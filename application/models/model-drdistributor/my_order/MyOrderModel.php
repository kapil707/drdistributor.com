<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MyOrderModel extends CI_Model  
{
	public function __construct(){
		parent::__construct();
	}
	
	public function get_chemist_photo($user_altercode){
		$row = $this->db->query("SELECT tbl_acm_other.image from tbl_acm,tbl_acm_other where tbl_acm.altercode='$user_altercode' and tbl_acm.code = tbl_acm_other.code")->row();
		$user_image = base_url()."user_profile/$row->image";
		if(empty($row->image))
		{
			$user_image = base_url()."img_v51/logo.png";
		}
		return $user_image;
	}
	
	public function get_my_order_api($user_type="",$user_altercode="",$salesman_id="",$get_record="",$limit=12) {		
		$jsonArray = array();
		
		$user_image = $this->get_chemist_photo($user_altercode);

		$query = $this->db->query("SELECT DISTINCT(order_id) as order_id,sum(`sale_rate`*`quantity`) as total,gstvno,date,time FROM `tbl_order` WHERE `chemist_id`= '$user_altercode' GROUP BY order_id,gstvno,date,time order by order_id desc limit $get_record,$limit")->result();
		if($user_type=="sales")
		{
			$query = $this->db->query("SELECT DISTINCT(order_id) as order_id,sum(`sale_rate`*`quantity`) as total,gstvno,date,time FROM `tbl_order` WHERE `chemist_id`= '$user_altercode' and selesman_id='$salesman_id' GROUP BY order_id,gstvno,date,time order by order_id desc limit $get_record,$limit")->result();
		}
		foreach($query as $row)
		{
			$get_record++;
			$order_id 	= $row->order_id;						
			$item_total = round($row->total,2);
			if(empty($row->gstvno))
			{
				$item_title = "Pending / Order no. ".$row->order_id;
			}
			else
			{
				$item_title = "Generated / Order no. ".$row->gstvno;
			}
			$item_date_time	= $row->date." ".$row->time;			
			$item_id = $order_id;
			$item_message  = $item_total;
			$item_image = $user_image;
			
			$dt = array(
				'item_id' => $item_id,
				'item_title' => $item_title,
				'item_message' => $item_message,
				'item_date_time' => $item_date_time,
				'item_image' => $item_image,
			);
			$jsonArray[] = $dt;
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] 		= $jsonArray;
		$return["get_record"] 	= $get_record;
		return $return;
	}
	
	public function get_my_order_details_api($user_type="",$user_altercode="",$salesman_id="",$item_id="") {
		
		$this->db->select("o.*,m.packing,m.expiry,m.company_full_name,m.packing,m.salescm1,m.salescm2,m.image1");
		$this->db->where('o.chemist_id',$user_altercode);
		$this->db->where('o.order_id',$item_id);
		$this->db->order_by('o.id','desc');
		$this->db->from('tbl_order as o');
		$this->db->join('tbl_medicine as m', 'm.i_code = o.i_code', 'left');
		$query = $this->db->get()->result();
		if($user_type=="sales")
		{
			$this->db->select("o.*,m.packing,m.expiry,m.company_full_name,m.packing,m.salescm1,m.salescm2,m.image1");
			$this->db->where('o.selesman_id',$salesman_id);
			$this->db->where('o.chemist_id',$user_altercode);
			$this->db->where('o.order_id',$item_id);
			$this->db->order_by('o.id','desc');
			$this->db->from('tbl_order as o');
			$this->db->join('tbl_medicine as m', 'm.i_code = o.i_code', 'left');
			$query = $this->db->get()->result();
		}
		foreach($query as $row)
		{
			if(empty($row->gstvno))
			{
				$title = "Pending / Order no. ".$row->order_id;
			}
			else
			{
				$title = "Generated / Order no. ".$row->gstvno;
			}

			$item_code 			= $row->i_code;
			$item_price 		= sprintf('%0.2f',round($row->sale_rate,2));
			$item_quantity 		= $row->quantity;
			$item_quantity_price= sprintf('%0.2f',round($row->quantity * $row->sale_rate,2));
			$item_date_time 	= date("d-M-y",strtotime($row->date))." ".$row->time;
			$item_modalnumber 	= "Pc / Laptop"; //$row->modalnumber;
			$item_name 		= (ucwords(strtolower($row->item_name)));
			$item_packing 	= ($row->packing);
			$item_expiry 	= ($row->expiry);
			$item_company 	= (ucwords(strtolower($row->company_full_name)));
			$item_scheme 	= $row->salescm1."+".$row->salescm2;
			$item_image = constant('img_url_site')."uploads/default_img.jpg";
			if(!empty($row->image1))
			{
				$item_image = constant('img_url_site').$row->image1;
			}
			
			$dt = array(
				'item_code' => $item_code,
				'item_image' => $item_image,
				'item_name' => $item_name,
				'item_packing' => $item_packing,
				'item_expiry' => $item_expiry,
				'item_company' => $item_company,
				'item_scheme' => $item_scheme,
				'item_price' => $item_price,
				'item_quantity' => $item_quantity,
				'item_quantity_price' => $item_quantity_price,
				'item_date_time' => $item_date_time,
				'item_modalnumber' => $item_modalnumber,
			);
			$jsonArray[] = $dt;
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $title;
		return $return;		
	}

	public function order_excel_file($query,$chemist_excle,$download_type)
	{
		error_reporting(0);
		
		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		
		ob_clean();		
		date_default_timezone_set('Asia/Calcutta');
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1','Code')
		->setCellValue('B1','Name')
		->setCellValue('C1','Quantity')
		->setCellValue('D1','PTR')
		->setCellValue('E1','Total')
		->setCellValue('F1','Chemist');		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);	
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray(array('font' => array('size' => 10,'bold' => false,'color' => array('rgb' => '000000'),'name'  => 'Arial')));
		$i = 0;
		$rowCount = 2;
		foreach($query as $row)
		{
			$i++;
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$row->item_code);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$row->item_name);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$row->quantity);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$row->sale_rate);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,$row->sale_rate * $row->quantity);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,$chemist_excle);
			
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.':F'.$rowCount)->applyFromArray(array('font' => array('size' => 8,'bold' => false,'color' => array('rgb' => '000000'),'name'  => 'Arial')));
			
			$file_name = $row->order_id;
			
			$rowCount++;
		}
		if($download_type=="direct_download")
		{
			$file_name = $file_name.".xls";
			
			//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
			/*$objWriter->save('uploads_sales/kapilkifile.xls');*/
			
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename='.$file_name);
			header('Cache-Control: max-age=0');
			ob_start();
			$objWriter->save('php://output');
			$data = ob_get_contents();
		}
	}
}
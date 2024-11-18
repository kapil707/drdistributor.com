<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MyOrderModel extends CI_Model  
{
	public function __construct(){
		parent::__construct();

		// Load model
		$this->load->model("model-drdistributor/user_model/UserModel");

		$this->load->model("model-drdistributor/medicine_details/MedicineDetailsModel");
	}

	public function OrderCheck($ChemistId,$OrderId){
		$this->db->select("id");
		$this->db->where('chemist_id',$ChemistId);
		$this->db->where('id',$OrderId);
		$row = $this->db->get("tbl_cart")->row();
		if(!empty($row)){
			return $row->id;
		}else{
			return "";
		}
	}
	
	public function get_my_order_api($UserType="",$ChemistId="",$SalesmanId="",$get_record="",$limit=12) {		
		$jsonArray = array();
		
		$user_image = $this->UserModel->get_chemist_photo($ChemistId);

		$query = $this->db->query("SELECT * FROM `tbl_cart_orderxxx` WHERE `chemist_id`= '$ChemistId' order by id desc limit $get_record,$limit")->result();
		if($UserType=="sales")
		{
			$query = $this->db->query("SELECT * FROM `tbl_cart_order` WHERE `chemist_id`= '$ChemistId' and `salesman_id`= '$SalesmanId' order by id desc limit $get_record,$limit")->result();
		}
		foreach($query as $row)
		{
			$get_record++;
			$order_id 	= $row->id;						
			$item_total = round($row->total,2);
			if(empty($row->gstvno))
			{
				$item_title = "Pending / Order no. ".$order_id;
			}
			else
			{
				$item_title = "Generated / Order no. ".$order_id ." / Gstvno no. ".$row->gstvno;
			}
			$item_date_time	= date("d-M-y",strtotime($row->date))." @ ".date("h:i a",strtotime($row->time));		
			$item_id = $order_id;
			$item_message  = $item_total;
			$item_image = $user_image;

			$download_url = base_url()."od/".$ChemistId."/".$order_id;
			
			$dt = array(
				'item_id' => $item_id,
				'item_title' => $item_title,
				'item_message' => $item_message,
				'item_date_time' => $item_date_time,
				'item_image' => $item_image,
				'download_url' => $download_url,
			);
			$jsonArray[] = $dt;
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] 		= $jsonArray;
		$return["get_record"] 	= $get_record;
		return $return;
	}
	
	public function get_my_order_details_api($UserType="",$ChemistId="",$SalesmanId="",$ItemId="") {
		
		$jsonArray = array();
		$title = $download_url = "";

		$this->db->select("*,m.packing,m.expiry,m.company_full_name,m.packing,m.salescm1,m.salescm2,m.image1");
		if($UserType=="sales")
		{
			$this->db->where('o.selesman_id',$SalesmanId);
		}
		$this->db->where('o.chemist_id',$ChemistId);
		$this->db->where('o.order_id',$ItemId);
		$this->db->where('o.status',1);
		$this->db->order_by('o.id','desc');
		$this->db->from('tbl_cartxxx as o');
		$this->db->join('tbl_medicine as m', 'm.i_code = o.i_code', 'left');
		$query = $this->db->get()->result();
		foreach($query as $row)
		{
			if(empty($row->gstvno))
			{
				$title = "Pending / Order no. ".$row->order_id;
			}
			else
			{
				$title = "Generated / Order no. ".$row->order_id ." / Gstvno no. ".$row->gstvno;
			}

			$download_url = base_url()."od/".$ChemistId."/".$row->order_id;

			$jsonArray[] = $this->MedicineDetailsModel->medicine_details_row_dt($row);
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $title;
		$return["download_url"] = $download_url;
		return $return;		
	}

	public function OrderExcelFile($ItemId,$download_type)
	{
		error_reporting(0);

		$where = array('order_id'=>$ItemId);
		$this->db->where($where);
		$query = $this->db->get("tbl_order");
		$row   = $query->row();
		$query = $query->result();

		/************************************************************* */
		$where 			= array('altercode'=>$row->chemist_id);
		$users 			= $this->Scheme_Model->select_row("tbl_chemist",$where);
		$acm_altercode 	= $users->altercode;
		$acm_name		= ucwords(strtolower($users->name));		
		$chemist_excle 	= "$acm_name ($acm_altercode)";
		/************************************************************* */
	
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
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray(array('font' => array('size' => 10,'bold' => true,'color' => array('rgb' => '343a40'),'name'  => 'Arial')));
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
			
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.':F'.$rowCount)->applyFromArray(array('font' => array('size' => 10,'bold' => false,'color' => array('rgb' => '343a40'),'name'  => 'Arial')));
			
			$file_name = $row->order_id;
			
			$rowCount++;
		}
		if($download_type=="direct_download")
		{
			$file_name = $file_name.".xls";
			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
			
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename='.$file_name);
			header('Cache-Control: max-age=0');
			ob_start();
			$objWriter->save('php://output');
			$data = ob_get_contents();
		}
	}

	//delete karna ha iss ko 
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MyInvoiceModel extends CI_Model  
{	
	public function __construct(){
		parent::__construct();

		// Load model
		$this->load->model("model-drdistributor/user_model/UserModel");
	}
	
	public function get_my_invoice_api($UserType="",$ChemistId="",$SalesmanId="",$get_record="",$limit="12")	{
		$jsonArray = array();

		$user_image = $this->UserModel->get_chemist_photo($ChemistId);

		$item_image 	= $user_image;
		$item_image 	= ($item_image);
		/**************************************************** */
		$order_by = array('id','desc');
		//$get_limit = array('12',$get_record);
		$get_limit = array($limit,$get_record);
		$where = array('chemist_id'=>$ChemistId);
		$query = $this->Scheme_Model->select_fun_limit("tbl_invoice",$where,$get_limit,$order_by);
		$query = $query->result();
		foreach($query as $row)
		{
			$get_record++;
			$item_id			= $row->id;
			$item_title 		= $row->gstvno;
			$item_total 		= number_format($row->amt,2);
			$item_date_time 	= date("d-M-y",strtotime($row->date));
			$out_for_delivery 	= "";//$row->out_for_delivery;
			$delete_status		= "";//$row->delete_status;

			$item_message   = $item_total;

			$gstvno = $row->gstvno;
			$download_url = base_url()."id/".$ChemistId."/".$gstvno;
			
			$dt = array(
				'item_id' => $item_id,
				'item_title' => $item_title,
				'item_message' => $item_message,
				'item_date_time' => $item_date_time,
				'item_image' => $item_image,
				'out_for_delivery' => $out_for_delivery,
				'delete_status' => $delete_status,
				'download_url' => $download_url
			);

			// Add the data to the JSON array
			$jsonArray[] = $dt;
		}
		
		$return["items"] = $jsonArray;
		$return["get_record"] = $get_record;		
		return $return;
	}

	public function get_my_invoice_details_api($UserType="",$ChemistId="",$SalesmanId="",$ItemId="")
	{
		$jsonArray = array();
		$jsonArray1 = array();
		$jsonArray2 = array();
		
		$title = "";
		$download_url = "";

		/**********************************************/
		$this->db->select('tbl_chemist.name as chemist_name, tbl_medicine.item_name, tbl_medicine.item_code, tbl_medicine.packing, tbl_medicine.expiry, tbl_medicine.batch_no, tbl_medicine.sale_rate, tbl_medicine.salescm1, tbl_medicine.salescm2, tbl_medicine.featured, tbl_medicine.image1, tbl_medicine.company_full_name, tbl_invoice.chemist_id, tbl_invoice.gstvno, tbl_invoice.amt, tbl_invoice_item.*');
        $this->db->from('tbl_invoice_item');
        $this->db->join('tbl_invoice', 'tbl_invoice.vno = tbl_invoice_item.vno AND tbl_invoice.date = tbl_invoice_item.date', 'left');
        $this->db->join('tbl_chemist', 'tbl_chemist.altercode = tbl_invoice.chemist_id', 'left');
        $this->db->join('tbl_medicine', 'tbl_medicine.i_code = tbl_invoice_item.itemc', 'left');
        $this->db->where('tbl_invoice.id', $ItemId);
		$this->db->where('tbl_invoice.chemist_id', $ChemistId);
		$query = $this->db->get();
		/**********************************************/
		$result = $query->result();		
		foreach($result as $row){

			$inv_type 	= "insert";
			$id			= $row->id;
			$gstvno 	= $row->gstvno;
			$title 		= $gstvno;
			$date_time 	= date("d-M-y",strtotime($row->date));
			$total 		= number_format($row->amt,2);
			$folder_dt 	= $row->date;
			
			$vno		= $row->vno;
			$date		= $row->date;

			$download_url = base_url()."id/".$user_altercode."/".$gstvno;
			
			$status = "Generated";
			
			$i_code 		= $row->itemc;
			$item_quantity 	= $row->qty;
			$item_code 		= $row->itemc; //yha sahi ha

			$item_price = sprintf('%0.2f',round($row->sale_rate,2));
			$item_quantity_price= sprintf('%0.2f',round($item_quantity * $row->sale_rate,2));
			$item_date_time 	= date("d-M-y",strtotime($date_time));
			$item_modalnumber 	= "Pc / Laptop"; //$row->modalnumber;
				
			$item_name 		= (ucwords(strtolower($row->item_name)));
			$item_packing 	= ($row->packing);
			$item_expiry 	= ($row->expiry);
			$item_company 	= (ucwords(strtolower($row->company_full_name)));
			$item_scheme 	= $row->salescm1."+".$row->salescm2;
			$item_featured 	= $row->featured;

			$item_image		= constant('img_url_site').$row->image1;
			if(empty($row->image1))
			{
				$item_image = base_url()."uploads/default_img.jpg";
			}
			
			$dt = array(
				'item_code' => $item_code,
				'item_image' => $item_image,
				'item_name' => $item_name,
				'item_packing' => $item_packing,
				'item_expiry' => $item_expiry,
				'item_company' => $item_company,
				'item_scheme' => $item_scheme,
				'item_featured' => $item_featured,
				'item_price' => $item_price,
				'item_quantity' => $item_quantity,
				'item_quantity_price' => $item_quantity_price,
				'item_date_time' => $item_date_time,
				'item_modalnumber' => $item_modalnumber,
			);

			// Add the data to the JSON array
			$jsonArray[] = $dt;
		}
	
		// URL to the JSON file (replace with the actual URL)
        $jsonUrl = 'https://www.drdweb.co.in/invoice_files/'.$date.'/'.$vno.'.json'; 
		// Initialize cURL session
		$ch = curl_init();

		// Set the URL and options
		curl_setopt($ch, CURLOPT_URL, $jsonUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL verification for testing (not recommended in production)

		// Execute the request
		$jsonContent = curl_exec($ch);

		// Check for cURL errors
		if (curl_errno($ch)) {
			echo 'cURL error: ' . curl_error($ch);
			curl_close($ch);
			return;
		}

		// Close the cURL session
		curl_close($ch);

		// Decode the JSON content into an associative array
		$dataArray = json_decode($jsonContent, true);

		// Check if the decoding was successful
		if (json_last_error() === JSON_ERROR_NONE) {
			// Loop through the array and extract 'itemc' values
			foreach ($dataArray as $item) {
				$item_code = $item['itemc'];
				$item_description1 = $item['remarks'];
				$item_type = $item['descp'];

				$row2 = $this->db->query("select * from tbl_medicine where i_code='$item_code'")->row();

				$item_price = sprintf('%0.2f',round($row2->sale_rate,2));
				$item_quantity_price= sprintf('%0.2f',round($item_quantity * $row2->sale_rate,2));
				$item_date_time 	= date("d-M-y",strtotime($date_time));
				$item_modalnumber 	= "Pc / Laptop"; //$row->modalnumber;
					
				$item_name 		= htmlentities(ucwords(strtolower($row2->item_name)));
				$item_packing 	= htmlentities($row2->packing);
				$item_expiry 	= htmlentities($row2->expiry);
				$item_company 	= htmlentities(ucwords(strtolower($row2->company_full_name)));
				$item_scheme 	= $row2->salescm1."+".$row2->salescm2;
				$item_featured 	= $row2->featured;

				$item_image		= constant('img_url_site').$row2->image1;
				if(empty($row2->image1))
				{
					$item_image = base_url()."uploads/default_img.jpg";
				}
				
				$dt = array(
					'item_code' => $item_code,
					'item_image' => $item_image,
					'item_name' => $item_name,
					'item_packing' => $item_packing,
					'item_expiry' => $item_expiry,
					'item_company' => $item_company,
					'item_scheme' => $item_scheme,
					'item_featured' => $item_featured,
					'item_price' => $item_price,
					'item_quantity' => $item_quantity,
					'item_quantity_price' => $item_quantity_price,
					'item_date_time' => $item_date_time,
					'item_modalnumber' => $item_modalnumber,
					'item_description1' => $item_description1,
				);

				if($item_type=="QTY.CHANGE"){
					// Add the data to the JSON array
					$jsonArray1[] = $dt;
				}else{
					// Add the data to the JSON array
					$jsonArray2[] = $dt;
				}
			}
		}
		
		/*
		// edit or delete
		$where = array('date'=>$date,'vno'=>$vno);
		$result = $this->Scheme_Model->select_all_result("tbl_invoice_item_delete",$where);
		//$result = $query->result();
		foreach($result as $row1){
			
			$item_code 		= $row1->itemc;
			
			$row2 = $this->db->query("select * from tbl_medicine where i_code='$item_code'")->row();

			$item_price = sprintf('%0.2f',round($row2->sale_rate,2));
			$item_quantity_price= sprintf('%0.2f',round($item_quantity * $row2->sale_rate,2));
			$item_date_time 	= date("d-M-y",strtotime($date_time));
			$item_modalnumber 	= "Pc / Laptop"; //$row->modalnumber;
				
			$item_name 		= htmlentities(ucwords(strtolower($row2->item_name)));
			$item_packing 	= htmlentities($row2->packing);
			$item_expiry 	= htmlentities($row2->expiry);
			$item_company 	= htmlentities(ucwords(strtolower($row2->company_full_name)));
			$item_scheme 	= $row2->salescm1."+".$row2->salescm2;
			$item_featured 	= $row2->featured;

			$item_image		= constant('img_url_site').$row2->image1;
			if(empty($row2->image1))
			{
				$item_image = base_url()."uploads/default_img.jpg";
			}
			
			$item_description1 = $row1->remarks;
			
			$dt = array(
				'item_code' => $item_code,
				'item_image' => $item_image,
				'item_name' => $item_name,
				'item_packing' => $item_packing,
				'item_expiry' => $item_expiry,
				'item_company' => $item_company,
				'item_scheme' => $item_scheme,
				'item_featured' => $item_featured,
				'item_price' => $item_price,
				'item_quantity' => $item_quantity,
				'item_quantity_price' => $item_quantity_price,
				'item_date_time' => $item_date_time,
				'item_modalnumber' => $item_modalnumber,
				'item_description1' => $item_description1,
			);

			if($row1->type=="edit")
			{
				// Add the data to the JSON array
				$jsonArray1[] = $dt;
			}else{
				// Add the data to the JSON array
				$jsonArray2[] = $dt;
			}
		}*/
		

		$return["items"] 		= $jsonArray;
		$return["items_edit"] 	= $jsonArray1;
		$return["items_delete"] = $jsonArray2;
		$return["download_url"] = $download_url;
		$return["title"] 		= $title;
		return $return;
	}
	
	public function invoice_excel_file($gstvno,$download_type)
	{	
		error_reporting(0);
		
		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		
		ob_clean();		

		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1','SUPPLIER')
		->setCellValue('B1','BILL NO.')
		->setCellValue('C1','DATE')
		->setCellValue('D1','COMPANY')
		->setCellValue('E1','CODE')
		->setCellValue('F1','BARCODE')
		->setCellValue('G1','ITEM NAME')
		->setCellValue('H1','PACK')
		->setCellValue('I1','BATCH')
		->setCellValue('J1','EXPIRY')
		->setCellValue('K1','QTY')
		->setCellValue('L1','F.QTY')
		->setCellValue('M1','HALFP')
		->setCellValue('N1','FTRATE')
		->setCellValue('O1','SRATE')
		->setCellValue('P1','MRP')
		->setCellValue('Q1','DIS')
		->setCellValue('R1','EXCISE')
		->setCellValue('S1','VAT')
		->setCellValue('T1','ADNLVAT')
		->setCellValue('U1','AMOUNT')
		->setCellValue('V1','LOCALCENT')
		->setCellValue('W1','SCM1')
		->setCellValue('X1','SCM2')
		->setCellValue('Y1','SCMPER')
		->setCellValue('Z1','HSNCODE')
		->setCellValue('AA1','CGST')
		->setCellValue('AB1','SGST')
		->setCellValue('AC1','IGST')
		->setCellValue('AD1','PSRLNO')
		->setCellValue('AE1','TCSPER')
		->setCellValue('AF1','TCSAMT')
		->setCellValue('AG1','ALTERCODE');
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(14);
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:AG1')->applyFromArray(array('font' => array('size' =>10,'bold' => TRUE,'name'  => 'Arial','color' => ['rgb' => '800000'],)));
		
		$objPHPExcel->getActiveSheet()
        ->getStyle('A1:AG1')
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setRGB('ccffff');
		
		$BStyle = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		  )
		);
		$objPHPExcel->getActiveSheet()->getStyle('A1:AG1')->applyFromArray($BStyle);
		
		/**********************************************/
		$this->db->select('tbl_chemist.name as chemist_name, tbl_medicine.item_name, tbl_medicine.item_code, tbl_medicine.packing,tbl_medicine.batch_no, tbl_medicine.company_full_name, tbl_invoice.chemist_id, tbl_invoice.gstvno, tbl_invoice_item.*');
        $this->db->from('tbl_invoice_item');
        $this->db->join('tbl_invoice', 'tbl_invoice.vno = tbl_invoice_item.vno AND tbl_invoice.date = tbl_invoice_item.date', 'left');
        $this->db->join('tbl_chemist', 'tbl_chemist.altercode = tbl_invoice.chemist_id', 'left');
        $this->db->join('tbl_medicine', 'tbl_medicine.i_code = tbl_invoice_item.itemc', 'left');
        $this->db->where('tbl_invoice.gstvno', $gstvno);
		$query = $this->db->get();
		/**********************************************/
		$result = $query->result();
		$rowCount = 2;
		$fileok=0;
		foreach($result as $row)
		{
			$fileok=1;
			$date = strtotime($row->date);
			$date = date('d/m/Y',$date);
			$gstvno = $row->gstvno;
			
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$row->chemist_name);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$gstvno);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$date);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$row->company_full_name);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,$row->itemc);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,(int)$row->item_code);
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,$row->item_name);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount,$row->packing);
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount,$row->batch_no);
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount,$row->expiry);
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount,$row->qty);
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount,$row->fqty);
			$objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount,$row->halfp);
			$objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount,$row->ftrate);
			$objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount,$row->ntrate);
			$objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount,$row->mrp);
			$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount,$row->dis);
			$objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount,$row->excise);
			$objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowCount,"0");
			$objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount,$row->adnlvat);
			$objPHPExcel->getActiveSheet()->SetCellValue('U'.$rowCount,$row->netamt);
			$objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowCount,$row->localcent);
			$objPHPExcel->getActiveSheet()->SetCellValue('W'.$rowCount,$row->scm1);
			$objPHPExcel->getActiveSheet()->SetCellValue('X'.$rowCount,$row->scm2);
			$objPHPExcel->getActiveSheet()->SetCellValue('Y'.$rowCount,$row->scmper);
			$objPHPExcel->getActiveSheet()->SetCellValue('Z'.$rowCount,$row->hsncode);
			$objPHPExcel->getActiveSheet()->SetCellValue('AA'.$rowCount,$row->cgst);
			$objPHPExcel->getActiveSheet()->SetCellValue('AB'.$rowCount,$row->sgst);
			$objPHPExcel->getActiveSheet()->SetCellValue('AC'.$rowCount,$row->igst);
			$objPHPExcel->getActiveSheet()->SetCellValue('AD'.$rowCount,$row->psrlno);
			$objPHPExcel->getActiveSheet()->SetCellValue('AE'.$rowCount,"0");
			$objPHPExcel->getActiveSheet()->SetCellValue('AF'.$rowCount,"0");
			$objPHPExcel->getActiveSheet()->SetCellValue('AG'.$rowCount,$row->chemist_id);
			
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.':AG'.$rowCount)->applyFromArray($BStyle);
			$rowCount++;
		}
		
		$name = $gstvno;
		if($download_type=="direct_download")
		{
			$file_name = $name.".xls";
			
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
		
		if($download_type=="cronjob_download")
		{
			if($fileok==1)
			{
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
				$file_name = "test_folder/".$name.".xls";
				$objWriter->save($file_name);
				
				$file_name2 = "test_folder/xx".$name.".xls";
				$objWriter->save($file_name2);
				
				$x[0] = $file_name;
				$x[1] = $invoice_message_body;
 				return $x;
			}
			else
			{
				$file_name = "";
				return $file_name;
			}
		}
	}
}  
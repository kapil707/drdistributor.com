<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MyInvoiceModel extends CI_Model  
{
	function select_fun($tbl,$where)
	{
		$db_invoice = $this->load->database('default3', TRUE);
		if($where!="")
		{
			$db_invoice->where($where);
		}
		return $db_invoice->get($tbl);	
	}
	function insert_fun($tbl,$dt)
	{
		$db_invoice = $this->load->database('default3', TRUE);
		if($db_invoice->insert($tbl,$dt))
		{
			return $db_invoice->insert_id();
		}
		else
		{
			return false;
		}
	}
	function edit_fun($tbl,$dt,$where)
	{
		$db_invoice = $this->load->database('default3', TRUE);
		if($db_invoice->update($tbl,$dt,$where))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function delete_fun($tbl,$where)
	{
		$db_invoice = $this->load->database('default3', TRUE);
		if($db_invoice->delete($tbl,$where))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function select_fun_limit($tbl,$where,$get_limit='',$order_by='')
	{
		$db_invoice = $this->load->database('default3', TRUE);
		if(!empty($where))
		{
			$db_invoice->where($where);
		}
		if(!empty($order_by))
		{
			$db_invoice->order_by($order_by[0],$order_by[1]);
		}
		if(!empty($get_limit))
		{
			$db_invoice->limit($get_limit[0],$get_limit[1]);
		}
		return $db_invoice->get($tbl);	
	}
	
	/********************************************************/

	public function my_invoice_api($user_type="",$user_altercode="",$salesman_id="",$get_record="")
	{
		$jsonArray = array();

		/************************************** */
		$row1 = $this->db->query("SELECT tbl_acm.name,tbl_acm.altercode,tbl_acm_other.image from tbl_acm,tbl_acm_other where tbl_acm.altercode='$user_altercode' and tbl_acm.code = tbl_acm_other.code")->row();
		$user_image = base_url()."user_profile/$row1->image";
		if(empty($row1->image))
		{
			$user_image = base_url()."img_v51/logo.png";
		}
		$item_image 	= $user_image;
		$item_image 	= ($item_image);
		/************************************** */

		if($user_type=="sales")
		{
			$order_by = array('id','desc');
			$get_limit = array('12',$get_record);
			$where = array('chemist_id'=>$user_altercode);
			$query = $this->select_fun_limit("tbl_invoice_new",$where,$get_limit,$order_by);
			$query = $query->result();
		}
		else
		{
			$order_by = array('id','desc');
			$get_limit = array('12',$get_record);
			$where = array('chemist_id'=>$user_altercode);
			$query = $this->select_fun_limit("tbl_invoice_new",$where,$get_limit,$order_by);
			$query = $query->result();
		}
		foreach($query as $row)
		{
			$get_record++;
			$item_id			= $row->id;
			$item_title 		= $row->gstvno;
			$item_total 		= number_format($row->amt,2);
			$item_date_time 	= date("d-M-y",strtotime($row->vdt));
			$out_for_delivery 	= "";//$row->out_for_delivery;
			$delete_status		= $row->delete_status;

			$item_message   = $item_total;

			$gstvno = $row->gstvno;
			$download_url = base_url()."invoice_download/".$user_altercode."/".$gstvno;
			
			$dt = array(
				'item_id' => $item_id,
				'item_title' => $item_title,
				'item_message' => $item_message,
				'item_date_time' => $item_date_time,
				'item_name' => $item_name,
				'item_image' => $item_image,
				'out_for_delivery' => $out_for_delivery,
				'delete_status' => $delete_status,
				'download_url' => $download_url
			);

			// Add the data to the JSON array
			$jsonArray[] = $dt;
		}
		$jsonString = json_encode($jsonArray);
		
		$return_value["items"] = $jsonString;
		$return_value["get_record"] = $get_record;
		
		return $return_value;
	}

	public function my_invoice_details_api($user_type="",$user_altercode="",$salesman_id="",$item_id="")
	{
		$jsonArray = array();
		$jsonArray1 = array();
		$jsonArray2 = array();
		
		$header_title = "";
		$download_url = "";
		
		$where = array('id'=>$item_id,'chemist_id'=>$user_altercode);
		$query = $this->select_fun("tbl_invoice_new",$where);
		$row = $query->row();
		if(!empty($row->id))
		{
			$inv_type 	= "insert";
			$id			= $row->id;
			$gstvno 	= $row->gstvno;
			$header_title = $gstvno;
			$date_time 	= date("d-M-y",strtotime($row->date));
			$total 		= number_format($row->amt,2);
			$folder_dt 	= $row->date;
			
			$vdt		= $row->vdt;
			$vno		= $row->vno;

			$download_url = base_url()."invoice_download/".$user_altercode."/".$gstvno;
			
			$name = substr($row->name,0,19);
			$file_name = "_D.R.DISTRIBUTORS PVT_".$name.".xls";
			
			$where = array('vdt'=>$vdt,'vno'=>$vno);
			$query = $this->select_fun("tbl_invoice_item",$where);
			$result = $query->result();
			foreach($result as $row1){
				$status = "Generated";
				
				$item_code 		= $row1->item_code;
				$item_quantity 	= $row1->qty;
				
				$row2 = $this->db->query("select * from tbl_medicine where item_code='$item_code'")->row();

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

				// Add the data to the JSON array
				$jsonArray[] = $dt;
			}
			
			// edit or delete
			$where = array('vdt'=>$vdt,'vno'=>$vno);
			$query = $this->select_fun("tbl_invoice_item_delete",$where);
			$result = $query->result();
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
			}
		}

$header_title= <<<EOD
{"header_title":"{$header_title}"}
EOD;

$download_url= <<<EOD
{"download_url":"{$download_url}"}
EOD;
		
		$jsonString  = json_encode($jsonArray);
		$jsonString1 = json_encode($jsonArray1);
		$jsonString2 = json_encode($jsonArray2);
		
		$val[0] = $jsonString; //item 
		$val[1] = $jsonString1;//item edit
		$val[2] = $jsonString2;//item delete
		$val[3] = "[$download_url]";
		$val[4] = "[$header_title]";
		return $val;
	}
	
	public function invoice_excel_file($gstvno,$download_type)
	{		
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
		$where = array('gstvno'=>$gstvno);
		$query = $this->select_fun("tbl_invoice_new",$where);
		$row   = $query->row();
		$chemist_name = $row->chemist_name;
		/**********************************************/
		
		$where = array('vdt'=>$row->vdt,'vno'=>$row->vno);
		$query = $this->select_fun("tbl_invoice_item",$where);
		$result = $query->result();
		$rowCount = 2;
		$fileok=0;
		foreach($result as $row)
		{
			$fileok=1;
			$vdt = strtotime($row->vdt);
			$vdt = date('d/m/Y',$vdt);
			
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$chemist_name);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$gstvno);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$vdt);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$row->company_full_name);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,$row->itemc);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,(int)$row->item_code);
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,$row->item_name);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount,$row->packing);
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount,$row->batch);
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
			$objPHPExcel->getActiveSheet()->SetCellValue('AG'.$rowCount,$chemist_id);
			
			
			$item_name  = $row->item_name;
			$qty  		= $row->qty;
			$batch  	= $row->batch;
			$expiry  	= $row->expiry;
			
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
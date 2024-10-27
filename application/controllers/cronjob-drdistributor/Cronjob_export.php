<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit','-1');
class Cronjob_export extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
	}
    public function test_email()
	{
		$this->load->library('phpmailer_lib');
		$email = $this->phpmailer_lib->load();
		
		$subject = "drd local test ok";
		$message = "drd local test ok";
		
		$addreplyto 		= "application@drdistributor.com";
		$addreplyto_name 	= "Vipul DRD";
		$server_email 		= "application@drdistributor.com";
		//$server_email 	= "send@drdindia.com";
		$server_email_name 	= "DRD TEST";
		$email1 			= "kapil707sharma@gmail.com";
		
		$email->AddReplyTo($addreplyto,$addreplyto_name);
		$email->SetFrom($server_email,$server_email_name);
		$email->AddAddress($email1);
		
		$email->Subject   	= $subject;
		$email->Body 		= $message;

		$email->IsHTML(true);

		// SMTP configuration
		$email->isSMTP();
		$email->SMTPAuth   = 3; 
		$email->SMTPSecure = "tls";  //tls
		$email->Host     = "smtp.gmail.com";
		$email->Username   = "application2@drdindia.com";
		$email->Password   = "drd@june2023";
		$email->Port     = 587;

		if($email->send()){
            echo 'Message has been sent';
        }else{
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $email->ErrorInfo;
        }
		echo "<pre>";
		print_r($email);
	}

	public function create_excel_file_for_other_site()
	{
		//error_reporting(0);
		$delimiter = ",";
		$fp = fopen('chemist/uploads_sales/item_list.csv', 'w');
		$fields = array('Company_Name','DIVISION','Item_Code','Item_Name','Packing','Expiry','BatchNo','SaleRate','MRP','SaleScm1','SaleScm2','BATCHQTY','GSTPER','Item_Date','Time');
		fputcsv($fp, $fields, $delimiter);
		$query = $this->db->get("tbl_medicine")->result();
		foreach($query as $row)
		{
			if($row->misc_settings=="#NRX"){
				$batchqty = "10";
				if($row->batchqty<10){
					$batchqty = $row->batchqty;
				}
			}else{
				$batchqty = $row->batchqty;
			}
			$dt = date("d-M-Y");
			$tt = date("H:i:s");
			$item_date = date("d-M-Y", strtotime($row->item_date));
			$lineData = array("$row->company_name","$row->division","$row->item_code","$row->item_name","$row->packing","$row->expiry","$row->batch_no","$row->sale_rate","$row->mrp","$row->salescm1","$row->salescm2","$batchqty","$row->gstper","$item_date","$dt","$tt");
			fputcsv($fp, $lineData, $delimiter);
		}
		fclose($fp);
		echo "Create Excel File For Other Site Working";
	}
}
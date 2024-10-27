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
		$filepath = 'chemist/uploads_sales/item_list.csv';

		// fopen के साथ error handling
		if (!$fp = fopen($filepath, 'w')) {
			die("Unable to open file for writing.");
		}

		$fields = array('Company_Name', 'DIVISION', 'Item_Code', 'Item_Name', 'Packing', 'Expiry', 'BatchNo', 'SaleRate', 'MRP', 'SaleScm1', 'SaleScm2', 'BATCHQTY', 'GSTPER', 'Item_Date', 'Date', 'Time');
		if (fputcsv($fp, $fields, $delimiter) === false) {
			die("Unable to write column headers to file.");
		}
		//$this->db->limit("100");
		$query = $this->db->get("tbl_medicine")->result();
		//print_r($query);
		foreach ($query as $row) {
			$batchqty = ($row->misc_settings == "#NRX" && $row->batchqty < 10) ? $row->batchqty : "10";

			$date = date("d-M-Y");
			$time = date("H:i:s");
			$item_date = date("d-M-Y", strtotime($row->item_date));

			$lineData = array(
				$row->company_name,
				$row->division,
				$row->item_code,
				$row->item_name,
				$row->packing,
				$row->expiry,
				$row->batch_no,
				$row->sale_rate,
				$row->mrp,
				$row->salescm1,
				$row->salescm2,
				$batchqty,
				$row->gstper,
				$item_date,
				$date,
				$time
			);

			// डेटा को CSV में लिखें और एरर चेक करें
			if (fputcsv($fp, $lineData, $delimiter) === false) {
				die("Unable to write data row to file.");
			}
		}

		fclose($fp);
		echo "CSV file created successfully for other site.";
	}
}
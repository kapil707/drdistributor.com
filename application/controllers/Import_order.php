<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Import_order extends CI_Controller {

	var $UserId 		= "";
	var $UserType 		= "";
	var $UserFullName 	= "";
	var $UserPassword 	= "";
	var $UserImage 		= "";
	var $ChemistNrx 	= "";
	var $ChemistId 		= "";
	var $SalesmanId 	= "";
	var $FirebaseToken  = "";
	var $UserCart  		= "";
	
	var $MedicineImageUrl = "";
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');
		$this->load->library('session');

		/************login check************** */	
		LoginCheck("import_order");
		/************************************* */

		/************log file***************** */
		CreateUserLog();
		/************************************* */

		/********************session start***************************** */
		$this->UserId		= $this->session->userdata('UserId');
		$this->UserType    	= $this->session->userdata('UserType');
		$this->UserFullName = $this->session->userdata('UserFullName');
		$this->UserPassword	= $this->session->userdata('UserPassword');
		$this->UserImage 	= $this->session->userdata('UserImage');
		$this->ChemistNrx	= $this->session->userdata('ChemistNrx');
		$this->ChemistId	= $this->session->userdata('ChemistId');
		$this->SalesmanId	= $this->session->userdata('SalesmanId');
		$this->FirebaseToken= $this->session->userdata('FirebaseToken');
		$this->UserCart		= $this->session->userdata('UserCart');
		/********************************************************** */
	}
	
	public function index()
	{
		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Upload order";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */

		/********************PageMainData************************** */
		$data["UserId"] 	 = $this->UserId;
		$data["UserType"]    = $this->UserType;
		$data["UserFullName"]= $this->UserFullName;
		$data["UserImage"] 	 = $this->UserImage;
		$data["ChemistId"]	 = $this->ChemistId;
		$data["FirebaseToken"]= $this->FirebaseToken;

		/******************DeliveringToData************************* */
		$data["DeliveringTo"]= $data["ChemistId"];
		if($this->UserType=="sales")
		{
			$data["DeliveringTo"] = $data["ChemistId"]." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}
		/********************************************************** */
		$ChemistId = $this->ChemistId;

		$where = array('user_altercode'=>$ChemistId);
		$row = $this->Scheme_Model->select_row("tbl_import_order_excel_row",$where);
		$data["headername"] = $data["itemname"] = $data["itemqty"] = $data["itemmrp"] 	= "";
		if(!empty($row->headername))
		{
			$data["headername"] = $row->headername;
			$data["itemname"] 	= $row->itemname;
			$data["itemqty"] 	= $row->itemqty;
			$data["itemmrp"] 	= $row->itemmrp;
		}
		
		$this->load->view('header_footer/header', $data);
		$this->load->view('import_order/index', $data);
		$this->load->view('header_footer/footer', $data);
	}
	
	public function medicine_suggest(){

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Suggest medicine";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */
		
		/********************PageMainData************************** */
		$data["UserId"] 	 = $this->UserId;
		$data["UserType"]    = $this->UserType;
		$data["UserFullName"]= $this->UserFullName;
		$data["UserImage"] 	 = $this->UserImage;
		$data["ChemistId"]	 = $this->ChemistId;
		$data["FirebaseToken"]= $this->FirebaseToken;

		/******************DeliveringToData************************* */
		$data["DeliveringTo"]= $data["ChemistId"];
		if($this->UserType=="sales")
		{
			$data["DeliveringTo"] = $data["ChemistId"]." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}
		/********************************************************** */

		$this->load->view('header_footer/header',$data);
		$this->load->view('import_order/medicine_suggest', $data);
		$this->load->view('header_footer/footer', $data);
	}
	
	public function process_main($order_id=''){
		
		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Import order";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */
		
		/********************PageMainData************************** */
		$data["UserId"] 	 = $this->UserId;
		$data["UserType"]    = $this->UserType;
		$data["UserFullName"]= $this->UserFullName;
		$data["UserImage"] 	 = $this->UserImage;
		$data["ChemistId"]	 = $this->ChemistId;
		$data["FirebaseToken"]= $this->FirebaseToken;

		/******************DeliveringToData************************* */
		$data["DeliveringTo"]= $data["ChemistId"];
		if($this->UserType=="sales")
		{
			$data["DeliveringTo"] = $data["ChemistId"]." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}
		/********************************************************** */
		$data["order_id"] = $order_id;

		$this->load->view('header_footer/header', $data);
		$this->load->view('import_order/process_main', $data);
		$this->load->view('header_footer/footer', $data);
		$this->load->view('header_footer/medicine_details_model', $data);
	}
	
	public function medicine_deleted_items($order_id=''){
	
		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Deleted items";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */
		
		/********************PageMainData************************** */
		$data["UserId"] 	 = $this->UserId;
		$data["UserType"]    = $this->UserType;
		$data["UserFullName"]= $this->UserFullName;
		$data["UserImage"] 	 = $this->UserImage;
		$data["ChemistId"]	 = $this->ChemistId;
		$data["FirebaseToken"]= $this->FirebaseToken;

		/******************DeliveringToData************************* */
		$data["DeliveringTo"]= $data["ChemistId"];
		if($this->UserType=="sales")
		{
			$data["DeliveringTo"] = $data["ChemistId"]." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}
		/********************************************************** */
		$ChemistId = $this->ChemistId;
		$SalesmanId = $this->SalesmanId;

		$data["order_id"] = $order_id = base64_decode($order_id);
		if($this->UserType=="chemist")
		{
			$users = $this->db->query("select * from tbl_chemist where altercode='$ChemistId' ")->row();
			$acm_altercode 	= $users->altercode;
			$acm_name		= $users->name;
			$acm_email 		= $users->email;
			$acm_mobile 	= $users->mobile;			
			
			$chemist_excle 	= "$acm_name ($acm_altercode)";
			$file_name 		= $acm_altercode;
		}
		if($this->UserType=="sales")
		{
			//jab sale man say login hota ha to
			$users = $this->db->query("select * from tbl_chemist where altercode='$ChemistId' ")->row();
			$user_session	= $users->id;
			$acm_altercode 	= $users->altercode;
			$acm_name 		= $users->name;
			$acm_email 		= $users->email;
			$acm_mobile 	= $users->mobile;

			$users = $this->db->query("select * from tbl_users where customer_code='$SalesmanId' ")->row();
			$salesman_name 		= $users->firstname." ".$users->lastname;
			$salesman_mobile	= $users->cust_mobile;
			$salesman_altercode	= $users->customer_code;
			
			$chemist_excle 	= $acm_name." ($acm_altercode)";
			$file_name 		= $acm_altercode;
		}
		/***********************************************/
		$result = $this->db->query("select * from tbl_import_order_excel_file where order_id='$order_id' and (status=0 or status=1 or status=3)")->result();
		$data["result"]	= $result;
		if(empty($result))
		{
			redirect(base_url()."mc");
		}
		
		$dt = $dt1 = $dt2 = "";
		$i = 0;
		foreach($result as $row)
		{
			$i++;
			$item_name = $row->item_name;
			$mrp = $row->mrp;
			$quantity = $row->quantity;
			
			$dt1 = "<br><table border='1' width='100%'><tr><td>Sno</td><td>Deleted Item Name</td><td>Deleted Item Mrp.</td><td>Deleted Item Quantity</td></tr>";
			$dt.= "<tr><td>".$i."</td><td>".$item_name."</td><td>".$mrp."</td><td>".$quantity."</td></tr>";
			$dt2.= "</table>";
		}
		
		$message = $dt1.$dt.$dt2;
		$subject   = "Import order delete items from D.R. Distributors Pvt. Ltd.";
		
		$user_email_id = $acm_email;
		if (filter_var($user_email_id, FILTER_VALIDATE_EMAIL)) {
		
		}
		else{			
			$user_email_id="";
		}
		
		if(!empty($user_email_id))
		{
			$file_name_1 = "Import-Order-Deleted-Items-Report.xls";
			$file_name1  = $this->import_orders_delete_items($result);
			
			$subject = ($subject);
			$message = ($message);
			$email_function = "import_orders_delete_items";
			$mail_server = "";
			$date = date('Y-m-d');
			$time = date("H:i",time());
			
			$dt = array(
			'user_email_id'=>$user_email_id,
			'subject'=>$subject,
			'message'=>$message,
			'email_function'=>$email_function,
			'file_name1'=>$file_name1,
			'file_name_1'=>$file_name_1,
			'mail_server'=>$mail_server,
			'date'=>$date,
			'time'=>$time,
			);
			$this->Scheme_Model->insert_fun("tbl_email_send",$dt);				
		}
		
		$this->load->view('header_footer/header', $data);
		$this->load->view('import_order/medicine_deleted_items', $data);
		$this->load->view('header_footer/footer', $data);
	}
	
	public function import_orders_delete_items($query)
	{
		error_reporting(0);

		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		
		ob_clean();		
		date_default_timezone_set('Asia/Calcutta');
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1', 'Sno')
		->setCellValue('B1', 'Item Name')
		->setCellValue('C1', 'Item Mrp.')
		->setCellValue('D1', 'Item Quantity');		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);	
		$i = 0;
		$rowCount = 2;
		foreach($query as $row)
		{
			$i++;			
			$item_name = $row->item_name;
			$mrp = $row->mrp;
			$quantity = $row->quantity;
			
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$i);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$item_name);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$mrp);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$quantity);
			$rowCount++;
		}
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$file_name = "temp_files/import_orders_delete_items_".time().".xls";
		$objWriter->save($file_name);
		return $file_name;
	}
	
	public function downloadfile($order_id='')
	{	
		$order_id = base64_decode($order_id);
		$result = $this->db->query("select * from tbl_import_order_excel_file where order_id='$order_id' and (status=0 or status=1 or status=3)")->result();
		
		$delimiter = ",";
		$filename = "download.csv";
		$i = 0;
		$f = fopen('php://memory', 'w');
		$fields = array('ID', 'Name','Mrp', 'Qty');
		fputcsv($f, $fields, $delimiter);
		foreach($result as $row)
		{
			$i++;
			$lineData = array($i, $row->item_name,$row->mrp,$row->quantity);
			fputcsv($f, $lineData, $delimiter);
		}
		fseek($f, 0);
		
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '";');
		
		fpassthru($f);
		exit;
	}
	
	public function import_order_downloadall($order_id='')
	{
		$result = $this->db->query("select * from tbl_import_order_excel_file where order_id='$order_id' and status='0'")->result();
		
		$delimiter = ",";
		$filename = "download.csv";
		$i = 0;
		$f = fopen('php://memory', 'w');
		$fields = array('ID', 'Name', 'Qty');
		fputcsv($f, $fields, $delimiter);
		foreach($result as $row)
		{
			$i++;
			$lineData = array($i, $row->item_name, $row->quantity);
			fputcsv($f, $lineData, $delimiter);
		}
		fseek($f, 0);
		
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '";');
		
		fpassthru($f);
		exit;
	}
}
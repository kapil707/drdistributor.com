<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_invoice extends CI_Controller {

	var $user_image = "";
	var $user_fname = "";
	var $delivering_to = "";
	var $user_type = "";
	var $user_altercode = "";
	var $user_password = "";
	var $chemist_id = "";
	var $salesman_id = "";
	var $user_nrx  = "";
	
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');
		$this->load->library('session');

		/************log file***************** */
		CreateUserLog();
		/************************************* */
	
		// Load model
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");

		/********************session start***************************** */
		$this->user_image 	 = $this->session->userdata('user_image');
		$this->user_fname    = $this->session->userdata('user_fname');
		$this->delivering_to = $this->session->userdata('user_altercode');	
		
		$this->user_type 		= $this->session->userdata('user_type');
		$this->user_altercode 	= $this->session->userdata('user_altercode');
		$this->user_password	= $this->session->userdata('user_password');
		$this->user_nrx			= $this->session->userdata('user_nrx');

		$chemist_id = $salesman_id = "";
		if($this->user_type=="sales" && !empty($this->session->userdata('chemist_id')))
		{
			$this->chemist_id 		= $this->session->userdata('chemist_id');
			$this->salesman_id 		= $this->user_altercode;
			$this->user_altercode 	= $this->chemist_id;
			$this->delivering_to 	= $this->chemist_id;
		}
		/********************************************************** */
	}

	public function index(){
		/************login check************** */
		LoginCheck("my_invoice");
		/************************************* */

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "My invoice";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */

		/********************session***************************** */
		$data["session_user_image"] 	= $this->session->userdata('user_image');
		$data["session_user_fname"]     = $this->session->userdata('user_fname');
		$data["session_user_altercode"] = $this->session->userdata('user_altercode');
		$data["session_delivering_to"]  = $this->session->userdata('user_altercode');	
		
		$user_type 		= $this->session->userdata('user_type');
		$user_altercode = $this->session->userdata('user_altercode');
		$user_password	= $this->session->userdata('user_password');

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $this->session->userdata('chemist_id');
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		/********************************************************** */
		$data["chemist_id"] = $chemist_id;

		$this->load->view('header_footer/header', $data);
		$this->load->view('my_invoice/my_invoice',$data);
		$this->load->view('header_footer/footer', $data);
	}

	public function my_invoice_details($item_id=""){

		/************login check************** */
		LoginCheck("my_invoice");
		/************************************* */

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "My invoice details";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */

		/********************session***************************** */
		$data["session_user_image"] 	= $this->session->userdata('user_image');
		$data["session_user_fname"]     = $this->session->userdata('user_fname');
		$data["session_user_altercode"] = $this->session->userdata('user_altercode');
		$data["session_delivering_to"]  = $this->session->userdata('user_altercode');	
		
		$user_type 		= $this->session->userdata('user_type');
		$user_altercode = $this->session->userdata('user_altercode');
		$user_password	= $this->session->userdata('user_password');

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $this->session->userdata('chemist_id');
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		/********************************************************** */
		$data["chemist_id"] = $chemist_id;

		$data["item_id"] = $item_id;
		
		$this->load->view('header_footer/header', $data);
		$this->load->view('my_invoice/my_invoice_details',$data);
		$this->load->view('header_footer/footer', $data);
	}

	/*******************api start*********************/
	public function my_invoice_api(){
		$get_record	 	= $_REQUEST["get_record"];
		/********************session***************************** */
		$user_type 		= $this->session->userdata('user_type');
		$user_altercode = $this->session->userdata('user_altercode');
		$user_password	= $this->session->userdata('user_password');

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $this->session->userdata('chemist_id');
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		/********************************************************** */
		$items = "";
		if(!empty($user_type) && !empty($user_altercode)) {

			$result = $this->MyInvoiceModel->get_my_invoice_api($user_type,$user_altercode,$salesman_id,$get_record);
			$items  	= $result["items"];
			$get_record  = $result["get_record"];
		}

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
			'get_record' => $get_record
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function my_invoice_details_api(){
		$item_id		= $_REQUEST['item_id'];
		/********************session***************************** */
		$user_type 		= $this->session->userdata('user_type');
		$user_altercode = $this->session->userdata('user_altercode');
		$user_password	= $this->session->userdata('user_password');

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $this->session->userdata('chemist_id');
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		/********************************************************** */
		$items = $items_edit = $items_delete = $download_url = $title = "";
		if(!empty($user_type) && !empty($user_altercode) && !empty($item_id)){			
			$result = $this->MyInvoiceModel->get_my_invoice_details_api($user_type,$user_altercode,$salesman_id,$item_id);
			$items  		= $result["items"];
			$items_edit  	= $result["items_edit"];
			$items_delete  	= $result["items_delete"];
			$download_url  	= $result["download_url"];
			$title			= $result["title"];
		}	
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
			'items_edit' => $items_edit,
			'items_delete' => $items_delete,
			'download_url' => $download_url,
			'title' => $title,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function my_invoice_details_main_api(){

		$item_id		= $_REQUEST['item_id'];
		$user_type 		= "chemist";
		$user_altercode = $_REQUEST['user_altercode'];
		$user_password	= "";
		$chemist_id 	= "";
		$salesman_id = "";
		/*if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}*/
		$items = $items_edit = $items_delete = $download_url = $title = "";
		if(!empty($user_type) && !empty($user_altercode) && !empty($item_id)){			
			$result = $this->MyInvoiceModel->get_my_invoice_details_api($user_type,$user_altercode,$salesman_id,$item_id);
			$items  		= $result["items"];
			$items_edit  	= $result["items_edit"];
			$items_delete  	= $result["items_delete"];
			$download_url  	= $result["download_url"];
			$title			= $result["title"];
		}	
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
			'items_edit' => $items_edit,
			'items_delete' => $items_delete,
			'download_url' => $download_url,
			'title' => $title,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
}
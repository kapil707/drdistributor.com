<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_invoice extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Load model

		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");
	}

	public function index(){

		$this->load->model("model-drdistributor/account_model/AccountModel");
        $this->AccountModel->login_check("my_invoice");
		
		$data["main_page_title"] = "My invoice";

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["session_delivering_to"]  = $_COOKIE['user_altercode'];		
		
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$data["chemist_id"] = $chemist_id;
		if($user_type=="sales")
		{
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist'> <img src='".base_url()."/img_v51/edit_icon.png' width='12px;' style='margin-top: 2px;margin-bottom: 2px;'> Edit chemist</a>";
		}

		/********************************************************** */
		$page_name = "my_invoice";
		$browser_type = "Web";
		$browser = "";

		$this->load->model("model-drdistributor/activity_model/ActivityModel");
		$this->ActivityModel->activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */

		$this->load->view('header_footer/header', $data);
		$this->load->view('my_invoice/my_invoice',$data);
	}

	public function my_invoice_details($item_id=""){

		$this->load->model("model-drdistributor/account_model/AccountModel");
        $this->AccountModel->login_check("my_invoice");
		
		$data["main_page_title"] = "My invoice details";

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["session_delivering_to"]  = $_COOKIE['user_altercode'];		
		
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$data["chemist_id"] = $chemist_id;
		if($user_type=="sales")
		{
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist'> <img src='".base_url()."/img_v51/edit_icon.png' width='12px;' style='margin-top: 2px;margin-bottom: 2px;'> Edit chemist</a>";
		}

		/********************************************************** */
		$page_name = "my_invoice_details";
		$browser_type = "Web";
		$browser = "";

		$this->load->model("model-drdistributor/activity_model/ActivityModel");
		$this->ActivityModel->activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */

		$data["item_id"] = $item_id;
		
		$this->load->view('header_footer/header', $data);
		$this->load->view('my_invoice/my_invoice_details',$data);
	}

	/*******************api start*********************/
	public function my_invoice_api(){
		$get_record	 	= $_REQUEST["get_record"];
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];
		$chemist_id 	= "";
		$salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
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
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];
		$chemist_id 	= "";
		$salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
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
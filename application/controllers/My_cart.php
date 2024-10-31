<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_cart extends CI_Controller {

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

		/************login check************** */
		LoginCheck("my_cart");
		/************************************* */

		/************log file***************** */
		CreateUserLog();
		/************************************* */

		// Load model
		$this->load->model("model-drdistributor/my_cart/MyCartModel");

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

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "My order";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */

		/********************PageMainData************************** */
		$data["session_user_image"] 	= $this->user_image;
		$data["session_user_fname"]     = $this->user_fname;
		$data["session_user_altercode"] = $this->user_altercode;
		$data["session_delivering_to"]  = $this->delivering_to;

		$data["chemist_id"] = $chemist_id = $this->chemist_id; 
		if($this->user_type=="sales")
		{
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}
		/********************************************************** */
		
		$this->load->view('header_footer/header', $data);
		$this->load->view('my_cart/my_cart', $data);
	}

	/*******************api start*********************/
	public function my_cart_total_api(){
		$user_type 		= $this->user_type;
		$user_altercode = $this->user_altercode;
		$chemist_id 	= $this->chemist_id;
		$salesman_id 	= $this->salesman_id;
		/********************************************************** */
		$items = "";
		if(!empty($user_altercode))
		{
			$result = $this->MyCartModel->my_cart_total_api($user_type,$user_altercode,$user_password,$salesman_id);
			$items = $result["items"];
		}
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
	public function my_cart_api(){
		
		$user_type 		= $this->user_type;
		$user_altercode = $this->user_altercode;
		$user_password	= $this->user_password;
		$chemist_id 	= $this->chemist_id;
		$salesman_id 	= $this->salesman_id;
		/********************************************************** */
		$order_type = $_POST["order_type"];
		$items = $items_other = "";
		if(!empty($user_altercode))
		{
			$result = $this->MyCartModel->my_cart_api($user_type,$user_altercode,$user_password,$salesman_id,$order_type);
			$items = $result["items"];
			$items_other = $result["items_other"];
			$items_total = $result["items_total"];
		}
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
            'items_other' => $items_other
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function medicine_add_to_cart_api()
	{
		$item_code				= $_REQUEST["item_code"];
		$item_order_quantity	= $_REQUEST["item_order_quantity"];
		$order_type 	= "pc_mobile";
		$mobilenumber 	= "";
		$modalnumber 	= "PC / Laptop";
		$device_id 		= "";
		
		$user_type 		= $this->user_type;
		$user_altercode = $this->user_altercode;
		$chemist_id 	= $this->chemist_id;
		$salesman_id 	= $this->salesman_id;
		
		$status = $status_message = "";
		if(!empty($user_type) && !empty($user_altercode)){
			$excel_number = "";		
			$result = $this->MyCartModel->medicine_add_to_cart_api($user_type,$user_altercode,$salesman_id,$order_type,$item_code,$item_order_quantity,$mobilenumber,$modalnumber,$device_id,$excel_number);
			
			$status = $result["status"];
			$status_message = $result["status_message"];
		}

		$dt = array(
			'status' => $status,
			'status_message' => $status_message,
		);
		$items[] = $dt;
		
		$response = array(
            'success' => "1",
            'message' => 'Data add successfully',
            'items'=>$items,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function medicine_delete_all_api(){

		$user_type 		= $this->user_type;
		$user_altercode = $this->user_altercode;
		$chemist_id 	= $this->chemist_id;
		$salesman_id 	= $this->salesman_id;

		if(!empty($user_type) && !empty($user_altercode)){
			$result = $this->MyCartModel->medicine_delete_all_api($user_type,$user_altercode,$salesman_id);
			$items = $result["items"];
		}
		
		$response = array(
			'success' => "1",
			'message' => 'Data delete successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function medicine_delete_api(){

		$user_type 		= $this->user_type;
		$user_altercode = $this->user_altercode;
		$chemist_id 	= $this->chemist_id;
		$salesman_id 	= $this->salesman_id;

		$item_code 		= $_POST['item_code'];
		if(!empty($user_type) && !empty($user_altercode)){
			$result = $this->MyCartModel->medicine_delete_api($user_type,$user_altercode,$salesman_id,$item_code);
			$items = $result["items"];
		}
		$response = array(
			'success' => "1",
			'message' => 'Data delete successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function place_order_api()
	{
		$user_type 		= $this->user_type;
		$user_altercode = $this->user_altercode;
		$user_password 	= $this->user_password;
		$chemist_id 	= $this->chemist_id;
		$salesman_id 	= $this->salesman_id;

		$items = "";
		$remarks 		= $_REQUEST["remarks"];

		$result = $this->MyCartModel->place_order_api($user_type,$user_altercode,$user_password,$salesman_id,"pc_mobile",$remarks);
		$status = $result["status"];
		$status_message = $result["status_message"];

		$jsonArray = array();
		$dt = array(
			'status'=>$status,
			'status_message'=>$status_message,
		);
		$jsonArray[] = $dt;
		$items = $jsonArray;

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}
}
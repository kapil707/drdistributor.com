<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_cart extends CI_Controller {

	var $UserId 		= "";
	var $UserType 		= "";
	var $UserFullName 	= "";
	var $UserPassword 	= "";
	var $UserImage 		= "";
	var $ChemistNrx 	= "";
	var $ChemistId 		= "";
	var $SalesmanId 	= "";
	
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
		$this->UserId		= $this->session->userdata('UserId');
		$this->UserType    	= $this->session->userdata('UserType');
		$this->UserFullName = $this->session->userdata('UserFullName');
		$this->UserPassword	= $this->session->userdata('UserPassword');
		$this->UserImage 	= $this->session->userdata('UserImage');
		$this->ChemistNrx	= $this->session->userdata('ChemistNrx');
		$this->ChemistId	= $this->session->userdata('ChemistId');
		$this->SalesmanId	= $this->session->userdata('SalesmanId');
		/********************************************************** */
	}

	public function index(){

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "My order";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */

		/********************PageMainData************************** */
		$data["UserId"] 	 = $this->UserId;
		$data["UserType"]    = $this->UserType;
		$data["UserFullName"]= $this->UserFullName;
		$data["UserImage"] 	 = $this->UserImage;
		$data["ChemistId"]	 = $this->ChemistId;

		/******************DeliveringToData************************* */
		$data["DeliveringTo"]= $data["ChemistId"];
		if($this->UserType=="sales")
		{
			$data["DeliveringTo"] = $data["ChemistId"]." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}
		/********************************************************** */
		
		$this->load->view('header_footer/header', $data);
		$this->load->view('my_cart/my_cart', $data);
		$this->load->view('header_footer/medicine_details_model', $data);
	}

	/*******************api start*********************/
	public function my_cart_total_api(){

		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;
		$UserPassword 	= $this->UserPassword;
		
		$items = "";
		if(!empty($UserType) && !empty($ChemistId))	{

			$result = $this->MyCartModel->my_cart_total_api($UserType,$ChemistId,$UserPassword,$SalesmanId);
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
	public function my_cart_api() {
		
		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;
		$UserPassword 	= $this->UserPassword;
		
		$order_type = $_POST["order_type"];
		$items = $items_other = "";
		if(!empty($UserType) && !empty($ChemistId) && !empty($order_type))	{

			$result = $this->MyCartModel->my_cart_api($UserType,$ChemistId,$UserPassword,$SalesmanId,$order_type);

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

	public function medicine_add_to_cart_api() {

		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;

		$item_code				= $_REQUEST["item_code"];
		$item_order_quantity	= $_REQUEST["item_order_quantity"];
		$order_type 	= "pc_mobile";
		$mobilenumber 	= "";
		$modalnumber 	= "PC / Laptop";
		$device_id 		= "";
		
		$status = $status_message = "";
		if(!empty($UserType) && !empty($ChemistId)){

			$excel_number = "";
			$result = $this->MyCartModel->medicine_add_to_cart_api($UserType,$ChemistId,$SalesmanId,$order_type,$item_code,$item_order_quantity,$mobilenumber,$modalnumber,$device_id,$excel_number);
			
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

	public function medicine_delete_all_api() {

		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;

		if(!empty($UserType) && !empty($ChemistId)){

			$result = $this->MyCartModel->medicine_delete_all_api($UserType,$ChemistId,$SalesmanId);

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

	public function medicine_delete_api() {

		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;

		$item_code 		= $_POST['item_code'];
		if(!empty($UserType) && !empty($ChemistId)) {
			
			$result = $this->MyCartModel->medicine_delete_api($UserType,$ChemistId,$SalesmanId,$item_code);

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

	public function place_order_api() {
		
		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;
		$UserPassword 	= $this->UserPassword;

		$items = "";
		$remarks 		= $_REQUEST["remarks"];
		if(!empty($UserType) && !empty($ChemistId)) {
			$result = $this->MyCartModel->place_order_api($UserType,$ChemistId,$UserPassword,$SalesmanId,"pc_mobile",$remarks);
			$status = $result["status"];
			$status_message = $result["status_message"];

			$jsonArray = array();
			$dt = array(
				'status'=>$status,
				'status_message'=>$status_message,
			);
			$jsonArray[] = $dt;
			$items = $jsonArray;
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
}
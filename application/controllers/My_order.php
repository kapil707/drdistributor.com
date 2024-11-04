<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_order extends CI_Controller {

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

		/************log file***************** */
		CreateUserLog();
		/************************************* */
	
		// Load model
		$this->load->model("model-drdistributor/my_order/MyOrderModel");

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

		/************login check************** */
		LoginCheck("my_order");
		/************************************* */

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "My Order";
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
		$this->load->view('my_order/my_order', $data);
		$this->load->view('header_footer/footer', $data);
	}

	public function my_order_details($item_id=""){

		/************login check************** */
		LoginCheck("my_order");
		/************************************* */

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "My order details";
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
		$data["item_id"] = $item_id;

		$this->load->view('header_footer/header', $data);		
		$this->load->view('my_order/my_order_details', $data);
		$this->load->view('header_footer/footer', $data);
		$this->load->view('header_footer/medicine_details_model', $data);
	}

	/*******************api start*********************/
	public function my_order_api(){

		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;

		$get_record	 	= $_REQUEST["get_record"];
		$items = "";
		if(!empty($UserType) && !empty($ChemistId)) {
			$result = $this->MyOrderModel->get_my_order_api($UserType,$ChemistId,$SalesmanId,$get_record);
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
	
	public function my_order_details_api(){

		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;

		$item_id		= $_REQUEST['item_id'];
		$items = $download_url = $title = "";
		if(!empty($UserType) && !empty($ChemistId) && !empty($item_id)){

			$result = $this->MyOrderModel->get_my_order_details_api($UserType,$ChemistId,$SalesmanId,$item_id);

			$title  = $result["title"];
			$items  = $result["items"];
			$download_url  = $result["download_url"];
		}	
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'title' => $title,
			'items' => $items,
			'download_url' => $download_url,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function my_order_details_main_api(){
		
		$ItemId			= $_REQUEST['ItemId'];
		$OrderChemistId = $_REQUEST['OrderChemistId'];
		$UserType 		= "chemist";
		$SalesmanId 	= "";
		
		$items = $download_url = $title = "";
		if(!empty($UserType) && !empty($OrderChemistId) && !empty($ItemId)){

			$result = $this->MyOrderModel->get_my_order_details_api($UserType,$OrderChemistId,$SalesmanId,$ItemId);
			$title  = $result["title"];
			$items  = $result["items"];
			$download_url  = $result["download_url"];
		}	
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'title' => $title,
			'items' => $items,
			'download_url' => $download_url,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
}
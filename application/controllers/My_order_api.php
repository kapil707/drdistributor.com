<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_order_api extends CI_Controller {

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
		$this->FirebaseToken= $this->session->userdata('FirebaseToken');
		$this->UserCart		= $this->session->userdata('UserCart');
		/********************************************************** */
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

		$ItemId			= $_REQUEST['item_id'];
		$items = $download_url = $title = "";
		if(!empty($UserType) && !empty($ChemistId) && !empty($ItemId)){

			$result = $this->MyOrderModel->get_my_order_details_api($UserType,$ChemistId,$SalesmanId,$ItemId);

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
		
		$ItemId			= $_REQUEST['item_id'];
		$ChemistId 		= $_REQUEST['order_chemist_id'];
		$UserType 		= "chemist";
		$SalesmanId 	= "";
		
		$items = $download_url = $title = "";
		if(!empty($UserType) && !empty($ChemistId) && !empty($ItemId)){
			$result = $this->MyOrderModel->get_my_order_details_api($UserType,$ChemistId,$SalesmanId,$ItemId);
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
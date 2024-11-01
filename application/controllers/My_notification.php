<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_notification extends CI_Controller {

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
		LoginCheck("my_notification");
		/************************************* */

		/************log file***************** */
		CreateUserLog();
		/************************************* */
	
		// Load model
		$this->load->model("model-drdistributor/my_notification/MyNotificationModel");

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
		$data["MainPageTitle"] = $MainPageTitle = "My notification";
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
		$this->load->view('my_notification/my_notification', $data);
		$this->load->view('header_footer/footer', $data);
	}

	public function my_notification_details($item_id=""){
		
		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "My notification details";
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
		$this->load->view('my_notification/my_notification_details', $data);
		$this->load->view('header_footer/footer', $data);
	}

	/*******************api start*********************/
	public function my_notification_api(){

		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;

		$get_record	 	= $_REQUEST["get_record"];
		$items = "";
		if(!empty($UserType) && !empty($ChemistId)) {

			$result = $this->MyNotificationModel->get_my_notification_api($UserType,$ChemistId,$SalesmanId,$get_record);

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

	public function my_notification_details_api(){

		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;

		$item_id		= $_REQUEST['item_id'];
		$items = "";
		if(!empty($UserType) && !empty($ChemistId) && !empty($item_id)){
			
			$result = $this->MyNotificationModel->get_my_notification_details_api($UserType,$ChemistId,$SalesmanId,$item_id);

			$title  = $result["title"];
			$items  = $result["items"];
		}	
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'title' => $title,
			'items' => $items,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
}
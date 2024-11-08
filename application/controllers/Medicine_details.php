<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Medicine_details extends CI_Controller {

	var $UserId 		= "";
	var $UserType 		= "";
	var $UserFullName 	= "";
	var $UserPassword 	= "";
	var $UserImage 		= "";
	var $ChemistNrx 	= "";
	var $ChemistId 		= "";
	var $SalesmanId 	= "";
	var $FirebaseToken  = "";
	
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');
		$this->load->library('session');
		
		/************login check************** */	
		//LoginCheck();
		/************************************* */

		/************log file***************** */
		CreateUserLog();
		/************************************* */
	
		// Load model
		$this->load->model("model-drdistributor/medicine_details/MedicineDetailsModel");
		$this->load->model("model-drdistributor/medicine_favourite/MedicineFavouriteModel");

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
		/********************************************************** */
	}

	public function index($item_code="") {
		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Medicine Details";
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

		$data['item_code'] = $item_code;
		
		$this->load->view('header_footer/header', $data);
		$this->load->view('medicine_details/medicine_details', $data);
		$this->load->view('header_footer/footer', $data);
	}
	
	/*******************api start*********************/
	public function medicine_details_api() {

		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;

		$item_code		= $_REQUEST["item_code"];
		
		$items = "";
		/********************************************************** */
		if(!empty($UserType) && !empty($ChemistId) && !empty($item_code)) {
			$result = $this->MedicineDetailsModel->medicine_details_api($UserType,$ChemistId,$SalesmanId,$item_code);
			$items = $result["items"];
		} elseif(!empty($item_code)) {			
			$result = $this->MedicineDetailsModel->medicine_details_api("","","",$item_code);
			$items = $result["items"];
		}

		/******************CreateSearcLog********************* */
		$search_term = "";
		$product_viewed = $item_code;
		CreateSearcLog($search_term, $product_viewed); 
		/***************************************************** */
        
        $response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

    public function medicine_favourite_api(){

		$ChemistId = $this->ChemistId;

		$items = "";
		if(!empty($ChemistId)){
	        $items = $this->MedicineFavouriteModel->get_medicine_favourite_api($ChemistId);
		}
        $response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
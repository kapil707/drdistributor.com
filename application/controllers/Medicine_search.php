<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Medicine_search extends CI_Controller {

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
		LoginCheck("medicine_search");
		/************************************* */

		/************log file***************** */
		CreateUserLog();
		/************************************* */

		// Load model
		$this->load->model("model-drdistributor/medicine_search/MedicineSearchModel");

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
		$data["MainPageTitle"] = $MainPageTitle = "Search medicines";
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
		$this->load->view('medicine_search/medicine_search', $data);
	}

	/*******************api start*********************/
	public function medicine_search_api()
	{
		$ChemistNrx  		= $this->ChemistNrx;

		$keyword   			= $_REQUEST['keyword'];
		$total_rec   		= $_REQUEST['total_rec'];
		$checkbox_medicine 	= $_REQUEST['checkbox_medicine_val'];
		$checkbox_company	= $_REQUEST['checkbox_company_val'];
		$checkbox_out_of_stock= $_REQUEST['checkbox_out_of_stock_val'];

		/******************CreateSearcLog********************* */
		$search_term = $keyword;
		$product_viewed = "";
		CreateSearcLog($search_term, $product_viewed); 
		/***************************************************** */

		$items = "";
		if(!empty($keyword)){
			$items = $this->MedicineSearchModel->medicine_search_api($keyword,$ChemistNrx,$total_rec,$checkbox_medicine,$checkbox_company,$checkbox_out_of_stock);
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
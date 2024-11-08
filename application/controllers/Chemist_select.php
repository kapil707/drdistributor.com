<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class chemist_select extends CI_Controller {

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
		
		$this->load->model("model-drdistributor/chemist_select/ChemistSelectModel");

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
    
    public function index(){

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Chemist select";
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

		$this->load->view('header_footer/header', $data);
		$this->load->view('chemist_select/chemist_select', $data);
	}

	/*******************api start*********************/
	public function chemist_search_api() {

		$UserType 		= $this->UserType;

		$items = "";
		$keyword 		= $_REQUEST["keyword"];
		if(!empty($UserType) && !empty($keyword)) {
			$result = $this->ChemistSelectModel->chemist_search_api($keyword);
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

	public function chemist_session_add($ChemistId="",$ChemistNrx="")
	{
		$UserType 		= $this->UserType;
		if(!empty($UserType))
		{
			if($UserType=="sales") {
				$this->session->set_userdata('ChemistId',$ChemistId);
				$this->session->set_userdata('ChemistNrx',$ChemistNrx);
				redirect(base_url()."home");
			}
		}	
	}
	public function salesman_my_cart_api(){
		
		$UserType 		= $this->UserType;
		$UserId 		= $this->UserId;

		$items = "";
		if(!empty($UserType) && !empty($UserId)) {
			$result = $this->ChemistSelectModel->salesman_my_cart_api($UserType,$UserId);
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
}
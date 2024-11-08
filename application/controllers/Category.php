<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller {

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
		
		/************login check************** */	
		//LoginCheck();
		/************************************* */

		/************log file***************** */
		CreateUserLog();
		/************************************* */

		// Load model
		$this->load->model("model-drdistributor/medicine_category/MedicineCategoryModel");
		$this->load->model("model-drdistributor/medicine_division/MedicineDivisionModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineItemModel");

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

	public function index($item_company=""){

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "DRD";
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

		$item_company = str_replace("-"," ",strtolower($item_company));
		
		$row = $this->db->query("select code from tbl_medicine_menu where menu='$item_company'")->row();
		$item_code = $row->code;
		
		$data["item_page_type"] = "medicine_category";
		$data["item_code"] 		= $item_code;
		$data["item_division"] 	= "";

		$data["company_full_name"] = "Dr";

		$this->load->view('header_footer/header', $data);		
		$this->load->view('medicine_category/medicine_category', $data);
	}
	
	public function featured_brand($CategoryName="",$item_division=""){

		$CategoryName = str_replace("-", " ", $CategoryName);
		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = $CategoryName;
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

		$item_code = $this->MedicineDivisionModel->get_division_category_name_id($CategoryName);

		$item_page_type="featured_brand";
		$data["item_page_type"] = $item_page_type;
		$data["item_code"] 		= $item_code;
		$data["item_division"] 	= $item_division;

		$data["company_full_name"] = "Dr";

		$this->load->view('header_footer/header', $data);		
		$this->load->view('medicine_category/medicine_category', $data);
	}
	
	public function itemcategory($CategoryName=""){

		$CategoryName = str_replace("-", " ", $CategoryName);
		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = $CategoryName;
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

		$item_code = $this->MedicineItemModel->get_item_category_name_id($CategoryName);

		$item_page_type="itemcategory";
		$item_division = "";
		$data["item_page_type"] = $item_page_type;
		$data["item_code"] 		= $item_code;
		$data["item_division"] 	= $item_division;

		$data["company_full_name"] = "Dr";

		$this->load->view('header_footer/header', $data);		
		$this->load->view('medicine_category/medicine_category', $data);
	}

	public function medicine_category_api(){

		/******************************************/
		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId		= $this->SalesmanId;
		$ChemistNrx		= $this->ChemistNrx;

		$SessionValue = "no";
		if(!empty($UserType)){
			$SessionValue = "yes";
		}

		$item_page_type	= $_POST["item_page_type"];
		$item_code		= $_POST['item_code'];
		$item_division	= $_POST['item_division'];
		$get_record		= $_POST['get_record'];
		if(!empty($item_page_type))
		{
			if($item_page_type=="medicine_category")
			{
				/*****************************/
				$show_out_of_stock="1";
				$limit="12";
				$order_by_type="id";
				/*****************************/

				$result = $this->MedicineCategoryModel->medicine_category_api($SessionValue,$ChemistNrx,$item_code,$show_out_of_stock,$get_record,$limit,$order_by_type);
				$items  = $result["items"];
				$title  = $result["title"];
				$get_record  = $result["get_record"];
			}

			if($item_page_type=="featured_brand")
			{
				/*****************************/
				$show_out_of_stock="1";
				$limit="12";
				$order_by_type="id";
				/*****************************/

				$result = $this->MedicineCategoryModel->featured_brand_api($SessionValue,$ChemistNrx,$item_code,$item_division,$show_out_of_stock,$get_record,$limit,$order_by_type);
				$items  = $result["items"];
				$title  = $result["title"];
				$get_record  = $result["get_record"];
			}

			if($item_page_type=="itemcategory")
			{
				/*****************************/
				$show_out_of_stock="1";
				$limit="12";
				$order_by_type="id";
				/*****************************/

				$CategoryId = $item_code;
				$result = $this->MedicineItemModel->medicine_item($SessionValue,$CategoryId,$UserType,$ChemistId,$SalesmanId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type);
				$items = $result["items"];
				$title  = $result["title"];
				$get_record  = $result["get_record"];
			}
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
            'title' => $title,
			'get_record' => $get_record,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
}
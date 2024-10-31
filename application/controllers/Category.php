<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller {

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
		
		/************login check************** */	
		LoginCheck();
		/************************************* */

		/************log file***************** */
		CreateUserLog();
		/************************************* */

		// Load model
		$this->load->model("model-drdistributor/medicine_category/MedicineCategoryModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineItemModel");

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

	public function index($item_company=""){

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "DRD";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */

		/********************PageMainData************************** */
		$data["session_user_type"] 		= $this->user_type;
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
	
	public function featured_brand($item_code="",$item_division=""){

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "DRD";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */
		
		/********************PageMainData************************** */
		$data["session_user_type"] 		= $this->user_type;
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

		$item_page_type="featured_brand";
		$data["item_page_type"] = $item_page_type;
		$data["item_code"] 		= $item_code;
		$data["item_division"] 	= $item_division;

		$data["company_full_name"] = "Dr";

		$this->load->view('header_footer/header', $data);		
		$this->load->view('medicine_category/medicine_category', $data);
	}
	
	public function itemcategory($item_code=""){

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "DRD";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */

		/********************PageMainData************************** */
		$data["session_user_type"] 		= $this->user_type;
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
		$user_type 		= $this->user_type;
		$user_altercode = $this->user_altercode;
		$user_password	= $this->user_password;
		$user_nrx		= $this->user_nrx;

		$session_yes_no = "no";
		if(!empty($user_altercode)){
			$session_yes_no = "yes";
		}

		$item_page_type	= $_POST["item_page_type"];
		$item_code		= $_POST['item_code'];
		$item_division	= $_POST['item_division'];
		$get_record		= $_POST['get_record'];
		if($item_page_type!="")
		{
			if($item_page_type=="medicine_category")
			{
				$result = $this->MedicineCategoryModel->medicine_category_api($session_yes_no,$user_nrx,$item_code,$get_record);
				$items  = $result["items"];
				$title  = $result["title"];
				$get_record  = $result["get_record"];
			}

			if($item_page_type=="featured_brand")
			{
				$result = $this->MedicineCategoryModel->featured_brand_api($session_yes_no,$user_nrx,$item_code,$item_division,$get_record);
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

				$category_id = $item_code;
				$result = $this->MedicineItemModel->medicine_item($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id,$user_nrx,$show_out_of_stock,$get_record,$limit,$order_by_type);
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
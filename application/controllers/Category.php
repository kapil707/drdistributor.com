<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// Load model
		$this->load->model("model-drdistributor/account_model/AccountModel");
        $this->AccountModel->login_check();

		$this->load->model("model-drdistributor/medicine_category/MedicineCategoryModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineItemModel");
		$this->load->model("model-drdistributor/activity_model/ActivityModel");
	}

	public function index($item_company=""){
		
		$data["main_page_title"] = "Dr";

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["session_delivering_to"]  = $_COOKIE['user_altercode'];		
		
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$data["chemist_id"] = $chemist_id;
		if($user_type=="sales")
		{
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_item_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}

		/********************************************************** */
		$page_name = "medicine_category";
		$browser_type = "Web";
		$browser = "";

		$this->ActivityModel->activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
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

		$data["main_page_title"] = "Dr";
		
		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["session_delivering_to"]  = $_COOKIE['user_altercode'];		
		
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$data["chemist_id"] = $chemist_id;
		if($user_type=="sales")
		{
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_item_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}
		
		/********************************************************** */
		$page_name = "medicine_category";
		$browser_type = "Web";
		$browser = "";

		$this->ActivityModel->activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
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

		$data["main_page_title"] = "Dr";

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["session_delivering_to"]  = $_COOKIE['user_altercode'];		
		
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$data["chemist_id"] = $chemist_id;
		if($user_type=="sales")
		{
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_item_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}

		/********************************************************** */
		$page_name = "medicine_category";
		$browser_type = "Web";
		$browser = "";

		$this->ActivityModel->activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
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
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];
		$user_nrx		= $_COOKIE["user_nrx"];
		$chemist_id 	= $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
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
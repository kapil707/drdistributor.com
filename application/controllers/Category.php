<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// Load model
		$this->load->model("model-drdistributor/chemist_login/ChemistLoginModel");
        $this->ChemistLoginModel->login_check();

		$this->load->model("model-drdistributor/medicine_category/MedicineCategoryModel");
	}

	public function index($item_company=""){
		
		$data["main_page_title"] = "Dr";
		$item_company = str_replace("-"," ",strtolower($item_company));
		
		$row = $this->db->query("select code from tbl_medicine_menu where menu='$item_company'")->row();
		$item_code = $row->code;
		
		$data["item_page_type"] = "medicine_category";
		$data["item_code"] 		= $item_code;
		$data["item_division"] 	= "";

		$data["company_full_name"] = "Dr";

		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id 	= "";
		$salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];

		/********************************************************** */
		$page_name = "medicine_category";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */

		$this->load->view('home/header_footer/header', $data);		
		$this->load->view('home/category/medicine_category', $data);
	}
	
	public function featured_brand($item_code="",$item_division=""){
		$item_page_type="featured_brand";
		////error_reporting(0);
		//$this->login_check();
		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["chemist_id"] 			= "";
		
		$data["main_page_title"] = "Dr";
		if(empty($_COOKIE['user_session'])){
			//redirect(base_url()."home");			
		}
		$data["item_page_type"] = $item_page_type;
		$data["item_code"] 		= $item_code;
		$data["item_division"] 	= $item_division;

		$data["company_full_name"] = "Dr";

		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id 	= "";
		$salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}

		/********************************************************** */
		$page_name = "medicine_category";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */

		$this->load->view('home/header_footer/header', $data);		
		$this->load->view('home/category/medicine_category', $data);
	}
	
	public function medicine_item_wise($item_code="",$item_division=""){
		$item_page_type="medicine_item_wise";
		////error_reporting(0);
		//$this->login_check();
		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["chemist_id"] 			= $_COOKIE['user_altercode'];
		
		$data["main_page_title"] = "Dr";
		if(empty($_COOKIE['user_session'])){
			//redirect(base_url()."home");			
		}
		$data["item_page_type"] = $item_page_type;
		$data["item_code"] 		= $item_code;
		$data["item_division"] 	= $item_division;

		$data["company_full_name"] = "Dr";

		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id 	= $_COOKIE["chemist_id"];
		$salesman_id = "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}

		/********************************************************** */
		$page_name = "medicine_category";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */

		$this->load->view('home/header', $data);		
		$this->load->view('home/category/medicine_category', $data);
	}

	public function medicine_category_api(){

		/******************************************/
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];
		$chemist_id 	= "";
		$salesman_id = "";
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
				$result = $this->MedicineCategoryModel->medicine_category_api($session_yes_no,$item_code,$get_record);
				$items  = $result["items"];
				$title  = $result["title"];
				$get_record  = $result["get_record"];
			}

			if($item_page_type=="featured_brand")
			{
				$result = $this->MedicineCategoryModel->featured_brand_api($session_yes_no,$item_code,$item_division,$get_record);
				$items  = $result["items"];
				$title  = $result["title"];
				$get_record  = $result["get_record"];
			}

			if($item_page_type=="medicine_similar")
			{
				$items = $this->Chemist_Model->medicine_similar_api($item_code,$get_record);
			}	

			if($item_page_type=="medicine_item_wise")
			{
				$category_id = $item_code;
				$result = $this->Chemist_Model->medicine_item_wise_json_50($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id);
				$items  = $result["items"];
				$title  = $result["title"];
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

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
		$this->load->library('session');

		/************log file***************** */
		CreateUserLog();
		/************************************* */

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
	
	public function index(){
		
		/************login check************** */	
		LoginCheck();
		/************************************* */

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Home";
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
		
		$this->load->view('header_footer/header', $data);		
		$this->load->view('home_page/home_page', $data);
		$this->load->view('header_footer/footer', $data);
	}

	public function test(){	
		$this->load->view('test/test');
	}

	/*******************api start*********************/
	public function get_top_menu_api(){
		$this->load->model("model-drdistributor/top_menu/TopMenuModel");

		$result = $this->TopMenuModel->get_top_menu_api();
		$items = $result["items"];

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response); 
	}

	public function home_page_main_api(){
		$this->load->model("model-drdistributor/slider_model/SliderModel");
		$this->load->model("model-drdistributor/medicine_division/MedicineDivisionModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineItemModel");

		$this->load->model("model-drdistributor/home_menu/HomeMenuModel");
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");
		$this->load->model("model-drdistributor/my_notification/MyNotificationModel");

		$myitems = array();

		$get_record	 	= "0";//$_REQUEST["get_record"];
		$user_type = $user_altercode = $user_password	= $chemist_id = $salesman_id = "";
		$user_nrx = "no";

		if(!empty($this->user_type)){
			$user_type 		= $this->user_type;
			$user_altercode = $this->user_altercode;
			$user_password	= $this->user_password;
			$user_nrx		= $this->user_nrx;
			$chemist_id 	= $this->chemist_id;
			$salesman_id 	= $this->salesman_id;
		}

		$seq_id = $_POST["seq_id"];
		
		$items = $title = $category_id = $page_type = $next_id = "";
		$tbl_home = $this->db->query("select * from tbl_home where status=1 and seq_id in ($seq_id) ")->result();
		foreach($tbl_home as $row){
			$category_id = $row->category_id;
			
			if($row->type=="slider"){
			    $result = $this->SliderModel->slider($row->category_id);
		        $items = $result["items"];
				$title  = 'slider';
			}
			
			// if($row->type=="menu"){
			// 	$result = $this->HomeMenuModel->get_menu_api();
		    //     $items = $result["items"];
			// 	$title  = 'menu';				
			// }

			if(!empty($user_type) && !empty($user_altercode) && $row->type=="notification") {

				$result = $this->MyNotificationModel->get_my_notification_api($user_type,$user_altercode,$salesman_id,"0","3");
				$items    = $result["items"];
				$title  = 'notification';
			}

			if(!empty($user_type) && !empty($user_altercode) && $row->type=="invoice") {

				$result = $this->MyInvoiceModel->get_my_invoice_api($user_type,$user_altercode,$salesman_id,"0","3");
				$items    = $result["items"];
				$title  = 'invoice';
			}
			
			if($row->type=="divisioncategory"){
			    $result = $this->MedicineDivisionModel->medicine_division($category_id);
				
				$title  = $result["title"];
		        $items = $result["items"];
			}
			
			if($row->type=="itemcategory"){
				$result = $this->MedicineItemModel->medicine_item($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id,$user_nrx);
				$title  = $result["title"];
				$items = $result["items"];
			}

			$page_type = $row->type;

			$next_id = $row->seq_id + 1;

			if($next_id<=5){
				$next_id = 6;
			}
			$dt = array(
				'title' => $title,
				'category_id' => $category_id,
				'page_type' => $page_type,
				'next_id' => $next_id,
				'items' => $items,
			);
			$myitems[] = $dt;
		}		

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $myitems,
		);
		
		/****************************************************** */
		//$response = '{"get_result":['.$response.']}'; 
	
		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response); 
	}

	public function theme_set_api()
	{
		$items = "";
		$theme_set_css 	= $_POST["theme_set_css"];
		$theme_type 	= $theme_set_css;
		setcookie("theme_type", $theme_type, time() + (86400 * 30), "/");

		$jsonArray = array();
		$dt = array(
			'status'=>1,
		);
		$jsonArray[] = $dt;
		$items = $jsonArray;

		$response = array(
			'success' => "1",
			'message' => 'Data save successfully',
			'items' => $items,
		);

		header('Content-Type: application/json');
		echo json_encode($response); 
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');
		$this->load->library('session');
		
		/***********************log file start*************************** */
		if(!empty($this->session->userdata('user_altercode'))){
			$user_type 		= $this->session->userdata('user_type');
			$user_altercode = $this->session->userdata('user_altercode');

			$chemist_id = $salesman_id = "";
			if($user_type=="sales" && !empty($this->session->userdata('chemist_id')))
			{
				$chemist_id 	= $this->session->userdata('chemist_id');
				$salesman_id 	= $user_altercode;
				$user_altercode = $chemist_id;
			}
			//logs create from hear
			log_activity($user_altercode,$salesman_id,$user_type,"web");
		}
		/***********************log file end*************************** */
	}
	
	public function index(){	
		$this->load->model("model-drdistributor/account_model/AccountModel");
        $this->AccountModel->login_check();

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Home";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */
		
		/********************session***************************** */
		$data["session_user_image"] 	= $this->session->userdata('user_image');
		$data["session_user_fname"]     = $this->session->userdata('user_fname');
		$data["session_user_altercode"] = $this->session->userdata('user_altercode');
		$data["session_delivering_to"]  = $this->session->userdata('user_altercode');	
		
		$user_type 		= $this->session->userdata('user_type');
		$user_altercode = $this->session->userdata('user_altercode');
		$user_password	= $this->session->userdata('user_password');

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $this->session->userdata('chemist_id');
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		/********************************************************** */
		$data["chemist_id"] = $chemist_id;
		if($user_type=="sales")
		{
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}
		
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
		$user_type 		= $user_altercode = $user_password	= $chemist_id = $salesman_id = "";
		$user_nrx = "no";
		if(!empty($_COOKIE["user_type"])){
			$user_type 		= $_COOKIE["user_type"];
			$user_altercode = $_COOKIE["user_altercode"];
			$user_password	= $_COOKIE["user_password"];
			$user_nrx		= $_COOKIE["user_nrx"];
			$chemist_id 	= "";
			$salesman_id = "";
		}

		$session_yes_no = "no";
		if(!empty($user_altercode)){
			$session_yes_no = "yes";
			if($user_type=="sales") {
				$chemist_id 	= $_COOKIE["chemist_id"];
				$salesman_id 	= $user_altercode;
				$user_altercode = $chemist_id;
			}
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
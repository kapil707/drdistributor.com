<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_api extends CI_Controller {

	var $UserId 		= "";
	var $UserType 		= "";
	var $UserFullName 	= "";
	var $UserPassword 	= "";
	var $UserImage 		= "";
	var $ChemistNrx 	= "";
	var $ChemistId 		= "";
	var $SalesmanId 	= "";
	var $FirebaseToken  = "";
	var $UserCart  		= "";

	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');
		$this->load->library('session');

		/************log file***************** */
		CreateUserLog();
		/************************************* */

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
		$this->UserCart		= $this->session->userdata('UserCart');
		/********************************************************** */
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
		$UserType = $ChemistId = $SalesmanId = $UserPassword = "";
		$ChemistNrx = $SessionValue = "no";
		if(!empty($this->UserType)){
			$UserType 		= $this->UserType;
			$ChemistId 		= $this->ChemistId;
			$SalesmanId 	= $this->SalesmanId;
			$UserPassword	= $this->UserPassword;
			$ChemistNrx		= $this->ChemistNrx;
			$SessionValue 	= "yes";
		}

		$seq_id = $_POST["seq_id"];
		
		$items = $title = $CategoryId = $page_type = $next_id = "";
		$query = $this->db->query("select * from tbl_home where status=1 and seq_id in ($seq_id) ")->result();
		foreach($query as $row){
			$CategoryId = $row->category_id;
			$type 		= $row->type;
			
			if($row->type=="slider"){
			    $result = $this->SliderModel->slider($CategoryId);
		        $items = $result["items"];
				$title  = 'slider';
			}
			
			// if($row->type=="menu"){
			// 	$result = $this->HomeMenuModel->get_menu_api();
		    //     $items = $result["items"];
			// 	$title  = 'menu';				
			// }

			if(!empty($UserType) && !empty($ChemistId) && $type=="notification") {
				$result = $this->MyNotificationModel->get_my_notification_api($UserType,$ChemistId,$SalesmanId,"0","3");
				$items    = $result["items"];
				$title  = 'notification';
			}

			if(!empty($UserType) && !empty($ChemistId) && $type=="invoice") {
				$result = $this->MyInvoiceModel->get_my_invoice_api($UserType,$ChemistId,$SalesmanId,"0","3");
				$items    = $result["items"];
				$title  = 'invoice';
			}
			
			if($type=="divisioncategory"){
			    $result = $this->MedicineDivisionModel->medicine_division($CategoryId);
				
				$title  = $result["title"];
		        $items = $result["items"];
			}
			
			if($type=="itemcategory"){
				$result = $this->MedicineItemModel->medicine_item($SessionValue,$CategoryId,$UserType,$ChemistId,$SalesmanId,$ChemistNrx);
				$title  = $result["title"];
				$items = $result["items"];
			}

			$page_type = $type;

			$next_id = $row->seq_id + 1;

			if($next_id<=5){
				$next_id = 6;
			}
			$dt = array(
				'title' => $title,
				'CategoryId' => $CategoryId,
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
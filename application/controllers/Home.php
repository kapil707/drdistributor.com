<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// Load model
		//$this->load->model("LoginModel");
		//$this->load->model("MedicineSearchModel");
		$this->load->model("model-drdistributor/ChemistLoginModel");
        $this->ChemistLoginModel->login_check();

		$this->load->model("model-drdistributor/slider/SliderModel");
		$this->load->model("MenuModel");
		$this->load->model("model-drdistributor/medicine_division/MedicineDivisionModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineItemModel");

		$this->load->model("model-drdistributor/home_menu/HomeMenuModel");
		
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");
		$this->load->model("model-drdistributor/my_order/MyOrderModel");
		$this->load->model("model-drdistributor/my_notification/MyNotificationModel");
		
		$this->load->model("model-drdistributor/medicine_favourite/MedicineFavouriteModel");
		
		$this->load->model("model-drdistributor/my_cart/MyCartModel");
	}
	
	public function index(){	
		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		
		if(!empty($_COOKIE['user_type']))
		{
			$user_type = $_COOKIE['user_type'];
			$chemist_id = "";
			if($user_type=="sales")
			{
				$chemist_id = "";$_COOKIE['chemist_id'];
				$data["session_user_fname"]     = "Code : ".$chemist_id." | <a href='".base_url()."home/select_chemist'> <img src='".base_url()."/img_v51/edit_icon.png' width='12px;' style='margin-top: 2px;margin-bottom: 2px;'></a>";
			}
		}
		
		$data["main_page_title"] = "Home";
		
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
		$page_name = "index";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */

		$tbl_home = $this->db->query("select * from tbl_home where status=1 order by seq_id asc")->result();
		$data["tbl_home"] = $tbl_home;
		
		$this->load->view('home/header_footer/header', $data);		
		$this->load->view('home/home/home', $data);
		$this->load->view('home/header_footer/footer', $data);
	}

	public function home_page_api()
	{
		$get_record	 	= "0";//$_REQUEST["get_record"];
		$user_type 		= $user_altercode = $user_password	= $chemist_id = $salesman_id = "";
		if(!empty($_COOKIE["user_type"])){
			$user_type 		= $_COOKIE["user_type"];
			$user_altercode = $_COOKIE["user_altercode"];
			$user_password	= $_COOKIE["user_password"];
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
		
		/*
		$my_notification = "";
		if($user_type!="" && $user_altercode!="" && $get_record!="")
		{
			$result = $this->Chemist_Model->my_notification_json_50($user_type,$user_altercode,$salesman_id,$get_record);

			$my_notification  = $result["items"];
		}
		$my_notification = '{"my_notification":['.$my_notification.']}';

		/****************************************************** */
		/*
		$my_invoice = "";
		if($user_type!="" && $user_altercode!="" && $get_record!="")
		{
			$result = $this->Chemist_Model->my_invoice_json_50($user_type,$user_altercode,$salesman_id,$get_record);

			$my_invoice  = $result["items"];
		}
		$my_invoice = '{"my_invoice":['.$my_invoice.']}';
		*/
		
		$myid = $nid = $_REQUEST["myid"];
		
		$items = "";
		$tbl_home = $this->db->query("select * from tbl_home where status=1 and id='$nid' order by seq_id asc")->result();
		foreach($tbl_home as $row){
			$category_id = $row->category_id;
			
			$result_row = "[]";
			if($row->type=="slider"){
			    $result = $this->SliderModel->slider($row->category_id);
		        $result_row = $result["items"];
				$result_title  = 'slider';
			}
			
			if($row->type=="menu"){
				$result = $this->HomeMenuModel->get_menu_api();
		        $result_row = $result["items"];
				$result_title  = 'menu';				
			}
			
			if($row->type=="divisioncategory"){
			    $result = $this->MedicineDivisionModel->medicine_division($category_id);
				
				$result_title  = $result["title"];
		        $result_row = $result["items"];
			}
			
			if($row->type=="itemcategory"){
				$result = $this->MedicineItemModel->medicine_item($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id);
				$result_title  = $result["title"];
				$result_row = $result["items"];
			}

			$response = array(
				'success' => "1",
				'message' => 'Data load successfully',
				'result' => $row->type,
				'result_id' => $row->id,
				'result_category_id' => $category_id,
				'result_title' => $result_title,
				'result_row' => $result_row,
				'myid' => $myid,
			);
		}
		
		/****************************************************** */
		//$response = '{"get_result":['.$response.']}'; 
	
		// Send JSON response
		header('Content-Type: application/json');
		echo '{"get_result":['.json_encode($response).']}'; 
	}
}
?>
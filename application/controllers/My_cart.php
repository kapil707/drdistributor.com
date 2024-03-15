<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_cart extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Load model
		$this->load->model("model-drdistributor/account_model/AccountModel");
        $this->AccountModel->login_check("my_cart");

		$this->load->model("model-drdistributor/my_cart/MyCartModel");
	}

	public function index(){
		
		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["chemist_id"] = $_COOKIE['user_altercode'];

		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id 	= "";
		$salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id		= $_COOKIE['chemist_id'];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		if($user_type=="sales")
		{
			$chemist_id		= $_COOKIE['chemist_id'];
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist'> <img src='".base_url()."/img_v51/edit_icon.png' width='12px;' style='margin-top: 2px;margin-bottom: 2px;'> Edit chemist</a>";
		}

		/********************************************************** */
		$page_name = "my_cart";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */
		
		$data["main_page_title"] = "My order";
		$this->load->view('header_footer/header', $data);
		$this->load->view('my_cart/my_cart', $data);
	}

	public function my_cart_api(){
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];
		$chemist_id 	= "";
		$salesman_id = "";
		if($user_type=="sales"){
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$items = $items_other = "";
		if(!empty($user_altercode))
		{
			$result = $this->MyCartModel->my_cart_api($user_type,$user_altercode,$user_password,$salesman_id,"all");
			$items = $result["items"];
			$items_other = $result["items_other"];
			$items_total = $result["items_total"];
			setcookie("user_cart_total", $items_total, time() + (86400 * 30), "/");
		}
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
            'items_other' => $items_other
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function medicine_add_to_cart_api()
	{
		$item_code				= $_REQUEST["item_code"];
		$item_order_quantity	= $_REQUEST["item_order_quantity"];
		$order_type 	= "pc_mobile";
		$mobilenumber 	= "";
		$modalnumber 	= "PC / Laptop";
		$device_id 		= "";
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
		if(!empty($user_type) && !empty($user_altercode)){
			$excel_number = "";		
			$status = $this->MyCartModel->medicine_add_to_cart_api($user_type,$user_altercode,$salesman_id,$order_type,$item_code,$item_order_quantity,$mobilenumber,$modalnumber,$device_id,$excel_number);
			/*****************************************************/
		}

		if(!empty($user_altercode))
		{
			$result = $this->MyCartModel->my_cart_api($user_type,$user_altercode,$user_password,$salesman_id,"all");
			$items = $result["items"];
			$items_other = $result["items_other"];
			$items_total = $result["items_total"];
			setcookie("user_cart_total", $items_total, time() + (86400 * 30), "/");
		}
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
            'items_other' => $items_other
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function medicine_delete_all_api(){
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
		if(!empty($user_type) && !empty($user_altercode)){
			$result = $this->MyCartModel->medicine_delete_all_api($user_type,$user_altercode,$salesman_id);
			$items = $result["items"];
		}
		
		$response = array(
			'success' => "1",
			'message' => 'Data delete successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function medicine_delete_api(){
		$item_code 		= $_POST['item_code'];
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
		if(!empty($user_type) && !empty($user_altercode)){
			$result = $this->MyCartModel->medicine_delete_api($user_type,$user_altercode,$salesman_id,$item_code);
			$items = $result["items"];
		}
		$response = array(
			'success' => "1",
			'message' => 'Data delete successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function place_order_api()
	{
		$items = "";
		$remarks 		= $_REQUEST["remarks"];

		$user_type 		= $_COOKIE['user_type'];
		$user_altercode = $_COOKIE['user_altercode'];
		$user_password	= $_COOKIE['user_password'];
		
		$chemist_id 	= "";
		$salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE['chemist_id'];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}	
		$result = $this->MyCartModel->place_order_api($user_type,$user_altercode,$user_password,$salesman_id,"pc_mobile",$remarks);
		$status = $result["status"];
		$status_message = $result["status_message"];
		if($status=="1"){
			$user_cart_total = 0;
			setcookie("user_cart_total", $user_cart_total, time() + (86400 * 30), "/");
		}

		$jsonArray = array();
		$dt = array(
			'status'=>$status,
			'status_message'=>$status_message,
		);
		$jsonArray[] = $dt;
		$items = $jsonArray;

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
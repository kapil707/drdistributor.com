<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_cart extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Load model
		$this->load->model("model-drdistributor/chemist_login/ChemistLoginModel");
        $this->ChemistLoginModel->login_check();

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
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}

		/********************************************************** */
		$page_name = "my_order";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */
		
		$data["main_page_title"] = "My order";
		$this->load->view('home/header_footer/header', $data);
		$this->load->view('home/my_cart/my_cart', $data);
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
		$items = $other_items = "";
		if(!empty($user_altercode))
		{
			$val = $this->MyCartModel->my_cart_api($user_type,$user_altercode,$user_password,$salesman_id,"all");
			$items = $val[0];
			$other_items = $val[1];
			$user_cart_total = $val[2];
			setcookie("user_cart_total", $user_cart_total, time() + (86400 * 30), "/");
		}
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
            'other_items' => $other_items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
}
?>
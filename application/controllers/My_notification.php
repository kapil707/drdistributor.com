<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_notification extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Load model
		$this->load->model("model-drdistributor/chemist_login/ChemistLoginModel");
        $this->ChemistLoginModel->login_check("my_notification");

		$this->load->model("model-drdistributor/my_notification/MyNotificationModel");
	}

	public function index(){
		
		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["chemist_id"] = $_COOKIE['user_altercode'];
		
		$data["main_page_title"] = "My notification";

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
		$page_name = "my_notification";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */

		$this->load->view('home/header_footer/header', $data);		
		$this->load->view('my_notification/my_notification', $data);
	}

	public function my_notification_api(){
		$get_record	 	= $_REQUEST["get_record"];
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
		$items = "";
		if(!empty($user_type) && !empty($user_altercode)) {

			$result = $this->MyNotificationModel->get_my_notification_api($user_type,$user_altercode,$salesman_id,$get_record);
			$items  	= $result["items"];
			$get_record  = $result["get_record"];
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
            'get_record' => $get_record
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function my_notification_details($item_id=""){

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["chemist_id"] = $_COOKIE['user_altercode'];
		
		$data["main_page_title"] = "My notification details";
		
		$data["item_id"] = $item_id;

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
		$page_name = "my_notification_details";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */

		$this->load->view('home/header_footer/header', $data);		
		$this->load->view('my_notification/my_notification_details', $data);
	}

	
	public function my_notification_details_api(){
		$item_id		= $_REQUEST['item_id'];
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
		$items = "";
		if(!empty($user_type) && !empty($user_altercode) && !empty($item_id)){			
			$result = $this->MyNotificationModel->get_my_notification_details_api($user_type,$user_altercode,$salesman_id,$item_id);
			$title  = $result["title"];
			$items  = $result["items"];
		}	
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'title' => $title,
			'items' => $items,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
}
?>
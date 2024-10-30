<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_notification extends CI_Controller {

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

		/************login check************** */
		LoginCheck("my_notification");
		/************************************* */

		/************log file***************** */
		CreateUserLog();
		/************************************* */
	
		// Load model
		$this->load->model("model-drdistributor/my_notification/MyNotificationModel");

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

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "My notification";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */

		/********************PageMainData************************** */
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
		$this->load->view('my_notification/my_notification', $data);
		$this->load->view('header_footer/footer', $data);
	}

	public function my_notification_details($item_id=""){
		
		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "My notification details";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */

		/********************PageMainData************************** */
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

		$data["item_id"] = $item_id;

		$this->load->view('header_footer/header', $data);		
		$this->load->view('my_notification/my_notification_details', $data);
		$this->load->view('header_footer/footer', $data);
	}

	/*******************api start*********************/
	public function my_notification_api(){

		$user_type 		= $this->user_type;
		$user_altercode = $this->user_altercode;
		$chemist_id 	= $this->chemist_id;
		$salesman_id 	= $this->salesman_id;

		$get_record	 	= $_REQUEST["get_record"];
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

	public function my_notification_details_api(){

		$user_type 		= $this->user_type;
		$user_altercode = $this->user_altercode;
		$chemist_id 	= $this->chemist_id;
		$salesman_id 	= $this->salesman_id;

		$item_id		= $_REQUEST['item_id'];
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
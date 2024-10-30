<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');
		$this->load->library('session');

		$this->load->model("model-drdistributor/account_model/AccountModel");
        $this->AccountModel->login_check("account");

		$this->load->model("model-drdistributor/user_model/UserModel");
		
		/***********************log file start*************************** */
		if(!empty($this->session->userdata('user_altercode'))){
			$user_type 		= $this->session->userdata('user_type');
			$user_altercode = $this->session->userdata('user_altercode');

			$chemist_id = $salesman_id = "";
			if($user_type=="sales")
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
		//error_reporting(0);
		redirect(base_url());
	}
	public function account(){

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Account";
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

		$this->load->view('header_footer/header', $data);
		$this->load->view('user/account', $data);
	}
	public function update_account(){

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Update account";
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
			redirect(base_url());
		}

		$this->load->view('header_footer/header', $data);	
		$this->load->view('user/update_account', $data);
	}

	public function update_image(){

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Update image";
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

		$this->load->view('header_footer/header', $data);
		$this->load->view('user/update_image', $data);
	}
	
	public function update_password(){
		
		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Update password";
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

		$this->load->view('header_footer/header', $data);
		$this->load->view('user/update_password', $data);
	}

	/*******************api start*********************/
	public function get_user_account_api()
	{
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

		if(!empty($user_type) && !empty($user_altercode))
		{
			$return = $this->UserModel->get_user_account_api($user_type,$user_altercode,$salesman_id);
			$items = $return["items"];
		}

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function get_new_user_account_api(){
		//error_reporting(0);
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

		if(!empty($user_type) && !empty($user_altercode))
		{
			$return = $this->UserModel->get_new_user_account_api($user_type,$user_altercode,$salesman_id);
			$items = $return["items"];
		}

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function update_user_account_api(){
		//error_reporting(0);
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

		$user_phone 	= $_POST['user_phone'];
		$user_email 	= $_POST['user_email'];
		$user_address 	= $_POST['user_address'];
		if(!empty($user_type) && !empty($user_altercode))
		{
			$return = $this->UserModel->update_user_account_api($user_type,$user_altercode,$user_phone,$user_email,$user_address);
			$items = $return["items"];
		}

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	public function update_password_api()
	{
		//error_reporting(0);
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
		
		$old_password   = $_POST['old_password'];
		$new_password   = $_POST['new_password'];
		if(!empty($user_type) && !empty($user_altercode) && !empty($old_password) && !empty($new_password))
		{
			$return = $this->UserModel->update_password_api($user_type,$user_altercode,$old_password,$new_password);
			$items = $return["items"];
		}

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function update_user_upload_image_api()
	{
		//error_reporting(0);
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
		if(!empty($user_type) && !empty($user_altercode) && !empty($_FILES))
		{
			$return = $this->UserModel->update_user_upload_image_api($user_type,$user_altercode,$salesman_id,$_FILES);
			$items = $return["items"];
		}

		$response = array(
			'success' => "1",
			'message' => 'Data uploaded successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}
}
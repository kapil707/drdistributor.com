<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

	var $UserId 		= "";
	var $UserType 		= "";
	var $UserFullName 	= "";
	var $UserPassword 	= "";
	var $UserImage 		= "";
	var $ChemistNrx 	= "";
	var $ChemistId 		= "";
	var $SalesmanId 	= "";

	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');
		$this->load->library('session');

		/************login check************** */
		LoginCheck("account");
		/************************************* */

		/************log file***************** */
		CreateUserLog();
		/************************************* */

		// Load model
		$this->load->model("model-drdistributor/user_model/UserModel");

		/********************session start***************************** */
		$this->UserId		= $this->session->userdata('UserId');
		$this->UserType    	= $this->session->userdata('UserType');
		$this->UserFullName = $this->session->userdata('UserFullName');
		$this->UserPassword	= $this->session->userdata('UserPassword');
		$this->UserImage 	= $this->session->userdata('UserImage');
		$this->ChemistNrx	= $this->session->userdata('ChemistNrx');
		$this->ChemistId	= $this->session->userdata('ChemistId');
		$this->SalesmanId	= $this->session->userdata('SalesmanId');
		/********************************************************** */
	}
	public function index(){
		//error_reporting(0);
		redirect(base_url());
	}

	public function account(){

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Account";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */
		
		/********************PageMainData************************** */
		$data["UserId"] 	 = $this->UserId;
		$data["UserType"]    = $this->UserType;
		$data["UserFullName"]= $this->UserFullName;
		$data["UserImage"] 	 = $this->UserImage;
		$data["ChemistId"]	 = $this->ChemistId;

		/******************DeliveringToData************************* */
		$data["DeliveringTo"]= $data["ChemistId"];
		if($this->UserType=="sales")
		{
			$data["DeliveringTo"] = $data["ChemistId"]." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}
		/********************************************************** */

		$this->load->view('header_footer/header', $data);
		$this->load->view('user/account', $data);
	}
	
	public function update_account(){

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Update account";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */
		
		/********************PageMainData************************** */
		$data["UserId"] 	 = $this->UserId;
		$data["UserType"]    = $this->UserType;
		$data["UserFullName"]= $this->UserFullName;
		$data["UserImage"] 	 = $this->UserImage;
		$data["ChemistId"]	 = $this->ChemistId;

		/******************DeliveringToData************************* */
		$data["DeliveringTo"]= $data["ChemistId"];
		if($this->UserType=="sales")
		{
			$data["DeliveringTo"] = $data["ChemistId"]." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}
		/********************************************************** */

		if($this->UserType=="sales") {
			redirect(base_url());
		}

		$this->load->view('header_footer/header', $data);	
		$this->load->view('user/update_account', $data);
	}

	public function update_image(){

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Update image";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */
		
		/********************PageMainData************************** */
		$data["UserId"] 	 = $this->UserId;
		$data["UserType"]    = $this->UserType;
		$data["UserFullName"]= $this->UserFullName;
		$data["UserImage"] 	 = $this->UserImage;
		$data["ChemistId"]	 = $this->ChemistId;

		/******************DeliveringToData************************* */
		$data["DeliveringTo"]= $data["ChemistId"];
		if($this->UserType=="sales")
		{
			$data["DeliveringTo"] = $data["ChemistId"]." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}
		/********************************************************** */

		$this->load->view('header_footer/header', $data);
		$this->load->view('user/update_image', $data);
	}
	
	public function update_password(){
		
		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Update password";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */
		
		/********************PageMainData************************** */
		$data["UserId"] 	 = $this->UserId;
		$data["UserType"]    = $this->UserType;
		$data["UserFullName"]= $this->UserFullName;
		$data["UserImage"] 	 = $this->UserImage;
		$data["ChemistId"]	 = $this->ChemistId;

		/******************DeliveringToData************************* */
		$data["DeliveringTo"]= $data["ChemistId"];
		if($this->UserType=="sales")
		{
			$data["DeliveringTo"] = $data["ChemistId"]." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}
		/********************************************************** */

		$this->load->view('header_footer/header', $data);
		$this->load->view('user/update_password', $data);
	}

	/*******************api start*********************/
	public function get_user_account_api()
	{
		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;

		if(!empty($UserType) && !empty($ChemistId)) {

			$return = $this->UserModel->get_user_account_api($UserType,$ChemistId,$SalesmanId);
			$items = $return["items"];
			// set image only for website
			$this->session->set_userdata('UserImage',$items[0]["user_image"]);
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

		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;

		if(!empty($UserType) && !empty($ChemistId))	{

			$return = $this->UserModel->get_new_user_account_api($UserType,$ChemistId,$SalesmanId);
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
		
		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;

		$user_phone 	= $_POST['user_phone'];
		$user_email 	= $_POST['user_email'];
		$user_address 	= $_POST['user_address'];
		if(!empty($UserType) && !empty($ChemistId)) {

			$return = $this->UserModel->update_user_account_api($UserType,$ChemistId,$user_phone,$user_email,$user_address);
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
		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;
		
		$old_password   = $_POST['old_password'];
		$new_password   = $_POST['new_password'];
		if(!empty($UserType) && !empty($ChemistId) && !empty($old_password) && !empty($new_password))
		{
			$return = $this->UserModel->update_password_api($UserType,$ChemistId,$old_password,$new_password);
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
		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;
		
		$items = "";
		if(!empty($UserType) && !empty($ChemistId) && !empty($_FILES))
		{
			$return = $this->UserModel->update_user_upload_image_api($UserType,$ChemistId,$SalesmanId,$_FILES);
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
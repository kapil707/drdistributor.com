<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_invoice extends CI_Controller {
	
	public function index(){
		////error_reporting(0);
		//$this->login_check();
		//$this->salesman_chemist_ck();
		
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
		$page_name = "my_invoice";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */
		
		$data["main_page_title"] = "My invoice";
		$this->load->view('home/header_footer/header', $data);
		$this->load->view('home/my_invoice/my_invoice',$data);
	}
	public function my_invoice_details($item_id=""){
		////error_reporting(0);
		// $this->login_check();
		// $this->salesman_chemist_ck();

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		//$data["chemist_id"] = $_COOKIE['user_altercode'];;
		
		$data["main_page_title"] = "My invoice details";
		
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
		$page_name = "my_invoice_details";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */
		
		$this->load->view('home/header_footer/header', $data);
		$this->load->view('home/my_invoice/my_invoice_details',$data);
	}
}
?>
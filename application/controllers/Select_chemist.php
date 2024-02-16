<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Select_chemist extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Load model
	}
    
    public function index(){

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		
		$data["main_page_title"] = "Search Chemist";

		if(!empty($_COOKIE["user_type"]))
		{
			$user_type = $_COOKIE['user_type'];
			$chemist_id = "";
			if($user_type=="sales")
			{
				if(!empty($_COOKIE['chemist_id'])){
					$chemist_id = $_COOKIE['chemist_id'];
					$data["session_user_fname"]     = "Code : ".$chemist_id." | <a href='".base_url()."home/select_chemist'> <img src='".base_url()."/img_v51/edit_icon.png' width='12px;' style='margin-top: 2px;margin-bottom: 2px;'></a>";
				}
			}
		}

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
		$page_name = "search_medicine";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */		
		
		$data["chemist_id"] = $chemist_id;
		$data["chemist_id_for_cart_total"] = $chemist_id;
		$this->load->view('home/header_footer/header', $data);
		$this->load->view('home/select_chemist/select_chemist', $data);
	}
}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		//error_reporting(0);
		redirect(base_url());
	}
	public function termsofservice() {
		//error_reporting(0);
		$data = "";
		
		$data["session_user_image"] = base_url()."img_v".constant('site_v')."/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		$data["chemist_id"] = "";
		
		if(!empty($this->session->userdata('user_altercode')))
		{
			$data["session_user_image"] 	= $this->session->userdata('user_image');
			$data["session_user_fname"]     = $this->session->userdata('user_fname');
			$data["session_user_altercode"] = $this->session->userdata('user_altercode');
			$data["chemist_id"] = $this->session->userdata('user_altercode');
		}
		
		$this->load->view('home/header', $data);
	    $this->load->view('main_page/termsofservice', $data);
	}
	public function privacy_policy() {
		//error_reporting(0);
		
		$data["session_user_image"] = base_url()."img_v".constant('site_v')."/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		$data["chemist_id"] = "";
		
		if(!empty($this->session->userdata('user_altercode')))
		{
			$data["session_user_image"] 	= $this->session->userdata('user_image');
			$data["session_user_fname"]     = $this->session->userdata('user_fname');
			$data["session_user_altercode"] = $this->session->userdata('user_altercode');
			$data["chemist_id"] = $this->session->userdata('user_altercode');
		}
		
		$this->load->view('home/header', $data);
	    $this->load->view('main_page/privacy_policy', $data);
	}
	public function register() {
		//error_reporting(0);
		$data["main_page_title"] = "Create account";
	    $this->load->view('main_page/register', $data);
	}
	
	public function login() {
		$this->session->sess_destroy();
		if($this->session->userdata('user_session')!=""){
			redirect('home');
		}
		$data["main_page_title"] = "Login";
	    $this->load->view('main_page/login', $data);
	}
	
	public function logout(){
		$this->session->sess_destroy();	
		//$this->session->unset_userdata('__ci_last_regenerate');
		/*$CI =& get_instance();
		$path = $CI->config->item('cache_path');
		$cache_path = ($path == '') ? APPPATH.'cache/' : $path;
		$handle = opendir($cache_path);
		while (($file = readdir($handle))!== FALSE) 
		{
			//Leave the directory protection alone
			if ($file != '.htaccess' && $file != 'index.html')
			{
				echo $cache_path.'/'.$file;
			   //@unlink($cache_path.'/'.$file);
			}
		}
		closedir($handle);*/
		setcookie("user_cart_total", "0", time() + (86400 * 30), "/");
		setcookie("user_type", "", time() + (86400 * 30), "/");
		setcookie("user_altercode", "", time() + (86400 * 30), "/");
		setcookie("user_password", "", time() + (86400 * 30), "/");
		setcookie("chemist_id", "", time() + (86400 * 30), "/");
		setcookie("user_session", "", time() + (86400 * 30), "/");
		redirect(base_url());
	}
	public function logout2(){
		$this->session->sess_destroy();	
		$this->session->unset_userdata('__ci_last_regenerate');
		redirect(base_url()."user/login");
	}
	public function download_order($order_id,$chemist_id)
	{
		$where = array('order_id'=>$order_id,'chemist_id'=>$chemist_id);
		$this->db->where($where);
		$query = $this->db->get("tbl_order");
		$row   = $query->row();
		$query = $query->result();
		if($row->id!="")
		{
			$where 			= array('altercode'=>$row->chemist_id);
			$users 			= $this->Scheme_Model->select_row("tbl_acm",$where);
			$acm_altercode 	= $users->altercode;
			$acm_name		= ucwords(strtolower($users->name));		
			$chemist_excle 	= "$acm_name ($acm_altercode)";
			$this->Order_Model->excel_save_order_to_server($query,$chemist_excle,"direct_download");
		}
		else{
			echo "error";
		}
	}
	public function login_api(){
		//error_reporting(0);
		$user_name1 = $_POST["user_name1"];
		$password1	= $_POST["password1"];
		$submit 	= "98c08565401579448aad7c64033dcb4081906dcb";
		header('Content-Type: application/json');
		$items = $this->Chemist_Model->login($user_name1,$password1);
		$someArray = json_decode($items, true);
		$user_return 	= "user_return";
		$user_session 	= "user_session";
		$user_fname 	= "user_fname";
		$user_code 		= "user_code";
		$user_altercode = "user_altercode";
		$user_type 		= "user_type";
		$user_password 	= "user_password";
		$user_division 	= "user_division";
		$user_compcode 	= "user_compcode";
		$user_image 	= "user_image";
		$user_nrx 		= "user_nrx";
		if($someArray[$user_return]=="1")
		{
			$ret = $this->Chemist_Model->insert_value_on_session($someArray[$user_session],$someArray[$user_fname],$someArray[$user_code],$someArray[$user_altercode],$someArray[$user_type],$someArray[$user_password],$someArray[$user_division],$someArray[$user_compcode],$someArray[$user_image],$someArray[$user_nrx]);
			$user_type 		= $someArray[$user_type];
			$user_altercode = $someArray[$user_altercode];
			$user_password	= $someArray[$user_password];	
			setcookie("chemist_id", "", time() + (86400 * 30), "/");
			$chemist_id  = "";
			$salesman_id = "";
			if($user_type=="sales")
			{
				$chemist_id     = $_COOKIE["chemist_id"];
				$salesman_id 	= $user_altercode;
				$user_altercode = $chemist_id;
			}
			$user_cart_total = $this->Chemist_Model->count_temp_rec($user_type,$user_altercode,$salesman_id);
			setcookie("user_cart_total", $user_cart_total, time() + (86400 * 30), "/");
		}
		else{
			$ret=1;
		}
		if($ret==1)
		{
?>
{"items":[<?= $items;?>]}<?php
		}
	}

	public function account(){

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["chemist_id"] 			= $_COOKIE['user_altercode'];

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
		$page_name = "account";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */
		
		$data["main_page_title"] = "Account";
		$this->load->view('home/header_footer/header', $data);
		$this->load->view('home/account', $data);
	}

	public function change_account(){

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["chemist_id"] 			= $_COOKIE['user_altercode'];
		
		$data["main_page_title"] = "Update account";
		$user_type = $_COOKIE['user_type'];
		if($user_type=="sales")
		{
			redirect(base_url());
		}

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
		$page_name = "change_account";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */

		$this->load->view('home/header_footer/header', $data);	
		$this->load->view('home/change_account', $data);
	}

	public function change_image(){

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["chemist_id"]	 			= $_COOKIE['user_altercode'];
		
		$data["main_page_title"] = "Update image";

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
		$page_name = "change_image";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */

		$this->load->view('home/header_footer/header', $data);
		$this->load->view('home/change_image', $data);
	}
	
	public function change_password(){

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["chemist_id"] 			= $_COOKIE['user_altercode'];
		
		$data["main_page_title"] = "Update password";

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
		$page_name = "change_password";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */

		$this->load->view('home/header_footer/header', $data);
		$this->load->view('home/change_password', $data);
	}
}
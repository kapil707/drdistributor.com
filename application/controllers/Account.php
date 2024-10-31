<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account extends CI_Controller {

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
		
		// Load model
		$this->load->model("model-drdistributor/account_model/AccountModel");
	}

	public function account_request() {
		
		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Request for login credentials";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */

		$this->load->view('account/header', $data);
	    $this->load->view('account/account_request', $data);
	}

	public function account_delete_request() {

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Request for account delete";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */

		$this->load->view('account/header', $data);
	    $this->load->view('account/account_delete_request', $data);
	}
	
	public function login() {

		//$this->session->sess_destroy();
		if(!empty($this->session->userdata('user_session'))){
			redirect('home');
		}

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Login";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */

		$this->load->view('account/header', $data);
	    $this->load->view('account/account_login', $data);
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
		setcookie("user_type", "", time() + (86400 * 30), "/");
		setcookie("user_altercode", "", time() + (86400 * 30), "/");
		setcookie("user_password", "", time() + (86400 * 30), "/");
		setcookie("chemist_id", "", time() + (86400 * 30), "/");
		setcookie("user_session", "", time() + (86400 * 30), "/");
		redirect(base_url());
	}

	public function get_login_api(){
		//error_reporting(0);
		$user_name 		= $_POST["user_name"];
		$user_password	= $_POST["user_password"];

		$items = "";
		if(!empty($user_name) && !empty($user_password)){
			$result = $this->AccountModel->get_login_api($user_name,$user_password,"website");
			$items = $result["items"];
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function get_create_new_api(){
		//error_reporting(0);
		$user_name 		= $_POST["user_name"];
		$phone_number	= $_POST["phone_number"];

		$items = "";
		if(!empty($user_name) && !empty($phone_number)){
			$result = $this->AccountModel->get_create_new_api($user_name,$phone_number);
			$items = $result["items"];
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function account_delete_request_api(){
		//error_reporting(0);
		$user_name 		= $_POST["user_name"];
		$user_password 	= $_POST["user_password"];
		$phone_number	= $_POST["phone_number"];

		$items = "";
		if(!empty($user_name) && !empty($user_password)){
			$result = $this->AccountModel->account_delete_request_api($user_name,$user_password,$phone_number);
			$items = $result["items"];
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
}
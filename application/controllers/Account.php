<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("model-drdistributor/chemist_login/ChemistLoginModel");
	}
	public function account_request() {
		//error_reporting(0);
		$data["main_page_title"] = "Request for login credentials";
	    $this->load->view('account/account_request', $data);
	}

	public function account_delete_request() {
		//error_reporting(0);
		$data["main_page_title"] = "Request for login credentials";
	    $this->load->view('account/account_delete_request', $data);
	}
	
	public function login() {
		$this->session->sess_destroy();
		if($this->session->userdata('user_session')!=""){
			redirect('home');
		}
		$data["main_page_title"] = "Login";
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
		setcookie("user_cart_total", "0", time() + (86400 * 30), "/");
		setcookie("user_type", "", time() + (86400 * 30), "/");
		setcookie("user_altercode", "", time() + (86400 * 30), "/");
		setcookie("user_password", "", time() + (86400 * 30), "/");
		setcookie("chemist_id", "", time() + (86400 * 30), "/");
		setcookie("user_session", "", time() + (86400 * 30), "/");
		redirect(base_url());
	}

	public function get_create_new_api(){
		//error_reporting(0);
		$chemist_code 	= $_POST["chemist_code"];
		$phone_number	= $_POST["phone_number"];

		if(!empty($chemist_code) && !empty($phone_number)){
			$result = $this->ChemistLoginModel->get_create_new_api($chemist_code,$phone_number);
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
	public function chemist_login_api(){
		//error_reporting(0);
		$user_name1 = $_POST["user_name1"];
		$password1	= $_POST["password1"];

		if(!empty($user_name1) && !empty($password1)){
			$result = $this->ChemistLoginModel->chemist_login_api($user_name1,$password1,"website");
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
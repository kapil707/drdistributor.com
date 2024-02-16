<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {
	public function login_check()
	{
		if($this->session->userdata('user_session')!=""){
			redirect(base_url()."home");			
		}
		$under_construction = $this->Scheme_Model->get_website_data("under_construction");
		if($under_construction=="1")
		{
			redirect(base_url()."under_construction");
		}
	}
	
	public function index(){
		$this->login_check();
		
		$data["main_page_title"] = "Home";
		$data["session_user_image"] = base_url()."img_v51/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		$data["chemist_id"] = "";
		if(!empty($_COOKIE["user_altercode"])){
			redirect(base_url()."home");
		} else {
			setcookie("user_cart_total", "0", time() + (86400 * 30), "/");
			setcookie("user_type", "", time() + (86400 * 30), "/");
			setcookie("user_altercode", "", time() + (86400 * 30), "/");
			setcookie("user_password", "", time() + (86400 * 30), "/");
			setcookie("chemist_id", "", time() + (86400 * 30), "/");
		}
		
		/********************************************************** */

		/**********************************************************/
		
		$this->load->view('home/header_footer/header', $data);		
		$this->load->view('home/home/home', $data);
		$this->load->view('home/header_footer/footer', $data);
	}

	public function termsofservice() {
		
		$data = "";
		
		$data["session_user_image"] = base_url()."img_v51/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		$data["chemist_id"] = "";
				
		$this->load->view('home/header_footer/header', $data);
	    $this->load->view('main_page/termsofservice', $data);
	}
	public function privacy_policy() {
		//error_reporting(0);
		
		$data["session_user_image"] = base_url()."img_v51/logo2.png";
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
		
		$this->load->view('home/header_footer/header', $data);
	    $this->load->view('main_page/privacy_policy', $data);
	}
}
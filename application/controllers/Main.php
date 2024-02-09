<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit','-1');
ini_set('post_max_size','500M');
ini_set('upload_max_filesize','500M');
ini_set('max_execution_time',36000);
class Main extends CI_Controller {
	public function login_check()
	{
		//error_reporting(0);
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
		
		$site_v = 51;
		
		$data["main_page_title"] = "Home";
		$data["session_user_image"] = base_url()."img_v".$site_v."/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		$data["chemist_id"] = "";
		if($_COOKIE["user_altercode"]!=""){
			redirect(constant('main_site')."home");
		} else {
			setcookie("user_cart_total", "0", time() + (86400 * 30), "/");
		}
		
		/********************************************************** */
		$page_name = "index";
		$browser_type = "Web";
		$browser = "";
		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */
		$tbl_home = $this->db->query("select * from tbl_home where status=1 order by seq_id asc")->result();
		$data["tbl_home"] = $tbl_home;
		
		$this->load->view('home/header', $data);		
		$this->load->view('home/home', $data);
		$this->load->view('home/footer', $data);
	}
}
?>
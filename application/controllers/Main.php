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
		$data["session_delivering_to"] = "xxxxxx";
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
		
		$this->load->view('header_footer/header', $data);		
		$this->load->view('home_page/home_page', $data);
		$this->load->view('header_footer/footer', $data);
	}

	public function terms_of_services() {

		$data["main_page_title"] = "Home";
		$data["session_user_image"] = base_url()."img_v51/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		$data["chemist_id"] = "";
		$data["main_page_title"] = "Request for account delete";

		$this->load->view('header_footer/header', $data);
	    $this->load->view('terms_of_services/terms_of_services', $data);
		$this->load->view('header_footer/footer', $data);
	}
	public function privacy_policy() {
		//error_reporting(0);
		
		$data["main_page_title"] = "Privacy policy";
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
		
		$this->load->view('header_footer/header', $data);
	    $this->load->view('privacy_policy/privacy_policy', $data);
		$this->load->view('header_footer/footer', $data);
	}

	public function download_order($order_id,$chemist_id)
	{
		$this->load->model("model-drdistributor/my_order/MyOrderModel");

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
			$this->MyOrderModel->order_excel_file($query,$chemist_excle,"direct_download");
		}
		else{
			echo "error";
		}
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {

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
	}

	public function LoginCheck()
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
		$this->LoginCheck();

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Home";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */

		$data["session_user_image"] = base_url()."img_v51/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		$data["session_delivering_to"] = "Guest";
		$data["chemist_id"] = "";
		if(!empty($user_altercode)){
			redirect(base_url()."home");
		}
		/********************************************************** */

		/**********************************************************/
		
		$this->load->view('header_footer/header', $data);		
		$this->load->view('home_page/home_page', $data);
		$this->load->view('header_footer/footer', $data);
	}

	public function terms_of_services() {

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Terms Of Services";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */

		$data["session_user_image"] = base_url()."img_v51/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		$data["chemist_id"] = "";
		$data["session_delivering_to"]  = "";

		$this->load->view('header_footer/header', $data);
	    $this->load->view('terms_of_services/terms_of_services', $data);
		$this->load->view('header_footer/footer', $data);
	}
	public function privacy_policy() {

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Privacy policy";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */

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

	public function download_order_old($order_id,$chemist_id)
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
			$users 			= $this->Scheme_Model->select_row("tbl_chemist",$where);
			$acm_altercode 	= $users->altercode;
			$acm_name		= ucwords(strtolower($users->name));		
			$chemist_excle 	= "$acm_name ($acm_altercode)";
			$this->MyOrderModel->order_excel_file($query,$chemist_excle,"direct_download");
		}
		else{
			echo "error";
		}
	}
	
	/***************invoice part********************** */	
	public function view_order($chemist_id='',$order_id=''){
		
		$data["session_user_image"] = base_url()."img_v51/logo2.png";
		$data["session_user_fname"]     = $chemist_id;
		$data["session_user_altercode"] = $chemist_id;
		$data["session_delivering_to"]  = $chemist_id;
		$data["chemist_id"] = "";
		
		$data["item_id"] = "";
		$data["user_altercode"] = "";
		$where = array('chemist_id'=>$chemist_id,'order_id'=>$order_id,);
		$this->db->where($where);
		$query = $this->db->get("tbl_order");
		$row   = $query->row();
		$query = $query->result();
		if(!empty($row->id)){
			$data["item_id"] 		= $order_id;
			$data["user_altercode"] = $chemist_id;
		}

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "$order_id";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */

		$this->load->view('header_footer/header', $data);
		$this->load->view('my_order/my_order_details_main', $data);	
		$this->load->view('header_footer/footer', $data);	
	}

	public function order_download($chemist_id='',$order_id=''){

		$this->load->model("model-drdistributor/my_order/MyOrderModel");

		$where = array('chemist_id'=>$chemist_id,'order_id'=>$order_id);
		$this->db->where($where);
		$query = $this->db->get("tbl_order");
		$row   = $query->row();
		$query = $query->result();
		if(!empty($row->id)){

			$where 			= array('altercode'=>$row->chemist_id);
			$users 			= $this->Scheme_Model->select_row("tbl_chemist",$where);
			$acm_altercode 	= $users->altercode;
			$acm_name		= ucwords(strtolower($users->name));		
			$chemist_excle 	= "$acm_name ($acm_altercode)";
			$this->MyOrderModel->order_excel_file($query,$chemist_excle,"direct_download");
		}
		else{
			echo "error";
		}
	}

	/***************invoice part********************** */	
	public function view_invoice($chemist_id='',$invoice_id=''){
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");

		$data["session_user_image"] = base_url()."img_v51/logo2.png";
		$data["session_user_fname"]     = $chemist_id;
		$data["session_user_altercode"] = $chemist_id;
		$data["session_delivering_to"]  = $chemist_id;
		
		$data["item_id"] = "";
		$data["user_altercode"] = "";
		$where = array('gstvno'=>$invoice_id,'chemist_id'=>$chemist_id);
		$row = $this->Scheme_Model->select_row("tbl_invoice",$where);
		if(!empty($row->id)){
			$data["item_id"] 		= $row->id;
			$data["user_altercode"] = $chemist_id;
		}
	
		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "$invoice_id";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */

		$this->load->view('header_footer/header', $data);
		$this->load->view('my_invoice/my_invoice_details_main', $data);		
	}
	
	public function invoice_download($chemist_id='',$invoice_id='')
	{
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");

		$where = array('gstvno'=>$invoice_id,'chemist_id'=>$chemist_id);
		$row = $this->Scheme_Model->select_row("tbl_invoice",$where);
		if(!empty($row->id)){
			$this->MyInvoiceModel->invoice_excel_file($row->gstvno,"direct_download");
		}else{
			$data["session_user_image"] = base_url()."img_v51/logo2.png";
			$data["session_user_fname"]     = "Guest";
			$data["session_user_altercode"] = "xxxxxx";
			
			$data["item_id"] 		= "";
			$data["user_altercode"] = "";
			
			/********************MainPageTitle***************************** */
			$data["MainPageTitle"] = $MainPageTitle = "DRD";
			$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
			$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
			/********************************************************** */

			$this->load->view('home/header_footer/header', $data);
			$this->load->view('main_page/invoice', $data);
			$this->load->view('header_footer/footer', $data);
		}
	}
}
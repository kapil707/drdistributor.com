<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {

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

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Home";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */

		if(!empty($this->UserType)){
			/********************PageMainData************************** */
			$data["UserId"] 	 = $this->UserId;
			$data["UserType"]    = $this->UserType;
			$data["UserFullName"]= $this->UserFullName;
			$data["UserImage"] 	 = $this->UserImage;
			$data["ChemistId"]	 = $this->ChemistId;

			/******************DeliveringToData************************* */
			$data["DeliveringTo"]= $data["ChemistId"];
			if($this->UserType=="sales") {
				$data["DeliveringTo"] = $data["ChemistId"]." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
			}
			/********************************************************** */
		}else{
			$data["UserId"] 		= "Guest";
			$data["UserType"]     	= "";
			$data["UserImage"] 		= base_url()."img_v51/logo2.png";
			$data["UserFullName"]   = "Guest";
			$data["DeliveringTo"] 	= "Guest";
			$data["ChemistId"] 		= "";
		}
		/**********************************************************/
		
		$this->load->view('header_footer/header', $data);		
		$this->load->view('home_page/home_page', $data);
		$this->load->view('header_footer/footer', $data);
	}

	public function terms_of_services() {

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Terms Of Services";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
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

	public function download_order_old($order_id,$chemist_id){

		// Load model
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
	
	/***************order part********************** */	
	public function view_order($ChemistId='',$OrderId=''){

		$data["UserId"] 		= $ChemistId;
		$data["UserType"]     	= "";
		$data["UserImage"] 		= base_url()."img_v51/logo2.png";
		$data["UserFullName"]   = $ChemistId;
		$data["DeliveringTo"] 	= $ChemistId;
		$data["ChemistId"] 		= $ChemistId;
		
		$data["ItemId"] = "";
		$where = array('chemist_id'=>$ChemistId,'order_id'=>$OrderId,);
		$this->db->where($where);
		$query = $this->db->get("tbl_order");
		$row   = $query->row();
		$query = $query->result();
		if(!empty($row->id)){
			$data["ItemId"] = $OrderId;
		}

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "$OrderId";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */

		$this->load->view('header_footer/header', $data);
		$this->load->view('my_order/my_order_details_main', $data);	
		$this->load->view('header_footer/footer', $data);	
	}

	public function order_download($chemist_id='',$order_id=''){
		
		// Load model
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
	public function view_invoice($InvoiceChemistId='',$Gstvno=''){

		// Load model
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "$Gstvno";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		/********************************************************** */

		if(!empty($this->UserType)){
			/********************PageMainData************************** */
			$data["UserId"] 	 = $this->UserId;
			$data["UserType"]    = $this->UserType;
			$data["UserFullName"]= $this->UserFullName;
			$data["UserImage"] 	 = $this->UserImage;
			$data["ChemistId"]	 = $this->ChemistId;

			/******************DeliveringToData************************* */
			$data["DeliveringTo"]= $data["ChemistId"];
			if($this->UserType=="sales") {
				$data["DeliveringTo"] = $data["ChemistId"]." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
			}
			/********************************************************** */
		}else{
			$data["UserId"] 		= "Guest";
			$data["UserType"]     	= "";
			$data["UserImage"] 		= base_url()."img_v51/logo2.png";
			$data["UserFullName"]   = "Guest";
			$data["DeliveringTo"] 	= "Guest";
			$data["ChemistId"] 		= "";
		}
		/**********************************************************/

		$ItemId = $this->MyInvoiceModel->InvoiceCheck($InvoiceChemistId,$Gstvno);

		$data["InvoiceChemistId"] 	= $InvoiceChemistId;
		$data["ItemId"] 			= $ItemId;

		$this->load->view('header_footer/header', $data);
		$this->load->view('my_invoice/my_invoice_details_main', $data);
		$this->load->view('header_footer/footer', $data);
	}
	
	public function invoice_download($InvoiceChemistId='',$Gstvno=''){
		
		// Load model
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");

		$ItemId = $this->MyInvoiceModel->InvoiceCheck($InvoiceChemistId,$Gstvno);
		if(!empty($ItemId)){
			$this->MyInvoiceModel->invoice_excel_file($Gstvno,"direct_download");
		}else{			
			/********************MainPageTitle***************************** */
			$data["MainPageTitle"] = $MainPageTitle = "DRD";
			$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
			/********************************************************** */

			if(!empty($this->UserType)){
				/********************PageMainData************************** */
				$data["UserId"] 	 = $this->UserId;
				$data["UserType"]    = $this->UserType;
				$data["UserFullName"]= $this->UserFullName;
				$data["UserImage"] 	 = $this->UserImage;
				$data["ChemistId"]	 = $this->ChemistId;
	
				/******************DeliveringToData************************* */
				$data["DeliveringTo"]= $data["ChemistId"];
				if($this->UserType=="sales") {
					$data["DeliveringTo"] = $data["ChemistId"]." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
				}
				/********************************************************** */
			}else{
				$data["UserId"] 		= "Guest";
				$data["UserType"]     	= "";
				$data["UserImage"] 		= base_url()."img_v51/logo2.png";
				$data["UserFullName"]   = "Guest";
				$data["DeliveringTo"] 	= "Guest";
				$data["ChemistId"] 		= "";
			}
			/**********************************************************/

			$this->load->view('home/header_footer/header', $data);
			$this->load->view('main_page/invoice', $data);
			$this->load->view('header_footer/footer', $data);
		}
	}
}
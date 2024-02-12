<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoice extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");
	}
	
	public function index($chemist_id='',$invoice_id=''){
		
		$data["session_user_image"] = base_url()."img_v".constant('site_v')."/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		
		$where = array('gstvno'=>$invoice_id,'chemist_id'=>$chemist_id);
		$query = $this->MyInvoiceModel->select_fun("tbl_invoice_new",$where);
		$row   = $query->row();
		$data["item_id"] 		= $row->id;
		$data["user_altercode"] = $chemist_id;
		
		$data["main_page_title"] = $invoice_id;	
		$this->load->view('home/header', $data);		
		$this->load->view('main_page/invoice', $data);		
	}
	
	public function invoice_download($chemist_id='',$invoice_id='')
	{
		$where = array('gstvno'=>$invoice_id,'chemist_id'=>$chemist_id);
		$query = $this->MyInvoiceModel->select_fun("tbl_invoice_new",$where);
		$row   = $query->row();
		if(!empty($row->id))
		{
			$this->MyInvoiceModel->invoice_excel_file($row->gstvno,"direct_download");
		}else{
			$data["session_user_image"] = base_url()."img_v".constant('site_v')."/logo2.png";
			$data["session_user_fname"]     = "Guest";
			$data["session_user_altercode"] = "xxxxxx";
			
			$data["item_id"] 		= "";
			$data["user_altercode"] = "";
			
			$data["main_page_title"] = "";
			$this->load->view('home/header', $data);		
			$this->load->view('main_page/invoice', $data);
		}
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoice extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");
	}
	
	public function index($chemist_id='',$invoice_id=''){
		
		$data["session_user_image"] = base_url()."img_v51/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		
		$where = array('gstvno'=>$invoice_id,'chemist_id'=>$chemist_id);
		$query = $this->MyInvoiceModel->select_fun("tbl_invoice_new",$where);
		$row   = $query->row();
		$data["item_id"] 		= $row->id;
		$data["user_altercode"] = $chemist_id;
		
		$data["main_page_title"] = $invoice_id;	
		$this->load->view('home/header_footer/header', $data);
		$this->load->view('main_page/invoice', $data);		
	}

	public function my_invoice_details_api(){
		$item_id	 	= $_REQUEST["item_id"];
		$user_altercode = $_REQUEST["user_altercode"];
		$salesman_id 	= "";
		$user_type 		= "chemist";
		$items 			= "";
		$delete_items	= "";
		$download_url 	= "";
		$items = $items_edit = $items_delete = $download_url = $header_title = "";
		if(!empty($user_type) && !empty($user_altercode) && !empty($item_id)){			
			$result = $this->MyInvoiceModel->get_my_invoice_details_api($user_type,$user_altercode,$salesman_id,$item_id);
			$items  		= $result["items"];
			$items_edit  	= $result["items_edit"];
			$items_delete  	= $result["items_delete"];
			$download_url  	= $result["download_url"];
			$header_title  	= $result["header_title"];
		}	
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
			'items_edit' => $items_edit,
			'items_delete' => $items_delete,
			'download_url' => $download_url,
			'header_title' => $header_title,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
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
			$data["session_user_image"] = base_url()."img_v51/logo2.png";
			$data["session_user_fname"]     = "Guest";
			$data["session_user_altercode"] = "xxxxxx";
			
			$data["item_id"] 		= "";
			$data["user_altercode"] = "";
			
			$data["main_page_title"] = "";
			$this->load->view('home/header_footer/header', $data);
			$this->load->view('main_page/invoice', $data);
		}
	}
}
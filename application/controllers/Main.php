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
		$data["session_delivering_to"] = "Guest";
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
	
	/***************invoice part********************** */	
	public function view_order($chemist_id='',$order_id=''){
		
		$data["session_user_image"] = base_url()."img_v51/logo2.png";
		$data["session_user_fname"]     = $chemist_id;
		$data["session_user_altercode"] = $chemist_id;
		
		$data["item_id"] = "";
		$where = array('chemist_id'=>$chemist_id,'order_id'=>$order_id,);
		$this->db->where($where);
		$query = $this->db->get("tbl_order");
		$row   = $query->row();
		$query = $query->result();
		if(!empty($row->id)){
			$data["item_id"] 		= $order_id;
			$data["user_altercode"] = $chemist_id;
		}

		$data["main_page_title"] = $order_id;	
		$this->load->view('header_footer/header', $data);
		$this->load->view('my_order/my_order_details', $data);		
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

	/***************invoice part********************** */	
	public function view_invoice($chemist_id='',$invoice_id=''){
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");

		$data["session_user_image"] = base_url()."img_v51/logo2.png";
		$data["session_user_fname"]     = $chemist_id;
		$data["session_user_altercode"] = $chemist_id;
		
		$where = array('gstvno'=>$invoice_id,'chemist_id'=>$chemist_id);
		$query = $this->MyInvoiceModel->select_fun("tbl_invoice_new",$where);
		$row   = $query->row();
		$data["item_id"] 		= $row->id;
		$data["user_altercode"] = $chemist_id;
		
		$data["main_page_title"] = $invoice_id;	
		$this->load->view('header_footer/header', $data);
		$this->load->view('main_page/invoice', $data);		
	}
	
	public function invoice_download($chemist_id='',$invoice_id='')
	{
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");

		$where = array('gstvno'=>$invoice_id,'chemist_id'=>$chemist_id);
		$query = $this->MyInvoiceModel->select_fun("tbl_invoice_new",$where);
		$row   = $query->row();
		if(!empty($row->id)){
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

	public function my_invoice_details_api(){
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");
		
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
}
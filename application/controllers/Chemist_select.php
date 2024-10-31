<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class chemist_select extends CI_Controller {

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
		
		$this->load->model("model-drdistributor/chemist_select/ChemistSelectModel");

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
    
    public function index(){

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "Chemist select";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */
		
		/********************session start***************************** */
		$data["session_user_image"] 	= $this->session->userdata('user_image');
		$data["session_user_fname"]     = $this->session->userdata('user_fname');
		$data["session_user_altercode"] = $this->session->userdata('user_altercode');
		$data["session_delivering_to"]  = $this->session->userdata('user_altercode');	
		
		$user_type 		= $this->session->userdata('user_type');
		$user_altercode = $this->session->userdata('user_altercode');
		$user_password	= $this->session->userdata('user_password');

		$chemist_id = $salesman_id = "";
		if($user_type=="sales" && !empty($this->session->userdata('chemist_id')))
		{
			$chemist_id 	= $this->session->userdata('chemist_id');
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		/********************************************************** */
		$data["chemist_id"] = $chemist_id;
		if($user_type=="sales")
		{
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_item_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}	
		
		$data["chemist_id"] = $chemist_id;
		$data["chemist_id_for_cart_total"] = $chemist_id;
		$this->load->view('header_footer/header', $data);
		$this->load->view('chemist_select/chemist_select', $data);
	}

	/*******************api start*********************/
	public function chemist_search_api()
	{
		$items = "";
		$user_type 		= $this->session->userdata('user_type');
		$user_altercode = $this->session->userdata('user_altercode');
		$keyword 		= $_REQUEST["keyword"];
		if(!empty($user_type) && !empty($user_altercode) && !empty($keyword))
		{
			$result = $this->ChemistSelectModel->chemist_search_api($keyword);
			$items = $result["items"];
		}
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function chemist_session_add($chemist_id="",$user_nrx="")
	{
		if(!empty($this->session->userdata('user_altercode')))
		{
			$user_type 		= $this->session->userdata('user_type');
			if($user_type=="sales")
			{
				$this->session->set_userdata('chemist_id',$chemist_id);
				$this->session->set_userdata('user_nrx',$user_nrx);
				redirect(base_url()."home");
			}
		}	
	}
	public function salesman_my_cart_api(){
		$user_type 		= $this->session->userdata('user_type');
		$user_altercode = $this->session->userdata('user_altercode');
		$items = "";
		if(!empty($user_type) && !empty($user_altercode))
		{
			$result = $this->ChemistSelectModel->salesman_my_cart_api($user_type,$user_altercode);
			$items = $result["items"];
		}
		
		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}
}
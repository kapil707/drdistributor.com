<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Medicine_use extends CI_Controller {

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
	public function index($item_code) {

		/********************MainPageTitle***************************** */
		$data["MainPageTitle"] = $MainPageTitle = "How to use";
		$data["siteTitle"] = $this->appconfig->siteTitle." || $MainPageTitle";
		$data["WebsiteVersion"] = $this->appconfig->getWebsiteVersion();
		/********************************************************** */

		$data["session_user_image"] = base_url()."img_v51/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		$data["session_delivering_to"]  = "";
		$data["chemist_id"] = "";

		$data['item_code'] = $item_code;

		$this->load->view('header_footer/header', $data);
	    $this->load->view('medicine_use/medicine_use', $data);
		$this->load->view('header_footer/footer', $data);
	}

	
	public function medicine_use_api(){
		$this->load->model("model-drdistributor/medicine_details/MedicineDetailsModel");

		$item_code		= $_REQUEST["item_code"];
		$user_type 		= "Chmiest";
		$user_altercode = "Guest";
		$user_password	= "";
		$chemist_id 	= "";
		$salesman_id = "";
		if(!empty($_COOKIE["user_type"])){
			$user_type 		= $_COOKIE["user_type"];
			$user_altercode = $_COOKIE["user_altercode"];
			$user_password	= $_COOKIE["user_password"];
			$user_nrx		= $_COOKIE["user_nrx"];
			$chemist_id 	= "";
			$salesman_id = "";
		}
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		if(!empty($user_type) && !empty($user_altercode) && !empty($item_code)){
			
			$result = $this->MedicineDetailsModel->medicine_details_api($user_type,$user_altercode,$salesman_id,$item_code);
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
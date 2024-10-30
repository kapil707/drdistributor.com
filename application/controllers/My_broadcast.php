<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_broadcast extends CI_Controller {

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
		
		// Load model
		$this->load->model("model-drdistributor/my_broadcast/MyBroadcastModel");

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

	/*******************api start*********************/
	public function my_broadcast_api(){
		/********************session***************************** */
		$user_type 		= $this->session->userdata('user_type');
		$user_altercode = $this->session->userdata('user_altercode');
		$user_password	= $this->session->userdata('user_password');

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $this->session->userdata('chemist_id');
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		/********************************************************** */
		$items = "";
		if(!empty($user_type) && !empty($user_altercode)) {

			$result = $this->MyBroadcastModel->get_my_broadcast_api($user_type,$user_altercode,$salesman_id);
			$items  	= $result["items"];
		}
		if($items){
			$response = array(
				'success' => "1",
				'message' => 'Data load successfully',
				'items' => $items
			);
		}else{
			$response = array(
				'success' => "0",
				'message' => 'no data found',
				'items' => ""
			);
		}

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
}
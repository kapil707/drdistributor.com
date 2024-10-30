<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_broadcast extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');
		$this->load->library('session');
		
		// Load model
		$this->load->model("model-drdistributor/my_broadcast/MyBroadcastModel");
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
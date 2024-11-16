<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_broadcast_api extends CI_Controller {

	var $UserId 		= "";
	var $UserType 		= "";
	var $UserFullName 	= "";
	var $UserPassword 	= "";
	var $UserImage 		= "";
	var $ChemistNrx 	= "";
	var $ChemistId 		= "";
	var $SalesmanId 	= "";
	var $FirebaseToken  = "";
	var $UserCart  		= "";
	
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');
		$this->load->library('session');

		/************log file***************** */
		CreateUserLog();
		/************************************* */

		/********************session start***************************** */
		$this->UserId		= $this->session->userdata('UserId');
		$this->UserType    	= $this->session->userdata('UserType');
		$this->UserFullName = $this->session->userdata('UserFullName');
		$this->UserPassword	= $this->session->userdata('UserPassword');
		$this->UserImage 	= $this->session->userdata('UserImage');
		$this->ChemistNrx	= $this->session->userdata('ChemistNrx');
		$this->ChemistId	= $this->session->userdata('ChemistId');
		$this->SalesmanId	= $this->session->userdata('SalesmanId');
		$this->FirebaseToken= $this->session->userdata('FirebaseToken');
		$this->UserCart		= $this->session->userdata('UserCart');
		/********************************************************** */
		
		// Load model
		$this->load->model("model-drdistributor/my_broadcast/MyBroadcastModel");
	}

	/*******************api start*********************/
	public function my_broadcast_api(){
		
		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;

		$items = "";
		if(!empty($UserType) && !empty($ChemistId)) {

			$result = $this->MyBroadcastModel->get_my_broadcast_api($UserType,$ChemistId,$SalesmanId);
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
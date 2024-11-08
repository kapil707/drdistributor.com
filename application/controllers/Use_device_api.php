<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Use_device_api extends CI_Controller {

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
		/********************************************************** */
		
		// Load model
		$this->load->model("model-drdistributor/user_device/UserDeviceModel");
	}

	public function insert_user_device_api(){
		
		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;

		$firebase_token = $_POST["firebase_token"];
		$type = "Web";

		if(!empty($UserType) && !empty($ChemistId) && !empty($firebase_token)) {

			$result = $this->UserDeviceModel->insert_user_device($UserType,$ChemistId,$SalesmanId,$firebase_token,$type);
		}

		$response = array(
			'success' => "1",
			'message' => 'Data insert successfully',
		);

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Medicine_other extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Load model
		$this->load->model("model-drdistributor/chemist_login/ChemistLoginModel");
        $this->ChemistLoginModel->login_check();
		
	}public function medicine_details_api()
	{
		$item_code		= $_REQUEST["item_code"];
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];
		$chemist_id 	= "";
		$salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		if(!empty($user_type) && !empty($user_altercode) && !empty($item_code)){
			
			$items = $this->Chemist_Model->medicine_details_api($user_type,$user_altercode,$salesman_id,$item_code);
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
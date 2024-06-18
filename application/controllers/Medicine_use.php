<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Medicine_use extends CI_Controller {	
	public function index($item_code) {

		$data["main_page_title"] = "Home";
		$data["session_user_image"] = base_url()."img_v51/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		$data["session_delivering_to"]  = "";
		$data["chemist_id"] = "";
		$data["main_page_title"] = "How to Use";

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
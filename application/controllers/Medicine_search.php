<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Medicine_search extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Load model
		$this->load->model("model-drdistributor/account_model/AccountModel");
        $this->AccountModel->login_check("medicine_search");

		$this->load->model("model-drdistributor/medicine_search/MedicineSearchModel");
	}
    
    public function index(){

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		
		$data["main_page_title"] = "Search medicines";

		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		if($user_type=="sales")
		{
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist'> <img src='".base_url()."/img_v51/edit_icon.png' width='12px;' style='margin-top: 2px;margin-bottom: 2px;'> Edit chemist</a>";
		}

		$data["chemist_id"] = $chemist_id;
		/********************************************************** *
		if($user_type=="sales")
		{
			$user_session 	= $_COOKIE['user_session'];
			if(!empty($chemist_id))
			{
				$user_temp_rec = $user_session."_".$user_type."_".$chemist_id;
				setcookie("user_temp_rec", $user_temp_rec, time() + (86400 * 30), "/");
			}
		}

		/********************************************************** */
		$page_name = "search_medicine";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */
		
		$this->load->view('header_footer/header', $data);
		$this->load->view('medicine_search/medicine_search', $data);
	}

	public function medicine_search_api()
	{
		$items = "";
		$keyword   			= $_REQUEST['keyword'];
		$total_rec   		= $_REQUEST['total_rec'];
		$checkbox_medicine 	= $_REQUEST['checkbox_medicine_val'];
		$checkbox_company	= $_REQUEST['checkbox_company_val'];
		$checkbox_out_of_stock= $_REQUEST['checkbox_out_of_stock_val'];
		$user_nrx  			= $_COOKIE["user_nrx"];
		if(!empty($keyword))
		{
			$items = $this->MedicineSearchModel->medicine_search_api($keyword,$user_nrx,$total_rec,$checkbox_medicine,$checkbox_company,$checkbox_out_of_stock);
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
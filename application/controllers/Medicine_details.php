<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Medicine_details extends CI_Controller {

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
		
		/************login check************** */	
		LoginCheck();
		/************************************* */

		/************log file***************** */
		CreateUserLog();
		/************************************* */
	
		// Load model
		$this->load->model("model-drdistributor/medicine_details/MedicineDetailsModel");
		$this->load->model("model-drdistributor/medicine_favourite/MedicineFavouriteModel");

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
	public function medicine_details_api()
	{
		$item_code		= $_REQUEST["item_code"];

		/********************PageSession*************************** */
		$user_type 		= $this->user_type;
		$user_altercode = $this->user_altercode;
		$user_password	= $this->user_password;
		$chemist_id 	= $this->chemist_id;
		$salesman_id 	= $this->salesman_id;
		/********************************************************** */
		if(!empty($user_type) && !empty($user_altercode) && !empty($item_code)){			
			$result = $this->MedicineDetailsModel->medicine_details_api($user_type,$user_altercode,$salesman_id,$item_code);
			$items = $result["items"];
		}

		/******************CreateSearcLog********************* */
		$search_term = "";
		$product_viewed = $item_code;
		CreateSearcLog($search_term, $product_viewed); 
		/***************************************************** */
        
        $response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

    public function get_medicine_favourite_api(){
		$user_altercode = $this->user_altercode;

		$items = "";
		if(!empty($user_altercode)){
	        $items = $this->MedicineFavouriteModel->get_medicine_favourite_api($user_altercode);
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
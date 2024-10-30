<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Medicine_details extends CI_Controller {
	
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
	}
	
	/*******************api start*********************/
	public function medicine_details_api()
	{
		$item_code		= $_REQUEST["item_code"];
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];
		$chemist_id 	= $salesman_id = "";
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

		/***************************************************** */
		if(!empty($_COOKIE["user_altercode"])){
			$user_type 		= $_COOKIE["user_type"];
			$user_altercode = $_COOKIE["user_altercode"];

			$chemist_id = $salesman_id = "";
			if($user_type=="sales")
			{
				$chemist_id 	= $_COOKIE["chemist_id"];
				$salesman_id 	= $user_altercode;
				$user_altercode = $chemist_id;
			}
		
			$product_viewed = $item_code;

			log_search_activity($user_altercode, $salesman_id, "", $product_viewed); 
		}
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
		$items = "";
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];
		$chemist_id 	= "";
		$salesman_id = "";
		if($user_type=="sales") {
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
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
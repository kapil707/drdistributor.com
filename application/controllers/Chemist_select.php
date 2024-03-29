<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class chemist_select extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Load model

		if(empty($_COOKIE["user_altercode"])){
			redirect(base_url()."login");
		}
		$under_construction = $this->Scheme_Model->get_website_data("under_construction");
		if($under_construction=="1")
		{
			redirect(base_url()."under_construction");
		}

		$this->load->model("model-drdistributor/chemist_select/ChemistSelectModel");
	}
    
    public function index(){
		
		$data["main_page_title"] = "Chemist select";
		
		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["session_delivering_to"]  = $_COOKIE['user_altercode'];		
		
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= "";//$_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$data["chemist_id"] = $chemist_id;
		if($user_type=="sales")
		{
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_item_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}

		/********************************************************** */
		$page_name = "search_chemist";
		$browser_type = "Web";
		$browser = "";

		$this->load->model("model-drdistributor/activity_model/ActivityModel");
		$this->ActivityModel->activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */		
		
		$data["chemist_id"] = $chemist_id;
		$data["chemist_id_for_cart_total"] = $chemist_id;
		$this->load->view('header_footer/header', $data);
		$this->load->view('chemist_select/chemist_select', $data);
	}

	/*******************api start*********************/
	public function chemist_search_api()
	{
		$items = "";
		$user_type 		= $_COOKIE['user_type'];
		$user_altercode	= $_COOKIE['user_altercode'];
		$keyword 		= $_REQUEST["keyword"];
		if(!empty($user_type) && !empty($user_altercode) && !empty($keyword))
		{
			$result = $this->ChemistSelectModel->chemist_search_api($keyword);
			$items = $result["items"];
		}
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function chemist_session_add($chemist_id="",$user_nrx="")
	{
		if(!empty($_COOKIE["user_type"]))
		{
			$user_type = $_COOKIE["user_type"];
			if($user_type=="sales")
			{
				setcookie("chemist_id", $chemist_id, time() + (86400 * 30), "/");
				setcookie("user_nrx", $user_nrx, time() + (86400 * 30), "/");
				redirect(base_url()."home");
			}
		}	
	}
	public function salesman_my_cart_api(){
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode	= $_COOKIE["user_altercode"];
		$items = "";
		if(!empty($user_type) && !empty($user_altercode))
		{
			$result = $this->ChemistSelectModel->salesman_my_cart_api($user_type,$user_altercode);
			$items = $result["items"];
		}
		
		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}
}
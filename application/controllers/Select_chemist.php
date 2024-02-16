<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Select_chemist extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Load model

		$this->load->model("model-drdistributor/select_chemist/SelectChemistModel");
	}
    
    public function index(){

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		
		$data["main_page_title"] = "Select Chemist";

		if(!empty($_COOKIE["user_type"]))
		{
			$user_type = $_COOKIE['user_type'];
			$chemist_id = "";
			if($user_type=="sales")
			{
				if(!empty($_COOKIE['chemist_id'])){
					$chemist_id = $_COOKIE['chemist_id'];
					$data["session_user_fname"]     = "Code : ".$chemist_id." | <a href='".base_url()."home/select_chemist'> <img src='".base_url()."/img_v51/edit_icon.png' width='12px;' style='margin-top: 2px;margin-bottom: 2px;'></a>";
				}
			}
		}

		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id 	= "";

		$salesman_id = "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}

		/********************************************************** */
		$page_name = "search_medicine";
		$browser_type = "Web";
		$browser = "";

		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */		
		
		$data["chemist_id"] = $chemist_id;
		$data["chemist_id_for_cart_total"] = $chemist_id;
		$this->load->view('home/header_footer/header', $data);
		$this->load->view('home/select_chemist/select_chemist', $data);
	}

	public function select_chemist_api()
	{
		//error_reporting(0);
		$items = "";
		$user_type 		= $_COOKIE['user_type'];
		$user_altercode	= $_COOKIE['user_altercode'];
		$keyword 		= $_REQUEST["keyword"];
		if(!empty($user_type) && !empty($user_altercode) && !empty($keyword))
		{
			$result = $this->SelectChemistModel->select_chemist_api($user_type,$user_altercode,$keyword);
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

	public function chemist_session_add($chemist_id="")
	{
		if(!empty($_COOKIE["user_type"]))
		{
			$user_type = $_COOKIE["user_type"];
			if($user_type=="sales")
			{
				setcookie("chemist_id", $chemist_id, time() + (86400 * 30), "/");
				redirect(base_url()."home");
			}
		}	
	}
	public function salesman_my_cart_api(){
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode	= $_COOKIE["user_altercode"];
		$items = "";
		if($user_type!="" && $user_altercode!="")
		{
			$items = $this->SelectChemistModel->salesman_my_cart_api($user_type,$user_altercode);
		}
?>
{"items":[<?= $items;?>]}<?php
	}
}
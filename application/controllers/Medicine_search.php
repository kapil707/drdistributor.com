<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Medicine_search extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Load model
		$this->load->model("model-drdistributor/chemist_login/ChemistLoginModel");
        $this->ChemistLoginModel->login_check("medicine_search");

		$this->load->model("model-drdistributor/medicine_search/MedicineSearchModel");
	}
    
    public function index(){

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		
		$data["main_page_title"] = "Search medicines";

		if(!empty($_COOKIE["user_type"]))
		{
			$user_type = $_COOKIE['user_type'];
			$chemist_id = "";
			if($user_type=="sales")
			{
				$chemist_id = $_COOKIE['chemist_id'];
				$data["session_user_fname"]     = "Code : ".$chemist_id." | <a href='".base_url()."home/select_chemist'> <img src='".base_url()."/img_v51/edit_icon.png' width='12px;' style='margin-top: 2px;margin-bottom: 2px;'></a>";
			}
		}

		$user_session 	= $_COOKIE['user_session'];
		$user_type 		= $_COOKIE['user_type'];
		$chemist_id 	= "";
		$data["chemist_id"] = $chemist_id;
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE['chemist_id'];
			$data["chemist_id"] = $chemist_id;
			if(!empty($chemist_id))
			{
				$user_temp_rec = $user_session."_".$user_type."_".$chemist_id;
				setcookie("user_temp_rec", $user_temp_rec, time() + (86400 * 30), "/");
			}
		}
		else
		{
			$data["chemist_id"] = "";
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
		
		if(!empty($_COOKIE['user_temp_rec'])){
			/************jab table m oss id ko davai nahi ha to yha remove karta ha */
			$user_temp_rec = $_COOKIE['user_temp_rec'];
			$this->db->query("delete from drd_temp_rec where temp_rec='$user_temp_rec' and status='0' and i_code='' ");
			/************************************************************************/
		}
		
		if(!empty($chemist_id))
		{
			$where = array('altercode'=>$chemist_id);
			$row = $this->Scheme_Model->select_row("tbl_acm",$where);
			$data["chemist_name"] = $row->name;
			$data["chemist_id"]   = $row->altercode;

			$where= array('code'=>$row->code);
			$row1 = $this->Scheme_Model->select_row("tbl_acm_other",$where);

			$user_profile = base_url()."img_v51/logo.png";
			if(!empty($row1->image)){
				$user_profile = base_url()."user_profile/".$row1->image;
				if(empty($row1->image))
				{
					$user_profile = base_url()."img_v51/logo.png";
				}
			}
			$data["chemist_image"]   = $user_profile;
		}
		
		$data["chemist_id"] = $chemist_id;
		$data["chemist_id_for_cart_total"] = $chemist_id;
		$this->load->view('home/header_footer/header', $data);
		$this->load->view('home/medicine_search/medicine_search', $data);
	}

	public function medicine_search_api()
	{
		$items = "[]";
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
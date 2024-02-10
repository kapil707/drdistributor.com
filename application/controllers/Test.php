<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends CI_Controller {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->model("model-drdistributor/InvoiceModel");
    }

	public function hello_g(){
		//echo "sdfsadf";
		
		//$file_name_dt  = $this->InvoiceModel->create_invoice_excle($vdt,$vno,$gstvno,$u_name,$chemist_id,"cronjob_download");
		
		$file_name_dt  = $this->InvoiceModel->create_invoice_excle("2024-01-19","566124","SB-23-566124","H185","cronjob_download");
	}
	
	public function create_invoice_excle_tt(){
		$this->InvoiceModel->create_invoice_excle_tt();
	}
	
	public function login_check()
	{	
		//error_reporting(0);
		
		$url = ($_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http') . "://{$_SERVER['SERVER_NAME']}".str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
		/*if($url==constant('main_site') && $this->session->userdata('user_type')=="sales")
		{
			redirect(constant('main_site')."logout");
		}*/
		if($_COOKIE["user_altercode"]==""){
			redirect(constant('main_site')."login");			
		}
		if($_COOKIE["user_type"]=="corporate"){
			redirect(constant('main_site')."logout");			
		}
		$under_construction = $this->Scheme_Model->get_website_data("under_construction");
		if($under_construction=="1")
		{
			redirect(base_url()."under_construction");
		}
	}
	
	public function salesman_chemist_ck()
	{
		if(!empty($_COOKIE["user_type"]))
		{
			$user_type = $_COOKIE["user_type"];
			if($user_type=="sales" && empty($_COOKIE["chemist_id"]))
			{
				redirect(constant('main_site')."home/select_chemist");
			}
		}	
	}
	
	
	public function search_medicine(){
		////error_reporting(0);
		$this->login_check();
		$this->salesman_chemist_ck();

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		
		$data["main_page_title"] = "Search medicines";

		if(!empty($_COOKIE["user_type"]))
		{
			$user_type = $_COOKIE['user_type'];
			$chemist_id = $_COOKIE['chemist_id'];
			if($user_type=="sales")
			{
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

		$chemist_id 	= $_COOKIE["chemist_id"];

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
		$this->load->view('home/header', $data);
		$this->load->view('test/search_medicine', $data);
	}
	
	public function index(){
		$this->login_check();
		////error_reporting(0);
		$data["main_page_title"] = "Home";
		$data["session_user_image"] = base_url()."img_v51/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		$data["chemist_id"] = "";
		if($_COOKIE["user_altercode"]!=""){
			//redirect(constant('main_site')."home");
		} else {
			setcookie("user_cart_total", "0", time() + (86400 * 30), "/");
		}
		
		/********************************************************** */
		$page_name = "index";
		$browser_type = "Web";
		$browser = "";
		$this->Chemist_Model->user_activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** 
		$tbl_home = $this->db->query("select * from tbl_home where status=1 order by seq_id asc")->result();
		$data["tbl_home"] = $tbl_home;
		//print_r($tbl_home);*/
		
		$this->load->view('test/header', $data);		
		$this->load->view('test/home', $data);
		$this->load->view('home/footer', $data);
	}
}
?>
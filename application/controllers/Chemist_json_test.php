<?php
header('Content-Type: application/json');
defined('BASEPATH') OR exit('No direct script access allowed');
class Chemist_json_test extends CI_Controller {	
	public function __construct(){

		parent::__construct();

		// Load model
		//$this->load->model("LoginModel");
		//$this->load->model("MedicineSearchModel");
		$this->load->model("SliderModel");
		$this->load->model("MenuModel");
		$this->load->model("MedicineDivisionModel");
		$this->load->model("MedicineItemModel");
		
		$this->load->model("model-drdistributor/InvoiceModel");
		$this->load->model("model-drdistributor/HomeMenuModel");
	}
	
	public function home_page_web()
	{
		$get_record	 	= "0";//$_REQUEST["get_record"];

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

		$session_yes_no = "no";
		if(!empty($user_altercode)){
			$session_yes_no = "yes";
		}
		/*
		$my_notification = "";
		if($user_type!="" && $user_altercode!="" && $get_record!="")
		{
			$result = $this->Chemist_Model->my_notification_json_50($user_type,$user_altercode,$salesman_id,$get_record);

			$my_notification  = $result["items"];
		}
		$my_notification = '{"my_notification":['.$my_notification.']}';

		/****************************************************** */
		/*
		$my_invoice = "";
		if($user_type!="" && $user_altercode!="" && $get_record!="")
		{
			$result = $this->Chemist_Model->my_invoice_json_50($user_type,$user_altercode,$salesman_id,$get_record);

			$my_invoice  = $result["items"];
		}
		$my_invoice = '{"my_invoice":['.$my_invoice.']}';
		*/
		
		$myid = $nid = $_REQUEST["myid"];
		
		$items = "";
		$tbl_home = $this->db->query("select * from tbl_home where status=1 and id='$nid' order by seq_id asc")->result();
		foreach($tbl_home as $row){
			$category_id = $row->category_id;
			
			$result_row = "[]";
			if($row->type=="slider"){
			    $top_flash = $this->SliderModel->slider($row->category_id);
		        $result_row = $top_flash;
				$row_title  = 'slider';
			}
			
			if($row->type=="menu"){
				$menu = $this->HomeMenuModel->get_menu_api();
		        $result_row = $menu;
				$row_title  = 'menu';
				
			}
			
			if($row->type=="divisioncategory"){
			    $result = $this->MedicineDivisionModel->medicine_division($category_id);
				
				$row_title  = $result["title"];
		        $result_row = $result["items"];
			}
			
			if($row->type=="itemcategory"){
				$result = $this->MedicineItemModel->medicine_item($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id);
				$row_title  = $result["title"];
				$result_row = $result["items"];
			}
            
            $items.= '{"result":"'.$row->type.'","result_id":"'.$row->id.'","result_category_id":"'.$category_id.'","result_title":"'.$row_title.'","result_row":'.$result_row.',"myid":'.$myid.'},';
		}
		if ($items != '') {
			$items = substr($items, 0, -1);
		}
		
		/****************************************************** */
		echo $get_result = '{"get_result":['.$items.']}'; 
	}
}

?>
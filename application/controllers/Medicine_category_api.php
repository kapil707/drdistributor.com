<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Medicine_category_api extends CI_Controller {

	var $UserId 		= "";
	var $UserType 		= "";
	var $UserFullName 	= "";
	var $UserPassword 	= "";
	var $UserImage 		= "";
	var $ChemistNrx 	= "";
	var $ChemistId 		= "";
	var $SalesmanId 	= "";
	var $FirebaseToken  = "";
	var $UserCart  		= "";

	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');
		
		/************login check************** */	
		//LoginCheck();
		/************************************* */

		/************log file***************** */
		CreateUserLog();
		/************************************* */

		// Load model
		$this->load->model("model-drdistributor/medicine_category/MedicineCategoryModel");
		$this->load->model("model-drdistributor/medicine_division/MedicineDivisionModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineItemModel");

		/********************session start***************************** */
		$this->UserId		= $this->session->userdata('UserId');
		$this->UserType    	= $this->session->userdata('UserType');
		$this->UserFullName = $this->session->userdata('UserFullName');
		$this->UserPassword	= $this->session->userdata('UserPassword');
		$this->UserImage 	= $this->session->userdata('UserImage');
		$this->ChemistNrx	= $this->session->userdata('ChemistNrx');
		$this->ChemistId	= $this->session->userdata('ChemistId');
		$this->SalesmanId	= $this->session->userdata('SalesmanId');
		$this->FirebaseToken= $this->session->userdata('FirebaseToken');
		$this->UserCart		= $this->session->userdata('UserCart');
		/********************************************************** */
	}
	
	public function get_medicine_category_api(){

		/******************************************/
		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId		= $this->SalesmanId;
		$ChemistNrx		= $this->ChemistNrx;

		$SessionValue = "no";
		if(!empty($UserType)){
			$SessionValue = "yes";
		}

		$item_company	= $_POST['item_company'];
		$item_division	= $_POST['item_division'];
		$get_record		= $_POST['get_record'];
		if(!empty($item_company))
		{
			$item_company 	= str_replace("-"," ",ucfirst($item_company));

			$item = $this->MedicineDivisionModel->get_medicine_company_id($item_company);
			$item_code 		= $item["company_code"];
			$item_page_type = "company_or_division";
			if($item["type"]=="company_category"){
				$item_page_type = "company_with_category";
			}
			if($item["type"]=="item_category"){
				$item_page_type = "item_category";
			}
			/*****************************/

			if($item_page_type=="company_or_division")
			{
				/*****************************/
				$show_out_of_stock="1";
				$limit="12";
				$order_by_type="id";
				/*****************************/

				$result = $this->CategoryModel->get_company_or_division_api($SessionValue,$ChemistNrx,$item_code,$item_division,$show_out_of_stock,$get_record,$limit,$order_by_type);
				$items  = $result["items"];
				$title  = $result["title"];
				$get_record  = $result["get_record"];
			}
			
			if($item_page_type=="company_with_category")
			{
				/*****************************/
				$show_out_of_stock="1";
				$limit="12";
				$order_by_type="id";
				/*****************************/

				$result = $this->CategoryModel->get_company_with_category_api($SessionValue,$ChemistNrx,$item_code,$show_out_of_stock,$get_record,$limit,$order_by_type);
				$items  = $result["items"];
				$title  = $result["title"];
				$get_record  = $result["get_record"];
			}

			if($item_page_type=="item_category")
			{
				/*****************************/
				$show_out_of_stock="1";
				$limit="12";
				$order_by_type="id";
				/*****************************/

				$CategoryId = $item_code;
				$result = $this->MedicineItemModel->medicine_item($SessionValue,$CategoryId,$UserType,$ChemistId,$SalesmanId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type);
				$items = $result["items"];
				$title  = $result["title"];
				$get_record  = $result["get_record"];
			}
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
            'title' => $title,
			'get_record' => $get_record,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
}
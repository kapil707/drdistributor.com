<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_invoice_api extends CI_Controller {

	var $UserId 		= "";
	var $UserType 		= "";
	var $UserFullName 	= "";
	var $UserPassword 	= "";
	var $UserImage 		= "";
	var $ChemistNrx 	= "";
	var $ChemistId 		= "";
	var $SalesmanId 	= "";
	var $FirebaseToken  = "";
	
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');
		$this->load->library('session');

		/************log file***************** */
		CreateUserLog();
		/************************************* */
	
		// Load model
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");

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
		/********************************************************** */
	}

	/*******************api start*********************/
	public function my_invoice_api(){

		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;

		$get_record	 	= $_REQUEST["get_record"];
		$items = "";
		if(!empty($UserType) && !empty($ChemistId)) {

			$result = $this->MyInvoiceModel->get_my_invoice_api($UserType,$ChemistId,$SalesmanId,$get_record);
			$items  	= $result["items"];
			$get_record  = $result["get_record"];
		}

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
			'get_record' => $get_record
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function my_invoice_details_api(){
		
		$UserType 		= $this->UserType;
		$ChemistId 		= $this->ChemistId;
		$SalesmanId 	= $this->SalesmanId;

		$item_id		= $_REQUEST['item_id'];
		$items = $items_edit = $items_delete = $download_url = $title = "";
		if(!empty($UserType) && !empty($ChemistId) && !empty($item_id)){

			$result = $this->MyInvoiceModel->get_my_invoice_details_api($UserType,$ChemistId,$SalesmanId,$item_id);
			$items  		= $result["items"];
			$items_edit  	= $result["items_edit"];
			$items_delete  	= $result["items_delete"];
			$download_url  	= $result["download_url"];
			$title			= $result["title"];
		}	
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
			'items_edit' => $items_edit,
			'items_delete' => $items_delete,
			'download_url' => $download_url,
			'title' => $title,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function my_invoice_details_main_api(){

		$item_id		= $_REQUEST['item_id'];
		$ChemistId 		= $_REQUEST['invoice_chemist_id'];
		$UserType 		= "chemist";
		$SalesmanId 	= "";
		
		$items = $items_edit = $items_delete = $download_url = $title = "";
		if(!empty($UserType) && !empty($ChemistId) && !empty($item_id)){			
			$result = $this->MyInvoiceModel->get_my_invoice_details_api($UserType,$ChemistId,$SalesmanId,$ItemId);
			$items  		= $result["items"];
			$items_edit  	= $result["items_edit"];
			$items_delete  	= $result["items_delete"];
			$download_url  	= $result["download_url"];
			$title			= $result["title"];
		}	
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
			'items_edit' => $items_edit,
			'items_delete' => $items_delete,
			'download_url' => $download_url,
			'title' => $title,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
}
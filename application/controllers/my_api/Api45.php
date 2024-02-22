<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Api45 extends CI_Controller {		
	public function get_login_api()
	{
		$this->load->model("model-drdistributor/chemist_login/ChemistLoginModel");

		$api_key		= $_POST['api_key'];
		$user_name 		= $_POST['user_name'];
		$user_password 	= $_POST['user_password'];
		$firebase_token	= $_POST['firebase_token'];

		if(!empty($api_key) && !empty($user_name) && !empty($user_password))
		{
			$result = $this->ChemistLoginModel->chemist_login_api($user_name,$user_password,"");
			$items = $result["items"];
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo "[".json_encode($response)."]";
	}

	public function main_page_api()	{

		$this->load->model("model-drdistributor/my_cart/MyCartModel");

		$api_key 		= $_POST["api_key"];
		$user_type 		= $_POST["user_type"];
		$user_altercode	= $_POST["user_altercode"];
		$user_password	= $_POST["user_password"];
		$chemist_id		= $_POST["chemist_id"];

		$salesman_id 	= "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}

		$firebase_token = $_POST["firebase_token"];
		$device_id		= $_POST["device_id"];
		
		$versioncode	= $_POST["versioncode"];
		$getlatitude	= $_POST['getlatitude'];
		$getlongitude	= $_POST['getlongitude'];
		$gettime		= $_POST['gettime'];
		$getdate		= $_POST['getdate'];
		
		if(!empty($api_key))
		{
			//$login = $this->Chemist_Model->login($user_altercode,$user_password);
			$time	= time();
			$date	= date("Y-m-d");
			
			$where1= array('firebase_token'=>$firebase_token,'chemist_id'=>$user_altercode,'user_type'=>$user_type,);
			$row = $this->Scheme_Model->select_row("tbl_android_device_id",$where1);
			$ratingbar = 1;
			if(empty($row->id))
			{
				$dt = array(
				'firebase_token'=>$firebase_token,
				'device_id'=>$device_id,
				'user_type'=>$user_type,
				'chemist_id'=>$user_altercode,
				'versioncode'=>$versioncode,
				'time'=>$time,
				'date'=>$date,
				'ratingbar'=>$ratingbar,
				'getlatitude'=>$getlatitude,
				'getlongitude'=>$getlongitude,
				'gettime'=>$gettime,
				'getdate'=>$getdate,
				);
				$this->Scheme_Model->insert_fun("tbl_android_device_id",$dt);
			}
			else
			{
				$ratingbar = $row->ratingbar;
				$ratingbar++;
				
				$dt = array(
				'firebase_token'=>$firebase_token,
				'device_id'=>$device_id,
				'user_type'=>$user_type,
				'chemist_id'=>$user_altercode,
				'versioncode'=>$versioncode,
				'time'=>$time,
				'date'=>$date,
				'ratingbar'=>$ratingbar,
				'getlatitude'=>$getlatitude,
				'getlongitude'=>$getlongitude,
				'gettime'=>$gettime,
				'getdate'=>$getdate,
				);
				$where = array('firebase_token'=>$firebase_token,'chemist_id'=>$user_altercode,'user_type'=>$user_type,);
				$this->db->update("tbl_android_device_id",$dt,$where);
			}
			
			/*****ratingbarpage open hota ha iss code say ****/
			$ratingbarpage = 0;
			if(!empty($row->id))
			{
				if($row->ratingbar%10==0)
				{
					if($row->rating=="0")
					{
						$ratingbarpage = 1;
					}
				}
			}
			
			/********************************************************************/
			$logout = $clear_database = 0;
			if(!empty($row->id))
			{
				/*****versioncode same nahi ha to database clear ****/
				if($versioncode!=$row->versioncode)
				{
					$clear_database = 1;
				}				
				/*****admin say clear database karay to ****/
				if($row->clear_database==1)
				{
					$clear_database = $row->clear_database;
				}				
				/***************database clear ki command di ha to********************/
				if($clear_database==1)
				{
					$this->db->query("update tbl_android_device_id set clear_database='0' where device_id='$device_id'");
				}
				/***************logout ki command di ha to********************/
				if($row->logout==1)
				{
					$logout = 1;
					$this->db->query("update tbl_android_device_id set logout='0' where device_id='$device_id'");
				}
			}
			$versioncode 	= $this->Scheme_Model->get_website_data("android_versioncode");

			/***************broadcast message********************/
			$broadcast_status = $this->Scheme_Model->get_website_data("broadcast_status");
			$broadcast_title = $broadcast_message = "";
			if($broadcast_status=="1")
			{
				$broadcast_title = $this->Scheme_Model->get_website_data("broadcast_title");
				$broadcast_message = $this->Scheme_Model->get_website_data("broadcast_message");
			}		
			
			/*****************update ke liya code*********************/
			$force_update 			= $this->Scheme_Model->get_website_data("force_update");
			$force_update_title 	= $this->Scheme_Model->get_website_data("force_update_title");
			$force_update_message	= $this->Scheme_Model->get_website_data("force_update_message");	

			/***********************************************************/
			$under_construction = $this->Scheme_Model->get_website_data("under_construction");
			$under_construction_message = "";
			if($under_construction == 1)
			{
				$under_construction_message = "Android App Under Construction";
			}
		}
		$rating_bar_page = 0;

		$user_cart_items = $user_cart_items_other = "";
		if(!empty($api_key) && !empty($user_type) && !empty($user_altercode)) {

			$result = $this->MyCartModel->my_cart_api($user_type,$user_altercode,$user_password,$salesman_id,"all");
			$user_cart_items = $result["items"];
			$user_cart_items_other = $result["items_other"];
		}
		
		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'logout' => $logout,
			'versioncode' => $versioncode,
			'broadcast_title' => $broadcast_title,
			'broadcast_message' => $broadcast_message,
			'force_update' => $force_update,
			'force_update_title' => $force_update_title,
			'force_update_message' => $force_update_message,
			'under_construction' => $under_construction,
			'under_construction_message' => $under_construction_message,
			'rating_bar_page' => $rating_bar_page,
			'user_cart_items' => $user_cart_items,
			'user_cart_items_other' => $user_cart_items_other,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo "[".json_encode($response)."]";
	}

	public function home_page_api(){
		$this->load->model("model-drdistributor/top_menu/TopMenuModel");
		$this->load->model("model-drdistributor/slider_model/SliderModel");
		$this->load->model("model-drdistributor/medicine_division/MedicineDivisionModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineItemModel");

		if(!empty($_POST)){
			$api_key 		= $_POST["api_key"];
			$user_type 		= $_POST["user_type"];
			$user_altercode = $_POST["user_altercode"];
			$user_password	= $_POST["user_password"];
			$chemist_id 	= $_POST["chemist_id"];
			//$get_record	 	= $_POST["get_record"];
			$salesman_id 	= "";
			if($user_type=="sales")
			{
				$salesman_id 	= $user_altercode;
				$user_altercode = $chemist_id;
			}
			$session_yes_no = "yes";

			$category_id	= $_POST["category_id"];
			$page_type		= $_POST["page_type"];

			$items = $title = "";

			if($page_type=="top_menu"){
				$result = $this->TopMenuModel->get_top_menu_api();
				$items = $result["items"];
				$title  = "top menu";
			}

			if($page_type=="slider"){
				$result = $this->SliderModel->slider($category_id);
				$items = $result["items"];
				$title  = "slider";
			}

			if($page_type=="divisioncategory"){
				$result = $this->MedicineDivisionModel->medicine_division($category_id);
				$title  = $result["title"];
				$items = $result["items"];
			}

			if($page_type=="itemcategory"){
				$result = $this->MedicineItemModel->medicine_item($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id);
				$title  = $result["title"];
				$items = $result["items"];
			}
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
			'title' => $title,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo "[".json_encode($response)."]";
	}

	public function my_cart_api(){
		$this->load->model("model-drdistributor/my_cart/MyCartModel");
		
		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST["user_type"];
		$user_altercode = $_POST["user_altercode"];
		$user_password	= $_POST["user_password"];
		$chemist_id 	= $_POST["chemist_id"];
		//$get_record	 	= $_POST["get_record"];
		$salesman_id 	= "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$items = $get_record = "";
		if(!empty($api_key) && !empty($user_type) && !empty($user_altercode)) {

			$result = $this->MyCartModel->my_cart_api($user_type,$user_altercode,$user_password,$salesman_id,"all");
			$items = $result["items"];
			$items_other = $result["items_other"];
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
            'items_other' => $items_other
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo "[".json_encode($response)."]";
	}

	public function my_order_api(){
		$this->load->model("model-drdistributor/my_order/MyOrderModel");
		
		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST["user_type"];
		$user_altercode = $_POST["user_altercode"];
		$user_password	= $_POST["user_password"];
		$chemist_id 	= $_POST["chemist_id"];
		$get_record	 	= $_POST["get_record"];
		$salesman_id 	= "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$items = $get_record = "";
		if(!empty($user_type) && !empty($user_altercode)) {

			$result = $this->MyOrderModel->get_my_order_api($user_type,$user_altercode,$salesman_id,$get_record);
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
        echo "[".json_encode($response)."]";
	}

	public function my_order_details_api(){
		$this->load->model("model-drdistributor/my_order/MyOrderModel");
		
		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST["user_type"];
		$user_altercode = $_POST["user_altercode"];
		$user_password	= $_POST["user_password"];
		$chemist_id 	= $_POST["chemist_id"];
		$item_id	 	= $_POST["item_id"];
		$salesman_id 	= "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$items = $get_record = "";
		if(!empty($user_type) && !empty($user_altercode)&& !empty($item_id)){	

			$result = $this->MyOrderModel->get_my_order_details_api($user_type,$user_altercode,$salesman_id,$item_id);
			$items  	= $result["items"];
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo "[".json_encode($response)."]";
	}

	public function my_invoice_api(){
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");
		
		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST["user_type"];
		$user_altercode = $_POST["user_altercode"];
		$user_password	= $_POST["user_password"];
		$chemist_id 	= $_POST["chemist_id"];
		$get_record	 	= $_POST["get_record"];
		$salesman_id 	= "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$items = $get_record = "";
		if(!empty($user_type) && !empty($user_altercode)) {

			$result = $this->MyInvoiceModel->get_my_invoice_api($user_type,$user_altercode,$salesman_id,$get_record);
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
        echo "[".json_encode($response)."]";
	}

	public function my_invoice_details_api(){
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");
		
		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST["user_type"];
		$user_altercode = $_POST["user_altercode"];
		$user_password	= $_POST["user_password"];
		$chemist_id 	= $_POST["chemist_id"];
		$item_id	 	= $_POST["item_id"];
		$salesman_id 	= "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$items = $get_record = "";
		if(!empty($user_type) && !empty($user_altercode)&& !empty($item_id)){	

			$result = $this->MyInvoiceModel->get_my_invoice_details_api($user_type,$user_altercode,$salesman_id,$item_id);
			$items  		= $result["items"];
			$items_edit  	= $result["items_edit"];
			$items_delete  	= $result["items_delete"];
			$download_url  	= $result["download_url"];
			$header_title	= $result["header_title"];
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
			'items_edit' => $items_edit,
			'items_delete' => $items_delete,
			'download_url' => $download_url,
			'header_title' => $header_title,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo "[".json_encode($response)."]";
	}

	public function my_notification_api(){
		$this->load->model("model-drdistributor/my_notification/MyNotificationModel");
		
		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST["user_type"];
		$user_altercode = $_POST["user_altercode"];
		$user_password	= $_POST["user_password"];
		$chemist_id 	= $_POST["chemist_id"];
		$get_record	 	= $_POST["get_record"];
		$salesman_id 	= "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$items = $get_record = "";
		if(!empty($user_type) && !empty($user_altercode)) {

			$result = $this->MyNotificationModel->get_my_notification_api($user_type,$user_altercode,$salesman_id,$get_record);
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
        echo "[".json_encode($response)."]";
	}

	public function my_notification_details_api(){
		$this->load->model("model-drdistributor/my_notification/MyNotificationModel");
		
		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST["user_type"];
		$user_altercode = $_POST["user_altercode"];
		$user_password	= $_POST["user_password"];
		$chemist_id 	= $_POST["chemist_id"];
		$item_id	 	= $_POST["item_id"];
		$salesman_id 	= "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$items = $get_record = "";
		if(!empty($user_type) && !empty($user_altercode)&& !empty($item_id)){	

			$result = $this->MyNotificationModel->get_my_notification_details_api($user_type,$user_altercode,$salesman_id,$item_id);
			$items  	= $result["items"];
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo "[".json_encode($response)."]";
	}

	public function medicine_search_api()
	{
		$this->load->model("model-drdistributor/medicine_search/MedicineSearchModel");

		$items = "";

		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST["user_type"];
		$user_altercode = $_POST["user_altercode"];
		$user_password	= $_POST["user_password"];
		$chemist_id 	= $_POST["chemist_id"];
		$salesman_id 	= "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}

		$keyword   				= $_POST['keyword'];
		$total_rec   			= $_POST['total_rec'];
		$checkbox_medicine 		= $_POST['checkbox_medicine'];
		$checkbox_company		= $_POST['checkbox_company'];
		$checkbox_out_of_stock	= $_POST['checkbox_out_of_stock'];
		$user_nrx  				= $_POST["user_nrx"];
		
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
        echo "[".json_encode($response)."]";
	}

	public function medicine_details_api()
	{
		$this->load->model("model-drdistributor/medicine_details/MedicineDetailsModel");

		$item_code		= $_POST["item_code"];
		$items = "";

		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST["user_type"];
		$user_altercode = $_POST["user_altercode"];
		$user_password	= $_POST["user_password"];
		$chemist_id 	= $_POST["chemist_id"];
		$salesman_id 	= "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}

		if(!empty($user_type) && !empty($user_altercode) && !empty($item_code)){
			
			$result = $this->MedicineDetailsModel->medicine_details_api($user_type,$user_altercode,$salesman_id,$item_code);
			$items = $result["items"];
		}
        
        $response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo "[".json_encode($response)."]";
	}

	public function medicine_add_to_cart_api()
	{
		$this->load->model("model-drdistributor/my_cart/MyCartModel");

		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST["user_type"];
		$user_altercode = $_POST["user_altercode"];
		$user_password	= $_POST["user_password"];
		$chemist_id 	= $_POST["chemist_id"];
		$salesman_id 	= "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}

		$order_type 			= "Android";
		$item_code				= $_POST["item_code"];
		$item_order_quantity	= $_POST["item_order_quantity"];
		$mobilenumber 			= $_POST["mobilenumber"];
		$modalnumber 			= $_POST["modalnumber"];
		$device_id 				= $_POST["device_id"];

		if(!empty($user_type) && !empty($user_altercode)){
			$excel_number = "";		
			$status = $this->MyCartModel->medicine_add_to_cart_api($user_type,$user_altercode,$salesman_id,$order_type,$item_code,$item_order_quantity,$mobilenumber,$modalnumber,$device_id,$excel_number);
			/*****************************************************/
		}

		if(!empty($user_type) && !empty($user_altercode)){
			$result = $this->MyCartModel->my_cart_api($user_type,$user_altercode,$user_password,$salesman_id,"all");
			$items = $result["items"];
			$items_other = $result["items_other"];
		}
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
            'items_other' => $items_other,
			'status'=>$status
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo "[".json_encode($response)."]";
	}

	public function medicine_delete_api(){
		$this->load->model("model-drdistributor/my_cart/MyCartModel");
		
		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST["user_type"];
		$user_altercode = $_POST["user_altercode"];
		$user_password	= $_POST["user_password"];
		$chemist_id 	= $_POST["chemist_id"];
		$item_code	 	= $_POST["item_code"];
		$salesman_id 	= "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$items = $user_cart_items = $user_cart_items_other = "";
		if(!empty($api_key) && !empty($user_type) && !empty($user_altercode)) {

			$result = $this->MyCartModel->medicine_delete_api($user_type,$user_altercode,$salesman_id,$item_code);
			$items = $result["items"];

			$result = $this->MyCartModel->my_cart_api($user_type,$user_altercode,$user_password,$salesman_id,"all");
			$user_cart_items = $result["items"];
			$user_cart_items_other = $result["items_other"];
		}

		$response = array(
            'success' => "1",
			'message' => 'Data delete successfully',
			'items' => $items,
			'user_cart_items' => $user_cart_items,
			'user_cart_items_other' => $user_cart_items_other,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo "[".json_encode($response)."]";
	}

	public function medicine_delete_all_api(){
		$this->load->model("model-drdistributor/my_cart/MyCartModel");
		
		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST["user_type"];
		$user_altercode = $_POST["user_altercode"];
		$user_password	= $_POST["user_password"];
		$chemist_id 	= $_POST["chemist_id"];
		//$get_record	 	= $_POST["get_record"];
		$salesman_id 	= "";
		if($user_type=="sales")
		{
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$items = "";
		if(!empty($api_key) && !empty($user_type) && !empty($user_altercode)) {

			$result = $this->MyCartModel->medicine_delete_all_api($user_type,$user_altercode,$salesman_id);
			$items = $result["items"];
		}

		$response = array(
            'success' => "1",
			'message' => 'Data delete successfully',
			'items' => $items,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo "[".json_encode($response)."]";
	}

	/******************salesman ke liya ha sirf************************ */

	public function select_chemist_api(){
		$this->load->model("model-drdistributor/select_chemist/SelectChemistModel");

		$items = "";
		if(!empty($_POST)){
			$api_key		= $_POST['api_key'];
			$user_type 		= $_POST["user_type"];
			$user_altercode = $_POST["user_altercode"];
			$user_password	= $_POST["user_password"];
			$keyword		= $_POST["keyword"];
			/*$chemist_id 	= $_POST["chemist_id"];
			$salesman_id 	= "";
			if($user_type=="sales")
			{
				$salesman_id 	= $user_altercode;
				$user_altercode = $chemist_id;
			}*/
			if(!empty($user_type) && !empty($user_altercode) && !empty($keyword))
			{
				$result = $this->SelectChemistModel->select_chemist_api($keyword);
				$items = $result["items"];
			}
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo "[".json_encode($response)."]";
	}

	public function salesman_my_cart_api(){
		$this->load->model("model-drdistributor/select_chemist/SelectChemistModel");
	
		$items = "";
		if(!empty($_POST)){
			$api_key		= $_POST['api_key'];
			$user_type 		= $_POST["user_type"];
			$user_altercode = $_POST["user_altercode"];
			$user_password	= $_POST["user_password"];
		
			if(!empty($user_type) && !empty($user_altercode))
			{
				$result = $this->SelectChemistModel->salesman_my_cart_api($user_type,$user_altercode);
				$items = $result["items"];
			}
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo "[".json_encode($response)."]";
	}
}
<?php 
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');
class Api01 extends CI_Controller {	

	public function get_create_new_api()
	{
		$this->load->model("model-drdistributor/account_model/AccountModel");

		$api_key		= $_POST['api_key'];
		$user_name 		= $_POST["user_name"];
		$phone_number 	= $_POST["phone_number"];
		if(!empty($api_key) && !empty($user_name) && !empty($phone_number))
		{
			$return = $this->AccountModel->get_create_new_api($user_name,$phone_number);
			$items = $return["items"];
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
	public function get_login_api()
	{
		$this->load->model("model-drdistributor/account_model/AccountModel");

		$api_key		= $_POST['api_key'];
		$user_name 		= $_POST['user_name'];
		$user_password 	= $_POST['user_password'];
		$firebase_token	= $_POST['firebase_token'];

		if(!empty($api_key) && !empty($user_name) && !empty($user_password))
		{
			$result = $this->AccountModel->get_login_api($user_name,$user_password,"");
			$items = $result["items"];
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

	public function get_logout_api()
	{
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

		$device_id  = $_POST["device_id"];
		if(!empty($api_key))
		{
			$this->db->query("delete from tbl_android_device_id where device_id='$device_id' and chemist_id='$user_altercode'  and user_type='$user_type'");
		}

		$response = array(
            'success' => "1",
			'message' => 'logout successfully',
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
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

			/********************************/ 
			$this->load->model("model-drdistributor/account_model/AccountModel");
			/********************************/ 
			$return = $this->AccountModel->check_nrx_user($user_altercode);
			$user_image = $return["user_image"];
			$user_nrx = $return["user_nrx"];
			$logout = $return["logout"]; 
			if($user_type=="sales") { 
				$logout = 0;
			}
			/********************************/ 
			
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
			$clear_database = 0;
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

		$jsonArray = array();
		$dt = array(
			'user_image' => $user_image,
			'user_nrx' => $user_nrx,
			'logout' => $logout,
			'versioncode' => $versioncode,
			'force_update' => $force_update,
			'force_update_title' => $force_update_title,
			'force_update_message' => $force_update_message,
			'broadcast_status' => $broadcast_status,
			'broadcast_title' => $broadcast_title,
			'broadcast_message' => $broadcast_message,			
			'under_construction' => $under_construction,
			'under_construction_message' => $under_construction_message,
			'rating_bar_page' => $rating_bar_page,
		);
		$jsonArray[] = $dt;
		$items = $jsonArray;

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
			'user_cart_items' => $user_cart_items,
			'user_cart_items_other' => $user_cart_items_other,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function get_top_menu_api(){
		$items = "";
		
		if(!empty($_POST)){
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
			$session_yes_no = "yes";
			
			$this->load->model("model-drdistributor/top_menu/TopMenuModel");

			$result = $this->TopMenuModel->get_top_menu_api();
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

	public function home_page_api(){
		$this->load->model("model-drdistributor/slider_model/SliderModel");
		$this->load->model("model-drdistributor/medicine_division/MedicineDivisionModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineItemModel");
		$this->load->model("model-drdistributor/my_invoice/MyInvoiceModel");
		$this->load->model("model-drdistributor/my_notification/MyNotificationModel");

		if(!empty($_POST)){
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
			$session_yes_no = "yes";

			$seq_id  = $_POST["seq_id"];
		
			$title = $category_id = $page_type = $items = $next_id = "";
			$tbl_home = $this->db->query("select * from tbl_home where status=1 and seq_id in ($seq_id) ")->result();
			foreach($tbl_home as $row){
				$category_id = $row->category_id;
				
				if($row->type=="slider"){
					$result = $this->SliderModel->slider($row->category_id);
					$items = $result["items"];
					$title  = 'slider';
				}
				
				if($row->type=="menu"){
					$result = $this->HomeMenuModel->get_menu_api();
					$items = $result["items"];
					$title  = 'menu';				
				}

				if(!empty($user_type) && !empty($user_altercode) && $row->type=="notification") {

					$result = $this->MyNotificationModel->get_my_notification_api($user_type,$user_altercode,$salesman_id,"0","3");
					$items    = $result["items"];
					$title  = 'notification';
				}

				if(!empty($user_type) && !empty($user_altercode) && $row->type=="invoice") {

					$result = $this->MyInvoiceModel->get_my_invoice_api($user_type,$user_altercode,$salesman_id,"0","3");
					$items    = $result["items"];
					$title  = 'invoice';
				}
				
				if($row->type=="divisioncategory"){
					$result = $this->MedicineDivisionModel->medicine_division($category_id);
					
					$title  = $result["title"];
					$items = $result["items"];
				}
				
				if($row->type=="itemcategory"){
					$result = $this->MedicineItemModel->medicine_item($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id);
					$title  = $result["title"];
					$items = $result["items"];
				}

				$page_type = $row->type;
				$next_id = $row->seq_id + 1;
			
				if($next_id<=5){
					$next_id = 6;
				}

				$dt = array(
					'title' => $title,
					'category_id' => $category_id,
					'page_type' => $page_type,
					'next_id' => $next_id,
					'items' => $items,
				);
				$myitems[] = $dt;
			}
		}

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $myitems,
		);

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
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
		$items = $items_other = "";
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
        echo json_encode($response);
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
		$items = "";
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
        echo json_encode($response);
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
		$items = "";
		if(!empty($user_type) && !empty($user_altercode)&& !empty($item_id)){	

			$result = $this->MyOrderModel->get_my_order_details_api($user_type,$user_altercode,$salesman_id,$item_id);
			$items  	= $result["items"];
			$title  	= $result["title"];
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
			'title' => $title,
            'items' => $items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
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
		$items = "";
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
        echo json_encode($response);
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
		$items = "";
		if(!empty($user_type) && !empty($user_altercode)&& !empty($item_id)){	

			$result = $this->MyInvoiceModel->get_my_invoice_details_api($user_type,$user_altercode,$salesman_id,$item_id);
			$items  		= $result["items"];
			$items_edit  	= $result["items_edit"];
			$items_delete  	= $result["items_delete"];
			$download_url  	= $result["download_url"];
			$title	= $result["title"];
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
		$items = "";
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
        echo json_encode($response);
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
		$items = $title = "";
		if(!empty($user_type) && !empty($user_altercode)&& !empty($item_id)){	

			$result = $this->MyNotificationModel->get_my_notification_details_api($user_type,$user_altercode,$salesman_id,$item_id);
			$items  	= $result["items"];
			$title  	= $result["title"];
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
			'title' => $title,
            'items' => $items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
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
        echo json_encode($response);
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
        echo json_encode($response);
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
			$result = $this->MyCartModel->medicine_add_to_cart_api($user_type,$user_altercode,$salesman_id,$order_type,$item_code,$item_order_quantity,$mobilenumber,$modalnumber,$device_id,$excel_number);
			$status = $result["status"];
			$status_message = $result["status_message"];
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
			'status'=>$status,
			'status_message'=>$status_message,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
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
		if(!empty($api_key) && !empty($user_type) && !empty($user_altercode) && !empty($item_code)) {

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
        echo json_encode($response);
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
        echo json_encode($response);
	}

	public function place_order_api()
	{
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

		$remarks 		= $_POST["remarks"];			
		$latitude		= $_POST["latitude"];
		$longitude		= $_POST["longitude"];
		$mobilenumber	= $_POST["mobilenumber"];
		$modalnumber	= $_POST["modalnumber"];
		$device_id		= $_POST["device_id"];
		
		if(!empty($api_key) &&!empty($user_type) &&!empty($user_altercode) &&!empty($user_password)){
			$result = $this->MyCartModel->place_order_api($user_type,$user_altercode,$user_password,$salesman_id,"Android",$remarks);
			$status = $result["status"];
			$status_message = $result["status_message"];
		}

		$jsonArray = array();
		$dt = array(
			'status'=>$status,
			'status_message'=>$status_message,
		);
		$jsonArray[] = $dt;
		$items = $jsonArray;

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	/******************user account************************ */
	public function get_user_account_api()
	{
		$this->load->model("model-drdistributor/user_model/UserModel");
		
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

		if(!empty($user_type) && !empty($user_altercode))
		{
			$return = $this->UserModel->get_user_account_api($user_type,$user_altercode,$salesman_id);
			$items = $return["items"];
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

	public function get_new_user_account_api()
	{
		$this->load->model("model-drdistributor/user_model/UserModel");
		
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

		if(!empty($user_type) && !empty($user_altercode))
		{
			$return = $this->UserModel->get_new_user_account_api($user_type,$user_altercode);
			$items = $return["items"];
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

	public function update_user_account_api()
	{
		$this->load->model("model-drdistributor/user_model/UserModel");
		
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
		
		$user_phone 	= $_POST['user_phone'];
		$user_email 	= $_POST['user_email'];
		$user_address 	= $_POST['user_address'];
		if(!empty($user_type) && !empty($user_altercode))
		{
			$return = $this->UserModel->update_user_account_api($user_type,$user_altercode,$user_phone,$user_email,$user_address);
			$items = $return["items"];
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

	public function update_user_upload_image_api()
	{
		$this->load->model("model-drdistributor/user_model/UserModel");

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
		if(!empty($user_type) && !empty($user_altercode) && !empty($_FILES))
		{
			$return = $this->UserModel->update_user_upload_image_api($user_type,$user_altercode,$salesman_id,$_FILES);
			$items = $return["items"];
		}

		$response = array(
			'success' => "1",
			'message' => 'Data uploaded successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function update_password_api()
	{
		$this->load->model("model-drdistributor/user_model/UserModel");
		
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
		
		$old_password   = $_POST['old_password'];
		$new_password   = $_POST['new_password'];
		if(!empty($user_type) && !empty($user_altercode) && !empty($old_password) && !empty($new_password))
		{
			$return = $this->UserModel->update_password_api($user_type,$user_altercode,$old_password,$new_password);
			$items = $return["items"];
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

	public function medicine_category_api(){

		$this->load->model("model-drdistributor/medicine_category/MedicineCategoryModel");
		
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
		$session_yes_no = "yes";

		$item_page_type	= $_POST["item_page_type"];
		$item_code		= $_POST['item_code'];
		$item_division	= $_POST['item_division'];
		$get_record		= $_POST['get_record'];
		if($item_page_type!="")
		{
			if($item_page_type=="medicine_category")
			{
				$result = $this->MedicineCategoryModel->medicine_category_api($session_yes_no,$item_code,$get_record);
				$items  = $result["items"];
				$title  = $result["title"];
				$get_record  = $result["get_record"];
			}

			if($item_page_type=="featured_brand")
			{
				$result = $this->MedicineCategoryModel->featured_brand_api($session_yes_no,$item_code,$item_division,$get_record);
				$items  = $result["items"];
				$title  = $result["title"];
				$get_record  = $result["get_record"];
			}

			if($item_page_type=="itemcategory"){
				$this->load->model("model-drdistributor/medicine_item/MedicineItemModel");
				$category_id = $item_code;//yha sahi ha yaha par yha category_id ban jata ha

				/*****************************/
				$show_out_of_stock="1";
				$limit="12";
				$order_by_type="id";
				/*****************************/

				$result = $this->MedicineItemModel->medicine_item($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id,$show_out_of_stock,$get_record,$limit,$order_by_type);
				$items = $result["items"];
				$title  = $result["title"];
				$get_record  = $result["get_record"];
			}

			if($item_page_type=="medicine_similar")
			{
				$items = $this->Chemist_Model->medicine_similar_api($item_code,$get_record);
			}	
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'title' => $title,
			'get_record' => $get_record,
            'items' => $items,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
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
        echo json_encode($response);
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
        echo json_encode($response);
	}

	/******************main pages api************************ */

	public function terms_of_services_api(){
		$page_data = $this->Scheme_Model->get_website_data("terms_of_services");
	
		$jsonArray = array();
		$dt = array(
			'page_data'=>$page_data,
		);
		$jsonArray[] = $dt;
		$items = $jsonArray;

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function privacy_policy_api(){
		$page_data = $this->Scheme_Model->get_website_data("privacy_policy");
	
		$jsonArray = array();
		$dt = array(
			'page_data'=>$page_data,
		);
		$jsonArray[] = $dt;
		$items = $jsonArray;

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
        echo json_encode($response);
	}

	/******************ratingbar pages api************************ */
	public function ratingbar_done_api()
	{
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
		
		$device_id	= $_POST['device_id'];
		$rating 	= $_POST['rating'];
		if(!empty($api_key))
		{
			$this->db->query("update tbl_android_device_id set rating='$rating' where device_id='$device_id'");
		}

		$status = 1;
		$status_message = "working";

		$jsonArray = array();
		$dt = array(
			'status'=>$status,
			'status_message'=>$status_message,
		);
		$jsonArray[] = $dt;
		$items = $jsonArray;

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	public function ratingbar_review_api()
	{
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
		
		$device_id	= $_POST['device_id'];
		$review 	= $_POST['review'];
		if(!empty($api_key))
		{
			$this->db->query("update tbl_android_device_id set review='$review' where device_id='$device_id'");
		}

		$status = 1;
		$status_message = "Thank You To Sending Your Rating & Review";

		$jsonArray = array();
		$dt = array(
			'status'=>$status,
			'status_message'=>$status_message,
		);
		$jsonArray[] = $dt;
		$items = $jsonArray;

		$response = array(
			'success' => "1",
			'message' => 'Data load successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function test_notification()
	{
		//error_reporting(0);
		define('API_ACCESS_KEY', 'AAAAdZCD4YU:APA91bFjmo0O-bWCz2ESy0EuG9lz0gjqhAatkakhxJmxK1XdNGEusI5s_vy7v7wT5TeDsjcQH0ZVooDiDEtOU64oTLZpfXqA8EOmGoPBpOCgsZnIZkoOLVgErCQ68i5mGL9T6jnzF7lO');

		$id = "3050";
		$title = "xx";
		$message = "xx";
		$funtype = "0";
		$itemid = "xx";
		$division = "xx";
		$company_full_name = "xx";
		$image = "xx";

		
		echo $token = $_POST["token"];

		//$token = "emzHfsBsC6g:APA91bHOcEPNpdHVJJyYuZzSjG8tJiD86qJQl0zqu3oanJvmBDMlQo9xg_3x-2rQ3yCQpDvOW3dAA0Z8IgNvWzs14kJIiyEKrMQ4UEMbunAGID6z3BKcWPl09jUigZGPZa6AxbA7OpoB";
		$data = array
		(
			'id'=>$id,
			'title'=>$title,
			'message'=>$message,
			'funtype'=>$funtype,
			'itemid'=>$itemid,
			'division'=>$division,
			'company_full_name'=>$company_full_name,
			'image'=>$image,
		);
		//print_r($data);
			
		$fields = array
		(
			'to'=>$token,
			'data'=>$data,
			"priority"=>"high",
		);
		$headers = array
		(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);
		#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,'https://fcm.googleapis.com/fcm/send');
		curl_setopt($ch,CURLOPT_POST,true);
		curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($fields));
		$respose = curl_exec($ch);
		
		echo $respose;
		curl_close($ch);
	}
}
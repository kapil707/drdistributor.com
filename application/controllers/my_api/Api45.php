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

	public function home_page_api()
	{
		$api_key 		= $_POST["api_key"];
		$phone_type 	= $_POST["phone_type"];
		$firebase_token = $_POST["firebase_token"];
		$device_id		= $_POST["device_id"];
		$user_type 		= $_POST["user_type"];
		$user_altercode	= $_POST["user_altercode"];
		$user_password	= $_POST["user_password"];
		$chemist_id		= $_POST["chemist_id"];
		
		$versioncode	= $_POST["versioncode"];
		$getlatitude	= $_POST['getlatitude'];
		$getlongitude	= $_POST['getlongitude'];
		$gettime		= $_POST['gettime'];
		$getdate		= $_POST['getdate'];
		
		if(!empty($api_key))
		{
			$login = $this->Chemist_Model->login($user_altercode,$user_password);
			$time			= time();
			$date			= date("Y-m-d");
			
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
			/***************broadcast message********************/
			$broadcast_status = $this->Scheme_Model->get_website_data("broadcast_status");
			$broadcast = $broadcast_title = "";
			if($broadcast_status=="1")
			{
				$broadcast_title = $this->Scheme_Model->get_website_data("broadcast_title");
				$broadcast = $this->Scheme_Model->get_website_data("broadcast_message");
				$broadcast_title = base64_encode($broadcast_title);
				$broadcast = base64_encode($broadcast);
			}
			
			/***************versioncode kya ha wo yaha say ata ha********************/
			$versioncode 	= $this->Scheme_Model->get_website_data("android_versioncode");
			
			
			/*****************update ke liya code*********************/
			$force_update 			= $this->Scheme_Model->get_website_data("force_update");
			$force_update_title 	= $this->Scheme_Model->get_website_data("force_update_title");
			$force_update_message	= $this->Scheme_Model->get_website_data("force_update_message");			
			$force_update_title 	= base64_encode($force_update_title);
			$force_update_message 	= base64_encode($force_update_message);			
						
			/************notificaion ke status ata ha**************************/
			$android_noti = 0;
			if($user_type == "chemist")
			{
				$where1= array('user_type'=>$user_type,'chemist_id'=>$user_altercode,'status'=>'0',);
				$row = $this->Scheme_Model->select_row("tbl_android_notification",$where1);
				if(!empty($row->id))
				{
					$android_noti = 1;
				}
			}
			
			/*******************website_menu_json*******************/
			$menu_json = $this->Chemist_Model->website_menu_json_new();
			$menu_json = "[$menu_json]";
			
			/*******************featured_brand_json******************/
			$medicine_title0 = "Our top brands";
			$medicine_json0 = $this->Chemist_Model->featured_brand_json_new();
			$medicine_json0 = "[$medicine_json0]";
			
			/**********************hot_selling_today_json************/
			$medicine_json1 = $this->Chemist_Model->new_medicine_this_month_json_new();
			$medicine_json1 = "[$medicine_json1]";
			
			/**********************must_buy_medicines_json************/
			$medicine_json2 = $this->Chemist_Model->hot_selling_today_json_new();
			$medicine_json2 = "[$medicine_json2]";
			/**********************short_medicines_available_now_json******/
			$medicine_json3 = $this->Chemist_Model->must_buy_medicines_json_new();
			$medicine_json3 = "[$medicine_json3]";
			/**********************new 5 number box************/
			$medicine_json4 = $this->Chemist_Model->frequently_use_medicines_json_new();
			$medicine_json4 = "[$medicine_json4]";
			/***************************************************/
			/**********************new 5 number box************/
			$medicine_json5 = $this->Chemist_Model->stock_now_available();
			$medicine_json5 = "[$medicine_json5]";
			/***************************************************/
			/**********************new 6 number box************/
			$salesman_id = "";
			if($user_type=="sales")
			{
				$salesman_id 	= $user_altercode;
				$user_altercode = $chemist_id;
			}
			$medicine_json6 = $this->Chemist_Model->user_top_search_items($user_type,$user_altercode,$salesman_id);
			$medicine_json6 = "[$medicine_json6]";
			/***************************************************/
			
			/***************Under Construction**********************/
			$under_construction = $this->Scheme_Model->get_website_data("under_construction");
			$under_construction_message = "";
			if($under_construction == 1)
			{
				$under_construction_message = "Android App Under Construction";
			}
			$under_construction_message = base64_encode($under_construction_message);
			$salesman_id = "";
			if($user_type=="sales")
			{
				$salesman_id 	= $user_altercode;
				$user_altercode = $chemist_id;
			}
			$val = $this->Order_Model->my_cart_api($user_type,$user_altercode,$user_password,$salesman_id,"all","android");
			$user_cart_json0 = $val[0];
			$user_cart_json1 = $val[1];
			$user_cart_json0 = "[$user_cart_json0]";
			$user_cart_json1 = "[$user_cart_json1]";
			
$items .= <<<EOD
{"logout":"{$logout}","user_cart_json0":$user_cart_json0,"user_cart_json1":$user_cart_json1,"broadcast_title":"{$broadcast_title}","broadcast":"{$broadcast}","versioncode":"{$versioncode}","force_update":"{$force_update}","force_update_title":"{$force_update_title}","force_update_message":"{$force_update_message}","under_construction":"{$under_construction}","under_construction_message":"{$under_construction_message}","ratingbarpage":"{$ratingbarpage}","android_noti":"{$android_noti}","medicine_title0":"{$medicine_title0}","menu_json":$menu_json,"medicine_json0":$medicine_json0,"medicine_json1":$medicine_json1,"medicine_json2":$medicine_json2,"medicine_json3":$medicine_json3,"medicine_json4":$medicine_json4,"medicine_json5":$medicine_json5,"medicine_json6":$medicine_json6},
EOD;
if ($items != '') {
	$items = substr($items, 0, -1);
}
		}
?>
[<?= $items;?>]
<?php
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
		$items = $get_record = "";
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
}
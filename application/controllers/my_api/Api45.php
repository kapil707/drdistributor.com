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

	public function my_cart_api(){
		$this->load->model("model-drdistributor/my_cart/MyCartModel");
		
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
}
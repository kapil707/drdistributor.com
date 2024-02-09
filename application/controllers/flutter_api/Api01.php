<?php 
header("Content-type: application/json; charset=utf-8");
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit','-1');
ini_set('post_max_size','500M');
ini_set('upload_max_filesize','500M');
ini_set('max_execution_time',36000);
class Api01 extends CI_Controller {	
	
	 public function __construct(){

		parent::__construct();

		// Load model
		$this->load->model("LoginModel");
		$this->load->model("MedicineSearchModel");
		$this->load->model("SliderModel");
	}

	public function login_api()
	{
		$api_key		= $_POST['api_key'];
		$user_name 		= $_POST['user_name'];
		$user_password 	= $_POST['user_password'];
		
		if($api_key!="")
		{
			$items = $this->LoginModel->login($user_name,$user_password);
?>
{"items":[<?= $items;?>]}
<?php
		}
	}
	
	//new add on 2023-03-23
	public function home_page_api()
	{
	    $get_record	 	= "0";//$_REQUEST["get_record"];

		$user_type 		= "chemist";
		$user_altercode = "v153";
		$user_password	= "";

		$chemist_id 	= "";

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
	    
	    
	    $items = "";
		$tbl_home = $this->db->query("select * from tbl_home where status=1 order by seq_id asc")->result();
		foreach($tbl_home as $row){
			$category_id = $row->category_id;
			
			$row_dt = "[]";
			if($row->type=="slider"){
			    $top_flash = $this->SliderModel->slider($row->category_id);
		        $row_dt = '['.$top_flash.']';
			}
			
			if($row->type=="divisioncategory"){
			    $result = $this->Chemist_Model->medicine_division_wise_json_50($category_id);
				
				$row_title  = $result["title"];
		        $row_dt     = '['.$result["items"].']';
			}
			
			
			if($row->type=="itemcategory"){
				$result = $this->Chemist_Model->medicine_item_wise_json_50($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id);

				$row_title  = $result["title"];
		        $row_dt     = '['.$result["items"].']';
			}
            
            $items.= '{"result":"'.$row->type.'","row_title":"'.$row_title.'","row_dt":'.$row_dt.'},';
		}
		if ($items != '') {
			$items = substr($items, 0, -1);
		}
		
		/****************************************************** */
		echo $get_result = '['.$items.']'; 
	}
	
	public function medicine_search_api()
	{
		//98c08565401579448aad7c64033dcb4081906dcb
		
		$items = "";
		
		$api_key 		= $_POST["api_key"];
		$keyword 		= $_POST["keyword"];
		$device_id		= $_POST['device_id'];
		$user_type 		= $_POST['user_type'];
		$user_altercode = $_POST['user_altercode'];
		$user_password 	= $_POST['user_password'];
		$salesman_id 	= $_POST['salesman_id'];

		if($api_key!="")
		{	
			//yha variables ko abhi set karna ha 	
			$search_type = "all";
			$get_record = "25";
			$user_nrx = "yes";
			$total_rec = "all";
			$checkbox_medicine = "1";
			$checkbox_company = "1";
			$checkbox_out_of_stock = "1";
			if(!empty($keyword)){
				$items = $this->MedicineSearchModel->medicine_search_api_51($keyword,$search_type,$get_record,$user_nrx,$total_rec,$checkbox_medicine,$checkbox_company,$checkbox_out_of_stock);
			}
		}
?>
{"items":[<?= $items;?>]}<?php
	}

	public function medicine_details_api()
	{
		$api_key 		= $_POST["api_key"];
			
		$user_type 		= $_POST['user_type'];
		$user_altercode = $_POST['user_altercode'];
		$user_password 	= $_POST['user_password'];

		$chemist_id 	= $_POST['chemist_id'];
		$item_code 		= $_POST["item_code"];

		if($api_key)
		{
			$salesman_id = "";
			if($user_type=="sales")
			{
				$salesman_id 	= $user_altercode;
				$user_altercode	= $chemist_id;
			}

			$items = $this->Chemist_Model->medicine_details_api($user_type,$user_altercode,$salesman_id,$item_code);
		}
?>
{"items":[<?= $items;?>]}<?php
	}

	public function my_cart_api()
	{
		//https://drdweb.co.in/new_api/api_mobile41/my_cart_api/get?submit=98c08565401579448aad7c64033dcb4081906dcb&chemist_id=v153&user_type=chemist&user_password=f5bb0c8de146c67b44babbf4e6584cc0&salesman_id=0
		$items = "";
		$other_items = "";
		
		$api_key		= $_POST['api_key'];
		$device_id		= $_POST['device_id'];
		$user_type 		= $_POST['user_type'];
		$user_altercode = $_POST['user_altercode'];
		$user_password 	= $_POST['user_password'];
		$chemist_id 	= $_POST['chemist_id'];

		if($api_key)
		{
			$salesman_id = "";
			if($user_type=="sales")
			{
				$salesman_id 	= $user_altercode;
				$user_altercode = $chemist_id;
			}
			
			$val = $this->Order_Model->my_cart_api($user_type,$user_altercode,$user_password,$salesman_id,"all","android");
			$items = $val[0];
			$other_items = $val[1];
		}
?>
[{"items":[<?= $items;?>],"other_items":[<?= $other_items;?>]}]<?php
	}

	public function medicine_add_to_cart_api()
	{
		//https://drdweb.co.in/new_api/api_mobile41/medicine_add_to_cart_api/get?device_id=ok&user_altercode=v153&user_password=123123123&user_type=chemist&item_code=35&item_quantity=5&salesman_id=0&mobilenumber=0&modalnumber=i13&submit=98c08565401579448aad7c64033dcb4081906dcb
		$items = "";
		$status = "0";
		$user_cart_json0 = $user_cart_json1 = "";	
		
		$api_key				= $_POST['api_key'];
		$device_id				= $_POST['device_id'];
		$mobilenumber 			= $_POST['mobilenumber'];
		$modalnumber 			= $_POST['modalnumber'];

		$item_code 				= $_POST['item_code'];
		$item_order_quantity 	= $_POST['item_order_quantity'];
		$order_type 			= $_POST['order_type'];			

		$user_type 				= $_POST['user_type'];
		$user_altercode 		= $_POST['user_altercode'];
		$user_password  		= $_POST['user_password'];
		$chemist_id 			= $_POST['chemist_id'];

		$get_cart_list 			= $_POST['get_cart_list'];

		if($api_key)
		{
			$salesman_id = "";
			if($user_type=="sales")
			{
				$salesman_id 	= $user_altercode;
				$user_altercode	= $chemist_id;
			}

			if(!empty($item_order_quantity))
			{
				$excel_number = "";		
				$status = $this->Chemist_Model->medicine_add_to_cart_api($user_type,$user_altercode,$salesman_id,$order_type,$item_code,$item_order_quantity,$mobilenumber,$modalnumber,$device_id,$excel_number);
			}
			
			if($get_cart_list==1)
			{
				$val = $this->Order_Model->my_cart_api($user_type,$user_altercode,$user_password,$salesman_id,"all","android");
				$user_cart_json0 = $val[0];
				$user_cart_json1 = $val[1];
			}
		}
$items= <<<EOD
{"status":"{$status}"},
EOD;
if ($items != '') {
	$items = substr($items, 0, -1);
}
?>
{"items":[<?= $items;?>],"user_cart_json0":[<?= $user_cart_json0;?>],"user_cart_json1":[<?= $user_cart_json1;?>]}<?php
	}

	public function my_order_api()
	{
		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST['user_type'];
		$user_altercode	= $_POST['user_altercode'];
		$chemist_id		= $_POST['chemist_id'];
		$get_record	 	= $_POST["get_record"];

		if($api_key!="" && $user_type!="" && $user_altercode!="" && $get_record!="")
		{
			$salesman_id = "";
			if($user_type=="sales")
			{
				$salesman_id 	= $user_altercode;
				$user_altercode	= $chemist_id;
			}

			$items = $this->Chemist_Model->my_order_api($user_type,$user_altercode,$salesman_id,$get_record);
		}
?>
[{"items":[<?= $items;?>]}]<?php
	}
	
	public function my_order_details_api($page_type)
	{
		if($page_type=="get")
		{
			$submit 		= $_GET['submit'];
			$user_type 		= $_GET['user_type'];
			$user_altercode	= $_GET['user_altercode'];
			$chemist_id		= $_GET['chemist_id'];
			$item_id		= $_GET['item_id'];
		}
		if($page_type=="post")
		{
			$submit 		= $_POST['submit'];
			$user_type 		= $_POST['user_type'];
			$user_altercode	= $_POST['user_altercode'];
			$chemist_id		= $_POST['chemist_id'];
			$item_id		= $_POST['item_id'];
		}
		$submit1 = md5("my_sweet_login");
		$submit1 = sha1($submit1);
		$submit1 = md5($submit1);
		$submit1 = sha1($submit1);
		$submit1 = md5($submit1);
		$submit1 = sha1($submit1);		
		if($submit==$submit1 && $user_type!="" && $user_altercode!="" && $item_id!="")
		{
			$salesman_id = "";
			if($user_type=="sales")
			{
				$salesman_id 	= $user_altercode;
				$user_altercode	= $chemist_id;
			}

			$items = $this->Chemist_Model->my_order_details_api($user_type,$user_altercode,$salesman_id,$item_id);
		}
?>
[{"items":[<?= $items;?>]}]<?php
	}

	public function my_invoice_api()
	{
		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST['user_type'];
		$user_altercode	= $_POST['user_altercode'];
		$chemist_id		= $_POST['chemist_id'];
		$get_record	 	= $_POST["get_record"];

		if($api_key!="" && $user_type!="" && $user_altercode!="" && $get_record!="")
		{
			$salesman_id = "";
			if($user_type=="sales")
			{
				$salesman_id 	= $user_altercode;
				$user_altercode	= $chemist_id;
			}

			$items = $this->Chemist_Model->my_invoice_api($user_type,$user_altercode,$salesman_id,$get_record);
		}
?>
[{"items":[<?= $items;?>]}]<?php
	}

	
	public function my_invoice_details_api($page_type)
	{
		$items = $delete_items = $download_url = $header_title = "";
		if($page_type=="get")
		{
			$submit 		= $_GET['submit'];
			$user_type 		= $_GET['user_type'];
			$user_altercode	= $_GET['user_altercode'];
			$chemist_id		= $_GET['chemist_id'];
			$item_id		= $_GET['item_id'];
		}
		if($page_type=="post")
		{
			$submit 		= $_POST['submit'];
			$user_type 		= $_POST['user_type'];
			$user_altercode	= $_POST['user_altercode'];
			$chemist_id		= $_POST['chemist_id'];
			$item_id		= $_POST['item_id'];
		}
		$submit1 = md5("my_sweet_login");
		$submit1 = sha1($submit1);
		$submit1 = md5($submit1);
		$submit1 = sha1($submit1);
		$submit1 = md5($submit1);
		$submit1 = sha1($submit1);		
		if($submit==$submit1 && $user_type!="" && $user_altercode!="" && $item_id!="")
		{
			$salesman_id = "";
			if($user_type=="sales")
			{
				$salesman_id 	= $user_altercode;
				$user_altercode	= $chemist_id;
			}

			$val = $this->Chemist_Model->my_invoice_details_api($user_type,$user_altercode,$salesman_id,$item_id);

			$items			= $val[0];
			$delete_items 	= $val[1];
			$download_url 	= $val[2];
			$header_title 	= $val[3];
		}
?>
[{"items":[<?= $items;?>],"delete_items":[<?= $delete_items;?>],"download_url":[<?= $download_url;?>],"header_title":[<?= $header_title;?>]}]<?php
	}

	public function my_notification_api()
	{
		$api_key		= $_POST['api_key'];
		$user_type 		= $_POST['user_type'];
		$user_altercode	= $_POST['user_altercode'];
		$chemist_id		= $_POST['chemist_id'];
		$get_record	 	= $_POST["get_record"];

		if($api_key!="" && $user_type!="" && $user_altercode!="" && $get_record!="")
		{
			$salesman_id = "";
			if($user_type=="sales")
			{
				$salesman_id 	= $user_altercode;
				$user_altercode	= $chemist_id;
			}
			
			$items = $this->Chemist_Model->my_notification_api($user_type,$user_altercode,$salesman_id,$get_record);
		}
?>
[{"items":[<?= $items;?>]}]<?php
	}
	
	public function my_notification_details_api($page_type)
	{
		if($page_type=="get")
		{
			$submit 		= $_GET['submit'];
			$user_type 		= $_GET['user_type'];
			$user_altercode	= $_GET['user_altercode'];
			$chemist_id		= $_GET['chemist_id'];
			$item_id		= $_GET['item_id'];
		}
		if($page_type=="post")
		{
			$submit 		= $_POST['submit'];
			$user_type 		= $_POST['user_type'];
			$user_altercode	= $_POST['user_altercode'];
			$chemist_id		= $_POST['chemist_id'];
			$item_id		= $_POST['item_id'];
		}
		$submit1 = md5("my_sweet_login");
		$submit1 = sha1($submit1);
		$submit1 = md5($submit1);
		$submit1 = sha1($submit1);
		$submit1 = md5($submit1);
		$submit1 = sha1($submit1);		
		if($submit==$submit1 && $user_type!="" && $user_altercode!="" && $item_id!="")
		{
			$salesman_id = "";
			if($user_type=="sales")
			{
				$salesman_id 	= $user_altercode;
				$user_altercode	= $chemist_id;
			}

			$items = $this->Chemist_Model->my_notification_details_api($user_type,$user_altercode,$salesman_id,$item_id);
		}
?>
[{"items":[<?= $items;?>]}]<?php
	}
}
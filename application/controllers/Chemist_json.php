<?php
header('Content-Type: application/json');
defined('BASEPATH') OR exit('No direct script access allowed');
class Chemist_json extends CI_Controller {		
	public function theme_set()
	{
		$items = "";
		$theme_set_css 	= $_POST["theme_set_css"];
		$theme_type 	= $theme_set_css;

		setcookie("theme_type", $theme_type, time() + (86400 * 30), "/");

		$status = "ok";
$items.=<<<EOD
{"status":"{$status}"},
EOD;
if ($items != '') {
	$items = substr($items, 0, -1);
}
?>
{"items":[<?= $items;?>]}<?php
	}

	public function create_new_api()
	{		
		//error_reporting(0);
		$chemist_code 	= $_POST["chemist_code"];
		$phone_number 	= $_POST["phone_number"];

		if($chemist_code!="" && $phone_number!="")
		{
			$items = $this->Chemist_Model->create_new($chemist_code,$phone_number);
		}
?>
{"items":[<?= $items;?>]}<?php
	}
	
	// done or check 21-02-16
	public function login(){
		//error_reporting(0);
		$user_name1 = $_POST["user_name1"];
		$password1	= $_POST["password1"];
		$submit 	= "98c08565401579448aad7c64033dcb4081906dcb";
		
		header('Content-Type: application/json');
		$items = $this->Chemist_Model->login($user_name1,$password1);
		$someArray = json_decode($items, true);
		
		$user_return 	= "user_return";
		$user_session 	= "user_session";
		$user_fname 	= "user_fname";
		$user_code 		= "user_code";
		$user_altercode = "user_altercode";
		$user_type 		= "user_type";
		$user_password 	= "user_password";
		$user_division 	= "user_division";
		$user_compcode 	= "user_compcode";
		$user_image 	= "user_image";
		$user_nrx 		= "user_nrx";
		if($someArray[$user_return]=="1")
		{
			$ret = $this->Chemist_Model->insert_value_on_session($someArray[$user_session],$someArray[$user_fname],$someArray[$user_code],$someArray[$user_altercode],$someArray[$user_type],$someArray[$user_password],$someArray[$user_division],$someArray[$user_compcode],$someArray[$user_image],$someArray[$user_nrx]);

			$user_type 		= $someArray[$user_type];
			$user_altercode = $someArray[$user_altercode];
			$user_password	= $someArray[$user_password];	
			
			setcookie("chemist_id", "", time() + (86400 * 30), "/");

			$chemist_id 	= $_COOKIE["chemist_id"];

			$salesman_id = "";
			if($user_type=="sales")
			{
				$salesman_id 	= $user_altercode;
				$user_altercode = $chemist_id;
			}
			
			$user_cart_total = $this->Chemist_Model->count_temp_rec($user_type,$user_altercode,$salesman_id);

			setcookie("user_cart_total", $user_cart_total, time() + (86400 * 30), "/");
		}
		else{
			$ret=1;
		}
		if($ret==1)
		{
?>
{"items":[<?= $items;?>]}<?php
		}
	}

	public function chemist_search_api()
	{
		//error_reporting(0);
		$items = "";
		$user_type 		= $_COOKIE['user_type'];
		$user_altercode	= $_COOKIE['user_altercode'];
		$keyword 		= $_REQUEST["keyword"];
		if($keyword!="")
		{
			$items = $this->Chemist_Model->chemist_search_api($user_type,$user_altercode,$keyword);
		}
?>
{"items":[<?= $items;?>]}<?php
	}
	
	public function medicine_search_api()
	{
		$items = "";
		$keyword	= $_REQUEST['keyword'];
		if(!empty($keyword))
		{
			$items = $this->Chemist_Model->medicine_search_api($keyword);
		}
?>
{"items":[<?= $items;?>]}<?php
	}

	public function medicine_search_api_50()
	{
		$items = "";
		$keyword	= $_REQUEST['keyword'];
		if(!empty($keyword))
		{
			$items = $this->Chemist_Model->medicine_search_api_50($keyword);
		}
?>
{"items":[<?= $items;?>]}<?php
	}
	
	public function medicine_search_api_51()
	{
		$items = "";
		$keyword   			= $_REQUEST['keyword'];
		$total_rec   		= $_REQUEST['total_rec'];
		$checkbox_medicine 	= $_REQUEST['checkbox_medicine_val'];
		$checkbox_company	= $_REQUEST['checkbox_company_val'];
		$checkbox_out_of_stock= $_REQUEST['checkbox_out_of_stock_val'];
		$user_nrx  			= $_COOKIE["user_nrx"];
		if(!empty($keyword))
		{
			$items = $this->Chemist_Model->medicine_search_api_51($keyword,"","",$user_nrx,$total_rec,$checkbox_medicine,$checkbox_company,$checkbox_out_of_stock);
		}
?>
{"items":[<?= $items;?>]}<?php
	}

	public function search_view_all_api()
	{
		$items = "";
		$keyword		= $_REQUEST['keyword'];
		$get_record		= $_POST['get_record'];
		if($keyword!="" && $get_record!="")
		{			
			$items = $this->Chemist_Model->medicine_search_api($keyword,"all",$get_record);
		}
?>
{"items":[<?= $items;?>]}<?php
	}

	public function medicine_details_api()
	{
		$item_code		= $_REQUEST["item_code"];
		
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

		if($user_type!="" && $user_altercode!="" && $item_code!=""){
			$items = $this->Chemist_Model->medicine_details_api($user_type,$user_altercode,$salesman_id,$item_code);
		}
		
?>
{"items":[<?= $items;?>]}<?php
	}

	public function medicine_add_to_cart_api()
	{
		$item_code				= $_REQUEST["item_code"];
		$item_order_quantity	= $_REQUEST["item_order_quantity"];

		
		$order_type 	= "pc_mobile";
		$mobilenumber 	= "";
		$modalnumber 	= "PC / Laptop";
		$device_id 		= "";
		
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

		if($user_type!="" && $user_altercode!=""){
			$excel_number = "";		
			$status = $this->Chemist_Model->medicine_add_to_cart_api($user_type,$user_altercode,$salesman_id,$order_type,$item_code,$item_order_quantity,$mobilenumber,$modalnumber,$device_id,$excel_number);
			
			/*****************************************************/
			$val = $this->Order_Model->my_cart_json_50($user_type,$user_altercode,$user_password,$salesman_id,"all");
			$items1 = $val[0];
			$items2 = $val[1];
			$user_cart_total = $val[2];
			
			setcookie("user_cart_total", $user_cart_total, time() + (86400 * 30), "/");
		}

$items= <<<EOD
{"status":"{$status}","user_cart_total":"{$user_cart_total}"},
EOD;
if ($items != '') {
	$items = substr($items, 0, -1);
}
?>
{"items":[<?= $items;?>],"items1":[<?= $items1;?>],"items2":[<?= $items2;?>]}<?php
	}
	public function delete_all_medicine_api(){
			
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
		if($user_type!="" && $user_altercode!=""){
			$status = $this->Chemist_Model->delete_all_medicine_api($user_type,$user_altercode,$salesman_id);
		}

$items= <<<EOD
{"status":"{$status}"},
EOD;
if ($items != '') {
	$items = substr($items, 0, -1);
}
?>
{"items":[<?= $items;?>]}<?php
	}

	public function delete_medicine_api(){

		$item_code 		= $_POST['item_code'];
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
		if($user_type!="" && $user_altercode!=""){
			$status = $this->Chemist_Model->delete_medicine_api($user_type,$user_altercode,$salesman_id,$item_code);
		}

$items= <<<EOD
{"status":"{$status}"},
EOD;
if ($items != '') {
	$items = substr($items, 0, -1);
}
?>
{"items":[<?= $items;?>]}<?php
	}
	
	public function salesman_my_cart_api(){
			
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode	= $_COOKIE["user_altercode"];
	
		$items = "";
		if($user_type!="" && $user_altercode!="")
		{
			$items = $this->Order_Model->salesman_my_cart_api($user_type,$user_altercode);
		}

?>
{"items":[<?= $items;?>]}<?php
	}

	public function my_cart_api(){
			
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id 	= $_COOKIE["chemist_id"];

		$salesman_id = "";
		if($user_type=="sales"){
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}

		$items = "";
		$other_items = "";
		if($user_altercode!="")
		{
			$val = $this->Order_Model->my_cart_json_50($user_type,$user_altercode,$user_password,$salesman_id,"all");
			$items = $val[0];
			$other_items = $val[1];
			$user_cart_total = $val[2];

			setcookie("user_cart_total", $user_cart_total, time() + (86400 * 30), "/");
		}

?>
{"items":[<?= $items;?>],"other_items":[<?= $other_items;?>]}<?php
	}
	
	public function my_cart_api2(){
			
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

		$items = "";
		$other_items = "";
		if($user_altercode!="")
		{
			$val = $this->Order_Model->my_cart_api($user_type,$user_altercode,$user_password,$salesman_id,"pc_mobile");
			$items = $val[0];
			$other_items = $val[1];
			$user_cart_total = $val[2];

			setcookie("user_cart_total", $user_cart_total, time() + (86400 * 30), "/");
		}

?>
{"items":[<?= $items;?>],"other_items":[<?= $other_items;?>]}<?php
	}
	
	public function check_login_function(){
		//error_reporting(0);
		$user_type 			= $_COOKIE["user_type"];
		$user_altercode		= $_COOKIE["user_altercode"];
		
		if($user_type=="chemist" && !empty($user_altercode))
		{
			$row = $this->db->query("select id from drd_login_time where user_altercode='$user_altercode' and user_type='$user_type'")->row();
			if(!empty($row->id))
			{
				$login_time = time();
				$update_time = date("YmdHi", strtotime("+15 minutes", $login_time));

				$this->db->query("update drd_login_time set login_time='$login_time',update_time='$update_time',online_status='1' where user_altercode='$user_altercode' and user_type='$user_type'");

				$download_invoice_url = "";
				$row1 = $this->db->query("select gstvno from tbl_invoice where altercode='$user_altercode' and download_status='0'")->row();
				if(!empty($row1->gstvno))
				{
					$gstvno = $row1->gstvno;
					$this->db->query("update tbl_invoice set download_status='1' where gstvno='$gstvno' and download_status='0'");
					$download_invoice_url = base_url() . "user/download_invoice1/" . $user_altercode . "/" . $gstvno;
				}

				$noti_id = $noti_title = $noti_message = $noti_time = "";
				if(empty($row1->id))
				{
					$row1 = $this->db->query("select id,title,message,time from tbl_android_notification where chemist_id='$user_altercode' and user_type='$user_type' and status='0' limit 1")->row();
					if(!empty($row1->id))
					{
						$noti_id 		= $row1->id;
						$noti_title 	= $row1->title;
						$noti_message 	= $row1->message;
						$noti_time 		= $row1->time;
					
						$this->db->query("update tbl_android_notification set status='1' where id='$noti_id'");
					}
				}
?>
{"items":[{"count":"","status":"0","noti_id":"<?= $noti_id ?>","noti_title":"<?= $noti_title ?>","noti_message":"<?= $noti_message ?>","noti_time":"<?= $noti_time ?>","download_invoice_url":"<?= $download_invoice_url ?>"}]}
<?php
			}
		}
	}
	
	public function my_order_api(){
		$get_record	 	= $_REQUEST["get_record"];

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
		
		if($user_type!="" && $user_altercode!="" && $get_record!="")
		{
			$result = $this->Chemist_Model->my_order_json_50($user_type,$user_altercode,$salesman_id,$get_record);

			$items  	= $result["items"];
			$title  	= $result["title"];
			$get_record = $result["get_record"];
		}
?>
{"get_result":[{"items":[<?= $items;?>]},{"title":"<?= $title;?>"},{"get_record":"<?= $get_record;?>"}]}<?php
	}
	
	// done or check 21-02-16
	public function my_order_details_api(){

		$item_id		= $_POST['item_id'];

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
		
		if($user_type!="" && $user_altercode!="" && $item_id!="")
		{
			$items = $this->Chemist_Model->my_order_details_api($user_type,$user_altercode,$salesman_id,$item_id);
		}
?>
{"items":[<?= $items;?>]}<?php
	}

	public function my_invoice_api(){
		$get_record	 	= $_REQUEST["get_record"];

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
		
		if($user_type!="" && $user_altercode!="" && $get_record!="")
		{
			$result = $this->Chemist_Model->my_invoice_json_50($user_type,$user_altercode,$salesman_id,$get_record);

			$items  	= $result["items"];
			$title  	= $result["title"];
			$get_record = $result["get_record"];
		}
?>
{"get_result":[{"items":[<?= $items;?>]},{"title":"<?= $title;?>"},{"get_record":"<?= $get_record;?>"}]}<?php
	}

	public function my_invoice_details_api(){
		$item_id	 	= $_REQUEST["item_id"];

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
		
		$items 			= "";
		$delete_items	= "";
		$download_url 	= "";
		if($user_type!="" && $user_altercode!="" && $item_id!="")
		{
			$val = $this->Chemist_Model->my_invoice_details_api($user_type,$user_altercode,$salesman_id,$item_id);

			$items			= $val[0];
			$edit_items 	= $val[4];
			$delete_items 	= $val[1];
			$download_url 	= $val[2];
			$header_title 	= $val[3];
		}
?>
{"items":[<?= $items;?>],"edit_items":[<?= $edit_items;?>],"delete_items":[<?= $delete_items;?>],"download_url":[<?= $download_url;?>],"header_title":[<?= $header_title;?>]}<?php
	}
	
	public function my_invoice_details_api2(){
		$item_id	 	= $_REQUEST["item_id"];
		$user_altercode = $_REQUEST["user_altercode"];

		$salesman_id 	= "";
		$user_type 		= "chemist";
		
		$items 			= "";
		$delete_items	= "";
		$download_url 	= "";
		if($user_type!="" && $user_altercode!="" && $item_id!="")
		{
			$val = $this->Chemist_Model->my_invoice_details_api($user_type,$user_altercode,$salesman_id,$item_id);

			$items			= $val[0];
			$edit_items 	= $val[4];
			$delete_items 	= $val[1];
			$download_url 	= $val[2];
			$header_title 	= $val[3];
		}
?>
{"items":[<?= $items;?>],"edit_items":[<?= $edit_items;?>],"delete_items":[<?= $delete_items;?>],"download_url":[<?= $download_url;?>],"header_title":[<?= $header_title;?>]}<?php
	}
	
	// done or check 21-02-16
	public function my_notification_api(){
		$get_record	 	= $_REQUEST["get_record"];

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
		
		if($user_type!="" && $user_altercode!="" && $get_record!="")
		{
			$result = $this->Chemist_Model->my_notification_json_50($user_type,$user_altercode,$salesman_id,$get_record);

			$items  	= $result["items"];
			$title  	= $result["title"];
			$get_record  = $result["get_record"];
		}
?>
{"get_result":[{"items":[<?= $items;?>]},{"title":"<?= $title;?>"},{"get_record":"<?= $get_record;?>"}]}<?php
	}
	
	public function my_notification_details_api(){
		$item_id		= $_REQUEST['item_id'];

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
		
		if($user_type!="" && $user_altercode!="" && $item_id!="")
		{			
			$items = $this->Chemist_Model->my_notification_details_api($user_type,$user_altercode,$salesman_id,$item_id);
		}		
?>
{"items":[<?= $items;?>]}<?php
	}
	
	public function featured_brand_api(){

		$compcode	= $_POST['compcode'];
		$division	= $_POST['division'];
		$get_record	= $_POST['get_record'];
		
		if($compcode!="")
		{
			$items = $this->Chemist_Model->featured_brand_api($compcode,$division,$get_record);
?>
{"items":[<?= $items;?>]}<?php
		}
	}
	
	public function medicine_category_api(){
		$item_page_type	= $_POST["item_page_type"];
		$item_code		= $_POST['item_code'];
		$item_division	= $_POST['item_division'];
		$get_record		= $_POST['get_record'];
		
		if($item_page_type!="")
		{
			if($item_page_type=="medicine_category")
			{
				$result = $this->Chemist_Model->medicine_category_json_50($item_code,$get_record);
				$items  = $result["items"];
				$title  = $result["title"];
				$get_record  = $result["get_record"];
			}
			if($item_page_type=="featured_brand")
			{
				$result = $this->Chemist_Model->featured_brand_2_json_50($item_code,$item_division,$get_record);
				$items  = $result["items"];
				$title  = $result["title"];
				$get_record  = $result["get_record"];
			}

			if($item_page_type=="medicine_similar")
			{
				$items = $this->Chemist_Model->medicine_similar_api($item_code,$get_record);
			}

			/******************************************/
			
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
			if($item_page_type=="medicine_item_wise")
			{
				$category_id = $item_code;
				$result = $this->Chemist_Model->medicine_item_wise_json_50($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id);
				$items  = $result["items"];
				$title  = $result["title"];
			}
		}
?>
{"get_result":[{"items":[<?= $items;?>]},{"title":"<?= $title;?>"},{"get_record":"<?= $get_record;?>"}]}<?php
	}

	public function medicines_last_order_api(){

		$items = "";
		
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
		
		/*$result = $this->db->query("select DISTINCT image,item_name,id,i_code,quantity, COUNT(*) as ct FROM tbl_order where chemist_id='$user_altercode' and user_type='chemist' GROUP BY item_name HAVING COUNT(*) > 0 order by ct asc limit 10")->result();*/
		$result = $this->db->query("select DISTINCT i_code,image,item_name,quantity,COUNT(*) as ct FROM tbl_order where chemist_id='$user_altercode' and user_type='chemist' GROUP BY i_code,image,item_name,quantity HAVING COUNT(*) > 0 order by ct asc limit 10")->result();
		foreach($result as $row)
		{
			$item_code 		= ($row->i_code);
			$item_name 		= ucwords(strtolower($row->item_name));
			$quantity 		= ($row->quantity);
			$item_image 	= ($row->image);
			
$items.= <<<EOD
{"item_code":"{$item_code}","item_name":"{$item_name}","quantity":"{$quantity}","item_image":"{$item_image}"},
EOD;
        }
if ($items != '') {
	$items = substr($items, 0, -1);
}
?>
{"items":[<?= $items;?>]}<?php
    }

	public function user_account_api(){
		//error_reporting(0);
		$user_type 		= $_REQUEST['user_type'];
		$user_altercode	= $_REQUEST['user_altercode'];
		
		if($user_type!="" && $user_altercode!="")
		{
			$items = $this->Chemist_Model->user_account($user_type,$user_altercode);
		}
?>
{"items":[<?= $items;?>]}<?php
	}

	public function check_user_account_api(){
		//error_reporting(0);
		$user_type 		= $_POST['user_type'];
		$user_altercode	= $_POST['user_altercode'];
		
		if($user_type!="" && $user_altercode!="")
		{
			$items = $this->Chemist_Model->check_user_account($user_type,$user_altercode);
		}
?>
{"items":[<?= $items;?>]}<?php
	}

	public function update_user_account_api(){
		//error_reporting(0);
		$user_type		= $_POST['user_type'];
		$user_altercode = $_POST['user_altercode'];
		$user_phone 	= $_POST['user_phone'];
		$user_email 	= $_POST['user_email'];
		$user_address 	= $_POST['user_address'];
		
		if($user_type!="" && $user_altercode!="")
		{
			$items = $this->Chemist_Model->update_user_account($user_type,$user_altercode,$user_phone,$user_email,$user_address);
		}
?>
{"items":[<?= $items;?>]}<?php
	}

	public function user_image_upload()
	{
		//error_reporting(0);
		$items = "";
		$status = "Something Wrong";
		$status1 = 0;
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$image_path 	= $_FILES['image_path']['tmp_name'];
			$user_type 		= $_POST['user_type'];
			$user_altercode	= $_POST['user_altercode'];

			if($user_type=="chemist")
			{
				$where= array('altercode'=>$user_altercode,'slcd'=>'CL');
				$row = $this->Scheme_Model->select_row("tbl_acm",$where);
				$user_code = $row->code;
			}

			if($user_type=="sales")
			{
				$where= array('customer_code'=>$user_altercode);
				$row = $this->Scheme_Model->select_row("tbl_users",$where);
				$user_code = $row->customer_code;
			}
			
			if($user_code!="")
			{
				$img_name     = time()."_".$user_code."_".$user_type.".png";
				$user_profile = "user_profile/$img_name";			
				move_uploaded_file($image_path,$user_profile);
				
				if($user_type=="chemist")
				{
					$status1 = $this->db->query("update tbl_acm_other set image='$img_name' where code='$user_code'");
					$status = "Updated Successfully";
					$user_image = constant('user_profile')."user_profile/$img_name";
				
					setcookie("user_image", $user_image, time() + (86400 * 30), "/");
				}
				
				if($user_type=="sales")
				{
					$status1 = $this->db->query("update tbl_users_other set image='$img_name' where customer_code='$user_code'");
					$status = "Updated Successfully";
					$user_image = constant('user_profile')."user_profile/$img_name";

					setcookie("user_image", $user_image, time() + (86400 * 30), "/");
				}
			}
		}
$items .= <<<EOD
{"status":"{$status}","status1":"{$status1}","v":"{$v}"},
EOD;
if ($items != '') {
	$items = substr($items, 0, -1);
}
		?>
{"items":[<?= $items;?>]}<?php
	}

	public function check_old_password_api()
	{
		//error_reporting(0);
		$user_type		= $_POST['user_type'];
		$user_altercode = $_POST['user_altercode'];
		$old_password   = $_POST['old_password'];

		if($user_type!="" && $user_altercode!="" && $old_password!="")
		{
			$items = $this->Chemist_Model->check_old_password($user_type,$user_altercode,$old_password);
		}
?>
{"items":[<?= $items;?>]}<?php
	}

	public function change_password_api()
	{
		//error_reporting(0);
		$user_type		= $_POST['user_type'];
		$user_altercode = $_POST['user_altercode'];
		$old_password   = $_POST['old_password'];
		$new_password   = $_POST['new_password'];

		if($user_type!="" && $user_altercode!="" && $old_password!="" && $new_password!="")
		{
			$items = $this->Chemist_Model->change_password($user_type,$user_altercode,$old_password,$new_password);
		}
?>
{"items":[<?= $items;?>]}<?php
	}

	//new add on 2023-03-23
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
		
		$my_notification = "";
		if($user_type!="" && $user_altercode!="" && $get_record!="")
		{
			$result = $this->Chemist_Model->my_notification_json_50($user_type,$user_altercode,$salesman_id,$get_record);

			$my_notification  = $result["items"];
		}
		$my_notification = '{"my_notification":['.$my_notification.']}';

		/****************************************************** */
		$my_invoice = "";
		if($user_type!="" && $user_altercode!="" && $get_record!="")
		{
			$result = $this->Chemist_Model->my_invoice_json_50($user_type,$user_altercode,$salesman_id,$get_record);

			$my_invoice  = $result["items"];
		}
		$my_invoice = '{"my_invoice":['.$my_invoice.']}';
		
		$items = "";
		$tbl_home = $this->db->query("select * from tbl_home where status=1 order by seq_id asc")->result();
		foreach($tbl_home as $row){
			$category_id = $row->category_id;
			
			$result_row = "[]";
			if($row->type=="slider"){
			    if($row->category_id=="1"){
			        $top_flash = $this->Chemist_Model->top_flash();
			    }
			    if($row->category_id=="2"){
			        $top_flash = $this->Chemist_Model->top_flash2();
			    }
		        $result_row = '['.$top_flash.']';
			}
			
			if($row->type=="divisioncategory"){
			    $result = $this->Chemist_Model->medicine_division_wise_json_50($category_id);
				
				$row_title  = $result["title"];
		        $result_row     = '['.$result["items"].']';
			}
			
			
			if($row->type=="itemcategory"){
				$result = $this->Chemist_Model->medicine_item_wise_json_50($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id);

				$row_title  = $result["title"];
		        $result_row     = '['.$result["items"].']';
			}
            
            $items.= '{"result":"'.$row->type.'","result_id":"'.$row->id.'","result_category_id":"'.$row->category_id.'","result_title":"'.$row_title.'","result_row":'.$result_row.'},';
		}
		if ($items != '') {
			$items = substr($items, 0, -1);
		}
		
		/****************************************************** */
		echo $get_result = '{"get_result":['.$items.','.$my_notification.','.$my_invoice.']}'; 
	}
}
?>
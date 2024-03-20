<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MyNotificationModel extends CI_Model  
{
	public function __construct(){
		parent::__construct();
	}
	
	public function get_chemist_photo($user_altercode){
		$row = $this->db->query("SELECT tbl_acm_other.image from tbl_acm,tbl_acm_other where tbl_acm.altercode='$user_altercode' and tbl_acm.code = tbl_acm_other.code")->row();
		$user_image = base_url()."user_profile/$row->image";
		if(empty($row->image))
		{
			$user_image = base_url()."img_v51/logo.png";
		}
		return $user_image;
	}
	
	public function get_my_notification_api($user_type="",$user_altercode="",$salesman_id="",$get_record="",$limit="12") {
		
		$user_image = $this->get_chemist_photo($user_altercode);
		
		$jsonArray = array();
		
		$this->db->where('chemist_id',$user_altercode);
		$this->db->where('device_id','default');
		$this->db->order_by('id','desc');
		$this->db->limit($limit,$get_record);
		$query = $this->db->get("tbl_android_notification")->result();
		foreach($query as $row)
		{
			$get_record++;
			$item_id		=	$row->id;
			$item_title		=	($row->title);
			$item_message	=	($row->message);
			$item_message	=   str_replace("<br>"," ",$item_message);
			$item_date_time = date("d-M-y",strtotime($row->date))." @ ".date("h:i a",strtotime($row->time));
			$item_message	= 	substr($item_message, 0, 50)."....";
			
			$item_image = $user_image;
			
			$dt = array(
				'item_id' => $item_id,
				'item_title' => $item_title,
				'item_message' => $item_message,
				'item_date_time' => $item_date_time,
				'item_image' => $item_image,
			);
			$jsonArray[] = $dt;
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] 		= $jsonArray;
		$return["get_record"] 	= $get_record;
		return $return;
	}
	
	public function get_my_notification_details_api($user_type="",$user_altercode="",$salesman_id="",$item_id="") {
		
		$user_image = $this->get_chemist_photo($user_altercode);
		
		$jsonArray = array();
		
		$this->db->where('chemist_id',$user_altercode);
		$this->db->where('device_id','default');
		$this->db->where('id',$item_id);
		$this->db->order_by('id','desc');
		$this->db->limit(8);
		$query = $this->db->get("tbl_android_notification")->result();
		foreach($query as $row)
		{
			$title			=	($row->title);

			$item_id		=	$row->id;
			$item_title		=	($row->title);
			$item_message	=	($row->message);
			$item_date_time = date("d-M-y",strtotime($row->date))." @ ".date("h:i a",strtotime($row->time));
			$item_fun_type	= 	($row->funtype);
			$itemid			= 	($row->itemid);
			$compid			= 	($row->compid);
			$division		= 	($row->division);
			$item_image2	= 	$row->image;
			$item_fun_id = $item_fun_id2 = "";
			if(!empty($item_image2))
			{
				$item_image2 =   constant('img_url_site')."uploads/manage_notification/photo/resize/".$item_image2;
			}
			if($item_fun_type=="1")
			{
				$item_fun_name = "get_single_medicine_info";
				$item_fun_id   = $itemid;
			}
			if($item_fun_type=="2")
			{
				$item_fun_name = "featured_brand";
				$item_fun_id   = $compid;
				$item_fun_id2  = $division;
			}
			if($item_fun_type=="3")
			{
				$item_fun_name = "map";
			}
			if($item_fun_type=="4")
			{
				$item_fun_name = "my_order";
			}
			if($item_fun_type=="5")
			{
				$item_fun_name = "my_invoice";
			}
			
			$item_image = $user_image;

			$item_message = str_replace("\\n", "<br>", $item_message);
			$item_message = $this->new_clean($item_message);
			
			$dt = array(
				'item_id' => $item_id,
				'item_title' => $item_title,
				'item_message' => $item_message,
				'item_date_time' => $item_date_time,
				'item_image' => $item_image,
				'item_image2' => $item_image2,
				'item_fun_type' => $item_fun_type,
				'item_fun_name' => $item_fun_name,
				'item_fun_id' => $item_fun_id,
				'item_fun_id2' => $item_fun_id2,
			);
			$jsonArray[] = $dt;
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] 	= $jsonArray;
		$return["title"] 	= $title;
		return $return;
	}

	function new_clean($string)
	{
		$k = str_replace('\n', '<br>', $string);
		$k = preg_replace('/[^A-Za-z0-9\#]/', ' ', $k);
		return $k;
		//return preg_replace('/[^A-Za-z0-9\#]/', '', $string); // Removes special chars.
	}
}
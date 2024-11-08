<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MyBroadcastModel extends CI_Model  
{
	public function __construct(){
		parent::__construct();
	}

	public function get_my_broadcast_api($UserType,$ChemistId,$SalesmanId) {
				
		$jsonArray = array();
		
		$this->db->where('chemist_id',$ChemistId);
		$this->db->where('status',0);
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$query = $this->db->get("tbl_broadcast")->result();
		foreach($query as $row)
		{
			$item_id		=	$row->id;
			$item_title		=	($row->title);
			$item_message	=	($row->message);
			$item_message	=   str_replace("<br>"," ",$item_message);
			$item_date_time = 	date("d-M-y @ h:i A", $row->timestamp);
			//$item_message	= 	substr($item_message, 0, 50)."....";
			
			$dt 	= array('status'=>1);
			$where 	= array('id'=>$item_id);
			$this->Scheme_Model->edit_fun("tbl_broadcast",$dt,$where);

			$item_image = "";
			
			$dt = array(
				'item_id' => $item_id,
				'item_title' => $item_title,
				'item_message' => $item_message,
				'item_date_time' => $item_date_time,
				'item_image' => $item_image,
			);
			$jsonArray[] = $dt;
		}

		$broadcast_status = "1";//$this->Scheme_Model->get_website_data("broadcast_status");
		if($broadcast_status=="1"){
			$item_title 	= $this->Scheme_Model->get_website_data("broadcast_title");
			$item_message 	= $this->Scheme_Model->get_website_data("broadcast_message");
			$item_date_time = date("d-M-y @ h:i A", time());

			$item_id = 0;
			$item_image = "";

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
		return $return;
	}
}
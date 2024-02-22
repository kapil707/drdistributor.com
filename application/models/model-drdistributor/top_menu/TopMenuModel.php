<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class TopMenuModel extends CI_Model  
{
	public function __construct(){
		parent::__construct();
	}
	
	public function get_top_menu_api()
	{		
		$jsonArray = array();
		
		$items = "";
		$where = array('status'=>1,);
		$this->db->order_by("short_order","asc");
		$this->db->where($where);
		$query = $this->db->get("tbl_medicine_menu")->result();
		foreach ($query as $row)
		{
			$item_code		=	$row->code;
			$item_company	=	ucwords(strtolower($row->menu));
			$item_url		=	str_replace(" ","-",strtolower($item_company));
			$item_image		=  	constant('img_url_site')."uploads/manage_medicine_menu/photo/resize/".$row->image;
			if (empty($row->image)){
				$item_image 	= constant('img_url_site')."uploads/default_img.jpg";
			}
			
			$dt = array(
				'item_code' => $item_code,
				'item_company' => $item_company,
				'item_image' => $item_image,
				'item_url' => $item_url,
			);
			$jsonArray[] = $dt;
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		return $return;	
	}
}
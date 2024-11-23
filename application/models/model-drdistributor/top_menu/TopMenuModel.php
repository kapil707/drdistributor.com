<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class TopMenuModel extends CI_Model  
{
	var $MedicineImageUrl = "";
	public function __construct(){
		parent::__construct();
		$this->load->library('AppConfig');
		
		$this->MedicineImageUrl = $this->appconfig->getMedicineImageUrl();
	}
	
	public function get_top_menu_api()
	{		
		$jsonArray = array();
		
		$items = "";
		$where = array('status'=>1,'company_type'=>'menu');
		$this->db->order_by("short_order","asc");
		$this->db->where($where);
		$query = $this->db->get("tbl_company_division")->result();
		foreach ($query as $row)
		{
			$item_code		=	$row->company_code;
			$item_company	=	ucwords(strtolower($row->company_name));
			$item_url		=	str_replace(" ","-",strtolower($item_company));
			$item_image		=  	$this->MedicineImageUrl."uploads/manage_company_division/photo/resize/".$row->image;
			if (empty($row->image)){
				$item_image 	= $this->MedicineImageUrl."uploads/default_img.jpg";
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
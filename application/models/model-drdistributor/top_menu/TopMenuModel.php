<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class TopMenuModel extends CI_Model  
{
	var $MedicineImageUrl = "";
	public function __construct(){
		parent::__construct();

		$this->MedicineImageUrl = $this->appconfig->getMedicineImageUrl();
	}
	
	public function get_top_menu_api()
	{		
		$jsonArray = array();
		
		$items = "";
		$where = array('status'=>1,'company_type'=>'menu');
		$this->db->order_by("short_order","asc");
		$this->db->where($where);
		$query = $this->db->get("tbl_company_divisionxxx")->result();
		foreach ($query as $row)
		{
			$item_code		=	$row->comp_code;
			$item_company	=	ucwords(strtolower($row->menu));
			$item_url		=	str_replace(" ","-",strtolower($item_company));
			$item_image		=  	$this->MedicineImageUrl."uploads/manage_medicine_menu/photo/resize/".$row->image;
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
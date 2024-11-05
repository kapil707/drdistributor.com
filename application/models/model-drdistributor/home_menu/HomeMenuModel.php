<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class HomeMenuModel extends CI_Model  
{
	public function __construct(){
		parent::__construct();
	}
	
	public function get_menu_api()
	{		
		$jsonArray = array();
		
		$sameid = "";
		$this->db->select("*");
		$this->db->order_by("id","asc");
		$query = $this->db->get("tbl_menu")->result();
		foreach ($query as $row)
		{
			$url = base_url()."assets/".$this->appconfig->getWebJs()."/images/";
			
			$menu_id		=	$row->id;
			$menu_name		=	ucwords(strtolower($row->menu_name));
			$menu_image		=	$url.$row->menu_image;
			$menu_url		=	$row->menu_url;
			
			$dt = array(
				'menu_id' => $menu_id,
				'menu_name' => $menu_name,
				'menu_image' => $menu_image,
				'menu_url' => $menu_url,
			);
			$jsonArray[] = $dt;
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		return $return;	
	}
}
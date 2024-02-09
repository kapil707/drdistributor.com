<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');
ini_set('post_max_size', '100M');
ini_set('upload_max_filesize', '100M');
ini_set('max_execution_time', 36000);
require_once APPPATH."/third_party/PHPExcel.php";
class MenuModel extends CI_Model  
{ 	
	public function website_menu()
	{
		//error_reporting(0);
		$items = "";
		$i = 1;
		$image = "";
		$where = array('status'=>1,);
		$query = $this->Scheme_Model->select_all_result("tbl_medicine_menu",$where,"short_order","asc");
		foreach ($query as $row)
		{
			$code		=	$row->code;
			$name		=	base64_encode(ucwords(strtolower($row->menu)));
			$image		=  constant('img_url_site')."uploads/manage_medicine_menu/photo/resize/".$row->image;
			if (empty($row->image)){
				$image 			= constant('img_url_site')."uploads/default_img.jpg";
			}
			
$items.= <<<EOD
{"code":"{$code}","name":"{$name}","image":"{$image}"},
EOD;
		}
if ($items != '') {
	$items = substr($items, 0, -1);
}
	return $items;
	}

	public function website_menu_json_new()
	{
		//error_reporting(0);
		$items = "";
		$where = array('status'=>1,);
		$query = $this->Scheme_Model->select_all_result("tbl_medicine_menu",$where,"short_order","asc");
		foreach ($query as $row)
		{
			$item_code		=	$row->code;
			$item_company	=	ucwords(strtolower($row->menu));
			$item_image		=  constant('img_url_site')."uploads/manage_medicine_menu/photo/resize/".$row->image;
			if (empty($row->image)){
				$item_image 	= constant('img_url_site')."uploads/default_img.jpg";
			}
			
$items.= <<<EOD
{"item_code":"{$item_code}","item_company":"{$item_company}","item_image":"{$item_image}"},
EOD;
		}
if ($items != '') {
	$items = substr($items, 0, -1);
}
	return $items;
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineNewThisMonthModel extends CI_Model  
{
	public function __construct(){

		parent::__construct();

	}
	
	public function get_item_category_name($category_id){
		$this->db->select("name");
		$this->db->where('id',$category_id);
		$row = $this->db->get("tbl_item_category")->row();
		return $row->name;
	}
	
	public function get_medicine_new_this_month_api($session_yes_no,$category_id)
	{		
		$jsonArray = array();
		$time  = time();
		$date = date("Y-m-d", strtotime("-30 days", $time));
		
		$this->db->select("i_code,item_name,packing,company_name,batchqty,mrp,sale_rate,final_price,margin,featured,image1,misc_settings");
		$this->db->where('item_date>=',$date);
		$this->db->where("batchqty!=0");
		$this->db->order_by("RAND()");
		$this->db->limit('25');
		$query = $this->db->get("tbl_medicine")->result();
		foreach ($query as $row)
		{
			$item_code			=	$row->i_code;
			$item_name			=	ucwords(strtolower($row->item_name));
			$item_packing		=	$row->packing;
			$item_company		=  	ucwords(strtolower($row->company_name));
			$item_quantity		=	$row->batchqty;
			$item_mrp			=	sprintf('%0.2f',round($row->mrp,2));
			$item_ptr			=	sprintf('%0.2f',round($row->sale_rate,2));
			$item_price			=	sprintf('%0.2f',round($row->final_price,2));
			$item_margin 		=   round($row->margin);
			$item_featured 		= 	$row->featured;

			$misc_settings =	$row->misc_settings;
			$item_stock = "";
			if($misc_settings=="#NRX" && $quantity>=10){
				$item_stock = "Available";
			}
			
			$item_image = constant('img_url_site')."uploads/default_img.jpg";
			if(!empty($row->image1))
			{
				$item_image = constant('img_url_site').$row->image1;
			}
			$item_image 		= htmlentities($item_image);
			
			if($session_yes_no=="no"){
				$item_mrp 		= "xx.xx";
				$item_ptr 		= "xx.xx";
				$item_price		= "xx.xx";
				$item_margin 	= "xx";
			}
				
			$dt = array(
				'item_code' => $item_code,
				'item_image' => $item_image,
				'item_name' => $item_name,
				'item_packing' => $item_packing,
				'item_company' => $item_company,
				'item_quantity' => $item_quantity,
				'item_stock' => $item_stock,
				'item_ptr' => $item_ptr,
				'item_mrp' => $item_mrp,
				'item_price' => $item_price,
				'item_margin' => $item_margin,
				'item_featured' => $item_featured,
			);
			$jsonArray[] = $dt;
		}
		$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonString;
		$return["title"] = $this->get_item_category_name($category_id);
		return $return;
	}
}


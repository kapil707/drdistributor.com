<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineDivisionModel extends CI_Model  
{ 
	public function get_division_category_name($category_id){
		$this->db->select("name");
		$this->db->where('id',$category_id);
		$row = $this->db->get("tbl_division_category")->row();
		return $row->name;
	}
	
	public function medicine_division($category_id)
	{
		$jsonArray = array();
		
		$image = "";
		/******************************************************* */
		$this->db->select("compcode,company_full_name,image");
		$this->db->where('status',1);
		$this->db->where('category_id',$category_id);
		$this->db->order_by('id','RANDOM');
		$this->db->limit('12');
		$query = $this->db->get("tbl_division_wise")->result();
		foreach ($query as $row)
		{
			$item_code			=	($row->compcode);
			$item_company		=	ucwords(strtolower($row->company_full_name));
			$item_division 		= 	"";
			$item_image			=   constant('img_url_site')."uploads/manage_division_wise/photo/resize/".$row->image;
			if (empty($row->image)){
				$item_image 	= constant('img_url_site')."uploads/default_img.jpg";
			}
			$item_image 	= htmlentities($item_image);
			
			$dt = array(
				'item_code' => $item_code,
				'item_image' => $item_image,
				'item_company' => $item_company,
				'item_division' => $item_division,
			);
			$jsonArray[] = $dt;
		}
		
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_division_category_name($category_id);
		return $return;
	}
}
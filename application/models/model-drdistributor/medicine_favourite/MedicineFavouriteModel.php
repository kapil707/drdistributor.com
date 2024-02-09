<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineFavouriteModel extends CI_Model  
{
	public function __construct(){

		parent::__construct();

	}
	
	public function get_medicine_favourite_api($user_altercode)
	{		
		$jsonArray = array();
		$query = $this->db->query("select DISTINCT i_code,image,item_name,quantity,COUNT(*) as ct FROM tbl_order where chemist_id='$user_altercode' and user_type='chemist' GROUP BY i_code,image,item_name,quantity HAVING COUNT(*) > 0 order by ct asc LIMIT 25")->result();
		foreach ($query as $row)
		{
			$item_code 		= ($row->i_code);
			$item_name 		= ucwords(strtolower($row->item_name));
			$item_image 	= ($row->image);
			$item_quantity 	= ($row->quantity);
				
			$dt = array(
				'item_code' => $item_code,
				'item_image' => $item_image,
				'item_name' => $item_name,
				'item_quantity' => $item_quantity,
			);
			$jsonArray[] = $dt;
		}
		//$jsonString  = json_encode($jsonArray);
		return $jsonArray;
	}
}


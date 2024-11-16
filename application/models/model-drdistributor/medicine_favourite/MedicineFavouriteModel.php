<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineFavouriteModel extends CI_Model  
{
	public function __construct(){
		parent::__construct();
	}
	
	public function get_medicine_favourite_api($ChemistId)
	{		
		$jsonArray = array();
		
		$this->db->select('i_code, image, item_name, quantity, COUNT(*) as ct');
        $this->db->from('tbl_cartxxx');
        $this->db->where('chemist_id', $ChemistId);
        $this->db->where('user_type', 'chemist');
		$this->db->where('status', '1');
        $this->db->group_by('i_code, image, item_name, quantity');
        $this->db->having('COUNT(*) >', 0);
        $this->db->order_by('ct', 'ASC');
        $this->db->limit(25);

        $query = $this->db->get()->result();
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


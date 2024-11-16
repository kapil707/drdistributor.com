<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineDivisionModel extends CI_Model  
{ 
	public function __construct(){
		parent::__construct();

		// Load model
		$this->load->model("model-drdistributor/medicine_details/MedicineDetailsModel");
	}

	public function get_division_category_name_id($company_name){

		$this->db->select("compcode");
		$this->db->where('company_full_name',$company_name);
		$row = $this->db->get("tbl_division_wise")->row();
		if(!empty($row)){
			return $row->compcode;
		} else {
			$this->db->select("compcode");
			$this->db->where('company_full_name',$company_name);
			$row = $this->db->get("tbl_medicine")->row();
			if(!empty($row)){
				return $row->compcode;
			}else{
				return $company_name;
			}
		}
	}

	public function get_division_category_id_name($compcode){
		$this->db->select("company_name");
		$this->db->where('compcode',$compcode);
		$row = $this->db->get("tbl_medicine")->row();
		if(!empty($row)){
			return $row->company_name;
		}else{
			return $compcode;
		}
	}
	
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
		// First get the count
		$count = $this->db->where('status', 1)
		->where('category_id', $category_id)
		->count_all_results('tbl_division_wise');

		// Get random offset
		$offset = rand(0, max(0, $count - 12));

		// Then get records
		$query = $this->db->select('compcode, company_full_name, image')
		->where('status', 1)
		->where('category_id', $category_id)
		->limit(12, $offset)
		->get('tbl_division_wise')->result();
		foreach ($query as $row)
		{
			$jsonArray[] = $this->MedicineDetailsModel->medicine_division_row_dt($row);
		}
		
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_division_category_name($category_id);
		return $return;
	}
}
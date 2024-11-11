<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineDivisionModel extends CI_Model  
{ 
	public function __construct(){
		parent::__construct();

		// Load model
		$this->load->model("model-drdistributor/medicine_details/MedicineDetailsModel");
	}

	public function get_division_category_name_id($CategoryName){
		$this->db->select("compcode");
		$this->db->where('company_full_name',$CategoryName);
		$row = $this->db->get("tbl_division_wise")->row();
		return $row->compcode;
	}

	public function get_division_category_id_name($compcode){
		$this->db->select("company_full_name");
		$this->db->where('compcode',$compcode);
		$row = $this->db->get("tbl_division_wise")->row();
		return $row->company_full_name;
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
		$this->db->select("compcode,company_full_name,image");
		$this->db->where('status',1);
		$this->db->where('category_id',$category_id);
		$this->db->order_by('id','RANDOM');
		$this->db->limit('12');
		$query = $this->db->get("tbl_division_wise")->result();
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
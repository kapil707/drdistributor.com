<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SliderModel extends CI_Model  
{ 	
	var $MedicineImageUrl = "";
	public function __construct(){
		parent::__construct();

		// Load model
		$this->load->model("model-drdistributor/medicine_division/MedicineDivisionModel");
		
		$this->MedicineImageUrl = $this->appconfig->getMedicineImageUrl();
	}

	function slider_to_url($function_type="",$item_code="",$company_code="",$company_division=""){

		$url = "#";
		if($function_type==1)
		{
			$url = base_url()."md/".$item_code;
		}
		if($function_type==2)
		{
			$item_code = $this->MedicineDivisionModel->get_division_category_id_name($item_code);
			$company_code = str_replace(" ","-",$company_code);
			$url = base_url()."c/fb/".strtolower($company_code)."/".strtolower($company_division);
		}
		return $url;
	}
	function slider_to_android($function_type=""){
		$return = "";
		if($function_type==2)
		{
			$return = "featured_brand";
		}
		return $return;
	}
	public function slider($slider_type=1)
	{
		$jsonArray = array();
		
		$where = array('status'=>1,'slider_type'=>$slider_type);
		$this->db->where($where);
		$this->db->order_by('RAND()');
		$query = $this->db->get("tbl_slider1")->result();
		foreach ($query as $row)
		{
			$id				=	$row->id;
			$function_type	=	$row->function_type;
			$item_code		=	$row->item_code;
			$company_code	=	$row->company_code;
			$company_division=	$row->company_division;

			$image 		= $this->MedicineImageUrl."uploads/manage_slider/photo/main/".$row->image;
			$web_action = $this->slider_to_url($function_type,$item_code,$company_code,$company_division);
			$android_action = $this->slider_to_android($function_type);
			
			// yha be code sahi ha 2024-11
			if($function_type==2){
				$item_code	    = $company_code;
			}

			$title = "";

			$dt = array(
				'item_id' => $id,
				'item_title' => $title,
				'item_type' => $fun_type,
				'item_code' => $item_code,
				'item_division' => $comp_division,
				'item_image' => $image,
				'item_web_action' => $web_action,
				'item_page_type' => $android_action,
			);
			$jsonArray[] = $dt;
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		return $return;	
	}
}
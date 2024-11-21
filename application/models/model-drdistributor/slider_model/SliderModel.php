<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SliderModel extends CI_Model  
{ 	
	public function __construct(){
		parent::__construct();

		// Load model
		$this->load->model("model-drdistributor/medicine_division/MedicineDivisionModel");
	}

	function slider_to_url($fun_type="",$item_code="",$comp_division=""){

		$item_code = $this->MedicineDivisionModel->get_division_category_id_name($item_code);		
		$item_code = str_replace(" ","-",$item_code);
		$item_code = strtolower($item_code);
		$url = "#";
		if($fun_type==1)
		{
			$url = base_url()."md/".$item_code;
		}
		if($fun_type==2)
		{
			$url = base_url()."c/fb/".$item_code."/".$comp_division;
		}
		return $url;
	}
	function slider_to_android($fun_type=""){
		$return = "";
		if($fun_type==2)
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
			$id			=	$row->id;
			$fun_type	=	$row->fun_type;
			$item_code	=	$row->item_code;
			$comp_code	=	$row->comp_code;
			$comp_division =	$row->comp_division;
			// yha code sahi ha 2024-11
			if($fun_type==1){
				$compid	    = $item_code;
			}
			$image 		= 	constant('img_url_site')."uploads/manage_slider/photo/main/".$row->image;
			$web_action = $this->slider_to_url($fun_type,$comp_code,$comp_division);
			$android_action = $this->slider_to_android($fun_type);
			
			// yha be code sahi ha 2024-11
			if($fun_type==2){
				$item_code	    = $comp_code;
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
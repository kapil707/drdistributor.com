<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SliderModel extends CI_Model  
{ 	
	function slider_to_url($funtype="",$compid="",$division=""){
		$url = "#";
		if($funtype==2)
		{
			$url = base_url()."category/featured_brand/".$compid."/".$division;
		}
		return $url;
	}
	public function slider($slider_type=1)
	{
		$jsonArray = array();
		
		$i = 1;
		$where = array('status'=>1,'slider_type'=>$slider_type);
		$this->db->where($where);
		$this->db->order_by('RAND()');
		$query = $this->db->get("tbl_slider")->result();
		foreach ($query as $row)
		{
			if($i==1)
			{
				$id	=	"active";
			}
			else{
				$id = "";
			}
			$i++;
			$compname="";
			if($row->funtype=="1"){ 				
			}
			if($row->funtype=="2" || $row->funtype=="3"){
				$row->itemid = $row->compid; 
				$row1 = $this->db->query("select company_full_name from tbl_medicine where compcode='$row->itemid'")->row();
				$compname = ($row1->company_full_name);
			}
			$funtype	=	$row->funtype;
			$itemid	    =	$row->itemid;
			$division	=	$row->division;
			$compid		=	$row->compid;
			$image 		= 	constant('img_url_site')."uploads/manage_slider/photo/main/".$row->image;
			$web_action = $this->slider_to_url($funtype,$compid,$division);
			
			$dt = array(
				'id' => $id,
				'funtype' => $funtype,
				'itemid' => $itemid,
				'division' => $division,
				'image' => $image,
				'compname' => $compname,
				'compid' => $compid,
				'web_action' => $web_action,
			);
			$jsonArray[] = $dt;
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		return $return;	
	}
}
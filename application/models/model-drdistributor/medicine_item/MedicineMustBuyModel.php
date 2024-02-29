<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineMustBuyModel extends CI_Model  
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
	
	public function get_medicine_must_buy_api($session_yes_no,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{		
		$date = date("Y-m-d");
		
		$jsonArray = array();
		$sameid = "";
		
		$this->db->select('i_code, COUNT(*) as quantity');
		$this->db->from('tbl_order');
		$this->db->where('date', $date);
		$this->db->group_by('i_code');
		$this->db->having('COUNT(*) >', 1);
		$this->db->order_by('quantity', 'desc');
		$this->db->limit($limit,$get_record);
		if($order_by_type=="RAND"){
			$this->db->order_by('i_code', "RAND()");
		}else{
			$this->db->order_by('i_code', 'desc');
		}
		$query = $this->db->get()->result();
		foreach ($query as $row)
		{
			$sameid.=$row->i_code.",";
		}
		$sameid = substr($sameid,0,-1);
		if(!empty($sameid))
		{
			$sameid = "i_code in(".$sameid.")";
		}
		
		if(!empty($sameid))
		{
			$this->db->select("i_code,item_name,packing,company_name,batchqty,mrp,sale_rate,final_price,margin,featured,image1,misc_settings");
			$this->db->where($sameid);
			if($show_out_of_stock==0){
				$this->db->where('batchqty !=', 0);
			}
			$this->db->limit($limit,$get_record);
			if($order_by_type=="RAND"){
				$this->db->order_by("RAND()");
			}else{
				$this->db->order_by('id', 'desc');
			}
			$query = $this->db->get("tbl_medicine")->result();
			foreach ($query as $row)
			{
				$get_record++;

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
				if($misc_settings=="#NRX" && $item_quantity>=10){
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
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($category_id);
		$return["get_record"] = $get_record;
		return $return;
	}
}


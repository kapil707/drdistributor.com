<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineSchemeNewModel extends CI_Model  
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

	public function get_medicine_scheme_now_api($session_yes_no,$user_nrx,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{
		$jsonArray = array();

		$this->db->select('t2.i_code, t2.item_name, t2.image1, t2.packing, t2.salescm1, t2.salescm2, t2.company_name, t2.batchqty, t2.mrp, t2.sale_rate, t2.final_price, t2.margin, t2.featured, t2.misc_settings');
		$this->db->from('tbl_medicine_compare AS t1');
		$this->db->join('tbl_medicine AS t2', 't1.i_code = t2.i_code', 'left');
		$this->db->where('compare_type','scheme');
		/************************************ */
		$where = "t2.status=1 and t2.`misc_settings` NOT LIKE '%gift%' and t2.category!='g'";
		$this->db->where($where);
		if($user_nrx=="yes"){
		}else{
			$where="t2.misc_settings!='#NRX'";
			$this->db->where($where);
		}
		/************************************ */
		if($show_out_of_stock==0){
			$this->db->where('t2.batchqty !=', 0);
		}
		$this->db->limit($limit,$get_record);
		if($order_by_type=="RAND"){
			$this->db->order_by('t2.id',"RAND()");
		}else{
			$this->db->order_by('t2.id', 'desc');
		}
		$query = $this->db->get()->result();
		foreach ($query as $row)
		{
			$get_record++;

			$item_code			=	$row->i_code;
			$item_name			=	ucwords(strtolower($row->item_name));
			$item_packing		=	$row->packing;
			$item_scheme		=	$row->salescm1."+".$row->salescm2;
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
			
			$item_image = base_url()."uploads/default_img.webp";
			if(!empty($row->image1))
			{
				$item_image = constant('img_url_site').$row->image1;
			}
			
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
				'item_scheme' => $item_scheme,
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
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($category_id);
		$return["get_record"] = $get_record;
		return $return;
	}
}
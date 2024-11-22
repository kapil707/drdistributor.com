<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineCategoryModel extends CI_Model  
{
	var $MedicineImageUrl = "";
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');

		$this->MedicineImageUrl = $this->appconfig->getMedicineImageUrl();
	}

	public function get_company_name_id($company_name){
		$this->db->select("company_code");
		$this->db->where('company_name',$company_name);
		$row = $this->db->get("tbl_company_division")->row();
		if(!empty($row)){
			return $row->company_code;
		}else{
			return "";
		}
	}

	public function get_company_name($company_code){
		$this->db->select("company_name");
		$this->db->where('company_code',$company_code);
		$row = $this->db->get("tbl_company_division")->row();
		if(!empty($row)){
			return $row->company_name;
		}else{
			return "";
		}
	}
	
	public function get_company_with_category_api($SessionValue="",$ChemistNrx="",$itemcat="",$show_out_of_stock="0",$get_record="0",$limit="12",$order_by_type="RAND")
	{
		$jsonArray = array();
		$title = "";

		$this->db->select("m.i_code, m.item_name, m.packing, m.salescm1, m.salescm2, m.company_name, m.batchqty, m.mrp, m.sale_rate, m.final_price, m.margin, CASE WHEN m.batchqty = 0 AND m.featured = 1 THEN 0 ELSE m.featured END as featured_new, m.image1, m.misc_settings", false);
        $this->db->from('tbl_medicine as m');
		/*********page where******************* */
		$this->db->where('m.itemcat',$itemcat);
		/************************************ */
		$where = "m.status=1 and m.misc_settings NOT LIKE '%gift%' and m.category!='g'";
		$this->db->where($where);
		if($ChemistNrx=="yes"){
		}else{
			$where="m.misc_settings!='#NRX'";
			$this->db->where($where);
		}
		/************************************ */
		if($show_out_of_stock==0){
			$this->db->where('m.batchqty !=', 0);
		}
		$this->db->limit($limit,$get_record);
		if($order_by_type=="RAND"){
			$this->db->order_by('m.id', "RAND()");
		}else{
			$this->db->order_by('featured_new', 'DESC');
        	$this->db->order_by('m.batchqty', 'DESC');
		}
		$query = $this->db->get()->result();
		foreach ($query as $row)
		{
			$get_record++;
			$jsonArray[] = $this->page_row_dt($row,$SessionValue);
		}

		$return["items"] = $jsonArray;
		$return["title"] = $this->get_company_name($itemcat);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function get_company_or_division_api($SessionValue="",$ChemistNrx="",$compcode="",$division="",$show_out_of_stock="0",$get_record="0",$limit="12",$order_by_type="RAND")
	{
		$jsonArray = array();
		$title = "";

		$this->db->select("m.i_code, m.item_name, m.packing, m.salescm1, m.salescm2, m.company_name, m.batchqty, m.mrp, m.sale_rate, m.final_price, m.margin, CASE WHEN m.batchqty = 0 AND m.featured = 1 THEN 0 ELSE m.featured END as featured_new, m.image1, m.misc_settings", false);
        $this->db->from('tbl_medicine as m');
		/*********page where******************* */
		$this->db->where('m.compcode',$compcode);
		if(!empty($division)){
			$this->db->where('m.division',$division);
		}
		/************************************ */
		$where = "m.status=1 and m.misc_settings NOT LIKE '%gift%' and m.category!='g'";
		$this->db->where($where);
		if($ChemistNrx=="yes"){
		}else{
			$where="m.misc_settings!='#NRX'";
			$this->db->where($where);
		}
		/************************************ */
		if($show_out_of_stock==0){
			$this->db->where('m.batchqty !=', 0);
		}
		$this->db->limit($limit,$get_record);
		if($order_by_type=="RAND"){
			$this->db->order_by('m.id', "RAND()");
		}else{
			$this->db->order_by('featured_new', 'DESC');
        	$this->db->order_by('m.batchqty', 'DESC');
		}
		$query = $this->db->get()->result();
		foreach ($query as $row)
		{
			$get_record++;
			$jsonArray[] = $this->page_row_dt($row,$SessionValue);
			$title = ucwords(strtolower($row->company_name));
		}

		if(empty($jsonArray)){
			$jsonArray = "";
		}

		$return["items"] = $jsonArray;
		$return["title"] = $title;
		$return["get_record"] = $get_record;
		return $return;
	}

	public function page_row_dt($row,$SessionValue){

		if(!empty($row)){
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
			$item_featured 		= 	$row->featured_new;

			$misc_settings =	$row->misc_settings;
			$item_stock = "";
			if($misc_settings=="#NRX" && $item_quantity>=10){
				$item_stock = "Available";
			}
			
			$item_image = base_url()."uploads/default_img.webp";
			if(!empty($row->image1))
			{
				$item_image = $this->MedicineImageUrl.$row->image1;
			}
			
			if($SessionValue=="no"){
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

			return $dt;
		}
	}
}
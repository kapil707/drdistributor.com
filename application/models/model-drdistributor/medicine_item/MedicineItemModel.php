<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineItemModel extends CI_Model  
{
	var $MedicineImageUrl = "";
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');

		$this->MedicineImageUrl = $this->appconfig->getMedicineImageUrl();
	}

	public function get_item_category_name($CategoryId){
		$this->db->select("name");
		$this->db->where('id',$CategoryId);
		$row = $this->db->get("tbl_item_category")->row();
		if(!empty($row)){
			return $row->name;
		}else{
			return "";
		}
	}
	
	public function medicine_item($SessionValue="no",$CategoryId,$UserType='',$ChemistId='',$SalesmanId='',$ChemistNrx='',$show_out_of_stock="0",$get_record="0",$limit="12",$order_by_type="RAND")
	{
		if($CategoryId=="1"){
			return $this->get_medicine_new_this_month_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type);
		}
		if($CategoryId=="2"){
			return $this->get_medicine_hot_selling_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type);
		}
		if($CategoryId=="3"){
			return $this->get_medicine_must_buy_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type);
		}		
		if($CategoryId=="4"){
			return $this->get_medicine_available_now_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type);
		}
		/************************************ */
		if($CategoryId=="5" && $SessionValue=="yes"){
			 return $this->get_medicine_top_search_api($SessionValue,$CategoryId,$UserType,$ChemistId,$SalesmanId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type);
		}
		if($CategoryId=="5" && $SessionValue=="no"){
			// jab session na milay to yha chalta ha 
			$return["items"] = array();
			$return["title"] = 'Search';
			return $return;
		}
		/************************************ */
		if($CategoryId=="6"){
			return $this->get_medicine_low_price_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type);
		}
		if($CategoryId=="7"){
			return $this->get_medicine_scheme_now_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type);
		}
		
		return $this->get_medicine_item_view_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type);
	}

	/****************************************** */
	public function get_medicine_new_this_month_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{		
		$jsonArray = array();
		$time  = time();
		$date = date("Y-m-d", strtotime("-30 days", $time));
		
		$this->db->select("m.i_code, m.item_name, m.packing, m.salescm1, m.salescm2, m.company_name, m.batchqty, m.mrp, m.sale_rate, m.final_price, m.margin, CASE WHEN m.batchqty = 0 AND m.featured = 1 THEN 0 ELSE m.featured END as featured_new, m.image1, m.misc_settings", false);
		$this->db->from('tbl_medicine as m');
		/*********page where******************* */
		$this->db->where('item_date>=',$date);
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
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($CategoryId);
		$return["get_record"] = $get_record;
		return $return;
	}

	/****************************************** */
	public function get_medicine_hot_selling_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{		
		$jsonArray = array();

		$this->db->select("m.i_code, m.item_name, m.packing, m.salescm1, m.salescm2, m.company_name, m.batchqty, m.mrp, m.sale_rate, m.final_price, m.margin, CASE WHEN m.batchqty = 0 AND m.featured = 1 THEN 0 ELSE m.featured END as featured_new, m.image1, m.misc_settings", false);
		$this->db->from('tbl_medicine_compare');
		$this->db->join('tbl_medicine AS m', 'm.i_code = tbl_medicine_compare.i_code', 'left');
		/*********page where******************* */
		$this->db->where('tbl_medicine_compare.compare_type','hot_selling');
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
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($CategoryId);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function get_medicine_must_buy_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{		
		$date = date("Y-m-d");
		
		$jsonArray = array();

		$this->db->select("COUNT(*) as quantity,m.i_code, m.item_name, m.packing, m.salescm1, m.salescm2, m.company_name, m.batchqty, m.mrp, m.sale_rate, m.final_price, m.margin, CASE WHEN m.batchqty = 0 AND m.featured = 1 THEN 0 ELSE m.featured END as featured_new, m.image1, m.misc_settings", false);
		$this->db->from('tbl_cart');
		$this->db->join('tbl_medicine as m', 'm.i_code = tbl_cart.i_code', 'left');
		/*********page where******************* */
		$this->db->where('tbl_cart.STATUS', 1);
		$this->db->where('tbl_cart.date',$date);
		/************************************ */
		$this->db->group_by('m.i_code, m.item_name, m.image1, m.packing, m.salescm1, m.salescm2, m.company_name, m.batchqty, m.mrp, m.sale_rate, m.final_price, m.margin, m.featured, m.misc_settings');
		$this->db->having('tbl_cart.quantity >', 1);
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
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($CategoryId);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function get_medicine_available_now_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{
		$jsonArray = array();

		$this->db->select("m.i_code, m.item_name, m.packing, m.salescm1, m.salescm2, m.company_name, m.batchqty, m.mrp, m.sale_rate, m.final_price, m.margin, CASE WHEN m.batchqty = 0 AND m.featured = 1 THEN 0 ELSE m.featured END as featured_new, m.image1, m.misc_settings", false);
		$this->db->from('tbl_medicine_compare');
		$this->db->join('tbl_medicine AS m', 'm.i_code = tbl_medicine_compare.i_code', 'left');
		/*********page where******************* */
		$this->db->where('tbl_medicine_compare.compare_type','batchqty');
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
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($CategoryId);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function get_medicine_top_search_api($SessionValue,$CategoryId,$UserType,$ChemistId,$SalesmanId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{		
		$jsonArray = array();

		$this->db->select("m.i_code, m.item_name, m.packing, m.salescm1, m.salescm2, m.company_name, m.batchqty, m.mrp, m.sale_rate, m.final_price, m.margin, CASE WHEN m.batchqty = 0 AND m.featured = 1 THEN 0 ELSE m.featured END as featured_new, m.image1, m.misc_settings", false);
		$this->db->from('tbl_search_logs');
		$this->db->join('tbl_medicine AS m', 'm.item_code = tbl_search_logs.product_viewed', 'left');
		/*********page where******************* */
		$this->db->where('tbl_search_logs.chemist_id', $ChemistId);
		$this->db->where('tbl_search_logs.salesman_id', $SalesmanId);
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
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($CategoryId);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function get_medicine_low_price_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{
		$jsonArray = array();

		$this->db->select("m.i_code, m.item_name, m.packing, m.salescm1, m.salescm2, m.company_name, m.batchqty, m.mrp, m.sale_rate, m.final_price, m.margin, CASE WHEN m.batchqty = 0 AND m.featured = 1 THEN 0 ELSE m.featured END as featured_new, m.image1, m.misc_settings", false);
		$this->db->from('tbl_medicine_compare');
		$this->db->join('tbl_medicine AS m', 'm.i_code = tbl_medicine_compare.i_code', 'left');
		/*********page where******************* */
		$this->db->where('tbl_medicine_compare.compare_type','mrp');
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
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($CategoryId);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function get_medicine_scheme_now_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{
		$jsonArray = array();

		$this->db->select("m.i_code, m.item_name, m.packing, m.salescm1, m.salescm2, m.company_name, m.batchqty, m.mrp, m.sale_rate, m.final_price, m.margin, CASE WHEN m.batchqty = 0 AND m.featured = 1 THEN 0 ELSE m.featured END as featured_new, m.image1, m.misc_settings", false);
		$this->db->from('tbl_medicine_compare');
		$this->db->join('tbl_medicine AS m', 'm.i_code = tbl_medicine_compare.i_code', 'left');
		/*********page where******************* */
		$this->db->where('tbl_medicine_compare.compare_type','scheme');
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
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($CategoryId);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function get_medicine_item_view_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{		
		$jsonArray = array();

		$this->db->select("m.i_code, m.item_name, m.packing, m.salescm1, m.salescm2, m.company_name, m.batchqty, m.mrp, m.sale_rate, m.final_price, m.margin, CASE WHEN m.batchqty = 0 AND m.featured = 1 THEN 0 ELSE m.featured END as featured_new, m.image1, m.misc_settings", false);
		$this->db->from('tbl_item_wise');
		$this->db->join('tbl_medicine AS m', 'm.i_code = tbl_item_wise.i_code', 'left');
		/*********page where******************* */
		$this->db->where("tbl_item_wise.status=1");
		$this->db->where("tbl_item_wise.category_id='$CategoryId'");
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
			$jsonArray[] = $this->page_row_dt($row,$SessionValue);
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($CategoryId);
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
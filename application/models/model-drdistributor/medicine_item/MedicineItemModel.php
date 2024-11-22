<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineItemModel extends CI_Model  
{
	public function __construct(){
		parent::__construct();

		// Load model
		$this->load->model("model-drdistributor/medicine_details/MedicineDetailsModel");
	}

	public function get_item_category_title_id($title){
		$this->db->select("id");
		$this->db->where('title',$title);
		$row = $this->db->get("tbl_item_category_nnn")->row();
		if(!empty($row)){
			return $row->id;
		}else{
			return "";
		}
	}

	public function get_item_category_title($id){
		$this->db->select("title");
		$this->db->where('id',$id);
		$row = $this->db->get("tbl_item_category_nnn")->row();
		if(!empty($row)){
			return $row->title;
		}else{
			return "";
		}
	}
	
	public function medicine_item($SessionValue="no",$CategoryId,$UserType='',$ChemistId='',$SalesmanId='',$ChemistNrx='',$show_out_of_stock="0",$get_record="0",$limit="12",$order_by_type="RAND")
	{
		if($CategoryId=="1" || $CategoryId=="2" || $CategoryId=="3" || $CategoryId=="4" || $CategoryId=="6" || $CategoryId=="7"){
			return $this->get_medicine_item($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type);
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
		
		return $this->get_medicine_item_view_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type);
	}

	/****************************************** */
	public function get_medicine_item($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{	
		$jsonArray = array();

		$this->db->select("m.i_code, m.item_name, m.packing, m.salescm1, m.salescm2, m.company_name, m.batchqty, m.mrp, m.sale_rate, m.final_price, m.margin, CASE WHEN m.batchqty = 0 AND m.featured = 1 THEN 0 ELSE m.featured END as featured_new, m.image1, m.misc_settings", false);
		$this->db->from('tbl_medicine_compare');
		$this->db->join('tbl_medicine AS m', 'm.i_code = tbl_medicine_compare.i_code', 'left');
		if($CategoryId=="1"){
			//new_medicine
			/*********page where******************* */
			$this->db->where('tbl_medicine_compare.compare_type','new_medicine');
			/************************************ */
		}
		if($CategoryId=="2"){
			//hot_selling
			/*********page where******************* */
			$this->db->where('tbl_medicine_compare.compare_type','hot_selling');
			/************************************ */
		}
		if($CategoryId=="3"){
			//must_buy
			/*********page where******************* */
			$this->db->where('tbl_medicine_compare.compare_type','must_buy');
			/************************************ */
		}
		if($CategoryId=="4"){
			//available_now
			/*********page where******************* */
			$this->db->where('tbl_medicine_compare.compare_type','batchqty');
			/************************************ */
		}
		if($CategoryId=="6"){
			//low_price
			/*********page where******************* */
			$this->db->where('tbl_medicine_compare.compare_type','mrp');
			/************************************ */
		}
		if($CategoryId=="7"){
			//scheme_now
			/*********page where******************* */
			$this->db->where('tbl_medicine_compare.compare_type','scheme');
			/************************************ */
		}
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
			$jsonArray[] = $this->MedicineDetailsModel->medicine_item_row_dt($row,$SessionValue);
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_title($CategoryId);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function get_medicine_top_search_api($SessionValue,$CategoryId,$UserType,$ChemistId,$SalesmanId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{		
		$jsonArray = array();

		$this->db->select("m.i_code, m.item_name, m.packing, m.salescm1, m.salescm2, m.company_name, m.batchqty, m.mrp, m.sale_rate, m.final_price, m.margin, CASE WHEN m.batchqty = 0 AND m.featured = 1 THEN 0 ELSE m.featured END as featured_new, m.image1, m.misc_settings", false);
		$this->db->from('tbl_search_logs');
		$this->db->join('tbl_medicine AS m', 'm.item_code = tbl_search_logs.item_code', 'left');
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
			$jsonArray[] = $this->MedicineDetailsModel->medicine_item_row_dt($row,$SessionValue);
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_title($CategoryId);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function get_medicine_item_view_api($SessionValue,$CategoryId,$ChemistNrx,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{		
		$jsonArray = array();

		$this->db->select("m.i_code, m.item_name, m.packing, m.salescm1, m.salescm2, m.company_name, m.batchqty, m.mrp, m.sale_rate, m.final_price, m.margin, CASE WHEN m.batchqty = 0 AND m.featured = 1 THEN 0 ELSE m.featured END as featured_new, m.image1, m.misc_settings", false);
		$this->db->from('tbl_item');
		$this->db->join('tbl_medicine AS m', 'm.i_code = tbl_item.item_code', 'left');
		/*********page where******************* */
		$this->db->where("tbl_item.status=1");
		$this->db->where("tbl_item.category_id='$CategoryId'");
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
			$jsonArray[] = $this->MedicineDetailsModel->medicine_item_row_dt($row,$SessionValue);
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_title($CategoryId);
		$return["get_record"] = $get_record;
		return $return;
	} 
}
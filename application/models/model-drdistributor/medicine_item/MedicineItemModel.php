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

	public function get_item_category_name($category_id){
		$this->db->select("name");
		$this->db->where('id',$category_id);
		$row = $this->db->get("tbl_item_category")->row();
		if(!empty($row)){
			return $row->name;
		}else{
			return "";
		}
	}
	
	public function medicine_item($session_yes_no="no",$category_id,$user_type='',$user_altercode='',$salesman_id='',$user_nrx='',$show_out_of_stock="0",$get_record="0",$limit="12",$order_by_type="RAND")
	{
		if($category_id=="1"){
			return $this->get_medicine_new_this_month_api($session_yes_no,$user_nrx,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type);
		}
		if($category_id=="2"){
			return $this->get_medicine_hot_selling_api($session_yes_no,$user_nrx,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type);
		}
		if($category_id=="3"){
			return $this->get_medicine_must_buy_api($session_yes_no,$user_nrx,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type);
		}		
		if($category_id=="4"){
			return $this->get_medicine_available_now_api($session_yes_no,$user_nrx,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type);
		}
		/************************************ */
		if($category_id=="5" && $session_yes_no=="yes"){
			 return $this->get_medicine_top_search_api($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id,$user_nrx,$show_out_of_stock,$get_record,$limit,$order_by_type);
		}
		if($category_id=="5" && $session_yes_no=="no"){
			// jab session na milay to yha chalta ha 
			$return["items"] = array();
			$return["title"] = 'Search';
			return $return;
		}
		/************************************ */
		if($category_id=="6"){
			return $this->get_medicine_low_price_api($session_yes_no,$user_nrx,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type);
		}
		if($category_id=="7"){
			return $this->get_medicine_scheme_now_api($session_yes_no,$user_nrx,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type);
		}
		
		return $this->get_medicine_item_view_api($session_yes_no,$user_nrx,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type);
	}

	/****************************************** */
	public function get_medicine_new_this_month_api($session_yes_no,$user_nrx,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{		
		$jsonArray = array();
		$time  = time();
		$date = date("Y-m-d", strtotime("-30 days", $time));
		
		$this->db->select("i_code,item_name,packing,salescm1,salescm2,company_name,batchqty,mrp,sale_rate,final_price,margin,featured,image1,misc_settings");
		$this->db->where('item_date>=',$date);
		/************************************ */
		$where = "status=1 and `misc_settings` NOT LIKE '%gift%' and category!='g'";
		$this->db->where($where);
		if($user_nrx=="yes"){
		}else{
			$where="misc_settings!='#NRX'";
			$this->db->where($where);
		}
		/************************************ */
		if($show_out_of_stock==0){
			$this->db->where('batchqty !=', 0);
		}
		$this->db->limit($limit,$get_record);
		if($order_by_type=="RAND"){
			$this->db->order_by('id', "RAND()");
		}else{
			$this->db->order_by('id', 'desc');
		}
		$this->db->limit(25);
		$query = $this->db->get("tbl_medicine")->result();
		foreach ($query as $row)
		{
			$get_record++;
			$jsonArray[] = $this->page_row_dt($row,$session_yes_no);
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($category_id);
		$return["get_record"] = $get_record;
		return $return;
	}

	/****************************************** */
	public function get_medicine_hot_selling_api($session_yes_no,$user_nrx,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{		
		$jsonArray = array();

		$this->db->select('t2.i_code, t2.item_name, t2.image1, t2.packing, t2.salescm1, t2.salescm2, t2.company_name, t2.batchqty, t2.mrp, t2.sale_rate, t2.final_price, t2.margin, t2.featured, t2.misc_settings');
		$this->db->from('tbl_hot_selling AS t1');
		$this->db->join('tbl_medicine AS t2', 't1.i_code = t2.i_code', 'left');
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
		$this->db->limit(25);
		$query = $this->db->get()->result();
		foreach ($query as $row)
		{
			$get_record++;
			$jsonArray[] = $this->page_row_dt($row,$session_yes_no);
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($category_id);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function get_medicine_must_buy_api($session_yes_no,$user_nrx,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{		
		$date = date("Y-m-d");
		
		$jsonArray = array();

		$this->db->select('COUNT(*) as quantity, t2.i_code, t2.item_name, t2.image1, t2.packing, t2.salescm1, t2.salescm2, t2.company_name, t2.batchqty, t2.mrp, t2.sale_rate, t2.final_price, t2.margin, t2.featured, t2.misc_settings');
		$this->db->from('tbl_cart as t1');
		$this->db->join('tbl_medicine as t2', 't1.i_code = t2.i_code', 'left');
		$this->db->where('t1.STATUS', 1);
		$this->db->where('t1.date',$date);
		$this->db->group_by('t2.i_code, t2.item_name, t2.image1, t2.packing, t2.salescm1, t2.salescm2, t2.company_name, t2.batchqty, t2.mrp, t2.sale_rate, t2.final_price, t2.margin, t2.featured, t2.misc_settings');
		$this->db->having('quantity >', 1);
		/************************************ */
		$where = "t2.status=1 and t2.misc_settings NOT LIKE '%gift%' and t2.category!='g'";
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
			$this->db->order_by("RAND()");
		}else{
			$this->db->order_by('id', 'desc');
		}		
		$this->db->limit(25);
		$query = $this->db->get()->result();
		foreach ($query as $row)
		{
			$get_record++;
			$jsonArray[] = $this->page_row_dt($row,$session_yes_no);
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($category_id);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function get_medicine_available_now_api($session_yes_no,$user_nrx,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{
		$jsonArray = array();

		$this->db->select('t2.i_code, t2.item_name, t2.image1, t2.packing, t2.salescm1, t2.salescm2, t2.company_name, t2.batchqty, t2.mrp, t2.sale_rate, t2.final_price, t2.margin, t2.featured, t2.misc_settings');
		$this->db->from('tbl_medicine_compare AS t1');
		$this->db->join('tbl_medicine AS t2', 't1.i_code = t2.i_code', 'left');
		$this->db->where('compare_type','batchqty');
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
		$this->db->limit(25);
		$query = $this->db->get()->result();
		foreach ($query as $row)
		{
			$get_record++;
			$jsonArray[] = $this->page_row_dt($row,$session_yes_no);
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($category_id);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function get_medicine_top_search_api($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id,$user_nrx,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{		
		$jsonArray = array();

		$this->db->select('t2.i_code, t2.item_name, t2.image1, t2.packing, t2.salescm1, t2.salescm2, t2.company_name, t2.batchqty, t2.mrp, t2.sale_rate, t2.final_price, t2.margin, t2.featured, t2.misc_settings');
		$this->db->from('tbl_top_search AS t1');
		$this->db->join('tbl_medicine AS t2', 't1.item_code = t2.i_code', 'left');
		$this->db->where('t1.user_type', $user_type);
		$this->db->where('t1.user_altercode', $user_altercode);
		$this->db->where('t1.salesman_id', $salesman_id);
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
			$this->db->order_by('t1.id',"RAND()");
		}else{
			$this->db->order_by('t1.id', 'desc');
		}
		$this->db->limit(25);
		$query = $this->db->get()->result();
		foreach ($query as $row)
		{
			$get_record++;
			$jsonArray[] = $this->page_row_dt($row,$session_yes_no);
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($category_id);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function get_medicine_low_price_api($session_yes_no,$user_nrx,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{
		$jsonArray = array();

		$this->db->select('t2.i_code, t2.item_name, t2.image1, t2.packing, t2.salescm1, t2.salescm2, t2.company_name, t2.batchqty, t2.mrp, t2.sale_rate, t2.final_price, t2.margin, t2.featured, t2.misc_settings');
		$this->db->from('tbl_medicine_compare AS t1');
		$this->db->join('tbl_medicine AS t2', 't1.i_code = t2.i_code', 'left');
		$this->db->where('compare_type','mrp');
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
		$this->db->limit(25);
		$query = $this->db->get()->result();
		foreach ($query as $row)
		{
			$get_record++;
			$jsonArray[] = $this->page_row_dt($row,$session_yes_no);
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($category_id);
		$return["get_record"] = $get_record;
		return $return;
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
			$jsonArray[] = $this->page_row_dt($row,$session_yes_no);
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($category_id);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function get_medicine_item_view_api($session_yes_no,$user_nrx,$category_id,$show_out_of_stock,$get_record,$limit,$order_by_type)
	{		
		$jsonArray = array();		
		$sameid = "";

		$this->db->distinct("i_code");
		$this->db->order_by('id','desc');
		$this->db->where("status=1");
		$this->db->where("category_id='$category_id'");
		$this->db->limit("250");
		$query = $this->db->get("tbl_item_wise")->result();
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
			$this->db->select("i_code,item_name,packing,salescm1,salescm2,company_name,batchqty,mrp,sale_rate,final_price,margin,featured,image1,misc_settings");
			$this->db->where($sameid);
			/************************************ */
			$where = "status=1 and `misc_settings` NOT LIKE '%gift%' and category!='g'";
			$this->db->where($where);
			if($user_nrx=="yes"){
			}else{
				$where="misc_settings!='#NRX'";
				$this->db->where($where);
			}
			/************************************ */
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
				$jsonArray[] = $this->page_row_dt($row,$session_yes_no);
			}
		}
		//$jsonString  = json_encode($jsonArray);
		
		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($category_id);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function page_row_dt($row,$session_yes_no){

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
			$item_featured 		= 	$row->featured;

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

			return $dt;
		}
	}
}
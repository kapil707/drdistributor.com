<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineDetailsModel extends CI_Model  
{
	var $MedicineImageUrl = "";
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');

		$this->MedicineImageUrl = $this->appconfig->getMedicineImageUrl();
	}

	public function medicine_details_api($user_type="",$user_altercode="",$salesman_id="",$item_code="")
	{
		$jsonArray = array();

		$item_date_time = date('d-M h:i A');
		
		//$db_medicine = $this->db_medicine;
		$db_medicine = $this->db;
		$db_medicine->select("*");
		$where = array('i_code'=>$item_code);
		$db_medicine->where($where);
		$db_medicine->limit(1);
		$row = $db_medicine->get("tbl_medicine")->row();
		if(!empty($row->id))
		{
			$item_code			=	$row->i_code;
			$item_name			=	(ucwords(strtolower($row->item_name)));
			$item_packing		=	($row->packing);
			$item_batch_no		=	($row->batch_no);
			$item_expiry		=	($row->expiry);
			$item_company 		=  	ucwords(strtolower($row->company_full_name));
			$item_quantity		=	$row->batchqty;
			$item_ptr			=	sprintf('%0.2f',round($row->sale_rate,2));
			$item_mrp			=	sprintf('%0.2f',round($row->mrp,2));
			$item_price			=	sprintf('%0.2f',round($row->final_price,2));
			$item_scheme		=	$row->salescm1."+".$row->salescm2;
			$item_margin 		=   round($row->margin);				
			$misc_settings		=   $row->misc_settings;
			$item_gst			=	$row->gstper;
			$item_featured 		= 	$row->featured;
			$item_discount 		= 	$row->discount;
			if($item_quantity==0)
			{
				$this->add_stock_low($user_type,$user_altercode,$salesman_id,$item_code);
				$item_batch_no 	= "xxxxxx";
				$item_expiry	= "00/00";
				$item_gst		= "0";
			}
			if(empty($item_discount))
			{
				$item_discount = "4.5";
			}
			$item_description1 = (trim($row->title2));
			$item_description2 = (trim($row->description));			

			$item_image  = $item_image2 = $item_image3 = $item_image4 = base_url()."uploads/default_img.webp";
			$img_url_site = $this->MedicineImageUrl;
			if(!empty($row->image1)){
				$item_image = $img_url_site.$row->image1;
				if(!empty($row->image1)){
					$item_image =  $this->MedicineImageUrl."medicine_image/".$item_code."-image1.jpg";
				}
			}
			if(!empty($row->image2)){
				$item_image2 = $img_url_site.$row->image2;
				if(!empty($row->image2)){
					$item_image2 =  $this->MedicineImageUrl."medicine_image/".$item_code."-image2.jpg";
				}
			}
			if(!empty($row->image3)){
				$item_image3 = $img_url_site.$row->image3;
				if(!empty($row->image3)){
					$item_image3 =  $this->MedicineImageUrl."medicine_image/".$item_code."-image3.jpg";
				}
			}
			if(!empty($row->image4)){
				$item_image4 = $img_url_site.$row->image4;
				if(!empty($row->image4)){
					$item_image4 =  $this->MedicineImageUrl."medicine_image/".$item_code."-image4.jpg";
				}
			}
			/*******************************************************
			$itemjoinid			=	$row->itemjoinid;
			/********************************************************/
			$itemjoinid = "";
			$items1 = "";
			if($itemjoinid!="")
			{
				$itemjoinid1 = explode (",", $itemjoinid);
				foreach($itemjoinid1 as $item_code_n)
				{
					$items1.= $this->get_itemjoinid($item_code_n);
				}
				if ($items1 != '') {
					$items1 = substr($items1, 0, -1);
				}
				$items1 = ',"items1":['.$items1.']';
			}
			else
			{
				$items1 = ',"items1":""';
			}

			$item_stock = "";
			if($misc_settings=="#NRX")
			{
				if($item_quantity>=10){
					$item_stock = "Available";
					$item_quantity = 1000; // yha validate kar ke liya ha taki maray pass kitni davi ha oss ko pata na chalay
				}
			}

			/************************************************** */
			$item_order_quantity = "";
			if(!empty($user_type)) {
				$where1 = array('chemist_id'=>$user_altercode,'salesman_id'=>$salesman_id,'user_type'=>$user_type,'i_code'=>$item_code,'status'=>'0');
				$this->db->select("quantity");
				$this->db->where($where1);
				$row1 = $this->db->get("tbl_cart")->row();
				if(!empty($row1->quantity)){
					$item_order_quantity = $row1->quantity;
				}
			}else{
				$item_batch_no 	= "xxxxxx";
				$item_expiry 	= "00/00";
				$item_mrp 		= "xx.xx";
				$item_ptr 		= "xx.xx";
				$item_price		= "xx.xx";
				$item_margin 	= "xx";
				$item_gst 		= "0";
				if($item_quantity!=0){
					$item_stock = "Available";
					$item_quantity = 1;
				}
			}

			$dt = array(
				'item_date_time' => $item_date_time,
				'item_code' => $item_code,
				'item_image' => $item_image,
				'item_image2' => $item_image2,
				'item_image3' => $item_image3,
				'item_image4' => $item_image4,
				'item_name' => $item_name,
				'item_packing' => $item_packing,
				'item_expiry' => $item_expiry,
				'item_batch_no' => $item_batch_no,
				'item_company' => $item_company,
				'item_quantity' => $item_quantity,
				'item_stock' => $item_stock,
				'item_ptr' => $item_ptr,
				'item_mrp' => $item_mrp,
				'item_price' => $item_price,
				'item_scheme' => $item_scheme,
				'item_margin' => $item_margin,
				'item_gst' => $item_gst,
				'item_featured' => $item_featured,
				'item_discount' => $item_discount,
				'item_description1' => $item_description1,
				'item_description2' => $item_description2,
				'item_order_quantity' => $item_order_quantity,
			);
			
			$jsonArray[] = $dt;
		}

		$return["items"] = $jsonArray;
		return $return;
	}

	public function add_stock_low($user_type,$user_altercode,$salesman_id,$item_code)
	{
		$date = date('Y-m-d');
		$time = date("H:i",time());
		$where = array('i_code'=>$item_code);
		$row = $this->Scheme_Model->select_row("tbl_medicine",$where);
		if(!empty($row->item_name))
		{
			$item_name 	= $row->item_name;
			$item_code 	= $row->item_code;
			$i_code 	= $row->i_code;
			$where1 = array('item_code'=>$item_code,'date'=>$date,);
			$row1 = $this->Scheme_Model->select_row("tbl_stock_low",$where1);
			if(empty($row1->item_code))
			{
				$dt = array(
				'user_type'=>$user_type,
				'chemist_id'=>$user_altercode,
				'salesman_id'=>$salesman_id,
				'i_code'=>$i_code,
				'item_name'=>$item_name,
				'item_code'=>$item_code,
				'date'=>$date,
				'time'=>$time,
				'status'=>'0',
				'download_status'=>'0',
				);
				$query = $this->Scheme_Model->insert_fun("tbl_stock_low",$dt);
			}
		}
	}

	//medicine_division ke liya only
	public function medicine_division_row_dt($row){
	
		if(!empty($row)){
			
			$item_code			=	($row->company_code);
			$item_company		=	ucwords(strtolower($row->company_name));
			$item_division 		= 	$row->company_division;
			$item_image			=   $this->MedicineImageUrl."uploads/manage_company_division/photo/resize/".$row->image;
			if (empty($row->image)){
				$item_image 	= $this->MedicineImageUrl."uploads/default_img.jpg";
			}
			$item_image 	= htmlentities($item_image);
			
			$dt = array(
				'item_code' => $item_code,
				'item_image' => $item_image,
				'item_company' => $item_company,
				'item_division' => $item_division,
			);

			return $dt;
		}
	}

	public function medicine_details_row_dt($row){

		if(!empty($row)){
			$item_code 			= $row->i_code;
			$item_price 		= sprintf('%0.2f',round($row->sale_rate,2));
			$item_quantity 		= $row->quantity;
			$item_quantity_price= sprintf('%0.2f',round($row->quantity * $row->sale_rate,2));
			$item_date_time 	= date("d-M-y",strtotime($row->date))." @ ".date("h:i a",strtotime($row->time));
			$item_modalnumber 	= "Pc / Laptop"; //$row->modalnumber;
			$item_name 		= (ucwords(strtolower($row->item_name)));
			$item_packing 	= ($row->packing);
			$item_expiry 	= ($row->expiry);
			$item_company 	= (ucwords(strtolower($row->company_full_name)));
			$item_scheme 	= $row->salescm1."+".$row->salescm2;
			$item_image = $this->MedicineImageUrl."uploads/default_img.jpg";
			if(!empty($row->image1))
			{
				$item_image = $this->MedicineImageUrl.$row->image1;
			}
			
			$dt = array(
				'item_code' => $item_code,
				'item_image' => $item_image,
				'item_name' => $item_name,
				'item_packing' => $item_packing,
				'item_expiry' => $item_expiry,
				'item_company' => $item_company,
				'item_scheme' => $item_scheme,
				'item_price' => $item_price,
				'item_quantity' => $item_quantity,
				'item_quantity_price' => $item_quantity_price,
				'item_date_time' => $item_date_time,
				'item_modalnumber' => $item_modalnumber,
			);
			return $dt;
		}
	}
	
	//medicine_item ke liya only
	public function medicine_item_row_dt($row,$SessionValue){

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
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

	public function get_item_category_name($code){
		$this->db->select("menu");
		$this->db->where('code',$code);
		$row = $this->db->get("tbl_medicine_menu")->row();
		if(!empty($row)){
			return $row->menu;
		}else{
			return "";
		}
	}
	
	public function medicine_category_api($SessionValue="",$ChemistNrx="",$itemcat="",$show_out_of_stock="0",$get_record="0",$limit="12",$order_by_type="RAND")
	{
		$jsonArray = array();
		$title = "";

		$this->db->select("i_code,item_name,packing,salescm1,salescm2,company_name,batchqty,mrp,sale_rate,final_price,margin,featured,image1,misc_settings");
		$this->db->where('itemcat',$itemcat);
		/************************************ */
		$where = "status=1 and `misc_settings` NOT LIKE '%gift%' and category!='g'";
		$this->db->where($where);
		if($ChemistNrx=="yes"){
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
			$jsonArray[] = $this->page_row_dt($row,$SessionValue);
		}

		$return["items"] = $jsonArray;
		$return["title"] = $this->get_item_category_name($itemcat);
		$return["get_record"] = $get_record;
		return $return;
	}

	public function featured_brand_api($session_yes_no="",$user_nrx="",$compcode="",$division="",$get_record="")
	{
		$jsonArray = array();
		$title = "";

		/******************************* */
		if($user_nrx=="yes"){
		}else{
			$where="misc_settings!='#NRX'";
			$this->db->where($where);
		}
		/******************************* */

		$this->db->where('compcode',$compcode);
		if(!empty($division)){
			$this->db->where('division',$division);
		}
		//$this->db->where('status','1'); // chnage by 2023-10-03
		$this->db->order_by('featured','desc');
		$this->db->order_by('batchqty','desc');
		$this->db->order_by('item_name','asc');
		$this->db->limit(12,$get_record);
		$query = $this->db->get("tbl_medicine")->result();
		$i = 0;
		$items = "";
		foreach ($query as $row)
		{
			if((substr($row->item_name,0,1)==".") && ($row->misc_settings=="#ITNOTE" && $row->batchqty=="0.000") && ($row->sale_rate=="0" || $row->sale_rate=="0.0"))
			{
			}
			else
			{						
				$item_featured 		= 	$row->featured;
				if($item_featured=="1")
				{			
					$id					=	$row->id;	
					$i++;
					if($i<4)
					{		
						$get_record++;						
						$sameid[$id]    =	$id;
						$item_code		=	$row->i_code;
						$item_name		=	ucwords(strtolower($row->item_name));		
						$item_packing	=	$row->packing;	
						$item_scheme	=	$row->salescm1."+".$row->salescm2;			
						$item_company 	= 	ucwords(strtolower($row->company_full_name));
						$item_margin	=	round($row->margin);
						$item_quantity	=	$row->batchqty;
						$item_featured 	= 	$row->featured;				
						$item_mrp		=	sprintf('%0.2f',round($row->mrp,2));
						$item_ptr		=	sprintf('%0.2f',round($row->sale_rate,2));
						$item_price		=	sprintf('%0.2f',round($row->final_price,2));
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
						$title = ucwords(strtolower($row->company_full_name));
						
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
				}
			}
		}
		foreach ($query as $row)
		{
			if((substr($row->item_name,0,1)==".") && ($row->misc_settings=="#ITNOTE" && $row->batchqty=="0.000") && ($row->sale_rate=="0" || $row->sale_rate=="0.0"))
			{
			}
			else
			{						
				$id		=	$row->id;
				if(empty($sameid[$id]))
				{
					$get_record++;
					$item_code		=	$row->i_code;
					$item_name		=	ucwords(strtolower($row->item_name));		
					$item_packing	=	$row->packing;
					$item_scheme	=	$row->salescm1."+".$row->salescm2;			
					$item_company 	= 	ucwords(strtolower($row->company_full_name));
					$item_margin	=	round($row->margin);
					$item_quantity	=	$row->batchqty;
					$item_featured 	= 	$row->featured;
					$item_mrp		=	sprintf('%0.2f',round($row->mrp,2));
					$item_ptr		=	sprintf('%0.2f',round($row->sale_rate,2));
					$item_price		=	sprintf('%0.2f',round($row->final_price,2));
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
					$title = ucwords(strtolower($row->company_full_name)); 
					
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
			}
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
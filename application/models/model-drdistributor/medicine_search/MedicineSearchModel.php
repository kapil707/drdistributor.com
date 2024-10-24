<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineSearchModel extends CI_Model  
{
	var $db_medicine;
	public function __construct(){

		parent::__construct();
		// Load model
	}

	public function medicine_search_api($keyword="",$user_nrx="",$total_rec="",$checkbox_medicine="",$checkbox_company="",$checkbox_out_of_stock="")
	{		
		$jsonArray = array();
		$item_count = 0;
		
		if($total_rec=="all"){
			$total_rec = 250;
		}
		/***********************************************/
		$characters_to_remove = array(" ","-",".", "`", "'", "/", "(", ")", "%", ",","%20");
		$keyword_title = str_replace($characters_to_remove, "", $keyword);
		$keyword_item_name = $keyword;
		$keyword_array = explode (" ", $keyword); 
		/********************************************************* */
		$this->db->select('m.id, m.i_code, m.item_name, m.packing, m.expiry, m.company_full_name, m.batchqty, m.sale_rate, m.mrp, m.final_price, m.title2, m.image1, m.salescm1, m.salescm2, m.margin, m.featured, m.misc_settings, m.itemjoinid');
		$this->db->from('tbl_medicine as m');
		$this->db->where('status', 1);
		$this->db->where('`misc_settings` NOT LIKE "%gift%"', NULL, FALSE);
		$this->db->where('category !=', 'g');

		if ($checkbox_out_of_stock == 0) {
			$this->db->where('m.batchqty !=', '0');
		}

		if ($user_nrx != "yes") {
			$this->db->where('misc_settings !=', '#NRX');
		}

		$this->db->group_start();

		if ($checkbox_medicine == 1 && $checkbox_company == 1) {
			$this->db->like('item_name', $keyword_item_name, 'both');
			$this->db->or_like('title', $keyword_item_name, 'both');
			$this->db->or_like('company_full_name', $keyword_item_name, 'both');
		}

		if ($checkbox_medicine == 1 && $checkbox_company == 0) {
			$this->db->like('item_name', $keyword_item_name, 'both');
			$this->db->or_like('title', $keyword_item_name, 'both');
		}

		if ($checkbox_medicine == 0 && $checkbox_company == 1) {
			$this->db->like('company_full_name', $keyword_item_name);
		}

		if ($checkbox_medicine == 0 && $checkbox_company == 0) {
			$this->db->like('packing', $keyword_item_name, 'both');
			$this->db->or_like('batch_no', $keyword_item_name, 'both');
			$this->db->or_like('title2', $keyword_item_name, 'both');
			$this->db->or_like('description', $keyword_item_name, 'both');
		}
		foreach($keyword_array as $row_val){
			//$this->db->or_like('item_name', $row_val);
		}
		$this->db->group_end();

		// Sorting logic
		$this->db->order_by("CASE WHEN m.batchqty = 0 THEN 1 ELSE 0 END", NULL, FALSE);

		$order_case = "CASE ";
		if ($checkbox_medicine == 1 && $checkbox_company == 1) {
			$order_case .= "
				WHEN item_name LIKE '{$this->db->escape_like_str($keyword_item_name)}%' THEN 1
				WHEN item_name LIKE '%{$this->db->escape_like_str($keyword_item_name)}%' AND item_name NOT LIKE '{$this->db->escape_like_str($keyword_item_name)}%' THEN 2
				WHEN item_name LIKE '%{$this->db->escape_like_str($keyword_item_name)}' THEN 3
				WHEN title LIKE '{$this->db->escape_like_str($keyword_item_name)}%' THEN 4
				WHEN title LIKE '%{$this->db->escape_like_str($keyword_item_name)}%' AND title NOT LIKE '{$this->db->escape_like_str($keyword_item_name)}%' THEN 5
				WHEN title LIKE '%{$this->db->escape_like_str($keyword_item_name)}' THEN 6
				WHEN company_full_name LIKE '{$this->db->escape_like_str($keyword_item_name)}%' THEN 7
				WHEN company_full_name LIKE '%{$this->db->escape_like_str($keyword_item_name)}%' AND company_full_name NOT LIKE '{$this->db->escape_like_str($keyword_item_name)}%' THEN 8
				WHEN company_full_name LIKE '%{$this->db->escape_like_str($keyword_item_name)}' THEN 9
				ELSE 10
			";
		} elseif ($checkbox_medicine == 1) {
			$order_case .= "
				WHEN item_name LIKE '{$this->db->escape_like_str($keyword_item_name)}%' THEN 1
				WHEN item_name LIKE '%{$this->db->escape_like_str($keyword_item_name)}%' AND item_name NOT LIKE '{$this->db->escape_like_str($keyword_item_name)}%' THEN 2
				WHEN item_name LIKE '%{$this->db->escape_like_str($keyword_item_name)}' THEN 3
				WHEN title LIKE '{$this->db->escape_like_str($keyword_item_name)}%' THEN 4
				WHEN title LIKE '%{$this->db->escape_like_str($keyword_item_name)}%' AND title NOT LIKE '{$this->db->escape_like_str($keyword_item_name)}%' THEN 5
				WHEN title LIKE '%{$this->db->escape_like_str($keyword_item_name)}' THEN 6
				ELSE 7
			";
		} elseif ($checkbox_company == 1) {
			$order_case .= "
				WHEN company_full_name LIKE '{$this->db->escape_like_str($keyword_item_name)}%' THEN 1
				WHEN company_full_name LIKE '%{$this->db->escape_like_str($keyword_item_name)}%' AND company_full_name NOT LIKE '{$this->db->escape_like_str($keyword_item_name)}%' THEN 2
				WHEN company_full_name LIKE '%{$this->db->escape_like_str($keyword_item_name)}' THEN 3
				ELSE 4
			";
		}
		if ($checkbox_medicine == 1 || $checkbox_company == 1) {
			$order_case .= "END";
			$this->db->order_by($order_case, NULL, FALSE);
		}
		$this->db->order_by('m.batchqty', 'DESC');
		$this->db->order_by('m.item_name', 'ASC');
		$this->db->limit($total_rec);

		$query = $this->db->get()->result();
		foreach ($query as $row)
		{
			$item_count++;
			$jsonArray[] = $this->medicine_search_row($row,$item_count);
		}
		return $jsonArray;
	}	

	public function medicine_search_api_old($keyword="",$user_nrx="",$total_rec="",$checkbox_medicine="",$checkbox_company="",$checkbox_out_of_stock="")
	{
		$db_medicine1 = $db_medicine2 = $db_medicine3 = $db_medicine4 = $db_medicine5 = $db_medicine6 = $this->db;
		
		$jsonArray = array();
		$query1 = $query2 = $query3 = $query4 = $query5 = $query6 = array(); 
		$sameid = array();
		$count_record = 0;
		$item_count = 0;
		
		if($total_rec=="all"){
			$total_rec = 250;
		}
		
		/***********************************************/
		$characters_to_remove = array(" ","-",".", "`", "'", "/", "(", ")", "%", ",","%20");
		$keyword_title = str_replace($characters_to_remove, "", $keyword);
		$keyword_item_name = $keyword;
		$keyword_array = explode (" ", $keyword); 
		/***********************************************/	
		

		if($checkbox_medicine=="1"){
			
			/**************item_name search part1*******************/
			$where = $sameid_where = "";
			
			$db_medicine1->select("m.id,m.i_code,m.item_name,m.packing,m.expiry,m.company_full_name,m.batchqty,m.sale_rate,m.mrp,m.final_price,m.title2,m.image1,m.salescm1,m.salescm2,m.margin,m.featured,m.misc_settings,m.itemjoinid");		
			
			//only item_name
			$where.= "(item_name='$keyword_item_name' or title='$keyword_title') ";
				
			$where.= "and status=1 and `misc_settings` NOT LIKE '%gift%' and category!='g'";
			
			if($user_nrx=="yes"){
				//$where.=" ";
			}else{
				$where.=" and misc_settings!='#NRX' ";
			}
			
			if(!empty($sameid))
			{
				$mylist = implode(',', $sameid); 
				$sameid_where = " and m.id not in(".$mylist.")";
				$db_medicine1->where($where.$sameid_where);
			}else{
				$db_medicine1->where($where);
			}
			
			if($total_rec!="all"){
				$db_medicine1->limit($total_rec);
			}
			$db_medicine1->order_by('m.batchqty desc','m.item_name asc');

			$query1 = $db_medicine1->get("tbl_medicine as m")->result();
			foreach($query1 as $row){
				$sameid[] = $row->id;
			}
			
			/**************item_name search part2*******************/
			if(($total_rec>$count_record || $total_rec=="all")) {
				
				$where = $sameid_where = "";
				
				$db_medicine2->select("m.id,m.i_code,m.item_name,m.packing,m.expiry,m.company_full_name,m.batchqty,m.sale_rate,m.mrp,m.final_price,m.title2,m.image1,m.salescm1,m.salescm2,m.margin,m.featured,m.misc_settings,m.itemjoinid");
				
				//only item_name
				$where.= "(item_name like '".$keyword_item_name."%' or title like '".$keyword_title."%') ";	
				
				$where.= "and status=1 and `misc_settings` NOT LIKE '%gift%' and category!='g'";
			
				if($user_nrx=="yes"){
					//$where.=" ";
				}else{
					$where.=" and misc_settings!='#NRX' ";
				}
				
				if(!empty($sameid))
				{
					$mylist = implode(',', $sameid); 
					$sameid_where = " and m.id not in(".$mylist.")";
					$db_medicine2->where($where.$sameid_where);
				}else{
					$db_medicine2->where($where);
				}
				
				if($total_rec!="all"){
					$db_medicine2->limit($total_rec);
				}
				$db_medicine2->order_by('m.batchqty desc','m.item_name asc');

				$query2 = $db_medicine2->get("tbl_medicine as m")->result();
				foreach($query2 as $row){
					$sameid[] = $row->id;
				}
			}
			
			
			/**************item_name search part3*******************/
			if(($total_rec>$count_record || $total_rec=="all")) {
				
				$where = $sameid_where = "";
				
				$db_medicine3->select("m.id,m.i_code,m.item_name,m.packing,m.expiry,m.company_full_name,m.batchqty,m.sale_rate,m.mrp,m.final_price,m.title2,m.image1,m.salescm1,m.salescm2,m.margin,m.featured,m.misc_settings,m.itemjoinid");
				
				//only item_name
				$where.= "(item_name like '%".$keyword_item_name."%' or title like '%".$keyword_title."%') ";
				
				$where.= "and status=1 and `misc_settings` NOT LIKE '%gift%' and category!='g'";
			
				if($user_nrx=="yes"){
					//$where.=" ";
				}else{
					$where.=" and misc_settings!='#NRX' ";
				}
				
				if(!empty($sameid))
				{
					$mylist = implode(',', $sameid); 
					$sameid_where = " and m.id not in(".$mylist.")";
					$db_medicine3->where($where.$sameid_where);
				}else{
					$db_medicine3->where($where);
				}
				
				if($total_rec!="all"){
					$db_medicine3->limit($total_rec);
				}
				$db_medicine3->order_by('m.batchqty desc','m.item_name asc');

				$query3 = $db_medicine3->get("tbl_medicine as m")->result();
				foreach($query3 as $row){
					$sameid[] = $row->id;
				}
			}
			
			
			/**************title search part4*******************/
			if(($total_rec>$count_record || $total_rec=="all")) {
				
				$where = $sameid_where = "";
				
				$db_medicine4->select("m.id,m.i_code,m.item_name,m.packing,m.expiry,m.company_full_name,m.batchqty,m.sale_rate,m.mrp,m.final_price,m.title2,m.image1,m.salescm1,m.salescm2,m.margin,m.featured,m.misc_settings,m.itemjoinid");			
				
				//only title
				$where.= "(item_name like '%".$keyword_item_name."' or title like '%".$keyword_title."') ";
					
				$where.= "and status=1 and `misc_settings` NOT LIKE '%gift%' and category!='g'";
			
				if($user_nrx=="yes"){
					//$where.=" ";
				}else{
					$where.=" and misc_settings!='#NRX' ";
				}
				
				if(!empty($sameid))
				{
					$mylist = implode(',', $sameid); 
					$sameid_where = " and m.id not in(".$mylist.")";
					$db_medicine4->where($where.$sameid_where);
				}else{
					$db_medicine4->where($where);
				}
				
				if($total_rec!="all"){
					$db_medicine4->limit($total_rec);
				}
				$db_medicine4->order_by('m.batchqty desc','m.item_name asc');

				$query4 = $db_medicine4->get("tbl_medicine as m")->result();
				foreach($query4 as $row){
					$sameid[] = $row->id;
				}
			}
			
			/**************title search part4*******************/
			if(($total_rec>$count_record || $total_rec=="all")) {
				
				$where = $sameid_where = "";
				
				$db_medicine5->select("m.id,m.i_code,m.item_name,m.packing,m.expiry,m.company_full_name,m.batchqty,m.sale_rate,m.mrp,m.final_price,m.title2,m.image1,m.salescm1,m.salescm2,m.margin,m.featured,m.misc_settings,m.itemjoinid");			
				
				//only title
				$where.= "(packing like '%".$keyword_item_name."' or packing like '".$keyword_item_name."%' or packing like '%".$keyword_item_name."%' ) ";
					
				$where.= "and status=1 and `misc_settings` NOT LIKE '%gift%' and category!='g'";
			
				if($user_nrx=="yes"){
					//$where.=" ";
				}else{
					$where.=" and misc_settings!='#NRX' ";
				}
				
				if(!empty($sameid))
				{
					$mylist = implode(',', $sameid); 
					$sameid_where = " and m.id not in(".$mylist.")";
					$db_medicine5->where($where.$sameid_where);
				}else{
					$db_medicine5->where($where);
				}
				
				if($total_rec!="all"){
					$db_medicine5->limit($total_rec);
				}
				$db_medicine5->order_by('m.batchqty desc','m.item_name asc');

				$query5 = $db_medicine5->get("tbl_medicine as m")->result();
				foreach($query5 as $row){
					$sameid[] = $row->id;
				}
			}
			/**************************************************/
		}
		
		/*******************company name say search*******************/
		if(($total_rec>$count_record || $total_rec=="all") && $checkbox_company=="1") {
			$where = $sameid_where = "";
			
			$db_medicine6->select("m.id,m.i_code,m.item_name,m.packing,m.expiry,m.company_full_name,m.batchqty,m.sale_rate,m.mrp,m.final_price,m.title2,m.image1,m.salescm1,m.salescm2,m.margin,m.featured,m.misc_settings,m.itemjoinid");
			
			//only title
			$where.= "(company_full_name='$keyword' or company_full_name like '".$keyword_item_name."%' or company_full_name like '%".$keyword_item_name."' or company_full_name like '%".$keyword_item_name."%') ";
				
			$where.= "and status=1 and `misc_settings` NOT LIKE '%gift%' and category!='g'";

			if($user_nrx=="yes"){
				//$where.=" ";
			}else{
				$where.=" and misc_settings!='#NRX' ";
			}

			if(!empty($sameid))
			{
				$mylist = implode(',', $sameid); 
				$sameid_where = " and m.id not in(".$mylist.")";
				$db_medicine6->where($where.$sameid_where);
			}else{
				$db_medicine6->where($where);
			}

			if($total_rec!="all"){
				$db_medicine6->limit($total_rec);
			}
			$db_medicine6->order_by('m.batchqty desc','m.item_name asc');

			$query6 = $db_medicine6->get("tbl_medicine as m")->result();
			foreach($query6 as $row){
				$sameid[] = $row->id;
			}
		}
		
		/***********************************************************/
		$query = array_merge($query1,$query2,$query3,$query4,$query5,$query6);
		foreach ($query as $row)
		{
			$sameid[] = $row->id;
			if($row->batchqty!=0 && $total_rec>$count_record){
				$count_record++;
				$item_count++;
				$jsonArray[] = $this->medicine_search_row($row,$item_count);
			}
		}
		foreach ($query as $row)
		{
			if($checkbox_out_of_stock=="1" && $row->batchqty==0 && $total_rec>$count_record){
				$count_record++;
				$item_count++;
				$jsonArray[] = $this->medicine_search_row($row,$item_count);
			}
		}
		
		
		/***************jab kuch be nahi milta ha to yha chalti ha*********************/
		
		if($checkbox_medicine=="1" && $count_record==0) {
			foreach($keyword_array as $keyword_row){
				if(!empty($keyword_row)) {
					$where = $sameid_where = "";
				
					$db_medicine6->select("m.id,m.i_code,m.item_name,m.packing,m.expiry,m.company_full_name,m.batchqty,m.sale_rate,m.mrp,m.final_price,m.title2,m.image1,m.salescm1,m.salescm2,m.margin,m.featured,m.misc_settings,m.itemjoinid");
					
					//only title
					$where.= "(title like '".$keyword_row."%') ";
						
					$where.= "and status=1 and `misc_settings` NOT LIKE '%gift%' and category!='g'";
			
					if($user_nrx=="yes"){
						//$where.=" ";
					}else{
						$where.=" and misc_settings!='#NRX' ";
					}
					
					if(!empty($sameid))
					{
						$mylist = implode(',', $sameid); 
						$sameid_where = " and m.id not in(".$mylist.")";
						$db_medicine6->where($where.$sameid_where);
					}else{
						$db_medicine6->where($where);
					}
					
					if($total_rec!="all"){
						$db_medicine6->limit($total_rec);
					}
					$db_medicine6->order_by('m.batchqty desc','m.item_name asc');

					$query6 = $db_medicine6->get("tbl_medicine as m")->result();
					/**********************************************************/
					foreach ($query6 as $row)
					{
						$sameid[] = $row->id;
						if($row->batchqty!=0 && $total_rec>$count_record){
							$count_record++;
							$item_count++;
							$jsonArray[] = $this->medicine_search_row($row,$item_count);
						}
					}
					foreach ($query6 as $row)
					{
						if($checkbox_out_of_stock=="1" && $row->batchqty==0 && $total_rec>$count_record){
							$count_record++;
							$item_count++;
							$jsonArray[] = $this->medicine_search_row($row,$item_count);
						}
					}
				}
			}
		}
		$mergedArray = array_merge($jsonArray);
		$jsonString  = ($mergedArray);
		return $jsonArray;
	}	
	
	public function medicine_search_row($row,$item_count)
	{
		$date_time = date('d-M h:i A');
		
		$item_code			=	$row->i_code;
		$item_name			=	(ucwords(strtolower($row->item_name)));
		$item_packing		=	($row->packing);
		$item_expiry		=	($row->expiry);
		$item_company		=	(ucwords(strtolower($row->company_full_name)));
		$item_quantity		=	$row->batchqty;
		$item_ptr			=	sprintf('%0.2f',round($row->sale_rate,2));
		$item_mrp			=	sprintf('%0.2f',round($row->mrp,2));
		$item_price			=	sprintf('%0.2f',round($row->final_price,2));
		
		$item_description  = (trim($row->title2));
		if(!empty($item_description)){
			$item_description  = substr($item_description,0,100).'...';
		}
		
		$item_image = base_url()."uploads/default_img.webp";
		if(!empty($row->image1))
		{
			$item_image = constant('img_url_site').$row->image1;
		}
		//$item_image = str_replace(" ","%20",$item_image);

		$item_scheme		=	$row->salescm1."+".$row->salescm2;
		$item_margin 		=   round($row->margin);
		$item_featured 		= 	$row->featured;
		$misc_settings 		= 	$row->misc_settings;

		$item_stock = "";
		if($misc_settings=="#NRX" && $item_quantity>=10){
			$item_stock = "Available";
		}

		if(strpos($misc_settings,"#ITNOTE")!== false) {
			$item_description = $row->itemjoinid;
		}
		
		$similar_items = "";
		$itemjoinid = 	$row->itemjoinid;
		if($itemjoinid!="") {
			$similar_items = "View similar items";
		}
		
		$dt = array(
			'item_count' => $item_count,
			'item_code' => $item_code,
			'item_image' => $item_image,
			'item_name' => $item_name,
			'item_packing' => $item_packing,
			'item_expiry' => $item_expiry,
			'item_company' => $item_company,
			'item_quantity' => $item_quantity,
			'item_stock' => $item_stock,
			'item_ptr' => $item_ptr,
			'item_mrp' => $item_mrp,
			'item_price' => $item_price,
			'item_scheme' => $item_scheme,
			'item_margin' => $item_margin,
			'item_featured' => $item_featured,
			'item_description' => $item_description,
			'similar_items' => $similar_items,
		);
		return $dt;
	}
}


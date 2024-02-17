<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineDetailsModel extends CI_Model  
{
	var $db_medicine;
	public function __construct(){

		parent::__construct();

		// Load model
		$this->db_medicine = $this->load->database('default2', TRUE);
	}

	public function medicine_details_api($user_type,$user_altercode,$salesman_id,$item_code)
	{
		$jsonArray = array();
		$this->insert_top_search($user_type,$user_altercode,$salesman_id,$item_code);
		$items = "";
		$item_date_time = date('d-M h:i A');
		
		$db_medicine = $this->db_medicine;
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
			$item_expiry		=	($row->expiry);
			$item_batch_no		=	($row->batch_no);
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
			}
			if(empty($item_discount))
			{
				$item_discount = "4.5";
			}
			$item_description1 = (trim($row->title2));
			$item_description2 = (trim($row->description));
			
			$img_url_site = constant('img_url_site');

			$item_image  = $img_url_site."uploads/default_img.jpg";
			$item_image2 = $img_url_site."uploads/default_img.jpg";
			$item_image3 = $img_url_site."uploads/default_img.jpg";
			$item_image4 = $img_url_site."uploads/default_img.jpg";
			if(!empty($row->image1))
			{
				$item_image = $img_url_site.$row->image1;
			}
			if(!empty($row->image2))
			{
				$item_image2 = $img_url_site.$row->image2;
			}
			if(!empty($row->image3))
			{
				$item_image3 = $img_url_site.$row->image3;
			}
			if(!empty($row->image4))
			{
				$item_image4 = $img_url_site.$row->image4;
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
				}
			}
			$item_order_quantity = "";
			$where1 = array('chemist_id'=>$user_altercode,'selesman_id'=>$salesman_id,'user_type'=>$user_type,'i_code'=>$item_code,'status'=>'0');
			//$this->db->select(*);
			$this->db->where($where1);
			$row1 = $this->db->get("drd_temp_rec")->row();
			if(!empty($row1->id))
			{
				$item_order_quantity = $row1->quantity;
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

	public function insert_top_search($user_type,$user_altercode,$salesman_id,$item_code)
	{
		$where = array('user_altercode'=>$user_altercode,'salesman_id'=>$salesman_id,'user_type'=>$user_type,'item_code'=>$item_code);
		$row = $this->Scheme_Model->select_row("tbl_top_search",$where);
		if(empty($row))
		{
			$date = date('Y-m-d');
			$time = date("H:i",time());
			$datetime = time();
			$dt = array(
				'user_altercode'=>$user_altercode,
				'salesman_id'=>$salesman_id,
				'user_type'=>$user_type,
				'item_code'=>$item_code,
				'date'=>$date,
				'time'=>$time,
				'datetime'=>$datetime,
			);
			$this->Scheme_Model->insert_fun("tbl_top_search",$dt);
		}
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

	public function medicine_search_api($keyword="",$user_nrx="",$total_rec="",$checkbox_medicine="",$checkbox_company="",$checkbox_out_of_stock="")
	{
		$db_medicine1 = $db_medicine2 = $db_medicine3 = $db_medicine4 = $db_medicine5 = $db_medicine6 = $this->db_medicine;
		
		$jsonArray = array();
		$query1 = $query2 = $query3 = $query4 = $query5 = $query6 = array(); 
		$sameid = $sameid1 = $sameid2 = $sameid3 = $sameid4 = $sameid5 = $sameid6 = "";
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
				//$mylist = implode(',', $sameid); 
				$sameid_where = " and m.id not in(".$sameid.")";
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
				$id		=	$row->id;
				$sameid1.= $id.",";
			}
			if(!empty($sameid1)){
				$sameid.= substr($sameid1,0,-1);
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
					//$mylist = implode(',', $sameid); 
					$sameid_where = " and m.id not in(".$sameid.")";
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
					$id		=	$row->id;
					$sameid2.= $id.",";
				}
				if(!empty($sameid2)){
					$sameid.= substr($sameid2,0,-1);
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
					//$mylist = implode(',', $sameid); 
					$sameid_where = " and m.id not in(".$sameid.")";
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
					$id		=	$row->id;
					$sameid3.= $id.",";
				}
				if(!empty($sameid3)){
					$sameid.= substr($sameid3,0,-1);
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
					//$mylist = implode(',', $sameid); 
					$sameid_where = " and m.id not in(".$sameid.")";
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
					$id		=	$row->id;
					$sameid4.= $id.",";
				}
				if(!empty($sameid4)){
					$sameid.= substr($sameid4,0,-1);
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
					//$mylist = implode(',', $sameid); 
					$sameid_where = " and m.id not in(".$sameid.")";
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
					$id		=	$row->id;
					$sameid5.= $id.",";
				}
				if(!empty($sameid5)){
					$sameid.= substr($sameid5,0,-1);
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
				//$mylist = implode(',', $sameid); 
				$sameid_where = " and m.id not in(".$sameid.")";
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
				$id		=	$row->id;
				$sameid6.= $id.",";
			}
			if(!empty($sameid6)){
				$sameid.= substr($sameid6,0,-1);
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
						//$mylist = implode(',', $sameid); 
						$sameid_where = " and m.id not in(".$sameid.")";
						$db_medicine6->where($where.$sameid_where);
					}else{
						$db_medicine6->where($where);
					}
					
					if($total_rec!="all"){
						$db_medicine6->limit($total_rec);
					}
					$db_medicine6->order_by('m.batchqty desc','m.item_name asc');

					$query6 = $db_medicine6->get("tbl_medicine as m")->result();
					/***********************************************************/
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
		
		/***********************************************************/
		$mergedArray = array_merge($jsonArray);
		$jsonString  = ($mergedArray);
		return $jsonString;
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
		
		$item_description  = 	(trim($row->title2));
		$item_description  =   ($item_description);
		$item_image = constant('img_url_site')."uploads/default_img.jpg";
		if(!empty($row->image1))
		{
			$item_image = constant('img_url_site').$row->image1;
		}
		$item_image = str_replace(" ","%20",$item_image);

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
		if($itemjoinid!="")
		{
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
			'item_featured' => $item_featured,
			'similar_items' => $similar_items,
		);
		return $dt;
	}
}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');
ini_set('post_max_size', '100M');
ini_set('upload_max_filesize', '100M');
ini_set('max_execution_time', 36000);
require_once APPPATH."/third_party/PHPExcel.php";
class MedicineSearchModel extends CI_Model  
{
	function new_clean($string) {
		$k= str_replace('\n', '<br>', $string);
		$k= preg_replace('/[^A-Za-z0-9\#]/', ' ', $k);
		return $k;
		//return preg_replace('/[^A-Za-z0-9\#]/', '', $string); // Removes special chars.
	}	
	
	public function search_medicine($keyword)
	{
		//error_reporting(0);
		$sameid = "";
		$items = "";
		$count = 0;
		$date_time = date('d-M h:i A');
		$items = "";
		$keyword = str_replace("'","",$keyword);
		$keyword_title = str_replace("-","",$keyword);
		$keyword_title = str_replace(".","",$keyword_title);
		$keyword_title = str_replace("`","",$keyword_title);
		$keyword_title = str_replace("'","",$keyword_title);
		$keyword_title = str_replace("/","",$keyword_title);
		$keyword_title = str_replace("(","",$keyword_title);
		$keyword_title = str_replace(")","",$keyword_title);
		$keyword_title = str_replace("%","",$keyword_title);
		$keyword_title = str_replace(",","",$keyword_title);		
		$keyword_title = str_replace("%20","",$keyword_title);
		$keyword_title = str_replace(" ","",$keyword_title);
		
		$keyword_name = str_replace("%20"," ",$keyword);
		
		$this->db->select("m.*");
		$this->db->where("(title='$keyword_title' or title like '".$keyword_title."%' or item_name='$keyword_title' or item_name='$keyword_name' or item_name like '".$keyword_name."%' or company_full_name='$keyword_title' or company_full_name like '".$keyword_name."%') and status=1");
		$this->db->limit(20);
		$this->db->order_by('m.item_name','asc');
		$query = $this->db->get("tbl_medicine as m")->result();
		foreach ($query as $row)
		{
			$id		=	$row->id;
			$items.=$this->search_medicine_new($row,$id,$count,$date_time);
			$count++;
			
			$sameid.= $id.",";
		}
		$sameid = substr($sameid,0,-1);
		if(!empty($sameid))
		{
			$sameid = " and m.id not in(".$sameid.")";
		}
		
		$this->db->select("m.*");
		$this->db->where("(title like '%".$keyword_title."%' or item_name like '%".$keyword_name."%' or company_full_name like '%".$keyword_name."%') and status=1 ".$sameid);
		$this->db->limit(20);
		$this->db->order_by('m.item_name','asc');
		$query = $this->db->get("tbl_medicine as m")->result();
		foreach ($query as $row)
		{
			$id	= $row->id;
			$items.=$this->search_medicine_new($row,$id,$count,$date_time);
			$count++;
		}
if ($items != ''){
	$items = substr($items, 0, -1);
}
	return $items;
	}
	
	public function search_medicine_new($row,$id,$count,$date_time)
	{
		$i_code				=	$row->i_code;
		$item_code			=	$row->item_code;
		$title				=	$row->title;
		$item_name			=	htmlentities(ucwords(strtolower($row->item_name)));
		$company_name		=	htmlentities(ucwords(strtolower($row->company_name)));
		$company_full_name 	=  	htmlentities(ucwords(strtolower($row->company_full_name)));
		$batchqty			=	$row->batchqty;
		$batch_no			=	htmlentities($row->batch_no);
		$packing			=	htmlentities($row->packing);
		$sale_rate			=	sprintf('%0.2f',round($row->sale_rate,2));
		$mrp				=	sprintf('%0.2f',round($row->mrp,2));
		$final_price		=	sprintf('%0.2f',round($row->final_price,2));
		$scheme				=	$row->salescm1."+".$row->salescm2;
		$expiry				=	$row->expiry;				
		$compcode 			=   $row->compcode;				
		$item_date 			=   $row->item_date;
		$margin 			=   round($row->margin);				
		$misc_settings		=   $row->misc_settings;
		$gstper				=	$row->gstper;
		$itemjoinid			=	$row->itemjoinid;
		$featured 			= 	$row->featured;
		$discount 			= 	$row->discount;
		
		if(empty($discount))
		{
			$discount = "4.5";
		}
		
		$description1 = $this->new_clean(trim($row->title2));
		$description2 = $this->new_clean(trim($row->description));
		$image1 = constant('img_url_site')."uploads/default_img.jpg";
		$image2 = constant('img_url_site')."uploads/default_img.jpg";
		$image3 = constant('img_url_site')."uploads/default_img.jpg";
		$image4 = constant('img_url_site')."uploads/default_img.jpg";
		if(!empty($row->image1))
		{
			$image1 = constant('img_url_site').$row->image1;
		}
		if(!empty($row->image2))
		{
			$image2 = constant('img_url_site').$row->image2;
		}
		if(!empty($row->image3))
		{
			$image3 = constant('img_url_site').$row->image3;
		}
		if(!empty($row->image4))
		{
			$image4 = constant('img_url_site').$row->image4;
		}
		
		$itemjoinid = "";
		$items1 = "";
		if($itemjoinid!="")
		{
			$itemjoinid1 = explode (",", $itemjoinid);
			foreach($itemjoinid1 as $item_code_n)
			{
				$items1.= $this->get_itemjoinid($item_code_n);
			}
			if (!empty($items1)) {
				$items1 = substr($items1, 0, -1);
			}
			
			if (!empty($items1)) {
				$items1 = ',"items1":['.$items1.']';
			} else{
				$itemjoinid = "";
				$items1 = ',"items1":""';
			}
		}
		else
		{
			$items1 = ',"items1":""';
		}
		/********************************************************/
		//$itemjoinid			=	base64_encode($row->itemjoinid);
$items= <<<EOD
{"count":"{$count}","i_code":"{$i_code}","item_code":"{$item_code}","date_time":"{$date_time}","title":"{$title}","item_name":"{$item_name}","company_name":"{$company_name}","company_full_name":"{$company_full_name}","image1":"{$image1}","image2":"{$image2}","image3":"{$image3}","image4":"{$image4}","description1":"{$description1}","description2":"{$description2}","batchqty":"{$batchqty}","sale_rate":"{$sale_rate}","mrp":"{$mrp}","final_price":"{$final_price}","batch_no":"{$batch_no}","packing":"{$packing}","expiry":"{$expiry}","scheme":"{$scheme}","margin":"{$margin}","featured":"{$featured}","gstper":"{$gstper}","discount":"{$discount}","misc_settings":"{$misc_settings}","itemjoinid":"{$itemjoinid}"$items1},
EOD;
		return $items;
	}
	public function medicine_search_api($keyword="",$search_type="",$get_record="")
	{
		//$db2 = $this->load->database('default2', TRUE);
		//error_reporting(0);
		$sameid = "";
		$items = "";
		$count = 1;
		$date_time = date('d-M h:i A');
		$items = "";
		$keyword = str_replace("'","",$keyword);
		$keyword_title = str_replace("-","",$keyword);
		$keyword_title = str_replace(".","",$keyword_title);
		$keyword_title = str_replace("`","",$keyword_title);
		$keyword_title = str_replace("'","",$keyword_title);
		$keyword_title = str_replace("/","",$keyword_title);
		$keyword_title = str_replace("(","",$keyword_title);
		$keyword_title = str_replace(")","",$keyword_title);
		$keyword_title = str_replace("%","",$keyword_title);
		$keyword_title = str_replace(",","",$keyword_title);		
		$keyword_title = str_replace("%20","",$keyword_title);
		$keyword_title = str_replace(" ","",$keyword_title);
		
		$keyword_name = str_replace("%20"," ",$keyword);
		$this->db->select("m.*");
		$this->db->where("(title='$keyword_title' or title like '".$keyword_title."%' or item_name='$keyword_title' or item_name='$keyword_name' or item_name like '".$keyword_name."%') and status=1 and category!='g'");
		if($search_type=="all")
		{
			$this->db->limit(12,$get_record);
			$this->db->order_by('m.item_name asc');
		}
		else
		{
			$this->db->limit(25);
			$this->db->order_by('m.batchqty desc','m.item_name asc');
		}
		$query = $this->db->get("tbl_medicine as m")->result();
		foreach ($query as $row)
		{
			$get_record++;
			$id		=	$row->id;
			$items.=$this->search_medicine2_new($row,$id,$count,$date_time,$get_record);
			$count++;
			
			$sameid.= $id.",";
		}
		$sameid = substr($sameid,0,-1);
		if(!empty($sameid))
		{
			$sameid = " and m.id not in(".$sameid.")";
		}
		
		$this->db->select("m.*");
		$this->db->where("(title like '%".$keyword_title."%' or item_name like '%".$keyword_name."%' or company_full_name like '%".$keyword_name."%' or packing like '".$keyword_name."' or title2 like '".$keyword_name."%' or description like '%".$keyword_name."' or company_full_name='$keyword_title' or company_full_name like '".$keyword_name."%') and status=1 and category!='g'".$sameid);
		if($search_type=="all")
		{
			$this->db->limit(12,$get_record);
			$this->db->order_by('m.item_name asc');
		}
		else
		{
			$this->db->limit(25);
			$this->db->order_by('m.batchqty desc','m.item_name asc');
		}
		$query = $this->db->get("tbl_medicine as m")->result();
		foreach ($query as $row)
		{			
			$get_record++;
			$id	= $row->id;
			$items.=$this->search_medicine2_new($row,$id,$count,$date_time,$get_record);
			$count++;
		}
if ($items != ''){
	$items = substr($items, 0, -1);
}
	return $items;
	}
	
	public function search_medicine2_new($row,$id,$count,$date_time,$get_record)
	{
		$item_code			=	$row->i_code;
		$item_name			=	htmlentities(ucwords(strtolower($row->item_name)));
		$item_packing		=	htmlentities($row->packing);
		$item_expiry		=	htmlentities($row->expiry);
		$item_company		=	htmlentities(ucwords(strtolower($row->company_full_name)));
		$item_quantity		=	$row->batchqty;
		$item_ptr			=	sprintf('%0.2f',round($row->sale_rate,2));
		$item_mrp			=	sprintf('%0.2f',round($row->mrp,2));
		$item_price			=	sprintf('%0.2f',round($row->final_price,2));
		
		$item_description1  = 	htmlentities(trim($row->title2));
		$item_description1  =   $this->new_clean($item_description1);
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
		
		$similar_items = "";
		$itemjoinid = 	$row->itemjoinid;
		if($itemjoinid!="")
		{
			$similar_items = "View similar items";
		}
$items=<<<EOD
{"item_code":"{$item_code}","item_image":"{$item_image}","item_name":"{$item_name}","item_packing":"{$item_packing}","item_expiry":"{$item_expiry}","item_company":"{$item_company}","item_quantity":"{$item_quantity}","item_stock":"{$item_stock}","item_ptr":"{$item_ptr}","item_mrp":"{$item_mrp}","item_price":"{$item_price}","item_scheme":"{$item_scheme}","item_margin":"{$item_margin}","item_featured":"{$item_featured}","item_description1":"{$item_description1}","similar_items":"{$similar_items}","count":"{$count}","get_record":"{$get_record}"},
EOD;
		return $items;
	}
	
	public function medicine_search_api_50($keyword="",$search_type="",$get_record="")
	{
		//$db2 = $this->load->database('default2', TRUE);
		//error_reporting(0);
		$sameid = "";
		$items = "";
		$count = 1;
		$date_time = date('d-M h:i A');
		$items = "";
		$keyword = str_replace("'","",$keyword);
		$keyword_title = str_replace("-","",$keyword);
		$keyword_title = str_replace(".","",$keyword_title);
		$keyword_title = str_replace("`","",$keyword_title);
		$keyword_title = str_replace("'","",$keyword_title);
		$keyword_title = str_replace("/","",$keyword_title);
		$keyword_title = str_replace("(","",$keyword_title);
		$keyword_title = str_replace(")","",$keyword_title);
		$keyword_title = str_replace("%","",$keyword_title);
		$keyword_title = str_replace(",","",$keyword_title);		
		$keyword_title = str_replace("%20","",$keyword_title);
		$keyword_title = str_replace(" ","",$keyword_title);
		
		$keyword_name = str_replace("%20"," ",$keyword);
		$this->db->select("m.id,m.i_code,m.item_name,m.packing,m.expiry,m.company_full_name,m.batchqty,m.sale_rate,m.mrp,m.final_price,m.title2,m.image1,m.salescm1,m.salescm2,m.margin,m.featured,m.misc_settings,m.itemjoinid");
		$this->db->where("(title='$keyword_title' or title like '".$keyword_title."%' or item_name='$keyword_title' or item_name='$keyword_name' or item_name like '".$keyword_name."%') and status=1 and `misc_settings` NOT LIKE '%gift%'");
		if($search_type=="all")
		{
			$this->db->limit(12,$get_record);
			$this->db->order_by('m.item_name asc');
		}
		else
		{
			$this->db->limit(100);
			$this->db->order_by('m.batchqty desc','m.item_name asc');
		}
		$query = $this->db->get("tbl_medicine as m")->result();
		foreach ($query as $row)
		{
			$get_record++;
			$id		=	$row->id;
			$items.=$this->search_medicine2_new_50($row,$id,$count,$date_time,$get_record);
			$count++;
			
			$sameid.= $id.",";
		}
		$sameid = substr($sameid,0,-1);
		if(!empty($sameid))
		{
			$sameid = " and m.id not in(".$sameid.")";
		}
		
		$db2 = $this->load->database('default2', TRUE);
		$db2->select("m.i_code,m.item_name,m.packing,m.expiry,m.company_full_name,m.batchqty,m.sale_rate,m.mrp,m.final_price,m.title2,m.image1,m.salescm1,m.salescm2,m.margin,m.featured,m.misc_settings,m.itemjoinid");
		$db2->where("(title like '%".$keyword_title."%' or item_name like '%".$keyword_name."%' or company_full_name like '%".$keyword_name."%' or packing like '".$keyword_name."' or title2 like '".$keyword_name."%' or description like '%".$keyword_name."' or company_full_name='$keyword_title' or company_full_name like '".$keyword_name."%') and status=1 and `misc_settings` NOT LIKE '%gift%' ".$sameid);
		if($search_type=="all")
		{
			$db2->limit(12,$get_record);
			$db2->order_by('m.item_name asc');
		}
		else
		{
			$db2->limit(100);
			$db2->order_by('m.batchqty desc','m.item_name asc');
		}
		$query = $db2->get("tbl_medicine as m")->result();
		foreach ($query as $row)
		{			
			$get_record++;
			$id	= $row->id;
			$items.=$this->search_medicine2_new_50($row,$id,$count,$date_time,$get_record);
			$count++;
		}
if ($items != ''){
	$items = substr($items, 0, -1);
}
	return $items;
	}
	public function search_medicine2_new_50($row,$id,$count,$date_time,$get_record)
	{
		$item_code			=	$row->i_code;
		$item_name			=	htmlentities(ucwords(strtolower($row->item_name)));
		$item_packing		=	htmlentities($row->packing);
		$item_expiry		=	htmlentities($row->expiry);
		$item_company		=	htmlentities(ucwords(strtolower($row->company_full_name)));
		$item_quantity		=	$row->batchqty;
		$item_ptr			=	sprintf('%0.2f',round($row->sale_rate,2));
		$item_mrp			=	sprintf('%0.2f',round($row->mrp,2));
		$item_price			=	sprintf('%0.2f',round($row->final_price,2));
		
		$item_description  = 	htmlentities(trim($row->title2));
		$item_description  =   $this->new_clean($item_description);
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
$items=<<<EOD
{"item_code":"{$item_code}","item_image":"{$item_image}","item_name":"{$item_name}","item_packing":"{$item_packing}","item_expiry":"{$item_expiry}","item_company":"{$item_company}","item_quantity":"{$item_quantity}","item_stock":"{$item_stock}","item_ptr":"{$item_ptr}","item_mrp":"{$item_mrp}","item_price":"{$item_price}","item_scheme":"{$item_scheme}","item_margin":"{$item_margin}","item_featured":"{$item_featured}","item_description":"{$item_description}","similar_items":"{$similar_items}","count":"{$count}","get_record":"{$get_record}"},
EOD;
		return $items;
	}
	
	public function medicine_search_api_51($keyword="",$search_type="",$get_record="",$user_nrx="",$total_rec="",$checkbox_medicine="",$checkbox_company="",$checkbox_out_of_stock="")
	{
		//$db2 = $this->load->database('default2', TRUE);
		//error_reporting(0);
		$sameid = "";
		$items = "";
		$count = 1;
		$date_time = date('d-M h:i A');
		$items = "";
		$keyword = str_replace("'","",$keyword);
		$keyword_title = str_replace("-","",$keyword);
		$keyword_title = str_replace(".","",$keyword_title);
		$keyword_title = str_replace("`","",$keyword_title);
		$keyword_title = str_replace("'","",$keyword_title);
		$keyword_title = str_replace("/","",$keyword_title);
		$keyword_title = str_replace("(","",$keyword_title);
		$keyword_title = str_replace(")","",$keyword_title);
		$keyword_title = str_replace("%","",$keyword_title);
		$keyword_title = str_replace(",","",$keyword_title);		
		$keyword_title = str_replace("%20","",$keyword_title);
		$keyword_title = str_replace(" ","",$keyword_title);
		
		$keyword_name = str_replace("%20"," ",$keyword);
		if($checkbox_medicine=="1"){
			$this->db->select("m.id,m.i_code,m.item_name,m.packing,m.expiry,m.company_full_name,m.batchqty,m.sale_rate,m.mrp,m.final_price,m.title2,m.image1,m.salescm1,m.salescm2,m.margin,m.featured,m.misc_settings,m.itemjoinid");
			$where = "(title='$keyword_title' or title like '".$keyword_title."%' or item_name='$keyword_title' or item_name='$keyword_name' or item_name like '".$keyword_name."%') and status=1 and `misc_settings` NOT LIKE '%gift%' and category!='g'";
			if($user_nrx=="yes"){
				//$where.=" ";
			}else{
				$where.=" and misc_settings!='#NRX' ";
			}
			$this->db->where($where);
			$total_rec_local = 0;
			if($total_rec==""){
				if($search_type=="all")
				{
					$this->db->limit(12,$get_record);
					$this->db->order_by('m.item_name asc');
				}
				else
				{
					$this->db->limit(100);
					$this->db->order_by('m.batchqty desc','m.item_name asc');
				}
			}else{
				if($total_rec!="all"){
					$this->db->limit($total_rec);
				}
				$this->db->order_by('m.batchqty desc','m.item_name asc');
			}
			$query = $this->db->get("tbl_medicine as m")->result();
			foreach ($query as $row)
			{
				$id		=	$row->id;
				if($row->batchqty!=0){
					$get_record++;
					
					$items.=$this->search_medicine2_new_50($row,$id,$count,$date_time,$get_record);
					
					$count++;
					$total_rec_local++;
				}
				if($checkbox_out_of_stock=="1" && $row->batchqty==0){
					$get_record++;
				
					$items.=$this->search_medicine2_new_50($row,$id,$count,$date_time,$get_record);
					
					$count++;
					$total_rec_local++;
				}
				
				$sameid.= $id.",";
			}
			$sameid = substr($sameid,0,-1);
			if(!empty($sameid))
			{
				$sameid = " and m.id not in(".$sameid.")";
			}
		}
		
		if(($total_rec>$total_rec_local || $total_rec=="all") && $checkbox_company=="1") {
			$db2 = $this->load->database('default2', TRUE);
			$db2->select("m.i_code,m.item_name,m.packing,m.expiry,m.company_full_name,m.batchqty,m.sale_rate,m.mrp,m.final_price,m.title2,m.image1,m.salescm1,m.salescm2,m.margin,m.featured,m.misc_settings,m.itemjoinid");
			$where = "(";
			if($checkbox_medicine=="1"){
				$where.= "title like '%".$keyword_title."%' or item_name like '%".$keyword_name."%' or title2 like '".$keyword_name."%' or ";
			} 
			//$where.= "company_full_name like '%".$keyword_name."%' or packing like '".$keyword_name."' or description like '%".$keyword_name."' or company_full_name='$keyword_title' or company_full_name like '".$keyword_name."%') and status=1 and `misc_settings` NOT LIKE '%gift%' ";
			$where.= "company_full_name like '%".$keyword_name."%' or company_full_name='$keyword_title' or company_full_name like '".$keyword_name."%') and status=1 and `misc_settings` NOT LIKE '%gift%' and category!='g'";
			if($user_nrx=="yes"){
				//$where.=" and misc_settings='#NRX' ";
			}else{
				$where.=" and misc_settings!='#NRX' ";
			}
			//echo $where;
			$db2->where($where.$sameid);
			if($total_rec==""){
				if($search_type=="all")
				{
					$db2->limit(12,$get_record);
					$db2->order_by('m.item_name asc');
				}
				else
				{
					$db2->limit(100);
					$db2->order_by('m.batchqty desc','m.item_name asc');
				}
			}else{
				if($total_rec!="all"){
					$db2->limit($total_rec-$total_rec_local);
				}
				$db2->order_by('m.batchqty desc','m.item_name asc');
			}
			$query = $db2->get("tbl_medicine as m")->result();
			foreach ($query as $row)
			{			
				$get_record++;
				$id	= $row->id;
				if($row->batchqty!=0){
					$items.=$this->search_medicine2_new_50($row,$id,$count,$date_time,$get_record);
					$count++;
				}
				if($checkbox_out_of_stock=="1" && $row->batchqty==0){
					$items.=$this->search_medicine2_new_50($row,$id,$count,$date_time,$get_record);
					$count++;
				}
			}
		}
if ($items != ''){
	$items = substr($items, 0, -1);
}
	return $items;
	}
}
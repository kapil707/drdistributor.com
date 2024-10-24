<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ImportOrderModel extends CI_Model  
{ 
    public function __construct(){
		parent::__construct();
	}
    public function import_order_dropdownbox($keyword,$item_mrp,$u_type="site")
	{
		$items = "";
		$keyword_title = str_replace("-","",$keyword);
		$keyword_title = str_replace(".","",$keyword_title);
		$keyword_title = str_replace("`","",$keyword_title);
		$keyword_title = str_replace("'","",$keyword_title);
		$keyword_title = str_replace("/","",$keyword_title);
		$keyword_title = str_replace("(","",$keyword_title);
		$keyword_title = str_replace(")","",$keyword_title);
		$keyword_title = str_replace("%","",$keyword_title);
		$keyword_title = str_replace(","," ",$keyword_title);
		$just_title    = $keyword_title;
		$just_title = str_replace("%20",",",$just_title);
		$just_title = str_replace(" ",",",$just_title);
		$keyword_title = str_replace("%20","",$keyword_title);
		$keyword_title = str_replace(" ","",$keyword_title);
		$keyword_name = str_replace("%20"," ",$keyword);
		$candi_0 = $candi_1 = $candi_2 = $candi_3 = $candi_4 = $candi_5 = $candi_6 = $candi_7 = $candi_8 = $candi_9 = "";
		/*********************************************************/
		$this->db->select("i_code,mrp");
		$this->db->where("(title like '".$keyword_title."%') and status='1' and batchqty!='0'");
		$this->db->order_by('item_name','asc');
		$this->db->limit(1);
		$query = $this->db->get("tbl_medicine")->result();
		$candi_0 = $this->import_order_dropdownbox_dt($query,"not","0");
		if(!empty($candi_0["i_code"]))
		{
			$items = $candi_0;
			//echo "ok00";
		}
		/*********************************************************/
		if(empty($candi_0["i_code"]))
		{
			$this->db->select("i_code,mrp");
			$this->db->where("(title like '".$keyword_title."%') and status='1'");
			$this->db->order_by('item_name','asc');
			$this->db->limit(1);
			$query = $this->db->get("tbl_medicine")->result();
			$candi_1 = $this->import_order_dropdownbox_dt($query,$item_mrp,"1");
			if(!empty($candi_1["i_code"]))
			{
				$items = $candi_1;
				//echo "ok01";
			}
		}
		/*********************************************************/
		if(empty($candi_1["i_code"]))
		{
			$this->db->select("i_code,mrp");
			$this->db->where("(item_name like '".$keyword_name."%' or title like '%".$keyword_title."%' or company_full_name like '".$keyword_name."%') and status='1'");
			$this->db->order_by('item_name','asc');
			$this->db->limit(1);
			$query = $this->db->get("tbl_medicine")->result();
			$candi_2 = $this->import_order_dropdownbox_dt($query,$item_mrp,"1");
			if(!empty($candi_2["i_code"]))
			{
				$items = $candi_2;
				//echo "ok02";
			}
		}
		if(empty($candi_0["i_code"]) && empty($candi_1["i_code"]) && empty($candi_2["i_code"]))
		{
			$value3 = $keyword_name;
			for($i=0;$i<strlen($keyword_name);$i++)
			{
				if(empty($candi_3))
				{
					$candi_3 = $this->import_order_dropdownbox_dt1($value3,$item_mrp,"1");
					$value3 = substr($value3, 0, -1);
				}
			}
			//echo "ok03";
		}
		if(empty($candi_0["i_code"]) && empty($candi_1["i_code"]) && empty($candi_2["i_code"]) && empty($candi_3["i_code"]))
		{
			$value4 = $keyword_name;
			for($i=0;$i<strlen($keyword_name);$i++)
			{
				if(empty($candi_4))
				{
					$candi_4 = $this->import_order_dropdownbox_dt2($value4,$item_mrp,"1");
					$value4 = substr($value4, 0, -1);
					if(strlen($value4)<6)
					{
						break;
					}
				}
			}
			//echo "ok04";
		}
		if(empty($candi_0["i_code"]) && empty($candi_1["i_code"]) && empty($candi_2["i_code"]) && empty($candi_3["i_code"]) && empty($candi_4["i_code"]))
		{
			$value5 = $keyword_title;
			for($i=0;$i<strlen($keyword_title);$i++)
			{
				if(empty($candi_5))
				{
					$candi_5 = $this->import_order_dropdownbox_dt2($value5,"not","0");
					$value5 = substr($value5, 0, -1);
					if(strlen($value5)<6)
					{
						break;
					}
				}
			}
			//echo "ok05";
		}
		if(!empty($candi_3["i_code"]))
		{
			$items = $candi_3;
		}
		if(!empty($candi_4["i_code"]))
		{
			$items = $candi_4;
		}
		if(!empty($candi_5["i_code"]))
		{
			$items = $candi_5;
		}
		/**** new crete by 26-03-2021****jab same name ki davi but def mrp h to*/
		if(empty($candi_0["i_code"]) && empty($candi_1["i_code"]) && empty($candi_2["i_code"]) && empty($candi_3["i_code"]) && empty($candi_4["i_code"]) && empty($candi_5["i_code"]))
		{
			$this->db->select("i_code,mrp");
			$this->db->where("(item_name='".$keyword_name."') and status='1'");
			$this->db->order_by('item_name','asc');
			$this->db->limit(1);
			$query = $this->db->get("tbl_medicine")->result();
			$candi_6 = $this->import_order_dropdownbox_dt($query,"not","0");
			//echo "ok061";
		}
		if(!empty($candi_6["i_code"]))
		{
			$items = $candi_6;
		}
		if($u_type=="admin")
		{	
			/**** new crete by 14-05-2021****jab same name ki davi but def mrp h to*/
			if(empty($candi_0["i_code"]) && empty($candi_1["i_code"]) && empty($candi_2["i_code"]) && empty($candi_3["i_code"]) && empty($candi_4["i_code"]) && empty($candi_5["i_code"]) && empty($candi_6["i_code"]))
			{
				$value7 = $keyword_title;
				for($i=0;$i<strlen($keyword_title);$i++)
				{
					if(empty($candi_7["i_code"]))
					{
						$candi_7 = $this->import_order_dropdownbox_dt1($value7,"not","0");
						$value7 = substr($value7, 0, -1);
						if(strlen($value7)<10)
						{
							break;
						}
					}
				}
				//echo "ok07";
			}
			if(!empty($candi_7["i_code"]))
			{
				$items = $candi_7;
			}
			/**** new crete by 20-10-2021****jab same name ki davi but def mrp h to*/
			if(empty($candi_0["i_code"]) && empty($candi_1["i_code"]) && empty($candi_2["i_code"]) && empty($candi_3["i_code"]) && empty($candi_4["i_code"]) && empty($candi_5["i_code"]) && empty($candi_6["i_code"]) && empty($candi_7["i_code"]))
			{
				$value8 = $keyword_title;
				$value8 = str_replace("*","",$value8);
				for($i=0;$i<strlen($keyword_title);$i++)
				{
					if(empty($candi_8["i_code"]))
					{
						$candi_8 = $this->import_order_dropdownbox_dt1($value8,$item_mrp,"1");
						$value8 = substr($value8, 0, -1);
						if(strlen($value8)<9)
						{
							break;
						}
					}
				}
				//echo "ok08";
			}
			if(!empty($candi_8["i_code"]))
			{
				$items = $candi_8;
			}
		}
		if($u_type=="site")
		{
			if(empty($candi_0["i_code"]) && empty($candi_1["i_code"]) && empty($candi_2["i_code"]) && empty($candi_3["i_code"]) && empty($candi_4["i_code"]) && empty($candi_5["i_code"]) && empty($candi_6["i_code"]))
			{
				$value7 = $keyword_title;
				for($i=0;$i<strlen($keyword_title);$i++)
				{
					if(empty($candi_7["i_code"]))
					{
						$candi_7 = $this->import_order_dropdownbox_dt1($value7,"not","0");
						$value7 = substr($value7, 0, -1);
						if(strlen($value7)<4)
						{
							break;
						}
					}
				}
				//echo "ok07";
			}
			if(!empty($candi_7["i_code"]))
			{
				$items = $candi_7;
			}
			/**** new crete by 20-10-2021****jab same name ki davi but def mrp h to*/
			if(empty($candi_0["i_code"]) && empty($candi_1["i_code"]) && empty($candi_2["i_code"]) && empty($candi_3["i_code"]) && empty($candi_4["i_code"]) && empty($candi_5["i_code"]) && empty($candi_6["i_code"]) && empty($candi_7["i_code"]))
			{
				$value8 = $keyword_title;
				$value8 = str_replace("*","",$value8);
				for($i=0;$i<strlen($keyword_title);$i++)
				{
					if(empty($candi_8["i_code"]))
					{
						$candi_8 = $this->import_order_dropdownbox_dt2($value8,"not","0");
						if(strlen($value8)<4)
						{
							break;
						}
					}
				}
				//echo "ok08";
			}
			if(!empty($candi_8["i_code"]))
			{
				$items = $candi_8;
			}
			/**** new crete by 20-10-2021****jab same name ki davi but def mrp h to*/
			if(empty($candi_0["i_code"]) && empty($candi_1["i_code"]) && empty($candi_2["i_code"]) && empty($candi_3["i_code"]) && empty($candi_4["i_code"]) && empty($candi_5["i_code"]) && empty($candi_6["i_code"]) && empty($candi_7["i_code"]) && empty($candi_8["i_code"]))
			{
				$value9 = $keyword_title;
				$value9 = str_replace("*","",$value9);
				for($i=strlen($value9);$i>0;$i--)
				{
					if(empty($candi_9["i_code"]))
					{
						$x = $i - strlen($value9);
						$value9_ = substr($value9, 0, $x);
						$candi_9 = $this->import_order_dropdownbox_dt2($value9_,"not","0");
					}
				}
				//echo "ok09";
			}
			if(!empty($candi_9["i_code"]))
			{
				$items = $candi_9;
			}
		}
		return $items;
	}
	public function import_order_dropdownbox_dt1($keyword,$item_mrp,$type)
	{		
		/*********************************************************/
		$this->db->select("i_code,mrp");
		$this->db->where("(item_name like '".$keyword."%' or title like '%".$keyword."%' or company_full_name like '".$keyword."%' ) and status='1'");
		$this->db->order_by('item_name','asc');
		$this->db->limit(1);
		$query = $this->db->get("tbl_medicine")->result();
		return $this->import_order_dropdownbox_dt($query,$item_mrp,$type);
	}
	public function import_order_dropdownbox_dt2($keyword,$item_mrp,$type)
	{		
		/*********************************************************/
		$this->db->select("i_code,mrp");
		$this->db->where("(title like '".$keyword."%' or title like '%".$keyword."%' or title like '%".$keyword."') and status='1'");
		$this->db->order_by('item_name','asc');
		$this->db->limit(1);
		$query = $this->db->get("tbl_medicine")->result();
		return $this->import_order_dropdownbox_dt($query,$item_mrp,$type);
	}
	public function import_order_dropdownbox_dt3($keyword,$item_mrp,$type)
	{		
		/*********************************************************/
		$keyword = explode(",", $keyword);
		$keyword = shuffle($keyword);
		$keyword_other = "";
		$this->db->select("i_code,mrp");
		foreach($keyword as $row)
		{
			$keyword_other.= "title like '".$row."%' or ";
		}
		echo $keyword_other = substr($keyword_other, 0, -3);die;
		$this->db->where($keyword_other."and status='1'");
		$this->db->order_by('item_name','asc');
		$this->db->limit(1);
		$query = $this->db->get("tbl_medicine")->result();
		return $this->import_order_dropdownbox_dt($query,$item_mrp,$type);
	}
	public function import_order_dropdownbox_dt($query,$item_mrp,$type)
	{
		if(empty($type)){
			$type = 0;
		}
		$ret["i_code"] = "";
		$ret["mrp"]  = $item_mrp;
		$ret["type"] = $type;
		foreach ($query as $row)
		{
			if(round($item_mrp)==round($row->mrp) || $item_mrp=="not")
			{
				$i_code	=	$row->i_code;
				$mrp	=	$row->mrp;						
				if($i_code!=0 && $i_code!=-1)
				{
					$ret["i_code"] = $i_code;
					$ret["mrp"] = $mrp;
					$ret["type"] = $type;
				}
			}
		}
		return $ret;
	}
}
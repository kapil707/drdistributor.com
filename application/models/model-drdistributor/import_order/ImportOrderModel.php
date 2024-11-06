<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ImportOrderModel extends CI_Model  
{ 
    public function __construct(){
		parent::__construct();

		$this->load->model("model-drdistributor/my_cart/MyCartModel");
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

	public function get_import_order_suggest($ChemistId) {		
		$this->db->select("*");
		$this->db->where('user_altercode',$ChemistId);
		$this->db->order_by('your_item_name','asc');
		return $this->db->get("drd_import_orders_suggest")->result();
	}

	public function process_main($OrderId) {
		
		$jsonArray = array();

		$i = 1;
		$this->db->select("*");
		$this->db->where('order_id',$OrderId);
		$this->db->where('status',0);
		$this->db->order_by('id','asc');
		$this->db->limit(1);
		$result = $this->db->get("drd_import_file")->result();
		foreach($result as $row)
		{
			$this->db->query("update drd_import_file set status='1' where id='$row->id'");

			$dt = array(
				'i'=>$i++,
				'id' => $row->id,
				'item_name'=>$row->item_name,
				'quantity'=>$row->quantity,
				'mrp'=>$row->mrp,
				'order_id'=>$row->order_id,
				'status'=>$row->status,
				'p_status'=>$row->p_status,
				'user_type'=>$row->user_type,
				'user_altercode'=>$row->user_altercode,
				'salesman_id'=>$row->salesman_id,
				'date'=>$row->date,
			);
			$jsonArray[] = $dt;
		}
		return $jsonArray;
	}

	public function process_main2($OrderId) {
		
		$jsonArray = array();

		$i = 1;
		$this->db->select("id");
		$this->db->where('order_id',$OrderId);
		$this->db->where('status',1);
		$this->db->order_by('id','asc');
		$this->db->limit(1);
		$row = $this->db->get("drd_import_file")->result();
		if($row)
		{
			$this->db->query("update drd_import_file set status='1' where id='$row->id'");
		}
		return $row;
	}

	public function process_find_medicine_api($UserType,$ChemistId,$SalesmanId,$ChemistNrx,$ItemId) {
		
		$this->db->select("*");
		$this->db->where('id',$ItemId);
		$row = $this->db->get("drd_import_file")->row();

		$order_id			= $row->order_id;
		$order_quantity		= $row->quantity;
		$item_mrp 			= $row->mrp;
		$order_item_name	= $this->clean1($row->item_name);

		/******************************************/
		$suggest_i_code = $item_suggest_altercode = "";
		$suggest = 0;

		$this->db->select("*");
		$this->db->where('your_item_name',$order_item_name);
		$this->db->order_by('id','desc');
		$row1 = $this->db->get("drd_import_orders_suggest")->row();
		if(!empty($row1->id)) {
			$suggest = 1;
			$order_item_name		= $row1->item_name;
			$suggest_i_code 		= $row1->i_code;
			$item_suggest_altercode = $row1->user_altercode;
		}
		$type_ = 1;
		if(!empty($suggest_i_code))
		{
			$type_ = "1";
			$i_code = $suggest_i_code;
			$where = array('i_code'=>$i_code);
		}
		else{			
			/******************************************/
			$items = $this->import_order_dropdownbox($order_item_name,$item_mrp);
			/*****************************************/		
			$type_ = $items["type"];
			$i_code = $items["i_code"];
			$where = array('i_code'=>$i_code);
		}

		$this->db->select("*");
		$this->db->where($where);

		$where = "status=1 and `misc_settings` NOT LIKE '%gift%' and category!='g'";
		$this->db->where($where);
		
		if($ChemistNrx=="yes"){
		}else{
			$where="misc_settings!='#NRX'";
			$this->db->where($where);
		}
		$this->db->limit(1);
		$this->db->order_by('item_name','asc');
		$row2 = $this->db->get("tbl_medicine")->row();

		$return["row"] = $row2;
		$return["type_"] = $type_;
		$return["suggest"] = $suggest;
		$return["order_quantity"] = $order_quantity;
		$return["item_suggest_altercode"] = $item_suggest_altercode;
		return $return;
	}

	public function import_order_row_delete($UserType,$ChemistId,$SalesmanId,$ItemId,$ItemCode) {
		
		$this->db->query("update drd_import_file set status=2 where id='$ItemId'");
		/******************************************************* */
		
		$this->MyCartModel->medicine_delete_api($UserType,$ChemistId,$SalesmanId,$ItemCode);
		/******************************************************* */

		$status = 1;
		return $status;
	}

	public function import_order_row_quantity_change($UserType,$ChemistId,$SalesmanId,$ItemId,$ItemQuantity) {
		
		$this->db->query("update drd_import_file set quantity='$ItemQuantity' where id='$ItemId'");

		$status = 1;
		return $status;
	}

	public function import_order_medicine_change($UserType,$ChemistId,$SalesmanId,$ItemId,$ItemCode,$SelectedItemCode) {

		$this->db->select("item_name");
		$this->db->where('i_code',$SelectedItemCode);
		$row = $this->db->get("tbl_medicine")->row();
		$item_name = $row->item_name;
		/******************************************************* */

		$this->db->select("item_name");
		$this->db->where('id',$ItemId);
		$row1 = $this->db->get("drd_import_file")->row();
		$your_item_name = $row1->item_name;		
		/******************************************************* */

		$where = array('your_item_name'=>$your_item_name);
		$this->delete_query("drd_import_orders_suggest",$where);
		/******************************************************* */
		
		$this->MyCartModel->medicine_delete_api($UserType,$ChemistId,$SalesmanId,$ItemCode);
		/******************************************************* */

		$date = date('Y-m-d');
		$time = time();
		$datetime = date("d-M-y H:i",$time);

		$dt = array(
			'your_item_name'=>$your_item_name,
			'item_name'=>$item_name,
			'i_code'=>$ItemCode,
			'user_altercode'=>$ChemistId,
			'date'=>$date,
			'time'=>$time,
			'datetime'=>$datetime,
		);
		$this->insert_query("drd_import_orders_suggest",$dt);
		$status = 1;
		return $status;
	}

	public function import_order_medicine_delete_suggested($UserType,$ChemistId,$SalesmanId,$ItemId) {
	
		$status = 0;
		$this->db->select("item_name");
		$this->db->where('id',$ItemId);
		$row = $this->db->get("drd_import_file")->row();
		if(!empty($row->item_name))
		{
			$your_item_name = $row->item_name;
			$this->db->select("i_code");
			$this->db->where('your_item_name',$your_item_name);
			$row1 = $this->db->get("drd_import_orders_suggest")->row();
			$ItemCode = $row1->i_code;
			/******************************************************* */

			$where = array('your_item_name'=>$your_item_name);
			$this->delete_query("drd_import_orders_suggest",$where);
			/******************************************************* */

			$this->MyCartModel->medicine_delete_api($UserType,$ChemistId,$SalesmanId,$ItemCode);

			$status = 1;
		}
		return $status;
	}

	function insert_query($tbl,$dt)
	{
		if($this->db->insert($tbl,$dt))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

	function delete_query($tbl,$where)
	{
		if($this->db->delete($tbl,$where))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function clean1($string) {
		$string = str_replace('"', "'", $string);
		$string = str_replace('\'', '', $string);
		return $string;
	}
}
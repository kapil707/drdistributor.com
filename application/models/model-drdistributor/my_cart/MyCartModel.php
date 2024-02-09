<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MyCartModel extends CI_Model  
{
	public function __construct(){
		parent::__construct();
	}
	
	public function get_temp_rec($user_type='',$user_altercode='',$salesman_id='')
	{
		if($user_type=="sales")
		{
			$temp_rec = $user_type."_".$salesman_id."_".$user_altercode;
		}
		else
		{
			$temp_rec = $user_type."_".$user_altercode;
		}
		return $temp_rec;
	}
	
	public function get_total_price_of_order($selesman_id='',$chemist_id='',$user_type='',$user_password='',$device_type="website")
	{
		$temp_rec = $this->get_temp_rec($user_type,$chemist_id,$selesman_id);
		if($user_type=="sales")
		{
			$this->db->where('selesman_id',$selesman_id);
		}
		$this->db->where('temp_rec',$temp_rec);
		$this->db->where('chemist_id',$chemist_id);
		$this->db->where('status','0');
		$this->db->order_by('id','desc');	
		$query = $this->db->get("drd_temp_rec")->result();
		$order_price = 0;
		foreach($query as $row)
		{
			$order_price = $order_price + ($row->quantity * $row->sale_rate);
		}
		$row = $this->db->query("select tbl_acm_other.password,tbl_acm_other.block,tbl_acm_other.status,tbl_acm_other.order_limit,tbl_acm_other.website_limit,tbl_acm_other.android_limit from tbl_acm left join tbl_acm_other on tbl_acm.code = tbl_acm_other.code where tbl_acm.altercode='$chemist_id' and tbl_acm.code=tbl_acm_other.code limit 1")->row();
		
		$user_order_limit = "5000";
		if($device_type=="website")
		{
			$user_order_limit = $row->website_limit;
		}
		if($device_type=="android")
		{
			$user_order_limit = $row->android_limit;
		}
			
		$order_limit[0] = 1; // ek honay par he place hoga order
		$order_limit[1] = "";
		if($user_type=="chemist")
		{
			$order_limit[1] = "<font color='red'>Minimum value to place order is of <i class='fa fa-inr'></i> ". number_format($user_order_limit)."/-</font>";
			$order_price      = round($order_price);
			$user_order_limit = round($user_order_limit);
			if($order_price<=$user_order_limit)
			{
				$order_limit[0] = 0;
			}
			/**jab user block yha inactive ho to */
			if($row->block=="1" || $row->status=="0")
			{
				$order_limit[0] = 0;
				$order_limit[1] = "<font color='red'>Can't Place Order due to technical issues.</font>";
			}		
			/**jab user ka password match na kray to */
			if($row->password!=$user_password)
			{
				$order_limit[0] = 0;
				$order_limit[1] = "<font color='red'>Can't Place Order, Please Re-Login with your New Password.</font>";
			}
		}
		
		return $order_limit;
	}
	
	public function my_cart_api($user_type="",$user_altercode="",$user_password="",$selesman_id="",$order_type="",$device_type="website")
	{
	    $jsonArray = $jsonArray1 = array();
	    
		$items = "";
		$other_items = "";
		$items_total = $items_price = 0;
		if($user_type=="sales")
		{
			if($order_type=="all"){
				$temp_rec = $this->get_temp_rec($user_type,$user_altercode,$selesman_id);
				$where = array('temp_rec'=>$temp_rec,'selesman_id'=>$selesman_id,'chemist_id'=>$user_altercode,'status'=>'0');
				$this->db->select("*");
				$this->db->where($where);
				$this->db->order_by('excel_number','asc');
				$query = $this->db->get("drd_temp_rec")->result();
			}else{
				$temp_rec = $this->get_temp_rec($user_type,$user_altercode,$selesman_id);
				$where = array('temp_rec'=>$temp_rec,'selesman_id'=>$selesman_id,'chemist_id'=>$user_altercode,'status'=>'0','order_type'=>$order_type);
				$this->db->select("*");
				$this->db->where($where);
				$this->db->order_by('excel_number','asc');
				$query = $this->db->get("drd_temp_rec")->result();
			}
		}
		else
		{
			$selesman_id 	= "";
			if($order_type=="all"){
				$temp_rec = $this->get_temp_rec($user_type,$user_altercode,$selesman_id);
				$where = array('temp_rec'=>$temp_rec,'chemist_id'=>$user_altercode,'status'=>'0');
				$this->db->select("*");
				$this->db->where($where);
				$this->db->order_by('excel_number','asc');
				$query = $this->db->get("drd_temp_rec")->result();
			}else {
				$temp_rec = $this->get_temp_rec($user_type,$user_altercode,$selesman_id);
				$where = array('temp_rec'=>$temp_rec,'chemist_id'=>$user_altercode,'status'=>'0','order_type'=>$order_type);
				$this->db->select("*");
				$this->db->where($where);
				$this->db->order_by('excel_number','asc');
				$query = $this->db->get("drd_temp_rec")->result();
			}
		}	
        foreach($query as $row)
		{
			$item_id			= $row->id;
			$item_code 			= $row->i_code;
			$item_quantity		= $row->quantity;
			$item_order_quantity= $row->quantity;
			$item_image			= $row->image;
			$item_name			= htmlentities(ucwords(strtolower($row->item_name)));
			$item_packing		= htmlentities($row->packing);
			$item_expiry		= htmlentities($row->expiry);
			$item_company		= htmlentities(ucwords(strtolower($row->company_full_name)));
			$item_scheme		= $row->scheme;
			
			$item_margin 		= round($row->margin);
			$item_featured 		= $row->featured;
			$item_price			= sprintf('%0.2f',round($row->sale_rate,2));
			$item_quantity_price= sprintf('%0.2f',round($item_price*$item_quantity,2));
			$item_date_time		= $row->datetime;
			$item_modalnumber	= htmlentities($row->modalnumber);
			
			$items_total++;
			$items_price 		= $items_price + $item_quantity_price;
			
			$stock = "";
			$item_quantity = "";
			
			$dt = array(
			    'item_id' => $item_id,
				'item_code' => $item_code,
				'item_image' => $item_image,
				'item_name' => $item_name,
				'item_packing' => $item_packing,
				'item_expiry' => $item_expiry,
				'item_company' => $item_company,
				'item_scheme' => $item_scheme,
				'item_margin' => $item_margin,
				'item_featured' => $item_featured,
				'item_price' => $item_price,
				'item_quantity' => $item_quantity,
				'item_stock' => $item_stock,
				'item_quantity_price' => $item_quantity_price,
				'item_date_time' => $item_date_time,
				'item_modalnumber' => $item_modalnumber,
				'item_order_quantity'=>$item_order_quantity,
			);
			$jsonArray[] = $dt;
			
/*$items.= <<<EOD
{"id":"{$item_id}","code":"{$item_code}","quantity":"{$item_quantity}","stock":"{$stock}","order_quantity":"{$item_order_quantity}","image":"{$item_image}","name":"{$item_name}","packing":"{$item_packing}","expiry":"{$item_expiry}","company":"{$item_company}","scheme":"{$item_scheme}","margin":"{$item_margin}","featured":"{$item_featured}","price":"{$item_price}","quantity_price":"{$item_quantity_price}","datetime":"{$item_datetime}","modalnumber":"{$item_modalnumber}"},
EOD;*/
		}
		
    	//iss query say button visble or disble hota ha plceorder ka
    	$place_order_btn = $this->get_total_price_of_order($selesman_id,$user_altercode,$user_type,$user_password,$device_type);
    	$place_order_button  = $place_order_btn[0];
    	$place_order_message = "<center>".$place_order_btn[1]."</center>";
    	$items_price = sprintf('%0.2f',round($items_price,2));
    	
    	$dt = array(
			    'user_altercode' => $user_altercode,
				'items_total' => $items_total,
				'items_price' => $items_price,
				'place_order_button' => $place_order_button,
				'place_order_message' => $place_order_message,
			);
		$jsonArray1[] = $dt;
		
		$val[0] = $jsonArray;
		$val[1] = $jsonArray1;
		$val[2] = $items_total;
		return $val;
	}
}
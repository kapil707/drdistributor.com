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
			$item_name			= (ucwords(strtolower($row->item_name)));
			$item_packing		= ($row->packing);
			$item_expiry		= ($row->expiry);
			$item_company		= (ucwords(strtolower($row->company_full_name)));
			$item_scheme		= $row->scheme;
			
			$item_margin 		= round($row->margin);
			$item_featured 		= $row->featured;
			$item_price			= sprintf('%0.2f',round($row->sale_rate,2));
			$item_quantity_price= sprintf('%0.2f',round($item_price*$item_quantity,2));
			$item_date_time		= $row->datetime;
			$item_modalnumber	= ($row->modalnumber);
			
			$items_total++;
			$items_price 		= $items_price + $item_quantity_price;
			
			$item_stock = "";
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
		
		$return[0] = $jsonArray;
		$return[1] = $jsonArray1;
		$return[2] = $items_total;
		return $return;
	}

	public function medicine_add_to_cart_api($user_type,$user_altercode,$salesman_id,$order_type,$item_code,$item_order_quantity,$mobilenumber,$modalnumber,$device_id,$excel_number="0")
	{
		$where = array('chemist_id'=>$user_altercode,'selesman_id'=>$salesman_id,'user_type'=>$user_type,'i_code'=>$item_code,'status'=>'0');
		$this->db->delete("drd_temp_rec", $where);
		$time = time();
		$date = date("Y-m-d",$time);
		$datetime = date("d-M-y H:i",$time);
		if($user_type=="sales")
		{
			$temp_rec = $user_type."_".$salesman_id."_".$user_altercode;			
		}
		else
		{
			$temp_rec = $user_type."_".$user_altercode;
		}
		if($excel_number==0 || $excel_number=="0" || $excel_number==""){
			$row2 = $this->db->query("select excel_number from drd_temp_rec where chemist_id='$user_altercode' and selesman_id='$salesman_id' and user_type='$user_type' and status=0 order by id desc")->row();
			if(!empty($row2->excel_number)){
				$excel_number = $row2->excel_number + 1;
			}
			if($excel_number==0){
				$excel_number = 1;
			}
		}
		$where1 = array('i_code'=>$item_code);
		$row1 = $this->Scheme_Model->select_row("tbl_medicine",$where1);
		if(!empty($row1->item_name))
		{
			$image1 = constant('img_url_site')."uploads/default_img.jpg";
			if(!empty($row1->image1))
			{
				$image1 = constant('img_url_site').$row1->image1;
			}
			$dt = array(
				'i_code'=>$item_code,
				'item_code'=>$row1->item_code,
				'quantity'=>$item_order_quantity,				
				'item_name'=>$row1->item_name,
				'packing'=>$row1->packing,
				'expiry'=>$row1->expiry,
				'margin'=>$row1->margin,
				'featured'=>$row1->featured,
				'company_full_name'=>$row1->company_full_name,
				'sale_rate'=>$row1->final_price,
				'scheme'=>$row1->salescm1."+".$row1->salescm2,
				'image'=>$image1,
				'chemist_id'=>$user_altercode,
				'selesman_id'=>$salesman_id,
				'user_type'=>$user_type,
				'date'=>$date,
				'time'=>$time,
				'datetime'=>$datetime,
				'temp_rec'=>$temp_rec,
				'order_type'=>$order_type,
				'mobilenumber'=>$mobilenumber,
				'modalnumber'=>$modalnumber,
				'device_id'=>$device_id,
				'excel_number'=>$excel_number,
				'status'=>0,
				'json_id'=>0,
				'excel_temp_id'=>0,
				'filename'=>"",
				'your_item_name'=>"",
				'join_temp'=>"",
				'order_id'=>"",
				);
			$this->Scheme_Model->insert_fun("drd_temp_rec",$dt);
			$status = "1";
		}else{
			$status = "0";
		}
		return $status;
	}

	public function delete_medicine_api($user_type="",$user_altercode="",$salesman_id="",$item_code="")
	{
		$response = $this->db->query("delete from drd_temp_rec where user_type='$user_type' and chemist_id='$user_altercode' and selesman_id='$salesman_id' and status='0' and i_code='$item_code'");
		return $response;
	}
	
	public function delete_all_medicine_api($user_type="",$user_altercode="",$salesman_id="")
	{
		$response = $this->db->query("delete from drd_temp_rec where user_type='$user_type' and chemist_id='$user_altercode' and selesman_id='$salesman_id' and status='0'");
		return $response;
	}
}
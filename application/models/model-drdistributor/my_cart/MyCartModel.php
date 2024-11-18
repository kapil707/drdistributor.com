<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MyCartModel extends CI_Model  
{
	var $MedicineImageUrl = "";
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');

		$this->MedicineImageUrl = $this->appconfig->getMedicineImageUrl();
	}
	
	public function get_total_price_of_order($user_type='',$user_altercode='',$user_password='',$salesman_id='',$device_type="website")
	{		
		$chemist_id = $user_altercode;
		$items_total = $items_price = 0;
		if($user_type!="sales")
		{
			$salesman_id = "";
		}
		$row = $this->db->query("SELECT count(id) as items_total,sum(sale_rate*quantity) as items_price FROM `tbl_cart` WHERE `chemist_id`='$chemist_id' and salesman_id='$salesman_id' and user_type='$user_type' and status=0")->row();
		if(!empty($row)){
			$items_total = $row->items_total;
			$items_price = $row->items_price;
		}

		$row = $this->db->query("select tbl_chemist_other.password,tbl_chemist_other.block,tbl_chemist_other.status,tbl_chemist_other.order_limit,tbl_chemist_other.website_limit,tbl_chemist_other.android_limit from tbl_chemist left join tbl_chemist_other on tbl_chemist.code = tbl_chemist_other.code where tbl_chemist.altercode='$chemist_id' and tbl_chemist.code=tbl_chemist_other.code limit 1")->row();		
		$user_order_limit = "5000";
		if(!empty($row)){
			if($user_type=="chemist")
			{
				if($device_type=="website")
				{
					$user_order_limit = $row->website_limit;
				}
				if($device_type=="android")
				{
					$user_order_limit = $row->android_limit;
				}
			}
		}

		$return["items_total"] = $items_total;
		$return["items_price"] = $items_price;
		$return["status"] = 1; // ek honay par he place hoga order
		$return["status_message"] = "";
		if(!empty($row)){
			if($user_type=="chemist")
			{
				$return["status_message"] = "<font color='red'>Minimum value to place order is of <i class='fa fa-inr'></i> ". number_format($user_order_limit)."/-</font>";
				$items_price      = round($items_price);
				$user_order_limit = round($user_order_limit);
				if($items_price<=$user_order_limit)
				{
					$return["status"] = 0;
				}
				/**jab user block yha inactive ho to */
				if($row->block=="1" || $row->status=="0")
				{
					$return["status"] = 0;
					$return["status_message"] = "<font color='red'>Can't Place Order due to technical issues.</font>";
				}		
				/**jab user ka password match na kray to */
				if($row->password!=$user_password)
				{
					$return["status"] = 0;
					$return["status_message"] = "<font color='red'>Can't Place Order, Please Re-Login with your New Password.</font>";
				}
			}
		}else{
			$return["status"] = 0;
			$return["status_message"] = "<font color='red'>Can't Place Order, Please Re-Login with your New Password.</font>";
		}	
		return $return;
	}

	public function my_cart_total_api($user_type="",$user_altercode="",$user_password="",$selesman_id="")
	{
		/*********************************************************** */
    	//iss query say button visble or disble hota ha plceorder ka
    	$get_total_price_of_order = $this->get_total_price_of_order($user_type,$user_altercode,$user_password,$selesman_id);

    	$status  = $get_total_price_of_order["status"];
    	$status_message = "<center>".$get_total_price_of_order["status_message"]."</center>";
		$items_total  = $get_total_price_of_order["items_total"];
		$items_price  = $get_total_price_of_order["items_price"];
    	$items_price = sprintf('%0.2f',round($items_price,2));
    	/*********************************************************** */

    	$dt = array(
			'items_total' => $items_total,
			'items_price' => $items_price,
			'status' => $status,
			'status_message' => $status_message,
		);
		$jsonArray[] = $dt;
		
		$return["items"] 		= $jsonArray;
		$return["items_total"] 	= $items_total;
		return $return;
	}
	
	public function my_cart_api($user_type="",$user_altercode="",$user_password="",$selesman_id="",$order_type="",$device_type="website")
	{
	    $jsonArray = $jsonArray1 = array();
	    
		$items_total = $items_price = 0;
		if($user_type!="sales")
		{
			$selesman_id 	= "";
		}
		$where = array(
			'chemist_id' => $user_altercode,
			'salesman_id' => $selesman_id,
			'user_type' => $user_type,
			'status' => '0'
		);
		
		$this->db->select("*");
		$this->db->where($where);
		
		if($order_type == "import_order") {
			$this->db->where('order_type!=', 'import_order');
		}
		
		// Simplified ordering using FIELD and single CASE
		$this->db->order_by("FIELD(order_type, 'pc_mobile', 'import_order')", '', FALSE);
		$this->db->order_by("
			CASE order_type 
				WHEN 'pc_mobile' THEN short_order 
				WHEN 'import_order' THEN -short_order
			END
		", 'DESC', FALSE);
		
		$query = $this->db->get("tbl_cart")->result();
		
        foreach($query as $row)
		{
			$item_id			= $row->id;
			$item_code 			= $row->i_code;
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
			$item_quantity_price= sprintf('%0.2f',round($item_price*$item_order_quantity,2));
			$item_date_time		= date("d-M-y @ h:i A",$row->timestamp);
			$item_modalnumber	= ($row->modalnumber);
			
			$items_total++;
			$items_price 		= $items_price + $item_quantity_price;
			
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
				'item_order_quantity'=>$item_order_quantity,
				'item_quantity_price' => $item_quantity_price,
				'item_date_time' => $item_date_time,
				'item_modalnumber' => $item_modalnumber,
			);
			$jsonArray[] = $dt;
		}
		
		/*********************************************************** */
    	//iss query say button visble or disble hota ha plceorder ka
    	$get_total_price_of_order = $this->get_total_price_of_order($user_type,$user_altercode,$user_password,$selesman_id,$device_type);

    	$status  = $get_total_price_of_order["status"];
    	$status_message = "<center>".$get_total_price_of_order["status_message"]."</center>";
    	$items_price = sprintf('%0.2f',round($items_price,2));
    	/*********************************************************** */

    	$dt = array(
			'user_altercode' => $user_altercode,
			'items_total' => $items_total,
			'items_price' => $items_price,
			'status' => $status,
			'status_message' => $status_message,
		);
		$jsonArray1[] = $dt;
		
		$return["items"] 		= $jsonArray;
		$return["items_other"] 	= $jsonArray1;
		$return["items_total"] 	= $items_total;
		return $return;
	}

	public function get_short_order($user_type,$user_altercode,$salesman_id)
	{
		$q = $this->db->query("select count(short_order) as total from tbl_cart where user_type='$user_type' and chemist_id='$user_altercode' and salesman_id='$salesman_id' and status=0")->row();
		if(empty($q)){
			return 1;
		}else{
			return $q->total + 1;
		}
	}

	public function medicine_add_to_cart_api($user_type,$user_altercode,$salesman_id,$item_code,$item_order_quantity,$order_type,$excel_number="0",$mobilenumber="",$modalnumber="",$device_id="")
	{
		$time = time();
		$date = date("Y-m-d",$time);
		$time1 = date("H:i",$time);
		$datetime = date("d-M-y H:i",$time);
		$timestamp = time();

		/**************************************************************** */
		$short_order = $this->get_short_order($user_type,$user_altercode,$salesman_id);

		/**********1000 say jada ki value add he nahi hoya ge cart me */
		if($item_order_quantity>=1000){
			$item_order_quantity = 1000;
		}
		
		/**************************************************************** */
		$where1 = array('i_code'=>$item_code);
		$row1 = $this->Scheme_Model->select_row("tbl_medicine",$where1);
		if(!empty($row1->item_name))
		{
			$image1 = $this->MedicineImageUrl."uploads/default_img.jpg";
			if(!empty($row1->image1))
			{
				$image1 = $this->MedicineImageUrl.$row1->image1;
			}
			$dt1 = array(
				'order_id'=>"",
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
				'salesman_id'=>$salesman_id,
				'user_type'=>$user_type,
				'date'=>$date,
				'time'=>$time1,
				'timestamp'=>$timestamp,
				'order_type'=>$order_type,
				'mobilenumber'=>$mobilenumber,
				'modalnumber'=>$modalnumber,
				'device_id'=>$device_id,
				'short_order'=>$short_order,
				'status'=>0,);
			
				//insert or update check hear for cart
				$where = array('user_type'=>$user_type,'chemist_id'=>$user_altercode,'salesman_id'=>$salesman_id,'i_code'=>$item_code,'status'=>'0');
				$this->db->select("id");
				$this->db->where($where);
				$row1 = $this->db->get("tbl_cart")->row();		
				if(empty($row1)){
					$this->insert_query("tbl_cart",$dt1);
				}else{
					//sirf qunatity update hoti ha
					$dt2 = array(
						'quantity'=>$item_order_quantity,
						'date'=>$date,
						'time'=>$time1,
						'timestamp'=>$timestamp,
						'order_type'=>$order_type,);
					$this->update_query("tbl_cart",$dt2,$where);
				}
			$status = "1";
			$status_message = "Medicine added successfully";
		}else{
			$status = "0";
			$status_message = "Medicine added fail";
		}
		$return["status"] = $status;
		$return["status_message"] = $status_message;
		return $return;
	}

	public function medicine_delete_api($user_type="",$user_altercode="",$salesman_id="",$item_code="")
	{
		/**************************************************************** */
		$where = array('user_type'=>$user_type,'chemist_id'=>$user_altercode,'salesman_id'=>$salesman_id,'status'=>'0','i_code'=>$item_code);
		$result = $this->delete_query("tbl_cart", $where);
		/**************************************************************** */
		
		if(empty($result)){
			$status = "0";
		}else{
			$status = "1";
		}

		$jsonArray = array();
		$dt = array(
			'status' => $status,
		);
		$jsonArray[] = $dt;
		
		$return["items"] = $jsonArray;
		return $return;
	}

	public function medicine_delete_all_api($user_type="",$user_altercode="",$salesman_id="")
	{
		/**************************************************************** */
		$where = array('user_type'=>$user_type,'chemist_id'=>$user_altercode,'salesman_id'=>$salesman_id,'status'=>'0');
		$result = $this->delete_query("tbl_cart", $where);
		/**************************************************************** */
		
		if(empty($result)){
			$status = "0";
		}else{
			$status = "1";
		}

		$jsonArray = array();
		$dt = array(
			'status' => $status,
		);
		$jsonArray[] = $dt;
		
		$return["items"] = $jsonArray;
		return $return;
	}

	public function place_order_api($user_type='',$user_altercode='',$user_password='',$salesman_id='',$order_type='',$remarks='',$latitude='',$longitude='',$mobilenumber='',$modalnumber='',$device_id='')
	{
		$chemist_id = $user_altercode;
		
		$return["status"] = "0";
		$return["status_message"] = "<font color='red'>Sorry your order has been failed please try again.</font>";
		$under_construction = $this->Scheme_Model->get_website_data("under_construction");
		if($under_construction=="1")
		{
			return $return;
		}
		
		$get_total_price_of_order["status"] = 1;
		if($user_type=="chemist")
		{
			$get_total_price_of_order = $this->get_total_price_of_order($user_type,$chemist_id,$user_password,$salesman_id);
		}
		if($get_total_price_of_order["status"]=="0")
		{
			return $return;
		}
		else
		{
			/*------------------------------------------------*/
			$date = date('Y-m-d');
			$time = date("H:i",time());
			$timestamp = time();
			$download_time = date("YmdHi", strtotime('+2 minutes', time()));
			/*------------------------------------------------*/

			/************************************************************************* */
			$total = 0;
			$row_total = $this->db->query("SELECT count(id) as items_total,sum(sale_rate*quantity) as items_price FROM `tbl_cart` WHERE `chemist_id`='$chemist_id' and salesman_id='$salesman_id' and user_type='$user_type' and status=0")->row();
			if(!empty($row_total)){
				$total = $row_total->items_price;
				$items_total = $row_total->items_total;
			}
			$dt = array(
				'chemist_id'=>$chemist_id,
				'salesman_id'=>$salesman_id,
				'user_type'=>$user_type,
				'order_type'=>$order_type,
				'remarks'=>$remarks,
				'total'=>$total,
				'date'=>$date,
				'time'=>$time,
				'timestamp'=>$timestamp,
				'download_time'=>$download_time,
				'items_total'=>$items_total,
				'gstvno'=>0);
			$order_id = $this->insert_query("tbl_cart_order",$dt);
			/************************************************************************ */
			if(!empty($order_id))
			{
				/**************************************** */
				$where = array('user_type'=>$user_type,'chemist_id'=>$user_altercode,'salesman_id'=>$salesman_id,'status'=>'0');
				$dt = array('status'=>'1','order_id'=>$order_id,);
				$this->update_query("tbl_cart",$dt,$where);
				/**************************************** */
				
				$place_order_message = $this->Scheme_Model->get_website_data("place_order_message");
				$return["status_message"] = "<font color='#28a745'>Your Order No. : ".$order_id."</font>".$place_order_message;
				$return["status"] = "1";
				return $return;
			}
			else{
				return $return; // jab mobile say order kar diya or website par be place order karay to
			}
		}
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

	function update_query($tbl,$dt,$where)
	{
		if($this->db->update($tbl,$dt,$where))
		{
			return true;
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
}
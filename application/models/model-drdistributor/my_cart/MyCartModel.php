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
			$return = $user_type."_".$salesman_id."_".$user_altercode;
		}
		else
		{
			$return = $user_type."_".$user_altercode;
		}
		return $return;
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
		$where = array('chemist_id' => $user_altercode,'salesman_id' => $selesman_id,'user_type' => $user_type,	'status' => '0');
		$this->db->select("*");
		$this->db->where($where);
		$this->db->order_by("
			CASE 
				WHEN order_type = 'pc_mobile' THEN 1 
				WHEN order_type = 'excelFile' THEN 2 
				ELSE 3 
			END
		", null, false);
		$this->db->order_by("
			CASE 
				WHEN order_type = 'pc_mobile' THEN short_order 
				ELSE NULL 
			END
		", 'DESC', false);
		$this->db->order_by("
			CASE 
				WHEN order_type = 'excelFile' THEN short_order 
				ELSE NULL 
			END
		", 'ASC', false);
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

	public function medicine_add_to_cart_api($user_type,$user_altercode,$salesman_id,$order_type,$item_code,$item_order_quantity,$mobilenumber,$modalnumber,$device_id,$excel_number="0")
	{
		/**************************************************************** */
		$where = array('user_type'=>$user_type,'chemist_id'=>$user_altercode,'selesman_id'=>$salesman_id,'i_code'=>$item_code,'status'=>'0');
		$this->delete_fun("drd_temp_rec", $where);
		/**************************************************************** */

		$time = time();
		$date = date("Y-m-d",$time);
		$time1 = date("H:i",$time);
		$datetime = date("d-M-y H:i",$time);
		$timestamp = time();

		/**************************************************************** */
		if($user_type=="sales")
		{
			$temp_rec = $user_type."_".$salesman_id."_".$user_altercode;			
		}
		else
		{
			$temp_rec = $user_type."_".$user_altercode;
		}

		$short_order = $this->get_short_order($user_type,$user_altercode,$salesman_id);

		/**********1000 say jada ki value add he nahi hoya ge cart me */
		if($item_order_quantity>=1000){
			$item_order_quantity = 1000;
		}
		
		/**************************************************************** *
		 * off kar diya yha 2024-03-23 ko
		if(empty($excel_number)){
			$excel_number = 1;
			$row = $this->db->query("select excel_number from drd_temp_rec where user_type='$user_type' and chemist_id='$user_altercode' and selesman_id='$salesman_id' and status=0 order by id desc")->row();
			if(!empty($row->excel_number)){
				$excel_number = $row->excel_number + 1;
			}
		}
		

		/**************************************************************** */
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
				'order_id'=>"",);

			$this->insert_fun("drd_temp_rec",$dt);
			

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
					$this->insert_fun("tbl_cart",$dt1);
				}else{
					//sirf qunatity update hoti ha
					$dt2 = array(
						'quantity'=>$item_order_quantity,
						'date'=>$date,
						'time'=>$time1,
						'timestamp'=>$timestamp,
						'order_type'=>$order_type,);
					$this->update_fun("tbl_cart",$dt2,$where);
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
		$where = array('user_type'=>$user_type,'chemist_id'=>$user_altercode,'selesman_id'=>$salesman_id,'status'=>'0','i_code'=>$item_code);
		$result = $this->delete_fun("drd_temp_rec", $where);
		/**************************************************************** */

		/**************************************************************** */
		$where = array('user_type'=>$user_type,'chemist_id'=>$user_altercode,'salesman_id'=>$salesman_id,'status'=>'0','i_code'=>$item_code);
		$result = $this->delete_fun("tbl_cart", $where);
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
		$where = array('user_type'=>$user_type,'chemist_id'=>$user_altercode,'selesman_id'=>$salesman_id,'status'=>'0');
		$result = $this->delete_fun("drd_temp_rec", $where);
		/**************************************************************** */

		/**************************************************************** */
		$where = array('user_type'=>$user_type,'chemist_id'=>$user_altercode,'salesman_id'=>$salesman_id,'status'=>'0');
		$result = $this->delete_fun("tbl_cart", $where);
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

	public function tbl_order_id()
	{
		$q = $this->db->query("select order_id from tbl_order_id where id='1'")->row();
		$order_id = $q->order_id + 1;
		$this->db->query("update tbl_order_id set order_id='$order_id' where id='1'");
		return $order_id;
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
		$temp_rec = $this->get_temp_rec($user_type,$chemist_id,$salesman_id);
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


			/********************************************************************************** */
			$total = 0;
			$row_total = $this->db->query("SELECT sum(sale_rate*quantity) as total FROM `tbl_cart` WHERE `chemist_id`='$chemist_id' and salesman_id='$salesman_id' and user_type='$user_type' and status=0")->row();
			if(!empty($row_total)){
				$total = $row_total->total;
			}
			$dt1 = array(
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
				'gstvno'=>0);
			$query = $this->insert_fun("tbl_cart_order",$dt1);
			$order_id = $query;
			/********************************************************************************** */
			
			$this->db->distinct("i_code");
			$this->db->select("i_code,quantity,item_name,sale_rate,item_code,image");
			if($user_type=="sales")
			{
				$this->db->where('selesman_id',$salesman_id);
			}
			$this->db->where('user_type',$user_type);
			$this->db->where('temp_rec',$temp_rec);
			$this->db->where('chemist_id',$chemist_id);
			$this->db->where('status','0');
			$this->db->order_by('i_code','desc');	
			$query = $this->db->get("drd_temp_rec")->result();
						
			$total = 0;
			$join_temp = time()."_".$user_type."_".$chemist_id."_".$salesman_id;
			$i_code = "";
			$temp_rec_new = $order_id."_".$temp_rec;
			foreach($query as $row)
			{
				$i_code		= 	$row->i_code;
				$quantity 	= 	$row->quantity;
				$item_name 	=  	$row->item_name;
				$sale_rate 	=  	$row->sale_rate;
				$item_code 	=  	$row->item_code; // its real id
				$item_image	=  	$row->image;				
				
				$total = $total + ($sale_rate * $quantity);				
				
				if(!empty($item_name)){
					$dt = array(
						'order_id'=>$order_id,
						'chemist_id'=>$chemist_id,
						'selesman_id'=>$salesman_id,
						'user_type'=>$user_type,
						'order_type'=>$order_type,
						'remarks'=>$remarks,
						'i_code'=>$i_code,
						'item_code'=>$item_code,
						'item_name'=>$item_name,
						'quantity'=>$quantity,
						'sale_rate'=>$sale_rate,
						'date'=>$date,
						'time'=>$time,
						'join_temp'=>$join_temp,
						'temp_rec'=>$temp_rec_new,
						'status'=>'1',
						'gstvno'=>'',
						'odt'=>'',
						'ordno_new'=>'',
						'latitude'=>$latitude,
						'longitude'=>$longitude,
						'mobilenumber'=>$mobilenumber,
						'modalnumber'=>$modalnumber,
						'device_id'=>$device_id,
						'image'=>$item_image,
						'download_time'=>$download_time,
					);
					$query = $this->insert_fun("tbl_order",$dt);
				}
			}
			if(!empty($query))
			{
				/**************************************** */
				$where = array('user_type'=>$user_type,'chemist_id'=>$user_altercode,'selesman_id'=>$salesman_id,'status'=>'0','temp_rec'=>$temp_rec);
				$dt = array('status'=>'1','order_id'=>$order_id);
				$this->update_fun("drd_temp_rec",$dt,$where);
				/**************************************** */

				/**************************************** */
				$where = array('user_type'=>$user_type,'chemist_id'=>$user_altercode,'salesman_id'=>$salesman_id,'status'=>'0');
				$dt = array('status'=>'1','order_id'=>$order_id,);
				$this->update_fun("tbl_cart",$dt,$where);
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

	function insert_fun($tbl,$dt)
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

	function update_fun($tbl,$dt,$where)
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

	function delete_fun($tbl,$where)
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
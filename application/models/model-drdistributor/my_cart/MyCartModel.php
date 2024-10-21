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
		if($user_type=="sales")
		{
		}else{
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
		if($user_type=="sales")
		{			
		}
		else
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
		$this->db->delete("drd_temp_rec", $where);

		$where = array('user_type'=>$user_type,'chemist_id'=>$user_altercode,'salesman_id'=>$salesman_id,'i_code'=>$item_code,'status'=>'0');
		$this->db->delete("tbl_cart", $where);
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
				'time'=>$time,
				'timestamp'=>$timestamp,
				'order_type'=>$order_type,
				'mobilenumber'=>$mobilenumber,
				'modalnumber'=>$modalnumber,
				'device_id'=>$device_id,
				'short_order'=>$short_order,
				'status'=>0,
				'order_id'=>"",);
			
			$this->insert_fun("tbl_cart",$dt1);
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
		$result = $this->db->query("delete from drd_temp_rec where user_type='$user_type' and chemist_id='$user_altercode' and selesman_id='$salesman_id' and status='0' and i_code='$item_code'");

		$result = $this->db->query("delete from tbl_cart where user_type='$user_type' and chemist_id='$user_altercode' and salesman_id='$salesman_id' and status='0' and i_code='$item_code'");
		
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
		$result = $this->db->query("delete from drd_temp_rec where user_type='$user_type' and chemist_id='$user_altercode' and selesman_id='$salesman_id' and status='0'");

		$result = $this->db->query("delete from tbl_cart where user_type='$user_type' and chemist_id='$user_altercode' and salesman_id='$salesman_id' and status='0'");
		
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

	public function place_order_api($user_type='',$user_altercode='',$user_password='',$selesman_id='',$order_type='',$remarks='',$latitude='',$longitude='',$mobilenumber='',$modalnumber='',$device_id='')
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
		$temp_rec = $this->get_temp_rec($user_type,$chemist_id,$selesman_id);
		if($user_type=="chemist")
		{
			$get_total_price_of_order = $this->get_total_price_of_order($user_type,$chemist_id,$user_password,$selesman_id);
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
			$download_time = date("YmdHi", strtotime('+2 minutes', time()));
			$order_id 	= $this->tbl_order_id();
			/*------------------------------------------------*/
			
			$this->db->distinct("i_code");
			$this->db->select("i_code,quantity,item_name,sale_rate,item_code,image");
			if($user_type=="sales")
			{
				$this->db->where('selesman_id',$selesman_id);
			}
			$this->db->where('user_type',$user_type);
			$this->db->where('temp_rec',$temp_rec);
			$this->db->where('chemist_id',$chemist_id);
			$this->db->where('status','0');
			$this->db->order_by('i_code','desc');	
			$query = $this->db->get("drd_temp_rec")->result();
						
			$total = 0;
			$join_temp = time()."_".$user_type."_".$chemist_id."_".$selesman_id;
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
						'selesman_id'=>$selesman_id,
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
				$this->save_order_to_server_again($temp_rec_new,$order_id,$order_type);
				$this->db->query("update drd_temp_rec set status='1',order_id='$order_id' where temp_rec='$temp_rec' and status='0' and chemist_id='$chemist_id' and selesman_id='$selesman_id'");

				$this->db->query("update tbl_cart set status='1',order_id='$order_id' where status='0' and chemist_id='$chemist_id' and salesman_id='$selesman_id' and user_type='$user_type'");
				
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
	
	public function save_order_to_server_again($temp_rec,$order_id,$order_type)
	{
		$where = array('temp_rec'=>$temp_rec,'order_id'=>$order_id);
		$this->db->where($where);
		$query = $this->db->get("tbl_order")->result();
		$total_rs = $count_line = 0;
		foreach($query as $row)
		{
			$remarks 	= $row->remarks;
			$user_type 	= $row->user_type;
			$chemist_id = $row->chemist_id;
			$selesman_id= $row->selesman_id;
			$total_rs 	= ($row->sale_rate * $row->quantity) + $total_rs;
			$count_line++;
		}
		$total_rs = round($total_rs);
		if($user_type=="chemist")
		{			
			$where 			= array('altercode'=>$chemist_id);
			$users 			= $this->Scheme_Model->select_row("tbl_chemist",$where);
			$acm_altercode 	= $users->altercode;
			$acm_name		= ucwords(strtolower($users->name));
			$acm_email 		= $users->email;
			$acm_mobile 	= $users->mobile;			
			
			$chemist_excle 	= "$acm_name ($acm_altercode)";
			$file_name 		= $acm_altercode;
		}
		if($user_type=="sales")
		{
			//jab sale man say login hota ha to
			$where 			= array('altercode'=>$chemist_id);
			$users 			= $this->Scheme_Model->select_row("tbl_chemist",$where);
			$user_session	= $users->id;
			$acm_altercode 	= $users->altercode;
			$acm_name 		= ucwords(strtolower($users->name));
			$acm_email 		= $users->email;
			$acm_mobile 	= $users->mobile;
			
			$where = array('customer_code'=>$selesman_id);
			$users = $this->Scheme_Model->select_row("tbl_users",$where);
			$salesman_name 		= $users->firstname." ".$users->lastname;
			$salesman_mobile	= $users->cust_mobile;
			$salesman_altercode	= $users->customer_code;
			
			$chemist_excle 	= $acm_name." ($acm_altercode)";
			$file_name 		= $acm_altercode;
		}
		/*****************Excel file ke liya*****************************
		// yha code band kiya ha ku ki url diya ha file nahi bj rhay no need file ko download ka url bj rahy ha osi say sara kam ho raha ha	
		$file_name_1 = $this->Order_Model->excel_save_order_to_server($query,$chemist_excle,"cronjob_download");
		/****************************************************************/	
		
		/*****************whtsapp message*****************************/	
		if($user_type == "sales")
		{
			if($salesman_mobile!="")
			{
				$w_number 		= "+91".$salesman_mobile;//$c_cust_mobile;
				$w_altercode 	= $acm_altercode;
				$w_message 		= "New Order Placed - $order_id for $acm_name for amount $total_rs";
				$this->Message_Model->insert_whatsapp_message($w_number,$w_message,$w_altercode);
			}
		}
		$whatsapp_email_how_to_use_dt = $this->whatsapp_email_how_to_use_dt($query);
		$whatsapp_table_formet_dt 	= $whatsapp_email_how_to_use_dt[0];
		$email_table_formet_dt 		= $whatsapp_email_how_to_use_dt[1];
		$html_table_formet_dt 		= $whatsapp_email_how_to_use_dt[2];
		
		if($remarks){
			$remarks = "<br>Remarks : ".$remarks;
		}

		$default_place_order_text = $this->Scheme_Model->get_website_data("default_place_order_text");

		$whatsapp_footer_text = $this->Scheme_Model->get_website_data("whatsapp_footer_text");
		$txt_msg = "Hello $acm_name ($acm_altercode)<br><br>".$default_place_order_text."<br><br>Order No. : $order_id<br>Total Rs. : $total_rs/- $remarks $whatsapp_table_formet_dt <br><br><b>You can check your order by clicking on </b><br><br>https://www.drdistributor.com/view_order/".$acm_altercode."/".$order_id." <br><br><b>You can download your order by clicking on</b> <br><br>https://www.drdistributor.com/order_download/".$acm_altercode."/".$order_id." ".$whatsapp_footer_text;

		$email_footer_text = $this->Scheme_Model->get_website_data("email_footer_text");
		$txt_msg_email = "Hello $acm_name ($acm_altercode)<br><br>".$default_place_order_text."<br><br>Order No. : $order_id<br>Total Rs. : $total_rs/- $remarks $email_table_formet_dt <br><br><b>You can check your order by clicking on </b><br><br>https://www.drdistributor.com/view_order/".$acm_altercode."/".$order_id." <br><br><b>You can download your order by clicking on</b> <br><br>https://www.drdistributor.com/order_download/".$acm_altercode."/".$order_id." ".$email_footer_text."<br><br>".$html_table_formet_dt;			
			
		/************************************************/
		$q_altercode 	= $acm_altercode;
		$q_title 		= "New Order - $order_id";
		$q_message		= $txt_msg;
		$this->Message_Model->insert_android_notification("4",$q_title,$q_message,$q_altercode,"chemist");
		/************************************************/
		if(!empty($acm_mobile))
		{
			$w_number 		= "+91".$acm_mobile;
			$w_altercode 	= $acm_altercode;
			$w_message 		= $txt_msg;
			$this->Message_Model->insert_whatsapp_message($w_number,$w_message,$w_altercode);
		}
		else
		{
			$err = "Number not Available";
			$mobile = "";
			$this->Message_Model->tbl_whatsapp_email_fail($mobile,$err,$acm_altercode);
		}
		/***************only for group message***********************/
		$txt_msg1  = str_replace("Hello","",$txt_msg);
		$group2_message 	= "New order recieved from ".$txt_msg1;
		$whatsapp_group2 = $this->Scheme_Model->get_website_data("whatsapp_group2");
		$this->Message_Model->insert_whatsapp_group_message($whatsapp_group2,$group2_message);
		/*************************************************************/
		
		/******************group message******************************/
		$group1_message 	= "New Order Recieved from ".$txt_msg1."Please check in Easy Sol";
		$whatsapp_group1 = $this->Scheme_Model->get_website_data("whatsapp_group1");
		$this->Message_Model->insert_whatsapp_group_message($whatsapp_group1,$group1_message);
		/**********************************************************/
		
		$subject = "DRD Order || ($order_id) || $acm_name ($acm_altercode)";
		
		$message = "";
		if($user_type == "sales"){
			$message ="Salesman : ".$salesman_name." (".$salesman_altercode.")<br>";
		}		
		$message.=$txt_msg_email;
		
		$user_email_id = $acm_email;
		if (filter_var($user_email_id, FILTER_VALIDATE_EMAIL)) {
			//$user_email_id = "drdwebmail1@gmail.com";	
		}
		else{			
			$err = $user_email_id." is Wrong Email";
			$mobile = "";
			$this->Message_Model->tbl_whatsapp_email_fail($mobile,$err,$acm_altercode);
			$user_email_id = "kapildrd@gmail.com";			
		}
		if(!empty($user_email_id))
		{
			//$file_name1 = $order_id;
			$file_name_1 = $file_name1 = "";
			
			$subject = ($subject);
			$message = ($message);
			$email_function = "new_order";
			$mail_server = "";
			/************************************************/
			$row1 = $this->db->query("select * from tbl_email where email_function='$email_function'")->row();
			/***********************************************/
			$email_other_bcc = $row1->email;
			$date = date('Y-m-d');
			$time = date("H:i",time());
			$dt = array(
			'user_email_id'=>$user_email_id,
			'subject'=>$subject,
			'message'=>$message,
			'email_function'=>$email_function,
			'file_name1'=>$file_name1,
			'file_name_1'=>$file_name_1,
			'mail_server'=>$mail_server,
			'email_other_bcc'=>$email_other_bcc,
			'date'=>$date,
			'time'=>$time,
			);
			$this->insert_fun("tbl_email_send",$dt);				
		}
		
		return "1";
	}

	public function whatsapp_email_how_to_use_dt($query){
		
		$tbl = $tbl_w = $tbl_html = "";
		$i = $t = 0;
		foreach($query as $row)
		{
			$i++;
			$view = "";
			$row1 = $this->db->query("select * from tbl_medicine_use where i_code='$row->i_code'")->row();
			if(!empty($row1)){
				$t++;
				$view = "<b>How to use this medicine : </b><a href='".base_url()."medicine_use/".$row1->i_code."'>View</a>";
				$tbl_w.= $t.". ".$row->item_name."<br>".base_url()."medicine_use/".$row1->i_code."<br>";
				
				$tbl_html.= "<br><br><hr><h2><center>How to use this medicine :<b>".$row->item_name."</b></center></h2><br>";
				// for email html
				$result2 = $this->db->query("select * from tbl_medicine_use_child where item_code='$row1->i_code' order by file_type asc")->result();
				foreach($result2 as $row2){
					if($row2->file_type=="image"){
						$tbl_html.= "<img src='".constant('img_url_site').$row2->file."' width='250px' style='object-fit: contain;height: 200px;margin-right:15px;margin-bottom:15px;border-radius:10px;'>";
					}
					if($row2->file_type=="video"){ 
						$tbl_html.= "<a href='".constant('img_url_site').$row2->file."'><img src='https://www.drdistributor.com/img_v51/default-video-thumbnail.jpg' width='250px' style='object-fit: contain;height: 200px;margin-right:15px;margin-bottom:15px;border-radius:10px;'></a>";
					}
				}
			}
			
			$tbl.= "<tr><td>".$i."</td><td>".$row->item_code."</td><td>".$row->item_name." ".$view."</td><td>".$row->quantity."</td><td>".$row->sale_rate."</td><td>".$row->sale_rate * $row->quantity."</td></tr>";
		}
		
		$tbl = "<br><br><table width='100%' border='1'><tr><th>SrNo.</th><th>Item Code</th><th>Item Name</th><th>Item quantity</th><th>Price</th><th>Total</th></tr> ".$tbl."</table>";
		if($tbl_w){
			$tbl_w = "<br><br><b>How to use this medicine</b><br><br>".$tbl_w;
		}
		
		$x[0] = $tbl_w;
		$x[1] = $tbl;
		$x[2] = $tbl_html;
		
		return $x;
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
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AccountModel extends CI_Model  
{
	public function __construct(){
		parent::__construct();
	}
    
    public function login_check($back_url='')
	{
        if(empty($_COOKIE["user_altercode"])){
			if(!empty($back_url)){
				redirect(base_url()."login?back_url=".$back_url);
			}else{
				redirect(base_url()."login");
			}
		}
		$under_construction = $this->Scheme_Model->get_website_data("under_construction");
		if($under_construction=="1")
		{
			redirect(base_url()."under_construction");
		}

		if(!empty($_COOKIE["user_type"]))
		{
			$user_type = $_COOKIE["user_type"];
			if($user_type=="sales" && empty($_COOKIE["chemist_id"]))
			{
				redirect(base_url()."select_chemist");
			}
		}	
	}

	public function check_nrx_user($user_altercode)
	{
		$logout   	= 0;
		$user_nrx 	= "no";
		$user_image = base_url()."img_v51/logo.png";

		$query = $this->db->query("select tbl_chemist.id,tbl_chemist.narcolicence,tbl_acm_other.image,tbl_acm_other.status,tbl_acm_other.block,tbl_acm_other.image,tbl_acm_other.delete_request,tbl_acm_other.delete_request_date from tbl_chemist left join tbl_acm_other on tbl_chemist.code = tbl_acm_other.code where tbl_chemist.altercode='$user_altercode' and tbl_chemist.code=tbl_acm_other.code limit 1")->row();
		if(!empty($query->id)){
			$narcolicence = $query->narcolicence;
			if($narcolicence=="."){
				$user_nrx = "yes";
			}			
			if(!empty($query->image))
			{
				$user_image = base_url()."user_profile/".$query->image;
			}
			if($query->block=="1" || $query->status=="0" || $query->delete_request=="1"){
				$logout = 1;
			}
		}else{
			$logout = 1;
		}

		$return["user_nrx"] 	= $user_nrx;
		$return["user_image"] 	= $user_image;
		$return["logout"] 		= $logout;
		return $return;	
	}

	public function get_login_api($user_name,$user_password,$type="")
	{	
		$jsonArray = array();

		$user_session = $user_fname = $user_code = $user_altercode = $user_type = $user_image = "";
		
		$defaultpassword= $this->Scheme_Model->get_website_data("defaultpassword");
		$status 		= 	"0";
		$status_message	= 	"User account doesn't exist.";
		$user_nrx 		= 	"no";
		if(!empty($user_name) && !empty($user_password))
		{
			$user_password = md5($user_password);			
			$query = $this->db->query("select tbl_chemist.id,tbl_chemist.code,tbl_chemist.altercode,tbl_chemist.narcolicence,tbl_chemist.name,tbl_chemist.address,tbl_chemist.mobile,tbl_chemist.invexport,tbl_chemist.email,tbl_chemist.status as status1,tbl_acm_other.status,tbl_acm_other.password as password,tbl_acm_other.exp_date,tbl_acm_other.block,tbl_acm_other.image,tbl_acm_other.delete_request,tbl_acm_other.delete_request_date from tbl_chemist left join tbl_acm_other on tbl_chemist.code = tbl_acm_other.code where tbl_chemist.altercode='$user_name' and tbl_chemist.code=tbl_acm_other.code limit 1")->row();
			if (!empty($query->id))
			{
				if ($query->password == $user_password || $user_password==md5($defaultpassword))
				{
					if($query->block=="0" && $query->status=="1")
					{
						$user_session 	= 	$query->id;
						$user_fname		= 	ucwords(strtolower($query->name));
						$user_code	 	= 	$query->code;
						$user_altercode	= 	$query->altercode;
						$narcolicence	= 	$query->narcolicence;

						$user_nrx = "no";
						if($narcolicence=="."){
							$user_nrx = "yes";
						}
						$user_image 	= 	base_url()."user_profile/".$query->image;
						if(empty($query->image))
						{
							$user_image = base_url()."img_v51/logo4.png";
						}
						$user_type 		= 	"chemist";
						$status 		= 	"1";
						$status_message = 	"Logged in successfully";
						/*if($type=="mobile")
						{							
							$otp_type 			= "1";
							$otp_sms  		  	= rand(9999,99999);
							$otp_massage_txt  	= $this->otp($query->altercode,$otp_sms);
							$status_message 	= 	"OTP sent successfully";
						}*/
					}
					else
					{
						$status_message = "Can't Login due to technical issues.";
						if($query->delete_request=="1")
						{
							$delete_request_date = date("d-M-Y",strtotime($query->delete_request_date));
							$android_mobile = $this->Scheme_Model->get_website_data("android_mobile");
							$status_message = "Your Account is in delete mode. Your account deleted automatically after $delete_request_date . if your recover your account then you can connect to Vipul Gupta ($android_mobile)";
						}
					}
				}
				else
				{
					$status_message = "Invalid password";
				}
			}
			else
			{
				$query = $this->db->query("select u.id,u.customer_code,u.customer_name,u.cust_addr1,u.cust_mobile,u.cust_email,u.is_active,u.user_role,u.login_expiry,u.divison,u.company_name,lu.password,lu.image	from tbl_users u left join tbl_users_other lu on lu.customer_code = u.customer_code where lu.customer_code='$user_name' limit 1")->row();
				if (!empty($query->id))
				{
					if ($query->password == $user_password || $user_password==md5($defaultpassword))
					{
						$user_session 	= 	$query->id;
						$user_fname		= 	ucwords(strtolower($query->customer_name));
						$user_image 	= 	base_url()."user_profile/".$query->image;
						if(empty($query->image))
						{
							$user_image = base_url()."img_v51/logo4.png";
						}
						$user_code	 	= 	$query->customer_code;
						$user_altercode	= 	$query->customer_code;
						$user_type 		= 	"sales";
						$status 		= 	"1";
						$status_message = 	"Logged in successfully";
						$user_nrx 		= "yes";
					}
					else
					{
						$status_message = "Invalid password";
					}
				}
			}
		}

		if($status==1 && $type=="website"){
			$this->insert_website_session($user_session,$user_fname,$user_code,$user_altercode,$user_type,$user_password,$user_image,$user_nrx);
		}

		$dt = array(
			'user_session' => $user_session,
			'user_fname' => $user_fname,
			'user_code' => $user_code,
			'user_altercode' => $user_altercode,
			'user_type' => $user_type,
			'user_password' => $user_password,
			'user_image' => $user_image,
			'user_nrx' => $user_nrx,
			'status' => $status,
			'status_message' => $status_message,
		);
		$jsonArray[] = $dt;

		$return["items"] = $jsonArray;
		return $return;	
	}

	public function insert_website_session($user_session='',$user_fname='',$user_code='',$user_altercode='',$user_type='',$user_password='',$user_image='',$user_nrx='') 
	{		
		//$session_arr = array('user_session'=>$user_session,'user_fname'=>$user_fname,'user_code'=>$user_code,'user_altercode'=>$user_altercode,'user_type'=>$user_type,'user_password'=>$user_password,'user_division'=>$user_division,'user_compcode'=>$user_compcode,'user_image'=>$user_image,'user_nrx'=>$user_nrx);

		setcookie("user_session", $user_session, time() + (86400 * 30), "/");
		setcookie("user_fname", $user_fname, time() + (86400 * 30), "/");
		setcookie("user_code", $user_code, time() + (86400 * 30), "/");
		setcookie("user_altercode", $user_altercode, time() + (86400 * 30), "/");
		setcookie("user_type", $user_type, time() + (86400 * 30), "/");
		setcookie("user_password", $user_password, time() + (86400 * 30), "/");
		setcookie("user_image", $user_image, time() + (86400 * 30), "/");
		setcookie("user_nrx", $user_nrx, time() + (86400 * 30), "/");
		//$this->session->set_userdata($session_arr);
		$login_time = time();
		$update_time = date("YmdHi", strtotime("+15 minutes", $login_time));
		$row = $this->db->query("select * from drd_login_time where user_altercode='$user_altercode' and user_type='$user_type'")->row();
		if(empty($row->id))
		{
			$this->db->query("insert into drd_login_time set user_altercode='$user_altercode',user_type='$user_type',login_time='$login_time',update_time='$update_time'");
		}
		else
		{
			$this->db->query("update drd_login_time set login_time='$login_time',update_time='$update_time' where user_altercode='$user_altercode' and user_type='$user_type'");
		}
		return "1";
	}

	public function get_create_new_api($user_name,$phone_number)
	{		
		$status = "0";
		$query = $this->db->query("select * from tbl_chemist where altercode='$user_name' and slcd='CL' limit 1")->row();
		if (empty($query->id))
		{
			$status_message = "User account doesn't exist.";
		}
		else
		{
			$code = $query->code;
			$row1 = $this->db->query("select * from tbl_acm_other where code='$code'")->row();
			if(empty($row1->id))
			{
				$new_request = 1;
				$dt = array(
					'code'=>$code,
					'new_request'=>$new_request,
					'order_limit'=>"3000",
					'website_limit'=>"3000",
					'android_limit'=>"3000",
					'user_phone'=>$phone_number,
					'download_status'=>0,
				);
				$this->Scheme_Model->insert_fun("tbl_acm_other",$dt);
				$subject = "Request for New Account";
				$message = "Request for New Account <br><br>Chemist Code : $user_name <br><br>Phone Number : $phone_number";
				$email_function = "new_account";
				$mail_server = "";		
				$user_email_id = "vipul@drdindia.com";
				$date = date('Y-m-d');
				$time = date("H:i",time());
				$dt = array(
					'user_email_id'=>$user_email_id,
					'subject'=>$subject,
					'message'=>$message,
					'email_function'=>$email_function,
					'mail_server'=>$mail_server,
					'date'=>$date,
					'time'=>$time,
				);
				$x = $this->Scheme_Model->insert_fun("tbl_email_send",$dt);
				if($x){
					$status = "1";
					$status_message = "Thank you for submitting your request we will get in touch with you shortly.";
				}
				/******************group message******************************/
				$group1_message 	= "Request for New Account<br><br>Chemist Code : $user_name<br><br>Phone Number : $phone_number";
				$whatsapp_group1 = $this->Scheme_Model->get_website_data("whatsapp_group1");
				$this->Message_Model->insert_whatsapp_group_message($whatsapp_group1,$group1_message);
				$group2_message 	= $group1_message;
				$whatsapp_group2 = $this->Scheme_Model->get_website_data("whatsapp_group2");
				$this->Message_Model->insert_whatsapp_group_message($whatsapp_group2,$group2_message);
				/**********************************************************/
			}
			else{
				$status_message = "User account already exists.";
			}
		}

		$dt = array(
			'status' => $status,
			'status_message' => $status_message,
		);
		$jsonArray[] = $dt;

		$return["items"] = $jsonArray;
		return $return;	
	}

	public function account_delete_request_api($user_name,$user_password,$phone_number)
	{		
		$status = "0";
		$status_message = "User account doesn't exist.";

		if(!empty($user_name) && !empty($user_password))
		{
			$user_password = md5($user_password);			
			$query = $this->db->query("select tbl_chemist.id,tbl_chemist.code,tbl_chemist.altercode,tbl_chemist.narcolicence,tbl_chemist.name,tbl_chemist.address,tbl_chemist.mobile,tbl_chemist.invexport,tbl_chemist.email,tbl_chemist.status as status1,tbl_acm_other.status,tbl_acm_other.password as password,tbl_acm_other.exp_date,tbl_acm_other.block,tbl_acm_other.image,tbl_acm_other.delete_request,tbl_acm_other.delete_request_date from tbl_chemist left join tbl_acm_other on tbl_chemist.code = tbl_acm_other.code where tbl_chemist.altercode='$user_name' and tbl_chemist.code=tbl_acm_other.code limit 1")->row();
			if (!empty($query->id))
			{
				if ($query->password == $user_password)
				{
					if($query->block=="0" && $query->status=="1")
					{
						/**************************************/
						$date = date('Y-m-d');
						$delete_request_date = date('Y-m-d', strtotime($date. ' + 7 day'));
						$this->db->query("update tbl_acm_other set block=1,status=0,delete_request=1,delete_request_date='$delete_request_date' where code='$query->code'");
						/**************************************/

						$group2_message = "Hello Team Account Delete Request<br><br>Chemist Code : ".$user_name."<br>Mobile Number : ".$phone_number."<br><br>Thanks";
						/***************only for group message***********************/
						$whatsapp_group2 = $this->Scheme_Model->get_website_data("whatsapp_group2");
						$this->Message_Model->insert_whatsapp_group_message($whatsapp_group2,$group2_message);
						/*************************************************************/

						$status = "1";
						$status_message = "Thank you for submitting your request your account delete with in 7 days.";
					}
					else
					{
						$status_message = "Can't Login due to technical issues.";
						if($query->delete_request=="1")
						{
							$delete_request_date = date("d-M-Y",strtotime($query->delete_request_date));
							$android_mobile = $this->Scheme_Model->get_website_data("android_mobile");
							$status_message = "Your Account is in delete mode. Your account deleted automatically after $delete_request_date . if your recover your account then you can connect to Vipul Gupta ($android_mobile)";
						}
					}
				}
				else
				{
					$status_message = "Invalid password";
				}
			}
		}

		$dt = array(
			'status' => $status,
			'status_message' => $status_message,
		);
		$jsonArray[] = $dt;

		$return["items"] = $jsonArray;
		return $return;	
	}
}
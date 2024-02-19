<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ChemistLoginModel extends CI_Model  
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

	public function chemist_login_api($user_name1,$password1,$type="")
	{	
		$jsonArray = array();

		$user_session = $user_fname = $user_code = $user_altercode = $user_type = $user_image = "";
		
		$defaultpassword= $this->Scheme_Model->get_website_data("defaultpassword");
		$status 		= 	"0";
		$status_message	= 	"Logic error.";
		$user_nrx 		= 	"no";
		if(!empty($user_name1) && !empty($password1))
		{
			$user_password = md5($password1);			
			$query = $this->db->query("select tbl_acm.id,tbl_acm.code,tbl_acm.altercode,tbl_acm.narcolicence,tbl_acm.name,tbl_acm.address,tbl_acm.mobile,tbl_acm.invexport,tbl_acm.email,tbl_acm.status as status1,tbl_acm_other.status,tbl_acm_other.password as password,tbl_acm_other.exp_date,tbl_acm_other.block,tbl_acm_other.image from tbl_acm left join tbl_acm_other on tbl_acm.code = tbl_acm_other.code where tbl_acm.altercode='$user_name1' and tbl_acm.code=tbl_acm_other.code limit 1")->row();
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
						if($narcolicence=="."){
							$user_nrx = "yes";
						}
						$user_image 	= 	base_url()."user_profile/".$query->image;
						if(empty($query->image))
						{
							$user_image = base_url()."img_v51/logo.png";
						}
						$user_type 		= 	"chemist";
						$status 		= 	"1";
						$status_message = 	"Logged in successfully";
						if($type=="mobile")
						{							
							$otp_type 			= "1";
							$otp_sms  		  	= rand(9999,99999);
							$otp_massage_txt  	= $this->otp($query->altercode,$otp_sms);
							$status_message 	= 	"OTP sent successfully";
						}
					}
					else
					{
						$status_message = "Can't Login due to technical issues.";
					}
				}
				else
				{
					$status_message = "Invalid password";
				}
			}
			else
			{
				$query = $this->db->query("select u.id,u.customer_code,u.customer_name,u.cust_addr1,u.cust_mobile,u.cust_email,u.is_active,u.user_role,u.login_expiry,u.divison,u.company_name,lu.password,lu.image	from tbl_users u left join tbl_users_other lu on lu.customer_code = u.customer_code where lu.customer_code='$user_name1' limit 1")->row();
				if (!empty($query->id))
				{
					if ($query->password == $user_password || $user_password==md5($defaultpassword))
					{
						$user_session 	= 	$query->id;
						$user_fname		= 	ucwords(strtolower($query->customer_name));
						$user_image 	= 	base_url()."user_profile/".$query->image;
						if(empty($query->image))
						{
							$user_image = base_url()."img_v51/logo.png";
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
}
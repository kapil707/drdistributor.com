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

		$otp_type  = "0";		
		$otp_sms = $otp_massage_txt = "";
		$user_session = $user_fname = $user_code = $user_altercode = $user_division = $user_compcode = $user_type = $user_image = "";
		$items = "";
		$defaultpassword= $this->Scheme_Model->get_website_data("defaultpassword");
		$user_return 	= 	"0";
		$user_alert 	= 	"Logic error.";
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
						$user_return 	= 	"1";
						$user_alert 	= 	"Logged in successfully";
						if($type=="mobile")
						{							
							$otp_type 			= "1";
							$otp_sms  		  	= rand(9999,99999);
							$otp_massage_txt  	= $this->otp($query->altercode,$otp_sms);
							$user_alert 	= 	"OTP sent successfully";
						}
					}
					else
					{
						$user_alert = "Can't Login due to technical issues.";
					}
				}
				else
				{
					$user_alert = "Invalid password";
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
						$user_return 	= 	"1";
						$user_alert 	= 	"Logged in successfully";
						$user_nrx 		= "yes";
					}
					else
					{
						$user_alert = "Invalid password";
					}
				}
				else
				{
					$query = $this->db->query("select tbl_staffdetail.compcode,tbl_staffdetail.division,tbl_staffdetail.id,tbl_staffdetail.code,tbl_staffdetail.degn as name, tbl_staffdetail.mobilenumber as mobile,tbl_staffdetail.memail as email,tbl_staffdetail_other.status,tbl_staffdetail_other.password from tbl_staffdetail left join tbl_staffdetail_other on tbl_staffdetail.code = tbl_staffdetail_other.code where tbl_staffdetail.memail='$user_name1' and tbl_staffdetail.code=tbl_staffdetail_other.code limit 1")->row();
					if (!empty($query->id))
					{
						if ($query->password == $user_password)
						{
							if($query->status==1)
							{
								$user_session 	= 	$query->id;
								$user_fname		= 	ucwords(strtolower($query->name));
								$user_code	 	= 	$query->code;
								$user_altercode	= 	$query->code;
								$user_type 		= 	"corporate";
								$user_return 	= 	"1";
								$user_alert 	= 	"Logged in successfully";
								$user_division	= 	$query->division;
								$user_compcode	= 	$query->compcode;
								$user_image = constant('img_url_site')."img_v51/logo.png";
							}
							else
							{
								$user_alert = "Access denied";
							}
						}
						else
						{
							$user_alert = "Invalid password";
						}
					}
					else{
						$user_alert = "Invalid username & password";
					}
				}
			}
		}

		$dt = array(
			'user_session' => $user_session,
			'user_fname' => $user_fname,
			'user_code' => $user_code,
			'user_altercode' => $user_altercode,
			'user_type' => $user_type,
			'user_password' => $user_password,
			'user_alert' => $user_alert,
			'user_image' => $user_image,
			'user_return' => $user_return,
			'user_division' => $user_division,
			'user_compcode' => $user_compcode,
			'otp_type' => $otp_type,
			'otp_sms' => $otp_sms,
			'otp_massage_txt' => $otp_massage_txt,
			'user_nrx' => $user_nrx,
		);
		$jsonArray[] = $dt;

		$return["items"] = $jsonArray;
		return $return;	
	}

	public function otp($altercode,$otp_sms)
	{
		$query = $this->db->query("select tbl_acm.id,tbl_acm.code,tbl_acm.altercode,tbl_acm.name,tbl_acm.address,tbl_acm.mobile,tbl_acm.invexport,tbl_acm.email,tbl_acm.status as status1,tbl_acm_other.status,tbl_acm_other.password as password,tbl_acm_other.exp_date,tbl_acm_other.block,tbl_acm_other.image from tbl_acm left join tbl_acm_other on tbl_acm.code = tbl_acm_other.code where tbl_acm.altercode='$altercode' and tbl_acm.code=tbl_acm_other.code limit 1")->row();
		if($query->altercode)
		{
			$w_number 		= "+91".$query->mobile;//$c_cust_mobile;
			$w_altercode 	= $altercode;
			$w_message 		= $otp_sms." is otp for D.R. distributor login. Do not share it with anyone.";
			$this->Message_Model->insert_whatsapp_message($w_number,$w_message,$w_altercode);
			$subject = "D.R. distributor OTP Verify";
			$message = $w_message;
			$email_function = "password";
			$mail_server = "";
			$date = date('Y-m-d');
			$time = date("H:i",time());
			$user_email_id = $query->email;
			if (filter_var($user_email_id, FILTER_VALIDATE_EMAIL)) {		
				$dt = array(
					'user_email_id'=>$user_email_id,
					'subject'=>$subject,
					'message'=>$message,
					'email_function'=>$email_function,
					'mail_server'=>$mail_server,
					'date'=>$date,
					'time'=>$time,
					);
				$this->Scheme_Model->insert_fun("tbl_email_send",$dt);
			}
			$mobile = $query->mobile;
			$email 	= $query->email;
			$mobile = str_repeat('*', strlen($mobile) - 3) . substr($mobile, -3);
			$x = explode("@",$email);
			$e1 = substr($x[0], 0, 2);
			$e2 = str_repeat('*', strlen($x[0]) - 4) . substr($x[0], -2);
			$email = $e1.$e2."@".$x[1];
			return "OTP has been sent to you  on your mobile number (".$mobile.") or email address (".$email."). Please enter it below.";
		}
	}
	public function otp_resent($altercode)
	{
		$otp_sms  		  	= rand(9999,99999);
		$otp_massage_txt  	= $this->otp($altercode,$otp_sms);
$items=<<<EOD
{"otp_sms":"{$otp_sms}","otp_massage_txt":"{$otp_massage_txt}"},
EOD;
if ($items != '') {
	$items = substr($items, 0, -1);
}
	return $items;
	}
}
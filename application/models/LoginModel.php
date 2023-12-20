<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');
ini_set('post_max_size', '100M');
ini_set('upload_max_filesize', '100M');
ini_set('max_execution_time', 36000);
require_once APPPATH."/third_party/PHPExcel.php";
class LoginModel extends CI_Model  
{
	public function login($user_name1,$password1,$type="")
	{		
		$otp_type  = "0";		
		$otp_sms = $otp_massage_txt = "";
		
		$user_session = $user_fname = $user_code = $user_altercode = $user_division = $user_compcode = $user_type = $user_image = "";
		$items = "";
		$defaultpassword= $this->Scheme_Model->get_website_data("defaultpassword");
		$return_status 	= 	"0";
		$return_message = 	"Logic error.";
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
						$return_status 	= 	"1";
						$return_message = 	"Logged in successfully";
						$user_type 		= 	"chemist";

						$user_id 		= 	$query->id;
						$user_fname		= 	ucwords(strtolower($query->name));
						$user_code	 	= 	$query->code;
						$user_altercode	= 	$query->altercode;
						$narcolicence	= 	$query->narcolicence;
						if($narcolicence=="."){
							$user_nrx = "yes";
						}

						$user_image 	= 	constant('main_site')."user_profile/".$query->image;
						if(empty($query->image))
						{
							$user_image = constant('main_site')."img_v".constant('site_v')."/logo.png";
						}

						if($type=="mobile")
						{							
							$otp_type 			= "1";
							$otp_sms  		  	= rand(9999,99999);
							$otp_massage_txt  	= $this->otp($query->altercode,$otp_sms);
							$return_message 	= 	"OTP sent successfully";
						}
					}
					else
					{
						$return_message = "Can't Login due to technical issues.";
					}
				}
				else
				{
					$return_message = "Invalid password";
				}
			}
			else
			{
				$query = $this->db->query("select u.id,u.customer_code,u.customer_name,u.cust_addr1,u.cust_mobile,u.cust_email,u.is_active,u.user_role,u.login_expiry,u.divison,u.company_name,lu.password,lu.image	from tbl_users u left join tbl_users_other lu on lu.customer_code = u.customer_code where lu.customer_code='$user_name1' limit 1")->row();
				if (!empty($query->id))
				{
					if ($query->password == $user_password || $user_password==md5($defaultpassword))
					{
						$user_id 		= 	$query->id;
						$user_fname		= 	ucwords(strtolower($query->customer_name));
						$user_image 	= 	constant('main_site')."user_profile/".$query->image;
						if(empty($query->image))
						{
							$user_image = constant('main_site')."img_v".constant('site_v')."/logo.png";
						}
						$return_status 	= 	"1";
						$return_message = 	"Logged in successfully";

						$user_code	 	= 	$query->customer_code;
						$user_altercode	= 	$query->customer_code;
						$user_type 		= 	"sales";
						$user_nrx 		= "yes";
					}
					else
					{
						$return_message = "Invalid password";
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
								$return_status 	= 	"1";
								$return_message = 	"Logged in successfully";

								$user_id 		= 	$query->id;
								$user_fname		= 	ucwords(strtolower($query->name));
								$user_code	 	= 	$query->code;
								$user_altercode	= 	$query->code;
								$user_type 		= 	"corporate";
								$user_division	= 	$query->division;
								$user_compcode	= 	$query->compcode;
								$user_image = constant('img_url_site')."img_v".constant('site_v')."/logo.png";
							}
							else
							{
								$return_message = "Access denied";
							}
						}
						else
						{
							$return_message = "Invalid password";
						}
					}
					else{
						$return_message = "Invalid username & password";
					}
				}
			}
		}
		

$items.= <<<EOD
{"return_status":"$return_status","return_message":"$return_message","user_type":"$user_type","user_id":"$user_id","user_code":"$user_code","user_altercode":"$user_altercode","user_password":"$user_password","user_fname":"$user_fname","user_image":"$user_image","user_nrx":"$user_nrx","user_division":"$user_division","user_compcode":"$user_compcode","otp_type":"$otp_type","otp_sms":"$otp_sms","otp_massage_txt":"$otp_massage_txt"},
EOD;
if ($items != '') {
	$items = substr($items, 0, -1);
}
	return $items;
	}
}
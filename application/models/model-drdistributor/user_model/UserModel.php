<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserModel extends CI_Model  
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

	public function change_password($user_type,$user_altercode,$user_password,$new_password)
	{
		$jsonArray = array();

		$user_password = md5($user_password);
		
		$status_message = "Oldpassword doesn't match";
		$status = "0";
		if($user_type=="chemist")
		{
			$query = $this->db->query("select tbl_acm.id,tbl_acm.code,tbl_acm.altercode,tbl_acm.name,tbl_acm.address,tbl_acm.mobile,tbl_acm.invexport,tbl_acm.email,tbl_acm.status as status1,tbl_acm_other.status,tbl_acm_other.password as password,tbl_acm_other.exp_date,tbl_acm_other.block,tbl_acm_other.image from tbl_acm left join tbl_acm_other on tbl_acm.code = tbl_acm_other.code where tbl_acm.altercode='$user_altercode' and tbl_acm.code=tbl_acm_other.code limit 1")->row();
			if ($query->id!="")
			{
				if ($query->password == $user_password && $query->block=="0" && $query->status=="1")
				{
					$code = $query->code;
					$new_password = md5($new_password);
					$this->db->query("update tbl_acm_other set password='$new_password',download_status=0 where code='$code'");
					$status_message = "Updated successfully";
					$status = "1";
				}
				else
				{
					$status_message = "Oldpassword doesn't match";
				}
			}
			else
			{
				$status_message = "Logic error.";
			}
		}
		if($user_type=="sales")
		{
			$query = $this->db->query("select u.id,u.customer_code,u.customer_name,u.cust_addr1,u.cust_mobile,u.cust_email,u.is_active,u.user_role,u.login_expiry,u.divison,u.company_name,lu.password	from tbl_users u left join tbl_users_other lu on lu.customer_code = u.customer_code where lu.customer_code='$user_altercode' limit 1")->row();
			if ($query->id!="")
			{
				if ($query->password == $user_password)
				{
					$code = $query->customer_code;
					$new_password = md5($new_password);
					$this->db->query("update tbl_users_other set password='$new_password',download_status=0 where customer_code='$code'");
					$status_message = "Password Change Successfully";
					$status = "1";
				}
				else
				{
					$status_message = "Oldpassword doesn't match";
				}
			}
			else
			{
				$status_message = "Logic error.";
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
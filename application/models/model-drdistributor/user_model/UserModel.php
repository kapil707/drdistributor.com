<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserModel extends CI_Model  
{
	public function __construct(){
		parent::__construct();
	}

	public function user_account_api($user_type,$user_altercode)
	{
		$items = "";
		if($user_type=="chemist")
		{
			$row = $this->db->query("select * from tbl_acm where altercode='$user_altercode' and slcd='CL'")->row();
			if(!empty($row->id))
			{
				$user_id		= ($row->id);
				$user_name 		= (ucwords(strtolower($row->name)));
				$user_altercode = ($row->altercode);
				$user_mobile 	= ($row->mobile);
				$user_email 	= ($row->email);
				$user_address 	= ($row->address);
				$user_gstno 	= ($row->gstno);				
				$where= array('code'=>$row->code);
				$row1 = $this->Scheme_Model->select_row("tbl_acm_other",$where);
				$user_image = base_url()."user_profile/$row1->image";
				if(empty($row1->image))
				{
					$user_image = base_url()."img_v51/logo.png";
				}
				$user_status	= ($row1->status);
				if($user_status)
				{
					$user_status = "Active";
				}
				else
				{
					$user_status = "Inactive";
				}
			}
		}
		if($user_type=="sales")
		{
			$row = $this->db->query("select * from tbl_users where customer_code='$user_altercode'")->row();
			if(!empty($row->id))
			{
				$user_id		= ($row->id);
				$user_name 		= (ucwords(strtolower($row->customer_name)));
				$user_altercode = ($row->customer_code);
				$user_mobile 	= ($row->cust_mobile);
				$user_email 	= ($row->cust_email);
				$user_address 	= ($row->cust_addr1);
				$user_gstno 	= "";
				$user_status	= "1";
				$where= array('customer_code'=>$row->customer_code);
				$row1 = $this->Scheme_Model->select_row("tbl_users_other",$where);
				$user_image = base_url()."user_profile/$row1->image";
				if(empty($row1->image))
				{
					$user_image = base_url()."img_v51/logo.png";
				}
				if($user_status=="1")
				{
					$user_status = "Active";
				}
			}
		}

		$dt = array(
			'user_id' => $user_id,
			'user_name' => $user_name,
			'user_altercode' => $user_altercode,
			'user_mobile' => $user_mobile,
			'user_email' => $user_email,
			'user_address' => $user_address,
			'user_gstno' => $user_gstno,
			'user_status' => $user_status,
			'user_image' => $user_image,
		);
		$jsonArray[] = $dt;

		$return["items"] = $jsonArray;
		return $return;
	}

	public function check_user_account_api($user_type,$user_altercode)
	{
		$items = "";
		if($user_type=="chemist")
		{
			$row = $this->db->query("select * from tbl_acm where altercode='$user_altercode' and slcd='CL'")->row();
			if(!empty($row->id))
			{
				$id			= ($row->id);
				$row1 = $this->db->query("select * from tbl_acm_other where code='$row->code'")->row();
				$user_phone		= ($row1->user_phone);
				$user_email		= ($row1->user_email);
				$user_address	= ($row1->user_address);
				$user_update	= ($row1->user_update);
			}
		}
		if($user_type=="sales")
		{
			$row = $this->db->query("select * from tbl_users where customer_code='$user_altercode'")->row();
			if(!empty($row->id))
			{
				$user_phone		= ($row->user_phone);
				$user_email		= ($row->user_email);
				$user_address	= ($row->user_address);
				$user_update	= ($row->user_update);
			}
		}

		$dt = array(
			'user_phone' => $user_phone,
			'user_email' => $user_email,
			'user_address' => $user_address,
			'user_update' => $user_update,
		);
		$jsonArray[] = $dt;

		$return["items"] = $jsonArray;
		return $return;
	}

	public function update_password_api($user_type,$user_altercode,$user_password,$new_password)
	{
		$jsonArray = array();

		$user_password = md5($user_password);
		
		$status_message = "Oldpassword doesn't match";
		$status = "0";
		if($user_type=="chemist")
		{
			$query = $this->db->query("select tbl_acm.id,tbl_acm.code,tbl_acm.altercode,tbl_acm.name,tbl_acm.address,tbl_acm.mobile,tbl_acm.invexport,tbl_acm.email,tbl_acm.status as status1,tbl_acm_other.status,tbl_acm_other.password as password,tbl_acm_other.exp_date,tbl_acm_other.block,tbl_acm_other.image from tbl_acm left join tbl_acm_other on tbl_acm.code = tbl_acm_other.code where tbl_acm.altercode='$user_altercode' and tbl_acm.code=tbl_acm_other.code limit 1")->row();
			if(!empty($query->id))
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
			if(!empty($query->id))
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserModel extends CI_Model  
{
	var $user_profile_url = "";
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');
		
		$this->user_profile_url = $this->appconfig->getUserProfileUrl();
	} 

	public function get_user_account_api($user_type,$user_altercode,$salesman_id)
	{
		$items = "";
		if($user_type=="chemist")
		{
			$row = $this->db->query("select * from tbl_chemist where altercode='$user_altercode' and slcd='CL'")->row();
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
				$row1 = $this->Scheme_Model->select_row("tbl_chemist_other",$where);
				$user_image = $this->user_profile_url.$row1->image;
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
			$row = $this->db->query("select * from tbl_users where customer_code='$salesman_id'")->row();
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

	public function get_new_user_account_api($user_type,$user_altercode)
	{
		if($user_type=="chemist")
		{
			$row = $this->db->query("select * from tbl_chemist where altercode='$user_altercode' and slcd='CL'")->row();
			if(!empty($row->id))
			{
				$row1 = $this->db->query("select * from tbl_chemist_other where code='$row->code'")->row();
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

	public function update_user_account_api($user_type,$user_altercode,$user_phone,$user_email,$user_address)
	{
		$jsonArray = array();
		
		$status = "0";
		$status_message = "";
		if($user_type=="chemist")
		{
			$row = $this->db->query("select * from tbl_chemist where altercode='$user_altercode' and slcd='CL'")->row();
			if(!empty($row->id))
			{
				$code = ($row->code);
				$this->db->query("update tbl_chemist_other set user_phone='$user_phone',user_email='$user_email',user_address='$user_address',user_update='1' where code='$code'");
				$status_message = "Request has been sent. Your account will update soon.";
				$status = "1";
			}
			else
			{
				$status_message = "Logic error.";
			}
		}
		if($user_type=="sales")
		{
			$status1 = "";
			$row = $this->db->query("select * from tbl_users where customer_code='$user_altercode' and slcd='CL'")->row();
			if(!empty($row->id))
			{
				$code = ($row->customer_code);
				$this->db->query("update tbl_users_other set user_phone='$user_phone',user_email='$user_email',user_address='$user_address',user_update='1' where customer_code='$code'");
				$status_message = "Request has been sent";
				$status = "1";
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

	public function update_password_api($user_type,$user_altercode,$user_password,$new_password)
	{
		$jsonArray = array();

		$user_password = md5($user_password);
		
		$status_message = "Oldpassword doesn't match";
		$status = "0";
		if($user_type=="chemist")
		{
			$query = $this->db->query("select tbl_chemist.id,tbl_chemist.code,tbl_chemist.altercode,tbl_chemist.name,tbl_chemist.address,tbl_chemist.mobile,tbl_chemist.invexport,tbl_chemist.email,tbl_chemist.status as status1,tbl_chemist_other.status,tbl_chemist_other.password as password,tbl_chemist_other.exp_date,tbl_chemist_other.block,tbl_chemist_other.image from tbl_chemist left join tbl_chemist_other on tbl_chemist.code = tbl_chemist_other.code where tbl_chemist.altercode='$user_altercode' and tbl_chemist.code=tbl_chemist_other.code limit 1")->row();
			if(!empty($query->id))
			{
				if ($query->password == $user_password && $query->block=="0" && $query->status=="1")
				{
					$code = $query->code;
					$new_password = md5($new_password);
					$this->db->query("update tbl_chemist_other set password='$new_password',download_status=0 where code='$code'");
					$status_message = "Password updated successfully";
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

	public function update_user_upload_image_api($user_type,$user_altercode,$salesman_id,$files)
	{
		$jsonArray = array();

		$user_image = "";
		$upload_image = "user_profile";
		if (isset($files['upload_image']) && $files['upload_image']['error'] === UPLOAD_ERR_OK) {
			ini_set('upload_max_filesize', '10M');
			ini_set('post_max_size', '10M');
			ini_set('max_input_time', 300);
			ini_set('max_execution_time', 300);
	
			$config['upload_path'] = $upload_image;  // Define the directory where you want to store the uploaded files.
			$config['allowed_types'] = '*';  // You may want to restrict allowed file types.
			$config['max_size'] = 0;  // Set to 0 to allow any size.

			$new_name = time().$files["upload_image"]['name'];
			$config['file_name'] = $new_name;
	
			$this->load->library('upload', $config);
	
			if (!$this->upload->do_upload('upload_image')) {
				$error = array('error' => $this->upload->display_errors());
				//$this->load->view('upload_form', $error);
				//print_r($error);
				$status = 0;
				$status_message = $error;
			} else {
				$data = $this->upload->data();
				$user_image = ($data['file_name']);
				//$this->load->view('upload_success', $data);
			}

			if($user_type=="chemist")
			{
				$row = $this->db->query("select code from tbl_chemist where altercode='$user_altercode'")->row();
				
				$this->db->query("update tbl_chemist_other set image='$user_image' where code='$row->code'");
			}
			$status = 1;
			$status_message = "Uploaded successfully.";
		} else {
			// Invalid file or no file uploaded

			$status = 0;
			$status_message = "Invalid file or no file uploaded.";
		}

		$dt = array(
			'status' => $status,
			'status_message' => $status_message,
			'user_image' => $user_image,
		);
		$jsonArray[] = $dt;

		$return["items"] = $jsonArray;
		return $return;	
	}
}
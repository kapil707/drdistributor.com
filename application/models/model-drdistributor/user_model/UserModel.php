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

	public function get_chemist_photo($user_altercode){
		$row = $this->db->query("SELECT tbl_chemist_other.image from tbl_chemist,tbl_chemist_other where tbl_chemist.altercode='$user_altercode' and tbl_chemist.code = tbl_chemist_other.code")->row();
		$user_image = $this->user_profile_url.$row->image;
		if(empty($row->image))
		{
			$user_image = base_url().$this->appconfig->getWebJs()."/images/logo4.png";
		}
		return $user_image;
	}

	public function get_user_account_api($UserType='',$ChemistId='',$SalesmanId='')
	{
		$items = "";
		if($UserType=="chemist")
		{
			$row = $this->db->query("select * from tbl_chemist where altercode='$ChemistId' and slcd='CL'")->row();
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
		if($UserType=="sales")
		{
			$row = $this->db->query("select * from tbl_users where customer_code='$SalesmanId'")->row();
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
				$user_image = $this->user_profile_url.$row1->image;
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

	public function get_new_user_account_api($UserType='',$ChemistId='',$SalesmanId='')
	{
		if($UserType=="chemist")
		{
			$row = $this->db->query("select * from tbl_chemist where altercode='$ChemistId' and slcd='CL'")->row();
			if(!empty($row->id))
			{
				$row1 = $this->db->query("select * from tbl_chemist_other where code='$row->code'")->row();
				$user_phone		= ($row1->user_phone);
				$user_email		= ($row1->user_email);
				$user_address	= ($row1->user_address);
				$user_update	= ($row1->user_update);
			}
		}
		if($UserType=="sales")
		{
			$row = $this->db->query("select * from tbl_users where customer_code='$SalesmanId'")->row();
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

	public function update_user_account_api($UserType='',$ChemistId='',$user_phone,$user_email,$user_address)
	{
		$jsonArray = array();
		
		$status = "0";
		$status_message = "";
		if($UserType=="chemist")
		{
			$row = $this->db->query("select * from tbl_chemist where altercode='$ChemistId' and slcd='CL'")->row();
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

	public function update_password_api($UserType='',$ChemistId='',$user_password,$new_password)
	{
		$jsonArray = array();

		$user_password = md5($user_password);
		
		$status_message = "Oldpassword doesn't match";
		$status = "0";
		if($UserType=="chemist")
		{
			$query = $this->db->query("select tbl_chemist.id,tbl_chemist.code,tbl_chemist.altercode,tbl_chemist.name,tbl_chemist.address,tbl_chemist.mobile,tbl_chemist.invexport,tbl_chemist.email,tbl_chemist.status as status1,tbl_chemist_other.status,tbl_chemist_other.password as password,tbl_chemist_other.exp_date,tbl_chemist_other.block,tbl_chemist_other.image from tbl_chemist left join tbl_chemist_other on tbl_chemist.code = tbl_chemist_other.code where tbl_chemist.altercode='$ChemistId' and tbl_chemist.code=tbl_chemist_other.code limit 1")->row();
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
		if($UserType=="sales")
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

	public function update_user_upload_image_api($UserType='',$ChemistId='',$SalesmanId='',$files)
	{
		$jsonArray = array();

		$user_image = "";
		$upload_image = "user_profile";
		if (isset($files['upload_image']) && $files['upload_image']['error'] === UPLOAD_ERR_OK) {

			// Image file path and name
			$file_path = $files['upload_image']['tmp_name'];
			$file_name = $files['upload_image']['name'];
			
			// Server endpoint jahan image ko upload karna hai
			$url = 'https://drdweb.co.in/user_profile/upload_user_profile_api';
	
			// cURL request setup
			$curl = curl_init();
	
			// cURL options set kar rahe hain
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => array(
					'image' => new CURLFile($file_path, $files['upload_image']['type'], $file_name)
				),
			));
	
			 // cURL request send kar rahe hain
			 $response = curl_exec($curl);

			 $user_image = "";
			 // Error handle kar rahe hain
			 if (curl_errno($curl)) {
				 echo 'cURL Error: ' . curl_error($curl);
			 } else {
				 // JSON response ko decode karte hain
				 $response_data = json_decode($response, true);
	 
				 // `user_image` ko access karte hain
				 if (isset($response_data['success']) && $response_data['success'] == 1) {
					 	$user_image = $response_data['user_image'];
						$status = 1;
						$status_message = "Uploaded successfully.";
					 //echo 'Uploaded Image Name: ' . $user_image;
				 } else {
					 //echo 'Failed to upload image: ' . $response_data['message'];
					 	$status = 0;
						$status_message = "Invalid file or no file uploaded.";
				 }
			 }
	 
			 // cURL ko close karte hain
			 curl_close($curl);

			if($UserType=="chemist" && !empty($user_image))	{

				$row = $this->db->query("select code from tbl_chemist where altercode='$ChemistId'")->row();
				
				$this->db->query("update tbl_chemist_other set image='$user_image' where code='$row->code'");
			}
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
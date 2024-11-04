<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ChemistSelectModel extends CI_Model  
{
	var $user_profile_url = "";
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');

		$this->user_profile_url = $this->appconfig->getUserProfileUrl();
	}
	
	public function chemist_search_api($keyword="")
	{		
		$jsonArray = array();

		$result = $this->db->query("select tbl_chemist.name,tbl_chemist.altercode,tbl_chemist_other.image,tbl_chemist.narcolicence from tbl_chemist left JOIN tbl_chemist_other on tbl_chemist.code=tbl_chemist_other.code where (name like '".$keyword."%' or altercode='$keyword' or altercode like '%".$keyword."' or altercode like '".$keyword."%' or altercode like '%".$keyword."%') and slcd='CL' limit 50")->result();		
		$count = $user_cart = $user_cart_total = 0;
		foreach ($result as $row)
		{
			if(substr($row->name,0,1)==".")
			{
			}
			else
			{
				$chemist_name		=	ucwords(strtolower($row->name));
				$chemist_altercode	=	$row->altercode;
				$narcolicence		= 	$row->narcolicence;
				$user_nrx = "no";
				if($narcolicence=="."){
					$user_nrx = "yes";
				}
				/*$user_cart 		 = $row->user_cart;
				$user_cart_total = $row->user_cart_total;*/
				$user_cart_total = sprintf('%0.2f',round($user_cart_total,2));
				$chemist_image = base_url().$this->appconfig->getWebJs()."/images/logo4.png";
				if(!empty($row->image))
				{
					$chemist_image = $this->user_profile_url.$row->image;
				}
				$count++;	
				
				$dt = array(
					'user_nrx' => $user_nrx,
					'chemist_altercode' => $chemist_altercode,
					'chemist_name' => $chemist_name,
					'chemist_image' => $chemist_image,
					'user_cart' => $user_cart,
					'user_cart_total' => $user_cart_total,
					'count' => $count,
				);
				$jsonArray[] = $dt;
			}
		}
		
		$return["items"] = $jsonArray;
		return $return;
	}

	public function salesman_my_cart_api($user_type="",$user_altercode="")
	{
		$jsonArray = array();

		$items = "";
		$salesman_id 	= $user_altercode;
		$query = $this->db->query("select distinct chemist_id from drd_temp_rec where selesman_id='$salesman_id' and user_type='$user_type' and status='0' order by chemist_id asc")->result();
		foreach($query as $row)
		{	
			$chemist_id = $row->chemist_id;
			$row1 = $this->db->query("select count(id) as user_cart,sum(quantity*sale_rate) as user_cart_total from drd_temp_rec where user_type='$user_type' and selesman_id='$salesman_id' and chemist_id='$chemist_id' and status=0")->row();
			$user_cart = $user_cart_total = 0;
			if($row1->user_cart!=0)
			{
				$user_cart = $row1->user_cart;
				$user_cart_total = $row1->user_cart_total;
			}
			$user_cart_total = sprintf('%0.2f',round($user_cart_total,2));
			
			$row1 = $this->db->query("select tbl_chemist.name,tbl_chemist.altercode,tbl_chemist_other.image,tbl_chemist.narcolicence from tbl_chemist left JOIN tbl_chemist_other on tbl_chemist.code=tbl_chemist_other.code where tbl_chemist.altercode='$chemist_id'")->row();
			$chemist_name  		= (ucwords(strtolower($row1->name)));		
			$chemist_altercode 	= $row1->altercode;
			$chemist_image = base_url().$this->appconfig->getWebJs()."/images/logo4.png";
			if(!empty($row1->image))
			{
				$chemist_image = $this->user_profile_url.$row1->image;
			}

			$narcolicence		= 	$row1->narcolicence;
			$user_nrx = "no";
			if($narcolicence=="."){
				$user_nrx = "yes";
			}

			$dt = array(
				'user_nrx' => $user_nrx,
				'chemist_altercode' => $chemist_altercode,
				'chemist_name' => $chemist_name,
				'chemist_image' => $chemist_image,
				'user_cart' => $user_cart,
				'user_cart_total' => $user_cart_total,
			);
			$jsonArray[] = $dt;
		}

		$return["items"] = $jsonArray;
		return $return;
	}
}
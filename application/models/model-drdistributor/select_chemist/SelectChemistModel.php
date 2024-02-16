<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SelectChemistModel extends CI_Model  
{
	public function __construct(){
		parent::__construct();
	}
	
	public function select_chemist_api($user_type="",$user_altercode="",$keyword="")
	{
		
		$jsonArray = array();

		$result = $this->db->query("select tbl_acm.name,tbl_acm.altercode,tbl_acm_other.image from tbl_acm left JOIN tbl_acm_other on tbl_acm.code=tbl_acm_other.code where (name like '".$keyword."%' or altercode='$keyword' or altercode like '%".$keyword."' or altercode like '".$keyword."%' or altercode like '%".$keyword."%') and slcd='CL' limit 50")->result();		
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
				/*$user_cart 		 = $row->user_cart;
				$user_cart_total = $row->user_cart_total;*/
				$user_cart_total = sprintf('%0.2f',round($user_cart_total,2));
				$chemist_image = base_url()."img_v51/logo.png";
				if(!empty($row->image))
				{
					$chemist_image = base_url()."user_profile/".$row->image;
				}
				$count++;	
				
				$dt = array(
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
}
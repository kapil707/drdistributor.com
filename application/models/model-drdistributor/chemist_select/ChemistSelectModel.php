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

		$this->db->select('
			tc.name,
			tc.altercode,
			tco.image,
			tc.narcolicence
		')
		->from('tbl_chemist tc')
		->join('tbl_chemist_other tco', 'tc.code = tco.code', 'left')
		->where('tc.slcd', 'CL')
		->group_start()
			->like('tc.name', $keyword, 'after')
			->or_where('tc.altercode', $keyword)
			->or_like('tc.altercode', $keyword, 'both')
		->group_end()
		->limit(50);
		$result = $this->db->get()->result();
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
				$chemist_image = base_url()."assets/".$this->appconfig->getWebJs()."/images/logo4.png";
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

	public function salesman_my_cart_api($UserType="",$SalesmanId="")
	{
		$jsonArray = array();

		$items = "";
		$this->db->select('
			tc.name,
			tc.narcolicence,
			tco.image,
			tcart.chemist_id,
			COUNT(tcart.id) as total_count,
			SUM(tcart.quantity * tcart.sale_rate) as total_amount
		')
		->from('tbl_cart tcart')
		->join('tbl_chemist tc', 'tc.altercode = tcart.chemist_id', 'left')
		->join('tbl_chemist_other tco', 'tc.code = tco.code', 'left')
		->where('tcart.salesman_id', 'sm1')
		->where('tcart.status', '0')
		->group_by('tcart.chemist_id, tc.name, tc.narcolicence, tco.image');

		$query = $this->db->get()->result();
		foreach($query as $row)
		{	
			$chemist_id = $row->chemist_id;
			$user_cart = $row->total_cart;
			$user_cart_total = $row->total_amount;
			$user_cart_total = sprintf('%0.2f',round($user_cart_total,2));

			$chemist_name  		= (ucwords(strtolower($row->name)));		
			$chemist_altercode 	= $chemist_id;
			$chemist_image = base_url()."assets/".$this->appconfig->getWebJs()."/images/logo4.png";
			if(!empty($row->image))
			{
				$chemist_image = $this->user_profile_url.$row->image;
			}

			$narcolicence		= 	$row->narcolicence;
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
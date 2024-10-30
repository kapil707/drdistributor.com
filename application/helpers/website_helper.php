<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('LoginCheck'))
{
	function LoginCheck($back_url=''){

		$ci =& get_instance();
		$ci->load->library('session');

		if(empty($ci->session->userdata('user_session'))){
			if(!empty($back_url)){
				redirect(base_url()."login?back_url=".$back_url);
			}else{
				redirect(base_url()."login");
			}
		} else {
			$user_type 		= $ci->session->userdata('user_type');
			$user_altercode = $ci->session->userdata('user_altercode');
			if($user_type=="sales" && empty($ci->session->userdata('chemist_id')))
			{
				redirect(base_url()."select_chemist");
			}
		}
	}
}
if ( ! function_exists('CreateUserLog'))
{
	function CreateUserLog(){
		$ci =& get_instance();
		$ci->load->library('session');
		if(!empty($ci->session->userdata('user_session'))){
			$user_type 		= $ci->session->userdata('user_type');
			$user_altercode = $ci->session->userdata('user_altercode');
			$chemist_id 	= $salesman_id = "";
			if($user_type=="sales" && !empty($ci->session->userdata('chemist_id')))
			{
				$chemist_id 	= $ci->session->userdata('chemist_id');
				$salesman_id 	= $user_altercode;
				$user_altercode = $chemist_id;
			}
			//logs create from hear
			log_activity($user_altercode,$salesman_id,$user_type,"web");
		}
	}
}
if ( ! function_exists('vp_seo'))
{
	function vp_seo(){

		$ci =& get_instance();
		$ci->load->database(); 

		$currentURL = current_url(); //http://myhost/main

		$params   = $_SERVER['QUERY_STRING']; //my_id=1,3

		if($params){
			$fullURL = $currentURL . '?' . $params; 
		}else{
			$fullURL = $currentURL;
		}
		$seo_author 		= $ci->Scheme_Model->get_website_data("seo_author");
		$seo_description 	= $ci->Scheme_Model->get_website_data("seo_description");
		$seo_keywords 		= $ci->Scheme_Model->get_website_data("seo_keywords");
		$seo_google 		= $ci->Scheme_Model->get_website_data("seo_google");
		//echo $fullURL;
	
		$row = $ci->db->query("select * from tbl_seo where url='$fullURL'")->row();
		if(!empty($row->id)){
			if(!empty($row->author)){
				$seo_author = $row->author;
			}
			if(!empty($row->description)){
				$seo_description = $row->description;
			}
			if(!empty($row->keywords)){
				$seo_keywords = $row->keywords;
			}
			if(!empty($row->seo_google)){
				$seo_google = $row->seo_google;
			}
		}
		?>
		<meta name="author" content="<?php echo $seo_author ?>">

		<meta name="description" content="<?php echo $seo_description ?>" />

		<meta name="keywords" content="<?php echo $seo_keywords ?>" />
		
		<?php echo $seo_google ?>
		<?php
	}
}
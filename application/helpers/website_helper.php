<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('LoginCheck'))
{
	function LoginCheck($back_url=''){

		$CI =& get_instance();
		$CI->load->library('session');
		$method = $CI->router->fetch_method();

		if(empty($CI->session->userdata('UserId'))){
			if(!empty($back_url)){
				redirect(base_url()."login?back_url=".$back_url);
			}else{
				redirect(base_url()."login");
			}
		} else {
			if($method!="select_chemist"){
				if($CI->session->userdata('UserType')=="sales" && empty($CI->session->userdata('ChemistId')))
				{
					redirect(base_url()."select_chemist");
				}
			}
		}
	}
}
if (!function_exists('CreateUserLog'))
{
	function CreateUserLog(){
		$CI =& get_instance();
		$CI->load->library('session');
		if(!empty($CI->session->userdata('UserType'))){
			$UserType 		= $CI->session->userdata('UserType');
			$ChemistId 		= $CI->session->userdata('ChemistId');
			$SalesmanId 	= $CI->session->userdata('SalesmanId');			
			//logs create from hear
			log_activity($ChemistId,$SalesmanId,$UserType,"web");
		}
	}
}
if ( ! function_exists('CreateSearcLog'))
{
	function CreateSearcLog($search_term='',$product_viewed=''){
		$CI =& get_instance();
		$CI->load->library('session');
		if(!empty($CI->session->userdata('UserType'))){
			$UserType 		= $CI->session->userdata('UserType');
			$ChemistId 		= $CI->session->userdata('ChemistId');
			$SalesmanId 	= $CI->session->userdata('SalesmanId');	
			//logs create from hear
			log_search_activity($ChemistId, $SalesmanId, $search_term, $product_viewed);
		}
	}
}
if ( ! function_exists('vp_seo'))
{
	function vp_seo(){

		$CI =& get_instance();
		$CI->load->database(); 

		$currentURL = current_url(); //http://myhost/main

		$params   = $_SERVER['QUERY_STRING']; //my_id=1,3

		if($params){
			$fullURL = $currentURL . '?' . $params; 
		}else{
			$fullURL = $currentURL;
		}
		$seo_author 		= $CI->Scheme_Model->get_website_data("seo_author");
		$seo_description 	= $CI->Scheme_Model->get_website_data("seo_description");
		$seo_keywords 		= $CI->Scheme_Model->get_website_data("seo_keywords");
		$seo_google 		= $CI->Scheme_Model->get_website_data("seo_google");
		//echo $fullURL;
	
		$row = $CI->db->query("select * from tbl_seo where url='$fullURL'")->row();
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
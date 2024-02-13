<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ChemistLoginModel extends CI_Model  
{
	public function __construct(){
		parent::__construct();
	}
    
    public function login_check()
	{
        if(empty($_COOKIE["user_altercode"])){
			redirect(base_url()."login");			
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
				redirect(constant('main_site')."home/select_chemist");
			}
		}	
	}
}
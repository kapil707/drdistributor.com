<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Chemist_login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("model-drdistributor/chemist_login/ChemistLoginModel");
	}

	public function chemist_login_api(){
		//error_reporting(0);
		$user_name1 = $_POST["user_name1"];
		$password1	= $_POST["password1"];
		$submit 	= "98c08565401579448aad7c64033dcb4081906dcb";
		header('Content-Type: application/json');
		$items = $this->ChemistLoginModel->chemist_login_api($user_name1,$password1);
		$someArray = json_decode($items, true);
		$user_return 	= "user_return";
		$user_session 	= "user_session";
		$user_fname 	= "user_fname";
		$user_code 		= "user_code";
		$user_altercode = "user_altercode";
		$user_type 		= "user_type";
		$user_password 	= "user_password";
		$user_division 	= "user_division";
		$user_compcode 	= "user_compcode";
		$user_image 	= "user_image";
		$user_nrx 		= "user_nrx";
		if($someArray[$user_return]=="1")
		{
			$ret = $this->Chemist_Model->insert_value_on_session($someArray[$user_session],$someArray[$user_fname],$someArray[$user_code],$someArray[$user_altercode],$someArray[$user_type],$someArray[$user_password],$someArray[$user_division],$someArray[$user_compcode],$someArray[$user_image],$someArray[$user_nrx]);
			$user_type 		= $someArray[$user_type];
			$user_altercode = $someArray[$user_altercode];
			$user_password	= $someArray[$user_password];	
			setcookie("chemist_id", "", time() + (86400 * 30), "/");
			$chemist_id  = "";
			$salesman_id = "";
			if($user_type=="sales")
			{
				$chemist_id     = $_COOKIE["chemist_id"];
				$salesman_id 	= $user_altercode;
				$user_altercode = $chemist_id;
			}
			$user_cart_total = $this->Chemist_Model->count_temp_rec($user_type,$user_altercode,$salesman_id);
			setcookie("user_cart_total", $user_cart_total, time() + (86400 * 30), "/");
		}
		else{
			$ret=1;
		}
		if($ret==1)
		{
?>
{"items":[<?= $items;?>]}<?php
		}
	}
}
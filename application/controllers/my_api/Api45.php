<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Api45 extends CI_Controller {		
	public function get_login_api()
	{
		$this->load->model("model-drdistributor/chemist_login/ChemistLoginModel");

		$api_key		= $_POST['api_key'];
		$user_name 		= $_POST['user_name'];
		$user_password 	= $_POST['user_password'];
		$firebase_token	= $_POST['firebase_token'];

		if(!empty($api_key) && !empty($user_name) && !empty($user_password))
		{
			$result = $this->ChemistLoginModel->chemist_login_api($user_name,$user_password,"");
			$items = $result["items"];
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo "[".json_encode($response)."]";
	}
}
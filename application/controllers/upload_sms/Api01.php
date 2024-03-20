<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Api01 extends CI_Controller {	

	public function upload_sms()
	{

		$sender		= $_POST['sender'];
		$message_body = $_POST["message_body"];

		$dt = array(
			'sender'=>$sender,
			'message_body'=>$message_body,
		);
		$this->Scheme_Model->insert_fun("tbl_upload_sms",$dt);

		$response = array(
            'success' => "1",
            'message' => 'Data add successfully',
			'sender' => $sender,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
}
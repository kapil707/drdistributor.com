<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ActivityModel extends CI_Model  
{
	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Method to insert log data into the database
    public function insert_log($data) {
        $this->db->insert('tbl_activity_logs', $data);
    }
	function activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser)
	{
		$date = date('Y-m-d');
		$time = date("H:i",time());
		$timestamp = time();
		$dt = array(
			'user_type'=>$user_type,
			'user_altercode'=>$user_altercode,
			'salesman_id'=>$salesman_id,
			'page_name'=>$page_name,
			'browser_type'=>$browser_type,
			'browser'=>$browser,
			'date'=>$date,
			'time'=>$time,
			'datetime'=>$timestamp,);
		//$this->Scheme_Model->insert_fun("tbl_user_activity_log",$dt);
	}

	function activity_new($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser)
	{

	}
}
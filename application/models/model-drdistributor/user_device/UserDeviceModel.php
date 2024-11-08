<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserDeviceModel extends CI_Model  
{ 
    public function __construct(){
		parent::__construct();
	}

	function insert_query($tbl,$dt) {

		if($this->db->insert($tbl,$dt))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

	function update_query($tbl,$dt,$where) {

		if($this->db->update($tbl,$dt,$where))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function insert_user_device($chemist_id,$salesman_id,$user_type,$firebase_token,$type) {

		$dt = array(
			'chemist_id'=>$chemist_id,
			'salesman_id'=>$salesman_id,
			'user_type'=>$user_type,
			'firebase_token'=>$firebase_token,
			'insert_type'=>$insert_type,
			'type'=>$type,
			'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
            'timestamp' => time(),
		);
		
		$this->db->select("id");
		$this->db->where('chemist_id',$chemist_id);
		$this->db->where('salesman_id',$salesman_id);
		$this->db->where('user_type',$user_type);
		$this->db->where('firebase_token',$firebase_token);
		$row = $this->db->get("tbl_user_device")->row();
		if(empty($row)) {
			$this->insert_query("tbl_user_device",$dt);
		}else{
			$where = array('chemist_id'=>$chemist_id,'salesman_id'=>$salesman_id,'user_type'=>$user_type);
			$this->update_query("tbl_user_device",$dt,$where);
		}
	}
}
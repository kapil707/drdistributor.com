<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email_Message_Model extends CI_Model
{
	public function send_email($email_new_type='')
	{
	    $time  = time();
		$mytime_min 	= date("i",$time);
		$mytime_ganta 	= date("H",$time);
	    
		//error_reporting(0);
		$this->db->limit(1);
		$this->db->where('status','0');
		if($email_new_type==1){
			$this->db->where('email_function','corporate_report');
		}else{
			$this->db->where('email_function!=','corporate_report');
		}
		$this->db->order_by('id','desc');
		$query = $this->db->get("tbl_email_send")->result();
		
		$this->load->library('phpmailer_lib');
		$email = $this->phpmailer_lib->load();
			
		foreach($query as $row)
		{
			/************************************************/
			$id 			= $row->id;
			$user_email_id 	= $row->user_email_id;
			$subject 		= ($row->subject);
			$message 		= ($row->message);
		    $email_function = $row->email_function;
			$file_name1 	= $row->file_name1;
			$file_name2 	= $row->file_name2;
			$file_name3 	= $row->file_name3;
			$file_name_1 	= $row->file_name_1;
			$file_name_2 	= $row->file_name_2;
			$file_name_3 	= $row->file_name_3;
			$mail_server 	= $row->mail_server;
			$email_other_bcc= $row->email_other_bcc;
			if($row->email_other_bcc=="")
			{
				$email_other_bcc="";
			}
			
			/************************************************/
			
			/************************************************/
			$this->db->where('email_function',$email_function);
			$row1 = $this->db->get("tbl_email")->row();
			
			$addreplyto 		= $row1->addreplyto;
			$addreplyto_name 	= $row1->addreplyto_name;
			$server_email 		= $row1->server_email;
			$server_email_name 	= $row1->server_email_name;
			$email1 			= $row1->email;
			$email_bcc 			= $row1->email_bcc;
			$live_or_demo 		= $row1->live_or_demo;
			
			$email->AddReplyTo($addreplyto,$addreplyto_name);
			$email->SetFrom($server_email,$server_email_name);
			/************************************************/
			
			/*if($mytime_min=="00" && $mytime_ganta%2==0){
			    $email_bcc = "kapildrd@gmail.com";
			}*/

			/*
			$email_cc = $this->check_email_cc($row1->id,$email1);
			if($email_cc!=""){
			    $email_bcc = $email_cc;
			}
			
			/************************************************/
			
			$email->Subject   	= $subject;
			$email->Body 		= $message;		
			if($live_or_demo=="Demo")
			{
				//$email->AddAddress($user_email_id);
				if(!empty($email1)) {
					$email->AddAddress($email1);
				}
				$email_bcc = explode (",",$email_bcc);
				foreach($email_bcc as $bcc)
				{
					$email->addBcc($bcc);
				}
				$email_other_bcc = explode (",",$email_other_bcc); 				
				foreach($email_other_bcc as $email_other_bcc_ok)
				{
					$email->addBcc($email_other_bcc_ok);
				}
			}
			else
			{
				$email->AddAddress($user_email_id);
				if(!empty($email1)) {
					$email->addBcc($email1);
				}
				$email_bcc = explode (",",$email_bcc);
				foreach($email_bcc as $bcc)
				{
					$email->addBcc($bcc);
				}
				$email_other_bcc = explode (",",$email_other_bcc); 				
				foreach($email_other_bcc as $email_other_bcc_ok)
				{
					$email->addBcc($email_other_bcc_ok);
				}
			}
			if($file_name1)
			{
				if($file_name_1)
				{
					$email->addAttachment($file_name1,$file_name_1);
				}
				else
				{
					$email->addAttachment($file_name1);
				}
			}
			if($file_name2)
			{
				if($file_name_2)
				{
					$email->addAttachment($file_name2,$file_name_2);
				}
				else
				{
					$email->addAttachment($file_name2);
				}
			}
			if($file_name3)
			{
				if($file_name_3)
				{
					$email->addAttachment($file_name3,$file_name_3);
				}
				else
				{
					$email->addAttachment($file_name3);
				}
			}
			
			/************************************************/
			//$this->db->query("delete from tbl_email_send where id='$id'");
			/************************************************/

			$this->db->query("update tbl_email_send set status='1' where id='$id'");
			
			$email->IsHTML(true);		
			if($email->Send()){
				echo "Mail Sent";
			}
			else{
				echo "Mail Failed";
			}
			if($file_name1)
			{
				unlink($file_name1);
			}
			if($file_name2)
			{
				unlink($file_name2);
			}
			if($file_name3)
			{
				unlink($file_name3);
			}
		}
	}
}
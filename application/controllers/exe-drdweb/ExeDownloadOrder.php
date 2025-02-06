<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ExeDownloadOrder extends CI_Controller
{
	public function __construct(){

		parent::__construct();
		// Load model
		$this->load->model("model-drdweb/WhatsAppModel");
	}

	public function download_order($order_id)
	{
		$jsonArray_lines = array();
		$jsonArray = array();

		$total_line = 0;
		$date = date("Y-m-d");
		$download_time = date("YmdHi");
		$result = $this->db->query("SELECT tbl_cart_order.*,tbl_chemist.code,tbl_chemist.slcd FROM tbl_cart_order LEFT JOIN tbl_chemist ON tbl_cart_order.chemist_id = tbl_chemist.altercode WHERE tbl_cart_order.id='$order_id' and download_time<='$download_time'")->result();
		// Process each row from the result set
		foreach ($result as $row) {

			// These values will represent the last processed row's details
			$order_id = $row->id;
			$user_type = $row->user_type;
			$chemist_id = $row->chemist_id;
			$salesman_id = $row->salesman_id;
			$remarks = $row->remarks;
			$date = $row->date;
			$time = $row->time;
			$total_line = (int)$row->items_total;

			$acno = $row->code;
			$slcd = $row->slcd;
			
			/************************************************************ */
			$result1 = $this->db->query("SELECT * from tbl_cart where order_id='$order_id'")->result();	
			foreach ($result1 as $row1) {		
				$dt = array(
					'online_id' => $row1->id,
					'i_code' => $row1->i_code,
					'item_code' => $row1->item_code,
					'quantity' => $row1->quantity,
					'sale_rate' => $row1->sale_rate,
				);
				$jsonArray_lines[] = $dt;
			}
			/************************************************************ */
		}

		// If result is not empty, proceed to fetch chemist details
		if (!empty($result)) {
			// Final order details
			$dt = array(
				'order_id' => $order_id,
				'chemist_id' => $chemist_id,
				'salesman_id' => $salesman_id,
				'user_type' => $user_type,
				'acno' => $acno,
				'slcd' => $slcd,
				'remarks' => $remarks,
				'date' => $date,
				'time' => $time,
				'total_line' => $total_line,
			);
			$jsonArray[] = $dt;

			// Prepare the response structure
			$response = array(
				'success' => "1",
				'message' => 'Data load successfully',
				'items' => $jsonArray,
				'items_other' => $jsonArray_lines,
			);
		} else {
			// If no result found, prepare an empty response
			$response = array(
				'success' => "0",
				'message' => 'No data found',
				'items' => "",
				'items_other' => "",
			);
		}
		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	public function update_order_gstvno($order_id,$gstvno,$insert_total_line,$download_total_line)
	{
		if(!empty($order_id) && !empty($gstvno))
		{
			$row = $this->db->query("SELECT items_total FROM `tbl_cart_order` WHERE `id`='$order_id'")->row();
			$total = $row->items_total;

			$this->db->query("update tbl_cart_order set gstvno='$gstvno',download_status=1,download_line='$insert_total_line' where id='$order_id'");
			/***************only for group message***********************/
			$group2_message = "Order No. $order_id download Line Items (Total:$total/Download:$download_total_line/Insert:$insert_total_line) - Easysol No. $gstvno inserted at : ".date("d-M-y H:i");
			$whatsapp_group2 = $this->Scheme_Model->get_website_data("whatsapp_group2");
			$this->WhatsAppModel->insert_whatsapp_group($whatsapp_group2,$group2_message);

			/***********************************************************/ 
			if($total!=$insert_total_line){
				$group1_message = "Order No. $order_id download Line Items (Total:$total/Download:$download_total_line/Insert:$insert_total_line) - Easysol No. $gstvno inserted at : ".date("d-M-y H:i");
				$whatsapp_group1 = $this->Scheme_Model->get_website_data("whatsapp_group1");
				$this->WhatsAppModel->insert_whatsapp_group($whatsapp_group1,$group1_message);
			}
			/*************************************************************/
		}
	}

	public function update_order_gstvno_error($order_id,$gstvno,$insert_total_line,$download_total_line)
	{
		if(!empty($order_id) && !empty($gstvno))
		{
			$row = $this->db->query("SELECT items_total FROM `tbl_cart_order` WHERE `id`='$order_id'")->row();
			$total = $row->items_total;

			$group1_message = $group2_message = "Problem Order No. $order_id (Total:$total/Download:$download_total_line/Insert:$insert_total_line) - at : ".date("d-M-y H:i");

			/******************************************************* */
			$whatsapp_group1 = $this->Scheme_Model->get_website_data("whatsapp_group1");
			$this->WhatsAppModel->insert_whatsapp_group($whatsapp_group1,$group1_message);
			
			/******************************************************* */
			$whatsapp_group2 = $this->Scheme_Model->get_website_data("whatsapp_group2");
			$this->WhatsAppModel->insert_whatsapp_group($whatsapp_group2,$group2_message);
		}
	}
}
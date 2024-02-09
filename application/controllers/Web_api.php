<?php
header('Content-Type: application/json');
defined('BASEPATH') OR exit('No direct script access allowed');
class Web_api extends CI_Controller {	
	public function __construct(){

		parent::__construct();

		// Load model
		
		$this->load->model("model-drdistributor/MedicineSearchModel");
		$this->load->model("model-drdistributor/MedicineTopSearchModel");
	}
	
	public function medicine_search_api()
	{
		$items = "[]";
		$keyword   			= $_REQUEST['keyword'];
		$total_rec   		= $_REQUEST['total_rec'];
		$checkbox_medicine 	= $_REQUEST['checkbox_medicine_val'];
		$checkbox_company	= $_REQUEST['checkbox_company_val'];
		$checkbox_out_of_stock= $_REQUEST['checkbox_out_of_stock_val'];
		$user_nrx  			= $_COOKIE["user_nrx"];
		if(!empty($keyword))
		{
			$items = $this->MedicineSearchModel->medicine_search_api($keyword,$user_nrx,$total_rec,$checkbox_medicine,$checkbox_company,$checkbox_out_of_stock);
		}
        
        $response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
	
	public function medicine_top_search_api()
	{
		$items = "[]";
		$session_yes_no   	= $_REQUEST['session_yes_no'];
		$category_id   		= $_REQUEST['category_id'];
		$user_type 			= $_REQUEST['user_type'];
		$user_altercode		= $_REQUEST['user_altercode'];
		$salesman_id		= $_REQUEST['salesman_id'];
		if(!empty($category_id))
		{
			$items = $this->MedicineTopSearchModel->medicine_top_search_api($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id);
		}
?>
{"items":<?= $items["items"];?>}<?php
	}
}
?>
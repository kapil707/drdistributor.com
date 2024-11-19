<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Import_order_api extends CI_Controller {

	var $UserId 		= "";
	var $UserType 		= "";
	var $UserFullName 	= "";
	var $UserPassword 	= "";
	var $UserImage 		= "";
	var $ChemistNrx 	= "";
	var $ChemistId 		= "";
	var $SalesmanId 	= "";
	var $FirebaseToken  = "";
	var $UserCart  		= "";
	
	var $MedicineImageUrl = "";
	public function __construct(){
		parent::__construct();
		// Load the AppConfig library
        $this->load->library('AppConfig');
		$this->load->library('session');

		/************login check************** */	
		LoginCheck("import_order");
		/************************************* */

		/************log file***************** */
		CreateUserLog();
		/************************************* */

		// Load model
		$this->load->model("model-drdistributor/import_order/ImportOrderModel");
		$this->load->model("model-drdistributor/my_cart/MyCartModel");

		/********************session start***************************** */
		$this->UserId		= $this->session->userdata('UserId');
		$this->UserType    	= $this->session->userdata('UserType');
		$this->UserFullName = $this->session->userdata('UserFullName');
		$this->UserPassword	= $this->session->userdata('UserPassword');
		$this->UserImage 	= $this->session->userdata('UserImage');
		$this->ChemistNrx	= $this->session->userdata('ChemistNrx');
		$this->ChemistId	= $this->session->userdata('ChemistId');
		$this->SalesmanId	= $this->session->userdata('SalesmanId');
		$this->FirebaseToken= $this->session->userdata('FirebaseToken');
		$this->UserCart		= $this->session->userdata('UserCart');
		/********************************************************** */

		$this->MedicineImageUrl = $this->appconfig->getMedicineImageUrl();
	}

	public function upload_import_file_api(){
		
		error_reporting(0);

		$UserType	= $this->UserType;
		$ChemistId	= $this->ChemistId;
		$SalesmanId	= $this->SalesmanId;

		$headername	= strtoupper($_POST['headername']);
		$itemname 	= strtoupper($_POST['itemname']);
		
		$itemqty 	= strtoupper($_POST['itemqty']);
		$itemqty    = str_replace(",","",$itemqty);
		$itemqty    = str_replace(".","",$itemqty);
		$itemmrp 	= strtoupper($_POST['itemmrp']);
		$itemmrp    = str_replace(",","",$itemmrp);
		$itemmrp    = str_replace(".","",$itemmrp);
		
		$date = date('Y-m-d');
		$time = date("H:i",time());
		
		$where = array('user_altercode'=>$ChemistId);
		$row = $this->Scheme_Model->select_row("drd_excel_file",$where);
		if(empty($row->id))
		{
			$this->db->query("insert into drd_excel_file set headername='$headername',itemname='$itemname',itemqty='$itemqty',itemmrp='$itemmrp',user_altercode='$ChemistId'");
		}
		else
		{
			$this->db->query("update drd_excel_file set headername='$headername',itemname='$itemname',itemqty='$itemqty',itemmrp='$itemmrp' where user_altercode='$ChemistId'");
		}
		
		$filename = time().$_FILES['file']['name'];
		$uploadedfile = $_FILES['file']['tmp_name'];
		$upload_path = "./temp_files/";
		if(move_uploaded_file($uploadedfile, $upload_path.$filename))
		{
			/*****************************/
			$row = $this->db->query("select order_id from drd_import_file order by id desc limit 1")->row();
			$order_id = 1;
			if(!empty($row->order_id))
			{
				$order_id = $row->order_id + 1;
			}
			/*****************************/
			
			$excelFile = $upload_path.$filename;
			if(file_exists($excelFile))
			{
				$this->load->library('excel');
				$objPHPExcel = PHPExcel_IOFactory::load($excelFile);
				foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					for ($row=$headername; $row<=$highestRow; $row++)
					{
						$item_name 	= $worksheet->getCell($itemname.$row)->getValue();
						if($item_name!="")
						{
							$quantity 	= $worksheet->getCell($itemqty.$row)->getValue();
							$mrp 		= $worksheet->getCell($itemmrp.$row)->getValue();
							
							if($quantity=="")
                            {
                              	$quantity = 1;
                            }
							if($quantity==0)
                            {
                              	$quantity = 1;
                            }
							$quantity = intval($quantity);
							if($quantity>=1000)
							{
								$quantity = 1000;
							}
                          
                          	if($mrp=="")
                            {
                              	$mrp = "";
                            }
							
							$dt = array(
								'item_name'=>$item_name,
								'quantity'=>$quantity,
								'mrp'=>$mrp,
								'order_id'=>$order_id,
								'user_type'=>$UserType,
								'user_altercode'=>$ChemistId,
								'salesman_id'=>$SalesmanId,
								'date'=>$date,
								'time'=>$time,
							);
							$this->Scheme_Model->insert_fun("drd_import_file",$dt);
						}
					}
				}
				unlink($excelFile);
			}
			$order_id  = base64_encode($order_id);
			$url = base_url()."io/p/$order_id";
		}
		else{
			$url = base_url()."io";
		}

		$jsonArray = array();
		$dt = array(
			'url'=>$url,
		);
		$jsonArray[] = $dt;
		$items = $jsonArray;

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function medicine_suggest_api(){
		$ChemistId	= $this->ChemistId;

		$jsonArray = $this->ImportOrderModel->get_import_order_suggest($this->ChemistId);

		$items = $jsonArray;

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
        );
		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function delete_suggest_by_id_api()
	{
		$id = ($_REQUEST["id"]);
		if(!empty($id)){
			$this->ImportOrderModel->delete_suggest_by_id_api($id);
		}
		
		$response = array(
            'success' => "1",
            'message' => 'Data delete successfully'
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function order_check_api(){
		$order_id = $_POST["order_id"];
		$order_id = base64_decode($order_id);
		$jsonArray = $this->ImportOrderModel->order_check($order_id);
		if (!empty($jsonArray)) {
			$items = "yes";
		}else{
			$items = "no";
		}
		
		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items' => $items,
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
	
	function clean($string) {
		$string = str_replace('(', '', $string);
		$string = str_replace(')', '', $string);
		$string = str_replace('*', '', $string);
		$string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
		$string = str_replace('-', '', $string); // Replaces all spaces with hyphens.
		return preg_replace('/[^A-Za-z0-9\#]/', '', $string); // Removes special chars.
	}
	
	function clean1($string) {
		$string = str_replace('"', "'", $string);
		$string = str_replace('\'', '', $string);
		return $string;
	}
	
	function clean2($string) {
		// remove 29-11-19 check kiya ha no need for search panel
		/*$string = str_replace('-', ' ', $string);
		$string = str_replace('(', ' ', $string);
		$string = str_replace(')', ' ', $string);
		$string = str_replace('*', ' ', $string);// Replaces all spaces with hyphens.*/
		return $string; // Removes 
		return preg_replace('/[^A-Za-z0-9\#]/', ' ', $string); // Removes special chars.
	}
	
	function clean3($string) {
		$string = str_replace('-', ' ', $string);
		$string = str_replace('(', ' ', $string);
		$string = str_replace(')', ' ', $string);
		$string = str_replace('*', ' ', $string);
		return preg_replace('/[^A-Za-z0-9\#]/', ' ', $string);
	}
	
	function highlightWords($string, $search){
		$string = strtoupper($this->clean2($string));
		$search = strtoupper($search);
		$myArray = explode(' ', $search);
		foreach($myArray as $raman)
		{
			if (strpos($string, $raman) !== false) 
			{
				$string = str_replace($raman,"<b>".$raman."</b>",$string);
			}
		}
		return $string;
	}

	public function process_main_api(){

		$order_id = $_POST["order_id"];
		$order_id = base64_decode($order_id);

		$jsonArray = $this->ImportOrderModel->process_main($order_id);

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items'=> $jsonArray,
			'ChemistId'=>$this->ChemistId
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}
	
	public function process_find_medicine_api() {	

		$order_id = $_POST["order_id"];
		$order_id = base64_decode($order_id);

		$row = $this->ImportOrderModel->process_main2($order_id);
		if(!empty($row)){
			$ItemId	= $row->id;
			
			$UserType 		= $this->UserType;
			$ChemistId 		= $this->ChemistId;
			$SalesmanId		= $this->SalesmanId;
			$ChemistNrx		= $this->ChemistNrx;

			$return_value = $this->ImportOrderModel->process_find_medicine_api($UserType,$ChemistId,$SalesmanId,$ChemistNrx,$ItemId);
			
			$row = $return_value["row"];
			$type_ = $return_value["type_"];
			$suggest = $return_value["suggest"];
			$order_quantity = $return_value["order_quantity"];
			$item_suggest_altercode = $return_value["item_suggest_altercode"];
			/******************************************/		
			$item_code = $item_image = $item_name = $item_packing = $item_stock = $item_scheme = $item_company = $item_batch_no = $item_expiry = $item_message = $item_background = "";
			$item_quantity = $item_mrp = $item_ptr = $item_price = $item_margin = $item_featured = 0;
			$item_image = base_url()."uploads/default_img.webp";
			if(!empty($row)) {

				$item_code			=	$row->i_code;
				$item_name			=	ucwords(strtolower($row->item_name));
				$item_packing		=	$row->packing;
				$item_scheme		=	$row->salescm1."+".$row->salescm2;
				$item_company		=  	ucwords(strtolower($row->company_name));
				$item_quantity		=	$row->batchqty;
				$item_mrp			=	sprintf('%0.2f',round($row->mrp,2));
				$item_ptr			=	sprintf('%0.2f',round($row->sale_rate,2));
				$item_price			=	sprintf('%0.2f',round($row->final_price,2));
				$item_margin 		=   round($row->margin);
				$item_featured 		= 	$row->featured;

				$misc_settings =	$row->misc_settings;
				$item_stock = "";
				if($misc_settings=="#NRX" && $item_quantity>=10){
					$item_stock = "Available";
				}
				
				$item_image = base_url()."uploads/default_img.webp";
				if(!empty($row->image1))
				{
					$item_image = $this->MedicineImageUrl.$row->image1;
				}

				$item_batch_no = $row->batch_no;
				$item_expiry =	$row->expiry;
				
				/******************************************/
				if($row->batchqty!=0  && is_numeric($order_quantity)){
					$item_code 		= $row->i_code;
					$order_type 	= "import_order";
					$mobilenumber 	= "";
					$modalnumber 	= "PC - Import Order";
					$device_id    	= "";				
					$this->MyCartModel->medicine_add_to_cart_api($UserType,$ChemistId,$SalesmanId,$item_code,$order_quantity,$order_type,$ItemId,$mobilenumber,$modalnumber,$device_id);
				}
				/******************************************/
			}

			if($type_==1){
				$item_message = "Find medicine (By DRD server) |";
				$item_background = "#13ffb33b";
			}

			if($type_==0){
				$item_message = "Find medicine but difference name or mrp. (By DRD server) | ";
				$item_background = "#1713ff2e";
			}
			
			if(empty($item_name)){
				$item_message = "<span style=color:red>(Not found any medicine)</span> | ";
				$item_background = "#ffe494";
			}		
			
			if($item_quantity==0){
				$item_message.= "<span style=color:red>Out of stock</span> | ";
				$item_background = "#ffe494";
			}
			
			$item_suggest_delete = 0;
			if($suggest==1){
				$item_message = "Related results found (Suggest set by $item_suggest_altercode) | ";
				$item_background = "#97dcd6";
				if($item_suggest_altercode==$ChemistId){
					$item_suggest_delete = 1;
				}
				
				if($item_quantity==0){
					$item_message.= " <span style=color:red>Out of stock</span> | ";
					$item_background = "#ffe494";
				}
			}

			$dt = array(
				'item_id' => $ItemId,
				'item_message'=>$item_message,
				'item_background'=>$item_background,
				'item_suggest_delete'=>$item_suggest_delete,

				'item_code' => $item_code,
				'item_image' => $item_image,
				'item_name' => $item_name,
				'item_packing' => $item_packing,
				'item_scheme' => $item_scheme,
				'item_company' => $item_company,
				'item_quantity' => $item_quantity,
				'item_stock' => $item_stock,
				'item_ptr' => $item_ptr,
				'item_mrp' => $item_mrp,
				'item_price' => $item_price,
				'item_margin' => $item_margin,
				'item_featured' => $item_featured,
				
				'item_batch_no' => $item_batch_no,
				'item_expiry' => $item_expiry,
			);
			$jsonArray[] = $dt;
		}else{
			$jsonArray = "";
		}

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items'=> $jsonArray
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	public function import_order_row_delete_api() {

		$ItemId		= ($_POST["item_id"]);
		$ItemCode 	= ($_POST["item_code"]);

		$UserType 	= $this->UserType;
		$ChemistId 	= $this->ChemistId;
		$SalesmanId = $this->SalesmanId; 

		$status = 0;
		if(!empty($ItemId)){
			$status = $this->ImportOrderModel->import_order_row_delete($UserType,$ChemistId,$SalesmanId,$ItemId,$ItemCode);
		}

		$jsonArray = array();
		$dt = array(
			'status'=>$status,
		);
		$jsonArray[] = $dt;
		$items = $jsonArray;

		$response = array(
			'success' => "1",
			'message' => 'Data delete successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	public function import_order_row_quantity_change_api() {

		$ItemId 		= $_POST["item_id"];
		$ItemQuantity	= $_POST["quantity"];

		$UserType 	= $this->UserType;
		$ChemistId 	= $this->ChemistId;
		$SalesmanId = $this->SalesmanId;
		
		$status = 0;
		if(!empty($ItemId) && !empty($ItemQuantity)){
			if($ItemQuantity>=1000){
				$ItemQuantity = 1000;
			}

			$status = $this->ImportOrderModel->import_order_row_quantity_change($UserType,$ChemistId,$SalesmanId,$ItemId,$ItemQuantity);
		}

		$jsonArray = array();
		$dt = array(
			'status'=>$status,
		);
		$jsonArray[] = $dt;
		$items = $jsonArray;

		$response = array(
			'success' => "1",
			'message' => 'Data change successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function expiry_check($expiry)
	{
		$dt = date("y.m.d");
		$time = strtotime($dt);
		$y = date("ym", strtotime("+6 month", $time));
		$expiry1 = substr($expiry,0,2);
		$expiry2 = substr($expiry,3,5);
		$x = $expiry2.$expiry1;
		if($y<=$x)
		{
			$r = 0;
		}
		else
		{
			$r = 1;
		}
		return $r;
	}
	
	public function import_order_medicine_change_api() {

		$ItemId				= ($_POST["item_id"]);
		$ItemCode 			= ($_POST["item_code"]);
		$SelectedItemCode	= ($_POST["selected_item_code"]);

		$UserType 	= $this->UserType;
		$ChemistId 	= $this->ChemistId;
		$SalesmanId = $this->SalesmanId; 

		$status = 0;
		if(!empty($ItemCode) && !empty($ItemId)){
			$status = $this->ImportOrderModel->import_order_medicine_change($UserType,$ChemistId,$SalesmanId,$ItemId,$ItemCode,$SelectedItemCode);
		}

		$jsonArray = array();
		$dt = array(
			'status'=>$status,
		);
		$jsonArray[] = $dt;
		$items = $jsonArray;

		$response = array(
			'success' => "1",
			'message' => 'Data change successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	public function import_order_medicine_delete_suggested_api() {

		$ItemId 	= ($_REQUEST["item_id"]);

		$UserType 	= $this->UserType;
		$ChemistId 	= $this->ChemistId;
		$SalesmanId = $this->SalesmanId;

		$status = $this->ImportOrderModel->import_order_medicine_delete_suggested($UserType,$ChemistId,$SalesmanId,$ItemId);

		$jsonArray = array();
		$dt = array(
			'status'=>$status,
		);
		$jsonArray[] = $dt;
		$items = $jsonArray;

		$response = array(
			'success' => "1",
			'message' => 'Data delete successfully',
			'items' => $items,
		);

		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}
}
?>
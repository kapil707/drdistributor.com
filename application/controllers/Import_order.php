<?php
/*ini_set('memory_limit','-1');
ini_set('post_max_size','100M');
ini_set('upload_max_filesize','100M');
ini_set('max_execution_time',36000);*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Import_order extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Load model
		$this->load->model("model-drdistributor/account_model/AccountModel");
        $this->AccountModel->login_check("import_order");

		$this->load->model("model-drdistributor/my_cart/MyCartModel");
	}
	
	public function index()
	{
		$data["main_page_title"] = "Upload order";

		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["session_delivering_to"]  = $_COOKIE['user_altercode'];		
		
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$data["chemist_id"] = $chemist_id;
		if($user_type=="sales")
		{
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}

		/********************************************************** */
		$page_name = "import_order";
		$browser_type = "Web";
		$browser = "";

		$this->load->model("model-drdistributor/activity_model/ActivityModel");
		$this->ActivityModel->activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */
		
		$where = array('user_altercode'=>$user_altercode);
		$row = $this->Scheme_Model->select_row("drd_excel_file",$where);
		$data["headername"] = $data["itemname"] = $data["itemqty"] = $data["itemmrp"] 	= "";
		if(!empty($row->headername))
		{
			$data["headername"] = $row->headername;
			$data["itemname"] 	= $row->itemname;
			$data["itemqty"] 	= $row->itemqty;
			$data["itemmrp"] 	= $row->itemmrp;
		}
		
		$this->load->view('header_footer/header', $data);
		$this->load->view('import_order/index', $data);
		$this->load->view('header_footer/footer', $data);
	}
	
	public function medicine_suggest(){

		$data["main_page_title"] = "Suggest medicine";
		
		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["session_delivering_to"]  = $_COOKIE['user_altercode'];		
		
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$data["chemist_id"] = $chemist_id;
		if($user_type=="sales")
		{
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}

		/********************************************************** */
		$page_name = "import_order_medicine_suggest";
		$browser_type = "Web";
		$browser = "";

		$this->load->model("model-drdistributor/activity_model/ActivityModel");
		$this->ActivityModel->activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */
		
		$where = array('user_altercode'=>$user_altercode);
		$result = $this->Scheme_Model->select_all_result("drd_import_orders_suggest",$where,"your_item_name","asc");
		$data["result"] = $result;

		$this->load->view('header_footer/header',$data);
		$this->load->view('import_order/medicine_suggest', $data);
		$this->load->view('header_footer/footer', $data);
	}
	
	public function medicine_search($order_id=''){
		
		$data["main_page_title"] = "Import order";
		
		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["session_delivering_to"]  = $_COOKIE['user_altercode'];		
		
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$data["chemist_id"] = $chemist_id;
		if($user_type=="sales")
		{
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}

		/********************************************************** */
		$page_name = "import_order";
		$browser_type = "Web";
		$browser = "";

		$this->load->model("model-drdistributor/activity_model/ActivityModel");
		$this->ActivityModel->activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */

		$data["order_id"]	= $order_id = base64_decode($order_id);
		$data["myname"] 	= $user_altercode;
		$where = array('order_id'=>$order_id,'status'=>'0');
		$result = $this->Scheme_Model->select_all_result("drd_import_file",$where,"id","asc");
		$data["result"] 	= $result;
		if(empty($result))
		{
			redirect(base_url()."import_order");
		}
		$data["import_order_page"] = "yes";

		$this->load->view('header_footer/header', $data);
		$this->load->view('import_order/medicine_search', $data);
		$this->load->view('header_footer/footer', $data);
	}
	
	public function medicine_deleted_items($order_id=''){
		
		$data["main_page_title"] = "Deleted items";
		
		$data["session_user_image"] 	= $_COOKIE['user_image'];
		$data["session_user_fname"]     = $_COOKIE['user_fname'];
		$data["session_user_altercode"] = $_COOKIE['user_altercode'];
		$data["session_delivering_to"]  = $_COOKIE['user_altercode'];		
		
		$user_type 		= $_COOKIE["user_type"];
		$user_altercode = $_COOKIE["user_altercode"];
		$user_password	= $_COOKIE["user_password"];

		$chemist_id = $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE["chemist_id"];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}
		$data["chemist_id"] = $chemist_id;
		if($user_type=="sales")
		{
			$data["session_delivering_to"] = $chemist_id." | <a href='".base_url()."select_chemist' class='all_chemist_edit_btn'> <i class='fa fa-pencil all_chemist_edit_btn' aria-hidden='true'></i> Edit chemist</a>";
		}

		/********************************************************** */
		$page_name = "import_order_deleted_items";
		$browser_type = "Web";
		$browser = "";

		$this->load->model("model-drdistributor/activity_model/ActivityModel");
		$this->ActivityModel->activity_log($user_type,$user_altercode,$salesman_id,$page_name,$browser_type,$browser);
		/********************************************************** */

		$data["order_id"]	= $order_id = base64_decode($order_id);
		if($user_type=="chemist")
		{
			$users = $this->db->query("select * from tbl_chemist where altercode='$chemist_id' ")->row();
			$acm_altercode 	= $users->altercode;
			$acm_name		= $users->name;
			$acm_email 		= $users->email;
			$acm_mobile 	= $users->mobile;			
			
			$chemist_excle 	= "$acm_name ($acm_altercode)";
			$file_name 		= $acm_altercode;
		}
		if($user_type=="sales")
		{
			//jab sale man say login hota ha to
			$users = $this->db->query("select * from tbl_chemist where altercode='$user_altercode' ")->row();
			$user_session	= $users->id;
			$acm_altercode 	= $users->altercode;
			$acm_name 		= $users->name;
			$acm_email 		= $users->email;
			$acm_mobile 	= $users->mobile;
			$users = $this->db->query("select * from tbl_users where customer_code='$salesman_id' ")->row();
			$salesman_name 		= $users->firstname." ".$users->lastname;
			$salesman_mobile	= $users->cust_mobile;
			$salesman_altercode	= $users->customer_code;
			
			$chemist_excle 	= $acm_name." ($acm_altercode)";
			$file_name 		= $acm_altercode;
		}
		/***********************************************/
		$result = $this->db->query("select * from drd_import_file where order_id='$order_id' and status=0")->result();
		$data["result"]	= $result;
		if(empty($result))
		{
			redirect(base_url()."my_cart");
		}
		
		$dt = $dt1 = $dt2 = "";
		$i = 0;
		foreach($result as $row)
		{
			$i++;
			$item_name = $row->item_name;
			$mrp = $row->mrp;
			$quantity = $row->quantity;
			
			$dt1 = "<br><table border='1' width='100%'><tr><td>Sno</td><td>Deleted Item Name</td><td>Deleted Item Mrp.</td><td>Deleted Item Quantity</td></tr>";
			$dt.= "<tr><td>".$i."</td><td>".$item_name."</td><td>".$mrp."</td><td>".$quantity."</td></tr>";
			$dt2.= "</table>";
		}
		
		$message = $dt1.$dt.$dt2;
		$subject   = "Import order delete items from D.R. Distributors Pvt. Ltd.";
		
		$user_email_id = $acm_email;
		if (filter_var($user_email_id, FILTER_VALIDATE_EMAIL)) {
		
		}
		else{
			$err = $user_email_id." is Wrong Email";
			$mobile = "";
			$this->Message_Model->tbl_whatsapp_email_fail($mobile,$err,$acm_altercode);
			
			$user_email_id="";
		}
		
		if($user_email_id!="")
		{
			$file_name_1 = "Import-Order-Deleted-Items-Report.xls";
			$file_name1  = $this->import_orders_delete_items($result);
			
			$subject = ($subject);
			$message = ($message);
			$email_function = "import_orders_delete_items";
			$mail_server = "";
			$date = date('Y-m-d');
			$time = date("H:i",time());
			
			$dt = array(
			'user_email_id'=>$user_email_id,
			'subject'=>$subject,
			'message'=>$message,
			'email_function'=>$email_function,
			'file_name1'=>$file_name1,
			'file_name_1'=>$file_name_1,
			'mail_server'=>$mail_server,
			'date'=>$date,
			'time'=>$time,
			);
			$this->Scheme_Model->insert_fun("tbl_email_send",$dt);				
		}
		
		$this->load->view('header_footer/header', $data);
		$this->load->view('import_order/medicine_deleted_items', $data);
		$this->load->view('header_footer/footer', $data);
	}
	
	public function import_orders_delete_items($query)
	{
		error_reporting(0);

		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		
		ob_clean();		
		date_default_timezone_set('Asia/Calcutta');
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1', 'Sno')
		->setCellValue('B1', 'Item Name')
		->setCellValue('C1', 'Item Mrp.')
		->setCellValue('D1', 'Item Quantity');		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);	
		$i = 0;
		$rowCount = 2;
		foreach($query as $row)
		{
			$i++;			
			$item_name = $row->item_name;
			$mrp = $row->mrp;
			$quantity = $row->quantity;
			
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$i);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$item_name);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$mrp);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$quantity);
			$rowCount++;
		}
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$file_name = "temp_files/import_orders_delete_items_".time().".xls";
		$objWriter->save($file_name);
		return $file_name;
	}
	
	public function downloadfile($order_id='')
	{	
		$order_id = base64_decode($order_id);
		$result = $this->db->query("select * from drd_import_file where order_id='$order_id' and status=0")->result();
		
		$delimiter = ",";
		$filename = "download.csv";
		$i = 0;
		$f = fopen('php://memory', 'w');
		$fields = array('ID', 'Name','Mrp', 'Qty');
		fputcsv($f, $fields, $delimiter);
		foreach($result as $row)
		{
			$i++;
			$lineData = array($i, $row->item_name,$row->mrp,$row->quantity);
			fputcsv($f, $lineData, $delimiter);
		}
		fseek($f, 0);
		
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '";');
		
		fpassthru($f);
		exit;
	}
	
	public function import_order_downloadall($order_id='')
	{	
		
		$result = $this->db->query("select * from drd_import_file where order_id='$order_id' and status='0'")->result();
		
		$delimiter = ",";
		$filename = "download.csv";
		$i = 0;
		$f = fopen('php://memory', 'w');
		$fields = array('ID', 'Name', 'Qty');
		fputcsv($f, $fields, $delimiter);
		foreach($result as $row)
		{
			$i++;
			$lineData = array($i, $row->item_name, $row->quantity);
			fputcsv($f, $lineData, $delimiter);
		}
		fseek($f, 0);
		
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '";');
		
		fpassthru($f);
		exit;
	}
	
	/*******************api start*********************/	
	public function upload_import_file(){
		
		error_reporting(0);

		$user_type		= $_COOKIE['user_type'];
		$user_altercode	= $_COOKIE['user_altercode'];
		$user_password	= $_COOKIE['user_password'];
		$chemist_id		= "";
		$salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id		= $_COOKIE['chemist_id'];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}

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
		
		$where = array('user_altercode'=>$user_altercode);
		$row = $this->Scheme_Model->select_row("drd_excel_file",$where);
		if(empty($row->id))
		{
			$this->db->query("insert into drd_excel_file set headername='$headername',itemname='$itemname',itemqty='$itemqty',itemmrp='$itemmrp',user_altercode='$user_altercode'");
		}
		else
		{
			$this->db->query("update drd_excel_file set headername='$headername',itemname='$itemname',itemqty='$itemqty',itemmrp='$itemmrp' where user_altercode='$user_altercode'");
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
								'user_type'=>$user_type,
								'user_altercode'=>$user_altercode,
								'salesman_id'=>$salesman_id,
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
			$url = base_url()."import_order/medicine_search/$order_id";
		}
		else{
			$url = base_url()."import_order";
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
	
	public function get_temp_rec($chemist_id)
	{
		$user_altercode = $_COOKIE['user_altercode'];
		$user_type 		= $_COOKIE['user_type'];
		if($user_type=="sales")
		{
			$temp_rec = $user_type."_".$user_altercode."_".$chemist_id;
		}
		else
		{
			$temp_rec = $user_type."_".$user_altercode;
		}
		return $temp_rec;
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
	
	public function import_order_medicine_details_api() {	

		$excel_number	= $_POST["myid"];
		
		$user_type 		= $_COOKIE['user_type'];
		$user_altercode = $_COOKIE['user_altercode'];
		$user_password	= $_COOKIE['user_password'];
		$user_nrx		= $_COOKIE['user_nrx'];
		
		$chemist_id 	= $salesman_id = "";
		if($user_type=="sales")
		{
			$chemist_id 	= $_COOKIE['chemist_id'];
			$salesman_id 	= $user_altercode;
			$user_altercode = $chemist_id;
		}

		/******************************************/
		
		$row = $this->db->query("select * from drd_import_file where id='$excel_number'")->row();
		$order_id			= $row->order_id;
		$order_quantity		= $row->quantity;
		$item_mrp 			= $row->mrp;
		$order_item_name	= $this->clean1($row->item_name);
		
		/******************************************/
		$suggest_i_code = $item_suggest_altercode = "";
		$suggest = 0;
		$row_s = $this->db->query("select * from drd_import_orders_suggest where your_item_name='$order_item_name' order by id desc")->row();
		if(!empty($row_s->id)) {
			$suggest = 1;
			$order_item_name	= $row_s->item_name;
			$suggest_i_code 	= $row_s->i_code;
			$item_suggest_altercode 	= $row_s->user_altercode;
		}
		$type_ = 1;
		if(!empty($suggest_i_code))
		{
			$type_ = "1";
			$i_code = $suggest_i_code;
			$where = array('i_code'=>$i_code);
		}
		else{			
			/******************************************/
			$items=$this->Chemist_Model->import_order_dropdownbox($order_item_name,$item_mrp);
			/*****************************************/		
			$type_ = $items["type"];
			$i_code = $items["i_code"];
			$where = array('i_code'=>$i_code);
		}
		
		/*****************************************/
		$this->db->select("*");
		$this->db->where($where);

		$where = "status=1 and `misc_settings` NOT LIKE '%gift%' and category!='g'";
		$this->db->where($where);
		
		if($user_nrx=="yes"){
		}else{
			$where="misc_settings!='#NRX'";
			$this->db->where($where);
		}
		$this->db->limit(1);
		$this->db->order_by('item_name','asc');
		$row = $this->db->get("tbl_medicine")->row();
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
				$item_image = constant('img_url_site').$row->image1;
			}

			$item_batch_no = $row->batch_no;
			$item_expiry =	$row->expiry;
			
			/******************************************/
			if($row->batchqty!=0  && is_numeric($order_quantity)){
				$item_code = $row->i_code;
				$this->medicine_add_to_cart_api($item_code,$order_quantity,$excel_number,$order_id,$user_type,$user_altercode,$salesman_id);				
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
		
		if($suggest==1){
			$item_message = "Related results found (Suggest set by $item_suggest_altercode) | ";
			$item_background = "#97dcd6";
			
			if($item_quantity==0){
				$item_message.= " <span style=color:red>Out of stock</span> | ";
				$item_background = "#ffe494";
			}
		}

		$dt = array(
			'excel_number' => $excel_number,
			'item_message'=>$item_message,
			'item_background'=>$item_background,
			'item_suggest_altercode'=>$item_suggest_altercode,			

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

		$response = array(
            'success' => "1",
            'message' => 'Data load successfully',
            'items'=> $jsonArray
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
	
	public function medicine_add_to_cart_api($item_code,$item_order_quantity,$excel_number,$order_id,$user_type,$user_altercode,$salesman_id)
	{		
		$status = 0;
		$order_type 	= "excelFile";
		$mobilenumber 	= "";
		$modalnumber 	= "PC - Import Order";
		$device_id    	= "";
		if($item_code!="")
		{
			$result = $this->MyCartModel->medicine_add_to_cart_api($user_type,$user_altercode,$salesman_id,$order_type,$item_code,$item_order_quantity,$mobilenumber,$modalnumber,$device_id,$excel_number);
			$status = $result["status"];
			$this->db->query("update drd_import_file set status='1' where id='$excel_number' and order_id='$order_id'");
		}
		return $status;
	}
	
	public function import_oreder_medicine_quantity_change_api() {
		$myid 		= $_POST["myid"];
		$import_order_quantity	= $_POST["import_order_quantity"];
		
		$status = 0;
		if(!empty($import_order_quantity)){
			if($import_order_quantity>=1000){
				$import_order_quantity = 1000;
			}
			$status = $this->db->query("update drd_import_file set quantity='$import_order_quantity' where id='$myid'");
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
	
	public function import_oreder_medicine_delete_api() {
		$status = 0;
		$myid	= $_POST["myid"];
		if(!empty($myid))
		{
			$this->db->query("update drd_import_file set status=0 where id='$myid'");
			$this->db->query("delete from drd_temp_rec where excel_number='$myid'");
			$status = 1;
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
	
	/*21-01-2020*/
	public function import_order_medicine_change_api(){

		$item_code		= ($_POST["item_code"]);	
		$myid			= ($_POST["myid"]);
		$status = 0;
		if(!empty($item_code) && !empty($myid)){
			$row = $this->db->query("select item_name from tbl_medicine where i_code='$item_code'")->row();
			$item_name = $row->item_name;
			$row1 = $this->db->query("select item_name from drd_import_file where id='$myid'")->row();
			$your_item_name = $row1->item_name;
			$this->db->query("delete from drd_temp_rec where excel_number='$myid'");
			
			$this->db->query("delete from drd_import_orders_suggest where your_item_name='$your_item_name'");
			$user_altercode	= $_COOKIE["user_altercode"];
			$date = date('Y-m-d');
			$time = time();
			$datetime = date("d-M-y H:i",$time);
			
			$status = $this->db->query("insert into drd_import_orders_suggest set your_item_name='$your_item_name',item_name='$item_name',i_code='$item_code',user_altercode='$user_altercode',date='$date',time='$time',datetime='$datetime'");
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
	
	public function import_oreder_medicine_delete_suggested_api()
	{
		$user_type 		= $_COOKIE['user_type'];
		$user_altercode	= $_REQUEST["user_altercode"];
		$myid 			= ($_REQUEST["myid"]);
		$status 		= 0;
		$row = $this->db->query("select item_name from drd_import_file where id='$myid'")->row();
		if(!empty($row->item_name))
		{
			$row1 = $this->db->query("select i_code from drd_import_orders_suggest where your_item_name='$row->item_name'")->row();
			$response = $this->db->query("delete from drd_import_orders_suggest where your_item_name='$row->item_name'");
			$salesman_id = "";
			if($user_type=="sales")
			{
				$salesman_id 	= $_COOKIE['user_altercode'];
			}else{
				$user_altercode	= $_COOKIE["user_altercode"];
			}
			$item_code = $row1->i_code;
			$this->db->query("delete from drd_temp_rec where i_code='$item_code' and user_type='$user_type' and selesman_id='$salesman_id' and chemist_id='$user_altercode' and status=0");
			$status = 1;
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

	public function delete_suggest_by_id()
	{
		$id = ($_REQUEST["id"]);
		if(!empty($id)){
			$this->db->query("delete from drd_import_orders_suggest where id='$id'");
		}
		
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
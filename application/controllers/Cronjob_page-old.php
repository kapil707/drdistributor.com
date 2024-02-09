<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');
ini_set('post_max_size', '100M');
ini_set('upload_max_filesize', '100M');
ini_set('max_execution_time', 36000);
require_once APPPATH."/third_party/PHPExcel.php";
class Cronjob_page extends CI_Controller 
{
    public function test_email()
	{
		$this->load->library('phpmailer_lib');
		$email = $this->phpmailer_lib->load();
		
		$subject = "drd local test ok";
		$message = "drd local test ok";
		
		$addreplyto 		= "application@drdistributor.com";
		$addreplyto_name 	= "Vipul DRD";
		$server_email 		= "application@drdistributor.com";
		//$server_email 	= "send@drdindia.com";
		$server_email_name 	= "DRD TEST";
		$email1 			= "kapil707sharma@gmail.com";
		
		$email->AddReplyTo($addreplyto,$addreplyto_name);
		$email->SetFrom($server_email,$server_email_name);
		$email->AddAddress($email1);
		
		$email->Subject   	= $subject;
		$email->Body 		= $message;

		$email->IsHTML(true);

		// SMTP configuration
		$email->isSMTP();
		$email->SMTPAuth   = 3; 
		$email->SMTPSecure = "tls";  //tls
		$email->Host     = "smtp.gmail.com";
		$email->Username   = "application2@drdindia.com";
		$email->Password   = "drd@june2023";
		$email->Port     = 587;

		if($email->send()){
            echo 'Message has been sent';
        }else{
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $email->ErrorInfo;
        }
		echo "<pre>";
		print_r($email);
	}

	public function Myexcle_export_for3_party()
	{
		//error_reporting(0);
		$delimiter = ",";
		$fp = fopen('chemist/uploads_sales/item_list.csv', 'w');
		$fields = array('Company_Name','DIVISION','Item_Code','Item_Name','Packing','Expiry','BatchNo','SaleRate','MRP','SaleScm1','SaleScm2','BATCHQTY','GSTPER','Item_Date','Date','Time');
		fputcsv($fp, $fields, $delimiter);
		$query = $this->db->get("tbl_medicine")->result();
		foreach($query as $row)
		{
			if($row->misc_settings=="#NRX"){
				$batchqty = "10";
				if($row->batchqty<10){
					$batchqty = $row->batchqty;
				}
			}else{
				$batchqty = $row->batchqty;
			}
			$dt = date("d-M-Y");
			$tt = date("H:i:s");
			$item_date = date("d-M-Y", strtotime($row->item_date));
			$lineData = array("$row->company_name","$row->division","$row->item_code","$row->item_name","$row->packing","$row->expiry","$row->batch_no","$row->sale_rate","$row->mrp","$row->salescm1","$row->salescm2","$batchqty","$row->gstper","$item_date","$dt","$tt");
			fputcsv($fp, $lineData, $delimiter);
		}
		fclose($fp);
		echo "ok";
	}
	
    public function send_email_message($email_new_type="")
	{
		$this->Message_Model->send_email_message($email_new_type);
	}
	
	public function all_message_send_by()
	{
		$this->Message_Model->send_whatsapp_message();
		$this->Message_Model->send_whatsapp_group_message();
		$this->Message_Model->send_android_notification();
		echo "work";
	}

	public function chkinvdel()
	{
		$time  = time();
		$vdt15 = date("Y-m-d", strtotime("-15 days", $time));

		$q = $this->db->query("SELECT * FROM `tbl_invoice2` WHERE `date`<'$vdt15'")->result();
		foreach($q as $row)
		{
			$id 		= $row->id;
			$gstvno 	= $row->gstvno;
			echo $files = base_url()."/upload_invoice/".$gstvno.".xls";
			echo "<br>";
			$files 		= $_SERVER['DOCUMENT_ROOT']."/upload_invoice/".$gstvno.".xls";
			$files1 	= $_SERVER['DOCUMENT_ROOT']."/upload_invoice/delete_".$gstvno.".xls";
			unlink($files);

			$files2 	= "./upload_invoice/delete_".$gstvno.".xls";
			if(file_exists($files2)=="1")
			{
				unlink($files1);
			}
		}
	}
	
	public function invoice_folder_create()
	{
		$time  = time();
		$vdt   = date("Y-m-d",$time);

		if (!file_exists('upload_invoice/'.$vdt)) {
			mkdir('upload_invoice/'.$vdt, 0777, true);
		}
	}
	
	/********delete one month old sales************************/
	public function delete_one_old_rec()
	{
	    $this->invoice_folder_create();
	    
		$time  = time();
		$vdt   = date("Y-m-d",$time);
		$day1  = date("Y-m-d", strtotime("-1 days", $time));
		$day7  = date("Y-m-d", strtotime("-7 days", $time));
		$day15  = date("Y-m-d", strtotime("-15 days", $time));
		$vdt30 = date("Y-m-d", strtotime("-30 days", $time));
		$vdt45 = date("Y-m-d", strtotime("-45 days", $time));
		$vdt60 = date("Y-m-d", strtotime("-60 days", $time));
		$vdt365 = date("Y-m-d", strtotime("-365 days", $time));

		echo "work";

		$db2 = $this->load->database('default2', TRUE);
		$db2->query("DELETE FROM `tbl_medicine_compare_final` WHERE date<='$day7'");		
		$this->db->query("DELETE FROM `tbl_deliverby` WHERE vdt<='$vdt'");		
		$this->db->query("DELETE FROM `drd_import_file` WHERE date<='$day7'");
		$this->db->query("DELETE FROM `drd_temp_rec` WHERE date<='$day7' and status='1'");
		$this->db->query("DELETE FROM `tbl_whatsapp_message` WHERE date<='$day7'");
		$this->db->query("DELETE FROM `tbl_whatsapp_group_message` WHERE date<='$day7'");
		
		$this->db->query("DELETE FROM `tbl_order` WHERE date<='$vdt60'");
		$this->db->query("DELETE FROM `tbl_android_notification` WHERE date<='$vdt60'");
		$this->db->query("DELETE FROM `tbl_low_stock_alert` WHERE date<='$vdt60'");
		$this->db->query("DELETE FROM `tbl_delete_import` WHERE date<='$vdt60'");
		$this->db->query("DELETE FROM `tbl_android_device_id` WHERE date<='$vdt60'");
		$result = $this->db->query("SELECT * FROM `tbl_invoice` WHERE `date`<'$vdt365'")->result();
		foreach($result as $row)
		{
			$id 		= $row->id;
			$gstvno 	= $row->gstvno;
			$files 		= $_SERVER['DOCUMENT_ROOT']."/upload_invoice/".$gstvno.".xls";
			$files1 	= $_SERVER['DOCUMENT_ROOT']."/upload_invoice/delete_".$gstvno.".xls";
			unlink($files);

			$files2 	= "./upload_invoice/delete_".$gstvno.".xls";
			if(file_exists($files2)=="1")
			{
				unlink($files1);
			}
			$this->db->query("DELETE FROM `tbl_invoice` WHERE id='$id'");
		}

		$result = $this->db->query("select * from tbl_staffdetail_other")->result();
		foreach($result as $row)
		{
			$row1 = $this->db->query("select * from tbl_staffdetail where code='$row->code'")->row();
			if(empty($row1->id))
			{
				$code = $row->code;
				$this->db->query("delete from tbl_staffdetail_other where code='$code'");
			}
		}

		$result = $this->db->query("SELECT * FROM `tbl_email_send`  WHERE `date`<'$day7'")->result();
		foreach($result as $row)
		{
			$id = $row->id;
			$file_name1 = $row->file_name1;
			if($file_name1)
			{
				unlink($file_name1);
			}
			$file_name2 = $row->file_name2;
			if($file_name2)
			{
				unlink($file_name2);
			}
			$file_name3 = $row->file_name3;
			if($file_name3)
			{
				unlink($file_name3);
			}
			$this->db->query("DELETE FROM `tbl_email_send` WHERE id='$id'");
		}
	}

	public function report_send_by_admin()
	{
		$massage = "Report:-".date('d-M h:i A');
		
		$massage1 = "\\n";		
		$massage1.= "\\n **************Main part**************";
		
		$result = $this->db->query("select count(id) as total from tbl_medicine")->row();
		$massage1.= "\\nTotal Medicine :- ".$result->total;
		
		/*****************************************************/
		$this->insert_meta_data("total_medicine",$result->total);
		/*****************************************************/
		
		$result = $this->db->query("select count(id) as total from tbl_acm where slcd='CL'")->row();
		$massage1.= "\\nTotal Chemist :- ".$result->total;
		
		/*****************************************************/
		$this->insert_meta_data("total_chemist",$result->total);
		/*****************************************************/
		
		$result = $this->db->query("select count(id) as total from tbl_users")->row();
		$massage1.= "\\nTotal Salesman :- ".$result->total;
		
		/*****************************************************/
		$this->insert_meta_data("total_salesman",$result->total);
		/*****************************************************/
		
		$result = $this->db->query("select count(id) as total from tbl_staffdetail")->row();
		$massage1.= "\\nTotal Corporate :- ".$result->total;
		
		/*****************************************************/
		$this->insert_meta_data("total_corporate",$result->total);
		/*****************************************************/
		
		$result = $this->db->query("select count(id) as total from tbl_master where slcd='SM' and altercode!=''")->row();
		$massage1.= "\\nTotal master :- ".$result->total;
		
		/*****************************************************/
		$this->insert_meta_data("total_master",$result->total);
		/*****************************************************/
		
		/************************************************/
		
		$date = date("Y-m-d");

		$db3 = $this->load->database('default3', TRUE);
		
		$db3->select('amt');
		$db3->where('date',$date);
		$query = $db3->get("tbl_invoice")->result();
		$today_invoice = 0;
		foreach($query as $row)
		{
			$today_invoice++;
			$today_total_sales = $today_total_sales + round($row->amt);
			$today_total_taxamt = $today_total_taxamt + round($row->taxamt);
		}
		
		setlocale(LC_MONETARY, 'en_IN');
		$today_total_sales = money_format('%!i', $today_total_sales - $today_total_taxamt);
		
		$today_total_sales = substr($today_total_sales, 0, -3);
		
		$massage2 = "\\n";
		$massage2.= "\\n **************Sales part**************";
		$massage2.= "\\nTotal Invoice :- ".$today_invoice;
		$massage2.= "\\nTotal Sale :- ".$today_total_sales;
		
		/*****************************************************/
		$this->insert_meta_data("total_invoice",$today_invoice);
		$this->insert_meta_data("total_sale",$today_total_sales);
		/*****************************************************/
		
		/***************************************************/
		
		$result = $this->db->query("select count(DISTINCT order_id) as total from tbl_order where date='$date'")->row();
		$today_orders1 = $result->total;
		
		$result = $this->db->query("select count(DISTINCT order_id) as total from tbl_order where download_status='0'")->row();
		$today_orders2 = $result->total;

		$result = $this->db->query("select sum(quantity*sale_rate) as total from tbl_order where download_status='0'")->row();
		$today_orders2_val = $result->total;

		setlocale(LC_MONETARY, 'en_IN');
		$today_orders2_val = money_format('%!i', $today_orders2_val);
		$today_orders2_val = substr($today_orders2_val, 0, -3);
		
		$massage3 = "\\n";
		$massage3.= "\\n **************Order part**************";
		$massage3.= "\\nPending Order :- ".$today_orders2;	
		$massage3.= "\\nPending Order Value :- ".$today_orders2_val;
		$massage3.= "\\n";	
		$massage3.= "\\nToday Total Order :- ".$today_orders1;
		
		/*****************************************************/
		$this->insert_meta_data("pending_order",$today_orders2);
		$this->insert_meta_data("pending_order_value",$today_orders2_val);
		$this->insert_meta_data("pending_order_order",$today_orders1);
		/*****************************************************/
		
		$result = $this->db->query("select count(DISTINCT chemist_id) as total from tbl_order where date='$date' ")->row();
		$massage3.= "\\nUnique Orders :- ".$result->total;
		
		/*****************************************************/
		$this->insert_meta_data("unique_orders",$result->total);
		/*****************************************************/
		
		$result = $this->db->query("select count(DISTINCT order_id) as total from tbl_order where date='$date' and order_type='pc_mobile'")->row();
		$massage3.= "\\nTotal Website Orders :- ".$result->total;
		
		/*****************************************************/
		$this->insert_meta_data("total_website_orders",$result->total);
		/*****************************************************/
		
		$result = $this->db->query("select count(DISTINCT order_id) as total from tbl_order where date='$date' and order_type='android'")->row();
		$massage3.= "\\nTotal Android Orders :- ".$result->total;
		
		/*****************************************************/
		$this->insert_meta_data("total_android_orders",$result->total);
		/*****************************************************/


		$massage4 = "\\n";
		$massage4.= "\\n **************Email part**************";
		$result = $this->db->query("SELECT * FROM `tbl_email`")->result();
		foreach ($result as $row){
			$server_email_name = $row->server_email_name;
			$email_function = $row->email_function;

			$row1 = $this->db->query("select count(id) as total from tbl_email_send where date='$date' and email_function='$email_function'")->row();

			$row2 = $this->db->query("select count(id) as total from tbl_email_send where date='$date' and email_function='$email_function' and status=1")->row();

			$massage4.= "\\nTotal ".$server_email_name." :- ".$row1->total."/".$row2->total;
			
			/*****************************************************/
			$this->insert_meta_data($email_function,$row1->total."/".$row2->total);
			/*****************************************************/
		}

		
		$this->db->select('quantity,sale_rate');
		$this->db->where('date',$date);
		$query = $this->db->get("tbl_order")->result();
		$today_orders_items = 0;
		foreach($query as $row)
		{
			$today_orders_price = $today_orders_price + ($row->quantity * $row->sale_rate);
			$today_orders_items++;
		}
		setlocale(LC_MONETARY, 'en_IN');
		$today_orders_price = money_format('%!i', $today_orders_price);
		$today_orders_price = substr($today_orders_price, 0, -3);
		
		$massage3.= "\\nTotal Order Value :- ".$today_orders_price;
		$massage3.= "\\nTotal Order Item :- ".$today_orders_items;
		
		/*****************************************************/
		$this->insert_meta_data("total_order_value",$today_orders_price);
		$this->insert_meta_data("total_order_item",$today_orders_items);
		/*****************************************************/

		/***************only for group message***********************/
		$group2_message 	= $massage.$massage1.$massage2.$massage3.$massage4;
		$whatsapp_group2 = $this->Scheme_Model->get_website_data("whatsapp_group2");
		$this->Message_Model->insert_whatsapp_group_message($whatsapp_group2,$group2_message);
		/*************************************************************/
		
		
	}
	
	public function insert_meta_data($meta_type="",$meta_data=""){
		$datatime  = time();
		$date  = date("Y-m-d",$datatime);
		$time  = date("H:i",$datatime);
		$dt = array('meta_type'=>$meta_type,'meta_data'=>$meta_data,'date'=>$date,'time'=>$time,'datatime'=>$datatime,);
		$this->Scheme_Model->insert_fun("tbl_meta_data",$dt);
	}

	public function send_member_notification(){
		
		//error_reporting(0);
		define('API_ACCESS_KEY', 'AAAAdZCD4YU:APA91bFjmo0O-bWCz2ESy0EuG9lz0gjqhAatkakhxJmxK1XdNGEusI5s_vy7v7wT5TeDsjcQH0ZVooDiDEtOU64oTLZpfXqA8EOmGoPBpOCgsZnIZkoOLVgErCQ68i5mGL9T6jnzF7lO');
		
		//$this->db->select('firebase_token');
		$query = $this->db->query("SELECT firebase_token FROM `tbl_master_other` WHERE `firebase_token`!=''")->result();
		foreach($query as $row)
		{
			$firebase_token = $row->firebase_token;

			$id = "1";
			$title = "Hello";
			$message = "Hello";
			$funtype = "100";
			$division = "";
			$company_full_name = "";
			$image = "";
			$itemid = "";
			
			$token = $firebase_token;
			$data = array
			(
				'id'=>$id,
				'title'=>$title,
				'message'=>$message,
				'funtype'=>$funtype,
				'itemid'=>$itemid,
				'division'=>$division,
				'company_full_name'=>$company_full_name,
				'image'=>$image,
			);
				
			$fields = array
			(
				'to'=>$token,
				'data'=>$data,
			);

			$headers = array
			(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);
			#Send Reponse To FireBase Server	
			$ch = curl_init();
			curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
			curl_setopt( $ch,CURLOPT_POST, true );
			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
			$result = curl_exec($ch);
			echo $result;
			curl_close($ch);
		}
	}

	public function check_duplicate_records()
	{
		$massage = "Report:-".date('d-M h:i A');

		$massage.= "\\n*Medicine duplicate records*";

		$i = 0;
		$result = $this->db->query("SELECT item_name,item_code,i_code FROM tbl_medicine group by item_code having count(*)>=2")->result();
		foreach($result as $row)
		{
			$i++;
			$massage.= "\\n$i :- ".$row->item_name." code(".$row->item_code.") -- id(".$row->i_code.")";
		}


		$massage1 = "\\n\\n*Medicine not added item code*";

		$i = 0;
		$result = $this->db->query("SELECT item_name,item_code,i_code FROM tbl_medicine where item_code=''")->result();
		foreach($result as $row)
		{
			$i++;
			$massage1.= "\\n$i :- ".$row->item_name." code(".$row->item_code.") -- id(".$row->i_code.")";
		}

		/***************only for group message***********************/
		$group2_message 	= $massage.$massage1;
		$whatsapp_group2 = $this->Scheme_Model->get_website_data("whatsapp_group2");
		$this->Message_Model->insert_whatsapp_group_message($whatsapp_group2,$group2_message);
		/*************************************************************/
	}

	public function cronjob_website_menu_json_new()
	{
		$result0 = $this->Chemist_Model->website_menu_json_new();
		file_put_contents("json_api/website_menu_json_new.json", $result0);
	}

	public function cronjob_top_flash()
	{
		$result0 = $this->Chemist_Model->top_flash();
		file_put_contents("json_api/top_flash.json", $result0);
	}

	public function cronjob_top_flash2()
	{
		$result0 = $this->Chemist_Model->top_flash2();
		file_put_contents("json_api/top_flash2.json", $result0);
	}

	public function cronjob_featured_brand_json_new()
	{
		$result0 = $this->Chemist_Model->featured_brand_json_new();
		file_put_contents("json_api/featured_brand_json_new.json", $result0);
	}

	public function cronjob_new_medicine_this_month_json_new()
	{
		$result0 = $this->Chemist_Model->new_medicine_this_month_json_new();
		file_put_contents("json_api/new_medicine_this_month_json_new.json", $result0);
	}

	public function cronjob_hot_selling_today_json_new()
	{
		$result0 = $this->Chemist_Model->hot_selling_today_json_new();
		file_put_contents("json_api/hot_selling_today_json_new.json", $result0);
	}

	public function cronjob_must_buy_medicines_json_new()
	{
		$result0 = $this->Chemist_Model->must_buy_medicines_json_new();
		file_put_contents("json_api/must_buy_medicines_json_new.json", $result0);
	}

	public function cronjob_frequently_use_medicines_json_new()
	{
		$result0 = $this->Chemist_Model->frequently_use_medicines_json_new();
		file_put_contents("json_api/frequently_use_medicines_json_new.json", $result0);
	}

	public function cronjob_stock_now_available()
	{
		$result0 = $this->Chemist_Model->stock_now_available();
		file_put_contents("json_api/stock_now_available.json", $result0);
	}
	
	/*
	// new add by comparer part
	public function medicine_comparer_copy()
	{
		$time  = time();
		$vdt   = date("d",$time);
		if($vdt%5==0){

			$db2 = $this->load->database('default2', TRUE);

			//$db2->query("TRUNCATE TABLE tbl_final_comparer");
			$db2->query("TRUNCATE TABLE tbl_medicine_comparer");
			$db2->query("INSERT tbl_medicine_comparer SELECT * FROM tbl_medicine");
		}
	}

	public function medicine_comparer_status_update()
	{
		$db2 = $this->load->database('default2', TRUE);

		$db2->query("update tbl_medicine_comparer set status=0");
	}*/

	public function medicine_comparer()
	{
		$db2 = $this->load->database('default2', TRUE);

		$time  = time();
		$date  = date("Y-m-d",$time);

		$sameid = "";
		$result = $db2->query("SELECT i_code,mrp,margin,batchqty from tbl_medicine_comparer where status=1 limit 250")->result();
		foreach($result as $row){
			$sameid.=$row->i_code.",";

			$mrp[$row->i_code] 		= $row->mrp;
			$margin[$row->i_code] 	= $row->margin;
			$batchqty[$row->i_code] = $row->batchqty;
		}

		$sameid = substr($sameid,0,-1);
		if(!empty($sameid))
		{
			$sameid = "i_code in(".$sameid.")";

			$result1 = $db2->query("SELECT i_code,mrp,margin,batchqty from tbl_medicine where $sameid")->result();
			foreach($result1 as $row1){
				//echo $mrp[$row1->i_code]."--".$row1->mrp."<br>";
				if($mrp[$row1->i_code]>$row1->mrp){
					$db2->query("insert into tbl_final_comparer (i_code,date,type) values ('$row1->i_code','$date','mrp')"); 
					//echo "insert into tbl_final_comparer (i_code,date,type) values ('$row1->i_code','$date','mrp') <br>";
				}
				if($margin[$row1->i_code]<$row1->margin){
					$db2->query("insert into tbl_final_comparer (i_code,date,type) values ('$row1->i_code','$date','margin')"); 
				}
				if($batchqty[$row1->i_code]==0 && $row1->batchqty!=0){
					$db2->query("insert into tbl_final_comparer (i_code,date,type) values ('$row1->i_code','$date','batchqty')"); 
				}
				$db2->query("update tbl_medicine_comparer set status=0 where i_code='$row1->i_code'");
			}
		}
	}
}
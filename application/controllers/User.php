<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		//error_reporting(0);
		redirect(base_url());
	}
	public function termsofservice() {
		//error_reporting(0);
		$data = "";
		
		$data["session_user_image"] = base_url()."img_v".constant('site_v')."/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		$data["chemist_id"] = "";
		
		if(!empty($this->session->userdata('user_altercode')))
		{
			$data["session_user_image"] 	= $this->session->userdata('user_image');
			$data["session_user_fname"]     = $this->session->userdata('user_fname');
			$data["session_user_altercode"] = $this->session->userdata('user_altercode');
			$data["chemist_id"] = $this->session->userdata('user_altercode');
		}
		
		$this->load->view('home/header', $data);
	    $this->load->view('main_page/termsofservice', $data);
	}
	public function privacy_policy() {
		//error_reporting(0);
		
		$data["session_user_image"] = base_url()."img_v".constant('site_v')."/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		$data["chemist_id"] = "";
		
		if(!empty($this->session->userdata('user_altercode')))
		{
			$data["session_user_image"] 	= $this->session->userdata('user_image');
			$data["session_user_fname"]     = $this->session->userdata('user_fname');
			$data["session_user_altercode"] = $this->session->userdata('user_altercode');
			$data["chemist_id"] = $this->session->userdata('user_altercode');
		}
		
		$this->load->view('home/header', $data);
	    $this->load->view('main_page/privacy_policy', $data);
	}
	public function register() {
		//error_reporting(0);
		$data["main_page_title"] = "Create account";
	    $this->load->view('main_page/register', $data);
	}
	
	public function login() {
		$this->session->sess_destroy();
		if($this->session->userdata('user_session')!=""){
			redirect('home');
		}
		$data["main_page_title"] = "Login";
	    $this->load->view('main_page/login', $data);
	}
	
	public function logout(){
		$this->session->sess_destroy();	
		//$this->session->unset_userdata('__ci_last_regenerate');
		/*$CI =& get_instance();
		$path = $CI->config->item('cache_path');
		$cache_path = ($path == '') ? APPPATH.'cache/' : $path;
		$handle = opendir($cache_path);
		while (($file = readdir($handle))!== FALSE) 
		{
			//Leave the directory protection alone
			if ($file != '.htaccess' && $file != 'index.html')
			{
				echo $cache_path.'/'.$file;
			   //@unlink($cache_path.'/'.$file);
			}
		}
		closedir($handle);*/
		setcookie("user_cart_total", "0", time() + (86400 * 30), "/");
		setcookie("user_type", "", time() + (86400 * 30), "/");
		setcookie("user_altercode", "", time() + (86400 * 30), "/");
		setcookie("user_password", "", time() + (86400 * 30), "/");
		setcookie("chemist_id", "", time() + (86400 * 30), "/");
		setcookie("user_session", "", time() + (86400 * 30), "/");
		redirect(base_url());
	}
	public function logout2(){
		$this->session->sess_destroy();	
		$this->session->unset_userdata('__ci_last_regenerate');
		redirect(base_url()."user/login");
	}
	
	public function invoice($chemist_id='',$invoice_id=''){
		
		$data["session_user_image"] = base_url()."img_v".constant('site_v')."/logo2.png";
		$data["session_user_fname"]     = "Guest";
		$data["session_user_altercode"] = "xxxxxx";
		
		$db3 = $this->load->database('default3', TRUE);
		$where = array('gstvno'=>$invoice_id,'altercode'=>$chemist_id);
		$db3->where($where);
		$query = $db3->get("tbl_invoice");
		$row   = $query->row();
		$data["item_id"] 		= $row->id;
		$data["user_altercode"] = $chemist_id;
		
		$data["main_page_title"] = $invoice_id;	
		$this->load->view('home/header', $data);		
		$this->load->view('main_page/my_invoice_details', $data);		
	}
	public function download_invoice($chemist_id='',$invoice_id='')
	{
		$db3 = $this->load->database('default3', TRUE);
		$where = array('gstvno'=>$invoice_id,'altercode'=>$chemist_id);
		$db3->where($where);
		$query = $db3->get("tbl_invoice");
		$row   = $query->row();
		if($row->id!="")
		{
			$gstvno 	= $row->gstvno;
			$folder_dt 	= $row->date;
			$excelFile 	= "./upload_invoice/".$gstvno.".xls";
			if (file_exists($excelFile)) {
			?>
			<script>
				window.location.href = "<?= base_url(); ?>upload_invoice/<?= $invoice_id ?>.xls";
				setTimeout(function() {window.history.back();}, 500);
			</script>
			<?php }else{ ?>
				<script>
					window.location.href = "<?= base_url(); ?>upload_invoice/<?php echo $folder_dt?>/<?= $invoice_id ?>.xls";
					setTimeout(function() {window.history.back();}, 500);
				</script>
				<?php
			}
		}
		else{
			?>
			<script>
				window.history.back();
			</script>
			<?php
		}	
	}
	public function download_invoice1($chemist_id='',$invoice_id='')
	{
		$db3 = $this->load->database('default3', TRUE);
		$where = array('gstvno'=>$invoice_id,'altercode'=>$chemist_id);
		$db3->where($where);
		$query =$db3->get("tbl_invoice");
		$row   = $query->row();
		if($row->id!="")
		{
			$gstvno 	= $row->gstvno;
			$folder_dt 	= $row->date;
			
			$excelFile 	= "./upload_invoice/".$gstvno.".xls";
			if (file_exists($excelFile)) {
			?>
			<script>
				window.location.href = "<?= base_url(); ?>upload_invoice/<?= $invoice_id ?>.xls";
				setTimeout(function() {window.close();}, 500);
			</script>
			<?php }else{ ?>
				<script>
					window.location.href = "<?= base_url(); ?>upload_invoice/<?php echo $folder_dt?>/<?= $invoice_id ?>.xls";
					setTimeout(function() {window.close();}, 500);
				</script>
				<?php
			}
		}
		else{
			?>
			<script>
				window.history.back();
			</script>
			<?php
		}	
	}
	public function download_order($order_id,$chemist_id)
	{
		$where = array('order_id'=>$order_id,'chemist_id'=>$chemist_id);
		$this->db->where($where);
		$query = $this->db->get("tbl_order");
		$row   = $query->row();
		$query = $query->result();
		if($row->id!="")
		{
			$where 			= array('altercode'=>$row->chemist_id);
			$users 			= $this->Scheme_Model->select_row("tbl_acm",$where);
			$acm_altercode 	= $users->altercode;
			$acm_name		= ucwords(strtolower($users->name));		
			$chemist_excle 	= "$acm_name ($acm_altercode)";
			$this->Order_Model->excel_save_order_to_server($query,$chemist_excle,"direct_download");
		}
		else{
			echo "error";
		}
	}

	public function login_api(){
		//error_reporting(0);
		$user_name1 = $_POST["user_name1"];
		$password1	= $_POST["password1"];
		$submit 	= "98c08565401579448aad7c64033dcb4081906dcb";
		header('Content-Type: application/json');
		$items = $this->Chemist_Model->login($user_name1,$password1);
		$someArray = json_decode($items, true);
		$user_return 	= "user_return";
		$user_session 	= "user_session";
		$user_fname 	= "user_fname";
		$user_code 		= "user_code";
		$user_altercode = "user_altercode";
		$user_type 		= "user_type";
		$user_password 	= "user_password";
		$user_division 	= "user_division";
		$user_compcode 	= "user_compcode";
		$user_image 	= "user_image";
		$user_nrx 		= "user_nrx";
		if($someArray[$user_return]=="1")
		{
			$ret = $this->Chemist_Model->insert_value_on_session($someArray[$user_session],$someArray[$user_fname],$someArray[$user_code],$someArray[$user_altercode],$someArray[$user_type],$someArray[$user_password],$someArray[$user_division],$someArray[$user_compcode],$someArray[$user_image],$someArray[$user_nrx]);
			$user_type 		= $someArray[$user_type];
			$user_altercode = $someArray[$user_altercode];
			$user_password	= $someArray[$user_password];	
			setcookie("chemist_id", "", time() + (86400 * 30), "/");
			$chemist_id  = "";
			$salesman_id = "";
			if($user_type=="sales")
			{
				$chemist_id     = $_COOKIE["chemist_id"];
				$salesman_id 	= $user_altercode;
				$user_altercode = $chemist_id;
			}
			$user_cart_total = $this->Chemist_Model->count_temp_rec($user_type,$user_altercode,$salesman_id);
			setcookie("user_cart_total", $user_cart_total, time() + (86400 * 30), "/");
		}
		else{
			$ret=1;
		}
		if($ret==1)
		{
?>
{"items":[<?= $items;?>]}<?php
		}
	}
}
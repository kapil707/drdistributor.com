<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->load->view('test/index');	
	}
	public function test2(){
		$this->load->view('test/index');	
	}
	public function test3(){
		$this->load->view('test/index');	
	}
}
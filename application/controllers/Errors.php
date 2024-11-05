<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Errors extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the AppConfig library
        $this->load->library('AppConfig');
    }

    public function custom_404() {
        $this->output->set_status_header('404');
        $this->load->view('custom_404');
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('log_activity')) {
    function log_activity() {
        // Get a reference to the CodeIgniter super object
        $CI =& get_instance();
        
        // Load the ActivityModel
        $CI->load->model("model-drdistributor/activity_model/ActivityModel");

        // Get request information
        $ip_address = $CI->input->ip_address();
        $url = current_url();
        $http_method = $CI->input->method();
        $user_agent = $CI->input->user_agent();

        // Prepare data to insert
        $log_data = array(
            'ip_address' => $ip_address,
            'url' => $url,
            'http_method' => strtoupper($http_method),
            'user_agent' => $user_agent
        );

        // Insert log into the database
        $CI->ActivityModel->insert_log($log_data);
    }
}
?>

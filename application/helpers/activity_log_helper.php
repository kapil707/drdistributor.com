<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('log_activity')) {
    function log_activity($user_altercode='',$salesman_id='',$user_type='',$view_type) {
        // Get a reference to the CodeIgniter super object
        $CI =& get_instance();
        
        // Load the ActivityModel
        $CI->load->model("model-drdistributor/activity_model/ActivityModel");

        // Get request information
        $ip_address = $CI->input->ip_address();
        $url = current_url();
        $http_method = $CI->input->method();
        $user_agent = $CI->input->user_agent();

        // Get controller and method name
        $controller = $CI->router->fetch_class();
        $method = $CI->router->fetch_method();

        // Get query parameters or form data based on HTTP method
        $request_data = '';
        if (strtoupper($http_method) === 'GET') {
            $request_data = json_encode($CI->input->get());
        } elseif (strtoupper($http_method) === 'POST') {
            $request_data = json_encode($CI->input->post());
        }

        // Prepare data to insert
        $log_data = array(
            'ip_address' => $ip_address,
            'url' => $url,
            'http_method' => strtoupper($http_method),
            'user_agent' => $user_agent,
            'controller' => $controller,
            'method' => $method,
            'request_data' => $request_data,
            'user_altercode' => $user_altercode,
            'salesman_id' => $salesman_id,
            'user_type' => $user_type,
            'view_type' => $view_type,
        );

        // Insert log into the database
        $CI->ActivityModel->insert_log($log_data);
    }
}

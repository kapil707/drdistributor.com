<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('log_activity')) {
    function log_activity($chemist_id='',$salesman_id='',$user_type='',$view_type) {
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
            'chemist_id' => $chemist_id,
            'salesman_id' => $salesman_id,
            'user_type' => $user_type,
            'view_type' => $view_type,
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
            'timestamp' => time(),
        );

        // Insert log into the database
        //$CI->ActivityModel->insert_log($log_data);
    }
}
if (!function_exists('log_search_activity')) {
    function log_search_activity($chemist_id, $salesman_id, $search_term="", $item_code="") {
        // Get a reference to the CodeIgniter super object
        $CI =& get_instance();
        
        // Load the ActivityModel
        $CI->load->model("model-drdistributor/medicine_search/MedicineSearchModel");

        $log_data = array(
            'chemist_id' => $chemist_id,
            'salesman_id' => $salesman_id,
            'search_term' => $search_term,
            'item_code' => $item_code,
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
            'timestamp' => time(),
        );
        
        // Insert log into the database
        //$CI->MedicineSearchModel->insert_log($log_data);
    }
}

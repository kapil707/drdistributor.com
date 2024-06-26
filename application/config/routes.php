<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'main/index';

$route['login'] = 'Account/login';
$route['create_new'] = 'Account/account_request';
$route['account_request'] = 'Account/account_request';
$route['account_delete_request'] = 'Account/account_delete_request';
$route['logout'] = 'Account/logout';

$route['user/login'] = 'Account/login';
$route['user/create_new'] = 'Account/account_request';
$route['user/account_request'] = 'Account/account_request';
$route['user/logout'] = 'Account/logout';

$route['user/privacy_policy'] = 'main/privacy_policy';
$route['privacy_policy']='main/privacy_policy';
$route['user/termsofservice'] = 'main/terms_of_services';
$route['termsofservice']='main/terms_of_services';
$route['terms_of_services']='main/terms_of_services';

$route['chemist/android/Api_mobile30/insert_temp_order/(:any)'] = 'android/Api_mobile30/insert_temp_order/$1';
$route['chemist/android/Api_mobile30/get_online_cart/(:any)'] = 'android/Api_mobile30/get_online_cart/$1';
$route['chemist/android/Api_mobile30/get_online_cart2/(:any)'] = 'android/Api_mobile30/get_online_cart2/$1';
$route['chemist/android/Api_mobile30/delete_temp_order/(:any)'] = 'android/Api_mobile30/delete_temp_order/$1';
$route['chemist/android/Api_mobile30/deleteall_temp_order/(:any)'] = 'android/Api_mobile30/deleteall_temp_order/$1';
$route['chemist/android/Api_mobile30/save_order_to_server/(:any)'] = 'android/Api_mobile30/save_order_to_server/$1';


$route['all_invoice'] = 'User/local_server_all_invoice';
$route['pickedby'] = 'User/local_server_pickedby';
$route['deliverby'] = 'User/local_server_deliverby';

$route['home']='Home/index';

$route['search_medicine']='medicine_search/index';
$route['medicine_search']='medicine_search/index';
$route['home/search_medicine']='medicine_search/index';
$route['home/medicine_search']='medicine_search/index';

$route['my_cart']='my_cart/index';
$route['home/my_cart']='my_cart/index';

$route['track_order']='home/track_order';

$route['medicine_use/(:any)']='medicine_use/index/$1';

$route['my_order']='my_order/index';
$route['my_order_details/(:any)']='my_order/my_order_details/$1';
$route['user/download_order/(:any)/(:any)'] = 'main/download_order_old/$1/$2';
$route['order_download/(:any)/(:any)'] = 'main/order_download/$1/$2';
$route['order/(:any)/(:any)'] = 'main/view_order/$1/$2';
$route['view_order/(:any)/(:any)'] = 'main/view_order/$1/$2';

$route['invoice/(:any)/(:any)'] = 'main/view_invoice/$1/$2';
$route['view_invoice/(:any)/(:any)'] = 'main/view_invoice/$1/$2';
$route['invoice_download/(:any)/(:any)'] = 'main/invoice_download/$1/$2';

$route['my_invoice']='my_invoice/index';
$route['my_invoice_details/(:any)']='my_invoice/my_invoice_details/$1';

$route['my_notification']='my_notification/index';
$route['my_notification_details/(:any)']='my_notification/my_notification_details/$1';

$route['home/account']='user/account';
$route['home/change_account']='user/update_account';
$route['home/change_image']='user/update_image';
$route['home/change_password']='user/update_password';

$route['account']='user/account';
$route['change_account']='user/update_account';
$route['change_image']='user/update_image';
$route['change_password']='user/update_password';

$route['update_account']='user/update_account';
$route['update_image']='user/update_image';
$route['update_password']='user/update_password';

$route['category/(:any)'] = 'Category/index/$1';
$route['category/api/medicine_category_api'] = 'Category/medicine_category_api';
$route['category/itemcategory/(:any)']= 'Category/itemcategory/$1';
$route['category/featured_brand/(:any)/(:any)']= 'Category/featured_brand/$1/$2';


$route['select_chemist'] = 'Chemist_select/index';
$route['home/select_chemist'] = 'Chemist_select/index';

$route['404_override'] = 'errors/custom_404';
$route['translate_uri_dashes'] = FALSE;
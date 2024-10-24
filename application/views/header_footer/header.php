<?php 
$theme_type = "lite";
if (isset($_COOKIE["theme_type"])) {
	$theme_type = $_COOKIE["theme_type"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>
		<?= $title = $this->Scheme_Model->get_website_data("title") ;?> || <?= $main_page_title;?>
	</title>
	
	<meta name="msapplication-tap-highlight" content="no" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="canonical" href="https://www.drdistributor.com/" />

	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="<?= base_url(); ?>assets/website/css/font-awesome.min.css"> 
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Ottoman+Siyaq&display=swap" rel="stylesheet">
	
	<?php vp_seo(); ?>
	
	<?php if($theme_type=="lite") { ?>
		<meta name="theme-color" content="#27ae60">
		<link href="<?= base_url(); ?>assets/css/style-light.css" rel="stylesheet" type="text/css"/>
	<?php } ?>

	<?php if($theme_type=="dark") { ?>
		<meta name="theme-color" content="#373d40">
		<link href="<?= base_url(); ?>assets/css/style-dark.css" rel="stylesheet" type="text/css"/>
	<?php } ?>

	<link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" />

	<link href="<?= base_url(); ?>assets/website/easyzoom/easyzoom.css" rel="stylesheet" type="text/css" />

	<link rel="icon" href="<?= base_url(); ?>img_v51/logo4.png" type="image/logo" sizes="16x16" alt="<?= $title;?>" />
	
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<link href="<?= base_url(); ?>assets/website/css/min.css" rel="stylesheet" type="text/css" />
	<script src="<?= base_url(); ?>assets/website/js/min.js"></script>
</head>
<body>
<div class="top_bar">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-6 col-6 web-col-padding-5" style="display: flex;">
				<div class="" style="float:left;">
					<a href="javascript:new_style_menu_show()" class="top_bar_logo" style="color:white;" title="Drd Menu">
						<img src="<?= base_url() ?>img_v51/logo4.png" alt="<?= $title;?>" title="<?= $title;?>">
					</a>
					<a href="javascript:goBack()" class="top_bar_back_btn" title="Go Back">
						<i class="fa fa-chevron-left" aria-hidden="true"></i>
					</a>
				</div>
				<div class="" style="float:left; margin-left:5px;width: inherit;">
					<h1 class="pro-link top_bar_title">
						Loading....
					</h1>
					<div class="pro-link top_bar_title1">
						Code : <?= $session_delivering_to ?>
					</div>
				</div>
			</div>
			
			<div class="col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-6 col-6 web-col-padding-5">
				<ul class="top_bar_menu">
					<li class="d-none d-sm-block">
						<a href="<?= base_url() ?>" title="Home">
							<i class="fa fa-home" aria-hidden="true"></i>
							<span class="d-none d-xl-block">Home</span>
						</a>
					</li>
					
					<li class="d-none d-sm-block">
						<a href="<?= base_url() ?>medicine_search" title="Search medicine / company">
							<i class="fa fa-search" aria-hidden="true"></i>
							<span class="d-none d-xl-block">Search</span>
						</a>
					</li>

					<li class="d-none d-sm-block">
						<a href="javascript:new_style_menu_show()" class="mobile_off">
							<i class="fa fa-user" aria-hidden="true"></i>
							<span class="d-none d-xxxl-block">My&nbsp;</span>
							<span class="d-none d-xl-block">Account</span>
						</a>
					</li>
					
					<li class="mobile_show">
						<a href="#" onclick="delete_all_medicine()" title="delete all" class="top_bar_menu_delete_all_btn" style="display: none;">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a href="<?= base_url(); ?>my_cart" class="top_menu_cart_div" title="My cart">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
							<span class="d-none d-xxxl-block">My&nbsp;</span>
							<span class="d-none d-xl-block">Cart&nbsp;</span>
							(<span class="top_bar_menu_cart_span">0</span>)
						</a>
					</li>

					<li class="d-none d-lg-block">
						<a href="<?= base_url() ?>my_order" class="mobile_off" title="My order">
							<i class="fa fa-newspaper-o" aria-hidden="true"></i> 
							<span class="d-none d-xxxl-block">My&nbsp;</span>
							<span>Order</span>
						</a>
					</li>					

					<li class="d-none d-lg-block">
						<a href="<?= base_url() ?>my_invoice" class="mobile_off" title="My invoice">
							<i class="fa fa-flag" aria-hidden="true"></i>
							<span class="d-none d-xxxl-block">My&nbsp;</span>
							<span>Invoice</span>
						</a>
					</li>

					<li class="d-none d-sm-block">
						<a href="<?= base_url() ?>my_notification" class="mobile_off" title="My notification">
							<i class="fa fa-bell" aria-hidden="true"></i>
							<span class="d-none d-xxxl-block">My&nbsp;</span>
							<span class="d-none d-xl-block">Notification</span>
						</a>
					</li>
					
					<li class="d-none d-lg-block">
						<a href="<?= base_url() ?>import_order" class="mobile_off" title="Upload order">
							<i class="fa fa-upload" aria-hidden="true"></i>
							<span>Upload</span>
							<span class="d-none d-xxxl-block">&nbsp;Order</span>
						</a>
					</li>

					<?php if(!empty($_COOKIE['user_session'])){ ?>
					<li class="d-none d-md-block">
						<a class="mobile_off" title="Logout" href="javascript:void(0);" onclick="logout_function()">
							<i class="fa fa-sign-out" aria-hidden="true"></i>
							<span>Logout</span>
						</a>
					</li>
					<?php } else { ?>
					<li class="d-none d-md-block">
						<a href="<?php echo base_url(); ?>login" title="Login">
							<i class="fa fa-sign-out" aria-hidden="true"></i>
							<span>Login</span>
						</a>
					</li>
					<?php } ?>
				<ul>
			</div>
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
				<div class="row">
					<div class="col-lg-3 col-md-1 col-sm-12 col-xs-12 col-12 mobile_off">
						<div class="top_bar_google_play_btn">
							<div class="d-none d-xxxl-block wow pulse animated" data-wow-delay="300ms" data-wow-iteration="infinite" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-delay: 300ms; animation-iteration-count: infinite; animation-name: pulse;">
								<div class="google_play" style="width: 134px;float: right;">
									<a href="https://play.google.com/store/apps/details?id=com.drdistributor.dr&hl=en" target="_black" title="Download App">
										<img src="https://www.drdistributors.co.in/drd-live/img_v51/playstrore.png" alt="Google Play" style="width:20px;">
										Google Play
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-10 col-sm-12 col-xs-12 col-12">

						<a href="<?= base_url(); ?>search_medicine" title="Search medicine / company" class="top_bar_search_div">
							<i class="fa fa-search top_bar_search_div_search_icon" aria-hidden="true"></i>
							<div class="top_bar_search_div_search_text">Search medicine / company</div> 
						</a>
						
						<div class="top_bar_search_textbox_div">
							<i class="fa fa-search top_bar_search_textbox_div_search_icon" aria-hidden="true"></i>

							<input type="text" class="medicine_search_textbox input_type_text" placeholder="Search medicine / company" tabindex="1" style="display:none">

							<input type="text" class="chemist_search_textbox input_type_text" placeholder="Search chemist"  tabindex="1" style="display:none">

							<i class="fa fa-list-alt top_bar_search_textbox_div_menu_icon" aria-hidden="true" onclick="menu_search_function()"></i>

							<i class="fa fa-times top_bar_search_textbox_div_clear_icon" aria-hidden="true" onclick="clear_search_function()"></i>
						</div>
						<div class="search_result_div"></div>
					</div>

					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<div class="top_bar_search_textbox_div_menu" style="display:none">
							<div class="row">
								<div class="col-sm-6">
									<label>Medicine : <input type="checkbox" class="menu_search_icon_checkbox checkbox_medicine" onchange="medicine_search_api()" checked></label>
								</div>
								<div class="col-sm-6">
									<label>Company : <input type="checkbox" class="menu_search_icon_checkbox checkbox_company" onchange="medicine_search_api()" checked></label>
								</div>
								<div class="col-sm-8">
									Result Show :
								</div>
								<div class="col-sm-4">
									<select class="medicine_total_rec" onchange="medicine_search_api()">
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="75">75</option>
										<option value="100">100</option>
										<option value="all">All</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-sm-12 top_bar_menu2">
				<ul class="top_bar_menu2_ul"></ul>
			</div>

			<div class="col-sm-12 text-right mobile_show">
				<span class="top_bar_title2"></span>
			</div>
		</div>
	</div>
</div>
<!-- ******************************************************** -->
<img src="<?= base_url(); ?>img_v51/logo.png" style="display:none" alt="<?= $title;?>">
<div class="left_menu_bar">
	<div class="left_menu_bar_div1">
		<div class="row">
			<div class="col-sm-2 col-4">
				<img src="<?= $session_user_image ?>" alt="<?= $session_user_fname ?>" title="<?= $session_user_fname ?>" class="left_menu_bar_account_image" onerror=this.src="<?= base_url(); ?>img_v51/logo4.png">
			</div>
			<div class="col-sm-8 col-6">
				<div class="left_menu_bar_accoun_chemist_name">
					<?= $session_user_fname ?>
				</div>
				<div class="left_menu_bar_accoun_chemist_code">
					Code : <?= $session_user_altercode ?>
				</div>
			</div>
			<div class="col-sm-2 col-2 text-left">
				<i class="fa fa-times left_menu_bar_cancel_icon" aria-hidden="true" onclick="new_style_menu_hide()"></i>
			</div>
		</div>
	</div>
	<div class="left_menu_bar_div2 text-center">
		<h2 class="text-left">Select theme</h2>
		<select class="input_type_text2 theme_set_css" onchange="theme_set()" style="width:96%;">
			<option value="lite" <?php if($theme_type=="lite") { echo "selected"; } ?>>Lite</option>
			<option value="dark" <?php if($theme_type=="dark") { echo "selected"; } ?>>Dark</option>
		</select>
		<h2 class="text-left">Account</h2>
		<ul>
			<li>
				<a href="<?= base_url() ?>account" title="Account">
					<i class="fa fa-user" aria-hidden="true"></i> 
					Account
				</a>
			</li>
			<li>
				<a href="<?= base_url() ?>update_account" title="Update account">
					<i class="fa fa-pencil-square" aria-hidden="true"></i>
					Update account
				</a>
			</li>
			<li>
				<a href="<?= base_url() ?>update_image" title="Update image">
					<i class="fa fa-camera" aria-hidden="true"></i> 
					Update image
				</a>
			</li>
			<li>
				<a href="<?= base_url() ?>update_password" title="Update password">
				<i class="fa fa-key" aria-hidden="true"></i>
					Update password
				</a>
			</li>
			<li class="mobile_off">
				<a href="<?= base_url(); ?>import_order/medicine_suggest" title="Update suggest medicine">
					<i class="fa fa-thumbs-up" aria-hidden="true"></i> 
					Update suggest medicine
				</a>
			</li>
			<?php
			if(!empty($_COOKIE['user_type'])){
			if($_COOKIE['user_type']=="sales")
			{
				$user_type = $_COOKIE['user_type'];
				?>
			<h2 class="text-left">Server Report</h2>
			<li>
				<a href="http://192.168.0.100:7272/drd_local_server/pendingorder_report" title="Pending Order" target="_black">
					<img class="img-circle" src="<?= base_url() ?>img_v51/privacy_policy.png" width="20" alt="Pending Order" title="Pending Order">
					Pending Order
				</a>
			</li>

			<li>
				<a href="http://192.168.0.100:7272/drd_local_server/drd_today_invoice" title="All Invoice" target="_black">
					<img class="img-circle" src="<?= base_url() ?>img_v51/privacy_policy.png" width="20" alt="All Invoice" title="All Invoice">
					All Invoice
				</a>
			</li>
			
			<li>
				<a href="http://192.168.0.100:7272/drd_local_server/child_invoice/pickedby" title="Pickedby Invoice" target="_black">
					<img class="img-circle" src="<?= base_url() ?>img_v51/privacy_policy.png" width="20" alt="Pickedby Invoice" title="Pickedby Invoice">
					Pickedby Invoice
				</a>
			</li>
			
			<li>
				<a href="http://192.168.0.100:7272/drd_local_server/child_invoice/pickedby" title="Deliverby Invoice" target="_black">
					<img class="img-circle" src="<?= base_url() ?>img_v51/privacy_policy.png" width="20" alt="Deliverby Invoice" title="Deliverby Invoice">
					Deliverby Invoice
				</a>
			</li>
			
			<li>
				<a href="http://192.168.0.100:7272/drd_local_server/delivery_report" title="Delivery Report" target="_black">
					<img class="img-circle" src="<?= base_url() ?>img_v51/privacy_policy.png" width="20" alt="Delivery Report" title="Delivery Report">
					Delivery Report
				</a>
			</li>
			<?php } }?>
			<h2 class="text-left">Others</h2>
			<li>
				<a href="tel:+919899133989" title="Contact us">
					<i class="fa fa-phone-square" aria-hidden="true"></i> Contact us
				</a>
			</li>
			<li title="Email">
				<a href="mailto:vipul@drdindia.com" title="Email">
					<i class="fa fa-envelope" aria-hidden="true"></i> Email
				</a>
			</li>
			<li title="Privacy policy">
				<a href="<?= base_url();?>privacy_policy" title="Privacy policy">
					<i class="fa fa-book" aria-hidden="true"></i>
					Privacy policy
				</a>
			</li>
			<li title="Share App">
				<a href="https://play.google.com/store/apps/details?id=com.drdistributor.dr&hl=en" target="_black" title="Share App">
					<i class="fa fa-share-alt-square" aria-hidden="true"></i>
					Share App
				</a>
			</li>
			<li title="Download App">
				<a href="https://play.google.com/store/apps/details?id=com.drdistributor.dr&hl=en" target="_black" title="Download App">
					<i class="fa fa-mobile" aria-hidden="true"></i>
					Download App
				</a>
			</li>
			<?php if(!empty($_COOKIE['user_session'])){ ?>
			<li title="Logout">
				<a title="Logout" href="javascript:void(0);" onclick="logout_function()">
					<i class="fa fa-sign-out" aria-hidden="true"></i>
					Logout
				</a>
			</li>
			<?php } else { ?>
			<li title="Login">
				<a href="<?= base_url('login')?>" title="Login">
					<i class="fa fa-sign-out" aria-hidden="true"></i>
					Login
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>
<!-- ******************************************************** -->
<div class="select_medicine_in_modal_script_css"></div>
<div class="only_for_noti"></div>
<!-- ******************************************************** -->
<input type="hidden" class="medicine_details_item_code">
<div type="hidden" class="medicine_details_all_data"></div>
<!-- ******************************************************** -->
<span data-toggle="modal" data-target="#myModal_medicine_details" style="text-decoration: none;" class="myModal_medicine_details"></span>
<div class="modal modaloff" id="myModal_medicine_details">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Medicine details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times modal_cancel_btn" aria-hidden="true"></i>
				</button>
			</div>
			<div class="modal-body">
				<div class="medicine_details_item_date_time">Loading....</div>
				<div class="medicine_details_api_loading text-center" style="display:none">
					<div>
						<img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px" alt="loading">
					</div>
					<div>Loading....</div>
				</div>
				<div class="row medicine_details_api_data" style="display:none">
					<div class="col-sm-5 col-12">
						<div class="row">
							<div class="col-sm-12 col-9">
								<img src="<?= base_url(); ?>/img_v51/featured_img.png" alt="" class="medicine_details_featured_img" loading="lazy">

								<img src="<?= base_url(); ?>/img_v51/out_of_stock_img.png" alt="" class="medicine_details_out_of_stock_img" loading="lazy">

								<div class="big1">
									<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
										<a>
											<img src="<?= base_url(); ?>/uploads/default_img.webp" width="100%" style="float: right;margin-top:10px;" class="medicine_details_image modal_item_image_change" alt="zoom" loading="lazy" onerror="setDefaultImage(this);">
										</a>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-3">
								<div class="row">
									<div class="col-sm-3 col-12">
										<img src="<?= base_url(); ?>/uploads/default_img.webp" class="medicine_details_image_small modal_item_image_change1" onclick="modal_item_image_change(1)" alt="zoom" loading="lazy" onerror="setDefaultImage(this);">
									</div>
									<div class="col-sm-3 col-12">
										<img src="<?= base_url(); ?>/uploads/default_img.webp" class="medicine_details_image_small modal_item_image_change2" onclick="modal_item_image_change(2)" alt="zoom" loading="lazy" onerror="setDefaultImage(this);">
									</div>
									<div class="col-sm-3 col-12">
										<img src="<?= base_url(); ?>/uploads/default_img.webp" class="medicine_details_image_small modal_item_image_change3" onclick="modal_item_image_change(3)" alt="zoom" loading="lazy" onerror="setDefaultImage(this);">
									</div>
									<div class="col-sm-3 col-12">
										<img src="<?= base_url(); ?>/uploads/default_img.webp" class="medicine_details_image_small modal_item_image_change4" onclick="modal_item_image_change(4)" alt="zoom" loading="lazy" onerror="setDefaultImage(this);">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-7 col-12">
						<div class="row">
							<div class="col-sm-12 col-12" style="margin-top: 5px;">
								<span class="medicine_details_item_name"></span>
							</div>
							<div class="col-sm-6 col-6 text-left">
								<span class="medicine_details_item_packing text-left"></span>
							</div>
							<div class="col-sm-6 col-6 text-right">
								<span class="medicine_details_item_batch_no"></span>
							</div>
							<div class="col-sm-6 col-6 text-left">
								<span class="medicine_details_item_margin"></span>
							</div>
							<div class="col-sm-6 col-6 text-right">
								<span class="medicine_details_item_expiry"></span>
							</div>
							<div class="col-sm-12 col-12">
								<span class="medicine_details_item_company"></span>
							</div>
							<div class="col-sm-6 col-6 text-left">
								<span class="medicine_details_item_stock"></span>
							</div>

							<div class="col-sm-6 col-6 text-right">
								<span class="medicine_details_item_scheme"></span>
							</div>
							
							<div class="col-sm-12 col-12 medicine_details_hr medicine_details_item_scheme_line text-center">
								Scheme is not added in Landing price
							</div>

							<div class="col-sm-12 col-12 medicine_details_hr medicine_details_item_description1">
							</div>

							<div class="col-sm-12 col-12 medicine_details_hr">
							</div>

							<div class="col-sm-6 col-6 text-left">
								<span class="medicine_details_item_ptr">
								</span>
							</div>
							<div class="col-sm-6 col-6 text-right">	
								<span class="medicine_details_item_mrp"></span>
							</div>
							<div class="col-sm-4 col-4 text-left">	
								<span class="medicine_details_item_gst"></span>
							</div>
							<div class="col-sm-8 col-8 text-right">
								<span class="medicine_details_item_price" title="*Approximate ~"></span>
							</div>
							<div class="col-sm-12 col-12 text-left medicine_details_hr">
								*The information given on this page is based on historical data and estimates . Please refer to the final invoice for the exact value. E&OE.
							</div>

							<div class="col-sm-12 col-12 medicine_details_hr">
							</div>

							<div class="col-sm-12 col-12 order_quantity_div">
								<div class="row">
									<div class="col-sm-5 col-4">
										<span class="medicine_details_item_order_quantity">Order quantity
										</span>
									</div>

									<div class="col-sm-7 col-8 text-right">
										<span class="medicine_details_item_total"></span>
									</div>

									<div class="col-sm-4 col-4">
										<input type="number" class="medicine_details_item_order_quantity_textbox input_type_text2" placeholder="Eg 1,2" name="quantity" required="" style="width:100px;" value="" title="Order quantity" min="1" max="1000" maxlength="4" onchange="change_item_order_quantity()" onkeyup="change_item_order_quantity()">
										<input type="hidden" class="medicine_details_item_order_quantity_hidden">
									</div>

									<div class="col-sm-8 col-8">
										<button type="submit" class="btn btn-primary main_theme_button medicine_details_item_add_to_cart_btn"  onclick="medicine_add_to_cart_api()" title="Add to cart">Add to cart</button>

										<button type="submit" class="btn btn-primary main_theme_button_disable medicine_details_item_add_to_cart_btn_disable" onclick="" title="Add to cart">Add to cart</button>
									</div>

									<div class="col-sm-12 col-12 add_to_cart_error_message text-danger text-center medicine_details_hr"></div>
								</div>
							</div>
						</div>

					</div>
					<div class="col-sm-12 col-12 medicine_details_hr medicine_details_item_description2">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ******************************************************** -->
<span class="main_page_loading text-center">
	<h2>
		<img src="<?php echo base_url(); ?>img_v51/loading.gif" width="100px">
	</h2>
	<h2>Please wait....</h2>
</span>
<!-- ******************************************************** -->
<div class="main_page_something_went_wrong text-center">
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<h2>
				<img src="<?php echo base_url(); ?>img_v51/something_went_wrong.png" width="100%">
			</h2>
		</div>
		<div class="col-sm-3"></div>
	</div>
</div>
<!-- ******************************************************** -->
<div class="main_page_no_record_found text-center">
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<h2>
				<img src="<?php echo base_url(); ?>img_v51/no_record_found.png" width="100%">
			</h2>
		</div>
		<div class="col-sm-3"></div>
	</div>
</div>

<!-- ******************************************************** -->
<div class="main_page_cart_emtpy text-center">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<h2>
				<img src="<?php echo base_url(); ?>img_v51/cart_empty.png" width="100%">
			</h2>
			<a href="<?=base_url();?>home/search_medicine" class="btn main_theme_button add_more_btn" style="margin-top:10px;"> 
				+ Add new medicine
			</a>
		</div>
		<div class="col-sm-4"></div>
	</div>
</div>

<!-- ******************************************************** -->
<div class="background_blur" onclick="clear_search_function()" style="display:none"></div>

<!-- ******************************************************** -->
<script>
function get_base_url(){
	return "<?= base_url(); ?>";
}
function get_user_altercode(){
	<?php if(!empty($_COOKIE["user_altercode"])){ ?>
		return "<?= $_COOKIE["user_altercode"] ?>";
	<?php }else {?>
		return "";
	<?php } ?>
}
var default_img = "<?= base_url(); ?>uploads/default_img.webp";
var get_page_name = "";
var order_type = "all";
</script>
<script src="<?= base_url(); ?>assets/website/easyzoom/easyzoom.js"></script>
<script src="<?= base_url(); ?>assets/website/wow_css_js/wow.js"></script>
<script src="<?= base_url(); ?>assets/js/main_page.js"></script>
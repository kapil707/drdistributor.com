<?php 
$site_v = 51;
$theme_type = "lite";
if (isset($_COOKIE["theme_type"])) {
	$theme_type = $_COOKIE["theme_type"];
}
if (!isset($_COOKIE["user_cart_total"])) {
	setcookie("user_cart_total", "0", time() + (86400 * 30), "/");
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

	<meta name="theme-color" content="#27ae60">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?= base_url(); ?>assets/website/css/font-awesome.min.css"> 
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Ottoman+Siyaq&display=swap" rel="stylesheet">
	
	<?php vp_seo(); ?>
	
	<style>
	pre {
	  overflow-x: auto;
	  white-space: pre-wrap;
	  white-space: -moz-pre-wrap;
	  white-space: -pre-wrap;
	  white-space: -o-pre-wrap;
	  word-wrap: break-word;
	}
	</style>
	<?php if($theme_type=="lite") { ?>
	<style>/*light theme*/
	:root{
		--main_theme_bg_color:#fbfbfb;
		
		--main_theme_body_text_color:#000000;
		--main_theme_color:#27ae60;
		
		--main_theme_top_menu_bar_bg:#ffffff;
		--main_theme_top_menu_bar_bg1:#ffffff;
		
		--top_icon_menu_li_bg:#e9ecef;
		--top_icon_menu_li_bg_hover:#ebebeb;
		--top_icon_menu_color:#757575;
		
		--main_theme_hearder_color:#757575;
		--main_theme_hearder_color_hover:#757575;
		
		--main_theme_footer_bg:#f6f6f6;
		--main_theme_footer_bg1:#ffffff;
		--main_theme_footer_color:#757575;
		
		--main_theme_home_pg_menu_color:#757575;
		--main_theme_home_pg_menu_color_hover:#757575;

		--heading_home_hr_line:#27ae60;
		--main_theme_box_shadow:#27ae60;
		
		--main_theme_border_color:#27ae60;
		--main_theme_border_hover_color:#757575;

		--main_theme_white_background_color:#ffffff;
		--main_theme_left_menu_bg_color:#f6f6f6;
		--main_theme_left_menu_bg_color1:#ffffff;

		--main_theme_textbox_background_color:#ffffff;
		--main_theme_textbox_text_color:#6A6767;
		
		--main_theme_scrollbar_color:#757575;
		

		--main_theme_li_color:rgb(240, 240, 240);
		--main_theme_li_bg_color:#969a9829;
		--main_theme_li_bg_hover_color:#d2d3d4;

		--main_theme_li2_color:rgb(240, 240, 240);
		--main_theme_li2_bg_color:#ffffff;
		--main_theme_li2_bg_hover_color:#27ae6029;

		--main_theme_textbox_bg_color:#ffffff;
		--main_theme_textbox_color:#6A6767;

		--main_theme_textbox2_bg_color:#ffffff;
		--main_theme_textbox2_color:#6A6767;

		--main_theme_text_white_color:#ffffff;
		--main_theme_text_black_color:#757575;

		
		--main_theme_modal_bg_color:#ffffff;

		--mainbutton-color:#27a3ae; /* #27ae60; */
		--mainbuttonhover-color:#225f64; /* #1b6339; */
		
		/************/
		--home_company_color:#30363C;
		--home_company_color_hover:#757575;
		
		--main_theme_left_right_btn:#ffffff;
		--main_theme_left_right_btn_bg:#000000;
		
		--main_theme_search_icon_color:#6a6767;

		
		--item_name_color:#27ae60; /*27ae60 */
		--item_date_time_color:#795548;
		
		--item_name_color_hover:#757575; /*27ae60 */
		--item_packing_color:#ff9800;
		--item_batch_no_color:#795548;
		--item_margin_color:#1084a1;
		--item_company_color:#3f51b5;
		--item_company2_color:#795548;
		--item_expiry_color:#981e1e;
		--item_stock_color:#1084a1;
		--item_scheme_color:#c66464;
		--item_scheme_line_color:#685c5c;
		--item_hr_line_color:#d9d9d9;

		--out_of_stock-color:#ff0a0a;

		--item_ptr_color:#795548;
		--item_mrp_color:#795548;
		--item_price_color:#6c757d;
		--item_gst_color:#965400;

		--chemist_user_name_color:#27ae60;
		--chemist_altercode_color:#795548;
		
		--item_description1_color:#685c5c;	
		--item_description2_color:#685c5c;
		--item_similar_items_color:#965400;
		

		--item_order_quantity:#685c5c;
		--item_order_quantity_bg:#e8e8e8;
	}
	</style>
	<?php } ?>

	<?php if($theme_type=="dark") { ?>
	<style>/*dark theme */
	:root{
		--main_theme_bg_color:#000; /* #041C32 */
		
		--main_theme_body_text_color:#ced4da;
		--main_theme_color:#04293A;
		
		--main_theme_footer_color:#04293A;
		
		--main_theme_top_menu_bar_bg:#383d41;
		--main_theme_top_menu_bar_bg1:#383d41;
		
		
		--top_icon_menu_li_bg:#6a6767;
		--top_icon_menu_li_bg_hover:#6a6767;
		--top_icon_menu_color:#ced4da;
		
		--main_theme_hearder_color:#ced4da;
		--main_theme_hearder_color_hover:#ced4da;
		
		--main_theme_footer_bg:#383d41;
		--main_theme_footer_bg1:#383d41;
		--main_theme_footer_color:#ced4da;
		
		--main_theme_home_pg_menu_color:#ced4da;
		--main_theme_home_pg_menu_color_hover:#ced4da;

		--heading_home_hr_line:#27ae60;
		--main_theme_box_shadow:#27ae60;
		
		--main_theme_border_color:#6A6767;
		--main_theme_border_hover_color:#6A6767;
		--main_theme_modal_bg_color:#000000; /* 474040 */

		--main_theme_white_background_color:#000000;
		--main_theme_left_menu_bg_color:#383d41;
		--main_theme_left_menu_bg_color1:#383d41;

		--main_theme_textbox_background_color:#000000;
		--main_theme_textbox_text_color:#ced4da;
		

		--main_theme_li_color:#474040;
		--main_theme_li_bg_color:#064663;
		--main_theme_li_bg_hover_color:#232020;

		--main_theme_li2_color:rgb(240, 240, 240);
		--main_theme_li2_bg_color:#27ae6000;
		--main_theme_li2_bg_hover_color:#27ae6029;

		--main_theme_textbox_bg_color:#474040;
		--main_theme_textbox_color:#ebebeb;

		--main_theme_textbox2_bg_color:#191616;
		--main_theme_textbox2_color:#ebebeb;

		--main_theme_text_white_color:#000000;
		--main_theme_text_black_color:#757575;
		

		

		--mainbutton-color:#757575; /* #27ae60; */
		--mainbuttonhover-color:#rgba(0,0,0,.5); /* #27ae60; */

		

		/************/
		--home_company_color:#ffffff;
		
		--main_theme_left_right_btn:#000000;
		--main_theme_left_right_btn_bg:#ffffff;
		
		--main_theme_search_icon_color:#ced4da;

		--item_date_time_color:#ffffff;
		--item_name_color:#ffffff; /*27ae60 */
		--item_packing_color:#ffc107;
		--item_batch_no_color:#20c997;
		--item_margin_color:#fd7e14;
		--item_company_color:#dc3545;
		--item_company2_color:#6c757d;
		--item_expiry_color:#e83e8c;
		--item_stock_color:#1084a1;
		--item_scheme_color:#c66464;
		--item_scheme_line_color:#685c5c;
		--item_hr_line_color:#d9d9d9;

		--out_of_stock-color:#ff0a0a;

		--item_ptr_color:#6c757d;
		--item_mrp_color:#6c757d;
		--item_price_color:#b6b2b2;
		--item_gst_color:#c66464;

		--chemist_user_name_color:#27ae60;
		--chemist_altercode_color:#795548;
		
		--item_description1_color:#ebebeb;	
		--item_description2_color:#ebebeb;
		--item_similar_items_color:#965400;
		

		--item_order_quantity:#ffffff;
		--item_order_quantity_bg:#ffffff;
	} 
	</style>
	<?php } ?>

	<link href="<?= base_url(); ?>assets/website/css/style<?= $site_v ?>.css" rel="stylesheet" type="text/css"/>

	<link rel="icon" href="<?= base_url(); ?>img_v<?= $site_v ?>/logo.png" type="image/logo" sizes="16x16" alt="<?= $title;?>" />
	
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
	<script src="<?= base_url(); ?>assets/js/jssor.slider-28.0.0.min.js" type="text/javascript"></script>
	<script type="text/javascript">
	window.jssor_1_slider_init = function() {

		var jssor_1_options = {
			$AutoPlay: 1,
			$SlideWidth: 700,
			$ArrowNavigatorOptions: {
			$Class: $JssorArrowNavigator$
			},
			$BulletNavigatorOptions: {
			$Class: $JssorBulletNavigator$
			}
		};

		var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

		/*#region responsive code begin*/

		var MAX_WIDTH = screen.width;

		function ScaleSlider() {
			var containerElement = jssor_1_slider.$Elmt.parentNode;
			var containerWidth = containerElement.clientWidth;

			if (containerWidth) {

				var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

				jssor_1_slider.$ScaleWidth(expectedWidth);
			}
			else {
				window.setTimeout(ScaleSlider, 30);
			}
		}

		ScaleSlider();

		$Jssor$.$AddEvent(window, "load", ScaleSlider);
		$Jssor$.$AddEvent(window, "resize", ScaleSlider);
		$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
		/*#endregion responsive code end*/
	};
	
	window.jssor_2_slider_init = function() {

		var jssor_2_options = {
			$AutoPlay: 1,
			$SlideWidth: 700,
			$ArrowNavigatorOptions: {
			$Class: $JssorArrowNavigator$
			},
			$BulletNavigatorOptions: {
			$Class: $JssorBulletNavigator$
			}
		};

		var jssor_2_slider = new $JssorSlider$("jssor_2", jssor_2_options);

		/*#region responsive code begin*/

		var MAX_WIDTH = screen.width;

		function ScaleSlider2() {
			var containerElement = jssor_2_slider.$Elmt.parentNode;
			var containerWidth = containerElement.clientWidth;

			if (containerWidth) {

				var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

				jssor_2_slider.$ScaleWidth(expectedWidth);
			}
			else {
				window.setTimeout(ScaleSlider2, 30);
			}
		}

		ScaleSlider2();

		$Jssor$.$AddEvent(window, "load", ScaleSlider2);
		$Jssor$.$AddEvent(window, "resize", ScaleSlider2);
		$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider2);
		/*#endregion responsive code end*/
	};
	</script>

	<link rel="stylesheet" href="<?= base_url(); ?>assets/website/css/min.css"/>
	<script src="<?= base_url(); ?>assets/website/js/min.js"></script>
	<style>
	.menubtn1{
		display:none;
	}
	.typewriter h1{
		animation: 
		typing 2s steps(22),
		cursor .4s step-end infinite alternate;
		
		overflow:hidden;
		width:100%;
		white-space:nowrap;
	}
	@keyframes cursor{
		50%{
			border-color:transparent;
		}
	}
	@keyframes typing{
		from{
			width:0;
		}
	}
	</style>
</head>
<body>
<?php
if(empty($chemist_id_for_cart_total))
{
	$chemist_id_for_cart_total = "";
}
$website_menu 	= $this->Chemist_Model->website_menu_json_new();
$website_menu 	= '['.$website_menu.']';
$website_menu 	= json_decode($website_menu, true);
?>
	<div class="top_menu_bar">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-xs-6 col-6" style="display: flex;">
					<div class="" style="float:left;">
						<a href="javascript:goBack()" class="menubtn2" title="Go Back">
							<i class="fa fa-chevron-left main_back_button main_icon1" aria-hidden="true"></i>
						</a>
						<a href="javascript:new_style_menu_show()" class="menubtn1" style="color:white;" title="Drd Menu">
							<img src="<?= base_url() ?>img_v<?= $site_v ?>/logo4.png" class="main_white_logo" alt="<?= $title;?>" title="<?= $title;?>">
						</a>
					</div>
					<div class="" style="float:left; margin-left:5px;width: inherit;">
						<h1 class="pro-link headertitle">
							Delivering to
						</h1>
						<div class="pro-link headertitle1">
							<?= $session_user_fname ?>
						</div>
					</div>
				</div>
				
				<div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-xs-6 col-6">
					<ul class="top_icon_menu">
						<li style="background: var(--top_icon_menu_li_bg);" class="d-none d-xl-block wow pulse animated" data-wow-delay="300ms" data-wow-iteration="infinite" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-delay: 300ms; animation-iteration-count: infinite; animation-name: pulse;">
							<a href="https://play.google.com/store/apps/details?id=com.drdistributor.dr&hl=en" target="_black" title="Download App">
								<i class="fa fa-mobile main_icon1" aria-hidden="true"></i>
								Download App
							</a>
						</li>
						<li>
							<a href="<?= base_url() ?>" title="Home">
								<i class="fa fa-home main_icon1" aria-hidden="true"></i>
								<span class="d-none d-lg-block">Home</span>
							</a>
						</li>
						<li>
							<a href="<?= base_url() ?>search_medicine" title="Search medicine / company">
								<i class="fa fa-search main_icon1" aria-hidden="true"></i>
								<span class="d-none d-lg-block">Search</span>
							</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>my_cart" class="top_menu_cart_div" title="Cart">
								<i class="fa fa-shopping-cart main_icon1" aria-hidden="true"></i>
								<span class="d-none d-lg-block">Cart</span>&nbsp;
								(<span class="header_cart_span" style=""><?= $_COOKIE["user_cart_total"]; ?></span>)
							</a>
						</li>
						<li class="d-none d-sm-block">
							<a href="javascript:new_style_menu_show()" class="mobile_off">
								<i class="fa fa-user main_icon1" aria-hidden="true"></i>
								<span class="d-none d-lg-block">Account</span>
							</a>
						</li>
						<li class="d-none d-xl-block">
							<a href="<?= base_url() ?>my_invoice" class="mobile_off" title="Notification">
								<i class="fa fa-flag main_icon1" aria-hidden="true"></i>
								Invoice
							</a>
						</li>
						<li class="d-none d-sm-block">
							<a href="<?= base_url() ?>my_notification" class="mobile_off" title="Notification">
								<i class="fa fa-bell main_icon1" aria-hidden="true"></i>
								<span class="d-none d-lg-block">Notification</span>
							</a>
						</li>
						
						<?php if(!empty($_COOKIE['user_session'])){ ?>
						<li class="d-none d-sm-block">
							<a class="mobile_off" title="Logout" href="javascript:void(0);" onclick="logout_function()">
								<i class="fa fa-sign-out main_icon1" aria-hidden="true"></i>
								<span class="d-none d-lg-block">Logout</span>
							</a>
						</li>
						<?php } ?>
					<ul>
				</div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 search_medicine_main" style="margin-top:5px;">
					<div class="row">
						<div class="col-lg-3 col-md-1 col-sm-12 col-xs-12 col-12"></div>
						<div class="col-lg-6 col-md-10 col-sm-12 col-xs-12 col-12">
							<a href="<?= base_url(); ?>home/search_medicine" title="Search medicine / company" class="home_page_search_div">
								<i class="fa fa-search search_icon1 main_icon1" aria-hidden="true"></i> <div class="my_typing">Search medicine / company...</div> 
							</a>
							
							<div class="home_page_search_div_box">
								<i class="fa fa-search textbox_search_icon" aria-hidden="true"></i>
								<input type="text" class="select_medicine search_textbox input_type_text" placeholder="Search medicine / company" tabindex="1">
								<input type="text" class="select_chemist search_textbox input_type_text" placeholder="Search chemist"  tabindex="1" />
								<i class="fa fa-list-alt menu_search_icon" aria-hidden="true" onclick="menu_search_icon()"></i>
								<i class="fa fa-times clear_search_icon" aria-hidden="true" onclick="clear_search_icon()"></i>
							</div>
							<div class="search_medicine_result"></div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<div class="home_page_search_div_box_more_btn" style="display:none">
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
				
				<div class="col-sm-12">
					<div class="top_menu_menu_main">
						<ul class="top_menu_menu">
							<?php foreach($website_menu as $row) { ?>
							<li>
								<?php /*<a href="<?= base_url();?>home/medicine_category/medicine_category/<?= $row["item_code"] ?>">*/ ?>
								<a href="<?= base_url();?>category/<?= str_replace(" ","-",strtolower($row["item_company"])); ?>">
									<span>
									<?= ($row["item_company"]) ?>
									</span>
								</a>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>

				<div class="col-sm-12 current_order_search_page" style="display:none;">
					<span class="header_result_found"></span>
				</div>

				<div class="col-sm-3 col-3 current_order_cart_page account_page_header" style="margin-top:10px;display:none;">
					<img src="<?= $session_user_image ?>" alt="<?= $session_user_fname ?>" title="<?= $session_user_fname ?>" class="rounded account_page_header_image" onerror=this.src="<?= base_url(); ?>img_v<?= $site_v ?>/logo.png">
				</div>
			</div>
		</div>
	</div>

	<img src="<?= base_url(); ?>img_v<?= $site_v ?>/logo.png" style="display:none" alt="<?= $title;?>">
	<div class="left_menu_bar">
		<div class="left_menu_bar_part1">
			<div class="row">
				<div class="col-sm-2 col-4">
					<img src="<?= $session_user_image ?>" alt="<?= $session_user_fname ?>" title="<?= $session_user_fname ?>" class="left_menu_bar_account_image" onerror=this.src="<?= base_url(); ?>img_v<?= $site_v ?>/logo.png">
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
					<i class="fa fa-times left_menu_bar_cancel" aria-hidden="true" onclick="new_style_menu_hide()"></i>
				</div>
				<div class="col-sm-12 col-12">
					<div class="text-left" style="margin-left: 10px;margin-top: 10px;border-bottom: 1px solid var(--main_theme_border_color);font-size: 20px;">Select theme</div>
					<select class="input_type_text2 theme_set_css" onchange="theme_set()" style="margin-top:10px;">
						<option value="lite" <?php if($theme_type=="lite") { echo "selected"; } ?>>Lite</option>
						<option value="dark" <?php if($theme_type=="dark") { echo "selected"; } ?>>Dark</option>
					</select>
				</div>
			</div>
		</div>
		<div class="left_menu_bar_part2 text-center">
			<div class="social-icon">
			<div class="text-left" style="margin-left: 10px;margin-top: 10px;border-bottom: 1px solid var(--main_theme_border_color);font-size: 20px;">Account</div>
				<ul>
					<li>
						<a href="<?= base_url('home/account')?>" title="Account">
							<i class="fa fa-user left_menu_icon" aria-hidden="true"></i> Account
						</a>
					</li>
					<li>
						<a href="<?= base_url('home/change_account')?>" title="Update account">
							<i class="fa fa-pencil-square left_menu_icon" aria-hidden="true"></i>
							Update account
						</a>
					</li>
					<li>
						<a href="<?= base_url('home/change_image')?>" title="Update image">
							<i class="fa fa-camera left_menu_icon" aria-hidden="true"></i> Update image
						</a>
					</li>
					<li>
						<a href="<?= base_url('home/change_password')?>" title="Update password">
						<i class="fa fa-key left_menu_icon" aria-hidden="true"></i>
						Update password
						</a>
					</li>
					<li class="mobile_off">
						<a href="<?= base_url('import_order/medicine_suggest')?>" title="Update suggest medicine">
							<i class="fa fa-thumbs-up left_menu_icon" aria-hidden="true"></i> Update suggest medicine
						</a>
					</li>
					<?php
					if(!empty($_COOKIE['user_type'])){
					if($_COOKIE['user_type']=="sales")
					{
						$user_type = $_COOKIE['user_type'];
						?>
					<div class="text-left" style="margin-left: 10px;margin-top: 10px;border-bottom: 1px solid var(--main_theme_border_color);font-size: 20px;">Server Report</div>

					<li>
						<a href="http://192.168.0.100:7272/drd_local_server/pendingorder_report" title="Pending Order" target="_black">
							<img class="img-circle" src="<?= base_url() ?>img_v<?= $site_v ?>/privacy_policy.png" width="20" alt="Pending Order" title="Pending Order">
							Pending Order
						</a>
					</li>

					<li>
						<a href="http://192.168.0.100:7272/drd_local_server/drd_today_invoice" title="All Invoice" target="_black">
							<img class="img-circle" src="<?= base_url() ?>img_v<?= $site_v ?>/privacy_policy.png" width="20" alt="All Invoice" title="All Invoice">
							All Invoice
						</a>
					</li>
					
					<li>
						<a href="http://192.168.0.100:7272/drd_local_server/child_invoice/pickedby" title="Pickedby Invoice" target="_black">
							<img class="img-circle" src="<?= base_url() ?>img_v<?= $site_v ?>/privacy_policy.png" width="20" alt="Pickedby Invoice" title="Pickedby Invoice">
							Pickedby Invoice
						</a>
					</li>
					
					<li>
						<a href="http://192.168.0.100:7272/drd_local_server/child_invoice/pickedby" title="Deliverby Invoice" target="_black">
							<img class="img-circle" src="<?= base_url() ?>img_v<?= $site_v ?>/privacy_policy.png" width="20" alt="Deliverby Invoice" title="Deliverby Invoice">
							Deliverby Invoice
						</a>
					</li>
					
					<li>
						<a href="http://192.168.0.100:7272/drd_local_server/delivery_report" title="Delivery Report" target="_black">
							<img class="img-circle" src="<?= base_url() ?>img_v<?= $site_v ?>/privacy_policy.png" width="20" alt="Delivery Report" title="Delivery Report">
							Delivery Report
						</a>
					</li>
					<?php } }?>
					<div class="text-left" style="margin-left: 10px;margin-top: 10px;border-bottom: 1px solid var(--main_theme_border_color);font-size: 20px;">Others</div>
					<li>
						<a href="tel:+919899133989" title="Contact us">
							<i class="fa fa-phone-square left_menu_icon" aria-hidden="true"></i> Contact us
						</a>
					</li>
					<li title="Email">
						<a href="mailto:vipul@drdindia.com" title="Email">
							<i class="fa fa-envelope left_menu_icon" aria-hidden="true"></i> Email
						</a>
					</li>
					<li title="Privacy policy">
						<a href="<?= base_url('user/privacy_policy')?>" title="Privacy policy">
							<i class="fa fa-book left_menu_icon" aria-hidden="true"></i>
							Privacy policy
						</a>
					</li>
					<li title="Share App">
						<a href="https://play.google.com/store/apps/details?id=com.drdistributor.dr&hl=en" target="_black" title="Share App">
							<i class="fa fa-share-alt-square left_menu_icon" aria-hidden="true"></i>
							Share App
						</a>
					</li>
					<li title="Download App">
						<a href="https://play.google.com/store/apps/details?id=com.drdistributor.dr&hl=en" target="_black" title="Download App">
							<i class="fa fa-mobile left_menu_icon" aria-hidden="true"></i>
							Download App
						</a>
					</li>
					<?php if(!empty($_COOKIE['user_session'])){ ?>
					<li title="Logout">
						<a title="Logout" href="javascript:void(0);" onclick="logout_function()">
							<i class="fa fa-sign-out left_menu_icon" aria-hidden="true"></i>
							Logout
						</a>
					</li>
					<?php } else { ?>
					<li title="Login">
						<a href="<?= base_url('login')?>" title="Login">
							<i class="fa fa-sign-out left_menu_icon" aria-hidden="true"></i>
							Login
						</a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>				
	</div>
			
			
	

<script>
function theme_set()
{
	theme_set_css = $(".theme_set_css").val()
	$.ajax({
		type       : "POST",
		data       :  { theme_set_css:theme_set_css} ,
		url        : "<?php echo base_url(); ?>Chemist_json/theme_set",
		cache	   : true,
		success : function(data){
			if(data!="")
			{
				$.each(data.items, function(i,item){	
					if (item){
						location.reload();
					}
				});	
			}
		},
	});
}

function callandroidfun(funtype,id,compname,image,division) {	
	if(funtype=="1"){
		//android.fun_Get_single_medicine_info(id);
		get_single_medicine_info(id);
	}
	if(funtype=="2")
	{
		window.location.href = '<?= base_url(); ?>home/medicine_category/featured_brand/'+id+'/'+division;
	}
}
function gosearchpage()
{
	window.location.href = "<?= base_url();?>home/search_medicine";
}
function check_login_function()
{
	$(".small_noti_box").hide(500);
	id ='';
	$.ajax({
		type       : "POST",
		data       :  { id:id} ,
		url        : "<?php echo base_url(); ?>Chemist_json/check_login_function",
		cache	   : true,
		success : function(data){
			if(data!="")
			{
				$.each(data.items, function(i,item){	
					if (item){
						
						if(item.download_invoice_url!="")
						{
							download_invoice(item.download_invoice_url)
						}

						if(item.noti_id!="")
						{
							$(".small_noti_box").show(500);
							$(".small_noti_box_data").html("<b>"+item.noti_title+"</b>"+"<p>"+item.noti_message+"</p>");
						}

						/*if(item.status=="0")
						{
							window.location.href = "<?= base_url();?>user/logout2";
						}*/

						/*notiid		= (item.notiid);
						broadcastid = (item.broadcastid);
						if(notiid!=""){
							notititle 	= atob(item.notititle);
							notibody 	= atob(item.notibody);
							$(".only_for_noti").append('<li class="only_for_noti_li notiid_'+notiid+'"><div class="notititle">'+notititle+'</div><div class="notibody">'+notibody+'</div></li>');						
							setTimeout('$(".notiid_"+notiid).hide()',10000);
						}
						if(broadcastid!=""){
							broadcasttitle 		= atob(item.broadcasttitle);
							broadcastmessage 	= atob(item.broadcastmessage);
							$('.broadcast_title').html(broadcasttitle);
							$('.broadcast_message').html(broadcastmessage);
							$('.myModal_broadcast').click();
						}
						if(item.count!="")
						{
							//$(".notificationdiv").html("("+item.count+")");
							if(item.count=="0")
							{
								$(".cssnotification").show();
								$(".cssnotification1").hide();
							}
							else
							{
								$(".cssnotification").hide();
								$(".cssnotification1").show();
							}
						}*/
					}
				});	
			}
		},
		timeout: 10000
	});
	setTimeout('check_login_function();',60000);
}
function clear_small_noti(){
	$(".small_noti_box").hide(500);
}
$(document).ready(function(){
	//setTimeout('count_temp_rec();',500);
	//setTimeout('check_login_function();',6000);

	$('.medicine_details_item_order_quantity_textbox').keypress(function (e) {
		if (e.which == 13) {
			medicine_add_to_cart_api();
		} 
	});
});

function get_single_medicine_info(item_code)
{
	var session_user_altercode = "<?= $_COOKIE["user_altercode"] ?>";
	if(session_user_altercode=="" || session_user_altercode==null)
	{
		window.location.href = "<?=base_url(); ?>home";
	} else 
	{
		$('.myModal_medicine_details').click();
		$(".medicine_details_api_loading").show();
		$(".medicine_details_api_data").hide();
		$(".medicine_details_item_description1").hide();
		$(".medicine_details_item_description2").hide();

		$(".medicine_details_item_order_quantity_textbox").val("");
		medicine_details_api(item_code);
	}
}

function medicine_details_api(item_code)
{
	$('.medicine_details_item_add_to_cart_btn').html("Add to cart");
	$('.medicine_details_item_add_to_cart_btn_loading').hide();

	item_date_time = item_batch_no = item_gst = item_description2 = "";

	$.ajax({
		url: "<?php echo base_url(); ?>medicine_details/medicine_details_api",
		type:"POST",
		dataType: 'json',
		data: {item_code:item_code},
		error: function(){
			
		},
		success: function(data){
			$.each(data.items, function(i,item){	
				if (item)
				{
					item_date_time	= item.item_date_time;
					$(".medicine_details_item_date_time").html("as on " + item_date_time)

					item_batch_no	= item.item_batch_no;
					$(".medicine_details_item_batch_no").html("Batch no : "+item_batch_no)

					item_gst	= item.item_gst;
					$(".medicine_details_item_gst").html("GST : "+item_gst +"%")

					item_image	= item.item_image;
					$(".medicine_details_image").attr("src",item_image)
					$(".example-image-link").attr("href",item_image)
					$(".example-image-link").attr("data-standard",item_image)
					var $easyzoom = $('.easyzoom').easyZoom();
							/*
					// Setup thumbnails example
					var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

					/*$('.thumbnails').on('click', 'a', function(e) {
						var $this = $(this);

						e.preventDefault();

						// Use EasyZoom's `swap` method
						api1.swap($this.data('standard'), item_image);
					});*/


					item_image	= item.item_image;
					$(".modal_item_image_change1").attr("src",item_image)
					item_image2	= item.item_image2;
					$(".modal_item_image_change2").attr("src",item_image2)
					item_image3	= item.item_image3;
					$(".modal_item_image_change3").attr("src",item_image3)
					item_image4	= item.item_image4;
					$(".modal_item_image_change4").attr("src",item_image4)					

					$(".medicine_details_item_description2").show()
					item_description2	= item.item_description2;
					$(".medicine_details_item_description2").html(item_description2)
					if(item_description2=="")
					{
						$(".medicine_details_item_description2").hide()
					}

					item_order_quantity	= item.item_order_quantity;
					$(".medicine_details_item_order_quantity_textbox").val(item_order_quantity)
					if(item_order_quantity!=""){
						$('.medicine_details_item_add_to_cart_btn').html("Update cart");
					}

					item_name		= item.item_name;
					item_packing	= item.item_packing;
					item_expiry		= item.item_expiry;
					item_company	= item.item_company;
					item_quantity	= item.item_quantity;
					item_stock		= item.item_stock;
					item_ptr		= item.item_ptr;
					item_mrp		= item.item_mrp;
					item_price		= item.item_price;
					item_scheme		= item.item_scheme;
					item_margin		= item.item_margin;
					item_featured	= item.item_featured;
					item_description1= item.item_description1;
					
					
					insert_top_search(item_code,item_name,item_packing) // firebase code
					medicine_details_api_data(item_code)	
					
					item_image	= item.item_image;
					$(".medicine_details_image").attr("src",item_image)
					item_image	= item.item_image;
					$(".modal_item_image_change1").attr("src",item_image)
					item_image2	= item.item_image2;
					$(".modal_item_image_change2").attr("src",item_image2)
					item_image3	= item.item_image3;
					$(".modal_item_image_change3").attr("src",item_image3)
					item_image4	= item.item_image4;
					$(".modal_item_image_change4").attr("src",item_image4)
				}
			});	
		},
		timeout: 10000
	});
}

// start new code for fast open modal
function medicine_details_funcation(item_code)
{	
	var session_user_altercode = "<?= $_COOKIE["user_altercode"] ?>";
	if(session_user_altercode=="" || session_user_altercode==null)
	{
		window.location.href = "<?=base_url(); ?>home";
	} else 
	{
		$(".medicine_details_item_order_quantity_textbox").val("");
		$(".medicine_details_item_order_quantity_textbox").focus();
		
		medicine_details_get(item_code);
		setTimeout(medicine_details_api(item_code),500);// its on header page

		$('.search_textbox').val("");
		$(".search_medicine_result").html("");
		$(".myModal_medicine_details").click();
	}
}
// end new code for fast open modal 

function medicine_details_get(item_code)
{	
	item_image = $(".medicine_details_all_data_"+item_code).attr("item_image")
	item_name = $(".medicine_details_all_data_"+item_code).attr("item_name")
	item_packing = $(".medicine_details_all_data_"+item_code).attr("item_packing")
	item_expiry = $(".medicine_details_all_data_"+item_code).attr("item_expiry")
	item_company = $(".medicine_details_all_data_"+item_code).attr("item_company")
	item_quantity = $(".medicine_details_all_data_"+item_code).attr("item_quantity")
	item_stock = $(".medicine_details_all_data_"+item_code).attr("item_stock")
	item_ptr = $(".medicine_details_all_data_"+item_code).attr("item_ptr")
	item_mrp = $(".medicine_details_all_data_"+item_code).attr("item_mrp")
	item_price = $(".medicine_details_all_data_"+item_code).attr("item_price")
	item_scheme = $(".medicine_details_all_data_"+item_code).attr("item_scheme")
	item_margin = $(".medicine_details_all_data_"+item_code).attr("item_margin")
	item_featured = $(".medicine_details_all_data_"+item_code).attr("item_featured")
	item_description1 = $(".medicine_details_all_data_"+item_code).attr("item_description1")
	item_order_quantity = $(".medicine_details_all_data_"+item_code).attr("item_order_quantity")
	
	item_date_time = item_batch_no = item_gst = item_description2 = "";
	$(".medicine_details_item_date_time").html("Loading....")
	$(".medicine_details_item_batch_no").html("")
	$(".medicine_details_item_gst").html("")
	$(".medicine_details_item_description2").html("")

	medicine_details_api_data(item_code) // its on header page
}

function medicine_details_api_data(item_code)
{
	$(".medicine_details_api_loading").hide();
	$(".medicine_details_api_data").show();

	/***********************important ************************/
	$('.medicine_details_item_code').val(item_code);
	/********************************************************/

	$(".medicine_details_item_add_to_cart_btn").hide()
	$(".medicine_details_item_add_to_cart_btn_disable").hide()
	$('.medicine_details_item_add_to_cart_btn_loading').hide()

	$(".medicine_details_featured_img").hide()
	$(".medicine_details_out_of_stock_img").hide()	

	$(".medicine_details_image").attr("src",item_image)
	$(".medicine_details_image_small").attr("src",item_image)

	$(".medicine_details_item_name").html(item_name)
	$(".medicine_details_item_packing").html("Packing : "+item_packing)
	$(".medicine_details_item_batch_no").html("Batch no : "+item_batch_no)

	$(".medicine_details_item_margin").html(item_margin+'% Margin*')
	$(".medicine_details_item_expiry").html("Expiry : "+item_expiry)
	$(".medicine_details_item_company").html("By "+item_company)
	$(".medicine_details_item_stock").html("Stock : " +item_quantity)
	$(".medicine_details_item_scheme").html("Scheme : " +item_scheme)

	$(".medicine_details_item_description1").html(item_description1)
	$(".medicine_details_item_description1").show()
	if(item_description1=="")
	{
		$(".medicine_details_item_description1").hide()
	}

	$(".medicine_details_item_ptr").html('PTR : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_ptr + "/-")
	$(".medicine_details_item_mrp").html('MRP : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_mrp + "/-")
	$(".medicine_details_item_gst").html("GST : "+item_gst +"%")
	$(".medicine_details_item_price").html('*Approximate Value ~ : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_price + "/-")

	$(".medicine_details_item_scheme_line").show()
	$(".medicine_details_item_scheme").show()
	if(item_scheme=="0+0")
	{
		$(".medicine_details_out_of_stock_img").hide()
		$(".medicine_details_item_scheme_line").hide()
		$(".medicine_details_item_scheme").hide()
	}

	if(item_featured=="1" && item_quantity!="0"){
		$(".medicine_details_featured_img").show()
	}

	if(parseInt(item_quantity)==0){
		
		$(".medicine_details_item_add_to_cart_btn_disable").show()
		$(".medicine_details_item_stock").html("<font color=red>Out of stock</font>")

		$(".medicine_details_out_of_stock_img").show()
		$(".medicine_details_item_scheme").hide()
		$(".medicine_details_item_scheme_line").hide()
	}else{
		$(".medicine_details_item_add_to_cart_btn").show()
	}

	if(item_stock!="")
	{
		$(".medicine_details_item_stock").html(item_stock)
	}

	$(".medicine_details_item_quantity").val(item_quantity)
	if(item_order_quantity){
		$(".medicine_details_item_order_quantity_textbox").val(item_order_quantity)
	}
	$(".medicine_details_item_order_quantity_textbox").focus()
}

function modal_item_image_change(_id)
{
	modal_item_image_change_url = $(".modal_item_image_change"+_id).attr("src");
	$(".modal_item_image_change").attr("src",modal_item_image_change_url);
	$(".example-image-link").attr("href",modal_item_image_change_url)
	$(".example-image-link").attr("data-standard",modal_item_image_change_url)
	
	$(".easyzoom-flyout img").attr("src",modal_item_image_change_url)
}

function medicine_add_to_cart_api()
{
	<?php 
	if(!empty($page_cart)) {
		if($page_cart=="1") { ?>
			setTimeout(function() {
				$(".edit_item_focues"+i_code).focus();
			}, 2000);
		<?php 
		} 
	}?>	

	item_quantity		= $(".medicine_details_item_quantity").val();
	item_order_quantity	= $(".medicine_details_item_order_quantity_textbox").val();
	item_code			= $(".medicine_details_item_code").val();

	if(item_order_quantity=="")
	{
		swal("Enter quantity");
		$(".medicine_details_item_order_quantity_textbox").val("");
		$(".medicine_details_item_order_quantity_textbox").focus();
	}
	else
	{
		item_order_quantity = parseInt(item_order_quantity);
		item_quantity		= parseInt(item_quantity);
		if(item_order_quantity!=0)
		{
			if(item_order_quantity<=item_quantity)
			{
				$(".medicine_details_item_add_to_cart_btn").hide()
				$(".medicine_details_item_add_to_cart_btn_disable").hide()

				$('.medicine_details_item_add_to_cart_btn_loading').show();

				$(".modaloff").click();
				$(".search_textbox").focus();
				
				$.ajax({
					type       : "POST",
					data       : {item_code:item_code,item_order_quantity:item_order_quantity},
					url        : "<?php echo base_url(); ?>my_cart/medicine_add_to_cart_api",
					cache	   : true,
					error: function(){
						swal("error add to cart")
					},
					success    : function(data){
						medicine_cart_list();
					},
					timeout: 10000
				});
			}
			else
			{
				swal("Enter a valid quantity");
			}
		}
		else{
			swal("Enter quantity one or more than one");
		}
	}
}

</script>
<div class="select_medicine_in_modal_script_css"></div>
<div class="only_for_noti"></div>

<input type="hidden" class="medicine_details_item_code">
<div type="hidden" class="medicine_details_all_data"></div>
<a href="#" data-toggle="modal" data-target="#myModal_medicine_details" style="text-decoration: none;" class="myModal_medicine_details"></a>
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
			<div class="medicine_details_item_date_time" style="">Loading....</div>
			<div class="medicine_details_api_loading text-center" style="display:none">
				<div>
					<img src="<?= base_url(); ?>/img_v<?= $site_v ?>/loading.gif" width="100px" alt="loading">
				</div>
				<div>Loading....</div>
			</div>
			<div class="row medicine_details_api_data" style="display:none">
				<div class="col-sm-5 col-12">

					<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
						<a class="example-image-link" data-standard="">
						<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="100%" style="float: right;margin-top:10px;" class="medicine_details_image modal_item_image_change" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
						</a>
					</div>
					
					<img src="<?= base_url(); ?>/img_v<?= $site_v ?>/featured_img.png" width="100" style="position: absolute;margin-top:10px;display:none;left: 15px;" alt="zoom" class="medicine_details_featured_img" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>

					<img src="<?= base_url(); ?>/img_v<?= $site_v ?>/out_of_stock_img.png" width="100" style="position: absolute;margin-top:10px;display:none;left: 15px;" alt="zoom" class="medicine_details_out_of_stock_img" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
					
					<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;margin-right: 6.6%;" class="medicine_details_image_small modal_item_image_change1" onclick="modal_item_image_change(1)" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>

					<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;margin-right: 6.6%;" class="medicine_details_image_small modal_item_image_change2" onclick="modal_item_image_change(2)" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>

					<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;margin-right: 6.6%;" class="medicine_details_image_small modal_item_image_change3" onclick="modal_item_image_change(3)" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>

					<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;" class="medicine_details_image_small modal_item_image_change4" onclick="modal_item_image_change(4)" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
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
						<div class="col-sm-4 col-5 text-left">	
							<span class="medicine_details_item_gst"></span>
						</div>
						<div class="col-sm-8 col-7 text-right">
							<span class="medicine_details_item_price" title="*Approximate value ~"></span>
						</div>
						<div class="col-sm-12 col-12 text-left">
						*The information given on this page is based on historical data and estimates . Please refer to the final invoice for the exact value. E&OE.
						</div>

						<div class="col-sm-12 col-12 medicine_details_hr">
						</div>

						<div class="col-sm-12 col-12">
							<span class="medicine_details_item_order_quantity" style="width:50%;float:left;margin-top:5px;">Order quantity
							</span>
							
							<span class="text-right" style="width:50%;float:left;margin-top:5px;">

								<input type="number" class="medicine_details_item_order_quantity_textbox" placeholder="Eg 1,2" name="quantity" required="" style="width:100px;float:right;" value="" title="Enter quantity" min="1" max="1000">

								<input type="hidden" class="medicine_details_item_quantity">
							</span>
						</div>

						<div class="col-sm-12 col-12 medicine_details_hr">
						</div>

						<div class="col-sm-12 col-12">
							<button type="submit" class="btn btn-primary mainbutton medicine_details_item_add_to_cart_btn"  onclick="medicine_add_to_cart_api()" title="Add to cart">Add to cart</button>

							<button type="submit" class="btn btn-primary mainbutton_disable medicine_details_item_add_to_cart_btn_disable" onclick="" title="Add to cart">Add to cart</button>

							<div class="medicine_details_item_add_to_cart_btn_loading text-center" style="display:none">
								<button type="submit" class="btn btn-primary mainbutton_disable" onclick="" title="Loading....">Loading....</button>
							</div>
						</div>

						<div class="col-sm-12 col-12 medicine_details_hr">
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-12 medicine_details_hr medicine_details_item_description2">
			</div>

			<div class="col-sm-12 col-12 medicine_details_hr">
			</div>
			</div>
		</div>
	</div>
</div>

<a href="#" data-toggle="modal" data-target="#myModal_loading" style="text-decoration: none;" class="myModal_loading"></a>
<div class="modal modaloff" id="myModal_loading">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title MedicineDetailscssmod">Medicine details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="MedicineDetailsData"></div>				
				<div class="MedicineSmilerProduct"></div>
			</div>
		</div>
	</div>
</div>
<?php /***************************broadcast**************************************/ ?>
<a href="#" data-toggle="modal" data-target="#myModal_broadcast" style="text-decoration: none;" class="myModal_broadcast"></a>
<div class="modal modaloff" id="myModal_broadcast">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title broadcast_title">
					<?= $this->Scheme_Model->get_website_data("broadcast_title"); ?>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body broadcast_message">
				<pre><p><?= $this->Scheme_Model->get_website_data("broadcast_message"); ?></p></pre>
			</div>
		</div>
	</div>
</div>
<?php
$broadcast_status = $this->Scheme_Model->get_website_data("broadcast_status");
if($broadcast_status=="1"){ ?>
	<script>
	setTimeout(function() {
        $('.myModal_broadcast').click();
    }, 3000);
	</script>
	<?php
}
?>

<script>
function new_style_menu_show()
{
	$(".left_menu_bar").show(500);
}
function new_style_menu_hide()
{
	$(".left_menu_bar").hide(500);
}
function logout_function(){
	swal({
		title: "Are you sure to Logout?",
		/*text: "Once deleted, you will not be able to recover this imaginary file!",*/
		icon: "warning",
		buttons: ["No", "Yes"],
		dangerMode: true,
	}).then(function(result) {
		if (result) 
		{
			window.location.href = "<?= base_url('logout')?>"
		} 
	});
}
</script>

<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-database.js"></script>
<script>
// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
/*var  firebaseConfig = {
apiKey: "AIzaSyBovCE4GE71WoWlK5KcWXZl7WZjGVUiQiM",
authDomain: "drd-web-firebase-db.firebaseapp.com",
databaseURL: "https://drd-web-firebase-db-default-rtdb.firebaseio.com",
projectId: "drd-web-firebase-db",
storageBucket: "drd-web-firebase-db.appspot.com",
messagingSenderId: "810227054981",
appId: "1:810227054981:web:b4a453038af2a21c71acec",
measurementId: "G-MN55NJJGBX"
};*/

var  firebaseConfig = {
apiKey: "AIzaSyBPkM-zLmMQbHGE_Ye1qOsBl6IhROvu6RU",
authDomain: "drd-noti-fire-base.appspot.com",
databaseURL: "https://drd-noti-fire-base.firebaseio.com",
projectId: "drd-noti-fire-base",
storageBucket: "drd-web-firebase-db.appspot.com",
messagingSenderId: "504935735685",
appId: "1:504935735685:android:a2d0ae89504ba935f5e4ec"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
// Set database variable
var database = firebase.database()
function insert_users_live()
{
	var todayDateTime = new Date().toLocaleString("en-US", {timeZone: "Asia/Kolkata"});
	var m 	= new Date(todayDateTime)
	year 	= m.getFullYear()
	month 	= change_dt_format(m.getMonth()+1);
	day 	= change_dt_format(m.getDate());
	hours 	= change_dt_format(m.getHours());
	minutes = change_dt_format(m.getMinutes());
	var dateString = year +"-"+ (month) +"-"+ day;
	var timeString = hours + ":" + minutes;

	database.ref('chemist_online/<?php echo $this->session->userdata('user_altercode'); ?>').set({
		user_altercode : '<?php echo $this->session->userdata('user_altercode'); ?>',
		user_date : dateString,
		user_time : timeString,
		value : "web"
	})

	/*var chemist_onlineRef = firebase.database().ref("chemist_online/");
	chemist_onlineRef.ref ({
		'<?php echo $this->session->userdata('user_altercode'); ?>' : {
			user_time : '<?php echo date("H:i"); ?>',
			user_date : '<?php echo date("d-m-Y"); ?>'
		}
	});*/

	/*let today = new Date();
	let m = today.toLocaleString("en-US", "Asia/Delhi");
	//var dateString = m.getUTCFullYear() +"/"+ (m.getUTCMonth()+1) +"/"+ m.getUTCDate() + " " + m.getUTCHours() + ":" + m.getUTCMinutes() + ":" + m.getUTCSeconds();

	var dateString = m.getUTCFullYear() +"-"+ (m.getUTCMonth()+1) +"-"+ m.getUTCDate();
	var timeString = m.getUTCHours() + ":" + m.getUTCMinutes();

	database.ref('chemist_online/<?php echo $this->session->userdata('user_altercode'); ?>').set({
		user_altercode : '<?php echo $this->session->userdata('user_altercode'); ?>',
		user_time : timeString,
		user_date : dateString
	})*/
	setTimeout(function() { insert_users_live() }, 30000);
}
<?php if($this->session->userdata('user_type')!="") { ?>
insert_users_live();
insert_open_page();
<?php } ?>
function change_dt_format(dt)
{
	if(dt==1)
	{
		dt = "01"
	}
	if(dt==2)
	{
		dt = "02"
	}
	if(dt==3)
	{
		dt = "03"
	}
	if(dt==4)
	{
		dt = "04"
	}
	if(dt==5)
	{
		dt = "05"
	}
	if(dt==6)
	{
		dt = "06"
	}
	if(dt==7)
	{
		dt = "07"
	}
	if(dt==8)
	{
		dt = "08"
	}
	if(dt==9)
	{
		dt = "09"
	}
	return dt;
}
function insert_open_page()
{
	var todayDateTime = new Date().toLocaleString("en-US", {timeZone: "Asia/Kolkata"});
	var m 	= new Date(todayDateTime)
	year 	= m.getFullYear()
	month 	= change_dt_format(m.getMonth()+1);
	day 	= change_dt_format(m.getDate());
	hours 	= change_dt_format(m.getHours());
	minutes = change_dt_format(m.getMinutes());
	var dateString = year +"-"+ (month) +"-"+ day;
	var timeString = hours + ":" + minutes;

	database.ref('chemist_open_page/'+dateString+'/<?php echo $this->session->userdata('user_altercode'); ?>').push({
		user_altercode : '<?php echo $this->session->userdata('user_altercode'); ?>',
		page_url : '<?php echo $_SERVER['HTTP_REFERER']; ?>',
		user_date : dateString,
		user_time : timeString,
		value : "web"
	})
}

function insert_top_search(item_code,item_name,item_packing)
{
	var todayDateTime = new Date().toLocaleString("en-US", {timeZone: "Asia/Kolkata"});
	var m 	= new Date(todayDateTime)
	year 	= m.getFullYear()
	month 	= change_dt_format(m.getMonth()+1);
	day 	= change_dt_format(m.getDate());
	hours 	= change_dt_format(m.getHours());
	minutes = change_dt_format(m.getMinutes());
	var dateString = year +"-"+ (month) +"-"+ day;
	var timeString = hours + ":" + minutes;

	database.ref('chemist_top_search/'+dateString+'/<?php echo $this->session->userdata('user_altercode'); ?>').push({
		user_altercode : '<?php echo $this->session->userdata('user_altercode'); ?>',
		item_code : item_code,
		item_name : item_name,
		item_packing : item_packing,
		user_date : dateString,
		user_time : timeString,
		value : "web"
	})
}

</script>
<link rel="stylesheet" href="<?= base_url(); ?>assets/website/easyzoom/easyzoom.css" />
<script src="<?= base_url(); ?>assets/website/easyzoom/easyzoom.js"></script>
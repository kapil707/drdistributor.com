<?php 
$site_v = 51;
$theme_type = "lite";
if (isset($_COOKIE["theme_type"])) {
	$theme_type = $_COOKIE["theme_type"];
}
if (!isset($_COOKIE["user_cart_total"])) {
	setcookie("user_cart_total", "0", time() + (86400 * 30), "/");
	$_COOKIE["user_cart_total"] = 0;
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
								<span class="d-none d-lg-block"> Cart</span>&nbsp;
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

<script>
var bas_url = "<?=base_url(); ?>";
var session_user_altercode = "<?= $_COOKIE["user_altercode"] ?>";
</script>
<script src="<?= base_url(); ?>assets/js/mainsite.js"></script>

<link rel="stylesheet" href="<?= base_url(); ?>assets/website/easyzoom/easyzoom.css" />
<script src="<?= base_url(); ?>assets/website/easyzoom/easyzoom.js"></script>
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
		<?= $title = $siteTitle; ?>
	</title>
	
	<meta name="msapplication-tap-highlight" content="no" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="canonical" href="<?php echo $this->appconfig->getWeburl(); ?>" />

	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	
	<link rel="stylesheet" href="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/css/bootstrap.min.css">

	<!-- <script src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/js/jquery.min.js"></script> -->

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
	<!-- <script src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/js/bootstrap.min.js"></script> -->

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/css/font-awesome.min.css"> 
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Ottoman+Siyaq&display=swap" rel="stylesheet">
	
	<?php vp_seo(); ?>
	
	<?php if($theme_type=="lite") { ?>
		<meta name="theme-color" content="#27ae60">
		<link href="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/css/style-light.css" rel="stylesheet" type="text/css"/>
	<?php } ?>

	<?php if($theme_type=="dark") { ?>
		<meta name="theme-color" content="#373d40">
		<link href="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/css/style-dark.css" rel="stylesheet" type="text/css"/>
	<?php } ?>

	<link href="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/css/style.css" rel="stylesheet" type="text/css" />

	<link href="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/easyzoom/easyzoom.css" rel="stylesheet" type="text/css" />

	<link rel="icon" href="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/images/logo4.png" type="image/logo" sizes="16x16" alt="<?= $title;?>" />
	
	<script src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/js/sweetalert.min.js"></script>

	<link href="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/css/min.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div class="top_bar">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-6 col-6 web-col-padding-5" style="display: flex;">
				<div class="" style="float:left;">
					<a href="javascript:new_style_menu_show()" class="top_bar_logo" style="color:white;" title="Drd Menu">
						<img src="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/images/logo4.png" alt="<?= $title;?>" title="<?= $title;?>">
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
						Code : <?= $DeliveringTo ?>
					</div>
				</div>
			</div>
			
			<div class="col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-6 col-6 web-col-padding-5">
				<ul class="top_bar_menu">
					<li class="d-none d-sm-block">
						<?php if(!empty($UserType)){ ?>
							<a href="<?= base_url() ?>" title="Home">
						<?php } else { ?>
							<a href="<?= base_url() ?>home" title="Home">
						<?php } ?>
							<i class="fa fa-home" aria-hidden="true"></i>
							<span class="d-none d-xl-block">Home</span>
						</a>
					</li>
					
					<li class="d-none d-sm-block">
						<a href="<?= base_url() ?>ms" title="Search medicine / company">
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
						<a href="<?= base_url(); ?>mc" class="top_menu_cart_div" title="My cart">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
							<span class="d-none d-xxxl-block">My&nbsp;</span>
							<span class="d-none d-xl-block">Cart&nbsp;</span>
							(<span class="top_bar_menu_cart_span">0</span>)
						</a>
					</li>

					<li class="d-none d-lg-block">
						<a href="<?= base_url() ?>mo" class="mobile_off" title="My order">
							<i class="fa fa-newspaper-o" aria-hidden="true"></i> 
							<span class="d-none d-xxxl-block">My&nbsp;</span>
							<span>Order</span>
						</a>
					</li>					

					<li class="d-none d-lg-block">
						<a href="<?= base_url() ?>mi" class="mobile_off" title="My invoice">
							<i class="fa fa-flag" aria-hidden="true"></i>
							<span class="d-none d-xxxl-block">My&nbsp;</span>
							<span>Invoice</span>
						</a>
					</li>

					<li class="d-none d-sm-block">
						<a href="<?= base_url() ?>mn" class="mobile_off" title="My notification">
							<i class="fa fa-bell" aria-hidden="true"></i>
							<span class="d-none d-xxxl-block">My&nbsp;</span>
							<span class="d-none d-xl-block">Notification</span>
						</a>
					</li>
					
					<li class="d-none d-lg-block">
						<a href="<?= base_url() ?>io" class="mobile_off" title="Upload order">
							<i class="fa fa-upload" aria-hidden="true"></i>
							<span>Upload</span>
							<span class="d-none d-xxxl-block">&nbsp;Order</span>
						</a>
					</li>

					<?php if(!empty($UserType)){ ?>
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
										<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/playstrore.png" alt="Google Play" style="width:20px;">
										Google Play
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-10 col-sm-12 col-xs-12 col-12">

						<a href="<?= base_url(); ?>ms" title="Search medicine / company" class="top_bar_search_div">
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
<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/logo.png" style="display:none" alt="<?= $title;?>">
<div class="left_menu_bar">
	<div class="left_menu_bar_div1">
		<div class="row">
			<div class="col-sm-2 col-4">
				<img src="<?= $UserImage ?>" alt="<?= $UserFullName ?>" title="<?= $UserFullName ?>" class="left_menu_bar_account_image" onerror=this.src="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/images/logo4.png">
			</div>
			<div class="col-sm-8 col-6">
				<div class="left_menu_bar_accoun_chemist_name">
					<?= $UserFullName ?>
				</div>
				<div class="left_menu_bar_accoun_chemist_code">
					Code : <?= $UserId ?>
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
				<a href="<?= base_url() ?>a" title="Account">
					<i class="fa fa-user" aria-hidden="true"></i> 
					Account
				</a>
			</li>
			<li>
				<a href="<?= base_url() ?>au" title="Update account">
					<i class="fa fa-pencil-square" aria-hidden="true"></i>
					Update account
				</a>
			</li>
			<li>
				<a href="<?= base_url() ?>iu" title="Update image">
					<i class="fa fa-camera" aria-hidden="true"></i> 
					Update image
				</a>
			</li>
			<li>
				<a href="<?= base_url() ?>pu" title="Update password">
				<i class="fa fa-key" aria-hidden="true"></i>
					Update password
				</a>
			</li>
			<li class="mobile_off">
				<a href="<?= base_url(); ?>io/usm" title="Update suggest medicine">
					<i class="fa fa-thumbs-up" aria-hidden="true"></i> 
					Update suggest medicine
				</a>
			</li>
			<?php
			if(!empty($session_user_type)){
			if($session_user_type=="sales")
			{
				?>
			<h2 class="text-left">Server Report</h2>
			<li>
				<a href="http://192.168.0.100:7272/drd_local_server/pendingorder_report" title="Pending Order" target="_black">
					<img class="img-circle" src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/privacy_policy.png" width="20" alt="Pending Order" title="Pending Order">
					Pending Order
				</a>
			</li>

			<li>
				<a href="http://192.168.0.100:7272/drd_local_server/drd_today_invoice" title="All Invoice" target="_black">
					<img class="img-circle" src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/privacy_policy.png" width="20" alt="All Invoice" title="All Invoice">
					All Invoice
				</a>
			</li>
			
			<li>
				<a href="http://192.168.0.100:7272/drd_local_server/child_invoice/pickedby" title="Pickedby Invoice" target="_black">
					<img class="img-circle" src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/privacy_policy.png" width="20" alt="Pickedby Invoice" title="Pickedby Invoice">
					Pickedby Invoice
				</a>
			</li>
			
			<li>
				<a href="http://192.168.0.100:7272/drd_local_server/child_invoice/pickedby" title="Deliverby Invoice" target="_black">
					<img class="img-circle" src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/privacy_policy.png" width="20" alt="Deliverby Invoice" title="Deliverby Invoice">
					Deliverby Invoice
				</a>
			</li>
			
			<li>
				<a href="http://192.168.0.100:7272/drd_local_server/delivery_report" title="Delivery Report" target="_black">
					<img class="img-circle" src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/privacy_policy.png" width="20" alt="Delivery Report" title="Delivery Report">
					Delivery Report
				</a>
			</li>
			<?php } }?>
			<h2 class="text-left">Others</h2>
			<li>
				<a href="tel:<?php echo $this->appconfig->getSiteMobile(); ?>" title="Contact us">
					<i class="fa fa-phone-square" aria-hidden="true"></i> Contact us
				</a>
			</li>
			<li title="Email">
				<a href="mailto:<?php echo $this->appconfig->getSiteEmail(); ?>" title="Email">
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
				<a href="<?php echo $this->appconfig->getAppUrl(); ?>" target="_black" title="Share App">
					<i class="fa fa-share-alt-square" aria-hidden="true"></i>
					Share App
				</a>
			</li>
			<li title="Download App">
				<a href="<?php echo $this->appconfig->getAppUrl(); ?>" target="_black" title="Download App">
					<i class="fa fa-mobile" aria-hidden="true"></i>
					Download App
				</a>
			</li>
			<?php if(!empty($session_user_type)){ ?>
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
<!-- <div type="hidden" class="medicine_details_all_data"></div> -->
<!-- ******************************************************** 

******************************************************** -->
<span class="main_page_loading text-center">
	<h2>
		<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/loading.gif" width="100px">
	</h2>
	<h2>Please wait....</h2>
</span>
<!-- ******************************************************** -->
<div class="main_page_something_went_wrong text-center">
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<h2>
				<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/something_went_wrong.png" width="100%">
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
				<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/no_record_found.png" width="100%">
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
				<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/cart_empty.png" width="100%">
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
	return "<?= $this->appconfig->getApiUrl(); ?>";
}
function getWebJs(){
	return "<?= $this->appconfig->getWebJs(); ?>";
}
function get_UserType(){
	<?php if(!empty($UserType)){ ?>
		return "<?= $UserType ?>";
	<?php } else {?>
		return "";
	<?php } ?>
}
function get_FirebaseToken() {
	<?php if(!empty($FirebaseToken)){ ?>
		return "<?= $FirebaseToken ?>";
	<?php } else {?>
		return "";
	<?php } ?>
}
var default_img = "<?= base_url(); ?>uploads/default_img.webp";
var get_page_name = "";
var siteTitle = "<?php echo $this->appconfig->siteTitle; ?>";
</script>
<script src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/easyzoom/easyzoom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init();
</script>

<!-- ******************************************************** -->
<div type="hidden" class="medicine_details_div"></div>
<script src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/js/main_page123.js"></script>
<!-- ******************************************************** -->
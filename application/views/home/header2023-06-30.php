<?php 
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
	<meta name="msapplication-tap-highlight" content="no" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>
		<?= $this->Scheme_Model->get_website_data("title") ;?> || <?= $main_page_title;?>
	</title>
	<meta charset utf="8">
	<meta name="theme-color" content="#27ae60">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?= base_url(); ?>assets/website/css/font-awesome.min.css"> 
	<link href="<?= base_url(); ?>assets/website/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/website/wow_css_js/animate.css"> 
	
	<?php if($theme_type=="lite") { ?>
	<style>/*light theme*/
	:root{
		--main_theme_body_text_color:#000000;
		--main_theme_color:#27ae60;
		--main_theme_footer_color:#ffffff;
		--main_theme_footer_bg:#F2F6F7;
		--main_theme_bg_color:#f3f4f6;
		--main_theme_top_menu_bar_bg:#ffffff;

		--heading_home_hr_line:#27ae60;

		--main_theme_box_shadow:#27ae60;

		--main_theme_white_background_color:#ffffff;
		--main_theme_left_menu_bg_color:#27ae60;

		--main_theme_textbox_background_color:#ffffff;
		--main_theme_textbox_text_color:#6A6767;
		--main_theme_scrollbar_color:#27ae60;
		

		--main_theme_li_color:rgb(240, 240, 240);
		--main_theme_li_bg_color:#969a9829;
		--main_theme_li_bg_hover_color:#27ae6029;

		--main_theme_li2_color:rgb(240, 240, 240);
		--main_theme_li2_bg_color:#ffffff;
		--main_theme_li2_bg_hover_color:#27ae6029;

		--main_theme_textbox_bg_color:#ffffff;
		--main_theme_textbox_color:#6A6767;

		--main_theme_textbox2_bg_color:#ffffff;
		--main_theme_textbox2_color:#6A6767;

		--main_theme_text_white_color:#ffffff;
		--main_theme_text_black_color:#757575;

		--main_theme_border_color:#27ae60;
		--main_theme_border_hover_color:#27ae6085;
		
		--main_theme_modal_bg_color:#ffffff;

		--mainbutton-color:#27ae60; /* #27ae60; */
		--mainbuttonhover-color:#1b6339; /* #27ae60; */

		
		

		/************/
		--home_company_color:#757575;
		--home_company_color_hover:#27ae60;
		--main_theme_left_right_btn:#27ae60;
		--main_theme_search_icon_color:#6a6767;


		--item_date_time_color:#795548;
		--item_name_color:#757575; /*27ae60 */
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
		--main_theme_body_text_color:#ffffff;
		--main_theme_color:#04293A;
		--main_theme_footer_color:#04293A;
		--main_theme_bg_color:#041C32;
		--main_theme_top_menu_bar_bg:#ebebeb;

		--heading_home_hr_line:#575757;

		--main_theme_box_shadow:#ffffff;

		--main_theme_white_background_color:#000000;
		--main_theme_left_menu_bg_color:#04293A;

		--main_theme_textbox_background_color:#000000;
		--main_theme_textbox_text_color:#ffffff;
		

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
		--main_theme_text_black_color:#ffffff;
		
		--main_theme_border_color:#6A6767;
		--main_theme_border_hover_color:#6A6767;
		--main_theme_modal_bg_color:#000000; /* 474040 */

		--mainbutton-color:#607d8b; /* #27ae60; */
		--mainbuttonhover-color:#364952; /* #27ae60; */

		

		/************/
		--home_company_color:#ffffff;
		--main_theme_left_right_btn:#ffffff;
		--main_theme_search_icon_color:#ffffff;

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

	<link href="<?= base_url(); ?>assets/website/css/style<?= constant('site_v') ?>.css" rel="stylesheet" type="text/css"/>

	<link rel="icon" href="<?= base_url(); ?>img_v<?= constant('site_v') ?>/logo.png" type="image/logo" sizes="16x16">
	
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
	</script>

	<link rel="stylesheet" href="<?= base_url(); ?>assets/website/css/min.css"/>
	<script src="<?= base_url(); ?>assets/website/js/min.js"></script>

</head>
<body>
<?php
if(empty($chemist_id_for_cart_total))
{
	$chemist_id_for_cart_total = "";
}
$website_menu 	= file_get_contents('./json_api/website_menu_json_new.json');
$website_menu 	= '['.$website_menu.']';
$website_menu 	= json_decode($website_menu, true);
?>
	<div class="top_menu_bar">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-4"></div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 col-12">
					<span style="float:left; margin-right:10px;">
						<a href="javascript:goBack()" class="menubtn2" title="Go Back">
							<i class="fa fa-chevron-left main_back_button main_icon1" aria-hidden="true"></i>
						</a>
						<a href="javascript:new_style_menu_show()" class="menubtn1" style="color:white;" title="Drd Menu">
							<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/logo1.png" class="main_white_logo" alt="Dr. Distributor" title="Dr. Distributor">
						</a>
					</span>

					<span style="float:left; margin: auto;width:60%;">
						<div class="pro-link headertitle">
							Delivering to
						</div>
						<div class="pro-link headertitle1">
							<?= $session_user_fname ?>
						</div>
					</span>

					<span class="mobile_show">
						<a href="<?= base_url(); ?>home/my_cart" class="top_menu_small_btn top_menu_cart_div" title="Cart" style="float:right">
							<i class="fa fa-shopping-cart main_icon1" aria-hidden="true"></i>
							<span class="header_cart_span" style="">
								<?= $_COOKIE["user_cart_total"]; ?>
							</span>
							Cart
						</a>

						<a href="#" onclick="delete_all_medicine()" class="top_menu_small_btn delete_btn_icon" title="Delete All" style="float:right">
							<i class="fa fa-trash main_icon1" aria-hidden="true"></i>
						</a>
					</span>
				</div>
				
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-4 col-12" style="display:none">

					<a href="<?= base_url(); ?>home/search_medicine" title="Search medicine / company" class="home_page_search_div">
						<i class="fa fa-search search_icon1 main_icon1" aria-hidden="true"></i> Search medicine / company 
					</a>
					
					<div class="home_page_search_div_box">
						<i class="fa fa-search search_icon main_icon1" aria-hidden="true"></i>
						<input type="text" class="select_medicine search_textbox input_type_text" placeholder="Search medicine / company" tabindex="1">
						<input type="text" class="select_chemist search_textbox input_type_text" placeholder="Search chemist"  tabindex="1" />
						<i class="fa fa-times clear_search_icon main_icon1" aria-hidden="true" onclick="clear_search_icon()"></i>
					</div>
					<div class="search_medicine_result"></div>
				</div>
				
				<div class="col-sm-8 mobile_off">
					<ul class="top_icon_menu">
						<li>
							<a href="<?= base_url() ?>home/search_medicine" title="Search medicine / company">
								<i class="fa fa-mobile main_icon1" aria-hidden="true"></i>
								Download App
							</a>
						</li>
						<li>
							<a href="<?= base_url() ?>home/search_medicine" title="Search medicine / company">
								<i class="fa fa-search main_icon1" aria-hidden="true"></i>
								Search
							</a>
						</li>
						<li>
							<a href="<?= base_url() ?>home" title="Home">
								<i class="fa fa-home main_icon1" aria-hidden="true"></i>
								Home
							</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>home/my_cart" class="top_menu_cart_div" title="Cart">
								<i class="fa fa-shopping-cart main_icon1" aria-hidden="true"></i>
								<span class="header_cart_span" style="">
									<?= $_COOKIE["user_cart_total"]; ?>
								</span>
								Cart
							</a>
						</li><li>
							<a href="<?= base_url() ?>home/my_notification" class="mobile_off" title="Notification">
								<i class="fa fa-bell main_icon1" aria-hidden="true"></i>
								Notification
							</a>
						</li><li>
							<a href="<?= base_url() ?>home/account" class="mobile_off">
								<i class="fa fa-user main_icon1" aria-hidden="true"></i>
								Account
							</a>
						</li>
						
						<?php if($_COOKIE['user_session']!=""){ ?>
						<li>
							<a class="mobile_off" title="Logout" href="javascript:void(0);" onclick="logout_function()">
								<i class="fa fa-sign-out main_icon1" aria-hidden="true"></i>
								Logout
							</a>
						</li>
						<?php } ?>
					<ul>
				</div>
				
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 col-12" style="display:none">
					<ul class="top-header-ul">
						<li><i class="fa fa-envelope" aria-hidden="true"></i><?= $this->Scheme_Model->get_website_data("android_email") ;?></li>
						<li><i class="fa fa-phone" aria-hidden="true"></i><?= $this->Scheme_Model->get_website_data("android_mobile") ;?></li>
						<li><i class="fa fa-whatsapp" aria-hidden="true"></i><?= $this->Scheme_Model->get_website_data("android_whatsapp") ;?></li>
					</ul>
				</div>
				
				
				
				<div class="col-sm-12 mobile_off" style="border-top: 1px solid #b8b8b8;">
					<ul class="top_menu_menu">
						<?php foreach($website_menu as $row) { ?>
						<li>
							<a href="<?= base_url();?>home/medicine_category/medicine_category/<?= $row["item_code"] ?>">
								<span>
								<?= ($row["item_company"]) ?>
								</span>
							</a>
						</li>
						<?php } ?>
					</ul>
				</div>
				
				

				<div class="col-sm-12 current_order_search_page" style="width: 100%;margin-top: 50px;text-align: right;display:none;">
					<span class="header_result_found"></span>
				</div>

				<div class="col-sm-3 col-3 current_order_cart_page account_page_header" style="margin-top:10px;display:none;">
					<img src="<?= $session_user_image ?>" alt="<?= $session_user_fname ?>" title="<?= $session_user_fname ?>" class="rounded account_page_header_image" onerror=this.src="<?= base_url(); ?>img_v<?= constant('site_v') ?>/logo.png">
				</div>
			</div>
		</div>
	</div>

	<img src="<?= base_url(); ?>img_v<?= constant('site_v') ?>/logo.png" style="display:none" alt="Dr. Distributor" title="Dr. Distributor">
	<div class="left_menu_bar">
		<div class="left_menu_bar_part1">
			<div class="row">
				<div class="col-sm-3 col-4">
					<img src="<?= $session_user_image ?>" alt="<?= $session_user_fname ?>" title="<?= $session_user_fname ?>" class="left_menu_bar_account_image" onerror=this.src="<?= base_url(); ?>img_v<?= constant('site_v') ?>/logo.png">
				</div>
				<div class="col-sm-7 col-6">
					<div class="left_menu_bar_accoun_chemist_name">
						<?= $session_user_fname ?>
					</div>
					<div class="left_menu_bar_accoun_chemist_code">
						Code : <?= $session_user_altercode ?>
					</div>
				</div>
				<div class="col-sm-2 col-2 text-left">
					<i class="fa fa-times main_icon1" aria-hidden="true" onclick="new_style_menu_hide()"></i>
				</div>
				<div class="col-sm-12 col-12">
					<lable>Select theme</lable><br>
					<select class="input_type_text2 theme_set_css" onchange="theme_set()">
						<option value="lite" <?php if($theme_type=="lite") { echo "selected"; } ?>>Lite</option>
						<option value="dark" <?php if($theme_type=="dark") { echo "selected"; } ?>>Dark</option>
					</select>
				</div>
			</div>
		</div>
		<div class="left_menu_bar_part2 text-center">
			<div class="social-icon">
			<div class="text-left" style="margin-left:10px;margin-top:10px; border-top: 1px solid #f3f3f3;">Account</div>
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
					<div class="text-left" style="margin-left:10px;margin-top:10px; border-top: 1px solid #f3f3f3;">Server Report</div>

					<li>
						<a href="http://192.168.0.100:7272/drd_local_server/pendingorder_report" title="Pending Order" target="_black">
							<img class="img-circle" src="<?= base_url() ?>img_v<?= constant('site_v') ?>/privacy_policy.png" width="20" alt="All Invoice" title="Pending Order">
							Pending Order
						</a>
					</li>

					<li>
						<a href="http://192.168.0.100:7272/drd_local_server/drd_today_invoice" title="All Invoice" target="_black">
							<img class="img-circle" src="<?= base_url() ?>img_v<?= constant('site_v') ?>/privacy_policy.png" width="20" alt="All Invoice" title="All Invoice">
							All Invoice
						</a>
					</li>
					
					<li>
						<a href="http://192.168.0.100:7272/drd_local_server/child_invoice/pickedby" title="Pickedby Invoice" target="_black">
							<img class="img-circle" src="<?= base_url() ?>img_v<?= constant('site_v') ?>/privacy_policy.png" width="20" alt="Pickedby Invoice" title="Pickedby Invoice">
							Pickedby Invoice
						</a>
					</li>
					
					<li>
						<a href="http://192.168.0.100:7272/drd_local_server/child_invoice/pickedby" title="Deliverby Invoice" target="_black">
							<img class="img-circle" src="<?= base_url() ?>img_v<?= constant('site_v') ?>/privacy_policy.png" width="20" alt="Deliverby Invoice" title="Deliverby Invoice">
							Deliverby Invoice
						</a>
					</li>
					
					<li>
						<a href="http://192.168.0.100:7272/drd_local_server/delivery_report" title="Delivery Report" target="_black">
							<img class="img-circle" src="<?= base_url() ?>img_v<?= constant('site_v') ?>/privacy_policy.png" width="20" alt="Delivery Report" title="Delivery Report">
							Delivery Report
						</a>
					</li>
					<?php } }?>
					<div class="text-left" style="margin-left:10px;margin-top:10px; border-top: 1px solid #f3f3f3;">Others</div>
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
							<img class="img-circle" src="<?= base_url() ?>img_v<?= constant('site_v') ?>/playstrore.png" width="20" alt="Download App" title="Download App">
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
	setTimeout('check_login_function();',6000);

	$('.medicine_details_item_order_quantity_textbox').keypress(function (e) {
		if (e.which == 13) {
			medicine_add_to_cart_api();
		} 
	});
});

function get_single_medicine_info(item_code)
{
	var session_user_altercode = "<?= $session_user_altercode ?>";
	if(session_user_altercode=="xxxxxx")
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
		url: "<?php echo base_url(); ?>Chemist_json/medicine_details_api",
		type:"POST",
		/*dataType: 'html',*/
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
	var session_user_altercode = "<?= $session_user_altercode ?>";
	if(session_user_altercode=="xxxxxx")
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

	$(".medicine_details_item_margin").html(item_margin+'% Margin')
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
					url        : "<?php echo base_url(); ?>Chemist_json/medicine_add_to_cart_api",
					cache	   : true,
					error: function(){
						swal("error add to cart")
					},
					success    : function(data){
						$.each(data.items, function(i,item){	
							if (item)
							{
								if(item.status=="1")
								{	
									user_cart_total = item.user_cart_total;
									$(".header_cart_span").html(user_cart_total)
									
									<?php if($this->uri->segment(2)=="my_cart") { ?>
									my_cart_page_load();
									<?php } ?>
									/*******************yha serach page par use ho raha ha*/
									$(".medicine_cart_list_div").html("");
									
									//medicine_cart_list();
									/******************************************************/

									$('.medicine_details_item_add_to_cart_btn_loading').hide()

									$('.search_textbox').val("");
									$(".search_medicine_result").html("");
								}
							}
						});
						<?php if($this->uri->segment(2)=="search_medicine") { ?>
						$.each(data.items1, function(i,item){
							if (item)
							{
								item_code			= item.code;
								item_image			= item.image;
								item_name 			= item.name;
								item_packing 		= item.packing;
								item_expiry 		= item.expiry;
								item_company 		= item.company;
								item_quantity 		= item.quantity;
								item_stock 			= item.stock;
								item_ptr 			= item.ptr;
								item_mrp 			= item.mrp;
								item_price 			= item.price;
								item_scheme 		= item.scheme;
								item_margin 		= item.margin;
								item_featured 		= item.featured;
								item_description1 	= item.description1;
								similar_items 		= item.similar_items;
								//new add for last order qty
								item_order_quantity = item.order_quantity;

								div_all_data = "<div class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"' item_order_quantity='"+item_order_quantity+"'></div>"

								item_id 			= item.id;
								item_quantity_price = item.quantity_price;
								item_datetime 		= item.datetime;
								item_modalnumber 	= item.modalnumber;

								error_img ="onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'"

								item_other_image_div = '';
								if(item_featured=="1"){
									item_other_image_div = '<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/featured_img.png" class="medicine_cart_item_featured_img">';
								}
								
								image_div = item_other_image_div+'<img src="'+item_image+'" style="width: 100%;cursor: pointer;" class="medicine_cart_item_image" onclick="medicine_details_funcation('+item_code+')" '+error_img+'>';
								
								item_scheme_div = "";
								if(item_scheme!="0+0")
								{
									item_scheme_div =  ' | <span class="medicine_cart_item_scheme" title="'+item_name+' '+item_scheme+'">Scheme : '+item_scheme+'</span>';
								}

								rate_div = '<div class="cart_ki_main_div3"><span class="medicine_cart_item_price2" title="*Approximate ~">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</span> | <span class="medicine_cart_item_price">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_quantity_price+'/-</span></div><div class="cart_ki_main_div3"><span class="medicine_cart_item_datetime">'+item_modalnumber+' | '+item_datetime+'</span><span style="float:right;"><a href="javascript:delete_medicine('+item_code+')" tabindex="-10" title="Delete '+item_name+'"><i class="fa fa-trash-o cart_new_btn_color_css" aria-hidden="true" style="margin-right:5px;"></i></a>&nbsp;<a href="javascript:medicine_details_funcation('+item_code+')" tabindex="-10" title="Edit '+item_name+'" class="edit_item_focues'+item_code+'"><i class="fa fa-pencil cart_new_btn_color_css" aria-hidden="true"></i></a>&nbsp;&nbsp;</div>';
								
								$(".medicine_cart_list_div").append('<div class="main_theme_li_bg"><div class="medicine_cart_small_div1">'+image_div+'</div><div class="medicine_cart_small_div2"><div class="medicine_cart_item_name" title="'+item_name+'" onclick="medicine_details_funcation('+item_code+')" style="cursor: pointer;">'+item_name+' <span class="medicine_cart_item_packing">('+item_packing+' Packing)</span></div><div class=""><span class="medicine_cart_item_margin">'+item_margin+'% Margin </span> | <span class="medicine_cart_item_expiry">Expiry : '+item_expiry+'</span></div><div class="medicine_cart_item_company">By '+item_company+'</div><div class="text-left medicine_cart_item_order_quantity" title="'+item_name+' Quantity: '+item_order_quantity+'" >Order quantity : '+item_order_quantity+item_scheme_div+'</div><span class="mobile_off">'+rate_div+'</span></div><span class="mobile_show" style="margin-left:5px;">'+rate_div+'</span></div>'+div_all_data);
							}
						});
						
						$.each(data.items2, function(i,item){
							if (item)
							{
								items_price = item.items_price;
								items_total = item.items_total;
								place_order_button = item.place_order_button;
								place_order_message = item.place_order_message;
								$(".div_cart_total_price").html('<i class="fa fa-inr"></i> '+items_price+'/-');
								$(".div_cart_total_items").html(items_total+" items");
								$(".div_cart_total_items1").html("("+items_total+")");
								$(".header_cart_span").html(items_total);
								$(".place_order_message").html(place_order_message);
								$(".header_result_found").html("Current order ("+items_total+")");
								if(items_total==0)
								{
									$(".cart_empty_cart_div").show();
									$(".cart_add_to_cart_div").hide();
									$(".cart_disabled_cart_div").hide();
								}
								else
								{
									$(".cart_empty_cart_div").hide();
									$(".cart_add_to_cart_div").show();
									$(".cart_disabled_cart_div").show();
								}
							}
						});
						<?php } ?>
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
				<h1>
					<img src="<?= base_url(); ?>/img_v<?= constant('site_v') ?>/loading.gif" width="100px" alt="">
				</h1>
				<h1>Loading....</h1>
			</div>
			<div class="row medicine_details_api_data" style="display:none">
				<div class="col-sm-5 col-12">

					<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
						<a class="example-image-link" data-standard="">
						<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="100%" style="float: right;margin-top:10px;" class="medicine_details_image modal_item_image_change" alt="" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
						</a>
					</div>
					
					<img src="<?= base_url(); ?>/img_v<?= constant('site_v') ?>/featured_img.png" width="100" style="position: absolute;margin-top:10px;display:none;" alt="" class="medicine_details_featured_img" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>

					<img src="<?= base_url(); ?>/img_v<?= constant('site_v') ?>/out_of_stock_img.png" width="100" style="position: absolute;margin-top:10px;display:none;" alt="" class="medicine_details_out_of_stock_img" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
					
					<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;margin-right: 6.6%;" class="medicine_details_image_small modal_item_image_change1" onclick="modal_item_image_change(1)" alt="" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>

					<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;margin-right: 6.6%;" class="medicine_details_image_small modal_item_image_change2" onclick="modal_item_image_change(2)" alt="" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>

					<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;margin-right: 6.6%;" class="medicine_details_image_small modal_item_image_change3" onclick="modal_item_image_change(3)" alt="" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>

					<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;" class="medicine_details_image_small modal_item_image_change4" onclick="modal_item_image_change(4)" alt="" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
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
						*Approximate billing value per unit, subject change . As per final invoice.
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
				<h5 class="modal-title broadcast_title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body broadcast_message">
				
			</div>
		</div>
	</div>
</div>

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
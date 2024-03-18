<?php 
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
	
	<?php if($theme_type=="lite") { ?>
		<link href="<?= base_url(); ?>assets/css/style-light.css" rel="stylesheet" type="text/css"/>
	<?php } ?>

	<?php if($theme_type=="dark") { ?>
		<link href="<?= base_url(); ?>assets/css/style-dark.css" rel="stylesheet" type="text/css"/>
	<?php } ?>

	<link href="<?= base_url(); ?>assets/css/style2nicsrt.css" rel="stylesheet" type="text/css"/>

	<link rel="icon" href="<?= base_url(); ?>img_v51/logo.png" type="image/logo" sizes="16x16" alt="<?= $title;?>" />
	
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<link rel="stylesheet" href="<?= base_url(); ?>assets/website/css/min.css"/>
	<script src="<?= base_url(); ?>assets/website/js/min.js"></script>
</head>
<body>
	<?php
	if(empty($chemist_id_for_cart_total))
	{
		$chemist_id_for_cart_total = "";
	}
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
							<img src="<?= base_url() ?>img_v51/logo4.png" class="main_white_logo" alt="<?= $title;?>" title="<?= $title;?>">
						</a>
					</div>
					<div class="" style="float:left; margin-left:5px;width: inherit;">
						<h1 class="pro-link headertitle">
							Delivering to
						</h1>
						<div class="pro-link headertitle1">
							Code : <?= $session_delivering_to ?>
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
							<?php 
							/*foreach($website_menu as $row) { ?>
							<li>
								<?php /*<a href="<?= base_url();?>home/medicine_category/medicine_category/<?= $row["item_code"] ?>">*/ /*?>
								<a href="<?= base_url();?>category/<?= str_replace(" ","-",strtolower($row["item_company"])); ?>">
									<span>
									<?= ($row["item_company"]) ?>
									</span>
								</a>
							</li>
							<?php } */ ?>
						</ul>
					</div>
				</div>

				<div class="col-sm-12 current_order_search_page" style="display:none;">
					<span class="header_result_found"></span>
				</div>

				<div class="col-sm-3 col-3 current_order_cart_page account_page_header" style="margin-top:10px;display:none;">
					<img src="<?= $session_user_image ?>" alt="<?= $session_user_fname ?>" title="<?= $session_user_fname ?>" class="rounded account_page_header_image" onerror=this.src="<?= base_url(); ?>img_v51/logo.png">
				</div>
			</div>
		</div>
	</div>

	<img src="<?= base_url(); ?>img_v51/logo.png" style="display:none" alt="<?= $title;?>">
	<div class="left_menu_bar">
		<div class="left_menu_bar_part1">
			<div class="row">
				<div class="col-sm-2 col-4">
					<img src="<?= $session_user_image ?>" alt="<?= $session_user_fname ?>" title="<?= $session_user_fname ?>" class="left_menu_bar_account_image" onerror=this.src="<?= base_url(); ?>img_v51/logo.png">
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
						<a href="<?= base_url() ?>account" title="Account">
							<i class="fa fa-user left_menu_icon" aria-hidden="true"></i> Account
						</a>
					</li>
					<li>
						<a href="<?= base_url() ?>update_account" title="Update account">
							<i class="fa fa-pencil-square left_menu_icon" aria-hidden="true"></i>
							Update account
						</a>
					</li>
					<li>
						<a href="<?= base_url() ?>update_image" title="Update image">
							<i class="fa fa-camera left_menu_icon" aria-hidden="true"></i> Update image
						</a>
					</li>
					<li>
						<a href="<?= base_url() ?>update_password" title="Update password">
						<i class="fa fa-key left_menu_icon" aria-hidden="true"></i>
						Update password
						</a>
					</li>
					<li class="mobile_off">
						<a href="<?= base_url(); ?>import_order/medicine_suggest" title="Update suggest medicine">
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
						<a href="<?= base_url();?>privacy_policy" title="Privacy policy">
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
		url        : "<?php echo base_url(); ?>home/theme_set_api",
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
		window.location.href = '<?= base_url(); ?>category/featured_brand/'+id+'/'+division;
	}
}
function gosearchpage()
{
	window.location.href = "<?= base_url();?>search_medicine";
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
	var session_user_altercode = "";
	<?php if(isset($_COOKIE["user_altercode"])){ ?>
		session_user_altercode = "<?= $_COOKIE["user_altercode"] ?>";
	<?php } ?>
	if(session_user_altercode=="" || session_user_altercode==null)
	{
		window.location.href = "<?=base_url(); ?>";
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
	/***************************************************************** */
	$('.order_quantity_div').hide();
	$('.medicine_details_item_add_to_cart_btn').html("Add to cart");
	$('.medicine_details_item_add_to_cart_btn_disable').html("Add to cart");
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
					
					// firebase code
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
	var session_user_altercode = "";
	<?php if(isset($_COOKIE["user_altercode"])){ ?>
		session_user_altercode = "<?= $_COOKIE["user_altercode"] ?>";
	<?php } ?>
	if(session_user_altercode=="" || session_user_altercode==null)
	{
		window.location.href = "<?=base_url(); ?>home";
	} else 
	{
		$(".medicine_details_item_order_quantity_textbox").val("");
		$(".medicine_details_item_order_quantity_textbox").focus();
		
		medicine_details_get(item_code);
		medicine_details_api(item_code);
		//setTimeout(medicine_details_api(item_code),500);// its on header page

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
	$(".medicine_details_api_data").show();
	$(".medicine_details_api_loading").hide();

	/***********************important ************************/
	$('.medicine_details_item_code').val(item_code);
	/********************************************************/

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

	$(".medicine_details_item_description1").hide()
	if(item_description1!=""){
		$(".medicine_details_item_description1").show()
		$(".medicine_details_item_description1").html(item_description1)
	}

	/******************************************************************* */
	$(".medicine_details_item_ptr").html('PTR : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_ptr + "/-")
	$(".medicine_details_item_mrp").html('MRP : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_mrp + "/-")
	$(".medicine_details_item_gst").html("GST : "+item_gst +"%")
	$(".medicine_details_item_price").html('*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_price + "/-")
	$(".medicine_details_item_price_calculate").html('*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_price + "/-")
	/******************************************************************* */

	$(".medicine_details_item_scheme_line").show()
	$(".medicine_details_item_scheme").show()
	if(item_scheme=="0+0"){
		$(".medicine_details_out_of_stock_img").hide()
		$(".medicine_details_item_scheme_line").hide()
		$(".medicine_details_item_scheme").hide()
	}

	if(item_featured=="1" && item_quantity!="0"){
		$(".medicine_details_featured_img").show()
	}

	/******************************************************************* */
	$('.medicine_details_item_add_to_cart_btn_loading').hide()
	$(".medicine_details_item_add_to_cart_btn").hide()
	$(".medicine_details_item_add_to_cart_btn_disable").show()
	$(".order_quantity_div").show()
	if(parseInt(item_quantity)==0){
		$(".order_quantity_div").hide()		
		$(".medicine_details_out_of_stock_img").show()
		$(".medicine_details_item_stock").html("<font color=red>Out of stock</font>")
	}

	/******************************************************************* */
	$(".medicine_details_item_order_quantity_hidden").val(item_quantity)
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

	item_quantity		= $(".medicine_details_item_order_quantity_hidden").val();
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
						if(data.items=="")
						{
							$(".medicine_cart_list_div").html('<h1><center><img src="<?= base_url(); ?>/img_v51/cartempty.png" width="80%"></center></h1>');
							$(".delete_all_btn").hide();
						}
						else
						{
							$(".medicine_cart_list_div").html("");
							$(".delete_all_btn").show();
						}
						$.each(data.items, function(i,item){
							if (item)
							{
								item_code			= item.item_code;
								item_image			= item.item_image;
								item_name 			= item.item_name;
								item_packing 		= item.item_packing;
								item_expiry 		= item.item_expiry;
								item_company 		= item.item_company;
								item_quantity 		= item.item_quantity;
								item_stock 			= item.item_stock;
								item_ptr 			= item.item_ptr;
								item_mrp 			= item.item_mrp;
								item_price 			= item.item_price;
								item_scheme 		= item.item_scheme;
								item_margin 		= item.item_margin;
								item_featured 		= item.item_featured;
								item_description1 	= item.item_description1;
								similar_items 		= item.similar_items;
								//new add for last order qty
								item_order_quantity = item.item_order_quantity;

								div_all_data = "<div class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"' item_order_quantity='"+item_order_quantity+"'></div>"

								item_id 			= item.item_id;
								item_quantity_price = item.item_quantity_price;
								item_datetime 		= item.item_date_time;
								item_modalnumber 	= item.item_modalnumber;

								error_img ="onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'"

								item_other_image_div = '';
								if(item_featured=="1"){
									item_other_image_div = '<img src="<?= base_url() ?>img_v51/featured_img.png" class="medicine_cart_item_featured_img">';
								}
								
								image_div = item_other_image_div+'<img src="'+item_image+'" style="width: 100%;cursor: pointer;" class="medicine_cart_item_image" onclick="medicine_details_funcation('+item_code+')" '+error_img+'>';
								
								item_scheme_div = "";
								if(item_scheme!="0+0")
								{
									item_scheme_div =  ' | <span class="medicine_cart_item_scheme" title="'+item_name+' '+item_scheme+'">Scheme : '+item_scheme+'</span>';
								}

								rate_div = '<div class="cart_ki_main_div3"><span class="medicine_cart_item_price2" title="*Approximate ~">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</span> | <span class="medicine_cart_item_price">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_quantity_price+'/-</span></div><div class="cart_ki_main_div3"><span class="medicine_cart_item_datetime">'+item_modalnumber+' | '+item_datetime+'</span><span style="float:right;"><a href="javascript:delete_medicine('+item_code+')" tabindex="-10" title="Delete '+item_name+'"><i class="fa fa-trash-o cart_new_btn_color_css" aria-hidden="true" style="margin-right:5px;"></i></a>&nbsp;<a href="javascript:medicine_details_funcation('+item_code+')" tabindex="-10" title="Edit '+item_name+'" class="edit_item_focues'+item_code+'"><i class="fa fa-pencil cart_new_btn_color_css" aria-hidden="true"></i></a>&nbsp;&nbsp;</div>';
								
								$(".medicine_cart_list_div").append('<div class="main_theme_li_bg"><div class="medicine_cart_small_div5">'+image_div+'</div><div class="medicine_cart_small_div6"><div class="medicine_cart_item_name" title="'+item_name+'" onclick="medicine_details_funcation('+item_code+')" style="cursor: pointer;">'+item_name+' <span class="medicine_cart_item_packing">('+item_packing+' Packing)</span></div><div class=""><span class="medicine_cart_item_margin">'+item_margin+'% Margin* </span> | <span class="medicine_cart_item_expiry">Expiry : '+item_expiry+'</span></div><div class="medicine_cart_item_company">By '+item_company+'</div><div class="text-left medicine_cart_item_order_quantity" title="'+item_name+' Quantity: '+item_order_quantity+'" >Order quantity : '+item_order_quantity+item_scheme_div+'</div><span class="mobile_off">'+rate_div+'</span></div><span class="mobile_show" style="margin-left:5px;">'+rate_div+'</span></div>'+div_all_data);
							}
						});
						$.each(data.items_other, function(i,item){
							if (item)
							{
								items_price = item.items_price;
								items_total = item.items_total;
								status = item.status;
								status_message = item.status_message;
								$(".div_cart_total_price").html('<i class="fa fa-inr"></i>'+items_price+'/-');
								$(".div_cart_total_items").html("My Cart ("+items_total+")");
								$(".div_cart_total_items1").html("("+items_total+")");
								$(".header_cart_span").html(items_total);
								$(".place_order_message").html(status_message);
								$(".header_result_found").html("Current order ("+items_total+")");
								if(items_total==0)
								{
									$(".cart_empty_cart_div").show();
									$(".cart_add_to_cart_div").hide();
									$(".cart_disabled_cart_div").hide();
									$(".place_order_div").hide();
								}
								if(items_total!=0)
								{
									$(".cart_add_to_cart_div").show();
									if(status==1)
									{
										$(".cart_empty_cart_div").hide();
										$(".cart_disabled_cart_div").hide();
										$(".place_order_message").html('');
										$(".place_order_div").show();
									}
									else{
										$(".cart_empty_cart_div").hide();
										$(".cart_disabled_cart_div").show();
										$(".place_order_div").hide();
									}
								}
							}
						});
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

function get_top_menu_api(){
	myid = '';
	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       :  {myid:myid} ,
		url        : "<?php echo base_url(); ?>home/get_top_menu_api",
		cache	   : true,
		success : function(data){
			if(data!="") {
				$.each(data.items, function(i,item){
					if (item){
						item_code	 	= item.item_code;
						item_company	= item.item_company;
						item_image	 	= item.item_image;
						item_url	 	= "<?= base_url();?>category/"+item.item_url;

						$(".top_menu_menu").append('<li><a href="'+item_url+'"><span>'+item_company+'</span></a></li>');
					}
				});
			}
		}
	});
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
						<img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px" alt="loading">
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
						
						<img src="<?= base_url(); ?>/img_v51/featured_img.png" width="100" style="position: absolute;margin-top:10px;display:none;left: 15px;" alt="zoom" class="medicine_details_featured_img" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>

						<img src="<?= base_url(); ?>/img_v51/out_of_stock_img.png" width="100" style="position: absolute;margin-top:10px;display:none;left: 15px;" alt="zoom" class="medicine_details_out_of_stock_img" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
						
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
								<span class="medicine_details_item_price" title="*Approximate ~"></span>
							</div>
							<div class="col-sm-12 col-12 medicine_details_hr">
							</div>
							<div class="col-sm-12 col-12 text-left">
								*The information given on this page is based on historical data and estimates . Please refer to the final invoice for the exact value. E&OE.
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-12 medicine_details_hr">
					</div>

					<div class="col-sm-2 col-12"></div>
					<div class="col-sm-8 col-12 order_quantity_div">
						<div class="row">
							<div class="col-sm-4 col-4">
								<span class="medicine_details_item_order_quantity">Order quantity
								</span>
							</div>

							<div class="col-sm-8 col-8 text-right">
								<span class="medicine_details_item_price_calculate"></span>
							</div>

							<div class="col-sm-4 col-4">
								<input type="number" class="medicine_details_item_order_quantity_textbox" placeholder="Eg 1,2" name="quantity" required="" style="width:100px;" value="" title="Enter quantity" min="1" max="1000" onchange="change_item_order_quantity()" onkeyup="change_item_order_quantity()">
								<input type="hidden" class="medicine_details_item_order_quantity_hidden">
							</div>

							<div class="col-sm-8 col-8">
								<button type="submit" class="btn btn-primary mainbutton medicine_details_item_add_to_cart_btn"  onclick="medicine_add_to_cart_api()" title="Add to cart">Add to cart</button>

								<button type="submit" class="btn btn-primary mainbutton_disable medicine_details_item_add_to_cart_btn_disable" onclick="" title="Add to cart">Add to cart</button>

								<div class="medicine_details_item_add_to_cart_btn_loading text-center" style="display:none">
									<button type="submit" class="btn btn-primary mainbutton_disable" onclick="" title="Loading....">Loading....</button>
								</div>
							</div>

							<div class="col-sm-12 col-12 add_to_cart_error_message text-danger text-center medicine_details_hr"></div>
						</div>
					</div>
					<div class="col-sm-2 col-12"></div>

					<div class="col-sm-12 col-12 medicine_details_hr medicine_details_item_description2">
					</div>
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

function setDefaultImage(image) {
	image.onerror = "<?= base_url(); ?>/uploads/default_img.jpg";
}
function change_item_order_quantity(){

	$(".add_to_cart_error_message").html('');
	$(".medicine_details_item_add_to_cart_btn").hide();
	$(".medicine_details_item_add_to_cart_btn_disable").show();

	item_order_quantity	 = $(".medicine_details_item_order_quantity_textbox").val();	
	if(item_order_quantity==""){
		$(".medicine_details_item_price_calculate").html('*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_price + "/-");
	}else{
		item_order_quantity  = parseInt(item_order_quantity);

		if(item_order_quantity<=parseInt(item_quantity)){
			item_price_calculate = parseFloat(item_price) * item_order_quantity;

			item_price_calculate = item_price_calculate.toFixed(2);

			$(".medicine_details_item_price_calculate").html('Total : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_price_calculate + "/-");

			$(".medicine_details_item_add_to_cart_btn").show();
			$(".medicine_details_item_add_to_cart_btn_disable").hide();
			
		}else{
			$(".add_to_cart_error_message").html('Enter maximum quantity '+item_quantity+' only');
		}		
	}
}
</script>
<link rel="stylesheet" href="<?= base_url(); ?>assets/website/easyzoom/easyzoom.css" />
<script src="<?= base_url(); ?>assets/website/easyzoom/easyzoom.js"></script>
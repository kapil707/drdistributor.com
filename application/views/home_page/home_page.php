<style>
.menubtn1{
	display:inline;
}
.menubtn2,.homebtn_div
{
	display:none;
}
.headertitle
{
	margin-top: 2px;
	font-size:16px;
}
.headertitle1
{
	display:block !important;
}
/*
.search_medicine_main{
	display:none;
} */
.maincontainercss{
	padding-top: 160px;
    min-height: 500px;
}
</style>
<?php
$ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
$isMob = is_numeric(strpos($ua, "mobile"));

$default_img = base_url()."/uploads/default_img.jpg";
$error_img ="onerror=this.src=".base_url()."/uploads/default_img.jpg";

?>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<style>
.owl-carousel {
	margin: 0 auto;
	padding: 30px 0;
}
.owl-carousel .item {
	line-height: 2;
	font-weight: 700;
}

.owl-carousel .owl-nav button.owl-prev,
.owl-carousel .owl-nav button.owl-next {
	z-index: 1;
	width: 40px;
	height: 40px;
	background-color: #ccc;
	border-radius: 50%;
	position: absolute;
	top: 50%;
	transform: translatey(-50%);
}

.owl-nav button span {
	font-size: 30px;
	height: 100%;
	display: block;
	width: 100%;
}
.owl-carousel .owl-nav button.owl-prev {
	left: 0;
}
.owl-carousel .owl-nav button.owl-next {
	right: 0;
}
.owl-carousel .owl-nav {
	margin: 0;
}
</style>
<div class="container-fluid maincontainercss">
	<div class="row home_page_slider1_data"></div>
	<div class="row home_page_divisioncategory1_data"></div>
	<div class="row home_page_menu_data"></div>
	<div class="row home_page_invoice_notification_data"></div>
	<div class="row home_page_all_data"></div>
	<div class="row">
		<div class="col-sm-12 text-center">
			<div class="myloading">
				<img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px">
				<br>
				Loading....
			</div>
			<br>
			<div class="load_more btn btn-success" onclick="load_more()">Load More</div>
		</div>
	</div>
</div>


<script>
function home_page_slider(category_id,items,title){
	var mydata = '';
	$.each(items, function(i,item){
		if (item){
			division 	= item.item_division;
			funtype		= item.item_type;
			itemid 		= item.item_id;
			image 		= item.item_image;
			web_action	= item.item_web_action;

			if(division){
				division="not";
			}
			error_img ="onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'"

			mydata+='<a href="'+web_action+'"><div><img src="'+image+'" data-u="image" class="img_css_forslider" alt="" '+error_img+'></div></a>';
		}
	});
	
	myval = '<div class="col-xs-12 col-sm-12 col-12"><div id="jssor_'+category_id+'"><div data-u="slides" class="top_flash_div">'+mydata+'</div><div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75"><div data-u="prototype" class="i" style="width:16px;height:16px;"><svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><circle class="b" cx="8000" cy="8000" r="5800"></circle></svg></div></div><div data-u="arrowleft" class="jssora051" style="width:30px;height:30px;top:0px;left:35px;background: black;border-radius: 30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75"><svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline></svg></div><div data-u="arrowright" class="jssora051" style="width:30px;height:30px;top:0px;right:35px;background: black;border-radius: 30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75"><svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline></svg></div></div></div>';
	
	return myval;
}

function home_page_menu(category_id,items,title){
	var mydata = '';
	$.each(items, function(i,item){
		if (item){
			
			menu_id 	= item.menu_id;
			menu_name 	= item.menu_name;
			menu_image 	= item.menu_image;
			menu_url 	= '<?= base_url(); ?>'+item.menu_url;
			
			mobile_off_cls = "";
			if(menu_id==6){
				mobile_off_cls = "mobile_off";
			}

			mydata+='<div class="home_menu_main_div wow fadeInDown animated '+mobile_off_cls+'" data-wow-duration="0.1s" data-wow-delay="0.2s"><a href="'+menu_url+'" style="color:black"><div class="text-center"><img src="'+menu_image+'" class="img-fluid img-responsive" alt><div class="home_menu_main_btn">'+menu_name+'</div></div></a></div>';
		}
	});
	
	myval = '<div class="col-xs-12 col-sm-12 col-12" style="margin-top: 20px;margin-bottom: 20px;">'+mydata+'</div>';
	
	return myval;
}

function home_page_divisioncategory(category_id,items,title){
	var mydata = '';
	$.each(items, function(i,item){
		if (item){			
			item_code 		= item.item_code;
			item_company 	= item.item_company;
			item_division 	= item.item_division;
			item_image 		= item.item_image;

			mydata+= '<div class="item"><div class="featured_brand_home_div1 text-center"><a href="<?= base_url(); ?>category/featured_brand/'+item_code+'/'+item_division+'"><img src="'+item_image+'" alt=""></a><a href="<?= base_url(); ?>category/featured_brand/'+item_code+'/'+item_division+'"><div class="medicine_details_item_company">'+item_company+'</div></a></div></div>';
		}
	});
	
	myval = '<div class="col-xs-12 col-sm-12 col-12"><div class="featured_home_title1"><div class="heading_home1"><span class="">'+title+'</span></div></div><div class="row"><div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-12 col-12 mobile_off"><img src="<?php echo base_url(); ?>img_v51/heart.png" width="100%" class=""></div><div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-12 col-12"><div class="owl-carousel owl-carousel'+category_id+'">'+mydata+'</div></div></div></div>';
	
	return myval;
}

function home_page_itemcategory(category_id,items,title){
	var mydata = '';
	$.each(items, function(i,item){
		if (item){			
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

			div_all_data = "<div class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"'></div>"
									
			error_img ="onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'";

			item_other_image_div = '';
			if(item_featured=="1" && item_quantity!="0"){
				item_other_image_div = '<img src="<?= base_url() ?>img_v51/featured_img.png" class="medicine_cart_item_featured_img">';
			}

			if(item_quantity==0) {
				item_other_image_div = '<img src="<?= base_url() ?>img_v51/out_of_stock_img.png" class="medicine_cart_item_out_of_stock_img">';
			}

			item_scheme_div = "";
			if(item_scheme!="0+0") {
				item_scheme_div = '<div class="medicine_cart_item_scheme">Scheme : '+item_scheme+'</div>';
			}

			mydata+= '<div class="item"><div class="featured_brand_home_div text-center"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')">'+item_other_image_div+'<img src="'+item_image+'" alt="" '+error_img+' class="medicine_cart_item_image"></a><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')"><div class="medicine_cart_item_name">'+item_name+'<span class="medicine_cart_item_packing"> ('+item_packing+' Packing)</span></div><div class="medicine_cart_item_margin">'+item_margin+'% Margin*</div><div class="medicine_cart_item_company">By '+item_company+'</div>'+item_scheme_div+'<div class="medicine_cart_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/-</div><div class="medicine_cart_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/-</div><div class="medicine_cart_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</div></a></div></div>';
		}
	});
	
	myval = '<div class="col-xs-12 col-sm-12 col-12"><div class="featured_home_title1"><div class="heading_home1"><span class=""><a href="<?= base_url(); ?>category/itemcategory/'+category_id+'">'+title+'</a></span></div></div><div class="row"><div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12"><div class="owl-carousel owl-carousel'+category_id+'">'+mydata+'</div></div></div></div>';
	
	return myval;
}

function home_page_invoice(category_id,items,title){
	var mydata = '';
	$.each(items, function(i,item){
		if (item){
			item_id	 		= item.item_id;
			item_title 		= item.item_title;
			item_total 		= item.item_message;
			item_date_time 	= item.item_date_time;
			out_for_delivery= item.out_for_delivery;
			delete_status	= item.delete_status;
			download_url	= item.download_url;
			item_image 		= item.item_image;

			if(out_for_delivery!="")
			{
				out_for_delivery = ' | Out For Delivery Date Time : ' + out_for_delivery;
			}
			delete_status_div = "";
			if(delete_status==1)
			{
				delete_status_div = '<div class="medicine_cart_item_datetime">Some items have been deleted / modified in this order</div>';
			}
			
			mydata+='<div class="main_theme_li_bg"><div class="medicine_my_page_div1"><a href="<?php echo base_url() ?>my_invoice_details/'+item_id+'"><img src="'+item_image+'" alt="" title="" onerror=this.src="<?= base_url(); ?>/uploads/default_img.jpg" class="medicine_cart_item_image"></a></div><div class="medicine_my_page_div2 text-left"><div class=""><a href="<?php echo base_url() ?>my_invoice_details/'+item_id+'"><span class="medicine_cart_item_name">'+item_title+'</span></a><span style="float: right;color: red;"><a href="'+download_url+'" style="color: red;">Download Invoice</a></span></div><a href="<?php echo base_url() ?>my_invoice_details/'+item_id+'"><div class="medicine_cart_item_price">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_total+'/-</div><div class="medicine_cart_item_datetime">Invoice Date : '+item_date_time+''+out_for_delivery+'</div>'+delete_status_div+'</div></a></div>';
		}
	});
	
	myval = '<div class="col-sm-6 wow fadeInLeft animated" data-wow-duration="0.10s" data-wow-delay="0.2s"><div class="home_page_new_box_inv_title"><a href="<?= base_url() ?>my_invoice" title="My invoice">My invoice</a></div><div class="website_box_part home_page_new_box_inv p-2">'+mydata+'</div></div>';
	
	return myval;
}

function home_page_notification(category_id,items,title){
	var mydata = '';
	$.each(items, function(i,item){
		if (item){
			item_id 			= item.item_id;
			item_title 			= item.item_title;
			item_message 		= item.item_message;
			item_date_time 		= item.item_date_time;
			item_image 			= item.item_image;
			
			mydata+='<div class="main_theme_li_bg"><a href="<?php echo base_url() ?>my_notification_details/'+item_id+'"><div class="medicine_my_page_div1"><img src="'+item_image+'" alt="" title="" onerror=this.src="<?= base_url(); ?>/uploads/default_img.jpg" class="medicine_cart_item_image"></div><div class="medicine_my_page_div2 text-left"><div class="medicine_cart_item_name">'+item_title+'</div><div class="medicine_cart_item_price">'+item_message+'</div><div class="medicine_cart_item_datetime">'+item_date_time+'</div></div></a></div>';
		}
	});
	
	myval = '<div class="col-sm-6 wow fadeInRight animated" data-wow-duration="0.10s" data-wow-delay="0.2s"><div class="home_page_new_box_inv_title"><a href="<?= base_url() ?>my_notification" title="My notification">My notification</div><div class="website_box_part home_page_new_box_inv p-2">'+mydata+'</div></div>';
	
	return myval;
}

function home_page_owl_load(category_id){
	//alert(category_id)
    $(".owl-carousel"+category_id).owlCarousel({
        items: 10, // Number of items to display
        loop: true, // Enable loop
        margin: 4, // Margin between items
        autoplay: true, // Enable autoplay
        autoplayTimeout: 5000, // Autoplay interval in milliseconds
        responsiveClass:true,
		nav: true,
        responsive:{
            0:{
                items:3,
            },
            768:{
                items:5,
            },
            1024:{
                items:7,
            }
			,1280:{
                items:8,
            }
        }
    });
}

/*************************************** */
var my_notification_no_record_found = 0;
var my_invoice_no_record_found = 0;
var local_myid = '';
var query_work = 0;
var next_id = "";
function home_page_api(seq_id)
{
	$('.myloading').show();
	$(".home_page_my_notification").html('<div><center><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px"></center></div><div><center>Loading....</center></div>');
	$(".home_page_my_invoice").html('<div><center><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px"></center></div><div><center>Loading....</center></div>');

	query_work = 1;
	//alert(id);
	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       :  {seq_id:seq_id} ,
		url        : "<?php echo base_url(); ?>home/home_page_api",
		cache	   : true,
		success : function(data){
			$('.myloading').hide();
			if(data!="")
			{
				query_work = 0;
				console.log("query_work:"+query_work)
				$('.myloading').hide();
				$.each(data.get_result, function(i,row){
					//alert(row.myid);
					$(".main_loading_css").hide();	
					items = row.items;
					title = row.title;

					category_id = row.category_id;
					page_type = row.page_type;

					next_id = row.next_id;

					if(page_type=="invoice") {
						dt_result = home_page_invoice(category_id,items,title);
						$(".home_page_invoice_notification_data").append(dt_result);
					}

					if(page_type=="notification") {
						dt_result = home_page_notification(category_id,items,title);
						$(".home_page_invoice_notification_data").append(dt_result);
					}
					
					if(page_type=="menu") {
						dt_result = home_page_menu(category_id,items,title);
						$(".home_page_menu_data").html(dt_result);
					}
					
					if(page_type=="slider") {
						dt_result = home_page_slider(category_id,items,title);
						if(category_id=="1"){
							$(".home_page_slider1_data").html(dt_result);
							jssor_1_slider_init();
						}
						if(category_id=="2"){
							$(".home_page_all_data").append(dt_result);
							jssor_2_slider_init();
						}
					}
					if(page_type=="divisioncategory") {
						dt_result = home_page_divisioncategory(category_id,items,title);
						if(category_id=="1"){
							$(".home_page_divisioncategory1_data").append(dt_result);
						}else{
							$(".home_page_all_data").append(dt_result);
						}
						home_page_owl_load(category_id);
					}
					
					if(page_type=="itemcategory") {
						dt_result = home_page_itemcategory(category_id,items,title);
						$(".home_page_all_data").append(dt_result);
						home_page_owl_load(category_id);
					}
				});
			}
		},
		timeout: 10000
	});
}

$(document).ready(function() {
	get_top_menu_api();
	home_page_api(1);
	home_page_api(2);
	home_page_api(3);
	home_page_api(4);
	home_page_api(5);
	
    $(window).scroll(function(){
		console.log("scrollTop"+$(window).scrollTop())
		console.log("document-height"+$(window).scrollTop())
		console.log("window-height"+$(window).scrollTop())
		//if(($(window).scrollTop() == ($(document).height() - $(window).height())) && query_work==0){
		if($(window).scrollTop() >=1000 && query_work==0){
			home_page_api(next_id);
		}
    });
});

function load_more(){
	home_page_api(next_id);
}

function download_invoice(url){
	window.open(url, '_blank');
	window.close();
}
</script>
<script src="<?php echo base_url(); ?>/assets/website/wow_css_js/wow.js"></script>
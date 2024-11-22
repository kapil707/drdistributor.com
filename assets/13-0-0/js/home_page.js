var my_notification_no_record_found = 0;
var my_invoice_no_record_found = 0;
var local_myid = '';
var query_work = 0;
var next_id = "";

$(document).ready(function() {
	setTimeout(function() {
		get_broadcast_message();
	}, 3000);
	home_page_menu();
	get_top_menu_api();
	home_page_main_api("1,2,4,5");

	$(window).scroll(function(){
		var scrollBottom = $(".main_container").height() - $(window).height() - $(window).scrollTop();
		if (scrollBottom<600  && query_work==0){
			home_page_main_api(next_id);
		}
	});
});

function get_broadcast_message(){
	$.ajax({
        type: "POST",
        url: get_base_url() + "My_broadcast_api/my_broadcast_api",
        cache: false,
        dataType: 'json',
        success: function(response) {
            if (response.success === "1") {
				$('#myModal_broadcast').modal('show');
                response.items.forEach(item => {
					$('.broadcast_title').text(item.item_title);
					$('.broadcast_message').text(item.item_message);
                });
            }
        },
        error: function(xhr, status, error) {
            
        }
    });
}

function home_page_menu(){

	var myArray = [
		{
			"menu_id": "1",
			"menu_name": "New Order",
			"menu_image": get_base_url()+'assets/'+getWebJs()+'/images/homebtn1.png',
			"menu_url": "medicine_search"
		},
		{
			"menu_id": "2",
			"menu_name": "My Cart",
			"menu_image": get_base_url()+'assets/'+getWebJs()+'/images/homebtn2.png',
			"menu_url": "my_cart"
		},
		{
			"menu_id": "3",
			"menu_name": "My Order",
			"menu_image": get_base_url()+'assets/'+getWebJs()+'/images/homebtn3.png',
			"menu_url": "my_order"
		},
		{
			"menu_id": "4",
			"menu_name": "My Invoice",
			"menu_image": get_base_url()+'assets/'+getWebJs()+'/images/homebtn4.png',
			"menu_url": "my_invoice"
		},
		{
			"menu_id": "5",
			"menu_name": "Track Order",
			"menu_image": get_base_url()+'assets/'+getWebJs()+'/images/homebtn5.png',
			"menu_url": "track_order"
		},
		{
			"menu_id": "6",
			"menu_name": "Upload Order",
			"menu_image": get_base_url()+'assets/'+getWebJs()+'/images/homebtn6.png',
			"menu_url": "import_order"
		},
		{
			"menu_id": "7",
			"menu_name": "Notification",
			"menu_image": get_base_url()+'assets/'+getWebJs()+'/images/homebtn7.png',
			"menu_url": "my_notification"
		}
	];
	var mydata = '';
	$.each(myArray, function(i,item){
		if (item){
			
			menu_id 	= item.menu_id;
			menu_name 	= item.menu_name;
			menu_image 	= item.menu_image;
			menu_url 	= get_base_url() + item.menu_url;
			
			mobile_off_cls = "";
			if(menu_id==6){
				mobile_off_cls = "mobile_off";
			}

			mydata+='<div class="home_page_menu_div wow fadeInDown animated '+mobile_off_cls+'" data-wow-duration="0.1s" data-wow-delay="0.2s"><a href="'+menu_url+'" style="color:black"><div class="text-center"><img src="'+menu_image+'" class="img-fluid img-responsive" alt><div class="home_page_menu_div_btn">'+menu_name+'</div></div></a></div>';
		}
	});
	
	myval = '<div class="col-xs-12 col-sm-12 col-12 col-padding-5">'+mydata+'</div>';	
	//return myval;
	$(".home_page_menu_data").html(myval);
}

function get_top_menu_api(){
	myid = '';
	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       : {myid:myid} ,
		url        : get_base_url() + "home_api/get_top_menu_api",
		cache : true,
		success : function(data){
			if(data!="") {
				$(".top_bar_menu2").show();
				$.each(data.items, function(i,item){
					if (item){
						item_code	 	= item.item_code;
						item_company	= item.item_company;
						item_image	 	= item.item_image;
						item_url	 	= get_base_url() + "c/"+item.item_url;

						$(".top_bar_menu2_ul").append('<li><a href="'+item_url+'"><span>'+item_company+'</span></a></li>');
					}
				});
			}
		}
	});
}

function home_page_main_api(seq_id){
	if(query_work==0)
	{
		$(".main_page_loading1").show();

		query_work = 1;
		//alert(id);
		$.ajax({
			type       : "POST",
			dataType   : "json",
			data       :  {seq_id:seq_id} ,
			url        : get_base_url() + "home_api/home_page_main_api",
			cache : true,
			error: function(){
				$(".main_page_loading1").hide();
			},
			success : function(data){
				$(".main_page_loading1").hide();
				//$(".main_loading_css").hide();
				get_my_home_response(data.items);
			},
			timeout: 60000
		});
	}
}

function get_my_home_response(items){

	$.each(items, function(i,row){
		
		items = row.items;
		title = row.title;

		/*if(items!=''){
			query_work = 0;
		}*/
		query_work = 0;
		CategoryId = row.CategoryId;
		page_type = row.page_type;

		next_id = row.next_id;

		if(page_type=="invoice") {
			dt_result = home_page_invoice(CategoryId,items,title);
			$(".home_page_invoice_notification_data").append(dt_result);
		}

		if(page_type=="notification") {
			dt_result = home_page_notification(CategoryId,items,title);
			$(".home_page_invoice_notification_data").append(dt_result);
		}
		
		if(page_type=="menu") {
			dt_result = home_page_menu(CategoryId,items,title);
			$(".home_page_menu_data").html(dt_result);
		}
		
		if(page_type=="slider") {
			dt_result = home_page_slider(CategoryId,items,title);
			if(CategoryId=="1"){
				$(".home_page_slider1_data").html(dt_result);
				jssor_1_slider_init();
			}
			if(CategoryId=="2"){
				$(".home_page_all_data").append(dt_result);
				jssor_2_slider_init();
			}
		}
		if(page_type=="divisioncategory") {
			dt_result = home_page_divisioncategory(CategoryId,items,title);
			if(CategoryId=="1"){
				$(".home_page_divisioncategory1_data").append(dt_result);
			}else{
				$(".home_page_all_data").append(dt_result);
			}
			home_page_owl_load("divisioncategory",CategoryId);
		}
		
		if(page_type=="itemcategory" && items.length != 0) {
			dt_result = home_page_itemcategory(CategoryId,items,title);
			$(".home_page_all_data").append(dt_result);
			home_page_owl_load("itemcategory",CategoryId);
		}
	});
}

function home_page_owl_load(type,CategoryId){
	if(type=="divisioncategory"){
		$(".owl-carousel"+CategoryId).owlCarousel({
			items: 3, // Number of items to display
			loop: true, // Enable loop
			margin: 2, // Margin between items
			autoplay: true, // Enable autoplay
			autoplayTimeout: 5000, // Autoplay interval in milliseconds
			responsiveClass:true,
			nav: true,
			navText: [
				"<span><i class='fa fa-angle-left' aria-hidden='true'></i></span>",
				"<span><i class='fa fa-angle-right' aria-hidden='true'></i></span>"
			],
			responsive:{
				0:{
					items:3,
				},
				500:{
					items:3,
				},
				768:{
					items:4,
				},
				1024:{
					items:5,
				}
				,1280:{
					items:6,
				}
			}
		});
	}else{
		$(".owl-carousel"+CategoryId).owlCarousel({
			items: 3, // Number of items to display
			loop: true, // Enable loop
			margin: 2, // Margin between items
			autoplay: true, // Enable autoplay
			autoplayTimeout: 5000, // Autoplay interval in milliseconds
			responsiveClass:true,
			nav: true,
			navText: [
				"<span><i class='fa fa-angle-left' aria-hidden='true'></i></span>",
				"<span><i class='fa fa-angle-right' aria-hidden='true'></i></span>"
			],
			responsive:{
				0:{
					items:3,
				},
				500:{
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
				,1500:{
					items:10,
				}
			}
		});
	}
}

function home_page_slider(CategoryId,items,title){
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

			mydata+='<a href="'+web_action+'"><div><img src="'+image+'" data-u="image" class="img_css_for_slider" alt=""></div></a>';
		}
	});
	
	myval = '<div class="col-xs-12 col-sm-12 col-12 col-padding-5"><div id="jssor_'+CategoryId+'"><div data-u="slides" class="top_flash_div">'+mydata+'</div><div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75"><div data-u="prototype" class="i" style="width:16px;height:16px;"><svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><circle class="b" cx="8000" cy="8000" r="5800"></circle></svg></div></div><div data-u="arrowleft" class="jssora_arrowleft" data-autocenter="2" data-scale="0.75" data-scale-left="0.75"><span><i class="fa fa-angle-left" aria-hidden="true"></i></span></div><div data-u="arrowright" class="jssora_arrowright" data-autocenter="2" data-scale="0.75" data-scale-right="0.75"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span></div></div></div>';
	
	return myval;
}


function home_page_divisioncategory(CategoryId,items,title){
	var mydata = '';
	$.each(items, function(i,item){
		if (item){			
			item_code 		= item.item_code;
			item_company 	= item.item_company;
			item_division 	= item.item_division;
			item_image 		= item.item_image;

			CategoryName = item_company.replace(" ", "-");
			CategoryName = CategoryName.replace(" ", "-");
			CategoryName = CategoryName.replace(" ", "-");
			CategoryName = CategoryName.replace(" ", "-");
			CategoryName = CategoryName.replace(" ", "-");

			mydata+= '<div class="item"><div class="all_divisioncategory text-center"><a href="'+get_base_url()+'c/'+CategoryName+'/'+item_division+'"><img class="all_item_image" src="uploads/division_category_default_img.webp" alt=""><img class="all_item_image_load" src="'+item_image+'" alt="" onload="showActualImage(this)" style="display:none;"></a><a href="'+get_base_url()+'c/'+CategoryName+'/'+item_division+'"><div class="home_page_item_company">'+item_company+'</div></a></div></div>';
		}
	});
	
	myval = '<div class="col-xs-12 col-sm-12 col-12 col-padding-5"><div class="home_page_heading"><div class="home_page_heading_title"><span class="">'+title+'</span></div></div><div class="row"><div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-12 col-12 mobile_off"><img src="'+get_base_url()+'assets/'+getWebJs()+'/images/heart.png" width="100%" class=""></div><div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-12 col-12"><div class="owl-carousel owl-carousel'+CategoryId+'">'+mydata+'</div></div></div></div>';
	
	return myval;
}

function home_page_itemcategory(CategoryId,items,title){
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

			item_batch_no		= "xxxxxx";
			item_expiry 		= "00/00";
			item_gst 			= "0";
			item_description1 	= "";
			similar_items 		= "";

			div_all_data = "<div class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_batch_no='"+item_batch_no+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_gst='"+item_gst+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"'></div>";

			item_other_image_div = '';
			if(item_featured=="1" && item_quantity!="0"){
				item_other_image_div = '<img src="'+get_base_url()+'assets/'+getWebJs()+'/images/featured_img.png" class="all_item_featured_img">';
			}

			if(item_quantity==0) {
				item_other_image_div = '<img src="'+get_base_url()+'assets/'+getWebJs()+'/images/out_of_stock_img.png" class="all_item_out_of_stock_img">';
			}

			item_scheme_div = "";
			if(item_scheme!="0+0") {
				item_scheme_div = '<div class="all_item_scheme">Scheme : '+item_scheme+'</div>';
			}

			mydata+= '<div class="item"><div class="all_itemcategory text-center" title="'+item_name+'"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')">'+item_other_image_div+'<img class="all_item_image" src="uploads/default_img.webp" alt=""><img class="all_item_image_load" src="'+item_image+'" alt="" onload="showActualImage(this)" onerror="setDefaultImage(this);" style="display:none;"><div class="all_item_name">'+item_name+'<span class="all_item_packing"> ('+item_packing+' Packing)</span></div><div class="all_item_margin">'+item_margin+'% Margin*</div><div class="all_item_company">By '+item_company+'</div>'+item_scheme_div+'<div class="all_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/-</div><div class="all_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/-</div><div class="all_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</div></a></div>'+div_all_data+'</div>';
		}
	});

	CategoryName = title.replace(" ", "-");
	CategoryName = CategoryName.replace(" ", "-");
	CategoryName = CategoryName.replace(" ", "-");
	CategoryName = CategoryName.replace(" ", "-");
	
	myval = '<div class="col-xs-12 col-sm-12 col-12 col-padding-5"><div class="home_page_heading"><div class="home_page_heading_title"><span class=""><a href="'+get_base_url()+'c/'+CategoryName+'">'+title+'</a></span></div></div><div class="row"><div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12"><div class="owl-carousel owl-carousel'+CategoryId+'">'+mydata+'</div></div></div></div>';
	
	return myval;
}

function home_page_invoice(CategoryId,items,title){
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
				delete_status_div = '<div class="all_item_date_time">Some items have been deleted / modified in this order</div>';
			}
			
			mydata+='<div class="main_box_div_data"><div class="home_page_box_left_div"><a href="'+get_base_url()+'mid/'+item_id+'"><img src="'+item_image+'" alt="" title="" onerror="setDefaultImage(this);" class="all_item_image"></a></div><div class="home_page_box_right_div text-left"><div class=""><a href="'+get_base_url()+'mid/'+item_id+'"><span class="all_item_title">'+item_title+'</span></a><span style="float: right;"><a href="'+download_url+'" class="all_item_download">Download Excel</a></span></div><a href="'+get_base_url()+'mid/'+item_id+'"><div class="all_item_total">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_total+'/-</div><div class="all_item_date_time">Invoice Date : '+item_date_time+''+out_for_delivery+'</div>'+delete_status_div+'</div></a></div>';
		}
	});
	
	myval = '<div class="col-sm-6 wow fadeInLeft animated web-col-padding-5 col-padding-5" data-wow-duration="0.10s" data-wow-delay="0.2s"><div class="home_page_heading_title2"><a href="'+get_base_url()+'mi" title="My invoice">My invoice</a></div><div class="">'+mydata+'</div></div>';
	
	return myval;
}

function home_page_notification(CategoryId,items,title){
	var mydata = '';
	$.each(items, function(i,item){
		if (item){
			item_id 			= item.item_id;
			item_title 			= item.item_title;
			item_message 		= item.item_message;
			item_date_time 		= item.item_date_time;
			item_image 			= item.item_image;
			
			mydata+='<div class="main_box_div_data"><a href="'+get_base_url()+'mnd/'+item_id+'"><div class="home_page_box_left_div"><img src="'+item_image+'" alt="" title="" onerror="setDefaultImage(this);" class="all_item_image"></div><div class="home_page_box_right_div text-left"><div class="all_item_title">'+item_title+'</div><div class="all_item_message">'+item_message+'</div><div class="all_item_date_time">'+item_date_time+'</div></div></a></div>';
		}
	});
	
	myval = '<div class="col-sm-6 wow fadeInRight animated web-col-padding-5 col-padding-5" data-wow-duration="0.10s" data-wow-delay="0.2s"><div class="home_page_heading_title2"><a href="'+get_base_url()+'mn" title="My notification">My notification</div><div class="">'+mydata+'</div></div>';
	
	return myval;
}

/*************************************** */
function load_more(){
	home_page_api(next_id);
}

function download_invoice(url){
	window.open(url, '_blank');
	window.close();
}

/************************************ */
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
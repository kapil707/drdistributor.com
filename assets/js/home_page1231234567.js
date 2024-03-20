function home_page_owl_load(category_id){
	//alert(category_id)
    $(".owl-carousel"+category_id).owlCarousel({
        items: 3, // Number of items to display
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


function get_top_menu_api(){
	myid = '';
	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       :  {myid:myid} ,
		url        : get_base_url() + "home/get_top_menu_api",
		cache	   : true,
		success : function(data){
			if(data!="") {
				$(".top_bar_menu2").show();
				$.each(data.items, function(i,item){
					if (item){
						item_code	 	= item.item_code;
						item_company	= item.item_company;
						item_image	 	= item.item_image;
						item_url	 	= get_base_url() + "category/"+item.item_url;

						$(".top_bar_menu2_ul").append('<li><a href="'+item_url+'"><span>'+item_company+'</span></a></li>');
					}
				});
			}
		}
	});
}

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

			mydata+='<a href="'+web_action+'"><div><img src="'+image+'" data-u="image" class="img_css_forslider" alt="" onerror="setDefaultImage(this);"></div></a>';
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
			menu_url 	= get_base_url() + item.menu_url;
			
			mobile_off_cls = "";
			if(menu_id==6){
				mobile_off_cls = "mobile_off";
			}

			mydata+='<div class="home_page_menu_div wow fadeInDown animated '+mobile_off_cls+'" data-wow-duration="0.1s" data-wow-delay="0.2s"><a href="'+menu_url+'" style="color:black"><div class="text-center"><img src="'+menu_image+'" class="img-fluid img-responsive" alt><div class="home_page_menu_div_btn">'+menu_name+'</div></div></a></div>';
		}
	});
	
	myval = '<div class="col-xs-12 col-sm-12 col-12">'+mydata+'</div>';	
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

			mydata+= '<div class="item"><div class="all_divisioncategory text-center"><a href="'+get_base_url()+'category/featured_brand/'+item_code+'/'+item_division+'"><img src="'+item_image+'" alt=""></a><a href="'+get_base_url()+'category/featured_brand/'+item_code+'/'+item_division+'"><div class="home_page_item_company">'+item_company+'</div></a></div></div>';
		}
	});
	
	myval = '<div class="col-xs-12 col-sm-12 col-12"><div class="home_page_heading"><div class="home_page_heading_title"><span class="">'+title+'</span></div></div><div class="row"><div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-12 col-12 mobile_off"><img src="'+get_base_url()+'img_v51/heart.png" width="100%" class=""></div><div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-12 col-12"><div class="owl-carousel owl-carousel'+category_id+'">'+mydata+'</div></div></div></div>';
	
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

			item_description1 	= "";
			similar_items 		= "";
			item_expiry 		= "";

			div_all_data = "<span class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"'></span>"

			item_other_image_div = '';
			if(item_featured=="1" && item_quantity!="0"){
				item_other_image_div = '<img src="'+get_base_url()+'img_v51/featured_img.png" class="all_item_featured_img">';
			}

			if(item_quantity==0) {
				item_other_image_div = '<img src="'+get_base_url()+'img_v51/out_of_stock_img.png" class="all_item_out_of_stock_img">';
			}

			item_scheme_div = "";
			if(item_scheme!="0+0") {
				item_scheme_div = '<div class="all_item_scheme">Scheme : '+item_scheme+'</div>';
			}

			mydata+= '<div class="item"><div class="all_itemcategory text-center" title="'+item_name+'"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')">'+item_other_image_div+'<img src="'+item_image+'" alt="'+item_name+'" onerror="setDefaultImage(this);" class="all_item_image"><div class="all_item_name">'+item_name+'<span class="all_item_packing"> ('+item_packing+' Packing)</span></div><div class="all_item_margin">'+item_margin+'% Margin*</div><div class="all_item_company">By '+item_company+'</div>'+item_scheme_div+'<div class="all_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/-</div><div class="all_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/-</div><div class="all_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</div></a></div>'+div_all_data+'</div>';
		}
	});
	
	myval = '<div class="col-xs-12 col-sm-12 col-12"><div class="home_page_heading"><div class="home_page_heading_title"><span class=""><a href="'+get_base_url()+'category/itemcategory/'+category_id+'">'+title+'</a></span></div></div><div class="row"><div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12"><div class="owl-carousel owl-carousel'+category_id+'">'+mydata+'</div></div></div></div>';
	
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
				delete_status_div = '<div class="all_item_date_time">Some items have been deleted / modified in this order</div>';
			}
			
			mydata+='<div class="main_box_div_data"><div class="home_page_box_left_div"><a href="'+get_base_url()+'my_invoice_details/'+item_id+'"><img src="'+item_image+'" alt="" title="" onerror="setDefaultImage(this);" class="all_item_image"></a></div><div class="home_page_box_right_div text-left"><div class=""><a href="'+get_base_url()+'my_invoice_details/'+item_id+'"><span class="all_item_title">'+item_title+'</span></a><span style="float: right;"><a href="'+download_url+'" class="all_item_download">Download Excel</a></span></div><a href="'+get_base_url()+'my_invoice_details/'+item_id+'"><div class="all_item_total">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_total+'/-</div><div class="all_item_date_time">Invoice Date : '+item_date_time+''+out_for_delivery+'</div>'+delete_status_div+'</div></a></div>';
		}
	});
	
	myval = '<div class="col-sm-6 wow fadeInLeft animated" data-wow-duration="0.10s" data-wow-delay="0.2s"><div class="home_page_heading_title2"><a href="'+get_base_url()+'my_invoice" title="My invoice">My invoice</a></div><div class="main_box_div p-2">'+mydata+'</div></div>';
	
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
			
			mydata+='<div class="main_box_div_data"><a href="'+get_base_url()+'my_notification_details/'+item_id+'"><div class="home_page_box_left_div"><img src="'+item_image+'" alt="" title="" onerror="setDefaultImage(this);" class="all_item_image"></div><div class="home_page_box_right_div text-left"><div class="all_item_title">'+item_title+'</div><div class="all_item_message">'+item_message+'</div><div class="all_item_date_time">'+item_date_time+'</div></div></a></div>';
		}
	});
	
	myval = '<div class="col-sm-6 wow fadeInRight animated" data-wow-duration="0.10s" data-wow-delay="0.2s"><div class="home_page_heading_title2"><a href="'+get_base_url()+'my_notification" title="My notification">My notification</div><div class="main_box_div p-2">'+mydata+'</div></div>';
	
	return myval;
}

/*************************************** */
var my_notification_no_record_found = 0;
var my_invoice_no_record_found = 0;
var local_myid = '';
var query_work = 0;
var next_id = "";
function home_page_api(seq_id)
{
	$('load_more').hide();
	$('.myloading').show();
	
	$(".home_page_my_notification").html('<div><center><img src="'+get_base_url()+'/img_v51/loading.gif" width="100px"></center></div><div><center>Loading....</center></div>');
	$(".home_page_my_invoice").html('<div><center><img src="'+get_base_url()+'/img_v51/loading.gif" width="100px"></center></div><div><center>Loading....</center></div>');

	query_work = 1;
	//alert(id);
	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       :  {seq_id:seq_id} ,
		url        : get_base_url() + "home/home_page_api",
		cache	   : true,
		error: function(){
			$('.myloading').hide();
			$('load_more').hide();
		},
		success : function(data){
			//console.log(data);
			$('.myloading').hide();
			$('load_more').show();
			if(data!="")
			{
				query_work = 0;
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
		timeout: 60000
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
		var scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
		if (scrollBottom<600  && query_work==0){
			home_page_api(next_id);
		}
	});
	
    // $(window).scroll(function(){
	// 	console.log("scrollTop"+$(window).scrollTop())
	// 	console.log("document-height"+$(window).scrollTop())
	// 	console.log("window-height"+$(window).scrollTop())
	// 	//if(($(window).scrollTop() == ($(document).height() - $(window).height())) && query_work==0){
	// 	if($(window).scrollTop() >1000 && query_work==0){
	// 		home_page_api(next_id);
	// 	}
    // });
});

function load_more(){
	home_page_api(next_id);
}

function download_invoice(url){
	window.open(url, '_blank');
	window.close();
}
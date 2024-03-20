$(document).ready(function(){
	call_page();
});
function call_page()
{
	$(".top_bar_title2").html("Loading....");
	$(".main_page_loading").html('<h2><center><img src="'+get_base_url()+'/img_v51/loading.gif" width="100px"></center></h2><h2><center>Loading....</center></h2>');
	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       : {item_id:item_id} ,
		url        : get_base_url()+"my_notification/my_notification_details_api",
		cache	   : false,
		error: function(){
			$(".main_page_loading").html('<h2><center><img src="'+get_base_url()+'/img_v51/no_record_found.png" width="100%"></center></h2>');
			$(".top_bar_title2").html("No record found");
		},
		success    : function(data){
			$(".main_page_loading").html("");
			if(data.items=="") {
				$(".main_page_loading").html('<h2><center><img src="'+get_base_url()+'/img_v51/no_record_found.png" width="100%"></center></h2>');
				$(".top_bar_title2").html("No record found");
			}
			
			if (data.title!="") {
				$(".top_bar_title").html(data.title);
			}
			$.each(data.items, function(i,item){	
				if (item){
					item_id 			= item.item_id;
					item_title 			= item.item_title;
					item_message 		= item.item_message;
					item_date_time 		= item.item_date_time;
					item_image 			= item.item_image;
					item_image2			= item.item_image2;
					item_fun_type 		= item.item_fun_type;
					item_fun_name 		= item.item_fun_name;
					item_fun_id 		= item.item_fun_id;
					item_fun_id2 		= item.item_fun_id2;
					function_call = "#";
					if(item_fun_type=="1")
					{
						function_call = "javascript:"+item_fun_name+"('"+item_fun_id+"')";
					}
					if(item_fun_type=="2")
					{
						if(item_fun_id2=="")
						{
							item_fun_id2 = "not";
						}
						function_call = get_base_url() + item_fun_name+"/"+item_fun_id + "/" + item_fun_id2;
					}
					if(item_fun_type=="3"){
						function_call = get_base_url() + item_fun_id;
					}
					if(item_fun_type=="4"){
						function_call = get_base_url() + item_fun_id;
					}
					if(item_fun_type=="5"){
						function_call = get_base_url() + item_fun_id;
					}
					if(item_image2)
					{
						item_image2 = "<img src='"+item_image2+"' class='medicine_cart_item_image'>";
					}
					$(".main_page_data").append('<div class="main_box_div_data"><a href="'+function_call+'"><div class="all_page_details_page_box_left_div"><img src="'+item_image+'" alt="" title="" onerror="setDefaultImage(this);" class="all_item_image"></div><div class=all_page_details_page_box_right_div text-left"><div class="medicine_cart_item_name">'+item_title+'</div><div class="all_items_message">'+item_message+'</div><div class="medicine_cart_item_date_time">'+item_date_time+'</div><div class="medicine_cart_item_date_time">'+item_image2+'</div></div></a></div>');
					
					$(".main_page_data").show();
					$(".top_bar_title2").html(item_date_time);
				}
			});
		},
		timeout: 10000
	});
}
function callandroidfun(funtype,id,compname,image,division) {
	if(funtype=="1"){
		android.fun_Get_single_medicine_info(id);
	}
	if(funtype=="2"){
		compname = atob(compname);
		android.fun_Featured_brand_medicine_division(id,compname,image,division);
	}
	if(funtype=="3"){
		window.location.href = get_base_url()+"map"
	}
	if(funtype=="4"){
		window.location.href = get_base_url()+"my_orders"
	}
	if(funtype=="5"){
		window.location.href = get_base_url()+"my_invoice"
	}
}
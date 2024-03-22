$(document).ready(function(){
	call_page();
});
function call_page()
{	
	/*********************************** */
	$(".top_bar_title2").html("Loading....");
	$(".main_container").show();
	$(".main_page_loading").show();
	$(".main_page_no_record_found").hide();
	$(".main_page_something_went_wrong").hide();
	/*********************************** */
	
	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       : {item_id:item_id,user_altercode:user_altercode},
		url        : get_base_url() + "my_order/my_order_details_main_api",
		cache	   : false,
		error: function(){
			$(".top_bar_title2").html("No record found");
			$(".main_container").hide();
			$(".main_page_loading").hide();
			$(".main_page_something_went_wrong").show();
		},
		success    : function(data){
			
			$(".main_page_loading").hide();
			if(data.items=="") {
				$(".top_bar_title2").html("No record found");
				$(".main_container").hide();
				$(".main_page_no_record_found").show();
			}
			
			if (data.title!="") {
				$(".top_bar_title").html(data.title);
			}

			if (data.download_url!="") {
				$(".download_excel_url").html("<a href="+data.download_url+"><button type='button' class='btn btn-warning btn-block main_theme_button'>Download Excel</button></a>");
			}
			
			$.each(data.items, function(i,item){	
				if (item)
				{
					item_code 			= item.item_code;
					item_image 			= item.item_image;
					item_name 			= item.item_name;
					item_packing 		= item.item_packing;
					item_expiry			= item.item_expiry;
					item_company 		= item.item_company;
					item_scheme 		= item.item_scheme;
					item_price 			= item.item_price;
					item_quantity 		= item.item_quantity;
					item_quantity_price = item.item_quantity_price;
					item_date_time 		= item.item_date_time;
					item_modalnumber 	= item.item_modalnumber;

					item_description1 	= "";
					similar_items 		= "";
					item_stock			= "";
					item_ptr			= "";
					item_mrp			= "";
					item_featured		= "";
					item_margin			= "";

					div_all_data = "<span class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"'></span>";
					
					item_scheme_div = "";
					if(item_scheme!="0+0")
					{
						item_scheme_div =  ' | <span class="all_item_scheme" title="'+item_name+' '+item_scheme+'">Scheme : '+item_scheme+'</span>';
					}

					rate_div = '<div class="all_item_date_time">'+item_modalnumber+' | '+item_date_time+'</div><div class=""><span class="all_item_price">Price : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</span> | <span class="all_item_total">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_quantity_price+'/-</span></div>';
					
					$(".main_page_data").append('<div class="main_box_div_data" onclick="medicine_details_funcation('+item_code+')" style="cursor: pointer;"><div class="all_page_details_page_box_left_div"><img class="all_item_image" src="'+default_img+'" alt="'+item_name+'"><img class="all_item_image_load" src="'+item_image+'" alt="'+item_name+'" onload="showActualImage(this)" onerror="setDefaultImage(this);"></div><div class="all_page_details_page_box_right_div"><div class="all_item_name" title="'+item_name+'">'+item_name+' <span class="all_item_packing">('+item_packing+' Packing)</span></div><div class="all_item_expiry">Expiry : '+item_expiry+'</div><div class="all_item_company">By '+item_company+'</div><div class="text-left all_item_order_quantity" title="'+item_name+' Quantity: '+item_quantity+'" >Order quantity : '+item_quantity+item_scheme_div+'</div><span class="mobile_off">'+rate_div+'</span></div><span class="mobile_show" style="margin-left:5px;">'+rate_div+'</span>'+div_all_data+'</div>');

					$(".top_bar_title2").html(item_date_time);
				}
			});	
		},
		timeout: 60000
	});
}
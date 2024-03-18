$(document).ready(function(){
	call_page();
});
function call_page()
{	
	$(".load_more").hide();
	$(".load_page_loading").html('<h1><center><img src="'+get_base_url()+'img_v51/loading.gif" width="100px"></center></h1><h1><center>Loading....</center></h1>');
	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       : {item_id:item_id},
		url        : get_base_url() + "my_order/my_order_details_api",
		cache	   : false,
		error: function(){
			$(".load_page_loading").html('<h1><img src="'+get_base_url()+'img_v51/something_went_wrong.png" width="100%"></h1>');
		},
		success    : function(data){
			$(".load_page_loading").html("");
			if(data.items=="") {
				$(".load_page_loading").html('<h1><center><img src="'+get_base_url()+'img_v51/no_record_found.png" width="100%"></center></h1>');
			}
			
			if (data.title!="") {
				$(".headertitle").html(data.title);
			}
			$.each(data.items, function(i,item){	
				if (item)
				{
					item_id 			= item.item_id;
					item_code 			= item.item_code;
					item_quantity 		= item.item_quantity;
					item_image 			= item.item_image;
					item_name 			= item.item_name;
					item_packing 		= item.item_packing;
					item_expiry			= item.item_expiry;
					item_company 		= item.item_company;
					item_scheme 		= item.item_scheme;
					item_price 			= item.item_price;
					item_quantity_price = item.item_quantity_price;
					item_date_time 		= item.item_date_time;
					item_modalnumber 	= item.item_modalnumber;
					
					image_div = '<img src="'+item_image+'" style="width: 100%;cursor: pointer;" class="medicine_cart_item_image"  onerror="setDefaultImage(this);">';
					
					item_scheme_div = "";
					if(item_scheme!="0+0")
					{
						item_scheme_div =  ' | <span class="medicine_cart_item_scheme" title="'+item_name+' '+item_scheme+'">Scheme : '+item_scheme+'</span>';
					}
					rate_div = '<div class="cart_ki_main_div3 medicine_cart_item_datetime">'+item_modalnumber+' | '+item_date_time+'</div><div class="cart_ki_main_div3"><span class="medicine_cart_item_price2">Price : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</span> | <span class="medicine_cart_item_price">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_quantity_price+'/-</span></div>';
					
					$(".load_page").append('<div class="main_theme_li_bg" onclick="get_single_medicine_info('+item_code+')" style="cursor: pointer;"><div class="medicine_cart_div1">'+image_div+'</div><div class="medicine_cart_div2"><div class="medicine_cart_item_name" title="'+item_name+'">'+item_name+' <span class="medicine_cart_item_packing">('+item_packing+' Packing)</span></div><div class="medicine_cart_item_expiry">Expiry : '+item_expiry+'</div><div class="medicine_cart_item_company">By '+item_company+'</div><div class="text-left medicine_cart_item_order_quantity" title="'+item_name+' Quantity: '+item_quantity+'" >Order quantity : '+item_quantity+item_scheme_div+'</div><span class="mobile_off">'+rate_div+'</span></div><span class="mobile_show" style="margin-left:5px;">'+rate_div+'</span></div>');
					$(".load_page").show();
				}
			});	
		},
		//timeout: 10000
	});
}
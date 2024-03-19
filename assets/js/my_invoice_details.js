$(document).ready(function(){
	call_page();
});
function call_page()
{
	$(".load_page_loading").html('<h2><center><img src="'+get_base_url()+'img_v51/loading.gif" width="100px"></center></h2><h2><center>Loading....</center></h2>');
	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       : {item_id:item_id} ,
		url        : get_base_url()+ "my_invoice/my_invoice_details_api",
		cache	   : false,
		error: function(){
			$(".load_page_loading").html('<h2><img src="'+get_base_url()+'img_v51/something_went_wrong.png" width="100%"></h2>');
		},
		success    : function(data){
			$(".load_page_loading").html("");
			if(data.items=="")
			{
				$(".load_page_loading").html('<h2><center><img src="'+get_base_url()+'img_v51/no_record_found.png" width="100%"></center></h2>');
			}
			
			if (data.title!="") {
				$(".top_bar_title").html(data.title);
			}

			if (data.download_url!="") {
				$(".download_excel_url").html("<a href="+data.download_url+"><button type='button' class='btn btn-warning btn-block'>Download Excel</button></a>");
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
					
					image_div = '<img src="'+item_image+'" style="width: 100%;cursor: pointer;" class="all_item_image" onerror="setDefaultImage(this);">';
					
					item_scheme_div = "";
					if(item_scheme!="0+0")
					{
						item_scheme_div =  ' | <span class="all_item_scheme" title="'+item_name+' '+item_scheme+'">Scheme : '+item_scheme+'</span>';
					}
					rate_div = '<div class="all_item_date_time">'+item_modalnumber+' | '+item_date_time+'</div><div class=""><span class="all_item_price">Price : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</span> | <span class="all_item_total">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_quantity_price+'/-</span></div>';
					
					$(".main_page_data").append('<div class="main_box_div_data" onclick="get_single_medicine_info('+item_code+')" style="cursor: pointer;"><div class="all_page_details_page_box_left_div">'+image_div+'</div><div class="all_page_details_page_box_right_div"><div class="all_item_name" title="'+item_name+'">'+item_name+' <span class="all_item_packing">('+item_packing+' Packing)</span></div><div class="all_item_expiry">Expiry : '+item_expiry+'</div><div class="all_item_company">By '+item_company+'</div><div class="text-left all_item_order_quantity" title="'+item_name+' Quantity: '+item_quantity+'" >Order quantity : '+item_quantity+item_scheme_div+'</div><span class="mobile_off">'+rate_div+'</span></div><span class="mobile_show" style="margin-left:5px;">'+rate_div+'</span></div>');
					$(".main_page_data").show();
				}
			});	
			$.each(data.items_edit, function(i,item){	
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
					item_description1	= item.item_description1;
					
					image_div = '<img src="'+item_image+'" style="width: 100%;cursor: pointer;" class="all_item_image" onerror="setDefaultImage(this);">';
					
					item_scheme_div = "";
					if(item_scheme!="0+0")
					{
						item_scheme_div =  ' | <span class="all_item_scheme" title="'+item_name+' '+item_scheme+'">Scheme : '+item_scheme+'</span>';
					}
					rate_div = '<div class="all_item_date_time">'+item_modalnumber+' | '+item_date_time+'</div><div class=""><span class="all_item_price">Price : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</span> | <span class="all_item_total">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_quantity_price+'/-</span></div>';
					
					$(".main_page_data_edit").append('<div class="main_box_div_data" onclick="get_single_medicine_info('+item_code+')" style="cursor: pointer;"><div class="all_page_details_page_box_left_div">'+image_div+'</div><div class="all_page_details_page_box_right_div"><div class="all_item_name" title="'+item_name+'">'+item_name+' <span class="all_item_packing">('+item_packing+' Packing)</span></div><div class="all_item_expiry">Expiry : '+item_expiry+'</div><div class="all_item_company">By '+item_company+'</div><div class="text-left all_item_order_quantity" title="'+item_name+' Quantity: '+item_quantity+'" >Order quantity : '+item_quantity+item_scheme_div+'</div><span class="mobile_off">'+rate_div+'</span></div><span class="mobile_show" style="margin-left:5px;">'+rate_div+'</span><div class="all_item_description1">'+item_description1+'</div></div>');
					$(".div_item_edit").show();
					$(".main_page_data_edit").show();
				}
			});	
			
			$.each(data.items_delete, function(i,item){	
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
					item_description1	= item.item_description1;
					
					image_div = '<img src="'+item_image+'" style="width: 100%;cursor: pointer;" class="all_item_image" onerror="setDefaultImage(this);">';

					item_scheme_div = "";
					if(item_scheme!="0+0")
					{
						item_scheme_div =  ' | <span class="all_item_scheme" title="'+item_name+' '+item_scheme+'">Scheme : '+item_scheme+'</span>';
					}
					rate_div = '<div class="all_item_date_time">'+item_modalnumber+' | '+item_date_time+'</div><div class=""><span class="all_item_price">Price : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</span> | <span class="all_item_total">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_quantity_price+'/-</span></div>';
					
					$(".load_page_delete").append('<div class="main_box_div_data" onclick="get_single_medicine_info('+item_code+')" style="cursor: pointer;"><div class="all_page_details_page_box_left_div">'+image_div+'</div><div class="all_page_details_page_box_right_div"><div class="all_item_name" title="'+item_name+'">'+item_name+' <span class="all_item_packing">('+item_packing+' Packing)</span></div><div class="all_item_expiry">Expiry : '+item_expiry+'</div><div class="all_item_company">By '+item_company+'</div><div class="text-left all_item_order_quantity" title="'+item_name+' Quantity: '+item_quantity+'" >Order quantity : '+item_quantity+item_scheme_div+'</div><span class="mobile_off">'+rate_div+'</span></div><span class="mobile_show" style="margin-left:5px;">'+rate_div+'</span><div class="all_item_description1">'+item_description1+'</div></div>');
					$(".main_page_data_delete").show();
					$(".load_page_delete").show();
				}
			});
		},
		timeout: 60000
	});
}
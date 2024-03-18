$(window).scroll(function(){
	var scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
	if (scrollBottom<100){
		//alert(parseInt($(window).scrollTop()))
		$(".load_more").click()
	}
});
$(document).ready(function(){
	get_record=$(".get_record").val();
	call_page(get_record)
});
function load_more()
{
	get_record=$(".get_record").val();
	call_page(get_record)
}
var query_work = 0;
var no_record_found = 0;
function call_page(get_record)
{
	if(query_work=="0")
	{
		query_work = 1;
		$(".load_more").hide();
		$(".load_page_loading").html('<div><center><img src="'+get_base_url()+'/img_v51/loading.gif" width="100px"></center></div><div><center>Loading....</center></div>');
		$.ajax({
			type       : "POST",
			data       :  {item_page_type:item_page_type,item_code:item_code,item_division:item_division,get_record:get_record} ,
			url        : get_base_url()+"category/api/medicine_category_api",
			cache	   : false,
			error: function(){
				$(".load_page_loading").html("");
				$(".load_page").html('<div><img src="'+get_base_url()+'img_v51/something_went_wrong.png" width="100%"></div>');
			},
			success    : function(data){
				if(data.items=="")
				{
					if(no_record_found=="0")
					{
						$(".load_page_loading").html("");
						$(".load_page").html('<div><center><img src="'+get_base_url()+'/img_v51/no_record_found.png" width="100%"></center></div>');
					}
					else
					{
						$(".load_page_loading").html("");
						//$(".load_page").html("");
					}
				}
				else
				{
					$(".load_page_loading").html("");
				}
				title 	= data.title;
				if(title!=""){
					$(".headertitle").html(title);
				}
				get_record 	= data.get_record;
				$(".get_record").val(get_record);
				$.each(data.items, function(i,item){
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
							item_other_image_div = '<img src="'+get_base_url()+'img_v51/featured_img.png" class="medicine_cart_item_featured_img">';
						}

						if(item_quantity==0) {
							item_other_image_div = '<img src="'+get_base_url()+'img_v51/out_of_stock_img.png" class="medicine_cart_item_out_of_stock_img">';
						}

						item_scheme_div = "";
						if(item_scheme!="0+0") {
							item_scheme_div = '<div class="all_item_scheme">Scheme : '+item_scheme+'</div>';
						}
						
						$(".load_page").append('<div class="col-sm-3 col-6 p-0 m-0 text-center"><div class="medicine_category_page text-center" title="'+item_name+'"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')">'+item_other_image_div+'<img src="'+item_image+'" alt="'+item_name+'" onerror="setDefaultImage(this);" class="all_item_image"><div class="all_item_name">'+item_name+'<span class="all_item_packing"> ('+item_packing+' Packing)</span></div><div class="all_item_margin">'+item_margin+'% Margin*</div><div class="all_item_company">By '+item_company+'</div>'+item_scheme_div+'<div class="all_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/-</div><div class="all_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/-</div><div class="all_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</div></a></div>'+div_all_data+'</div>');

						query_work = 0;
						no_record_found = 1;
						$(".load_more").show();
					}
				});
			},
			timeout: 10000
		});
	}
}
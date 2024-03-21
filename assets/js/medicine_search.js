function cart_page_load(){

	$(".search_page_div_for_fix_height").css("height",$(window).height() - 240)

	$(".top_bar_search_div").hide();
	$(".top_bar_search_textbox_div").show();

	$('.medicine_search_textbox').val("");
	$('.medicine_search_textbox').show();
	$('.medicine_search_textbox').focus();

	my_cart_api();
	get_medicine_favourite();
}

function get_medicine_favourite() {
	id = "";
	$.ajax({
		url: get_base_url() + "medicine_details/get_medicine_favourite_api",
		type	:"POST",
		dataType: "json",
		cache: true,
		data: {id:id},
		error: function(){
			$(".get_medicine_favourite_api_div").html('<h2><img src="'+ get_base_url()+'img_v51/something_went_wrong.png" width="100%"></h2>');
		},
		success: function(data){
			if(data.items==""){
				$(".get_medicine_favourite_api_div").html('<div class="row p-2" style="background:var(--main_theme_white_background_color);"><div class="col-sm-12 text-center"><h2><img src="'+ get_base_url()+'/img_v51/no_record_found.png" width="100%"></h2></div></div>');
				$(".header_result_found").html("No record found");
			}else{
				$(".get_medicine_favourite_api_div").html('');
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

					div_all_data = "<div class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"'></div>"
					
					$(".get_medicine_favourite_api_div").append('<div class="main_box_div_data"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')" style="text-decoration: none;"><div class="favourite_medicines_box_left_div"><img class="all_item_image" src="'+default_img+'" alt="'+item_name+'"><img class="all_item_image_load" src="'+item_image+'" alt="'+item_name+'" onload="showActualImage(this)" onerror="setDefaultImage(this);"></div><div class="favourite_medicines_box_right_div"><div class="text-capitalize all_item_name">'+item_name+'</div><div class="text-left all_item_order_quantity">Last order quantity : '+item_quantity+'</div></div></a></div>'+div_all_data);
				}
			});
		},
		timeout: 10000
	});
}

function current_order_ref()
{
	my_cart_api();
}

function clear_search_icon()
{
	$(".search_result_div").html("");
	$(".search_result_div").hide();

	$(".medicine_search_textbox").val("");
	$('.medicine_search_textbox').focus();

	$(".top_bar_search_textbox_div_menu_icon").hide();
	$(".top_bar_search_textbox_div_menu").hide();

	$(".top_bar_search_textbox_div_clear_icon").hide();	
	$(".background_blur").hide();

	$(".search_pg_current_order").show();
	$(".search_pg_result_found").hide();
}
function menu_search_icon() {
	$(".top_bar_search_textbox_div_menu").show();
}
$(document).ready(function(){	
	$(".medicine_search_textbox").keyup(function(e){
		if(e.keyCode == 8)
		{
			var keyword = $(".medicine_search_textbox").val();
			if(keyword!="")
			{
				if(keyword.length<3)
				{
					$('.medicine_search_textbox').focus();
					$(".search_result_div").html("");
				}
			}
			else{
				clear_search_icon();
			}
		}
	})  
	$(".medicine_search_textbox").keypress(function() { 
		var keyword = $(".medicine_search_textbox").val();
		//$('.headertitle').html(keyword)
		if(keyword!="")
		{
			if(keyword.length<3)
			{
				$('.medicine_search_textbox').focus();
				$(".search_result_div").html("");
			}
			if(keyword.length>2)
			{
				//medicine_search_api();
				setTimeout('medicine_search_api();',500);
			}
		}
		else{
			clear_search_icon();
		}
	});
	$(".medicine_search_textbox").change(function() { 
	});
	$(".medicine_search_textbox").on("search", function() { 
	});
	
    $(".medicine_search_textbox").keydown(function(event) {
    	if(event.key=="ArrowDown")
    	{
			page_up_down_arrow("1");
    		$('.hover_1').attr("tabindex",-1).focus();
			return false;
    	}
    });
	setTimeout('cart_page_load();',100);
	
	document.onkeydown = function(evt) {
		evt = evt || window.event;
		if (evt.keyCode == 27) {
			clear_search_icon();
		}
	};
});

function page_up_down_arrow(new_i)
{
	$('.hover_'+new_i).keypress(function (e) {
		 if (e.which == 13) {
			$('.medicine_details_funcation_'+new_i).click();
		 } 						 
	 });
	$('.hover_'+new_i).keydown(function(event) {
		if(event.key=="ArrowDown")
		{
			new_i = parseInt(new_i) + 1;
			page_up_down_arrow(new_i);
			$('.hover_'+new_i).attr("tabindex",-1).focus();
			return false;
		}
		if(event.key=="ArrowUp")
		{
			if(parseInt(new_i)==1)
			{
				var searchInput = $('.medicine_search_textbox');
				var strLength = searchInput.val().length * 2;

				searchInput.focus();
				searchInput[0].setSelectionRange(strLength, strLength);
			}
			else
			{
				new_i = parseInt(new_i) - 1;
				page_up_down_arrow(new_i);
				$('.hover_'+new_i).attr("tabindex",-1).focus();
			}
			return false;
		}
	});
}

function cart_empty_btn()
{
	swal("Your cart is empty");
}
function view_cart_btn()
{
	window.location.href= get_base_url() + "my_cart";
}

function medicine_search_api()
{
	$(".search_pg_current_order").hide();
	$(".search_pg_result_found").show();

	new_i = 0;

	$(".top_bar_search_textbox_div_menu_icon").show();
	$(".top_bar_search_textbox_div_clear_icon").show();

	var keyword = $(".medicine_search_textbox").val();
	//$('.headertitle').html(keyword)
	if(keyword!="")
	{
		if(keyword=="#")
		{
			keyword = "k1k2k12k";
		}
		if(keyword.length>1)
		{
			total_rec 				= $(".medicine_total_rec").val();
			checkbox_medicine 		= $(".checkbox_medicine").val();
			checkbox_company  		= $(".checkbox_company").val();
			checkbox_out_of_stock 	= $(".checkbox_out_of_stock").val();
			
			checkbox_medicine_val = checkbox_company_val = checkbox_out_of_stock_val = 0;
			checkbox_out_of_stock_val = 1; // yha default ha
			if($(".checkbox_medicine").prop("checked") == true){
                checkbox_medicine_val = 1;
            }
			if($(".checkbox_company").prop("checked") == true){
                checkbox_company_val = 1;
            }
			if($(".checkbox_out_of_stock").prop("checked") == true){
                checkbox_out_of_stock_val = 1;
				//console.log(checkbox_out_of_stock_val)
            }
			
			$(".background_blur").show();
			$(".search_result_div").show();
			$(".search_result_div").html('<div class="row p-2" style="background:var(--main_theme_white_background_color);"><div class="col-sm-12 text-center"><h2><img src="'+ get_base_url()+'/img_v51/loading.gif" width="100px"></h2><h2>Loading....</h2></div></div>');
			$(".header_result_found").html("Loading....");
			$.ajax({
			type       : "POST",
			dataType   : "json",
			data       :  {keyword:keyword,total_rec:total_rec,checkbox_medicine_val:checkbox_medicine_val,checkbox_company_val:checkbox_company_val,checkbox_out_of_stock_val:checkbox_out_of_stock_val} ,
			url        : get_base_url() + "medicine_search/medicine_search_api",
			cache	   : true,
			error: function(){
				$(".search_result_div").html('<h2><img src="'+ get_base_url()+'img_v51/something_went_wrong.png" width="100%"></h2>');
				$(".top_bar_title2").html("No record found");
			},
			success    : function(data){
				if(data.items=="")
				{
					$(".search_result_div").html('<div class="row p-2" style="background:var(--main_theme_white_background_color);"><div class="col-sm-12 text-center"><h2><img src="'+ get_base_url()+'/img_v51/no_record_found.png" width="100%"></h2></div></div>');
					$(".top_bar_title2").html("No record found");
				}
				else
				{
					$(".search_result_div").html("");
					$(".top_bar_title2").html("Found result");
				}
				$.each(data.items, function(i,item){
						if (item)
						{
							new_i 				= item.item_count;
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
							item_description1 	= item.item_description;
							similar_items 		= item.similar_items;
							
							csshover1 = 'hover_'+new_i;

							div_all_data = "<div class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"'></div>"

							div_start = 'onClick=medicine_details_funcation("'+item_code+'"),clear_search_icon()';
							
							item_scheme_div = "";
							if(item_scheme!="0+0")
							{
								item_scheme_div =  ' | <span class="all_item_scheme">Scheme : '+item_scheme+'</span>';
							}

							item_other_image_div = '';
							if(item_featured=="1" && item_quantity!="0"){
								item_other_image_div = '<img src="'+ get_base_url()+'img_v51/featured_img.png" class="all_item_featured_img">';
							}

							item_quantity_div = '<span class="all_item_stock">Stock : '+item_quantity+'</span>' + item_scheme_div;
							if(item_stock!="")
							{
								item_quantity_div = '<span class="all_item_stock">'+item_stock+'</span>' + item_scheme_div;
							}

							if(item_quantity=="0"){
								item_quantity_div = '<span class="all_item_out_of_stock">Out of stock</span>';
								item_other_image_div = '<img src="'+ get_base_url()+'img_v51/out_of_stock_img.png" class="all_item_out_of_stock_img">';
							}
							
							rete_div =  '<span class="all_item_ptr" title="PTR : '+item_ptr+'">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/- </span> | <span class="all_item_mrp" title="MRP : '+item_mrp+'">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/- </span> | <span class="all_item_price" title="*Approximate ~ '+item_price+'">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/- </span>';							

							$(".search_result_div").append('<div class="main_box_div_data '+csshover1+' medicine_details_funcation_'+new_i+'" '+div_start+'><div class="medicine_search_box_left_div">'+item_other_image_div+'<img class="all_item_image" src="'+default_img+'" alt="'+item_name+'"><img class="all_item_image_load" src="'+item_image+'" alt="'+item_name+'" onload="showActualImage(this)" onerror="setDefaultImage(this);"></div><div class="medicine_search_box_right_div"><div class="all_item_name">'+item_name+'<span class="all_item_packing mobile_off"> ('+item_packing+' Packing)</span></div><div class="all_item_packing mobile_show">'+item_packing+' Packing</div><div class=""><span class="all_item_margin">'+item_margin+'% Margin* </span>| <span class="all_item_expiry">Expiry : '+item_expiry+'</span></div><div class="all_item_company">By '+item_company+'</div><div>'+item_quantity_div+'</div><div class="mobile_off">'+rete_div+'</div></div><div class="medicine_search_full_width mobile_show" style="margin-left:5px;">'+rete_div+'</div><div class="medicine_search_full_width all_item_description1">'+item_description1+'</div><div class="medicine_search_full_width medicine_cart_item_similar_items"><a href="'+get_base_url()+'medicine_category/medicine_similar/'+item_code+'">'+similar_items+'</a></div></div>'+div_all_data);
				
							$(".search_pg_result_found").html("Search result");	
							$(".top_bar_title2").html("Found result ("+new_i+")");
							
							if(new_i=="50")	{
								$(".search_result_div").append('<div style="color: green;font-weight: bold;margin: 10px" class="text-center"><a href="'+ get_base_url()+'home/search_view_all?keyword='+keyword+'">View All</a></div>');
							}
						}						
					});
				},
				timeout: 60000
			});
		}
		else{
			
			$(".top_bar_search_textbox_div_menu_icon").hide();
			$(".top_bar_search_textbox_div_menu").hide();

			$(".top_bar_search_textbox_div_clear_icon").hide();
			$(".search_result_div").html("");
		}
	}
}
function import_order_medicine_change(item_id) {

	$(".top_bar_search_div").hide();
	$(".top_bar_search_textbox_div").show();

	$('.medicine_search_textbox').val("");
	$('.medicine_search_textbox').show();
	$('.medicine_search_textbox').focus();

	hidden_item_id = item_id;
	hidden_item_name = $(".import_order_hidden_item_name_"+item_id).val();
	setTimeout($('.medicine_search_textbox').val(hidden_item_name),500);
	setTimeout(medicine_search_api(),700);
}

function import_order_medicine_change_api(selected_item_code){	


	item_id = hidden_item_id;
	hidden_item_code = $(".import_order_hidden_item_code_"+item_id).val();
	//hidden_item_code yha value wo ha jo davai ko kisi or ke sth set kar rhay ha to kam ati ha 
	if(item_id!=""){
		$.ajax({
			url: get_base_url() + "import_order/import_order_medicine_change_api",
			type:"POST",
			/*dataType: 'html',*/
			data: {item_id:item_id,item_code:hidden_item_code,selected_item_code:selected_item_code},
			cache : true,
			error: function(){
				swal("Medicine not changed");
			},
			success: function(data){
					$.each(data.items, function(i,item){	
					if (item)
					{
						if(item.status=="1")
						{
							swal("Medicine changed successfully", {
								icon: "success",
							});
							hidden_item_id = "";
							process_find_medicine(item_id)
						}
						else{
							swal("Medicine not changed");
						}
					} 
				});
			},
			timeout: 60000
		});
	}
	else{
		get_single_medicine_info(item_code); // yha popup modal open karta ha fir user add to cart kar skta ha 
	}
}
/************************************* */
function import_order_medicine_delete_suggested(item_id) {
	swal({
		title: "Are you sure to delete suggested medicine?",
		/*text: "Once deleted, you will not be able to recover this imaginary file!",*/
		icon: "warning",
		buttons: ["No", "Yes"],
		dangerMode: true,
	}).then(function(result) {
		if (result) {
			$.ajax({
				url: get_base_url() + "import_order/import_order_medicine_delete_suggested_api",
				type:"POST",
				data: {item_id:item_id},
				cache : true,
				timeout: 60000,
				error: function(){
					swal("Suggested medicine not deleted");
				},
				success: function(data){
					$.each(data.items, function(i,item){	
						if (item)
						{
							if(item.status=="1")
							{
								swal("Suggested Medicine deleted successfully", {
									icon: "success",
								});
								process_find_medicine(item_id)
							}
							else{
								swal("Suggested medicine not deleted");
							}
						} 
					});
				}
			});
		} else {
			swal("Suggested medicine not deleted");
		}
	});
}

/*************************************/
function add_new_medicine() {
	clear_search_function();
	$('.medicine_search_textbox').focus();
}
function clear_search_function() {

	$(".background_blur").hide();

	$(".search_result_div").html("");
	$(".search_result_div").hide();

	$(".search_result_div_mobile").html("");
	$(".search_result_div_mobile").hide();	

	$(".medicine_search_textbox").val("");
	$('.medicine_search_textbox').focus();

	$(".top_bar_search_textbox_div_menu_icon").hide();
	$(".top_bar_search_textbox_div_menu").hide();

	$(".top_bar_search_textbox_div_clear_icon").hide();	

	$(".my_cart_api_div_mobile").hide();

	/**************************************** */
}

/************************************* */
function import_order_page_load(){
	my_cart_api("notall"); // yha excel order ko chhod kar baki sabhi order show karay ga

	$(".top_bar_search_div").hide();
	$(".top_bar_search_textbox_div").show();

	$('.medicine_search_textbox').val("");
	$('.medicine_search_textbox').show();
	$('.medicine_search_textbox').focus();
}

function page_up_down_arrow(new_i)
{
	$('.hover_'+new_i).keypress(function (e) {
		 if (e.which == 13) {
			item_code = $(".medicine_details_funcation_"+new_i).attr("item_code");
			medicine_details_funcation(item_code);
			clear_search_function();
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

function medicine_search_api() {
	new_i = 0;

	$(".my_cart_api_div_mobile").hide();
	
	$(".top_bar_search_textbox_div_menu_icon").show();
	$(".top_bar_search_textbox_div_clear_icon").show();

	var keyword = $(".medicine_search_textbox").val();
	if(keyword!="")
	{
		if(keyword=="#")
		{
			keyword = "k1k2k12k";
		}
		if(keyword.length>2)
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
            }
			
			$(".background_blur").show();
			$(".top_bar_title2").html("Loading....");

			$(".search_result_div").show();
			$(".search_result_div").html('<div class="row"><div class="col-sm-12 text-center">'+loading_img_function()+'</div></div>');

			$(".search_result_div_mobile").show();
			$(".search_result_div_mobile").html('<div class="row"><div class="col-sm-12 text-center">'+loading_img_function()+'</div></div>');

			$.ajax({
				type       : "POST",
				data       :  {keyword:keyword,total_rec:total_rec,checkbox_medicine_val:checkbox_medicine_val,checkbox_company_val:checkbox_company_val,checkbox_out_of_stock_val:checkbox_out_of_stock_val} ,
				url        : get_base_url() + "medicine_search/medicine_search_api",
				cache : true,
				error: function(){
					$(".search_result_div").html(something_went_wrong_function());
					$(".search_result_div_mobile").html(something_went_wrong_function());
					$(".top_bar_title2").html("No record found");
				},
				cache	   : false,
				success    : function(data){
					
					$(".search_result_div").html("");
					$(".search_result_div_mobile").html("");
					if(data.items==""){
						$(".top_bar_title2").html("No record found");
						$(".search_result_div").html(no_record_found_function());
						$(".search_result_div_mobile").html(no_record_found_function());
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
							
							div_all_data = "<div class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"'></div>"
							
							item_scheme_div = "";
							if(item_scheme!="0+0")
							{
								item_scheme_div =  ' | <span class="all_item_scheme">Scheme : '+item_scheme+'</span>';
							}

							item_other_image_div = '';
							if(item_featured=="1" && item_quantity!="0"){
								item_other_image_div = '<img src="'+ get_base_url()+'assets/'+ getWebJs()+'/images/featured_img.png" class="all_item_featured_img">';
							}

							item_quantity_div = '<span class="all_item_stock">Stock : '+item_quantity+'</span>' + item_scheme_div;
							if(item_stock!="")
							{
								item_quantity_div = '<span class="all_item_stock">'+item_stock+'</span>' + item_scheme_div;
							}

							if(item_quantity=="0"){
								item_quantity_div = '<span class="all_item_out_of_stock">Out of stock</span>';
								item_other_image_div = '<img src="'+ get_base_url()+'assets/${getWebJs()}/images/out_of_stock_img.png" class="all_item_out_of_stock_img">';
							}
							
							rete_div =  '<span class="all_item_ptr" title="PTR : '+item_ptr+'">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/- </span> | <span class="all_item_mrp" title="MRP : '+item_mrp+'">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/- </span> | <span class="all_item_price" title="*Approximate ~ '+item_price+'">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/- </span>';


							onlcick_event = 'onclick=import_order_medicine_change_api("'+item_code+'"),clear_search_function()';

							
							var serach_data = '<div class="main_box_div_data hover_'+new_i+' medicine_details_funcation_'+new_i+'" '+onlcick_event+' item_code="'+item_code+'"><div class="medicine_search_box_left_div">'+item_other_image_div+'<img class="all_item_image" src="'+default_img+'" alt="'+item_name+'"><img class="all_item_image_load" src="'+item_image+'" alt="'+item_name+'" onload="showActualImage(this)" onerror="setDefaultImage(this);"></div><div class="medicine_search_box_right_div"><div class="all_item_name">'+item_name+'<span class="all_item_packing mobile_off"> ('+item_packing+' Packing)</span></div><div class="all_item_packing mobile_show">'+item_packing+' Packing</div><div class=""><span class="all_item_margin">'+item_margin+'% Margin* </span>| <span class="all_item_expiry">Expiry : '+item_expiry+'</span></div><div class="all_item_company">By '+item_company+'</div><div>'+item_quantity_div+'</div><div class="mobile_off">'+rete_div+'</div></div><div class="medicine_search_full_width mobile_show" style="margin-left:5px;">'+rete_div+'</div><div class="medicine_search_full_width all_item_description1">'+item_description1+'</div><div class="medicine_search_full_width medicine_cart_item_similar_items"><a href="'+get_base_url()+'medicine_category/medicine_similar/'+item_code+'">'+similar_items+'</a></div></div>'+div_all_data;

							$(".search_result_div").append(serach_data);
							$(".search_result_div_mobile").append(serach_data);
				
							$(".top_bar_title2").html("Found result ("+new_i+")");
							
							if(new_i=="50")	{
								$(".search_result_div").append('<div style="color: green;font-weight: bold;margin: 10px" class="text-center"><a href="'+ get_base_url()+'home/search_view_all?keyword='+keyword+'">View All</a></div>');
								$(".search_result_div_mobile").append('<div style="color: green;font-weight: bold;margin: 10px" class="text-center"><a href="'+ get_base_url()+'home/search_view_all?keyword='+keyword+'">View All</a></div>');
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
			$(".search_result_div_mobile").html("");
		}
	}
}
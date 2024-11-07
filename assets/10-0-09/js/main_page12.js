function showActualImage(img) {
	img.style.display = 'block'; // Show the actual image
	img.previousElementSibling.style.display = 'none'; // Hide the default image
}

function setDefaultImage(image) {
	image.onerror = default_img;
}

function new_style_menu_show(){
	$(".left_menu_bar").show(500);
}

function new_style_menu_hide(){
	$(".left_menu_bar").hide(500);
}
function loading_img_function(){
	return '<h2><img src="'+ get_base_url()+'assets/'+getWebJs()+'/images/loading.gif" width="100px"></h2><h2>Loading....</h2>';
}
function no_record_found_function(){
	return '<h2><img src="'+ get_base_url()+'assets/'+getWebJs()+'/images/no_record_found.png" width="100%"></h2>';
}
function something_went_wrong_function(){
	return '<h2><img src="'+get_base_url()+'assets/'+getWebJs()+'/images/something_went_wrong.png" width="100%"></h2>';
}
function cart_emtpy_function(){
	return '<h2><center><img src="'+get_base_url()+'assets/'+getWebJs()+'/images/cart_empty.png" width="80%"></center></h2>';
}

function logout_function(){
	swal({
		title: "Are you sure to Logout?",
		/*text: "Once deleted, you will not be able to recover this imaginary file!",*/
		icon: "warning",
		buttons: ["No", "Yes"],
		dangerMode: true,
	}).then(function(result) {
		if (result) {
			$.ajax({
				type       : "GET",
				url        : get_base_url() +"logout",
				cache : true,
				success : function(data){
					if(data!="")
					{
						$.each(data.items, function(i,item){	
							if (item){
								location.reload();
							}
						});	
					}
				},
			});
		} 
	});
}

function theme_set()
{
	theme_set_css = $(".theme_set_css").val()
	$.ajax({
		type       : "POST",
		data       :  { theme_set_css:theme_set_css} ,
		url        : get_base_url() + "home/theme_set_api",
		cache : true,
		success : function(data){
			if(data!="")
			{
				$.each(data.items, function(i,item){	
					if (item){
						location.reload();
					}
				});	
			}
		},
	});
}

function callandroidfun(funtype,id,compname,image,division) {	
	if(funtype=="1"){
		//android.fun_Get_single_medicine_info(id);
		get_single_medicine_info(id);
	}
	if(funtype=="2")
	{
		window.location.href = get_base_url() + 'c/fb/'+id+'/'+division;
	}
}

function gosearchpage() {
	window.location.href = get_base_url() + "ms";
}

$(document).ready(function(){

	$('.medicine_details_item_order_quantity_textbox').keypress(function (e) {
		if (e.which == 13) {

			item_order_quantity	= $(".medicine_details_item_order_quantity_textbox").val();
			$(".add_to_cart_error_message").html('');
			if(item_order_quantity==""){
				$(".add_to_cart_error_message").html('Enter quantity');
				$(".medicine_details_item_order_quantity_textbox").focus();
				
			}else{
				medicine_add_to_cart_api();
			}
		} 
	});
	
	var getUserId = get_UserId();
	if(getUserId=="" || getUserId==null)
	{
	}else{
		/******************************** */
		get_my_cart_total_api();
		/******************************** */
	}
});

function get_my_cart_total_api(){

	/******************************** */
	setTimeout('get_my_cart_total_api();',120000);
	/******************************** */
	$.ajax({
		type : "POST",
		url  : get_base_url() + "my_cart/my_cart_total_api",
		cache : true,
		error: function(){
		},
		success    : function(data){
			$.each(data.items, function(i,item){
				if (item)
				{
					items_price = item.items_price;
					items_total = item.items_total;
					status = item.status;
					status_message = item.status_message;
					$(".search_cart_footer_div_total_price").html('<i class="fa fa-inr"></i>'+items_price+'/-');
					$(".search_cart_footer_div_total_items").html("My cart ("+items_total+")");
					$(".search_cart_page_total_cart_items").html("("+items_total+")");
					$(".place_order_message").html(status_message);
					$(".top_bar_title2").html("My cart ("+items_total+")");

					$(".search_cart_delete_all_btn").show();
		
					$(".top_bar_menu_cart_span").html(items_total);
					$(".top_bar_menu_delete_all_btn").show();
					if(items_total==0)
					{
						/**********only for search page********** */
						if(get_page_name=="medicine_search"){
							$(".medicine_search_page_cart_emtpy").show()
							$(".medicine_search_page_cart_emtpy").html(cart_emtpy_function())
						}
						/**********only for cart page********** */
						if(get_page_name=="my_cart"){
							$(".main_page_cart_emtpy").show();
		
							$(".main_container").hide()
							$(".search_cart_footer_div").hide()
						}
						/************************************* */

						$(".top_bar_title2").html("Your cart is empty");

						$(".search_cart_footer_div_cart_empty").show();
						$(".search_cart_footer_div_add_to_cart").hide();
						$(".cart_footer_div_can_not_place_order_btn").hide();
						$(".cart_footer_div_place_order_btn").hide();

						$(".search_cart_delete_all_btn").hide();
						$(".top_bar_menu_delete_all_btn").hide();
					}
					if(items_total!=0)
					{
						/**********only for search page********** */
						if(get_page_name=="medicine_search"){
							$(".medicine_search_page_cart_emtpy").hide()
						}
						/**********only for cart page********** */
						if(get_page_name=="my_cart"){
							$(".main_page_cart_emtpy").hide();

							$(".main_container").show()
							$(".search_cart_footer_div").show()
						}
						/************************************* */

						$(".search_cart_footer_div_add_to_cart").show();
						if(status==1)
						{
							$(".search_cart_footer_div_cart_empty").hide();
							$(".cart_footer_div_can_not_place_order_btn").hide();
							$(".place_order_message").html('');
							$(".cart_footer_div_place_order_btn").show();
						}
						else{
							$(".search_cart_footer_div_cart_empty").hide();
							$(".cart_footer_div_can_not_place_order_btn").show();
							$(".cart_footer_div_place_order_btn").hide();
						}
					}
				}
			});
		}
	});
}

function get_single_medicine_info(item_code)
{
	var getUserId = get_UserId();
	if(getUserId=="" || getUserId==null)
	{
		window.location.href = get_base_url();
	} else 
	{
		$('.medicine_details_item_order_quantity_textbox').val('');
		$('.myModal_medicine_details').click();
		$(".medicine_details_api_loading").show();
		$(".medicine_details_api_data").hide();
		$(".medicine_details_item_description1").hide();
		$(".medicine_details_item_description2").hide();

		medicine_details_api(item_code);
	}
}

function medicine_details_funcation(item_code)
{	
	var getUserId = get_UserId();
	if((getUserId=="" || getUserId==null) && get_page_name!="medicine_details")
	{
		window.location.href = get_base_url() + "home";
	} else {		
		medicine_details_get(item_code);
		medicine_details_api(item_code);
		//setTimeout(medicine_details_api(item_code),500);// its on header page

		$('.search_textbox').val("");
		$(".search_medicine_result").html("");
		$(".myModal_medicine_details").click();
	}
}

function medicine_details_api(item_code)
{
	/***************************************************************** */
	//$('.order_quantity_div').hide();
	$('.medicine_details_item_add_to_cart_btn').html("Add to cart");
	$('.medicine_details_item_add_to_cart_btn_disable').html("Add to cart");

	item_date_time = item_batch_no = item_gst = item_description2 = "";

	if(get_page_name=="medicine_details"){
		/*********************************** */
		$(".top_bar_title").html("Loading....");
		$(".main_container").show();
		$(".main_page_loading").show();
		$(".main_page_no_record_found").hide();
		$(".main_page_something_went_wrong").hide();
		/*********************************** */
	}

	$.ajax({
		url: get_base_url() + "medicine_details/medicine_details_api",
		type:"POST",
		dataType: 'json',
		data: {item_code:item_code},
		cache : true,
		error: function(){
			if(get_page_name=="medicine_details"){
				$(".top_bar_title").html("No record found");
				$(".main_container").hide();
				$(".main_page_loading").hide();
				$(".main_page_something_went_wrong").show();
			}
		},
		success: function(data){
			if(get_page_name=="medicine_details"){
				$(".main_page_loading").hide();
				if(data.items=="") {
					$(".top_bar_title").html("No record found");
					$(".main_container").hide();
					$(".main_page_no_record_found").show();
				}
			}
			$.each(data.items, function(i,item){	
				if (item)
				{
					if(get_page_name=="medicine_details"){
						$(".top_bar_title").html(item.item_name);
						document.title = item.item_name;
						$(".main_container").show();
					}

					item_date_time	= item.item_date_time;
					$(".medicine_details_item_date_time").html("as on " + item_date_time)

					item_batch_no	= item.item_batch_no;
					$(".medicine_details_item_batch_no").html("Batch no : "+item_batch_no)

					item_gst	= item.item_gst;
					$(".medicine_details_item_gst").html("GST : "+item_gst +"%")

					$(".medicine_details_item_description2").show()
					item_description2	= item.item_description2;
					$(".medicine_details_item_description2").html(item_description2)
					if(item_description2=="")
					{
						$(".medicine_details_item_description2").hide()
					}
					/************************************************** */
					item_order_quantity	= item.item_order_quantity;	
					/************************************************** */				

					item_name		= item.item_name;
					item_packing	= item.item_packing;
					item_expiry		= item.item_expiry;
					item_company	= item.item_company;
					item_quantity	= item.item_quantity;
					item_stock		= item.item_stock;
					item_ptr		= item.item_ptr;
					item_mrp		= item.item_mrp;
					item_price		= item.item_price;
					item_scheme		= item.item_scheme;
					item_margin		= item.item_margin;
					item_featured	= item.item_featured;
					item_description1= item.item_description1;
					
					// firebase code
					medicine_details_api_data(item_code)
					/*************************************************************** */
					item_image	= item.item_image;
					$('.big1').html('<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails"><a href="'+item_image+'"><img src="'+item_image+'" width="100%" style="float: right;margin-top:10px;" class="medicine_details_image" alt="zoom" loading="lazy" onerror="setDefaultImage(this);"/></a></div>');
					$('.easyzoom').easyZoom();
					/*************************************************************** */

					item_image	= item.item_image;
					$(".modal_item_image_change1").attr("src",item_image)
					item_image2	= item.item_image2;
					$(".modal_item_image_change2").attr("src",item_image2)
					item_image3	= item.item_image3;
					$(".modal_item_image_change3").attr("src",item_image3)
					item_image4	= item.item_image4;
					$(".modal_item_image_change4").attr("src",item_image4)
				}
			});	
		},
		timeout: 60000
	});
}

function medicine_details_get(item_code)
{	
	item_image = $(".medicine_details_all_data_"+item_code).attr("item_image")
	item_name = $(".medicine_details_all_data_"+item_code).attr("item_name")
	item_packing = $(".medicine_details_all_data_"+item_code).attr("item_packing")
	item_batch_no = $(".medicine_details_all_data_"+item_code).attr("item_batch_no")
	item_expiry = $(".medicine_details_all_data_"+item_code).attr("item_expiry")
	item_company = $(".medicine_details_all_data_"+item_code).attr("item_company")
	item_quantity = $(".medicine_details_all_data_"+item_code).attr("item_quantity")
	item_stock = $(".medicine_details_all_data_"+item_code).attr("item_stock")
	item_ptr = $(".medicine_details_all_data_"+item_code).attr("item_ptr")
	item_mrp = $(".medicine_details_all_data_"+item_code).attr("item_mrp")
	item_price = $(".medicine_details_all_data_"+item_code).attr("item_price")
	item_gst = $(".medicine_details_all_data_"+item_code).attr("item_gst")
	item_scheme = $(".medicine_details_all_data_"+item_code).attr("item_scheme")
	item_margin = $(".medicine_details_all_data_"+item_code).attr("item_margin")
	item_featured = $(".medicine_details_all_data_"+item_code).attr("item_featured")
	item_description1 = $(".medicine_details_all_data_"+item_code).attr("item_description1")
	item_order_quantity = $(".medicine_details_all_data_"+item_code).attr("item_order_quantity")
	
	item_date_time = item_description2 = "";
	$(".medicine_details_item_date_time").html("Loading....")
	$(".medicine_details_item_description2").html("")

	medicine_details_api_data(item_code) // its on header page
}

function medicine_details_api_data(item_code)
{
	$(".medicine_details_api_data").show();
	$(".medicine_details_api_loading").hide();

	/***********************important ************************/
	$('.medicine_details_item_code').val(item_code);
	/********************************************************/

	$(".medicine_details_featured_img").hide()
	$(".medicine_details_out_of_stock_img").hide()	

	$(".medicine_details_image").attr("src",item_image)
	$(".medicine_details_image_small").attr("src",item_image)

	$(".medicine_details_item_name").html(item_name)
	$(".medicine_details_item_packing").html("Packing : "+item_packing)
	$(".medicine_details_item_batch_no").html("Batch no : "+item_batch_no)

	$(".medicine_details_item_margin").html(item_margin+'% Margin*')
	$(".medicine_details_item_expiry").html("Expiry : "+item_expiry)
	$(".medicine_details_item_company").html("By "+item_company)
	$(".medicine_details_item_scheme").html("Scheme : " +item_scheme)

	/**************************************** */
	$(".medicine_details_item_stock").html("Stock : " +item_quantity)
	if(item_stock!=0){
		$(".medicine_details_item_stock").html("Stock : "+item_stock);
	}
	/**************************************** */
	
	$(".medicine_details_item_description1").hide()
	if(item_description1!=""){
		$(".medicine_details_item_description1").show()
		$(".medicine_details_item_description1").html(item_description1)
	}

	/******************************************************************* */
	$(".medicine_details_item_ptr").html('PTR : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_ptr + "/-")
	$(".medicine_details_item_mrp").html('MRP : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_mrp + "/-")
	$(".medicine_details_item_gst").html("GST : "+item_gst +"%")
	$(".medicine_details_item_price").html('*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_price + "/-")
	$(".medicine_details_item_total").html('*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_price + "/-")
	/******************************************************************* */

	$(".medicine_details_item_scheme_line").show()
	$(".medicine_details_item_scheme").show()
	if(item_scheme=="0+0"){
		$(".medicine_details_out_of_stock_img").hide()
		$(".medicine_details_item_scheme_line").hide()
		$(".medicine_details_item_scheme").hide()
	}

	if(item_featured=="1" && item_quantity!="0"){
		$(".medicine_details_featured_img").show()
	}

	/******************************************************************* */
	$(".medicine_details_item_add_to_cart_btn").hide()
	$(".medicine_details_item_add_to_cart_btn_disable").show()
	$(".order_quantity_div").show()
	if(parseInt(item_quantity)==0){
		$(".order_quantity_div").hide()		
		$(".medicine_details_out_of_stock_img").show()
		$(".medicine_details_item_stock").html("<font color=red>Out of stock</font>")
	}

	/******************************************************************* */
	$(".medicine_details_item_order_quantity_hidden").val(item_quantity)
	if(item_order_quantity!=""){
		$(".medicine_details_item_order_quantity_textbox").val(item_order_quantity)
		$('.medicine_details_item_add_to_cart_btn').html("Update cart");
		$('.medicine_details_item_add_to_cart_btn_disable').html("Update cart");
	}
	$(".medicine_details_item_order_quantity_textbox").focus()
}

function change_item_order_quantity(){

	$(".add_to_cart_error_message").html('');
	$(".medicine_details_item_add_to_cart_btn").hide();
	$(".medicine_details_item_add_to_cart_btn_disable").show();

	item_order_quantity	 = $(".medicine_details_item_order_quantity_textbox").val();	
	if(item_order_quantity==""){
		$(".medicine_details_item_total").html('*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_price + "/-");
	}else{
		item_order_quantity  = parseInt(item_order_quantity);
		if(item_order_quantity==0){
			$(".add_to_cart_error_message").html('Minimum order quantity one and more than one');
		}else{
			if(item_order_quantity<=parseInt(item_quantity)){
				item_price_calculate = parseFloat(item_price) * item_order_quantity;

				item_price_calculate = item_price_calculate.toFixed(2);

				$(".medicine_details_item_total").html('Total : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_price_calculate + "/-");

				$(".medicine_details_item_add_to_cart_btn").show();
				$(".medicine_details_item_add_to_cart_btn_disable").hide();
				
			}else{
				$(".add_to_cart_error_message").html('Enter maximum quantity '+item_quantity+' only');
			}
		}	
	}
}

function medicine_add_to_cart_api()
{	
	item_quantity_add	= $(".medicine_details_item_order_quantity_hidden").val();
	item_order_quantity	= $(".medicine_details_item_order_quantity_textbox").val();
	item_code			= $(".medicine_details_item_code").val();

	$("#my_cart_main_id_"+item_code).html('');

	$(".add_to_cart_error_message").html('');
	if(item_order_quantity==""){
		$(".add_to_cart_error_message").html('Enter quantity');
		$(".medicine_details_item_order_quantity_textbox").focus();
	}
	else
	{
		item_order_quantity = parseInt(item_order_quantity);
		item_quantity_add	= parseInt(item_quantity_add);
		if(item_order_quantity!=0)
		{
			if(item_order_quantity<=item_quantity_add)
			{
				$(".modaloff").click();				
				$('.medicine_search_textbox').focus();

				/*if(get_page_name=="import_order"){
					order_type = "notall";
				}else{
					order_type = "all";
				}*/

				if(get_page_name=="medicine_search" || get_page_name=="my_cart"){
					
					div_all_data = "<span class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='' item_stock='' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='' item_order_quantity='"+item_order_quantity+"'></span>";

					item_id 			= "0";
					item_quantity_price = parseFloat(item_order_quantity) * parseFloat(item_price);
					item_quantity_price = item_quantity_price.toFixed(2)
					item_datetime 		= "Just now";
					item_modalnumber 	= "PC / Laptop";

					item_other_image_div = '';
					if(item_featured=="1"){
						item_other_image_div = '<img src="'+ get_base_url()+'assets/'+getWebJs()+'/images/featured_img.png" class="all_item_featured_img">';
					}
					
					item_scheme_div = "";
					if(item_scheme!="0+0")
					{
						item_scheme_div =  ' | <span class="all_item_scheme" title="'+item_name+' '+item_scheme+'">Scheme : '+item_scheme+'</span>';
					}

					rate_div = '<div><span class="all_item_price" title="*Approximate ~">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</span> | <span class="all_item_total">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_quantity_price+'/-</span></div><div><span class="all_item_model_number">'+item_modalnumber+'</span> | <span class="all_item_date_time">'+item_datetime+'</span><span style="float:right;"><a href="javascript:delete_medicine('+item_code+')" tabindex="-10" title="Delete '+item_name+'"><i class="fa fa-trash-o all_item_delete_btn" aria-hidden="true" style="margin-right:5px;"></i></a>&nbsp;<a href="javascript:medicine_details_funcation('+item_code+')" tabindex="-10" title="Edit '+item_name+'" class="edit_item_focues'+item_code+'"><i class="fa fa-pencil all_item_edit_btn" aria-hidden="true"></i></a>&nbsp;&nbsp;</div>';
					
					var my_cart_data = '<span id="my_cart_main_id_'+item_code+'"><div class="main_box_div_data"><div class="my_cart_box_left_div"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')">'+item_other_image_div+'<img class="all_item_image" src="'+default_img+'" alt="'+item_name+'"><img class="all_item_image_load" src="'+item_image+'" alt="'+item_name+'" onload="showActualImage(this)" onerror="setDefaultImage(this);"></a></div><div class="my_cart_box_right_div"><div class="all_item_name" title="'+item_name+'" onclick="medicine_details_funcation('+item_code+')" style="cursor: pointer;">'+item_name+' <span class="all_item_packing">('+item_packing+' Packing)</span></div><div class=""><span class="all_item_margin">'+item_margin+'% Margin* </span> | <span class="all_item_expiry">Expiry : '+item_expiry+'</span></div><div class="all_item_company">By '+item_company+'</div><div class="text-left all_item_order_quantity" title="'+item_name+' Quantity: '+item_order_quantity+'" >Order quantity : '+item_order_quantity+item_scheme_div+'</div><span class="mobile_off">'+rate_div+'</span></div><span class="mobile_show pl-2">'+rate_div+'</span></div>'+div_all_data+"</span>";

					$(".my_cart_api_div").prepend(my_cart_data);
					$(".my_cart_api_div_mobile").prepend(my_cart_data);
					$(".my_cart_api_div_import_order").prepend(my_cart_data);
				}

				if(get_page_name=="medicine_details"){
					$('.medicine_details_item_add_to_cart_btn').hide();
					$('.medicine_details_item_add_to_cart_btn_disable').show();

					$('.medicine_details_item_add_to_cart_btn').html("Update cart");
					$('.medicine_details_item_add_to_cart_btn_disable').html("Loading....");
				}
				
				$.ajax({
					type       : "POST",
					data       : {item_code:item_code,item_order_quantity:item_order_quantity,order_type:order_type},
					url        : get_base_url() + "my_cart/medicine_add_to_cart_api",
					cache	   : true,
					error: function(){
						swal("error add to cart")
					},
					success    : function(data){
						
						if(get_page_name!="medicine_details"){
							$(".medicine_details_item_order_quantity_textbox").val("");
						}

						/***************************** */
						get_my_cart_total_api();
						/***************************** */
						
						/***************************** */
						$.each(data.items, function(i,item){	
							if (item)
							{
								if(item.status=="1")
								{
									if(get_page_name=="medicine_details"){
										swal("Medicine added successfully");
										$('.medicine_details_item_add_to_cart_btn_disable').html("Update cart");
									}
								}
							}
						});
					},
					timeout: 60000
				});
			}
			else
			{
				swal("Enter a valid quantity");
			}
		}
		else{
			swal("Enter quantity one or more than one");
		}
	}
}

function modal_item_image_change(_id)
{
	item_image = $(".modal_item_image_change"+_id).attr("src");
	
	$('.big1').html('<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails"><a href="'+item_image+'"><img src="'+item_image+'" width="100%" style="float: right;margin-top:10px;" class="medicine_details_image" alt="zoom" loading="lazy" onerror="setDefaultImage(this);"/></a></div>');
	$('.easyzoom').easyZoom();
}

function delete_medicine(item_code) {
	swal({
		title: "Are you sure to delete medicine?",
		/*text: "Once deleted, you will not be able to recover this imaginary file!",*/
		icon: "warning",
		buttons: ["No", "Yes"],
		dangerMode: true,
	}).then(function(result) {
		if (result) 
		{
			$("#my_cart_main_id_"+item_code).html('');
			
			$.ajax({                          
				url:  get_base_url() +"my_cart/medicine_delete_api",
				type:"POST",
				dataType: 'json',
				cache : true,
				data:{item_code: item_code},
				error: function(){
					swal("Medicine not deleted");
				},
				success: function(data){
					$.each(data.items, function(i,item){	
						if (item)
						{
							if(item.status=="1")
							{
								/***************************** */
								get_my_cart_total_api();
								/***************************** */
								
								// swal("Medicine deleted successfully", {
								// 	icon: "success",
								// });
								$(".item_focues"+item_code).html('')
							}
							else{
								//swal("Medicine not deleted");
							}
						} 
					});
				},
				timeout: 60000
			});
		} else {
			//swal("Medicine not deleted");
		}
	});
}

function delete_all_medicine()
{
	swal({
		title: "Are you sure to delete all medicines?",
		/*text: "Once deleted, you will not be able to recover this imaginary file!",*/
		icon: "warning",
		buttons: ["No", "Yes"],
		dangerMode: true,
	}).then(function(result) {
		if (result) 
		{
			$(".my_cart_api_div").html('');
			$(".my_cart_api_div_mobile").html('');
			$(".my_cart_api_div_import_order").html('');

			id = "";
			$.ajax({                          
				url:  get_base_url() +"my_cart/medicine_delete_all_api",
				type:"POST",
				dataType: 'json',
				data: {id:id},
				cache : true,
				error: function(){
					swal("Medicines not deleted");
				},
				success: function(data){
					$.each(data.items, function(i,item){	
						if (item)
						{
							if(item.status==1)
							{
								/***************************** */
								get_my_cart_total_api();
								/***************************** */
								
								/*swal("Medicines deleted successfully", {
									icon: "success",
								});*/
							}
							else{
								//swal("Medicines not deleted");
							}
						} 
					});
				},
				timeout: 60000
			});
		} else {
			//swal("Medicines not deleted");
		}
	});
}
function my_cart_api(order_type="") {

	id = "";
	$.ajax({
		url: get_base_url() +"my_cart/my_cart_api",
		type	:"POST",
		dataType: "json",
		cache: true,
		data: {order_type:order_type},
		error: function(){
			$(".main_page_loading").hide();

			/**********only for cart page********** */
			if(get_page_name=="my_cart"){				
				$(".main_page_something_went_wrong").show();

				$(".main_container").hide()
				$(".search_cart_footer_div").hide()
			}
			/************************************* */
		},
		success: function(data){

			$(".my_cart_api_div").html("");
			$(".my_cart_api_div_mobile").html("");
			$(".my_cart_api_div_import_order").html("");

			$(".main_page_loading").hide();
			if(data.items=="") {				
				/**********only for cart page********** */
				if(get_page_name=="my_cart"){
					$(".main_page_cart_emtpy").show();

					$(".main_container").hide()
					$(".search_cart_footer_div").hide()
				}
			}else{
				/**********only for cart page********** */
				if(get_page_name=="my_cart"){
					$(".main_page_cart_emtpy").hide();

					$(".main_container").show()
					$(".search_cart_footer_div").show()
				}
				/************************************* */
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
					item_quantity 		= "1";//item.item_quantity;
					item_stock 			= "Available";//item.item_stock;
					item_ptr 			= "00.00";//item.item_ptr;
					item_mrp 			= "00.00";//item.item_mrp;
					item_price 			= item.item_price;
					item_scheme 		= item.item_scheme;
					item_margin 		= item.item_margin;
					item_featured 		= item.item_featured;
					item_description1 	= "";//item.item_description1;
					similar_items 		= "";//item.similar_items;
					//new add for last order qty
					item_order_quantity = item.item_order_quantity;

					item_batch_no   = "xxxxxx";
					item_gst		= "0";

					div_all_data = "<span class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_batch_no='"+item_batch_no+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_gst='"+item_gst+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"' item_order_quantity='"+item_order_quantity+"'></span>";

					item_id 			= item.item_id;
					item_quantity_price = item.item_quantity_price;
					item_datetime 		= item.item_date_time;
					item_modalnumber 	= item.item_modalnumber;

					item_other_image_div = '';
					if(item_featured=="1"){
						item_other_image_div = '<img src="'+ get_base_url()+'assets/'+getWebJs()+'/images/featured_img.png" class="all_item_featured_img">';
					}
					
					item_scheme_div = "";
					if(item_scheme!="0+0")
					{
						item_scheme_div =  ' | <span class="all_item_scheme" title="'+item_name+' '+item_scheme+'">Scheme : '+item_scheme+'</span>';
					}

					rate_div = '<div><span class="all_item_price" title="*Approximate ~">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</span> | <span class="all_item_total">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_quantity_price+'/-</span></div><div><span class="all_item_model_number">'+item_modalnumber+'</span> | <span class="all_item_date_time">'+item_datetime+'</span><span style="float:right;"><a href="javascript:delete_medicine('+item_code+')" tabindex="-10" title="Delete '+item_name+'"><i class="fa fa-trash-o all_item_delete_btn" aria-hidden="true" style="margin-right:5px;"></i></a>&nbsp;<a href="javascript:medicine_details_funcation('+item_code+')" tabindex="-10" title="Edit '+item_name+'" class="edit_item_focues'+item_code+'"><i class="fa fa-pencil all_item_edit_btn" aria-hidden="true"></i></a>&nbsp;&nbsp;</div>';
					
					var my_cart_data = '<span id="my_cart_main_id_'+item_code+'"><div class="main_box_div_data"><div class="my_cart_box_left_div"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')">'+item_other_image_div+'<img class="all_item_image" src="'+default_img+'" alt="'+item_name+'"><img class="all_item_image_load" src="'+item_image+'" alt="'+item_name+'" onload="showActualImage(this)" onerror="setDefaultImage(this);"></a></div><div class="my_cart_box_right_div"><div class="all_item_name" title="'+item_name+'" onclick="medicine_details_funcation('+item_code+')" style="cursor: pointer;">'+item_name+' <span class="all_item_packing">('+item_packing+' Packing)</span></div><div class=""><span class="all_item_margin">'+item_margin+'% Margin* </span> | <span class="all_item_expiry">Expiry : '+item_expiry+'</span></div><div class="all_item_company">By '+item_company+'</div><div class="text-left all_item_order_quantity" title="'+item_name+' Quantity: '+item_order_quantity+'" >Order quantity : '+item_order_quantity+item_scheme_div+'</div><span class="mobile_off">'+rate_div+'</span></div><span class="mobile_show pl-2">'+rate_div+'</span></div>'+div_all_data+"</span>";

					$(".my_cart_api_div").append(my_cart_data);
					$(".my_cart_api_div_mobile").append(my_cart_data);
					$(".my_cart_api_div_import_order").append(my_cart_data);
				}
			});
		},
		timeout: 60000
	});
}
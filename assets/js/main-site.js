function theme_set()
{
	theme_set_css = $(".theme_set_css").val()
	$.ajax({
		type       : "POST",
		data       :  { theme_set_css:theme_set_css} ,
		url        : base_url+"Chemist_json/theme_set",
		cache	   : true,
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
		window.location.href = '<?= base_url(); ?>home/medicine_category/featured_brand/'+id+'/'+division;
	}
}
function gosearchpage()
{
	window.location.href = "<?= base_url();?>home/search_medicine";
}
function check_login_function()
{
	$(".small_noti_box").hide(500);
	id ='';
	$.ajax({
		type       : "POST",
		data       :  { id:id} ,
		url        : base_url+"Chemist_json/check_login_function",
		cache	   : true,
		success : function(data){
			if(data!="")
			{
				$.each(data.items, function(i,item){	
					if (item){
						
						if(item.download_invoice_url!="")
						{
							download_invoice(item.download_invoice_url)
						}

						if(item.noti_id!="")
						{
							$(".small_noti_box").show(500);
							$(".small_noti_box_data").html("<b>"+item.noti_title+"</b>"+"<p>"+item.noti_message+"</p>");
						}

						/*if(item.status=="0")
						{
							window.location.href = "<?= base_url();?>user/logout2";
						}*/

						/*notiid		= (item.notiid);
						broadcastid = (item.broadcastid);
						if(notiid!=""){
							notititle 	= atob(item.notititle);
							notibody 	= atob(item.notibody);
							$(".only_for_noti").append('<li class="only_for_noti_li notiid_'+notiid+'"><div class="notititle">'+notititle+'</div><div class="notibody">'+notibody+'</div></li>');						
							setTimeout('$(".notiid_"+notiid).hide()',10000);
						}
						if(broadcastid!=""){
							broadcasttitle 		= atob(item.broadcasttitle);
							broadcastmessage 	= atob(item.broadcastmessage);
							$('.broadcast_title').html(broadcasttitle);
							$('.broadcast_message').html(broadcastmessage);
							$('.myModal_broadcast').click();
						}
						if(item.count!="")
						{
							//$(".notificationdiv").html("("+item.count+")");
							if(item.count=="0")
							{
								$(".cssnotification").show();
								$(".cssnotification1").hide();
							}
							else
							{
								$(".cssnotification").hide();
								$(".cssnotification1").show();
							}
						}*/
					}
				});	
			}
		},
		timeout: 10000
	});
	setTimeout('check_login_function();',60000);
}
function clear_small_noti(){
	$(".small_noti_box").hide(500);
}
$(document).ready(function(){
	//setTimeout('count_temp_rec();',500);
	//setTimeout('check_login_function();',6000);

	$('.medicine_details_item_order_quantity_textbox').keypress(function (e) {
		if (e.which == 13) {
			medicine_add_to_cart_api();
		} 
	});
});

function get_single_medicine_info(item_code)
{
	if(session_user_altercode=="" || session_user_altercode==null)
	{
		window.location.href = base_url;
	} else 
	{
		$('.myModal_medicine_details').click();
		$(".medicine_details_api_loading").show();
		$(".medicine_details_api_data").hide();
		$(".medicine_details_item_description1").hide();
		$(".medicine_details_item_description2").hide();

		$(".medicine_details_item_order_quantity_textbox").val("");
		medicine_details_api(item_code);
	}
}

function medicine_details_api(item_code)
{
	$('.medicine_details_item_add_to_cart_btn').html("Add to cart");
	$('.medicine_details_item_add_to_cart_btn_loading').hide();

	item_date_time = item_batch_no = item_gst = item_description2 = "";

	$.ajax({
		url: "<?php echo base_url(); ?>medicine_details/medicine_details_api",
		type:"POST",
		dataType: 'json',
		data: {item_code:item_code},
		error: function(){
			
		},
		success: function(data){
			$.each(data.items, function(i,item){	
				if (item)
				{
					item_date_time	= item.item_date_time;
					$(".medicine_details_item_date_time").html("as on " + item_date_time)

					item_batch_no	= item.item_batch_no;
					$(".medicine_details_item_batch_no").html("Batch no : "+item_batch_no)

					item_gst	= item.item_gst;
					$(".medicine_details_item_gst").html("GST : "+item_gst +"%")

					item_image	= item.item_image;
					$(".medicine_details_image").attr("src",item_image)
					$(".example-image-link").attr("href",item_image)
					$(".example-image-link").attr("data-standard",item_image)
					var $easyzoom = $('.easyzoom').easyZoom();
							/*
					// Setup thumbnails example
					var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

					/*$('.thumbnails').on('click', 'a', function(e) {
						var $this = $(this);

						e.preventDefault();

						// Use EasyZoom's `swap` method
						api1.swap($this.data('standard'), item_image);
					});*/


					item_image	= item.item_image;
					$(".modal_item_image_change1").attr("src",item_image)
					item_image2	= item.item_image2;
					$(".modal_item_image_change2").attr("src",item_image2)
					item_image3	= item.item_image3;
					$(".modal_item_image_change3").attr("src",item_image3)
					item_image4	= item.item_image4;
					$(".modal_item_image_change4").attr("src",item_image4)

					$(".medicine_details_item_description2").show()
					item_description2	= item.item_description2;
					$(".medicine_details_item_description2").html(item_description2)
					if(item_description2=="")
					{
						$(".medicine_details_item_description2").hide()
					}

					item_order_quantity	= item.item_order_quantity;
					$(".medicine_details_item_order_quantity_textbox").val(item_order_quantity)
					if(item_order_quantity!=""){
						$('.medicine_details_item_add_to_cart_btn').html("Update cart");
					}

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
					
					item_image	= item.item_image;
					$(".medicine_details_image").attr("src",item_image)
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
		timeout: 10000
	});
}

// start new code for fast open modal
function medicine_details_funcation(item_code)
{	
	if(session_user_altercode=="" || session_user_altercode==null)
	{
		window.location.href = base_url;
	} else 
	{
		$(".medicine_details_item_order_quantity_textbox").val("");
		$(".medicine_details_item_order_quantity_textbox").focus();
		
		medicine_details_get(item_code);
		setTimeout(medicine_details_api(item_code),500);// its on header page

		$('.search_textbox').val("");
		$(".search_medicine_result").html("");
		$(".myModal_medicine_details").click();
	}
}
// end new code for fast open modal 

function medicine_details_get(item_code)
{	
	item_image = $(".medicine_details_all_data_"+item_code).attr("item_image")
	item_name = $(".medicine_details_all_data_"+item_code).attr("item_name")
	item_packing = $(".medicine_details_all_data_"+item_code).attr("item_packing")
	item_expiry = $(".medicine_details_all_data_"+item_code).attr("item_expiry")
	item_company = $(".medicine_details_all_data_"+item_code).attr("item_company")
	item_quantity = $(".medicine_details_all_data_"+item_code).attr("item_quantity")
	item_stock = $(".medicine_details_all_data_"+item_code).attr("item_stock")
	item_ptr = $(".medicine_details_all_data_"+item_code).attr("item_ptr")
	item_mrp = $(".medicine_details_all_data_"+item_code).attr("item_mrp")
	item_price = $(".medicine_details_all_data_"+item_code).attr("item_price")
	item_scheme = $(".medicine_details_all_data_"+item_code).attr("item_scheme")
	item_margin = $(".medicine_details_all_data_"+item_code).attr("item_margin")
	item_featured = $(".medicine_details_all_data_"+item_code).attr("item_featured")
	item_description1 = $(".medicine_details_all_data_"+item_code).attr("item_description1")
	item_order_quantity = $(".medicine_details_all_data_"+item_code).attr("item_order_quantity")
	
	item_date_time = item_batch_no = item_gst = item_description2 = "";
	$(".medicine_details_item_date_time").html("Loading....")
	$(".medicine_details_item_batch_no").html("")
	$(".medicine_details_item_gst").html("")
	$(".medicine_details_item_description2").html("")

	medicine_details_api_data(item_code) // its on header page
}

function medicine_details_api_data(item_code)
{
	$(".medicine_details_api_loading").hide();
	$(".medicine_details_api_data").show();

	/***********************important ************************/
	$('.medicine_details_item_code').val(item_code);
	/********************************************************/

	$(".medicine_details_item_add_to_cart_btn").hide()
	$(".medicine_details_item_add_to_cart_btn_disable").hide()
	$('.medicine_details_item_add_to_cart_btn_loading').hide()

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
	$(".medicine_details_item_stock").html("Stock : " +item_quantity)
	$(".medicine_details_item_scheme").html("Scheme : " +item_scheme)

	$(".medicine_details_item_description1").html(item_description1)
	$(".medicine_details_item_description1").show()
	if(item_description1=="")
	{
		$(".medicine_details_item_description1").hide()
	}

	$(".medicine_details_item_ptr").html('PTR : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_ptr + "/-")
	$(".medicine_details_item_mrp").html('MRP : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_mrp + "/-")
	$(".medicine_details_item_gst").html("GST : "+item_gst +"%")
	$(".medicine_details_item_price").html('*Approximate Value ~ : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_price + "/-")

	$(".medicine_details_item_scheme_line").show()
	$(".medicine_details_item_scheme").show()
	if(item_scheme=="0+0")
	{
		$(".medicine_details_out_of_stock_img").hide()
		$(".medicine_details_item_scheme_line").hide()
		$(".medicine_details_item_scheme").hide()
	}

	if(item_featured=="1" && item_quantity!="0"){
		$(".medicine_details_featured_img").show()
	}

	if(parseInt(item_quantity)==0){
		
		$(".medicine_details_item_add_to_cart_btn_disable").show()
		$(".medicine_details_item_stock").html("<font color=red>Out of stock</font>")

		$(".medicine_details_out_of_stock_img").show()
		$(".medicine_details_item_scheme").hide()
		$(".medicine_details_item_scheme_line").hide()
	}else{
		$(".medicine_details_item_add_to_cart_btn").show()
	}

	if(item_stock!="")
	{
		$(".medicine_details_item_stock").html(item_stock)
	}

	$(".medicine_details_item_quantity").val(item_quantity)
	if(item_order_quantity){
		$(".medicine_details_item_order_quantity_textbox").val(item_order_quantity)
	}
	$(".medicine_details_item_order_quantity_textbox").focus()
}

function modal_item_image_change(_id)
{
	modal_item_image_change_url = $(".modal_item_image_change"+_id).attr("src");
	$(".modal_item_image_change").attr("src",modal_item_image_change_url);
	$(".example-image-link").attr("href",modal_item_image_change_url)
	$(".example-image-link").attr("data-standard",modal_item_image_change_url)
	
	$(".easyzoom-flyout img").attr("src",modal_item_image_change_url)
}

function medicine_add_to_cart_api()
{
    /*
	<?php 
	if(!empty($page_cart)) {
		if($page_cart=="1") { ?>
			setTimeout(function() {
				$(".edit_item_focues"+i_code).focus();
			}, 2000);
		<?php 
		} 
	}?>	*/

	item_quantity		= $(".medicine_details_item_quantity").val();
	item_order_quantity	= $(".medicine_details_item_order_quantity_textbox").val();
	item_code			= $(".medicine_details_item_code").val();

	if(item_order_quantity=="")
	{
		swal("Enter quantity");
		$(".medicine_details_item_order_quantity_textbox").val("");
		$(".medicine_details_item_order_quantity_textbox").focus();
	}
	else
	{
		item_order_quantity = parseInt(item_order_quantity);
		item_quantity		= parseInt(item_quantity);
		if(item_order_quantity!=0)
		{
			if(item_order_quantity<=item_quantity)
			{
				$(".medicine_details_item_add_to_cart_btn").hide()
				$(".medicine_details_item_add_to_cart_btn_disable").hide()

				$('.medicine_details_item_add_to_cart_btn_loading').show();

				$(".modaloff").click();
				$(".search_textbox").focus();
				
				$.ajax({
					type       : "POST",
					data       : {item_code:item_code,item_order_quantity:item_order_quantity},
					url        : base_url+"my_cart/medicine_add_to_cart_api",
					cache	   : true,
					error: function(){
						swal("error add to cart")
					},
					success    : function(data){
						if(data.items=="")
						{
							$(".medicine_cart_list_div").html('<h1><center><img src="'+base_url+'/img_v51/cartempty.png" width="80%"></center></h1>');
							$(".delete_all_btn").hide();
						}
						else
						{
							$(".medicine_cart_list_div").html("");
							$(".delete_all_btn").show();
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
								//new add for last order qty
								item_order_quantity = item.item_order_quantity;

								div_all_data = "<div class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"' item_order_quantity='"+item_order_quantity+"'></div>"

								item_id 			= item.item_id;
								item_quantity_price = item.item_quantity_price;
								item_datetime 		= item.item_date_time;
								item_modalnumber 	= item.item_modalnumber;

								error_img ="onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'"

								item_other_image_div = '';
								if(item_featured=="1"){
									item_other_image_div = '<img src="<?= base_url() ?>img_v51/featured_img.png" class="medicine_cart_item_featured_img">';
								}
								
								image_div = item_other_image_div+'<img src="'+item_image+'" style="width: 100%;cursor: pointer;" class="medicine_cart_item_image" onclick="medicine_details_funcation('+item_code+')" '+error_img+'>';
								
								item_scheme_div = "";
								if(item_scheme!="0+0")
								{
									item_scheme_div =  ' | <span class="medicine_cart_item_scheme" title="'+item_name+' '+item_scheme+'">Scheme : '+item_scheme+'</span>';
								}

								rate_div = '<div class="cart_ki_main_div3"><span class="medicine_cart_item_price2" title="*Approximate ~">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</span> | <span class="medicine_cart_item_price">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_quantity_price+'/-</span></div><div class="cart_ki_main_div3"><span class="medicine_cart_item_datetime">'+item_modalnumber+' | '+item_datetime+'</span><span style="float:right;"><a href="javascript:delete_medicine('+item_code+')" tabindex="-10" title="Delete '+item_name+'"><i class="fa fa-trash-o cart_new_btn_color_css" aria-hidden="true" style="margin-right:5px;"></i></a>&nbsp;<a href="javascript:medicine_details_funcation('+item_code+')" tabindex="-10" title="Edit '+item_name+'" class="edit_item_focues'+item_code+'"><i class="fa fa-pencil cart_new_btn_color_css" aria-hidden="true"></i></a>&nbsp;&nbsp;</div>';
								
								$(".medicine_cart_list_div").append('<div class="main_theme_li_bg"><div class="medicine_cart_small_div5">'+image_div+'</div><div class="medicine_cart_small_div6"><div class="medicine_cart_item_name" title="'+item_name+'" onclick="medicine_details_funcation('+item_code+')" style="cursor: pointer;">'+item_name+' <span class="medicine_cart_item_packing">('+item_packing+' Packing)</span></div><div class=""><span class="medicine_cart_item_margin">'+item_margin+'% Margin* </span> | <span class="medicine_cart_item_expiry">Expiry : '+item_expiry+'</span></div><div class="medicine_cart_item_company">By '+item_company+'</div><div class="text-left medicine_cart_item_order_quantity" title="'+item_name+' Quantity: '+item_order_quantity+'" >Order quantity : '+item_order_quantity+item_scheme_div+'</div><span class="mobile_off">'+rate_div+'</span></div><span class="mobile_show" style="margin-left:5px;">'+rate_div+'</span></div>'+div_all_data);
							}
						});
						$.each(data.items_other, function(i,item){
							if (item)
							{
								items_price = item.items_price;
								items_total = item.items_total;
								place_order_button = item.place_order_button;
								place_order_message = item.place_order_message;
								$(".div_cart_total_price").html('<i class="fa fa-inr"></i> '+items_price+'/-');
								$(".div_cart_total_items").html(items_total+" items");
								$(".div_cart_total_items1").html("("+items_total+")");
								$(".header_cart_span").html(items_total);
								$(".place_order_message").html(place_order_message);
								$(".header_result_found").html("My Cart ("+items_total+")");
								if(items_total==0)
								{
									$(".cart_empty_cart_div").show();
									$(".cart_add_to_cart_div").hide();
									$(".cart_disabled_cart_div").hide();
								}
								else
								{
									$(".cart_empty_cart_div").hide();
									$(".cart_add_to_cart_div").show();
									$(".cart_disabled_cart_div").show();
								}
							}
						});
					},
					timeout: 10000
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
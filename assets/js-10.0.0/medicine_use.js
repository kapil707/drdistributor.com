$(document).ready(function(){
	call_page()
});
function load_more()
{
	call_page()
}
var query_work = 0;
var no_record_found = 0;
function call_page()
{
	if(query_work=="0")
	{
		query_work = 1;
		$.ajax({
			type       : "POST",
			data       :  {item_code:item_code} ,
			url        : "https://www.drdweb.co.in/medicine_use/get_medicine_use",
			cache	   : false,
			error: function(){
				$(".load_page_loading").html("");
				$(".load_page").html('<h1><img src="'+get_base_url()+'img_v51/something_went_wrong.png" width="100%"></h1>');
			},
			success    : function(data){
				$.each(data.medicine_use, function(i,item){
					if (item){
						file			= item.file;
						file_type		= item.file_type;
						
						image = video = "";
						if(file_type=="image"){
							image = '<img src="'+file+'" width="100%">';
						}
						
						if(file_type=="video"){
							video = '<video width="100%" height="250" controls="" poster="'+get_base_url()+'img_v51/default-video-thumbnail.jpg"><source src="'+file+'" type="video/mp4">Your browser does not support the video tag.</video>';
						}
						
						if(image!=""){
							$(".load_page_images").append('<div class="col-sm-2 col-6 p-0 m-0 text-center"><div class="medicine_use_div">'+image+'</div></div>');
						}
						if(video!=""){
							$(".load_page_videos").append('<div class="col-sm-6 col-6 p-0 m-0 text-center"><div class="medicine_use_div1">'+video+'</div></div>');
						}
						//$(".headertitle").html(item.item_header_title);
						query_work = 0;
						no_record_found = 1;
						$(".load_more").show();
					}
				});
			},
			timeout: 10000
		});
	}
	call_page2()
}
function call_page2()
{
	$.ajax({
		type       : "POST",
		data       :  {item_code:item_code} ,
		url        : get_base_url()+"Medicine_use/medicine_use_api",
		cache	   : false,
		error: function(){
			$(".load_page_loading").html("");
			$(".load_page").html('<h1><img src="'+get_base_url()+'img_v51/something_went_wrong.png" width="100%"></h1>');
		},
		success    : function(data){
			$.each(data.items, function(i,item){
				$(".top_bar_title").html(item.item_name);
				
				/***********************important ************************/
				$('.medicine_details_item_code').val(item.item_code);
				/********************************************************/

				$(".medicine_details_featured_img").hide()
				$(".medicine_details_out_of_stock_img").hide()	

				$(".medicine_details_image").attr("src",item.item_image)
				$(".medicine_details_image_small").attr("src",item.item_image)

				$(".medicine_details_item_name").html(item.item_name)
				$(".medicine_details_item_packing").html("Packing : "+item.item_packing)
				$(".medicine_details_item_batch_no").html("Batch no : "+item.item_batch_no)

				$(".medicine_details_item_margin").html(item.item_margin+'% Margin*')
				$(".medicine_details_item_expiry").html("Expiry : "+item.item_expiry)
				$(".medicine_details_item_company").html("By "+item.item_company)
				$(".medicine_details_item_scheme").html("Scheme : " +item.item_scheme)

				/**************************************** */
				$(".medicine_details_item_stock").html("Stock : " +item.item_quantity)
				if(item.item_stock!=0){
					$(".medicine_details_item_stock").html("Stock : "+item.item_stock);
				}
				/**************************************** */
				
				$(".medicine_details_item_description1").hide()
				if(item.item_description1!=""){
					$(".medicine_details_item_description1").show()
					$(".medicine_details_item_description1").html(item.item_description1)
				}

				/******************************************************************/
				$(".medicine_details_item_ptr").html('PTR : <i class="fa fa-inr" aria-hidden="true"></i> ' +item.item_ptr + "/-")
				$(".medicine_details_item_mrp").html('MRP : <i class="fa fa-inr" aria-hidden="true"></i> ' +item.item_mrp + "/-")
				$(".medicine_details_item_gst").html("GST : "+item.item_gst +"%")
				$(".medicine_details_item_price").html('*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> ' +item.item_price + "/-")
				$(".medicine_details_item_total").html('*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> ' +item.item_price + "/-")
				/******************************************************************/

				$(".medicine_details_item_scheme_line").show()
				$(".medicine_details_item_scheme").show()
				if(item.item_scheme=="0+0"){
					$(".medicine_details_out_of_stock_img").hide()
					$(".medicine_details_item_scheme_line").hide()
					$(".medicine_details_item_scheme").hide()
				}

				if(item.item_featured=="1" && item.item_quantity!="0"){
					$(".medicine_details_featured_img").show()
				}

				/******************************************************************* */
				$(".medicine_details_item_add_to_cart_btn").hide()
				$(".medicine_details_item_add_to_cart_btn_disable").show()
				$(".order_quantity_div").show()
				if(parseInt(item.item_quantity)==0){
					$(".order_quantity_div").hide()		
					$(".medicine_details_out_of_stock_img").show()
					$(".medicine_details_item_stock").html("<font color=red>Out of stock</font>")
				}

				/******************************************************************* */
				$(".medicine_details_item_order_quantity_hidden").val(item.item_quantity)
				if(item.item_order_quantity!=""){
					$(".medicine_details_item_order_quantity_textbox").val(item.item_order_quantity)
					$('.medicine_details_item_add_to_cart_btn').html("Update cart");
					$('.medicine_details_item_add_to_cart_btn_disable').html("Update cart");
				}
				$(".medicine_details_item_order_quantity_textbox").focus()
			});
		},
		timeout: 10000
	});
}
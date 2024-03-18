function setDefaultImage(image) {
	image.onerror = "<?= base_url(); ?>/uploads/default_img.jpg";
}
function change_item_order_quantity(){

	$(".add_to_cart_error_message").html('');
	$(".medicine_details_item_add_to_cart_btn").hide();
	$(".medicine_details_item_add_to_cart_btn_disable").show();

	item_order_quantity	 = $(".medicine_details_item_order_quantity_textbox").val();	
	if(item_order_quantity==""){
		$(".medicine_details_item_price_calculate").html('*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_price + "/-");
	}else{
		item_order_quantity  = parseInt(item_order_quantity);
		if(item_order_quantity==0){
			$(".add_to_cart_error_message").html('Minimum order quantity one and more than one');
		}else{
			if(item_order_quantity<=parseInt(item_quantity)){
				item_price_calculate = parseFloat(item_price) * item_order_quantity;

				item_price_calculate = item_price_calculate.toFixed(2);

				$(".medicine_details_item_price_calculate").html('Total : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_price_calculate + "/-");

				$(".medicine_details_item_add_to_cart_btn").show();
				$(".medicine_details_item_add_to_cart_btn_disable").hide();
				
			}else{
				$(".add_to_cart_error_message").html('Enter maximum quantity '+item_quantity+' only');
			}
		}	
	}
}

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
	$(".medicine_details_item_stock").html("Stock : " +item_quantity)
	$(".medicine_details_item_scheme").html("Scheme : " +item_scheme)

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
	$(".medicine_details_item_price_calculate").html('*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> ' +item_price + "/-")
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
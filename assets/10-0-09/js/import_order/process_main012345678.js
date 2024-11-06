function MainPageFuncationCall() {

	$(".top_bar_title2").html("Loading....");
	$(".main_page_loading").show();

	$.ajax({
		type: "POST",
		dataType: "json",
		data: { order_id: order_id },
		url: get_base_url() + "import_order/process_main_api",
		cache : true,
		timeout: 60000,
		error: function() {
		},
		success: function(data) {
			$.each(data.items, function(i, item) {
				if (item) {
					let _i = item.i;
					let item_id = item.id;
					let item_name = item.item_name;
					let item_quantity = item.quantity;
					let item_mrp = item.mrp;
					let ChemistId = data.ChemistId;

					$(".main_page_data").append(`
                        <div class="main_box_div_data import_order_main_div_${item_id} p-1">
						<div class="row">
							<div class="col-sm-12">
								<div class="import_order_box_left_div web-col-padding-0">
									(${_i}) ${ChemistId} :
								</div>
								<div class="import_order_box_right_div web-col-padding-0">
									<div class="row">
										<div class="col-sm-9">	
											<span class="import_order_title_1 all_item_name">
												${item_name}
											</span> | 
											
											<span class="all_item_order_quantity">Quantity : </span>

											<input type="text" class="import_order_hidden_item_code_${item_id}" />

											<input type="hidden" name="" value="${item_name}" class="import_order_hidden_item_name_${item_id}" />

											<input type="number" name="item_qty[]" value="${item_quantity}" class="import_order_quantity_textbox_${item_id} import_order_item_order_quantity_textbox" style="width:100px;" placeholder="Eg 1,2" onchange="import_order_row_quantity_change(${item_id})" title="Order quantity" min="1" max="1000" maxlength="4" />

											<span>				
												<a href="javascript:void(0)" onclick="import_order_row_delete(${item_id})" title="Delete" class="import_order_delete_btn"><i class="fa fa-trash-o" aria-hidden="true" style="margin-right:5px;"></i> Delete</a>
											</span>

											<span class="loading_with_id_${item_id}" style="display:none">Loading....</span>
										</div>
										<div class="col-sm-3 text-right">
											<span class="all_item_mrp">
												MRP. : 
												<i class="fa fa-inr" aria-hidden="true"></i>
												${item_mrp}/-
											</span>
										</div>
									</div>
								</div>

								<div class="col-sm-12 import_order_main_${item_id}" style="display:none">
									<div class="import_order_box_left_div web-col-padding-0">

										<img src="${get_base_url()}assets/${getWebJs()}/images/featured_img.png" class="import_order_item_featured_img import_order_item_featured_${item_id}" style="display:none">

										<img src="${get_base_url()}assets/${getWebJs()}/images/out_of_stock_img.png" class="import_order_item_out_of_stock_img import_order_item_out_of_stock_${item_id}" style="display:none">

										<img src="${get_base_url()}assets/${getWebJs()}/images/logo4.png" width="60px;" class="all_item_image import_order_item_image_${item_id}" alt="">

									</div>

									<div class="import_order_box_right_div web-col-padding-0">
										<div class="row">
											<div class="col-sm-8">
												<span class="all_item_name import_order_item_name_${item_id}"></span>

												<span class="all_item_packing">
													(<span class="import_order_item_packing_${item_id}"></span> Packing) 
												</span> - 

												<span class="all_item_expiry"> 
													Expiry : <span class="import_order_item_expiry_${item_id}"></span>
												</span>
											</div>
											<div class="col-sm-4 text-right">
												<span class="all_item_ptr">
													PTR : <i class="fa fa-inr" aria-hidden="true"></i> 
													<span class="import_order_item_ptr_${item_id}">0.00</span>/-
												</span> | 

												<span class="all_item_mrp">
													MRP. : <i class="fa fa-inr" aria-hidden="true"></i> <span class="import_order_item_mrp_${item_id}">0.00</span>/- 
												</span>
											</div>

											<div class="col-sm-12">
												<div class="all_item_hr"></div>
											</div>

											<div class="col-sm-7">
												<span class="all_item_company">
													By : <span class="import_order_item_company_${item_id}"></span>
												</span> |  

												<span class="all_item_batch_no"> Batch no : 
													<span class="import_order_item_batch_no_${item_id}"></span>
												</span>

												<span class="all_item_scheme import_order_item_scheme_div_${item_id}"> | 
													<span class="import_order_item_scheme_${item_id}"></span>
												</span>
											</div>
											<div class="col-sm-5 text-right">
												<span class="all_item_stock">
													Stock : <span class="import_order_item_stock_${item_id}"></span>
												</span> | 

												<span class="all_item_price">
													*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> 
													<span class="import_order_item_price_${item_id}">0.00</span>/-
												</span>
											</div>

											<div class="col-sm-12">
												<div class="all_item_hr"></div>
											</div>
									
											<div class="col-sm-12">
												<span class="cart_description1 import_order_item_message_${item_id}"> 
												</span>
												<span>
													<a href="javascript:import_order_medicine_change(${item_id})" class="import_order_edit_btn" title="Change medicine">
														<i class="fa fa-pencil" aria-hidden="true"></i>
														Change medicine
													</a>
												</span>
												<span class="import_order_item_suggested_${item_id}" style="display:none"> | 
													<a href="javascript:import_order_medicine_delete_suggested(${item_id})" title="Delete suggested" class="import_order_delete_btn"><i class="fa fa-trash-o" aria-hidden="true" style="margin-right:5px;"></i>Delete suggest</a>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					`);

					//setTimeout(process_find_medicine(item_id),500);
				}
			});
		}
	});
}

function process_find_medicine(item_id){

	$(".loading_with_id_"+item_id).show();
	$('.import_order_main_'+item_id).hide();

	$.ajax({
		type       : "POST",
		data       : {item_id:item_id} ,
		url        : get_base_url() + "import_order/process_find_medicine_api",
		cache : true,
		timeout: 60000,
		error: function(){
			$(".selected_msg_"+cssid).html("Server not Responding, Please try Again");
		},
		success    : function(data){
			$.each(data.items, function(i,item){
				if (item)
				{
					$(".main_page_loading").hide();
					$(".loading_with_id_"+item_id).hide();

					item_message 	= item.item_message;
					item_background = item.item_background;
					item_suggest_altercode = item.item_suggest_altercode;

					item_code = item.item_code;
					item_name = item.item_name;
					item_image = item.item_image;
					item_packing = item.item_packing;
					item_batch_no = item.item_batch_no;
					item_expiry = item.item_expiry;
					item_scheme = item.item_scheme;
					item_quantity = item.item_quantity;
					item_stock = item.item_stock;
					item_company = item.item_company;
					item_ptr = item.item_ptr;
					item_mrp = item.item_mrp;
					item_price = item.item_price;
					item_featured = item.item_featured;

					$('.import_order_main_'+item_id).show();
					$('.import_order_quantity_textbox_'+item_id).focus();

					$('.import_order_main_div_'+item_id).css("background-color",item_background);

					$('.import_order_item_message_'+item_id).html(item_message);
					
					$('.import_order_hidden_item_code_'+item_id).val(item_code)
					$('.import_order_item_name_'+item_id).html(item_name)
					$('.import_order_item_image_'+item_id).attr("src",item_image);
					$('.import_order_item_packing_'+item_id).html(item_packing);
					$('.import_order_item_batch_no_'+item_id).html(item_batch_no);
					$('.import_order_item_expiry_'+item_id).html('<b>'+item_expiry+'</b>');
					$('.import_order_item_scheme_'+item_id).html('Scheme : '+item_scheme);

					item_quantity_div = item_quantity;
					if(item_stock!="")
					{
						item_quantity_div = item_stock;
					}

					$('.import_order_item_stock_'+item_id).html(item_quantity_div);
					$('.import_order_item_company_'+item_id).html(item_company);

					$('.import_order_item_ptr_'+item_id).html(item_ptr);
					$('.import_order_item_mrp_'+item_id).html(item_mrp);
					$('.import_order_item_price_'+item_id).html(item_price);

					$('.import_order_item_scheme_div_'+item_id).hide()
					if(item_scheme!="0+0"){
						$('.import_order_item_scheme_div_'+item_id).show()
					}

					$('.import_order_item_featured_'+item_id).hide();
					if(item_quantity=="0"){
						$('.import_order_item_out_of_stock_'+item_id).show();
					}

					$('.import_order_item_featured_'+item_id).hide();
					if(item_featured=="1"){
						$('.import_order_item_featured_'+item_id).show();
					}

					$('.import_order_item_featured_'+item_id).hide();
					if(item_featured=="1"){
						$('.import_order_item_featured_'+item_id).show();
					}
					
					$('.import_order_item_suggested_'+item_id).hide();
					if(item_suggest_altercode!=""){
						$('.import_order_item_suggested_'+item_id).show();
					}				
				}
			});
		}
	});
}


function import_order_row_delete(item_id) {

	hidden_item_code = $(".import_order_hidden_item_code_"+item_id).val();
	swal({
		title: "Are you sure to delete medicine?",
		/*text: "Once deleted, you will not be able to recover this imaginary file!",*/
		icon: "warning",
		buttons: ["No", "Yes"],
		dangerMode: true,
	}).then(function(result) {
		if (result) {
			$.ajax({
				type       : "POST",
				data       : {item_id:item_id,item_code:hidden_item_code,},
				url        : get_base_url() + "import_order/import_order_row_delete_api",
				cache : true,
				timeout: 60000,
				error: function(){
					swal("Medicine not deleted");
				},
				success    : function(data){
					$.each(data.items, function(i,item){	
						if (item)
						{
							if(item.status=="1")
							{
								$(".import_order_main_div_"+item_id).hide();
								$(".import_order_main_div_"+item_id).html('');
								swal("Medicine deleted successfully", {
									icon: "success",
								});
							}
							else{
								swal("Medicine not deleted");
							}
						} 
					});
				}
			});
		} else {
			swal("Medicine not deleted");
		}
	});
}

function import_order_row_quantity_change(item_id) {

	hidden_item_code = $(".import_order_hidden_item_code_"+item_id).val();
	quantity = $(".import_order_quantity_textbox_"+item_id).val();
	$.ajax({
		type       : "POST",
		data       :  {item_id:item_id,item_code:hidden_item_code,quantity:quantity,},
		url        : get_base_url() +  "import_order/import_order_row_quantity_change_api",
		cache : true,
		error: function(){
			swal("Quantity not updated");
		},
		success    : function(data){
			$.each(data.items, function(i,item){	
				if (item)
				{
					if(item.status=="1")
					{
						swal("Quantity updated successfully");
						process_find_medicine(item_id);
					}
					else{
						swal("Quantity not updated");
					}
				}
			});
		}
	});
}
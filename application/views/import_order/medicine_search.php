<?php if(!empty($chemist_id)){ ?>
<style>
.top_bar_title{
	margin-top: -5px;
}
</style>
<script>
$(".top_bar_title1").show();
</script>
<?php } ?>
<script>
$(".top_bar_title").html("<?= $main_page_title ?>");
function goBack() {
	window.location.href = "<?= base_url();?>import_order";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-12 col-12">
			<?php
			$lastcount=0;
			$j = 0;
			foreach($result as $row)
			{
				$item_name 	= ucwords(strtolower($row->item_name));
				if(!empty($item_name))
				{
					$item_qty 	= $row->quantity;
					$item_mrp 	= $row->mrp;
					$i          = $row->id; 
					$j++;
					?>
					<input type="hidden" value="<?= $item_name ?>" class="your_item_name_<?= $i ?>">
					<input type="hidden" value="<?= $item_mrp ?>" class="your_item_mrp_<?= $i ?>">
					<input type="hidden" value="<?= $item_qty ?>" class="your_item_qty_<?= $i ?>">
					<div class="main_box_div_data remove_css_<?= $i ?> import_order_td_<?= $i ?> p-1">
						<div class="row">
							<div class="col-sm-10">
								(<?= $j ?>)
								
								<?= $myname;?> : 
								<span class="import_order_title_1 all_item_name">
									<?= $item_name; ?>
								</span> | 
								
								<span class="all_item_order_quantity">Quantity : </span>

								<input type="number" name="item_qty[]" value="<?= $item_qty ?>" class="item_qty_<?= $i ?> import_order_item_order_quantity_textbox" style="width:100px;" placeholder="Eg 1,2" onchange="change_order_quantity('<?= $i; ?>')" title="Order quantity" min="1" max="1000" maxlength="4" />

								<span class="cart_delete_btn_<?= $i ?>">											
									<a href="javascript:void(0)" onclick="delete_row_medicine('<?= $i; ?>')" title="Delete" class="import_order_delete_btn"><i class="fa fa-trash-o" aria-hidden="true" style="margin-right:5px;"></i> Delete</a>
								</span>
							</div>
							<div class="col-sm-2 text-right">
								<span class="all_item_mrp">MRP. : 
									<i class="fa fa-inr" aria-hidden="true"></i>
									<?= number_format($item_mrp,2) ?>/-
								</span>					
							</div>

							<div class="col-sm-12">
								<div class="all_item_hr"></div>
							</div>

							<div class="col-sm-12 select_product_<?= $i ?>" style="display:none">
								<div class="import_order_box_left_div">
									<img src="<?=base_url(); ?>img_v51/logo2.png" width="60px;" class="image_css_<?= $i ?> all_item_image" alt="" onerror="this.src='<?= base_url(); ?>/uploads/default_img.jpg'">
								</div>

								<div class="import_order_box_right_div">
									<div class="row">
										<div class="col-sm-8">
											Found : 
											<span class="all_item_name selected_item_name_<?= $i ?>"></span>

											<span class="all_item_packing">
												(<span class="selected_packing_<?= $i ?>"></span> Packing) 
											</span> - 

											<span class="all_item_expiry expiry_css_<?= $i ?>"> 
												Expiry : <span class="selected_expiry_<?= $i ?>"></span>
											</span>
										</div>
										<div class="col-sm-4 text-right">
											<span class="all_item_ptr">
												PTR : <i class="fa fa-inr" aria-hidden="true"></i> 
												<span class="selected_sale_rate_<?= $i ?>">0.00</span>/-
											</span> | 

											<span class="all_item_mrp">
												MRP. : <i class="fa fa-inr" aria-hidden="true"></i> <span class="selected_mrp_<?= $i ?>">0.00</span>/- 
											</span>
										</div>

										<div class="col-sm-12">
											<div class="all_item_hr"></div>
										</div>

										<div class="col-sm-7">
											<span class="all_item_company">
												By : <span class="selected_company_full_name_<?= $i ?>"></span>
											</span> |  

											<span class="all_item_batch_no"> Batch no : 
												<span class="selected_batch_no_<?= $i ?>"></span>
											</span>

											<span class="select_product_<?= $i ?> selected_scheme_span_<?= $i ?>"> | 
												<span class="all_item_scheme selected_scheme_<?= $i ?>"></span>
											</span>
										</div>
										<div class="col-sm-5 text-right">
											<span class="all_item_stock">
												Stock : <span class="selected_batchqty_<?= $i ?>"></span>
											</span> | 

											<span class="all_item_price">
												*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> 
												<span class="selected_final_price_<?= $i ?>">0.00</span>/-
											</span>
										</div>

										<div class="col-sm-12">
											<div class="all_item_hr"></div>
										</div>
								
										<div class="col-sm-12">
											<span class="cart_description1 selected_msg_<?= $i ?>"> 
											</span>
											<span class="selected_SearchAnotherMedicine_<?= $i ?>">
												<a href="javascript:change_medicine('<?= $i ?>')" class="import_order_edit_btn" title="Change medicine">
													<i class="fa fa-pencil" aria-hidden="true"></i>
													Change medicine
												</a>
											</span>
											<span class="selected_suggest_<?= $i ?>" style="display:none">
												<a href="javascript:delete_suggested_medicine('<?= $i ?>')" title="Delete suggested" class="import_order_delete_btn"><i class="fa fa-trash-o" aria-hidden="true" style="margin-right:5px;"></i>Delete suggest</a>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
					$lastcount++;
				}
			}
			?>
		</div>
		<div class="col-sm-6 col-6 text-left">
			<button type="submit" class="btn btn-primary main_theme_button next_btn" name="submit" value="submit" onclick="add_new_medicine()" style="width:30%"> + Add Medicine</button>
		</div>
		<div class="col-sm-6 col-6 text-right">
			<a href="<?= base_url(); ?>import_order/medicine_deleted_items/<?php echo base64_encode($order_id); ?>">
				<button type="submit" class="btn btn-primary main_theme_button next_btn" name="submit" value="submit" style="width:20%">Next</button>
			</a>
		</div>
		<div class="col-sm-12 col-12 col-padding-5 web-col-padding-5 mt-3">
			<div class="main_box_div2">
				<span class="my_cart_api_div_import_order"></span>
			</div>
		</div>		
	</div>     
</div>
<input type="hidden" class="_row_id">

<div class="script_css"></div>
<input type="hidden" value="<?php echo time(); ?>" class="mytime">
<input type="hidden" value="" class="new_import_page_item_name">
<input type="hidden" value="" class="new_import_page_item_mrp">
<script>
get_page_name = "import_page";// change value taki cart pur load na ho 
order_type = "notall";// change value taki cart pur load na ho 
</script>
<script src="<?= base_url(); ?>assets/js/import_order/medicine_search1.js"></script>
<script>
$(document).ready(function(){
	<?php foreach($result as $row) { ?>
	//setTimeout("insert_main_row_data('<?php echo $row->id ?>')",500);
	setTimeout("get_check_medicine_details('<?php echo $row->id ?>')",500);
	<?php  } ?>
});

function get_check_medicine_details(row_id) {
	item_name 	= $(".your_item_name_"+row_id).val();
	item_mrp  	= $(".your_item_mrp_"+row_id).val();
	item_qty  	= $(".your_item_qty_"+row_id).val();
	mytime 		= $(".mytime").val();
	$.ajax({
		type       : "POST",
		data       : {row_id:row_id} ,
		url        : get_base_url() + "import_order/get_check_medicine_details_api",
		cache	   : false,
		error: function(){
			$(".selected_msg_"+cssid).html("Server not Responding, Please try Again");
		},
		success    : function(data){
			console.log(data);
			//$(".insert_main_row_data_"+row_id).html(data);
			$.each(data.items, function(i,item){
				if (item)
				{
					excel_number = item.excel_number;
					message 	= item.message;
					suggest_altercode = item.suggest_altercode;
					item_name = item.item_name;
					item_image = item.item_image;
					item_packing = item.item_packing;
					item_batch_no = item.item_batch_no;
					item_expiry = item.item_expiry;
					item_scheme = item.item_scheme;
					item_batchqty = item.item_batchqty;
					item_company_full_name = item.item_company_full_name;
					item_ptr = item.item_ptr;
					item_mrp = item.item_mrp;
					item_price = item.item_price;

					$('.item_qty_'+excel_number).focus()
					$('.select_product_'+excel_number).show()

					$('.selected_msg_'+excel_number).html(message);

					$('.selected_item_name_'+excel_number).html(item_name)
					$('.image_css_'+excel_number).attr("src",item_image);
					$('.selected_packing_'+excel_number).html(item_packing);
					$('.selected_batch_no_'+excel_number).html(item_batch_no);
					$('.selected_expiry_'+excel_number).html('<b>'+item_expiry+'</b>');
					$('.selected_scheme_'+excel_number).html('Scheme : '+item_scheme);
					$('.selected_batchqty_'+excel_number).html(item_batchqty);
					$('.selected_company_full_name_'+excel_number).html(item_company_full_name);

					$('.selected_sale_rate_'+excel_number).html(item_ptr);
					$('.selected_mrp_'+excel_number).html(item_mrp);
					$('.selected_final_price_'+excel_number).html(item_price);	
					
					$('.selected_suggest_'+excel_number).hide();
					if(suggest_altercode!=""){
						$('.selected_suggest_'+excel_number).show();
					}				
				}
			});
		}
	});
}

var js_i = "";
var js_j = "";
function add_new_row_import_order_page(item_code,item_order_quantity) {
	if(js_i=="")
	{
		js_i = parseInt("<?= $i; ?>");
		js_j = parseInt("<?= $j; ?>");
	}
	
	js_i++;
	js_j++;
	
	js1 = "javascript:change_medicine('"+js_i+"')";
	js2 = "javascript:delete_suggested_medicine('"+js_i+"')";
	item_image = $(".medicine_details_all_data_"+item_code).attr("item_image")
	item_name = $(".medicine_details_all_data_"+item_code).attr("item_name")
	item_mrp = $(".medicine_details_all_data_"+item_code).attr("item_mrp")

	$(".tbody_row").append('<tr class="remove_css_'+js_i+'"><td>'+js_j+'<input type="hidden" value="'+item_name+'" class="your_item_name_'+js_i+'"><input type="hidden" value="'+item_mrp+'" class="your_item_mrp_'+js_i+'"><input type="hidden" value="'+item_order_quantity+'" class="your_item_qty_'+js_i+'"></td><td class="import_order_td_'+js_i+'"><div class="row"><div class="col-sm-1"><img src="'+get_base_url()+'img_v51/logo2.png" width="60px;" style="margin-top: 5px;" class="image_css_'+js_i+'" alt=""></div><div class="col-sm-11"><div class="row"><div class="col-sm-8"><span style="float:left;"><?= $myname;?> : <span class="import_order_title_1"> '+item_name+'</span> </span> <span style="float:left; margin-left:10px;margin-right:10px;" class="import_order_mrp"> | </span> <span style="float:left;"><a href="javascript:void(0)" onclick="delete_row_medicine('+js_i+')" title="Delete medicine" class="cart_delete_btn"> <img src="'+get_base_url()+'img_v51/delete_icon.png" width="18px;" alt="Delete medicine"> Delete medicine</a> </span> </div> <div class="col-sm-4 text-right"> <span style="float:right;"> <div class="import_order_mrp">MRP. : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/-</div> </span> <span style="float:right; margin-left:10px;margin-right:10px;" class="import_order_mrp"> | </span> <span style="float:right;"> <input type="number" name="item_qty[]" value="'+item_order_quantity+'" class="form-control item_qty_'+js_i+'" style="width: 50px;height: 30px;font-size: 12px;padding: 3px;" onchange="change_order_quantity('+js_i+')" min="1" max="1000" /> </span> <span style="float:right;margin-right:5px;" class="cart_order_qty1"> Quantity : </span> </div> <div class="col-sm-12" style=" border-top-style: solid;border-top-color: #dee2e6;border-top-width: 1px;"></div> </div> <div class="row select_product_'+js_i+'" style="display:none"> <div class="col-sm-8"> DRD :  <span class="import_order_title selected_item_name_'+js_i+'"></span> <span class="import_order_packing"> (<span class="selected_packing_'+js_i+'"></span> Packing) </span> - <span class="import_order_expiry expiry_css_'+js_i+'"> Expiry : <span class="selected_expiry_'+js_i+'"></span></span> </div> <div class="col-sm-4 text-right"> <span class="import_order_stock"> Stock : <span class="selected_batchqty_'+js_i+'"></span></span> | <span class="import_order_mrp"> MRP. : <i class="fa fa-inr" aria-hidden="true"></i> <span class="selected_mrp_'+js_i+'">0.00</span>/- </span> </div>	<div class="col-sm-12" style=" border-top-style: solid;border-top-color: #dee2e6;border-top-width: 1px;"></div> <div class="col-sm-7"> <span class="import_order_company"> By : <span class="selected_company_full_name_'+js_i+'"></span></span> |  <span class="import_order_batch_no"> Batch No : <span class="selected_batch_no_'+js_i+'"></span></span> <span class="select_product_'+js_i+' selected_scheme_span_'+js_i+'"> |  <span class="import_order_scheme selected_scheme_'+js_i+'"></span> </span> </div> <div class="col-sm-5 text-right"> <span class="import_order_ptr"> PTR : <i class="fa fa-inr" aria-hidden="true"></i> <span class="selected_sale_rate_'+js_i+'">0.00</span>/-</span> | <span class="import_order_landing_price"> ~ Landing price : <i class="fa fa-inr" aria-hidden="true"></i> <span class="selected_final_price_'+js_i+'">0.00</span>/-</span> </div> </div> </div> <div class="col-sm-12" style=" border-top-style: solid;border-top-color: #dee2e6;border-top-width: 1px;"></div> <div class="col-sm-12"> <span class="selected_msg_'+js_i+'"> Loading.... </span> <span class="selected_SearchAnotherMedicine_'+js_i+'" style="display:none">  | <a href="'+js1+'" class="cart_delete_btn" title="Change medicine"> <img src="'+get_base_url()+'img_v51/edit_icon.png" width="18px;" alt="Change medicine"> Change medicine </a> </span> <span class="selected_suggest_'+js_i+'" style="display:none"> | <a href="'+js2+'" title="Delete Suggest Medicine" class="cart_delete_btn"><img src="'+get_base_url()+'img_v51/delete_icon.png" width="18px;" alt="Delete Suggest Medicine">Delete Suggest Medicine</a> </span> </div> </div> <span class="insert_main_row_data_'+js_i+'"></span> </td> </tr>');

	setTimeout("insert_main_row_data('"+js_i+"')",1000);
}
</script>
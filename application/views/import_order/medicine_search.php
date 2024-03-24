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
<script>
get_page_name = "import_page";// change value taki cart pur load na ho 
order_type = "notall";// change value taki cart pur load na ho 
</script>
<script src="<?= base_url(); ?>assets/js/import_order/medicine_search1234.js"></script>
<script>
$(document).ready(function(){
	<?php foreach($result as $row) { ?>
	//setTimeout("insert_main_row_data('<?php echo $row->id ?>')",500);
	setTimeout("get_check_medicine_details('<?php echo $row->id ?>')",500);
	<?php  } ?>
});
</script>
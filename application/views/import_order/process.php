<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>io";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-12 col-12 main_page_data">
			<?php /*
			$i = 0;
			foreach($result as $row)
			{
				$item_name 	= ucwords(strtolower($row->item_name));
				if(!empty($item_name))
				{
					$item_qty 	= $row->quantity;
					$item_mrp 	= $row->mrp;
					$myid       = $row->id; 
					$i++;
					?>
					<div class="main_box_div_data import_order_main_div_<?= $myid ?> p-1">
						<div class="row">
							<div class="col-sm-12">
								<div class="import_order_box_left_div web-col-padding-0">
									(<?= $i ?>) <?= $ChemistId;?> :
								</div>
								<div class="import_order_box_right_div web-col-padding-0">
									<div class="row">
										<div class="col-sm-9">	
											<span class="import_order_title_1 all_item_name">
												<?= $item_name; ?>
											</span> | 
											
											<span class="all_item_order_quantity">Quantity : </span>

											<input type="text" class="import_order_hidden_item_code_<?= $myid ?>" />

											<input type="hidden" name="" value="<?= $item_name; ?>" class="import_order_hidden_item_name_<?= $myid ?>" />

											<input type="number" name="item_qty[]" value="<?= $item_qty ?>" class="import_order_quantity_textbox_<?= $myid ?> import_order_item_order_quantity_textbox" style="width:100px;" placeholder="Eg 1,2" onchange="import_oreder_medicine_quantity_change('<?= $myid ?>')" title="Order quantity" min="1" max="1000" maxlength="4" />

											<span>				
												<a href="javascript:void(0)" onclick="import_order_medicine_delete('<?= $myid ?>')" title="Delete" class="import_order_delete_btn"><i class="fa fa-trash-o" aria-hidden="true" style="margin-right:5px;"></i> Delete</a>
											</span>
										</div>
										<div class="col-sm-3 text-right">
											<span class="all_item_mrp">
												MRP. : 
												<i class="fa fa-inr" aria-hidden="true"></i>
												<?= number_format($item_mrp,2) ?>/-
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="all_item_hr"></div>
							</div>

							<div class="col-sm-12 import_order_main_<?= $myid ?>" style="display:none">
								<div class="import_order_box_left_div web-col-padding-0">

									<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/featured_img.png" class="import_order_item_featured_img import_order_item_featured_<?= $myid ?>" style="display:none">

									<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/out_of_stock_img.png" class="import_order_item_out_of_stock_img import_order_item_out_of_stock_<?= $myid ?>" style="display:none">

									<img src="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/images/logo4.png" width="60px;" class="all_item_image import_order_item_image_<?= $myid ?>" alt="">

								</div>

								<div class="import_order_box_right_div web-col-padding-0">
									<div class="row">
										<div class="col-sm-8">
											<span class="all_item_name import_order_item_name_<?= $myid ?>"></span>

											<span class="all_item_packing">
												(<span class="import_order_item_packing_<?= $myid ?>"></span> Packing) 
											</span> - 

											<span class="all_item_expiry"> 
												Expiry : <span class="import_order_item_expiry_<?= $myid ?>"></span>
											</span>
										</div>
										<div class="col-sm-4 text-right">
											<span class="all_item_ptr">
												PTR : <i class="fa fa-inr" aria-hidden="true"></i> 
												<span class="import_order_item_ptr_<?= $myid ?>">0.00</span>/-
											</span> | 

											<span class="all_item_mrp">
												MRP. : <i class="fa fa-inr" aria-hidden="true"></i> <span class="import_order_item_mrp_<?= $myid ?>">0.00</span>/- 
											</span>
										</div>

										<div class="col-sm-12">
											<div class="all_item_hr"></div>
										</div>

										<div class="col-sm-7">
											<span class="all_item_company">
												By : <span class="import_order_item_company_<?= $myid ?>"></span>
											</span> |  

											<span class="all_item_batch_no"> Batch no : 
												<span class="import_order_item_batch_no_<?= $myid ?>"></span>
											</span>

											<span class="all_item_scheme import_order_item_scheme_div_<?= $myid ?>"> | 
												<span class="import_order_item_scheme_<?= $myid ?>"></span>
											</span>
										</div>
										<div class="col-sm-5 text-right">
											<span class="all_item_stock">
												Stock : <span class="import_order_item_stock_<?= $myid ?>"></span>
											</span> | 

											<span class="all_item_price">
												*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> 
												<span class="import_order_item_price_<?= $myid ?>">0.00</span>/-
											</span>
										</div>

										<div class="col-sm-12">
											<div class="all_item_hr"></div>
										</div>
								
										<div class="col-sm-12">
											<span class="cart_description1 import_order_item_message_<?= $myid ?>"> 
											</span>
											<span>
												<a href="javascript:import_order_medicine_change('<?= $myid ?>')" class="import_order_edit_btn" title="Change medicine">
													<i class="fa fa-pencil" aria-hidden="true"></i>
													Change medicine
												</a>
											</span>
											<span class="import_order_item_suggested_<?= $myid ?>" style="display:none"> | 
												<a href="javascript:import_order_medicine_delete_suggested('<?= $myid ?>')" title="Delete suggested" class="import_order_delete_btn"><i class="fa fa-trash-o" aria-hidden="true" style="margin-right:5px;"></i>Delete suggest</a>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			}*/
			?>
		</div>
		<div class="col-sm-6 col-6 text-left">
			<button type="submit" class="btn btn-primary main_theme_button next_btn" name="submit" value="submit" onclick="add_new_medicine()" style="width:30%"> + Add Medicine</button>
		</div>
		<div class="col-sm-6 col-6 text-right">
			<a href="<?= base_url(); ?>io/mdi/<?php echo base64_encode($OrderId); ?>">
				<button type="submit" class="btn btn-primary main_theme_button next_btn" name="submit" value="submit" style="width:20%">Next</button>
			</a>
		</div>
		<div class="col-sm-12 col-12 col-padding-5 web-col-padding-0 mt-3">
			<div class="main_box_div2">
				<span class="my_cart_api_div_import_order"></span>
			</div>
		</div>		
	</div>     
</div>
<input type="hidden" class="_row_id">
<script>
OrderId = "<?php echo $OrderId ?>";
get_page_name = "import_page";// change value taki cart pur load na ho 
order_type = "notall";// change value taki cart pur load na ho 
</script>
<script src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/js/import_order/process12345.js"></script>
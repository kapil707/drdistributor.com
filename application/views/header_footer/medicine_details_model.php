<span data-toggle="modal" data-target="#myModal_medicine_details" style="text-decoration: none;" class="myModal_medicine_details"></span>
<div class="modal modaloff" id="myModal_medicine_details">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Medicine details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times modal_cancel_btn" aria-hidden="true"></i>
				</button>
			</div>
			<div class="modal-body">
				<div class="medicine_details_item_date_time">Loading....</div>
				<div class="medicine_details_api_loading text-center" style="display:none">
					<div>
						<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/loading.gif" width="100px" alt="loading">
					</div>
					<div>Loading....</div>
				</div>
				<div class="row medicine_details_api_data" style="display:none">
					<div class="col-sm-5 col-12">
						<div class="row">
							<div class="col-sm-12 col-9">
								<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/featured_img.png" alt="" class="medicine_details_featured_img" loading="lazy">

								<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/out_of_stock_img.png" alt="" class="medicine_details_out_of_stock_img" loading="lazy">

								<div class="big1">
									<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
										<a>
											<img src="<?= base_url(); ?>/uploads/default_img.webp" width="100%" style="float: right;margin-top:10px;" class="medicine_details_image modal_item_image_change" alt="zoom" loading="lazy" onerror="setDefaultImage(this);">
										</a>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-3">
								<div class="row">
									<div class="col-sm-3 col-12">
										<img src="<?= base_url(); ?>/uploads/default_img.webp" class="medicine_details_image_small modal_item_image_change1" onclick="modal_item_image_change(1)" alt="zoom" loading="lazy" onerror="setDefaultImage(this);">
									</div>
									<div class="col-sm-3 col-12">
										<img src="<?= base_url(); ?>/uploads/default_img.webp" class="medicine_details_image_small modal_item_image_change2" onclick="modal_item_image_change(2)" alt="zoom" loading="lazy" onerror="setDefaultImage(this);">
									</div>
									<div class="col-sm-3 col-12">
										<img src="<?= base_url(); ?>/uploads/default_img.webp" class="medicine_details_image_small modal_item_image_change3" onclick="modal_item_image_change(3)" alt="zoom" loading="lazy" onerror="setDefaultImage(this);">
									</div>
									<div class="col-sm-3 col-12">
										<img src="<?= base_url(); ?>/uploads/default_img.webp" class="medicine_details_image_small modal_item_image_change4" onclick="modal_item_image_change(4)" alt="zoom" loading="lazy" onerror="setDefaultImage(this);">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-7 col-12">
						<div class="row">
							<div class="col-sm-12 col-12" style="margin-top: 5px;">
								<span class="medicine_details_item_name"></span>
							</div>
							<div class="col-sm-6 col-6 text-left">
								<span class="medicine_details_item_packing text-left"></span>
							</div>
							<div class="col-sm-6 col-6 text-right">
								<span class="medicine_details_item_batch_no"></span>
							</div>
							<div class="col-sm-6 col-6 text-left">
								<span class="medicine_details_item_margin"></span>
							</div>
							<div class="col-sm-6 col-6 text-right">
								<span class="medicine_details_item_expiry"></span>
							</div>
							<div class="col-sm-12 col-12">
								<span class="medicine_details_item_company"></span>
							</div>
							<div class="col-sm-6 col-6 text-left">
								<span class="medicine_details_item_stock"></span>
							</div>

							<div class="col-sm-6 col-6 text-right">
								<span class="medicine_details_item_scheme"></span>
							</div>
							
							<div class="col-sm-12 col-12 medicine_details_hr medicine_details_item_scheme_line text-center">
								Scheme is not added in Landing price
							</div>

							<div class="col-sm-12 col-12 medicine_details_hr medicine_details_item_description1">
							</div>

							<div class="col-sm-12 col-12 medicine_details_hr">
							</div>

							<div class="col-sm-6 col-6 text-left">
								<span class="medicine_details_item_ptr">
								</span>
							</div>
							<div class="col-sm-6 col-6 text-right">	
								<span class="medicine_details_item_mrp"></span>
							</div>
							<div class="col-sm-4 col-4 text-left">	
								<span class="medicine_details_item_gst"></span>
							</div>
							<div class="col-sm-8 col-8 text-right">
								<span class="medicine_details_item_price" title="*Approximate ~"></span>
							</div>
							<div class="col-sm-12 col-12 text-left medicine_details_hr">
								*The information given on this page is based on historical data and estimates . Please refer to the final invoice for the exact value. E&OE.
							</div>

							<div class="col-sm-12 col-12 medicine_details_hr">
							</div>

							<div class="col-sm-12 col-12 order_quantity_div">
								<div class="row">
									<div class="col-sm-5 col-4">
										<span class="medicine_details_item_order_quantity">Order quantity
										</span>
									</div>

									<div class="col-sm-7 col-8 text-right">
										<span class="medicine_details_item_total"></span>
									</div>

									<div class="col-sm-4 col-4">
										<input type="number" class="medicine_details_item_order_quantity_textbox input_type_text2" placeholder="Eg 1,2" name="quantity" required="" style="width:100px;" value="" title="Order quantity" min="1" max="1000" maxlength="4" onchange="change_item_order_quantity()" onkeyup="change_item_order_quantity()">
										<input type="hidden" class="medicine_details_item_price">
										<input type="hidden" class="medicine_details_item_code">
										<input type="hidden" class="medicine_details_item_quantity_max">
									</div>

									<div class="col-sm-1 col-1">
										<button type="submit" class="btn btn-danger medicine_details_item_delete main_theme_button_delete" onclick="delete_medicine('<?= $item_code; ?>')" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
									</div>

									<div class="col-sm-7 col-7">
										<button type="submit" class="btn btn-primary main_theme_button medicine_details_item_add_to_cart_btn"  onclick="medicine_add_to_cart_api()" title="Add to cart">Add to cart</button>

										<button type="submit" class="btn btn-primary main_theme_button_disable medicine_details_item_add_to_cart_btn_disable" onclick="" title="Add to cart">Add to cart</button>
									</div>

									<div class="col-sm-12 col-12 add_to_cart_error_message text-danger text-center medicine_details_hr"></div>
								</div>
							</div>
						</div>

					</div>
					<div class="col-sm-12 col-12 medicine_details_hr medicine_details_item_description2">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
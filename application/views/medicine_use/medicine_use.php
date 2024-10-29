<style>
.menubtn1,.search_medicine_main
{
	display:none;
}
@media screen and (max-width: 767px) {
	.homebtn_div
	{
		display:none;
	}
}
.medicine_use_div{
	border-radius: 10px;
    padding: 5px;
    margin: 5px;
    background-color: var(--main_theme_li2_bg_color);
    border: 1px solid var(--main_theme_border_color);
    box-shadow: 0px 0px 5px 0px var(--main_theme_box_shadow);
	height:210px;
}
.medicine_use_div img{
	object-fit: contain;
	height:200px;
}
.medicine_use_div1{
	border-radius: 10px;
    padding: 5px;
    margin: 5px;
    box-shadow: 0px 0px 5px 0px var(--main_theme_box_shadow);
	height:265px;
}
.medicine_use_div1 video{
	width:100%;
	height:250px;
	border-radius:10px;
}
</style>
<script>
$(".top_bar_title").html("Loading....");
function goBack() {
	window.location.href = "<?= base_url();?>";
}
</script>
<div class="container main_container">
<div class="row">
		<div class="col-sm-12 col-12">
			<div class="row">
				<div class="col-sm-12 col-12">	
					<div class="main_box_div p-2">
						<div class="row">
							<div class="col-sm-4 col-12">
								<div class="row">
									<div class="col-sm-12 col-9">
										<img src="<?= base_url(); ?>/img_v51/featured_img.png" alt="" class="medicine_details_featured_img" loading="lazy">

										<img src="<?= base_url(); ?>/img_v51/out_of_stock_img.png" alt="" class="medicine_details_out_of_stock_img" loading="lazy">

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
							<div class="col-sm-8 col-12">
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
											<div class="col-sm-4 col-4">
											</div>

											<div class="col-sm-8 col-8">
												<button type="submit" class="btn btn-primary main_theme_button"  onclick="get_single_medicine_info('<?= $item_code; ?>')" title="Add to cart">Add to cart</button>
											</div>

											<div class="col-sm-12 col-12 add_to_cart_error_message text-danger text-center medicine_details_hr"></div>
										</div>
									</div>
								</div>

							</div>
							<div class="col-sm-12 col-12 medicine_details_hr medicine_details_item_description2">
							</div>
						</div>
						<div class="col-sm-12 col-12 medicine_details_hr">
						</div>
						<b>Images</b>
						<div class="row load_page_images"></div>
						<div class="col-sm-12 col-12 medicine_details_hr">
						</div>
						<b>Videos</b>
						<div class="row load_page_videos"></div>
					</div>
				</div>     
			</div>
		</div> 
	</div>
</div>
<script>
item_code = '<?= $item_code; ?>';
</script>
<script src="<?= base_url(); ?>assets/js-<?php echo $WebsiteVersion; ?>//medicine_use.js"></script>
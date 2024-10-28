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
							<div class="col-sm-3 col-12">
								<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
									<a class="example-image-link" data-standard="">
									<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="100%" style="float: right;margin-top:10px;" class="medicine_details_image modal_item_image_change" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
									</a>
								</div>
								
								<!-- <img src="<?= base_url(); ?>/img_v51/featured_img.png" width="100" style="position: absolute;margin-top:10px;display:none;left: 15px;" alt="zoom" class="medicine_details_featured_img" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
								<img src="<?= base_url(); ?>/img_v51/out_of_stock_img.png" width="100" style="position: absolute;margin-top:10px;display:none;left: 15px;" alt="zoom" class="medicine_details_out_of_stock_img" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
								
								<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;margin-right: 6.6%;" class="medicine_details_image_small modal_item_image_change1" onclick="modal_item_image_change(1)" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
								<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;margin-right: 6.6%;" class="medicine_details_image_small modal_item_image_change2" onclick="modal_item_image_change(2)" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
								<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;margin-right: 6.6%;" class="medicine_details_image_small modal_item_image_change3" onclick="modal_item_image_change(3)" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
								<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;" class="medicine_details_image_small modal_item_image_change4" onclick="modal_item_image_change(4)" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'> -->
							</div>
							<div class="col-sm-9 col-12">
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
									<div class="col-sm-4 col-5 text-left">	
										<span class="medicine_details_item_gst"></span>
									</div>
									<div class="col-sm-8 col-7 text-right">
										<span class="medicine_details_item_price" title="*Approximate value ~"></span>
									</div>
									<div class="col-sm-12 col-12 medicine_details_hr">
									</div>
									<div class="col-sm-12 col-12 text-center">
									*Approximate billing value per unit, subject change . As per final invoice.
									</div>
									<div class="col-sm-12 col-12 medicine_details_hr">
									</div>
									<div class="col-sm-12 col-12" style="display:none">
										<span class="medicine_details_item_order_quantity" style="width:50%;float:left;margin-top:5px;">Order quantity
										</span>
										
										<span class="text-right" style="width:50%;float:left;margin-top:5px;">
											<input type="number" class="medicine_details_item_order_quantity_textbox" placeholder="Eg 1,2" name="quantity" required="" style="width:100px;float:right;" value="" title="Enter quantity" min="1" max="1000">
											<input type="hidden" class="medicine_details_item_quantity">
										</span>
									</div>
									<div class="col-sm-12 col-12 medicine_details_hr">
									</div>
									<div class="col-sm-12 col-12">
										<button type="submit" class="btn btn-primary main_theme_button"  onclick="get_single_medicine_info(18582)" title="Add to cart">Add to cart</button>
									</div>
									<div class="col-sm-12 col-12 medicine_details_hr" style="display:none">
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-12 medicine_details_hr medicine_details_item_description2">
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
<script src="<?= base_url(); ?>assets/js/medicine_use.js"></script>

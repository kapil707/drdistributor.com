<style>
@media screen and (max-width: 800px){
	.main_container {
		padding-bottom: 80px;
	}
}
.main_box_div_data{
	width: 49.7%;
    margin-right: 0.3%;
}
@media screen and (max-width: 800px) {
	.main_box_div_data{
		width:100%;
		margin-left:0px;
	}
}
</style>
<?php if(!empty($chemist_id)){ ?>
<style>
.top_bar_title1 {
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
	window.location.href = "<?= base_url();?>search_medicine";
}
</script>
<div class="container-fluid main_container">
	<div class="row">
		<div class="col-sm-6 col-6 mobile_off">
			<h6 class="home_page_heading_title3">
				My cart <span class="search_cart_page_total_cart_items"></span>
			</h6>
		</div>
		<div class="col-sm-6 col-6 text-right mobile_off" style="margin-top: 5px;">
			<a href="#" onclick="delete_all_medicine()" tabindex="-10" class="search_cart_delete_all_btn" title="Delete all medicines"> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete all medicines</a>
		</div>

		<div class="col-sm-12 col-12 col-padding-5 web-col-padding-5">
			<div class="main_box_div2 cart_page_div_for_fix_height">
				<span class="my_cart_api_div"></span>
			</div>
		</div>

		<div class="col-sm-4 col-12"></div>
		<div class="col-sm-4 col-12 text-center">
			<a href="<?=base_url();?>home/search_medicine" class="btn main_theme_button add_more_btn" style="margin-top:10px;display:none"> 
				+ Add new medicine
			</a>
		</div>
		<div class="col-sm-4 col-12"></div>
	</div>
</div>
<div class="search_cart_footer_div">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">	
				<strong style="color:red" class="place_order_message">
				</strong>
			</div>
			<div class="col-5 text-center">				
				<div class="search_cart_footer_div_total_items">Your cart is empty</div>
				<div class="search_cart_footer_div_total_price"><i class="fa fa-inr"></i>0.00/-</div>
			</div>
			<div class="col-7 text-center">
				<span class="search_cart_footer_div_cart_empty">
					<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px;display:none" id="order_loading"></i><button class="btn main_theme_button_disable" onclick="cart_empty_btn()" tabindex="-3" title="Your cart is empty">Your cart is empty</button>
				</span>
				<span class="cart_footer_div_can_not_place_order_btn" style="display:none">
					<em class="fa fa-circle-o-notch fa-spin" style="font-size:24px;display:none" id="order_loading"></em><button class="btn main_theme_button_disable" tabindex="-3" title="Can't Place your order">Can't Place your order</button>
				</span>
				<span class="cart_footer_div_place_order_btn" style="display:none">
					<em class="fa fa-circle-o-notch fa-spin" style="font-size:24px;display:none" id="order_loading"></em><button class="btn main_theme_button" onclick="place_order_model()" tabindex="-3" title="Place your order">Place your order</button>
				</span>
			</div>
		</div>
	</div>
</div>

<div style="width:100%;display:none;padding-top: 150px;" class="place_order_div">
	<h1 class="text-center">
		<img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px" alt="Loading...." title="Loading....">
	</h1>
	<h1 class="text-center">Loading....</h1>
	<h1 class="text-center">Please wait, Your order is under process.</h1>
</div>

<button type="button" class="place_order_model" data-toggle="modal" data-target="#myModal_place_order" style="display:none"></button>
<!-- The Modal -->
<div class="modal" id="myModal_place_order">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Enter a remark</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-times modal_cancel_btn" aria-hidden="true"></i>
				</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<div class="form-check" style="display:none;">
					<label class="form-check-label">
					<input type="radio" class="form-check-input" name="optradio" id="slice_type0" onclick="slice_type_change('0')" checked>Complete one order
					</label>
				</div>
				<?php /*
				<div class="form-check">
					<label class="form-check-label">
					<input type="radio" class="form-check-input" name="optradio" id="slice_type1" onclick="slice_type_change('1')">Break by Amount
					</label>
				</div>
				<div class="form-check disabled">
					<label class="form-check-label">
					<input type="radio" class="form-check-input" name="optradio" id="slice_type2" onclick="slice_type_change('2')">Break by Line Quantity
					</label>
					<input type="hidden" class="form-control" id="slice_type" value="0" />
				</div>*/ ?>
				<div class="form-group slice_item1_div" style="display:none">
					<label>Break by Amount</label>
					<select class="form-control" id="slice_item1">
						<option value="9000">9000</option>
						<option value="19000">19000</option>
						<option value="49000">49000</option>
						<option value="99000">99000</option>
						<option value="199000">199000</option>
					</select>
				</div>
				<div class="form-group slice_item2_div" style="display:none">
					<label>Break by Line Quantity</label>
					<select class="form-control" id="slice_item2">
						<option value="10">10</option>
						<option value="20">20</option>
						<option value="40">40</option>
						<option value="100">100</option>
					</select>
				</div>
				<div class="form-group">
					<textarea class="" id="remarks" rows="5" placeholder="Enter a remark" style="border-style: solid !important;border-color: #e0e0e0 !important;border-width: 1px !important;border-radius:10px;width: 100%;padding:10px;"></textarea>
				</div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn main_theme_button" data-dismiss="modal" onclick="place_order_complete()">Place your order</button>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>/assets/js/my_cart11.js"></script>
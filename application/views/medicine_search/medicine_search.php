<style>
.main_container{
	margin-bottom:100px;
}
</style>
<?php if(!empty($chemist_id)){ ?>
<style>
.top_bar_title {
	margin-top: -5px;
}
</style>
<script>
$(".top_bar_title1").show();
</script>
<?php } ?>
<script>
$(".top_bar_title").html("Search medicines");
function goBack() {
	window.location.href = "<?= base_url();?>home";
}
</script>
<div class="container-fluid main_container">
	<div class="row">
		<div class="col-sm-6 col-12 mobile_off" style="margin-bottom:5px;">
			<span class="text-left">
				<h6 class="home_page_heading_title2">Favourite medicines</h6>
			</span>
		</div>
		<div class="col-sm-3 col-12 mobile_off" style="margin-bottom:5px;">
			<h6 class="home_page_heading_title2" onclick="current_order_ref()">
				My Cart <span class="search_cart_page_total_cart_items"></span>
			</h6>
		</div>
		<div class="col-sm-3 col-12 mobile_off text-right" style="margin-bottom:5px;">
			<a href="#" onclick="delete_all_medicine()" tabindex="-10" class="cart_delete_btn delete_all_btn" title="Delete all medicines"> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete all medicines</a>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6 d-none d-sm-block">
			<div class="main_box_div search_page_div_for_fix_height get_medicine_favourite_api_div p-2">
				<h2 class="text-center"><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px" alt="Loading...." title="Loading...."></h2><h1 class="text-center">Loading....</h2>
			</div>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12 border_off_mobile">
			<div class="main_box_div search_page_div_for_fix_height my_cart_api_div p-2">
				<h2 class="text-center"><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px" alt="Loading...." title="Loading...."></h2><h1 class="text-center">Loading....</h2>
			</div>
		</div>
	</div>
</div>
<div class="search_cart_footer_div">
	<div class="container">
		<div class="row">
			<div class="col-5 text-center">				
				<div class="search_cart_footer_div_total_items">Your cart is empty</div>
				<div class="search_cart_footer_div_total_price"><i class="fa fa-inr"></i>0.00/-</div>
			</div>
			<div class="col-7 text-center">
				<span class="search_cart_footer_div_cart_empty">
					<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px;display:none" id="order_loading"></i><button class="btn btn-primary btn-block main_theme_button_disable" onclick="cart_empty_btn()" tabindex="-3" title="Your cart is empty">Your cart is empty</button>
				</span>
				<span class="search_cart_footer_div_add_to_cart" style="display:none">
					<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px;display:none" id="order_loading"></i><button class="btn btn-primary btn-block main_theme_button" onclick="view_cart_btn()" tabindex="-3" title="View cart">View cart</button>
				</span>
			</div>
		</div>
	</div>
</div>
<div class="background_blur" onclick="clear_search_icon()" style="display:none"></div>
<div class="menu_search_icon_box" style="display:none">
	<div class="row">
		<div class="col-sm-12 text-center">
			<b>Show Result</b>
		</div>
		<div class="col-sm-6">
			<label>Medicine : <input type="checkbox" class="menu_search_icon_checkbox checkbox_medicine" onchange="medicine_search_api()" checked></label>
		</div>
		<div class="col-sm-6">
			<label>Company : <input type="checkbox" class="menu_search_icon_checkbox checkbox_company" onchange="medicine_search_api()" checked></label>
		</div>
		<?php /*<div class="col-sm-6">
			<label>Out Of Stock <input type="checkbox" class="menu_search_icon_checkbox checkbox_out_of_stock" onchange="medicine_search_api()"></label>
		</div> */ ?>
		<div class="col-sm-8">
			Result Show :
		</div>
		<div class="col-sm-4">
			<select class="medicine_total_rec" onchange="medicine_search_api()">
				<option value="25">25</option>
				<option value="50">50</option>
				<option value="75">75</option>
				<option value="100">100</option>
				<option value="all">All</option>
			</select>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>/assets/js/medicine_search1.js"></script>
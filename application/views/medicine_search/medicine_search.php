<style>
.main_container{
	padding-bottom:0px;
}
@media screen and (max-width: 800px){
	.main_container {
		padding-bottom: 80px;
	}
}
</style>
<?php if(!empty($ChemistId) && $UserType=="sales"){ ?>
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
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>";
}
</script>
<div class="container-fluid main_container">
	<div class="row">
		<div class="col-lg-6 d-none d-lg-block">
			<span class="text-left">
				<h6 class="home_page_heading_title3">Favourite medicines</h6>
			</span>
		</div>
		<div class="col-lg-3 col-md-6 mobile_off">
			<h6 class="home_page_heading_title3" onclick="my_cart_api()">
				My Cart <span class="search_cart_page_total_cart_items"></span>
			</h6>
		</div>
		<div class="col-lg-3 col-md-6 mobile_off text-right">
			<a href="#" onclick="delete_all_medicine()" tabindex="-10" class="search_cart_delete_all_btn" title="Delete all medicines"> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete all medicines</a>
		</div>
		
		<div class="col-lg-6 d-none d-lg-block web-col-padding-5">
			<div class="main_box_div2 search_page_div_for_fix_height get_medicine_favourite_api_div"></div>
		</div>
		
		<div class="col-lg-6 col-md-12 d-none d-sm-block web-col-padding-5">
			<div class="medicine_search_page_cart_emtpy"></div>
			<div class="main_box_div2 search_page_div_for_fix_height my_cart_api_div"></div>
		</div>

		<div class="col-12 col-padding-5 mobile_show">
			<div class="search_result_div_mobile"></div>
			<div class="my_cart_api_div_mobile"></div>
			<div class="medicine_search_page_cart_emtpy"></div>
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
<script>
get_page_name = "medicine_search";// change value taki cart pur load na ho
</script>
<script src="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/js/medicine_favourite.js"></script>
<script src="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/js/medicine_search.js"></script>
<script>
$(document).ready(function(){	
	setTimeout('search_page_load();',100);
	setTimeout('medicine_favourite_api();',200);
	setTimeout('my_cart_api();',300);
});
</script>
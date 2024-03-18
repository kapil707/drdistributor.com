<style>
.maincontainercss{
	margin-bottom:100px;
}
.home_page_search_div_box_more_btn{
	display: inline-block !important;
}
@media screen and (max-width: 800px) {
	.home_page_search_div_box_more_btn{
		display:none;
	}
	.search_pg_menu_off,.main_home_top_btn{
		display:none;
	}
	.current_order_search_page,.delete_btn_icon
	{
		display: block !important;
	}
	.maincontainercss{
		margin-bottom:80px;
	}
}
.menu_search_icon{
	display: none;
}
.deleteicon
{
	display: initial !important;
}
.home_page_search_div_box,.select_medicine
{
	display: inline-block;
}
.select_chemist,.home_page_search_div,.search_medicine_result,.clear_search_icon
{
	display: none;
}
.search_medicine_main{
	display:block;
}
.top_menu_menu_main{
	display: none;
}
.maincontainercss {
    padding-top: 135px;
    min-height: 500px;
}
</style>
<?php if(!empty($chemist_id)){ ?>
<style>
.headertitle {
	margin-top: -5px;
}
</style>
<script>
$(".headertitle1").show();
</script>
<?php } ?>
<script>
$(".headertitle").html("Search medicines");
setTimeout('div_height();',500);
function  div_height(){
	$(".search_page_main_div").css("height",$(window).height() - 240)
	console.log($(window).height());
}
function goBack() {
	window.location.href = "<?= base_url();?>home";
}
</script>
<div class="container-fluid maincontainercss">
	<div class="row">
		<div class="col-sm-6 col-12 mobile_off" style="margin-bottom:5px;">
			<span class="text-left">
				<h6 class="search_pg_title_color">Favourite medicines</h6>
			</span>
		</div>
		<div class="col-sm-3 col-12 mobile_off" style="margin-bottom:5px;">
			<h6 class="search_pg_title_color" onclick="current_order_ref()">My Cart <span class="div_cart_total_items1"></span></h6>
		</div>
		<div class="col-sm-3 col-12 mobile_off text-right" style="margin-bottom:5px;">
			<a href="#" onclick="delete_all_medicine()" tabindex="-10" class="cart_delete_btn delete_all_btn" title="Delete all medicines">
			<i class="fa fa-trash-o" aria-hidden="true"></i> Delete all medicines</a>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6 d-none d-sm-block">
			<div class="website_box_part search_page_main_div get_medicine_favourite_div p-2">
				<h1 class="text-center"><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px" alt="Loading...." title="Loading...."></h1><h1 class="text-center">Loading....</h1>
			</div>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12 border_off_mobile">
			<div class="website_box_part search_page_main_div my_cart_api_div p-2">
				<h1 class="text-center"><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px" alt="Loading...." title="Loading...."></h1><h1 class="text-center">Loading....</h1>
			</div>
		</div>
	</div>
</div>
<div class="view_cart_or_empty_cart_btn_div">
	<div class="container">
		<div class="row">
			<div class="col-5 text-center">				
				<div class="div_cart_total_items">Your cart is empty</div>
				<div class="div_cart_total_price"><i class="fa fa-inr"></i>0.00</div>
			</div>
			<div class="col-7 text-center">
				<span class="cart_empty_cart_div">
					<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px;display:none" id="order_loading"></i><button class="btn btn-primary btn-block mainbutton_disable" onclick="cart_empty_btn()" tabindex="-3" title="Your cart is empty">Your cart is empty</button>
				</span>
				<span class="cart_add_to_cart_div" style="display:none">
					<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px;display:none" id="order_loading"></i><button class="btn btn-primary btn-block mainbutton" onclick="view_cart_btn()" tabindex="-3" title="View cart">View cart</button>
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
<script src="<?php echo base_url(); ?>/assets/js/medicine_search.js"></script>
<script>
$(".top_bar_title").html("<?= $main_page_title ?>");
function goBack() {
	window.location.href = "<?= base_url();?>";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-12 col-12">
			<div class="row">
				<div class="col-sm-12 text-right" style="display:none;">
					<img src="<?= base_url() ?>/img_v51/sortline.png" width="25px;" onclick="show_sorting_div();" class="showbtn" alt>
					<img src="<?= base_url() ?>/img_v51/sortline.png" width="25px;" onclick="hide_sorting_div();" class="showbtn1" style="display:none;" alt>
				</div>
				<div class="col-sm-12 sorting_div text-right" style="display:none;">
					<span class="sort_atoz" onclick="sort_atoz();">Name A to Z |</span>
					<span class="sort_ztoa" onclick="sort_ztoa();" style="display:none;">Name Z to A |</span>
					<span class="sort_price" onclick="sort_price();">Price Low to High | </span>
					<span class="sort_price1" onclick="sort_price1();" style="display:none;">Price High to Low | </span>
					<span class="sort_margin" onclick="sort_margin();">Margin Low to High</span>
					<span class="sort_margin1" onclick="sort_margin1();" style="display:none;">Margin High to Low</span>
				</div>
			</div>
			<div class="row load_page"></div>
			<div class="row">
				<div class="col-sm-12 text-center">
					<span class="load_page_loading" style="position: fixed;top: 300px;z-index: 100;margin-left:-90px"></span>
				</div>
			</div>
		</div>
	</div>     
</div>
<input type="hidden" class="get_record" value="0">
<script>
var item_page_type = '<?= $item_page_type; ?>';
var item_code = '<?= $item_code; ?>';
var item_division = '<?= $item_division; ?>';
</script>
<script src="<?php echo base_url(); ?>/assets/js/medicine_category1234567.js"></script>
<script>
function show_sorting_div()
{
	$(".showbtn").hide();	
	$(".showbtn1").show();
	$(".sorting_div").show();
}
function hide_sorting_div()
{
	$(".showbtn").show();	
	$(".showbtn1").hide();
	$(".sorting_div").hide();
}

function sort_atoz()
{
	$(".sort_atoz").hide();
	$(".sort_ztoa").show();	
	hide_sorting_div();
	call_page("sort_atoz");
}
function sort_ztoa()
{	
	$(".sort_atoz").show();
	$(".sort_ztoa").hide();
	hide_sorting_div();
	call_page("sort_ztoa");
}
function sort_price()
{
	$(".sort_price").hide();
	$(".sort_price1").show();	
	hide_sorting_div();
	call_page("sort_price");
}
function sort_price1()
{	
	$(".sort_price").show();
	$(".sort_price1").hide();
	hide_sorting_div();
	call_page("sort_price1");
}
function sort_margin()
{
	$(".sort_margin").hide();
	$(".sort_margin1").show();	
	hide_sorting_div();
	call_page("sort_margin");
}
function sort_margin1()
{	
	$(".sort_margin").show();
	$(".sort_margin1").hide();
	hide_sorting_div();
	call_page("sort_margin1");
}
</script>
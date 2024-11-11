<style>
.main_container{
	width:80%;
}
@media screen and (max-width: 800px){
	.main_container{
		width:100%;
	}
}
</style>
<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>";
}
</script>
<div class="container-fluid main_container">
	<div class="row">
		<div class="col-sm-12 col-12">
			<div class="row">
				<div class="col-sm-12 text-right" style="display:none;">
					<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/sortline.png" width="25px;" onclick="show_sorting_div();" class="showbtn" alt>
					<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/sortline.png" width="25px;" onclick="hide_sorting_div();" class="showbtn1" style="display:none;" alt>
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
			<div class="row main_page_data" style="display:none"></div>
		</div>
	</div>     
</div>
<input type="hidden" class="get_record" value="0">
<script>
var item_page_type = '<?= $item_page_type; ?>';
var item_code_pg = '<?= $item_code; ?>'; // yha sahi ha ku ki item_code already page me ho raha ha use
var item_division = '<?= $item_division; ?>';
</script>
<script src="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/js/medicine_category1.js"></script>
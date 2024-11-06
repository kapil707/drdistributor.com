<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>io";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-12 col-12 main_page_data"></div>
		<div class="col-sm-6 col-6 text-left next_button_show" style="display:none">
			<button type="submit" class="btn btn-primary main_theme_button next_btn" name="submit" value="submit" onclick="add_new_medicine()" style="width:30%"> + Add Medicine</button>
		</div>
		<div class="col-sm-6 col-6 text-right next_button_show" style="display:none">
			<a href="<?= base_url(); ?>io/mdi/<?php echo base64_encode($order_id); ?>">
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
order_id = "<?php echo $order_id ?>";
get_page_name = "import_page";// change value taki cart pur load na ho 
order_type = "notall";// change value taki cart pur load na ho 
</script>
<script src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/js/import_order/process_main0012.js"></script>
<script src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/js/import_order/process_main_other001.js"></script>
<script src="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/js/medicine_search.js"></script>
<script>
$(document).ready(function(){
	CheckOrderApi();
	import_order_page_load();
});
</script>
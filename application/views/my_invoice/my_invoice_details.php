<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>my_invoice";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4 col-12 download_excel_url p-2"></div>
		<div class="col-sm-4"></div>
		<div class="col-sm-12 col-12">
			<div class="main_page_data">
			</div>
		</div>
		<div class="col-sm-12 col-12 text-center main_page_data_edit_title" style="display:none" style="margin-top:5px;margin-bottom:5px;">
			<h4>Item quantity changed</h4>
		</div>
		<div class="col-sm-12 col-12">
			<div class="main_page_data_edit">
			</div>
		</div>
		<div class="col-sm-12 col-12 text-center main_page_data_delete_title" style="display:none" style="margin-top:5px;margin-bottom:5px;">
			<h4>Items deleted</h4>
		</div>
		<div class="col-sm-12 col-12">
			<div class="main_page_data_delete">
			</div>
		</div>
	</div>
</div>
<script>
var ItemId = "<?php echo $ItemId; ?>";
</script>
<script src="<?php echo base_url(); ?>/assets/js-<?php echo $this->appconfig->getWebJs(); ?>/my_invoice_details12.js"></script>
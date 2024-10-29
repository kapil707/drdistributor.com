<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>my_order";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4 col-12 download_excel_url p-2"></div>
		<div class="col-sm-4"></div>
		<div class="col-sm-12 col-12">
			<div class="row">
				<div class="col-sm-12 col-12">
					<div class="main_page_data">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
var item_id = "<?php echo $item_id; ?>";
</script>
<script src="<?php echo base_url(); ?>/assets/js-<?php echo $WebsiteVersion; ?>//my_order_details.js"></script>
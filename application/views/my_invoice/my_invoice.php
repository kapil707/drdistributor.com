<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>";
}
</script>
<div class="container main_container">
	<div class="row">
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
<input type="hidden" class="get_record" value="0">
<script>
$(".main_page_loading").show();
</script>
<script src="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/js/my_invoice123456789.js"></script>
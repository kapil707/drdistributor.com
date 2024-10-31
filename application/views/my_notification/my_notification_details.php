<style>
.main_container{
	margin-bottom:100px;
}
</style>
<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>my_notification";
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
<script>
var item_id = "<?php echo $item_id; ?>";
</script>
<script src="<?php echo base_url(); ?>/assets/js-<?php echo $this->appconfig->getWebJs(); ?>/my_notification_details.js"></script>
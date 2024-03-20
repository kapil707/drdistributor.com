<style>
.main_container{
	margin-bottom:100px;
}
</style>
<script>
$(".top_bar_title").html("<?= $main_page_title ?>");
function goBack() {
	window.location.href = "<?= base_url();?>my_notification";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-12 col-12">
			<div class="row">
				<div class="col-sm-12 col-12">
					<div class="main_box_div main_page_data p-2" style="display:none">
					</div>
				</div>
				<div class="col-sm-12 main_page_loading" style="margin-top:10px;">
				
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var item_id = "<?php echo $item_id; ?>";
</script>
<script src="<?php echo base_url(); ?>/assets/js/my_notification_details22.js"></script>
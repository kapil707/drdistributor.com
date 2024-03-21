<script>
$(".top_bar_title").html("<?= $main_page_title ?>");
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
					<div class="main_box_div main_page_data p-2" style="display:none">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
var item_id = "<?php echo $item_id; ?>";
var user_altercode = "<?php echo $user_altercode; ?>";
</script>
<script src="<?php echo base_url(); ?>/assets/js/my_order_details_main.js"></script>
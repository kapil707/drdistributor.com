<script>
$(".headertitle").html("<?= $main_page_title ?>");
function goBack() {
	window.location.href = "<?= base_url();?>my_order";
}
</script>
<div class="container maincontainercss">
	<div class="row">
		<div class="col-sm-12 col-12">
			<div class="row">
				<div class="col-sm-12 col-12">
					<div class="website_box_part main_page_data p-2" style="display:none">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
					<span class="main_page_loading" style="position: fixed;top: 300px;z-index: 100;margin-left:-90px"></span>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var item_id = "<?php echo $item_id; ?>";
</script>
<script src="<?php echo base_url(); ?>/assets/js/my_order_details123eifg.js"></script>
<script>
$(".top_bar_title").html("<?= $main_page_title ?>");
function goBack() {
	window.location.href = "<?= base_url();?>my_invoice";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-3 col-12 download_excel_url">
					
		</div>
		<div class="col-sm-3"></div>
		<div class="col-sm-12 col-12">
			<div class="main_box_div main_page_data p-2" style="display:none">
			</div>
		</div>
		<div class="col-sm-12 load_page_loading" style="margin-top:10px;">
		
		</div>
		<div class="col-sm-12 col-12 text-center div_item_edit" style="display:none" style="margin-top:5px;margin-bottom:5px;">
			<h4>Item quantity changed</h4>
		</div>
		<div class="col-sm-12 col-12">
			<div class="main_box_div main_page_data_edit p-2" style="display:none">
			</div>
		</div>
		<div class="col-sm-12 col-12 text-center main_page_data_delete" style="display:none" style="margin-top:5px;margin-bottom:5px;">
			<h4>Items deleted</h4>
		</div>
		<div class="col-sm-12 col-12">
			<div class="main_box_div load_page_delete p-2" style="display:none">
			</div>
		</div>
	</div>
</div>
<script>
	var item_id = "<?php echo $item_id; ?>";
</script>
<script src="<?php echo base_url(); ?>/assets/js/my_invoice_details234.js"></script>
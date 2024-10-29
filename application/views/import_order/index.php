<?php if(!empty($chemist_id)){ ?>
<style>
.top_bar_title{
	margin-top: -5px;
}
</style>
<script>
$(".top_bar_title1").show();
</script>
<?php } ?>
<script>
$(".top_bar_title").html("<?= $main_page_title ?>");
function goBack() {
	window.location.href = "<?= base_url();?>";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-12 col-12 main_box_div">
			<div class="form-group mt-2">
				<label for="file" class="label_css">Upload excel file</label>
				<div class="row">
					<div class="col-sm-8 col-11">
						<input id="sortpicture" type="file" name="sortpic" class="input_type_text2 login_textbox" onchange="sortpicture_change()" />
						<input type="hidden" name="chemist_id" id="chemist_id" class="chemist_id" value="<?= $chemist_id ?>" style="padding-bottom: 36px;" />
					</div>
					<div class="col-sm-1 col-1">
						<input id="clearfile" type="submit" name="clearfile" class="btn btn-w-m btn-danger clearfile site_round_btn31" onclick="clearfile()" style="display:none" value="Clear" style="width:20%" />
					</div>
					
					<div class="col-sm-3 col-12 text-right">
						<a href="<?= base_url() ?>import_order/medicine_suggest" title="Update suggest medicine" style="font-size: 15px; color:gray">
							<i class="fa fa-thumbs-o-up fa-2x" aria-hidden="true"></i>
							Update suggest medicine
						</a>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label for="file" class="label_css">Header column number</label>
				<input type="text" name="headername"  class="input_type_text2 login_textbox headername" placeholder="Header column number" value="<?= $headername ?>" />
			</div>	
			<div class="form-group">
				<label for="file" class="label_css">Item column name</label>
				<input type="text" name="itemname" class="input_type_text2 login_textbox itemname" placeholder="Item column name" value="<?= $itemname ?>" />
			</div>	
			<div class="form-group">
				<label for="file" class="label_css">Item column mrp</label>
				<input type="text" name="itemmrp" class="input_type_text2 login_textbox itemmrp" placeholder="Item column mrp" value="<?= $itemmrp ?>" />
			</div>
			<div class="form-group">
				<label for="file" class="label_css">Item column quantity</label>
				<input type="text" name="itemqty" class="input_type_text2 login_textbox itemqty" placeholder="Item column quantity" value="<?= $itemqty ?>" />
			</div>
			<div class="form-group text-center">
				<button id="upload_import_file" onclick="upload_import_file()" class="btn btn-primary main_theme_button" style="width:20%">Upload</button>
			</div>					
		</div>
	</div>  
</div>
<script src="<?= base_url(); ?>assets/js-<?php echo $this->appconfig->getWebsiteVersion; ?>/import_order/index.js"></script>
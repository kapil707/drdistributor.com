<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>account";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 col-12">
			<div class="row main_box_div p-2">
				<div class="col-sm-12">
					<div class="main_box_div_data">
						<div class="all_page_box_left_div">
							<img src="<?= $UserImage ?>" class="all_item_image" onerror="setDefaultImage(this);">
						</div>
						<div class="all_page_box_right_div text-left">
							<span class="all_item_name"><?= $UserFullName ?></span><br>
							<span class="all_item_packing">Code :
							<?php echo $ChemistId ?></span>
						</div>
					</div>
				</div>
				<div class="col-sm-12 mt-2">
					<label>Enter mobile</label>
				</div>
				<div class="col-sm-12">
					<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/phone1.png" width="25px" style="float: left; margin-top: 7px;position: absolute;margin-left: 10px;" alt>
					<input type="text" value="" class="input_type_text login_textbox" placeholder="Enter mobile" required="" name="mobile1" id="mobile1" title="Enter mobile" style="padding-left:40px;float: left;">
				</div>
				<div class="col-sm-12 mt-2">
					<label>Enter email</label>
				</div>
				<div class="col-sm-12">
					<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/email1.png" width="25px" style="float: left; margin-top: 7px;position: absolute;margin-left: 10px;" alt>
					<input type="text" value="" class="input_type_text login_textbox" placeholder="Enter email" required="" name="email1" id="email1" title="Enter email" style="padding-left:40px;float: left;">
				</div>
				<div class="col-sm-12 mt-2">
					<label>Enter address</label>
				</div>
				<div class="col-sm-12">
					<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/map1.png" width="25px" style="float: left; margin-top: 7px;position: absolute;margin-left: 10px;" alt>
					<input type="text" value="" class="input_type_text login_textbox" placeholder="Enter address" required="" name="address1" id="address1" title="Enter address" style="padding-left:40px;float: left;">
				</div>
				<div class="col-sm-12 mt-2 text-center">
					<span class="main_theme_gray_text submit_div" style="margin-top:10px;">&nbsp;</span>
				</div>
				<div class="col-sm-12 mb-2">
					<input type="submit" value="Update account" class="main_theme_button" name="Submit" onclick="submitbtn()" id="submitbtn">
					<input type="submit" value="Update account" class="main_theme_button_disable" id="submitbtn_disable" style="display:none">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 main_box_div load_page mt-2 p-2 mb-2" style="display:none;">
				</div>				
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/js/user/update_account.js"></script>
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
					<label>Enter oldpassword</label>
				</div>
				<div class="col-sm-12">
					<img src="<?= base_url() ?>/img_v51/b_lock.png" width="25px" style="float: left; margin-top: 7px;position: absolute;margin-left: 10px;" alt>
					<input type="password" value="" class="input_type_text login_textbox" placeholder="Enter oldpassword" required="" name="old_password" id="old_password" title="Enter oldpassword" autocomplete="new-password" onchange="check_old_password()" style="padding-left:40px;float: left;">
					<div style="float: right; margin-top: 10px;margin-left: -50px; width:45px;">
						<img src="<?= base_url() ?>/img_v51/b_eyes1.png" width="25px" onclick="showpassword()" id="eyes1" alt>
						<img src="<?= base_url() ?>/img_v51/b_eyes.png" width="25px" onclick="hidepassword()" id="eyes" style="display:none" alt>
					</div>
				</div>
				<div class="col-sm-12 mt-2">
					<label>Enter newpassword</label>
				</div>
				<div class="col-sm-12">
					<img src="<?= base_url() ?>/img_v51/b_lock.png" width="25px" style="float: left; margin-top: 7px;position: absolute;margin-left: 10px;" alt>
					<input type="password" value="" class="input_type_text login_textbox" placeholder="Enter newpassword" required="" name="new_password" id="new_password" title="Enter newpassword" maxlength="16" autocomplete="new-password" onchange="check_password1()" style="padding-left:40px;float: left;">
					<div style="float: right; margin-top: 10px;margin-left: -50px; width:45px;">
						<img src="<?= base_url() ?>/img_v51/b_eyes1.png" width="25px" onclick="showpassword1()" id="eyes1" alt>
						<img src="<?= base_url() ?>/img_v51/b_eyes.png" width="25px" onclick="hidepassword1()" id="eyes" style="display:none" alt>
					</div>
				</div>
				<div class="col-sm-12 mt-2">
					<label>Re-enter newpassword</label>
				</div>
				<div class="col-sm-12">
					<img src="<?= base_url() ?>/img_v51/b_lock.png" width="25px" style="float: left; margin-top: 7px;position: absolute;margin-left: 10px;" alt>
					<input type="password" value="" class="input_type_text login_textbox" placeholder="Re-enter newpassword" required="" name="renew_password" id="renew_password" title="Re-enter newpassword" autocomplete="new-password" onchange="check_password2()" style="padding-left:40px;float: left;">
					<div style="float: right; margin-top: 10px;margin-left: -50px; width:45px;">
						<img src="<?= base_url() ?>/img_v51/b_eyes1.png" width="25px" onclick="showpassword2()" id="eyes1" alt>
						<img src="<?= base_url() ?>/img_v51/b_eyes.png" width="25px" onclick="hidepassword2()" id="eyes" style="display:none" alt>
					</div>
				</div>
				<div class="col-sm-12 mt-2 text-center">
					<span class="text-center main_theme_gray_text submit_div" style="margin-top:10px;">&nbsp;</span>
				</div>
				<div class="col-sm-12 mb-2">
					<input type="submit" value="Update password" class="main_theme_button" onclick="submitbtn()" id="submitbtn" style="display:none">
					<input type="submit" value="Update password" class="main_theme_button_disable" id="submitbtn_disable">
				</div>
			</div> 
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/js/user/update_password1.js"></script>
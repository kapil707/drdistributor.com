	<div class="top_bar" style="position: relative !important;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">						
					<div class="text-center">
						<img src="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/images/logo4.png" width="60px" alt>
					</div>
					<h2 class="login_text_font text-center">
						<?= $this->appconfig->getSiteTitle2(); ?>
					</h2>
					<h5 class="text-right login_text_font">
						Request for login credentials
					</h5>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" style="margin-top:50px;">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 main_box_div p-5">
				<label class="label_css">Enter chemist code</label>
				<div class="form-row">
					<div class="form-group col">
						<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/my_account1.png" width="25px" style="float: left; margin-top: 10px;position: absolute;margin-left: 10px;" alt>
						<input type="text" value="" class="input_type_text login_textbox" placeholder="Chemist code(e.g. A125)" required="" name="user_name1" id="user_name1" title="Chemist code(e.g. A125)">
					</div>
				</div>
				<label class="label_css">Enter mobile number</label>
				<div class="form-row">
					<div class="form-group col">
						<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/phone1.png" width="25px" style="float: left; margin-top: 10px;position: absolute;margin-left: 10px;" alt>
						<input type="text" value="" class="input_type_text login_textbox" placeholder="Mobile number(e.g. 95123XXXXX)" required="" name="phone_number1" id="phone_number1" style="float: left;" title="Mobile number(e.g. 95123XXXXX)" maxlength="10">
					</div>
				</div>
				<h5 class="text-center submit_div mt-2">&nbsp;</h5>
				<div class="text-center" style="margin-top:10px;">
					<input type="submit" value="Submit" class="main_theme_button" name="Submit" onclick="submitbtn()"
					id="submitbtn">
					<input type="submit" value="Submit" class="main_theme_button_disable" id="submitbtn_disable" style="display:none">
				</div>
				<div class="text-center" style="margin-top:30px;">
					Already have an account? 
					<a href="<?= base_url() ?>login" class="main_theme_a">
					Login</a>
				</div>
				<div class="text-center" style="margin-top:15px;">
					<a href="<?= base_url() ;?>privacy_policy" title="Privacy policy" class="main_theme_a">
					Privacy policy</a>
				</div>
				<div class="text-center website_name_css" style="margin-top:15px;">
					<?= $this->Scheme_Model->get_website_data("title2") ;?>
				</div>
				<div class="text-center website_version_css" style="margin-top:5px;">
					Website version <?= $this->appconfig->getWebsiteVersion(); ?>
				</div>
			</div>
			<div class="col-md-3">
			</div>
		</div>
	</div>
</body>
</html>
<script src="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/js/account/account_request.js"></script>
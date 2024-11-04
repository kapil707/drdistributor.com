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
					<img class="img-circle" src="<?= base_url() ?>/img_v51/logo.png" width="40%" alt="Change Image" title="Update Image" style="margin-left:30%" id="user_profile">
				</div>
				<div class="col-sm-12 mt-2 mb-2">
					<div class="main_box_div_data p-4">
						<a href="javascript:getfile_fun()" title="Select image from gallery" class="main_theme_a">
							<img class="img-circle" src="<?= base_url() ?>/img_v51/photo1.png" width="30" alt="Select image from gallery" title="Select image from gallery">
							<span style="margin-left:20px;">Select image from gallery</span>
						</a>
					</div>
					<input type="file" id="getfile" onchange="update_user_upload_image_api()" style="display:none" accept=", image/gif,image/jpg,image/png,image/jpeg" />
				</div>
			</div> 
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/js/user/update_image.js"></script>
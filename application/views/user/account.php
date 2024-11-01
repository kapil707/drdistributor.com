<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>";
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
					<div class="main_box_div_data p-4 load_page">
						
					</div>
				</div>
				<div class="col-sm-12 mt-2">
					<div class="main_box_div_data p-4">
						<a href="<?= base_url(); ?>update_account" title="Update account" class="main_theme_a">
							<img class="img-circle" src="<?= base_url() ?>/img_v51/edit_icon.png" width="30" alt="Update Image" title="Update account">
							<span style="margin-left:20px;">Update account</span>
						</a>
					</div>
				</div>
				<div class="col-sm-12 mt-2">
					<div class="main_box_div_data p-4">
						<a href="<?= base_url(); ?>update_image" title="Update image" class="main_theme_a">
							<img class="img-circle" src="<?= base_url() ?>/img_v51/photo1.png" width="30" alt="Update Image" title="Update Image">
							<span style="margin-left:20px;">Update image</span>
						</a>
					</div>
				</div>
				<div class="col-sm-12 mt-2 mb-2">
					<div class="main_box_div_data p-4">
						<a href="<?= base_url();?>update_password" title="Update password" class="main_theme_a">
							<img class="img-circle" src="<?= base_url() ?>/img_v51/b_lock.png" width="30" alt="Update Password" title="Update Password">
							<span style="margin-left:20px;">Update password</span>
						</a>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-12">
					<div class="text-center" style="margin-top:20px;">
						<img src="<?= base_url() ?>/img_v51/logo.png" class="img-fluid" style="margin-top: 5px;" alt width="100px;">
					</div>
					<div class="text-center website_name_css" style="margin-top:15px;">
						<?= $this->Scheme_Model->get_website_data("title2") ;?>
					</div>
					<div class="text-center website_version_css" style="margin-top:5px;">
						Website version <?= $this->appconfig->getWebsiteVersion(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>/assets/js-<?php echo $this->appconfig->getWebJs(); ?>/user/account.js"></script>
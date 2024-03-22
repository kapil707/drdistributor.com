<style>
.top_bar_logo{
	display: inline !important;
}
.top_bar_back_btn{
	display: none !important;
}
.top_bar_title{
	margin-top: 0px;
	font-size:18px;
}
.top_bar_title1{
	display: inline !important;
}
.main_container {
    padding-top: 160px;
    min-height: 500px;
    padding-bottom: 100px;
}
</style>
<?php
$ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
$isMob = is_numeric(strpos($ua, "mobile"));

$default_img = base_url()."/uploads/default_img.jpg";
$error_img ="onerror=this.src=".base_url()."/uploads/default_img.jpg";

?>
<div class="container-fluid main_container">
	<div class="row home_page_slider1_data"></div>
	<div class="row home_page_divisioncategory1_data"></div>
	<div class="row home_page_menu_data"></div>
	<div class="row home_page_invoice_notification_data"></div>
	<div class="row home_page_all_data"></div>

	<div class="row">
		<div class="col-sm-6"></div>
		<div class="col-sm-12 text-center">
			<div class="main_page_loading1">
				<h2>
					<img src="<?php echo base_url(); ?>/img_v51/loading.gif" width="100px">
				</h2>
				<h2>Please wait....</h2>
			</div>
			<!-- <div class="load_more btn btn-success" onclick="load_more()">Load More</div> -->
		</div>
		<div class="col-sm-6"></div>
	</div>

	<div class="mobile_show">
		<div class="row">
			<div class="col-sm-12 col-col-padding-5">
				<ul class="home_page_mobile_footer">
					<li>
						<a href="tel:<?= $this->Scheme_Model->get_website_data("android_mobile") ;?>">
							<i class="fa fa-phone" aria-hidden="true"></i> 
							<?= $this->Scheme_Model->get_website_data("android_mobile") ;?>
						</a>
					</li>
					<li>
						<a href="mail:<?= $this->Scheme_Model->get_website_data("android_email") ;?>">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<?= $this->Scheme_Model->get_website_data("android_email") ;?>
						</a>
					</li>
					<li>
						<a href="https://play.google.com/store/apps/details?id=com.drdistributor.dr&hl=en" target="_black" title="Download App">
							<i class="fa fa-mobile" aria-hidden="true"></i>
							Download App
						</a>
					</li>
				</ul>
			</div>
			<div class="col-sm-12 text-center">
				<div class="text-center" style="margin-top:20px;">
					<img src="<?= base_url() ?>/img_v51/logo4.png" class="img-fluid" width="100px;">
				</div>
				<div class="text-center footer_website_name_css" style="margin-top:15px;">
					<?= $this->Scheme_Model->get_website_data("title2") ;?>
				</div>
				<div class="text-center footer_website_version_css" style="margin-top:5px;">
					Website version <?= $this->Scheme_Model->get_website_data("android_versioncode") ;?>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url(); ?>assets/website/js/jssor.slider-28.0.0.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script src="<?php echo base_url(); ?>/assets/js/home_page123.js"></script>
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
.main_container{
	padding-top: 160px;
    min-height: 500px;
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
</div>

<script src="<?= base_url(); ?>assets/website/js/jssor.slider-28.0.0.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script src="<?php echo base_url(); ?>/assets/js/home_page1.js"></script>
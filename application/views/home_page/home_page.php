<style>
.top_bar_logo{
	display: inline !important;
}
.top_bar_title2{
	display: none !important;
}
.top_bar_back_btn{
	display: none !important;
}
.top_bar_google_play_btn{
	display: inline !important;
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
<script>
$(".top_bar_title").html("Delivering to");
</script>
<div class="container-fluid main_container">
	<div class="row home_page_slider1_data"></div>
	<div class="row home_page_divisioncategory1_data"></div>
	<div class="row home_page_menu_data"></div>
	<?php if(!empty($UserType)){ ?>
	<div class="row home_page_invoice_notification_data"></div>
	<?php } ?>
	<div class="row home_page_all_data"></div>

	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4 text-center">
			<div class="main_page_loading1">
				<h2>
					<img src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/images/loading.gif" width="100px">
				</h2>
				<h2>Please wait....</h2>
			</div>
			<!-- <div class="load_more btn btn-success" onclick="load_more()">Load More</div> -->
		</div>
		<div class="col-sm-4"></div>
	</div>

	<div class="mobile_show">
		<div class="row">
			<div class="col-sm-12 col-12 col-padding-5">
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
					<img src="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/images/logo4.png" class="img-fluid" width="100px;">
				</div>
				<div class="text-center footer_website_name_css" style="margin-top:15px;">
					<?= $this->Scheme_Model->get_website_data("title2") ;?>
				</div>
				<div class="text-center footer_website_version_css" style="margin-top:5px;">
					Website version <?= $this->appconfig->getWebsiteVersion(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ******************broadcast_message***************************** -->
<a href="#" data-toggle="modal" data-target="#myModal_broadcast" style="text-decoration: none;" class="myModal_broadcast"></a>
<div class="modal modaloff" id="myModal_broadcast">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title broadcast_title">
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times modal_cancel_btn" aria-hidden="true"></i>	
				</button>
			</div>
			<div class="modal-body">
				<pre><p class="broadcast_message"></p></pre>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/js/jssor.slider-28.0.0.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script src="<?php echo base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/js/home_page.js"></script>
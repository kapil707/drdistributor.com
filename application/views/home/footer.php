<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/website/wow_css_js/animate.css">
	
<script src="<?= base_url(); ?>assets/website/js/blazy.min.js"></script>
<script src="<?= base_url(); ?>assets/website/js/scripts.js"></script>
<script>
// LAZY LOADING IMAGES
var bLazy = new Blazy();

wow = new WOW(
{
boxClass:     'wow',      // default
animateClass: 'animated', // default
offset:       1,          // default
mobile:       true,       // default
live:         true        // default
}
)
wow.init();
</script>
<div class="website_footer1 mobile_off">
	<div class="container">
		<div class="row">
			<div class="col-sm-2">
				<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/drphone.png" class="img-fluid" style="margin-top: 5px;" alt>
			</div>
			<div class="col-sm-10 text-center download_app_div">
				Download the App for Free
				<div style="width:250px;margin:auto;margin-top:50px;">
					<div class="google_play">
						<a href="https://play.google.com/store/apps/details?id=com.drdistributor.dr&hl=en_IN" target="_blank">
						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/playstrore.png" alt="Google Play" style="width:35px;"> Google Play
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="website_footer mobile_off" style="background-image: linear-gradient(#f6f6f6, #f1f1f1);">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="text-center footer_copy">
					<div class="text-center" style="margin-top:15px;">
						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/logo4.png" class="img-fluid" style="margin-top: 5px;" alt width="100px;">
					</div>
					<div class="text-center" style="margin-top:15px;">
						<strong><?= $this->Scheme_Model->get_website_data("title2") ;?></strong>
					</div>
					<div class="text-center" style="margin-top:5px;">
						Website version <?= $this->Scheme_Model->get_website_data("android_versioncode") ;?>
					</div>
				</div>
			</div>
			
			<div class="col-sm-4">
				<ul class="follow-footer-ul">
					<li class="footer_li_title"></li><ul>
					<li class="footer_li_title text-capitalize">Follow Us</li>
					<li class=""><img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/insta.svg"></li>
					<li class=""><img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/fb.svg"></li>
					<li class=""><img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/youtube.svg"></li>
					<li class=""><img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/twitter.svg"></li>
				<ul>
				<ul class="bottom-footer-ul">
					<li><i class="fa fa-envelope" aria-hidden="true"></i><?= $this->Scheme_Model->get_website_data("android_email") ;?></li>
					<li><i class="fa fa-phone" aria-hidden="true"></i><?= $this->Scheme_Model->get_website_data("android_mobile") ;?></li>
					<li><i class="fa fa-whatsapp" aria-hidden="true"></i><?= $this->Scheme_Model->get_website_data("android_whatsapp") ;?></li>
				</ul>
			</div>
			<div class="col-sm-4">
				<ul>
					<li class="footer_li_title">Need Help?</li>
					<li class="footer_li_text">
						<a href="<?= base_url('user/privacy_policy')?>" title="Privacy policy">
							<i class="fa fa-book left_menu_icon" aria-hidden="true"></i>
							Privacy policy
						</a>
					</li>
					<li class="footer_li_text">
						<a href="https://play.google.com/store/apps/details?id=com.drdistributor.dr&hl=en" target="_black" title="Share App">
							<i class="fa fa-share-alt-square left_menu_icon" aria-hidden="true"></i>
							Share App
						</a>
					</li>
					<li class="footer_li_text">
						<a href="https://play.google.com/store/apps/details?id=com.drdistributor.dr&hl=en" target="_black" title="Download App">
							<i class="fa fa-mobile left_menu_icon" aria-hidden="true"></i>
							Download App
						</a>
					</li>
				<ul>
			</div>
		</div>
	</div>
</div>

<div class="fix_footer mobile_show">
	<div class="mobile_footer div_width_20par text_cut_or_dot mobile_footer_css_ok text-center">
		<a href="<?= base_url('home/account')?>">
			<i class="fa fa-user" aria-hidden="true"></i>
			<div style="font-size: 11px;">Account</div>
		</a>
	</div>
	<div class="mobile_footer div_width_20par text_cut_or_dot mobile_footer_css_ok_left text-center">
		<a href="<?= base_url('home/track_order')?>">
			<i class="fa fa-map-marker" aria-hidden="true"></i>
			<div style="font-size: 11px;">Track</div>
		</a>
	</div>
	
	<div class="mobile_footer div_width_20par text_cut_or_dot mobile_footer_css_ok_center text-center">
		<a href="<?= base_url('home/search_medicine')?>" alt>
			<i class="fa fa-plus" aria-hidden="true"></i>
		</a>
	</div>
	
	<div class="mobile_footer div_width_20par text_cut_or_dot mobile_footer_css_ok_right text-center">
		<a href="<?= base_url('home/my_notification')?>">
			<i class="fa fa-bell main_icon1" aria-hidden="true"></i>
			<div style="font-size: 11px;" class="mobile_off">Notifications <span class="notificationdiv"></span></div>
			<div style="font-size: 11px;" class="mobile_show">Notifications <span class="notificationdiv"></span></div>
		</a>
	</div>
	
	<div class="mobile_footer div_width_20par text_cut_or_dot mobile_footer_css_ok text-center"
	style="margin-right: -15px;">
		<a href="<?= base_url();?>/home">
			<i class="fa fa-refresh" aria-hidden="true"></i>
			<div style="font-size: 11px;">Reload</div>
		</a>
	</div>
</div>

<div class="website_box_part small_noti_box" style="display:none">
	<i class="fa fa-times" aria-hidden="true" onclick="clear_small_noti()" style="display: inline;font-size: 20px;position: absolute;right: 2px;top:0px;"></i>
	<div class="small_noti_box_data"></div>
</div>
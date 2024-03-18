<style>
.menubtn1{
	display: inline !important;
}
.menubtn2{
	display: none !important;
}
.headertitle
{
	margin-top: -5px;
	display: inline !important;
}
</style>
<?php
$ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
$isMob = is_numeric(strpos($ua, "mobile"));

$default_img = base_url()."/uploads/default_img.jpg";
$error_img ="onerror=this.src=".base_url()."/uploads/default_img.jpg";

?>
<script src="<?= base_url(); ?>assets/js/jssor.slider-28.0.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
window.jssor_1_slider_init = function() {

	var jssor_1_options = {
		$AutoPlay: 1,
		$SlideWidth: 700,
		$ArrowNavigatorOptions: {
		$Class: $JssorArrowNavigator$
		},
		$BulletNavigatorOptions: {
		$Class: $JssorBulletNavigator$
		}
	};

	var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

	/*#region responsive code begin*/

	var MAX_WIDTH = screen.width;

	function ScaleSlider() {
		var containerElement = jssor_1_slider.$Elmt.parentNode;
		var containerWidth = containerElement.clientWidth;

		if (containerWidth) {

			var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

			jssor_1_slider.$ScaleWidth(expectedWidth);
		}
		else {
			window.setTimeout(ScaleSlider, 30);
		}
	}

	ScaleSlider();

	$Jssor$.$AddEvent(window, "load", ScaleSlider);
	$Jssor$.$AddEvent(window, "resize", ScaleSlider);
	$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
	/*#endregion responsive code end*/
};

window.jssor_2_slider_init = function() {

	var jssor_2_options = {
		$AutoPlay: 1,
		$SlideWidth: 700,
		$ArrowNavigatorOptions: {
		$Class: $JssorArrowNavigator$
		},
		$BulletNavigatorOptions: {
		$Class: $JssorBulletNavigator$
		}
	};

	var jssor_2_slider = new $JssorSlider$("jssor_2", jssor_2_options);

	/*#region responsive code begin*/

	var MAX_WIDTH = screen.width;

	function ScaleSlider2() {
		var containerElement = jssor_2_slider.$Elmt.parentNode;
		var containerWidth = containerElement.clientWidth;

		if (containerWidth) {

			var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

			jssor_2_slider.$ScaleWidth(expectedWidth);
		}
		else {
			window.setTimeout(ScaleSlider2, 30);
		}
	}

	ScaleSlider2();

	$Jssor$.$AddEvent(window, "load", ScaleSlider2);
	$Jssor$.$AddEvent(window, "resize", ScaleSlider2);
	$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider2);
	/*#endregion responsive code end*/
};
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<div class="container-fluid maincontainercss">
	<div class="row home_page_slider1_data"></div>
	<div class="row home_page_divisioncategory1_data"></div>
	<div class="row home_page_menu_data"></div>
	<div class="row home_page_invoice_notification_data"></div>
	<div class="row home_page_all_data"></div>
	<div class="row">
		<div class="col-sm-12 text-center">
			<div class="myloading">
				<img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px">
				<br>
				Loading....
			</div>
			<br>
			<div class="load_more btn btn-success" onclick="load_more()">Load More</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>/assets/website/wow_css_js/wow.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/home_page11.js"></script>
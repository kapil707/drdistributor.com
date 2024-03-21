<link rel="stylesheet" href="<?= base_url(); ?>assets/website/easyzoom/easyzoom.css" />
<script src="<?= base_url(); ?>assets/website/easyzoom/easyzoom.js"></script>


<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
	<a class="example-image-link" data-standard="">
		<img src="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708859763collagen_coffe-Photoroom_(1).jpg" width="100%" style="float: right;margin-top:10px;" class="medicine_details_image modal_item_image_change" alt="zoom" loading="eager" onerror="setDefaultImage(this);">
	</a>
</div>

<script>
$(document).ready(function() {
	var $easyzoom = $('.easyzoom').easyZoom();
});
</script>



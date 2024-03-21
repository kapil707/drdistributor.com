
<link rel="stylesheet" href="<?= base_url(); ?>assets/website/easyzoom/easyzoom.css" />



<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails" style="width:300px;height:300px;">
    <a href="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708859763collagen_coffe-Photoroom_(1).jpg" class="myacss">
        <img src="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708859763collagen_coffe-Photoroom_(1).jpg" alt="" class="myimgcss" style="width:300px;height:300px;" />
    </a>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="<?= base_url(); ?>assets/website/easyzoom/easyzoom.js"></script>
<script>
var $easyzoom = $('.easyzoom').easyZoom();

$(document).ready(function() {
    setTimeout(function() {

		// Update the image element with the loaded image URL
		$('.myimgcss').attr('src', 'https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708856059Cosmofix-R-Glow-Serum.png').attr('data-zoom-src', 'https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708856059Cosmofix-R-Glow-Serum.png');

		// Initialize EasyZoom on the updated image element
		$('.easyzoom').easyZoom();
    }, 5000); // 2000 milliseconds = 2 seconds
});
</script>


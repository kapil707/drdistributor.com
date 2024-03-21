<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/easyzoom/dist/easyzoom.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easyzoom/dist/easyzoom.css" />




<div class="thumbnails">
    <img src="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708856059Cosmofix-R-Glow-Serum.png" data-full-image="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708856059Cosmofix-R-Glow-Serum.png" class="thumbnail" />
    <img src="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708860474corium_body-Photoroom_(1).jpg" data-full-image="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708860474corium_body-Photoroom_(1).jpg" class="thumbnail" />
    <!-- Add more thumbnails as needed -->
</div>

<div class="zoom-container">
    <img src="" alt="" class="zoom-image" />
</div>


<!-- <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
    <a href="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708856059Cosmofix-R-Glow-Serum.png">
        <img src="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708856059Cosmofix-R-Glow-Serum.png" alt="" width="640" height="360" />
    </a>
</div>

<ul class="thumbnails">
    <li>
        <a href="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708860474corium_body-Photoroom_(1).jpg" data-standard="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708860474corium_body-Photoroom_(1).jpg">
            <img src="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708860474corium_body-Photoroom_(1).jpg" alt="" />
        </a>
    </li>
    <li>
        <a href="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708859521marine-Photoroom_(1).jpg" data-standard="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708859521marine-Photoroom_(1).jpg">
            <img src="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708859521marine-Photoroom_(1).jpg" alt="" />
        </a>
    </li>
    <li>
        <a href="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708861436silky_af-Photoroom_(2).jpg" data-standard="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708861436silky_af-Photoroom_(2).jpg">
            <img src="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708861436silky_af-Photoroom_(2).jpg" alt="" />
        </a>
    </li>
    <li>
        <a href="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708860695photocil-Photoroom_(1).jpg" data-standard="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708860695photocil-Photoroom_(1).jpg">
            <img src="https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708860695photocil-Photoroom_(1).jpg" alt="" />
        </a>
    </li>
</ul> -->

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="<?= base_url(); ?>assets/website/easyzoom/easyzoom.js"></script>
<script>

$(document).ready(function() {
    $('.thumbnail').on('click', function() {
        var fullImage = $(this).data('full-image');
        $('.zoom-image').attr('src', fullImage);
        $('.zoom-image').easyZoom();
    });
});
// var $easyzoom = $('.easyzoom').easyZoom();

// $(document).ready(function() {
//     setTimeout(function() {

// 		// Update the image element with the loaded image URL
// 		$('.easyzoom').attr('src', 'https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708856059Cosmofix-R-Glow-Serum.png').attr('data-zoom-src', 'https://www.drdweb.co.in/uploads/manage_medicine_image/photo/resize/1708856059Cosmofix-R-Glow-Serum.png');

// 		// Initialize EasyZoom on the updated image element
// 		$('.easyzoom').easyZoom();
//     }, 5000); // 2000 milliseconds = 2 seconds
// });
</script>


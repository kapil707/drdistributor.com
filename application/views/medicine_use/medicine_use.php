<style>
.menubtn1,.search_medicine_main
{
	display:none;
}
@media screen and (max-width: 767px) {
	.homebtn_div
	{
		display:none;
	}
}
.medicine_use_div{
	border-radius: 10px;
    padding: 5px;
    margin: 5px;
    background-color: var(--main_theme_li2_bg_color);
    border: 1px solid var(--main_theme_border_color);
    box-shadow: 0px 0px 5px 0px var(--main_theme_box_shadow);
	height:210px;
}
.medicine_use_div img{
	object-fit: contain;
	height:200px;
}
.medicine_use_div1{
	border-radius: 10px;
    padding: 5px;
    margin: 5px;
    box-shadow: 0px 0px 5px 0px var(--main_theme_box_shadow);
	height:265px;
}
.medicine_use_div1 video{
	width:100%;
	height:250px;
	border-radius:10px;
}
</style>
<script>
$(".top_bar_title").html("Loading....");
function goBack() {
	window.location.href = "<?= base_url();?>";
}
</script>
<div class="container main_container">
<div class="row">
		<div class="col-sm-12 col-12">
			<div class="row">
				<div class="col-sm-12 col-12">	
					<div class="main_box_div p-2">
						<div class="row">
							<?php include __DIR__ . '/../medicine_details/medicine_details.php'; ?>
						</div>
						<b>Images</b>
						<div class="row load_page_images"></div>
						<div class="col-sm-12 col-12 medicine_details_hr">
						</div>
						<b>Videos</b>
						<div class="row load_page_videos"></div>
					</div>
				</div>     
			</div>
		</div> 
	</div>
</div>
<script>
item_code = '<?= $item_code; ?>';
</script>
<script src="<?= base_url(); ?>assets/js/medicine_use12.js"></script>

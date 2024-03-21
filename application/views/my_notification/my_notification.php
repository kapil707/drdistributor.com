<style>
.main_container{
	margin-bottom:100px;
}
</style>
<script>
$(".top_bar_title").html("<?= $main_page_title ?>");
function goBack() {
	window.location.href = "<?= base_url();?>";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-12 col-12">
			<div class="row">
				<div class="col-sm-12 col-12">
					<div class="main_box_div main_page_data p-2" style="display:none">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
					<span class="main_page_loading" style="position: fixed;top: 300px;z-index: 100;margin-left:-90px">
						<h2><center><img src="'+get_base_url()+'/img_v51/loading.gif" width="100px"></center></h2><h2><center>Loading....</center></h2>
					</span>
				</div>
			</div>
		</div>
	</div>     
</div>
<input type="hidden" class="get_record" value="0">
<script src="<?php echo base_url(); ?>/assets/js/my_notification12afdasf.js"></script>
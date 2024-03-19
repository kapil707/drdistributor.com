<style>
.main_container{
	margin-bottom:100px;
}
.top_bar_back_btn{
	display: none;
}
</style>
<script>
$(".top_bar_title").html("Search chemist");
function goBack() {
	window.location.href = "<?= base_url();?>home";
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
					<span class="main_page_loading" style="position: fixed;top: 300px;z-index: 100;margin-left:-90px"></span>
				</div>
			</div>
		</div>
	</div>     
</div>
<div class="background_blur" onclick="clear_search_icon()" style="display:none"></div>
<script src="<?= base_url(); ?>assets/js/chemist_search12.js"></script>
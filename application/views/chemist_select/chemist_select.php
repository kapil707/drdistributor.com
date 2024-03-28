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
				<div class="col-sm-12 col-12 d-none d-sm-block web-col-padding-5">
					<div class="main_page_data"></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-padding-5 mobile_show">
			<div class="search_result_div_mobile"></div>
			<div class="main_page_data_mobile"></div>
		</div>
	</div>     
</div>
<script src="<?= base_url(); ?>assets/js/chemist_search123.js"></script>
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
					<div class="website_box_part p-2">
						<?= $this->Scheme_Model->get_website_data("privacy_policy") ;?>
					</div>
				</div>
			</div>
		</div>
	</div>     
</div>
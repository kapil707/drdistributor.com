<style>
.main_container{
	margin-bottom:100px;
}
</style>
<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
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
						<?= $this->Scheme_Model->get_website_data("terms_of_services") ;?>
					</div>
				</div>
			</div>
		</div>
	</div>     
</div>
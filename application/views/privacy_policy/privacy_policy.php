<script>
$(".headertitle").html("Privacy policy");
</script>
<div class="container maincontainercss">
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
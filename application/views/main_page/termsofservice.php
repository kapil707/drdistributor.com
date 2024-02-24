<style>
.menubtn1,.search_medicine_main
{
	display:none;
}
.headertitle
{
    margin-top: 5px !important;
}
@media screen and (max-width: 767px) {
	.homebtn_div
	{
		display:none;
	}
}
</style>
<script>
$(".headertitle").html("Terms of services");
</script>
<div class="container maincontainercss">
	<div class="row">
		<div class="col-sm-12 col-12">
			<div class="row">
				<div class="col-sm-12 col-12">	
					<div class="website_box_part">
						<?= $this->Scheme_Model->get_website_data("termsofservice") ;?>
					</div>
				</div>
			</div>
		</div>
	</div>     
</div>
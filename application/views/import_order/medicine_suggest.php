<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>io";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-12 col-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="page_table">
					<thead>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>     
</div>
<script>
$(document).ready(function(){
	MainPageFuncationCall();
});
</script>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<!-- jQuery and DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/js/import_order/medicine_suggest.js"></script>

<script src="https://cdn.datatables.net/scroller/2.2.0/js/dataTables.scroller.min.js"></script>
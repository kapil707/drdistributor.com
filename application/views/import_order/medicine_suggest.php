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
</head>
<script>
var table;
function MainPageFuncationCall() {
	table = $('#page_table').DataTable({
		ajax: {
			url: get_base_url() + "import_order_api/medicine_suggest_api",
			type: 'POST',
			dataSrc: 'items'
		},
		order: [[0, 'asc']],
		columns: [
			{ data: 'sr_no', title: 'Sr No.' },
			{ data: 'your_item_name', title: 'Item Name' },
			{ data: 'item_name', title: 'Suggest Item' },
			{
				data: null,
				title: 'Action',
				orderable: false,
				render: function (data, type, row) {
					return `<a href="javascript:void(0)" onclick="delete_suggest_by_id('${row.id}')" class="btn-white btn btn-xs">Delete</a>`;
				}
			}
		],
		pageLength: 25,
		responsive: true,
		dom: '<"html5buttons"B>lTfgitp',
		buttons: [
			{extend: 'copy'},
			{extend: 'csv'},
			{extend: 'excel', title: 'ExampleFile'},
			{extend: 'pdf', title: 'ExampleFile'},
			{extend: 'print',
				customize: function (win){
					$(win.document.body).addClass('white-bg');
					$(win.document.body).css('font-size', '10px');
					$(win.document.body).find('table')
							.addClass('compact')
							.css('font-size', 'inherit');
				}
			}
		]
	});
}
function delete_suggest_by_id(_id)
{
	if (confirm('Are you sure Delete Suggest?')) {
		$('.selected_suggest_'+_id).hide();
		$.ajax({
			url: "<?php echo base_url(); ?>import_order_api/delete_suggest_by_id_api",
			type:"POST",
			dataType: 'json',
			data: {id:_id},
			success: function(data){
				table.ajax.reload();
			}
		});
	}
}
</script>
<script src="https://cdn.datatables.net/scroller/2.2.0/js/dataTables.scroller.min.js"></script>
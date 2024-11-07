<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>io";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-12 col-12">
			<table class="table table-striped table-bordered" aria-describedby id="page_table">
				<thead>
					<tr>
						<th style="width:50px;" scope>
							S.No.
						</th>
						<th scope>
							Item Name
						</th>
						<th scope>
							Suggest Item
						</th>
						<th scope>
							Action
						</th>
					</tr>
				</thead>
				<tbody>
				<?php
				/*$lastcount=1;
				foreach($result as $row)
				{
					?>
					<tr class="selected_suggest_<?= $row->id ?>">
						<td><?= $lastcount++?></td>
						<td class="all_item_name"><?= ucwords(strtolower($row->your_item_name))?></td>
						<td class="all_item_name"><?= ucwords(strtolower($row->item_name))?></td>
						<td class="">
							<a href="javascript:delete_suggest_by_id('<?= $row->id ?>')" title="Delete Suggest Medicine" class="all_item_delete_btn"><i class="fa fa-trash" aria-hidden="true" style="margin-left:10px; font-size:20px"></i> Delete suggest medicine</a>
						</td>
					</tr>
					<?php
				}*/
				?>
				</tbody>
			</table>
		</div>	
	</div>     
</div>
<script>
$(document).ready(function(){
	MainPageFuncationCall();
});
</script>
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
			{ data: 'sr_no', title: 'Id' },
			/*{
				data: null,
				title: 'Action',
				orderable: false,
				render: function (data, type, row) {
					return `<a href="javascript:void(0)" onclick="delete_rec('${row.id}')" class="btn-white btn btn-xs">Delete</a>`;
				}
			}*/
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
			url: "<?php echo base_url(); ?>import_order_api/delete_suggest_by_id",
			type:"POST",
			dataType: 'json',
			data: {id:_id},
			success: function(data){
				
			}
		});
	}
}
</script>
<script src="https://cdn.datatables.net/scroller/2.2.0/js/dataTables.scroller.min.js"></script>
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
function delete_suggest_by_id(id)
{
	if (confirm('Are you sure Delete Suggest?')) {
		$.ajax({
			url: "<?php echo base_url(); ?>import_order_api/delete_suggest_by_id_api",
			type:"POST",
			dataType: 'json',
			data: {id:id},
			success: function(data){
				table.ajax.reload();
				swal("Medicine deleted successfully", {
					icon: "success"
				});
			}
		});
	}
}
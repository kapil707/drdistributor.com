function select_import_order_file(){
	import_order_file = $("#import_order_file").val();	
	if(import_order_file=="")
	{
		$("#clear_import_order_file").hide();
	}
	else
	{
		$("#clear_import_order_file").show();
	}
}
function clear_import_order_file(){
	$("#import_order_file").val('');
	$("#clear_import_order_file").hide();
}
function btn_upload_import_file(){
	headername 	= $(".headername").val();
	itemname 	= $(".itemname").val();
	itemqty 	= $(".itemqty").val();
	itemmrp 	= $(".itemmrp").val();
	import_order_file = $("#import_order_file").val();	
	if(import_order_file=="")
	{
		$("#import_order_file").focus();
		swal("Select File")
		return;
	}
	if(headername=="")
	{
		$(".headername").focus();
		swal("Enter Header Row Number")
		return;
	}
	if(itemname=="")
	{
		$(".itemname").focus();
		swal("Enter Item Row Name")
		return;
	}
	if(itemqty=="")
	{
		$(".itemqty").focus();
		swal("Enter Item Row Quantity")
		return;
	}
	if(itemmrp=="")
	{
		$(".itemmrp").focus();
		swal("Enter Item Row Mrp")
		return;
	}	
	$(".main_page_loading").show();
	$("#btn_upload_import_file").hide();
	var file_data = $('#import_order_file').prop('files')[0];
	var form_data = new FormData();                  
    form_data.append('file',file_data);
	form_data.append('headername',headername);
	form_data.append('itemname',itemname);
	form_data.append('itemqty',itemqty);
	form_data.append('itemmrp',itemmrp);           
    $.ajax({
		url: get_base_url() + "import_order_api/upload_import_file_api",
		cache : true,
		contentType: false,
		processData: false,
		data: form_data,
		timeout: 30000,
		type: 'post',
		error: function(){
		   	swal("Please compare the columns in the Excel file with those you have entered in the website.");
		   	$(".main_page_loading").hide();
			$("#btn_upload_import_file").show();
		},
		success: function(data){
			$.each(data.items, function(i,item){	
				if (item) {
					window.location.href = item.url;
				} 
			});
		}
	});
}
function sortpicture_change(){
	sortpicture1 = $("#sortpicture").val();	
	if(sortpicture1=="")
	{
		$(".clearfile").hide();
	}
	else
	{
		$(".clearfile").show();
	}
}
function clearfile(){
	$("#sortpicture").val('');
	$(".clearfile").hide();
}
function upload_import_file(){
	headername 	= $(".headername").val();
	itemname 	= $(".itemname").val();
	itemqty 	= $(".itemqty").val();
	itemmrp 	= $(".itemmrp").val();
	chemist_id	= $(".chemist_id").val();
	sortpicture1 = $("#sortpicture").val();	
	if(sortpicture1=="")
	{
		alert("Select File")
		$("#sortpicture").focus();
		return;
	}
	if(headername=="")
	{
		$(".headername").focus();
		alert("Enter Header Row Number")
		return;
	}
	if(itemname=="")
	{
		$(".itemname").focus();
		alert("Enter Item Row Name")
		return;
	}
	if(itemqty=="")
	{
		$(".itemqty").focus();
		alert("Enter Item Row Quantity")
		return;
	}
	if(itemmrp=="")
	{
		$(".itemmrp").focus();
		alert("Enter Item Row Mrp")
		return;
	}	
	$(".main_page_loading").show();
	$("#upload_import_file").hide();
	var file_data = $('#sortpicture').prop('files')[0];
	var form_data = new FormData();                  
    form_data.append('file',file_data);
	form_data.append('headername',headername);
	form_data.append('itemname',itemname);
	form_data.append('itemqty',itemqty);
	form_data.append('itemmrp',itemmrp);
    //alert(form_data);                             
    $.ajax({
		url: get_base_url() + "import_order/upload_import_file/",
		/*dataType: 'text',*/
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,                         
		type: 'post',
		error: function(){
		   	swal("Please compare the columns in the Excel file with those you have entered in the website.");
		   	$(".main_page_loading").hide();
			$("#upload_import_file").show();
		},
		success: function(data){
			$.each(data.items, function(i,item){	
				if (item) {
					window.location.href = item.url;
				} 
			});
		},
		timeout: 40000
	});
}
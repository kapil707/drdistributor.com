<?php if(!empty($chemist_id)){ ?>
<style>
.top_bar_title{
	margin-top: -5px;
}
</style>
<script>
$(".top_bar_title1").show();
</script>
<?php } ?>
<script>
$(".top_bar_title").html("<?= $main_page_title ?>");
function goBack() {
	window.location.href = "<?= base_url();?>";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-12 col-12 main_box_div">
			<div class="form-group mt-2">
				<label for="file">Upload excel file</label>
				<div class="row">
					<div class="col-sm-8 col-11">
						<input id="sortpicture" type="file" name="sortpic" class="input_type_text login_textbox" onchange="sortpicture_change()" />
						<input type="hidden" name="chemist_id" id="chemist_id" class="chemist_id" value="<?= $chemist_id ?>" style="padding-bottom: 36px;" />
					</div>
					<div class="col-sm-1 col-1">
						<input id="clearfile" type="submit" name="clearfile" class="btn btn-w-m btn-danger clearfile site_round_btn31" onclick="clearfile()" style="display:none" value="Clear" style="width:20%" />
					</div>
					
					<div class="col-sm-3 col-12 text-right">
						<a href="<?= base_url() ?>import_order/medicine_suggest" title="Update suggest medicine" style="font-size: 15px; color:gray">
							<i class="fa fa-thumbs-o-up fa-2x" aria-hidden="true"></i>
							Update suggest medicine
						</a>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label for="file">Header column number</label>
				<input type="text" name="headername"  class="input_type_text2 login_textbox headername" placeholder="Header column number" value="<?= $headername ?>" />
			</div>	
			<div class="form-group">
				<label for="file">Item column name</label>
				<input type="text" name="itemname" class="input_type_text2 login_textbox itemname" placeholder="Item column name" value="<?= $itemname ?>" />
			</div>	
			<div class="form-group">
				<label for="file">Item column mrp</label>
				<input type="text" name="itemmrp" class="input_type_text2 login_textbox itemmrp" placeholder="Item column mrp" value="<?= $itemmrp ?>" />
			</div>
			<div class="form-group">
				<label for="file">Item column quantity</label>
				<input type="text" name="itemqty" class="input_type_text2 login_textbox itemqty" placeholder="Item column quantity" value="<?= $itemqty ?>" />
			</div>
			<div class="form-group text-center">
				<span id="upload_import_file_loading" style="display:none">Uploading....</span>
				<button id="upload_import_file" onclick="upload_import_file()" class="btn btn-primary main_theme_button" style="width:20%">Upload</button>
			</div>					
		</div>
	</div>  
</div>
<script type="text/javascript">
function sortpicture_change()
{
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
function clearfile()
{
	$("#sortpicture").val('');
	$(".clearfile").hide();
}
function upload_import_file()
{
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
	$("#upload_import_file_loading").show();
	$("#upload_import_file").hide();
	var file_data = $('#sortpicture').prop('files')[0];
	var form_data = new FormData();                  
    form_data.append('file',file_data);
    //alert(form_data);                             
    $.ajax({
		url: "<?= base_url()?>import_order/upload_import_file/?headername="+headername+"&itemname="+itemname+"&itemqty="+itemqty+"&itemmrp="+itemmrp,
		/*dataType: 'text',*/
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,                         
		type: 'post',
		error: function(){
		   	swal("Please compare the columns in the Excel file with those you have entered in the website.");
		   	$("#upload_import_file_loading").hide();
			$("#upload_import_file").show();
		},
		success: function(data){
			$.each(data.items, function(i,item){	
				if (item)
				{
					window.location.href = item.url;
				} 
			});
		},
		timeout: 40000
	});
}
</script>
$(document).ready(function(){
	call_page("kapil");
});
function call_page_by_last_id()
{
	lastid1=$(".lastid1").val();
	call_page(lastid1)
}
function call_page(lastid1)
{
	new_i = 0;
	id = "";
	$(".load_more").hide();
	$(".load_page").html(loading_img_function());
	$.ajax({
		type       : "POST",
		data       : {id:id} ,
		url        : get_base_url()+"User/get_user_account_api",
		cache : true,
		error: function(){
			$(".load_page").html(something_went_wrong_function());
		},
		success    : function(data){
			if(data.items=="")
			{
				$(".load_page").html(no_record_found_function());
			}
			else
			{
				$(".load_page").html("");
			}
			$.each(data.items, function(i,item){	
				if (item){		
					user_id 		= item.user_id;
					user_name 		= item.user_name;
					user_altercode 	= item.user_altercode;
					user_mobile 	= item.user_mobile;
					user_email 		= item.user_email;
					user_address 	= item.user_address;
					user_gstno 		= item.user_gstno;
					user_status 	= item.user_status;
					user_image 		= item.user_image;

					if(user_image!="")
					{
						$("#user_profile").attr("src",user_image);
					}
				}
			});
		},
		timeout: 10000
	});
}
function getfile_fun()
{
	document.getElementById('getfile').click();
}
function update_user_upload_image_api()
{
	var file_data = $('#getfile').prop('files')[0];
	var form_data = new FormData();                  
    form_data.append('upload_image',file_data);
    //alert(form_data);                             
    $.ajax({
		url: get_base_url()+"User/update_user_upload_image_api",
		dataType: 'json',
		cache : true,
		contentType: false,
		processData: false,
		data: form_data,                         
		type: 'post',
		error: function(){
		   	swal("Error Upload Image");
		},
		success: function(data){
			$.each(data.items, function(i,item){	
				if (item)
				{
					swal(item.status_message)
					if(item.status=="1")
					{
						call_page("kapil");
					}
				} 
			});
		},
		timeout: 10000
	});
}
<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>account";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 col-12">
			<div class="row main_box_div p-2">
				<div class="col-sm-12">
					<div class="main_box_div_data">
						<div class="all_page_box_left_div">
							<img src="<?= $_COOKIE['user_image'] ?>" class="all_item_image" onerror="setDefaultImage(this);">
						</div>
						<div class="all_page_box_right_div text-left">
							<span class="all_item_name"><?= $_COOKIE['user_fname'] ?></span><br>
							<span class="all_item_packing">Code :
							<?php echo $_COOKIE['user_altercode'] ?></span>
						</div>
					</div>
				</div>
				<div class="col-sm-12 mt-2">
					<img class="img-circle" src="<?= base_url() ?>/img_v51/logo.png" width="40%" alt="Change Image" title="Update Image" style="margin-left:30%" id="user_profile">
				</div>
				<div class="col-sm-12 mt-2 mb-2">
					<div class="main_box_div_data p-4">
						<a href="javascript:getfile_fun()" title="Select image from gallery" class="main_theme_a">
							<img class="img-circle" src="<?= base_url() ?>/img_v51/photo1.png" width="30" alt="Select image from gallery" title="Select image from gallery">
							<span style="margin-left:20px;">Select image from gallery</span>
						</a>
					</div>
					<input type="file" id="getfile" onchange="update_user_upload_image_api()" style="display:none" accept=", image/gif,image/jpg,image/png,image/jpeg" />
				</div>
			</div> 
		</div>
	</div>
</div>
  
<script>
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
	$(".load_page").html('<h2><center><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px"></center></h2><h2><center>Loading....</center></h2>');
	$.ajax({
		type       : "POST",
		data       :  {id:id} ,
		url        : "<?php echo base_url(); ?>User/get_user_account_api",
		cache	   : false,
		error: function(){
			$(".load_page").html('<h2><center><img src="<?= base_url(); ?>/img_v51/no_record_found.png" width="100%"></center></h2>');
		},
		success    : function(data){
			if(data.items=="")
			{
				$(".load_page").html('<h2><center><img src="<?= base_url(); ?>/img_v51/no_record_found.png" width="100%"></center></h2>');
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
		url: "<?= base_url()?>User/update_user_upload_image_api",
		dataType: 'json',
		cache: false,
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
</script>
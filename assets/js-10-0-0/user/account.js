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
	$(".load_page").html('<h2><center><img src="'+get_base_url()+'img_v51/loading.gif" width="100px"></center></h2><h2><center>Loading....</center></h2>');
	$.ajax({
		type       : "POST",
		data       : {id:id} ,
		url        : get_base_url()+"User/get_user_account_api",
		cache	   : false,
		error: function(){
			$(".load_page").html('<h2><center><img src="'+get_base_url()+'img_v51/no_record_found.png" width="100%"></center></h2>');
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
					
					$(".load_page").append('<div class="row"><div class="col-sm-10 col-10"><img class="img-circle" src="'+get_base_url()+'img_v51/phone1.png" width="25" alt="Mobile" title="Mobile"><span style="margin-left:20px;">'+user_mobile+'</span></div><div class="col-sm-2 col-2"><span class="text-right"><a href="'+get_base_url()+'home/change_account" title="Update account"> <img class="img-circle" src="'+get_base_url()+'img_v51/edit_icon.png" width="20" alt="Update account" title="Update account"></a></span></div></div>');
					$(".load_page").append('<div class="row"><div class="col-sm-12"><img class="img-circle" src="'+get_base_url()+'img_v51/email1.png" width="25" alt="Email" title="Email"><span style="margin-left:20px;">'+user_email+'</span></div></div>');
					$(".load_page").append('<div class="row"><div class="col-sm-12"><img class="img-circle" src="'+get_base_url()+'img_v51/map1.png" width="25" alt="Address" title="Address"><span style="margin-left:20px;">'+user_address+'</span></div></div>');
				}
			});
		},
		timeout: 10000
	});
}
<style>
.menubtn1
{
	display:none;
}
@media screen and (max-width: 767px) {
	.website_menu,.current_order_search_page1,.select_chemist,.homebtn_div
	{
		display: none ;
	}
}
</style>
<script>
$(".headertitle").html("Account");
function goBack() {
	window.location.href = "<?= base_url();?>home";
}
</script>
<div class="container maincontainercss">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 col-12">
			<div class="row website_box_part">
				<div class="col-sm-12 mt-2">
					<div class="main_theme_li_bg p-2">
						<div class="row">
							<div class="col-sm-2 col-2">
								<img src="<?= $_COOKIE['user_image'] ?>" class="medicine_cart_item_image" onerror=this.src="<?= base_url(); ?>img_v51/logo.png">
							</div>
							<div class="col-sm-10 col-10 text-left">
								<span class="chemist_user_name"><?= $_COOKIE['user_fname'] ?></span><br>
								<span class="chemist_altercode">Code :
								<?php echo $_COOKIE['user_altercode'] ?></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12 mt-2">
					<div class="main_theme_li_bg p-4 load_page">
						
					</div>
				</div>
				<div class="col-sm-12 mt-2">
					<div class="main_theme_li_bg p-4">
						<a href="<?= base_url(); ?>update_account" title="Update account" class="main_theme_a">
							<img class="img-circle" src="<?= base_url() ?>/img_v51/photo1.png" width="30" alt="Update Image" title="Update account">
							<span style="margin-left:20px;">Update account</span>
						</a>
					</div>
				</div>
				<div class="col-sm-12 mt-2">
					<div class="main_theme_li_bg p-4">
						<a href="<?= base_url(); ?>update_image" title="Update image" class="main_theme_a">
							<img class="img-circle" src="<?= base_url() ?>/img_v51/photo1.png" width="30" alt="Update Image" title="Update Image">
							<span style="margin-left:20px;">Update image</span>
						</a>
					</div>
				</div>
				<div class="col-sm-12 mt-2 mb-2">
					<div class="main_theme_li_bg p-4">
						<a href="<?= base_url();?>update_password" title="Update password" class="main_theme_a">
							<img class="img-circle" src="<?= base_url() ?>/img_v51/b_lock.png" width="30" alt="Update Password" title="Update Password">
							<span style="margin-left:20px;">Update password</span>
						</a>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-12">
					<div class="text-center" style="margin-top:20px;">
						<img src="<?= base_url() ?>/img_v51/logo.png" class="img-fluid" style="margin-top: 5px;" alt width="100px;">
					</div>
					<div class="text-center website_name_css" style="margin-top:15px;">
						<?= $this->Scheme_Model->get_website_data("title2") ;?>
					</div>
					<div class="text-center website_version_css" style="margin-top:5px;">
						Website version <?= $this->Scheme_Model->get_website_data("android_versioncode") ;?>
					</div>
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
	$(".load_page").html('<h1><center><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px"></center></h1><h1><center>Loading....</center></h1>');
	$.ajax({
		type       : "POST",
		data       :  {id:id} ,
		url        : "<?php echo base_url(); ?>User/user_account_api",
		cache	   : false,
		error: function(){
			$(".load_page").html('<h1><center><img src="<?= base_url(); ?>/img_v51/no_record_found.png" width="100%"></center></h1>');
		},
		success    : function(data){
			if(data.items=="")
			{
				$(".load_page").html('<h1><center><img src="<?= base_url(); ?>/img_v51/no_record_found.png" width="100%"></center></h1>');
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
					
					$(".load_page").append('<div class="row"><div class="col-sm-10 col-10"><img class="img-circle" src="<?= base_url() ?>/img_v51/phone1.png" width="25" alt="Mobile" title="Mobile"><span style="margin-left:20px;">'+user_mobile+'</span></div><div class="col-sm-2 col-2"><span class="text-right"><a href="<?= base_url(); ?>home/change_account" title="Update account"> <img class="img-circle" src="<?= base_url() ?>/img_v51/edit_icon.png" width="20" alt="Update account" title="Update account"></a></span></div></div>');
					$(".load_page").append('<div class="row"><div class="col-sm-12"><img class="img-circle" src="<?= base_url() ?>/img_v51/email1.png" width="25" alt="Email" title="Email"><span style="margin-left:20px;">'+user_email+'</span></div></div>');
					$(".load_page").append('<div class="row"><div class="col-sm-12"><img class="img-circle" src="<?= base_url() ?>/img_v51/map1.png" width="25" alt="Address" title="Address"><span style="margin-left:20px;">'+user_address+'</span></div></div>');
				}
			});
		},
		timeout: 10000
	});
}
</script>
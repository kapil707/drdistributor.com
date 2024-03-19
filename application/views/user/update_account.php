<style>
.main_container{
	margin-bottom:100px;
}
</style>
<script>
$(".top_bar_title").html("<?= $main_page_title ?>");
function goBack() {
	window.location.href = "<?= base_url();?>my_invoice";
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
					<label>Enter mobile</label>
				</div>
				<div class="col-sm-12">
					<img src="<?= base_url() ?>/img_v51/phone1.png" width="25px" style="float: left; margin-top: 7px;position: absolute;margin-left: 10px;" alt>
					<input type="text" value="" class="input_type_text login_textbox" placeholder="Enter mobile" required="" name="mobile1" id="mobile1" title="Enter mobile" style="padding-left:40px;float: left;">
				</div>
				<div class="col-sm-12 mt-2">
					<label>Enter email</label>
				</div>
				<div class="col-sm-12">
					<img src="<?= base_url() ?>/img_v51/email1.png" width="25px" style="float: left; margin-top: 7px;position: absolute;margin-left: 10px;" alt>
					<input type="text" value="" class="input_type_text login_textbox" placeholder="Enter email" required="" name="email1" id="email1" title="Enter email" style="padding-left:40px;float: left;">
				</div>
				<div class="col-sm-12 mt-2">
					<label>Enter address</label>
				</div>
				<div class="col-sm-12">
					<img src="<?= base_url() ?>/img_v51/map1.png" width="25px" style="float: left; margin-top: 7px;position: absolute;margin-left: 10px;" alt>
					<input type="text" value="" class="input_type_text login_textbox" placeholder="Enter address" required="" name="address1" id="address1" title="Enter address" style="padding-left:40px;float: left;">
				</div>
				<div class="col-sm-12 mt-2 text-center">
					<span class="main_theme_gray_text submit_div" style="margin-top:10px;">&nbsp;</span>
				</div>
				<div class="col-sm-12 mb-2">
					<input type="submit" value="Update account" class="main_theme_button" name="Submit" onclick="submitbtn()" id="submitbtn">
					<input type="submit" value="Update account" class="main_theme_button_disable" id="submitbtn_disable" style="display:none">
				</div>
			</div>
			<div class="main_box_div_data load_page mt-2 p-2 mb-2" style="display:none;">
				
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
	$(".load_page").hide();
	new_i = 0;
	id = "";
	$(".load_more").hide();
	$(".load_page").html('<h2><center><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px"></center></h2><h2><center>Loading....</center></h2>');
	$.ajax({
		type       : "POST",
		data       :  {id:id} ,
		url        : "<?php echo base_url(); ?>User/get_new_user_account_api",
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
				$(".load_page").show();
			}
			$.each(data.items, function(i,item){	
				if (item){
					$(".load_page").append('<div class="row"><div class="col-sm-12 col-12"><h5>Last update request</h5></div></div>');
					
					$(".load_page").append('<div class="row"><div class="col-sm-12"><img class="img-circle" src="<?= base_url() ?>/img_v51/phone1.png" width="25" alt="Mobile" title="Mobile"><span style="margin-left:20px;">'+item.user_phone+'</span></div></div>');
					$(".load_page").append('<div class="row"><div class="col-sm-12"><img class="img-circle" src="<?= base_url() ?>/img_v51/email1.png" width="25" alt="Email" title="Email"><span style="margin-left:20px;">'+item.user_email+'</span></div></div>');
					$(".load_page").append('<div class="row"><div class="col-sm-12"><img class="img-circle" src="<?= base_url() ?>/img_v51/map1.png" width="25" alt="Address" title="Address"><span style="margin-left:20px;">'+item.user_address+'</span></div></div>');
				}
			});
		},
		timeout: 10000
	});
}
function submitbtn()
{
	mobile1 	= $('#mobile1').val();
	email1	    = $('#email1').val();
	address1	= $('#address1').val();
	submit = "98c08565401579448aad7c64033dcb4081906dcb";
	if(mobile1=="")
	{
		swal("Enter mobile")
		$(".submit_div").html("<p class='text-danger'>Enter mobile</p>");
		$('#mobile1').focus();
		return false;
	}
	if(email1=="")
	{
		swal("Enter email")
		$(".submit_div").html("<p class='text-danger'>Enter email</p>");
		$('#email1').focus();
		return false;
	}
	if(address1=="")
	{
		swal("Enter address")
		$(".submit_div").html("<p class='text-danger'>Enter address</p>");
		$('#address1').focus();
		return false;
	}
	
	$("#submitbtn").hide();
	$("#submitbtn_disable").show();
	$(".submit_div").html("Loading....");
	
	$.ajax({
		type       : "POST",
		data       : {user_phone:mobile1,user_email:email1,user_address:address1},
		url        : "<?= base_url();?>User/update_user_account_api",
		cache	   : false,
		error: function(){
			swal("Error")
			$(".submit_div").html("<p class='text-danger'>Error</p>");
			$("#submitbtn").show();
			$("#submitbtn_disable").hide();
		},
		success    : function(data){
			if(data!="")
			{
				$(".submit_div").html("");
				$("#submitbtn").show();
				$("#submitbtn_disable").hide();
			}
			$.each(data.items, function(i,item){	
				if (item)
				{
					swal(item.status_message);
					if(item.status=="1")
					{
						$(".submit_div").html("<p class='text-success'>"+item.status_message+"</p>");
						call_page("kapil");
					}
					else{
						$(".submit_div").html("<p class='text-danger'>"+item.status_message+"</p>");
					}
				}
			});	
		},
		timeout: 10000
	});
}
</script>
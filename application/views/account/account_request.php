<?php
$theme_type = "lite";
if (isset($_COOKIE["theme_type"])) {
	$theme_type = $_COOKIE["theme_type"];
}?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      <?= $this->Scheme_Model->get_website_data("title") ;?> || <?= $main_page_title;?>
    </title>
    <!-- Stylesheets -->
	<meta name="theme-color" content="#27ae60">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link href="https://fonts.googleapis.com/css?family=Cabin:700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/website/css/font-awesome.min.css"> 
	<link href="<?= base_url(); ?>assets/website/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<script src="<?= base_url(); ?>assets/website/js/jquery-2.1.4.min.js"></script>
	<script src="<?= base_url(); ?>assets/website/js/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>assets/website/js/bigSlide.js"></script> 

	<?php if($theme_type=="lite") { ?>
		<link href="<?= base_url(); ?>assets/css/style-light11234567.css" rel="stylesheet" type="text/css"/>
	<?php } ?>

	<?php if($theme_type=="dark") { ?>
		<link href="<?= base_url(); ?>assets/css/style-dark11234567.css" rel="stylesheet" type="text/css"/>
	<?php } ?>

	<link href="<?= base_url(); ?>assets/css/style11234567.css" rel="stylesheet" type="text/css" />

	<link rel="icon" href="<?= base_url(); ?>img_v51/logo4.png" type="image/logo" sizes="16x16">
	
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>

  <body>
	<div class="top_bar" style="position: relative !important;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">						
					<div class="text-center">
						<img src="<?= base_url() ?>img_v51/logo4.png" width="60px" alt>
					</div>
					<h2 class="login_text_font text-center">
					<?= $this->Scheme_Model->get_website_data("title2") ;?></h2>
					<h5 class="text-right login_text_font">
						Request for login credentials
					</h5>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" style="margin-top:50px;">
		<div class="row" style="margin-top:30px;">
			<div class="col-md-3"> 
			</div>
			<div class="col-md-6 login_new_box">
				<label class="label_css">Enter chemist code</label>
				<div class="form-row">
					<div class="form-group col">
						<img src="<?= base_url() ?>img_v51/my_account1.png" width="25px" style="float: left; margin-top: 10px;position: absolute;margin-left: 10px;" alt>
						<input type="text" value="" class="input_type_text login_textbox" placeholder="Chemist code(e.g. A125)" required="" name="user_name1" id="user_name1" title="Chemist code(e.g. A125)">
					</div>
				</div>
				<label class="label_css">Enter mobile number</label>
				<div class="form-row">
					<div class="form-group col">
						<img src="<?= base_url() ?>img_v51/phone1.png" width="25px" style="float: left; margin-top: 10px;position: absolute;margin-left: 10px;" alt>
						<input type="text" value="" class="input_type_text login_textbox" placeholder="Mobile number(e.g. 95123XXXXX)" required="" name="phone_number1" id="phone_number1" style="float: left;" title="Mobile number(e.g. 95123XXXXX)" maxlength="10">
					</div>
				</div>
				<h5 class="text-center gray_text_31 submit_div mt-2">&nbsp;</h5>
				<div class="text-center" style="margin-top:10px;">
					<input type="submit" value="Submit" class="main_theme_button" name="Submit" onclick="submitbtn()"
					id="submitbtn">
					<input type="submit" value="Submit" class="main_theme_button_disable" id="submitbtn_disable" style="display:none">
				</div>
				<div class="text-center" style="margin-top:30px;">
					Already have an account? 
					<a href="<?= base_url() ?>login" class="main_theme_a">
					Login</a>
				</div>
				<div class="text-center" style="margin-top:15px;">
					<a href="<?= base_url() ;?>privacy_policy" title="Privacy policy" class="main_theme_a">
					Privacy policy</a>
				</div>
				<div class="text-center website_name_css" style="margin-top:15px;">
					<?= $this->Scheme_Model->get_website_data("title2") ;?>
				</div>
				<div class="text-center website_version_css" style="margin-top:5px;">
					Website version <?= $this->Scheme_Model->get_website_data("android_versioncode") ;?>
				</div>
			</div>
			<div class="col-md-3">
			</div>
		</div>
	</div>
</body>
</html>
<script>
$('#user_name1').on("keypress", function(e) {
	if (e.keyCode == 13) {
		submitbtn()
		return false; // prevent the button click from happening
	}
});
$('#phone_number1').on("keypress", function(e) {
	if (e.keyCode == 13) {
		submitbtn()
		return false; // prevent the button click from happening
	}
});
function submitbtn()
{
	user_name 		= $('#user_name1').val();
	phone_number	= $('#phone_number1').val();
	if(user_name=="")
	{
		swal("Enter Chemist code");
		$(".submit_div").html("<p class='text-danger'>Enter Chemist code</p>");
		$('#user_name1').focus();
		return false;
	}
	if(phone_number=="")
	{
		swal("Enter Mobile number");
		$(".submit_div").html("<p class='text-danger'>Enter Mobile number</p>");
		$('#phone_number1').focus();
		return false;
	}
	
	$("#submitbtn").hide();
	$("#submitbtn_disable").show();
	$(".submit_div").html("Loading....");
	
	$.ajax({
		type       : "POST",
		data       : {user_name:user_name,phone_number:phone_number},
		url        : "<?= base_url();?>Account/get_create_new_api",
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
						$('#user_name1').val('');
						$('#phone_number1').val('');
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
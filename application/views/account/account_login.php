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
						Login
					</h5>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" style="margin-top:50px;">
		<div class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-6 main_box_div">
				<label class="label_css">Enter username</label>
				<div class="form-row">
					<div class="form-group col">
						<i class="fa fa-user login_pg_icon" aria-hidden="true"></i>
						<input type="text" value="" class="input_type_text login_textbox" placeholder="Enter username" required="" name="user_name1" id="user_name1" title="Enter username">
					</div>
				</div>
				<label class="label_css">Enter password</label>
				<div class="form-row">			
					<div class="form-group col">
						<i class="fa fa-key login_pg_icon" aria-hidden="true"></i>
						<input type="password" value="" class="input_type_text login_textbox" placeholder="Enter password" required="" name="password1" id="password1" style="float: left;" title="Enter password">
						<div style="float: right; margin-top: 10px;margin-left: -50px; width:45px;">
							<i class="fa fa-eye login_pg_eye_icon" aria-hidden="true" onclick="showpassword()" id="eyes1"></i>

							<i class="fa fa-eye-slash login_pg_eye_icon" aria-hidden="true" onclick="hidepassword()" id="eyes" style="display:none"></i>
						</div>
					</div>
				</div>
				<h5 class="text-center main_theme_gray_text submit_div mt-2">&nbsp;</h5>
				<div class="form-row">
					<div class="form-group col text-center">
						<label class="main_theme_gray_text">
							<input type="checkbox" checked id="checkbox" style="width:auto;"> I agree to the
						</label>&nbsp;
						<a href="<?= base_url(); ?>terms_of_services" class="main_theme_a">
							<strong>terms of services</strong>
						</a>
					</div>
				</div>
				<div class="text-center mt-2">
					<input type="submit" value="Login" class="main_theme_button" name="Submit" onclick="submitbtn()" id="submitbtn">
					<input type="submit" value="Login" class="main_theme_button_disable" id="submitbtn_disable" style="display:none">
				</div>
				<div class="text-center mt-4">
					Don't have an account? 
					<a href="<?= base_url() ?>account_request" class="main_theme_a">
					Request for login credentials</a>
				</div>
				<div class="text-center" style="margin-top:15px;">
					<a href="<?= base_url() ;?>privacy_policy" title="Privacy policy" class="main_theme_a">
					Privacy policy</a>
				</div>
				<div class="text-center website_name_css" style="margin-top:15px;">
					<?= $this->Scheme_Model->get_website_data("title2") ;?>
				</div>
				<div class="text-center website_version_css" style="margin-top:5px;">
					Website version <?= $website_version;?>
				</div>
			</div>
			<div class="col-md-3">
			</div>
		</div>
	</div>
</body>
</html>
<script>
function showpassword()
{
	$("#eyes1").hide();
	$("#eyes").show();
	document.getElementById("password1").type = 'text';
}
function hidepassword()
{
	$("#eyes1").show();
	$("#eyes").hide();
	document.getElementById("password1").type = 'password';
}
$('#user_name1').on("keypress", function(e) {
	if (e.keyCode == 13) {
		submitbtn()
		return false; // prevent the button click from happening
	}
});
$('#password1').on("keypress", function(e) {
	if (e.keyCode == 13) {
		submitbtn()
		return false; // prevent the button click from happening
	}
});
function submitbtn()
{
	user_name 		= $('#user_name1').val();
	user_password	= $('#password1').val();
	checkbox		= $('#checkbox').val();
	submit = "98c08565401579448aad7c64033dcb4081906dcb";
	if(user_name=="")
	{
		swal("Enter username");
		$(".submit_div").html("<p class='text-danger'>Enter username</p>");
		$('#user_name1').focus();
		return false;
	}
	if(user_password=="")
	{
		swal("Enter password");
		$(".submit_div").html("<p class='text-danger'>Enter password</p>");
		$('#password1').focus();
		return false;
	}
	if($('#checkbox').is(':checked'))
	{
	}
	else
	{
		swal("Check terms of service");
		$(".submit_div").html("<p class='text-danger'>Check terms of service</p>");
		$('#checkbox').focus();
		return false;
	}
	
	$("#submitbtn").hide();
	$("#submitbtn_disable").show();
	$(".submit_div").html("Loading....");

	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       : {user_name:user_name,user_password:user_password},
		url        : "<?= base_url();?>Account/get_login_api",
		cache	   : false,
		error: function(){
			swal("Error")
			$(".submit_div").html("<p class='text-danger'>Error</p>");
			$("#submitbtn").show();
			$("#submitbtn_disable").hide();
		},
		success    : function(data){
			$.each(data.items, function(i,item){	
				if (item)
				{
					if(item.status=="1")
					{
						$(".submit_div").html("<p class='text-success'>"+item.status_message+"</p>");
						if(item.user_type=="chemist" || item.user_type=="sales")
						{
							<?php if(isset($_GET["back_url"])) {
							?>
							window.location.href = "<?= base_url();?><?php echo $_GET["back_url"]; ?>";
							<?php
							} else { ?>
								window.location.href = "<?= base_url();?>home";
							<?php } ?>
						}
					}else{
						$(".submit_div").html("<p class='text-danger'>"+item.status_message+"</p>");
						swal(item.status_message);

						$("#submitbtn").show();
						$("#submitbtn_disable").hide();
					}
				}
			});	
		},
		timeout: 10000
	});
}
</script>
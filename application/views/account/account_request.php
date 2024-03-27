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
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 main_box_div p-5">
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
				<h5 class="text-center submit_div mt-2">&nbsp;</h5>
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
					Website version <?= $this->Scheme_Model->website_version() ;?>
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
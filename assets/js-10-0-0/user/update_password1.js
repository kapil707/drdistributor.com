function showpassword()
{
	$("#eyes1").hide();
	$("#eyes").show();
	document.getElementById("old_password").type = 'text';
}
function hidepassword()
{
	$("#eyes1").show();
	$("#eyes").hide();
	document.getElementById("old_password").type = 'password';
}
function showpassword1()
{
	$("#eyes1").hide();
	$("#eyes").show();
	document.getElementById("new_password").type = 'text';
}
function hidepassword1()
{
	$("#eyes1").show();
	$("#eyes").hide();
	document.getElementById("new_password").type = 'password';
}
function showpassword2()
{
	$("#eyes1").hide();
	$("#eyes").show();
	document.getElementById("renew_password").type = 'text';
}
function hidepassword2()
{
	$("#eyes1").show();
	$("#eyes").hide();
	document.getElementById("renew_password").type = 'password';
}
var pass1 = 0;
var pass2 = 0;
var pass3 = 0;
function check_old_password()
{
	pass1 = 0;
	old_password = $("#old_password").val();
	//$(".check_old_password_div").html("Loading....");
	if(old_password=="")
	{
		$(".submit_div").html("&nbsp;");
	} else{
		pass1 = 1;
		submit_btn();
		/*
		$.ajax({
			type       : "POST",
			data       :  {old_password:old_password,user_type:user_type,user_altercode:user_altercode} ,
			url        : "<?php echo base_url(); ?>Chemist_json/check_old_password_api",
			cache	   : false,
			success    : function(data){
				$.each(data.items, function(i,item){	
					if (item){
						if(item.status1=="1")
						{
							$(".check_old_password_div").html("<p class='text-success'>"+item.status+"</p>");
							pass1 = 1;
							submit_btn();
						}
						else{
							$(".check_old_password_div").html("<p class='text-danger'>"+item.status+"</p>");
							pass1 = 0;
							submit_btn();
						}
					}
				});	
			}
		});*/
	}
}
function check_password1()
{
	$(".check_new_password_div").html("Loading....");
	new_password = $("#new_password").val();
	if(new_password.length < 8)
	{
		swal("Password must contain 8 characters (e.g. A,a or 1,2 or !,$,@)");
		$(".submit_div").html("<p class='text-danger'>Password must contain 8 characters (e.g. A,a or 1,2 or !,$,@)</p>");
		pass2 = 0;
		submit_btn();
	}
	else
	{
		$(".submit_div").html("&nbsp;");
		pass2 = 1;
		submit_btn();
	}
}
function check_password2()
{
	$(".check_renew_password_div").html("Loading....");
	new_password = $("#new_password").val();
	renew_password = $("#renew_password").val();
	check_password1();
	if(new_password!=renew_password)
	{
		swal("Password doesn't match");
		$(".submit_div").html("<p class='text-danger'>Password doesn't match</p>");
		pass3 = 0;
		submit_btn();
	}
	else
	{
		$(".submit_div").html("<p class='text-success'>Password Matched.</p>");
		pass3 = 1;
		submit_btn();
	}
}
function submit_btn()
{
	$("#submitbtn").hide()
	$("#submitbtn_disable").show()
	if(pass1=="1" && pass2=="1" && pass3=="1")
	{
		$("#submitbtn").show()
		$("#submitbtn_disable").hide()
	}
}
function submitbtn()
{
	old_password = $("#old_password").val();
	new_password = $("#new_password").val();
	renew_password = $("#renew_password").val();
	if(old_password=="")
	{
		swal("Enter oldpassword")
		$(".submit_div").html("<p class='text-danger'>Enter oldpassword</p>");
		$('#old_password').focus();
		return false;
	}
	if(new_password=="")
	{
		swal("Enter newpassword")
		$(".submit_div").html("<p class='text-danger'>Enter newpassword</p>");
		$('#new_password').focus();
		return false;
	}
	if(renew_password=="")
	{
		swal("Enter Re-enter newpassword")
		$(".submit_div").html("<p class='text-danger'>Enter Re-enter newpassword</p>");
		$('#renew_password').focus();
		return false;
	}
	$("#submitbtn").hide();
	$("#submitbtn_disable").show();
	$(".submit_div").html("Loading....");
	
	$.ajax({
		type       : "POST",
		data       :  {old_password:old_password,new_password:new_password} ,
		url        : get_base_url()+"user/update_password_api",
		cache	   : false,
		error: function(){
			swal("Error")
			$(".submit_div").html("<p class='text-danger'>Error</p>");
			$("#submitbtn").show();
			$("#submitbtn_disable").hide();
		},
		success    : function(data){			
			$.each(data.items, function(i,item){	
				if (item){
					swal(item.status_message);
					if(item.status=="1")
					{
						$(".submit_div").html("<p class='text-success'>"+item.status_message+"</p>");
						$(".check_old_password_div").html("");
						$(".check_new_password_div").html("");
						$(".check_renew_password_div").html("");
						$("#old_password").val("");
						$("#new_password").val("");
						$("#renew_password").val("");						
					}
					else{
						$(".submit_div").html("<p class='text-danger'>"+item.status_message+"</p>");
					}
				}
			});	
		}
	});
}
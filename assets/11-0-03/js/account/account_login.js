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
		url        : get_base_url()+"Account/get_login_api",
		cache : true,
		timeout: 10000,
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
							window.location.href = back_url
						}
					}else{
						$(".submit_div").html("<p class='text-danger'>"+item.status_message+"</p>");
						swal(item.status_message);

						$("#submitbtn").show();
						$("#submitbtn_disable").hide();
					}
				}
			});	
		}
	});
}
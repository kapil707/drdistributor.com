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
		url        : get_base_url()+"Account/get_create_new_api",
		cache : true,
		timeout: 10000,
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
		}
	});
}
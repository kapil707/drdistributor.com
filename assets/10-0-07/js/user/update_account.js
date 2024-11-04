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
	$(".load_page").html('<h2><center><img src="'+get_base_url()+'/img_v51/loading.gif" width="100px"></center></h2><h2><center>Loading....</center></h2>');
	$.ajax({
		type       : "POST",
		data       : {id:id} ,
		url        : get_base_url()+"User/get_new_user_account_api",
		cache : true,
		error: function(){
			$(".load_page").html('<h2><center><img src="'+get_base_url()+'/img_v51/no_record_found.png" width="100%"></center></h2>');
		},
		success    : function(data){
			if(data.items=="")
			{
				$(".load_page").html('<h2><center><img src="'+get_base_url()+'/img_v51/no_record_found.png" width="100%"></center></h2>');
			}
			else
			{
				$(".load_page").html("");
				$(".load_page").show();
			}
			$.each(data.items, function(i,item){	
				if (item){
					$(".load_page").append('<div class="row"><div class="col-sm-12 col-12"><h5>Last update request</h5></div><div class="col-sm-12"><img class="img-circle" src="'+get_base_url()+'/img_v51/phone1.png" width="25" alt="Mobile" title="Mobile"><span style="margin-left:20px;">'+item.user_phone+'</span></div><div class="col-sm-12"><img class="img-circle" src="'+get_base_url()+'/img_v51/email1.png" width="25" alt="Email" title="Email"><span style="margin-left:20px;">'+item.user_email+'</span></div><div class="col-sm-12"><img class="img-circle" src="'+get_base_url()+'/img_v51/map1.png" width="25" alt="Address" title="Address"><span style="margin-left:20px;">'+item.user_address+'</span></div></div>');
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
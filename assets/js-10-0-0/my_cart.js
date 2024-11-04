$(document).ready(function(){
	$(".cart_page_div_for_fix_height").css("height",$(window).height() - 215)
	$(".main_page_loading").show();
	my_cart_api("all");
});

function slice_type_change(mtid)
{
	$(".slice_item1_div").hide();
	$(".slice_item2_div").hide();
	$("#slice_type").val(mtid);
	if(mtid=="1")
	{
		$(".slice_item1_div").show();
	}
	if(mtid=="2")
	{
		$(".slice_item2_div").show();
	}
}
function place_order_model()
{
	$(".place_order_model").click();
	$("#remarks").focus();
}
function place_order_complete()
{
	slice_item 	= "";
	slice_type 	= $("#slice_type").val();
	if(slice_type=="1")
	{
		slice_item 	= $("#slice_item1").val();
	}
	if(slice_type=="2")
	{
		slice_item 	= $("#slice_item2").val();
	}
	remarks 	= $("#remarks").val();
	$(".place_order_div").show();
	$(".main_container").hide();
	$(".search_cart_footer_div").hide();
	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       : {remarks:remarks},
		url        : get_base_url() +"my_cart/place_order_api",
		cache	   : true,
		error: function(){
			window.location.href = get_base_url() + "my_cart";
			//count_temp_rec();
		},
		success    : function(data){
			$.each(data.items, function(i,item){
				if (item)
				{
					status 	= item.status;
					status_message = (item.status_message);
					if(status=="0" || status=="1")
					{
						$(".place_order_div").html("<h1 class='text-center'>"+status_message+"</h1><h1 class='text-center'><input type='submit' value='Go home' class='btn main_theme_button' name='Go home' onclick='gohome()' style='width:50%;margin-top:100px;'></h1>");
				    }
					/******************************** *
					get_my_cart_total_api();
					/******************************** */
				}
			});
		},
		timeout: 60000
	});
}
function gohome()
{
	window.location.href = get_base_url();
}
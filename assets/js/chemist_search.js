function page_load() {
	$(".top_bar_search_div").hide();
	$(".top_bar_search_textbox_div").show();
	$(".chemist_search_textbox").val("");
	$('.chemist_search_textbox').show();
	$('.chemist_search_textbox').focus();
}
function clear_search_function() {
	$(".search_result_div").html("");
	$(".search_result_div").hide();	
	$(".chemist_search_textbox").val("");
	$('.chemist_search_textbox').focus();
	$(".top_bar_search_textbox_div_clear_icon").hide();
	$(".background_blur").hide();
}
$(document).ready(function() {
	$(".chemist_search_textbox").keyup(function(e){
		if(e.keyCode == 8)
		{
			var keyword = $(".chemist_search_textbox").val();
			if(keyword!="")
			{
				if(keyword.length<3)
				{
					$('.chemist_search_textbox').focus();
					$(".search_result_div").html("");
				}
			}
			else{
				clear_search_function();
			}
		}
	})
	$(".chemist_search_textbox").keypress(function() { 
		var keyword = $(".chemist_search_textbox").val();
		if(keyword!="")
		{
			if(keyword.length<3)
			{
				$('.chemist_search_textbox').focus();
				$(".search_result_div").html("");
			}
			search_chemist()
		}
		else{
			clear_search_function();
		}
	});
	$(".chemist_search_textbox").change(function() { 
	});
	$(".chemist_search_textbox").on("search", function() { 
	});
	
    $(".chemist_search_textbox").keydown(function(event) {
    	if(event.key=="ArrowDown")
    	{
			page_up_down_arrow("1");
    		$('.hover_1').attr("tabindex",-1).focus();
			return false;
    	}
    });
	setTimeout('page_load();',100);
	document.onkeydown = function(evt) {
		evt = evt || window.event;
		if (evt.keyCode == 27) {
			clear_search_function();
		}
	};
});
function search_chemist()
{
	new_i = 0;

	$(".top_bar_search_textbox_div_clear_icon").show();

	var keyword = $(".chemist_search_textbox").val();
	if(keyword!="")
	{
		if(keyword.length>1)
		{
			$(".background_blur").show();
			$(".top_bar_title2").html("Loading....");

			$(".search_result_div").show();
			$(".search_result_div").html('<div class="row"><div class="col-sm-12 text-center">'+loading_img_function()+'</div></div>');

			$.ajax({
				type       : "POST",
				dataType   : "json",
				data       : {keyword : keyword} ,
				url        : get_base_url()+"chemist_select/chemist_search_api",
				cache	   : false,
				error: function(){
					$(".search_result_div").html(something_went_wrong_function());
					$(".search_result_div_mobile").html(something_went_wrong_function());
					$(".top_bar_title2").html("No record found");
				},
				success    : function(data){
					
					$(".search_result_div").html("");
					$(".search_result_div_mobile").html("");
					if(data.items==""){
						$(".top_bar_title2").html("No record found");
						$(".search_result_div").html(no_record_found_function());
						$(".search_result_div_mobile").html(no_record_found_function());
					}
					$.each(data.items, function(i,item){	
						if (item){
							user_nrx			= item.user_nrx;
							chemist_altercode	= item.chemist_altercode;
							new_i				= item.count;
							
							//new_i = parseInt(new_i) + 1;
							
							a_ = 'onclick=chemist_session_add("'+chemist_altercode+'","'+user_nrx+'")';
							csshover1 = 'hover_'+new_i;
							chemist_message = "";
							if(item.user_cart!="0")
							{
								chemist_message = '<div class="all_item_date_time">Order '+item.user_cart+' Items | Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item.user_cart_total+'/-</div></div></div>';
							}
							
							var serach_data = '<div class="main_box_div_data '+csshover1+' select_chemist_'+new_i+'" '+a_+'><div class="chemist_search_box_left_div"><img src="'+item.chemist_image+'" class="all_item_image" onerror="setDefaultImage(this);"></div><div class="chemist_search_box_right_div"><div class="all_chemist_name">'+item.chemist_name+'</div><div class="all_chemist_altercode"> Code : '+item.chemist_altercode+'</div>'+chemist_message+'</div>';

							$(".search_result_div").append(serach_data);
							$(".search_result_div_mobile").append(serach_data);

							$(".top_bar_title2").html("Found result ("+new_i+")");
						}
					});					
				}
			});
		}
	}
	else{
		
		$(".top_bar_search_textbox_div_menu_icon").hide();
		$(".top_bar_search_textbox_div_menu").hide();

		$(".top_bar_search_textbox_div_clear_icon").hide();
		$(".search_result_div").html("");
		$(".search_result_div_mobile").html("");
	}
}
function chemist_session_add(chemist_id,user_nrx)
{	
	window.location.href = get_base_url()+"chemist_select/chemist_session_add/"+chemist_id+"/"+user_nrx
}
function page_up_down_arrow(new_i)
{
	$('.hover_'+new_i).keypress(function (e) {
		 if (e.which == 13) {
			$('.select_chemist_'+new_i).click();
		 } 						 
	 });
	$('.hover_'+new_i).keydown(function(event) {
		if(event.key=="ArrowDown")
		{
			new_i = parseInt(new_i) + 1;
			page_up_down_arrow(new_i);
			$('.hover_'+new_i).attr("tabindex",-1).focus();
			return false;
		}
		if(event.key=="ArrowUp")
		{
			if(parseInt(new_i)==1)
			{
				var searchInput = $('.chemist_search_textbox');
				var strLength = searchInput.val().length * 2;
				searchInput.focus();
				searchInput[0].setSelectionRange(strLength, strLength);
			}
			else
			{
				new_i = parseInt(new_i) - 1;
				page_up_down_arrow(new_i);
				$('.hover_'+new_i).attr("tabindex",-1).focus();
			}
			return false;
		}
	});
}
$(document).ready(function(){
	call_page("kapil");
});
function call_page_by_last_id()
{
	lastid1=$(".lastid1").val();
	call_page(lastid1)
}
var no_record_found = 0;
var new_i = 0;
function call_page(lastid1)
{
	/*********************************** */
	$(".top_bar_title2").html("Loading....");
	$(".main_container").show();
	$(".main_page_loading").show();
	$(".main_page_no_record_found").hide();
	$(".main_page_something_went_wrong").hide();
	/*********************************** */

	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       :  {lastid1:lastid1} ,
		url        : get_base_url()+"chemist_select/salesman_my_cart_api",
		cache	   : false,
		error: function(){
			$(".top_bar_title2").html("No record found");
			$(".main_container").hide();
			$(".main_page_loading").hide();
			$(".main_page_something_went_wrong").show();
		},
		success    : function(data){
			
			$(".main_page_loading").hide();
			if(data.items=="")
			{
				if(no_record_found=="0")
				{
					$(".top_bar_title2").html("No record found");
					$(".main_container").hide();
					$(".main_page_no_record_found").show();
				}
			}
			$.each(data.items, function(i,item){	
				if (item){
					user_nrx 			= item.user_nrx;
					chemist_altercode 	= item.chemist_altercode;

					a_ = 'onclick=chemist_session_add("'+chemist_altercode+'","'+user_nrx+'")';
					
					$(".main_page_data").append('<div class="main_box_div_data" '+a_+'><div class="chemist_search_box_left_div"><img src="'+item.chemist_image+'" class="all_item_image" onerror="setDefaultImage(this);"></div><div class="chemist_search_box_right_div"><div class="all_chemist_name">'+item.chemist_name+'</div><div class="all_chemist_altercode"> Code : '+item.chemist_altercode+'</div><div class="all_item_date_time">Order '+item.user_cart+' Items | Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item.user_cart_total+'/-</div></div></div>');	

					no_record_found = 1;
					
					new_i = parseInt(new_i) + 1;
					$(".top_bar_title2").html("Found result ("+new_i+")");
				}
			});
		},
		timeout: 60000
	});	
}
function page_load() {
	$(".top_bar_search_div").hide();
	$(".top_bar_search_textbox_div").show();
	$(".chemist_search_textbox").val("");
	$('.chemist_search_textbox').show();
	$('.chemist_search_textbox').focus();
}
function clear_search_icon() {
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
				clear_search_icon();
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
			clear_search_icon();
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
			clear_search_icon();
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
			$(".search_result_div").show();
			$(".search_result_div").html('<div class="row p-2" style="background:white;"><div class="col-sm-12 text-center"><h2><img src="'+get_base_url()+'img_v51/loading.gif" width="100px"></h2><h2>Loading....</h2></div></div>');
			$.ajax({
				type       : "POST",
				dataType   : "json",
				data       : {keyword : keyword} ,
				url        : get_base_url()+"chemist_select/chemist_search_api",
				cache	   : false,
				error: function(){
					$(".search_result_div").html('<h2><img src="'+get_base_url()+'img_v51/something_went_wrong.png" width="100%"></h2>');
				},
				success    : function(data){
					if(data.items=="")
					{
						$(".search_result_div").html('<h2><center><img src="'+get_base_url()+'img_v51/no_record_found.png" width="100%"></center></h2>');
					}
					else
					{
						$(".search_result_div").html("");
					}
					$.each(data.items, function(i,item){	
						if (item){
							chemist_altercode	= item.chemist_altercode;
							new_i				= item.count;
							
							//new_i = parseInt(new_i) + 1;
							
							a_ = 'onclick=chemist_session_add("'+chemist_altercode+'")';
							csshover1 = 'hover_'+new_i;
							chemist_message = "";
							if(item.user_cart!="0")
							{
								chemist_message = '<div class="all_item_date_time">Order '+item.user_cart+' Items | Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item.user_cart_total+'/-</div></div></div>';
							}
							
							$(".search_result_div").append('<div class="main_box_div_data '+csshover1+' select_chemist_'+new_i+'" '+a_+'><div class="chemist_search_box_left_div"><img src="'+item.chemist_image+'" class="all_item_image" onerror="setDefaultImage(this);"></div><div class="chemist_search_box_right_div"><div class="all_item_name">'+item.chemist_name+'</div><div class="all_item_packing"> Code : '+item.chemist_altercode+'</div>'+chemist_message+'</div>');
						}
					});					
				}
			});
		}
	}
	else{
		$(".top_bar_search_textbox_div_clear_icon").hide();
		$(".search_result_div").html("");
	}
}
function chemist_session_add(chemist_id)
{	
	window.location.href = get_base_url()+"chemist_select/chemist_session_add/"+chemist_id
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
function call_page(lastid1)
{
	$(".main_page_loading").html('<h2><center><img src="'+get_base_url()+'/img_v51/loading.gif" width="100px"></center></h2><h2><center>Loading....</center></h2>');
	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       :  {lastid1:lastid1} ,
		url        : get_base_url()+"chemist_select/salesman_my_cart_api",
		cache	   : false,
		error: function(){
			$(".main_page_loading").html("");
			$(".main_page_data").html('<h2><img src="'+get_base_url()+'img_v51/something_went_wrong.png" width="100%"></h2>');
		},
		success    : function(data){
			if(data.items=="")
			{
				if(no_record_found=="0")
				{
					$(".main_page_loading").html("");
					$(".main_page_data").html('<h2><center><img src="'+get_base_url()+'/img_v51/no_record_found.png" width="100%"></center></h2>');
				}
				else
				{
					$(".main_page_loading").html("");
					$(".main_page_data").html("");
				}
			}
			else
			{
				$(".main_page_loading").html("");
			}
			$.each(data.items, function(i,item){	
				if (item){
					chemist_altercode = item.chemist_altercode
					a_ = 'onclick=chemist_session_add("'+chemist_altercode+'")';
					
					$(".main_page_data").append('<div class="main_box_div_data" '+a_+'><div class="chemist_search_box_left_div"><img src="'+item.chemist_image+'" class="all_item_image" onerror="setDefaultImage(this);"></div><div class="chemist_search_box_right_div"><div class="all_item_name">'+item.chemist_name+'</div><div class="all_item_packing"> Code : '+item.chemist_altercode+'</div><div class="all_item_date_time">Order '+item.user_cart+' Items | Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item.user_cart_total+'/-</div></div></div>');	

					no_record_found = 1;
					$(".main_page_data").show();
				}
			});
		},
		timeout: 10000
	});	
}
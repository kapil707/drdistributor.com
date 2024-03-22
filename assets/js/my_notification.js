$(window).scroll(function(){
	var scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
	if (scrollBottom<100){
		load_more()
	}
});
$(document).ready(function(){
	get_record=$(".get_record").val();
	call_page(get_record)
});
function load_more()
{
	get_record=$(".get_record").val();
	call_page(get_record)
}
var query_work = 0;
var no_record_found = 0;
var new_i = 0;
function call_page(get_record)
{
	if(query_work=="0")
	{
		query_work = 1;

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
			data       :  {get_record:get_record} ,
			url        : get_base_url()+"my_notification/my_notification_api",
			cache	   : false,
			error: function(){
				$(".top_bar_title2").html("No record found");
				$(".main_container").hide();
				$(".main_page_loading").hide();
				$(".main_page_something_went_wrong").show();
			},
			success    : function(data){
				
				$(".main_page_loading").hide();
				if(data.items=="" && no_record_found=="0") {
					$(".top_bar_title2").html("No record found");
					$(".main_page_no_record_found").show();
				}
				
				get_record 	= data.get_record;
				$(".get_record").val(get_record);
				$.each(data.items, function(i,item){
					if (item){								
						item_id 			= item.item_id;
						item_title 			= item.item_title;
						item_message 		= item.item_message;
						item_date_time 		= item.item_date_time;
						item_image 			= item.item_image;
						
						$(".main_page_data").append('<div class="main_box_div_data"><a href="'+get_base_url()+'my_notification_details/'+item_id+'"><div class="all_page_box_left_div"><img src="'+item_image+'" alt="" title="" onerror="setDefaultImage(this);" class="all_item_image"></div><div class="all_page_box_right_div text-left"><div class="all_item_name">'+item_title+'</div><div class="all_item_message">'+item_message+'</div><div class="all_item_date_time">'+item_date_time+'</div></div></a></div>');
						
						query_work = 0;
						no_record_found = 1;
						
						new_i = parseInt(new_i) + 1;
						$(".top_bar_title2").html("Found result ("+new_i+")");
					}
				});
			},
			timeout: 60000
		});
	}
}
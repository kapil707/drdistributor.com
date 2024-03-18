$(window).scroll(function(){
	var scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
	if (scrollBottom<100){
		//alert(parseInt($(window).scrollTop()))
		$(".load_more").click()
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
function call_page(get_record)
{
	if(query_work=="0")
	{
		query_work = 1;
		$(".load_more").hide();
		$(".load_page_loading").html('<h1><center><img src="'+get_base_url()+'/img_v51/loading.gif" width="100px"></center></h1><h1><center>Loading....</center></h1>');
		$.ajax({
			type       : "POST",
			dataType   : "json",
			data       :  {get_record:get_record} ,
			url        : get_base_url()+"my_notification/my_notification_api",
			cache	   : false,
			error: function(){
				$(".load_page_loading").html("");
				$(".load_page").html('<h1><img src="'+get_base_url()+'img_v51/something_went_wrong.png" width="100%"></h1>');
			},
			success    : function(data){

				$(".load_page_loading").html("");				
				if(data.items=="" && no_record_found=="0") {
					$(".load_page").html('<h1><center><img src="'+get_base_url()+'/img_v51/no_record_found.png" width="100%"></center></h1>');
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
						
						$(".load_page").append('<div class="main_theme_li_bg"><a href="'+get_base_url()+'my_notification_details/'+item_id+'"><div class="medicine_my_page_div1"><img src="'+item_image+'" alt="" title="" onerror="setDefaultImage(this);" class="medicine_cart_item_image"></div><div class="medicine_my_page_div2 text-left"><div class="medicine_cart_item_name">'+item_title+'</div><div class="medicine_cart_item_price">'+item_message+'</div><div class="medicine_cart_item_datetime">'+item_date_time+'</div></div></a></div>');
						
						query_work = 0;
						no_record_found = 1;
						$(".load_more").show();
						$(".load_page").show();
					}
				});
			},
			timeout: 10000
		});
	}
}
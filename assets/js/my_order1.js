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
		$(".main_page_loading").html('<h2><img src="'+get_base_url()+'/img_v51/loading.gif" width="100px"></h2><h2>Loading....</h2>');
		$.ajax({
			type       : "POST",
			dataType   : "json",
			data       : { get_record:get_record} ,
			url        : get_base_url() + "my_order/my_order_api",
			cache	   : false,
			error: function(){
				$(".main_page_loading").html("");
				$(".main_page_data").html('<h2><img src="'+get_base_url()+'img_v51/something_went_wrong.png" width="100%"></h2>');
			},
			success    : function(data){
				
				$(".main_page_loading").html("");				
				if(data.items=="" && no_record_found=="0") {
					$(".main_page_data").html('<h2><center><img src="'+get_base_url()+'/img_v51/no_record_found.png" width="100%"></center></h2>');
				}
				
				get_record 	= data.get_record;
				$(".get_record").val(get_record);

				$.each(data.items, function(i,item){
					if (item){
						item_id	 		= item.item_id;
						item_title 		= item.item_title;
						item_total 		= item.item_message;
						item_date_time 	= item.item_date_time;
						item_image 		= item.item_image;
						
						$(".main_page_data").append('<div class="main_box_div_data"><a href="'+get_base_url()+'my_order_details/'+item_id+'"><div class="all_page_box_left_div"><img src="'+item_image+'" alt="" title="" onerror="setDefaultImage(this);" class="all_item_image"></div><div class="all_page_box_right_div text-left"><div class="all_item_name">'+item_title+'</div><div class="all_item_total">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_total+'/-</div><div class="all_item_date_time">'+item_date_time+'</div></div></a></div>');
						
						query_work = 0;
						no_record_found = 1;

						$(".main_page_data").show();
					}
				});
			},
			timeout: 60000
		});
	}
}
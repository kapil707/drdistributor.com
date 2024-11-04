$(window).scroll(function(){
	var scrollBottom = $(".main_container").height() - $(window).height() - $(window).scrollTop();
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
		$(".top_bar_title").html("Loading....");
		$(".main_container").hide();
		$(".main_page_loading").show();
		$(".main_page_no_record_found").hide();
		$(".main_page_something_went_wrong").hide();
		/*********************************** */

		$.ajax({
			type       : "POST",
			dataType   : "json",
			data       : {get_record:get_record} ,
			url        : get_base_url() + "my_invoice/my_invoice_api",
			cache	   : false,
			error: function(){
				$(".top_bar_title").html("No record found");
				$(".main_container").hide();
				$(".main_page_loading").hide();
				$(".main_page_something_went_wrong").show();
			},
			success    : function(data){

				$(".main_page_loading").hide();
				if(data.items=="" && no_record_found=="0") {
					$(".top_bar_title").html("No record found");
					$(".main_container").hide();
					$(".main_page_no_record_found").show();
				}
				
				get_record 	= data.get_record;
				$(".get_record").val(get_record);
				$.each(data.items, function(i,item){
					if (item){
						item_id	 		= item.item_id;
						item_title 		= item.item_title;
						item_total 		= item.item_message;
						item_date_time 	= item.item_date_time;
						out_for_delivery= item.out_for_delivery;
						delete_status	= item.delete_status;
						download_url	= item.download_url;
						item_image 		= item.item_image;
						
						if(out_for_delivery!="")
						{
							out_for_delivery = ' | Out For Delivery Date Time : ' + out_for_delivery;
						}
						delete_status_div = "";
						if(delete_status==1)
						{
							delete_status_div = '<div class="all_item_date_time">Some items have been deleted / modified in this order</div>';
						}
						
						$(".main_page_data").append('<div class="main_box_div_data"><div class="all_page_box_left_div"><a href="'+get_base_url()+'mid/'+item_id+'"><img src="'+item_image+'" alt="" title="" onerror="setDefaultImage(this);" class="all_item_image"></a></div><div class="all_page_box_right_div text-left"><div class=""><a href="'+get_base_url()+'mid/'+item_id+'"><span class="all_item_name">'+item_title+'</span></a><span style="float: right;"><a href="'+download_url+'"  class="all_item_download">Download Excel</a></span></div><a href="'+get_base_url()+'mid/'+item_id+'"><div class="all_item_price">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_total+'/-</div><div class="all_item_date_time">Invoice Date : '+item_date_time+''+out_for_delivery+'</div>'+delete_status_div+'</div></a></div>');
						
						query_work = 0;
						no_record_found = 1;
						
						new_i = parseInt(new_i) + 1;
						$(".top_bar_title").html("Found result ("+new_i+")");
					}
				});	
			},
			timeout: 60000
		});
	}
}
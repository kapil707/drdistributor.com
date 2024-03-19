<style>
.main_container{
	margin-bottom:100px;
}
</style>
<script>
$(".top_bar_title").html("<?= $main_page_title ?>");
function goBack() {
	window.location.href = "<?= base_url();?>";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-12 col-12">
			<div class="row">
				<div class="col-sm-12 col-12">
					<div class="main_box_div main_page_data p-2" style="display:none">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
					<span class="main_page_loading" style="position: fixed;top: 300px;z-index: 100;margin-left:-90px"></span>
				</div>
			</div>
		</div>
	</div>     
</div>
<input type="hidden" class="get_record" value="0">
<script>
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
		$(".main_page_loading").html('<h2><center><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px"></center></h2><h2><center>Loading....</center></h2>');
		$.ajax({
			type       : "POST",
			dataType   : "json",
			data       : {get_record:get_record} ,
			url        : "<?php echo base_url(); ?>my_invoice/my_invoice_api",
			cache	   : false,
			error: function(){
				$(".main_page_loading").html("");
				$(".main_page_data").html('<h2><img src="<?= base_url(); ?>img_v51/something_went_wrong.png" width="100%"></h2>');
			},
			success    : function(data){

				$(".main_page_loading").html("");				
				if(data.items=="" && no_record_found=="0") {
					$(".main_page_data").html('<h2><center><img src="<?= base_url(); ?>/img_v51/no_record_found.png" width="100%"></center></h2>');
				}
				
				get_record 	= data.get_record;
				$(".get_record").val(get_record);

				$.each(data.items, function(i,item){
					if (item){
						if(item.order_id=="")
						{
						}
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
						
						$(".main_page_data").append('<div class="main_box_div_data"><div class="all_page_box_left_div"><a href="<?php echo base_url() ?>my_invoice_details/'+item_id+'"><img src="'+item_image+'" alt="" title="" onerror=this.src="<?= base_url(); ?>/uploads/default_img.jpg" class="all_item_image"></a></div><div class="all_page_box_right_div text-left"><div class=""><a href="<?php echo base_url() ?>my_invoice_details/'+item_id+'"><span class="all_item_name">'+item_title+'</span></a><span style="float: right;color: red;"><a href="'+download_url+'"  class="all_item_download">Download Invoice</a></span></div><a href="<?php echo base_url() ?>my_invoice_details/'+item_id+'"><div class="all_item_price">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_total+'/-</div><div class="all_item_date_time">Invoice Date : '+item_date_time+''+out_for_delivery+'</div>'+delete_status_div+'</div></a></div>');
						
						query_work = 0;
						no_record_found = 1;
						$(".main_page_data").show();
					}
				});	
			},
			timeout: 10000
		});
	}
}
</script>
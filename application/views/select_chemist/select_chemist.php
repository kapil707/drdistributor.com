<style>
.menubtn1,.menubtn2
{
	display:none;
}
.homepgsearch_w
{
	display:none;
}
.headertitle
{
    margin-top: 5px !important;
}
.home_page_search_div_box,.select_chemist
{
	display: inline-block;
}
.select_medicine,.home_page_search_div,.search_medicine_result,.clear_search_icon
{
	display: none;
}
@media screen and (max-width: 767px) {
	.homebtn_div
	{
		display:none;
	}
}
.search_medicine_main{
	display:block;
}
.top_menu_menu_main{
	display: none;
}
</style>
<div class="container maincontainercss">
	<div class="row">
		<div class="col-sm-12 col-12">
			<div class="row">
				<div class="col-sm-12 col-12">
					<div class="website_box_part load_page" style="display:none">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
					<span class="load_page_loading" style="position: fixed;top: 300px;z-index: 100;margin-left:-90px"></span>
				</div>
				<div class="col-sm-12" style="margin-top:10px;">
					<button onclick="load_more()" class="load_more"></button>
				</div>
			</div>
		</div>
	</div>     
</div>
<script>
$(".headertitle").html("Search chemist");
function goBack() {
	window.location.href = "<?= base_url();?>home";
}
</script>
<div class="background_blur" onclick="clear_search_icon()" style="display:none"></div>
<script>
function page_load()
{
	search_focus();
	clear_search_icon();
}
function search_focus()
{
	$(".search_medicine_result").hide();
	$('.select_chemist').focus();
}
function clear_search_icon()
{
	$(".search_medicine_result").html("");
	$(".select_chemist").val("");
	$('.select_chemist').focus();
	$(".clear_search_icon").hide();
	$(".search_medicine_result").hide();	
	$(".background_blur").hide();
51
}
$(document).ready(function(){
	$(".select_chemist").keyup(function(e){
		if(e.keyCode == 8)51
		{
			var keyword = $(".select_chemist").val();
51
			if(keyword!="")
			{
				if(keyword.length<3)
				{
					$('.select_chemist').focus();
					$(".search_medicine_result").html("");
				}
			}
			else{
				clear_search_icon();
			}
		}
	})
	$(".select_chemist").keypress(function() { 
		var keyword = $(".select_chemist").val();
		if(keyword!="")
		{
			if(keyword.length<3)
			{
				$('.select_chemist').focus();
				$(".search_medicine_result").html("");
			}
			search_chemist()
		}
		else{
			clear_search_icon();
		}
	});
	$(".select_chemist").change(function() { 
	});
	$(".select_chemist").on("search", function() { 
	});
	
    $(".select_chemist").keydown(function(event) {
    	if(event.key=="ArrowDown")
    	{
			page_up_down_arrow("1");
    		$('.hover_1').attr("tabindex",-1).focus();
			return false;
    	}
    });
	setTimeout('page_load();',100);
	
51
	document.onkeydown = function(evt) {
		evt = evt || window.event;
		if (evt.keyCode == 27) {
			clear_search_icon();51
		}
	};
51
});
function search_chemist()
{
		new_i = 0;
		$(".clear_search_icon").show();
        var keyword = $(".select_chemist").val();
		if(keyword!="")
		{
			if(keyword.length>1)
			{
				$(".background_blur").show();
				$(".search_medicine_result").show();
				$(".search_medicine_result").html('<div class="row p-2" style="background:white;"><div class="col-sm-12 text-center"><h1><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px"></h1><h1>Loading....</h1></div></div>');
				$.ajax({
					type       : "POST",
					data       :  {keyword : keyword} ,
					url        : "<?php echo base_url(); ?>select_chemist/select_chemist_api",
					cache	   : false,
					error: function(){
						$(".search_medicine_result").html('<h1><img src="<?= base_url(); ?>img_v51/something_went_wrong.png" width="100%"></h1>');
					},
					success    : function(data){
						if(data.items=="")
						{
							$(".search_medicine_result").html('<h1><center><img src="<?= base_url(); ?>/img_v51/no_record_found.png" width="100%"></center></h1>');
						}
						else
						{
							$(".search_medicine_result").html("");
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
									chemist_message = '<div class="medicine_cart_item_date_time">Order '+item.user_cart+' Items | Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item.user_cart_total+'/-</div></div></div>';
								}
								
								$(".search_medicine_result").append('<div class="main_theme_li_bg '+csshover1+' select_chemist_'+new_i+'" '+a_+'><div class="search_chemist_div1"><img src="'+item.chemist_image+'" class="medicine_cart_item_image" onerror=this.src="<?= base_url(); ?>/uploads/default_img.jpg"></div><div class="search_chemist_div2"><div class="chemist_user_name">'+item.chemist_name+'</div><div class="chemist_altercode"> Code : '+item.chemist_altercode+'</div>'+chemist_message+'</div>');
							}
						});					
					}
				});
			}
		}
		else{
			$(".clear_search_icon").hide();
			$(".search_medicine_result").html("");
		}
}
function chemist_session_add(chemist_id)
{	
	window.location.href = "<?= base_url();?>select_chemist/chemist_session_add/"+chemist_id
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
				var searchInput = $('.select_chemist');
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
</script>
<script>
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
	$(".load_more").hide();
	$(".load_page_loading").html('<h1><center><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px"></center></h1><h1><center>Loading....</center></h1>');
	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       :  { lastid1:lastid1} ,
		url        : "<?php echo base_url(); ?>select_chemist/salesman_my_cart_api",
		cache	   : false,
		error: function(){
			$(".load_page_loading").html("");
			$(".load_page").html('<h1><img src="<?= base_url(); ?>img_v51/something_went_wrong.png" width="100%"></h1>');
		},
		success    : function(data){
			if(data.items=="")
			{
				if(no_record_found=="0")
				{
					$(".load_page_loading").html("");
					$(".load_page").html('<h1><center><img src="<?= base_url(); ?>/img_v51/no_record_found.png" width="100%"></center></h1>');
				}
				else
				{
					$(".load_page_loading").html("");
					$(".load_page").html("");
				}
			}
			else
			{
				$(".load_page_loading").html("");
			}
			$.each(data.items, function(i,item){	
				if (item){
					chemist_altercode = item.chemist_altercode
					a_ = 'onclick=chemist_session_add("'+chemist_altercode+'")';
					$(".load_page").append('<div class="main_theme_li_bg" '+a_+'><div class="medicine_chemist_div1"><img src="'+item.chemist_image+'" class="medicine_cart_item_image" onerror=this.src="<?= base_url(); ?>/uploads/default_img.jpg"></div><div class="medicine_chemist_div2"><div class="medicine_cart_item_name">'+item.chemist_name+'</div><div class="medicine_cart_item_packing"> Code : '+item.chemist_altercode+'</div><div class="medicine_cart_item_date_time">Order '+item.user_cart+' Items | Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item.user_cart_total+'/-</div></div></div>');				
					no_record_found = 1;
					$(".load_more").show();
					$(".load_page").show();
				}
			});
		},
		timeout: 10000
	});	
}
</script>
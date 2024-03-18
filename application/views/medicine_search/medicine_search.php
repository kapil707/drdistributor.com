<style>
.menubtn1
{
	display:none;
}
.maincontainercss{
	margin-bottom:100px;
}
@media screen and (max-width: 800px) {
	.search_pg_menu_off,.main_home_top_btn
	{
		display:none;
	}
	.current_order_search_page,.delete_btn_icon
	{
		display: block !important;
	}
	.maincontainercss{
		margin-bottom:80px;
	}
}
.home_page_search_div_box_more_btn{
	display: inline-block !important;
}
.menu_search_icon{
	display: none;
}
@media screen and (max-width:1024px) {
	.home_page_search_div_box_more_btn{
		display:none !important;
	}
	.menu_search_icon{
		display: inline;
	}
}
.deleteicon
{
	display: initial !important;
}
.home_page_search_div_box,.select_medicine
{
	display: inline-block;
}
.select_chemist,.home_page_search_div,.search_medicine_result,.clear_search_icon
{
	display: none;
}
.search_medicine_main{
	display:block;
}
.top_menu_menu_main{
	display: none;
}
.headertitle
{
	margin-top: 2px;
    font-size: 25px;
	font-weight: 700;
}
.maincontainercss {
    padding-top: 135px;
    min-height: 500px;
}
</style>
<?php if(!empty($chemist_id)){ ?>
<style>
.headertitle
{
	margin-top: -5px;
}
</style>
<script>
$(".headertitle1").show();
</script>
<?php } ?>
<script>
$(".headertitle").html("Search medicines");
setTimeout('div_height();',500);
function  div_height(){
	$(".search_page_main_div").css("height",$(window).height() - 240)
	console.log($(window).height());
}
function goBack() {
	window.location.href = "<?= base_url();?>home";
}
</script>
<div class="container-fluid maincontainercss">
	<div class="row">
		<div class="col-sm-6 col-12 mobile_off" style="margin-bottom:5px;">
			<span class="text-left">
				<h6 class="search_pg_title_color">Favourite medicines</h6>
			</span>
		</div>
		<div class="col-sm-3 col-12 mobile_off" style="margin-bottom:5px;">
			<h6 class="search_pg_title_color" onclick="current_order_ref()">My Cart <span class="div_cart_total_items1"></span></h6>
		</div>
		<div class="col-sm-3 col-12 mobile_off text-right" style="margin-bottom:5px;">
			<a href="#" onclick="delete_all_medicine()" tabindex="-10" class="cart_delete_btn delete_all_btn" title="Delete all medicines">
			<i class="fa fa-trash-o" aria-hidden="true"></i> Delete all medicines</a>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6 d-none d-sm-block">
			<div class="website_box_part search_page_main_div get_medicine_favourite_div p-2">
				<h1 class="text-center"><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px" alt="Loading...." title="Loading...."></h1><h1 class="text-center">Loading....</h1>
			</div>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12 border_off_mobile">
			<div class="website_box_part search_page_main_div medicine_cart_list_div p-2">
				<h1 class="text-center"><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px" alt="Loading...." title="Loading...."></h1><h1 class="text-center">Loading....</h1>
			</div>
		</div>
	</div>
</div>
<div class="view_cart_or_empty_cart_btn_div">
	<div class="container">
		<div class="row">
			<div class="col-5 text-center">				
				<div class="div_cart_total_items">Your cart is empty</div>
				<div class="div_cart_total_price"><i class="fa fa-inr"></i>0.00</div>
			</div>
			<div class="col-7 text-center">
				<span class="cart_empty_cart_div">
					<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px;display:none" id="order_loading"></i><button class="btn btn-primary btn-block mainbutton_disable" onclick="cart_empty_btn()" tabindex="-3" title="Your cart is empty">Your cart is empty</button>
				</span>
				<span class="cart_add_to_cart_div" style="display:none">
					<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px;display:none" id="order_loading"></i><button class="btn btn-primary btn-block mainbutton" onclick="view_cart_btn()" tabindex="-3" title="View cart">View cart</button>
				</span>
			</div>
		</div>
	</div>
</div>
<div class="background_blur" onclick="clear_search_icon()" style="display:none"></div>
<div class="menu_search_icon_box" style="display:none">
	<div class="row">
		<div class="col-sm-12 text-center">
			<b>Show Result</b>
		</div>
		<div class="col-sm-6">
			<label>Medicine : <input type="checkbox" class="menu_search_icon_checkbox checkbox_medicine" onchange="medicine_search_api()" checked></label>
		</div>
		<div class="col-sm-6">
			<label>Company : <input type="checkbox" class="menu_search_icon_checkbox checkbox_company" onchange="medicine_search_api()" checked></label>
		</div>
		<?php /*<div class="col-sm-6">
			<label>Out Of Stock <input type="checkbox" class="menu_search_icon_checkbox checkbox_out_of_stock" onchange="medicine_search_api()"></label>
		</div> */ ?>
		<div class="col-sm-8">
			Result Show :
		</div>
		<div class="col-sm-4">
			<select class="medicine_total_rec" onchange="medicine_search_api()">
				<option value="25">25</option>
				<option value="50">50</option>
				<option value="75">75</option>
				<option value="100">100</option>
				<option value="all">All</option>
			</select>
		</div>
	</div>
</div>
<script type="text/javascript">
function current_order_ref()
{
	cart_page_load();
}
get_medicine_favourite();
function cart_page_load()
{
	$(".search_medicine_result").hide();
	$('.homepgsearch_w').hide();
	$('.search_textbox').focus();
	medicine_cart_list();
}
function clear_search_icon()
{
	$(".search_medicine_result").html("");
	$(".search_medicine_result").hide();

	$(".search_textbox").val("");
	$('.search_textbox').focus();

	$(".menu_search_icon").hide();	
	$(".menu_search_icon_box").hide();
	$(".clear_search_icon").hide();	
	$(".background_blur").hide();

	$(".search_pg_current_order").show();
	$(".search_pg_result_found").hide();
}
function menu_search_icon()
{
	$(".menu_search_icon_box").show();
}
$(document).ready(function(){	
	$(".search_textbox").keyup(function(e){
		if(e.keyCode == 8)
		{
			var keyword = $(".search_textbox").val();
			if(keyword!="")
			{
				if(keyword.length<3)
				{
					$('.search_textbox').focus();
					$(".search_medicine_result").html("");
				}
			}
			else{
				clear_search_icon();
			}
		}
	})  
	$(".search_textbox").keypress(function() { 
		var keyword = $(".search_textbox").val();
		//$('.headertitle').html(keyword)
		if(keyword!="")
		{
			if(keyword.length<3)
			{
				$('.search_textbox').focus();
				$(".search_medicine_result").html("");
			}
			if(keyword.length>2)
			{
				//medicine_search_api();
				setTimeout('medicine_search_api();',500);
			}
		}
		else{
			clear_search_icon();
		}
	});
	$(".search_textbox").change(function() { 
	});
	$(".search_textbox").on("search", function() { 
	});
	
    $(".search_textbox").keydown(function(event) {
    	if(event.key=="ArrowDown")
    	{
			page_up_down_arrow("1");
    		$('.hover_1').attr("tabindex",-1).focus();
			return false;
    	}
    });
	setTimeout('cart_page_load();',100);
	
	document.onkeydown = function(evt) {
		evt = evt || window.event;
		if (evt.keyCode == 27) {
			clear_search_icon();
		}
	};
});

function page_up_down_arrow(new_i)
{
	$('.hover_'+new_i).keypress(function (e) {
		 if (e.which == 13) {
			$('.medicine_details_funcation_'+new_i).click();
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
				var searchInput = $('.search_textbox');
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

function cart_empty_btn()
{
	swal("Your cart is empty");
}
function view_cart_btn()
{
	window.location.href= "<?= base_url() ?>my_cart";
}

function medicine_search_api()
{
	$(".menu_search_icon_box").hide();
	$(".search_pg_current_order").hide();
	$(".search_pg_result_found").show();
	new_i = 0;
	$(".menu_search_icon").show();
	$(".clear_search_icon").show();
	var keyword = $(".search_textbox").val();
	//$('.headertitle').html(keyword)
	if(keyword!="")
	{
		if(keyword=="#")
		{
			keyword = "k1k2k12k";
		}
		if(keyword.length>1)
		{
			total_rec 				= $(".medicine_total_rec").val();
			checkbox_medicine 		= $(".checkbox_medicine").val();
			checkbox_company  		= $(".checkbox_company").val();
			checkbox_out_of_stock 	= $(".checkbox_out_of_stock").val();
			
			checkbox_medicine_val = checkbox_company_val = checkbox_out_of_stock_val = 0;
			checkbox_out_of_stock_val = 1; // yha default ha
			if($(".checkbox_medicine").prop("checked") == true){
                checkbox_medicine_val = 1;
            }
			if($(".checkbox_company").prop("checked") == true){
                checkbox_company_val = 1;
            }
			if($(".checkbox_out_of_stock").prop("checked") == true){
                checkbox_out_of_stock_val = 1;
				//console.log(checkbox_out_of_stock_val)
            }
			
			$(".background_blur").show();
			$(".search_medicine_result").show();
			$(".search_medicine_result").html('<div class="row p-2" style="background:var(--main_theme_white_background_color);"><div class="col-sm-12 text-center"><h1><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px"></h1><h1>Loading....</h1></div></div>');
			$(".header_result_found").html("Loading....");
			$.ajax({
			type       : "POST",
			dataType   : "json",
			data       :  {keyword:keyword,total_rec:total_rec,checkbox_medicine_val:checkbox_medicine_val,checkbox_company_val:checkbox_company_val,checkbox_out_of_stock_val:checkbox_out_of_stock_val} ,
			url        : "<?php echo base_url(); ?>medicine_search/medicine_search_api",
			cache	   : true,
			error: function(){
				$(".search_medicine_result").html('<h1><img src="<?= base_url(); ?>img_v51/something_went_wrong.png" width="100%"></h1>');
				$(".header_result_found").html("No record found");
			},
			success    : function(data){
				if(data.items=="")
				{
					$(".search_medicine_result").html('<div class="row p-2" style="background:var(--main_theme_white_background_color);"><div class="col-sm-12 text-center"><h1><img src="<?= base_url(); ?>/img_v51/no_record_found.png" width="100%"></h1></div></div>');
					$(".header_result_found").html("No record found");
				}
				else
				{
					$(".search_medicine_result").html("");
					$(".header_result_found").html("Found result");
				}
				$.each(data.items, function(i,item){
						if (item)
						{
							new_i 				= item.item_count;
							item_code			= item.item_code;
							item_image			= item.item_image;
							item_name 			= item.item_name;
							item_packing 		= item.item_packing;
							item_expiry 		= item.item_expiry;
							item_company 		= item.item_company;
							item_quantity 		= item.item_quantity;
							item_stock 			= item.item_stock;
							item_ptr 			= item.item_ptr;
							item_mrp 			= item.item_mrp;
							item_price 			= item.item_price;
							item_scheme 		= item.item_scheme;
							item_margin 		= item.item_margin;
							item_featured 		= item.item_featured;
							item_description1 	= item.item_description;
							similar_items 		= item.similar_items;
							
							csshover1 = 'hover_'+new_i;

							div_all_data = "<div class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"'></div>"

							div_start = 'onClick=medicine_details_funcation("'+item_code+'"),clear_search_icon()';
							
							item_scheme_div = "";
							if(item_scheme!="0+0")
							{
								item_scheme_div =  ' | <span class="all_item_scheme">Scheme : '+item_scheme+'</span>';
							}

							item_other_image_div = '';
							if(item_featured=="1" && item_quantity!="0"){
								item_other_image_div = '<img src="<?= base_url() ?>img_v51/featured_img.png" class="all_item_featured_img" style="width:40px">';
							}

							item_quantity_div = '<span class="all_item_stock">Stock : '+item_quantity+'</span>' + item_scheme_div;
							if(item_stock!="")
							{
								item_quantity_div = '<span class="all_item_stock">'+item_stock+'</span>' + item_scheme_div;
							}

							if(item_quantity=="0"){
								item_quantity_div = '<span class="all_item_out_of_stock">Out of stock</span>';
								item_other_image_div = '<img src="<?= base_url() ?>img_v51/out_of_stock_img.png" class="all_item_out_of_stock_img" style="width:40px">';
							}
							
							rete_div =  '<span class="all_item_ptr" title="PTR : '+item_ptr+'">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/- </span> | <span class="all_item_mrp" title="MRP : '+item_mrp+'">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/- </span> | <span class="all_item_price" title="*Approximate ~ '+item_price+'">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/- </span>';							

							$(".search_medicine_result").append('<div class="main_theme_li_bg '+csshover1+' medicine_details_funcation_'+new_i+'" '+div_start+'><div class="medicine_search_div1">'+item_other_image_div+'<img src="'+item_image+'" alt="'+item_name+'" onerror="setDefaultImage(this);" class="all_item_image"></div><div class="medicine_search_div2"><div class="all_item_name">'+item_name+'<span class="all_item_packing mobile_off"> ('+item_packing+' Packing)</span></div><div class="all_item_packing mobile_show">'+item_packing+' Packing</div><div class=""><span class="all_item_margin">'+item_margin+'% Margin* </span>| <span class="all_item_expiry">Expiry : '+item_expiry+'</span></div><div class="all_item_company">By '+item_company+'</div><div>'+item_quantity_div+'</div><div class="mobile_off">'+rete_div+'</div></div><div class="medicine_search_full_width mobile_show" style="margin-left:5px;">'+rete_div+'</div><div class="medicine_search_full_width medicine_cart_item_description1">'+item_description1+'</div><div class="medicine_search_full_width medicine_cart_item_similar_items"><a href="<?= base_url();?>home/medicine_category/medicine_similar/'+item_code+'">'+similar_items+'</a></div></div>'+div_all_data);
				
							$(".search_pg_result_found").html("Search result");	
							$(".headertitle").html("Search medicines ("+new_i+")");
							
							if(new_i=="50")
							{
								$(".search_medicine_result").append('<div style="color: green;font-weight: bold;margin: 10px" class="text-center"><a href="<?= base_url();; ?>/home/search_view_all?keyword='+keyword+'">View All</a></div>');
							}
						}						
					});
				},
				timeout: 60000
			});
		}
		else{
			$(".menu_search_icon").hide();
			$(".menu_search_icon_box").hide();
			$(".clear_search_icon").hide();
			$(".search_medicine_result").html("");
		}
	}
}
/*****************************************/
function get_medicine_favourite()
{
	//$('.get_medicine_favourite_div').html('');
	id = "";
	$.ajax({
		url: "<?php echo base_url(); ?>medicine_details/get_medicine_favourite_api",
		type	:"POST",
		dataType: "json",
		cache: true,
		data: {id:id},
		error: function(){
			$(".get_medicine_favourite_div").html('<h1><img src="<?= base_url(); ?>img_v51/something_went_wrong.png" width="100%"></h1>');
		},
		success: function(data){
			if(data.items=="")
			{
				$(".get_medicine_favourite_div").html('');
			}
			else
			{
				$(".get_medicine_favourite_div").html("");
			}
			$.each(data.items, function(i,item){
				if (item)
				{
					item_code			= item.item_code;
					item_image			= item.item_image;
					item_name 			= item.item_name;
					item_packing 		= item.item_packing;
					item_expiry 		= item.item_expiry;
					item_company 		= item.item_company;
					item_quantity 		= item.item_quantity;
					item_stock 			= item.item_stock;
					item_ptr 			= item.item_ptr;
					item_mrp 			= item.item_mrp;
					item_price 			= item.item_price;
					item_scheme 		= item.item_scheme;
					item_margin 		= item.item_margin;
					item_featured 		= item.item_featured;
					item_description1 	= item.item_description1;
					similar_items 		= item.similar_items;
					

					div_all_data = "<div class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"'></div>"
					
					$(".get_medicine_favourite_div").append('<a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')" style="text-decoration: none;"><div class="main_theme_li_bg"><div class="favourite_medicines_div1"><img src="'+item_image+'" style="width: 100%;cursor: pointer;" class="all_item_image" onclick="medicine_details_funcation('+item_code+')" onerror="setDefaultImage(this);"></div><div class="favourite_medicines_div2"><div class="text-capitalize all_item_name">'+item_name+'</div><div class="text-left all_item_order_quantity">Last order quantity : '+item_quantity+'</div></div></div></a>'+div_all_data);
				}
			});
		},
		timeout: 10000
	});
}
</script>
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
$(".headertitle").html("My cart");
function goBack() {
	window.location.href = "<?= base_url();?>search_medicine";
}
</script>
<div style="width:100%;display:none;padding-top: 150px;" class="loading_pg">
	<h1 class="text-center">
		<img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px" alt="Loading...." title="Loading....">
	</h1>
	<h1 class="text-center">Loading....</h1>
	<h1 class="text-center">Please wait, Your order is under process.</h1>
</div>
<div class="container-fluid maincontainercss">
	<div class="row">
		<div class="col-sm-6 col-6 current_order_search_page1 mobile_off">
			<h6 class="search_pg_title_color Current_Order">
				My cart <span class="div_cart_total_items1"></span>
			</h6>
		</div>
		<div class="col-sm-6 col-6 text-right current_order_search_page1 mobile_off" style="margin-bottom:5px;">
			<a href="#" onclick="delete_all_medicine()" tabindex="-10" class="cart_delete_btn delete_all_btn" title="Delete all medicine"> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete all <span class="mobile_off">medicines</span></a>
		</div>
		<div class="col-sm-12 col-12">
			<div class="website_box_part p-2">
				<span class="my_cart_api_div"></span>
			</div>
		</div>
		<div class="col-sm-3 col-8 text-left">
			<a href="<?=base_url();?>home/search_medicine" class="btn mainbutton" style="margin-top:10px;"> 
				+ Add new medicine
			</a>
		</div>
		<div class="col-sm-1"></div>
	</div>
</div>
<div class="place_order_or_empty_cart_btn_div">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">	
				<strong style="color:red" class="place_order_message">
				</strong>
			</div>
			<div class="col-5 text-center">				
				<div class="div_cart_total_items">Cart is empty</div>
				<div class="div_cart_total_price"><i class="fa fa-inr"></i>0.00</div>
			</div>
			<div class="col-7 text-center">
				<span class="cart_empty_cart_div">
					<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px;display:none" id="order_loading"></i><button class="btn mainbutton_disable" onclick="cart_empty_btn()" tabindex="-3" title="Cart Is Empty">Cart is empty</button>
				</span>
				<span class="cart_disabled_cart_div" style="display:none">
					<em class="fa fa-circle-o-notch fa-spin" style="font-size:24px;display:none" id="order_loading"></em><button class="btn mainbutton_disable" tabindex="-3" title="Can't place order">Can't place order</button>
				</span>
				<span class="place_order_div" style="display:none">
					<em class="fa fa-circle-o-notch fa-spin" style="font-size:24px;display:none" id="order_loading"></em><button class="btn mainbutton" onclick="place_order_model()" tabindex="-3" title="Place order">Place order</button>
				</span>
			</div>
		</div>
	</div>
</div>
<button type="button" class="place_order_model" data-toggle="modal" data-target="#myModal_place_order" style="display:none"></button>
<!-- The Modal -->
<div class="modal" id="myModal_place_order">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Enter a remark</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-times modal_cancel_btn" aria-hidden="true"></i>
				</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<div class="form-check" style="display:none;">
					<label class="form-check-label">
					<input type="radio" class="form-check-input" name="optradio" id="slice_type0" onclick="slice_type_change('0')" checked>Complete one order
					</label>
				</div>
				<?php /*
				<div class="form-check">
					<label class="form-check-label">
					<input type="radio" class="form-check-input" name="optradio" id="slice_type1" onclick="slice_type_change('1')">Break by Amount
					</label>
				</div>
				<div class="form-check disabled">
					<label class="form-check-label">
					<input type="radio" class="form-check-input" name="optradio" id="slice_type2" onclick="slice_type_change('2')">Break by Line Quantity
					</label>
					<input type="hidden" class="form-control" id="slice_type" value="0" />
				</div>*/ ?>
				<div class="form-group slice_item1_div" style="display:none">
					<label>Break by Amount</label>
					<select class="form-control" id="slice_item1">
						<option value="9000">9000</option>
						<option value="19000">19000</option>
						<option value="49000">49000</option>
						<option value="99000">99000</option>
						<option value="199000">199000</option>
					</select>
				</div>
				<div class="form-group slice_item2_div" style="display:none">
					<label>Break by Line Quantity</label>
					<select class="form-control" id="slice_item2">
						<option value="10">10</option>
						<option value="20">20</option>
						<option value="40">40</option>
						<option value="100">100</option>
					</select>
				</div>
				<div class="form-group">
					<textarea class="" id="remarks" rows="5" placeholder="Enter a remark" style="border-style: solid !important;border-color: #e0e0e0 !important;border-width: 1px !important;border-radius:10px;width: 100%;padding:10px;"></textarea>
				</div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn mainbutton" data-dismiss="modal" onclick="place_order_complete()">Place order</button>
			</div>
		</div>
	</div>
</div>
<script>
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
$(document).ready(function(){
	setTimeout('my_cart_page_load();',100);
});
function my_cart_page_load()
{
	my_cart_api();
	//place_order_or_empty_cart_btn();
}

// function my_cart_api_div()
// {
// 	$(".header_result_found").html("Loading....");
// 	$(".my_cart_api_div_div").html('<h1><center><img src="<?= base_url(); ?>/img_v51/loading.gif" width="100px"></center></h1><h1><center>Loading....</center></h1>');
// 	id = "";
// 	$.ajax({
// 		url: "<?php echo base_url(); ?>my_cart/my_cart_api",
// 		type	   :"POST",
// 		dataType   : "json",
// 		cache: true,
// 		data: {id:id},
// 		error: function(){
// 			$(".my_cart_api_div_div").html('<h1><img src="<?= base_url(); ?>img_v51/something_went_wrong.png" width="100%"></h1>');
// 		},
// 		success: function(data){
// 			if(data.items=="")
// 			{
// 				$(".my_cart_api_div_div").html('<h1><center><img src="<?= base_url(); ?>/img_v51/cartempty.png" width="30%"></center></h1>');
// 				$(".delete_all_btn").hide();
// 			}
// 			else
// 			{
// 				$(".my_cart_api_div_div").html("");
// 				$(".delete_all_btn").show();
// 			}
// 			$.each(data.items, function(i,item){
// 				if (item)
// 				{
// 					item_code			= item.item_code;
// 					item_image			= item.item_image;
// 					item_name 			= item.item_name;
// 					item_packing 		= item.item_packing;
// 					item_expiry 		= item.item_expiry;
// 					item_company 		= item.item_company;
// 					item_quantity 		= item.item_quantity;
// 					item_stock 			= item.item_stock;
// 					item_ptr 			= item.item_ptr;
// 					item_mrp 			= item.item_mrp;
// 					item_price 			= item.item_price;
// 					item_scheme 		= item.item_scheme;
// 					item_margin 		= item.item_margin;
// 					item_featured 		= item.item_featured;
// 					item_description1 	= item.item_description1;
// 					similar_items 		= item.similar_items;
// 					//new add for last order qty
// 					item_order_quantity = item.item_order_quantity;
// 					div_all_data = "<div class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"' item_order_quantity='"+item_order_quantity+"'></div>";
					
// 					item_id 			= item.item_id;
// 					item_quantity_price = item.item_quantity_price;
// 					item_datetime 		= item.item_date_time;
// 					item_modalnumber 	= item.item_modalnumber;
// 					error_img ="onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'"
// 					item_other_image_div = '';
// 					if(item_featured=="1"){
// 						item_other_image_div = '<img src="<?= base_url() ?>img_v51/featured_img.png" class="medicine_cart_item_featured_img">';
// 					}
// 					image_div = item_other_image_div+'<img src="'+item_image+'" style="width: 100%;" class="medicine_cart_item_image" '+error_img+'>';
// 					item_scheme_div = "";
// 					if(item_scheme!="0+0")
// 					{
// 						item_scheme_div =  ' | <span class="medicine_cart_item_scheme" title="'+item_name+' '+item_scheme+'">Scheme : '+item_scheme+'</span>';
// 					}

// 					rate_div = '<div class="cart_ki_main_div3"><span class="all_item_price" title="*Approximate ~">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</span> | <span class="all_item_price2">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_quantity_price+'/-</span></div><div class="cart_ki_main_div3"><span class="all_item_datetime">'+item_modalnumber+' | '+item_datetime+'</span><span style="float:right;"><a href="javascript:delete_medicine('+item_code+')" tabindex="-10" title="Delete '+item_name+'"><i class="fa fa-trash-o cart_new_btn_color_css" aria-hidden="true" style="margin-right:5px;"></i></a>&nbsp;<a href="javascript:medicine_details_funcation('+item_code+')" tabindex="-10" title="Edit '+item_name+'" class="edit_item_focues'+item_code+'"><i class="fa fa-pencil cart_new_btn_color_css" aria-hidden="true"></i></a>&nbsp;&nbsp;</div>';
					
// 					$(".my_cart_api_div_div").append('<div class="main_theme_li_bg"><div class="medicine_cart_div1">'+image_div+'</div><div class="medicine_cart_div2"><div class="all_item_name" title="'+item_name+'">'+item_name+' <span class="all_item_packing">('+item_packing+' Packing)</span></div><div class="all_item_expiry">Expiry : '+item_expiry+'</div><div class="all_item_company">By '+item_company+'</div><div class="text-left all_item_order_quantity" title="'+item_name+' Quantity: '+item_order_quantity+'" >Order quantity : '+item_order_quantity+item_scheme_div+'</div><span class="mobile_off">'+rate_div+'</span></div><span class="mobile_show" style="margin-left:5px;">'+rate_div+'</span></div>'+div_all_data);
// 				}
// 			});
// 			$.each(data.items_other, function(i,item){
// 				if (item)
// 				{
// 					items_price = item.items_price;
// 					items_total = item.items_total;
// 					status = item.status;
// 					status_message = item.status_message;
// 					$(".div_cart_total_price").html('<i class="fa fa-inr"></i>'+items_price+'/-');
// 					$(".div_cart_total_items").html("My Cart ("+items_total+")");
// 					$(".div_cart_total_items1").html("("+items_total+")");
// 					$(".header_cart_span").html(items_total);
// 					$(".place_order_message").html(status_message);
// 					$(".header_result_found").html("Current order ("+items_total+")");
// 					if(items_total==0)
// 					{
// 						$(".cart_empty_cart_div").show();
// 						$(".cart_add_to_cart_div").hide();
// 						$(".cart_disabled_cart_div").hide();
// 						$(".place_order_div").hide();
// 					}
// 					if(items_total!=0)
// 					{
// 						$(".cart_add_to_cart_div").show();
// 						if(status==1)
// 						{
// 							$(".cart_empty_cart_div").hide();
// 							$(".cart_disabled_cart_div").hide();
// 							$(".place_order_message").html('');
// 							$(".place_order_div").show();
// 						}
// 						else{
// 							$(".cart_empty_cart_div").hide();
// 							$(".cart_disabled_cart_div").show();
// 							$(".place_order_div").hide();
// 						}
// 					}
// 				}
// 			});
// 		},
// 		timeout: 60000
// 	});
// 	setTimeout('my_cart_api_div();',120000);
// }
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
	$(".loading_pg").show();
	$(".maincontainercss").hide();
	$(".place_order_or_empty_cart_btn_div").hide();
	$.ajax({
		type       : "POST",
		dataType   : "json",
		data       :  {remarks:remarks},
		url        : "<?php echo base_url(); ?>my_cart/place_order_api",
		cache	   : true,
		error: function(){
			//window.location.href = "<?= base_url();?>my_cart";
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
						$(".loading_pg").html("<h1 class='text-center'>"+status_message+"</h1><h1 class='text-center'><input type='submit' value='Go home' class='btn mainbutton' name='Go home' onclick='gohome()' style='width:50%;margin-top:100px;'></h1>");
				    }
					count_temp_rec();
				}
			});
		},
		timeout: 60000
	});
}
function gohome()
{
	window.location.href= "<?= base_url() ?>";
}
</script>
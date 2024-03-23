<?php if(!empty($chemist_id)){ ?>
<style>
.top_bar_title{
	margin-top: -5px;
}
</style>
<script>
$(".top_bar_title1").show();
</script>
<?php } ?>
<script>
$(".top_bar_title").html("Upload order");
function goBack() {
	window.location.href = "<?= base_url();?>import_order";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-12 col-12">
			<?php
			$lastcount=0;
			$j = 0;
			foreach($result as $row)
			{
				$item_name 	= ucwords(strtolower($row->item_name));
				if(!empty($item_name))
				{
					$item_qty 	= $row->quantity;
					$item_mrp 	= $row->mrp;
					$i          = $row->id; 
					$j++;
					?>
					<input type="hidden" value="<?= $item_name ?>" class="your_item_name_<?= $i ?>">
					<input type="hidden" value="<?= $item_mrp ?>" class="your_item_mrp_<?= $i ?>">
					<input type="hidden" value="<?= $item_qty ?>" class="your_item_qty_<?= $i ?>">
					<div class="row main_box_div_data remove_css_<?= $i ?> import_order_td_<?= $i ?> p-1">
						<div class="col-sm-10">
							(<?= $j ?>)
							
							<?= $myname;?> : 
							<span class="import_order_title_1 all_item_name">
								<?= $item_name; ?>
							</span> | 
							
							<span class="all_item_order_quantity">Quantity : </span>

							<input type="number" name="item_qty[]" value="<?= $item_qty ?>" class="item_qty_<?= $i ?> medicine_details_item_order_quantity_textbox" style="width:100px;" placeholder="Eg 1,2" onchange="change_order_quantity('<?= $i; ?>')" title="Order quantity" min="1" max="1000" maxlength="4" />

							<span class="cart_delete_btn_<?= $i ?>">											
								<a href="javascript:void(0)" onclick="delete_row_medicine('<?= $i; ?>')" title="Delete medicine" class="import_order_delete_btn"><i class="fa fa-trash-o" aria-hidden="true" style="margin-right:5px;"></i> Delete</a>
							</span>
						</div>
						<div class="col-sm-2 text-right">
							<span class="all_item_mrp">MRP. : 
								<i class="fa fa-inr" aria-hidden="true"></i>
								<?= number_format($item_mrp,2) ?>/-
							</span>					
						</div>

						<div class="col-sm-12 all_item_hr select_product_<?= $i ?>" style="display:none">
							<div class="import_order_box_left_div">
								<img src="<?=base_url(); ?>img_v51/logo2.png" width="60px;" class="image_css_<?= $i ?> all_item_image" alt="" onerror="this.src='<?= base_url(); ?>/uploads/default_img.jpg'">
							</div>

							<div class="import_order_box_right_div">
								<div class="row">
									<div class="col-sm-8">
										Found : 
										<span class="all_item_name selected_item_name_<?= $i ?>"></span>

										<span class="all_item_packing">
											(<span class="selected_packing_<?= $i ?>"></span> Packing) 
										</span> - 

										<span class="all_item_expiry expiry_css_<?= $i ?>"> 
											Expiry : <span class="selected_expiry_<?= $i ?>"></span>
										</span>
									</div>
									<div class="col-sm-4 text-right">
										<span class="all_item_ptr">
											PTR : <i class="fa fa-inr" aria-hidden="true"></i> 
											<span class="selected_sale_rate_<?= $i ?>">0.00</span>/-
										</span> | 

										<span class="all_item_mrp">
											MRP. : <i class="fa fa-inr" aria-hidden="true"></i> <span class="selected_mrp_<?= $i ?>">0.00</span>/- 
										</span>
									</div>

									<div class="col-sm-12 all_item_hr"></div>

									<div class="col-sm-7">
										<span class="all_item_company">
											By : <span class="selected_company_full_name_<?= $i ?>"></span>
										</span> |  

										<span class="all_item_batch_no"> Batch no : 
											<span class="selected_batch_no_<?= $i ?>"></span>
										</span>

										<span class="select_product_<?= $i ?> selected_scheme_span_<?= $i ?>"> | 
											<span class="all_item_scheme selected_scheme_<?= $i ?>"></span>
										</span>
									</div>
									<div class="col-sm-5 text-right">
										<span class="all_item_stock">
											Stock : <span class="selected_batchqty_<?= $i ?>"></span>
										</span> | 

										<span class="all_item_price">
											*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> 
											<span class="selected_final_price_<?= $i ?>">0.00</span>/-
										</span>
									</div>							
							
									<div class="col-sm-12 all_item_hr">
										<span class="cart_description1 selected_msg_<?= $i ?>"> Loading.... </span>
										<span class="selected_SearchAnotherMedicine_<?= $i ?>" style="display:none">
											<a href="javascript:change_medicine('<?= $i ?>')" class="all_item_edit_btn" title="Change medicine">
											<img src="<?= base_url(); ?>img_v51/edit_icon.png" width="18px;" alt="Change Medicine">
												Change medicine
											</a>
										</span>
										<span class="selected_suggest_<?= $i ?>" style="display:none">
										|
											<a href="javascript:delete_suggested_medicine('<?= $i ?>')" title="Delete suggested medicine" class="import_order_delete_btn"><i class="fa fa-trash-o" aria-hidden="true" style="margin-right:5px;"></i>Delete suggest</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php /***main result show hear*/ ?>
					<span class="insert_main_row_data_<?= $i ?>"></span>
					<?php
					$lastcount++;
				}
			}
			?>
		</div>
		<div class="col-sm-6 col-6 text-left">
			<button type="submit" class="btn btn-primary main_theme_button next_btn" name="submit" value="submit" onclick="add_new_medicine()" style="width:30%"> + Add Medicine</button>
		</div>
		<div class="col-sm-6 col-6 text-right">
			<a href="<?= base_url(); ?>import_order/medicine_deleted_items/<?php echo base64_encode($order_id); ?>">
				<button type="submit" class="btn btn-primary main_theme_button next_btn" name="submit" value="submit" style="width:20%">Next</button>
			</a>
		</div>
		<div class="col-sm-12 col-12 col-padding-5 web-col-padding-5 mt-3">
			<div class="main_box_div2">
				<span class="my_cart_api_div_inport_order"></span>
			</div>
		</div>		
	</div>     
</div>
<input type="hidden" class="_row_id">
<div class="background_blur" onclick="clear_search_icon()" style="display:none"></div>
<div class="script_css"></div>
<input type="hidden" value="<?php echo time(); ?>" class="mytime">
<input type="hidden" value="" class="new_import_page_item_name">
<input type="hidden" value="" class="new_import_page_item_mrp">
<script>
function insert_main_row_data(row_id)
{
	item_name = $(".your_item_name_"+row_id).val();
	item_mrp  = $(".your_item_mrp_"+row_id).val();
	item_qty  = $(".your_item_qty_"+row_id).val();
	mytime = $(".mytime").val();
	$.ajax({
		type       : "POST",
		data       :  {row_id:row_id} ,
		url        : "<?= base_url(); ?>import_order/insert_main_row_data",
		cache	   : false,
		error: function(){
			$(".selected_msg_"+cssid).html("Server not Responding, Please try Again");
		},
		success    : function(data){
			$(".insert_main_row_data_"+row_id).html(data);
		}
	});
}
function change_order_quantity(row_id)
{
	quantity  = $(".item_qty_"+row_id).val();
	$.ajax({
		type       : "POST",
		data       :  {row_id:row_id,quantity:quantity} ,
		url        : "<?= base_url(); ?>import_order/change_order_quantity",
		cache	   : false,
		error: function(){
			swal("Quantity not updated");
		},
		success    : function(data){
			$.each(data.items, function(i,item){	
				if (item)
				{
					if(item.status=="1")
					{
						$(".your_item_qty_"+row_id).val(quantity);
						swal("Quantity updated successfully");
						setTimeout(insert_main_row_data(row_id),500);
					}
					else{
						swal("Quantity not updated");
					}
				}
			});
		},
		timeout: 10000
	});
}
function delete_row_medicine(row_id)
{
	swal({
		title: "Are you sure to delete medicine?",
		/*text: "Once deleted, you will not be able to recover this imaginary file!",*/
		icon: "warning",
		buttons: ["No", "Yes"],
		dangerMode: true,
	}).then(function(result) {
		if (result) {
			$.ajax({
				type       : "POST",
				data       : {row_id:row_id,} ,
				url        : get_base_url() + "import_order/delete_row_medicine",
				cache	   : false,
				error: function(){
					swal("Medicine not deleted");
				},
				success    : function(data){
					$.each(data.items, function(i,item){	
						if (item)
						{
							if(item.status=="1")
							{
								$(".remove_css_"+row_id).hide();
								$(".remove_css_"+row_id).html('');
								swal("Medicine deleted successfully", {
									icon: "success",
								});
							}
							else{
								swal("Medicine not deleted");
							}
						} 
					});
				},
				timeout: 60000
			});
		} else {
			swal("Medicine not deleted");
		}
	});
}
function delete_suggested_medicine(row_id)
{
	swal({
		title: "Are you sure to delete suggested medicine?",
		/*text: "Once deleted, you will not be able to recover this imaginary file!",*/
		icon: "warning",
		buttons: ["No", "Yes"],
		dangerMode: true,
	}).then(function(result) {
		if (result) {
			$.ajax({
				url: get_base_url() + "import_order/delete_suggested_medicine",
				type:"POST",
				/*dataType: 'html',*/
				data: {row_id:row_id,user_altercode:'<?= $chemist_id ?>'},
				error: function(){
					swal("Suggested medicine not deleted");
				},
				success: function(data){
					$.each(data.items, function(i,item){	
						if (item)
						{
							if(item.status=="1")
							{
								swal("Suggested Medicine deleted successfully", {
									icon: "success",
								});
								$('.selected_suggest_'+row_id).hide();
								insert_main_row_data(row_id)
							}
							else{
								swal("Suggested medicine not deleted");
							}
						} 
					});
				},
				timeout: 60000
			});
		} else {
			swal("Suggested medicine not deleted");
		}
	});
}
/*************************************/
function change_medicine(row_id) {

	$('.medicine_search_textbox').val("");
	$('.medicine_search_textbox').show();
	$('.medicine_search_textbox').focus();
	
	$(".background_blur").show();

	$("._row_id").val(row_id);
	item_name = $(".your_item_name_"+row_id).val();
	setTimeout($('.medicine_search_textbox').val(item_name),500);
	setTimeout(search_medicine(),1000);
}
function clear_search_function() {

	$(".background_blur").hide();

	$(".search_result_div").html("");
	$(".search_result_div").hide();

	$(".search_result_div_mobile").html("");
	$(".search_result_div_mobile").hide();	

	$(".medicine_search_textbox").val("");
	$('.medicine_search_textbox').focus();

	$(".top_bar_search_textbox_div_menu_icon").hide();
	$(".top_bar_search_textbox_div_menu").hide();

	$(".top_bar_search_textbox_div_clear_icon").hide();	

	$(".my_cart_api_div_mobile").hide();
		
	i = $("._row_id").val();
	$(".item_qty_"+i).focus();
}

function cart_page_load(){

	$(".top_bar_search_div").hide();
	$(".top_bar_search_textbox_div").show();

	$('.medicine_search_textbox').val("");
	$('.medicine_search_textbox').show();
	$('.medicine_search_textbox').focus();

	my_cart_api();
}

$(document).ready(function(){
	$(".medicine_search_textbox").keyup(function(e){
		if(e.keyCode == 8)
		{
			var keyword = $(".medicine_search_textbox").val();
			if(keyword!="")
			{
				if(keyword.length<3)
				{
					$('.medicine_search_textbox').focus();
					$(".search_result_div").html("");
					$(".search_result_div_mobile").html("");
				}
			}
			else{
				clear_search_function();
			}
		}
	})  
	$(".medicine_search_textbox").keypress(function() { 
		var keyword = $(".medicine_search_textbox").val();
		//$('.headertitle').html(keyword)
		if(keyword!="")
		{
			if(keyword.length<3)
			{
				$('.medicine_search_textbox').focus();
				$(".search_result_div").html("");
				$(".search_result_div_mobile").html("");
			}
			if(keyword.length>2)
			{
				//medicine_search_api();
				setTimeout('medicine_search_api();',500);
			}
		}
		else{
			clear_search_function();
		}
	});
	$(".medicine_search_textbox").change(function() { 
	});
	$(".medicine_search_textbox").on("search", function() { 
	});
	
    $(".medicine_search_textbox").keydown(function(event) {
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
			clear_search_function();
		}
	};
});

function page_up_down_arrow(new_i)
{
	$('.hover_'+new_i).keypress(function (e) {
		 if (e.which == 13) {
			item_code = $(".medicine_details_funcation_"+new_i).attr("item_code");
			medicine_details_funcation(item_code);
			clear_search_function();
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
				var searchInput = $('.medicine_search_textbox');
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

function medicine_search_api() {
	new_i = 0;

	$(".my_cart_api_div_mobile").hide();
	
	$(".top_bar_search_textbox_div_menu_icon").show();
	$(".top_bar_search_textbox_div_clear_icon").show();

	var keyword = $(".medicine_search_textbox").val();
	if(keyword!="")
	{
		if(keyword=="#")
		{
			keyword = "k1k2k12k";
		}
		if(keyword.length>2)
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
			$(".top_bar_title2").html("Loading....");

			$(".search_result_div").show();
			$(".search_result_div").html('<div class="row"><div class="col-sm-12 text-center">'+loading_img_function()+'</div></div>');

			$(".search_result_div_mobile").show();
			$(".search_result_div_mobile").html('<div class="row"><div class="col-sm-12 text-center">'+loading_img_function()+'</div></div>');

			$.ajax({
				type       : "POST",
				data       :  {keyword:keyword,total_rec:total_rec,checkbox_medicine_val:checkbox_medicine_val,checkbox_company_val:checkbox_company_val,checkbox_out_of_stock_val:checkbox_out_of_stock_val} ,
				url        : "<?php echo base_url(); ?>medicine_search/medicine_search_api",
				error: function(){
					$(".search_medicine_result").html('<h1><img src="<?= base_url(); ?>img_v51/something_went_wrong.png" width="100%"></h1>');
				},
				cache	   : false,
				success    : function(data){
					if(data.items=="")
					{
						$(".search_medicine_result").html('<div class="row p-2" style="background:white;"><div class="col-sm-12 text-center"><h1><img src="<?= base_url(); ?>/img_v51/no_record_found.png" width="100%"></h1></div></div>');
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
							
							div_all_data = "<div class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"'></div>"
							
							item_scheme_div = "";
							if(item_scheme!="0+0")
							{
								item_scheme_div =  ' | <span class="all_item_scheme">Scheme : '+item_scheme+'</span>';
							}

							item_other_image_div = '';
							if(item_featured=="1" && item_quantity!="0"){
								item_other_image_div = '<img src="'+ get_base_url()+'img_v51/featured_img.png" class="all_item_featured_img">';
							}

							item_quantity_div = '<span class="all_item_stock">Stock : '+item_quantity+'</span>' + item_scheme_div;
							if(item_stock!="")
							{
								item_quantity_div = '<span class="all_item_stock">'+item_stock+'</span>' + item_scheme_div;
							}

							if(item_quantity=="0"){
								item_quantity_div = '<span class="all_item_out_of_stock">Out of stock</span>';
								item_other_image_div = '<img src="'+ get_base_url()+'img_v51/out_of_stock_img.png" class="all_item_out_of_stock_img">';
							}
							
							rete_div =  '<span class="all_item_ptr" title="PTR : '+item_ptr+'">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/- </span> | <span class="all_item_mrp" title="MRP : '+item_mrp+'">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/- </span> | <span class="all_item_price" title="*Approximate ~ '+item_price+'">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/- </span>';

							/*************************************************************** */
							onlcick_event = 'onClick=change_medicine_2("'+item_code+'"),clear_search_icon()';
							/*************************************************************** */
							var serach_data = '<div class="main_box_div_data hover_'+new_i+' medicine_details_funcation_'+new_i+'" '+onlcick_event+' item_code="'+item_code+'"><div class="medicine_search_box_left_div">'+item_other_image_div+'<img class="all_item_image" src="'+default_img+'" alt="'+item_name+'"><img class="all_item_image_load" src="'+item_image+'" alt="'+item_name+'" onload="showActualImage(this)" onerror="setDefaultImage(this);"></div><div class="medicine_search_box_right_div"><div class="all_item_name">'+item_name+'<span class="all_item_packing mobile_off"> ('+item_packing+' Packing)</span></div><div class="all_item_packing mobile_show">'+item_packing+' Packing</div><div class=""><span class="all_item_margin">'+item_margin+'% Margin* </span>| <span class="all_item_expiry">Expiry : '+item_expiry+'</span></div><div class="all_item_company">By '+item_company+'</div><div>'+item_quantity_div+'</div><div class="mobile_off">'+rete_div+'</div></div><div class="medicine_search_full_width mobile_show" style="margin-left:5px;">'+rete_div+'</div><div class="medicine_search_full_width all_item_description1">'+item_description1+'</div><div class="medicine_search_full_width medicine_cart_item_similar_items"><a href="'+get_base_url()+'medicine_category/medicine_similar/'+item_code+'">'+similar_items+'</a></div></div>'+div_all_data;

							$(".search_result_div").append(serach_data);
							$(".search_result_div_mobile").append(serach_data);
				
							$(".top_bar_title2").html("Found result ("+new_i+")");
							
							if(new_i=="50")	{
								$(".search_result_div").append('<div style="color: green;font-weight: bold;margin: 10px" class="text-center"><a href="'+ get_base_url()+'home/search_view_all?keyword='+keyword+'">View All</a></div>');
								$(".search_result_div_mobile").append('<div style="color: green;font-weight: bold;margin: 10px" class="text-center"><a href="'+ get_base_url()+'home/search_view_all?keyword='+keyword+'">View All</a></div>');
							}
						}
					});
				},
				timeout: 60000
			});
		}
		else{
			$(".clear_search_icon").hide();
			$(".search_medicine_result").html("");
		}
	}
}
function page_up_down_arrow(new_i)
{
	$('.hover_'+new_i).keypress(function (e) {
		 if (e.which == 13) {
			$('.get_single_medicine_info_'+new_i).click();
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
function add_new_medicine()
{
	clear_search_icon();
	$(".select_medicine").focus();
	$(".background_blur").show();
	$(".clear_search_icon").show();
}
function change_medicine_2(item_code)
{	
	row_id = $("._row_id").val();
	if(row_id!="")
	{
		$.ajax({
			url: "<?php echo base_url(); ?>import_order/change_medicine_2",
			type:"POST",
			/*dataType: 'html',*/
			data: {item_code:item_code,row_id:row_id},
			error: function(){
				swal("Medicine not changed");
			},
			success: function(data){
					$.each(data.items, function(i,item){	
					if (item)
					{
						if(item.status=="1")
						{
							setTimeout(insert_main_row_data(row_id),200);
							swal("Medicine changed successfully", {
								icon: "success",
							});
							$("._row_id").val('');
						}
						else{
							swal("Medicine not changed");
						}
					} 
				});
			},
			timeout: 60000
		});
	}
	else{
		get_single_medicine_info(item_code);
	}
}
var js_i = "";
var js_j = "";
function add_new_row_import_order_page(item_code,item_order_quantity)
{
	if(js_i=="")
	{
		js_i = parseInt("<?= $i; ?>");
		js_j = parseInt("<?= $j; ?>");
	}
	
	js_i++;
	js_j++;
	<?php $myname = ""; ?>
	
	js1 = "javascript:change_medicine('"+js_i+"')";
	js2 = "javascript:delete_suggested_medicine('"+js_i+"')";
	item_image = $(".medicine_details_all_data_"+item_code).attr("item_image")
	item_name = $(".medicine_details_all_data_"+item_code).attr("item_name")
	item_mrp = $(".medicine_details_all_data_"+item_code).attr("item_mrp")
	$(".tbody_row").append('<tr class="remove_css_'+js_i+'"><td>'+js_j+'<input type="hidden" value="'+item_name+'" class="your_item_name_'+js_i+'"><input type="hidden" value="'+item_mrp+'" class="your_item_mrp_'+js_i+'"><input type="hidden" value="'+item_order_quantity+'" class="your_item_qty_'+js_i+'"></td><td class="import_order_td_'+js_i+'"><div class="row"><div class="col-sm-1"><img src="<?=base_url(); ?>img_v51/logo2.png" width="60px;" style="margin-top: 5px;" class="image_css_'+js_i+'" alt=""></div><div class="col-sm-11"><div class="row"><div class="col-sm-8"><span style="float:left;"><?= $myname;?> : <span class="import_order_title_1"> '+item_name+'</span> </span> <span style="float:left; margin-left:10px;margin-right:10px;" class="import_order_mrp"> | </span> <span style="float:left;"><a href="javascript:void(0)" onclick="delete_row_medicine('+js_i+')" title="Delete medicine" class="search_cart_delete_all_btn"> <i class="fa fa-trash-o" aria-hidden="true" style="margin-right:5px;"></i> Delete medicine</a> </span> </div> <div class="col-sm-4 text-right"> <span style="float:right;"> <div class="import_order_mrp">MRP. : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/-</div> </span> <span style="float:right; margin-left:10px;margin-right:10px;" class="import_order_mrp"> | </span> <span style="float:right;"> <input type="number" name="item_qty[]" value="'+item_order_quantity+'" class="form-control item_qty_'+js_i+'" style="width: 50px;height: 30px;font-size: 12px;padding: 3px;" onchange="change_order_quantity('+js_i+')" min="1" max="1000" /> </span> <span style="float:right;margin-right:5px;" class="cart_order_qty1"> Quantity : </span> </div> <div class="col-sm-12" style=" border-top-style: solid;border-top-color: #dee2e6;border-top-width: 1px;"></div> </div> <div class="row select_product_'+js_i+'" style="display:none"> <div class="col-sm-8"> DRD :  <span class="import_order_title selected_item_name_'+js_i+'"></span> <span class="import_order_packing"> (<span class="selected_packing_'+js_i+'"></span> Packing) </span> - <span class="import_order_expiry expiry_css_'+js_i+'"> Expiry : <span class="selected_expiry_'+js_i+'"></span></span> </div> <div class="col-sm-4 text-right"> <span class="import_order_stock"> Stock : <span class="selected_batchqty_'+js_i+'"></span></span> | <span class="import_order_mrp"> MRP. : <i class="fa fa-inr" aria-hidden="true"></i> <span class="selected_mrp_'+js_i+'">0.00</span>/- </span> </div>	<div class="col-sm-12" style=" border-top-style: solid;border-top-color: #dee2e6;border-top-width: 1px;"></div> <div class="col-sm-7"> <span class="import_order_company"> By : <span class="selected_company_full_name_'+js_i+'"></span></span> |  <span class="import_order_batch_no"> Batch No : <span class="selected_batch_no_'+js_i+'"></span></span> <span class="select_product_'+js_i+' selected_scheme_span_'+js_i+'"> |  <span class="import_order_scheme selected_scheme_'+js_i+'"></span> </span> </div> <div class="col-sm-5 text-right"> <span class="import_order_ptr"> PTR : <i class="fa fa-inr" aria-hidden="true"></i> <span class="selected_sale_rate_'+js_i+'">0.00</span>/-</span> | <span class="import_order_landing_price"> ~ Landing price : <i class="fa fa-inr" aria-hidden="true"></i> <span class="selected_final_price_'+js_i+'">0.00</span>/-</span> </div> </div> </div> <div class="col-sm-12" style=" border-top-style: solid;border-top-color: #dee2e6;border-top-width: 1px;"></div> <div class="col-sm-12"> <span class="selected_msg_'+js_i+'"> Loading.... </span> <span class="selected_SearchAnotherMedicine_'+js_i+'" style="display:none">  | <a href="'+js1+'" class="cart_delete_btn" title="Change medicine"> <img src="<?= base_url(); ?>img_v51/edit_icon.png" width="18px;" alt="Change medicine"> Change medicine </a> </span> <span class="selected_suggest_'+js_i+'" style="display:none"> | <a href="'+js2+'" title="Delete Suggest Medicine" class="search_cart_delete_all_btn"><i class="fa fa-trash-o" aria-hidden="true" style="margin-right:5px;"></i>Delete Suggest Medicine</a> </span> </div> </div> <span class="insert_main_row_data_'+js_i+'"></span> </td> </tr>');
	setTimeout("insert_main_row_data('"+js_i+"')",1000);
}
</script>
<script src="<?= base_url(); ?>assets/website/select_css/chosen.jquery.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/website/select_css/init.js" type="text/javascript" charset="utf-8"></script>
<?php
foreach($result as $row)
{ ?>
<script>
$(document).ready(function(){
	setTimeout("insert_main_row_data('<?php echo $row->id ?>')",500);
});
</script>
<?php 
} ?>
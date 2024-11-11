function import_order_medicine_change(item_id) {

	$(".top_bar_search_div").hide();
	$(".top_bar_search_textbox_div").show();

	$('.medicine_search_textbox').val("");
	$('.medicine_search_textbox').show();
	$('.medicine_search_textbox').focus();

	import_order_medicine_change_value = 1;
	hidden_item_id = item_id;
	hidden_item_name = $(".import_order_hidden_item_name_"+item_id).val();
	setTimeout($('.medicine_search_textbox').val(hidden_item_name),500);
	setTimeout(medicine_search_api(),700);
}

function import_order_medicine_change_api(selected_item_code){	

	item_id = hidden_item_id;
	hidden_item_code = $(".import_order_hidden_item_code_"+item_id).val();
	//hidden_item_code yha value wo ha jo davai ko kisi or ke sth set kar rhay ha to kam ati ha 
	if(item_id!=""){
		$.ajax({
			url: get_base_url() + "import_order_api/import_order_medicine_change_api",
			type:"POST",
			data: {item_id:item_id,item_code:hidden_item_code,selected_item_code:selected_item_code},
			cache : true,
			timeout: 60000,
			error: function(){
				swal("Medicine not changed");
			},
			success: function(data){
					$.each(data.items, function(i,item){	
					if (item)
					{
						if(item.status=="1")
						{
							swal("Medicine changed successfully", {
								icon: "success",
							});
							import_order_medicine_change_value = 0;
							process_find_medicine()
						}
						else{
							swal("Medicine not changed");
						}
					} 
				});
			}
		});
	}
	else{
		get_single_medicine_info(item_code); // yha popup modal open karta ha fir user add to cart kar skta ha 
	}
}
/************************************* */
function import_order_medicine_delete_suggested(item_id) {
	swal({
		title: "Are you sure to delete suggested medicine?",
		/*text: "Once deleted, you will not be able to recover this imaginary file!",*/
		icon: "warning",
		buttons: ["No", "Yes"],
		dangerMode: true,
	}).then(function(result) {
		if (result) {
			$.ajax({
				url: get_base_url() + "import_order_api/import_order_medicine_delete_suggested_api",
				type:"POST",
				data: {item_id:item_id},
				cache : true,
				timeout: 60000,
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
								process_find_medicine()
							}
							else{
								swal("Suggested medicine not deleted");
							}
						} 
					});
				}
			});
		} else {
			swal("Suggested medicine not deleted");
		}
	});
}

/*************************************/
function add_new_medicine() {
	clear_search_function();
	$('.medicine_search_textbox').focus();
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

	/**************************************** */
}
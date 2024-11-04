$(document).ready(function(){
	MainPageFuncationCall();
});

function MainPageFuncationCall() {
	/*********************************** */
	$(".top_bar_title2").html("Loading....");
	$(".main_container").show();
	$(".main_page_loading").show();
	$(".main_page_no_record_found").hide();
	$(".main_page_something_went_wrong").hide();
	/*********************************** */

	$.ajax({
		type: "POST",
		dataType: "json",
		data: { ItemId: ItemId },
		url: get_base_url() + "my_notification/my_notification_details_api",
		cache: false,
		error: function() {
			$(".top_bar_title2").html("No record found");
			$(".main_container").hide();
			$(".main_page_loading").hide();
			$(".main_page_something_went_wrong").show();
		},
		success: function(data) {
			$(".main_page_loading").hide();

			// Check if items are empty
			if (data.items === "") {
				$(".top_bar_title2").html("No record found");
				$(".main_container").hide();
				$(".main_page_no_record_found").show();
				return;
			}

			// Set title if available
			if (data.title !== "") {
				$(".top_bar_title2").html(data.title);
			}

			$.each(data.items, function(i, item) {
				if (item) {
					const item_id = item.item_id;
					const item_title = item.item_title;
					const item_message = item.item_message;
					const item_date_time = item.item_date_time;
					const item_image = item.item_image;
					let item_image2 = item.item_image2;
					const item_fun_type = item.item_fun_type;
					const item_fun_name = item.item_fun_name;
					const item_fun_id = item.item_fun_id;
					let item_fun_id2 = item.item_fun_id2 || "not";

					// Determine the function call URL
					let function_call = "#";
					switch (item_fun_type) {
						case "1":
							function_call = `javascript:${item_fun_name}('${item_fun_id}')`;
							break;
						case "2":
							function_call = `${get_base_url()}${item_fun_name}/${item_fun_id}/${item_fun_id2}`;
							break;
						case "3":
						case "4":
						case "5":
							function_call = `${get_base_url()}${item_fun_id}`;
							break;
					}

					// Optional second image
					item_image2 = item_image2 ? `<img src="${item_image2}" class="medicine_cart_item_image">` : "";

					// Append content using template literals
					$(".main_page_data").append(`
						<div class="main_box_div_data">
							<a href="${function_call}">
								<div class="all_page_details_page_box_left_div">
									<img src="${item_image}" alt="" title="" onerror="setDefaultImage(this);" class="all_item_image">
								</div>
								<div class="all_page_details_page_box_right_div text-left">
									<div class="medicine_cart_item_name">${item_title}</div>
									<div class="all_items_message">${item_message}</div>
									<div class="medicine_cart_item_date_time">${item_date_time}</div>
									<div class="medicine_cart_item_date_time">${item_image2}</div>
								</div>
							</a>
						</div>
					`);

					$(".main_page_data").show();
					$(".top_bar_title2").html(item_date_time);
				}
			});
		},
		timeout: 60000
	});
}

function callandroidfun(funtype, id, compname, image, division) {
	compname = funtype === "2" ? atob(compname) : compname; // Decode if funtype is 2
	switch (funtype) {
		case "1":
			android.fun_Get_single_medicine_info(id);
			break;
		case "2":
			android.fun_Featured_brand_medicine_division(id, compname, image, division);
			break;
		case "3":
			window.location.href = get_base_url() + "map";
			break;
		case "4":
			window.location.href = get_base_url() + "my_orders";
			break;
		case "5":
			window.location.href = get_base_url() + "my_invoice";
			break;
	}
}
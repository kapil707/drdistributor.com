function medicine_favourite_api() {
    $.ajax({
        url: get_base_url() + "medicine_details/medicine_favourite_api",
        type: "POST",
        dataType: "json",
        cache: true,
        timeout: 60000,
        error: function() {
            $(".get_medicine_favourite_api_div").html(something_went_wrong_function());
        },
        success: function(data) {
            $(".get_medicine_favourite_api_div").html(''); // Clear the container
            
            if (!data.items || data.items.length === 0) {
                // Display "no records found" if items array is empty
                $(".get_medicine_favourite_api_div").html(no_record_found_function());
                return;
            }

            $.each(data.items, function(i, item) {
                if (item) {
                    const item_code = item.item_code;
                    const item_image = item.item_image;
                    const item_name = item.item_name;
                    const item_quantity = item.item_quantity;

                    // Hidden div for holding all data attributes
                    const div_all_data = `
                        <div class='medicine_details_all_data_${item_code}' 
                             item_image='${item_image}' 
                             item_name='${item_name}' 
                             item_packing='N/a' 
                             item_batch_no='xxxxxx' 
                             item_expiry='00/00' 
                             item_company='N/a' 
                             item_quantity='0' 
                             item_stock='' 
                             item_ptr='0' 
                             item_mrp='0' 
                             item_price='0' 
                             item_gst='0' 
                             item_scheme='0+0' 
                             item_margin='0' 
                             item_featured='0' 
                             item_description1='' 
                             similar_items=''>
                        </div>`;

                    // Main box div for displaying favorite medicine details
                    const medicineHtml = `
                        <div class="main_box_div_data">
                            <a href="javascript:void(0)" onclick="get_single_medicine_info(${item_code})" style="text-decoration: none;">
                                <div class="favourite_medicines_box_left_div">
                                    <img class="all_item_image" src="${default_img}" alt="${item_name}">
                                    <img class="all_item_image_load" src="${item_image}" alt="${item_name}" onload="showActualImage(this)" onerror="setDefaultImage(this);">
                                </div>
                                <div class="favourite_medicines_box_right_div">
                                    <div class="text-capitalize all_item_name">${item_name}</div>
                                    <div class="text-left all_item_order_quantity">Last order quantity: ${item_quantity}</div>
                                </div>
                            </a>
                        </div>`;

                    // Append the main box div and hidden data div to the container
                    $(".get_medicine_favourite_api_div").append(medicineHtml + div_all_data);
                }
            });
        }
    });
}
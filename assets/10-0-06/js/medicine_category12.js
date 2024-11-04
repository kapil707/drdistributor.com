$(window).scroll(function() {
    let isScrolling;
    clearTimeout(isScrolling);
    isScrolling = setTimeout(function() {
        LoadMore();
    }, 200);
});

$(document).ready(function() {
    get_record = $(".get_record").val();
    MainPageFuncationCall(get_record);
});

function LoadMore() {
    var scrollBottom = $(".main_container").height() - $(window).height() - $(window).scrollTop();
    if (scrollBottom < 100) {
        get_record = $(".get_record").val();
        MainPageFuncationCall(get_record);
    }
}

var query_work = 0;
var no_record_found = 0;
var new_i = 0;
var no_more_records_displayed = false;

function MainPageFuncationCall(get_record) {
    if (query_work === 0 && !no_more_records_displayed) { // Prevent further calls if "No more records" is displayed
        query_work = 1;

        $(".top_bar_title2").html("Loading....");
        $(".main_container").show();
        $(".main_page_loading").show();
        $(".main_page_no_record_found").hide();
        $(".main_page_something_went_wrong").hide();

        $.ajax({
            type: "POST",
            dataType: "json",
            data: { item_page_type: item_page_type, item_code: item_code_pg, item_division: item_division, get_record: get_record },
            url: get_base_url() + "category/api/medicine_category_api",
            cache: true,
            timeout: 60000,
            error: function() {
                $(".top_bar_title2").html("No record found");
                $(".main_container").hide();
                $(".main_page_loading").hide();
                $(".main_page_something_went_wrong").show();
                query_work = 0; // Reset to allow retries
            },
            success: function(data) {
                $(".main_page_loading").hide();
                if (data.items === "" && no_record_found === 0) {
                    $(".top_bar_title2").html("No record found");
                    $(".main_container").hide();
                    $(".main_page_no_record_found").show();
                }

                // Check if there are no new items in the response
                if (data.items.length === 0) {
                    if (!no_more_records_displayed) { // Ensure we only display the message once
                        $(".main_page_data").append('<div class="main_box_div_data"><div class="no_more_records">No more records</div></div>');
                        no_more_records_displayed = true; // Set flag to true so it doesn't show multiple times
                    }
                    return;
                }

                get_record = data.get_record;
                $(".get_record").val(get_record);

                title = data.title;
                if (title != "") {
                    $(".top_bar_title").html(title);
                }

                $.each(data.items, function(i, item) {
                    if (item) {
                        let item_code = item.item_code;
                        let item_image = item.item_image;
                        let item_name = item.item_name;
                        let item_packing = item.item_packing;
                        let item_company = item.item_company;
                        let item_quantity = item.item_quantity;
                        let item_stock = item.item_stock;
                        let item_ptr = item.item_ptr;
                        let item_mrp = item.item_mrp;
                        let item_price = item.item_price;
                        let item_scheme = item.item_scheme;
                        let item_margin = item.item_margin;
                        let item_featured = item.item_featured;

                        // Data to be stored for future reference
                        let div_all_data = `
                            <div class='medicine_details_all_data_${item_code}' 
                                item_image='${item_image}' 
                                item_name='${item_name}' 
                                item_packing='${item_packing}'
                                item_company='${item_company}' 
                                item_quantity='${item_quantity}' 
                                item_stock='${item_stock}' 
                                item_ptr='${item_ptr}' 
                                item_mrp='${item_mrp}' 
                                item_price='${item_price}' 
                                item_scheme='${item_scheme}' 
                                item_margin='${item_margin}' 
                                item_featured='${item_featured}'>
                            </div>`;

                        // Featured image or out of stock image handling
                        let item_other_image_div = '';
                        if (item_featured == "1" && item_quantity != "0") {
                            item_other_image_div = `<img src="${get_base_url()}img_v51/featured_img.png" class="all_item_featured_img">`;
                        } else if (item_quantity == 0) {
                            item_other_image_div = `<img src="${get_base_url()}img_v51/out_of_stock_img.png" class="all_item_out_of_stock_img">`;
                        }

                        // Scheme display if available
                        let item_scheme_div = "";
                        if (item_scheme != "0+0") {
                            item_scheme_div = `<div class="all_item_scheme">Scheme : ${item_scheme}</div>`;
                        }

                        // Append product data
                        $(".main_page_data").append(`
                            <div class="col-lg-2 col-sm-3 col-6 p-0 m-0 text-center">
                                <div class="medicine_category_page text-center" title="${item_name}">
                                    <a href="${get_base_url()}md/${item_code}" target="_blank">
                                        ${item_other_image_div}
                                        <img class="all_item_image" src="${default_img}" alt="${item_name}">
                                        <img class="all_item_image_load" src="${item_image}" alt="${item_name}" onload="showActualImage(this)" onerror="setDefaultImage(this);">
                                        <div class="all_item_name">${item_name}<span class="all_item_packing"> (${item_packing} Packing)</span></div>
                                        <div class="all_item_margin">${item_margin}% Margin*</div>
                                        <div class="all_item_company">By ${item_company}</div>
                                        ${item_scheme_div}
                                        <div class="all_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> ${item_ptr}/-</div>
                                        <div class="all_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> ${item_mrp}/-</div>
                                        <div class="all_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> ${item_price}/-</div>
                                    </a>
                                </div>
                                ${div_all_data}
                            </div>
                        `);

                        query_work = 0;
                        no_record_found = 1;

                        $(".main_page_data").show();
                        new_i++;
                        $(".top_bar_title2").html(`Found result (${new_i})`);
                    }
                });
            }
        });
    }
}

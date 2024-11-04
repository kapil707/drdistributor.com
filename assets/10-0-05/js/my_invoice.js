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
    if (query_work === 0) {
        query_work = 1;

        $(".top_bar_title2").html("Loading....");
        $(".main_container").show();
        $(".main_page_loading").show();
        $(".main_page_no_record_found").hide();
        $(".main_page_something_went_wrong").hide();

        $.ajax({
            type: "POST",
            dataType: "json",
            data: { get_record: get_record },
            url: get_base_url() + "my_invoice/my_invoice_api",
            cache: false,
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

                $.each(data.items, function(i, item) {
                    if (item) {
                        let item_id = item.item_id;
                        let item_title = item.item_title;
                        let item_total = item.item_message;
                        let item_date_time = item.item_date_time;
                        let out_for_delivery = item.out_for_delivery ? ` | Out For Delivery Date Time : ${item.out_for_delivery}` : "";
                        let delete_status_div = item.delete_status === 1 ? '<div class="all_item_date_time">Some items have been deleted / modified in this order</div>' : "";

                        $(".main_page_data").append(`
                            <div class="main_box_div_data">
                                <div class="all_page_box_left_div">
                                    <a href="${get_base_url()}mid/${item_id}">
                                        <img src="${item.item_image}" alt="" title="" onerror="setDefaultImage(this);" class="all_item_image">
                                    </a>
                                </div>
                                <div class="all_page_box_right_div text-left">
                                    <div>
                                        <a href="${get_base_url()}mid/${item_id}">
                                            <span class="all_item_name">${item_title}</span>
                                        </a>
                                        <span style="float: right;">
                                            <a href="${item.download_url}" class="all_item_download">Download Excel</a>
                                        </span>
                                    </div>
                                    <a href="${get_base_url()}mid/${item_id}">
                                        <div class="all_item_price">Total : <i class="fa fa-inr" aria-hidden="true"></i> ${item_total}/-</div>
                                        <div class="all_item_date_time">Invoice Date : ${item_date_time}${out_for_delivery}</div>
                                        ${delete_status_div}
                                    </a>
                                </div>
                            </div>
                        `);

                        query_work = 0;
                        no_record_found = 1;
                        new_i++;
                        $(".top_bar_title2").html(`Found result (${new_i})`);
                    }
                });
            }
        });
    }
}
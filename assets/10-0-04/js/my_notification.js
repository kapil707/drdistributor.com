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
    if (query_work === 0 && !no_more_records_displayed) {  // Prevent further calls if "No more records" is displayed
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
            url: get_base_url() + "my_notification/my_notification_api",
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
                    query_work = 0; // Reset query_work to allow retries if more records come
                    return;
                }

                get_record = data.get_record;
                $(".get_record").val(get_record);
                $.each(data.items, function(i, item) {
                    if (item) {
                        let item_id = item.item_id;
                        let item_title = item.item_title;
                        let item_message = item.item_message;
                        let item_date_time = item.item_date_time;
                        let item_image = item.item_image;

                        $(".main_page_data").append(`
                            <div class="main_box_div_data">
                                <a href="${get_base_url()}mnd/${item_id}">
                                    <div class="all_page_box_left_div">
                                        <img src="${item_image}" alt="" title="" onerror="setDefaultImage(this);" class="all_item_image">
                                    </div>
                                    <div class="all_page_box_right_div text-left">
                                        <div class="all_item_name">${item_title}</div>
                                        <div class="all_item_message">${item_message}</div>
                                        <div class="all_item_date_time">${item_date_time}</div>
                                    </div>
                                </a>
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
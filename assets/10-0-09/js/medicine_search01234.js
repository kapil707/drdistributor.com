var import_order_medicine_change_value = 0; // Import page variable, do not remove

function cart_page_load() {
    $(".main_page_loading").show();
    $(".search_page_div_for_fix_height").css("height", $(window).height() - 215);

    $(".top_bar_search_div").hide();
    $(".top_bar_search_textbox_div").show();
    
    $('.medicine_search_textbox').val("").show().focus();
    
    get_medicine_favourite();
    my_cart_api("all");
}

function clear_search_function() {
    $(".background_blur").hide();
    $(".search_result_div, .search_result_div_mobile").html("").hide();
    $(".medicine_search_textbox").val("").focus();
    $(".top_bar_search_textbox_div_menu_icon, .top_bar_search_textbox_div_menu, .top_bar_search_textbox_div_clear_icon").hide();
    $(".my_cart_api_div_mobile").show();
}

$(document).ready(function() {
    $(".medicine_search_textbox").keyup(function(e) {
        var keyword = $(this).val();
        
        if (keyword) {
            if (keyword.length < 3) {
                $(this).focus();
                $(".search_result_div, .search_result_div_mobile").html("");
            }
            if (keyword.length > 2) {
                setTimeout('medicine_search_api();', 500);
            }
        } else {
            clear_search_function();
        }
    });

    $(".medicine_search_textbox").keydown(function(event) {
        if (event.key == "ArrowDown") {
            page_up_down_arrow("1");
            $('.hover_1').attr("tabindex", -1).focus();
            return false;
        }
    });

    document.onkeydown = function(evt) {
        evt = evt || window.event;
        if (evt.keyCode == 27) {
            clear_search_function();
        }
    };
});

function page_up_down_arrow(new_i) {
    $('.hover_' + new_i).keypress(function(e) {
        if (e.which == 13) {
            var item_code = $(".medicine_details_funcation_" + new_i).attr("item_code");
            medicine_details_funcation(item_code);
            clear_search_function();
        }
    }).keydown(function(event) {
        if (event.key == "ArrowDown") {
            new_i = parseInt(new_i) + 1;
            page_up_down_arrow(new_i);
            $('.hover_' + new_i).attr("tabindex", -1).focus();
            return false;
        }
        if (event.key == "ArrowUp") {
            if (parseInt(new_i) == 1) {
                var searchInput = $('.medicine_search_textbox');
                var strLength = searchInput.val().length * 2;
                searchInput.focus()[0].setSelectionRange(strLength, strLength);
            } else {
                new_i = parseInt(new_i) - 1;
                page_up_down_arrow(new_i);
                $('.hover_' + new_i).attr("tabindex", -1).focus();
            }
            return false;
        }
    });
}

function get_medicine_favourite() {
    $.ajax({
        url: get_base_url() + "medicine_details/get_medicine_favourite_api",
        type: "POST",
        dataType: "json",
        cache: true,
        data: { id: "" },
        error: function() {
            $(".get_medicine_favourite_api_div").html(something_went_wrong_function());
        },
        success: function(data) {
            $(".get_medicine_favourite_api_div").html('');
            if (!data.items) {
                $(".get_medicine_favourite_api_div").html(no_record_found_function());
            }
            $.each(data.items, function(i, item) {
                if (item) {
                    var div_all_data = "<div class='medicine_details_all_data_" + item.item_code + "' item_image='" + item.item_image + "' item_name='" + item.item_name + "'></div>";
                    var favouriteMedicineHTML = '<div class="main_box_div_data"><a href="javascript:void(0)" onclick="medicine_details_funcation(' + item.item_code + ')"><div class="favourite_medicines_box_left_div"><img class="all_item_image" src="'+ default_img +'" alt="' + item.item_name + '"><img class="all_item_image_load" src="' + item.item_image + '" alt="' + item.item_name + '" onload="showActualImage(this)" onerror="setDefaultImage(this);"></div><div class="favourite_medicines_box_right_div"><div class="all_item_name">' + item.item_name + '</div><div class="all_item_order_quantity">Last order quantity: ' + item.item_quantity + '</div></div></a></div>' + div_all_data;
                    $(".get_medicine_favourite_api_div").append(favouriteMedicineHTML);
                }
            });
        },
        timeout: 60000
    });
}

function menu_search_function() {
    $(".top_bar_search_textbox_div_menu").show();
}

function cart_empty_btn() {
    swal("Your cart is empty");
}

function view_cart_btn() {
    window.location.href = get_base_url() + "mc";
}

function medicine_search_api() {
    var keyword = $(".medicine_search_textbox").val();
    
    if (keyword && keyword.length > 2) {
        $(".my_cart_api_div_mobile").hide();
        $(".top_bar_search_textbox_div_menu_icon, .top_bar_search_textbox_div_clear_icon").show();
        
        $(".background_blur").show();
        $(".top_bar_title2").html("Loading....");

        $(".search_result_div, .search_result_div_mobile").show().html('<div class="row"><div class="col-sm-12 text-center">' + loading_img_function() + '</div></div>');

        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                keyword: keyword,
                total_rec: $(".medicine_total_rec").val(),
                checkbox_medicine_val: $(".checkbox_medicine").prop("checked") ? 1 : 0,
                checkbox_company_val: $(".checkbox_company").prop("checked") ? 1 : 0,
                checkbox_out_of_stock_val: $(".checkbox_out_of_stock").prop("checked") ? 1 : 0
            },
            url: get_base_url() + "medicine_search/medicine_search_api",
            cache: true,
            error: function() {
                $(".search_result_div, .search_result_div_mobile").html(something_went_wrong_function());
                $(".top_bar_title2").html("No record found");
            },
            success: function(data) {
                $(".search_result_div, .search_result_div_mobile").html("");
                if (!data.items) {
                    $(".top_bar_title2").html("No record found");
                    $(".search_result_div, .search_result_div_mobile").html(no_record_found_function());
                }
                $.each(data.items, function(i, item) {
                    var itemHTML = generate_item_html(item, i + 1);
                    $(".search_result_div, .search_result_div_mobile").append(itemHTML);
                    $(".top_bar_title2").html("Found result (" + (i + 1) + ")");
                });
            },
            timeout: 60000
        });
    } else {
        $(".top_bar_search_textbox_div_menu_icon, .top_bar_search_textbox_div_menu, .top_bar_search_textbox_div_clear_icon").hide();
        $(".search_result_div, .search_result_div_mobile").html("");
    }
}

function generate_item_html(item, index) {
    var onlcick_event = import_order_medicine_change_value === 0 
        ? 'onclick="medicine_details_funcation(\'' + item.item_code + '\'), clear_search_function()"' 
        : 'onclick="import_order_medicine_change_api(\'' + item.item_code + '\'), clear_search_function()"';

    return `<div class="main_box_div_data hover_${index} medicine_details_funcation_${index}" ${onlcick_event} item_code="${item.item_code}">
                <div class="medicine_search_box_left_div">
                    ${item.featured ? '<img src="' + get_base_url() + 'assets/' + getWebJs() + '/images/featured_img.png" class="all_item_featured_img">' : ''}
                    <img class="all_item_image" src="${default_img}" alt="${item.item_name}">
                    <img class="all_item_image_load" src="${item.item_image}" alt="${item.item_name}" onload="showActualImage(this)" onerror="setDefaultImage(this);">
                </div>
                <div class="medicine_search_box_right_div">
                    <div class="all_item_name">${item.item_name} (${item.item_packing} Packing)</div>
                    <div class="all_item_company">By ${item.item_company}</div>
                    <div class="all_item_stock">${item.quantity}</div>
                    <div>*Approximate ~ : ${item.price}</div>
                </div>
            </div>`;
}
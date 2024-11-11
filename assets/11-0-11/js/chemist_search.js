let currentFocus = -1; // Tracks the currently focused item
function chemist_search_load() {

	$(".top_bar_search_div").hide();
	$(".top_bar_search_textbox_div").show();

	$('.chemist_search_textbox').val("");
	$('.chemist_search_textbox').show();
	$('.chemist_search_textbox').focus();
}
function clear_search_function() {

	$(".background_blur").hide();

	$(".search_result_div").html("");
	$(".search_result_div").hide();
	
	$(".search_result_div_mobile").html("");
	$(".search_result_div_mobile").hide();	

	$(".chemist_search_textbox").val("");
	$('.chemist_search_textbox').focus();

	$(".top_bar_search_textbox_div_menu_icon").hide();
	$(".top_bar_search_textbox_div_menu").hide();

	$(".top_bar_search_textbox_div_clear_icon").hide();	
	
	$(".main_page_data_mobile").show();
}

$(document).ready(function(){	
	$(".chemist_search_textbox").keyup(function(e){
		// Only call find_chemist if the key is not an arrow key, Enter, or Tab
        if (![37, 38, 39, 40, 13, 9].includes(e.keyCode)) { // Key codes for Left, Up, Right, Down, Enter, and Tab
            var keyword = $(".chemist_search_textbox").val();
			if(keyword!="")
			{
				if(keyword.length<3) {
					$('.chemist_search_textbox').focus();
					$(".search_result_div").html("");
					$(".search_result_div_mobile").html("");
				}
				if(keyword.length>2) {
					//medicine_search_api();
					setTimeout('search_chemist();',500);
				}
				//console.log("keyup"+keyword.length);
			}else{
				clear_search_function();
			}
        } else if (e.keyCode === 27) { // Handle Escape key specifically
			clear_search_function();
		}
	});

    $(".medicine_search_textbox").keydown(function(e) {
    	let listItems = $(".search_result_div ul li");
		console.log(currentFocus + " " + listItems.length)
        if (e.key === "ArrowDown") {
            e.preventDefault();
            currentFocus++;
            if (currentFocus >= listItems.length) currentFocus = 0; // Loop back to top
            addActive(listItems);
        } else if (e.key === "ArrowUp") {
            e.preventDefault();
            currentFocus--;
            if (currentFocus < 0) currentFocus = listItems.length - 1; // Loop back to bottom
            addActive(listItems);
        } else if (e.key === "Enter") {
            //e.preventDefault();
            if (currentFocus > -1) {
                listItems[currentFocus].click(); // Trigger click on the selected item
            }
        }
    });

	document.onkeydown = function(evt) {
		evt = evt || window.event;
		if (evt.keyCode == 27) {
			clear_search_function();
		}
	};
});

function addActive(listItems) {
    listItems.removeClass("search_result_div_active");
    if (currentFocus >= 0 && currentFocus < listItems.length) {
        const activeItem = listItems.eq(currentFocus);
        activeItem.addClass("search_result_div_active");

        // Ensure the active item is visible in the container
        const container = $(".search_result_div");
        const itemTop = activeItem.position().top;
        const itemBottom = itemTop + activeItem.outerHeight();
        const containerScrollTop = container.scrollTop();
        const containerHeight = container.innerHeight();

        if (itemBottom > containerHeight) {
            container.scrollTop(containerScrollTop + (itemBottom - containerHeight));
        } else if (itemTop < 0) {
            container.scrollTop(containerScrollTop + itemTop);
        }
    }
}

function search_chemist()
{
	new_i = 0;

	$(".main_page_data_mobile").hide();

	$(".top_bar_search_textbox_div_clear_icon").show();

	var keyword = $(".chemist_search_textbox").val();
	if(keyword!="")
	{
		if(keyword.length>2)
		{
			$(".background_blur").show();
			$(".top_bar_title2").html("Loading....");

			$(".search_result_div").show();
			$(".search_result_div").html('<div class="row"><div class="col-sm-12 text-center">'+loading_img_function()+'</div></div>');

			$(".search_result_div_mobile").show();
			$(".search_result_div_mobile").html('<div class="row"><div class="col-sm-12 text-center">'+loading_img_function()+'</div></div>');

			$.ajax({
				type       : "POST",
				dataType   : "json",
				data       : {keyword : keyword} ,
				url        : get_base_url()+"chemist_select/chemist_search_api",
				cache : true,
				timeout: 60000,
				error: function(){
					$(".search_result_div").html(something_went_wrong_function());
					$(".search_result_div_mobile").html(something_went_wrong_function());
					$(".top_bar_title2").html("No record found");
				},
				success    : function(data){
					$(".search_result_div").html("");
					$(".search_result_div_mobile").html("");
					if(data.items==""){
						$(".top_bar_title2").html("No record found");
						$(".search_result_div").html(no_record_found_function());
						$(".search_result_div_mobile").html(no_record_found_function());
					} else {
						let htmlContent = '<ul>';
						$.each(data.items, function(i,item){	
							if (item){
								new_i				= item.count;
								user_nrx			= item.user_nrx;
								chemist_altercode	= item.chemist_altercode;
								
								var onlcick_event = 'onclick=chemist_session_add("'+chemist_altercode+'","'+user_nrx+'")';

								var chemist_message = "";
								if(item.user_cart!="0") {
									chemist_message = '<div class="all_item_date_time">Order '+item.user_cart+' Items | Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item.user_cart_total+'/-</div></div></div>';
								}
								
								htmlContent += '<li class="main_box_div_data" '+onlcick_event+'><div class="chemist_search_box_left_div"><img src="'+item.chemist_image+'" class="all_item_image" onerror="setDefaultImage(this);"></div><div class="chemist_search_box_right_div"><div class="all_chemist_name">'+item.chemist_name+'</div><div class="all_chemist_altercode"> Code : '+item.chemist_altercode+'</div>'+chemist_message+'</li>';

								$(".top_bar_title2").html("Found result ("+new_i+")");
							}
						});
						htmlContent += '</ul>';
						$(".search_result_div").html(htmlContent);
						$(".search_result_div_mobile").html(htmlContent);
						currentFocus = -1; // Reset focus					
					}
				}
			});
		}
	}
	else{
		
		$(".top_bar_search_textbox_div_menu_icon").hide();
		$(".top_bar_search_textbox_div_menu").hide();

		$(".top_bar_search_textbox_div_clear_icon").hide();
		$(".search_result_div").html("");
		$(".search_result_div_mobile").html("");
	}
}
function chemist_session_add(chemist_id,user_nrx)
{	
	window.location.href = get_base_url()+"chemist_select/chemist_session_add/"+chemist_id+"/"+user_nrx
}
function page_up_down_arrow(new_i)
{
	$('.hover_'+new_i).keypress(function (e) {
		 if (e.which == 13) {
			$('.select_chemist_'+new_i).click();
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
				var searchInput = $('.chemist_search_textbox');
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
$(document).ready(function(){
	MainPageFuncationCall("kapil");
});
var no_record_found = 0;
var new_i = 0;
function MainPageFuncationCall()
{
	/*********************************** */
	$(".top_bar_title2").html("Loading....");
	$(".main_container").show();
	$(".main_page_loading").show();
	$(".main_page_no_record_found").hide();
	$(".main_page_something_went_wrong").hide();
	/*********************************** */

	$.ajax({
		type       : "POST",
		dataType   : "json",
		url        : get_base_url()+"chemist_select/salesman_my_cart_api",
		cache : true,
		error: function(){
			$(".top_bar_title2").html("No record found");
			$(".main_container").hide();
			$(".main_page_loading").hide();
			$(".main_page_something_went_wrong").show();
		},
		success    : function(data){
			
			$(".main_page_loading").hide();
			if(data.items=="")
			{
				if(no_record_found=="0")
				{
					$(".top_bar_title2").html("No record found");
					$(".main_container").hide();
					$(".main_page_no_record_found").show();
				}
			}
			$.each(data.items, function(i,item){	
				if (item){
					user_nrx 			= item.user_nrx;
					chemist_altercode 	= item.chemist_altercode;

					a_ = 'onclick=chemist_session_add("'+chemist_altercode+'","'+user_nrx+'")';
					
					var main_data = '<div class="main_box_div_data" '+a_+'><div class="chemist_search_box_left_div"><img src="'+item.chemist_image+'" class="all_item_image" onerror="setDefaultImage(this);"></div><div class="chemist_search_box_right_div"><div class="all_chemist_name">'+item.chemist_name+'</div><div class="all_chemist_altercode"> Code : '+item.chemist_altercode+'</div><div class="all_item_date_time">Order '+item.user_cart+' Items | Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item.user_cart_total+'/-</div></div></div>';

					$(".main_page_data").append(main_data);	
					$(".main_page_data_mobile").append(main_data);

					no_record_found = 1;
					
					new_i = parseInt(new_i) + 1;
					$(".top_bar_title2").html("Found result ("+new_i+")");
				}
			});
		},
		timeout: 60000
	});	
}
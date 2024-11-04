$(document).ready(function(){
	call_page()
});
function load_more()
{
	call_page()
}
var query_work = 0;
var no_record_found = 0;
function call_page()
{
	if(query_work=="0")
	{
		query_work = 1;
		$.ajax({
			type       : "POST",
			data       :  {item_code:item_code} ,
			url        : "https://www.drdweb.co.in/medicine_use/get_medicine_use",
			cache	   : false,
			error: function(){
				$(".load_page_loading").html("");
				$(".load_page").html('<h1><img src="'+get_base_url()+'img_v51/something_went_wrong.png" width="100%"></h1>');
			},
			success    : function(data){
				$.each(data.medicine_use, function(i,item){
					if (item){
						file			= item.file;
						file_type		= item.file_type;
						
						image = video = "";
						if(file_type=="image"){
							image = '<img src="'+file+'" width="100%">';
						}
						
						if(file_type=="video"){
							video = '<video width="100%" height="250" controls="" poster="'+get_base_url()+'img_v51/default-video-thumbnail.jpg"><source src="'+file+'" type="video/mp4">Your browser does not support the video tag.</video>';
						}
						
						if(image!=""){
							$(".load_page_images").append('<div class="col-sm-2 col-6 p-0 m-0 text-center"><div class="medicine_use_div">'+image+'</div></div>');
						}
						if(video!=""){
							$(".load_page_videos").append('<div class="col-sm-6 col-6 p-0 m-0 text-center"><div class="medicine_use_div1">'+video+'</div></div>');
						}
						//$(".headertitle").html(item.item_header_title);
						query_work = 0;
						no_record_found = 1;
						$(".load_more").show();
					}
				});
			},
			timeout: 10000
		});
	}
}
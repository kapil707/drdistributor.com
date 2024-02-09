<style>
.menubtn1{
	display:inline;
}
.menubtn2,.homebtn_div
{
	display:none;
}
.headertitle
{
	margin-top: 2px;
	font-size:16px;
}
.headertitle1
{
	display:block !important;
}
/*
.search_medicine_main{
	display:none;
} */
.maincontainercss{
	padding-top: 160px;
    min-height: 500px;
}
</style>
<?php
$ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
$isMob = is_numeric(strpos($ua, "mobile"));

$this->load->helper('url');

$default_img = base_url()."/uploads/default_img.jpg";
$error_img ="onerror=this.src=".base_url()."/uploads/default_img.jpg";


$user_type 		= $_COOKIE["user_type"];
$user_altercode = $_COOKIE["user_altercode"];
$user_password	= $_COOKIE["user_password"];

$chemist_id 	= $_COOKIE["chemist_id"];

$salesman_id = "";
if($user_type=="sales")
{
	$salesman_id 	= $user_altercode;
	$user_altercode = $chemist_id;
}

$session_yes_no = "no";
if(!empty($user_altercode)){
	$session_yes_no = "yes";
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<div class="container-fluid maincontainercss">
	<div class="row home_page_all_data"></div>
	<div class="myloading">Loading........</div>
</div>


<script>
function home_page_divisioncategory_load(category_id){
	//alert(category_id)
    $(".owl-carousel"+category_id).owlCarousel({
        items: 8, // Number of items to display
        loop: true, // Enable loop
        margin: 20, // Margin between items
        autoplay: true, // Enable autoplay
        autoplayTimeout: 3000, // Autoplay interval in milliseconds
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            768:{
                items:2,
            },
            1024:{
                items:8,
            }
        }
    });
}

function home_page_slider(category_id,result_row){
	var mydata = '';
	$.each(result_row, function(i,item){
		if (item){
			division 	= item.division;
			funtype		= item.funtype;
			itemid 		= item.itemid;
			compname	= item.compname;
			image 		= item.image;
			web_action	= item.web_action;

			if(division){
				division="not";
			}
			error_img ="onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'"

			mydata+='<a href="'+web_action+'"><div><img src="'+image+'" data-u="image" class="img_css_forslider" alt="" '+error_img+'></div></a>';
		}
	});
	
	myval = '<div class="col-xs-12 col-sm-12 col-12"><div id="jssor_'+id+'"><div data-u="slides" class="top_flash_div">'+mydata+'</div><div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75"><div data-u="prototype" class="i" style="width:16px;height:16px;"><svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><circle class="b" cx="8000" cy="8000" r="5800"></circle></svg></div></div><div data-u="arrowleft" class="jssora051" style="width:30px;height:30px;top:0px;left:35px;background: black;border-radius: 30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75"><svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline></svg></div><div data-u="arrowright" class="jssora051" style="width:30px;height:30px;top:0px;right:35px;background: black;border-radius: 30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75"><svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline></svg></div></div></div>';
	
	return myval;
}

function home_page_divisioncategory(category_id,result_row,title){
	var mydata = '';
	$.each(result_row, function(i,item){
		if (item){			
			item_code 		= item.item_code;
			item_company 	= item.item_company;
			item_division 	= item.item_division;
			item_image 		= item.item_image;

			mydata+= '<div class="item"><div class="home_main_div"><div class="image1"><a href="<?= base_url(); ?>category/featured_brand/'+item_code+'/'+item_division+'"><img src="'+item_image+'" alt=""></a></div><div class="content" style="padding-top:5px;"><a href="<?= base_url(); ?>category/featured_brand/'+item_code+'/'+item_division+'"><div class="medicine_details_item_company">'+item_company+'</div></a></div></div></div>';
		}
	});
	
	myval = '<div class="col-xs-12 col-sm-12 col-12"><div class="featured_home_title1"><div class="heading_home1"><span class="">'+title+'</span></div></div><div class="row"><div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-12 col-12 mobile_off"><img src="<?php echo base_url(); ?>img_v<?= constant('site_v') ?>/heart.png" width="100%" class=""></div><div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-12 col-12"><div class="owl-carousel owl-carousel'+category_id+'">'+mydata+'</div></div></div></div>';
	
	return myval;
}

/*************************************** */
var my_notification_no_record_found = 0;
var my_invoice_no_record_found = 0;
function home_page_load(id)
{
	$('.myloading').show();
	$(".home_page_my_notification").html('<div><center><img src="<?= base_url(); ?>/img_v<?= constant('site_v') ?>/loading.gif" width="100px"></center></div><div><center>Loading....</center></div>');
	$(".home_page_my_invoice").html('<div><center><img src="<?= base_url(); ?>/img_v<?= constant('site_v') ?>/loading.gif" width="100px"></center></div><div><center>Loading....</center></div>');

	//alert(id);
	$.ajax({
		type       : "POST",
		data       :  {id:id} ,
		url        : "<?php echo base_url(); ?>Chemist_json_test/home_page_web",
		cache	   : true,
		success : function(data){
			//alert(data)
			if(data!="")
			{
				alert(data.myid);
				$('.myloading').hide();
				$.each(data.get_result, function(i,row){
					$(".main_loading_css").hide();
					var category_id = row.result_category_id;
					var result_row = row.result_row;
					var title = row.result_title;
					if(row.result=="slider" && (row.result_category_id=="1" || row.result_category_id=="2")) {
						/*dt_result = home_page_slider(category_id,result_row);
						$(".home_page_all_data").append(dt_result);
						
						if(category_id=="1"){
							jssor_1_slider_init();
						}
						if(category_id=="2"){
							jssor_2_slider_init();
						}*/
					}
					if(row.result=="divisioncategory") {
						dt_result = home_page_divisioncategory(category_id,result_row,title);
						$(".home_page_all_data").append(dt_result);
						//alert(category_id)
						home_page_divisioncategory_load(category_id);
					}
				});
			}
		},
		timeout: 10000
	});
}
home_page_load(1);

$(document).ready(function(){
    $(window).scroll(function(){
		if(($(window).scrollTop() == $(document).height() - $(window).height())){
			home_page_load(1);
		}
    });
});

function download_invoice(url){
	window.open(url, '_blank');
	window.close();
}
</script>

<script src="<?php echo base_url(); ?>/assets/website/wow_css_js/wow.js"></script>
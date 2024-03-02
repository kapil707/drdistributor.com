<?php
$theme_type = "lite";
if (isset($_COOKIE["theme_type"])) {
	$theme_type = $_COOKIE["theme_type"];
}?>
<?php if($theme_type=="lite") { ?>
	<style>/*light theme*/
	:root{
		--main_theme_bg_color:#fbfbfb;
		
		--main_theme_body_text_color:#000000;
		--main_theme_color:#27ae60;
		
		--main_theme_top_menu_bar_bg:#ffffff;
		--main_theme_top_menu_bar_bg1:#ffffff;
		
		--top_icon_menu_li_bg:#e9ecef;
		--top_icon_menu_li_bg_hover:#ebebeb;
		--top_icon_menu_color:#757575;
		
		--main_theme_hearder_color:#757575;
		--main_theme_hearder_color_hover:#757575;
		
		--main_theme_footer_bg:#f6f6f6;
		--main_theme_footer_bg1:#ffffff;
		--main_theme_footer_color:#757575;
		
		--main_theme_home_pg_menu_color:#757575;
		--main_theme_home_pg_menu_color_hover:#757575;

		--heading_home_hr_line:#27ae60;
		--main_theme_box_shadow:#27ae60;
		
		--main_theme_border_color:#27ae60;
		--main_theme_border_hover_color:#757575;

		--main_theme_white_background_color:#ffffff;
		--main_theme_left_menu_bg_color:#f6f6f6;
		--main_theme_left_menu_bg_color1:#ffffff;

		--main_theme_textbox_background_color:#ffffff;
		--main_theme_textbox_text_color:#6A6767;
		
		--main_theme_scrollbar_color:#757575;
		

		--main_theme_li_color:rgb(240, 240, 240);
		--main_theme_li_bg_color:#969a9829;
		--main_theme_li_bg_hover_color:#ebebeb;

		--main_theme_li2_color:rgb(240, 240, 240);
		--main_theme_li2_bg_color:#ffffff;
		--main_theme_li2_bg_hover_color:#27ae6029;

		--main_theme_textbox_bg_color:#ffffff;
		--main_theme_textbox_color:#6A6767;

		--main_theme_textbox2_bg_color:#ffffff;
		--main_theme_textbox2_color:#6A6767;

		--main_theme_text_white_color:#ffffff;
		--main_theme_text_black_color:#757575;

		
		--main_theme_modal_bg_color:#ffffff;

		--mainbutton-color:#27a3ae; /* #27ae60; */
		--mainbuttonhover-color:#225f64; /* #1b6339; */
		
		/************/
		--home_company_color:#30363C;
		--home_company_color_hover:#757575;
		
		--main_theme_left_right_btn:#ffffff;
		--main_theme_left_right_btn_bg:#000000;
		
		--main_theme_search_icon_color:#6a6767;

		
		--item_name_color:#27ae60; /*27ae60 */
		--item_date_time_color:#795548;
		
		--item_name_color_hover:#757575; /*27ae60 */
		--item_packing_color:#ff9800;
		--item_batch_no_color:#795548;
		--item_margin_color:#1084a1;
		--item_company_color:#3f51b5;
		--item_company2_color:#795548;
		--item_expiry_color:#981e1e;
		--item_stock_color:#1084a1;
		--item_scheme_color:#c66464;
		--item_scheme_line_color:#685c5c;
		--item_hr_line_color:#d9d9d9;

		--out_of_stock-color:#ff0a0a;

		--item_ptr_color:#795548;
		--item_mrp_color:#795548;
		--item_price_color:#6c757d;
		--item_gst_color:#965400;

		--chemist_user_name_color:#27ae60;
		--chemist_altercode_color:#795548;
		
		--item_description1_color:#685c5c;	
		--item_description2_color:#685c5c;
		--item_similar_items_color:#965400;
		

		--item_order_quantity:#685c5c;
		--item_order_quantity_bg:#e8e8e8;
	}
	</style>
	<?php } ?>

	<?php if($theme_type=="dark") { ?>
	<style>/*dark theme */
	:root{
		--main_theme_bg_color:#000; /* #041C32 */
		
		--main_theme_body_text_color:#ced4da;
		--main_theme_color:#04293A;
		
		--main_theme_footer_color:#04293A;
		
		--main_theme_top_menu_bar_bg:#383d41;
		--main_theme_top_menu_bar_bg1:#383d41;
		
		
		--top_icon_menu_li_bg:#6a6767;
		--top_icon_menu_li_bg_hover:#6a6767;
		--top_icon_menu_color:#ced4da;
		
		--main_theme_hearder_color:#ced4da;
		--main_theme_hearder_color_hover:#ced4da;
		
		--main_theme_footer_bg:#383d41;
		--main_theme_footer_bg1:#383d41;
		--main_theme_footer_color:#ced4da;
		
		--main_theme_home_pg_menu_color:#ced4da;
		--main_theme_home_pg_menu_color_hover:#ced4da;

		--heading_home_hr_line:#27ae60;
		--main_theme_box_shadow:#27ae60;
		
		--main_theme_border_color:#6A6767;
		--main_theme_border_hover_color:#6A6767;
		--main_theme_modal_bg_color:#000000; /* 474040 */

		--main_theme_white_background_color:#000000;
		--main_theme_left_menu_bg_color:#383d41;
		--main_theme_left_menu_bg_color1:#383d41;

		--main_theme_textbox_background_color:#000000;
		--main_theme_textbox_text_color:#ced4da;
		

		--main_theme_li_color:#474040;
		--main_theme_li_bg_color:#064663;
		--main_theme_li_bg_hover_color:#232020;

		--main_theme_li2_color:rgb(240, 240, 240);
		--main_theme_li2_bg_color:#27ae6000;
		--main_theme_li2_bg_hover_color:#27ae6029;

		--main_theme_textbox_bg_color:#474040;
		--main_theme_textbox_color:#ebebeb;

		--main_theme_textbox2_bg_color:#191616;
		--main_theme_textbox2_color:#ebebeb;

		--main_theme_text_white_color:#000000;
		--main_theme_text_black_color:#757575;
		

		

		--mainbutton-color:#757575; /* #27ae60; */
		--mainbuttonhover-color:#rgba(0,0,0,.5); /* #27ae60; */

		

		/************/
		--home_company_color:#ffffff;
		
		--main_theme_left_right_btn:#000000;
		--main_theme_left_right_btn_bg:#ffffff;
		
		--main_theme_search_icon_color:#ced4da;

		--item_date_time_color:#ffffff;
		--item_name_color:#ffffff; /*27ae60 */
		--item_packing_color:#ffc107;
		--item_batch_no_color:#20c997;
		--item_margin_color:#fd7e14;
		--item_company_color:#dc3545;
		--item_company2_color:#6c757d;
		--item_expiry_color:#e83e8c;
		--item_stock_color:#1084a1;
		--item_scheme_color:#c66464;
		--item_scheme_line_color:#685c5c;
		--item_hr_line_color:#d9d9d9;

		--out_of_stock-color:#ff0a0a;

		--item_ptr_color:#6c757d;
		--item_mrp_color:#6c757d;
		--item_price_color:#b6b2b2;
		--item_gst_color:#c66464;

		--chemist_user_name_color:#27ae60;
		--chemist_altercode_color:#795548;
		
		--item_description1_color:#ebebeb;	
		--item_description2_color:#ebebeb;
		--item_similar_items_color:#965400;
		

		--item_order_quantity:#ffffff;
		--item_order_quantity_bg:#ffffff;
	} 
	</style>
	<?php } ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      <?= $this->Scheme_Model->get_website_data("title") ;?> || <?= $main_page_title;?>
    </title>
    <!-- Stylesheets -->
	<meta name="theme-color" content="#27ae60">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link href="https://fonts.googleapis.com/css?family=Cabin:700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/website/css/font-awesome.min.css"> 
	<link href="<?= base_url(); ?>assets/website/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<script src="<?= base_url(); ?>assets/website/js/jquery-2.1.4.min.js"></script>
	<script src="<?= base_url(); ?>assets/website/js/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>assets/website/js/bigSlide.js"></script> 


	<link href="<?= base_url(); ?>assets/website/css/style51.css" rel="stylesheet" type="text/css"/>
	<link rel="icon" href="<?= base_url(); ?>img_v51/logo.png" type="image/logo" sizes="16x16">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>

  <body>
	<div class="top_menu_bar" style="position: relative !important;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">						
					<div class="text-center">
						<img src="<?= base_url() ?>img_v51/logo.png" width="60px" alt>
					</div>
					<h2 class="login_text_font text-center">
					<?= $this->Scheme_Model->get_website_data("title2") ;?></h2>
					<h5 class="text-right login_text_font">
						Request for login credentials
					</h5>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" style="margin-top:50px;">
		<div class="row" style="margin-top:30px;">
			<div class="col-md-3">
			</div>
			<div class="col-md-6 login_new_box">
				<label>Enter chemist code</label>
				<div class="form-row">
					<div class="form-group col">
						<img src="<?= base_url() ?>img_v51/my_account1.png" width="25px" style="float: left; margin-top: 10px;position: absolute;margin-left: 10px;" alt>
						<input type="text" value="" class="input_type_text login_textbox" placeholder="Chemist code(e.g. A125)" required="" name="user_name1" id="user_name1" title="Chemist code(e.g. A125)">
					</div>
				</div>
				<label>Enter mobile number</label>
				<div class="form-row">
					<div class="form-group col">
						<img src="<?= base_url() ?>img_v51/phone1.png" width="25px" style="float: left; margin-top: 10px;position: absolute;margin-left: 10px;" alt>
						<input type="text" value="" class="input_type_text login_textbox" placeholder="Mobile number(e.g. 95123XXXXX)" required="" name="phone_number1" id="phone_number1" style="float: left;" title="Mobile number(e.g. 95123XXXXX)" maxlength="10">
					</div>
				</div>
				<h5 class="text-center gray_text_31 submit_div mt-2">&nbsp;</h5>
				<div class="text-center" style="margin-top:10px;">
					<input type="submit" value="Create account" class="mainbutton" name="Submit" onclick="submitbtn()"
					id="submitbtn"><input type="submit" value="Create account" class="mainbutton_disable" id="submitbtn_disable" style="display:none">
				</div>
				<div class="text-center" style="margin-top:30px;">
					Already have an account? 
					<a href="<?= base_url() ?>login" class="main_theme_a">
					Login</a>
				</div>
				<div class="text-center website_name_css" style="margin-top:15px;">
					<?= $this->Scheme_Model->get_website_data("title2") ;?>
				</div>
				<div class="text-center website_version_css" style="margin-top:5px;">
					Website version <?= $this->Scheme_Model->get_website_data("android_versioncode") ;?>
				</div>
			</div>
			<div class="col-md-3">
			</div>
		</div>
	</div>
</body>
</html>
<script>
$('#user_name1').on("keypress", function(e) {
	if (e.keyCode == 13) {
		submitbtn()
		return false; // prevent the button click from happening
	}
});
$('#phone_number1').on("keypress", function(e) {
	if (e.keyCode == 13) {
		submitbtn()
		return false; // prevent the button click from happening
	}
});
function submitbtn()
{
	chemist_code 	= $('#user_name1').val();
	phone_number	= $('#phone_number1').val();
	if(chemist_code=="")
	{
		swal("Enter Chemist code");
		$(".submit_div").html("<p class='text-danger'>Enter Chemist code</p>");
		$('#user_name1').focus();
		return false;
	}
	if(phone_number=="")
	{
		swal("Enter Mobile number");
		$(".submit_div").html("<p class='text-danger'>Enter Mobile number</p>");
		$('#phone_number1').focus();
		return false;
	}
	
	$("#submitbtn").hide();
	$("#submitbtn_disable").show();
	$(".submit_div").html("Loading....");
	
	$.ajax({
		type       : "POST",
		data       : {chemist_code:chemist_code,phone_number:phone_number},
		url        : "<?= base_url();?>chemist_login/get_create_new_api",
		cache	   : false,
		error: function(){
			swal("Error")
			$(".submit_div").html("<p class='text-danger'>Error</p>");
			$("#submitbtn").show();
			$("#submitbtn_disable").hide();
		},
		success    : function(data){
			if(data!="")
			{
				$(".submit_div").html("");
				$("#submitbtn").show();
				$("#submitbtn_disable").hide();
			}
			$.each(data.items, function(i,item){	
				if (item)
				{
					swal(item.status_message);
					if(item.status=="1")
					{
						$(".submit_div").html("<p class='text-success'>"+item.status_message+"</p>");
						$('#user_name1').val('');
						$('#phone_number1').val('');
					}
					else{
						$(".submit_div").html("<p class='text-danger'>"+item.status_message+"</p>");
					}
				}
			});	
		},
		timeout: 10000
	});
}
</script>
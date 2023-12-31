<style>
.menubtn1,.search_medicine_main
{
	display:none;
}
@media screen and (max-width: 767px) {
	.homebtn_div
	{
		display:none;
	}
}
.medicine_use_div{
	border-radius: 10px;
    padding: 5px;
    margin: 5px;
    background-color: var(--main_theme_li2_bg_color);
    border: 1px solid var(--main_theme_border_color);
    box-shadow: 0px 0px 5px 0px var(--main_theme_box_shadow);
	height:210px;
}
.medicine_use_div img{
	object-fit: contain;
	height:200px;
}
.medicine_use_div1{
	border-radius: 10px;
    padding: 5px;
    margin: 5px;
    background-color: var(--main_theme_li2_bg_color);
    border: 1px solid var(--main_theme_border_color);
    box-shadow: 0px 0px 5px 0px var(--main_theme_box_shadow);
	height:265px;
}
.medicine_use_div1 video{
	width:100%;
	height:250px;
	border-radius:10px;
}
</style>
<script>
$(".headertitle").html("Loading....");
function goBack() {
	window.location.href = "<?= base_url();?>home";
}
</script>
<div class="container maincontainercss">
	<div class="row">
		<div class="col-sm-12 col-12">
			<div class="row medicine_details_api_data">
				<div class="col-sm-3 col-12">
					<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
						<a class="example-image-link" data-standard="">
						<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="100%" style="float: right;margin-top:10px;" class="medicine_details_image modal_item_image_change" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
						</a>
					</div>
					
					<img src="<?= base_url(); ?>/img_v<?= constant('site_v') ?>/featured_img.png" width="100" style="position: absolute;margin-top:10px;display:none;left: 15px;" alt="zoom" class="medicine_details_featured_img" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>

					<img src="<?= base_url(); ?>/img_v<?= constant('site_v') ?>/out_of_stock_img.png" width="100" style="position: absolute;margin-top:10px;display:none;left: 15px;" alt="zoom" class="medicine_details_out_of_stock_img" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
					
					<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;margin-right: 6.6%;" class="medicine_details_image_small modal_item_image_change1" onclick="modal_item_image_change(1)" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>

					<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;margin-right: 6.6%;" class="medicine_details_image_small modal_item_image_change2" onclick="modal_item_image_change(2)" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>

					<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;margin-right: 6.6%;" class="medicine_details_image_small modal_item_image_change3" onclick="modal_item_image_change(3)" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>

					<img src="<?= base_url(); ?>/uploads/default_img.jpg" width="20%" style="float: left;margin-top:10px;cursor: pointer;" class="medicine_details_image_small modal_item_image_change4" onclick="modal_item_image_change(4)" alt="zoom" onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'>
				</div>
				<div class="col-sm-9 col-12">
					<div class="row">
						<div class="col-sm-12 col-12" style="margin-top: 5px;">
							<span class="medicine_details_item_name"></span>
						</div>
						<div class="col-sm-6 col-6 text-left">
							<span class="medicine_details_item_packing text-left"></span>
						</div>
						<div class="col-sm-6 col-6 text-right">
							<span class="medicine_details_item_batch_no"></span>
						</div>
						<div class="col-sm-6 col-6 text-left">
							<span class="medicine_details_item_margin"></span>
						</div>
						<div class="col-sm-6 col-6 text-right">
							<span class="medicine_details_item_expiry"></span>
						</div>
						<div class="col-sm-12 col-12">
							<span class="medicine_details_item_company"></span>
						</div>
						<div class="col-sm-6 col-6 text-left">
							<span class="medicine_details_item_stock"></span>
						</div>

						<div class="col-sm-6 col-6 text-right">
							<span class="medicine_details_item_scheme"></span>
						</div>
						
						<div class="col-sm-12 col-12 medicine_details_hr medicine_details_item_scheme_line text-center">
							Scheme is not added in Landing price
						</div>

						<div class="col-sm-12 col-12 medicine_details_hr medicine_details_item_description1">
						</div>

						<div class="col-sm-12 col-12 medicine_details_hr">
						</div>

						<div class="col-sm-6 col-6 text-left">
							<span class="medicine_details_item_ptr">
							</span>
						</div>
						<div class="col-sm-6 col-6 text-right">	
							<span class="medicine_details_item_mrp"></span>
						</div>
						<div class="col-sm-4 col-5 text-left">	
							<span class="medicine_details_item_gst"></span>
						</div>
						<div class="col-sm-8 col-7 text-right">
							<span class="medicine_details_item_price" title="*Approximate value ~"></span>
						</div>
						<div class="col-sm-12 col-12 medicine_details_hr">
						</div>
						<div class="col-sm-12 col-12 text-center">
						*Approximate billing value per unit, subject change . As per final invoice.
						</div>

						<div class="col-sm-12 col-12 medicine_details_hr">
						</div>

						<div class="col-sm-12 col-12" style="display:none">
							<span class="medicine_details_item_order_quantity" style="width:50%;float:left;margin-top:5px;">Order quantity
							</span>
							
							<span class="text-right" style="width:50%;float:left;margin-top:5px;">

								<input type="number" class="medicine_details_item_order_quantity_textbox" placeholder="Eg 1,2" name="quantity" required="" style="width:100px;float:right;" value="" title="Enter quantity" min="1" max="1000">

								<input type="hidden" class="medicine_details_item_quantity">
							</span>
						</div>

						<div class="col-sm-12 col-12 medicine_details_hr" style="display:none">
						</div>

						<div class="col-sm-12 col-12" style="display:none">
							<button type="submit" class="btn btn-primary mainbutton medicine_details_item_add_to_cart_btn"  onclick="medicine_add_to_cart_api()" title="Add to cart">Add to cart</button>

							<button type="submit" class="btn btn-primary mainbutton_disable medicine_details_item_add_to_cart_btn_disable" onclick="" title="Add to cart">Add to cart</button>

							<div class="medicine_details_item_add_to_cart_btn_loading text-center" style="display:none">
								<button type="submit" class="btn btn-primary mainbutton_disable" onclick="" title="Loading....">Loading....</button>
							</div>
						</div>

						<div class="col-sm-12 col-12 medicine_details_hr" style="display:none">
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-12 medicine_details_hr medicine_details_item_description2">
			</div>

			<div class="col-sm-12 col-12 medicine_details_hr">
			</div>
			<b>Images</b>
			<div class="row load_page_images"></div>
			<div class="col-sm-12 col-12 medicine_details_hr">
			</div>
			<b>Videos</b>
			<div class="row load_page_videos"></div>
		</div>
	</div>     
</div>
<input type="hidden" class="get_record" value="0">
<script>
/*$(window).scroll(function(){
	var scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
	if (scrollBottom<100){
		//alert(parseInt($(window).scrollTop()))
		$(".load_more").click()
	}
});*/
$(document).ready(function(){
	get_record=$(".get_record").val();
	call_page(get_record)
});
function load_more()
{
	get_record=$(".get_record").val();
	call_page(get_record)
}
var query_work = 0;
var no_record_found = 0;
function call_page(get_record)
{
	if(query_work=="0")
	{
		query_work = 1;
		$(".load_more").hide();
		$(".load_page_loading").html('<h1><center><img src="<?= base_url(); ?>/img_v<?= constant('site_v') ?>/loading.gif" width="100px"></center></h1><h1><center>Loading....</center></h1>');
		$.ajax({
			type       : "POST",
			data       :  {item_code:'<?= $item_code; ?>',user_type:'<?= $user_type; ?>',user_altercode:'<?= $user_altercode; ?>',user_password:'<?= $user_password; ?>',chemist_id:'<?= $chemist_id; ?>'} ,
			url        : "<?= constant('img_url_site');?>web_api/api01/get_medicine_use/",
			cache	   : false,
			error: function(){
				$(".load_page_loading").html("");
				$(".load_page").html('<h1><img src="<?= base_url(); ?>img_v<?= constant('site_v') ?>/something_went_wrong.png" width="100%"></h1>');
			},
			success    : function(data){
				if(data.get_result=="")
				{
					if(no_record_found=="0")
					{
						$(".load_page_loading").html("");
						$(".load_page").html('<h1><center><img src="<?= base_url(); ?>/img_v<?= constant('site_v') ?>/no_record_found.png" width="100%"></center></h1>');
					}
					else
					{
						$(".load_page_loading").html("");
						//$(".load_page").html("");
					}
				}
				else
				{
					$(".load_page_loading").html("");
				}
				console.log(data.items);
				$.each(data.result, function(i,row){
					$.each(row.medicine_details, function(i,item){
						$(".headertitle").html(item.item_name);
						
						
						$(".medicine_details_item_name").html(item.item_name);
						$(".medicine_details_item_packing").html("Packing : "+item.item_packing)
						$(".medicine_details_item_batch_no").html("Batch no : "+item.item_batch_no)

						$(".medicine_details_item_margin").html(item.item_margin+'% Margin')
						$(".medicine_details_item_expiry").html("Expiry : "+item.item_expiry)
						$(".medicine_details_item_company").html("By "+item.item_company)
						$(".medicine_details_item_stock").html("Stock : " +item.item_quantity)
						$(".medicine_details_item_scheme").html("Scheme : " +item.item_scheme)

						$(".medicine_details_item_description1").html(item.item_description1)
						$(".medicine_details_item_description1").show()
						
						if(item.item_description1=="")
						{
							$(".medicine_details_item_description1").hide()
						}

						$(".medicine_details_item_ptr").html('PTR : <i class="fa fa-inr" aria-hidden="true"></i> ' +item.item_ptr + "/-")
						$(".medicine_details_item_mrp").html('MRP : <i class="fa fa-inr" aria-hidden="true"></i> ' +item.item_mrp + "/-")
						$(".medicine_details_item_gst").html("GST : "+item.item_gst +"%")
						$(".medicine_details_item_price").html('*Approximate Value ~ : <i class="fa fa-inr" aria-hidden="true"></i> ' +item.item_price + "/-")

						$(".medicine_details_item_scheme_line").show()
						$(".medicine_details_item_scheme").show()
						if(item.item_scheme=="0+0")
						{
							$(".medicine_details_out_of_stock_img").hide()
							$(".medicine_details_item_scheme_line").hide()
							$(".medicine_details_item_scheme").hide()
						}

						if(item.item_featured=="1" && item.item_quantity!="0"){
							$(".medicine_details_featured_img").show()
						}

						if(parseInt(item.item_quantity)==0){
							
							$(".medicine_details_item_add_to_cart_btn_disable").show()
							$(".medicine_details_item_stock").html("<font color=red>Out of stock</font>")

							$(".medicine_details_out_of_stock_img").show()
							$(".medicine_details_item_scheme").hide()
							$(".medicine_details_item_scheme_line").hide()
						}else{
							$(".medicine_details_item_add_to_cart_btn").show()
						}

						if(item.item_stock!="")
						{
							$(".medicine_details_item_stock").html(item.item_stock)
						}

						$(".medicine_details_item_quantity").val(item.item_quantity)
						if(item.item_order_quantity){
							$(".medicine_details_item_order_quantity_textbox").val(item.item_order_quantity)
						}
						$(".medicine_details_item_order_quantity_textbox").focus()
						
						$(".medicine_details_image").attr("src",item.item_image)
						$(".medicine_details_image_small").attr("src",item.item_image)
					});
					$.each(row.medicine_use, function(i,item){
						if (item){
							file			= item.file;
							file_type		= item.file_type;
							
							image = video = "";
							if(file_type=="image"){
								image = '<img src="'+file+'" width="100%">';
							}
							
							if(file_type=="video"){
								video = '<video width="100%" height="250" controls="" poster="<?php echo base_url(); ?>img_v<?= constant('site_v') ?>/default-video-thumbnail.jpg"><source src="'+file+'" type="video/mp4">Your browser does not support the video tag.</video>';
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
				});
			},
			timeout: 10000
		});
	}
}
</script>
<script>
function show_sorting_div()
{
	$(".showbtn").hide();	
	$(".showbtn1").show();
	$(".sorting_div").show();
}
function hide_sorting_div()
{
	$(".showbtn").show();	
	$(".showbtn1").hide();
	$(".sorting_div").hide();
}

function sort_atoz()
{
	$(".sort_atoz").hide();
	$(".sort_ztoa").show();	
	hide_sorting_div();
	call_page("sort_atoz");
}
function sort_ztoa()
{	
	$(".sort_atoz").show();
	$(".sort_ztoa").hide();
	hide_sorting_div();
	call_page("sort_ztoa");
}
function sort_price()
{
	$(".sort_price").hide();
	$(".sort_price1").show();	
	hide_sorting_div();
	call_page("sort_price");
}
function sort_price1()
{	
	$(".sort_price").show();
	$(".sort_price1").hide();
	hide_sorting_div();
	call_page("sort_price1");
}
function sort_margin()
{
	$(".sort_margin").hide();
	$(".sort_margin1").show();	
	hide_sorting_div();
	call_page("sort_margin");
}
function sort_margin1()
{	
	$(".sort_margin").show();
	$(".sort_margin1").hide();
	hide_sorting_div();
	call_page("sort_margin1");
}
</script>
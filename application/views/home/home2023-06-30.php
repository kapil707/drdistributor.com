<style>

.menubtn2,.homebtn_div

{

	display:none;

}

.headertitle

{

	margin-top: -5px;

}

.headertitle1

{

	display:block !important;

}

</style>

<?php

$ua = strtolower($_SERVER["HTTP_USER_AGENT"]);

$isMob = is_numeric(strpos($ua, "mobile"));



$default_img = base_url()."/uploads/default_img.jpg";

$error_img ="onerror=this.src=".base_url()."/uploads/default_img.jpg";

?>

<div class="container-fluid maincontainercss">

	<div class="row">

		<?php foreach($tbl_home as $row) { ?>

		<?php if($row->type=="slider" && $row->category_id=="1"){ ?>

		<?php

		$top_flash 	= $this->Chemist_Model->top_flash();

		$top_flash 	= '['.$top_flash.']';

		$top_flash 	= json_decode($top_flash, true);

		?>

		<div class="col-xs-12 col-sm-12 col-12 wow fadeInDown animated" data-wow-duration="0.1s" data-wow-delay="0.2s">		

			<?php /* <img src="<?= base_url(); ?>/uploads/default_img.jpg" class="top_flash_loading">		

			<div id="jssor_1" style="display:none"> */ ?>

			<div id="jssor_1">

				<!-- Loading Screen -->

				<div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">

					<img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" alt>

				</div>

				<div data-u="slides" class="top_flash_div">

					<?php foreach($top_flash as $row1) { ?>

						<div><img src="<?php echo $row1["image"]; ?>" data-u="image" class="img_css_forslider" alt="" <?php echo $error_img; ?>></div>

					<?php } ?>

				</div>

				<!-- Bullet Navigator -->

				<div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">

					<div data-u="prototype" class="i" style="width:16px;height:16px;">

						<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">

							<circle class="b" cx="8000" cy="8000" r="5800"></circle>

						</svg>

					</div>

				</div>

				<!-- Arrow Navigator -->51

				<div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:35px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">

					<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">

						<polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>

					</svg>
51
				</div>

				<div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:35px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">

					<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">

						<polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>

					</svg>51

				</div>

			</div>

		</div>

		<script>
51
		jssor_1_slider_init();

		</script>

		<?php } 

		if($row->type=="slider" && $row->category_id=="2"){ ?>

		<?php51

		$top_flash2 = $this->Chemist_Model->top_flash2();

		$top_flash2 = '['.$top_flash2.']';

		$top_flash2 = json_decode($top_flash2, true);

		?>
51
		<div class="col-xs-12 col-sm-12 col-12 p-1">

			<div id="flash2" class="carousel slide" data-ride="carousel">

				<?php /* <div class="carousel-inner top_flash2_div">

					<img src="<?= base_url(); ?>/uploads/default_img.jpg" class="top_flash_loading">

				</div> */?>51

				<div class="carousel-inner">

					<?php 

					foreach($top_flash2 as $row1) { ?>

						<div class="carousel-item <?php 51

							<img src="<?php echo $row1["image"]; ?>" class="" alt="" <?php echo $error_img; ?>>

						</div>

					<?php } ?>

				</div>

				<a class="carousel-control-prev" href="#flash2" data-slide="prev">

					<span class="carousel-control-prev-icon"></span>

				</a>

				<a class="carousel-control-next" href="#flash2" data-slide="next">

					<span class="carousel-control-next-icon"></span>

				</a>

			</div>

		</div>

		<?php } ?>



		<?php if($row->type=="menu"){ ?>

		<div class="col-xs-12 col-sm-12 col-12" style="margin-top:10px;">51

			<div class="home_menu_main_div wow fadeInDown animated" data-wow-duration="0.1s" data-wow-delay="0.2s">

				<a href="<?= base_url('home/search_medicine')?>" style="color:black">

					<div class="text-center">

						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/homebtn1.png" class="img-fluid img-responsive" alt>

						<div class="home_menu_main_btn">New order</div>

					</div>

				</a>

			</div>

			51

			<div class="home_menu_main_div wow fadeInDown animated" data-wow-duration="0.3s" data-wow-delay="0.2s">

				<a href="<?= base_url('home/my_cart')?>"  style="color:black">

					<div class="text-center">

						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/homebtn2.png" class="img-fluid img-responsive" alt>

						<div class="home_menu_main_btn">Draft <span class="mycartwalidiv1"></span></div>

					</div>

				</a>

			</div>

			

			<div class="home_menu_main_div wow fadeInDown animated" data-wow-duration="0.4s" data-wow-delay="0.2s">

				<a href="<?= base_url('home/my_order')?>" style="color:black" title="My orders">

					<div class="text-center">

						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/homebtn3.png" class="img-fluid img-responsive" alt>

						<div class="home_menu_main_btn">My order</div>

					</div>

				</a>

			</div>

			

			<div class="home_menu_main_div wow fadeInDown animated" data-wow-duration="0.5s" data-wow-delay="0.2s">

				<a href="<?= base_url('home/my_invoice')?>" style="color:black" title="My invoices">

					<div class="text-center">

						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/homebtn4.png" class="img-fluid img-responsive" alt>

						<div class="home_menu_main_btn">My invoice</div>

					</div>

				</a>

			</div>

			

			<div class="home_menu_main_div wow fadeInDown animated" data-wow-duration="0.6s" data-wow-delay="0.2s">

				<a href="<?= base_url('home/track_order')?>" style="color:black" title="Track order">

					<div class="text-center">

						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/homebtn5.png" class="img-fluid img-responsive" alt>

						<div class="home_menu_main_btn">Track order</div>

					</div>

				</a>

			</div>

			<?php if($isMob=="1"){ ?>

			<div class="home_menu_main_div wow fadeInDown animated" data-wow-duration="0.7s" data-wow-delay="0.2s">

				<a href="<?= base_url('home/my_notification')?>" title="Notifications">

					<div class="text-center">

						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/homebtn7.png" class="img-fluid img-responsive" alt>

						<div class="home_menu_main_btn">Notification</div>

					</div>

				</a>

			</div>

			<?php } else { ?>

			<div class="home_menu_main_div wow fadeInDown animated" data-wow-duration="0.8s" data-wow-delay="0.2s">

				<a href="<?= base_url('import_order')?>" title="Upload order">

					<div class="text-center">

						<img src="<?= base_url()?>img_v<?= constant('site_v') ?>/homebtn6.png" class="img-fluid img-responsive" alt>

						<div class="home_menu_main_btn">Upload order</div>

					</div>

				</a>

			</div>

			<div class="home_menu_main_div wow fadeInDown animated" data-wow-duration="0.9s" data-wow-delay="0.2s">

				<a href="<?= base_url('home/my_notification')?>" title="Notifications">

					<div class="text-center">

						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/homebtn7.png" class="img-fluid img-responsive" alt>

						<div class="home_menu_main_btn">Notification</div>

					</div>

				</a>

			</div>

			<?php } ?>

		</div>51



		<?php if($_COOKIE['user_type']=="chemist") { ?>

		<div class="col-sm-6 wow fadeInLeft animated" data-wow-duration="0.10s" data-wow-delay="0.2s">

			<h2 class="home_page_new_box_inv_title">

				<a href="<?= base_url('home/my_invoice')?>" title="My invoice">

					My invoice

				</a>

			</h2>

			<div class="website_box_part home_page_new_box_inv">

				<div class="home_page_my_invoice"></div>

			</div>

		</div>



		<div class="col-sm-6 wow fadeInRight animated" data-wow-duration="0.11s" data-wow-delay="0.2s">

			<h2 class="home_page_new_box_inv_title">

			<a href="<?= base_url('home/my_notification')?>" title="Notifications">My Notification</a></h2>

			<div class="website_box_part home_page_new_box_inv">

				<div class="home_page_my_notification"></div>

			</div>

		</div>

	<?php } ?>



	<?php } ?>

	

	<?php if($row->type=="divisioncategory"){ ?>

		<?php /* style="background-image: url('<?php echo base_url(); ?>img_v<?= constant('site_v') ?>/topbrand.jpg');background-repeat: no-repeat;" */?>

		<?php 

		$result = $this->Chemist_Model->medicine_division_wise_json_50($row->category_id); 

		$result1 = '['.$result["items"].']';

		$result1 = json_decode($result1, true);

		?>

		<?php /* <div class="col-xs-12 col-sm-12 col-12 divisioncategory_div_<?php echo $row->category_id ?>"> */ ?>

		<div class="col-xs-12 col-sm-12 col-12">

			<div class="featured_home_title1 wow fadeInDown animated" data-wow-duration="0.4s" data-wow-delay="0.5s">

				<h1 class="heading_home1">

					<?php /*<span class="divisioncategory_title_<?php echo $row->category_id ?>"> */ ?>

					<span>

						<?php echo $result["title"] ?>

					</span>

				</h1>

			</div>

			<div class="row">
51
				<div class="col-sm-5">51

					<img src="<?php echo base_url(); ?>img_v<?= constant('site_v') ?>/heart.png" width="100%" class="wow fadeInLeft animated" data-wow-duration="0.4s" data-wow-delay="0.5s">

				</div>

				<div class="col-sm-7">

					<div class="featured_home" id="featured_home">

						<?php /*<ul class="divisioncategory_css divisioncategory_result_<?php echo $row->category_id ?>"> */ ?>

						<ul class="divisioncategory_css">

							<?php foreach($result1 as $row1) { ?>

							<li class="wow fadeInRight animated" data-wow-duration="0.4s" data-wow-delay="0.5s">

								<div class="home_main_div">

									<div class="image1">

										<a href="<?= base_url(); ?>home/medicine_category/featured_brand/<?php echo $row1["item_code"] ?>/<?php echo $row1["item_division"] ?>">

											<img src="<?php echo $default_img ?>" class="b-lazy" data-src="<?php echo $row1["item_image"] ?>" alt="">

										</a>

									</div>

									<div class="content" style="padding-top:5px;">

										<a href="<?= base_url(); ?>home/medicine_category/featured_brand/<?php echo $row1["item_code"] ?>/<?php echo $row1["item_division"] ?>">

											<div class="medicine_details_item_company">

												<?php echo $row1["item_company"] ?>

											</div>

										</a>

									</div>

								</div>

							</li>

							<?php } ?>

						</ul>

					</div>

				</div>

			</div>

		</div>

		<?php } ?>	

	

	

		<?php if($row->type=="itemcategory"){  ?>

		<?php /* <div class="col-xs-12 col-sm-12 col-12 itemcategory_div_<?php echo $row->category_id ?>"> */ ?>

		<div class="col-xs-12 col-sm-12 col-12">

		<?php 

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

		

		$result = $this->Chemist_Model->medicine_item_wise_json_50($session_yes_no,$row->category_id,$user_type,$user_altercode,$salesman_id);

		$result1 = '['.$result["items"].']';

		$result1 = json_decode($result1, true);
51
		?>

			<div class="featured_home_title wow fadeInDown animated" data-wow-duration="0.4s" data-wow-delay="0.5s">
51
				<h1 class="heading_home">

					<a href="<?= base_url(); ?>home/medicine_category/medicine_item_wise/<?php echo $row->category_id ?>" title="<?php echo $result["title"] ?>">	

					<?php /*<span class="itemcategory_title_<?php echo $row->category_id ?>"> */ ?>

						<span>

							<?php echo $result["title"] ?>

						</span>

					</a>

				</h1>

			</div>

			<?php if($row->category_id%2==0) { ?>
51
			<div class="row">

				<div class="col-sm-7">

					<div class="featured_home" id="featured_home">

						<ul class="itemcategory_css">

						<?php 

						$i = 1;

						foreach($result1 as $row1) { 

						if($i==11){

							break;

						}

						$i++;

						echo "<span class='medicine_details_all_data_".$row1["item_code"]."' item_image='".$row1["item_image"]."' item_name='".$row1["item_name"]."' item_packing='".$row1["item_packing"]."' item_expiry='".$row1["item_expiry"]."' item_company='".$row1["item_company"]."' item_quantity='".$row1["item_quantity"]."' item_stock='".$row1["item_stock"]."' item_ptr='".$row1["item_ptr"]."' item_mrp='".$row1["item_mrp"]."' item_price='".$row1["item_price"]."' item_scheme='".$row1["item_scheme"]."' item_margin='".$row1["item_margin"]."' item_featured='".$row1["item_featured"]."' item_description1='".$row1["item_description1"]."' similar_items='".$row1["similar_items"]."'></span>";



						$item_other_image_div = '';

						if($row1["item_featured"]=="1" && $row1["item_quantity"]!="0"){

							$item_other_image_div = '<img src="'.base_url().'img_v'.constant('site_v').'/fe51dicine_cart_item_featured_img">';

						}



						if($row1["item_quantity"]==0) {

							$item_other_image_div = '<img src="'.base_url().'img_v'.constant('site_v').'/out_of_stock_img.png" class="medicine_cart_item_out_of_stock_img">';

						}

						?>

						<li class="wow fadeInLeft animated" data-wow-duration="0.4s" data-wow-delay="0.5s">

							<div class="home_main_div">

								<div class="image">

									<a href="javascript:void(0)" onClick="medicine_details_funcation('<?php echo $row1["item_code"] ?>')" title="<?php echo $row1["item_name"] ?> (<?php echo $row1["item_packing"] ?> Packing)">	

										<?php echo $item_other_image_div?>

										<img src="<?php echo $default_img ?>" class="b-lazy medicine_cart_item_image" data-src="<?php echo $row1["item_image"] ?>" alt="">

									</a>

								</div>

								<div class="content">

									<a href="javascript:void(0)" onClick="medicine_details_funcation('<?php echo $row1["item_code"] ?>')" title="<?php echo $row1["item_name"] ?> (<?php echo $row1["item_packing"] ?> Packing)"	>

										<div class="medicine_cart_item_name">

											<?php echo $row1["item_name"] ?>

											<span class="medicine_cart_item_packing"> 

												(<?php echo $row1["item_packing"] ?> Packing)

											</span>

										</div>

										<div class="medicine_cart_item_margin">

											<?php echo $row1["item_margin"] ?>% Margin

										</div>

										<div class="medicine_cart_item_company">

											By <?php echo $row1["item_company"] ?>

										</div>

										<div class="medicine_cart_item_price">

											~ <i class="fa fa-inr" aria-hidden="true"></i>

											<?php echo $row1["item_price"] ?>/-

										</div>

									</a>

								</div>

							</div>

						</li>

						<?php } ?>

						</ul>

					</div>

				</div>

				<div class="col-sm-5 wow fadeInRight animated" data-wow-duration="0.4s" data-wow-delay="0.5s">

					<img src="<?php echo base_url(); ?>img_v<?= constant('site_v') ?>/heart.png" width="100%">

				</div>

			</div>

			<?php } else { ?>	

			<section class="featured_home" id="featured_home">

				<div class="swiper featured_home-slider featured-slider1">

					<?php /* <div class="swiper-wrapper itemcategory_result_<?php echo $row->category_id ?>"> */ ?>

					<div class="swiper-wrapper">



					<?php foreach($result1 as $row1) { ?>

						<?php

						echo "<span class='medicine_details_all_data_".$row1["item_code"]."' item_image='".$row1["item_image"]."' item_name='".$row1["item_name"]."' item_packing='".$row1["item_packing"]."' item_expiry='".$row1["item_expiry"]."' item_company='".$row1["item_company"]."' item_quantity='".$row1["item_quantity"]."' item_stock='".$row1["item_stock"]."' item_ptr='".$row1["item_ptr"]."' item_mrp='".$row1["item_mrp"]."' item_price='".$row1["item_price"]."' item_scheme='".$row1["item_scheme"]."' item_margin='".$row1["item_margin"]."' item_featured='".$row1["item_featured"]."' item_description1='".$row1["item_description1"]."' similar_items='".$row1["similar_items"]."'></span>";



						$item_other_image_div = '';

						if($row1["item_featured"]=="1" && $row1["item_quantity"]!="0"){

							$item_other_image_div = '<img src="'.base_url().'img_v'.constant('site_v').'/featured_img.png" class="medicine_cart_item_featured_img">';

						}



						if($row1["item_quantity"]==0) {

							$item_other_image_div = '<img src="'.base_url().'img_v'.constant('site_v').'/out_of_stock_img.png" class="medicine_cart_item_out_of_stock_img">';

						}

						?>

						<div class="swiper-slide box wow fadeInLeft animated" data-wow-duration="0.4s" data-wow-delay="0.4s">

							<div class="mcs-items-container">

								<div class="home_main_div">

									<div class="image">

										<a href="javascript:void(0)" onClick="medicine_details_funcation('<?php echo $row1["item_code"] ?>')"title="<?php echo $row1["item_name"] ?> (<?php echo $row1["item_packing"] ?> Packing)">	

											<?php echo $item_other_image_div?>

											<img src="<?php echo $default_img ?>" class="b-lazy medicine_cart_item_image" data-src="<?php echo $row1["item_image"] ?>" alt="">

										</a>

									</div>

									<div class="content">

										<a href="javascript:void(0)" onClick="medicine_details_funcation('<?php echo $row1["item_code"] ?>')"title="<?php echo $row1["item_name"] ?> (<?php echo $row1["item_packing"] ?> Packing)">

											<div class="medicine_cart_item_name">

												<?php echo $row1["item_name"] ?>

												<span class="medicine_cart_item_packing"> 

													(<?php echo $row1["item_packing"] ?> Packing)

												</span>

											</div>

											<div class="medicine_cart_item_margin">

												<?php echo $row1["item_margin"] ?>% Margin

											</div>

											<div class="medicine_cart_item_company">

												By <?php echo $row1["item_company"] ?>

											</div>

											<div class="medicine_cart_item_price">

												~ <i class="fa fa-inr" aria-hidden="true"></i>

												<?php echo $row1["item_price"] ?>/-

											</div>

										</a>

									</div>

								</div>

							</div>

						</div>

					<?php } ?>

					</div>

					<div class="swiper-button-next"></div>

					<div class="swiper-button-prev"></div>

				</div>

			</section>

			<?php } ?>

		</div>

		<?php } ?>

		<?php } ?>

	</div>

</div>

<?php

$broadcast_status = $this->Scheme_Model->get_website_data("broadcast_status");

if($broadcast_status=="1"){ ?>

	<script>

	setTimeout(function() {

		$('.broadcast_title').html("<?= $this->Scheme_Model->get_website_data("broadcast_title"); ?>");

		$('.broadcast_message').html("<?= $this->Scheme_Model->get_website_data("broadcast_message"); ?>");

        $('.myModal_broadcast').click();

    }, 2000);

	</script>

	<?php

}

?>

<script>

/*************************************** */

var my_notification_no_record_found = 0;

var my_invoice_no_record_found = 0;

function home_page_load()

{

	$(".home_page_my_notification").html('<h1><center><img src="<?= base_url(); ?>/img_v<?= constant('site_v') ?>/loading.gif" width="100px"></center></h1><h1><center>Loading....</center></h1>');

	$(".home_page_my_invoice").html('<h1><center><img src="<?= base_url(); ?>/img_v<?= constant('site_v') ?>/loading.gif" width="100px"></center></h1><h1><center>Loading....</center></h1>');

	id ='';

	$.ajax({

		type       : "POST",

		data       :  { id:id} ,

		url        : "<?php echo base_url(); ?>Chemist_json/home_page_web",

		cache	   : true,

		success : function(data){

			//alert(data)

			if(data!="")

			{

				<?php foreach($tbl_home as $row) { ?>

				<?php if($row->type=="slider" && $row->category_id=="1"){ ?>

					/*$(".top_flash_div").html('');



					$.each(data.get_result, function(i,work){	

						$.each(work.top_flash, function(i,item){

							if (item){

								

								division 	= item.division;

								funtype		= item.funtype;

								itemid 		= item.itemid;

								compname	= item.compname;

								image 		= item.image;



								if(division){

									division="not";

								}

								error_img ="onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'"



								$(".top_flash_div").append('<div><img src="'+image+'" data-u="image" class="img_css_forslider" alt="" '+error_img+'></div>');

							}

						});

					});

					/*$("#jssor_1").show();

					$(".top_flash_loading").hide();

					jssor_1_slider_init();	*/



				<?php } if($row->type=="slider" && $row->category_id=="2"){ ?>

					$(".top_flash2_div").html('');



					$.each(data.get_result, function(i,work){

						$.each(work.top_flash2, function(i,item){	

							if (item){



								id 			= item.id;

								funtype 	= item.funtype;

								itemid 		= item.itemid;

								division 	= item.division;

								image 		= item.image;

								compname 	= item.compname;



								error_img ="onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'"

								

								$(".top_flash2_div").append('<div class="carousel-item '+id+'"><img src="'+image+'" class="" alt="" '+error_img+'></div>');

							}

						});

					});

				<?php } ?>



				<?php if($row->type=="divisioncategory"){ ?>

				

				$(".divisioncategory_result_<?php echo $row->category_id; ?>").html('');

				$.each(data.get_result, function(i,work){

					title 	= work.divisioncategory_title_<?php echo $row->category_id; ?>;

					$(".divisioncategory_title_<?php echo $row->category_id; ?>").html(title);

					$.each(work.divisioncategory_result_<?php echo $row->category_id; ?>, function(i,item){	

						if (item){

							

							item_code 		= item.item_code;

							item_company 	= item.item_company;

							item_division 	= item.item_division;

							item_image 		= item.item_image;



							$(".divisioncategory_result_<?php echo $row->category_id; ?>").append('<li class="wow fadeInRight animated" data-wow-duration="2s" data-wow-delay="5s"><div class="home_main_div"><div class="image1"><a href="<?= base_url(); ?>home/medicine_category/featured_brand/'+item_code+'/'+item_division+'"><img src="'+item_image+'" alt=""></a></div><div class="content" style="padding-top:5px;"><a href="<?= base_url(); ?>home/featured_brand/'+item_code+'/'+item_division+'"><div class="medicine_details_item_company">'+item_company+'</div></a></div></div></li>');

						}

					});

				});

				<?php } ?>

				

				<?php if($row->type=="itemcategory"){ ?>

				

				$(".itemcategory_result_<?php echo $row->category_id; ?>").html('');

				$.each(data.get_result, function(i,work){

					title = work.itemcategory_title_<?php echo $row->category_id; ?>;

					$(".itemcategory_title_<?php echo $row->category_id; ?>").html(title);

					if(work.itemcategory_title_<?php echo $row->category_id; ?>==""){

						$(".itemcategory_div_<?php echo $row->category_id; ?>").hide()

					}

					$.each(work.itemcategory_result_<?php echo $row->category_id; ?>, function(i,item){	

						if (item){



							item_code			= item.item_code;

							item_image			= item.item_image;

							item_name 			= item.item_name;

							item_packing 		= item.item_packing;

							item_expiry 		= item.item_expiry;

							item_company 		= item.item_company;

							item_quantity 		= item.item_quantity;

							item_stock 			= item.item_stock;

							item_ptr 			= item.item_ptr;

							item_mrp 			= item.item_mrp;

							item_price 			= item.item_price;

							item_scheme 		= item.item_scheme;

							item_margin 		= item.item_margin;

							item_featured 		= item.item_featured;

							item_description1 	= item.item_description1;

							similar_items 		= item.similar_items;



							div_all_data = "<div class='medicine_details_all_data_"+item_code+"' item_image='"+item_image+"' item_name='"+item_name+"' item_packing='"+item_packing+"' item_expiry='"+item_expiry+"' item_company='"+item_company+"' item_quantity='"+item_quantity+"' item_stock='"+item_stock+"' item_ptr='"+item_ptr+"' item_mrp='"+item_mrp+"' item_price='"+item_price+"' item_scheme='"+item_scheme+"' item_margin='"+item_margin+"' item_featured='"+item_featured+"' item_description1='"+item_description1+"' similar_items='"+similar_items+"'></div>"



							error_img ="onerror=this.src='<?= base_url(); ?>/uploads/default_img.jpg'";



							item_other_image_div = '';

							if(item_featured=="1" && item_quantity!="0"){

								item_other_image_div = '<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/featured_img.png" class="medicine_cart_item_featured_img">';

							}



							if(item_quantity==0) {

								item_other_image_div = '<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/out_of_stock_img.png" class="medicine_cart_item_out_of_stock_img">';

							}



							margin_div = '<div class="medicine_cart_item_margin">'+item_margin+'% Margin</div>';

							

							$(".itemcategory_result_<?php echo $row->category_id; ?>").append('<div class="swiper-slide box"><div class="mcs-items-container"><div class="home_main_div"><div class="image"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')">'+item_other_image_div+'<img src="'+item_image+'" alt="" '+error_img+' class="medicine_cart_item_image"></a></div><div class="content"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')"><div class="medicine_cart_item_name">'+item_name+'<span class="medicine_cart_item_packing"> ('+item_packing+' Packing)</span></div>'+margin_div+'<div class="medicine_cart_item_company">By '+item_company+'</div><div class="medicine_cart_item_price">~ <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</div></a></div></div></div></div>'+div_all_data);

						

							/*$(".itemcategory_result_<?php echo $row->category_id; ?>").append('<div class="swiper-slide box"><div class="mcs-items-container"><div class="home_main_div"><div class="image"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')">'+item_other_image_div+'<img src="'+item_image+'" alt="" '+error_img+' class="medicine_cart_item_image"></a></div><div class="content"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')"><div class="medicine_cart_item_name">'+item_name+'<span class="medicine_cart_item_packing"> ('+item_packing+' Packing)</span></div>'+margin_div+'<div class="medicine_cart_item_company">By '+item_company+'</div><div class="medicine_cart_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/-</div><div class="medicine_cart_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/-</div><div class="medicine_cart_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</div></a></div></div></div></div>'+div_all_data);*/

						}

					});

				});



				<?php } ?>

				<?php } ?>



				$.each(data.get_result, function(i,work){

					if(work.my_notification=="")

					{

						if(my_notification_no_record_found=="0")

						{

							$(".home_page_my_notification").html('<h1><center><img src="<?= base_url(); ?>/img_v<?= constant('site_v') ?>/no_record_found.png" width="100%"></center></h1>');

						}

						else

						{

							$(".home_page_my_notification").html("");

						}

					}

					$.each(work.my_notification, function(i,item){	

						if (item){

						

							if(my_notification_no_record_found=="0"){

								my_notification_no_record_found=1;

								$(".home_page_my_notification").html("");

							}



							item_id 			= item.item_id;

							item_title 			= item.item_title;

							item_message 		= item.item_message;

							item_date_time 		= item.item_date_time;

							item_image 			= item.item_image;

							

							$(".home_page_my_notification").append('<div class="main_theme_li_bg"><a href="<?php echo base_url() ?>home/my_notification_details/'+item_id+'"><div class="medicine_my_page_div1"><img src="'+item_image+'" alt="" title="" onerror=this.src="<?= base_url(); ?>/uploads/default_img.jpg" class="medicine_cart_item_image"></div><div class="medicine_my_page_div2 text-left"><div class="medicine_cart_item_name">'+item_title+'</div><div class="medicine_cart_item_price">'+item_message+'</div><div class="medicine_cart_item_datetime">'+item_date_time+'</div></div></a></div>');

						}

					});

				});



				$.each(data.get_result, function(i,work){

					if(work.my_invoice=="")

					{

						if(my_invoice_no_record_found=="0")

						{

							$(".home_page_my_invoice").html('<h1><center><img src="<?= base_url(); ?>/img_v<?= constant('site_v') ?>/no_record_found.png" width="100%"></center></h1>');

						}

						else

						{

							$(".home_page_my_invoice").html("");

						}

					}



					$.each(work.my_invoice, function(i,item){	

						if (item){



							if(my_invoice_no_record_found=="0"){

								my_invoice_no_record_found=1;

								$(".home_page_my_invoice").html("");

							}



							item_id	 		= item.item_id;

							item_title 		= item.item_title;

							item_total 		= item.item_message;

							item_date_time 	= item.item_date_time;

							out_for_delivery= item.out_for_delivery;

							delete_status	= item.delete_status;

							download_url	= item.download_url;

							item_image 		= item.item_image;



							download_url	= "onclick=download_invoice('"+download_url+"')";



							if(out_for_delivery!="")

							{

								out_for_delivery = ' | Out For Delivery Date Time : ' + out_for_delivery;

							}



							delete_status_div = "";

							if(delete_status==1)

							{

								delete_status_div = '<div class="medicine_cart_item_datetime">Some items have been deleted / modified in this order</div>';

							}



							$(".home_page_my_invoice").append('<div class="main_theme_li_bg"><div class="medicine_my_page_div1"><a href="<?php echo base_url() ?>home/my_invoice_details/'+item_id+'"><img src="'+item_image+'" alt="" title="" onerror=this.src="<?= base_url(); ?>/uploads/default_img.jpg" class="medicine_cart_item_image"></a></div><div class="medicine_my_page_div2 text-left"><div class=""><a href="<?php echo base_url() ?>home/my_invoice_details/'+item_id+'"><span class="medicine_cart_item_name">'+item_title+'</span></a><span style="float: right;color: red;" '+download_url+'>Download Invoice</span></div><a href="<?php echo base_url() ?>home/my_invoice_details/'+item_id+'"><div class="medicine_cart_item_price">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_total+'/-</div><div class="medicine_cart_item_datetime">Invoice Date : '+item_date_time+''+out_for_delivery+'</div>'+delete_status_div+'</div></a></div>');

						}

					});

				});

			}

		},

		timeout: 10000

	});

}

//home_page_load();



function download_invoice(url){

	window.open(url, '_blank');

	window.close();

}

</script>



<script src="<?php echo base_url(); ?>/assets/website/wow_css_js/wow.js"></script>
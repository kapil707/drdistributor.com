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
<div class="container-fluid maincontainercss">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-12">
			<img src="<?= base_url(); ?>/uploads/default_img.jpg" class="top_flash_loading">		
			<div id="jssor_1" style="display:none">
				<!-- Loading Screen -->
				<div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
					<img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" alt>
				</div>
				<div data-u="slides" class="top_flash_div">
					<?php
					foreach($top_flash as $row)
					{
						if(empty($row["division"])){
							$row["division"]="not";
						}
						?>
						<div>
							<a href="javascript:callandroidfun('<?= $row["funtype"] ?>','<?= $row["itemid"] ?>','<?= base64_encode($row["compname"])?>','<?= $row["image"] ?>','<?= $row["division"] ?>');">
								<img src="<?= $row["image"] ?>" data-u="image" class="img_css_forslider" alt="" onerror="this.src='<?= base_url(); ?>/uploads/default_img.jpg'">
							</a>
						</div>
					<?php 
					} ?>
				</div>
				<!-- Bullet Navigator -->
				<div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
					<div data-u="prototype" class="i" style="width:16px;height:16px;">
						<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
							<circle class="b" cx="8000" cy="8000" r="5800"></circle>
						</svg>
					</div>
				</div>
				<!-- Arrow Navigator -->
				<div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:35px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
					<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
						<polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
					</svg>
				</div>
				<div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:35px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
					<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
						<polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
					</svg>
				</div>
			</div>
			
		</div>
				

		<div class="col-xs-12 col-sm-12 col-12">
			<?php if(!empty($result0)){ }?>
			<div class="featured_home_title">
				<h1 class="heading_home"><span><?php echo $title0; ?></span></h1>
			</div>
			<section class="featured_home" id="featured_home">
				<div class="swiper featured_home-slider featured-slider">
					<div class="swiper-wrapper home_page_result0">

						<div class="swiper-slide box">
							<div class="mcs-items-container1">
								<div class="home_main_div">
									<div class="image1">
										<a href="">
											<img src="<?= base_url(); ?>/uploads/default_img.jpg" alt="">
										</a>
									</div>
									<div class="content" style="padding-top:5px;">
										<a href="">
											<div class="medicine_details_item_company">
												Loading....
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>

						<div class="swiper-slide box">
							<div class="mcs-items-container1">
								<div class="home_main_div">
									<div class="image1">
										<a href="">
											<img src="<?= base_url(); ?>/uploads/default_img.jpg" alt="">
										</a>
									</div>
									<div class="content" style="padding-top:5px;">
										<a href="">
											<div class="medicine_details_item_company">
												Loading....
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>

						<div class="swiper-slide box">
							<div class="mcs-items-container1">
								<div class="home_main_div">
									<div class="image1">
										<a href="">
											<img src="<?= base_url(); ?>/uploads/default_img.jpg" alt="">
										</a>
									</div>
									<div class="content" style="padding-top:5px;">
										<a href="">
											<div class="medicine_details_item_company">
												Loading....
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="swiper-button-next swiper-button-next1"></div>
					<div class="swiper-button-prev swiper-button-prev1"></div>
				</div>
			</section>
			
		</div>

		<div class="col-xs-12 col-sm-12 col-12">
			<div class="featured_home_title">
				
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-12 col-12">
			<div class="home_menu_main_div">
				<a href="<?= base_url('home/search_medicine')?>" style="color:black">
					<div class="text-center">
						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/homebtn1.png" class="img-fluid img-responsive" alt>
						<div class="home_menu_main_btn">New order</div>
					</div>
				</a>
			</div>
			
			<div class="home_menu_main_div">
				<a href="<?= base_url('home/my_cart')?>"  style="color:black">
					<div class="text-center">
						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/homebtn2.png" class="img-fluid img-responsive" alt>
						<div class="home_menu_main_btn">Draft <span class="mycartwalidiv1"></span></div>
					</div>
				</a>
			</div>
			
			<div class="home_menu_main_div">
				<a href="<?= base_url('home/my_order')?>" style="color:black" title="My orders">
					<div class="text-center">
						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/homebtn3.png" class="img-fluid img-responsive" alt>
						<div class="home_menu_main_btn">My order</div>
					</div>
				</a>
			</div>
			
			<div class="home_menu_main_div">
				<a href="<?= base_url('home/my_invoice')?>" style="color:black" title="My invoices">
					<div class="text-center">
						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/homebtn4.png" class="img-fluid img-responsive" alt>
						<div class="home_menu_main_btn">My invoice</div>
					</div>
				</a>
			</div>
			
			<div class="home_menu_main_div">
				<a href="<?= base_url('home/track_order')?>" style="color:black" title="Track order">
					<div class="text-center">
						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/homebtn5.png" class="img-fluid img-responsive" alt>
						<div class="home_menu_main_btn">Track order</div>
					</div>
				</a>
			</div>
			
			<div class="home_menu_main_div mobile_off">
				<a href="<?= base_url('import_order')?>" title="Upload order">
					<div class="text-center">
						<img src="<?= base_url()?>img_v<?= constant('site_v') ?>/homebtn6.png" class="img-fluid img-responsive" alt>
						<div class="home_menu_main_btn">Upload order</div>
					</div>
				</a>
			</div>
			
			<div class="home_menu_main_div">
				<a href="<?= base_url('home/my_notification')?>" title="Notifications">
					<div class="text-center">
						<img src="<?= base_url() ?>img_v<?= constant('site_v') ?>/homebtn7.png" class="img-fluid img-responsive" alt>
						<div class="home_menu_main_btn">Notification</div>
					</div>
				</a>
			</div>
		</div>
	</div>

	<?php if($_COOKIE['user_type']=="chemist") { ?>
	<div class="row">
		<div class="col-sm-6">			
			<h2 class="home_page_new_box_inv_title">
				<a href="<?= base_url('home/my_invoice')?>" title="My invoice">
					My invoice
				</a>
			</h2>
			<div class="website_box_part home_page_new_box_inv">
				<div class="home_page_my_invoice"></div>
			</div>
		</div>

		<div class="col-sm-6">
			<h2 class="home_page_new_box_inv_title">
			<a href="<?= base_url('home/my_notification')?>" title="Notifications">My Notification</a></h2>
			<div class="website_box_part home_page_new_box_inv">
				<div class="home_page_my_notification"></div>
			</div>
		</div>
	</div>
	<?php } ?>
	
	<div class="row">
		<div class="col-sm-12">
			<?php 
			if(!empty($result1)){ }?>
			<div class="featured_home_title">
				<h1 class="heading_home">
					<span>
						<a href="<?= base_url(); ?>home/medicine_category/medicine_category1">
							<?php foreach($result1 as $row) { }?>
							<?php echo $row["item_header_title"]; ?>
						</a>
					</span>
				</h1>
			</div>
			<section class="featured_home" id="featured_home">
				<div class="swiper featured_home-slider featured-slider1">
					<div class="swiper-wrapper home_page_result1">
						<?php
						foreach($result1 as $row)
						{
							if($_COOKIE['user_type']==""){
								$row["item_mrp"] 		= "xx.xx";
								$row["item_ptr"] 		= "xx.xx";
								$row["item_price"]		= "xx.xx";
								$row["item_margin"] 	= "xx";
							}
							$item_featured = $row["item_featured"];
							$item_quantity = $row["item_quantity"];
							
							$item_other_image_div = '';
							if($item_featured=="1" && $item_quantity!="0"){
								$item_other_image_div = '<img src="'.base_url().'img_v'.constant("site_v").'/featured_img.png" class="medicine_cart_item_featured_img">';
							}

							if($item_quantity==0) {
								$item_other_image_div = '<img src="'.base_url().'img_v'.constant("site_v").'/out_of_stock_img.png" class="medicine_cart_item_out_of_stock_img">';
							}

							$margin_div = '<div class="medicine_cart_item_margin">'.$row["item_margin"].'% Margin</div>';

							$item_code			= $row["item_code"];
							$item_image			= $row["item_image"];
							$item_name 			= $row["item_name"];
							$item_packing 		= $row["item_packing"];
							$item_expiry 		= $row["item_expiry"];
							$item_company 		= $row["item_company"];
							$item_quantity 		= $row["item_quantity"];
							$item_stock 		= $row["item_stock"];
							$item_ptr 			= $row["item_ptr"];
							$item_mrp 			= $row["item_mrp"];
							$item_price 		= $row["item_price"];
							$item_scheme 		= $row["item_scheme"];
							$item_margin 		= $row["item_margin"];
							$item_featured 		= $row["item_featured"];
							$item_description1 	= $row["item_description1"];
							$similar_items 		= $row["similar_items"];
							?>

						<div class='medicine_details_all_data_<?= $item_code ?>' item_image='<?= $item_image?>' item_name='<?= $item_name?>' item_packing='<?= $item_packing?>' item_expiry='<?= $item_expiry?>' item_company='<?= $item_company?>' item_quantity='<?= $item_quantity?>' item_stock='<?= $item_stock?>' item_ptr='<?= $item_ptr?>' item_mrp='<?= $item_mrp?>' item_price='<?= $item_price?>' item_scheme='<?= $item_scheme?>' item_margin='<?= $item_margin?>' item_featured='<?= $item_featured?>' item_description1='<?= $item_description1?>' similar_items='<?= $similar_items?>'></div>

						<div class="swiper-slide box">
							<div class="mcs-items-container">
								<div class="home_main_div">
									<div class="image">
										<a href="javascript:void(0)" onClick="medicine_details_funcation('<?= $item_code; ?>')">
											<?php echo $item_other_image_div ?>
											<img src="<?= $item_image; ?>" alt="" onerror="this.src='<?= base_url(); ?>/uploads/default_img.jpg'" class="medicine_cart_item_image">
										</a>
									</div>
									<div class="content">
										<a href="javascript:void(0)" onClick="medicine_details_funcation('<?= $item_code; ?>')">
											<div class="medicine_cart_item_name"><?= $item_name; ?><span class="medicine_cart_item_packing"> (<?= $item_packing; ?> Packing)</span></div>
											<?php echo $margin_div ?>
											<div class="medicine_cart_item_company">By <?= $item_company; ?></div>
											<div class="medicine_cart_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_mrp; ?>/-
											</div>
											<div class="medicine_cart_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_ptr; ?>/-
											</div>
											<div class="medicine_cart_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_price; ?>/-</div>
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php  
							}
						?>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</section>
			<?php //} ?>
		</div>
		
		<div class="col-sm-12">
			<?php 
			if(!empty($result2)){ } ?>
			<div class="featured_home_title">
				<h1 class="heading_home">
					<span>
						<a href="<?= base_url(); ?>home/medicine_category/medicine_category2">
							<?php foreach($result2 as $row) { }?>
							<?php echo $row["item_header_title"]; ?>
						</a>
					</span>
				</h1>
			</div>
			<section class="featured_home" id="featured_home">
				<div class="swiper featured_home-slider featured-slider1">
					<div class="swiper-wrapper home_page_result2">
						<?php
						foreach($result2 as $row)
						{
							if($_COOKIE['user_type']==""){
								$row["item_mrp"] 		= "xx.xx";
								$row["item_ptr"] 		= "xx.xx";
								$row["item_price"]		= "xx.xx";
								$row["item_margin"] 	= "xx";
							}
							$item_featured = $row["item_featured"];
							$item_quantity = $row["item_quantity"];
							
							$item_other_image_div = '';
							if($item_featured=="1" && $item_quantity!="0"){
								$item_other_image_div = '<img src="'.base_url().'img_v'.constant("site_v").'/featured_img.png" class="medicine_cart_item_featured_img">';
							}

							if($item_quantity==0) {
								$item_other_image_div = '<img src="'.base_url().'img_v'.constant("site_v").'/out_of_stock_img.png" class="medicine_cart_item_out_of_stock_img">';
							}

							$margin_div = '<div class="medicine_cart_item_margin">'.$row["item_margin"].'% Margin</div>';
							$item_code			= $row["item_code"];
							$item_image			= $row["item_image"];
							$item_name 			= $row["item_name"];
							$item_packing 		= $row["item_packing"];
							$item_expiry 		= $row["item_expiry"];
							$item_company 		= $row["item_company"];
							$item_quantity 		= $row["item_quantity"];
							$item_stock 		= $row["item_stock"];
							$item_ptr 			= $row["item_ptr"];
							$item_mrp 			= $row["item_mrp"];
							$item_price 		= $row["item_price"];
							$item_scheme 		= $row["item_scheme"];
							$item_margin 		= $row["item_margin"];
							$item_featured 		= $row["item_featured"];
							$item_description1 	= $row["item_description1"];
							$similar_items 		= $row["similar_items"];
							?>

						<div class='medicine_details_all_data_<?= $item_code ?>' item_image='<?= $item_image?>' item_name='<?= $item_name?>' item_packing='<?= $item_packing?>' item_expiry='<?= $item_expiry?>' item_company='<?= $item_company?>' item_quantity='<?= $item_quantity?>' item_stock='<?= $item_stock?>' item_ptr='<?= $item_ptr?>' item_mrp='<?= $item_mrp?>' item_price='<?= $item_price?>' item_scheme='<?= $item_scheme?>' item_margin='<?= $item_margin?>' item_featured='<?= $item_featured?>' item_description1='<?= $item_description1?>' similar_items='<?= $similar_items?>'></div>

						<div class="swiper-slide box">
							<div class="mcs-items-container">
								<div class="home_main_div">
									<div class="image">
										<a href="javascript:void(0)" onClick="medicine_details_funcation('<?= $item_code; ?>')">
											<?php echo $item_other_image_div ?>
											<img src="<?= $item_image; ?>" alt="" onerror="this.src='<?= base_url(); ?>/uploads/default_img.jpg'" class="medicine_cart_item_image">
										</a>
									</div>
									<div class="content">
										<a href="javascript:void(0)" onClick="medicine_details_funcation('<?= $item_code; ?>')">
											<div class="medicine_cart_item_name"><?= $item_name; ?><span class="medicine_cart_item_packing"> (<?= $item_packing; ?> Packing)</span></div>
											<?php echo $margin_div ?>
											<div class="medicine_cart_item_company">By <?= $item_company; ?></div>
											<div class="medicine_cart_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_mrp; ?>/-
											</div>
											<div class="medicine_cart_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_ptr; ?>/-
											</div>
											<div class="medicine_cart_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_price; ?>/-</div>
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php  
							}
						?>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</section>
			<?php //} ?>
		</div>

		<div class="col-sm-12">
			<?php 
			if(!empty($result3)){ }?>
			<div class="featured_home_title">
				<h1 class="heading_home">
					<span>
						<a href="<?= base_url(); ?>home/medicine_category/medicine_category3">
							<?php foreach($result3 as $row) { }?>
							<?php echo $row["item_header_title"]; ?>
						</a>
					</span>
				</h1>
			</div>
			<section class="featured_home" id="featured_home">
				<div class="swiper featured_home-slider featured-slider1">
					<div class="swiper-wrapper home_page_result3">
						<?php
						foreach($result3 as $row)
						{
							if($_COOKIE['user_type']==""){
								$row["item_mrp"] 		= "xx.xx";
								$row["item_ptr"] 		= "xx.xx";
								$row["item_price"]		= "xx.xx";
								$row["item_margin"] 	= "xx";
							}
							$item_featured = $row["item_featured"];
							$item_quantity = $row["item_quantity"];
							
							$item_other_image_div = '';
							if($item_featured=="1" && $item_quantity!="0"){
								$item_other_image_div = '<img src="'.base_url().'img_v'.constant("site_v").'/featured_img.png" class="medicine_cart_item_featured_img">';
							}

							if($item_quantity==0) {
								$item_other_image_div = '<img src="'.base_url().'img_v'.constant("site_v").'/out_of_stock_img.png" class="medicine_cart_item_out_of_stock_img">';
							}

							$margin_div = '<div class="medicine_cart_item_margin">'.$row["item_margin"].'% Margin</div>';
							$item_code			= $row["item_code"];
							$item_image			= $row["item_image"];
							$item_name 			= $row["item_name"];
							$item_packing 		= $row["item_packing"];
							$item_expiry 		= $row["item_expiry"];
							$item_company 		= $row["item_company"];
							$item_quantity 		= $row["item_quantity"];
							$item_stock 		= $row["item_stock"];
							$item_ptr 			= $row["item_ptr"];
							$item_mrp 			= $row["item_mrp"];
							$item_price 		= $row["item_price"];
							$item_scheme 		= $row["item_scheme"];
							$item_margin 		= $row["item_margin"];
							$item_featured 		= $row["item_featured"];
							$item_description1 	= $row["item_description1"];
							$similar_items 		= $row["similar_items"];
							?>

						<div class='medicine_details_all_data_<?= $item_code ?>' item_image='<?= $item_image?>' item_name='<?= $item_name?>' item_packing='<?= $item_packing?>' item_expiry='<?= $item_expiry?>' item_company='<?= $item_company?>' item_quantity='<?= $item_quantity?>' item_stock='<?= $item_stock?>' item_ptr='<?= $item_ptr?>' item_mrp='<?= $item_mrp?>' item_price='<?= $item_price?>' item_scheme='<?= $item_scheme?>' item_margin='<?= $item_margin?>' item_featured='<?= $item_featured?>' item_description1='<?= $item_description1?>' similar_items='<?= $similar_items?>'></div>

						<div class="swiper-slide box">
							<div class="mcs-items-container">
								<div class="home_main_div">
									<div class="image">
										<a href="javascript:void(0)" onClick="medicine_details_funcation('<?= $item_code; ?>')">
											<?php echo $item_other_image_div ?>
											<img src="<?= $item_image; ?>" alt="" onerror="this.src='<?= base_url(); ?>/uploads/default_img.jpg'" class="medicine_cart_item_image">
										</a>
									</div>
									<div class="content">
										<a href="javascript:void(0)" onClick="medicine_details_funcation('<?= $item_code; ?>')">
											<div class="medicine_cart_item_name"><?= $item_name; ?><span class="medicine_cart_item_packing"> (<?= $item_packing; ?> Packing)</span></div>
											<?php echo $margin_div ?>
											<div class="medicine_cart_item_company">By <?= $item_company; ?></div>
											<div class="medicine_cart_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_mrp; ?>/-
											</div>
											<div class="medicine_cart_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_ptr; ?>/-
											</div>
											<div class="medicine_cart_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_price; ?>/-</div>
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php  
							}
						?>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</section>
			<?php //} ?>
		</div>

		<div class="col-sm-12">
			<?php 
			if(!empty($result4)){ }?>
			<div class="featured_home_title">
				<h1 class="heading_home">
					<span>
						<a href="<?= base_url(); ?>home/medicine_category/medicine_category4">
							<?php foreach($result4 as $row) { }?>
							<?php echo $row["item_header_title"]; ?>
						</a>
					</span>
				</h1>
			</div>
			<section class="featured_home" id="featured_home">
				<div class="swiper featured_home-slider featured-slider1">
					<div class="swiper-wrapper home_page_result4">
						<?php
						foreach($result4 as $row)
						{
							if($_COOKIE['user_type']==""){
								$row["item_mrp"] 		= "xx.xx";
								$row["item_ptr"] 		= "xx.xx";
								$row["item_price"]		= "xx.xx";
								$row["item_margin"] 	= "xx";
							}
							$item_featured = $row["item_featured"];
							$item_quantity = $row["item_quantity"];
							
							$item_other_image_div = '';
							if($item_featured=="1" && $item_quantity!="0"){
								$item_other_image_div = '<img src="'.base_url().'img_v'.constant("site_v").'/featured_img.png" class="medicine_cart_item_featured_img">';
							}

							if($item_quantity==0) {
								$item_other_image_div = '<img src="'.base_url().'img_v'.constant("site_v").'/out_of_stock_img.png" class="medicine_cart_item_out_of_stock_img">';
							}

							$margin_div = '<div class="medicine_cart_item_margin">'.$row["item_margin"].'% Margin</div>';
							$item_code			= $row["item_code"];
							$item_image			= $row["item_image"];
							$item_name 			= $row["item_name"];
							$item_packing 		= $row["item_packing"];
							$item_expiry 		= $row["item_expiry"];
							$item_company 		= $row["item_company"];
							$item_quantity 		= $row["item_quantity"];
							$item_stock 		= $row["item_stock"];
							$item_ptr 			= $row["item_ptr"];
							$item_mrp 			= $row["item_mrp"];
							$item_price 		= $row["item_price"];
							$item_scheme 		= $row["item_scheme"];
							$item_margin 		= $row["item_margin"];
							$item_featured 		= $row["item_featured"];
							$item_description1 	= $row["item_description1"];
							$similar_items 		= $row["similar_items"];
							?>

						<div class='medicine_details_all_data_<?= $item_code ?>' item_image='<?= $item_image?>' item_name='<?= $item_name?>' item_packing='<?= $item_packing?>' item_expiry='<?= $item_expiry?>' item_company='<?= $item_company?>' item_quantity='<?= $item_quantity?>' item_stock='<?= $item_stock?>' item_ptr='<?= $item_ptr?>' item_mrp='<?= $item_mrp?>' item_price='<?= $item_price?>' item_scheme='<?= $item_scheme?>' item_margin='<?= $item_margin?>' item_featured='<?= $item_featured?>' item_description1='<?= $item_description1?>' similar_items='<?= $similar_items?>'></div>

						<div class="swiper-slide box">
							<div class="mcs-items-container">
								<div class="home_main_div">
									<div class="image">
										<a href="javascript:void(0)" onClick="medicine_details_funcation('<?= $item_code; ?>')">
											<?php echo $item_other_image_div ?>
											<img src="<?= $item_image; ?>" alt="" onerror="this.src='<?= base_url(); ?>/uploads/default_img.jpg'" class="medicine_cart_item_image">
										</a>
									</div>
									<div class="content">
										<a href="javascript:void(0)" onClick="medicine_details_funcation('<?= $item_code; ?>')">
											<div class="medicine_cart_item_name"><?= $item_name; ?><span class="medicine_cart_item_packing"> (<?= $item_packing; ?> Packing)</span></div>
											<?php echo $margin_div ?>
											<div class="medicine_cart_item_company">By <?= $item_company; ?></div>
											<div class="medicine_cart_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_mrp; ?>/-
											</div>
											<div class="medicine_cart_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_ptr; ?>/-
											</div>
											<div class="medicine_cart_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_price; ?>/-</div>
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php  
							}
						?>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</section>
			<?php // } ?>
		</div>


		<div class="col-sm-12">
			<?php 
			if(!empty($result5)){ } ?>
			<div class="featured_home_title">
				<h1 class="heading_home">
					<span>
						<a href="<?= base_url(); ?>home/medicine_category/medicine_category5">
							<?php foreach($result5 as $row) { }?>
							<?php echo $row["item_header_title"]; ?>
						</a>
					</span>
				</h1>
			</div>
			<section class="featured_home" id="featured_home">
				<div class="swiper featured_home-slider featured-slider1">
					<div class="swiper-wrapper home_page_result5">
						<?php
						foreach($result5 as $row)
						{
							if($_COOKIE['user_type']==""){
								$row["item_mrp"] 		= "xx.xx";
								$row["item_ptr"] 		= "xx.xx";
								$row["item_price"]		= "xx.xx";
								$row["item_margin"] 	= "xx";
							}
							$item_featured = $row["item_featured"];
							$item_quantity = $row["item_quantity"];
							
							$item_other_image_div = '';
							if($item_featured=="1" && $item_quantity!="0"){
								$item_other_image_div = '<img src="'.base_url().'img_v'.constant("site_v").'/featured_img.png" class="medicine_cart_item_featured_img">';
							}

							if($item_quantity==0) {
								$item_other_image_div = '<img src="'.base_url().'img_v'.constant("site_v").'/out_of_stock_img.png" class="medicine_cart_item_out_of_stock_img">';
							}

							$margin_div = '<div class="medicine_cart_item_margin">'.$row["item_margin"].'% Margin</div>';
							$item_code			= $row["item_code"];
							$item_image			= $row["item_image"];
							$item_name 			= $row["item_name"];
							$item_packing 		= $row["item_packing"];
							$item_expiry 		= $row["item_expiry"];
							$item_company 		= $row["item_company"];
							$item_quantity 		= $row["item_quantity"];
							$item_stock 		= $row["item_stock"];
							$item_ptr 			= $row["item_ptr"];
							$item_mrp 			= $row["item_mrp"];
							$item_price 		= $row["item_price"];
							$item_scheme 		= $row["item_scheme"];
							$item_margin 		= $row["item_margin"];
							$item_featured 		= $row["item_featured"];
							$item_description1 	= $row["item_description1"];
							$similar_items 		= $row["similar_items"];
							?>

						<div class='medicine_details_all_data_<?= $item_code ?>' item_image='<?= $item_image?>' item_name='<?= $item_name?>' item_packing='<?= $item_packing?>' item_expiry='<?= $item_expiry?>' item_company='<?= $item_company?>' item_quantity='<?= $item_quantity?>' item_stock='<?= $item_stock?>' item_ptr='<?= $item_ptr?>' item_mrp='<?= $item_mrp?>' item_price='<?= $item_price?>' item_scheme='<?= $item_scheme?>' item_margin='<?= $item_margin?>' item_featured='<?= $item_featured?>' item_description1='<?= $item_description1?>' similar_items='<?= $similar_items?>'></div>

						<div class="swiper-slide box">
							<div class="mcs-items-container">
								<div class="home_main_div">
									<div class="image">
										<a href="javascript:void(0)" onClick="medicine_details_funcation('<?= $item_code; ?>')">
											<?php echo $item_other_image_div ?>
											<img src="<?= $item_image; ?>" alt="" onerror="this.src='<?= base_url(); ?>/uploads/default_img.jpg'" class="medicine_cart_item_image">
										</a>
									</div>
									<div class="content">
										<a href="javascript:void(0)" onClick="medicine_details_funcation('<?= $item_code; ?>')">
											<div class="medicine_cart_item_name"><?= $item_name; ?><span class="medicine_cart_item_packing"> (<?= $item_packing; ?> Packing)</span></div>
											<?php echo $margin_div ?>
											<div class="medicine_cart_item_company">By <?= $item_company; ?></div>
											<div class="medicine_cart_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_mrp; ?>/-
											</div>
											<div class="medicine_cart_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_ptr; ?>/-
											</div>
											<div class="medicine_cart_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_price; ?>/-</div>
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php  
							}
						?>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</section>
			<?php // } ?>
		</div>


		<div class="col-sm-12">
			<?php 
			if(!empty($result6)){ }?>
			<div class="featured_home_title">
				<h1 class="heading_home">
					<span>
						<a href="<?= base_url(); ?>home/medicine_category/medicine_category6">
							<?php foreach($result6 as $row) { }?>
							<?php echo $row["item_header_title"]; ?>
						</a>
					</span>
				</h1>
			</div>
			<section class="featured_home" id="featured_home">
				<div class="swiper featured_home-slider featured-slider1">
					<div class="swiper-wrapper home_page_result6">
						<?php
						foreach($result6 as $row)
						{
							if($_COOKIE['user_type']=="")
							{
								$row["item_mrp"] 		= "xx.xx";
								$row["item_ptr"] 		= "xx.xx";
								$row["item_price"]		= "xx.xx";
								$row["item_margin"] 	= "xx";
							}
							$item_featured = $row["item_featured"];
							$item_quantity = $row["item_quantity"];
							
							$item_other_image_div = '';
							if($item_featured=="1" && $item_quantity!="0"){
								$item_other_image_div = '<img src="'.base_url().'img_v'.constant("site_v").'/featured_img.png" class="medicine_cart_item_featured_img">';
							}

							if($item_quantity==0) {
								$item_other_image_div = '<img src="'.base_url().'img_v'.constant("site_v").'/out_of_stock_img.png" class="medicine_cart_item_out_of_stock_img">';
							}

							$margin_div = '<div class="medicine_cart_item_margin">'.$row["item_margin"].'% Margin</div>';
							$item_code			= $row["item_code"];
							$item_image			= $row["item_image"];
							$item_name 			= $row["item_name"];
							$item_packing 		= $row["item_packing"];
							$item_expiry 		= $row["item_expiry"];
							$item_company 		= $row["item_company"];
							$item_quantity 		= $row["item_quantity"];
							$item_stock 		= $row["item_stock"];
							$item_ptr 			= $row["item_ptr"];
							$item_mrp 			= $row["item_mrp"];
							$item_price 		= $row["item_price"];
							$item_scheme 		= $row["item_scheme"];
							$item_margin 		= $row["item_margin"];
							$item_featured 		= $row["item_featured"];
							$item_description1 	= $row["item_description1"];
							$similar_items 		= $row["similar_items"];
							?>

						<div class='medicine_details_all_data_<?= $item_code ?>' item_image='<?= $item_image?>' item_name='<?= $item_name?>' item_packing='<?= $item_packing?>' item_expiry='<?= $item_expiry?>' item_company='<?= $item_company?>' item_quantity='<?= $item_quantity?>' item_stock='<?= $item_stock?>' item_ptr='<?= $item_ptr?>' item_mrp='<?= $item_mrp?>' item_price='<?= $item_price?>' item_scheme='<?= $item_scheme?>' item_margin='<?= $item_margin?>' item_featured='<?= $item_featured?>' item_description1='<?= $item_description1?>' similar_items='<?= $similar_items?>'></div>

						<div class="swiper-slide box">
							<div class="mcs-items-container">
								<div class="home_main_div">
									<div class="image">
										<a href="javascript:void(0)" onClick="medicine_details_funcation('<?= $item_code; ?>')">
											<?php echo $item_other_image_div ?>
											<img src="<?= $item_image; ?>" alt="" onerror="this.src='<?= base_url(); ?>/uploads/default_img.jpg'" class="medicine_cart_item_image">
										</a>
									</div>
									<div class="content">
										<a href="javascript:void(0)" onClick="medicine_details_funcation('<?= $item_code; ?>')">
											<div class="medicine_cart_item_name"><?= $item_name; ?><span class="medicine_cart_item_packing"> (<?= $item_packing; ?> Packing)</span></div>
											<?php echo $margin_div ?>
											<div class="medicine_cart_item_company">By <?= $item_company; ?></div>
											<div class="medicine_cart_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_mrp; ?>/-
											</div>
											<div class="medicine_cart_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_ptr; ?>/-
											</div>
											<div class="medicine_cart_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> <?= $item_price; ?>/-</div>
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php  
							}
						?>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</section>
			<?php //} ?>
		</div>
	</div>

	<div class="row" style="margin-top:30px;">
		<div class="col-xs-12 col-sm-12 col-12 p-1">
			<div id="flash2" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner top_flash2_div">
				<?php
				foreach($top_flash2 as $row)
				{
					if(!empty($row["division"])){
						$row["division"]="not";
					}
					?>
					<div class="carousel-item <?= $row["id"] ?>">
						<a href="javascript:callandroidfun('<?= $row["funtype"] ?>','<?= $row["itemid"] ?>','<?= base64_encode($row["compname"])?>','<?= $row["image"] ?>','<?= $row["division"] ?>');">
							<img src="<?= $row["image"] ?>" class="" alt="" onerror="this.src='<?= base_url(); ?>/uploads/default_img.jpg'">
						</a>
					</div>
					<?php
				}
				?>
				</div>
				<a class="carousel-control-prev" href="#flash2" data-slide="prev">
					<span class="carousel-control-prev-icon"></span>
				</a>
				<a class="carousel-control-next" href="#flash2" data-slide="next">
					<span class="carousel-control-next-icon"></span>
				</a>
			</div>
		</div>
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
		url        : "<?php echo base_url(); ?>Chemist_json/new_part01",
		cache	   : true,
		success : function(data){
			//alert(data)
			if(data!="")
			{
				$(".top_flash_div").html('');
				$(".home_page_result0").html('');
				$(".top_flash2_div").html('');
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

				$.each(data.get_result, function(i,work){
					$.each(work.result0, function(i,item){	
						if (item){
							
							item_code 		= item.item_code;
							item_company 	= item.item_company;
							item_division 	= item.item_division;
							item_image 		= item.item_image;

							$(".home_page_result0").append('<div class="swiper-slide box"><div class="mcs-items-container1"><div class="home_main_div"><div class="image1"><a href="<?= base_url(); ?>home/medicine_category/featured_brand/'+item_code+'/'+item_division+'"><img src="'+item_image+'" alt=""></a></div><div class="content" style="padding-top:5px;"><a href="<?= base_url(); ?>home/featured_brand/'+item_code+'/'+item_division+'"><div class="medicine_details_item_company">'+item_company+'</div></a></div></div></div></div>');
						}
					});
				});

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

							$(".home_page_my_invoice").append('<div class="main_theme_li_bg"><div class="medicine_my_page_div1"><a href="<?php echo base_url() ?>home/my_invoice_details/'+item_id+'"><img src="'+item.user_image+'" alt="" title="" onerror=this.src="<?= base_url(); ?>/uploads/default_img.jpg" class="medicine_cart_item_image"></a></div><div class="medicine_my_page_div2 text-left"><div class=""><a href="<?php echo base_url() ?>home/my_invoice_details/'+item_id+'"><span class="medicine_cart_item_name">'+item_title+'</span></a><span style="float: right;color: red;" '+download_url+'>Download Invoice</span></div><a href="<?php echo base_url() ?>home/my_invoice_details/'+item_id+'"><div class="medicine_cart_item_price">Total : <i class="fa fa-inr" aria-hidden="true"></i> '+item_total+'/-</div><div class="medicine_cart_item_datetime">Invoice Date : '+item_date_time+''+out_for_delivery+'</div>'+delete_status_div+'</div></a></div>');
						}
					});
				});

				$.each(data.get_result, function(i,work){
					$.each(work.result1, function(i,item){	
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
							
							if("<?php echo $_COOKIE['user_type'] ?>"==""){
								$item_mrp 		= "xx.xx";
								$item_mrp 		= "xx.xx";
								$item_mrp		= "xx.xx";
								$item_mrp 		= "xx";
							}


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
						
							$(".home_page_result1").append('<div class="swiper-slide box"><div class="mcs-items-container"><div class="home_main_div"><div class="image"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')">'+item_other_image_div+'<img src="'+item_image+'" alt="" '+error_img+' class="medicine_cart_item_image"></a></div><div class="content"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')"><div class="medicine_cart_item_name">'+item_name+'<span class="medicine_cart_item_packing"> ('+item_packing+' Packing)</span></div>'+margin_div+'<div class="medicine_cart_item_company">By '+item_company+'</div><div class="medicine_cart_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/-</div><div class="medicine_cart_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/-</div><div class="medicine_cart_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</div></a></div></div></div></div>'+div_all_data);
						}
					});
				});


				$.each(data.get_result, function(i,work){
					$.each(work.result2, function(i,item){	
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
							
							if("<?php echo $_COOKIE['user_type'] ?>"==""){
								$item_mrp 		= "xx.xx";
								$item_mrp 		= "xx.xx";
								$item_mrp		= "xx.xx";
								$item_mrp 		= "xx";
							}


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
						
							$(".home_page_result2").append('<div class="swiper-slide box"><div class="mcs-items-container"><div class="home_main_div"><div class="image"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')">'+item_other_image_div+'<img src="'+item_image+'" alt="" '+error_img+' class="medicine_cart_item_image"></a></div><div class="content"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')"><div class="medicine_cart_item_name">'+item_name+'<span class="medicine_cart_item_packing"> ('+item_packing+' Packing)</span></div>'+margin_div+'<div class="medicine_cart_item_company">By '+item_company+'</div><div class="medicine_cart_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/-</div><div class="medicine_cart_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/-</div><div class="medicine_cart_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</div></a></div></div></div></div>'+div_all_data);
						}
					});
				});

				$.each(data.get_result, function(i,work){
					$.each(work.result3, function(i,item){	
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
							
							if("<?php echo $_COOKIE['user_type'] ?>"==""){
								$item_mrp 		= "xx.xx";
								$item_mrp 		= "xx.xx";
								$item_mrp		= "xx.xx";
								$item_mrp 		= "xx";
							}


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
						
							$(".home_page_result3").append('<div class="swiper-slide box"><div class="mcs-items-container"><div class="home_main_div"><div class="image"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')">'+item_other_image_div+'<img src="'+item_image+'" alt="" '+error_img+' class="medicine_cart_item_image"></a></div><div class="content"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')"><div class="medicine_cart_item_name">'+item_name+'<span class="medicine_cart_item_packing"> ('+item_packing+' Packing)</span></div>'+margin_div+'<div class="medicine_cart_item_company">By '+item_company+'</div><div class="medicine_cart_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/-</div><div class="medicine_cart_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/-</div><div class="medicine_cart_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</div></a></div></div></div></div>'+div_all_data);
						}
					});
				});

				$.each(data.get_result, function(i,work){
					$.each(work.result4, function(i,item){
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
							
							if("<?php echo $_COOKIE['user_type'] ?>"==""){
								$item_mrp 		= "xx.xx";
								$item_mrp 		= "xx.xx";
								$item_mrp		= "xx.xx";
								$item_mrp 		= "xx";
							}


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
						
							$(".home_page_result4").append('<div class="swiper-slide box"><div class="mcs-items-container"><div class="home_main_div"><div class="image"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')">'+item_other_image_div+'<img src="'+item_image+'" alt="" '+error_img+' class="medicine_cart_item_image"></a></div><div class="content"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')"><div class="medicine_cart_item_name">'+item_name+'<span class="medicine_cart_item_packing"> ('+item_packing+' Packing)</span></div>'+margin_div+'<div class="medicine_cart_item_company">By '+item_company+'</div><div class="medicine_cart_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/-</div><div class="medicine_cart_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/-</div><div class="medicine_cart_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</div></a></div></div></div></div>'+div_all_data);
						}
					});
				});

				$.each(data.get_result, function(i,work){
					$.each(work.result5, function(i,item){
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
							
							if("<?php echo $_COOKIE['user_type'] ?>"==""){
								$item_mrp 		= "xx.xx";
								$item_mrp 		= "xx.xx";
								$item_mrp		= "xx.xx";
								$item_mrp 		= "xx";
							}


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
						
							$(".home_page_result5").append('<div class="swiper-slide box"><div class="mcs-items-container"><div class="home_main_div"><div class="image"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')">'+item_other_image_div+'<img src="'+item_image+'" alt="" '+error_img+' class="medicine_cart_item_image"></a></div><div class="content"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')"><div class="medicine_cart_item_name">'+item_name+'<span class="medicine_cart_item_packing"> ('+item_packing+' Packing)</span></div>'+margin_div+'<div class="medicine_cart_item_company">By '+item_company+'</div><div class="medicine_cart_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/-</div><div class="medicine_cart_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/-</div><div class="medicine_cart_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</div></a></div></div></div></div>'+div_all_data);
						}
					});
				});

				$.each(data.get_result, function(i,work){
					$.each(work.result6, function(i,item){
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
							
							if("<?php echo $_COOKIE['user_type'] ?>"==""){
								$item_mrp 		= "xx.xx";
								$item_mrp 		= "xx.xx";
								$item_mrp		= "xx.xx";
								$item_mrp 		= "xx";
							}


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
						
							$(".home_page_result6").append('<div class="swiper-slide box"><div class="mcs-items-container"><div class="home_main_div"><div class="image"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')">'+item_other_image_div+'<img src="'+item_image+'" alt="" '+error_img+' class="medicine_cart_item_image"></a></div><div class="content"><a href="javascript:void(0)" onClick="medicine_details_funcation('+item_code+')"><div class="medicine_cart_item_name">'+item_name+'<span class="medicine_cart_item_packing"> ('+item_packing+' Packing)</span></div>'+margin_div+'<div class="medicine_cart_item_company">By '+item_company+'</div><div class="medicine_cart_item_mrp">MRP : <i class="fa fa-inr" aria-hidden="true"></i> '+item_mrp+'/-</div><div class="medicine_cart_item_ptr">PTR : <i class="fa fa-inr" aria-hidden="true"></i> '+item_ptr+'/-</div><div class="medicine_cart_item_price">*Approximate ~ : <i class="fa fa-inr" aria-hidden="true"></i> '+item_price+'/-</div></a></div></div></div></div>'+div_all_data);
						}
					});
				});

				$("#jssor_1").show();
				$(".top_flash_loading").hide();
				jssor_1_slider_init();
			}
		},
		timeout: 10000
	});
}
home_page_load();

function download_invoice(url){
	window.open(url, '_blank');
	window.close();
}
</script>
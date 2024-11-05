<?php
$theme_type = "lite";
if (isset($_COOKIE["theme_type"])) {
	$theme_type = $_COOKIE["theme_type"];
}?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
		<?= $title = $siteTitle; ?>
    </title>
    <!-- Stylesheets -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link href="https://fonts.googleapis.com/css?family=Cabin:700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/css/font-awesome.min.css"> 
	<link href="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<script src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/js/jquery-2.1.4.min.js"></script>
	<script src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/js/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/js/bigSlide.js"></script> 

	<?php if($theme_type=="lite") { ?>
		<meta name="theme-color" content="#27ae60">
		<link href="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/css/style-light.css" rel="stylesheet" type="text/css"/>
	<?php } ?>

	<?php if($theme_type=="dark") { ?>
		<meta name="theme-color" content="#373d40">
		<link href="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/css/style-dark.css" rel="stylesheet" type="text/css"/>
	<?php } ?>

	<link href="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/css/style.css" rel="stylesheet" type="text/css" />

	<link rel="icon" href="<?php echo base_url(); ?>/assets/<?php echo $this->appconfig->getWebJs(); ?>/images/logo4.png" type="image/logo" sizes="16x16">
	
	<script src="<?= base_url(); ?>assets/<?php echo $this->appconfig->getWebJs(); ?>/website/js/sweetalert.min.js"></script>
  </head>
  <body>
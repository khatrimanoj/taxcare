<?php defined('BASEPATH') or exit('No direct script access allowed'); //echo base_url(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
   <title><?php if(isset($page_title)){echo $page_title.' :: ';}?><?php echo ADMIN_PAGE_HEADING; ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/images/favicon.ico'); ?>">
        <!-- Main Menu CSS -->
         
        <!-- Bootstrap CSS -->
        <link href="<?= base_url('assets/backend/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!-- Animate CSS -->
        <link href="<?= base_url('assets/backend/css/animate.css'); ?>" rel="stylesheet">
        <link href="<?= base_url('assets/backend/css/icons.css'); ?>" rel="stylesheet">
       <!-- Custom Style-->
         <link href="<?= base_url('assets/backend/css/app-style.css'); ?>" rel="stylesheet"/>
        <!-- Custom CSS -->
        <link href="<?= base_url('assets/backend/css/style.css'); ?>" rel="stylesheet">
         <script type="text/javascript" src="<?= base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/modernizr-2.8.3.min.js'); ?>"></script>
       
        <base href="<?php echo base_url(); ?>">
    </head>

    <body>
<header>
<div class="header-top-section"></div>
<div class="header1-area header-two">
	<div class="header-top-area header-top-20" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					 
				</div>
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
				<center> <h3><?php echo ADMIN_PAGE_HEADING; ?></h3></center>	
				</div>
 
			</div>

		</div>
	</div>
</div>

</header>
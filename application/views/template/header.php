<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMAN 1 Wringin Anom</title>

        <!-- ========== COMMON STYLES ========== -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/lobipanel/lobipanel.min.css" media="screen" >

        <!-- ========== PAGE STYLES ========== -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/toastr/toastr.min.css" media="screen" >
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/icheck/skins/line/blue.css" >
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/icheck/skins/line/red.css" >
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/icheck/skins/line/green.css" >
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/bootstrap-tour/bootstrap-tour.css" >

        <!-- ========== THEME CSS ========== -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/main.css" media="screen" >

        <!-- ========== MODERNIZR ========== -->
        <script src="<?php echo base_url() ?>assets/Theme/js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <nav class="navbar top-navbar bg-white box-shadow">
            	<div class="container-fluid">
                    <div class="row">
                        <div class="navbar-header no-padding">
                			<a class="navbar-brand" href="<?php echo base_url() ?>assets/Theme/index.html">BANK MINI SEKOLAH
                			</a>
                            <span class="small-nav-handle hidden-sm hidden-xs"><i class="fa fa-outdent"></i></span>
                		</div>
                        <!-- /.navbar-header -->

                		<div class="collapse navbar-collapse" id="navbar-collapse-1">
                            <!-- /.nav navbar-nav -->

                			<ul class="nav navbar-nav navbar-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                				<li class="dropdown tour-two">
                					<a href="<?php echo base_url() ?>assets/Theme/#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">John Doe <span class="caret"></span></a>
                					<ul class="dropdown-menu profile-dropdown">
                						<li class="profile-menu bg-gray">
                						    <div class="">
                						        <img src="http://placehold.it/60/c2c2c2?text=User" alt="John Doe" class="img-circle profile-img">
                                                <div class="profile-name">
                                                    <h6>John Doe</h6>
                                                    <a href="<?php echo base_url() ?>assets/Theme/pages-profile.html">View Profile</a>
                                                </div>
                                                <div class="clearfix"></div>
                						    </div>
                						</li>
                						<li><a href="<?php echo base_url() ?>assets/Theme/#"><i class="fa fa-cog"></i> Settings</a></li>
                						<li><a href="<?php echo base_url() ?>assets/Theme/#"><i class="fa fa-sliders"></i> Account Details</a></li>
                						<li role="separator" class="divider"></li>
                						<li><a href="<?php echo site_url('C_Login/logout'); ?>" class="color-danger text-center"><i class="fa fa-sign-out"></i> Logout</a></li>
                					</ul>
                				</li>
                			</ul>
                            <!-- /.nav navbar-nav navbar-right -->
                		</div>
                		<!-- /.navbar-collapse -->
                    </div>
                    <!-- /.row -->
            	</div>
            	<!-- /.container-fluid -->
            </nav>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMAN 1 Wringin Anom</title>

        <link rel="shortcut icon" href="<?php echo base_url() ?>assets/Favicon/favicon.ico">
        <!-- ========== COMMON STYLES ========== -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/animate-css/animate.min.css" media="screen" >

        <!-- ========== PAGE STYLES ========== -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->

        <!-- ========== THEME CSS ========== -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/main.css" media="screen" >

        <!-- ========== MODERNIZR ========== -->
        <script src="<?php echo base_url() ?>assets/Theme/js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="">
        <div class="main-wrapper">
            <div class="">
                <div class="row">
                    <div class="col-lg-5 visible-lg-block">
                        <img src="<?php echo base_url() ?>assets/LOGO SEKOLAH WRINGINANOM.png" alt="Options - Admin Template" class="img-responsive">
                    </div>
                    <div class="col-lg-6">
                        <section class="section">
                            <div class="row mt-20">
                                <div class="col-md-50 col-md-offset-1 pt-50">

                                    <div class="row mt-100 ">
                                        <div class="col-md-11">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <div class="panel-title text-center">
                                                        <h4>SMA Negeri 1 Wringin Anom</h4>
                                                    </div>
                                                </div>
                                                <div class="panel-body p-20">
                                    <form class="form-horizontal" action="<?php echo site_url('C_Login/cek_login'); ?>" method="post">
                                                    	<div class="form-group">
                                                    		<label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                                                    		<div class="col-sm-10">
                                                    			<input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                                    		</div>
                                                    	</div>
                                                    	<div class="form-group">
                                                    		<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                                    		<div class="col-sm-10">
                                                    			<input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                                    		</div>
                                                    	</div>
                                                    	<div class="form-group">
                                                    		<div class="col-sm-offset-2 col-sm-10">
                                                    			<div class="checkbox">
                                                    				<label>
                                                    					<input type="checkbox"> Remember me
                                                    				</label>
                                                    			</div>
                                                    		</div>
                                                    	</div>
                                                    	<div class="form-group mt-20">
                                                    		<div class="col-sm-offset-2 col-sm-10">
                                                                <a href="#" class="form-link"><small class="muted-text">Forgot Password?</small></a>
                                                    			<button type="submit" class="btn btn-success btn-labeled pull-right">Sign in<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                                    		</div>
                                                    	</div>
                                                    </form>

                                                    <hr>

                                                    <h5 class="text-center mt-10 mb-20">Or Login With</h5>

                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-primary bg-primary-600 btn-labeled">Facebook<span class="btn-label btn-label-right"><i class="fa fa-facebook"></i></span></button>
                                                        <button type="button" class="btn btn-primary bg-primary-300 btn-labeled ml-5">Twitter<span class="btn-label btn-label-right"><i class="fa fa-twitter"></i></span></button>
                                                        <button type="button" class="btn btn-danger bg-danger-300 btn-labeled ml-5">Google<span class="btn-label btn-label-right"><i class="fa fa-google-plus"></i></span></button>
                                                    </div>
                                                    <!-- /.text-center -->

                                                </div>
                                            </div>
                                            <!-- /.panel -->
                                            <p class="text-muted text-center"><small>Copyright © SaltTechno 2017</small></p>
                                        </div>
                                        <!-- /.col-md-11 -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.col-md-12 -->
                            </div>
                            <!-- /.row -->
                        </section>

                    </div>
                    <!-- /.col-lg-6 -->
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /. -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="<?php echo base_url() ?>assets/Theme/js/jquery/jquery-2.2.4.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/pace/pace.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/lobipanel/lobipanel.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->

        <!-- ========== THEME JS ========== -->
        <script src="<?php echo base_url() ?>assets/Theme/js/main.js"></script>
        <script>
            $(function(){

            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>

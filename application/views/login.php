<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Dynamic Checksheet</title>

        <meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework">
        <meta property="og:site_name" content="Codebase">
        <meta property="og:description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo base_url().'assets/media/favicons/favicon.png'?>">
        <link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url().'assets/media/favicons/favicon-192x192.png'?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url().'assets/media/favicons/apple-touch-icon-180x180.png'?>">
        <!-- END Icons -->

        <!-- Stylesheets -->

        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="<?php echo base_url().'assets/css/codebase.min.css'?>">
        <!-- END Stylesheets -->
    </head>
    <body>
     <!-- Page Container -->
        <div id="page-container" class="main-content-boxed">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('<?php echo base_url().'assets/media/photos/office.jpg'?>');">
                    <div class="row mx-0 bg-black-op">
                        <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                            <div class="p-30 invisible" data-toggle="appear">
                                <!-- <p class="font-size-h3 font-w600 text-white">
                                    Get Inspired and Create.
                                </p> -->
                                <p class="font-italic text-white-op">
                                    Copyright &copy; <span class="js-year-copy">2022</span>
                                </p>
                            </div>
                        </div>
                        <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible" data-toggle="appear" data-class="animated fadeInRight">
                            <div class="content content-full">
                                <!-- Header -->
                                <div class="px-30 py-10">
                                    <a class="link-effect font-w700" href="http://cbi-astra.com/home/?lang=id">
                                        <i class="si si-globe"></i>
                                        <span class="font-size-xl text-primary-dark">PT</span><span class="font-size-xl"> Century Batteries Indonesia</span>
                                    </a>
                                    <h1 class="h3 font-w700 mt-30 mb-10">Sistem Pembuatan Workshop Order</h1>
                                    <h2 class="h5 font-w400 text-muted mb-0">Silahkan Log in </h2>
                                </div>
                                <!-- END Header -->

                                <!-- Sign In Form -->
                                <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <form class="js-validation-signin px-30" action="<?php echo base_url();?>login/validate" method="post">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="text" class="form-control" id="login-username" name="login-username">
                                                <label for="login-username">Username</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="password" class="form-control" id="login-password" name="login-password">
                                                <label for="login-password">Password</label>
                                            </div>
                                        </div>
                                    </div>
                                            <?php 
                                            if( $this->session->flashdata('msg1') )
                                            {
                                                echo '
                                                    <div class="alert alert-danger alert-dismissable" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <h3 class="alert-heading font-size-h4 font-w400">Login Gagal</h3>
                                                        <p class="mb-0">Username dan Password Tidak Sesuai !</p>
                                                    </div>
                                                ';
                                            }
                                            ?>
   
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-hero btn-alt-primary">
                                            <i class="si si-login mr-10"></i> Sign In
                                        </button>
                                    </div>
                                </form>
                                <!-- END Sign In Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
        <script src="<?php echo base_url().'assets/js/codebase.core.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/codebase.app.min.js'?>"></script>

        <!-- Page JS Plugins -->
        <script src="<?php echo base_url().'assets/js/plugins/jquery-validation/jquery.validate.min.js'?>"></script>

        <!-- Page JS Code -->
        <script src="<?php echo base_url().'assets/js/pages/op_auth_signin.min.js'?>"></script>
    </body>
</html>
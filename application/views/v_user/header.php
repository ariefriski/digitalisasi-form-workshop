<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Order Form Digital</title>

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
        <link rel="shortcut icon" href="assets/media/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url() . 'assets/media/favicons/favicon-192x192.png'?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() . 'assets/media/favicons/apple-touch-icon-180x180.png'?>">
        <!-- END Icons -->

        <!-- Stylesheets -->

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="<?=base_url() . 'assets/js/plugins/datatables/dataTables.bootstrap4.css'?>">

        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="<?=base_url() . 'assets/css/codebase.min.css'?>">

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!-- LOAD CUSTOM DOM TO MANIPULATE ADD CHECKSHEET ext. IN WHOLE PAGE ROLE ADMIN -->
        <style>
            .orderStatus { padding: 10px; overflow: hidden; }
            .orderStatus .row { padding: 0; margin: 0; display: flex; padding: 5px; width: 100%; }
            .orderStatus .row .col { display: block; flex: 1 1 0; padding: 5px; width: 100%; line-height: 12px; position: relative; text-align: center; padding-top: 15px; color: #aaa; }
            .orderStatus .row .col:before { content: ''; width: 100%; height: 5px; background: #ccc; top: 0px; left: 0; position: absolute; margin: 0 0 0 -50%; }
            .orderStatus .row .col.done:before { background: #56B500; }
            .orderStatus .row .col:first-child:before { background: none; }
            .orderStatus .row .col:after { position: absolute; width: 20px; height: 20px; content: "\f3fd"; color: #eee; font-size: 24px; line-height: 20px; background: #ccc; left: 50%; top: 0; z-index: 999; border-radius: 50%; margin: -8px 0 0 -10px; font-family: "Ionicons"; }
            .orderStatus .row .col.done:after { position: absolute; width: 20px; height: 20px; content: "\f3fd"; color: #fff; font-size: 24px; line-height: 20px; background: #56B500; left: 50%; top: 0; z-index: 999; border-radius: 50%; margin: -8px 0 0 -10px; font-family: "Ionicons"; }
            .orderStatus .row .col.done { color: #3d8f10 }
        </style>
    </head>
    <body>
        
<!--              -->
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- User Dropdown -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block"><?=$this->session->userdata('user_name')?></span>
                                <i class="fa fa-angle-down ml-5"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                                <a class="dropdown-item" href="<?php echo base_url();?>login/user_logout">
                                    <i class="si si-logout mr-5"></i> Sign Out
                                </a>
                            </div>
                        </div>
                        <!-- END User Dropdown -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->

                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->
            </header>
            <!-- END Header -->
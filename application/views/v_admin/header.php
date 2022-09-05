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
        <link rel="shortcut icon" href="<?= base_url() . 'assets/media/favicons/favicon.png'?>">
        <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url() . 'assets/media/favicons/favicon-192x192.png'?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() . 'assets/media/favicons/apple-touch-icon-180x180.png'?>">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="<?=base_url() . 'assets/js/plugins/datatables/dataTables.bootstrap4.css'?>">

        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="<?=base_url() . 'assets/css/codebase.min.css'?>">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->

    </head>
    <body>
    <div id="page-container" class="side-scroll page-header-modern main-content-boxed">
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- User Dropdown -->
                        <a href="<?php echo base_url();?>admin/dashboard">Home</a>
                        <!-- END User Dropdown -->
                    </div>
                    <div class="content-header-section">
                        <!-- User Dropdown -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block"><?=$this->session->userdata('admin_ws_name')?></span>
                                <i class="fa fa-angle-down ml-5"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                            <a class="dropdown-item" href="<?php echo base_url();?>admin/dashboard/IO">
                                    <i class="si si-list"></i> Order List
                                </a>
                                <a class="dropdown-item" href="<?php echo base_url();?>admin/edit/proses">
                                    <i class="si si-pencil"></i> Edit Data Proses
                                </a>
                                <a class="dropdown-item" href="<?php echo base_url();?>admin/edit/material">
                                    <i class="si si-pencil"></i> Edit Data Material
                                </a>
                                <a class="dropdown-item" href="<?php echo base_url();?>login/admin_ws_logout">
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
<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Digitalisasi Workshop</title>

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

         <!--EXPORT  -->
         <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
         <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />
         <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
         <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!-- LOAD CUSTOM DOM TO MANIPULATE ADD CHECKSHEET ext. IN WHOLE PAGE ROLE ADMIN -->
        
    </head>
    <body>
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed">
            <!-- Side Overlay-->
            <aside id="side-overlay">
                <!-- Side Header -->
                <div class="content-header content-header-fullrow">
                    <div class="content-header-section align-parent">
                        <!-- Close Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout" data-action="side_overlay_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <!-- END Close Side Overlay -->
                    </div>
                </div>
                <!-- END Side Header -->
            </aside>
            <!-- END Side Overlay -->

            
            <nav id="sidebar">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow px-15">
                        <!-- Mini Mode -->
                        <div class="content-header-section sidebar-mini-visible-b">
                            <!-- Logo -->
                            <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                            </span>
                            <!-- END Logo -->
                        </div>
                        <!-- END Mini Mode -->

                        <!-- Normal Mode -->
                        <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="link-effect font-w700" href="<?= base_url() . 'home' ?>">
                                    <i class="si si-fire text-primary"></i>
                                    <span class="font-size-xl text-dual-primary-dark">Work</span><span class="font-size-xl text-primary">shop</span>
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                        <!-- END Normal Mode -->
                    </div>
                    <!-- END Side Header -->
                    
                    <!-- Side Navigation -->
                    <div class="content-side content-side-full">
                        <ul class="nav-main">
                            <li>
                                <a href="<?= base_url() . 'admin/dashboard'?>"><span class="sidebar-mini-hide">Menunggu Persetujuan PIC Workshop</span></a>
                            </li>
                            <li>
                                <a href="<?= base_url() . 'admin/dashboard/ditolakApprove'?>"><span class="sidebar-mini-hide">Ditolak</span></a>
                            </li>
                            <li>
                                <a href="<?= base_url() . 'admin/response'?>"><span class="sidebar-mini-hide">Menunggu Approve Kasie/Kadept</span></a>
                            </li>
                            <li>
                                <a class="nav-submenu" data-toggle="nav-submenu" ><span class="sidebar-mini-hide">Proses</span></a>
                                <ul>
                                    <li>
                                        <a href="<?= base_url() . 'admin/response/route'?>"><span class="sidebar-mini-hide">Ready Input Order</span></a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() . 'admin/response/onprocess'?>"><span class="sidebar-mini-hide">Ready Schedulling</span></a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() . 'admin/response/waitingworking'?>"><span class="sidebar-mini-hide">Wait for Working</span></a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() . 'admin/response/working'?>"><span class="sidebar-mini-hide">On Working</span></a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() . 'admin/response/finish'?>"><span class="sidebar-mini-hide">Finish</span></a>
                                    </li>    
                                </ul>
                            </li>
                            <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">Reporting</a>
                                    <ul>
                                        <li>
                                            <a href="<?= base_url() . 'admin/response/chartRunningCost'?>">Running Cost</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() . 'admin/response/chartRunningHourMachine'?>">Running Hour Machine</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() . 'admin/response/chartTotalRunningCost'?>">Total Running Cost</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() . 'admin/response/quantityJobOrder'?>">Quantity Job Order</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() . 'admin/response/quantityOrderType'?>">Quantity Order Type</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() . 'admin/response/grafik'?>">Quantity Pie</a>
                                        </li>
                                    </ul>
                            </li>
                            <li>
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#">Role</a>
                                    <ul>
                                        <li>
                                            <a href="<?= base_url() . 'admin/user'?>">User</a>
                                        </li>
                                        <li>
                                        <a href="<?= base_url() . 'admin/department'?>">Department</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() . 'admin/section'?>">Section</a>
                                        </li>
                                    </ul>
                            </li>
                        </ul>
                 
                        
                    </div>
                    <!-- END Side Navigation -->
                </div>
                <!-- Sidebar Content -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button>
                        <!-- END Toggle Sidebar -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->

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
                                    <i class="si si-list"></i> Order List Plan
                                </a>
                               
                                <a class="dropdown-item" href="<?php echo base_url();?>admin/dashboard/IOActual">
                                    <i class="si si-list"></i> Order List Actual
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
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->
            </header>
            <!-- END Header -->
            <!-- END Header -->



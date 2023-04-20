<?php

$last = $this->uri->total_segments();
$url = $this->uri->segment($last);
$second_url = $this->uri->segment($last - 1);
// pre($second_url);
$user_id = session_get('euserId');

$user_data = $this->db->get_where(USERS, array('ID' => $user_id))->result_array();
if (!empty($user_data)) {
    $user_info = $user_data[0];
} else {
    $user_info = array();
}

// pre($user_info);

$subadmin_data = $this->db->get_where(SUB_ACCESS, array('subadmin' => $user_id))->result_array();
if (!empty($subadmin_data)) {
    $subadmin_info = json_decode($subadmin_data[0]['access_fields'], true);
    $subadmin_data = $subadmin_data[0];
} else {
    $subadmin_data = array();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo APP_NAME." | ".$page_title ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/fullcalendar/main.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/fullcalendar-daygrid/main.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/fullcalendar-timegrid/main.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/fullcalendar-bootstrap/main.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/dist/css/adminlte.min.css') ?>">

    <!-- STYLE -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DATATABLE -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">

    <!-- SELECT 2 -->

    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">

    <!-- TOASTR -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/toastr/toastr.min.css') ?>">

    <!-- EDITOR -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/summernote/summernote-bs4.css') ?>">
    <style>

.nav-pills .nav-link {
    color: #000;
}
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff;
    background: linear-gradient(to right, #ff5e62, #ff9966);
}
.brand-link, .info{
    /* color: linear-gradient(to right, #ff5e62, #ff9966); */
    background: -webkit-linear-gradient(#ff5e62, #ff5e62);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    /* font-size: 27px; */
}

.footer-link{
    background: -webkit-linear-gradient(#ff5e62, #ff5e62);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.nav-pills:hover .nav-link:hover, .nav-pills:hover .show>.nav-link:hover {
    color: #fff;
    background: linear-gradient(to right, #ff5e62, #ff9966);
}

.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background: linear-gradient(to right, #ff5e62, #ff9966);
    border: none;
}

.page-link{
    color: #000;
}






/*.elevation-3 {
    box-shadow: 0 0 0 rgba(0,0,0,0),0 0 0 rgba(0,0,0,.23)!important;
}

.img-circle {
    border-radius: 0% !important;
}

.brand-link .brand-image {
     float: none !important;
     max-height: none !important; 
}*/



   
}

</style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url('admin/dashboard') ?>" class="nav-link">Home</a>
                </li>
            </ul>



            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <?php if(!empty($user_info['avatar'])){ ?>
                            <img src="<?php echo base_url('site-assets/img/user-avatar/250-200-') . $user_info['avatar']; ?>" class="user-image img-circle elevation-2" alt="User Image">
                        <?php  } else { ?>
                            <img src="<?php echo base_url('site-assets/img/user-avatar/admin-default.png')?>" class="user-image img-circle elevation-2" alt="User Image">
                        <?php   } ?>
                        <span class="d-none d-md-inline"><?php echo $user_info['username'] ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header ">
                            <?php if(!empty($user_info['avatar'])){ ?>
                               <img src="<?php echo base_url('site-assets/img/user-avatar/250-200-') . $user_info['avatar']; ?>" class="img-circle elevation-2" alt="User Image">
                            <?php  } else { ?>
                                    <img src="<?php echo base_url('site-assets/img/user-avatar/admin-default.png')?>" class="img-circle elevation-2" alt="User Image">
                            <?php   } ?>


                            <p>
                                <?php echo $user_info['username'] ?>
                                <small>Member since
                                    <?php echo date('M, Y', strtotime($user_info['created_at'])) ?></small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="<?php echo base_url('admin/edit-profile') ?>" class="btn btn-default btn-flat">Profile</a>
                            <a href="<?php echo base_url('admin/logout') ?>" class="btn btn-default btn-flat float-right">Sign out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo base_url('admin/dashboard') ?>" class="brand-link">
                <!-- <img src="<?php echo base_url('site-assets/img/user-avatar/') . $user_info['avatar']; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
                <div style="text-align: center;">
                <img alt="AdminLTE Logo" class="brand-image img-circle elevation-3 element.style elevation-3 img-circle" src="<?php echo base_url('assets/admin/dist/img/logo.png') ?>" alt="logo.gif" style="width: 81px; height: auto; padding: 8px 0 5px 0;">
                
                </div>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php if(!empty($user_info['avatar'])){ ?>
                            <img src="<?php echo base_url('site-assets/img/user-avatar/250-200-') . $user_info['avatar']; ?>" class="img-circle elevation-2" alt="User Image">
                        <?php  } else { ?>
                            <img src="<?php echo base_url('site-assets/img/user-avatar/admin-default.png')?>" class="img-circle elevation-2" alt="User Image">
                        <?php   } ?>
                       
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo  $user_info['username'] ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/dashboard') ?>" class="nav-link <?php if ($url == 'dashboard') {
                                                                                                    echo 'active';
                                                                                                } ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <?php if (session_get('role') == 2 ? isset($subadmin_info) && in_array('vendor_section', $subadmin_info) : 1) { ?>
                            <!-- <li class="nav-item">
                            <a href="<?php echo base_url('admin/vendors') ?>"
                                class="nav-link <?php if ($url == 'vendors' || $url == 'vendor-page' || $second_url == 'edit-vendor') {
                                                    echo 'active';
                                                } ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Vendor
                                </p>
                            </a>
                        </li> -->
                        <?php } ?>


                        <?php if (session_get('role') == 2 ? isset($subadmin_info) && in_array('users_section', $subadmin_info) : 1) { ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('admin/all-users') ?>" class="nav-link <?php if ($url == 'all-users' || $second_url == 'edit-user') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Users
                                    </p>
                                </a>
                            </li>
                        <?php } ?>


                        <?php if (session_get('role') == 2 ? isset($subadmin_info) && in_array('users_section', $subadmin_info) : 1) { ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('admin/reported-users') ?>" class="nav-link <?php if ($url == 'reported-users') {
                                                                                                                echo 'active';
                                                                                                            } ?>">
                                    <i class="nav-icon fa fa-flag"></i>
                                    <p>
                                        Reported Users
                                    </p>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (session_get('role') == 2 ? isset($subadmin_info) && in_array('users_section', $subadmin_info) : 1) { ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('admin/blocked-users') ?>" class="nav-link <?php if ($url == 'blocked-users') {
                                                                                                                echo 'active';
                                                                                                            } ?>">
                                    <i class="nav-icon fas fa-ban"></i>
                                    <p>
                                        Blocked Users
                                    </p>
                                </a>
                            </li>
                        <?php } ?>


                        <?php if (session_get('role') == 2 ? isset($subadmin_info) && in_array('users_section', $subadmin_info) : 1) { ?>
                            <!-- <li class="nav-item">
                                <a href="<?php echo base_url('admin/fake-profiles') ?>" class="nav-link <?php if ($url == 'fake-profiles') {
                                                                                                            echo 'active';
                                                                                                        } ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Fake Profiles
                                    </p>
                                </a>
                            </li> -->
                        <?php } ?>
                        
                        <?php if (session_get('role') == 2 ? isset($subadmin_info) && in_array('users_section', $subadmin_info) : 1) { ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('admin/notifications') ?>" class="nav-link <?php if ($url == 'notifications'|| $url=='send-notifications') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                    <i class="nav-icon fas fa-bell"></i>
                                    <p>
                                        Notifications
                                    </p>
                                </a>
                            </li>
                        <?php } ?>





                        <?php if (session_get('role') == 2 ? isset($subadmin_info) && in_array('users_section', $subadmin_info) : 1) { ?>
                        <!-- <li class="nav-item">
                            <a href="<?php echo base_url('admin/inbox-users') ?>"
                                class="nav-link <?php if ($url == 'inbox-users') {
                                                    echo 'active';
                                                } ?>">
                                <i class="nav-icon fas fa-box"></i>
                                <p>
                                Inbox
                                </p>
                            </a>
                        </li> -->
                        <?php } ?>


                        <?php if (session_get('role') == 2 ? isset($subadmin_info) && in_array('users_section', $subadmin_info) : 1) { ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('admin/edit-profile') ?>" class="nav-link <?php if ($url == 'edit-profile') {
                                                                                                            echo 'active';
                                                                                                        } ?>">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Admin Profile
                                    </p>
                                </a>
                            </li>
                        <?php } ?>



                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/logout') ?>" class="nav-link">
                                <i class="nav-icon fas fa-lock"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>

                        <?php if (session_get('role') == 2 ? isset($subadmin_info) && in_array('subadmin_section', $subadmin_info) : 1) { ?>
                            <!-- <li class="nav-item">
                            <a href="<?php echo base_url('admin/subadmin') ?>"
                                class="nav-link <?php if ($url == 'subadmin' || $url == 'subadmin-page' || $second_url == 'edit-subadmin') {
                                                    echo 'active';
                                                } ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Subadmin
                                </p>
                            </a>
                        </li> -->
                        <?php } ?>

                        <!-- <li class="nav-item has-treeview">
                            <a href="#" class="nav-link <?php if ($second_url == 'pages' || $second_url == 'other-pages') {
                                                            echo 'active';
                                                        } ?>">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link <?php if ($second_url == 'pages') {
                                                                    echo 'active';
                                                                } ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Home
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url('admin/pages/home-page-banner') ?>"
                                                class="nav-link <?php if ($url == 'add-home-page-banner' || $url == 'home-page-banner') {
                                                                    echo 'active';
                                                                } ?>">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Banner</p>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="<?php echo base_url('admin/pages/home-page-category') ?>"
                                                class="nav-link <?php if ($url == 'home-page-category') {
                                                                    echo 'active';
                                                                } ?>">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Category</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo base_url('admin/pages/home-page-services') ?>"
                                                class="nav-link <?php if ($url == 'home-page-services') {
                                                                    echo 'active';
                                                                } ?>">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Services</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo base_url('admin/pages/home-page-contact') ?>"
                                                class="nav-link <?php if ($url == 'home-page-contact') {
                                                                    echo 'active';
                                                                } ?>">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Contact</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link <?php if ($second_url == 'other-pages') {
                                                                    echo 'active';
                                                                } ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Other pages
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url('admin/other-pages/terms-conditions') ?>"
                                                class="nav-link <?php if ($url == 'terms-conditions') {
                                                                    echo 'active';
                                                                } ?>">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Terms & Conditions</p>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="<?php echo base_url('admin/other-pages/privacy-policy') ?>"
                                                class="nav-link <?php if ($url == 'privacy-policy') {
                                                                    echo 'active';
                                                                } ?>">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Privacy policy</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li> -->



                        <?php if (session_get('role') == 2 ? isset($subadmin_info) && in_array('vendor_section', $subadmin_info) : 1) { ?>
                            <!-- <li class="nav-item">
                            <a href="<?php echo base_url('admin/coupons') ?>"
                                class="nav-link <?php if ($url == 'coupons' || $url == 'coupon-page' || $second_url == 'edit-coupon') {
                                                    echo 'active';
                                                } ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Coupon
                                </p>
                            </a>
                        </li> -->
                        <?php } ?>



                        <!-- <li class="nav-item has-treeview">
                            <a href="#" class="nav-link <?php if ($second_url == 'settings') {
                                                            echo 'active';
                                                        } ?>">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Settings
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                              
                                <li class="nav-item">
                                    <a href="<?php echo base_url('admin/settings/payments') ?>"
                                        class="nav-link <?php if ($url == 'payments') {
                                                            echo 'active';
                                                        } ?>">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Payments</p>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a href="<?php echo base_url('admin/settings/email-setting') ?>"
                                        class="nav-link <?php if ($url == 'email-setting') {
                                                            echo 'active';
                                                        } ?>">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>E-mail</p>
                                    </a>
                                </li>




                            </ul>
                        </li> -->

                        <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Vendor
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> -->
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


<?php
    require($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
    require(APP_PATH.'config/helper.php');
    require(APP_PATH.'models/Model.php');
    $db = new Model;

    if (isset($_SESSION['authority'])) {
        $authority = $db->select('admin_user', ['id' => $_SESSION['authority']]);
    }else {
        redirect('Authority/index');
    }
            // $result = $db->select('admin_user', null);
            // print_r($result);
        $value = $db->select_row('authority', ['user_id' => $authority['id']]);
        
        // print_r($value);
?>
<!DOCTYPE html>
<html lang="en">  
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kamgaro | DASHBOARD</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link href="https://www.jqueryscript.net/demo/Highly-Customizable-jQuery-Toast-Message-Plugin-Toastr/build/toastr.css" rel="stylesheet" type="text/css" />

    <link href="https://kamgaro.com/bootstrap/css/nprogress.css" rel="stylesheet" type="text/css" />

    <link href="https://kamgaro.com/bootstrap/css/custom.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="css/1sb-admin.min.css" rel="stylesheet" type="text/css" />

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script type="text/javascript" src="https:////cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="https://kamgaro.com/bootstrap/js/nprogress.js" type="9f2f1083a5a3d3a9c39893e3-text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-progressbar/0.9.0/bootstrap-progressbar.min.js" integrity="sha512-gBaNrdEUsGGVww431pfOqMlf+h1PaBMV3/ahRuVdIdeeUPbewu6e3gOoHNK1zv4pFaW5Q534Y8DKLOsDKe39Ug==" crossorigin="anonymous"></script>

    <script src="https://kamgaro.com/bootstrap/js/custom.min.js" type="9f2f1083a5a3d3a9c39893e3-text/javascript"></script>

    <script src="https://www.jqueryscript.net/demo/Highly-Customizable-jQuery-Toast-Message-Plugin-Toastr/toastr.js"></script>

    <script src="https://kamgaro.com/bootstrap/js/toast.js"></script>

    <script src="https://kamgaro.com/bootstrap/js/rocket-loader.min.js" data-cf-settings="9f2f1083a5a3d3a9c39893e3-|49" defer=""></script>

    <style>
        body {
            background: #F7F7F7;
        }
        .header {
            position: fixed;
            z-index: 11;
            height: 58px;
        }
        .top-right {
            z-index: 11;
            position: fixed;
            right: 0;
        }
        .title-main {
            height: 58px;
            position: fixed;
            z-index: 11;
        }
        #toast-container > div {
            opacity: 1;
            font-size: 16px;
            font-weight: 600;
        }
    </style>
    <script>
        function changeClass()
        {
            var x = document.getElementById('side-bar').offsetWidth;
            if(x == 70)
                document.getElementById('sidebar-menu').style.marginTop = "60px";
            else
                document.getElementById('sidebar-menu').style.marginTop = "0px";
        }
    </script>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container" style="background: #2A3F54;min-height: 100%;">
        <div class="col-md-3 left_col" id="side-bar" style="background: #2A3F54;min-height: 100%;">
            <div class="left_col scroll-view" style="background: #2A3F54;min-height: 100%;">
                <div class="navbar nav_title title-main" style="border: 0;">
                    <a href="http://kamgaro.com/" class="site_title"> <span>KAMGARO</span></a>
                </div>
                <div class="clearfix"></div>
                <div class="profile clearfix" style="padding-top: 58px;">
                    <div class="profile_pic">
                        <img src="<?= base_url(); ?>Admin/uploads/service/<?= $authority['image']; ?>" class="img-circle profile_img" alt="" />                    
                    </div>
                    <div class="profile_info">
                        <span>Welcome!</span>
                        <h2><?= $authority['name']; ?></h2>
                    </div>
                </div>
                <br />
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a href="index"><i class="fa fa-home"></i> Home </a></li>
                              <?php foreach ($value as $row) {?>
                            <?php  if ($row['authority'] == 'Users' && $row['status'] == 1) { ?>
                            <li><a href="customer"><i class="fa fa-users"></i> Users </a></li>
                            <?php } ?>
                            <?php  if ($row['authority'] == 'Agents' && $row['status'] == 1) { ?>
                            <li><a href="agent"><i class="fa fa-male"></i> Agents </a></li>
                            <?php } ?>
                            <?php  if ($row['authority'] == 'Vender' && $row['status'] == 1) { ?>
                            <li><a href="users"><i class="fa fa-users"></i> Vendor </a></li>
                            <?php } ?>
                            <?php  if ($row['authority'] == 'Customer Order' && $row['status'] == 1) { ?>
                            <li><a href="cust_order"><i class="fa fa-users"></i> Customer Order </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Vendor Order' && $row['status'] == 1) { ?>
                            <li><a href="ven_order"><i class="fa fa-users"></i> Vendor Order </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Freelancer' && $row['status'] == 1) { ?>
                            <li><a href="freelancer"><i class="fa fa-users"></i> Freelancer </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Add Agency' && $row['status'] == 1) { ?>
                            <li><a href="add_agency"><i class="fa fa-user-plus "></i> Add Agency </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'News' && $row['status'] == 1) { ?>
                            <li><a href="add_news"><i class="fa fa-user-plus "></i> News </a></li>
                            <?php } ?>
                            <?php  if ($row['authority'] == 'News Data' && $row['status'] == 1) { ?>
                            <li><a href="news_data"><i class="fa fa-user-plus "></i> News Data </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Nominee' && $row['status'] == 1) { ?>
                            <li><a href="nominee"><i class="fa fa-user-plus "></i> Nominee </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Agencies' && $row['status'] == 1) { ?>
                            <li><a href="show_agency"><i class="fa fa-th-large"></i> Agencies </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Payment' && $row['status'] == 1) { ?>
                            <li><a href="payment"><i class="fa fa-money"></i> Payment </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Agency Payment' && $row['status'] == 1) { ?>
                            <li><a href="due_payment"><i class="fa fa-money"></i> Agency Payment </a></li>
                            <?php } ?>
                            
                            <?php  if ($row['authority'] == 'Wallet Money' && $row['status'] == 1) { ?>
                            <li><a href="wallet"><i class="fa fa-money"></i> Wallet Money </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Location' && $row['status'] == 1) { ?>
							<li><a href="city"><i class="fa fa-map-marker"></i> Location </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Category' && $row['status'] == 1) { ?>
                            <li><a href="category"><i class="fa fa-th-list"></i> Category </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Product Category' && $row['status'] == 1) { ?>
                            <li><a href="product_category"><i class="fa fa-th-list"></i> Product Category </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Hire Enquery' && $row['status'] == 1) { ?>
                            <li><a href="hire-now"><i class="fa fa-envelope"></i> Hire Enquiry </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Filter User' && $row['status'] == 1) { ?>
                            <li><a href="user-filter"><i class="fa fa-filter"></i> Filter User </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Filter Agent' && $row['status'] == 1) { ?>
                            <li><a href="agent-filter"><i class="fa fa-filter"></i> Filter Agent </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Filter vender' && $row['status'] == 1) { ?>
                            <li><a href="filter-vendor"><i class="fa fa-filter"></i> Filter vender </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Service List' && $row['status'] == 1) { ?>
                            <li><a href="allow_service"><i class="fa fa-list-ul"></i> Service List </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Download Data' && $row['status'] == 1) { ?>
                            <li><a href="download"><i class="fa fa-download"></i> Download Data </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Query And Review' && $row['status'] == 1) { ?>
                            <li><a href="message"><i class="fa fa-comments"></i> Query & Review </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Product List' && $row['status'] == 1) { ?>
                            <li><a href="product_list"><i class="fa fa-comments"></i>Product List </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Withdraw Request' && $row['status'] == 1) { ?>
                            <li><a href="withdraw_request"><i class="fa fa-comments"></i>Withdraw Request </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Refer' && $row['status'] == 1) { ?>
                            <li><a href="refer"><i class="fa fa-comments"></i>Refer </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'User Refer' && $row['status'] == 1) { ?>
                            <li><a href="refrerEarningUser"><i class="fa fa-comments"></i>User Refer Money </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Agent Refer' && $row['status'] == 1) { ?>
                            <li><a href="refrerEarningAgent"><i class="fa fa-comments"></i>Agent Refer Money </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Vendor Refer' && $row['status'] == 1) { ?>
                            <li><a href="refrerEarningVendor"><i class="fa fa-comments"></i>Vendor Refer Money </a></li>
                            <?php } ?>

                            <?php  if ($row['authority'] == 'Freelancer Refer' && $row['status'] == 1) { ?>
                            <li><a href="refrerEarningFreelancer"><i class="fa fa-comments"></i>Freelancer Refer Money </a></li>
                            <?php } ?>
  

                             
                            <!-- <li><a href="role"><i class="fa fa-comments"></i> Role </a></li> -->
                            <!-- <?php  if ($row['authority'] == 'UI Control Panel') { ?>
                            <li><a href="ui_control"><i class="fa fa-television"></i> UI Control Panel </a></li>
                            <?php } ?> -->

                        <?php } ?>
                        
                        </ul>
                    </div>
                </div>
                <div class="sidebar-footer hidden-small">
                </div>
            </div>
        </div>
        <div class="top_nav">
            <div class="nav_menu header">
                <nav>
                    <div class="nav toggle" onclick="changeClass();">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right top-right">
                        <li>
                            <a href="javascript:void(0);" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="<?= base_url(); ?>Admin/uploads/service/<?= $authority['image']; ?>" alt="" /><?= $authority['name']; ?>                           
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="profile">My Profile</a></li>
                                <li><a href="profile"><span>Settings</span></a></li>
                                <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>
                        <li role="presentation" class="dropdown">
                            <!-- <a href="javascript:void(0);" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell"></i><span class="badge bg-green">0</span>
                            </a> -->
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                <a>
                                    <span class="image"><img src="<?= base_url(); ?>Admin/uploads/service/<?= $authority['image']; ?>" alt="" /></span>
                                    <span><span>John Smith</span><span class="time">3 mins ago</span></span>
                                    <span class="message">Film festivals used to be do-or-die moments for movie makers.</span>
                                </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a><strong>See All Alerts</strong><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="right_col" role="main" style="padding-top: 80px !important;min-height: 100% !important;">
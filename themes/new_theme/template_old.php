<!DOCTYPE html>
<head>
    <?php
    $this->load->model('master/master_model');
    $this->load->model('staff_tickets/staff_tickets_model');
    $this->load->model('admin/admin_model');
    $user_det = $this->session->userdata('logged_in');
    //echo "<pre>";print_r($user_det);exit;
    $staff_id = $user_det['user_id'];
    if ($user_det['staff_type'] == 'staff') {
        $data["all"] = $this->staff_tickets_model->get_image_details($staff_id);
    } else {
        $data["admin"] = $this->admin_model->get_image_details($staff_id);
    }
    $permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
    //print_r($permission);exit;
    if (empty($user_det['application']))
        redirect($this->config->item("base_url") . 'admin/index');
    ?>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title><?= $this->config->item('site_title'); ?> | <?= $this->config->item('site_powered'); ?></title>
    <?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
    <link href="<?= $theme_path; ?>/images/fav.png" rel="shortcut icon" type="img/x-icon">
    <link rel="stylesheet" type="text/css" media="all" href="<?= $theme_path; ?>/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?= $theme_path; ?>/css/my_style.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?= $theme_path; ?>/css/media_print.css" />

    <!-- start page loader -->
    <link rel="stylesheet" type="text/css" media="all" href="<?= $theme_path; ?>/css/demo.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?= $theme_path; ?>/css/fakeLoader.css" />
    <!-- bootstrap 3.0.2 -->
    <link href="<?= $theme_path; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?= $theme_path; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $theme_path; ?>/css/ionicons.css" rel="stylesheet" type="text/css" />
    <link href="<?= $theme_path; ?>/css/icomoon.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?= $theme_path; ?>/css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?= $theme_path; ?>/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <link href="<?= $theme_path; ?>/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?= $theme_path; ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?= $theme_path; ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
    <!--<link href="<?= $theme_path; ?>/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />-->
    <!-- Theme style -->
    <link href="<?= $theme_path; ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="<?= $theme_path; ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?= $theme_path; ?>/css/chat_style.css" rel="stylesheet" type="text/css" />
    <script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
    <!--start loader -->
    <script src="<?= $theme_path; ?>/js/fakeLoader.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $(".fakeloader").fakeLoader({
                timeToHide: 450,<!--starting 1200-->
                bgColor: "#37474f",
                spinner: "spinner1"
            });
        });
    </script>
    <link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/jquery.datetimepicker.css" />
    <script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.datetimepicker.js"></script>

    <!--Chat Js-->

    <!--End Chat Js-->
</head>
<body class="skin-blue">
    <!--<div class="fakeloader"></div>-->

    <div class="print_header">
        <div class="print_header_logo"><img src="<?= $theme_path; ?>/images/kasc-sathy-logo.png" width="75" /></div>
        <div class="print_header_tit">
            <h2>SCHOOL NAME</h2>
            <p>Affiliated to School Name, Coimbatore - An <strong>ISO 9001:2008</strong> Certified Institution</p>
            <p>Addres: <strong>Ram Nagar, CBE Main Road, Pudur Post, Coimbatore-641101, <br>Tamilnadu, India</strong></p>
        </div>
    </div>
    <!-- header logo: style can be found in header.less -->
    <header class="header">
        <a href="<?= $this->config->item('base_url') ?>admin/dashboard" class="logo"><img src="<?= $theme_path; ?>/images/esoft.png" /> <!--<small>e-learning</small>--></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="ion-ios7-bell-outline temp-fs"></i>
                            <span class="label label-success"><span class='msg_count'></span></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <span class='msg_count'></span> unread messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu message_list">


                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-warning"></i>
                            <span class="label label-warning notification"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <span class='notification1'></span> unread notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu notification_list">

                                </ul>
                            </li>
                            <li class="footer"><a  href="<?= $this->config->item('base_url'), 'admin/view_all_notification' ?>">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-tasks"></i>
                            <span class="label label-danger unread_tickets_count"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <span class='unread_tickets_count1'></span> Unread Staff Tickets</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu unread_list">

                                </ul>
                            </li>
                            <li class="footer">
                                <a href="<?= $this->config->item('base_url'), 'staff_tickets' ?>">View all tickets</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span><?= ucfirst($this->user_auth->get_username()); ?> <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <?php if ($user_det['staff_type'] == 'staff') { ?>
                                    <img src="<?= $this->config->item('base_url') . 'profile_image/staff/orginal/' . $data['all'][0]['image']; ?>" class="img-circle" alt="User Image" />
                                <?php } else { ?>
                                    <img src="<?= $this->config->item('base_url') . 'profile_image/admin/original/' . $data['admin'][0]['image']; ?>" class="img-circle" alt="User Image" />
                                <?php } ?>
                                <p>
                                    <?= ucfirst($this->user_auth->get_username()); ?>- College Faculty
                                    <?php if ($user_det['staff_type'] == 'staff') { ?>

                                        <small>Member since <?= date('M', strtotime($data["all"][0]['join_date'])) ?>. <?= date('Y', strtotime($data["all"][0]['join_date'])) ?></small>
                                    <?php } ?>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!--<li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </li>-->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?php if ($user_det['staff_type'] == 'staff') { ?>
                                        <a href="<?= $this->config->item('base_url') . ('staff_tickets/staff_profile') ?>" class="btn btn-default btn-flat">Profile</a>
                                    <?php } else { ?>
                                        <a href="<?= $this->config->item('base_url') . ('admin/admin_profile') ?>" class="btn btn-default btn-flat">Profile</a>
                                    <?php } ?>
                                </div>
                                <div class="pull-right">
                                    <?php if ($user_det['staff_type'] == 'admin') { ?>
                                        <a href="<?= $this->config->item('base_url') . ('admin/logout') ?>" class="btn btn-danger btn-flat">Sign out</a>
                                    <?php } else { ?>
                                        <a href="<?= $this->config->item('base_url') . ('users/logout') ?>" class="btn btn-danger btn-flat">Sign out</a>
                                    <?php } ?>


                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="wrapper row-offcanvas row-offcanvas-left">

        <!--AJAX LOADING AND NOTIFICATIONS STARTS HERE-->
        <script type="text/javascript">
        function for_loading(txt)
        {
            //THIS IS FOR NOTIFICATION WHEN AJAX LOAD STARTS, CODE STARTS HERE
            $('#dyna_div').addClass('growl-success').removeClass('growl-success');
            $('#tick_img_spn').css('display', 'none');
            $('#load_img_div').css('display', 'block');
            $('#main_load_div').css('display', 'block');
            $('#cls_inf_bt').css('display', 'none');
            $('#info_txt').html(txt);
            //THIS IS FOR NOTIFICATION WHEN AJAX LOAD STARTS, CODE ENDS HERE
        }

        function for_response(txt)
        {
            //THIS IS FOR NOTIFICATION WHEN AJAX LOAD RESPONSE CAME CODE STARTS HERE
            $('#dyna_div').addClass('my_alert-success').removeClass('my_alert-info');
            $('#main_load_div').css('display', 'block');
            $('#cls_inf_bt').css('display', 'block');
            $('#load_img_div').css('display', 'none');
            $('#tick_img_spn').css('display', 'block');
            $('#info_txt').html(txt);
            setTimeout(function () {
                $('#main_load_div').css('display', 'none');
            }, $('#aja_notf_time').val());
            //THIS IS FOR NOTIFICATION WHEN AJAX LOAD RESPONSE CAME CODE ENDS HERE
        }

        $(document).ready(function ()
        {
            $('#cls_inf_bt').click(function () {
                $('#main_load_div').css('display', 'none');
            });
        });
        </script>
        <input name="" type="hidden" value="1000" id="aja_notf_time"> <!--NOTIFICATION TIMING-->
        <div class="alert_img" id="main_load_div" style="display:none">
            <div class="my_alert my_alert-info my_alert-dismissable" id="dyna_div">  <!--Alter nate class names "my_alert-success, my_alert-danger, my_alert-warning, my_alert-info"-->
                <div class="fa" id="load_img_div"><img src="<?= $theme_path; ?>/img/loading_small.gif" /></div>
                <i class="fa fa-check" style="display:none" id="tick_img_spn"></i>
                <button id="cls_inf_bt" type="button" class="my_close" data-dismiss="alert" aria-hidden="true">×</button>
                <!--<b>Alert !</b>--> <span id="info_txt">Success alert preview. This alert is dismissable.</span>
            </div>
        </div>
        <!--AJAX LOADING AND NOTIFICATIONS ENDS HERE-->
        <!-- .................................................................................................................................-->

        <div class="wrapper row-offcanvas row-offcanvas-left">

            <!--AJAX LOADING AND NOTIFICATIONS STARTS HERE-->
            <script type="text/javascript">
                function for_loading_del(txt)
                {
                    //THIS IS FOR NOTIFICATION WHEN AJAX LOAD STARTS, CODE STARTS HERE
                    $('#dyna_div_del').addClass('my_alert-warning').removeClass('my_alert-danger');
                    $('#tick_img_spn_del').css('display', 'none');
                    $('#load_img_div_del').css('display', 'block');
                    $('#main_load_div_del').css('display', 'block');
                    $('#cls_inf_bt').css('display', 'none');
                    $('#info_txt_del').html(txt);
                    //THIS IS FOR NOTIFICATION WHEN AJAX LOAD STARTS, CODE ENDS HERE
                }

                function for_response_del(txt)
                {
                    //THIS IS FOR NOTIFICATION WHEN AJAX LOAD RESPONSE CAME CODE STARTS HERE
                    $('#dyna_div_del').addClass('my_alert-danger').removeClass('my_alert-warning');
                    $('#main_load_div_del').css('display', 'block');
                    $('#cls_inf_bt_del').css('display', 'block');
                    $('#load_img_div_del').css('display', 'none');
                    $('#tick_img_spn_del').css('display', 'block');
                    $('#info_txt_del').html(txt);
                    setTimeout(function () {
                        $('#main_load_div_del').css('display', 'none');
                    }, $('#aja_notf_time_del').val());
                    //THIS IS FOR NOTIFICATION WHEN AJAX LOAD RESPONSE CAME CODE ENDS HERE
                }

                $(document).ready(function ()
                {
                    $('#cls_inf_bt_del').click(function () {
                        $('#main_load_div_del').css('display', 'none');
                    });
                });
            </script>
            <input name="" type="hidden" value="1000" id="aja_notf_time_del"> <!--NOTIFICATION TIMING-->
            <div class="alert_img" id="main_load_div_del" style="display:none">
                <div class="my_alert my_alert-dismissable my_alert-danger" id="dyna_div_del">  <!--Alter nate class names "my_alert-success, my_alert-danger, my_alert-warning, my_alert-info"-->
                    <div class="fa" id="load_img_div"><img src="<?= $theme_path; ?>/img/loading_small.gif" /></div>
                    <i class="fa fa-check" style="display:none" id="tick_img_spn_del"></i>
                    <button id="cls_inf_bt_del" type="button" class="my_close" data-dismiss="alert" aria-hidden="true">×</button>
                    <!--<b>Alert !</b>--> <span id="info_txt_del">Success alert preview. This alert is dismissable.</span>
                </div>
            </div>
            <!--AJAX LOADING AND NOTIFICATIONS ENDS HERE-->

            <!--THIS IS FOR CONFIRMATION GOX STARTS HERE-->
            <!-- <script type="text/javascript">

                     function confm()
                     {
                             $('#conf_bx').trigger("click");

                             $("#ok_btn").live('click',function(){ return true; });
                             $("#can_btn").live('click',function(){ return false; });

                     }
                     </script>
             <a href="#confirm_bx" id="conf_bx" data-toggle="modal" name="group" style="display:none"></a>
             <div id="confirm_bx" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"	align="center">
                     <div class="modal-dialog">
                     <div class="modal-content">
             <a class="close" data-dismiss="modal" id="cls_lin" style="display:none">×</a>

             <div class="modal-body" >
               Are you sure you want to Save this?
             </div>
             <div class="modal-footer">
              <button type="button" id="ok_btn" class="btn btn-primary" >OK</button>
                 <button id="can_btn" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
             </div>
         </div>
         </div>
         </div>-->
            <!--THIS IS FOR CONFIRMATION GOX EDNS HERE-->

            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php if ($user_det['staff_type'] == 'staff') { ?>

                                <a href="#admin_profile_img" data-toggle="modal"><img src="<?= $this->config->item('base_url') . 'profile_image/staff/thumb/' . $data['all'][0]['image'] ?>" style="width: 50px;
                                                                                      height: 50px;" class="img-circle" alt="User Image" /></a>

                            <?php } else { ?>
                                <a href="#admin_profile_img" data-toggle="modal"><img style="width: 50px;
                                                                                      height: 50px;" src="<?= $this->config->item('base_url') . 'profile_image/admin/original/' . $data['admin'][0]['image']; ?>" class="img-circle" alt="User Image" /></a>

                            <?php } ?>
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?= ucfirst($this->user_auth->get_username()); ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i><span id='online_status'></span></a>
                        </div>
                    </div>
                    <!-- search form -->
                    <!--<form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>-->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu sidebar-ul">
                        <li class="<?= ($this->router->fetch_method() == 'dashboard') ? 'active' : '' ?>">
                            <a href="<?= $this->config->item('base_url'), 'admin/dashboard' ?>" class="">
                                <i class="ion-home buzz-out"></i> <span>Dashboard</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <?php
                        if ($user_det['staff_type'] == 'admin') {
                            ?>
                            <li class="treeview">
                                <a href="#" id="mas">
                                    <i class="ion-ios7-keypad buzz-out"></i> <span>Master</span>
                                    <span class="selected"></span>
                                    <i class="fa fa-angle-left pull-right"></i>

                                </a>
                                <ul class="treeview-menu" style="display:<?php
                                if ($this->router->fetch_class() == 'batch' || $this->router->fetch_class() == 'designation' || $this->router->fetch_class() == 'semester' || $this->router->fetch_class() == 'department' || $this->router->fetch_class() == 'group' || $this->router->fetch_class() == 'master' || $this->router->fetch_method() == 'college_mark_details' || $this->router->fetch_class() == 'exam') {
                                    echo 'block';
                                } else {
                                    echo 'none';
                                }
                                ?>">
                                    <li class="<?= ($this->router->fetch_class() == 'batch') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'batch' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Academic Year</span>

                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_class() == 'designation') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'designation' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Designation</span>
                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_class() == 'semester') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'semester' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Terms</span>
                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_class() == 'department') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'department' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Class</span>
                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_class() == 'group') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'group' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Section</span>
                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_class() == 'exam') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'exam' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Exam</span>
                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_class() == 'master') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'master' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Master Rights</span>
                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_method() == 'college_mark_details') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'admin/college_mark_details' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Master Mark Details</span>
                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_method() == 'college_fees_details') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'admin/college_fees_details' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Master Fees Details</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?= ($this->router->fetch_method() == 'manage_admin') ? 'active' : '' ?>">
                                <a href="<?= $this->config->item('base_url'), 'admin/manage_admin' ?>">
                                    <i class="ion-log-in buzz-out"></i> <span>Admin</span>
                                    <span class="selected"></span>
                                </a>
                            </li>

                            <li class="<?= ($this->router->fetch_class() == 'staff') ? 'active' : '' ?>">
                                <a href="<?= $this->config->item('base_url'), 'staff' ?>">
                                    <i class="ion-android-social-user buzz-out"></i> <span>Staff</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="<?php
                        if ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == '') {
                            echo 'active';
                        }
                        ?>">
                            <a href="<?= $this->config->item('base_url'), 'student' ?>">
                                <i class="ion-ios7-people buzz-out"></i> <span>Student</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <?php ?>
                        <li class="<?= ($this->router->fetch_class() == 'subject') ? 'active' : '' ?>">
                            <a href="<?= $this->config->item('base_url'), 'subject' ?>">
                                <i class="ion-android-book buzz-out"></i> <span>Subject</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <?php
                        if ($permission[0]['attendance'] == 1) {

                            //echo $this->router->fetch_class();
                            ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="ion-android-calendar buzz-out"></i><span>Attendance</span>
                                    <span class="selected"></span>
                                    <i class="fa fa-angle-left pull-right"></i>

                                </a>
                                <ul class="treeview-menu" id="att" style="display:<?php
                                if ($this->router->fetch_class() == 'attendence' || $this->router->fetch_class() == 'attendance_od_ml' || $this->router->fetch_class() == 'attendance_report' || $this->router->fetch_class() == 'staff_attendence') {
                                    echo 'block';
                                } else {
                                    echo 'none';
                                }
                                ?>">
                                    <li class="<?= ($this->router->fetch_class() == 'attendence') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'attendence' ?>">
                                            <i class="fa fa-angle-double-right"></i><span>Attendance Details</span>
                                        </a>
                                    </li>

                                    <li class="<?= ($this->router->fetch_class() == 'attendance_od_ml') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'attendance_od_ml' ?>">
                                            <i class="fa fa-angle-double-right"></i><span>Attendance OD / ML / Leave</span>
                                        </a>
                                    </li>

                                    <li class="<?= ($this->router->fetch_class() == 'attendance_report') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'attendance_report' ?>">
                                            <i class="fa fa-angle-double-right"></i><span>Attendance Report</span>
                                        </a>
                                    </li>
                                    <?php if ($user_det['staff_type'] == 'admin') { ?>
                                        <li class="<?= ($this->router->fetch_class() == 'staff_attendence') ? 'active' : '' ?>">
                                            <a href="<?= $this->config->item('base_url'), 'staff_attendence/' ?>">
                                                <i class="fa fa-angle-double-right"></i><span>Staff Attendance</span>
                                            </a>
                                        </li>
                                        <li class="<?= ($this->router->fetch_class() == 'staff_attendance_report') ? 'active' : '' ?>">
                                            <a href="<?= $this->config->item('base_url'), 'staff_attendence/staff_attendance_report' ?>">
                                                <i class="fa fa-angle-double-right"></i><span>Staff Attendance Report</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <?php
                            }
                            if ($permission[0]['chat'] == 1) {
                                ?>
                            <li class="treeview">
                                <a href="#" id="rintu">
                                    <i class="ion-android-chat buzz-out"></i> <span>Chat</span>
                                    <span class="selected"></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu" id="chat" style="display:<?php
                                if ($this->router->fetch_method() == 'adminchat' || $this->router->fetch_class() == 'chat' || $this->router->fetch_method() == 'studentchat') {
                                    echo 'block';
                                } else {
                                    echo 'none';
                                }
                                ?>">

                                    <li class="
                                    <?php
                                    if ($this->router->fetch_method() == 'adminchat') {
                                        echo 'active';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'chat/adminchat' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Chat with Admin</span>
                                        </a>
                                    </li>

                                    <li class="<?php
                                    if ($this->uri->segment(1) == 'chat' && $this->uri->segment(2) == '') {
                                        echo 'active';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'chat' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Chat with Staff</span>
                                        </a>
                                    </li>


                                    <li class="<?php
                                    if ($this->router->fetch_method() == 'studentchat') {
                                        echo 'active';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'chat/studentchat' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Chat with Students</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="treeview" id="timetable">
                                <a href="#" id="rintu">
                                    <i class="fa fa-calendar"></i> <span>Time Table</span>
                                    <span class="selected"></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                }
                                if ($permission[0]['time_table'] == 1) {
                                    ?>
                                    <li class="<?php
                                    if ($this->uri->segment(1) == 'time_table' && $this->uri->segment(2) == '') {
                                        echo 'active';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'time_table' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Create Time Table</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                <?php }
                                ?>
                                <li class="<?php
                                if ($this->uri->segment(1) == 'time_table' && $this->uri->segment(2) == 'staff_table' && $this->uri->segment(3) == 'staff_view_time_table') {
                                    echo 'active';
                                }
                                ?>">
                                    <a href="<?= $this->config->item('base_url'), 'time_table/staff_table/staff_view_time_table' ?>">
                                        <i class="fa fa-angle-double-right"></i> <span>View Time Table</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>

                                <?php
                                if ($user_det['staff_type'] == 'staff') {
                                    ?>
                                    <li class="<?php
                                    if ($this->router->fetch_method() == 'staff_time_table') {
                                        echo 'active';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'time_table/staff_table/staff_time_table' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Staff Time Table</span>
                                        </a>
                                    </li>
                                <?php } ?>

                            </ul>
                        </li>



                        <?php
                        if ($permission[0]['internal_mark'] == 1) {
                            ?>
                            <li class="treeview <?= ($this->router->fetch_class() == 'internal' || $this->router->fetch_class() == 'student_promotion') ? 'active' : '' ?>">
                                <a href="#">
                                    <i class="ion-ios7-time-outline buzz-out"></i> <span>Exam</span>
                                    <span class="selected"></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu" id="ass1" >
    <!--                                    <li class="<?= ($this->router->fetch_class() == 'internal' && $this->router->fetch_method() == 'internal_exam') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'internal/internal_exam' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Internal</span>
                                        </a>
                                    </li>-->
                                    <li class="<?= ($this->router->fetch_class() == 'internal' && $this->router->fetch_method() == 'internal_exam_result') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'internal/internal_exam_result' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Exam Result</span>
                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_class() == 'internal' && $this->router->fetch_method() == 'student_report') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'internal/student_report' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Exam Report</span>
                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_class() == 'student_promotion') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'student_promotion' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Student Promotion</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php }
                        ?>

                        <li class="treeview">
                            <a href="#">
                                <i class="ion-android-star buzz-out"></i> <span>Faculty</span>
                                <span class="selected"></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                if ($permission[0]['assignment'] == 1) {
                                    ?>
                                    <li class="<?php
                                    if ($this->uri->segment(1) == 'assignment' && $this->uri->segment(2) == '' || $this->uri->segment(2) == 'add_assignment') {
                                        echo 'active';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'assignment' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Add Project</span>
                                        </a>
                                    </li>
                                    <li class="<?php
                                    if ($this->router->fetch_method() == 'staff_view') {
                                        echo 'active';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'assignment/staff_view' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>View Project</span>
                                        </a>
                                    </li>
                                <?php }
                                ?>
                                <?php if ($permission[0]['sharing_note'] == 1) {
                                    ?>
                                    <li class="<?= ($this->router->fetch_class() == 'notes') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'notes' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Share Notes</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                //if($permission[0]['event']==1){
                                ?>
                                <li class="<?= ($this->router->fetch_class() == 'events') ? 'active' : '' ?>">
                                    <a href="<?= $this->config->item('base_url'), 'events' ?>">
                                        <i class="fa fa-angle-double-right"></i> <span>Events</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                                <?php
                                //}
                                if ($user_det['staff_type'] == 'staff') {
                                    ?>
                                    <li class="<?= ($this->router->fetch_class() == 'staff_tickets') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'staff_tickets/' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Tickets</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li class="<?= ($this->router->fetch_method() == 'admin_view') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'staff_tickets/admin_view' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Tickets</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li class="<?= ($this->router->fetch_method() == 'college_calendar') ? 'active' : '' ?>">
                                    <a href="<?= $this->config->item('base_url'), 'admin/college_calendar' ?>">
                                        <i class="fa fa-angle-double-right"></i> <span>School Calendar</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                                <li class="<?= ($this->router->fetch_method() == 'notice') ? 'active' : '' ?>">
                                    <a href="<?= $this->config->item('base_url'), 'admin/notice' ?>">
                                        <i class="fa fa-angle-double-right"></i> <span>Notice Board</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        <?php
                        if ($permission[0]['fee_details'] == 1) {
                            ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="ion-android-system-home buzz-out"></i><span>Hostel</span>
                                    <span class="selected"></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu" id="att" style="display:<?php
                                if ($this->router->fetch_class() == 'hostel' || $this->router->fetch_method() == 'add_hostel' || $this->router->fetch_method() == 'add_room' || $this->router->fetch_method() == 'admission_list' || $this->router->fetch_method() == 'room_allocation_list' || $this->router->fetch_method() == 'monthly_fees_list' || $this->router->fetch_method() == 'pay_monthly_fees' || $this->router->fetch_method() == 'hostel_report') {
                                    echo 'block';
                                } else {
                                    echo 'none';
                                }
                                ?>">
                                    <li class="<?= ($this->router->fetch_method() == 'add_hostel') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'hostel/add_hostel' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Add Hostel</span>
                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_method() == 'add_room') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'hostel/add_room' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Add Room</span>
                                        </a>
                                    </li>
                                    <li class="<?php
                                    if ($this->router->fetch_method() == 'admission_list' || $this->router->fetch_method() == 'admission') {
                                        echo 'active';
                                    } else {
                                        '';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'hostel/admission_list' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Admission</span>
                                        </a>
                                    </li>
                                    <li class="<?php
                                    if ($this->router->fetch_method() == 'room_allocation_list' || $this->router->fetch_method() == 'room_allocation') {
                                        echo 'active';
                                    } else {
                                        '';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'hostel/room_allocation_list' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Room Allocations</span>
                                        </a>
                                    </li>
                                    <li class="<?php
                                    if ($this->router->fetch_method() == 'monthly_fees_list' || $this->router->fetch_method() == 'add_monthly_fees') {
                                        echo 'active';
                                    } else {
                                        '';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'hostel/monthly_fees_list' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Monthly Fees</span>
                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_method() == 'pay_monthly_fees') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'hostel/pay_monthly_fees' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Pay Monthly Fees</span>
                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_method() == 'hostel_report') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'hostel/hostel_report' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Dividing  Hostel Report</span>
                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_method() == 'hostel_report') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'hostel/non_dividing_hostel_report' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Non Dividing  Hostel Report</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-money buzz-out"></i><span>Billing</span>
                                    <span class="selected"></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu" id="att" style="display:<?php
                                if ($this->router->fetch_class() == 'fees' || $this->router->fetch_method() == 'exam_fees' || $this->router->fetch_method() == 'pay' || $this->router->fetch_method() == 'report') {
                                    echo 'block';
                                } else {
                                    echo 'none';
                                }
                                ?>">
                                    <li class="<?php
                                    if ($this->router->fetch_method() == 'exam_fees' || $this->router->fetch_method() == 'create') {
                                        echo 'active';
                                    } else {
                                        '';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'fees/exam_fees' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Terms / Other Fees</span>
                                        </a>
                                    </li>
                                <!--<li class="<?= ($this->router->fetch_method() == 'fees') ? 'active' : '' ?>">
                                   <a href="<?= $this->config->item('base_url'), 'fees/hostel_fees' ?>">
                                       <i class="fa fa-angle-double-right"></i> <span>Hostel Fees</span>
                                   </a>
                                    </li>
                                <li class="<?= ($this->router->fetch_method() == 'fees') ? 'active' : '' ?>">
                                   <a href="<?= $this->config->item('base_url'), 'fees/transport_fees' ?>">
                                       <i class="fa fa-angle-double-right"></i> <span>Transport Fees</span>
                                   </a>
                                    </li>-->
                                    <li class="<?= ($this->router->fetch_method() == 'pay') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'fees/pay' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Pay</span>
                                        </a>
                                    </li>
                                    <li class="<?= ($this->router->fetch_method() == 'report') ? 'active' : '' ?>">
                                        <a href="<?= $this->config->item('base_url'), 'fees/report' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Report</span>
                                        </a>
                                    </li>
                                </ul>
                            <?php } ?>
                            <?php if ($permission[0]['transport'] == 1) { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-road buzz-out"></i><span>Transport</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu"  style="display:<?php
                                if ($this->router->fetch_class() == 'transport' || $this->router->fetch_method() == 'bus_root_details' || $this->router->fetch_method() == 'transport_fees') {
                                    echo 'block';
                                } else {
                                    echo 'none';
                                }
                                ?>">
                                    <li class="<?php
                                    if ($this->router->fetch_class() == 'transport' && $this->router->fetch_method() == 'index') {
                                        echo 'active';
                                    } else {
                                        '';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'transport/index' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Master</span>
                                        </a>
                                    </li>
                                <!--<li class="<?= ($this->router->fetch_method() == 'bus_root_details') ? 'active' : '' ?>">
                                   <a href="<?= $this->config->item('base_url'), 'transport/index' ?>">

                                   </a>
                                       </li>-->
                                    <!--<li class="<?php
                                    if ($this->router->fetch_class() == 'transport' && $this->router->fetch_method() == 'add_driver') {
                                        echo 'active';
                                    } else {
                                        '';
                                    }
                                    ?>">
                                   <a href="<?= $this->config->item('base_url'), 'transport/add_driver' ?>">
                                       <i class="fa fa-angle-double-right"></i> <span>Add Driver</span>
                                   </a>
                                    </li>-->
                                    <li class="<?php
                                    if ($this->router->fetch_class() == 'transport' && $this->router->fetch_method() == 'bus_root_details') {
                                        echo 'active';
                                    } else {
                                        '';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'transport/bus_root_details' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Bus Route</span>
                                        </a>
                                    </li>
                                    <li class="<?php
                                    if ($this->router->fetch_class() == 'transport' && $this->router->fetch_method() == 'transport_fees') {
                                        echo 'active';
                                    } else {
                                        '';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'transport/transport_report' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Transport Report</span>
                                        </a>
                                    </li>
                                    <li class="<?php
                                    if ($this->router->fetch_class() == 'transport' && $this->router->fetch_method() == 'transport_fees') {
                                        echo 'active';
                                    } else {
                                        '';
                                    }
                                    ?>">
                                        <a href="<?= $this->config->item('base_url'), 'transport/transport_addmission' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Transport Fees</span>
                                        </a>
                                    </li>
                                    <li class="<?php
                                    if ($this->router->fetch_class() == 'transport' && $this->router->fetch_method() == 'transport_fees') {
                                        echo 'active';
                                    } else {
                                        '';
                                    }
                                    ?>">

                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <!--                        <li class="treeview">
                                                    <a href="#">
                                                        <i class="fa fa-certificate buzz-out"></i> <span>Placement</span>
                                                        <span class="selected"></span>
                                                        <i class="fa fa-angle-left pull-right"></i>
                                                    </a>
                                                    <ul class="treeview-menu" id="ass1" style="display:<?php
                        if ($this->router->fetch_class() == 'placement_test' || $this->router->fetch_method() == 'get_stud_result' || $this->router->fetch_method() == 'placement_list') {
                            echo 'block';
                        } else {
                            echo 'none';
                        }
                        ?>">

                                                        <li class="<?php
                        if ($this->uri->segment(1) == 'placement_test' && $this->uri->segment(2) == 'placement_test_questions') {
                            echo 'active';
                        } else {

                        }
                        ?>">
                                                            <a href="<?= $this->config->item('base_url'), 'placement_test/placement_test_questions' ?>">
                                                                <i class="fa fa-angle-double-right"></i> <span>Questions Add</span>
                                                            </a>
                                                        </li>
                                                        <li class="<?php
                        if ($this->router->fetch_class() == 'placement_test' && $this->router->fetch_method() == 'get_stud_result') {
                            echo 'active';
                        } else {
                            '';
                        }
                        ?>">
                                                            <a href="<?= $this->config->item('base_url'), 'placement_test/get_stud_result' ?>">
                                                                <i class="fa fa-angle-double-right"></i> <span>View Result</span>
                                                            </a>
                                                        </li>
                                                        <li class="<?php
                        if ($this->router->fetch_class() == 'placement' && $this->router->fetch_method() == 'placement_list') {
                            echo 'active';
                        } else {
                            '';
                        }
                        ?>">
                                                            <a href="<?= $this->config->item('base_url'), 'placement/placement_list' ?>">
                                                                <i class="fa fa-angle-double-right"></i> <span>Campus Interview</span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </li>-->
                        <?php if ($permission[0]['library'] == 1) { ?>
                            <!--<li class="treeview">

                                    <a href="#">
                                    <i class="fa fa-book buzz-out"></i> <span>Library</span>
                                     <span class="selected"></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu" id="ass1" style="display:<?php
                            if ($this->router->fetch_class() == 'library') {
                                echo 'block';
                            } else {
                                echo 'none';
                            }
                            ?>">

                                    <li>
                                        <a href="<?= $this->config->item('base_url'), 'library/manage_books' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Manage Books</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $this->config->item('base_url'), 'library/manage_cd' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Manage CD / DVD</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $this->config->item('base_url'), 'library/manage_examination' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Manage Examination Papers</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?= $this->config->item('base_url'), 'library/issue_book' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Issue a book</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $this->config->item('base_url'), 'library/return_book' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Return a book</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $this->config->item('base_url'), 'library/search_book' ?>">
                                            <i class="fa fa-angle-double-right"></i> <span>Search book</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>-->
                        <?php } ?>
                        <li class="treeview">
                            <a href="#">
                                <i class="ion-settings buzz-out"></i> <span>Report</span>
                                <span class="selected"></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu" id="ass1" >
                                <li class="">
                                    <a href="<?= $this->config->item('base_url'), 'student/student_report' ?>">
                                        <i class="fa fa-angle-double-right"></i> <span>Student Report</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?= $this->config->item('base_url'), 'attendance_report' ?>">
                                        <i class="fa fa-angle-double-right"></i><span>Student Attendance Report</span>
                                    </a>
                                </li>
                                <!--                                <li class="">
                                                                    <a href="<?= $this->config->item('base_url'), 'staff_attendence/staff_attendance_report' ?>">
                                                                        <i class="fa fa-angle-double-right"></i><span>Staff Attendance Report</span>
                                                                    </a>
                                                                </li>-->
                                <li class="">
                                    <a href="<?= $this->config->item('base_url'), 'assignment/staff_view' ?>">
                                        <i class="fa fa-angle-double-right"></i> <span>Project</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?= $this->config->item('base_url'), 'internal/student_report' ?>">
                                        <i class="fa fa-angle-double-right"></i> <span>Exam Result</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?= $this->config->item('base_url'), 'hostel/hostel_report' ?>">
                                        <i class="fa fa-angle-double-right"></i> <span>Dividing  Hostel Report</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?= $this->config->item('base_url'), 'hostel/non_dividing_hostel_report' ?>">
                                        <i class="fa fa-angle-double-right"></i> <span>Non Dividing  Hostel Report</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?= $this->config->item('base_url'), 'fees/report' ?>">
                                        <i class="fa fa-angle-double-right"></i> <span>Billing</span>
                                    </a>
                                </li>
                                <!--                                <li class="#">
                                                                    <a href="<?= $this->config->item('base_url'), 'placement_test/get_stud_result' ?>">
                                                                        <i class="fa fa-angle-double-right"></i> <span>Placement Result</span>
                                                                    </a>
                                                                </li>-->
                            </ul>
                        </li>
                        <!--<li class="<?= ($this->router->fetch_class() == 'download_form' && $this->router->fetch_method() != 'videos') ? 'active' : '' ?>">
                                    <a href="<?= $this->config->item('base_url'), 'download_form' ?>">
                                        <i class="ion-android-download buzz-out"></i> <span>Download Form</span>
                                         <span class="selected"></span>
                                    </a>
                        </li>
                        <li class="<?= ($this->router->fetch_class() == 'download_form' && $this->router->fetch_method() == 'videos') ? 'active' : '' ?>">
                                    <a href="<?= $this->config->item('base_url'), 'download_form/videos' ?>">
                                        <i class="ion-ios7-videocam buzz-out"></i> <span>Videos Search</span>
                                         <span class="selected"></span>
                                    </a>
                        </li>
                         <li class="<?= ($this->router->fetch_class() == 'reg_form' && $this->router->fetch_method() == 'st_registration') ? 'active' : '' ?>">
                                    <a href="<?= $this->config->item('base_url'), 'st_registration/st_registration' ?>">
                                        <i class="fa fa-edit buzz-out"></i> <span>Student Registration</span>
                                         <span class="selected"></span>
                                    </a>
                        </li> -->



                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side dboard-top">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>

                        <?php
                        $cur_class = $this->router->class;

                        $cur_method = $this->router->method;


                        if ($cur_class == 'time_table' && $cur_method == 'staff_time_table')
                            echo "Staff Time Table";
                        else if ($cur_class == 'time_table')
                            echo "Time Table";
                        else if ($cur_class == 'attendence')
                            echo "Attendance";
                        else if ($cur_class == 'admin' && $cur_method == 'dashboard')
                            echo "Dashboard";
                        else if ($cur_class == 'admin' && $cur_method == 'admin_profile')
                            echo "Profile";
                        else if ($cur_class == 'batch')
                            echo "Academic Year";
                        else if ($cur_class == 'designation')
                            echo "Designation";
                        else if ($cur_class == 'semester')
                            echo "Terms";
                        else if ($cur_class == 'department')
                            echo "Class";
                        else if ($cur_class == 'group')
                            echo "Section";
                        else if ($cur_class == 'master')
                            echo "Master Rights";
                        else if ($cur_class == 'admin' && $cur_method == 'college_mark_details')
                            echo "Master Mark Details";
                        else if ($cur_class == 'admin' && $cur_method == 'manage_admin')
                            echo "Create Admin";
                        else if ($cur_class == 'events')
                            echo "Events";
                        else if ($cur_class == 'staff')
                            echo "Staff";
                        else if ($cur_class == 'student' && $cur_method != 'student_report')
                            echo "Student";
                        else if ($cur_class == 'student' && $cur_method == 'student_report')
                            echo "Student Report";
                        else if ($cur_class == 'subject')
                            echo "Subject";
                        else if ($cur_class == 'events')
                            echo "Events";
                        else if ($cur_class == 'attendance_od_ml')
                            echo "Attendance OD / ML / Leave";
                        else if ($cur_class == 'attendance_report')
                            echo "Attendance Report";
                        else if ($cur_class == 'chat' && $cur_method == 'adminchat')
                            echo "Chat With Admin";
                        else if ($cur_class == 'chat' && $cur_method != 'studentchat')
                            echo "Chat With Staff";
                        else if ($cur_class == 'chat' && $cur_method == 'studentchat')
                            echo "Chat With Student";
                        else if ($cur_class == 'assignment')
                            echo "Project";
                        else if ($cur_class == 'internal' && $cur_method == 'internal_exam')
                            echo "Internal";
                        else if ($cur_class == 'internal' && $cur_method == 'internal_exam_result')
                            echo "Exam Result";
                        else if ($cur_class == 'internal' && $cur_method == 'student_report')
                            echo "Exam Report";
                        else if ($cur_class == 'internal' && $cur_method == 'cgpa_report')
                            echo "CGPA Report";
                        else if ($cur_class == 'internal' && $cur_method == 'mark_sheet')
                            echo "Mark Sheet";
                        else if ($cur_class == 'student_promotion')
                            echo "Student Promotion";
                        else if ($cur_class == 'notes')
                            echo "Share Notes";
                        else if ($cur_class == 'staff_tickets' && $cur_method == 'staff_profile')
                            echo "Profile";
                        else if ($cur_class == 'staff_tickets')
                            echo "Tickets";
                        else if ($cur_class == 'assignment')
                            echo "Project";
                        else if ($cur_class == 'assignment')
                            echo "Project";
                        else if ($cur_method == 'notice')
                            echo "Notice Board";
                        else if ($cur_method == 'staff_time_table')
                            echo "Staff Time Table";
                        else if ($cur_method == 'update_admin')
                            echo "Update Admin";
                        else if ($cur_method == 'add_hostel')
                            echo "Add Hostel";
                        else if ($cur_method == 'add_room')
                            echo "Add Room";
                        else if ($cur_method == 'admission_list')
                            echo "Admission";
                        else if ($cur_method == 'admission')
                            echo "Admission";
                        else if ($cur_method == 'view_student_admission')
                            echo "Admission";
                        else if ($cur_method == 'update_student_admission')
                            echo "Admission";
                        else if ($cur_method == 'room_allocation_list')
                            echo "Room Allocations";
                        else if ($cur_method == 'room_allocation')
                            echo "Room Allocations";
                        else if ($cur_method == 'monthly_fees_list')
                            echo "Monthly Fees";
                        else if ($cur_method == 'add_monthly_fees')
                            echo "Monthly Fees";
                        else if ($cur_method == 'view_monthly_fees')
                            echo "Monthly Fees";
                        else if ($cur_method == 'update_monthly_fees')
                            echo "Monthly Fees";
                        else if ($cur_method == 'pay_monthly_fees')
                            echo "Pay Monthly Fees";
                        else if ($cur_method == 'hostel_report')
                            echo "Dividing Hostel Report";
                        else if ($cur_method == 'non_dividing_hostel_report')
                            echo "Non-Dividing Hostel Report";
                        else if ($cur_method == 'exam_fees')
                            echo "Terms/Other Fees";
                        else if ($cur_method == 'create')
                            echo "Terms/Other Fees";
                        else if ($cur_method == 'exam_fees_view')
                            echo "Terms/Other Fees";
                        else if ($cur_method == 'update_fees_view')
                            echo "Terms/Other Fees";
                        else if ($cur_method == 'pay')
                            echo "Pay";
                        else if ($cur_method == 'report')
                            echo "Report";
                        else if ($cur_class == 'download_form' && $cur_method != 'videos')
                            echo "Upload Form";
                        else if ($cur_class == 'download_form' && $cur_method == 'videos')
                            echo "Video Search";
                        else if ($cur_method == 'staff_view_time_table')
                            echo "Time Table";
                        else if ($cur_method == 'placement_test_questions')
                            echo "Placement Test Questions";

                        else if ($cur_class == 'staff_attendence' && $cur_method != 'staff_attendance_report')
                            echo "Staff Attendance";

                        else if ($cur_class == 'staff_attendence' && $cur_method == 'staff_attendance_report')
                            echo "Staff Attendance Report";


                        else if ($cur_class == 'library' && $cur_method == 'manage_books')
                            echo "Manage Book";
                        else if ($cur_class == 'library' && $cur_method == 'manage_cd')
                            echo "Manage CD/DVD";
                        else if ($cur_class == 'library' && $cur_method == 'edit_cd')
                            echo "Edit Manage CD/DVD";
                        else if ($cur_class == 'library' && $cur_method == 'manage_examination')
                            echo "Manage Examination Question Paper";


                        else if ($cur_class == 'library' && $cur_method == 'issue_book')
                            echo "Issue a Book";
                        else if ($cur_class == 'library' && $cur_method == 'return_book')
                            echo "Return a Book";
                        else if ($cur_class == 'library' && $cur_method == 'search_book')
                            echo "Search Books";
                        ?>
                    </h1>
                </section>



                <!-- Main content -->
                <section class="content">
                    <div class="box box-info">
                        <div class="box-body table-responsive">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </section><!-- /.content -->

            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <div class="main_footer">
            <div class="footer_style">Copyright 2018 School Software. All rights reserved. Powered by <a href="http://www.f2fsolutions.co.in/" target="_blank"class="foot-color">f2f solutions</a></div>
        </div>

        <!-- add new calendar event modal -->
        <!-- jQuery 2.0.2 -->
        <script src="<?= $theme_path; ?>/js/bootbox.js" type="text/javascript"></script>
        <script src="<?= $theme_path; ?>/js/demos.js" type="text/javascript"></script>
        <script src="<?= $theme_path; ?>/js/bootstrap.js" type="text/javascript"></script>
        <!--Chat Js-->
        <script src="<?= $theme_path; ?>/js/chat_js.js" type="text/javascript"></script>
        <!--End Chat Js-->

        <!--Chat Js-->
        <script src="<?= $theme_path; ?>/js/jquery.validate.min.js" type="text/javascript"></script>
        <!--File Upload Js-->
        <script src="<?= $theme_path; ?>/js/ajaxfileupload.js" type="text/javascript"></script>

        <!-- DATA TABES SCRIPT -->
        <script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="<?= $theme_path; ?>/js/common_validation.js" type="text/javascript"></script>


        <script type="text/javascript">
                $(function () {
                    $("#example1").dataTable();
                    $("#example4").dataTable();
                    $("#example5").dataTable();
                    $("#example3").dataTable();
                    $("#example4").dataTable();
                    $("#example5").dataTable();
                    $('#example2').dataTable({
                        "bPaginate": true,
                        "bLengthChange": false,
                        "bFilter": false,
                        "bSort": true,
                        "bInfo": true,
                        "bAutoWidth": false
                    });
                });
                // for refreshing the page
                /*window.onpageshow = function(event) {
                 if (event.persisted) {

                 window.location.reload();

                 }
                 };*/
        </script>


        <!-- Morris.js charts -->
        <script src="<?= $theme_path; ?>/js/raphael-min.js" type="text/javascript"></script>

        <script src="<?= $theme_path; ?>/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="<?= $theme_path; ?>/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?= $theme_path; ?>/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>

        <script src="<?= $theme_path; ?>/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="<?= $theme_path; ?>/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?= $theme_path; ?>/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?= $theme_path; ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5
        <script src="<?= $theme_path; ?>/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="<?= $theme_path; ?>/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>-->

        <!-- iCheck -->
        <script src="<?= $theme_path; ?>/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <script src="<?= $theme_path; ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?= $theme_path; ?>/js/AdminLTE/app.js" type="text/javascript"></script>

        <script type="text/javascript">

                var BASE_URL = '<?php echo $this->config->item('base_url'); ?>';
                var sess = '<?php echo $this->user_auth->get_username(); ?>';
        </script>



        <script src="<?= $theme_path; ?>/js/chat_js.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>chatty/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>chatty/js/chat.js"></script>
        <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>chatty/css/chat.css" />
        <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>chatty/css/screen.css" />
        <script type="text/javascript">
                $(function () {
                    $("#example1").dataTable();
                    $("#example4").dataTable();
                    $("#example5").dataTable();
                    $("#example3").dataTable();
                    $('#example2').dataTable({
                        "bPaginate": true,
                        "bLengthChange": false,
                        "bFilter": false,
                        "bSort": true,
                        "bInfo": true,
                        "bAutoWidth": false
                    });
                });

                $(".timepicker").timepicker({
                    showInputs: false
                });

                /*$(".bootstrap-timepicker-widget").live('blur',function(){
                 $('.bootstrap-timepicker-widget').addClass('open');
                 });
                 $(".timepicker").live('blur',function(){
                 $('.bootstrap-timepicker-widget').removeClass('open');
                 });*/
        </script>

        <script type="text/javascript">// <![CDATA[

            setInterval(function () {
                $.getJSON(BASE_URL + 'api/get_notification', function (result) {

                    if (result)
                    {
                        $('.fa-circle').addClass('text-success');
                        $('#online_status').html('Online');
                    } else
                    {
                        $('.fa-circle').removeClass('text-success');
                        $('#online_status').html('Offline');
                    }
                    $('.unread_tickets_count').html(result['unread_tickets_count']);
                    $('.notification').html(result['unread_notification_count']);
                    $('.msg_count').html(result['get_unread_message_count']);

                    if (result['get_unread_message_count'] == 0)
                        $('.label-success').hide();
                    else
                        $('.label-success').show();
                    list = '';
                    for (i = 0; i < result['unread_tickets'].length; i++)
                    {
                        if (result['unread_tickets'][i]['read'] == 1 || result['unread_tickets'][i]['read'] == 3)
                            color_tr = 'rgb(242, 252, 242)';
                        else
                            color_tr = 'rgb(255, 254, 232)';
                        if (result['unread_tickets'][i]['status'] == 0)
                            status = 'Open';
                        else
                            status = 'Closed';
                        if (result['unread_tickets'][i]["subject"].length > 30)
                            tickets = result['unread_tickets'][i]["subject"].substring(0, 30) + "...";
                        else
                            tickets = result['unread_tickets'][i]["subject"];

                        list = list + "<li style='background-color:" + color_tr + "' class='unread_class' id=" + result['unread_tickets'][i]["id"] + "><a href='#' style='color:#000;font-size: 12px;'><h3>" + result['unread_tickets'][i]["name1"] + "-" + result['unread_tickets'][i]["department"] + "<small class='pull-right'><i class='fa fa-clock-o'></i>" + result['unread_tickets'][i]["ldt"] + "</small></h3><div style='color:green'>" + tickets + "</div>" + status + "</a></li>";



                    }
                    if (list == '')
                    {
                        list = '<li>No Staff Tickets..</li>';
                        $('.unread_tickets_count1').html('No');
                    } else
                        $('.unread_tickets_count1').html(result['unread_tickets_count']);

                    list1 = '';
                    for (ii = 0; ii < result['unread_notification'].length; ii++)
                    {
                        console.log(result['unread_notification'][ii]['read']);
                        /*list1=list1+"<li><a class='all_notification "+result['unread_notification'][ii]['links']+"' id='"+result['unread_notification'][ii]['update_id']+"' >"+result['unread_notification'][ii]['notification']+result['unread_notification'][ii]['name']+result['unread_notification'][ii]['date']+"</a></li>";*/
                        if (result['unread_notification'][ii]['read'] == 1)
                            color_tr = 'rgb(242, 252, 242)';
                        else
                            color_tr = 'rgb(255, 254, 232)';
                        if (result['unread_notification'][ii]['notification'].length > 30)
                            note = result['unread_notification'][ii]['notification'].substring(0, 30) + "...";
                        else
                            note = result['unread_notification'][ii]['notification'];
                        list1 = list1 + "<li style='background-color:" + color_tr + "' class='staff_notify'><a style='color:#000;font-size: 12px;' class='all_notification " + result['unread_notification'][ii]['links'] + "' id='" + result['unread_notification'][ii]['update_id'] + "' ><h4>" + result['unread_notification'][ii]['name'] + "<small style='float: right'><i class='fa fa-clock-o'></i>" + result['unread_notification'][ii]['date'] + "</small></h4><p style='color:green;'>" + note + "</p></a></li>";



                    }
                    if (list1 == '')
                        list1 = '<li>No Notifications..</li>';

                    list2 = '';
                    for (k = 0; k < result['get_unread_message'].length; k++)
                    {
                        if (result['get_unread_message'][k]['recd'] == 1)
                            color_tr = 'rgb(242, 252, 242)';
                        else
                            color_tr = 'rgb(255, 254, 232)';
                        if (result['get_unread_message'][k]['message'].length > 30)
                            msg = result['get_unread_message'][k]['message'].substring(0, 30) + "...";
                        else
                            msg = result['get_unread_message'][k]['message'];

                        list2 = list2 + "<li style='background-color:" + color_tr + "'  ><a href='" + BASE_URL + 'chat/adminchat' + "'><h4>" + result['get_unread_message'][k]['from'] + "<small><i class='fa fa-clock-o'></i>" + result['get_unread_message'][k]['sent'] + "</small></h4><p>" + msg + "</p></a></li>";
                    }
                    if (list2 == '')
                        list2 = '<li>No Messages..</li>';

                    $('.notification_list').html(list1);
                    $('.unread_list').html(list);
                    $('.message_list').html(list2);
                });
            }, 100000);
            $('.label-success').hide();
            $.getJSON(BASE_URL + 'api/get_notification', function (result) {

                if (result)
                {
                    $('.fa-circle').addClass('text-success');
                    $('#online_status').html('Online');
                } else
                {
                    $('.fa-circle').removeClass('text-success');
                    $('#online_status').html('Offline');
                }
                $('.unread_tickets_count').html(result['unread_tickets_count']);
                $('.notification').html(result['unread_notification_count']);
                $('.msg_count').html(result['get_unread_message_count']);

                if (result['get_unread_message_count'] == 0)
                {
                    $('.label-success').hide();
                    $('.msg_count').html('No');
                } else
                    $('.label-success').show();
                if (result['unread_notification_count'] == 0)
                {
                    $('.notification1').html('No');
                } else
                    $('.notification1').html(result['unread_notification_count']);

                if (result['unread_tickets_count'] == 0)
                {
                    $('.unread_tickets_count1').html('No');
                } else
                    $('.unread_tickets_count1').html(result['unread_tickets_count']);
                list = '';
                for (i = 0; i < result['unread_tickets'].length; i++)
                {
                    if (result['unread_tickets'][i]['read'] == 1 || result['unread_tickets'][i]['read'] == 3)
                        color_tr = 'rgb(242, 252, 242)';
                    else
                        color_tr = 'rgb(255, 254, 232)';
                    if (result['unread_tickets'][i]['status'] == 0)
                        status = 'Open';
                    else
                        status = 'Closed';
                    if (result['unread_tickets'][i]["subject"].length > 30)
                        tickets = result['unread_tickets'][i]["subject"].substring(0, 30) + "...";
                    else
                        tickets = result['unread_tickets'][i]["subject"];

                    list = list + "<li style='background-color:" + color_tr + "' class='unread_class' id=" + result['unread_tickets'][i]["id"] + "><a style='color:#000;font-size: 12px;' href='#'><h3>" + result['unread_tickets'][i]["name1"] + "-" + result['unread_tickets'][i]["department"] + "<small class='pull-right'><i class='fa fa-clock-o'></i>" + result['unread_tickets'][i]["ldt"] + "</small></h3><div style='color:green'>" + tickets + "</div>" + status + "</a></li>";



                }
                if (list == '')
                    list = '<li>No Staff Tickets..</li>';


                list1 = '';
                for (ii = 0; ii < result['unread_notification'].length; ii++)
                {
                    /*list1=list1+"<li><a class='all_notification "+result['unread_notification'][ii]['links']+"' id='"+result['unread_notification'][ii]['update_id']+"' >"+result['unread_notification'][ii]['notification']+result['unread_notification'][ii]['name']+result['unread_notification'][ii]['date']+"</a></li>";*/
                    if (result['unread_notification'][ii]['read'] == 1)
                        color_tr = 'rgb(242, 252, 242)';
                    else
                        color_tr = 'rgb(255, 254, 232)';
                    if (result['unread_notification'][ii]['notification'].length > 30)
                        note = result['unread_notification'][ii]['notification'].substring(0, 30) + "...";
                    else
                        note = result['unread_notification'][ii]['notification'];
                    list1 = list1 + "<li style='background-color:" + color_tr + "' class='staff_notify'><a style='color:#000;font-size: 12px;' class='all_notification " + result['unread_notification'][ii]['links'] + "' id='" + result['unread_notification'][ii]['update_id'] + "' ><h4>" + result['unread_notification'][ii]['name'] + "<small style='float: right'><i class='fa fa-clock-o'></i>" + result['unread_notification'][ii]['date'] + "</small></h4><p style='color:green;'>" + note + "</p></a></li>";



                }
                if (list1 == '')
                    list1 = '<li>No Notifications..</li>';

                list2 = '';
                for (k = 0; k < result['get_unread_message'].length; k++)
                {
                    if (result['get_unread_message'][k]['recd'] == 1)
                        color_tr = 'rgb(242, 252, 242)';
                    else
                        color_tr = 'rgb(255, 254, 232)';
                    if (result['get_unread_message'][k]['message'].length > 30)
                        msg = result['get_unread_message'][k]['message'].substring(0, 30) + "...";
                    else
                        msg = result['get_unread_message'][k]['message'];

                    list2 = list2 + "<li style='background-color:" + color_tr + "'  ><a href='" + BASE_URL + 'chat/adminchat' + "'><h4>" + result['get_unread_message'][k]['from'] + "<small><i class='fa fa-clock-o'></i>" + result['get_unread_message'][k]['sent'] + "</small></h4><p>" + msg + "</p></a></li>";
                }
                if (list2 == '')
                    list2 = '<li>No Messages..</li>';

                $('.notification_list').html(list1);
                $('.unread_list').html(list);
                $('.message_list').html(list2);
            });
            $('.unread_class').live('click', function () {

                $.getJSON(BASE_URL + 'api/change_tickets_status/' + $(this).attr('id'), function (result) {
                    if (result)
                        window.location.href = BASE_URL + result;
                });
            });
            $('.all_notification').live('click', function () {
                class_name = $(this).attr('class').split(" ");
                $.getJSON(BASE_URL + 'api/change_read_status/' + $(this).attr('id'), function () {
                    window.location.href = BASE_URL + class_name[1];
                });
            });
            $(document).ready(function () {
                $('input').attr('autocomplete', 'off');
            });
        </script>

        <script type="text/javascript">

            $("#submit").live("click", function ()
            {
                $('.modal').css("display", "none");
                $('.fade').css("display", "none");


            });
        </script>
        <!--light box-->

        <!--FeedBack-->
        <script type="text/javascript" charset="utf-8">
            $(function () {
                var feedbackTab = {
                    speed: 300,
                    containerWidth: $('.feedback-panel').outerWidth(),
                    containerHeight: $('.feedback-panel').outerHeight(),
                    tabWidth: $('.feedback-tab').outerWidth(),
                    init: function () {
                        $('.feedback-panel').css('height', feedbackTab.containerHeight + 'px');
                        $('a.feedback-tab').click(function (event) {
                            if ($('.feedback-panel').hasClass('open')) {
                                $('.feedback-panel').animate({right: '-' + feedbackTab.containerWidth}, feedbackTab.speed)
                                        .removeClass('open');
                            } else {
                                $('.feedback-panel').animate({right: '0'}, feedbackTab.speed)
                                        .addClass('open');
                            }
                            event.preventDefault();
                        });
                    }
                };
                feedbackTab.init();
                $(".button").click(function () {
                    var email = $("input#email").val();
                    var message = $("textarea#message").val();
                    var response_message = "Thank you for your comment, see ya!"
                    var dataString = 'email=' + email + '&message=' + message;
                    $.ajax({
                        type: "POST",
                        url: "sendmail.php",
                        data: dataString,
                        success: function () {
                            $('#form-wrap').html("<div id='response-message'></div>");
                            $('#response-message').html("<p>" + response_message + "</p>")
                                    .hide()
                                    .fadeIn(500)
                                    .animate({opacity: 1.0}, 1000)
                                    .fadeIn(0, function () {
                                        $('.feedback-panel')
                                                .animate({left: '-' + (feedbackTab.containerWidth + feedbackTab.tabWidth)},
                                                (feedbackTab.speed))
                                                .removeClass('open');
                                    })
                        }
                    });
                    return false;
                });
            });
            $('.date').datetimepicker({
                lang: 'de',
                i18n: {de: {
                        months: [
                            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
                        ],
                        dayOfWeek: ["Su.", "Mo", "Tu", "We", "Th", "Fr", "Sa."]
                    }},
                timepicker: false,
                format: 'd-m-Y'
            });
            $('.date_class').datetimepicker({
                datepicker: false,
                timepicker: true,
                format: 'H:i',
                allowTimes: ['00:15', '00:30', '00:45', '01:00', '01:15', '01:30', '01:45', '02:00', '02:15', '02:30', '02:45', '03:00', '03:15', '03:30', '03:45', '04:00', '04:15', '04:30', '04:45', '04:00', '05:15', '05:30', '05:45', '05:00', '05:15', '05:30', '05:45', '06:00', '06:15', '06:30', '06:45', '07:00', '07:15', '07:30', '07:45', '08:00', '08:15', '08:30', '08:45', '09:00', '09:15', '09:30', '09:45', '10:00', '10:15', '10:30', '10:45', '11:00', '11:15', '11:30', '11:45', '12:00', '12:15', '12:30', '12:45', '13:00', '13:15', '13:30', '13:45', '14:00', '14:15', '14:30', '14:45', '15:00', '15:15', '15:30', '15:45', '16:00', '16:15', '16:30', '16:45', '17:00', '17:15', '17:30', '17:45', '17:00', '18:15', '18:30', '18:45', '19:00', , '19:15', '19:30', '19:45', '20:00', '20:15', '20:30', '20:45', '21:00', '21:15', '21:30', '21:45', '22:00', '22:15', '22:30', '22:45', '23:00'
                ]

            });
        </script>
        <?php
        if ($user_det['staff_type'] == 'admin') {
            ?>
            <div class="support_link"><a href="http://www.f2fsolutions.co.in/" target="_blank" title="Support"><img src="<?= $theme_path; ?>/images/support-1.png"/></a></div>

            <div class="feedback-panel">
                <a class="feedback-tab" href="#">Feedback</a>

                <div id="form-wrap">

                    Send Us Feedback</h3>


                    <p><label class="field-name">Name </label>: <?php echo $user_det['name']; ?></p>
                    <p><label class="field-name">Email ID </label>: <?php echo $user_det['email']; ?></p>
                    <p><label>Feed Back </label><br>

                        <textarea style="width:100%;height:75px; border:0;" id="feedback" ></textarea>
                    </p>
                    <div class="modal-footer" style="padding: 10px 20px 10px;border-color: #fff;">
                        <input type="button" value="Send" class="btn btn-primary" id="send_feed_back" >
                        <input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel_feed_back" value="Cancel">
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <script type="text/javascript">
            $("#send_feed_back").live('click', function ()
            {
                var feedback = $("#feedback").val();

                if (feedback == null || feedback == "" || feedback.length == 0)
                {
                    $("#feedback").css('border', '1px solid red');
                } else
                {
                    for_loading('Loading... Sending Mail...');
                    $.ajax({
                        url: BASE_URL + "admin/send_feedback",
                        type: 'POST',
                        data: {feedback: feedback},
                        success: function (result) {
                            if (result) {
                                alert('Feedback sent Successfully');
                                window.location.reload();
                            }
                        }

                    });
                    $("#feedback").val('');
                }
            });

            $("#cancel_feed_back").live('click', function ()
            {
                $("#feedback").val('');
                $('#feedback').css('border', '1px solid #CCCCCC');
            });
<?php /* ?>onload = function () {
  <?php if($this->uri->segment(2)=='update_student'){}
  else if($this->uri->segment(2)=='update_staff'){}
  else if($this->uri->segment(1)=='subject'){}
  else if($this->uri->segment(2)=='assignment_upload'){}
  else if($this->uri->segment(2)=='admin_view'){}
  else {?>

  $('input[type="text"]').val('');
  $('input[type="file"]').val('');
  $('input[type="checkbox"]').val('');
  $('input[type="radio"]').val('');
  $("select").val('');
  $('textarea').val('');
  <?php } ?>
  }
  <?php */ ?>
        </script>


        <div id="admin_profile_img" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <a class="close1" data-dismiss="modal">×</a>
                        <img src="<?= $this->config->item('base_url') . 'profile_image/admin/original/' . $data['admin'][0]['image']; ?>" alt="User Image"  width="50%"/>

                    </div>
                </div>
            </div>
        </div>
</body>
</html>
<!--href='"+BASE_URL+'staff_tickets'+"'
<img src='<?= $theme_path; ?>/img/avatar3.png' class='img-circle' alt='User Image'/>
-->

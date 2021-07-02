<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<!-- fullCalendar -->
<link href="<?= $theme_path; ?>/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="<?= $theme_path; ?>/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- animation -->
<link href="<?= $theme_path; ?>/css/animate.delay.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/ionicons.css" rel="stylesheet" type="text/css" />
<?php
$this->load->model('master/master_model');
$user_det = $this->session->userdata('logged_in');
$permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
?>
<link href="<?= $theme_path; ?>/css/jsCarousel-2.0.0.css" rel="stylesheet" type="text/css" />
<script src="<?= $theme_path; ?>/js/plugins/slider/jsCarousel-2.0.0.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#carouselhAuto').jsCarousel({onthumbnailclick: function (src) {
                alert(src);
            }, autoscroll: true, masked: true, itemstodisplay: 3, orientation: 'h'});

    });

</script>

<!--<div>
<ul class="widgeticons row">
<?php if ($user_det['staff_type'] == 'admin') { ?>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'admin/manage_admin' ?>"><img src="<?= $theme_path; ?>/img/gemicon/admin.png" alt="" /><span>Admin</span></a></li>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'batch' ?>"><img src="<?= $theme_path; ?>/img/gemicon/batch.png" alt="" /><span>Batch</span></a></li>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'designation' ?>"><img src="<?= $theme_path; ?>/img/gemicon/design.png" alt="" /><span>Designation</span></a></li>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'semester' ?>"><img src="<?= $theme_path; ?>/img/gemicon/semester.png" alt="" /><span>Semester</span></a></li>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'department' ?>"><img src="<?= $theme_path; ?>/img/gemicon/dept.png" alt="" /><span>Class</span></a></li>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'group' ?>"><img src="<?= $theme_path; ?>/img/gemicon/group.png" alt="" /><span>Section</span></a></li>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'master' ?>"><img src="<?= $theme_path; ?>/img/gemicon/master.png" alt=""/><span>Master Right</span></a></li>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'staff' ?>"><img src="<?= $theme_path; ?>/img/gemicon/staff.png" alt="" /><span>Staff</span></a></li>
<?php } ?>
<?php if ($permission[0]['add_student'] == 1) { ?>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'student' ?>"><img src="<?= $theme_path; ?>/img/gemicon/student.png" alt="" /><span>Student</span></a></li>
<?php } ?>
<li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'subject' ?>"><img src="<?= $theme_path; ?>/img/gemicon/subject.png" alt="" /><span>Subject</span></a></li>
<?php if ($permission[0]['attendance'] == 1) { ?>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'attendence' ?>"><img src="<?= $theme_path; ?>/img/gemicon/attendence.png" alt=""/><span>Attendance</span></a></li>
<?php } if ($permission[0]['chat'] == 1) { ?>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'chat' ?>"><img src="<?= $theme_path; ?>/img/gemicon/chat.png" alt="" /><span>Chat</span></a></li>
<?php } if ($permission[0]['time_table'] == 1) { ?>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'time_table' ?>"><img src="<?= $theme_path; ?>/img/gemicon/time_table.png" alt="" /><span>Time Table</span></a></li>
<?php } if ($permission[0]['assignment'] == 1) { ?>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'assignment/staff_view' ?>"><img src="<?= $theme_path; ?>/img/gemicon/assign.png" alt="" /><span>Projects</span></a></li>
<?php } if ($permission[0]['internal_mark'] == 1) { ?>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'internal/internal_exam' ?>"><img src="<?= $theme_path; ?>/img/gemicon/internal.png" alt="" /><span>Internal Marks</span></a></li>
<?php } if ($permission[0]['sharing_note'] == 1) { ?>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'notes' ?>"><img src="<?= $theme_path; ?>/img/gemicon/share.png" alt="" /><span>Share Notes</span></a></li>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'events' ?>"><img src="<?= $theme_path; ?>/img/gemicon/events.png" alt="" /><span>Events</span></a></li>
<?php } ?>
<?php if ($user_det['staff_type'] == 'admin') { ?>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'staff_tickets/admin_view' ?>"><img src="<?= $theme_path; ?>/img/gemicon/tickets.png" alt="" /><span>Tickets</span></a></li>
<?php } else { ?>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'staff_tickets/' ?>"><img src="<?= $theme_path; ?>/img/gemicon/tickets.png" alt="" /><span>Tickets</span></a></li>
<?php } ?>
<?php if ($permission[0]['fee_details'] == 1) { ?>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'fees/report' ?>" ><img src="<?= $theme_path; ?>/img/gemicon/fees.png" alt="" /><span>Billing</span></a></li>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'hostel/hostel_report' ?>"><img src="<?= $theme_path; ?>/img/gemicon/hostel.png" alt="" /><span>Hostel</span></a></li>
<?php } ?>
<?php if ($permission[0]['transport'] == 1) { ?>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'transport/' ?>" ><img src="<?= $theme_path; ?>/img/gemicon/transport.png" alt="" /><span>Transport</span></a></li>
<?php } ?>
<li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'placement/placement_list' ?>" ><img src="<?= $theme_path; ?>/img/gemicon/placement.png" alt="" /><span>Placement</span></a></li>
<?php if ($permission[0]['library'] == 1) { ?>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'library/manage_books' ?>" ><img src="<?= $theme_path; ?>/img/gemicon/library.png" alt="" /><span>Library</span></a></li>
<?php } ?>
<?php if ($user_det['staff_type'] == 'admin') { ?>
                    <li class="one_fifth"><a href="<?= $this->config->item('base_url'), 'socialnetwork/admin' ?>" target="_blank"><img src="<?= $theme_path; ?>/img/gemicon/social.png" alt="" /><span><b style="text-transform:lowercase">i</b> - Network</span></a></li>
<?php } ?>
</ul>
</div>-->
<!--<div class="row">
 <div class="col-md-3">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">

      <div class="visual">
       <i class="ion-android-friends"></i>
       </div>
       <div class="details">
         <div class="number">
            <span data-counter="counterup" data-value="1349">1349</span>
         </div>
           <div class="desc"> New Feedbacks </div>
               </div>
     </a>
 </div>
    <div class="col-md-3">
     <a class="dashboard-stat dashboard-stat-v2 red" href="#">
      <div class="visual">
       <i class="ion-ios7-star"></i>
       </div>
       <div class="details">
         <div class="number">
            <span data-counter="counterup" data-value="1349">12,5</span>M$
         </div>
           <div class="desc">  Total Profit  </div>
               </div>
     </a>
     </div>

    <div class="col-md-3">
     <a class="dashboard-stat dashboard-stat-v2 green1" href="#">
      <div class="visual">
       <i class="ion-android-social-user"></i>
       </div>
       <div class="details">
         <div class="number">
            <span data-counter="counterup" data-value="1349">549</span>
         </div>
           <div class="desc">   New Students   </div>
               </div>
     </a>
     </div>

    <div class="col-md-3">
      <a class="dashboard-stat dashboard-stat-v2 brown" href="#">
      <div class="visual">
       <i class="ion-more"></i>
       </div>
       <div class="details">
         <div class="number">
           + <span data-counter="counterup" data-value="1349">89</span>%
         </div>
           <div class="desc">   School Popularity   </div>
               </div>
     </a>
     </div>
    </div>-->

<div class="row">
	<div class="col-md-2">
    	<div class="info-box bg-b-orange">
            <div class="info-box-icon push-bottom"><i class="ion-android-social-user"></i></div>
            <div class="info-box-content">
              <span class="info-box-text">Student</span>
            </div>
          </div>
    </div>
    <div class="col-md-2">
    	<div class="info-box bg-b-cyan">
            <div class="info-box-icon push-bottom"><i class="ion-android-social-user"></i></div>
            <div class="info-box-content">
              <span class="info-box-text">Student</span>
            </div>
          </div>
    </div>
    <div class="col-md-2">
    	<div class="info-box bg-b-danger">
            <div class="info-box-icon push-bottom"><i class="ion-android-social-user"></i></div>
            <div class="info-box-content">
              <span class="info-box-text">Student</span>
            </div>
          </div>
    </div>
    <div class="col-md-2">
    	<div class="info-box bg-b-purple">
            <div class="info-box-icon push-bottom"><i class="ion-android-social-user"></i></div>
            <div class="info-box-content">
              <span class="info-box-text">Student</span>
            </div>
          </div>
    </div>
    <div class="col-md-2">
    	<div class="info-box bg-b-black">
            <div class="info-box-icon push-bottom"><i class="ion-android-social-user"></i></div>
            <div class="info-box-content">
              <span class="info-box-text">Student</span>
            </div>
          </div>
    </div>
    <div class="col-md-2">
    	<div class="info-box bg-b-blue">
            <div class="info-box-icon push-bottom"><i class="ion-android-social-user"></i></div>
            <div class="info-box-content">
              <span class="info-box-text">Student</span>
            </div>
          </div>
    </div>
</div>    

<div class="row" style="display:none;">
    <!--<div class="vspace-12-sm"></div>
    -->
    <div class="col-md-4">
        <div class="widget-box widget-bor">
            <div class="widget-header widget-header-flat widget-header-small ml-10">
                <h5 class="widget-title box-title2">
                    <i class="ion-android-inbox"></i>
                    Class
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            This Year
                            <i class="ion-images bigger-110"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div id="piechart-placeholder" style="width: 90%; min-height: 150px; padding: 0px; position: relative;"><canvas class="flot-base" width="384" height="150" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 384px; height: 150px;"></canvas><canvas class="flot-overlay" width="384" height="150" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 384px; height: 150px;"></canvas><div class="legend"><div style="position: absolute; width: 90px; height: 110px; top: 15px; right: -30px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:15px;right:-30px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #68BC31;overflow:hidden"></div></div></td><td class="legendLabel">Electrical Comm Engg</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #2091CF;overflow:hidden"></div></div></td><td class="legendLabel">Computer Science Engg</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #AF4E96;overflow:hidden"></div></div></td><td class="legendLabel">Information Technology</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #DA5430;overflow:hidden"></div></div></td><td class="legendLabel">Civil Engg</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #FEE074;overflow:hidden"></div></div></td><td class="legendLabel">other</td></tr></tbody></table></div></div>

                    <div class="hr hr8 hr-double"></div>
                    <div class="clearfix">
                    </div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div><!-- /.widget-box -->
    </div><!-- /.col -->
    <div class="col-md-4">
        <div class="widget-box widget-bor">
            <div class="widget-header widget-header-flat widget-header-small ml-10">
                <h5 class="widget-title box-title2">
                    <i class="fa fa-user"></i>
                    Total Students
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            This Year
                            <i class="ion-images bigger-110"></i>
                        </button>

                    </div>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div id="piechart-placeholder" style="width: 90%; min-height: 150px; padding: 0px; position: relative;"><canvas class="flot-base" width="384" height="150" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 384px; height: 150px;"></canvas><canvas class="flot-overlay" width="384" height="150" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 384px; height: 150px;"></canvas><div class="legend"><div style="position: absolute; width: 90px; height: 110px; top: 15px; right: -30px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:15px;right:-30px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #68BC31;overflow:hidden"></div></div></td><td class="legendLabel">ECE-150</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #2091CF;overflow:hidden"></div></div></td><td class="legendLabel">CS-140</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #AF4E96;overflow:hidden"></div></div></td><td class="legendLabel">IT-120</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #DA5430;overflow:hidden"></div></div></td><td class="legendLabel">CIVIL-135</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #FEE074;overflow:hidden"></div></div></td><td class="legendLabel">OTHER-90</td></tr></tbody></table></div></div>

                    <div class="hr hr8 hr-double"></div>

                    <div class="clearfix">


                    </div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div><!-- /.widget-box -->
    </div>
    <div class="col-md-4">
        <div class="widget-box widget-bor">
            <div class="widget-header widget-header-flat widget-header-small ml-10">
                <h5 class="widget-title box-title2">
                    <i class="ion-ios7-calendar"></i>
                    Attendance
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            This Year
                            <i class="ion-images bigger-110"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div id="piechart-placeholder" style="width: 90%; min-height: 150px; padding: 0px; position: relative;"><canvas class="flot-base" width="384" height="150" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 384px; height: 150px;"></canvas><canvas class="flot-overlay" width="384" height="150" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 384px; height: 150px;"></canvas><div class="legend"><div style="position: absolute; width: 90px; height: 110px; top: 15px; right: -30px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:15px;right:-30px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #68BC31;overflow:hidden"></div></div></td><td class="legendLabel">ECE-90%</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #2091CF;overflow:hidden"></div></div></td><td class="legendLabel">CS-80%</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #AF4E96;overflow:hidden"></div></div></td><td class="legendLabel">IT-95%</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #DA5430;overflow:hidden"></div></div></td><td class="legendLabel">CIVIL-93%</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #FEE074;overflow:hidden"></div></div></td><td class="legendLabel">OTHER-75%</td></tr></tbody></table></div></div>

                    <div class="hr hr8 hr-double"></div>

                    <div class="clearfix">





                    </div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div><!-- /.widget-box -->
    </div>

</div>
<?php
$bg_color = array('bg-aqua', 'bg-green', 'bg-yellow', 'bg-red', 'bg-blue', 'bg-purple', 'bg-teal', 'bg-maroon', 'bg-gray', 'bg-yellow', 'bg-lgreen', 'bg-dred', 'bg-dblue');
$icon = array('ion-person-stalker', 'ion-person-stalker', 'ion-person-stalker', 'ion-person-stalker', 'ion-person-stalker', 'ion-person-stalker', 'ion-person-stalker', 'ion-person-stalker', 'ion-person-stalker', 'ion-person-stalker', 'ion-person-stalker', 'ion-person-stalker', 'ion-person-stalker');
?>
<div class="">

    <!--<?php
    if (isset($all_department) && !empty($all_department)) {
        echo "<div id='carouselhAuto' style='cursor:default;'>";
        $i = 0;

        foreach ($all_department as $val) {
            if ($val['no_student'] > 0) {
                ?>
                                                                            <div>
                                                                                <div class="small-box <?= $bg_color[$i] ?>" style='cursor:default;'>
                                                                                    <div class="inner">
                                                                                        <h3>
                <?= $val['no_student'] ?><sup style="font-size: 15px">Students</sup>
                                                                                        </h3>
                                                                                        <p>
                <?= $val['department'] ?>
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="icon">
                                                                                        <i class="ion <?= $icon[$i] ?>"></i>
                                                                                    </div>
                                                                                    <a class="small-box-footer">
                                                                                      &nbsp;
                                                                                    </a>
                                                                                </div>
                                                                             </div>
                <?php
                $i++;
            }
        }
        echo "</div>";
    }
    ?>-->
    
    <div class="row">

        <section class="col-lg-6">
            <div class="box box-warning">
                <div class="box-header">
                    <i class="fa fa-calendar"></i>
                    <div class="box-title">Calendar</div>

                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <!-- button with a dropdown -->
                    </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <!--The calendar -->
                    <div id="calendar"></div>
                </div><!-- /.box-body -->
            </div>
        </section>
        <section class="col-lg-6">
            <div class="box box-danger"><div class="box-header"><i class="ion ion-clipboard"></i><h3 class="box-title">Recent Activity</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <ul class="todo-list">
                        <?php
                        $i = 0;
                        if (isset($all_notification) && !empty($all_notification)) {

                            foreach ($all_notification as $val) {
                                if (isset($val['links']) && !empty($val['links'])) {
                                    $i++;
                                    ?>
                                    <li class="li_<?= $val['id'] ?>">
                                        <span class="handle">
                                            <i class="fa fa-ellipsis-v"></i>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                        <span class="text">
                                            <a href="<?= $this->config->item('base_url') . $val['links'] ?>"><?= $val['notification'] ?></a>
                                        </span>
                                        <small class="label label-danger" style="float:right;"><i class="fa fa-clock-o"></i><?= date('d-M-Y', strtotime($val['date'])) ?></small>
                                        <div class="tools">
                                            <i class="fa fa-trash-o delete_note" title="Delete" id='<?= $val['id'] ?>'></i>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                        }
                        if ($i == 0)
                            echo "No Recent Activity..";
                        ?>
                    </ul>
                </div><!-- /.box-body -->
            </div>
        </section>
    </div>

    <script src="<?= $theme_path; ?>/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(function () {
        if (jQuery('.widgeticons').length > 0) {
            jQuery('.widgeticons a').hover(function () {
                jQuery(this).find('img').addClass('animate0 bounceIn');
            }, function () {
                jQuery(this).find('img').removeClass('animate0 bounceIn');
            });
        }
    });
    $('.delete_note').live('click', function () {
        list = $('.li_' + $(this).attr('id'));
        $.ajax({
            url: BASE_URL + "admin/update_notification",
            type: 'post',
            data: {
                note_id: $(this).attr('id')

            },
            success: function (result) {
                list.fadeOut();
            }

        });
    });
    </script>
    <script type="text/javascript">
        $(function () {

            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function () {

                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    };

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject);

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    });

                });
            }
            ini_events($('#external-events div.external-event'));

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date();
            var d = date.getDate(),
                    m = date.getMonth(),
                    y = date.getFullYear();
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {//This is to add icons to the visible buttons
                    prev: "<span class='fa fa-caret-left'></span>",
                    next: "<span class='fa fa-caret-right'></span>",
                    today: 'today',
                    month: 'month',
                    week: 'week',
                    day: 'day'
                },
                //Random default events
<?= $list; ?>,
                        editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    copiedEventObject.backgroundColor = $(this).css("background-color");
                    copiedEventObject.borderColor = $(this).css("border-color");

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }

                }
            });

            /* ADDING EVENTS */
            var currColor = "#f56954"; //Red by default
            //Color chooser button
            var colorChooser = $("#color-chooser-btn");
            $("#color-chooser > li > a").click(function (e) {
                e.preventDefault();
                //Save color
                currColor = $(this).css("color");
                //Add color effect to button
                colorChooser
                        .css({"background-color": currColor, "border-color": currColor})
                        .html($(this).text() + ' <span class="caret"></span>');
            });
            $("#add-new-event").click(function (e) {
                e.preventDefault();
                //Get value and make sure it is not null
                var val = $("#new-event").val();
                if (val.length == 0) {
                    return;
                }

                //Create event
                var event = $("<div />");
                event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
                event.html(val);
                $('#external-events').prepend(event);

                //Add draggable funtionality
                ini_events(event);

                //Remove event from text input
                $("#new-event").val("");
            });
        });
    </script>

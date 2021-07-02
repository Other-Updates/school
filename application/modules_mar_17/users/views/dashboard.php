<?php
$this->db->select('details');
$this->db->from('mas_college_det');
$this->db->where('typ_e', 'total_hours');
$query['tot_hou'] = $this->db->get()->result_array();
$total_cls_hrs = $query['tot_hou'][0]['details'];
if (isset($all_info[0]['time']) && !empty($all_info[0]['time'])) {
    $title = explode(",", $all_info[0]['time']);
}
$this->load->model('time_table/time_table_model');
$total_hours = $this->time_table_model->get_values_by_type('total_hours');
$total_days = $this->time_table_model->get_values_by_type('total_day_order');
$theme_path = $this->config->item('theme_locations') . $this->config->item('active_template');
?>

<div class="message-container">
    <div class="message-form-content">
        <div class="message-form-header">
            <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/attendence.png"></div>
            Attendance
        </div>
        <div class="message-form-inner attendance_table">
            <table class="my_table_style">
                <thead>
                    <tr>
                        <th width="3%" rowspan="2">#</th>
                        <th width="13%" rowspan="2" >Semester</th>
                        <th width="6%" rowspan="2" >(%)</th>
                        <th colspan="4" >No&nbsp;Of&nbsp;Days</th>
                        <th width="16%" rowspan="2" >Total&nbsp;OD&nbsp;(Hours)</th>
                        <th width="17%" rowspan="2" >Total&nbsp;ML&nbsp;(Hours)</th>
                    </tr>
                    <tr>
                        <th width="10%" >Total Worked Hours</th>
                        <th width="11%" >Total Present Hours</th>
                        <th width="12%" >Total Absent Hours</th>
                        <th width="12%" >Total Worded Days</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if (isset($day_list) && !empty($day_list)) {
                        foreach ($day_list as $vsl) {
                            $tot_hr_st = 0;
                            $std_pr = 0;

                            $this->db->select("COUNT(attendance_staff_det.id) AS hour_count");
                            //$this->db->where('attendance_stud_deta.std_id',$stud_det[0]['id']);
                            $this->db->where('attendance.semester_id', $vsl['semester_id']);
                            $this->db->join('attendance', 'attendance.id = attendance_staff_det.attend_id');
                            $qer = $this->db->get('attendance_staff_det')->result_array();
                            //echo $this->db->last_query();
                            $tot_hrs = $qer[0]['hour_count'];


                            $tot_od_ml_hrs = 0;
                            $this->db->select("COUNT(attendance_stud_deta.id) AS hour_countl");
                            $this->db->where('attendance_stud_deta.std_id', $stud_det[0]['id']);
                            $this->db->where('attendance_stud_deta.atten_mode', 'od');
                            $this->db->where('attendance.semester_id', $vsl['semester_id']);
                            $this->db->join('attendance', 'attendance.id = attendance_stud_deta.attend_id');
                            $qer = $this->db->get('attendance_stud_deta')->result_array();

                            if (isset($qer[0]['hour_countl']) && !empty($qer[0]['hour_countl'])) {
                                $tot_od_ml_hrs = $qer[0]['hour_countl'];
                            } else {
                                $tot_od_ml_hrs = 0;
                            }


                            $tot_od_ml_hrs_ml = 0;
                            $this->db->select("COUNT(attendance_stud_deta.id) AS hour_count2");
                            $this->db->where('attendance_stud_deta.std_id', $stud_det[0]['id']);
                            $this->db->where('attendance_stud_deta.atten_mode', 'ml');
                            $this->db->where('attendance.semester_id', $vsl['semester_id']);
                            $this->db->join('attendance', 'attendance.id = attendance_stud_deta.attend_id');
                            $qer = $this->db->get('attendance_stud_deta')->result_array();

                            if (isset($qer[0]['hour_count2']) && !empty($qer[0]['hour_count2'])) {
                                $tot_od_ml_hrs_ml = $qer[0]['hour_count2'];
                            } else {
                                $tot_od_ml_hrs_ml = 0;
                            }


                            $this->db->select("COUNT(attendance_stud_deta.id) AS hour_count");
                            $this->db->where('attendance_stud_deta.std_id', $stud_det[0]['id']);
                            $this->db->where('attendance_stud_deta.atten_mode', 'p');
                            $this->db->where('attendance.semester_id', $vsl['semester_id']);
                            $this->db->join('attendance', 'attendance.id = attendance_stud_deta.attend_id');
                            $qer = $this->db->get('attendance_stud_deta')->result_array();

                            $tot_hr_st = $qer[0]['hour_count'];
                            /* echo $tot_hr_st;
                              exit; */
                            $tot_hr_st1 = $tot_hr_st + $tot_od_ml_hrs;
                            $per_tmp = $tot_hr_st1 * 100;
                            $std_pr = $per_tmp / $tot_hrs;  // calculationg persentage
                            $absen_tmp_hr = $tot_hrs - $tot_hr_st;
                            $absen_hr = ($absen_tmp_hr > 0) ? $absen_tmp_hr : '--';
                            $total_od_ml_hrs = $tot_od_ml_hrs_ml + $tot_od_ml_hrs;
                            $tot_abs_hrs1 = $tot_hrs - $tot_hr_st;
                            $tot_abs_hrs = $tot_abs_hrs1 - $total_od_ml_hrs;
                            ?>
                            <tr class="row0">
                                <td align="center"><?= $i ?></td>
                                <td><?= $vsl['semester'] ?></td>
                                <td align="right"><?php echo round($std_pr, 2); ?></td>
                                <td align="right"><?php echo round($tot_hrs, 2); ?></td>
                                <td align="right"><?php echo round($tot_hr_st, 2); ?></td>
                                <td align="right"><?php echo round($tot_abs_hrs, 2); ?></td>
                                <td align="right"><?php echo round($tot_hrs / $total_cls_hrs, 2); ?></td>
                                <td align="right"><?php echo $tot_od_ml_hrs; ?></td>
                                <td align="right"><?php echo $tot_od_ml_hrs_ml; ?></td>
                            </tr>
        <?php
        $i++;
    }
} else
    echo "<tr><td colspan='9'>Attendance Not Created Yet...</td></tr>";
?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="message-container">
    <div class="message-form-content">
        <div class="message-form-header">
            <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/notice_board.png"></div>
            Notice Board
        </div>
        <div class="message-form-inner">
            <div class="my_notice">


                <?php
                $student = $this->session->userdata('user_info');
                if (isset($notice) && !empty($notice)) {
                    foreach ($notice as $val) {
                        if ($val['notice_type'] == 1) {
                            if ($val['depart_id'] == $student[0]['depart_id']) {
                                if ($val['group_id'] != 0) {
                                    if ($val['group_id'] == $student[0]['group_id']) {
                                        ?>
                                        <div class="notice">
                                            <div class="dept_date">
                                                <div class="message">
                                                    <div  class="message-avatar1"  style="cursor: context-menu;"></div>
                                                    <?php
                                                    if ($val['staff_type'] == 'staff') {
                                                        ?>
                                                        <img src="<?= $this->config->item('base_url') . 'profile_image/staff/orginal/' . $val['staff'][0]['image']; ?>" class="img-circle" alt="User Image" />
                        <?php } else { ?>
                                                        <img src="<?= $this->config->item('base_url') . 'profile_image/admin/original/' . $val['staff'][0]['image']; ?>" class="img-circle" alt="User Image" />
                        <?php } ?>
                                                    </a>
                                                    <div class="message-content1">
                                                        <div class="text">
                                                            <div class="posted_by">
                                                                Posted by
                                                                <span><?php echo ucfirst($val['staff'][0]['name']); ?></span>
                                                                <span style="color:green;font-size: 10px;" class="fright">Posted Date <i class="fa fa-clock-o"></i> <?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></span>
                                                            </div>
                                                            <p>
                                                            <table style="border:0">
                                                                <tr>
                                                                    <td style="border:0" width="1"><?php
                                                                        if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                                                                            $temp = explode(".", $val['notice_file']);
                                                                            $ext = end($temp);
                                                                            $txt = 'txt';
                                                                            $docx = 'docx';
                                                                            $pdf = 'pdf';
                                                                            $zip = 'zip';
                                                                            $rar = 'rar';
                                                                            $image = 'jpg';
                                                                            $image1 = 'jpeg';
                                                                            $image2 = 'bmp';
                                                                            $doc = 'doc';
                                                                            $image3 = 'png';
                                                                            $image4 = 'xps';
                                                                            ?>
                                                                            <?php
                                                                            if ($ext == $txt) {
                                                                                ?>
                                                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                    <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                                                                            <?php
                                                                            } else if ($ext == $doc) {
                                                                                ?>
                                                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                                                                            <?php
                                                                            } else if ($ext == $pdf) {
                                                                                ?>
                                                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                    <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                                                                            <?php } else if ($ext == $zip) {
                                                                                ?>
                                                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                    <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                            <?php } else if ($ext == $rar) {
                                ?>
                                                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                    <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                                                                            <?php
                                                                            } else if ($ext == $image) {
                                                                                ?>
                                                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                    <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                                                          /> </a>

                                                                            <?php
                                                                            } else if ($ext == $image1) {
                                                                                ?>
                                                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                                                         /></a>

                                                                            <?php
                                                                            } else if ($ext == $image2) {
                                                                                ?>
                                                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                                                         /></a>

                                                                            <?php
                                                                            } else if ($ext == $image3) {
                                                                                ?>
                                                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                                                         /></a>

                            <?php
                            } else if ($ext == $docx) {
                                ?>
                                                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                            <?php
                            } else if ($ext == $image2) {
                                ?>
                                                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                    <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                                                                        <?php } else {
                                                                            ?>
                                                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                                                                        <?php } ?>
                                                                    <?php } ?></td>
                                                                    <td style="border:0"><?php echo ucfirst($val['notice']); ?></td>
                                                                </tr>
                                                            </table>
                                                            </p>

                                                            <p class="from">To Department <span class="green"><?php
                                            if (isset($val['department'][0])) {

                                                echo $val['department'][0]['department'] . "-" . $val['group'][0]['group'];
                                            } else {
                                                echo "For All";
                                            }
                                                                    ?></span> <span class="fright" style="color:red;">End Date <i class="fa fa-clock-o"></i> <?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                    <div class="notice">
                                        <div class="dept_date">
                                            <div class="message">
                                                <div class="message-avatar1"  style="cursor: context-menu;"></div>
                    <?php
                    if ($val['staff_type'] == 'staff') {
                        ?>
                                                    <img src="<?= $this->config->item('base_url') . 'profile_image/staff/orginal/' . $val['staff'][0]['image']; ?>" class="img-circle" alt="User Image" />
                    <?php } else { ?>
                                                    <img src="<?= $this->config->item('base_url') . 'profile_image/admin/original/' . $val['staff'][0]['image']; ?>" class="img-circle" alt="User Image" />
                                                                    <?php } ?>
                                                </a>
                                                <div class="message-content1">
                                                    <div class="text">
                                                        <div class="posted_by">Posted by <span><?php echo ucfirst($val['staff'][0]['name']); ?></span>
                                                            <span style="color:green;font-size: 10px;" class="fright"><i class="fa fa-clock-o"></i> <?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></span></div>
                                                        <p>
                                                        <table style="border:0">
                                                            <tr>
                                                                <td style="border:0" width="1"><?php
                                                                    if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                                                                        $temp = explode(".", $val['notice_file']);
                                                                        $ext = end($temp);
                                                                        $txt = 'txt';
                                                                        $docx = 'docx';
                                                                        $pdf = 'pdf';
                                                                        $zip = 'zip';
                                                                        $rar = 'rar';
                                                                        $image = 'jpg';
                                                                        $image1 = 'jpeg';
                                                                        $image2 = 'bmp';
                                                                        $doc = 'doc';
                                                                        $image3 = 'png';
                                                                        $image4 = 'xps';
                                                                        ?>
                                                                        <?php
                                                                        if ($ext == $txt) {
                                                                            ?>
                                                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                        <?php
                        } else if ($ext == $doc) {
                            ?>
                                                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                                                                        <?php
                                                                        } else if ($ext == $pdf) {
                                                                            ?>
                                                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                                                                        <?php } else if ($ext == $zip) {
                                                                            ?>
                                                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                        <?php } else if ($ext == $rar) {
                            ?>
                                                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                                                                        <?php
                                                                        } else if ($ext == $image) {
                                                                            ?>
                                                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                                                      /> </a>

                                                                        <?php
                                                                        } else if ($ext == $image1) {
                                                                            ?>
                                                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                                                     /></a>

                                                                        <?php
                                                                        } else if ($ext == $image2) {
                                                                            ?>
                                                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                                                     /></a>

                        <?php
                        } else if ($ext == $image3) {
                            ?>
                                                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                                                     /></a>

                        <?php
                        } else if ($ext == $docx) {
                            ?>
                                                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                                                                <?php
                                                                } else if ($ext == $image2) {
                                                                    ?>
                                                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                                                                <?php } else {
                                                                    ?>
                                                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                                <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                                                                <?php } ?>
                                                            <?php } ?></td>
                                                                <td style="border:0"><?php echo ucfirst($val['notice']); ?></td>
                                                            </tr>
                                                        </table>
                                                        </p>
                                                    </div>
                                                    <p class="from">To Department <span class="green"><?php
                                    if (isset($val['department'][0])) {

                                        echo $val['department'][0]['department'] . "-";
                                        if (isset($val['group'][0])) {
                                            echo $val['group'][0]['group'];
                                        }
                                    } else {
                                        echo "For All";
                                    }
                                    ?></span> <span class="fright"><i class="fa fa-clock-o"></i> <?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                    <?php
                                                }
                                            }
                                        } else if ($val['notice_type'] == 0) {
                                            if ($val['view_type'] == 0 || $val['view_type'] == 1 || $val['view_type'] == 3) {
                                                ?>
                                <div class="notice">
                                    <div class="dept_date">
                                        <div class="message">
                                            <a class="message-avatar1" href="#" style="cursor: context-menu;">
                <?php
                if ($val['staff_type'] == 'staff') {
                    ?>
                                                    <img src="<?= $this->config->item('base_url') . 'profile_image/staff/orginal/' . $val['staff'][0]['image']; ?>" class="img-circle" alt="User Image" />
                                                                <?php } else { ?>
                                                    <img src="<?= $this->config->item('base_url') . 'profile_image/admin/original/' . $val['staff'][0]['image']; ?>" class="img-circle" alt="User Image" />
                                                                <?php } ?>
                                            </a>
                                            <div class="message-content1">
                                                <div class="text">
                                                    <div class="posted_by">Posted by <span><?php echo ucfirst($val['staff'][0]['name']); ?></span>
                                                        <span style="color:green;font-size: 10px;" class="fright">Posted Date <i class="fa fa-clock-o"></i> <?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></span></div>
                                                    <p>
                                                    <table style="border:0">
                                                        <tr>
                                                            <td style="border:0" width="1"><?php
                                                                if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                                                                    $temp = explode(".", $val['notice_file']);
                                                                    $ext = end($temp);
                                                                    $txt = 'txt';
                                                                    $docx = 'docx';
                                                                    $pdf = 'pdf';
                                                                    $zip = 'zip';
                                                                    $rar = 'rar';
                                                                    $image = 'jpg';
                                                                    $image1 = 'jpeg';
                                                                    $image2 = 'bmp';
                                                                    $doc = 'doc';
                                                                    $image3 = 'png';
                                                                    $image4 = 'xps';
                                                                    ?>
                                                                    <?php
                                                                    if ($ext == $txt) {
                                                                        ?>
                                                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                            <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                                                                    <?php
                                                                    } else if ($ext == $doc) {
                                                                        ?>
                                                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                            <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                    <?php
                    } else if ($ext == $pdf) {
                        ?>
                                                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                            <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                    <?php } else if ($ext == $zip) {
                        ?>
                                                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                            <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                                                                    <?php } else if ($ext == $rar) {
                                                                        ?>
                                                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                            <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                    <?php
                    } else if ($ext == $image) {
                        ?>
                                                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                            <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                                                  /> </a>

                    <?php
                    } else if ($ext == $image1) {
                        ?>
                                                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                            <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                                                 /></a>

                    <?php
                    } else if ($ext == $image2) {
                        ?>
                                                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                            <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                                                 /></a>

                                                                        <?php
                                                                        } else if ($ext == $image3) {
                                                                            ?>
                                                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                            <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                                                 /></a>

                                                                <?php
                                                                } else if ($ext == $docx) {
                                                                    ?>
                                                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                            <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                                                                <?php
                                                                } else if ($ext == $image2) {
                                                                    ?>
                                                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                            <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                    <?php } else {
                        ?>
                                                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                                            <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                                    <?php } ?>
                                <?php } ?></td>
                                                            <td style="border:0"><?php echo ucfirst($val['notice']); ?></td>
                                                        </tr>
                                                    </table>
                                                    </p>

                                                    <p class="from">To Department <span class="green"><?php
                if (isset($val['department'][0])) {

                    echo $val['department'][0]['department'] . "-" . $val['group'][0]['group'];
                } else {
                    echo "For All";
                }
                ?></span> <span class="fright" style="color:red;">End Date <i class="fa fa-clock-o"></i> <?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <?php
            }
        }
    }
} else {
    echo "<table><tr><td>No Recent Notice</td></tr></table>";
}
?>
            </div>
        </div>
    </div>
</div>

<div class="message-container">
    <!--<div class="message-form-content">
            <div class="message-form-header">
                    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/internal_mark.png"></div>
                    University Result
            </div>
            <div class="message-form-inner">
        <div>
            <table style="display:none;" class="table demo table-bordered my_table_style" data-filter="#filter" data-page-size="5" data-page-previous-text="prev" data-page-next-text="next">
                            <thead>
                            <tr>
                                    <th data-toggle="true">#</th>
                                    <th>Semester</th>
                                    <th>Obtained</th>
                                    <th data-hide="phone">Total</th>
                                    <th data-hide="phone">Semester(%)</th>
                            </tr>
                            </thead>
                            <tbody>
    <?php
    if (isset($sem_info) && !empty($sem_info)) {
        $i = 1;
        foreach ($sem_info as $val) {
            $get_mark = array();
            $total_mark = array();
            $percentage = array();
            ?>
                                <tr>
                                      <td align="center"><?= $i ?></td>
                                      <td><?= $val['semester'] ?></td>
                                      <td align="right"><?= $get_mark[] = round($val['sem_type'], 2) ?></td>
                                      <td align="right"><?= $total_mark[] = $val['subject_count'] * 100 ?></td>
                                      <td align="right"><?= $percentage[] = round($val['sem_type'] / ($val['subject_count']), 2) ?></td>
                                </tr>
            <?php
            $i++;
        }
        ?>

                                </tbody>
                                <tfoot>
                                <tr class="grandtotal">
                                  <td>&nbsp;</td>
                                  <td align="right">Over All</td>
                                  <td align="right"><?= array_sum($get_mark) ?></td>
                                  <td align="right"><?= array_sum($total_mark) ?></td>
                                  <td align="right"><?= array_sum($percentage) ?></td>
                                </tr>
                                </tfoot>
    <?php
} else
    echo "<tr><td colspan='5'>Waiting for Semester Result...</td></tr>";
?>
                    </table>
          </div>
            <br />
            <div>
            <table class="table demo table-bordered my_table_style1" data-filter="#filter" data-page-size="5" data-page-previous-text="prev" data-page-next-text="next" width="100%">
                            <thead>
                            <tr>
                                    <th>Semester</th>
                                    <th>Subjects</th>
                                    <th data-hide="phone">GPA</th>
                            </tr>
                            </thead>

                    <tbody>
    <?php
    $total = 0;
    $sum[] = 0;
    if (isset($university_result) && !empty($university_result)) {
        $i = 0;
        foreach ($university_result as $val) {
            ?>
                                            <tr bgcolor="#fff">
                                            <td><?= $val['semester_name'] ?></td>
                                            <td>
                                                    <table><tr>
            <?php
            if (isset($val['subject_info']) && !empty($val['subject_info'])) {
                foreach ($val['subject_info'] as $result) {
                    ?>


                                                            <td align="center"><?= $result['nick_name'] ?></td>

                    <?php
                }
            }
            ?>
                                                </tr>
            <?php
            if (isset($val['subject_info']) && !empty($val['subject_info'])) {

                foreach ($val['subject_info'] as $result1) {
                    $total = $result1['total_cgb'];
                    ?>
                                                                    <td align="center" style="background-color:<?= ($result1['grade'] == 0) ? '#EECECE' : '#C1F0E1' ?>">
                    <?php
                    if ($result1['grade'] == 10)
                        echo "S";
                    else if ($result1['grade'] == 9)
                        echo "A";
                    else if ($result1['grade'] == 8)
                        echo "B";
                    else if ($result1['grade'] == 7)
                        echo "C";
                    else if ($result1['grade'] == 6)
                        echo "D";
                    else if ($result1['grade'] == 5)
                        echo "E";
                    else if ($result1['grade'] == 0)
                        echo "U";
                    ?>
                                                                    - <?= $result1['grade'] ?>
                                                                </td>
                <?php
            }
        }
        $sum[] = $total;
        ?>

                                                    </table>
                                            </td>
                                            <td align="right"><?= $total; ?></td>
                                            </tr>
        <?php
        $i++;
    }
}
?>
                    </tbody>

                            <tfoot>
                            <tr>
                              <td>&nbsp;</td>
                              <td align="right">CGPA</td>
                              <td align="right"><?php echo round(array_sum($sum) / $i, 2); ?></td>
                            </tr>
                            </tfoot>
                    </table>
            </div>
            </div>
    </div>	-->
</div>

<div class="message-container">
    <div class="message-form-content">
        <div class="message-form-header">
            <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/assignment.png"></div>
            Class Time Table
        </div>
        <div class="message-form-inner">
            <div id='time_table'>
                            <?php
                            if (isset($all_info[0]['time_info']) && !empty($all_info[0]['time_info'])) {
                                ?>
                    <table class="table demo my_table_style time_table" data-filter="#filter" data-page-size="5" data-page-previous-text="prev" data-page-next-text="next">
                        <thead>
                            <tr style="background-color: rgb(250, 250, 250);">
                                <th class="tt_m" style="font-size:11px;"><strong>Days /<br /> Hours</strong></th>
                                <?php
                                $j = 1;
                                foreach ($title as $val) {
                                    if ($val != '') {
                                        if ($j % 2 != 0) {
                                            echo "<th style='font-size:11px;'  data-hide='phone,tablet'>";
                                        }
                                        ?>


                                <?= $val ?>
                                <br />

                                <?php
                                if ($j % 2 == 0) {
                                    echo "</th>";
                                }
                                $j++;
                            }
                        }
                        ?>
                        </tr>
                        </thead>

                        <tbody>
                            <?php
                            $k = 0;
                            $i = 1;
                            if (isset($all_info[0]['time_info']) && !empty($all_info[0]['time_info'])) {
                                foreach ($all_info[0]['time_info'] as $val1) {
                                    if ($k == 0 || $k % $total_hours[0]['details'] == 0) {
                                        echo "<tr ><td style='font-size:10px;font-weight:bold' class='tt_m'>Day" . $i . "</td>";
                                        $i++;
                                    }
                                    echo "<td style='font-size:10px;'>";
                                    ?>

            <?php print_r($val1['subject_name']) ?>


                                    <?php
                                    $this->load->model('time_table/time_table_model');
                                    $staff = $this->time_table_model->get_staff_info($val1['supject_id']);
                                    ?>
                                <br />
                                <span class='select_staff'><?= $staff[0]['staff_name'] ?></span>
                                <?php
                                echo "</td>";
                                $k++;
                            }
                        } else
                            echo "<tr></tr>"
                            ?>
                        </tbody>
                    </table>
                <?php
                }else {
                    echo "Class Time Table Not Created Yet...";
                }
                ?>
            </div>
        </div>
    </div>
</div>

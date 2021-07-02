<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
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
<div class="message-form-inner attendance_table">
    <div class="page-inner" style="padding-left: 0;"><div class="page-title"><span><h3>Attendance Details</h3></span> </div></div>
    <table class="table table-bordered table-striped dataTable" width="100%">
        <thead>
            <tr>
                <th width="3%" rowspan="2">#</th>
                <th width="13%" rowspan="2" >Term</th>
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
            /* echo "<pre>";
              print_r($day_list);
              exit; */
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





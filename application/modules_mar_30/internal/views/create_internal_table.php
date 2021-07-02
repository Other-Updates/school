<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
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
</script>
<style type="text/css">
    .convert_internal{position: relative;left: 16px;}
    input[type="text"]{ width:50px;}
</style>
<input type="hidden" class="int_convert_mark" value="<?= $mark_info[0]['int_convert_mark'] ?>"/>
<input type="hidden" class="total_int_mark" value="<?= $mark_info[0]['total_int_mark'] ?>" />
<input type="hidden" class="convert_mark_model" value="<?= $mark_info[0]['model_convert_mark'] ?>" />
<table  class="table table-bordered table-striped dataTable">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Roll No</th>
            <th>Student Name</th>
            <?php
            if (isset($mark_info[0]['no_internal']) && !empty($mark_info[0]['no_internal'])) {
                for ($j = 1; $j <= $mark_info[0]['no_internal']; $j++) {
                    ?>
                    <th>Internal-<?= $j ?>
                        </br>
                        Exam(<?php echo $mark_details[0]['grade_point'] ?>) + Practical(<?php echo $mark_details[0]['practical_mark'] ?>) <input type="text" value="<?php echo ($mark_details[0]['grade_point'] + $mark_details[0]['practical_mark']) ?>" class='text_total total_<?= $j ?>' />
                    </th>

                    <?php
                }
            }
            ?>
            <th style="display:none;">Model<input type="text" readonly="readonly"  value="<?= $mark_info[0]['model_mark'] ?>" class='model_score' /></th>
            <th>Internal Total</th>
            <th style="display:none;">Model Total</th>
            <th>Assignment</th>
            <th>Attendance</th>
            <th>Total</th>
        </tr>
    </thead>

    <?php
    if (isset($all_student) && !empty($all_student)) {
        $j = 1;
        $i = 0;
        foreach ($all_student as $val) {
            ?>
            <tr>
                <td><?= $j ?></td>
                <td><?= $val['std_id'] ?></td>
                <td><?= $val['name'] ?> <input type="hidden" id='<?= $j ?>' class="student_id <?= $val['id'] ?>" value='<?= $val['id'] ?>'/></td>
                <?php
                if (isset($mark_info[0]['no_internal']) && !empty($mark_info[0]['no_internal'])) {
                    for ($i = 1; $i <= $mark_info[0]['no_internal']; $i++) {
                        ?>
                        <td>
                            <input type="text"  class='text_int int_<?= $i ?> _intval_<?= $j ?>' />

                            <i class="fa fa-retweet convert_internal"></i>
                            <input type="text"  readonly="readonly" class='text_convert_<?= $j ?> convert_<?= $i ?>' />

                        </td>
                        <?php
                    }
                }
                ?>
                <td  style="display:none;">
                    <input type="text"  class='get_model modelscore_<?= $j ?>' />
                    <i class="fa fa-retweet convert_internal"></i>
                    <input type="text"  readonly="readonly" class='convertmodel_<?= $j ?>' />
                </td>
                <td>
                    <input type="hidden" readonly="readonly" class='totalval_<?= $j ?>' />
                    <input type="text" readonly="readonly"  class='fulltotalval_<?= $j ?>' />
                </td>
                <td style="display:none;">
                    <input type="text" readonly="readonly"  class='modelfullval_<?= $j ?>' />
                </td>
                <?php
                $assign = array();
                if (isset($val['assignment']) && !empty($val['assignment'])) {
                    foreach ($val['assignment'] as $all_val) {
                        $assign[] = $all_val['score'] / $all_val['total'];
                    }
                }


                $tot_hr_st = 0;
                $std_pr = 0;
                $att_mark = 0;
                $this->db->select("COUNT(attendance_staff_det.id) AS hour_count");
                //$this->db->where('attendance_stud_deta.std_id',$stud_det[0]['id']);
                $this->db->where('attendance.semester_id', $ajax_val['select_sem']);
                $this->db->join('attendance', 'attendance.id = attendance_staff_det.attend_id');
                $qer = $this->db->get('attendance_staff_det')->result_array();
                //echo $this->db->last_query();
                $tot_hrs = $qer[0]['hour_count'];


                $tot_od_ml_hrs = 0;
                $this->db->select("*,SUM(atten_od_ml_dates.hrs) AS hour_countl");
                $this->db->where('atten_od_ml_dates.stud_id', $val['id']);
                $this->db->where('atten_od_ml_std.semester_id', $ajax_val['select_sem']);
                $this->db->where('atten_od_ml_std.stud_id', $val['id']);
                $this->db->join('atten_od_ml_std', 'atten_od_ml_std.id = atten_od_ml_dates.atten_od_ml_std_id');
                $qer = $this->db->get('atten_od_ml_dates')->result_array();

                if (isset($qer[0]['hour_countl']) && !empty($qer[0]['hour_countl'])) {
                    $tot_od_ml_hrs = $qer[0]['hour_countl'];
                    $att_mod = $qer[0]['atten_mode'];
                } else {
                    $tot_od_ml_hrs = 0;
                    $att_mod = 0;
                }

                $this->db->select("COUNT(attendance_stud_deta.id) AS hour_count");
                $this->db->where('attendance_stud_deta.std_id', $val['id']);
                $this->db->where('attendance.semester_id', $ajax_val['select_sem']);
                $this->db->join('attendance', 'attendance.id = attendance_stud_deta.attend_id');
                $qer = $this->db->get('attendance_stud_deta')->result_array();

                $tot_hr_st = $qer[0]['hour_count'];
                $tot_hr_st1 = $tot_hr_st + $tot_od_ml_hrs;
                $per_tmp = $tot_hr_st1 * 100;
                $std_pr = $per_tmp / $tot_hrs;
                $absen_tmp_hr = $tot_hrs - $tot_hr_st;
                $absen_hr = ($absen_tmp_hr > 0) ? $absen_tmp_hr : '--';

                $att_mark = ($std_pr / 100) * $mark_info[0]['att_mark'];
                ?>
                <td>
                    <input type="text" readonly="readonly"  value="<?= array_sum($assign) ?>" class='assign_<?= $j ?>' />
                </td>
                <td>
                    <input type="text" readonly="readonly" value="<?= $att_mark ?>"  class='attend_<?= $j ?>' />
                </td>
                <td>
                    <input type="text" readonly="readonly"  class='final_total_<?= $j ?>' />
                </td>
            </tr>
            <?php
            $j++;
        }
    } else
        echo "<tr><td colspan=15'>Student Not Created Yet..</td></tr>";
    ?>
</table>
<br />
<div class="right">
    <input type="button" id='add_internal' value='Submit' class="btn btn-primary"/>
</div>
<br /><br />
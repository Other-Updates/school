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
<input type="hidden" class="update_id" value="<?= $all_info[0]['id'] ?>" />
<table class="table table-bordered table-striped dataTable">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Roll No</th>
            <th>Student Name</th>
            <?php
            $fullval = explode(",", $all_info[0]['internal_total']);
            //print_r($fullval);
            if (isset($mark_info[0]['no_internal']) && !empty($mark_info[0]['no_internal'])) {
                $jj = 0;
                for ($j = 1; $j <= $mark_info[0]['no_internal']; $j++) {
                    ?>
                    <th>Internal-<?= $j ?>
                        </br>
                        Exam(<?php echo $mark_details[0]['grade_point'] ?>) + Practical(<?php echo $mark_details[0]['practical_mark'] ?>)
                        <input  type="text" <?= ($all_info[0]['complete_status'] == 1) ? 'readonly' : '' ?> <?= ($fullval[$jj] != '') ? 'readonly' : '' ?> value='<?php echo ($mark_details[0]['grade_point'] + $mark_details[0]['practical_mark']) ?>' class='text_total total_<?= $j ?>' />
                    </th>
                    <?php
                    $jj++;
                }
            }
            ?>
            <th style="display:none;">Model<input type="text" readonly="readonly"  value="<?= $all_info[0]['model_total'] ?>" class='model_score' /></h>
            <th>Internal Total</th>
            <th style="display:none;">Model Total</th>
            <th>Assignment</th>
            <th>Attendance</th>
            <th style="display:none;">External</th>
            <th>Total</th>
        </tr>
    </thead>
    <?php
    if (isset($all_student) && !empty($all_student)) {
        $j = 1;
        foreach ($all_student as $val) {
            $intfullval = 0;
            ?>
            <tr>
                <td><?= $j ?></td>
                <td><?= $val['std_id'] ?></td>
                <td><?= $val['name'] ?> <input type="hidden" id='<?= $j ?>' class="student_id <?= $val['id'] ?>" value='<?= $val['id'] ?>'/></td>
                <?php
                //print_r($val['internal_details'][0]['internals']);
                if (isset($val['internal_details'][0]['internals']))
                    $intfullval = explode(",", $val['internal_details'][0]['internals']);
                if (isset($mark_info[0]['no_internal']) && !empty($mark_info[0]['no_internal'])) {
                    $kk = 0;
                    for ($i = 1; $i <= $mark_info[0]['no_internal']; $i++) {
                        ?>
                        <td>
                            <input type="text"  <?= ($all_info[0]['complete_status'] != 0) ? 'readonly' : '' ?> value='<?= $intfullval[$kk] ?>' class='text_int int_<?= $i ?> _intval_<?= $j ?>' />
                            <?php
                            $convert_int = ($intfullval[$kk] / $fullval[$kk]) * $mark_info[0]['int_convert_mark'];
                            ?>
                            <i class="fa fa-retweet convert_internal"></i>
                            <input type="text"  value='<?= $convert_int ?>' readonly="readonly" class='text_convert_<?= $j ?> convert_<?= $i ?>' />
                        </td>
                        <?php
                        $kk++;
                    }
                }
                ?>
                <td style="display:none;">
                    <input type="text" <?= ($all_info[0]['complete_status'] != 0) ? 'readonly' : '' ?>  value="<?= $val['internal_details'][0]['model'] ?>"  class='get_model modelscore_<?= $j ?>' />
                    <i class="fa fa-retweet convert_internal"></i>
                    <input type="text"   value="<?= $val['internal_details'][0]['model_total'] ?>" readonly="readonly" class='convertmodel_<?= $j ?>' />
                </td>
                <td>
                    <input type="hidden" readonly="readonly" class='totalval_<?= $j ?>' />
                    <input type="text" readonly="readonly" value="<?= $val['internal_details'][0]['internals_total'] ?>"  class='fulltotalval_<?= $j ?>' />
                </td>
                <td style="display:none;">
                    <input type="text" readonly="readonly" value="<?= $val['internal_details'][0]['model_total'] ?>"  class='modelfullval_<?= $j ?>' />
                </td>
                <?php
                $assign = array();
                if (isset($val['assignment']) && !empty($val['assignment'])) {
                    foreach ($val['assignment'] as $all_val) {
                        if ($all_val['total'] != 0)
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
                if ($tot_hrs != 0)
                    $std_pr = $per_tmp / $tot_hrs;
                $absen_tmp_hr = $tot_hrs - $tot_hr_st;
                $absen_hr = ($absen_tmp_hr > 0) ? $absen_tmp_hr : '--';

                $att_mark = ($std_pr / 100) * $mark_info[0]['att_mark'];
                ?>
                <td>
                    <input type="text" readonly="readonly"  value="<?= array_sum($assign) ?>" class='assign_<?= $j ?>' />
                </td>
                <td>
                    <input type="text" readonly="readonly"   value="<?= $val['internal_details'][0]['attendance'] ?>" class='attend_<?= $j ?>' />
                </td>
                <td style="display:none;">
                    <input type="text"  <?= ($all_info[0]['complete_status'] == 1) ? '' : 'readonly' ?>    value="<?= $val['internal_details'][0]['exam_mark'] ?>" class='exam_mark exam_<?= $j ?>' />
                </td>
                <td>
                    <input type="text" readonly="readonly"   value="<?= $val['internal_details'][0]['total'] ?>" class='final_total_<?= $j ?>' />
                    <input type="hidden"  value="<?= $val['internal_details'][0]['total'] - $val['internal_details'][0]['exam_mark'] ?>" class='hide_final_total_<?= $j ?>' />
                </td>
            </tr>
            <?php
            $j++;
        }
    }
    ?>
</table>
<br />
<?php if ($all_info[0]['complete_status'] == 0) { ?>
    <input type="button" id='update_internal' value='Update' class="btn btn-primary fright"/> &nbsp;
<?php } ?>
<?php if ($all_info[0]['complete_status'] == 0) { ?>
    <a href="#complete_internal_status" data-toggle="modal" title="View" data-original-title="View" name="group" class="btn bg-maroon">Complete</a>
    <div id="complete_internal_status" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">×</a>
                    <h3 id="myModalLabel"></h3>
                </div>
                <div class="modal-body">
                    Are You Sure You Want to Complete? You Can't Update Internal Marks Again.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary complete_internal"  class="" data-dismiss="modal" value="<?= $all_info[0]['id'] ?>">Complete</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($all_info[0]['complete_status'] == 3) { ?>
    <a href="#complete_internal_status" data-toggle="modal" title="View" data-original-title="View" name="group" class="btn bg-maroon">Close</a>
    <div id="complete_internal_status" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">×</a>
                    <h3 id="myModalLabel"></h3>
                </div>
                <div class="modal-body">
                    Are You Sure You Want to Close? You Can't Edit Again.
                </div>
                <div class="modal-footer">
                    <button class="btn bg-maroon close_internal"  class="" data-dismiss="modal" value="<?= $all_info[0]['id'] ?>">Close</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<a target="_blank" class="btn btn-primary" href='<?= $this->config->item('base_url') . 'internal/internal_print/' . $ajax_val['select_batch'] . '/' . $ajax_val['depart_id'] . '/' . $ajax_val['group_id'] . '/' . $ajax_val['subject'] . '/' . $ajax_val['select_sem'] . '/' . $ajax_val['int_id'] ?>'>View</a>
<br /><br />


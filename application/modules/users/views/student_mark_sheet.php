<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<div class="message-container">
    <div class="message-form-content">
        <div class="message-form-header">
            <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/internal_mark.png"></div>
            Mark Details
        </div>
        <div class="message-form-inner">
            <div>
                <?php
                if (empty($from_report)) {
                    ?>
                    <table class="view_table"  width="100" >
                        <tr>
                            <td style="width: 18%;">NAME</td>
                            <td class="text_bold"><?= strtoupper($student_info[0]['student_name']) ?>&nbsp;<?= strtoupper($student_info[0]['last_name']) ?></td>
                            <td>REGISTER NO</td>
                            <td class="text_bold"><?= $student_info[0]['regno'] ?></td>
                            <td>GENDER</td>
                            <td class="text_bold"><?= strtoupper($student_info[0]['gender']) ?></td>
                        </tr>
                        <tr>
                            <td>DATE OF BIRTH</td>
                            <td class="text_bold"><?= date('d-M-Y', strtotime($student_info[0]['dob'])) ?></td>
                            <td>BATCH</td>
                            <td class="text_bold"><?= $student_info[0]['from']; ?></td>
                            <td>BOARD</td>
                            <td class="text_bold"><?= strtoupper($board[0]['board_type']) ?></td>
                        </tr>
                        <tr>
                            <td>SCHOOL</td>
                            <td  class="text_bold">JKKN SCHOOL</td>
                            <td>CLASS</td>
                            <td class="text_bold"><?= strtoupper($student_info[0]['department']) ?></td>
                            <td colspan="2" rowspan="3" align="center"><img id="blah" style="height:100px;width:100px;text-align:center;" class="add_staff_thumbnail" src="<?= $this->config->item('base_url'); ?>/profile_image/student/orginal/<?= $student_info[0]['image'] ?>"  alt="Student Image" /></td>
                        </tr>
                        <tr>
                            <td>TERM</td>
                            <td  class="text_bold"><?= strtoupper($university_result[0]['semester_name']) ?></td>
                            <td>EXAM</td>
                            <td class="text_bold"><?= strtoupper($university_result[0]['exam_name']) ?></td>
                        </tr>
                    </table>
                    <br />
                    <?php
                } else {
                    ?>
                    <div class="page-inner" style="padding-left: 0;"><div class="page-title"><span><h3>Mark Sheet</h3></span> </div></div>
                <?php } ?>

                <table class="table table-bordered table-striped dataTable" width="100%">
                    <thead>
                        <tr>
                            <th style="text-align:center;width: 15%;">Subjects Code</th>
                            <th style="text-align:center;width: 40%;">Subjects</th>
                            <th style="text-align:center;width: 10%;">Theory</th>
                            <th style="text-align:center;width: 10%;">Practical</th>
                            <th style="text-align:center;width: 10%;">Total</th>
                            <th style="text-align:center;width: 10%;">Result</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $sum = array();
                        $total = 0;
                        $i = 0;
                        if (isset($university_result) && !empty($university_result)) {

                            foreach ($university_result as $val) {
                                ?>

                                <?php
                                if (isset($val['subject_info']) && !empty($val['subject_info'])) {
                                    foreach ($val['subject_info'] as $result1) {
                                        ?>
                                        <tr>
                                            <td  style="text-align:center;width: 15%;"><?= $result1['scode'] ?></td>
                                            <td  style="text-align:center;width: 40%;"><?= $result1['subject_name'] ?></td>
                                            <td  style="text-align:center;width: 10%;"><?php echo $result1['grade_point']; ?></td>
                                            <td  style="text-align:center;width: 10%;"><?php echo ($result1['practical_mark'] != '') ? $result1['practical_mark'] : '-'; ?>
                                            </td>
                                            <td  style="text-align:center;width: 10%;"><?php echo ($result1['grade_point'] + $result1['practical_mark']); ?></td>
                                            <?php if ($result1['practical_mark'] != '') { ?>
                                                <td  style="text-align:center;width: 10%;"><?php echo (($result1['grade_point'] >= $result1['pass_mark']) && ($result1['practical_mark'] >= $result1['practical_pass_mark']) ) ? 'PASS' : 'FAIL' ?></td>
                                            <?php } else { ?>
                                                <td  style="text-align:center;width: 10%;"><?php echo (($result1['grade_point'] >= $result1['pass_mark'])) ? 'PASS' : 'FAIL' ?></td>
                                            <?php } ?>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                                <tr>
                                    <td colspan="4" style="text-align:right;"><b> TOTAL </b></td>
                                    <td align="center"><strong><?= $result1['total']; ?></strong></td>
                                    <td>  </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align:right;"><b> RESULT </b></td>
                                    <td align="center"><?= ($result1['result'] == 2) ? '<span class="btn btn-danger btn-sm">FAIL</span>' : '<span class="btn btn-success btn-sm">PASS</span>' ?></td>
                                    <td>  </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <br />
<!--                <table class="view_table" width="100%">
                    <tr>
                        <td>RA</td>
                        <td width="5"></td>
                        <td class="text_bold">Reappearance is Required</td>
                    </tr>
                </table>-->
            </div>
            <div class="admin_print_use">
                <br />

                <input type="button" value='Print' class="btn btn-primary print_btn right header"/>

                <br /><br />
            </div>
            <script type="text/javascript">
                $('.print_btn').live('click', function () {
                    window.print();
                });
            </script>
        </div>
    </div>
</div>


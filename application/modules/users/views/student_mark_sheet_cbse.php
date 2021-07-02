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
                    <table class="staff_table"  width="100" >
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
                            <td colspan="2" rowspan="2" align="center"><img id="blah" style="height:100px;width:100px;" class="add_staff_thumbnail" src="<?= $this->config->item('base_url'); ?>/profile_image/student/orginal/<?= $student_info[0]['image'] ?>"  alt="Student Image" /></td>
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
                            <th style="text-align:center;width: 10%;">Credits</th>
                            <th style="text-align:center;width: 10%;">Letter Grade</th>
                            <th style="text-align:center;width: 10%;">Grade Point</th>
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
                                        $total = $result1['total'];
                                        ?>
                                        <tr>
                                            <td  style="text-align:center;width: 15%;"><?php echo $result1['scode'] ?></td>
                                            <td  style="text-align:left;width: 40%;"><?php echo ucfirst($result1['subject_name']); ?></td>
                                            <td  style="text-align:center;width: 10%;"><?php echo $result1['subject_mark']; ?></td>
                                            <td  style="text-align:center;width: 10%;">
                                                <?php
                                                if ($result1['grade'] == 10)
                                                    echo "A1";
                                                else if ($result1['grade'] == 9)
                                                    echo "A2";
                                                else if ($result1['grade'] == 8)
                                                    echo "B1";
                                                else if ($result1['grade'] == 7)
                                                    echo "B2";
                                                else if ($result1['grade'] == 6)
                                                    echo "C1";
                                                else if ($result1['grade'] == 5)
                                                    echo "C2";
                                                else if ($result1['grade'] == 4)
                                                    echo "D";
                                                else if ($result1['grade'] == 2)
                                                    echo "E1";
                                                else if ($result1['grade'] == 0)
                                                    echo "E2";
                                                ?>
                                            </td>
                                            <td  style="text-align:center;width: 10%;"><?= $result1['grade'] ?></td>
                                            <td  style="text-align:center;width: 10%;"><?= ($result1['grade'] == 0) ? 'FAIL' : 'PASS' ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                $sum[] = $total;
                                ?>

                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" align="right"><strong>GPA</strong></td>
                            <td align="center"><strong><?php echo $total; ?></strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right"><strong>CGPA</strong></td>
                            <td align="center"><strong><?php echo round(array_sum($sum) / $i, 2); ?></strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
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


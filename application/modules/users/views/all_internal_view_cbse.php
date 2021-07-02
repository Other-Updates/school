<?php
$user_info = $this->session->userdata('user_info');
$this->load->model('admin/admin_model');
$mark_info = $this->admin_model->get_internal_details();
?>

<br />
<div class="row">
    <div class="six columns">
        <table class="view_table" width="100%">
            <tr>
                <td width="40%">Roll No</td>
                <td class="text_bold" style="color:red"><?= $user_info[0]['std_id'] ?></td>
            </tr>
            <tr>
                <td>Batch</td>
                <td class="text_bold"><?= $user_info[0]['from']; ?></td>
            </tr>
            <tr>
                <td>Semester</td>
                <td class="text_bold"><?php
                    if (isset($all_sem[0]['semester'])) {
                        echo $all_sem[0]['semester'];
                    }
                    ?></td>
            </tr>
            <tr>
                <td>Board</td>
                <td class="text_bold"><?= $board[0]['board_type'] ?></td>
            </tr>
        </table>
    </div>
    <div class="six columns">
        <table class="view_table" width="100%">
            <tr>
                <td width="40%">Student Name</td>
                <td class="text_bold"><?= ucfirst($user_info[0]['name']) ?></td>
            </tr>
            <tr>
                <td>Department</td>
                <td class="text_bold"><?= $user_info[0]['department'] . '-' . $user_info[0]['group'] ?></td>
            </tr>
            <tr>
                <td>Join Date</td>
                <td class="text_bold"><?= date('d-m-Y', strtotime($user_info[0]['join_date'])) ?></td>
            </tr>
        </table>
    </div>
</div>

<br /><br />
<div class="full_width">
    <table  class="table table-bordered table-striped  my_table_style">
        <thead>
            <tr>
                <th>Roll No</th>
                <th>Student Name</th>
                <?php
                if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
                    foreach ($all_subject[0]['subject'] as $val) {
                        ?>
                        <th>
                            <?= $val['nick_name'] ?>
                            <input type="hidden" name="subject[]" value="<?= $val['subject_id'] ?>" />
                        </th>
                        <?php
                    }
                }
                ?>
                <th>GPA</th>
                <th>Result</th>
                <th class="header">Mark Sheet</th>
            </tr>
        </thead>
        <?php
        if (isset($all_grade[0]['external_details']) && !empty($all_grade[0]['external_details'])) {
            ?>
            <input type="hidden" name="update_page" value='<?= $all_grade[0]['id'] ?>'/>
            <?php
            $j = 1;
            $i = 0;
            foreach ($all_grade[0]['external_details'] as $val) {
                ?>

                <tr>
                    <td>
                        <?= $val['roll_no'] ?>
                        <input type="hidden" value="<?= $val['std_id'] ?>" name="std_id[]"  />
                    </td>
                    <td>
                        <?= $val['name'] ?>
                    </td>
                    <?php
                    if (isset($val['grade_details']) && !empty($val['grade_details'])) {
                        foreach ($val['grade_details'] as $val1) {
                            ?>

                            <td style="text-align:center;">
                                <?php
                                switch ($val1['grade']) {
                                    case 10:
                                        echo "A1";
                                        break;
                                    case 9:
                                        echo "A2";
                                        break;
                                    case 8:
                                        echo "B1";
                                        break;
                                    case 7:
                                        echo "B2";
                                        break;
                                    case 6:
                                        echo "C1";
                                        break;
                                    case 5:
                                        echo "C2";
                                        break;
                                    case 4:
                                        echo "D";
                                        break;
                                    case 2:
                                        echo "E1";
                                        break;
                                    case 0:
                                        echo "E2";
                                        break;
                                    case '':
                                        echo 'ww';
                                        break;
                                }
                                ?>
                                - <?php echo (($val1['grade']) != null) ? ucfirst($val1['grade']) : 'Grade' ?>
                            </td>
                            <?php
                        }
                    }
                    ?>
                    <td style="text-align:center;"><?= $val['grade_details'][0]['total'] ?></td>
                    <td style="text-align:center;" >
                        <label class="btn btn-<?php echo ($val1['grade'] == 0) ? 'danger' : 'success' ?> btn-sm"><?php echo ($val1['grade'] == 0) ? 'Fail' : 'Pass' ?></label>
                    </td>
                    <td class="header" style="text-align:center;">
                        <a href="<?= $this->config->item('base_url') . 'users/mark_sheet_cbse/' . $user_info[0]['id'] . '/' . $all_post['exam_id']; ?>" title="Mark Sheet" target="_blank" class="btn btn-info btn-sm">View</a>
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
    <table  class="table table-bordered table-striped my_table_style">
        <thead>
            <tr>
                <th>Letter Grade</th>
                <th>Grade Point</th>
                <th>Mark Range</th>
            </tr>
        </thead>
        <tr><td>A1</td><td>10</td><td>91-100</td></tr>
        <tr><td>A2</td><td>9</td><td>81-90</td></tr>
        <tr><td>B1</td><td>8</td><td>71-80</td></tr>
        <tr><td>B2</td><td>7</td><td>61-70</td></tr>
        <tr><td>C1</td><td>6</td><td>51-60</td></tr>
        <tr><td>C2</td><td>5</td><td>41-50</td></tr>
        <tr><td>D</td><td>4</td><td>33-40</td></tr>
        <tr><td>E1</td><td>2</td><td>21-32</td></tr>
        <tr><td>E2</td><td>0</td><td> < 50 </td></tr>
    </table>
    <br>
</div>

<?php
if (isset($all_grade[0]['external_details']) && !empty($all_grade[0]['external_details'])) {
    ?>
    <div class="admin_print_use header">
        <div class="right">
            <input type="button" value='Print' class="btn btn-primary print_btn "/>&nbsp;&nbsp;

            <a class="btn btn-info" href='<?= $this->config->item('base_url') . 'users/excel_cbse/' ?>'>Excel</a>&nbsp;&nbsp;

            <a class="btn btn-danger" href='<?= $this->config->item('base_url') . 'users/pdf_cbse/' ?>'>PDF</a>

        </div>
        <br /><br />
    </div>
<?php } ?>

<script type="text/javascript">

    $('.print_btn').live('click', function () {
        window.print();
    });

</script>


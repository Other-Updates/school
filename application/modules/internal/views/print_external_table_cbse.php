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
<?php
if (isset($all_grade[0]['external_details']) && !empty($all_grade[0]['external_details'])) {
    ?>
    <div class='print_admin_use'>
        <a href="<?= $this->config->item('base_url') . 'internal/cgpa_report/' . $post_data["batch_id"] . '/' . $post_data["depart_id"] . '/' . $post_data["group_id"] . '/' . $post_data["semester"] . '/' . $post_data["exam_id"]; ?>" title="CGPA REPORT" target="_blank" data-toggle="modal" name="group" class="btn bg-navy btn-sm" style="float:right">Over All CGPA</a>
    </div>

    <table class="staff_table">
        <tr>
            <td width="20%">Batch</td>
            <td width="30%" class="text_bold"><?= $all_grade[0]['from']; ?></td>
            <td width="20%">Class</td>
            <td width="30%" class="text_bold"><?= $all_grade[0]['department']; ?></td>
        </tr>
        <tr>
            <td>Term</td>
            <td class="text_bold"><?= $all_grade[0]['semester'] ?></td>
            <td>Section</td>
            <td class="text_bold"><?= $all_grade[0]['group'] ?></td>
        </tr>
        <tr>
            <td>Board</td>
            <td class="text_bold"><?= $board[0]['board_type'] ?></td>
            <td>Exam</td>
            <td class="text_bold"><?= ucwords($all_grade[0]['exam']); ?></td>
        </tr>
    </table>
    <br />
<?php } ?>
<table  class="table table-bordered table-striped dataTable" >
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

                        <th>
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
                        </th>
                        <?php
                    }
                }
                ?>
                <th><?= $val['grade_details'][0]['total'] ?></th>
            </tr>
            <?php
            $j++;
        }
    } else
        echo "<tr><td colspan=15'>Student Not Created Yet..</td></tr>";
    ?>
</table>
<br />
<table  class="table table-bordered table-striped dataTable">
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
<?php
if (isset($all_grade[0]['external_details']) && !empty($all_grade[0]['external_details'])) {
    ?>
    <div class="admin_print_use ">
        <div class="right">
            <input type="button" value='Print' class="btn btn-primary print_btn "/>&nbsp;&nbsp;

            <a class="header btn btn-info" href='<?= $this->config->item('base_url') . 'internal/excel/' . $post_data['batch_id'] . '/' . $post_data['depart_id'] . '/' . $post_data['group_id'] . '/' . $post_data['semester'] . '/' . $post_data['exam_id'] . '/' . $board[0]['id']; ?>'>Excel</a>&nbsp;&nbsp;

            <a class="header btn btn-warning" href='<?= $this->config->item('base_url') . 'internal/pdf/' . $post_data['batch_id'] . '/' . $post_data['depart_id'] . '/' . $post_data['group_id'] . '/' . $post_data['semester'] . '/' . $post_data['exam_id'] . '/' . $board[0]['id']; ?>'>PDF</a>

        </div>
        <br /><br />
    </div>
<?php } ?>
</form>
<script type="text/javascript">
    $('.print_btn').live('click', function () {
        window.print();
    });
</script>
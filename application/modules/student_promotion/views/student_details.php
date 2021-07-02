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
    .red{
        background: #da3d3dbf !important;
    }
</style>

<form action="<?php echo $this->config->item('base_url') . 'student_promotion/switch_over_students/' ?>" method="post" >
    <?php
    if (isset($all_grade[0]['external_details']) && !empty($all_grade[0]['external_details'])) {
        ?>
        <table class="staff_table">
            <tr>
                <td width="20%">Academic year</td>
                <td width="20%" class="text_bold"><?= $all_grade[0]['from'] ?></td>
                <td width="20%">Class</td>
                <td width="20%" class="text_bold"><?= ucwords($all_grade[0]['department']); ?></td>
            </tr>
            <tr>
                <td>Term</td>
                <td class="text_bold"><?= ucwords($all_grade[0]['semester']); ?></td>
                <td>Section</td>
                <td class="text_bold"><?= ucwords($all_grade[0]['group']); ?></td>
            </tr>
            <tr>
                <td>Board</td>
                <td class="text_bold"><?php echo ucwords($board[0]['board_type']); ?></td>
                <td><input type="checkbox" id="passed_students"  checked="" value="1" class="" name="passed_students"/>
                    <b>Passed students</b></td>
                <td><input type="checkbox" id="all_students"  value="0" class="" name="all_students" />
                    <b>All students</b></td>
            </tr>
        </table>
        <br />
    <?php } ?>

    <table  class="table table-bordered table-striped dataTable">
        <thead>
            <tr>
                <th>Roll No</th>
                <th>Student Name</th>
                <?php
                $sum = array();
                $sum1 = array();

                if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
                    foreach ($all_subject[0]['subject'] as $val) {
                        ?>
                        <th colspan="<?php echo ($val['check_practical'] == 1) ? 2 : 0 ?>">
                            <?= ucwords($val['nick_name']); ?> - Theory ( <?php echo $sum[] = ($val['grade_point']) ?> )

                            <?php if ($val['check_practical'] == 1) { ?>

                                - Practical ( <?php echo $sum1[] = ($val['practical_mark']); ?> )


                            <?php }
                            ?>
                        </th>

                        <?php
                    }
                }
                ?>
                <th>Total - ( <?php echo round((array_sum($sum) + array_sum($sum1))) ?> )

                </th>
                <th>Result</th>
            </tr>
        </thead>

        <?php
        if (isset($all_grade[0]['external_details']) && !empty($all_grade[0]['external_details'])) {
            ?>

            <?php
            $j = 1;
            $i = 0;
            foreach ($all_grade[0]['external_details'] as $val) {
                ?>
                <tr>
                    <td>

                        <input type="text" value='<?php echo ucwords($val['roll_no']); ?>' name="new_roll_no[]" style="width:100%"/>

                    </td>
                    <td>
                        <?php echo ucwords($val['name']); ?>
                    </td>
                    <?php
                    if (isset($val['grade_details']) && !empty($val['grade_details'])) {
                        foreach ($val['grade_details'] as $val1) {
                            ?>
                            <td>
                                <?php echo $val1['grade_point']; ?>
                            </td>

                            <?php if ($val1['practical_mark'] != '') { ?>
                                <td>
                                    <?php echo $val1['practical_mark'] ?>
                                </td>

                            <?php } ?>
                            <?php
                        }
                    }
                    ?>
                    <td><?= $val1['total'] ?></td>
                    <td><label class="btn btn-<?php echo ($val1['result'] == '1') ? 'success' : 'danger' ?> btn-sm"><?php echo ($val1['result'] == '1') ? 'Pass' : 'Fail' ?></label></td>

                </tr>
                <?php
                $j++;
            }
        } else
            echo "<tr><td colspan=15'>Exam Result Not Found..</td></tr>";
        ?>
    </table>
    </br>
    <?php
    if (isset($all_grade[0]['external_details']) && !empty($all_grade[0]['external_details'])) {

        if ($all_grade[0]['complete_status'] == 0) {
            ?>

            <div class="admin_print_use center ">
                <!--<div class="right">-->

                <input type="hidden" value='<?php echo $ajax_value['batch_id']; ?>' name="batch_id" />
                <input type="hidden" value='<?php echo $ajax_value['depart_id']; ?>' name="depart_id" />
                <input type="hidden" value='<?php echo $ajax_value['group_id']; ?>' name="group_id" />
                <input type="hidden" value='<?php echo $ajax_value['semester']; ?>' name="semester" />
                <input type="hidden" value='<?php echo $ajax_value['exam_id']; ?>' name="exam_id" />
                <input type="hidden" value='<?php echo $board[0]['id']; ?>' name="board_id" />

                <input type="submit" value='Promotion' class="btn btn-primary" />
        <!--                    <a class="btn btn-primary" href='<?= $this->config->item('base_url') . 'student_promotion/switch_over_students/' . $ajax_value['batch_id'] . '/' . $ajax_value['depart_id'] . '/' . $ajax_value['group_id'] . '/' . $ajax_value['semester'] . '/' . $ajax_value['exam_id'] . '/' . $all_grade[0]['id']; ?>'>Promotion</a>-->


                <!--</div>-->
            </div>

        </form>

        <?php
    }
}
?>

<script type="text/javascript">

    $('#passed_students').change(function () {
        if (this.checked) {
            $(this).val("1");
            $('#all_students').prop('checked', false);
        } else {
            $(this).val("0");
            $('#all_students').prop('checked', true);
            $('#all_students').val("1");
        }
    });

    $('#all_students').change(function () {
        if (this.checked) {
            $(this).val("1");
            $('#passed_students').prop('checked', false);
        } else {
            $(this).val("0");
            $('#passed_students').prop('checked', true);
            $('#passed_students').val("1");
        }
    });
</script>
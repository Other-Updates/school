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
<style type="text/css">
    // @media print{@page {size: landscape}}
</style>
<?php
if (isset($all_grade[0]['external_details']) && !empty($all_grade[0]['external_details'])) {
    ?>
    <!--    <div class='print_admin_use'>
            <a href="<?= $this->config->item('base_url') . 'internal/cgpa_report/' . $post_data["batch_id"] . '/' . $post_data["depart_id"] . '/' . $post_data["group_id"] . '/' . $post_data["semester"]; ?>" title="CGPA REPORT" target="_blank" data-toggle="modal" name="group" class="btn bg-navy btn-sm" style="float:right">Over All CGPA</a>
        </div>-->

    <table class="staff_table">
        <tr>
            <td width="20%">Academic year</td>
            <td width="30%" class="text_bold"><?= $all_grade[0]['from'] ?></td>
            <td width="20%">Class</td>
            <td width="30%" class="text_bold"><?= ucwords($all_grade[0]['department']); ?></td>
        </tr>
        <tr>
            <td>Term</td>
            <td class="text_bold"><?= ucwords($all_grade[0]['semester']); ?></td>
            <td>Section</td>
            <td class="text_bold"><?= ucwords($all_grade[0]['group']); ?></td>
        </tr>
        <tr>

            <td>Exam</td>
            <td class="text_bold"><?= ucwords($all_grade[0]['exam']); ?></td>
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
                        <?= ucwords($val['nick_name']); ?> - Theory( <?php echo $sum[] = ($val['grade_point']) ?> )

                        <?php if ($val['check_practical'] == 1) { ?>

                            - Practical( <?php echo $sum1[] = ($val['practical_mark']); ?> )


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
            <th>Mark Sheet</th>

        </tr>
<!--        <tr>
            <th></th>
            <th></th>

        <?php
        if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
            foreach ($all_subject[0]['subject'] as $val) {
                ?>
                                                                                            <th  colspan="<?php echo ($val['check_practical'] == 1) ? 2 : 0 ?>">
                                                                                                Pass Mark - Theory( <?php echo $val['pass_mark'] ?> )
                <?php if ($val['check_practical'] == 1) { ?>
                                                                                                                                        - Practical( <?php echo $sum1[] = ($val['practical_pass_mark']) ?> )
                <?php }
                ?>
                                                                                            </th>
                <?php
            }
        }
        ?>
            <th></th>
            <th></th>
        </tr>-->
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
                    <?php echo ucwords($val['roll_no']); ?>

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
                <td><a href="<?= $this->config->item('base_url') . 'internal/mark_sheet/' . $val['std_id']; ?>" title="Mark Sheet" target="_blank" class="btn bg-navy btn-sm">View</a> </td>
            </tr>
            <?php
            $j++;
        }
    } else
        echo "<tr><td colspan=15'>Student Not Created Yet..</td></tr>";
    ?>
</table>
<br>
<table class="table table-bordered table-striped dataTable">
    <tr>
        <th  style="width: 25%;">Subject Name</th>
        <th style="text-align:center;width: 10%;">Theory</th>
        <th  style="text-align:center;width: 10%;">Pass Mark</th>
        <th  style="text-align:center;width: 10%;">Practical Mark</th>
        <th style="text-align:center;width: 10%;">Practical Pass Mark</th>
    </tr>
    <?php
    if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
        foreach ($all_subject[0]['subject'] as $result1) {
            ?>
            <tr>
                <td  style="width: 25%;"><?= $result1['subject_name'] ?></td>
                <td  style="text-align:center;width: 10%;"><?php echo ($result1['grade_point'] != '') ? $result1['grade_point'] : '-' ?></td>
                <td  style="text-align:center;width: 10%;"><?php echo ($result1['pass_mark'] != '') ? $result1['pass_mark'] : '-' ?></td>
                <td  style="text-align:center;width: 10%;"><?php echo ($result1['practical_mark'] != '') ? $result1['practical_mark'] : '-' ?></td>
                <td  style="text-align:center;width: 10%;"><?php echo ($result1['practical_pass_mark'] != '') ? $result1['practical_pass_mark'] : '-' ?></td>
            </tr>
            <?php
        }
    } else
        echo "<tr><td colspan=5'>No Subject Found..</td></tr>";
    ?>

</table>
<div class="admin_print_use">
    <input type="button" value='Print' class="btn btn-primary print_btn right"/>
    <br /><br />
</div>
</form>
<script type="text/javascript">
    $('.print_btn').live('click', function () {
        window.print();
    });
</script>
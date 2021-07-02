<?php
header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename=Exam_report_' . time() . '.xls');
header('Pragma: no-cache');
header('Expires: 0');
?>
<style type="text/css">
    table { border:1px #dfdfdf solid; border-collapse:collapse; }
    table th,td { border:1px #dfdfdf solid; text-align:center; }
</style>
<?php
if (isset($all_grade[0]['external_details']) && !empty($all_grade[0]['external_details'])) {
    ?>

            <!--    <table>
                    <tr>
                        <th colspan="2">Exam</th>
                        <th colspan="2"><?= ucwords($all_grade[0]['exam']); ?></th>
                    </tr>
                    <tr>
                        <th>Academic year</th>
                        <th><?= $all_grade[0]['from'] ?></th>
                        <th>Class</th>
                        <th><?= ucwords($all_grade[0]['department']); ?></th>
                    </tr>
                    <tr>
                        <th>Term</th>
                        <th><?= ucwords($all_grade[0]['semester']); ?></th>
                        <th>Section</th>
                        <th><?= ucwords($all_grade[0]['group']); ?></th>
                    </tr>
                </table>-->
<?php } ?>
<table>
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
                        <?= ucwords($val['nick_name']); ?> - Theory
                        <?php if ($val['check_practical'] == 1) { ?>
                            - Practical
                        <?php }
                        ?>
                    </th>

                    <?php
                }
            }
            ?>
            <th>Total</th>
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
                <td><?php echo ($val1['result'] == '1') ? 'Pass' : 'Fail' ?></label></td>
            </tr>
            <?php
            $j++;
        }
    } else
        echo "<tr><td colspan=15'>Student Not Created Yet..</td></tr>";
    ?>
</table>
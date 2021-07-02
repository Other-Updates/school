<style type="text/css">
    table { border:1px solid #000 !important; border-collapse:collapse; width:100%; }
    table th,td { border:1px solid #000 !important; text-align:center; }
    table th { font-size: 12px; }
    table td {font-size: 11px; padding: 3px 2px; }
</style>
<?php
if (isset($all_grade[0]['external_details']) && !empty($all_grade[0]['external_details'])) {
    $cl = count($all_subject[0]['subject']);
    ?>
    <table>
        <tr>
            <th colspan="<?php echo ($cl + 4 ); ?>">Exam : <?= ucwords($all_grade[0]['exam']); ?></th>
        </tr>
        <tr>
            <th colspan="<?php echo ($cl + 4 ); ?>">Academic year : <?= ucwords($all_grade[0]['from']); ?></th>
        </tr>
        <tr>
            <th colspan="<?php echo ($cl + 4 ); ?>">Term : <?= ucwords($all_grade[0]['semester']); ?></th>
        </tr>
        <tr>
            <th colspan="<?php echo ($cl + 4 ); ?>">Class : <?= ucwords($all_grade[0]['department']); ?></th>
        </tr>
        <tr>
            <th colspan="<?php echo ($cl + 4 ); ?>">Section : <?= ucwords($all_grade[0]['group']); ?></th>
        </tr>
        <tr></tr>
    </table>
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
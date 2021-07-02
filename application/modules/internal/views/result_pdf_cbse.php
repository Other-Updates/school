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
            <th colspan="<?php echo ($cl + 3); ?>">Exam : <?= ucwords($all_grade[0]['exam']); ?></th>
        </tr>
        <tr>
            <th colspan="<?php echo ($cl + 3 ); ?>">Academic year : <?= ucwords($all_grade[0]['from']); ?></th>
        </tr>
        <tr>
            <th colspan="<?php echo ($cl + 3 ); ?>">Term : <?= ucwords($all_grade[0]['semester']); ?></th>
        </tr>
        <tr>
            <th colspan="<?php echo ($cl + 3 ); ?>">Class : <?= ucwords($all_grade[0]['department']); ?></th>
        </tr>
        <tr>
            <th colspan="<?php echo ($cl + 3 ); ?>">Section : <?= ucwords($all_grade[0]['group']); ?></th>
        </tr>
    </table>
    <tr>

    </tr>
    </table>
<?php } ?>
<table>
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

        <?php
        $j = 1;
        $i = 0;
        foreach ($all_grade[0]['external_details'] as $val) {
            ?>
            <tr>
                <td>
                    <?php echo $val['roll_no'] ?>

                </td>
                <td>
                    <?php echo $val['name'] ?>
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
                <th><?php echo $val['grade_details'][0]['total'] ?></th>
            </tr>
            <?php
            $j++;
        }
    } else
        echo "<tr><td colspan=15'>Student Not Created Yet..</td></tr>";
    ?>
</table>
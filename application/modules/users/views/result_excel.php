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
if (isset($all_grade) && !empty($all_grade)) {

    foreach ($all_grade as $grade) {
        ?>
        <table>
            <thead>
                <tr>
                    <th colspan="6"><?php echo strtoupper($grade['exam_name']); ?></th>
                </tr>
                <tr>
                    <th>Subjects Code</th>
                    <th>Subjects</th>
                    <th>Theory</th>
                    <th>Practical</th>
                    <th>Total</th>
                    <th>Result</th>
                </tr>
            </thead>
            <?php
            if (isset($grade['external_details']) && !empty($grade['external_details'])) {

                foreach ($grade['external_details'] as $result1) {
                    ?>
                    <tr>
                        <td><?= $result1['scode'] ?></td>
                        <td><?= $result1['subject_name'] ?></td>
                        <td><?php echo $result1['grade_point']; ?></td>
                        <td><?php echo ($result1['practical_mark'] != '') ? $result1['practical_mark'] : '-'; ?>
                        </td>
                        <td><?php echo ($result1['grade_point'] + $result1['practical_mark']); ?></td>
                        <td><?= (($result1['grade_point'] >= $result1['pass_mark']) && ($result1['practical_mark'] >= $result1['practical_pass_mark']) ) ? 'PASS' : 'FAIL' ?></td>
                    </tr>
                    <?php
                }
            } else
                echo "<tr><td colspan=6'>Student Not Created Yet..</td></tr>";
            ?>

        </table></br>
        <?php
    }
}else {
    echo "<table><tr><td colspan=6'>Data Not Found...</td></tr></table>";
}
?>


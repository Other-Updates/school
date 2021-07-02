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

<div class="page-inner" style="padding-left: 0;"><div class="page-title"><span><h3>Exam Results</h3></span> </div></div>
<?php
if (isset($all_grade) && !empty($all_grade)) {

    foreach ($all_grade as $grade) {
        ?>
        <table  class="table table-bordered table-striped dataTable">
            <thead>
                <tr>
                    <th colspan="6" style="text-align:center"><?php echo strtoupper($grade['exam_name']); ?></th>
                </tr>
                <tr>
                    <th style="text-align:center;width: 15%;">Subjects Code</th>
                    <th style="text-align:center;width: 40%;">Subjects</th>
                    <th style="text-align:center;width: 10%;">Theory</th>
                    <th style="text-align:center;width: 10%;">Practical</th>
                    <th style="text-align:center;width: 10%;">Total</th>
                    <th style="text-align:center;width: 10%;">Result</th>
                </tr>
            </thead>
            <?php
            if (isset($grade['external_details']) && !empty($grade['external_details'])) {

                foreach ($grade['external_details'] as $result1) {
                    ?>
                    <tr>
                        <td  style="text-align:center;width: 15%;"><?= $result1['scode'] ?></td>
                        <td  style="text-align:left;width: 40%;"><?= $result1['subject_name'] ?></td>
                        <td  style="text-align:center;width: 10%;"><?php echo $result1['grade_point']; ?></td>
                        <td  style="text-align:center;width: 10%;"><?php echo ($result1['practical_mark'] != '') ? $result1['practical_mark'] : '-'; ?>
                        </td>
                        <td  style="text-align:center;width: 10%;"><?php echo ($result1['grade_point'] + $result1['practical_mark']); ?></td>
                        <td  style="text-align:center;width: 10%;"><?= (($result1['grade_point'] >= $result1['pass_mark']) && ($result1['practical_mark'] >= $result1['practical_pass_mark']) ) ? 'PASS' : 'FAIL' ?></td>
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


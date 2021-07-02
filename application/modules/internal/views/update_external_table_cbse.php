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

<table  class="table table-bordered table-striped dataTable">
    <thead>
        <tr>
            <th colspan=15'>Board - <?php echo $board[0]['board_type']; ?>
                <input type="hidden" name="student_group[board_id]" value="<?php echo $board[0]['id']; ?>" />
            </th></tr>
        <tr>
        <tr>
            <th>Roll No</th>
            <th>Student Name</th>
            <?php
            if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
                foreach ($all_subject[0]['subject'] as $val) {
                    ?>
                    <th>
                        <?= $val['nick_name'] ?>-( <?php echo $sum[] = $val['grade_point'] ?> )
                        <input type="hidden" name="subject[]" value="<?= $val['subject_id'] ?>" />
                    </th>
                    <?php
                }
            }
            ?>
            <th>GPA - ( <?php echo round(array_sum($sum)) ?> )
                <input type="hidden" value="<?php echo round(array_sum($sum)) ?>" id='subject_grade_point' />
            </th>
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

                            <select id='grade_id_<?= $val['std_id'] ?>_<?= $val1['subject_id'] ?>'  class='grade<?= $val['std_id'] ?> grade_option' style="width:62px;float:left; padding:0;" name="grate[<?= $val['std_id'] ?>][<?= $val1['subject_id'] ?>]">
                                <option >Grade</option>
                                <option <?= ($val1['grade'] == '10') ? 'selected' : '' ?> value="10">A1</option>
                                <option <?= ($val1['grade'] == '9') ? 'selected' : '' ?> value="9" >A2</option>
                                <option <?= ($val1['grade'] == '8') ? 'selected' : '' ?> value="8" >B1</option>
                                <option <?= ($val1['grade'] == '7') ? 'selected' : '' ?> value="7" >B2</option>
                                <option <?= ($val1['grade'] == '6') ? 'selected' : '' ?> value="6" >C1</option>
                                <option <?= ($val1['grade'] == '5') ? 'selected' : '' ?> value="5" >C2</option>
                                <option <?= ($val1['grade'] == '4') ? 'selected' : '' ?> value="4" >D</option>
                                <option <?= ($val1['grade'] == '2') ? 'selected' : '' ?> value="2" >E1</option>
                                <option <?= ($val1['grade'] == '0') ? 'selected' : '' ?> value="0" >E2</option>
                            </select>
                            <input type="hidden" class='subject_<?= $val['std_id'] ?>' id='subject_point_<?= $val['std_id'] ?>_<?= $val1['subject_id'] ?>' style="width:53px;float:left;margin-left: 5px;" value="<?= $val1['subject_point'] ?>" />

                            <input type="text"  value="<?= $val1['grade'] ?>" readonly="readonly" id='grade_point_<?= $val['std_id'] ?>_<?= $val1['subject_id'] ?>' style="width:53px;float:left;margin-left: 5px;" class='point_<?= $val['std_id'] ?>' name="grate_point[<?= $val['std_id'] ?>][<?= $val1['subject_id'] ?>]" />

                            <input type="hidden"  readonly="readonly" id='grade_point_total_<?= $val['std_id'] ?>_<?= $val1['subject_id'] ?>' style="width:53px;float:left;margin-left: 5px;" value="<?= round($val1['subject_point'] * $val1['grade'], 2) ?>" class='per_<?= $val['std_id'] ?>'  />

                        </th>
                        <?php
                    }
                }
                ?>
                <th><input type="text"  readonly="readonly" id='total_<?= $val['std_id'] ?>' value="<?= $val['grade_details'][0]['total'] ?>" name='total[<?= $val['std_id'] ?>]'/></th>
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
    <br />
    <a class="btn btn-primary" href='<?= $this->config->item('base_url') . 'internal/external_print/' . $ajax_value['batch_id'] . '/' . $ajax_value['depart_id'] . '/' . $ajax_value['group_id'] . '/' . $ajax_value['semester'] . '/' . $ajax_value['exam_id'] . '/' . $board[0]['id']; ?>'>View</a>

    <?php if ($all_grade[0]['complete_status'] == 0) { ?>

        <div class="right">
            <input type="submit" value='Submit' class="btn btn-primary" />
        </div>

        <?php
    }
}
?>
</form>
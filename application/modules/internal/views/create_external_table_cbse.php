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
        <tr><th colspan=15'>Board - <?php echo $board[0]['board_type']; ?>
                <input type="hidden" name="student_group[board_id]" value="<?php echo $board[0]['id']; ?>" />
            </th></tr>
        <tr>
            <th>Roll No</th>
            <th>Student Name</th>
            <?php
            $sum = array();
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
    if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
        $j = 1;
        $i = 0;
        foreach ($all_student as $val) {
            ?>
            <tr>
                <td>
                    <?= $val['std_id'] ?>
                    <input type="hidden" value="<?= $val['id'] ?>" name="std_id[]"  />
                </td>
                <td>
                    <?= $val['name'] ?>
                </td>
                <?php
                if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
                    foreach ($all_subject[0]['subject'] as $val1) {
                        ?>

                        <th>
                            <select id='grade_id_<?= $val['id'] ?>_<?= $val1['subject_id'] ?>'  class='grade<?= $val['id'] ?> grade_option' style="width:78px;float:left;" name="grate[<?= $val['id'] ?>][<?= $val1['subject_id'] ?>]">
                                <option >Grade</option>
                                <option value="10">A1</option>
                                <option value="9" >A2</option>
                                <option value="8" >B1</option>
                                <option value="7" >B2</option>
                                <option value="6" >C1</option>
                                <option value="5" >C2</option>
                                <option value="4" >D</option>
                                <option value="2" >E1</option>
                                <option value="0" >E2</option>
                            </select>
                            <input type="hidden" class='subject_<?= $val['id'] ?>' id='subject_point_<?= $val['id'] ?>_<?= $val1['subject_id'] ?>' style="width:53px;float:left;margin-left: 5px;" value="<?= $val1['grade_point'] ?>" />

                            <input type="text"  readonly="readonly" id='grade_point_<?= $val['id'] ?>_<?= $val1['subject_id'] ?>' style="width:53px;float:left;margin-left: 5px;" class='point_<?= $val['id'] ?>' name="grate_point[<?= $val['id'] ?>][<?= $val1['subject_id'] ?>]" />

                            <input type="hidden"  readonly="readonly" id='grade_point_total_<?= $val['id'] ?>_<?= $val1['subject_id'] ?>' style="width:53px;float:left;margin-left: 5px;" class='per_<?= $val['id'] ?>'  />
                        </th>
                        <?php
                    }
                }
                ?>
                <th><input type="text" id='total_<?= $val['id'] ?>' readonly="readonly" name='total[<?= $val['id'] ?>]'/></th>
            </tr>
            <?php
            $j++;
        }
    } else
        echo "<tr><td colspan=15'>Exam Time Table Not Created Yet..</td></tr>";
    ?>
</table>
<br />
<div class="right">
    <?php
    if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
        ?>
        <input type="submit" value='Submit' class="btn btn-primary"/>
    <?php } ?>
</div>
<br /><br />
</form>
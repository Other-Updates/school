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
            $sum1 = array();

            if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
                foreach ($all_subject[0]['subject'] as $val) {
                    ?>
                    <th colspan="<?php echo ($val['check_practical'] == 1) ? 2 : 0 ?>">
                        <?= $val['nick_name'] ?> - Theory( <?php echo $sum[] = ($val['grade_point']) ?> )
                        <input type="hidden" name="subject[]" value="<?= $val['subject_id'] ?>" />
                        <?php if ($val['check_practical'] == 1) { ?>

                            - Practical( <?php echo $sum1[] = ($val['practical_mark']) ?> )


                        <?php }
                        ?>
                    </th>

                    <?php
                }
            }
            ?>
            <th>Total - ( <?php echo round((array_sum($sum) + array_sum($sum1))) ?> )
                <input type="hidden" value="<?php echo round(array_sum($sum)) ?>" id='subject_grade_point' />
            </th>
            <th>Result</th>
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
                        <td>
                            <input type="hidden" class="pass" value="<?= $val1['pass_mark'] ?>" style="width:62px;float:left; padding:0;" readonly="" />

                            <input type="hidden" class='total_mark subject_<?= $val['id'] ?>' id='subject_point_<?= $val['id'] ?>_<?= $val1['subject_id'] ?>' style="width:53px;float:left;margin-left: 5px;" value="<?= $val1['grade_point'] ?>" />

                            <input type="text"  style="width:53px;float:left;margin-left: 5px;" class='mark point_<?= $val['id'] ?>' name="grate_point[<?= $val['id'] ?>][<?= $val1['subject_id'] ?>]" onkeypress="return isNumber(event, this)"/>

                            <input type="hidden"  readonly="readonly" id='grade_point_total_<?= $val['id'] ?>_<?= $val1['subject_id'] ?>' style="width:53px;float:left;margin-left: 5px;" class='per_<?= $val['id'] ?>'
                        </td>

                        <?php if ($val1['check_practical'] == 1) { ?>
                            <td>
                                <input type="hidden" class='total_mark' value="<?= $val1['practical_mark'] ?>"  />
                                <input type="hidden"  class="pass" value="<?= $val1['practical_pass_mark'] ?>" style="width:62px;float:left; padding:0;" readonly="" />
                                <input type="text" class="mark" name="practical_mark[<?= $val['id'] ?>][<?= $val1['subject_id'] ?>]" style="width:53px;float:left;margin-left: 5px;" onkeypress="return isNumber(event, this)"/>
                            </td>

                        <?php } ?>


                        <?php
                    }
                }
                ?>
                <td><input type="text" id='total' class="total" readonly="readonly" name='total[<?= $val['id'] ?>]'/></td>
                <td><select id='result'  class='result' style="width:62px;float:left; padding:0;" name="result[<?= $val['id'] ?>]">
                        <option value="1">Pass</option>
                        <option value="2" >Fail</option>
                    </select>
                </td>
            </tr>
            <?php
            $j++;
        }
    } else
        echo "<tr><td colspan=15'>Exam Time Table Not Created Yet..</td></tr>";
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
<br />
<div class="right">
    <?php
    if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
        ?>
        <input type="submit" value='Submit' class="btn btn-primary" id="create_result"/>
    <?php } ?>
</div>
<br /><br />
</form>
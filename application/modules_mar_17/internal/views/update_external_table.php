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
                        <?= ucwords($val['nick_name']) ?> - Theory( <?php echo $sum[] = ($val['grade_point']) ?> )
                        <input type="hidden" name="subject[]" value="<?= $val['subject_id'] ?>" />
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
                    <?php echo ucwords($val['roll_no']); ?>
                    <input type="hidden" value="<?= $val['std_id']; ?>" name="std_id[]"  />
                </td>
                <td>
                    <?php echo ucwords($val['name']); ?>
                </td>
                <?php
                if (isset($val['grade_details']) && !empty($val['grade_details'])) {
                    foreach ($val['grade_details'] as $val1) {
                        ?>
                        <td>
                            <input type="hidden" class="pass" value="<?php echo $val1['pass_mark']; ?>" style="width:62px;float:left; padding:0;"  />
                            <input type="hidden" class='total_mark' style="width:53px;float:left;margin-left: 5px;" value="<?= $val1['subject_point'] ?>" />

                            <input type="text" style="width:53px;float:left;margin-left: 5px;" class='mark <?php echo($val1['pass_mark'] > $val1['grade_point']) ? 'red' : ''; ?>' name="grate_point[<?= $val['std_id'] ?>][<?= $val1['subject_id'] ?>]"  value="<?php echo $val1['grade_point']; ?>" onkeypress="return isNumber(event, this)"/>


                        </td>

                        <?php if ($val1['practical_mark'] != '') { ?>
                            <td>
                                <input type="hidden" class='total_mark' value="<?= $val1['practical'] ?>"  />
                                <input type="hidden"  class="pass" value="<?= $val1['practical_pass_mark'] ?>" style="width:62px;float:left; padding:0;" readonly="" />
                                <input type="text" class="mark <?php echo($val1['practical_pass_mark'] > $val1['practical_mark']) ? 'red' : ''; ?>" name="practical_mark[<?= $val['std_id'] ?>][<?= $val1['subject_id'] ?>]" style="width:53px;float:left;margin-left: 5px;" value="<?= $val1['practical_mark'] ?>" onkeypress="return isNumber(event, this)"/>
                            </td>

                        <?php } ?>



                        <?php
                    }
                }
                ?>
                <td><input type="text" id='total' class="total" readonly="readonly" value="<?= $val1['total'] ?>" name='total[<?= $val['std_id'] ?>]'/></td>
                <td><select id='result'  class='result' style="width:62px;float:left; padding:0;" name="result[<?= $val['std_id'] ?>]">
                        <option <?= ($val1['result'] == '1') ? 'selected' : '' ?> value="1">Pass</option>
                        <option <?= ($val1['result'] == '2') ? 'selected' : '' ?> value="2" >Fail</option>
                    </select>
                </td>
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

<br />
<a class="btn btn-primary" href='<?= $this->config->item('base_url') . 'internal/external_print/' . $ajax_value['batch_id'] . '/' . $ajax_value['depart_id'] . '/' . $ajax_value['group_id'] . '/' . $ajax_value['semester'] ?>'>View</a>
<!--<a class="btn btn-primary" href='<?= $this->config->item('base_url') . 'internal/switch_over_students/' . $ajax_value['batch_id'] . '/' . $ajax_value['depart_id'] . '/' . $ajax_value['group_id'] . '/' . $ajax_value['semester'] ?>'>Complete</a>-->
<div class="right">
    <input type="submit" value='Submit' class="btn btn-primary" id="update_result"/>
</div>
<br /><br />
</form>
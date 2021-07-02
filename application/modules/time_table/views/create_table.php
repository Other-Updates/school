<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<link href="<?= $theme_path; ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
<br />
<table border="0" class="staff_table_sub time_table">
    <tr style="background-color: rgb(250, 250, 250);">
        <td class="tt_m">Days/Hours</td>
        <?php
        $this->load->model('time_table/time_table_model');
        $total_hours = $this->time_table_model->get_values_by_type('total_hours');
        $total_days = $this->time_table_model->get_values_by_type('total_day_order');

        for ($j = 1; $j <= $total_hours[0]['details']; $j++) {
            ?>
            <td><?= $j ?>
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <div class="input-group" style="width:100px;">
                            <input type="text" class="form-control timepicker timearray"/>
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->
                </div>
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <div class="input-group" style="width:100px;">
                            <input type="text" class="form-control timepicker timearray"/>
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->
                </div>
            </td>
            <?php
        }
        ?>
    </tr>

    <tbody>
        <?php
        for ($i = 1; $i <= $total_days[0]['details']; $i++) {
            echo "<tr><td class='tt_m'>Day" . $i . "</td>";
            for ($j = 1; $j <= $total_hours[0]['details']; $j++) {
                ?>
            <td>
                <select class="select_subject check_class">
                    <option>Select</option>
                    <?php
                    if (isset($all_subject) && !empty($all_subject))
                        foreach ($all_subject as $val) {
                            ?>
                            <option value="<?= $val['id'] ?>"><?= $val['nick_name'] ?></option>
                            <?php
                        }
                    ?>
                </select>

                <span class='select_staff'>-</span>
            </td>
            <?php
        }
        echo "</tr>";
    }
    ?>
</tbody>
</table>
<br />
<div class="right">
    <input type="button" value='Submit' class='submit_time btn btn-primary' />
    <br /><br />
</div>
<div>
    <table class="staff_table">
        <?php
        if (isset($all_subject) && !empty($all_subject)) {
            foreach ($all_subject as $val) {
                ?>
                <tr>
                    <td width="137"><?php echo $val['nick_name']; ?></td>
                    <td width="5">-</td>
                    <td class="text_bold"><?php echo ucfirst(strtolower($val['subject_name'])); ?></td></tr>
                    <?php
                }
            }
            ?>
    </table>
</div>
<script src="<?= $theme_path; ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(".timepicker").timepicker({
        showInputs: false
    });
</script>
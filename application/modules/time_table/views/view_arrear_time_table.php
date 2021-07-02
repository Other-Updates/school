<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<div id="arrear_exam">
    <?php
    if (isset($arrear_exam) && !empty($arrear_exam)) {
        $i = 0;
        ?>
        <table border="0" id='app_table' class="staff" width="100%">
            <tr>

                <th>Term</th>
                <th>Subject</th>
                <th>Date</th>
                <th>From Time</th>
                <th>To Time</th>
                <th><input type="button" value="+" class='add_row btn bg-purple btn-sm' id="dis"/></th>
            </tr>
            <?php
            foreach ($arrear_exam as $arr) {
                $i++;
                ?>
                <tr class="test<?= $i ?>">
                    <td>
                        <select class="arrear_sem check_other_class" style="width:120px">

                            <?php
                            if (isset($all_semester) && !empty($all_semester)) {
                                foreach ($all_semester as $val) {
                                    ?>
                                    <option <?= ($arr['semester_id'] == $val['id']) ? 'selected' : '' ?>   value="<?= $val['id'] ?>"><?= $val['semester'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td class="subject_list">

                        <?php
                        $this->load->model('time_table/time_table_model');
                        $data['arrear_subject'] = $this->time_table_model->get_arrear_subject($arr['depart_id'], $arr['semester_id']);
                        ?>
                        <select class="arrear_subject check_other_class" style="width:300px;">
                            <?php foreach ($data['arrear_subject'] as $val) { ?>
                                <option <?= ($arr['subject_id'] == $val['scode']) ? 'selected' : '' ?> value="<?= $val['scode'] ?>"><?= $val['scode'] . "-" . $val['subject_name'] ?></option>


                            <?php } ?>
                        </select>
                    </td>
                    <td><input type="text" class="int_date date" style="width:120px" value="<?php echo date('d-m-Y', strtotime($arr['date_of_exam'])); ?>"/></td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <div class="input-group" style="width:100px;">
                                    <input type="text" class="form-control timepicker timein" value="<?= $arr['in_time'] ?>" />
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <div class="input-group" style="width:100px;">
                                    <input type="text" class="form-control timepicker timeout" value="<?= $arr['out_time'] ?>"/>
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td></td>
                </tr>
            <?php } ?>

        </table >

        <?php
    }
    ?>


    <div id="get_arrear_table">

    </div>

    <input type="button" class="btn btn-primary " id="arrear_time_btn_update" value="Update" />
    <input type="button" class="btn btn-danger conform" id="create_new" value="Create New" />
    <a href="<?= $this->config->item('base_url') . 'time_table/print_arrear_time_table/' . $arr['depart_id'] ?>" target="_blank" class="btn btn-success">View</a> <span style="color:#F00">NOTE:Past arrear timetable will remove on CREATE NEW Button</span>


</div>

<script src="<?= $theme_path; ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
    var BASE_URL = '<?php echo $this->config->item('base_url'); ?>';
</script>
<script type="text/javascript">


    $(".timepicker").timepicker({
        showInputs: false
    });
</script>

<script type="text/javascript">// <![CDATA[
    $('.date').datetimepicker({
        lang: 'de',
        i18n: {de: {
                months: [
                    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
                ],
                dayOfWeek: ["Su.", "Mo", "Tu", "We", "Th", "Fr", "Sa."]
            }},
        timepicker: false,
        format: 'd-m-Y'
    });



</script>
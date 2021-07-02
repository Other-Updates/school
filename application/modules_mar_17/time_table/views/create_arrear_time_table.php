<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<div id="arrear_exam">


    <table border="0" id='app_table' class="staff_table_sub new_arrear_table" width="100%">
        <tr>

            <th>Term</th>
            <th>Subject</th>
            <th>Date</th>
            <th>From Time</th>
            <th>To Time</th>
            <th><input type="button" value="+" class='add_row btn bg-purple btn-sm' id="dis"/></th>
        </tr>
        <tr>

            <td>
                <select class="arrear_sem check_other_class " style="width:120px">
                    <option value="">Select</option>
                    <?php
                    if (isset($all_semester) && !empty($all_semester)) {
                        foreach ($all_semester as $val) {
                            ?>
                            <option  value="<?= $val['id'] ?>"><?= $val['semester'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
            <td class="subject_list">
                <select class="arrear_subject check_other_class" style="width:300px;">
                    <option value="">Select</option>

                </select>
            </td>
            <td><input type="text" class="int_date date" style="width:120px"/></td>
            <td>
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <div class="input-group" style="width:100px;">
                            <input type="text" class="form-control timepicker timein" />
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
                            <input type="text" class="form-control timepicker timeout"/>
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td></td>
        </tr>


    </table >

    <div id="get_arrear_table">
    </div>

    <input type="button" class="btn btn-success" id="arrear_time_btn" value="Submit" disabled="disabled" />
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
<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<!--<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/css/MonthPicker.min.css" >
<script type='text/javascript' src='<?php echo $theme_path; ?>/js/MonthPicker.min.js'></script>-->
<style>
    .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td
    {
        font-size:11px;
        padding:3px;
    }
</style>
<form method="post" action="<?= $this->config->item('base_url') . 'staff_attendence/staff_attendance_report' ?>">
    <table class="table table-bordered table-striped">
        <tr>
            <td width="10%">Month</td>
            <td width="20%"><input type="text" class='month mandatory' name="month" value=" <?php if (isset($date) && !empty($date)) echo date('m-Y', strtotime($date)); ?>" id="join_date"/></td>
            <td><input type="submit" value="View" class="btn btn-info" /></td>
            <td><span class="pull-right">View Month : <strong>
                        <?php if (isset($date) && !empty($date)) echo date('M-Y', strtotime($date)); ?>
                    </strong>&nbsp;&nbsp;&nbsp;</span>
            </td>
        </tr>
    </table>
    <br />

</form>
<?php
//echo $date;
//print_r($report);
if (isset($report) && !empty($report)) {
    ?>

    <table class="table table-bordered table-striped dataTable">
        <thead>
            <tr>
                <th>Staff ID</th>
                <th>Staff Name</th>
                <?php
                foreach ($all_days as $days) {
                    ?>
                    <th><?= date('d', strtotime($days)) ?></th>
                    <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($report as $val) {
                ?>
                <tr>
                    <td><?= $val['staff_id'] ?></td>
                    <td><?= ucfirst($val['staff_name']) ?></td>
                    <?php
                    foreach ($val['month_list'] as $key => $l_val) {
                        ?>
                        <td>
                            <?php
                            $in_time = 0;
                            if (isset($l_val['in_time'][0]['time']) && !empty($l_val['in_time'][0]['time'])) {
                                $in_time = $l_val['in_time'][0]['time'];
                            }
                            $out_time = 0;
                            $set = 0;
                            if (isset($l_val['out_time'][0]['time']) && !empty($l_val['out_time'][0]['time'])) {
                                $out_time = $l_val['out_time'][0]['time'];
                                if ($out_time == $in_time) {
                                    $set = 1;
                                }
                            }
                            $ii = 0;
                            if ($set == 0 && $out_time != '' && $in_time != '') {
                                $ii = 1;
                                $date_1 = $in_time;
                                $date_2 = $out_time;
                                $datetime1 = date_create($date_1);
                                $datetime2 = date_create($date_2);
                                $interval = date_diff($datetime1, $datetime2);
                                echo '<b>' . $interval->format('%h:%i') . '</b>';
                            } else
                                echo '<span style="color:red">Ab</span>';
                            ?>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>
<script>

    $('.add_time').live('click', function () {
        var this_val = $(this);
        var in_t = $(this).closest('tr').find('.in_time').val();
        var out_t = $(this).closest('tr').find('.out_time').val();
        var id = $(this).closest('tr').find('.staff_id').val();
        var card_no = $(this).closest('tr').find('.access_card_no').val();
        var date = $('#st_date').val();
        var formate_date = $('#formate_date').val();
        var diff_time = $(this).closest('tr').find('.diff_time');
        var in_div = $(this).closest('tr').find('.in_div');
        var out_div = $(this).closest('tr').find('.out_div');
        if (in_t != '' && out_t != '')
        {
            $.ajax({
                url: BASE_URL + "staff_attendence/update_staff_attendance",
                type: 'GET',
                data: {
                    in_time: date + ' ' + in_t,
                    out_time: date + ' ' + out_t,
                    staff_id: id,
                    access_card_no: card_no,
                    st_date: date,
                },
                success: function (result) {
                    diff_time.html(result);
                    in_div.html(formate_date + ' ' + in_t);
                    out_div.html(formate_date + ' ' + out_t);
                    this_val.css('display', 'none');
                }
            });
        }
    });

    $('.month').datetimepicker({
        lang: 'de',
        i18n: {de: {
                months: [
                    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
                ],
                dayOfWeek: ["Su.", "Mo", "Tu", "We", "Th", "Fr", "Sa."]
            }},
        timepicker: false,
        format: 'm-Y',
        onClose: function (dateText) {
            $('.month').val(dateText.getMonth() + 1);
            month = dateText.getMonth() + 1;
            year = dateText.getFullYear();
            month = (month < 10) ? ('0' + month) : month;
            $('input[name="month"]').val(month + '-' + year);
        },
        onChangeMonth: function (dateText) {
            $('.month').val(dateText.getMonth() + 1);
            month = dateText.getMonth() + 1;
            year = dateText.getFullYear();
            month = (month < 10) ? ('0' + month) : month;
            $('input[name="month"]').val(month + '-' + year);
        }
    });
    $(".month").focus(function () {
        $(".xdsoft_calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });

</script>

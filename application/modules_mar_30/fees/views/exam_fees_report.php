<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<div id='bill_method'>


</div>
<div id='semester_fees'>
    <input type="hidden" id='bill_type' value="1" />
    <table width="100%" border="0" class="print_use1">
        <tr>
            <td width="200">Academic Year</td>
            <td>&nbsp;</td>
            <td><select id='batch' >
                    <option value="">Select</option>
                    <?php
                    if (isset($all_batch) && !empty($all_batch)) {
                        foreach ($all_batch as $val) {
                            ?>
                            <option value="<?= $val['id'] ?>"><?= $val['from']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td>Class</td>
            <td>&nbsp;</td>
            <td><div id='depart_div'>
                    <select id='depart' >
                        <option value="">Select</option>

                    </select>
                </div></td>
        </tr>
        <tr>
            <td>Section</td>
            <td>&nbsp;</td>
            <td><div id='group_div'>
                    <select id='group' >
                        <option value="">Select</option>

                    </select>
                </div></td>
        </tr>
        <tr>
            <td><span id='sem_label' >Term</span></td>
            <td></td>
            <td><div id='sem_div'>
                    <select id='semester'>
                        <option value="">Select</option>

                    </select>
                </div></td>
        </tr>
    </table>
    <div id='bill_div'>
    </div>
    <div id='search_option' class="print_admin_use">
        <table class="print_admin_use">
            <tr>
                <td width="221">Student Type</td>
                <td>
                    <select id='student_type'>
                        <option value="3">All</option>
                        <option value="1">Management</option>
                        <option value="2">Counselling</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Payment Status
                </td>
                <td>
                    <select id='payment_status'>
                        <option value="3">All</option>
                        <option value="1">Paid</option>
                        <option value="2">Pending</option>
                    </select>
                </td>
            </tr>
            <td>&nbsp;</td>
            <td>
                <input type="button" class='btn btn-warning' value="Send Alert" id='send_alert'/>
            </td>
            </tr>
        </table>
    </div>
    <div id='student_list'>
    </div>
</div>
<script type="text/javascript">

    $('#bill_type').live('change', function () {
        if ($(this).val() == 1)
        {
            $('#semester_fees').show();
        } else if ($(this).val() == 2)
        {
            $('#semester_fees').show();
            $('#sem_label,#sem_div').hide();
        }
    });
    $('#batch').live('change', function () {
        $.ajax({
            url: BASE_URL + "fees/get_department_by_batch",
            type: 'POST',
            data: {
                batch_id: $(this).val(),
            },
            success: function (result) {
                $('#depart_div').html(result);
                $('#semester').children('option:not(:first)').remove();
                $('#all_bill').children('option:not(:first)').remove();
                $('#group').children('option:not(:first)').remove();
            }
        });
    });
    $('#group').live('change', function () {
        if ($('#bill_type').val() == 1)
        {
            $.ajax({
                url: BASE_URL + "fees/get_sem_by_depart",
                type: 'POST',
                data: {
                    depart_id: $('#depart').val(),
                },
                success: function (result) {
                    $('#sem_div').html(result);
                    $('#all_bill').children('option:not(:first)').remove();
                }
            });
        } else if ($('#bill_type').val() == 2)
        {
            $.ajax({
                url: BASE_URL + "fees/get_all_fees_name",
                type: 'POST',
                data: {
                    billing_type: 'hostel'
                },
                success: function (result) {
                    $('#bill_div').html(result);
                }
            });
        }

    });
    $('#semester').live('change', function () {
        $.ajax({
            url: BASE_URL + "fees/get_all_fees_name",
            type: 'POST',
            data: {
                batch_id: $('#batch').val(),
                depart_id: $('#depart').val(),
                semester_id: $(this).val(),
            },
            success: function (result) {
                $('#bill_div').html(result);
            }
        });
    });

    $('#depart').live('change', function () {
        $.ajax({
            url: BASE_URL + "fees/get_all_group",
            type: 'POST',
            data: {
                depart_id: $('#depart').val()
            },
            success: function (result) {
                $('#group_div').html(result);
                $('#semester').children('option:not(:first)').remove();
                $('#all_bill').children('option:not(:first)').remove();
            }
        });
    });
    $('#search_option').hide();
    $('#all_bill').live('change', function () {
        if ($('#bill_type').val() == 1)
        {
            if ($('#all_bill').val() != '')
            {
                $('#search_option').show();
                for_loading('Loading... Data Receiving '); // loading notification
                $.ajax({
                    url: BASE_URL + "fees/get_all_student",
                    type: 'POST',
                    data: {
                        batch_id: $('#batch').val(),
                        depart_id: $('#depart').val(),
                        group_id: $('#group').val(),
                        semester_id: $('semester').val(),
                        fees_id: $(this).val(),
                        student_type: $('#student_type').val(),
                        payment_status: $('#payment_status').val()
                    },
                    success: function (result) {
                        $('#student_list').html(result);
                        for_response('Successfully Recevied...!'); // resutl notification
                    }
                });
            }
        } else
        {
            $.ajax({
                url: BASE_URL + "fees/get_all_student_for_hostel",
                type: 'POST',
                data: {
                    batch_id: $('#batch').val(),
                    depart_id: $('#depart').val(),
                    group_id: $('#group').val(),
                    semester_id: $('semester').val(),
                    fees_id: $(this).val(),
                },
                success: function (result) {
                    $('#student_list').html(result);
                }
            });
        }
    });
    $('#student_type').live('change', function () {
        $('#search_option').show();
        for_loading('Loading... Data Receiving '); // loading notification
        $.ajax({
            url: BASE_URL + "fees/get_all_student",
            type: 'POST',
            data: {
                batch_id: $('#batch').val(),
                depart_id: $('#depart').val(),
                group_id: $('#group').val(),
                semester_id: $('semester').val(),
                fees_id: $('#all_bill').val(),
                student_type: $(this).val(),
                payment_status: $('#payment_status').val()
            },
            success: function (result) {
                $('#student_list').html(result);
                for_response('Successfully Recevied...!'); // resutl notification
            }
        });
    });
    $('#send_alert').hide();
    $('#payment_status').live('change', function () {
        if ($(this).val() == 2)
            $('#send_alert').show();
        else
            $('#send_alert').hide();

        $('#search_option').show();
        for_loading('Loading... Data Receiving '); // loading notification
        $.ajax({
            url: BASE_URL + "fees/get_all_student",
            type: 'POST',
            data: {
                batch_id: $('#batch').val(),
                depart_id: $('#depart').val(),
                group_id: $('#group').val(),
                semester_id: $('semester').val(),
                fees_id: $('#all_bill').val(),
                student_type: $('#student_type').val(),
                payment_status: $(this).val()
            },
            success: function (result) {
                $('#student_list').html(result);
                for_response('Successfully Recevied...!'); // resutl notification
            }
        });
    });
</script>
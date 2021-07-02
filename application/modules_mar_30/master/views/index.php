<div id="view_all" class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Staffs</a></li>
        <li ><a href="#tab_2" data-toggle="tab">Admin</a></li>
    </ul>
    <br />
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="row">
                <div class="col-lg-4">
                    <table width="100%" border="0" class="form_table">
                        <tr>
                            <td width="100">Class</td>
                            <td>
                                <select id='depart_id' name='staff_master[depart_id]'>
                                    <option value="0">Select</option>
                                    <?php
                                    if (isset($all_depart) && !empty($all_depart)) {
                                        foreach ($all_depart as $val) {
                                            ?>
                                            <option value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>

                        </tr>
                    </table>

                </div>
                <div class="col-lg-4">
                    <table width="100%" border="0" class="form_table">
                        <tr>
                            <td width="100">Staff</td>
                            <td>
                                <div id='g_td'>

                                    <select id='group_id' name='staff_master[group_id]'>
                                        <option value="0">Select</option>
                                    </select>
                                </div>

                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br />
            <!--<table width="100%" border="0" class="form_table">
              <tr>
                <td width="100">Class:</td>
                <td width="1">&nbsp;</td>
                <td>
                <select id='depart_id' name='staff_master[depart_id]'>
                    <option value="0">Select</option>
            <?php
            if (isset($all_depart) && !empty($all_depart)) {
                foreach ($all_depart as $val) {
                    ?>
                                                    <option value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                    <?php
                }
            }
            ?>
                </select>
                </td>
                <td width="50">Staff:</td>
                <td width="1">&nbsp;</td>
                <td>
                <div id='g_td'>

                <select id='group_id' name='staff_master[group_id]'>
                    <option value="0">Select</option>
                </select>
                </div>

                </td>
              </tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
              <tr>
              </tr>
            </table>-->

            <div id='staff_matser'>
                <table  class="table">
                    <thead>
                        <tr>
                            <td width="95%"><strong>Modules</strong></td><td><input type="checkbox" id='staff_check' title="Select All"></td>
                        </tr>
                    </thead>

                    <tr>
                        <td>Add Student</td><td><input type="checkbox" class="staff_check" name='staff_master[add_student]'></td>
                    </tr>
                    <tr>
                        <td>Event</td><td><input type="checkbox" class="staff_check" name='staff_master[event]'></td>
                    </tr>
                    <tr>
                        <td>Time Table</td><td><input type="checkbox" class="staff_check" name='staff_master[time_table]'></td>
                    </tr>
                    <tr>
                        <td>Internal Mark And syllabus</td><td><input type="checkbox" class="staff_check" name='staff_master[internal_mark]'></td>
                    </tr>
                    <tr>
                        <td>Assignment</td><td><input type="checkbox" class="staff_check" name='staff_master[assignment]'></td>
                    </tr>
                    <tr>
                        <td>Attendance</td><td><input type="checkbox" class="staff_check" name='staff_master[attendance]'></td>
                    </tr>
                    <tr>
                        <td>Sharing Note</td><td><input type="checkbox" class="staff_check" name='staff_master[sharing_note]'></td>
                    </tr>
                    <tr>
                        <td>Fee Details</td><td><input type="checkbox" class="staff_check" name='staff_master[fee_details]'></td>
                    </tr>
                    <tr>
                        <td>Library</td><td><input type="checkbox" class="staff_check" name='staff_master[library]'></td>
                    </tr>
                    <tr>
                        <td>Transport</td><td><input type="checkbox" class="staff_check" name='staff_master[transport]'></td>
                    </tr>
                    <tr>
                        <td>Chat</td><td><input type="checkbox" class="staff_check" name='staff_master[chat]'></td>
                    </tr>
                    <tr>
                        <td>Add Subject</td><td><input type="checkbox" class="staff_check" name='staff_master[subject]'></td>
                    </tr>
                </table>
            </div>

            <div class="right">
                <input type="button" id='staff_master_btn' value="Submit" class="btn btn-primary"/>
            </div><br /><br />
        </div>
        <div class="tab-pane" id="tab_2">
            <table class="form_table">
                <tr>
                    <td width="100">Select Master</td>
                    <td>
                        <select id='admin_id' name='admin_master[admin_id]'>
                            <option value="0">Select</option>
                            <?php
                            if (isset($all_admin) && !empty($all_admin)) {
                                foreach ($all_admin as $val) {
                                    ?>
                                    <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <br />
            <div id='admin_matser'>
                <table class="table">
                    <thead>
                        <tr>
                            <td width="95%"><strong>Modules</strong></td><td><input type="checkbox" id='admin_check' title="Select All"></td>
                        </tr>
                    </thead>
                    <tr>
                        <td>Add Student</td><td><input type="checkbox" class="admin_check" name='admin_master[add_student]'></td>
                    </tr>
                    <tr>
                        <td>Event</td><td><input type="checkbox" class="admin_check" name='admin_master[event]'></td>
                    </tr>
                    <tr>
                        <td>Time Table</td><td><input type="checkbox" class="admin_check" name='admin_master[time_table]'></td>
                    </tr>
                    <tr>
                        <td>Internal Mark</td><td><input type="checkbox" class="admin_check" name='admin_master[internal_mark]'></td>
                    </tr>
                    <tr>
                        <td>Assignment</td><td><input type="checkbox" class="admin_check" name='admin_master[assignment]'></td>
                    </tr>
                    <tr>
                        <td>Attendance</td><td><input type="checkbox" class="admin_check" name='admin_master[attendance]'></td>
                    </tr>
                    <tr>
                        <td>Sharing Note</td><td><input type="checkbox" class="admin_check" name='admin_master[sharing_note]'></td>
                    </tr>
                    <tr>
                        <td>Fee Details</td><td><input type="checkbox" class="admin_check" name='admin_master[fee_details]'></td>
                    </tr>
                    <tr>
                        <td>Library</td><td><input type="checkbox" class="admin_check" name='admin_master[library]'></td>
                    </tr>
                    <tr>
                        <td>Transport</td><td><input type="checkbox" class="admin_check" name='admin_master[transport]'></td>
                    </tr>
                    <tr>
                        <td>Chat</td><td><input type="checkbox" class="admin_check" name='admin_master[chat]'></td>
                    </tr>
                    <tr>
                        <td>Add Subject</td><td><input type="checkbox" class="admin_check" name='admin_master[subject]'></td>
                    </tr>
                </table>
            </div>

            <div class="right">
                <input type="button" id='admin_master_btn'  value="Submit" class="btn btn-primary"/>
            </div>
            <br /><br />
        </div>
    </div>

</div><!-- /.tab-pane -->

<script type="text/javascript">
    $(document).ready(function () {
        $("#depart_id").focus();
        $('#staff_check').live('click', function (e) {
            var chk = $(this).attr('checked') ? true : false;
            //alert($(e.target));
            $('.staff_check').attr('checked', chk);
        });
        $('#admin_check').live('click', function (e) {
            var chk = $(this).attr('checked') ? true : false;
            //alert($(e.target));
            $('.admin_check').attr('checked', chk);
        });
    });
    $('#depart_id').live('change', function () {
        d_id = $(this);
        $.ajax({
            url: BASE_URL + "master/get_all_staff",
            type: 'POST',
            data: {
                depart_id: d_id.val()

            },
            success: function (result) {
                $('#g_td').html(result);
                $("#staff_id").focus();
            }
        });
    });
    $('#staff_master_btn').hide();
    $('#staff_id').live('change', function () {
        if ($(this).val() != 0)
        {
            $('#staff_master_btn').show();
            d_id = $(this).val();
            $.ajax({
                url: BASE_URL + "master/get_staff_master/",
                type: 'POST',
                data: {
                    staff_id: d_id

                },
                success: function (result) {
                    $('#staff_matser').html(result);
                }
            });
        } else
            $('#staff_master_btn').hide();
    });
    $('#admin_master_btn').hide();
    $('#admin_id').live('change', function () {
        if ($(this).val() != 0)
        {
            $('#admin_master_btn').show();
            d_id = $(this).val();
            $.ajax({
                url: BASE_URL + "master/get_admin_master/",
                type: 'POST',
                data: {
                    staff_id: d_id

                },
                success: function (result) {
                    $('#admin_matser').html(result);
                }
            });
        } else
            $('#admin_master_btn').hide();
    });
    $('#staff_master_btn').live('click', function () {
        for_loading('Loading... Staff Right Updateing'); // loading notification
        var staff_arr = Array();
        staff_arr[0] = $('#depart_id').val();
        staff_arr[1] = $('#staff_id').val();
        i = 2;
        $('.staff_check').each(function () {
            staff_arr[i] = $(this).attr('checked') ? 1 : 0;
            i++;
        });
        //alert(staff_arr);
        $.ajax({
            url: BASE_URL + "master/add_staff_master",
            type: 'post',
            data: {
                staff_info: staff_arr

            },
            success: function (result) {
                //$('#g_td').html(result);
                for_response('Staff Right Updated Successfully...!'); // resutl notification
            }
        });
        $('.staff_check').each(function () {
            $(this).removeAttr('checked');
        });
        $('#staff_check').removeAttr('checked');
        $('#staff_id').val('')
        $('#depart_id').val('');
    });
    $('#admin_master_btn').live('click', function () {
        var admin_arr = Array();
        admin_arr[1] = $('#admin_id').val();
        j = 2;
        $('.admin_check').each(function () {
            admin_arr[j] = $(this).attr('checked') ? 1 : 0;
            j++;
        });

        for_loading('Loading... Staff Right Updateing'); // loading notification
        $.ajax({
            url: BASE_URL + "master/add_admin_master",
            type: 'POST',
            data: {
                admin_info: admin_arr

            },
            success: function (result) {
                //$('#g_td').html(result);
                for_response('Admin Right Updated Successfully...!'); // resutl notification
            }
        });
        $('.admin_check').each(function () {
            $(this).removeAttr('checked');
        });
        $('#admin_check').removeAttr('checked');
        $('#admin_id').val('')
        /*$('#depart_id').val('');*/
    });
</script>
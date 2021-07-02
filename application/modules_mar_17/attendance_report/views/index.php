<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<script type="text/javascript">
//    $("#batch_id").live('change', function ()
//    {
//        $('select[name=sem_id] option[value=0]').attr('selected', 'selected');
//        $('select[name=dept_id] option[value=0]').attr('selected', 'selected');
//        $('select[name=group_id] option[value=0]').attr('selected', 'selected');
//        $('select[name=subj_id] option[value=0]').attr('selected', 'selected');
//        $("#fm_date").val('');
//        $("#to_date").val('');
//        $('#sem_id').prop('disabled', true);
//        $('#dept_id').prop('disabled', true);
//        $('#group_id').prop('disabled', true);
//        $("#fm_date").prop('disabled', true);
//        $("#to_date").prop('disabled', true);
//        $("#go_btn").prop('disabled', true);
//        $("#subj_id").prop('disabled', true);
//
//        $("#ate_res").html('');
//        if ($("#batch_id").val() != '0')
//        {
//            $('#sem_id').prop('disabled', false);
//
//        } else
//        {
//            $('select[name=sem_id] option[value=0]').attr('selected', 'selected');
//            $('select[name=dept_id] option[value=0]').attr('selected', 'selected');
//            $('select[name=group_id] option[value=0]').attr('selected', 'selected');
//            $("#fm_date").val('');
//            $("#to_date").val('');
//            $('#sem_id').prop('disabled', true);
//            $('#dept_id').prop('disabled', true);
//            $('#group_id').prop('disabled', true);
//            $("#fm_date").prop('disabled', true);
//            $("#to_date").prop('disabled', true);
//            $("#go_btn").prop('disabled', true);
//
//        }
//
//    });
//
//    $("#sem_id").live('change', function ()
//    {
//        $('select[name=dept_id] option[value=0]').attr('selected', 'selected');
//        $('select[name=group_id] option[value=0]').attr('selected', 'selected');
//
//        $("#fm_date").val('');
//        $("#to_date").val('');
//
//        $('#dept_id').prop('disabled', true);
//        $('#group_id').prop('disabled', true);
//        $("#fm_date").prop('disabled', true);
//        $("#to_date").prop('disabled', true);
//        $("#go_btn").prop('disabled', true);
//
//        $("#ate_res").html('');
//        if ($("#sem_id").val() != '0')
//        {
//            $('#dept_id').prop('disabled', false);
//        } else
//        {
//            $('select[name=dept_id] option[value=0]').attr('selected', 'selected');
//            $('select[name=group_id] option[value=0]').attr('selected', 'selected');
//
//            $("#fm_date").val('');
//            $("#to_date").val('');
//
//            $('#dept_id').prop('disabled', true);
//            $('#group_id').prop('disabled', true);
//            $("#fm_date").prop('disabled', true);
//            $("#to_date").prop('disabled', true);
//            $("#go_btn").prop('disabled', true);
//        }
//
//    });

    $("#group_id").live('change', function ()
    {
        $("#ate_res").html('');

        if ($("#group_id").val() != '0')
        {

            $('#dat_e').prop('disabled', false);
            $("#fm_date").prop('disabled', false);
            $("#to_date").prop('disabled', false);

            var batch_id = $("#batch_id").val();
            var sem_id = $("#sem_id").val();
            var dept_id = $("#dept_id").val();
            var group_id = $("#group_id").val();

            $.ajax({
                url: BASE_URL + "attendance_report/get_subj",
                type: 'POST',
                data: {batch_id: batch_id, dept_id: dept_id, sem_id: sem_id, group_id: group_id},
                success: function (result) {
                    $("#sub_res").html(result);

                    $('#subj_id').prop('disabled', false);

                }

            });
        } else
        {
            $("#fm_date").val('');
            $("#to_date").val('');

            $('#subj_id').prop('disabled', true);
            $("#fm_date").prop('disabled', true);
            $("#to_date").prop('disabled', true);
            $("#go_btn").prop('disabled', true);

        }

    });
    $("#subj_id").live('change', function ()
    {

    });
    $("#fm_date").live('blur', function ()
    {
        $("#ate_res").html('');
        if ($("#fm_date").val() != '')
        {
            $("#to_date").prop('disabled', false);

        } else
        {
            $("#go_btn").prop('disabled', true);
        }
    });


    $("#to_date").live('blur', function ()
    {
        $("#ate_res").html('');
        if ($("#fm_date").val() != '')
        {
            $("#go_btn").prop('disabled', false);
        } else
        {
            $("#go_btn").prop('disabled', true);
        }
    });

</script>

<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#group_id").focus(); // THIS IS FOR FOCCUSSING THE FIRST ELEMENT WHEN LOADING THE PAGE
        $("#dept_id").change(function ()
        {
            $("#res").html('<img src="<?= $theme_path; ?>/img/ajax_loader/s_loader_gr.gif" />'); // THIS IS FOR ASSIGNING THE LOADING IMAGE

            //$('#res').html('') //this is for clear the response dive

            var dept_id = $("#dept_id").val();
            if (dept_id == '0')
            {
                $("#res").html('<img src="<?= $theme_path; ?>/img/ajax_loader/s_loader_gr.gif" />'); // THIS IS FOR ASSIGNING THE LOADING IMAGE
                $("#res").html($("#stat_group").html());
            } else
            {
                //alert(staff_id);
                $.ajax({
                    url: BASE_URL + "student/get_all_group_attend",
                    type: 'post',
                    data: {depart_id: dept_id},
                    success: function (result) {
                        $("#res").html(result);
                        $('#group_id').focus();
                    }

                });

            }
        });

    });


</script>

<script type="text/javascript">

    $("#go_btn").live('click', function ()
    {
        for_loading('Loading... Please Be Patient'); // loading notification

        $('#ate_res').html('');
        //this is for clear the response dive
        var batch_id = $("#batch_id").val();
        var sem_id = $("#sem_id").val();
        var dept_id = $("#dept_id").val();
        var group_id = $("#group_id").val();
        var subj_id = $("#subj_id").val();
        var fm_date = $("#fm_date").val();
        var to_date = $("#to_date").val();


        //alert(staff_id);
        $.ajax({
            url: BASE_URL + "attendance_report/get_sutent_prs_list",
            type: 'POST',
            data: {batch_id: batch_id, dept_id: dept_id, sem_id: sem_id, group_id: group_id, subj_id: subj_id, fm_date: fm_date, to_date: to_date},
            success: function (result) {
                for_response('Content Loaded Successfully...!'); // resutl notification
                $("#ate_res").html(result);
                var tot_hrs = $("#tot_hours").val();
                for (var i = 1; i <= tot_hrs; i++)
                {
                    var v = $('.pres_' + i + ':checked').length;
                    var v = (v == 0) ? '' : v;
                    $('#pres_strth' + i).html(v);

                }
                //$("#repo_bt").prop('disabled',false);

            }

        });
    });


    $("#rep_id").live('change', function ()
    {
        if ($(this).val() != 0) {
            $("#repo_bt").prop('disabled', false);
        } else {
            $("#repo_bt").prop('disabled', true);
        }
    });

    $("#print_bt").live('click', function () // this is for print buttons
    {
        window.print();
    });

    $("#repo_bt").live('click', function ()
    {
        var batch_id = $("#batch_id").val();
        var sem_id = $("#sem_id").val();
        var dept_id = $("#dept_id").val();
        var group_id = $("#group_id").val();
        var subj_id = $("#subj_id").val();
        var fm_date = $("#fm_date").val();
        var to_date = $("#to_date").val();
        var rep_id = $("#rep_id").val();
        window.open(BASE_URL + "attendance_report/get_sutent_prs_list_report?batch_id=" + batch_id + "&sem_id=" + sem_id + "&dept_id=" + dept_id + "&group_id=" + group_id + "&subj_id=" + subj_id + "&fm_date=" + fm_date + "&to_date=" + to_date + "&rep_id=" + rep_id, '_blank');


    });
</script>

<script>

    $('.saves').live('click ', function () {

        for_loading('Loading... Please Be Patient'); // loading notification

        var batch_id = $('#batch_id').val();
        var sem_id = $('#sem_id').val();
        var dept_id = $('#dept_id').val();
        var group_id = $('#group _id').val();
        var dat_e = $('# dat_e').val();

        var ids = $(this).attr("id");
        var ids_arr = ids.split('_');
        var clm = ids_arr[1];
        var staff_id = $('#staff_' + clm).val();
        var subject_id = $('#subject_' + clm).val();
        var tot_strth = $('#tot_strth' + clm).html();
        var pres_strth = $('#pres_strth' + clm).html();
        var attend_arr = Array();
        i = 0;
        $('.pres_' + clm).each(function () {
            if ($(this).attr('checked'))
            {
                attend_arr[i] = $(this).val();
                i++;
            }
        });
        //alert(attend_arr.toString())

        $.ajax({
            url: BASE_URL + "attendence/insert_attend",
            type: 'POST',
            data: {batch_id: batch_id, sem_id: sem_id, dept_id: dept_id, group_id: group_id, dat_e: dat_e, hour_no: clm, staff_id: staff_id, subject_id: subject_id, tot_strth: tot_strth, pres_strth: pres_strth, attend_arr: attend_arr},
            success: function (result) {
                if (result == 1)
                {
                    for_response('Added Successfully...!'); // resutl notification

                    $('#saves_' + clm).prop('disabled', true);
                } else
                {
                    for_response('Oops... Sorry Could Not Add...!'); // resutl notification

                    $('#saves_' + clm).prop('disabled', true);
                }

            }
        });

    });
</script>
<!--<div class="loading_img" style="display:none">
<div class="overlay dark"></div>
<div class="loading-img"></div>
</div>-->

<input name="aja_res_flg" id="aja_res_flg" type="hidden" value="0" /><!--THIS IS FOR ASSIGNING THE RESULT WHEN THE AJAX RETURN-->

<table class="staff_table_sub attendence_style print_use">

    <tr>
<!--        <td width="35">Batch</td>
        <td width="119">
        <?php if (isset($all_batch) && !empty($all_batch)) { ?>
                                    <select name="batch_id" id="batch_id" >
                                        <option value="0">Select</option>
            <?php foreach ($all_batch as $vls) { ?>
                                                                <option value="<?= $vls['id'] ?>"><?= $vls['from'] ?> - <?= $vls['to'] ?></option>
            <?php } ?>
                                    </select>
            <?php
        } else {
            echo "Oops! Please Add Batches";
        }
        ?>
        </td>
        <td width="56">Term</td>
        <td width="119">
        <?php if (isset($sem_list) && !empty($sem_list)) { ?>
                                    <select name="sem_id" id="sem_id" disabled="disabled">
                                        <option value="0">Select</option>
            <?php foreach ($sem_list as $vls) { ?>
                                                                <option value="<?= $vls['id'] ?>"><?= $vls['semester'] ?></option>
            <?php } ?>
                                    </select>
            <?php
        } else {
            echo "Oops! Please Add Term";
        }
        ?>
        </td>-->
    <input type="hidden" id="batch_id" value="<?php echo $batch[0]['id'] ?>" />
    <input type="hidden" id="sem_id" value="<?php echo $term[0]['id'] ?>" />

    <td width="71">Class</td>
    <td width="119">
        <?php if (isset($all_depart) && !empty($all_depart)) { ?>
            <select name="dept_id" id="dept_id" >
                <option value="0">Select</option>
                <?php foreach ($all_depart as $vls) { ?>
                    <option value="<?= $vls['id'] ?>"><?= $vls['department'] ?></option>
                <?php } ?>
            </select>
            <?php
        } else {
            echo "Oops! Please Add Class";
        }
        ?>
    </td>
    <td width="39">Section</td>
    <td width="74">
        <div id="stat_group" style="display:none"><!--this is for ajax returns empty-->
            <select name="grp_id" id="grp_id" disabled="disabled">
                <option value="0">Select</option>
            </select>
        </div>
        <div id="res">
            <select name="group_id" id="group_id" disabled="disabled">
                <option value="0">Select</option>
            </select>
        </div>
    </td>

    <td width="29">Subject</td>
    <td width="94">
        <div id="sub_res">
            <select name="subj_id" id="subj_id" disabled="disabled">
                <option value="0">Select</option>
                <option value="all">All</option>
            </select>
        </div>
    </td>

    <td>From</td>
    <td><input type="text" class="date" name="fm_date" id="fm_date" style="width:100px;" readonly="readonly" disabled="disabled"/></td>
    <td>To&nbsp;</td>
    <td><input type="text" class="date" name="to_date" id="to_date" style="width:100px;" readonly="readonly" disabled="disabled"/></td>
    <td>&nbsp;</td>
    <td><button type="button" name="go_btn" id="go_btn" class="btn btn-primary" disabled="disabled">Go</button>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
</table>
<div id="ate_res" class="att_div">

</div>

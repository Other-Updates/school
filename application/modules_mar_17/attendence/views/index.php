<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<script type="text/javascript">
//    $("#batch_id").live('change', function ()
//    {
//
//        $("#ate_res").html('');
//        if ($("#batch_id").val() != '0')
//        {
//            $('#sem_id').prop('disabled', false);
//
//        } else
//        {
//
//            $('select[name=sem_id] option[value=0]').attr('selected', 'selected');
//            $('select[name=dept_id] option[value=0]').attr('selected', 'selected');
//            $('select[name=group_id] option[value=0]').attr('selected', 'selected');
//            $('select[name=dat_e] option[value=0]').attr('selected', 'selected');
//            $('#sem_id').prop('disabled', true);
//            $('#dept_id').prop('disabled', true);
//            $('#group_id').prop('disabled', true);
//            $('#dat_e').prop('disabled', true);
//            //$('select[name=day_ord] option[value=0]').attr('selected', 'selected');  $('#day_ord').prop('disabled',true);
//            $('select[name=hrs_nos] option[value=0]').attr('selected', 'selected');
//            $('#hrs_nos').prop('disabled', true);
//
//            $('#go_aja').prop('disabled', true);
//            $("#subj_id").val('');
//            $("#suj_lb").css('display', 'none');
//            $("#suj_nm").html('');
//            $("#stff_id").val('');
//            $("#stf_lb").css('display', 'none');
//            $("#stf_nm").html('');
//
//        }
//
//    });

//    $("#sem_id").live('change', function ()
//    {
//
//        $("#ate_res").html('');
//        if ($("#sem_id").val() != '0')
//        {
//            $('#dept_id').prop('disabled', false);
//        } else
//        {
//            $('select[name=dept_id] option[value=0]').attr('selected', 'selected');
//            $('select[name=group_id] option[value=0]').attr('selected', 'selected');
//            $('select[name=dat_e] option[value=0]').attr('selected', 'selected');
//            $('#dept_id').prop('disabled', true);
//            $('#group_id').prop('disabled', true);
//            $('#dat_e').prop('disabled', true);
//            //$('select[name=day_ord] option[value=0]').attr('selected', 'selected');  $('#day_ord').prop('disabled',true);
//            $('select[name=hrs_nos] option[value=0]').attr('selected', 'selected');
//            $('#hrs_nos').prop('disabled', true);
//            $('#go_aja').prop('disabled', true);
//            $("#subj_id").val('');
//            $("#suj_lb").css('display', 'none');
//            $("#suj_nm").html('');
//            $("#stff_id").val('');
//            $("#stf_lb").css('display', 'none');
//            $("#stf_nm").html('');
//        }
//
//    });

    $("#group_id").live('change', function ()
    {
        $('select[name=dat_e] option[value=0]').attr('selected', 'selected');
        $("#ate_res").html('');
        if ($("#group_id").val() != '0')
        {
            $('#dat_e').prop('disabled', false);
        } else
        {
            $('select[name=dat_e] option[value=0]').attr('selected', 'selected');
            $('#dat_e').prop('disabled', true);
            //$('select[name=day_ord] option[value=0]').attr('selected', 'selected');  $('#day_ord').prop('disabled',true);
            $('select[name=hrs_nos] option[value=0]').attr('selected', 'selected');
            $('#hrs_nos').prop('disabled', true);
            $('#go_aja').prop('disabled', true);
            $("#subj_id").val('');
            $("#suj_lb").css('display', 'none');
            $("#suj_nm").html('');
            $("#stff_id").val('');
            $("#stf_lb").css('display', 'none');
            $("#stf_nm").html('');
        }

    });

</script>

<script type="text/javascript">
    $(document).ready(function ()
    {
        $('#group_id').focus();
        // THIS IS FOR FOCCUSSING THE FIRST ELEMENT WHEN LOADING THE PAGE
        $("#dept_id").change(function ()
        {
            //$('select[name=day_ord] option[value=0]').attr('selected', 'selected');  $('#day_ord').prop('disabled',true);
            $('select[name=hrs_nos] option[value=0]').attr('selected', 'selected');
            $('#hrs_nos').prop('disabled', true);
            $('#go_aja').prop('disabled', true);
            $("#subj_id").val('');
            $("#suj_lb").css('display', 'none');
            $("#suj_nm").html('');
            $("#stff_id").val('');
            $("#stf_lb").css('display', 'none');
            $("#stf_nm").html('');

            $("#res").html('<img src="<?= $theme_path; ?>/img/ajax_loader/s_loader_gr.gif" />'); // THIS IS FOR ASSIGNING THE LOADING IMAGE

            $('#res').html('') //this is for clear the response dive

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

                    }

                });

            }
        });

    });


</script>

<script type="text/javascript">

    $("#dat_e").live('change', function ()
    {

        $('#ate_res').html('') //this is for clear the response dive

        //$('select[name=day_ord] option[value=0]').attr('selected', 'selected');  $('#day_ord').prop('disabled',true);
        $('select[name=hrs_nos] option[value=0]').attr('selected', 'selected');
        $('#hrs_nos').prop('disabled', true);
        $('#go_aja').prop('disabled', true);
        $("#subj_id").val('');
        $("#suj_lb").css('display', 'none');
        $("#suj_nm").html('');
        $("#stff_id").val('');
        $("#stf_lb").css('display', 'none');
        $("#stf_nm").html('');

        if ($("#dat_e").val() == '0')
        {
            // $('select[name=day_ord] option[value=0]').attr('selected', 'selected');  $('#day_ord').prop('disabled',true);
            $('select[name=hrs_nos] option[value=0]').attr('selected', 'selected');
            $('#hrs_nos').prop('disabled', true);

        } else
        {
            var batch_id = $('#batch_id').val();
            var sem_id = $('#sem_id').val();
            var dept_id = $('#dept_id').val();
            var group_id = $('#group_id').val();
            var dat_e = $('#dat_e').val();


            $.ajax({
                url: BASE_URL + "attendence/day_ords",
                type: 'get',
                data: {batch_id: batch_id, sem_id: sem_id, dept_id: dept_id, group_id: group_id, dat_e: dat_e},
                success: function (result) {
                    $("#day_or_res").html(result);
                    $('#day_ord').prop('disabled', false);
                    if ($('#day_ord').val() != '0') {
                        $('#hrs_nos').prop('disabled', false);
                    }
                }
            });

        }

    });
</script>

<script>
    $('#pwdbut_').live('click', function () {

        $("#res_pwd_").html('<img src="<?= $theme_path; ?>/img/ajax_loader/loader_gr.gif" />'); // THIS IS FOR ASSIGNING THE LOADING IMAGE

        var stf_id = $('#stff_id').val();
        var stf_pwd = $('#stf_pwd_val_').val();
        $.ajax({
            url: BASE_URL + "attendence/staff_pwd",
            type: 'post',
            data: {stf_id: stf_id, stf_pwd: stf_pwd},
            success: function (result) {
                if (result == 1)
                {
                    var altms = 'success';
                    $('#subject_').prop('disabled', false);
                    $('#aja_res_flg').val(1);
                    $('#clsbut_').trigger("click"); // this is for click the popup link
                } else
                {
                    var altms = 'incorrect password';
                    $('#aja_res_flg').val(0);
                }

                $("#res_pwd_").html(altms);
            }

        });

    });
</script>

<script type="text/javascript">

    $('.check_all').live('click', function () {

        var i = $(this).val();
        $('.pres_').not(this).prop('checked', this.checked);
        if ($(this).attr('checked'))
        {
            $('#pres_strth').html($('#tot_strth').html());
            $('#saves_').prop('disabled', false);
        } else
        {
            $('#pres_strth').html('');
            $('#saves_').prop('disabled', true);
        }

    });
</script>

<script type="text/javascript">

    function count_pres(check_ids)
    {
        $('#saves_').prop('disabled', false);
        var tot_pr = $('#pres_strth').html()
        if ($('#' + check_ids).attr('checked'))
        {
            tot_pr = (tot_pr == '') ? 0 : tot_pr;
            tot_pr = parseInt(tot_pr);
            var ne_per = tot_pr + 1;
            $('#pres_strth').html(ne_per)

        } else
        {
            $('#check_all_').attr('checked', false);
            tot_pr = parseInt(tot_pr);
            var ne_per = tot_pr - 1;
            ne_per = (ne_per == '0') ? '' : ne_per;
            $('#pres_strth').html(ne_per)
            if (ne_per == '') {
                $('#saves_').prop('disabled', true);
            }
        }
    }


    $('#day_ord').live('change', function () {
        $('#ate_res').html(''); //this is for clear the response dive
        $('#go_aja').prop('disabled', true);
        $("#subj_id").val('');
        $("#suj_lb").css('display', 'none');
        $("#suj_nm").html('');
        $("#stff_id").val('');
        $("#stf_lb").css('display', 'none');
        $("#stf_nm").html('');
        $('select[name=hrs_nos] option[value=0]').attr('selected', 'selected');
        $('#hrs_nos').prop('disabled', true);
        if ($(this).val() == 0)
        {
            $('#hrs_nos').prop('disabled', true);
        } else
        {
            $('#hrs_nos').prop('disabled', false);
        }
    });

    $('#hrs_nos').live('change', function () {
        $('#ate_res').html(''); //this is for clear the response dive
        if ($(this).val() == 0)
        {
            $('#go_aja').prop('disabled', true);
            $("#subj_id").val('');
            $("#suj_lb").css('display', 'none');
            $("#suj_nm").html('');
            $("#stff_id").val('');
            $("#stf_lb").css('display', 'none');
            $("#stf_nm").html('');
        } else
        {
            $('#go_aja').prop('disabled', false);
            var batch_id = $('#batch_id').val();
            var sem_id = $('#sem_id').val();
            var dept_id = $('#dept_id').val();
            var group_id = $('#group_id').val();
            var day_ord = $('#day_ord').val();
            var hrs_nos = $('#hrs_nos').val();
            $.ajax({
                url: BASE_URL + "attendence/get_subj_staff",
                type: 'POST',
                data: {batch_id: batch_id, sem_id: sem_id, dept_id: dept_id, group_id: group_id, day_ord: day_ord, hrs_nos: hrs_nos},
                success: function (result) {
                    result = result.trim()
                    if (result == 'fail')
                    {
                        alert('Sorry No Time Table Found!...');
                        $('#go_aja').prop('disabled', true);
                        $("#subj_id").val('');
                        $("#suj_lb").css('display', 'none');
                        $("#suj_nm").html('');
                        $("#stff_id").val('');
                        $("#stf_lb").css('display', 'none');
                        $("#stf_nm").html('');
                    } else
                    {
                        var res = result.split(",");
                        var subj = res[0].split("-");
                        $("#subj_id").val(subj[0]);
                        $("#suj_lb").css('display', 'block');
                        $("#suj_nm").html(subj[1]);
                        var staff = res[1].split("-");
                        $("#stff_id").val(staff[0]);
                        $("#stf_lb").css('display', 'block');
                        $("#stf_nm").html(staff[1]);
                    }
                }
            });
        }
    });
</script>

<script type="text/javascript">
    $('#go_aja').live('click', function () {
        for_loading('Loading... Please Be Patient'); // loading notification
        var batch_id = $('#batch_id').val();
        var sem_id = $('#sem_id').val();
        var dept_id = $('#dept_id').val();
        var group_id = $('#group_id').val();
        var dat_e = $("#dat_e").val();
        var day_ord = $('#day_ord').val();
        var hrs_nos = $('#hrs_nos').val();
        $.ajax({
            url: BASE_URL + "attendence/get_sutent_hurs_list",
            type: 'post',
            data: {batch_id: batch_id, sem_id: sem_id, dept_id: dept_id, group_id: group_id, dat_e: dat_e, day_ord: day_ord, hrs_nos: hrs_nos},
            success: function (result) {
                $("#ate_res").html(result);
                var tot_strth = $("#tot_strth").html();
                var v = $('.pres_:checked').length;
                var v = (v == 0) ? '' : v;
                $('#pres_strth').html(v);
                if (v == tot_strth) {
                    $('#check_all_').attr('checked', true);
                }

                for_response('Content Loaded Successfully...!'); // resutl notification
            }
        });
    });</script>

<script>

    $('#saves_').live('click', function () {

        /*$('#pwd_pop_').trigger("click"); // this is for click the popup link
         $("#res_pwd_").html(''); 	*/

        bootbox.confirm("Are you sure you want to Save this?", function (result)
        {
            if (result)
            {


                for_loading('Loading... P lease Be Patient'); // loadi ng notification


                var batch_id = $('#batch_id').val();
                var sem_id = $('#sem_id').val();
                var dept_id = $('#dept_id').val();
                var group_id = $('#group_id').val();
                var dat_e = $('#d at_e').val();
                var day_ord = $('# day_ord').val();

                var hrs_nos = $('#hrs_nos').val();
                var staff_id = $('#stff_id').val();
                var subject_id = $('#subj_id').val();
                var tot_strth = $('#tot_strth').html();
                var pres_strth = $('#pres_strth').html();
                var attend_arr = Array();
                i = 0;
                $('.pres_').each(function () {
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
                    data: {batch_id: batch_id, sem_id: sem_id, dept_id: dept_id, group_id: group_id, dat_e: dat_e, day_ord: day_ord, hour_no: hrs_nos, staff_id: staff_id, subject_id: subject_id, tot_strth: tot_strth, pres_strth: pres_strth, attend_arr: attend_arr},
                    success: function (result) {
                        if (result == 1)
                        {
                            $('#saves_').prop('disabled', true);
                            for_response('Added Successfully...!'); // resutl notification

                        } else
                        {
                            $('#saves_').prop('disabled', true);
                            for_response('Oops... Sorry Could Not Add...!'); // resutl notification
                        }

                    }
                });
            }//end of if for confirmation
        }); //end of confirmation

    });

</script>
<!--<div class="loading_img" style="display:none">
<div class="overlay dark"></div>
<div class="loading-img"></div>
</div>-->

<input name="aja_res_flg" id="aja_res_flg" type="hidden" value="0" /><!--THIS IS FOR ASSIGNING THE RESULT WHEN THE AJAX RETURN-->

<table class="staff_table_sub attendence_style">

    <tr>
    <input type="hidden" id="batch_id" value="<?php echo $batch[0]['id'] ?>" />
    <input type="hidden" id="sem_id" value="<?php echo $term[0]['id'] ?>" />
<!--        <td>Batch</td>
    <td>
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
    <td>Term</td>
    <td>
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

    <td>Class</td>
    <td>
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
    <td>Section</td>
    <td>
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

    <td>Date</td>
    <td>
        <?php
        $cur_date = $this->user_auth->get_curdate();
        ?>
        <select name="dat_e" id="dat_e" disabled="disabled">
            <option value="0">Select</option>
            <?php
            for ($i = 30; $i >= 0; $i--) {
                $newdate = strtotime('-' . $i . ' day', strtotime($cur_date));
                $newdate = date('d-m-Y', $newdate);
                ?>
                <option value="<?= $newdate ?>"><?= $newdate ?></option>
            <?php } ?>
        </select>

    </td>

    <td>Day</td>
    <td>
        <div id="day_or_res">
            <select name="day_ord" id="day_ord">
                <option value="0">Select</option>
                <?php
                $i = 1;
                while ($tot_dys[0]['details'] >= $i) {
                    ?>
                    <option value="<?= $i ?>">Day Order <?= $i ?></option>
                    <?php
                    $i++;
                }
                ?>
            </select>
        </div>
    </td>
    <td>Hours</td>
    <td><div id="hrs_res">
            <select name="hrs_nos" id="hrs_nos" >
                <option value="0">Select</option>
                <?php
                $i = 1;
                while ($tot_hrs[0]['details'] >= $i) {
                    ?>
                    <option value="<?= $i ?>">Hour <?= $i ?></option>
                    <?php
                    $i++;
                }
                ?>
            </select>
        </div></td>
    <td><span id="suj_lb" style="display:none">Subject</span>
        <input name="subj_id" id="subj_id" type="hidden" value="" />
    </td>
    <td><span id="suj_nm" style="color:green; font-weight:bold;"></span></td>
    <td><span id="stf_lb" style="display:none">Staff Name</span>
        <input name="stff_id" id="stff_id" type="hidden" value="" />
    </td>
    <td><span id="stf_nm" style="color:green; font-weight:bold;"></span></td>
    <td>&nbsp;</td>
    <td>
        <input class="saves btn btn-primary btn-sm" disabled="disabled" name="go_aja" id="go_aja" type="button" value="Go"/>
    </td>
</tr>
</table>
<div id="ate_res" class="att_div">

</div>

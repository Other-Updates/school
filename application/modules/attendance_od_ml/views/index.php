<?php
$theme_path = $this->config->item('theme_locations') . $this->config->item('active_template');
$cur_date = $this->user_auth->get_curdate();

$cur_dat_al = date('Y-m-d', strtotime($cur_date));
$get_whe = array('typ_e' => 'sem_strt_date', 'statu_s' => '1');
$sem_strt_dt = $this->db->get_where('mas_college_det', $get_whe)->result_array();
$sem_str_dat = date('Y-m-d', strtotime($sem_strt_dt[0]['details']));

$date1 = date_create($sem_str_dat);
$date2 = date_create($cur_dat_al);
$diff = date_diff($date1, $date2);

$tot_pre_days = $diff->format("%a");
?>
<script type="text/javascript">
    $(".lv_hrs").live('blur', function ()
    {
        var ids = $(this).attr("id");
        var ids_arr = ids.split('_');
        var i = ids_arr[1];

        if ($(this).val() == '')
        {
            $('#texval_' + i).html('Please Enter the Hour');
            $('#lvhrs_' + i).focus();
        } else
        {

            if ($('#lvhrs_' + i).val().length > 1)
            {
                $('#texval_' + i).html('Given Hour should be less than the Total Hour');
                $('#lvhrs_' + i).focus();
            } else
            {
                $('#texval_' + i).html('');
            }


        }
    });

    function validatenumber(evt) {
        var tot_hrs = $('#tot_hrs').val();
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);

        var regex = /^[0-9\b]+$/;    // allow only numbers [0-9]
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault)
                theEvent.preventDefault();
        } else {
            if (tot_hrs < key) {
                theEvent.returnValue = false;
            }
        }

    }


    $("#atten_lv_for").live('change', function () //THIS IS FOR GETTING THE DATE LIST FOR COLLEGE LEAVE
    {
        $("#sele_cnt").html('');
        var vl = $(this).val();

        if (vl == '0')
        {
            $("#dys_hrs").html('Days');
            $('#stud_div').css('display', 'none');
            $("#res_div").html('');
        } else if (vl == '1')
        {
            $("#dys_hrs").html('Days');
            $("#stu_nm").html('');
            for_loading('Loading... Please Be Patient'); // loading notification
            $('#stud_div').css('display', 'none');
            $.ajax({
                url: BASE_URL + "attendance_od_ml/get_date_list",
                type: 'POST',
                data: {leav_type: vl},
                success: function (result) {
                    $("#res_div").html(result);
                    for_response('Content Loaded Successfully...!');
                }
            });
        } else if (vl == '2')
        {
            $("#dys_hrs").html('Hours');
            $("#stu_nm").html('Student Name : ');
            $('#stud_div').css('display', 'block');
            $("#res_div").html('');
        }

    });


    $("#sub_vl").live('click', function () // AJAX INSERTION FOR COLLEGE LEAVE ALLOCTION FUNCTIONALITY
    {

        var cnt = 0;
        $('.sele_chk').each(function () {
            if ($(this).attr('checked')) {
                cnt++;
            }
        });
        if (cnt < 1) {
            $('#val_res').html('Please Select Atleat One Date');
            return false;
        }

        bootbox.confirm("Are you sure you want to Save this?", function (result)
        {
            if (result)
            {
                for_loading('Loading... Please Be Patient'); // loading notification

                var atten_for = $("#atten_lv_for").val();
                //alert(atten_for)
                var attend_arr = Array();

                var i = 0;

                var tot_hrs = $('#tot_hrs').val();
                var att_hrs_arry = Array();
                $('.sele_chk').each(function () {
                    if ($(this).attr('checked'))
                    {
                        attend_arr[i] = $(this).val();
                        i++;
                    }
                });

                if (atten_for == 1) // this is for college
                {
                    $.ajax({
                        url: BASE_URL + "attendance_od_ml/leave_date_inse",
                        type: 'POST',
                        data: {attend_arr: attend_arr},
                        success: function (result) { /*if(result==1){*/
                            for_response('Date Saved Successfully...!');  /*location.reload();*/ /*}else{ alert('fail'); }*/
                            $('#atten_lv_for').trigger("change");
                            $("#sele_cnt").html('');
                            $('#val_res').html('');
                        }
                    });
                } else if (atten_for == 2) // this is for student leav
                {
                    var stud_id = $("#stud_id").val();
                    var atten_id = $("#atten_id").val();
                    var lv_type_id = $("#lv_type_id").val();
                    var att_hrs_arr = Array();
                    var j = 0;
                    $('.lv_hrs').each(function () {
                        if ($(this).val() != '0')
                        {
                            att_hrs_arr[j] = $(this).val();

                            j++;
                        }
                    });


                    $.ajax({
                        url: BASE_URL + "attendance_od_ml/od_ml_hrs_inse",
                        type: 'POST',
                        data: {atten_id: atten_id, stud_id: stud_id, lv_type_id: lv_type_id, attend_arr: attend_arr},
                        success: function (result) { /*if(result==1){*/
                            for_response('Date Saved Successfully...!');  /*location.reload();*/
                            /*}else{ alert('fail'); }*/$('#date_vl').trigger("change");
                            $('#lv_type_id').trigger("change");
                            $("#sele_cnt").html('');
                        }
                    });

                }
            }//end of if for confirmation
        }); //end of confirmation
    });

    $("#lv_type_id").live('change', function ()
    {
        $("#ate_res").html('');
        if ($(this).val() != '0')
        {
            $('#date_vl').attr('disabled', false);
            var rol_no = $("#rol_no").val();
            var sem_id = $("#sem_id").val();

            $.ajax({
                url: BASE_URL + "attendance_od_ml/abs_date_list",
                type: 'POST',
                data: {sem_id: sem_id, rol_no: rol_no},
                success: function (result) {
                    $("#dat_lsit").html(result);
                    $('#date_vl').attr('disabled', false);
                }
            });

        } else if ($(this).val() == '0')
        {
            $('#res_div').html('');
            $('.sele_chk').each(function () {
                $(this).attr('checked', false);
            });
            $('select[name=date_vl] option[value=0]').attr('selected', 'selected');
            $('#date_vl').attr('disabled', true);
            $('#sele_cnt').html('');
        }
        $('#date_vl').focus();
    });

    $("#sem_id").live('change', function ()
    {
        $("#res_div").html('');

        $('select[name=lv_type_id] option[value=0]').attr('selected', 'selected');
        $('select[name=date_vl] option[value=0]').attr('selected', 'selected');
        $('#date_vl').prop('disabled', true);

        if ($("#sem_id").val() != '0')
        {
            $('#rol_no').prop('disabled', false);
            $('#lv_type_id').prop('disabled', false);
        } else
        {
            $('#res_div').html('');
            $('.sele_chk').each(function () {
                $(this).attr('checked', false);
            });

            $('#rol_no').val('');
            $('#sele_cnt').html('');
            $('select[name=lv_type_id] option[value=0]').attr('selected', 'selected');
            $('#rol_no').prop('disabled', true);
            $('#lv_type_id').prop('disabled', true);


        }
        $('#rol_no').focus();
    });

    $("#date_vl").live('change', function ()
    {

        if ($("#date_vl").val() != '0')
        {
            $('#dyn_div').css('display', 'block');

            var batch_id = $("#batch_id").val();
            var sem_id = $("#sem_id").val();
            var dept_id = $("#dept_id").val();
            var group_id = $("#group_id").val();

            var rol_no = $("#rol_no").val();
            var leav_for = $("#atten_lv_for").val();
            var date_vl = $("#date_vl").val();

            if (rol_no != '')
            {
                $.ajax({
                    url: BASE_URL + "attendance_od_ml/get_date_hrs_list",
                    type: 'POST',
                    data: {batch_id: batch_id, sem_id: sem_id, dept_id: dept_id, group_id: group_id, leav_type: leav_for, rol_no: rol_no, date_vl: date_vl},
                    success: function (result) {
                        $("#res_div").html(result);
                    }
                });
            } else
            {
                $("#res_div").html('');
                $('.sele_chk').each(function () {
                    $(this).attr('checked', false);
                });
                $('#sele_cnt').html('');

            }


        } else
        {
            $('#res_div').html('');
            $('.sele_chk').each(function () {
                $(this).attr('checked', false);
            });
            //$('select[name=lv_type_id] option[value=0]').attr('selected', 'selected');
            $('#sele_cnt').html('');

        }
    });


    $("#rol_no").live('blur', function ()
    {
        $('select[name=lv_type_id] option[value=0]').attr('selected', 'selected');
        var rol_no = $("#rol_no").val()
        if ($("#rol_no").val() != '')
        {
            $.ajax({
                url: BASE_URL + "attendance_od_ml/stud_name_by_rolno",
                type: 'POST',
                data: {rol_no: rol_no},
                success: function (result) {
                    result = result.trim();
                    if (result == 'fail') { /*alert('Sorry Wrong Roll Number..!')*/
                    } else {
                        $('#stud_nam').html(result);
                    }
                }
            });

            $('#res_div').html('');
            $('#lv_type_id').prop('disabled', false);

        } else
        {
            $('#lv_type_id').focus();
            $('#lv_type_id').prop('disabled', true);
            $('select[name=lv_type_id] option[value=0]').attr('selected', 'selected');
            $('#sele_cnt').html('');

        }
        //$('#lv_type_id').focus();
    });


    $(".sele_chk").live('click', function ()
    {
        var ids = $(this).attr("id");
        var ids_arr = ids.split('_');
        var i = ids_arr[1];

        //$('#sub_vl').prop('disabled',false);
        var tot_pr = $('#sele_cnt').html()
        if ($(this).attr('checked'))
        {
            tot_pr = (tot_pr == '') ? 0 : tot_pr;
            tot_pr = parseInt(tot_pr);
            var ne_per = tot_pr + 1;
            $('#sub_vl').prop('disabled', false);
            $('#sele_cnt').html(ne_per)
            $('#lvhrs_' + i).prop('disabled', false);
            $('#lvhrs_' + i).focus();

        } else
        {
            tot_pr = parseInt(tot_pr);
            var ne_per = tot_pr - 1;
            ne_per = (ne_per == '0') ? '' : ne_per;
            $('#sele_cnt').html(ne_per);
            if (ne_per == '') {
                $('#sub_vl').prop('disabled', true);
            } else {
                $('#sub_vl').prop('disabled', false);
            }
            //if($('#sele_cnt').val()==''){ $('#sub_vl').prop('disabled',true); }else{ $('#sub_vl').prop('disabled',false); }
            $('#lvhrs_' + i).prop('disabled', true);
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#atten_lv_for").focus(); // THIS IS FOR FOCCUSSING THE FIRST ELEMENT WHEN LOADING THE PAGE
        $("#dept_id").change(function ()
        {
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
                    type: 'POST',
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
        for_loading('Loading... Please Be Patient'); // loading notification

        $('#ate_res').html('') //this is for clear the response dive
        var batch_id = $("#batch_id").val();
        var sem_id = $("#sem_id").val();
        var dept_id = $("#dept_id").val();
        var group_id = $("#group_id").val();
        var dat_e = $("#dat_e").val();

        if (dat_e == '0')
        {

        } else
        {
            //alert(staff_id);
            $.ajax({
                url: BASE_URL + "attendence/get_sutent_hurs_list",
                type: 'post',
                data: {batch_id: batch_id, dept_id: dept_id, sem_id: sem_id, group_id: group_id, dat_e: dat_e},
                success: function (result) {
                    $("#ate_res").html(result);
                    var tot_hrs = $("#tot_hours").val();
                    for (var i = 1; i <= tot_hrs; i++)
                    {
                        var v = $('.pres_' + i + ':checked').length;
                        var v = (v == 0) ? '' : v;
                        $('#pres_strth' + i).html(v);

                    }
                    for_response('Content Loaded Successfully...!'); // resutl notification
                }

            });

        }
    });
</script>

<script type="text/javascript"> <!--THIS IS FOR CHECK AND UNCHECK THE EVERY COLOUMN STUDNETS-->
    $('.check_all').live('click', function () {
        $('.sele_chk').not(this).prop('checked', this.checked);
        var v = $('.sele_chk:checked').length;
        if (v == '0') {
            v = '';
            $('#sub_vl').prop('disabled', true);
        } else {
            v = v;
            $('#sub_vl').prop('disabled', false);
        }
        $('#sele_cnt').html(v);

    });
</script>

<?php /* ?><script type="text/javascript" src="<?=$theme_path; ?>/js/auto_com/jquery.js"></script><?php */ ?>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />

<script type="text/javascript">
    $().ready(function () {
        $("#rol_no").autocomplete("attendance_od_ml/get_sutent_list", {
            width: 260,
            matchContains: true,
            //mustMatch: true,
            //minChars: 0,
            //multiple: true,
            //highlight: false,
            //multipleSeparator: ",",
            selectFirst: false
        });
    });
    /*$('#course').live('blur',function(){
     alert($(this).val());
     });*/

</script>
<table class="staff_table" width="100%">
    <tr>
        <td width="10%">Leave For</td>
        <td width="23%" style="padding:0">
            <select name="atten_lv_for" id="atten_lv_for" >
                <option value="0">Select</option>
                <option value="1">School</option>
                <option value="2">Student</option>
            </select>
        </td>
        <td width="6%"><span id="dys_hrs">Days</span></td>
        <td width="9%" class="text_bold"><span id="sele_cnt"></span></td>
        <td width="26%"><span id="stu_nm"></span><span id="stud_nam"></span></td>
        <td width="26%"></td>
    </tr>
</table>
<!--<table width="600" border="1">
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>-->
<div id="stud_div" style="display:none">
    <table class="staff_table_sub attendence_style">

        <tr>

            <td width="56">Term</td>
            <td width="119">
                <?php if (isset($sem_list) && !empty($sem_list)) { ?>
                    <select name="sem_id" id="sem_id">
                        <option value="0">Select</option>
                        <?php foreach ($sem_list as $vls) { ?>
                            <option value="<?= $vls['id'] ?>"><?= $vls['semester'] ?></option>
                        <?php } ?>
                    </select>
                <?php } else {
                    echo "Oops! Please Add Staffs";
                } ?>
            </td>
            <td width="98">Student Roll No</td>
            <td width="100"><!--<label for="textfield"></label>-->
                <input type="text" name="rol_no" id="rol_no" autocomplete="off" disabled="disabled" style="width:100px"/></td>
            <td width="72">Leave Type</td>
            <td width="119">

                <select name="lv_type_id" id="lv_type_id" disabled="disabled">
                    <option value="0">Select</option>
                    <option value="1">OD</option>
                    <option value="2">ML</option>
                </select>

            </td>
            <td width="72">Absent Date</td>
            <td width="103">
                <div id="dat_lsit">
                    <select name="date_vl" id="date_vl" disabled="disabled">
                        <option value="0">Select</option>
                        <?php
                        for ($i = $tot_pre_days; $i >= 0; $i--) {
                            $newdate = strtotime('-' . $i . ' day', strtotime($cur_date));
                            $newdate = date('d-m-Y', $newdate);
                            $newdate_al = date('Y-m-d', strtotime($newdate));
                            ?>
                            <option value="<?= $newdate_al ?>"><?= $newdate ?></option>
<?php } ?>
                    </select>
                </div>
            </td>

        </tr>
    </table>
</div>
<div id="res_div">

</div>


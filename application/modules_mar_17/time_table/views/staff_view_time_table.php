<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<table class="form_table">
    <tr>
        <td>Type</td>
        <td>&nbsp;</td>
        <td>
            <select id='select_type' class="ajax_required" tabindex="1">
                <option value="">Select</option>
                <option value="4" id='calss_time'>Class Time Table</option>
                <!--                <option value="1" id='internal'>Internal</option>
                                <option value="2" id='external'>Model</option>-->
                <option value="3" id='exam'>Exam</option>
                <!--<option value="5" id='arrear'>Arrear Exam</option>-->
            </select>
        </td>
        <td>&nbsp;</td>
        <td id="a1">Class</td>
        <td>&nbsp;</td>
        <td>

            <select id='depart_id' name='student_group[depart_id]' class="ajax_required" tabindex="4" disabled="disabled" >
                <option value="">Select</option>
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
    <tr>
    <input type="hidden" id="select_batch" value="<?php echo $batch[0]['id'] ?>" />
    <input type="hidden" id="select_sem" value="<?php echo $term[0]['id'] ?>" />
<!--        <td id="a2">Batch</td>
        <td>&nbsp;</td>
        <td>
            <select id='select_batch'  class="ajax_required" tabindex="2" disabled="disabled" >
                <option value="">Select</option>
    <?php
    if (isset($all_batch) && !empty($all_batch)) {

        foreach ($all_batch as $val1) {
            ?>
                                                <option value="<?= $val1['id'] ?>"><?php echo $val1['from'] . '-' . $val1['to'] ?></option>
            <?php
        }
    }
    ?>
            </select>
        </td>
        <td>&nbsp;</td>-->
    <td id="a3">Section</td>
    <td>&nbsp;</td>
    <td id='g_td'>
        <select id='group_id' name='student_group[group_id]'  class="ajax_required" tabindex="5" disabled="disabled" >
            <option value="0">Select</option>
        </select>
    </td>

<!--        <td id="a4">Term</td>
        <td>&nbsp;</td>
        <td>
            <select id='select_sem'  class="ajax_required" tabindex="3" disabled="disabled" >
                <option value="">Select</option>
    <?php
    if (isset($all_semester) && !empty($all_semester)) {

        foreach ($all_semester as $val1) {
            ?>
                                                <option value="<?= $val1['id'] ?>"><?php echo $val1['semester'] ?></option>
            <?php
        }
    }
    ?>
            </select>
        </td>

        <td></td>-->
    <div class="dddd">
        <td class='im_type'></td>
        <td></td>
        <td>
            <select id='int_id' style="display:none" tabindex="6">
                <option>Type</option>
                <option value="1">Internal-1</option>
                <option value="2">Internal-2</option>
                <option value="3">Internal-3</option>
            </select>
            <select id='int_id1' style="display:none" tabindex="6">
                <option>Type</option>
                <!--/*  <option value="1">External</option>*/-->
                <option value="2">Model Exam-1</option>
            </select>
        </td>
    </div>
</tr>
</table>



<div id='div1'>

    <select id='select_days' value='5' style="display:none">
        <option value='5'>Days</option>
        <?php
        for ($i = 1; $i <= 7; $i++) {
            ?>
            <option value='5'><?= $i ?></option>
            <?php
        }
        ?>
    </select>

    <select id='select_hours' value='6'  style="display:none">
        <option  value='6'>Hours</option>
        <?php
        for ($i = 1; $i <= 10; $i++) {
            ?>
            <option value='6'><?= $i ?></option>
            <?php
        }
        ?>
    </select><br />
    <div style="margin-right:100px;" class="right">
        <input type="button" value='View' class='create_time btn btn-primary' />
    </div><br /><br />

    <div id='time_table1'>

    </div>
</div>
<div id='div2'>
    <!--<br /><br />
<table>
<tr>
<td width="11.3%">&nbsp;&nbsp;Internal</td>
<td>&nbsp;</td>
<td>
<select id='int_id'>
            <option>Type</option>
            <option value="1">Internal-1</option>
            <option value="2">Internal-2</option>
            <option value="3">Internal-3</option>
</select>
</td>
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
</table>
    -->

    <div id='int_div'>

    </div>



</div>
<div id='div3'>
    <br /><br />
<!--<table>
<tr>
<td width="11.3%">&nbsp;&nbsp;Model</td>
<td>&nbsp;</td>
<td>
<select id='int_id1'>
                <option>Type</option>
    <!--/*  <option value="1">External</option>
      <option value="2">Model Exam-1</option>
</select>
</td>
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
</table>  -->

    <div id='int_div1'>

    </div>

</div>
<div id='div4'>

    <div id='int_div2'>

    </div>
</div>
<div id="arrear_exam">
</div>

<script src="<?= $theme_path; ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
//$("#select_type").focus();
    });
    var BASE_URL = '<?php echo $this->config->item('base_url'); ?>';
</script>
<script type="text/javascript">
    $(".timepicker").timepicker({
        showInputs: false
    });
</script>




<script type="text/javascript">

    $('#div1,#div2,#div3,#div4').hide();
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function () {
        readURL(this);
    });
    /*$('.add_row').live('click',function(){
     $('#last_row').clone().appendTo('#app_table');
     var i=0;
     $('.sno').each(function(){
     $(this).html(i);
     i++;
     });
     });
     $(".remove_comments").live('click',function(){
     $(this).closest("tr").remove();
     var i=0;
     $('.sno').each(function(){
     $(this).html(i);
     i++;
     });
     });*/
    $('#depart_id').live('change', function () {

        d_id = $(this).val();
        var select_type = $('#select_type').val();

        if (select_type == 5)
        {
            if (d_id == '' || d_id == null || d_id == 'Select')
            {

            } else
            {
                for_loading('Loading...Time table Generated');

                $.ajax({
                    url: BASE_URL + "time_table/staff_table/print_arrear_time_table",
                    type: 'post',
                    data: {
                        depart_id: d_id
                    },
                    success: function (result) {
                        $('#arrear_exam').html(result);
                        for_response('Time table Generated Successfully');
                    }
                });
            }
        } else
        {
            $.ajax({
                url: BASE_URL + "time_table/staff_table/get_all_group",
                type: 'POST',
                data: {
                    depart_id: d_id

                },
                success: function (result) {
                    $('#g_td').html(result);

                }
            });
        }
    });
    $('#select_type').live('change', function () {

        $('.im_type').html('');
        $('#int_id').hide();
        $('#int_id1').hide();
        if ($(this).val() == 4)
        {
            $('#div1').show();
            $('#div2,#div3,#div4,#arrear_exam').hide();
            //$('#select_batch').show();
            //$('#select_sem').show();
            $('#depart_id').show();
            $('#group_id').show();
            $('#a1').show();
            $('#a2').show();
            $('#a3').show();
            $('#a4').show();
            //$('#select_batch').val('');
            // $('#select_sem').val('');
            $('#depart_id').val('');
            $('#group_id').val('');
            $("#arrear_exam").hide();

            $('#depart_id').prop('disabled', false);
        } else if ($(this).val() == 1)
        {
            $('#int_id').show();
            $('.im_type').html('Internal Type');
            $('#int_id1').hide();
            $('#div2').show();
            $('#div1,#div3,#div4').hide();
            // $('#select_batch').show();
            // $('#select_sem').show();
            $('#depart_id').show();
            $('#group_id').show();
            $('#a1').show();
            $('#a2').show();
            $('#a3').show();
            $('#a4').show();
            // $('#select_batch').val('');
            // $('#select_sem').val('');
            $('#depart_id').val('');
            $('#group_id').val('');
            $("#arrear_exam").hide();
            $('#depart_id').prop('disabled', false);


        } else if ($(this).val() == 2)
        {
            $('.im_type').html('Model Type');
            $('#int_id').hide();
            $('#int_id1').show();
            $('#div3').show();
            $('#div1,#div2,#div4').hide();
            // $('#select_batch').show();
            // $('#select_sem').show();
            $('#depart_id').show();
            $('#group_id').show();
            $('#a1').show();
            $('#a2').show();
            $('#a3').show();
            $('#a4').show();
            // $('#select_batch').val('');
            //$('#select_sem').val('');
            $('#depart_id').val('');
            $('#group_id').val('');
            $("#arrear_exam").hide();
            $('#depart_id').prop('disabled', false);

        } else if ($(this).val() == 3)
        {
            $('#div4').show();
            $('#div1,#div2,#div3').hide();
            //  $('#select_batch').show();
            //  $('#select_sem').show();
            $('#depart_id').show();
            $('#group_id').show();
            $('#a1').show();
            $('#a2').show();
            $('#a3').show();
            $('#a4').show();
            // $('#select_batch').val('');
            // $('#select_sem').val('');
            $('#depart_id').val('');
            $('#group_id').val('');
            $("#arrear_exam").hide();
            $('#depart_id').prop('disabled', false);
        } else if ($(this).val() == 5)
        {

            $("#arrear_exam").show();
            $('#div1,#div2,#div3').hide();
            // $('#select_batch').hide();
            // $('#select_sem').hide();
            $('#depart_id').val('');
            $('#group_id').hide();

            $('#a2').hide();
            $('#a3').hide();
            $('#a4').hide();





            $('#depart_id').prop('disabled', false);
        } else if ($(this).val() == "" || $(this).val() == null)
        {
            $('#div1,#div2,#div3,#div4').hide();
            // $('#select_batch').show();
            //$('#select_sem').show();
            $('#depart_id').show();
            $('#group_id').show();
            $('#a1').show();
            $('#a2').show();
            $('#a3').show();
            $('#a4').show();
            // $('#select_batch').val('');
            // $('#select_sem').val('');
            $('#depart_id').val('');
            $('#group_id').val('');
            $("#arrear_exam").hide();
            // $('#select_batch').prop('disabled', true);
            // $('#select_sem').prop('disabled', true);
            $('#depart_id').prop('disabled', true);
            $('#group_id').prop('disabled', true);
        }
    });
    $('.ajax_required').live('blur', function () {
        if ($(this).val() == '' || $(this).val() == null || $(this).val().trim().length == 0 || $(this).val() == '.' || $(this).val() == ',' || $(this).val() == 0)
        {
            $(this).css('border', '1px solid red');
            $(this).attr('title', 'Field Required');
        } else
        {
            $(this).css('border', '');
            $(this).attr('title', '');
        }

    });
    $('.ajax_required').live('change', function () {
        $('#time_table1,#int_div,#int_div1,#int_div2').html("");
        $("#int_id").val('');
        $("#int_id1").val('');
    });
//    $('#select_batch').live('change', function () {
//        if ($(this).val() == "" || $(this).val() == null)
//        {
//            $('#select_sem').prop('disabled', true);
//            $('#select_sem').val('');
//            $('#depart_id').val('');
//            $('#group_id').val('');
//        } else
//        {
//            $('#select_sem').prop('disabled', false);
//
//            $('#select_sem').val('');
//            $('#depart_id').val('');
//            $('#group_id').val('');
//        }
//    });
//    $('#select_sem').live('change', function () {
//
//        //$("#depart_id").focus();
//        if ($(this).val() == "" || $(this).val() == null)
//        {
//
//
//            $('#depart_id').prop('disabled', true);
//            $('#depart_id').val('');
//            $('#group_id').val('');
//        } else
//        {
//
//
//            $('#depart_id').prop('disabled', false);
//            $('#depart_id').val('');
//            $('#group_id').val('');
//
//        }
//    });
    $('#select_type,#select_batch,#select_sem').live('change', function () {
        $("#group_id").val('');
    });
    $('.create_time').live('click', function () {
        i = 0;
        $('.ajax_required').each(function () {
            if ($(this).val() == '' || $(this).val() == null || $(this).val().trim().length == 0 || $(this).val() == '.' || $(this).val() == ',' || $(this).val() == 0)
            {

                i = 1;
                $(this).css('border', '1px solid red');
                $(this).attr('title', 'Field Required');
            }
        });
        $('.mandatory').each(function () {
            if ($(this).val() == '' || $(this).val() == null || $(this).val().trim().length == 0 || $(this).val() == '.' || $(this).val() == ',' || $(this).val() == 0)
            {

                i = 1;
                $(this).css('border', '1px solid red');
                $(this).attr('title', 'Field Required');
            }
        });
        if (i == 0)
        {
            for_loading('Loading... Time Table Generate'); // loading notification
            $.ajax({
                url: BASE_URL + "time_table/staff_table/print_time_table",
                type: 'POST',
                data: {
                    select_batch: $('#select_batch').val(),
                    depart_id: $('#depart_id').val(),
                    group_id: $('#group_id').val(),
                    select_sem: $('#select_sem').val()

                },
                success: function (result) {
                    $('#time_table1').html(result);
                    for_response(' Time Table Generated successfully...!'); // resutl notification
                }
            });
        }
    });




    $('#int_id').live('change', function () {
        i = 0;
        $('#int_div2').html('');
        if ($(this).val() != 'Type') {
            $('.ajax_required').each(function () {
                if ($(this).val() == '' || $(this).val() == null || $(this).val().trim().length == 0 || $(this).val() == '.' || $(this).val() == ',' || $(this).val() == 0)
                {

                    i = 1;
                    $(this).css('border', '1px solid red');
                    $(this).attr('title', 'Field Required');
                    $('#int_id').val("");
                }
            });
            if (i == 0)
            {
                for_loading('Loading... Internal Time Table Generate'); // loading notification
                $.ajax({
                    url: BASE_URL + "time_table/staff_table/print_other_time_table",
                    type: 'POST',
                    data: {
                        select_type: $('#select_type').val(),
                        select_batch: $('#select_batch').val(),
                        depart_id: $('#depart_id').val(),
                        group_id: $('#group_id').val(),
                        select_sem: $('#select_sem').val(),
                        int_id: $(this).val()

                    },
                    success: function (result) {
                        $("#int_div").html(result);
                        for_response(' Internal Time Table Generated successfully...!'); // resutl notification
                    }
                });
            }
        }
    });
    $('.timein').live('blur', function () {
        if ($(this).val() == '')
            $(this).css('border', '1px solid red');
        else
            $(this).css('border', '');
    });
    $('.timeout').live('blur', function () {
        if ($(this).val() == '')
            $(this).css('border', '1px solid red');
        else
            $(this).css('border', '');
    });
    /*$('.int_date').live('blur',function(){
     if($(this).val()=='')
     $(this).css('border','1px solid red');
     else
     $(this).css('border','');
     });*/



    $('#int_id1').live('change', function () {
        $('#int_div2').html('');
        i = 0;
        if ($(this).val() != 'Type') {
            $('.ajax_required').each(function () {
                if ($(this).val() == '' || $(this).val() == null || $(this).val().trim().length == 0 || $(this).val() == '.' || $(this).val() == ',' || $(this).val() == 0)
                {
                    i = 1;
                    $(this).css('border', '1px solid red');
                    $(this).attr('title', 'Field Required');
                    $('#int_id').val("");
                }
            });
            if (i == 0)
            {
                for_loading('Loading... Model Time Table Generate'); // loading notification
                $.ajax({
                    url: BASE_URL + "time_table/staff_table/print_other_time_table",
                    type: 'POST',
                    data: {
                        select_type: $('#select_type').val(),
                        select_batch: $('#select_batch').val(),
                        depart_id: $('#depart_id').val(),
                        group_id: $('#group_id').val(),
                        select_sem: $('#select_sem').val(),
                        int_id: $(this).val()

                    },
                    success: function (result) {
                        $('.select_subject').val('');
                        $('.int_date').val('');
                        $('.timein').val('');
                        $('.timeout').val('');
                        $("#int_div1").html(result);
                        for_response(' Model Time Table Generated successfully...!'); // resutl notification
                    }
                });
            }
        }

    });



    $('#group_id').live('change', function () {
        if ($('#select_type').val() == 3)
        {
            $("#time_table1").html('');
            //$('#int_id').focus();
            //$('#int_id1').focus();
            $("#int_div2").html('');
            $("#int_div1").html('');
            $("#int_div").html('');
            if ($(this).val() != '')
            {
                i = 0;
                if ($('#select_type').val() == '')
                {
                    i = 1;
                    $('#select_type').css('border', '1px solid red');
                }
                if ($('#select_batch').val() == '')
                {
                    i = 1;
                    $('#select_batch').css('border', '1px solid red');
                }
                if ($('#select_sem').val() == '')
                {
                    i = 1;
                    $('#select_sem').css('border', '1px solid red');
                }
                if (i == 0) {
                    $('#int_id').prop('disabled', false);
                    $('#int_id1').prop('disabled', false);
                    $('#int_id').val('');
                    $('#int_id1').val('');
                    //for_loading('Loading... Exam Time Table Generate'); // loading notification
                    $.ajax({
                        url: BASE_URL + "time_table/staff_table/print_other_time_table",
                        type: 'POST',
                        data: {
                            select_type: $('#select_type').val(),
                            select_batch: $('#select_batch').val(),
                            depart_id: $('#depart_id').val(),
                            group_id: $('#group_id').val(),
                            select_sem: $('#select_sem').val(),
                            int_id: 1

                        },
                        success: function (result) {
                            $("#int_div2").html(result);
                            //for_response(' Exam Time Table Generated successfully...!'); // resutl notification
                        }
                    });
                }

            }
        }

    });

    // global



    // working for arrear exam


    //




    // validation for arrear exam

</script>


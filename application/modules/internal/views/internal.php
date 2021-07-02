<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template');
?>
<table class="form_table">
    <tr>
        <td>Class</td>
        <td>&nbsp;</td>
        <td id='td_depart'>
            <select id='depart_id' name='student_group[depart_id]' >
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
        <td>&nbsp;</td>


    </tr>
    <tr>
    <input type="hidden" id="select_batch"  value="<?php echo $batch[0]['id'] ?>" />
    <input type="hidden" id="select_sem"  value="<?php echo $batch[0]['id'] ?>" />
<!--        <td>Batch</td>
     <td>&nbsp;</td>
     <td>
         <select id='select_batch' class='ajax_class'>
             <option value="0">Select</option>
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
     </td>-->
     <!--<td>&nbsp;</td>-->
    <td>Section</td>
    <td>&nbsp;</td>
    <td id='g_td'>
        <select id='group_id' name='student_group[group_id]' disabled="disabled" >
            <option value="0">Select</option>
        </select>
    </td>

</tr>
<tr>
<!--        <td>Term</td>
    <td>&nbsp;</td>
    <td id='td_sem'>
        <select id='select_sem'  class='ajax_class' disabled="disabled">
            <option value="0">Select</option>
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
    <td>&nbsp;</td>-->
    <td>Subject</td>
    <td>&nbsp;</td>
    <td id='sub_td'>
        <select id='subject_id' disabled="disabled">
            <option value="0">Select</option>
        </select>
    </td>

</tr>

</table>
<br />
<div id='int_div'>

</div>


<script type="text/javascript">
    $(document).ready(function () {
        $("#select_batch").focus();
    });
    $('.ajax_class,#depart_id,#group_id').live('change', function () {
        $("#int_div").html('');

    });
    $('#depart_id').live('change', function () {
        $("#subject_id").val('');
        $("#group_id").val('');
    });
    $('.ajax_class').live('change', function () {
        $("#subject_id").val('');
        $("#depart_id").val('');
        $("#group_id").val('');
    });

    $('#upload').live('click', function () {
        $.ajax({
            url: BASE_URL + "internal/upload",
            type: 'post',
            data: {
                upload: $('#file_name').val()
            },
            success: function (result) {
            }
        });
    });
    $('#depart_id').live('change', function () {
        d_id = $(this).val();
        if (d_id == "" || d_id == null)
        {
            $("#group_id").attr('disabled', true);
            $("#subject_id").attr('disabled', true);
        } else
        {
            $("#group_id").attr('disabled', false);
            $.ajax({
                url: BASE_URL + "student/get_all_group",
                type: 'POST',
                data: {
                    depart_id: d_id

                },
                success: function (result) {
                    $('#g_td').html(result);

                    /*$('.modal-backdrop').hide();
                     $('.close_div').hide();*/
                }
            });
        }
    });
//    $('#select_batch').live('change', function () {
//        b_id = $(this).val();
//        if (b_id == "" || b_id == null)
//        {
//            $("#select_sem").attr('disabled', true);
//            $("#depart_id").attr('disabled', true);
//            $("#group_id").attr('disabled', true);
//            $("#subject_id").attr('disabled', true);
//        } else
//        {
//            $("#depart_id").attr('disabled', false);
//            $.ajax({
//                url: BASE_URL + "subject/get_all_department_internal",
//                type: 'POST',
//                data: {
//                    batch_id: b_id
//
//                },
//                success: function (result) {
//                    $('#td_depart').html(result);
//                    /*$('.modal-backdrop').hide();
//                     $('.close_div').hide();*/
//                }
//            });
//        }
//    });
//    $('#select_batch').live('change', function () {
//        b_id = $(this).val();
//        if (b_id == "" || b_id == null)
//        {
//            $("#select_sem").attr('disabled', true);
//            $("#depart_id").attr('disabled', true);
//            $("#group_id").attr('disabled', true);
//            $("#subject_id").attr('disabled', true);
//        } else
//        {
//            $("#select_sem").attr('disabled', false);
//            $.ajax({
//                url: BASE_URL + "subject/get_all_sem",
//                type: 'POST',
//                data: {
//                    batch_id: b_id
//
//                },
//                success: function (result) {
//                    $('#td_sem').html(result);
//
//                    /*$('.modal-backdrop').hide();
//                     $('.close_div').hide();*/
//                }
//            });
//        }
//    });
//    $('#select_sem').live('change', function () {
//        if ($(this).val() == "" || $(this).val() == null)
//        {
//            $("#depart_id").attr('disabled', true);
//            $("#group_id").attr('disabled', true);
//            $("#subject_id").attr('disabled', true);
//        } else
//        {
//            $("#depart_id").attr('disabled', false);
//
//        }
//    });
    $('#group_id').live('change', function () {
        group = $(this).val();
        if (group == "" || group == null)
        {
            $("#subject_id").attr('disabled', true);
            $("#subject_id").val('');
        } else
        {
            $("#subject_id").attr('disabled', false);
            $.ajax({
                url: BASE_URL + "internal/get_all_subject",
                type: 'post',
                data: {
                    select_batch: $('#select_batch').val(),
                    depart_id: $('#depart_id').val(),
                    group_id: group,
                    select_sem: $("#select_sem").val()

                },
                success: function (result) {
                    $('#sub_td').html(result);

                    /*$('.modal-backdrop').hide();
                     $('.close_div').hide();*/
                }
            });
        }
    });
    $('#subject_id').live('change', function () {
        i = 0;
//        if ($('#select_batch').val() == 0)
//        {
//            $('#select_batch').css('border-color', 'red');
//            i = 1;
//        } else
//            $('#select_batch').css('border-color', '');
//
//        if ($('#select_sem').val() == 0)
//        {
//            $('#select_sem').css('border-color', 'red');
//            i = 1;
//        } else
//            $('#select_sem').css('border-color', '');
        if ($('#depart_id').val() == 0)
        {
            $('#depart_id').css('border-color', 'red');
            i = 1;
        } else
            $('#depart_id').css('border-color', '');
        if ($('#group_id').val() == '')
        {
            console.log('ff');
            $('#group_id').css('border-color', 'red');
            i = 1;
        } else
            $('#group_id').css('border-color', '');
        if (i == 0 && $(this).val() != 0)
        {
            for_loading('Loading... Internal Details'); // loading notification
            $.ajax({
                url: BASE_URL + "internal/check_internal",
                type: 'post',
                data: {
                    select_batch: $('#select_batch').val(),
                    depart_id: $('#depart_id').val(),
                    group_id: $('#group_id').val(),
                    subject: $(this).val(),
                    select_sem: $("#select_sem").val()
                },
                success: function (result) {
                    $('#int_div').html('');
                    $('#int_div').html(result);
                    for_response('Internal Details displayed Successfully...!'); // resutl notification
                }
            });
        }

    });
    /*$('#subject_id').live('change',function(){
     for_loading('Loading... Internal Details'); // loading notification
     $.ajax({
     url:BASE_URL+"internal/check_internal",
     type:'post',
     data:{
     select_batch:$('#select_batch').val(),
     depart_id:$('#depart_id').val(),
     group_id:$('#group_id').val(),
     subject:$(this).val(),
     select_sem:$("#select_sem").val()
     },
     success:function(result){
     $('#int_div').html('');
     $('#int_div').html(result);
     }
     });

     });    */
    $('.text_int').live('keyup', function () {
        class_name = $(this).attr('class').split("_");
        int_convert_mark = $('.int_convert_mark').val();
        total_int_mark = $('.total_int_mark').val();
        total_mark = $('.total_' + class_name[2]).val();

        if (Number(total_mark) >= Number($(this).val()))
        {
            single = ($(this).val() / total_mark) * int_convert_mark;
            close_qty = $(this).closest('tr').find('.convert_' + class_name[2]);
            close_qty.val(single.toFixed(2));
            var myArray = [];
            i = 0;
            $('.text_convert_' + class_name[4]).each(function () {
                myArray[ i ] = $(this).val();
                i++
            });
            final_val = myArray.sort(descending);
            cal_val = (Number(final_val[0]) + Number(final_val[1])) / 2;
            $('.totalval_' + class_name[4]).val(cal_val.toFixed(2));
            $('.fulltotalval_' + class_name[4]).val((cal_val * 2).toFixed(2));
            last_val = Number($('.fulltotalval_' + class_name[4]).val()) + Number($('.modelfullval_' + class_name[4]).val()) + Number($('.assign_' + class_name[4]).val()) + Number($('.attend_' + class_name[4]).val());
            $('.final_total_' + class_name[4]).val(last_val.toFixed(2));
            $(this).css('border-color', '');
        } else
            $(this).css('border-color', 'red');
    });
    $('.text_total').live('keyup', function () {
        class_name = $(this).attr('class').split("_");
        int_convert_mark = $('.int_convert_mark').val();
        total_int_mark = $('.total_int_mark').val();
        std_mark = $('.int_' + class_name[2]).val();
        this_val = $(this).val();
        $('.int_' + class_name[2]).each(function () {
            single = ($(this).val() / this_val) * int_convert_mark;
            ful_change = $(this).closest('tr').find('.convert_' + class_name[2]);
            ful_change.val(single);
            class_name1 = $(this).attr('class').split("_");
            var myArray = [];
            i = 0;
            $('.text_convert_' + class_name1[4]).each(function () {
                myArray[ i ] = $(this).val();
                i++
            });
            final_val = myArray.sort(descending);
            cal_val = (Number(final_val[0]) + Number(final_val[1])) / 2;
            $('.totalval_' + class_name1[4]).val(cal_val.toFixed(2));
            $('.fulltotalval_' + class_name1[4]).val((cal_val * 2).toFixed(2));
            last_val = Number($('.fulltotalval_' + class_name1[4]).val()) + Number($('.modelfullval_' + class_name1[4]).val()) + Number($('.assign_' + class_name1[4]).val()) + Number($('.attend_' + class_name1[4]).val());
            $('.final_total_' + class_name1[4]).val(last_val.toFixed(2));
        });

    });

    function descending(a, b) {
        return b - a;
    }
    $('.get_model').live('keyup', function () {
        class_name2 = $(this).attr('class').split("_");
        model_score = $('.model_score').val();
        if (Number(model_score) >= Number($(this).val()))
        {
            convert_mark_model = $('.convert_mark_model').val();
            single = ($(this).val() / model_score) * convert_mark_model;
            $('.convertmodel_' + class_name2[2]).val(single.toFixed(2));
            $('.modelfullval_' + class_name2[2]).val(single.toFixed(2));

            last_val = Number($('.fulltotalval_' + class_name2[2]).val()) + Number($('.modelfullval_' + class_name2[2]).val()) + Number($('.assign_' + class_name2[2]).val()) + Number($('.attend_' + class_name2[2]).val());
            $('.final_total_' + class_name2[2]).val(last_val.toFixed(2));
            $(this).css('border-color', '');
        } else
            $(this).css('border-color', 'red');

    });
    $('#add_internal').live('click', function () {

        i = 0;
        ii = 0;
        jj = 0;
        int_total = '';
        $('.text_total').each(function () {
            int_total = int_total + $(this).val() + ',';
        });
        j = 0;
        var student_info = [];
        $('.student_id').each(function () {
            com_class = $(this).attr('class').split(" ");
            com_id = $(this).attr('id');
            int_total_val = '';

            $('._intval_' + com_id).each(function () {
                split_class = $(this).attr('class').split("_");
                if (Number($(this).val()) > Number($('.total_' + split_class[2]).val()))
                {
                    ii = 1;
                    $(this).css('border-color', 'red');
                } else
                    $(this).css('border-color', '');

                int_total_val = int_total_val + $(this).val() + ',';
            });
            if (Number($(".model_score").val()) < Number($('.modelscore_' + com_id).val()))
            {
                jj = 1;
                $('.modelscore_' + com_id).css('border-color', 'red');
            } else
                $('.modelscore_' + com_id).css('border-color', '');

            student_info[j] = $(this).val() + '-' + $('.modelscore_' + com_id).val() + '-' + $('.fulltotalval_' + com_id).val() + '-' + $('.modelfullval_' + com_id).val() + '-' + $('.assign_' + com_id).val() + '-' + $('.attend_' + com_id).val() + '-' + $('.final_total_' + com_id).val() + '-' + int_total_val;

            j++;
        });
        if (ii == 0 && jj == 0)
        {
            for_loading('Loading... Internal Details Submitting'); // loading notification
            $.ajax({
                url: BASE_URL + "internal/add_internal",
                type: 'POST',
                data: {
                    select_batch: $('#select_batch').val(),
                    depart_id: $('#depart_id').val(),
                    group_id: $('#group_id').val(),
                    subject: $("#subject_id").val(),
                    select_sem: $("#select_sem").val(),
                    int_total_val: int_total,
                    model_total_val: $(".model_score").val(),
                    student_details: student_info
                },
                success: function (result) {
                    for_response('Internal Details Submitted Successfully...!'); // resutl notification
                    $("#int_div").html('');
                }
            });
            $('.ajax_class').val('');
            $('.mandatory').val('');
            $('#subject_id').val('');
        }

    });

    $('#update_internal').live('click', function () {

        i = 0;
        int_total = '';
        $('.text_total').each(function () {
            int_total = int_total + $(this).val() + ',';
        });
        j = 0;
        var student_info = [];
        ii = 0;
        jj = 0;
        $('.student_id').each(function () {
            com_class = $(this).attr('class').split(" ");
            com_id = $(this).attr('id');
            int_total_val = '';

            $('._intval_' + com_id).each(function () {
                split_class = $(this).attr('class').split("_");
                if (Number($(this).val()) > Number($('.total_' + split_class[2]).val()))
                {
                    ii = 1;
                    $(this).css('border-color', 'red');
                } else
                    $(this).css('border-color', '');

                int_total_val = int_total_val + $(this).val() + ',';
            });
            if (Number($(".model_score").val()) < Number($('.modelscore_' + com_id).val()))
            {
                jj = 1;
                $('.modelscore_' + com_id).css('border-color', 'red');
            } else
                $('.modelscore_' + com_id).css('border-color', '');
            student_info[j] = $(this).val() + '-' + $('.modelscore_' + com_id).val() + '-' + $('.fulltotalval_' + com_id).val() + '-' + $('.modelfullval_' + com_id).val() + '-' + $('.assign_' + com_id).val() + '-' + $('.attend_' + com_id).val() + '-' + $('.final_total_' + com_id).val() + '-' + int_total_val + '-' + $('.exam_' + com_id).val();

            j++;
        });
        if (ii == 0 && jj == 0)
        {
            for_loading('Loading... Internal Details Updatting'); // loading notification
            $.ajax({
                url: BASE_URL + "internal/update_internal",
                type: 'POST',
                data: {
                    select_batch: $('#select_batch').val(),
                    depart_id: $('#depart_id').val(),
                    group_id: $('#group_id').val(),
                    subject: $("#subject_id").val(),
                    select_sem: $("#select_sem").val(),
                    int_total_val: int_total,
                    model_total_val: $(".model_score").val(),
                    update_id: $(".update_id").val(),
                    student_details: student_info
                },
                success: function (result) {
                    for_response('Internal Details Updated Successfully...!'); // resutl notification
                    $("#int_div").html('');
                }
            });
            $('.ajax_class').val('');
            $('.mandatory').val('');
            $('#subject_id').val('');
        }
    });
    $('.complete_internal').live('click', function () {
        b_id = $(this);
        for_loading('Loading... Internal Marks Updatting'); // loading notification
        $.ajax({
            url: BASE_URL + "internal/update_complete_status",
            type: 'POST',
            data: {
                batch_id: b_id.val()

            },
            success: function (result) {
                for_response('Internal Marks Completed Successfully...!'); // resutl notification
                /*$('.modal-backdrop').hide();
                 $('.close_div').hide();*/
            }
        });
    });
    $('.close_internal').live('click', function () {
        b_id = $(this);
        for_loading('Loading... Internal Marks Updatting'); // loading notification
        $.ajax({
            url: BASE_URL + "internal/update_complete_status1",
            type: 'POST',
            data: {
                batch_id: b_id.val()

            },
            success: function (result) {
                for_response('Internal Marks Details Closed Successfully...!'); // resutl notification
                //$('#update_internal').hide();
                /*$('.modal-backdrop').hide();
                 $('.close_div').hide();*/
            }
        });
    });

    $('.exam_mark').live('keyup', function () {

        exam_id = $(this).attr('class').split("_");
        $('.final_total_' + exam_id[2]).val('');
        console.log($(this).val());
        console.log($('.hide_final_total_' + exam_id[2]).val());
        all_final_val = Number($(this).val()) + Number($('.hide_final_total_' + exam_id[2]).val());
        $('.final_total_' + exam_id[2]).val(all_final_val);

    });
</script>









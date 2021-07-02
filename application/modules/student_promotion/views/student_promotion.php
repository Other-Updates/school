<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template');
?>
<form method="post" id="form_result" >
    <table class="form_table">
        <tr>
            <td>Exam</td>
            <td>&nbsp;</td>
            <td id='td_depart'>
                <select id='exam_id' name='student_group[exam_id]' disabled="">
                    <?php
                    if (isset($all_exam) && !empty($all_exam)) {
                        foreach ($all_exam as $val) {
                            if ($val['id'] == 3) {
                                ?>
                                <option value="<?= $val['id'] ?>" selected=""><?= $val['exam'] ?></option>
                                <?php
                            }
                        }
                    }
                    ?>
                </select>
            </td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Class</td>
            <td>&nbsp;</td>
            <td id='td_depart'>
                <select id='depart_id' name='external[depart_id]'>
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
            <td>Section</td>
            <td>&nbsp;</td>
            <td id='g_td'>
                <select id='group_id' name='external[group_id]' disabled="disabled"  >
                    <option value="0">Select</option>
                </select>
            </td>
            <td></td>
        </tr>
        <tr>
        <input type="hidden" id="select_batch"  name="external[batch_id]" value="<?php echo $batch[0]['id'] ?>" />
        <input type="hidden" id="select_sem"  name='external[semester]'  value="<?php echo $term[0]['id'] ?>" />
<!--            <td>Batch</td>
            <td>&nbsp;</td>
            <td>
                <select id='select_batch' class='ajax_class' name="external[batch_id]">
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
            </td>
            <td>&nbsp;</td>
            <td></td>
            <td>&nbsp;</td>
            <td>

            </td>-->

        </tr>
        <tr>
<!--            <td>Term</td>
            <td>&nbsp;</td>
            <td id='td_sem'>
                <select id='select_sem'  class='ajax_class' name='external[semester]' disabled="disabled">
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
            <td style="display:none;">Subject</td>
            <td  style="display:none;">&nbsp;</td>
            <td  style="display:none;" id='sub_td'>
                <select id='subject_id' disabled="disabled">
                    <option value="0">Select</option>
                </select>
            </td>

        </tr>

    </table>
    <br />
    <div id='std_list'>

    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            $("#select_batch").focus();
        });
        $('.ajax_class,#depart_id,#group_id,#exam_id').live('change', function () {
            $("#int_div").html('');
        });
        $('#exam_id').live('change', function () {
            $("#subject_id").val('');
            $("#depart_id").val('');
            $("#group_id").val('');
        });
        $('#depart_id').live('change', function () {
            $("#subject_id").val('');
            $("#group_id").val('');
        });
        $('.ajax_class').live('change', function () {
            $("#subject_id").val('');
            $("#depart_id").val('');
            $("#group_id").val('');
            $("#exam_id").val('');
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
                    url: BASE_URL + "internal/get_all_group",
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
        $('#group_id').live('change', function () {
            group = $(this).val();
            if (group == "" || group == null)
            {
                $("#subject_id").attr('disabled', true);
            } else
            {
                $("#subject_id").attr('disabled', false);
                $.ajax({
                    url: BASE_URL + "student_promotion/get_all_student_with_subject",
                    type: 'POST',
                    data: {
                        exam_id: $('#exam_id').val(),
                        batch_id: $('#select_batch').val(),
                        depart_id: $('#depart_id').val(),
                        group_id: group,
                        semester: $("#select_sem").val()

                    },
                    success: function (result) {
                        $('#std_list').html(result);
                        /*$('.modal-backdrop').hide();
                         $('.close_div').hide();*/
                    }
                });
            }
        });
        $('#subject_id').live('change', function () {
            i = 0;
            if ($('#select_batch').val() == 0)
            {
                $('#select_batch').css('border-color', 'red');
                i = 1;
            } else
                $('#select_batch').css('border-color', '');
            if ($('#select_sem').val() == 0)
            {
                $('#select_sem').css('border-color', 'red');
                i = 1;
            } else
                $('#select_sem').css('border-color', '');
            if ($('#exam_id').val() == 0)
            {
                $('#exam_id').css('border-color', 'red');
                i = 1;
            } else
                $('#exam_id').css('border-color', '');
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

        $('.mark').live('change', function () {
            var result_status = 0;
            var final_qty = 0;
            var result = $(this).closest('tr').find('.result');

            $(this).closest('tr').find('.mark').each(function () {

                var marks = $(this);
                var total_mark = $(this).closest('td').find('.total_mark');
                var pass = $(this).closest('td').find('.pass');

                if (Number(pass.val()) > Number($(this).val()))
                {
                    result_status = 1;
                    marks.addClass('red');
                } else {
                    marks.removeClass('red');
                }

                if (Number(total_mark.val()) >= Number($(this).val()))
                {
                    var mark = $(this);
                    var total = $(this).closest('tr').find('.total');
                    if (Number(mark.val()) != '')
                    {
                        final_qty = final_qty + Number(mark.val());
                        total.val(final_qty.toFixed(2));
                    }
                    $(this).css('border-color', '');
                } else {
                    $(this).css('border-color', 'red');

                }
            });

            if (result_status == 1) {
                result.val("2").change();
            } else {
                result.val("1").change();
            }


        });

        $('form#form_result').submit('click', function () {

            var err = 0;
            $('.mark').each(function () {

                var mark = $(this);
                var total_mark = $(this).closest('td').find('.total_mark');
                if ($(this).val() == '') {
                    $(this).css('border-color', 'red');
                    err = 1;
                } else {
                    if (Number(total_mark.val()) < Number($(this).val()))
                    {
                        $(this).css('border-color', 'red');
                        err = 1;

                    } else {
                        $(this).css('border-color', '');
                    }
                }
            });

            if (err == 1)
                return false;
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
                    /*$('.modal-backdrop').hide();
                     $('.close_div').hide();*/
                }
            });
        });

        function isNumber(evt, this_ele) {
            this_val = $(this_ele).val();
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (evt.which == 13) {//Enter key pressed
                $(".thVal").blur();
                return false;
            }
            if (charCode > 39 && charCode > 37 && charCode > 31 && ((charCode != 46 && charCode < 48) || charCode > 57 || (charCode == 46 && this_val.indexOf('.') != -1))) {
                return false;
            } else {
                return true;
            }

        }

    </script>









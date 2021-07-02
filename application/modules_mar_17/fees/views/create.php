<form method="post">
    <table>
        <tr>
            <td width="360">Academic Year</td>
            <td>
                <select class="mandatory" id='select_batch'  name='fees_info[batch_id]'>
                    <option value="">Select</option>
                    <?php
                    if (isset($all_batch) && !empty($all_batch)) {

                        foreach ($all_batch as $val1) {
                            ?>
                            <option value="<?= $val1['id'] ?>" class="<?php echo $val1['from'] . '-' . $val1['to'] ?>"><?php echo $val1['from']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Class</td>
            <td>
                <select class="mandatory" id='depart_id'  name='fees_info[depart_id]'>
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
            <td>Term</td>
            <td id='year_td'>
                <select id='select_sem' class="mandatory"  name='fees_info[semester_id]'>
                    <option value="">Select</option>
                    <?php
                    if (isset($all_semester) && !empty($all_semester)) {

                        foreach ($all_semester as $val1) {
                            ?>
                            <option value="<?= $val1['id'] ?>" ><?php echo $val1['semester'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <div id='fees_info'>

    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('#fees_info').hide();
        $('#select_batch').live('change', function () {
            $('#depart_id').val(0);
            $('#select_sem').val(0);
            $('#fees_info').hide();
        });
    });
    $('#depart_id').live('change', function () {
        $('#select_sem').val(0);
        $('#fees_info').hide();
    });
    $('#select_sem').live('change', function () {
        $('#fees_info').show();
        if ($('#select_sem').val() != 0)
        {
            $.ajax({
                url: BASE_URL + "fees/check_fees_info",
                type: 'POST',
                data: {
                    batch_id: $('#select_batch').val(),
                    depart_id: $('#depart_id').val(),
                    semester_id: $('#select_sem').val()

                },
                success: function (result) {
                    $('#fees_info').html(result);
                }
            });
        }
        $('#fees_info').html('');
    });
//    $('#select_batch').live('change', function () {
//        f_arr = $("#select_batch option:selected").attr('class').split("-");
//        select_year = '';
//        select_year = select_year + "<select id='select_sem'  name='fees_info[semester_id]'><option value='0'>Select</option>";
//        j = 1;
//        for (i = f_arr[0]; i <= f_arr[1] - 1; i++)
//        {
//            select_year = select_year + "<option value=" + j + " >Year-" + j + "</option>";
//            j++;
//        }
//        select_year = select_year + "</select>";
//        $('#year_td').html(select_year);
//    });

    $('.master_fees_check').live('click', function () {
        if ($(this).attr('checked') == 'checked')
        {
            fees_id = $(this).attr('id');
            $('#fees_amt_' + fees_id).removeAttr('readonly');
            $('#fees_amt_' + fees_id).addClass('mandatory');
        } else
        {
            $('#fees_amt_' + fees_id).removeClass('mandatory');
            $('#fees_amt_' + fees_id).css('border-color', '');
            fees_id = $(this).attr('id');
            $('#fees_amt_' + fees_id).attr('readonly', 'readonly');
            $('#fees_amt_' + fees_id).val('');
            total = 0;
            $('.fees_amount').each(function () {
                total = total + Number($(this).val());
            });
            $('#total').val(total.toFixed(2));
            $('#full_mge_total').val((Number($("#total").val()) + Number($('#mge_amt').val())).toFixed(2));
        }
    });
    $('#mge_amt,#full_mge_total').hide();
    $('#mge_check').live('click', function () {
        if ($(this).attr('checked') == 'checked')
        {
            $('#mge_amt,#full_mge_total').show();
            $('#mge_amt').removeAttr('readonly');
            $('#mge_amt').addClass('mandatory');
        } else
        {
            $('#mge_amt').removeClass('mandatory');
            $('#mge_amt').css('border-color', '');
            $('#mge_amt,#full_mge_total').hide();
            $('#mge_amt').val('');
            $('#full_mge_total').val('');
            $('#mge_amt').attr('readonly', 'readonly');
        }
    });
    $('.fees_amount').live('keyup', function () {
        total = 0;
        $('.fees_amount').each(function () {
            total = total + Number($(this).val());
        });
        $('#total').val(total.toFixed(2));
        $('#full_mge_total').val((Number($("#total").val()) + Number($('#mge_amt').val())).toFixed(2));
    });
    $('#mge_amt').live('keyup', function () {
        $('#full_mge_total').val((Number($("#total").val()) + Number($('#mge_amt').val())).toFixed(2));
    });
    $('.fain_type').live('click', function () {
        if ($(this).val() == 'yes')
        {
            $('.amt_tr').show();
            $('.type_tr').show();
            $('.fain_amt').addClass('mandatory');
        } else
        {
            $('.amt_tr').hide();
            $('.type_tr').hide();
            $('.fain_amt').removeClass('mandatory');
        }
    });
    $('.pain_option').live('click', function () {
        $('.per_fees_type').html('  / ' + $(this).val());
    });
</script>
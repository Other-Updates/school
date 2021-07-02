<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template');
?>
<table class="form_table">
    <input type="hidden" id="select_batch"  value="<?php echo $batch[0]['id'] ?>" />
    <input type="hidden" id="select_sem"  value="<?php echo $batch[0]['id'] ?>" />
    <tr>

        <td>Class</td>
        <td>&nbsp;</td>
        <td>
            <select id='depart_id' name='student_group[depart_id]'>
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
    <tr>

        <td>Section</td>
        <td>&nbsp;</td>
        <td id='g_td'>
            <select id='group_id' name='student_group[group_id]'>
                <option value="0">Select</option>
            </select>
        </td>

    </tr>
    <tr>
        <td></td>
        <td>&nbsp;</td>
        <td>

        </td>
        <td>&nbsp;</td>
        <td>Subject</td>
        <td>&nbsp;</td>
        <td id='sub_td'>
            <select id='subject_id'>
                <option value="0">Select</option>
            </select>
        </td>

    </tr>
</table>
<div id='int_div'>

</div>


<script type="text/javascript">

    $('#depart_id').live('change', function () {
        d_id = $(this);
        $.ajax({
            url: BASE_URL + "student/get_all_group",
            type: 'POST',
            data: {
                depart_id: d_id.val()

            },
            success: function (result) {
                $('#g_td').html(result);
                /*$('.modal-backdrop').hide();
                 $('.close_div').hide();*/
            }
        });
    });
    $('#group_id').live('change', function () {
        d_id = $(this);
        $.ajax({
            url: BASE_URL + "internal/get_all_subject",
            type: 'POST',
            data: {
                select_batch: $('#select_batch').val(),
                depart_id: $('#depart_id').val(),
                group_id: $(this).val(),
                select_sem: $("#select_sem").val()

            },
            success: function (result) {
                $('#sub_td').html(result);
                /*$('.modal-backdrop').hide();
                 $('.close_div').hide();*/
            }
        });
    });
    $('#subject_id').live('change', function () {
        $.ajax({
            url: BASE_URL + "internal/check_assignment",
            type: 'POST',
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
            }
        });

    });

</script>









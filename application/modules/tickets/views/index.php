<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<form method="post"  enctype="multipart/form-data">
    <table class="staff_table">
        <tr>
            <td>Name</td>
            <td><input type="text" name='student[name]' /></td>
        </tr>

        <td>E-Mail</td>
        <td><input type="text"  name='student_details[state]'/></td>

        </tr>
        <tr>
            <td>Class</td>
            <td>
                <select id='depart_id' name='student_group[depart_id]'  class="form-control">
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

        <tr>
            <td>Email Id</td>
            <td>
                <input type="text"  name='student[email_id]' />
            </td>
        </tr>
    </table>
    <table style="display:none;">
        <tr id="last_row" >
            <td class="dy_no"></td>
            <td><input type="text" name='qualification[pass][]'/></td>
            <td><input type="button" value="-" class='remove_comments btn bg-purple btn-sm'/></td>
        </tr>
    </table>
    <br />
    <div class="right"><input type="submit" value="submit" class="btn btn-primary"></div>
    <br />
    <br />
</form>



<script type="text/javascript">
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
    $('.add_row').click(function () {
        $('#last_row').clone().appendTo('#app_table');
        var i = 4;
        $('.dy_no').each(function () {
            $(this).html(i);
            i++;
        });
    });
    $(".remove_comments").live('click', function () {
        $(this).closest("tr").remove();
        var i = 4;
        $('.dy_no').each(function () {
            $(this).html(i);
            i++;
        });
    });
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

</script>
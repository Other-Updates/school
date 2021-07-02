<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<script type="text/javascript">

    $('.mandatory1').live('blur', function () {


        if ($(this).val() == '' || $(this).val() == null || $(this).val().trim().length == 0 || $(this).val() == '.' || $(this).val() == ',')
        {
            $(this).css('border', '1px solid red');
            result = 1;
        } else {
            $(this).css('border', '1px solid #CCCCCC');
            $(this).tooltip('hide');
        }


    });
    $(document).ready(function ()
    {
//        $("#batch").change(function ()
//        {
//            var b = $(this).val();
//            $('#sem').val('');
//            $("#department").val('');
//            $("#group_id").val('');
//            $("#subject_id").val('');
//            $("#staff_ass_number").val('');
//            if (b == '' || b == null)
//            {
//                $('#sem').attr('disabled', true);
//                $("#department").attr('disabled', true);
//
//                $("#group_id").attr('disabled', true);
//                $("#subject_id").attr('disabled', true);
//                $("#staff_ass_number").attr('disabled', true);
//            } else
//            {
//                $('#sem').attr('disabled', false);
//
//            }
//        });
//        $("#sem").change(function ()
//        {
//            var s = $(this).val();
//            $("#department").val('');
//            $("#group_id").val('');
//            $("#subject_id").val('');
//            $("#staff_ass_number").val('');
//            if (s == "" || s == null)
//            {
//                $("#department").attr('disabled', true);
//
//                $("#group_id").attr('disabled', true);
//                $("#subject_id").attr('disabled', true);
//                $("#staff_ass_number").attr('disabled', true);
//            } else
//            {
//
//                $("#department").attr('disabled', false);
//
//            }
//        });
//        $("#group_id").change(function ()
//        {
//
//        });

        //get group
        $("#department").change(function ()
        {

            var department = $("#department").val();

            $("#subject_id").val('');
            $("#staff_ass_number").val('');
            if (department == "" || department == null)
            {
                $("#group_id").attr('disabled', true);
                $("#subject_id").attr('disabled', true);
                $("#staff_ass_number").attr('disabled', true);
            } else
            {
                $("#group_id").attr('disabled', false);
                $.ajax({
                    url: BASE_URL + "assignment/get_group_for_assignment",
                    type: 'POST',
                    data: {dep_id: department
                    },
                    success: function (result) {

                        //alert(result);
                        $("#group_list").html(result);


                    }

                });
            }
        });



    });

    $('#group_id').live('change', function () {
        $("#staff_ass_number").val('');
        var department = $("#department").val(),
                sem = $("#sem").val(),
                batch = $("#batch").val(),
                group = $("#group_id").val();

        $.ajax({
            url: BASE_URL + "assignment/get_subject_group_for_assignment",
            type: 'POST',
            data: {
                batch: batch, sem: sem, dep_id: department, group_id: group

            },
            success: function (result) {

                $('#subject_list').html(result);


            }
        });
    });
</script>
<table class="form_table" width="100%">
    <tr>
    <input type="hidden" id="batch" value="<?php echo $batch[0]['id'] ?>" />
    <input type="hidden" id="sem" value="<?php echo $term[0]['id'] ?>" />
<!--        <td>Batch</td>
<td><select id="batch" class="mandatory1">
        <option value="">Select Batch</option>
    <?php
    if (isset($batch) && !empty($batch)) {
        foreach ($batch as $val) {
            ?>
                                <option value="<?php echo $val['id']; ?>"><?php echo $val['from'] . "-" . $val['to']; ?></option>
            <?php
        }
    }
    ?></select></td>
<td>Term</td>
<td><select id="sem" class="mandatory1" disabled="disabled">
        <option value="">Select Term</option>
    <?php
    if (isset($semester) && !empty($semester)) {
        foreach ($semester as $row) {
            ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['semester']; ?></option>
            <?php
        }
    }
    ?></select>
</td>-->
    <td>Class</td>
    <td id="depertment_list"><select id="department" class="mandatory1" >
            <option value="">Select Class</option>
            <?php
            if (isset($department) && !empty($department)) {
                foreach ($department as $row) {
                    ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['department']; ?></option>
                    <?php
                }
            }
            ?>
        </select></td>

    <td>Section</td>
    <td id="group_list"><select class="mandatory1" disabled="disabled">
            <option value="">Select Section</option>
        </select></td>
    <td>Subject</td>
    <td id="subject_list"><select class="mandatory1" disabled="disabled">
            <option value="">Select Subject</option>
        </select></td>

    <td>Project Number</td>
    <td id="assignment_number"><select class="mandatory1" disabled="disabled">
            <option value="">Select Project</option>
        </select></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
</table>
<input type="button" value="Search" id="search" style="margin-right:20px;" class="btn btn-primary fright" />
<br /><br />
<div id="list_assignment">
</div>
<script type="text/javascript">
    $("#subject_id").live("change", function ()
    {
        var batch = $("#batch").val(),
                department = $("#department").val(),
                group = $("#group_id").val(),
                sem = $("#sem").val();
        var subject_id = $("#subject_id").val();
        //alert(group);
        $.ajax({
            url: BASE_URL + "assignment/get_student_assignment_number",
            type: 'POST',
            data: {batch: batch, department: department, group: group, sem: sem, subject: subject_id},
            success: function (result)
            {
                $("#assignment_number").html(result);

            }

        });


    });
    //


    //get assignments
    $("#search").live("click", function ()
    {
        var result = 0;
        $('.mandatory1').each(function ()
        {

            if ($(this).val() == '' || $(this).val() == null || $(this).val().trim().length == 0 || $(this).val() == '.' || $(this).val() == ',')
            {
                $(this).css('border', '1px solid red');
                result = 1;
            } else {
                $(this).css('border', '1px solid #CCCCCC');

            }

        });
        var batch = $("#batch").val(),
                department = $("#department").val(),
                group = $("#group_id").val(),
                sem = $("#sem").val(),
                subject_id = $("#subject_id").val(),
                ass_number = $("#staff_ass_number").val();

        if (result == 0)
        {
            $.ajax({
                url: BASE_URL + "assignment/get_submitted_assignment_by_subid",
                type: 'POST',
                data: {batch: batch, department: department, group: group, sem: sem, subject: subject_id, ass_number: ass_number},
                success: function (result)
                {
                    $("#list_assignment").html(result);

                }

            });
        } else
        {

        }
    });
    // insert assignment mark for non-upload
    $("#insert_mark").live('click', function ()
    {
        batch = $("#batch").val(),
                department = $("#department").val(),
                group = $("#group_id").val(),
                sem = $("#sem").val(),
                subject_id = $("#subject_id").val(),
                ass_number = $("#staff_ass_number").val();
        m = 0;
        n = 0;
        $('.mark_ass').each(function () {
            if ($(this).val() == '')
            {
                m = 1;
                $(this).css('border', '1px solid red');
            }
        });
        $('.submitted_date').each(function () {
            if ($(this).val() == '')
            {
                n = 1;
                $(this).css('border', '1px solid red');
            }
        });
        i = 0;
        mark_ass = Array();
        $('.mark_ass').each(function () {
            mark_ass[i] = $(this).val();
            i++;
        });
        j = 0;
        student_id = Array();
        $('.student_id').each(function () {
            student_id[j] = $(this).val();
            j++;
        });
        k = 0;
        assign_id = Array();
        $('.assign_id').each(function () {
            assign_id[k] = $(this).val();
            k++;
        });
        y = 0;
        submitted_date = Array();
        $('.submitted_date').each(function () {
            submitted_date[y] = $(this).val();
            y++;
        });
        if (m == 0 && n == 0)
        {
            for_loading('Loading... Project Marks');

            $.ajax({
                url: BASE_URL + "assignment/insert_mark_for_non_upload",
                type: 'POST',
                data:
                        {
                            batch: batch, department: department, group: group, sem: sem, subject: subject_id, ass_number: ass_number,
                            student_id: student_id,
                            assign_id: assign_id,
                            mark_arr: mark_ass,
                            sub_date: submitted_date

                        },
                success: function (result)
                {

                    $("#list_assignment").html(result);
                    for_response(' Project Marks Updated...!');
                }

            });
        }
    });
    // closing the mark update
    $("#close_mark").live('click', function ()
    {
        batch = $("#batch").val(),
                department = $("#department").val(),
                group = $("#group_id").val(),
                sem = $("#sem").val(),
                subject_id = $("#subject_id").val(),
                ass_number = $("#staff_ass_number").val();
        for_loading('Loading... Closing Marks');
        assign_id = $('.assign_id').val();
        $.ajax({
            url: BASE_URL + "assignment/update_close_status",
            type: 'POST',
            data:
                    {
                        batch: batch, department: department, group: group, sem: sem, subject: subject_id, ass_number: ass_number,
                        assign_id: assign_id

                    },
            success: function (result)
            {

                $("#list_assignment").html(result);
                for_response(' Project Marks Handling closed...!');

            }

        });
        $('.modal').css("display", "none");
        $('.fade').css("display", "none");
    });
</script>



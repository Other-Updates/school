<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<script type="text/javascript">

    $('#sem').live('change', function ()
    {

        var sem = $("#sem").val();
        $('#assignment_number').html('');
        if (sem == "" || sem == null)
        {
            window.location.reload();
        } else
        {
            $.ajax({
                url: BASE_URL + "users/get_student_subject",
                type: 'POST',
                data: {sem: sem,
                },
                success: function (result) {

                    //alert(result);
                    $("#list_all").html(result);

                }

            });
        }
    });



</script>

<div class="message-container">
    <div class="message-form-content">
        <div class="message-form-header">
            <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/assignment.png"></div>
            Assignment
        </div>
        <div class="message-form-inner">

            <div class="form-row" style="padding-bottom:0;">
                <label class="field-name">Select Term</label>
                <select id="sem" class="mandatory">
                    <option value="">Select</option>
                    <?php
                    if (isset($semester) && !empty($semester)) {
                        foreach ($semester as $row) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['semester']; ?></option>
                            <?php
                        }
                    }
                    ?></select>
            </div>


            <div class="form-row">
                <table class="form_table" width="100%">
                    <tr>
                        <td id="list_all" style="padding:0; border-color:#fff;"></td>
                        <td id="assignment_number" style="padding:0;  border-color:#fff;"></td>
                    </tr>
                </table>
            </div>
            <div class="view_table">
                <table width="100%">
                    <tr>
                        <td width="20%"></td>
                        <td width="67%"><input type="button" value="Search" id="search" class="btn btn-primary" /></td>
                        <td width="13%">&nbsp;</td>
                    </tr>
                </table>
            </div>

            <div id="list_assignment">
                <?php
                $cur_time = date("Y-m-d");

                if (isset($last_assign) && !empty($last_assign)) {
                    foreach ($last_assign as $billto) {
                        if ($cur_time < $billto["due_date"]) {
                            ?>
                            <div class="view_table">
                                <div class="row">
                                    <div class="six columns">
                                        <table width="100%">
                                            <tr>
                                                <td width="40%">Project Date</td>
                                                <td width="60%" class="text_bold" style="color:green"  ><?php echo date('d-M-Y', strtotime($billto["ldt"])); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Due Date</td>
                                                <td class="text_bold"style="color:red"><?php echo date('d-M-Y', strtotime($billto["due_date"])); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Subject Name</td>
                                                <td class="text_bold"><?php echo $billto['subject_name']; ?></td>
                                            </tr>


                                        </table>


                                    </div>
                                    <div class="six columns">
                                        <table width="100%">
                                            <tr>
                                                <td width="20%">Comments</td>
                                                <td class="text_bold"><?php echo $billto["comments"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Total Marks</td>
                                                <td width="60%" class="text_bold"><?php echo $billto["total"]; ?></td>
                                            </tr>
                                            <tr>
                                                <?php if ($billto["close_status"] == 0) { ?>
                                                    <td>Submit</td>
                                                    <td class="text_bold"><a target="_blank" href="<?= $this->config->item('base_url') . 'users/assignment_upload/' . $billto["id"] ?>" data-toggle="modal" name="group">View</a></td>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <td>Score</td>
                                                    <td class="text_bold"><?php
                                                        if (isset($billto["assignment_details"][0]['score'])) {
                                                            echo $billto["assignment_details"][0]['score'] . "/Assignment Closed";
                                                        } else {
                                                            echo "Assignment is Closed and Score is not updated";
                                                        }
                                                        ?></td>
                                                <?php }
                                                ?>
                                            </tr>

                                        </table>
                                    </div>
                                    <table width="100%">
                                        <tr>
                                            <td>Project Questions</td>
                                            <td class="text_bold"><?php echo $billto["question"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project File</td>
                                            <td class="text_bold"><a href="<?= $this->config->item('base_url') . 'assignment_files/questions/' . $billto['ass_file']; ?>" download="<?= $billto['ass_file'] ?>"><?php echo $billto['ass_file']; ?></a></td>

                                        </tr>
                                        <tr>
                                            <td width="20%">Project Number</td>
                                            <td class="text_bold"><?php echo $billto["ass_number"]; ?></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#subject_id").live("change", function ()
    {
        var sem = $("#sem").val();
        var subject_id = $("#subject_id").val();
        //alert(subject_id);
        $.ajax({
            url: BASE_URL + "users/get_student_assignment_number",
            type: 'POST',
            data: {sem: sem, subject: subject_id},
            success: function (result)
            {
                $("#assignment_number").html(result);

            }

        });
    });


    //get assignments
    $("#search").live("click", function ()
    {
        var result = 0;
        $('.mandatory').each(function ()
        {

            if ($(this).val() == '' || $(this).val() == null)
            {
                $(this).css('border', '1px solid red');
                result = 1;
            } else {
                $(this).css('border', '1px solid #CCCCCC');
                //$(this).tooltip('hide');
            }

        });
        var sem = $("#sem").val(),
                subject_id = $("#subject_id").val(),
                ass_number = $("#student_ass_number").val();
        //alert(ass_number);
        if (result == 0)
        {
            $.ajax({
                url: BASE_URL + "users/get_assignment_byid",
                type: 'POST',
                data: {sem: sem, subject: subject_id, ass_number: ass_number},
                success: function (result)
                {
                    $("#list_assignment").html(result);

                }

            });
        } else
        {
        }
    });

</script>



<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script type="text/javascript">
    $('.mandatory1').live('blur', function ()
    {
        var m = $(this).parent().find(".errormessage");

        if ($(this).val() == '' || $(this).val() == null || $(this).val().trim().length == 0 || $(this).val() == '.' || $(this).val() == ',')
        {
            m.html("Required field");
            i = 1;

        } else
            m.html("");
    });
    $("#ass_qn").live('blur', function ()
    {
        var name = $(this).val();
        var m = $("#ass_error");

        if (name == '' || name == null || name.trim().length == 0)
        {
            m.html("Required field");
        } else if (name.trim().length < 10 || name.trim().length > 1000)
        {
            m.html("Minimum 10 to 1000 characters");

        } else
        {
            m.html("");
        }
    });
    $("#comments").live('blur', function ()
    {
        var comments = $(this).val();
        var m = $("#com_error");

        if (comments.trim().length > 0)
        {
            if (comments.trim().length < 3 || comments.trim().length > 250)
            {
                m.html("Minimum 3 to 250 characters");

            } else
            {
                m.html("");
            }
        }
    });
    $("#total").live('blur', function ()
    {
        var total = $(this).val();
        var m = $("#mark_error");

        if (total == '' || total == null || total.trim().length == 0 || total == 0)
        {
            m.html("Required field");
        } else if (total.trim().length > 3 || total > 100)
        {
            m.html("Invalid Mark");

        } else
        {
            m.html("");
        }
    });

    //get group and subject by department

    $('#department').live('change', function () {
        d_id = $(this);


        $.ajax({
            url: BASE_URL + "assignment/get_group",
            type: 'POST',
            data: {
                dep_id: d_id.val()

            },
            success: function (result) {
                $('#group_list').html(result);

            }
        });
    });
// get subject by group
    $('#group_id').live('change', function () {

        var department = $("#department").val(),
                sem = $("#sem").val(),
                batch = $("#batch").val(),
                group = $("#group_id").val();

        $.ajax({
            url: BASE_URL + "assignment/get_subject_group",
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
<div>
    <form method="post" action="<?php echo $this->config->item('base_url'); ?>assignment/update_assignment" enctype="multipart/form-data" name="sform">
        <table width="100%" class="staff_table">

            <tr>
                <td width="16%">Project QN</td>
                <td colspan="3"><textarea name="ass_qn" id="ass_qn" style="width:100%" class="mandatory1"><?php echo $view_list[0]['question']; ?></textarea><input type="hidden" name="id" value="<?php echo $view_list[0]['id']; ?>"  /> <span style="color:red;" id="ass_error" class="errormessage"></span> </td>
                <td width="17%">&nbsp;</td>
            </tr>
            <tr>
                <td>Added Project File</td>

                <td><?php echo $view_list[0]['ass_file']; ?></td>
                <td>New Project File</td>
                <td><input type="file" name="qn_file" value="<?php $this->config->item("base_url") . 'assignment_files/questions/' . $view_list[0]['ass_file']; ?>"></td>
            </tr>
            <tr>
            <input type="hidden" id="batch" value="<?php echo $batch[0]['id'] ?>" />
            <input type="hidden" id="sem" value="<?php echo $term[0]['id'] ?>" />
<!--                <td>Batch</td>

                <td width="39%">
                    <select name="batch" id="batch" class="mandatory1">
                        <option value="<?php echo $view_list[0]['batch_id']; ?>"><?php echo $view_list[0]['from'] . "-" . $view_list[0]['to']; ?></option>
            <?php
            if (isset($batch) && !empty($batch)) {
                foreach ($batch as $row) {
                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['from'] . '-' . $row['to']; ?></option>
                    <?php
                }
            }
            ?>
                    </select><span style="color:red;" id="batch_error" class="errormessage"></span>
                </td>

                <td width="10%">Term</td>
                <td width="18%">
                    <select name="sem" id="sem" class="mandatory1">
                        <option value="<?php echo $view_list[0]['semester_id']; ?>"><?php echo $view_list[0]['semester']; ?></option>
            <?php
            if (isset($semester) && !empty($semester)) {
                foreach ($semester as $row) {
                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['semester']; ?></option>
                    <?php
                }
            }
            ?>
                    </select><span style="color:red;" id="sem_error" class="errormessage"></span>
                </td>-->
            </tr>
            <tr>
                <td>Class</td>
                <td>
                    <select name="department" id="department" class="mandatory1">
                        <option value="<?php echo $view_list[0]['depart_id']; ?>"><?php echo $view_list[0]['department']; ?></option>
                        <?php
                        if (isset($department) && !empty($department)) {
                            foreach ($department as $row) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['department']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select><span style="color:red;" id="dep_error" class="errormessage"></span>
                </td>

                <td>Group</td>
                <td id="group_list"><select name="group_id" id="group_id" class="mandatory1">
                        <?php
                        if (isset($view_list[0]['group'])) {
                            ?>
                            <option value="<?php echo $view_list[0]['group_id']; ?>"><?php echo $view_list[0]['group'][0]['group']; ?></option>

                            <?php
                        } else {
                            ?>
                            <option value="">Select Group</option>
                            <?php
                        }
                        if (isset($group_list) && !empty($group_list)) {
                            foreach ($group_list as $val) {
                                ?>
                                <option value="<?php echo $val['id']; ?>"><?php echo $val['group']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select> <span style="color:red;" id="group_error" class="errormessage"></span></td>
            </tr>
            <tr>
                <td>Subject:</td>
                <td id="subject_list"><select name="sub_name" id="subject_id" class="mandatory1">
                        <option value="<?php echo $view_list[0]['subject_id']; ?>"><?php echo $view_list[0]['subject_name']; ?></option>
                        <?php
                        if (isset($subject_list) && !empty($subject_list)) {
                            foreach ($subject_list as $val) {
                                ?>
                                <option value="<?php echo $val['id']; ?>"><?php echo $val['subject_name']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select><span style="color:red;" id="sub_error" class="errormessage"></span></td>
            </tr>
        </table>
        <table width="100%" class="staff_table">
            <tr>
                <td width="15%">Comments</td>

                <td colspan="3"><textarea name="comments" style="width:100%" class="mandatory1"><?php echo $view_list[0]['comments']; ?></textarea> <span style="color:red;" id="com_error" class="errormessage"></span></td>
                <td width="8%">&nbsp;</td>
                <td width="9%">&nbsp;</td>
            </tr>
            <tr>
                <td width="11%">Due Date</td>

                <td width="17%"><input type="text" name="d_date" class="date mandatory1" id="d_date" value="<?php echo date("d-m-Y", strtotime($view_list[0]['due_date'])); ?>" /><span style="color:red;" id="date_error" class="errormessage"></span></td>

                <td>Total Marks</td>

                <td width="39%"><input type="text" name="total" class="mandatory1" id="total" value="<?php echo $view_list[0]['total']; ?>" /></td><span style="color:red;" id="mark_error" class="errormessage"></span>
            </tr>
        </table>

        <input type="submit" value="Send" name="adding" id="submit" class="btn btn-primary" />
        <input type="reset" value="Cancel" id="cancel" class="btn btn-danger"/>
    </form>
</div>
<script type="text/javascript">
    $("form[name=sform]").submit(function ()
    {
        var i = 0;
        var ass_qn = $("#ass_qn").val();
        var batch = $("#batch").val();
        var sem = $("#sem").val();
        var department = $("#department").val();
        var group = $("#group_id").val();
        var subject = $("#subject_id").val();

        var comments = $("#comments").val();
        var total = $("#total").val();
        var due_date = $("#d_date").val();
        if (batch == null || batch == "")
        {
            $("#batch_error").html("Required field");
            i = 1;
        }
        if (sem == null || sem == "")
        {
            $("#sem_error").html("Required field");
            i = 1;
        }
        if (department == null || department == "")
        {
            $("#dep_error").html("Required field");
            i = 1;
        }
        if (group == null || group == "")
        {
            $("#group_error").html("Required field");
            i = 1;
        }
        if (subject == null || subject == "")
        {
            $("#sub_error").html("Required field");
            i = 1;
        }

        if (due_date == null || due_date == "")
        {
            $("#date_error").html("Required field");
            i = 1;
        }
        if (ass_qn == "" || ass_qn == null || ass_qn.trim().length == 0)
        {
            $("#ass_error").html("Required field");
            i = 1;
        }

        if (comments.trim().length > 0)
        {
            if (name.trim().length < 3 || name.trim().length > 250)
            {
                $("#com_error").html("Minimum 3 to 250 characters");
                i = 1;
            }
        }

        if (total == '' || total == null || total.trim().length == 0 || total == 0)
        {
            $("#mark_error").html("Required field");
            i = 1;
        } else if (total.trim().length > 3 || total > 100)
        {
            $("#mark_error").html("Invalid Mark");
            i = 1;
        } else if (ass_qn.length < 10 || ass_qn.length > 1000)
        {
            $("#ass_error").html("Minimum 10 to 1000 characters");
            i = 1;
        } else
        {
        }

        if (i == 1)
        {

            return false;
        } else
        {

            return true;
        }

    });
    $("#cancel").click(function ()
    {
        $('.mandatory1').val('');
        $('#comments').val('');
        $('.errormessage').html("");

    });
</script>

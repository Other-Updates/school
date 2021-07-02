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


//    $('#batch').live('change', function ()
//    {
//        var batch = $(this).val();
//        if (batch == "" || batch == null)
//        {
//            $('#sem').attr('disabled', true);
//            $("#department").attr('disabled', true);
//
//            $("#group_id").attr('disabled', true);
//            $("#subject_id").attr('disabled', true);
//            $("#sem").val('');
//            $("#department").val('');
//            $("#group_id").val('');
//            $("#subject_id").val('');
//            $("#ass").val('');
//
//        } else
//        {
//            $('#sem').attr('disabled', false);
//            $("#department").attr('disabled', true);
//
//            $("#group_id").attr('disabled', true);
//            $("#subject_id").attr('disabled', true);
//            $("#sem").val('');
//            $("#department").val('');
//            $("#group_id").val('');
//            $("#subject_id").val('');
//            $("#ass").val('');
//        }
//
//    });




//    $('#sem').live('change', function ()
//    {
//        var sem = $(this).val();
//        if (sem == null || sem == "")
//        {
//            $("#department").attr('disabled', true);
//
//            $("#group_id").attr('disabled', true);
//            $("#subject_id").attr('disabled', true);
//            $("#department").val('');
//            $("#group_id").val('');
//            $("#subject_id").val('');
//            $("#ass").val('');
//        } else
//        {
//            $("#department").attr('disabled', false);
//            $("#group_id").attr('disabled', true);
//            $("#subject_id").attr('disabled', true);
//            $("#department").val('');
//            $("#group_id").val('');
//            $("#subject_id").val('');
//            $("#ass").val('');
//        }
//    });

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
        d_id = $(this).val();
        if (d_id == null || d_id == "")
        {
            $("#group_id").attr('disabled', true);
            $("#subject_id").attr('disabled', true);
            $("#group_id").val('');
            $("#subject_id").val('');
        } else
        {
            $("#group_id").attr('disabled', false);
            $("#subject_id").attr('disabled', true);
            $("#group_id").val('');
            $("#subject_id").val('');
            $.ajax({
                url: BASE_URL + "assignment/get_group",
                type: 'POST',
                data: {
                    dep_id: d_id

                },
                success: function (result) {
                    $('#group_list').html(result);


                }
            });
        }
    });


    // get semster by batch
//    $('#batch').live('change', function ()
//    {
//        var batch = $(this).val();
//
//        $.ajax({
//            url: BASE_URL + "assignment/get_sem",
//            type: 'POST',
//            data: {
//                batch: batch
//            },
//            success: function (result) {
//                $('#sem_show').html(result);
//
//
//            }
//        });
//
//    });




// get subject by group
    $('#group_id').live('change', function () {

        var department = $("#department").val();
        sem = $("#sem").val();
        batch = $("#batch").val();
        group = $("#group_id").val();

        if (group == null || group == "")
        {
            $("#subject_id").attr('disabled', true);

            $("#subject_id").val('');
        } else
        {
            $("#subject_id").attr('disabled', false);

            $("#subject_id").val('');
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
        }
    });
// get assignment number
    $('#subject_id').live('change', function () {

        var batch_id = $("#batch").val();
        var department = $("#department").val();
        var group = $("#group_id").val();
        var subject = $("#subject_id").val();
        var sem = $("#sem").val();
        $.ajax({
            url: BASE_URL + "assignment/get_assignment_number",
            type: 'POST',
            data: {
                batch: batch_id, department: department, group: group, sem: sem, subject: subject

            },
            success: function (result) {
                $('#ass_number').html(result);
                $('#ass_qn').focus();

            }
        });
    });
    // file error
    $("#qn_file").live('change', function () {

        var val = $(this).val();
        //alert(val);
        switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
            case 'doc':
            case 'docx':
            case 'pdf':
            case '':
                $(this).val();
                $("#file_error").html("");
                break;
            default:
                $(this).val();

                $("#file_error").html("Upload Pdf/Doc/Docx");
                break;
        }
    });
    // due date
    /*$('#d_date').live('blur',function()
     {

     var d_date=$(this).val();
     var d=new Date();

     var current_date = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + d.getDate();

     var start_date=$(this).val().split('-');
     var temp=start_date[2]+"-"+start_date[1]+"-"+start_date[0];
     var date1 = Date.parse(temp);
     var date2 = Date.parse(current_date);

     var m=$("#date_error");

     if(d_date=='' || total==null)
     {
     m.html("Required field");
     }
     else if(date1 < date2)
     {
     m.html("Invalid Date Selection");
     }
     else if(temp==end_date)
     {
     m.html("");
     }
     });*/


    $("#d_date").live('change', function ()
    {
        var dateString = $('#d_date').val();
        var today = $('#today').val();
        if (dateString == "")
        {
            $("#date_error").html("Required Field");
        } else if (dateString < today)
        {
            $("#date_error").html("Invalid Date Selection");
        } else
        {
            $("#date_error").html("");
        }
    });
</script>

<div>
    <form method="post" action="<?php echo $this->config->item('base_url'); ?>assignment/insert_assignment" enctype="multipart/form-data" name="sform">
        <table width="100%" class="staff_table">

            <tr>
            <input type="hidden" id="batch" value="<?php echo $batch[0]['id'] ?>" />
            <input type="hidden" id="sem" value="<?php echo $term[0]['id'] ?>" />
            <input type="hidden" value="no" id="refreshed" />
        <!--                <td width="15%">Batch</td>
                        <td width="37%">
                            <select name="batch" id="batch" class="mandatory1 mandatory">
                                <option value="">Select Batch</option>
            <?php
            if (isset($batch) && !empty($batch)) {
                foreach ($batch as $row) {
                    ?>
                                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['from'] . '-' . $row['to']; ?></option>
                    <?php
                }
            }
            ?>
                            </select>
                            <span style="color:red;" id="batch_error" class="errormessage"></span> </td>
                        <td width="14.5%">Term</td>
                        <td width="18%" id="sem_show">
                            <select name="sem" id="sem" class="mandatory1 mandatory" disabled="disabled">
                                <option value="">Select Term</option>
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
                        </td>
                        <td>&nbsp;</td>-->
            </tr>

            <tr>
                <td>Class</td>
                <td><select name="department" id="department" class="mandatory1 mandatory" >
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
                    </select><span style="color:red;" id="dep_error" class="errormessage"></span></td>
                <td>Section</td>
                <td id="group_list"><select name="group_id" id="group_id" class="mandatory1 mandatory" disabled="disabled" >
                        <option value="">Select Section</option>

                    </select> <span style="color:red;" id="group_error" class="errormessage"></span></td>

            </tr>
            <tr>
                <td>Subject</td>
                <td id="subject_list"><select name="sub_name" id="subject_id" class="mandatory1 mandatory" disabled="disabled" >
                        <option value="">Select Subject</option>

                    </select><span style="color:red;" id="sub_error" class="errormessage"></span> </td>

                <td>Project Number</td>
                <td id="ass_number"><input type="text" id="ass" name="ass_number" readonly /><span style="color:red;" id="num_error" class="errormessage"></span> </td>
            </tr>
        </table>
        <table width="100%" class="staff_table">
            <tr>
                <td width="15%">Project QN</td>
                <td colspan="3"><textarea id="ass_qn" name="ass_qn" style="width:100%;height:100px;" class="mandatory1 mandatory"></textarea>
                    <span style="color:red;" id="ass_error" class="errormessage"></span> </td>
                <td width="17%">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td width="10%"><input type="file" id="qn_file" name="qn_file"  /><span style="color:red;" id="file_error" class="errormessage1"></span></td>

                <td width="15%">Student Upload Status</td>
                <td><select id="status" name="status" class="mandatory1 mandatory">
                        <option value="">Select Status</option>
                        <option value="1">Upload</option>
                        <option value="0">Non Upload</option>
                    </select> <span style="color:red;" id="status_error" class="errormessage"></span></td>
            </tr>
            <tr>
                <td width="16%">Comments</td>
                <td colspan="3"><textarea id="comments" name="comments" style="width:100%" ></textarea><span style="color:red;" id="com_error" class="errormessage"></span></td>
                <td width="8%">&nbsp;</td>
                <td width="9%">&nbsp;</td>
            </tr>
            <tr>
                <td>Total Marks</td>
                <td width="39%"><input type="text" id="total" name="total" maxlength="3" class="int_val mandatory1 mandatory" /><span style="color:red;" id="mark_error" class="errormessage"></span></td>
                <td width="11%">Due Date </td>
                <td width="17%"><input type="text" class="date mandatory1 mandatory" id="d_date" name="d_date" />
                    <input type="hidden" id="today" value="<?php echo $i = date("d-m-y"); ?>" /><span style="color:red;" id="date_error" class="errormessage"></span></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <br />
        <input type="button" value="Cancel" id="cancel" class="btn btn-danger"/>
        <div class="right"><input type="submit" value="Send" name="adding" id="submit" class="btn btn-primary" style="float:left;"/></div>
        <br />
    </form>
</div>
<br />
<!-- /.tab-pane -->


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
        var status = $("#status").val();
        var comments = $("#comments").val();
        var total = $("#total").val();
        var due_date = $("#d_date").val();
        var message = $("#file_error").html();
        var date_error = $("#date_error").html();
        if (message.trim().length > 0)
        {

            i = 1;
        }

        if (status == null || status == "")
        {
            $("#status_error").html("Required field");
            $("#status").css('border', '1px solid red');
            i = 1;
        }
        if (batch == null || batch == "")
        {
            $("#batch_error").html("Required field");
            $("#batch").css('border', '1px solid red');
            i = 1;
        }

        if (sem == null || sem == "")
        {
            $("#sem_error").html("Required field");
            $("#sem").css('border', '1px solid red');
            i = 1;
        }
        if (department == null || department == "")
        {
            $("#dep_error").html("Required field");
            $("#department").css('border', '1px solid red');
            i = 1;
        }
        if (group == null || group == "")
        {
            $("#group_error").html("Required field");
            $("#group_id").css('border', '1px solid red');
            i = 1;
        }
        if (subject == null || subject == "")
        {
            $("#sub_error").html("Required field");
            $("#subject_id").css('border', '1px solid red');
            i = 1;
        }

        if (due_date == null || due_date == "")
        {
            $("#date_error").html("Required field");
            $("#d_date").css('border', '1px solid red');
            i = 1;
        }
        if (ass_qn == null || ass_qn == "" || ass_qn.trim().length == 0)
        {
            $("#ass_error").html("Required field");
            $("#ass_qn").css('border', '1px solid red');
            i = 1;
        }

        if (comments.trim().length > 0)
        {
            if (comments.trim().length < 3 || comments.trim().length > 250)
            {
                $("#com_error").html("Minimum 3 to 250 characters");
                $("#comments").css('border', '1px solid red');
                i = 1;

            }
        }

        if (total == '' || total == null || total.trim().length == 0 || total == 0)
        {
            $("#mark_error").html("Required field");
            $("#total").css('border', '1px solid red');
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
        var dateString = $('#d_date').val();
        var today = $('#today').val();
        if (dateString == "")
        {
            $("#date_error").html("Required Field");
            i = 1;
        } else if (dateString < today)
        {
            $("#date_error").html("Invalid Date Selection");
            i = 1;
        } else
        {
            $("#date_error").html("");
        }
        if (i == 1)
        {

            return false;
        } else
        {
            for_loading('Adding Project.....!');
            return true;
        }

    });
    $("#cancel").live('click', function ()
    {
        $('.mandatory1').val('');
        $('#comments').val('');
        $('#ass').val('');
        $('#qn_file').val('');
        $('.errormessage').html("");
        $('#file_error').html("");
        $('.mandatory').css('border', '1px solid #CCCCCC');

    });
</script>

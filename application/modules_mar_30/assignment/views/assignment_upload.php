<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>


<form method="post" name="sform" action="<?php echo $this->config->item('base_url'); ?>assignment/insert_assignment_mark" >
    <input type="hidden" name="ass_id" value="<?php echo $enter_mark[0]['ass_details'][0]['id']; ?>">
    <input type="hidden" name="student_id" value="<?php echo $enter_mark[0]['student_id']; ?>">
    <div class="row">
        <div class="col-lg-6">
            <table class="staff_table" width="100%">
                <tr>
                    <td width="200">Student Name</td>
                    <td colspan="3" class="text_bold"><?php echo $enter_mark[0]['std_details'][0]['name'] . "  " . $enter_mark[0]['std_details'][0]['last_name']; ?></td>
                </tr>

                <tr>
                    <td>Academic Year</td>
                    <td colspan="3" class="text_bold"><?php echo $enter_mark[0]['batch'][0]['from']; ?></td>
                </tr>
                <tr>
                    <td>Class</td>
                    <td colspan="3" class="text_bold"><?php echo $enter_mark[0]['department'][0]['department']; ?></td>
                </tr>
                <tr>
                    <td>Section</td>
                    <td colspan="3" class="text_bold"><?php echo $enter_mark[0]['group'][0]['group']; ?></td>
                </tr>

                <tr>
                    <td>Project Date</td>
                    <td colspan="3" class="text_bold"><?php echo date('d-m-Y', strtotime($enter_mark[0]['ass_details'][0]['ldt'])); ?></td>
                </tr>

                <tr>
                    <td>Submitted Date</td>
                    <td class="text_bold" colspan="3"><?php
                        if ($enter_mark[0]['ass_details'][0]['ass_type'] == 0) {
                            ?>
                            <input type="text" class="date" value="<?php
                            if ($enter_mark[0]['assign'][0]['sub_date'] == '0000-00-00') {
                                echo '';
                            } else {
                                echo date("d-m-Y", strtotime($enter_mark[0]['assign'][0]['sub_date']));
                            }
                            ?>" name="submitted_date" />
                                   <?php
                               } else {
                                   echo date("d-m-Y", strtotime($enter_mark[0]['assign'][0]['sub_date']));
                               }
                               ?></td>
                </tr>
                <tr>
                    <td>File Name</td>
                    <td colspan="3" class="text_bold">
                        <?php
                        if (isset($enter_mark[0]['assign'][0])) {
                            ?>
                            <a  href="<?= $this->config->item('base_url') . 'assignment_files/' . $enter_mark[0]['assign'][0]['file_name']; ?>" <?php echo $enter_mark[0]['assign'][0]['file_name']; ?>><?php echo $enter_mark[0]['assign'][0]['file_name']; ?></a>
                            <?php
                        }
                        ?>

                    </td>

                </tr>
                <tr>
                    <td>Enter Mark</td>
                    <td class="text_bold" width="50"><input type="text" id="score" name="ass_marks" value="<?php echo $enter_mark[0]['assign'][0]['score']; ?>" style="width:50px" class="int_val" maxlength="<?php echo strlen($enter_mark[0]['ass_details'][0]['total']); ?>" /></td>
                    <td class="text_bold" width="5"><strong>/</strong></td>
                    <td class="text_bold"><input type="text" id="total" value="<?php echo $enter_mark[0]['ass_details'][0]['total']; ?>" readonly="readonly" style="width:50px" /></td>  <td><span style="color:red;" id="mark_error" class="errormessage"></span></td>
                </tr>
                <tr>
                    <td>Due Date</td>
                    <td colspan="3" class="text_bold red"><?php echo date('d-m-Y', strtotime($enter_mark[0]['ass_details'][0]['due_date'])); ?></td>
                </tr>
                <tr>
                    <td></td><td colspan="3"><input type="submit" class="btn btn-success" value="Enter Mark" id="close_window"></td>
                </tr>

            </table>
        </div>
        <?php
        if (isset($enter_mark[0]['assign'][0]['file_name']) && !empty($enter_mark[0]['assign'][0]['file_name'])) {
            ?>
            <div class="col-lg-6">
                <iframe src="http://docs.google.com/gview?url=<?= $this->config->item('base_url') . 'assignment_files/' . $enter_mark[0]['assign'][0]['file_name']; ?>&embedded=true" style="width:100%; height:400px;" frameborder="0"></iframe>
            </div>
            <?php
        }
        ?>
    </div>




</form>






<script type="text/javascript">


    $("form[name=sform]").submit(function ()
    {
        var i = 0;
        var error = $('#mark_error').html();
        var score = $("#score").val();
        var total = $("#total").val();
        if (score == '' || score == null || score.trim().length == 0)
        {
            $('#mark_error').html("Required field");
            i = 1
        } else if (parseFloat(score) > parseInt(total))
        {
            $('#mark_error').html("Invalid Mark");
            i = 1

        } else
        {
            $('#mark_error').html("");
        }
        if (error.trim().length == 0 && i == 0)
        {


            alert("Mark Updated Successfully.");
            return true;
            //alert("The request has been submitted.");
            //window.close();
        } else
        {
            return false;
        }
    });
    $("#score").live('blur', function ()
    {
        //alert($(this).val());
        var score = $(this).val();
        var total = $("#total").val();

        var m = $("#mark_error");

        if (score == null || score == '' || score.trim().length == 0)
        {
            m.html("Required field");
        } else if (parseFloat(score) > parseInt(total))
        {

            m.html("Invalid Mark");

        } else
        {
            m.html("");
        }
    });
</script>

<!-- http://'.$_SERVER['HTTP_HOST'].'/software-i2/trunk/codes/i2_software/' -->







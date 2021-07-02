<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script type="text/javascript">
    var BASE_URL = '<?php echo $this->config->item('base_url'); ?>';
    var sess = '<?php echo $this->user_auth->get_username(); ?>';
</script>
<style type="text/css">
    .my_notice img{width: 44px; height: 44px; border-radius: 5px; border: 3px solid rgba(0,0,0,0.1);}
</style>

<script type="text/javascript">
    $('.mandatory1').live('blur', function ()
    {
        var m = $(this).parent().find(".errormessage");

        if ($(this).val() == '' || $(this).val() == null || $(this).val().trim().length == 0)
        {
            m.html("Required field");
            i = 1;

        } else
        {
            m.html("");
        }
    });
    $("#notice_to").live('change', function ()
    {
        var nt = $(this).val();
        if (nt == '' || nt == null)
        {
            $("#nt_error").html('Required Field');
        } else
        {
            $("#nt_error").html('');

        }
    });
    $("#group_id").live('change', function ()
    {
        var gr = $(this).val();
        if (gr == '' || gr == null)
        {
            $("#group_error").html('Required Field');
        } else
        {
            $("#group_error").html('');

        }
    });
    $("#from_date").live('blur', function ()
    {
        var from = $(this).val();
        if (from == '' || from == null)
        {
            $("#from_error").html('Required Field');
        } else
        {
            $("#to_date").val('');
            $("#from_error").html('');
            $("#due_error").html('');
        }
    });
    $("#to_date").live('blur', function ()
    {
        var to = $(this).val();
        var startDate = $('#from_date').val().split('-');
        var endDate = $('#to_date').val().split('-');
        var d1 = startDate[2] + "-" + startDate[1] + "-" + startDate[0];
        var d2 = endDate[2] + "-" + endDate[1] + "-" + endDate[0];
        var date1 = Date.parse(d1);
        var date2 = Date.parse(d2);

        if (to == '' || to == null)
        {
            $("#due_error").html('Required Field');
        } else if (date1 > date2) {

            $("#due_error").html('Select Valid Dates');
        } else
        {
            $("#due_error").html('');

        }
    });

    $("#department").live('blur', function ()
    {

        var dep = $(this).val();
        if (dep == '' || dep == null)
        {
            $("#dep_error").html('Required Field');
            $("#department").css('border', '1px solid red');
        } else
        {
            $("#dep_error").html('');
            $("#department").css('border', '1px solid #CCCCCC');
        }
    });




    $("#notice").live('blur', function ()
    {
        var notice = $(this).val();

        if (notice == '' || notice == null || notice.trim().length == 0 || notice == 0)
        {
            $("#notice_error").html("Required Field");
            $("#notice").css('border', '1px solid red');
        } else if (notice.trim().length < 10 || notice.trim().length > 2000)
        {
            $("#notice_error").html("Minimum 10 to 1000 characters");
            $("#notice").css('border', '1px solid red');
        } else
        {
            $("#notice_error").html("");
            $("#notice").css('border', '');
        }
    });
    $("#department").live('change', function ()
    {

        var department = $(this).val();

        $.ajax({
            url: BASE_URL + "admin/get_group",
            type: 'POST',
            data: {dep: department
            },
            success: function (result) {

                //alert(result);
                $("#group_list").html(result);


            }

        });
    });




    $("#submit").live('click', function ()
    {
        var i = 0;
        var message = $("#file_error").html();
        var notice_to = $("#notice_to").val();
        var department = $("#department").val();
        var group = $("#group_id").val();
        var from = $("#from_date").val();
        var to = $("#to_date").val();
        var notice = $("#notice").val();
        var startDate = $('#from_date').val().split('-');
        var endDate = $('#to_date').val().split('-');
        var d1 = startDate[2] + "-" + startDate[1] + "-" + startDate[0];
        var d2 = endDate[2] + "-" + endDate[1] + "-" + endDate[0];
        var date1 = Date.parse(d1);
        var date2 = Date.parse(d2);
        if (message.trim().length != 0)
        {
            i = 1;
        }
        if ($("#my_radio1").prop("checked"))
        {
            var notice_type = $("#my_radio1").val();
        }
        if ($("#my_radio").prop("checked"))
        {

            var notice_type = $("#my_radio").val();
            if (department == '' || department == null)
            {
                $("#dep_error").html('Required Field');
                $("#department").css('border', '1px solid red');
                i = 1;
            }
            if (notice_to == '' || notice_to == null)
            {
                $("#nt_error").html('Required Field');
                $("#notice_to").css('border', '1px solid red');
                i = 1;
            }
            var gr = $("#group_id").val();
            if (gr == '' || gr == null)
            {
                $("#group_error").html('Required Field');
                $("#group_id").css('border', '1px solid red');
                i = 1;
            } else
            {
                $("#group_error").html('');

            }

        }
        if (notice_to == '' || notice_to == null)
        {
            $("#nt_error").html('Required Field');
            $("#notice_to").css('border', '1px solid red');
            i = 1;
        }
        if (from == '' || from == null)
        {
            $("#from_error").html('Required Field');
            $("#from_date").css('border', '1px solid red');
            i = 1;
        }
        if (to == '' || to == null)
        {
            $("#due_error").html('Required Field');
            $("#to_date").css('border', '1px solid red');
            i = 1;
        } else if (date1 > date2)
        {

            $("#due_error").html('Select Valid Dates');
            i = 1;
        }
        if (notice == '' || notice == null || notice.trim().length == 0 || notice == 0)
        {
            $("#notice_error").html("Required Field");
            $("#notice").css('border', '1px solid red');
            i = 1;
        } else if (notice.trim().length < 10 || notice.trim().length > 2000)
        {
            $("#notice_error").html("Minimum 10 to 1000 characters");
            $("#notice").css('border', '1px solid red');
            i = 1;
        } else
        {
            $("#notice_error").html("");
            $("#notice").css('border', '');
        }
        /*if(notice.trim().length==0)
         {
         $("#notice_error").html('Required Field');
         $(".nicEdit-main").css('border','1px solid red');
         i=1;
         }
         else if(notice.trim().length>10 || notice.trim().length>2000)
         {
         $("#notice_error").html('Minimum 10 to 1000 characters');
         $(".nicEdit-main").css('border','1px solid red');
         i=1;
         }*/


        if (i == 0)
        {
            for_response('Notice Added Successfully...!');
            return true;
        } else
        {
            return false;
        }
    });

</script>

<div>

    <form action="<?php echo $this->config->item('base_url'); ?>admin/insert_notice" enctype="multipart/form-data" name="sform" method="post">
        <table class="form_table" width="100%">
            <tr>
                <td width="16%">Notice to</td>
                <td>
                    <input class="public" id="my_radio1" type="radio" name="type" value="0" checked="checked" />
                    <label for="my_radio" style="font-weight:normal">Public</label>&nbsp;&nbsp;
                    <input id="my_radio" type="radio" name="type"   value="1" />
                    <label for="my_radio" style="font-weight:normal">Class</label>
                    <span style="color:red;" id="name_error" class="errormessage"></span></td>
            </tr>
        </table>
        <table class="form_table"  id="show-me" style="display:none" width="100%">

            <tr>
                <td width="45%">Select Class</td>
                <td>
                    <select id="department" name="department" class="">
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
                    </select><span style="color:red;" id="dep_error" class="errormessage"></span>
                </td>
            </tr>
            <tr>
                <td>Section</td>
                <td id="group_list"><select id="group_id" name="group_id">
                        <option value="">Select Section</option>
                    </select> <span style="color:red;" id="group_error" class="errormessage"></span></td>
            </tr>

        </table>
        <table class="form_table" width="100%">
            <tr>
                <td>Select Notice to</td>
                <td>
                    <select id='notice_to' name='notice_to' class="mandatory1 mandatory" >
                        <option value="">Select</option>
                        <option value="1">Student</option>
                        <option value="2">Staff</option>
                        <option value="3">Student and Staff</option>

                    </select><span style="color:red;" id="nt_error" class="errormessage"></span>
                </td>
            </tr>
            <tr>
                <td>From Date</td>
                <td><input type="text"  id="from_date" name="from_date" class="date mandatory1 mandatory"  /><span style="color:red;" id="from_error" class="errormessage"></span> <td></td></td>
            </tr>
            <tr>
                <td>Due Date</td>
                <td><input type="text" class="date mandatory1 mandatory" name="to_date" id="to_date"/><span style="color:red;" id="due_error" class="errormessage"></span></td>
            </tr>
            <tr>
                <td>Notice File</td>
                <td><input type="file" class="notes_val" name="notice_file" id="notice_file"/><span style="color:red;" id="file_error" class="errormessage"></span></td>
            </tr>
            <!--<tr>
            <td style="vertical-align:top">Notice</td>
            <td colspan="3"><textarea id="notice" name="notice"  style="width:86%;height:50px;" class="mandatory1 " ></textarea><span style="color:red;" id="notice_error" class="errormessage"></span>
            </td>
          </tr>-->
            <tr>
                <td width="16%">Notice</td>
                <td colspan="3">
                    <textarea id="notice" name="notice" style="height:75px; width:50%; outline: none;" class="mandatory1"></textarea>
                    <!--<textarea id="notice" name="notice"  style="width:86%;height:50px;" class="mandatory1 " ></textarea>-->
                    <span style="color:red;" id="notice_error" class="errormessage"></span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Post" id="submit"  class="btn btn-primary"/> &nbsp;<input type="button" value="cancel" name="cancel" class="btn btn-danger" id="cancel"/></td>
            </tr>
        </table>
    </form>


</div>
<div id="list_all">
<?php
$user_det = $this->session->userdata('logged_in');
if (isset($notice) && !empty($notice)) {
    foreach ($notice as $val) {
        if ($val['notice_type'] == 1) {

            if ($val['view_type'] == 1 && $user_det['user_id'] == $val['created_by'] && $user_det['staff_type'] == $val['staff_type']) {
                ?>
                    <div class="my_notice notice">
                <?php
                if ($user_det['staff_type'] == 'admin') {
                    ?>
                            <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                    <?php
                }
                if ($user_det['staff_type'] == $val['staff_type'] && $user_det['user_id'] == $val['created_by']) {
                    ?>
                            <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                        <?php
                    }
                    ?>
                        <table width="100%" class="staff_table">

                            <tr>
                                <td width="10%">Posted By</td><td class="text_bold red"><?php echo ucfirst($val['staff'][0]['name']); ?></td>
                                <td>To Class</td><td class="text_bold">
                    <?php
                    if (isset($val['department'][0])) {
                        echo $val['department'][0]['department'] . "&nbsp;-&nbsp;";
                        if (isset($val['group'][0])) {
                            echo $val['group'][0]['group'];
                        }
                    } else {
                        echo "For all&nbsp;";
                        if ($val['view_type'] == 0) {
                            echo "";
                        } else if ($val['view_type'] == 1) {
                            echo "Student";
                        } else if ($val['view_type'] == 2) {
                            echo "Staff";
                        } else if ($val['view_type'] == 3) {
                            echo "";
                        }
                    }
                    ?></td>
                                <td>From Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></td>
                                <td>Due Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></td>
                            </tr>
                            <tr>
                                <td>Notice</td><td colspan="7" class="text_bold"><?php echo $val['notice']; ?></td>
                                    <?php
                                    if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                                        $temp = explode(".", $val['notice_file']);
                                        $ext = end($temp);
                                        $txt = 'txt';
                                        $docx = 'docx';
                                        $pdf = 'pdf';
                                        $zip = 'zip';
                                        $rar = 'rar';
                                        $image = 'jpg';
                                        $image1 = 'jpeg';
                                        $image2 = 'bmp';
                                        $doc = 'doc';
                                        $image3 = 'png';
                                        $image4 = 'xps';
                                        ?>
                                    <td><?php
                                        if ($ext == $txt) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                                    <?php
                                    } else if ($ext == $doc) {
                                        ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                    <?php
                    } else if ($ext == $pdf) {
                        ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                    <?php } else if ($ext == $zip) {
                        ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                                        <?php } else if ($ext == $rar) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                                        <?php
                                        } else if ($ext == $image) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                      /> </a>

                                        <?php
                                        } else if ($ext == $image1) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                     /></a>

                                        <?php
                                        } else if ($ext == $image2) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                     /></a>

                                        <?php
                                        } else if ($ext == $image3) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                     /></a>

                                        <?php
                                        } else if ($ext == $docx) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                                        <?php
                                        } else if ($ext == $image2) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                    <?php } else {
                        ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                                        <?php } ?></td>
                <?php } ?>
                            </tr>
                        </table>
                    </div>
                                    <?php
                                } else if ($val['view_type'] == 0 || $val['view_type'] == 2 || $val['view_type'] == 3) {
                                    if ($user_det['staff_type'] == 'staff') {
                                        if ($val['depart_id'] == 0 || $val['depart_id'] == $user_det['department_id']) {
                                            ?>
                            <div class="my_notice notice">
                        <?php
                        if ($user_det['staff_type'] == 'admin') {
                            ?>
                                    <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                <?php
                            }
                            if ($user_det['staff_type'] == $val['staff_type'] && $user_det['user_id'] == $val['created_by']) {
                                ?>
                                    <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                <?php
                            }
                            ?>
                                <table width="100%" class="staff_table">
                                    <tr>
                                        <td width="10%">Posted BY</td><td  class="text_bold red"><?php echo ucfirst($val['staff'][0]['name']); ?></td>
                                        <td >To Class</td><td class="text_bold">
                                <?php
                                if (isset($val['department'][0])) {
                                    echo $val['department'][0]['department'] . "&nbsp;-&nbsp;";
                                    if (isset($val['group'][0])) {
                                        echo $val['group'][0]['group'];
                                    }
                                } else {
                                    echo "For all&nbsp;";
                                    if ($val['view_type'] == 0) {
                                        echo "";
                                    } else if ($val['view_type'] == 1) {
                                        echo "Student";
                                    } else if ($val['view_type'] == 2) {
                                        echo "Staff";
                                    } else if ($val['view_type'] == 3) {
                                        echo "";
                                    }
                                }
                                ?></td>
                                        <td >From Date</td><td  class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></td>
                                        <td >Due Date</td><td  class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Notice</td>
                                        <td colspan="5" class="text_bold"><?php echo $val['notice']; ?></td>
                                            <?php
                                            if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                                                $temp = explode(".", $val['notice_file']);
                                                $ext = end($temp);
                                                $txt = 'txt';
                                                $docx = 'docx';
                                                $pdf = 'pdf';
                                                $zip = 'zip';
                                                $rar = 'rar';
                                                $image = 'jpg';
                                                $image1 = 'jpeg';
                                                $image2 = 'bmp';
                                                $doc = 'doc';
                                                $image3 = 'png';
                                                $image4 = 'xps';
                                                ?>
                                            <td><?php
                                                if ($ext == $txt) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                                                <?php
                                                } else if ($ext == $doc) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                                                <?php
                                                } else if ($ext == $pdf) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                                                <?php } else if ($ext == $zip) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                                                <?php } else if ($ext == $rar) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                                                <?php
                                                } else if ($ext == $image) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                              /> </a>

                                                <?php
                                                } else if ($ext == $image1) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                             /></a>

                                                <?php
                                                } else if ($ext == $image2) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                             /></a>

                                                <?php
                                                } else if ($ext == $image3) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                             /></a>

                                                <?php
                                                } else if ($ext == $docx) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                                                <?php
                                                } else if ($ext == $image2) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                                                <?php } else {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                                                <?php } ?></td>
                                            <?php } ?>
                                    </tr>
                                </table>
                            </div>
                            <?php
                        }
                    } else if ($user_det['staff_type'] == 'admin') {
                        ?>

                        <div class="my_notice notice">
                        <?php
                        if ($user_det['staff_type'] == 'admin') {
                            ?>
                                <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                <?php
                            }
                            if ($user_det['staff_type'] == $val['staff_type'] && $user_det['user_id'] == $val['created_by']) {
                                ?>
                                <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                <?php
                            }
                            ?>
                            <table width="100%" class="staff_table">
                                <tr>
                                    <td width="10%">Posted BY</td><td class="text_bold red"><?php echo ucfirst($val['staff'][0]['name']); ?></td>
                                    <td>To Class</td><td class="text_bold">
                            <?php
                            if (isset($val['department'][0])) {
                                echo $val['department'][0]['department'] . "&nbsp;-&nbsp;";
                                if (isset($val['group'][0])) {
                                    echo $val['group'][0]['group'];
                                }
                            } else {
                                echo "For all&nbsp;";
                                if ($val['view_type'] == 0) {
                                    echo "";
                                } else if ($val['view_type'] == 1) {
                                    echo "Student";
                                } else if ($val['view_type'] == 2) {
                                    echo "Staff";
                                } else if ($val['view_type'] == 3) {
                                    echo "";
                                }
                            }
                            ?></td>
                                    <td>From Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></td>
                                    <td>Due Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></td>
                                </tr>
                                <tr>
                                    <td>Notice</td><td colspan="5" class="text_bold"><?php echo $val['notice']; ?></td>
                    <?php
                    if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                        $temp = explode(".", $val['notice_file']);
                        $ext = end($temp);
                        $txt = 'txt';
                        $docx = 'docx';
                        $pdf = 'pdf';
                        $zip = 'zip';
                        $rar = 'rar';
                        $image = 'jpg';
                        $image1 = 'jpeg';
                        $image2 = 'bmp';
                        $doc = 'doc';
                        $image3 = 'png';
                        $image4 = 'xps';
                        ?>
                                        <td><?php
                                            if ($ext == $txt) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                                            <?php
                                            } else if ($ext == $doc) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                                            <?php
                                            } else if ($ext == $pdf) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                                            <?php } else if ($ext == $zip) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                        <?php } else if ($ext == $rar) {
                            ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                                            <?php
                                            } else if ($ext == $image) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                          /> </a>

                                            <?php
                                            } else if ($ext == $image1) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                            <?php
                                            } else if ($ext == $image2) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                            <?php
                                            } else if ($ext == $image3) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                            <?php
                                            } else if ($ext == $docx) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                        <?php
                        } else if ($ext == $image2) {
                            ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                            <?php } else {
                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                            <?php } ?></td>
                        <?php } ?>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                }
            } else if ($val['notice_type'] == 0) {

                if ($user_det['staff_type'] == 'staff') {
                    if ($val['view_type'] == 1 && $user_det['user_id'] == $val['created_by'] && $user_det['staff_type'] == $val['staff_type']) {
                        ?>
                        <div class="my_notice notice">
                            <?php
                            if ($user_det['staff_type'] == 'admin') {
                                ?>
                                <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                <?php
                            }
                            if ($user_det['staff_type'] == $val['staff_type'] && $user_det['user_id'] == $val['created_by']) {
                                ?>
                                <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                <?php
                            }
                            ?>
                            <table width="100%" class="staff_table">
                                <tr>
                                    <td width="10%">Posted BY</td><td class="text_bold red"><?php echo ucfirst($val['staff'][0]['name']); ?></td>
                                    <td>To Class</td><td class="text_bold">
                                        <?php
                                        if (isset($val['department'][0])) {
                                            echo $val['department'][0]['department'] . "&nbsp;-&nbsp;";
                                            if (isset($val['group'][0])) {
                                                echo $val['group'][0]['group'];
                                            }
                                        } else {
                                            echo "For all&nbsp;";
                                            if ($val['view_type'] == 0) {
                                                echo "";
                                            } else if ($val['view_type'] == 1) {
                                                echo "Student";
                                            } else if ($val['view_type'] == 2) {
                                                echo "Staff";
                                            } else if ($val['view_type'] == 3) {
                                                echo "";
                                            }
                                        }
                                        ?></td>
                                    <td>From Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></td>
                                    <td>Due Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></td>
                                </tr>
                                <tr>
                                    <td>Notice</td><td colspan="5" class="text_bold"><?php echo $val['notice']; ?></td>
                                        <?php
                                        if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                                            $temp = explode(".", $val['notice_file']);
                                            $ext = end($temp);
                                            $txt = 'txt';
                                            $docx = 'docx';
                                            $pdf = 'pdf';
                                            $zip = 'zip';
                                            $rar = 'rar';
                                            $image = 'jpg';
                                            $image1 = 'jpeg';
                                            $image2 = 'bmp';
                                            $doc = 'doc';
                                            $image3 = 'png';
                                            $image4 = 'xps';
                                            ?>
                                        <td><?php
                        if ($ext == $txt) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                                            <?php
                                            } else if ($ext == $doc) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                        <?php
                        } else if ($ext == $pdf) {
                            ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                                            <?php } else if ($ext == $zip) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                                            <?php } else if ($ext == $rar) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                        <?php
                        } else if ($ext == $image) {
                            ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                          /> </a>

                        <?php
                        } else if ($ext == $image1) {
                            ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                            <?php
                                            } else if ($ext == $image2) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                        <?php
                        } else if ($ext == $image3) {
                            ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                            <?php
                                        } else if ($ext == $docx) {
                                            ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                            <?php
                            } else if ($ext == $image2) {
                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                                <?php } else {
                                    ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                                <?php } ?></td>
                            <?php } ?>
                                </tr>
                            </table>
                        </div>
                            <?php
                        }
                        if ($val['view_type'] == 0 || $val['view_type'] == 2 || $val['view_type'] == 3) {
                            ?>
                        <div class="my_notice notice">
                            <?php
                            if ($user_det['staff_type'] == 'admin') {
                                ?>
                                <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                        <?php
                    }
                    if ($user_det['staff_type'] == $val['staff_type'] && $user_det['user_id'] == $val['created_by']) {
                        ?>
                                <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                            <?php
                                        }
                                        ?>
                            <table width="100%" class="staff_table">
                                <tr>
                                    <td width="10%">Posted By</td><td class="text_bold red"><?php echo ucfirst($val['staff'][0]['name']); ?></td>
                                    <td>To Class</td><td class="text_bold">
                    <?php
                    if (isset($val['department'][0])) {
                        echo $val['department'][0]['department'] . "&nbsp;-&nbsp;" . $val['group'][0]['group'];
                    } else {
                        echo "For all&nbsp;";
                        if ($val['view_type'] == 0) {
                            echo "";
                        } else if ($val['view_type'] == 1) {
                            echo "Student";
                        } else if ($val['view_type'] == 2) {
                            echo "Staff";
                        } else if ($val['view_type'] == 3) {
                            echo "";
                        }
                    }
                    ?></td>
                                    <td>From Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></td>
                                    <td>Due Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></td>
                                </tr>
                                <tr>
                                    <td>Notice</td><td colspan="5" class="text_bold"><?php echo $val['notice']; ?></td>
                                        <?php
                                        if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                                            $temp = explode(".", $val['notice_file']);
                                            $ext = end($temp);
                                            $txt = 'txt';
                                            $docx = 'docx';
                                            $pdf = 'pdf';
                                            $zip = 'zip';
                                            $rar = 'rar';
                                            $image = 'jpg';
                                            $image1 = 'jpeg';
                                            $image2 = 'bmp';
                                            $doc = 'doc';
                                            $image3 = 'png';
                                            $image4 = 'xps';
                                            ?>
                                        <td><?php
                                            if ($ext == $txt) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                        <?php
                        } else if ($ext == $doc) {
                            ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                                            <?php
                                            } else if ($ext == $pdf) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                                            <?php } else if ($ext == $zip) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                        <?php } else if ($ext == $rar) {
                            ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                                            <?php
                                            } else if ($ext == $image) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                          /> </a>

                                            <?php
                                            } else if ($ext == $image1) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                            <?php
                                            } else if ($ext == $image2) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                            <?php
                            } else if ($ext == $image3) {
                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                <?php
                                } else if ($ext == $docx) {
                                    ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                                <?php
                                } else if ($ext == $image2) {
                                    ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                                <?php } else {
                                    ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                        <?php } ?></td>
                    <?php } ?>
                                </tr>
                            </table>
                        </div>
                                        <?php
                                    }
                                } else if ($user_det['staff_type'] == 'admin') {
                                    ?>
                    <div class="my_notice notice">
                                    <?php
                                    if ($user_det['staff_type'] == 'admin') {
                                        ?>
                            <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                    <?php
                }
                if ($user_det['staff_type'] == $val['staff_type'] && $user_det['user_id'] == $val['created_by']) {
                    ?>
                            <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                <?php
                            }
                            ?>
                        <table width="100%" class="staff_table">
                            <tr>
                                <td width="10%">Posted By</td><td class="text_bold red"><?php echo ucfirst($val['staff'][0]['name']); ?></td>
                                <td>To Class</td><td class="text_bold">
                                <?php
                                if (isset($val['department'][0])) {
                                    echo $val['department'][0]['department'] . "&nbsp;-&nbsp;" . $val['group'][0]['group'];
                                } else {
                                    echo "For all&nbsp;";
                                    if ($val['view_type'] == 0) {
                                        echo "";
                                    } else if ($val['view_type'] == 1) {
                                        echo "Student";
                                    } else if ($val['view_type'] == 2) {
                                        echo "Staff";
                                    } else if ($val['view_type'] == 3) {
                                        echo "";
                                    }
                                }
                                ?></td>
                                <td>From Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></td>
                                <td>Due Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></td>
                            </tr>
                            <tr>

                            <label>Noticed</label><div><?php echo $val['notice']; ?></div>
                                <?php
                                if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                                    $temp = explode(".", $val['notice_file']);
                                    $ext = end($temp);
                                    $txt = 'txt';
                                    $docx = 'docx';
                                    $pdf = 'pdf';
                                    $zip = 'zip';
                                    $rar = 'rar';
                                    $image = 'jpg';
                                    $image1 = 'jpeg';
                                    $image2 = 'bmp';
                                    $doc = 'doc';
                                    $image3 = 'png';
                                    $image4 = 'xps';
                                    ?>
                                <td><?php
                    if ($ext == $txt) {
                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                            <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                                    <?php
                                    } else if ($ext == $doc) {
                                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                            <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                                    <?php
                                    } else if ($ext == $pdf) {
                                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                            <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                    <?php } else if ($ext == $zip) {
                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                            <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                                    <?php } else if ($ext == $rar) {
                                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                            <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                                    <?php
                                    } else if ($ext == $image) {
                                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                            <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                  /> </a>

                    <?php
                    } else if ($ext == $image1) {
                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                            <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                 /></a>

                        <?php
                        } else if ($ext == $image2) {
                            ?>
                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                            <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                 /></a>

                    <?php
                    } else if ($ext == $image3) {
                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                            <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                 /></a>

                    <?php
                    } else if ($ext == $docx) {
                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                            <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                    <?php
                    } else if ($ext == $image2) {
                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                            <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                    <?php } else {
                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                            <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                    <?php } ?></td>
                <?php } ?>
                            </tr>
                        </table>
                    </div>
                <?php
            }
        }
    }
}
?>
</div>

<script type="text/javascript">
    // delete
    $("#yes").live("click", function ()
    {
        for_loading_del('Loading... Data Delete wait...'); // loading notification
        var hid = $(this).parent().parent().find('.hid').val();

        $.ajax({
            url: BASE_URL + "admin/delete_notice",
            type: 'POST',
            data: {nid: hid},
            success: function (result) {

                $("#list_all").html(result);
                for_response_del('Delete Successfully...!'); // resutl notification

            }

        });




        $('.modal').css("display", "none");
        $('.fade').css("display", "none");

    });

    $("#cancel").live('click', function ()
    {
        $(".mandatory1").val('');
        $("#department").val('');
        $("#notice_file").val('');
        $(".nicEdit-main").html('');
        $(".errormessage").html('');
        $('.mandatory1').css('border', '1px solid #CCCCCC');
        $("#department").css('border', '1px solid #CCCCCC');
        $('.nicEdit-main').css('border', '');
        // $("#file_error").html('');
    });


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.notes_val').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    // image checking
    $(".notes_val").change(function () {

        var val = $(this).val();

        switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
            case 'gif':
            case 'jpg':
            case 'png':
            case 'bmp':
            case 'doc':
            case 'docx':
            case 'pdf':
            case 'xlsx':
            case 'xps':
            case 'jpeg':
            case '':
            case 'xls':
                $(this).val();
                $("#file_error").html("");
                break;
            default:
                $(this).val();

                $("#file_error").html("Invalid File Type");
                break;
        }
    });

    $(".notes_val").change(function () {

        var val = $(this).val();
        if (val == "" || val == null)
        {
        } else
        {
            readURL(this);
        }
    });
</script>


<style type="text/css">
    .show { display: block;}
    .hide { display: none;}
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $("#my_radio").click(function () {
            $('#show-me').css('display', 'block');
        });
        $(".group").click(function () {
            $('.group').css('display', 'block');
        });
        $(".public").click(function () {
            $('#show-me').css('display', 'none');
            $("#nt_error").html('');
            $("#dep_error").html('');
            $('#notice_to').css('border', '1px solid #CCCCCC');
            $('#department').css('border', '1px solid #CCCCCC');

        });
    });
</script>
<?php
if (isset($notice) && !empty($notice)) {
    foreach ($notice as $val) {
        ?>
        <div id="close">
            <div id="delete_<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal">×</a>
                            <h3 id="myModalLabel">Delete Notice</h3>
                        </div>
                        <div class="modal-body" >
                            Are you sure want to Delete?
                            <input type="hidden" value="<?php echo $val['id']; ?>" class="hid" />

                        </div>
                        <div class="modal-footer">
                            <input type="button" value="Yes" id="yes" class="btn btn-primary delete"  />
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>


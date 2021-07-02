
<script>

    $(document).ready(function ()
    {

        $("form[name=sform]").submit(function ()
        {
            var i = 0;

            var name = $("#name").val();
            var notes_file = $("#notes_file").val();
            var batch = $("#batch").val();
            var semester = $("#semester").val();
            var my_select = $("#my_select").val();
            if (name == "")
            {
                $("#v1").html("Required Field");
                i = 1;
            } else
            {
                $("#v1").html("");
            }
            if (notes_file == "")
            {
                $("#v2").html("Choose File");
                i = 1;
            } else
            {
                $("#v2").html("");
            }
//            if (batch == "")
//            {
//                $("#v3").html("Select Batch");
//                i = 1;
//            } else
//            {
//                $("#v3").html("");
//            }
//            if (semester == "")
//            {
//                $("#v4").html("Select Term");
//                i = 1;
//            } else
//            {
//                $("#v4").html("");
//            }
            if (my_select == "")
            {
                $("#v5").html("Select Class");
                i = 1;
            } else
            {
                $("#v5").html("");
            }
            if (i == 1)
            {
                return false;
            } else
            {
                return true;
            }
        });
    });
</script>

<script>
    $("#name").live('blur', function ()
    {
        var name = $("#name").val();
        if (name == "")
        {
            $("#v1").html("Required Field");
        } else
        {
            $("#v1").html("");
        }
    });
    $("#notes_file").live('blur', function ()
    {
        var notes_file = $("#notes_file").val();
        if (notes_file == "")
        {
            $("#v2").html("Choose File");

        } else
        {
            $("#v2").html("");
        }
    });
//    $("#batch").live('blur', function ()
//    {
//        var batch = $("#batch").val();
//        if (batch == "")
//        {
//            $("#v3").html("Select Batch");
//
//        } else
//        {
//            $("#v3").html("");
//        }
//    });
//    $("#semester").live('blur', function ()
//    {
//        var semester = $("#semester").val();
//        if (semester == "")
//        {
//            $("#v4").html("Select Term");
//
//        } else
//        {
//            $("#v4").html("");
//        }
//    });
    $("#my_select").live('blur', function ()
    {
        var my_select = $("#my_select").val();
        if (my_select == "")
        {
            $("#v5").html("Select Class");

        } else
        {
            $("#v5").html("");
        }
    });
</script>
<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<?php
$user = $this->user_auth->get_user_id();
$staff = $this->session->userdata('logged_in');
?>
<form method="post" name="sform" action="<?php echo $this->config->item('base_url'); ?>notes/insert_notes"  enctype="multipart/form-data">
    <div>

        <div>
            <table class="form_table" width="100%">
                <tr>
                <input type="hidden" name="user" value="<?php echo $user; ?>"  /><td width="14%"></td>
                </tr>

                <tr>
                    <td width="14%">Notes Title</td>
                    <td width="24%"><input type="text" id="name" name="notes" class="notes mandatory"  />
                        <span id="v1" class="val" style="color:#F00;"></span></td>
                <span style="color:red;" id="status_error" class="errormessage"></span>
                <td width="14%">Share Your Attachment's</td>
                <td width="20%"><input type='file' name="notes_image" id="notes_file" class="notes_share value mandatory" value="notes_share"  /><span id="v2" class="val" style="color:#F00;"></span><span class="val" style="color:red;" id="size_error"></span></td>
                <span style="color:red; display:none;" id="status_error" class="result"> Please Upload Files </span>
                <td></td>
                <td></td>
                </tr>
                <tr>
                <input type="hidden" id="batch" name='batch' value="<?php echo $batch[0]['id'] ?>" />
                <input type="hidden" id="semester" name='semester' value="<?php echo $term[0]['id'] ?>" />
    <!--                    <td>Batch </td>
                        <td>
                            <select id='batch' name='batch'  class="mandatory batch res" >
                                <option value="" selected="selected">Select</option>
                <?php
                if (isset($all_batch) && !empty($all_batch)) {

                    foreach ($all_batch as $view) {
                        ?>
                                                                                        <option value="<?= $view['id'] ?>"><?php echo $view['from'] . '-' . $view['to'] ?></option>
                        <?php
                    }
                }
                ?>
                            </select><span id="v3" class="val" style="color:#F00;"></span>
                        </td>
                    <span style="color:red;" id="status_error" class="errormessage"></span>
                    <td>Term </td>
                    <td>
                        <select id='semester' name='semester'  class="mandatory semester" >
                            <option value="" selected="selected">Select</option>
                <?php
                if (isset($all_semester) && !empty($all_semester)) {

                    foreach ($all_semester as $view) {
                        ?>
                                                                                    <option value="<?= $view['id'] ?>"><?php echo $view['semester'] ?></option>
                        <?php
                    }
                }
                ?>
                        </select><span id="v4" class="val" style="color:#F00;"></span>
                    </td>
                    <span style="color:red;" id="status_error" class="errormessage"></span>-->
                <td >Class</td>
                <td >
                    <select id="my_select" name='student_depart'  class="department mandatory"  >
                        <option value="">Select</option>
                        <?php
                        if (isset($all_department) && !empty($all_department)) {
                            foreach ($all_department as $val) {
                                ?>
                                <option value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select><span id="v5" class="val" style="color:#F00;"></span>
                </td>
                <span style="color:red;" id="status_error" class="errormessage"></span>
                </tr>
            </table>
            <table class="form_table"  id="show-me"  width="100%">

                <tr>
                    <td width="400" id="g_td"></td>
                    <td id="s_td"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>


            <table class="form_table group" width="100%"  >
                <tr>
                    <td width="10%"></td>
                    <td width="48%"></td>

                </tr>
            </table>
            <table class="form_table" width="100%">
                <tr>
                    <td width="14%">&nbsp;</td>
                    <td width="71%">
                        <input type="submit" value="send" name="send" id="submit" class="btn btn-primary" /> <input type="reset" value="cancel"  name="cancel" class="btn btn-danger"/>
                    </td>
                    <td width="7%">&nbsp;</td>
                    <td width="8%">

                    </td>
                </tr>
            </table>
        </div>
</form>
<br />

<!--<--shared_notes_view-->
<div id="view_all">
    <table id="example1" class="table table-bordered table-striped dataTable" width="100%">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Files</th>
                <th>Notes Title</th>
                <th>Subject</th>
                <th>Academic Year</th>
                <th>Class</th>
                <th>Section</th>
                <th>Term</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            if (isset($list) && !empty($list)) {
                //echo "<pre>"; print_r($list); exit;
                foreach ($list as $val) {

                    $temp = explode(".", $val['image']);
                    $ext = end($temp);

                    $txt = 'txt';
                    $docx = 'docx';
                    $pdf = 'pdf';
                    $zip = 'zip';
                    $rar = 'rar';
                    $image = 'jpg';
                    $image1 = 'jpeg';
                    $image2 = '';
                    $doc = 'doc'
                    ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td>
                            <?php
                            if ($ext == $txt) {
                                ?>
                                <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                                    <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a></td>
                            <?php
                        } else if ($ext == $doc) {
                            ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                        <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a></td>
                    <?php
                } else if ($ext == $pdf) {
                    ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                        <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a></td>
                <?php } else if ($ext == $zip) {
                    ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                        <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a></td>
                <?php } else if ($ext == $rar) {
                    ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                        <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a></td>
                    <?php
                } else if ($ext == $image) {
                    ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                        <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . $val['image'] ?>"
                              /> </a>

                    <?php
                } else if ($ext == $image1) {
                    ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                        <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . $val['image'] ?>"
                             /></a>

                    <?php
                } else if ($ext == $docx) {
                    ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                        <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                    <?php
                } else if ($ext == $image2) {
                    ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                        <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                <?php } else {
                    ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                        <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                <?php } ?>


                </td>

                <td ><?= $val['note_title'] ?></td>
                <td><?php
                    if ($val['subject_id'] == 0) {
                        echo "**";
                    } else {
                        echo $val['nick_name'];
                    }
                    ?></td>
                <td ><?= $val['from']; ?></td>
                <td><?php
                    if ($val['depart_id'] == 0) {
                        echo "**";
                    } else {
                        echo $val['nickname'];
                    }
                    ?></td>
                <td><?php
                    if ($val['group_id'] == 0) {
                        echo "**";
                    } else {
                        echo $val['group'];
                    }
                    ?></td>
                <td ><?= $val['sem'] ?></td>
                <td ><?= date("d-M-Y", strtotime($val['ldt'])) ?></td>
                <td>
                    <?php if ($val['created_user'] == $staff['user_id'] && $val['staff_type'] == $staff['staff_type']) {
                        ?>
                        <a href="#delete_batch<?php echo $val['id']; ?>" title="Remove" data-toggle="modal" name="group"
                           class="btn btn-danger">Delete</a>
                           <?php
                       } else {
                           echo "**";
                       }
                       ?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
        </tbody>
    </table>
</div>




<?php
if (isset($list) && !empty($list)) {
    foreach ($list as $val) {
        //echo "<pre>"; print_r($rem); exit;
        ?>
        <div id="delete_batch<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Delete Notes</h3>
                    </div>
                    <div class="modal-body" >
                        <b>Are you sure you want to Remove Notes?
                            <input type="hidden" value="<?php echo $val['id']; ?>" class="id" /></b>
                    </div>
                    <div class="modal-footer">
                     <!--<input type="button" value="Yes"  class="btn btn-primary delete_yes"  />
                     <input type="button" value="No" class="btn btn-primary delete_all " id="no" />-->

                        <button type="button" id="r" class="remove_notes btn btn-primary" value="Remove"> <i class="fa fa-times"></i>Remove</button>
                        <button type="button" class="btn btn-danger delete_all" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>




<script type="text/javascript">

    $(".remove").live('click', function () {
        $(this).closest("tr").remove();
        var i = 4;
        $('.dy_no').each(function () {
            $(this).html(i);
            i++;
        });
    });
    $('#name').live('blur', function () {
        var note = $(this).val();
        if (note == "" || note == null || note.trim().length == 0 || note == 0)
        {

            // $("#batch").attr('disabled', true);
            // $("#semester").attr('disabled', true);
            $(".department").attr('disabled', true);
        } else
        {
            $(".department").attr('disabled', false);

        }
    });
    $("#notes_file").live('change', function () {

        var val = $(this).val();
        if (val == "")
        {
            // $("#batch").attr('disabled', true);
            //$("#semester").attr('disabled', true);
            $(".department").attr('disabled', true);
        } else
        {
            $("#batch").attr('disabled', false);

        }
    });
//    $('#batch').live('change', function () {
//        var batch = $(this).val();
//        if (batch == "" || batch == null)
//        {
//            $("#semester").attr('disabled', true);
//            $(".department").attr('disabled', true);
//        } else
//        {
//            $("#semester").attr('disabled', false);
//
//        }
//    });
//    $('#semester').live('change', function () {
//        var sem = $(this).val();
//        if (sem == "" || sem == null)
//        {
//
//            $(".department").attr('disabled', true);
//        } else
//        {
//            $(".department").attr('disabled', false);
//
//        }
//    });
    $('.department').live('change', function () {
        d_id = $(this);

        $.ajax(
                {
                    url: BASE_URL + "notes/get_all_group",
                    type: 'POST',
                    data: {
                        depart_id: d_id.val()

                    },
                    success: function (result)
                    {
                        $('#g_td').html(result);

                        /*$('.modal-backdrop').hide();
                         $('.close_div').hide();*/
                    }
                });
        $('.subject').val('');
    });
    $('.group').live('change', function () {
        var dep = $('.department').val();
        var semester = $('#semester').val();
        var grp = $(this).val();
        var batch = $('#batch').val();
        $.ajax(
                {
                    url: BASE_URL + "notes/get_all_sub",
                    type: 'POST',
                    data: {
                        value1: dep, value2: grp, value3: semester, value4: batch

                    },
                    success: function (result)
                    {
                        $('#s_td').html(result);

                        /*$('.modal-backdrop').hide();
                         $('.close_div').hide();*/
                    }
                });
    });
// delete query
    $(".remove_notes").live("click", function ()
    {

        for_loading_del('Loading... Data Delete wait...'); // loading notification
        var id = $(this).parent().parent().find('.id').val();


        $.ajax(
                {
                    url: BASE_URL + "notes/delete_notes",
                    type: 'POST',
                    data: {value1: id},
                    success: function (result) {
                        $("#view_all").html(result);
                        for_response_del('Notes Deleted Successfully...!'); // resutl notification
                    }
                });
        $('.modal').css("display", "none");
        $('.fade').css("display", "none");
    });



    $('.mandatory').live('blur', function ()
    {
        if ($(this).val() == '' || $(this).val() == null || $(this).val().trim().length == 0 || $(this).val() == '.' || $(this).val() == ',')
        {
            $(this).css('border', '1px solid red');
            result = 1;
        } else
            $(this).css('border', '1px solid #CCCCCC');
    });



    $(".btn-danger").click(function ()
    {
        $('.mandatory').val('');
        $('.mandatory').css('border', '1px solid #CCCCCC');
        $('.val').html('');

    });



<!-- on change closed-->

    $('.res').live('change', function () {

        $('.semester').val('');
        $('.department').val('');
        $('.group').val('');
        $('.subject').val('');

    });

    $('.semester').live('change', function () {
        $('.department').val('');
        $('.group').val('');
        $('.subject').val('');

    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#notes_file").change(function () {

        var val = $(this).val();
        //alert(val);
        switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
            case 'gif':
            case 'jpg':
            case 'png':
            case 'doc':
            case 'docx':
            case 'xps':
            case 'pdf':
            case 'xls':
            case 'xlsx':
            case 'ppt':
            case 'sldx':
            case 'pps':
            case 'jpeg':
            case 'txt':
            case '':
                $(this).val();
                $("#size_error").html("");
                break;
            default:
                $(this).val();

                $("#size_error").html("Invalid File Type");
                break;
        }
    });

    $("form[name=sform]").submit(function ()
    {

        var message = $("#size_error").html();
        if (message.trim().length > 0)
        {

            return false;
        } else
        {
            return true;
        }

    });
</script>





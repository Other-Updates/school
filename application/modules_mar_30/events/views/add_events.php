<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<script type="text/javascript">
    $(document).ready(function ()
    {

        $("form[name=sform]").submit(function ()
        {
            var i = 0;
            if ($("#my_radio").prop("checked"))
            {
                var batch = $("#batch_id").val();
                var depart = $("#depart_id").val();
//                if (batch == "")
//                {
//                    $("#v2").html("Select Batch");
//                    i = 1;
//                } else
//                {
//                    $("#v2").html("");
//                }
                if (depart == "")
                {
                    $("#v3").html("Select Class");
                    i = 1;
                } else
                {
                    $("#v3").html("");
                }
            }
            var message2 = $("#v1").html();

            var event_name = $("#event_name").val();
            var event_date = $("#event_date").val();
            var event_venue = $("#venue").val();

            var o = document.getElementById('my_radio1');
            var t = document.getElementById('my_radio');

            if ((o.checked == false) && (t.checked == false))
            {
                $("#v1").html("Select Anyone");
                i = 1;
            } else
            {
                $("#v1").html("");
            }

            if (event_name == "")
            {
                $("#v4").html("Enter Event Name");
                i = 1;
            } else
            {
                $("#v4").html("");
            }
            if (event_date == "")
            {
                $("#v5").html("Select Event Date");
                i = 1;
            } else
            {
                $("#v5").html("");
            }
            if (event_venue == "")
            {
                $("#v6").html("Enter Venue");
                i = 1;
            } else
            {
                $("#v6").html("");
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

    $("#my_radio").live('click', function ()
    {
//        $("#batch_id").live('blur', function ()
//        {
//            var batch = $("#batch_id").val();
//
//            if (batch == "")
//            {
//                $("#v2").html("Select Batch");
//            } else
//            {
//                $("#v2").html("");
//            }
//        });
        $("#depart_id").live('blur', function ()
        {
            var depart = $("#depart_id").val();

            if (depart == "")
            {
                $("#v3").html("Select Class");
            } else
            {
                $("#v3").html("");
            }

        });
    });
    $("#event_name").live('blur', function ()
    {
        var event_name = $("#event_name").val();
        if (event_name == "")
        {
            $("#v4").html("Enter Event Name");
        } else
        {
            $("#v4").html("");
        }
    });
    $("#event_date").live('blur', function ()
    {
        var event_date = $("#event_date").val();
        if (event_date == "")
        {
            $("#v5").html("Select Event Date");
        } else
        {
            $("#v5").html("");
        }
    });
    $("#venue").live('blur', function ()
    {
        var venue = $("#venue").val();
        if (venue == "")
        {
            $("#v6").html("Enter Venue");
        } else
        {
            $("#v6").html("");
        }
    });

//$(document).ready(function(){ $(".public").focus(); });
</script>
<script>
    $(document).ready(function () {

        $("#imgInp").change(function () {

            var val = $(this).val();

            switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
                case 'gif':
                case 'jpg':
                case 'png':
                case 'doc':
                case 'docx':
                case 'txt':
                case '':

                    $("#img").html("");

                    break;
                default:
                    $(this).val();
                    // error message here
                    $("#img").html("Invalid File Type");
                    break;
            }
        });
    });
</script>

<?php $user_det = $this->session->userdata('logged_in'); ?>
<div class="row">
    <form method="post" enctype="multipart/form-data" name="sform" >
        <?php
        if (isset($user_det) && !empty($user_det)) {
            foreach ($user_det as $bil) {
                ?>

                <td><input type="hidden" name="user_id" value="<?= $user_det['user_id'] ?>" /></td>
                <td><input type="hidden" name="staff_type" value="<?= $user_det['staff_type'] ?>" /></td>
                <td><input type="hidden" name="staff_name" value="<?= $user_det['name'] ?>" /></td>
                <?php
            }
        }
        ?>
        <div class="col-lg-6">
            <table class="form_table" width="100%">
                <tr>
                    <td width="30%">Share to</td>
                    <td>
                        <input class="public" checked="checked" id="my_radio1" type="radio" name="type" value="Public" />
                        <label for="my_radio" style="font-weight:normal">Public</label>
                        <input id="my_radio" type="radio" name="type" value="Class"  onclick="showSelect();" />
                        <label for="my_radio" style="font-weight:normal">Class</label>
                    </td>
                    <?php /* ?><td>
                      <input id="my_radio2" type="radio" name="type" class="my_radio2" value="alumni"  onclick="showSelect();" />
                      <label for="my_radio" style="font-weight:normal">Alumni</label>
                      </td><?php */ ?>
                    <td><span id="v1" class="val" style="color:#F00;"></span></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <table class="form_table"  id="show-me" style="display:none" width="100%">

                <tr>
                <input type="hidden" id="batch_id" name='batch_id' value="<?php echo $batch[0]['id'] ?>" />
<!--                    <td width="12%">Select Batch</td>
               <td width="23%" id="b_td">
                   <select id='batch_id' name='batch_id' class="batch_id" >
                       <option value="" selected="selected">Select</option>
                <?php
                if (isset($all_batch) && !empty($all_batch)) {

                    foreach ($all_batch as $val) {
                        ?>
                                                                                       <option value="<?= $val['id'] ?>"><?php echo $val['from'] . '-' . $val['to'] ?></option>
                        <?php
                    }
                }
                ?>
                   </select><span id="v2" class="val" style="color:#F00;"></span>
               </td>-->
                </tr>
                <tr>
                    <td width="43%">Select Class</td>
                    <td>
                        <select id="depart_id" name='depart_id' class="depart_id" >
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
                        </select><span id="v3" class="val" style="color:#F00;"></span>
                    </td>
                </tr>

            </table>
            <table class="form_table" width="100%">
                <tr>
                    <td width="30%">Event</td>
                    <td><input type="text" name="event_name" id="event_name"  /><span id="v4" class="val" style="color:#F00;"></span> <td></td></td>
                </tr>
                <tr>
                    <td>Event Date</td>
                    <td><input type="text" class="date" name="date" id="event_date"/><span id="v5" class="val" style="color:#F00;"></span></td>
                </tr>
                <tr>
                    <td>Venue</td>
                    <td><input type="text" name="venue" id="venue"/><span id="v6" class="val" style="color:#F00;"></span></td>
                </tr>
                <tr>
                    <td><input type="submit" value="save"  class="btn btn-primary"/> &nbsp;<input type="button" value="cancel" name="cancel" id="cancel" class="btn btn-danger"/>&nbsp;</td>
                </tr>
            </table>
        </div>
        <div class="col-lg-6">
            <table>
                <tr>
                    <td>
                        <strong>Upload Your Events Image</strong><br />
                        <div class="profilethumb">
                            <a href="#"><?= $list[0]['image']; ?></a>
                        </div>
                        <div class="event_img">
                            <a href="#">Size 400*300</a>
                            <img id="blah" class="add_staff_thumbnail1" src="<?= $this->config->item('base_url') ?>profile_image/events/orginal/events.png" alt="Events Image">
                            <p>&nbsp;</p>
                            <input type='file' name="image_name" id="imgInp" /><span id="img" class="val" style="color:#F00;"></span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>


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

    /*	$("#event_name").blur(function()
     {
     var name=$("#event_name").val();
     $.ajax(
     {
     url:BASE_URL+"events/checking_events",
     type:'POST',
     data:{ value1 : event_name},
     success:function(result)
     {
     $("#errormessage").html(result);
     }
     })
     });


     $('.to').live('change',function(){
     evnt=$("#event_name").val(),
     //  	tdt=$(".to").val();

     $.ajax(
     {
     url:BASE_URL+"events/validate_events",
     type:'POST',
     data:{ value1 : evnt},
     success:function(result)
     {
     $("#val").html(result);

     }
     });
     });*/
    $("#cancel").live("click", function ()
    {
        //$("#batch_id").val('');
        $("#depart_id").val('');
        $("#event_name").val('');
        $("#event_date").val('');
        $("#venue").val('');
        $("#imgInp").val('');
        $(".mandatory1").val('');
        $('.val').html('');
        $(".errormessage").html('');
        $("#blah").replaceWith('  <img id="blah" class="add_staff_thumbnail1" src="<?= $this->config->item('base_url') ?>profile_image/events/orginal/events.png" alt="Events Image">');

    });





    $("#imgInp").change(function () {
        if ($(this).val() == "" || $(this).val() == null)
        {

        } else
        {
            readURL(this);
        }
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
            url: BASE_URL + "events/get_all_group",
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


                <!--<style type="text/css">
                .show { display: block;}
                .hide { display: none;}
                </style>
                <script type="text/javascript">
                $(document).ready(function() {
                $("#my_radio").click(function () {
                $('#show-me').css('display','block');
                });
                $(".group").click(function () {
                $('.group').css('display','block');
                });
                $(".public").click(function () {
                $('#show-me, .group').css('display','none');
                });
                });-->

<style type="text/css">
    .show { display: block;}
    .hide { display: none;}
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $("#my_radio").click(function ()
        {
            $('#show-me').css('display', 'block');
        });

        $("#my_radio2").click(function ()
        {
            b_id = $(this);
            $.ajax(
                    {
                        url: BASE_URL + "events/get_alumni",
                        type: 'POST',
                        data: {batch_id: b_id.val()},
                        success: function (result)
                        {
                            $("#b_td").html(result);
                            $('#depart_id').focus();
                        }
                    });

            $('#show-me').css('display', 'block');
        });
        $(".group").click(function () {
            $('.group').css('display', 'block');
        });
        $(".public").click(function () {
            $('#show-me').css('display', 'none');
            // $("#batch_id").val('');
            $("#depart_id").val('');
            $("#nt_error").html('');
            $("#dep_error").html('');
            $('#share_to').css('border', '1px solid #CCCCCC');
            $('#department').css('border', '1px solid #CCCCCC');

        });
    });
</script>
<script>

    $("form[name=sform]").submit(function ()
    {

        var message = $("#img").html();
        if (message.trim().length > 0)
        {

            return false;
        } else
        {
            return true;
        }

    });
</script>

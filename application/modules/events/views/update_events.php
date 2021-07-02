

<script>
    function validateform()
    {
        var i = 0;
        var event_name = $("#event_name").val();
        var event_date = $("#event_date").val();
        var event_venue = $("#venue").val();

        if (event_name == "")
        {

            $("#v1").html("Enter Event Name");
            i = 1;
        } else
        {
            $("#v1").html("");
        }
        if (event_date == "")
        {
            $("#v2").html("Select Event Date");
            i = 1;
        } else
        {
            $("#v2").html("");
        }
        if (event_venue == "")
        {
            $("#v3").html("Enter Venue");
            i = 1;
        } else
        {
            $("#v3").html("");
        }

        if ($("#type").val() == 'department')
        {
            var batch = $("#batch_id").val();
            var depart = $("#depart_id").val();
            if (batch == "")
            {
                $("#v4").html("Select Batch");
                i = 1;
            } else
            {
                $("#v4").html("");
            }
            if (depart == "")
            {
                $("#v5").html("Select Class");
                i = 1;
            } else
            {
                $("#v5").html("");
            }
        }
        if (i == 1)
        {

            return false;
        } else
        {

            return true;
        }
    }

</script>
<script>
    $("#event_name").live('blur', function ()
    {
        var event_name = $("#event_name").val();
        if (event_name == "")
        {
            $("#v1").html("Enter Event Name");
        } else
        {
            $("#v1").html("");
        }
    });
    $("#event_date").live('blur', function ()
    {
        var event_date = $("#event_date").val();
        if (event_date == "")
        {
            $("#v2").html("Select Event Date");
        } else
        {
            $("#v2").html("");
        }
    });
    $("#venue").live('blur', function ()
    {
        var venue = $("#venue").val();
        if (venue == "")
        {
            $("#v3").html("Enter Venue");
        } else
        {
            $("#v3").html("");
        }
    });
//    $("#batch_id").live('blur', function ()
//    {
//        var venue = $("#batch_id").val();
//        if (venue == "")
//        {
//            $("#v4").html("Select Batch");
//        } else
//        {
//            $("#v4").html("");
//        }
//    });
    $("#depart_id").live('blur', function ()
    {
        var venue = $("#depart_id").val();
        if (venue == "")
        {
            $("#v5").html("Select Class");
        } else
        {
            $("#v5").html("");
        }
    });
</script>
<script>
    $(document).ready(function () {
        $(".public").focus();
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
<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<form  method="post" enctype="multipart/form-data" name="sform" onsubmit="return validateform();" action="<?php echo $this->config->item('base_url') . 'events/updateevent'; ?>">
    <?php
    $i = 1;
    if (isset($events_info) && !empty($events_info)) {
        foreach ($events_info as $val) {
//echo "<pre>";print_r($val); exit;
            ?>
            <div class="row">

                <div class="col-lg-6">
                    <table class="form_table">
                        <tr>
                            <td><input type="hidden" name="id" class="id" readonly="readonly" value="<?php echo $val['id']; ?>" /></td>
                        </tr>
                        <tr>
                            <td width="151">Events Name</td>
                            <td><input type="text" name="event_name" id="event_name"  class="events" value="<?= $val['event_name'] ?>" />
                                <span id="v1" style="color:#F00;"></span></td>
                        </tr>
                        <tr>
                            <td>Events Date</td>
                            <td><input type="text" name="date" class="date" id="event_date" value="<?= $val['date'] ?>" />
                                <span id="v2" style="color:#F00;"></span></td>
                        </tr>
                        <tr>
                            <td>Venue</td>
                            <td><input type="text" name="venue" class="venue" id="venue" value="<?= $val['venue'] ?>" />
                                <span id="v3" style="color:#F00;"></span></td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td>
                                <select id="type" name="type">
                                    <option <?= ($val['type'] == 'Class') ? 'selected' : ''; ?> value="Class">Class</option>
                                    <option <?= ($val['type'] == 'Public') ? 'selected' : ''; ?> value="Public">Public</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <table class="tab1">
                        <tr>
                        <input type="hidden" id="batch_id" name='batch_id' value="<?php echo $batch[0]['id'] ?>" />
        <!--                            <td width="155">Batch</td>
                       <td>
                           <select id='batch_id' name='batch_id' >
                               <option value="">Select</option>
                        <?php
                        if (isset($all_batch) && !empty($all_batch)) {

                            foreach ($all_batch as $val) {
                                ?>
                                                                       <option <?= ($val['id'] == $events_info[0]['batch_id']) ? 'selected' : '' ?> value="<?= $val['id'] ?>"><?php echo $val['from'] . '-' . $val['to'] ?>
                                                                       </option>
                                <?php
                            }
                        }
                        ?>
                           </select><span id="v4" style="color:#F00;"></span>
                       </td>-->
                        </tr>
                        <tr>
                            <td>Class</td>
                            <td>
                                <select id='depart_id' name='depart_id' class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                    if (isset($all_depart) && !empty($all_depart)) {
                                        foreach ($all_depart as $val) {
                                            ?>
                                            <option <?= ($val['id'] == $events_info[0]['depart_id']) ? 'selected' : '' ?> value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select><span id="v5" style="color:#F00;"></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <?php
                if (isset($events_info) && !empty($events_info)) {
                    foreach ($events_info as $val) {
                        ?>
                        <div class="col-lg-6">
                            <div class="event_img">
                                <a href="#">Size 400*300</a>
                                <img id="blah" class="add_staff_thumbnail1" src="<?= $this->config->item('base_url'); ?>/profile_image/events/orginal/<?= $val['image'] ?>"  alt="Events Image Missed" />
                                <p>&nbsp;</p>
                                <input type='file' name="image_name" value="<?= $val['image'] ?>" id="imgInp" /> <span id="img" style="color:#F00;"></span>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <?php
            $i++;
        }
    }
    ?>
    <br />
    <div class="right"><input type="submit"  value='Update' class="btn btn-primary" id="update"/>
        <input type="button" value="Back" class="btn btn-danger" onClick="history.go(-1);return true;">
    </div>
    <br /><br />
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $("select").change(function () {
            $("select option:selected").each(function () {
                if ($(this).attr("value") == "department") {
                    $(".tab1").show();
                }
                if ($(this).attr("value") == "public") {
                    $(".tab1").hide();
                    // $("#batch_id").val('');
                    $("#depart_id").val('');
                }
            });
        }).change();
    });
</script>


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
<script type="text/javascript">
    $("form[name=sform]").submit(function ()
    {
        var message = $("#hidden_msg").val();
        if (message.length > 0)
        {
            alert(message);
            return false;
        } else
        {

            return true;
        }

    });

</script>
<?php
/* ?>
  <script>
  $("#update").live("click",function()
  {
  var id=$(this).parent().parent().find('.id').val();
  events=$(this).parent().parent().find('.events').val();
  dept=$(this).parent().parent().find('.dept').val();
  group=$(this).parent().parent().find('.group').val();
  type=$(this).parent().parent().find('.type').val();
  venue=$(this).parent().parent().find('.venue').val();
  $.ajax({
  url:BASE_URL+"events/update_events",
  type:'POST',
  data:{ value1 : id , value2 : events, value3 : dept, value4 : group, value5 : type, value6 : venue},
  success:function(result){
  $("#list_all").html(result);
  }
  });
  $('.modal').css("display", "none");
  $('.fade').css("display", "none");
  });
  </script>				<?php */?>
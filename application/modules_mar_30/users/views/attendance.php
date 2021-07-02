<?php
$theme_path = $this->config->item('theme_locations') . $this->config->item('active_template');
/* $title=explode(",", $all_info[0]['time']); */
?>

<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#sem_id").focus(); // THIS IS FOR FOCCUSSING THE FIRST ELEMENT WHEN LOADING THE PAGE
        $("#sem_id").change(function ()
        {
            $("#res_dv").html('<img src="<?= $theme_path; ?>/img/ajax_loader/s_loader_gr.gif" />'); // THIS IS FOR ASSIGNING THE LOADING IMAGE

            var sem_id = $("#sem_id").val();
            if (sem_id == '0')
            {
                $("#res_dv").html(''); // THIS IS FOR ASSIGNING THE LOADING IMAGE
            } else
            {
                //alert(staff_id);
                $.ajax({
                    url: BASE_URL + "users/attendance_list",
                    type: 'POST',
                    data: {sem_id: sem_id},
                    success: function (result) {
                        $("#res_dv").html(result);

                    }

                });

            }
        });

    });


</script>
<div class="message-container">
    <div class="message-form-content">
        <div class="message-form-header">
            <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/attendence.png"></div>
            Attendance
        </div>
        <div class="message-form-inner">

            <div class="form-row user_print_use">
                <label class="field-name">Select Term :</label>
                <?php if (isset($sem_list) && !empty($sem_list)) { ?>
                    <select name="sem_id" id="sem_id">
                        <option value="0">Select</option>
                        <?php foreach ($sem_list as $vls) { ?>
                            <option value="<?= $vls['id'] ?>"><?= $vls['semester'] ?></option>
                        <?php } ?>
                    </select>
                    <?php
                } else {
                    echo "Oops! Please Add Term";
                }
                ?>
            </div>

            <div id="res_dv">
            </div>
        </div>
    </div>
</div>
<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.datetimepicker.js"></script>

<form method="post" action="<?php echo $this->config->item('base_url'); ?>hostel/update_student_admission_error">
    <div class="fees_tit">Student Details</div><br />
    <table class="staff_table">

        <tr>
            <td>First Name</td>
            <td>:</td>
            <td class="text_bold"><?= $std_info1[0]['name'] ?><input type="hidden" name="roll_no" value="<?= $std_info1[0]['std_id'] ?>"></td>
            <td>&nbsp;</td>
            <td>Last Name</td>
            <td>:</td>
            <td class="text_bold"><?= $std_info1[0]['last_name'] ?></td>
            <td>&nbsp;</td>
            <td rowspan="4" colspan="3" align="center">
                <img id="blah" class="add_staff_thumbnail" src="<?= $this->config->item('base_url') ?>profile_image/student/orginal/<?= $std_info1[0]['image'] ?>" alt="Staff Image" /><br />
                <span class="green"></span>
            </td>
            <td rowspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>:</td>
            <td colspan="5" class="text_bold"><?= $std_info1[0]['address'] ?></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Roll No</td>
            <td>:</td>
            <td class="text_bold"><?= $std_info1[0]['std_id'] ?></td><td>&nbsp;</td>
            <td>Father's / Guardians Name</td>
            <td>:</td>
            <td class="text_bold"><?= $std_info1[0]['parent_name'] ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td>DOB</td>
            <td>:</td>
            <td class="text_bold"><?= date('d-m-Y', strtotime($std_info1[0]['dob'])) ?></td><td>&nbsp;</td>
            <td>City</td>
            <td>:</td>
            <td class="text_bold"><?= $std_info1[0]['city'] ?></td><td>&nbsp;</td>

        </tr>
        <tr>
            <td>Academic Year</td>
            <td>:</td>
            <td class="text_bold">
                <?= $std_info1[0]['from']; ?>
            </td><td>&nbsp;</td>
            <td>State</td>
            <td>:</td>
            <td class="text_bold"><?= $std_info1[0]['state'] ?></td><td>&nbsp;</td>
            <td>Student Type</td>
            <td>:</td>
            <td class="text_bold"><?= ($std_info1[0]['student_type'] == 1) ? 'Counselling' : 'Management' ?></td>
        </tr>
        <tr>
            <td>Class</td>
            <td>:</td>
            <td class="text_bold">
                <?= $std_info1[0]['department'] ?>
            </td><td>&nbsp;</td>
            <td>Country</td>
            <td>:</td>
            <td class="text_bold"><?= $std_info1[0]['country'] ?></td><td>&nbsp;</td>
            <td>
                Parent's / Guardians Mob No
            </td>
            <td>:</td>
            <td class="text_bold"><?= $std_info1[0]['parent_no'] ?></td>
        </tr>
        <tr>
            <td>Section</td>
            <td>:</td>
            <td id='g_td' class="text_bold">
                <?= $std_info1[0]['group'] ?>
            </td><td>&nbsp;</td>
            <td>Postal Code</td>
            <td>:</td>
            <td class="text_bold"><?= $std_info1[0]['postal_code'] ?></td><td>&nbsp;</td>
            <td>
                Student Mob No
            </td>
            <td>:</td>
            <td class="text_bold"><?= $std_info1[0]['contact_no'] ?></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>:</td>
            <td class="text_bold">
                <?= ucfirst($std_info1[0]['gender']) ?>
            </td><td>&nbsp;</td>
            <td>Joining Date</td>
            <td>:</td>
            <td class="text_bold">
                <?= date('d-m-Y', strtotime($std_info1[0]['join_date'])) ?>
            </td><td>&nbsp;</td>
            <td>
                Emergency Contact No
            </td>
            <td>:</td>
            <td class="text_bold"><?= $std_info1[0]['emgy_no'] ?></td>
        </tr>
    </table>
    <br />
    <div class="fees_tit">Advance Payment</div>
    <br />
    <table class="staff_table">
        <tr>
            <td width="320">Hostel Name</td>
            <td>
                <select id='h_id' name='block_id'>

                    <?php
                    foreach ($hostel_name as $hostel) {
                        ?>
                        <option <?= ($hostel['id'] == $std_info1[0]['block_id']) ? 'selected' : '' ?> value='<?= $hostel['id'] ?>'><?= $hostel['block'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Advance Payment</td>
            <td>
                <div id='amt_div'>
                    <input type="text" id='std_advance' name="amount" readonly="readonly" value="<?= $std_info1[0]['amount'] ?>" style="float:left;"/>
                    <?php
                    if ($std_info1[0]['block'][0]['hostel_type'] == 1) {
                        echo " ( Rs " . $std_info1[0]['block'][0]['per_day'] . " / Day )";
                    }
                    ?>
                    <input type='button' value='Edit' id='edit_adv_amt' class='btn bg-navy btn-sm' title='Edit' style="float:left; position:relative; left:10px ; top:5px;" >
                </div>

            </td>
        </tr>
        <tr>
            <td><label>Joining Date</label></td>
            <td><input type="text" id="adm_date" name="admission_date" class="date" value="<?= date('d-m-Y', strtotime($std_info1[0]['admission_date'])) ?>"  /><span id="jdup" style="color:#F00;"></span></td>
        </tr>
        <tr>
            <td>Period</td>
            <td>
                <span style="float:left;margin-top: 7PX;">From : &nbsp;&nbsp;</span>
                <span style="float:left;">
                    <select name="start_year" id="start_year" style="width:76px;">
                        <?php
                        $inc = explode('-', $std_info1[0]['from']);
                        for ($i = trim($inc[0]); $i <= trim($inc[1]); $i++) {
                            ?>
                            <option <?= ($i == $std_info1[0]['start_year']) ? 'selected' : '' ?> value='<?= $i ?>'><?= $i ?></option>
                            <?php
                        }
                        ?>

                    </select>
                </span>
                <span style="float:left;margin-top: 7PX;">
                    &nbsp;&nbsp;To : &nbsp;&nbsp;
                </span>
                <span style="float:left;">
                    <select name="end_year" id="end_year" style="width:76px;">
                        <?php
                        $inc = explode('-', $std_info1[0]['from']);
                        for ($i = trim($inc[0]); $i <= trim($inc[1]); $i++) {
                            ?>
                            <option <?= ($i == $std_info1[0]['end_year']) ? 'selected' : '' ?> value='<?= $i ?>'><?= $i ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" id="submit" class="btn btn-primary"/>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $(".staff_table_sub tr:even").css("background-color", "#FAFAFA");
    });
    $('#h_id').live('change', function () {
        $.ajax({
            url: BASE_URL + "hostel/get_amount_by_hostel_id",
            type: 'POST',
            data: {
                h_id: $('#h_id').val(),
            },
            success: function (result) {
                $('#amt_div').html(result);
            }
        });
    });
    $('#edit_adv_amt').live('click', function () {
        $('#std_advance').removeAttr('readonly');
    });
</script>
<script type="text/javascript">
    $("#std_advance").live('blur', function ()
    {
        var advanceamt = $("#std_advance").val();
        var filter = /^[1-9][0-9]*$/;
        if (advanceamt == "" || advanceamt == null || advanceamt.trim().length == 0)
        {
            //$("#adpay").html("Required Field");
            $('#std_advance').css('border', '1px solid red');
        } else if (!filter.test(advanceamt))
        {
            //$("#adpay").html("Required");
            $('#std_advance').css('border', '1px solid red');
        } else if (advanceamt.length < 4 || advanceamt.length > 10)
        {
            $('#std_advance').css('border', '1px solid red');
        } else
        {
            //$("#adpay").html("");
            $('#std_advance').css('border', '1px solid #CCCCCC');
        }
    });
    $("#adm_date").live('blur', function ()
    {
        var adm_date = $("#adm_date").val();
        if (adm_date == "")
        {
            $("#jdup").html("Required Field");
            $('#adm_date').css('border', '1px solid red');
        } else
        {
            $("#jdup").html("");
            $('#adm_date').css('border', '1px solid #CCCCCC');
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#submit').live('click', function () {
            i = 0;
            var advanceamt = $("#std_advance").val();
            var filter = /^[1-9][0-9]*$/;
            var start_year = $("#start_year").val();
            var end_year = $("#end_year").val();
            if (advanceamt == "" || advanceamt == null || advanceamt.trim().length == 0)
            {
                //$("#adpay").html("Required Field");
                $('#std_advance').css('border', '1px solid red');
                i = 1;
            } else if (!filter.test(advanceamt))
            {
                //$("#adpay").html("Required");
                $('#std_advance').css('border', '1px solid red');
                i = 1;
            } else if (advanceamt.length < 4 || advanceamt.length > 10)
            {
                $('#std_advance').css('border', '1px solid red');
                i = 1;
            } else
            {
                //$("#adpay").html("");
                $('#std_advance').css('border', '1px solid #CCCCCC');
            }
            var adm_date = $("#adm_date").val();
            if (adm_date == "")
            {
                $("#jdup").html("Required Field");
                $('#adm_date').css('border', '1px solid red');
                i = 1;
            } else
            {
                $("#jdup").html("");
                $('#adm_date').css('border', '1px solid #CCCCCC');
            }
            if (start_year <= end_year)
            {
            } else
            {
                //$("#dateval").html("Required Field");
                $('#start_year').css('border', '1px solid red');
                $('#end_year').css('border', '1px solid red');
                i = 1
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
<script type="text/javascript">// <![CDATA[
    $('.date').datetimepicker({
        lang: 'de',
        i18n: {de: {
                months: [
                    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
                ],
                dayOfWeek: ["Su.", "Mo", "Tu", "We", "Th", "Fr", "Sa."]
            }},
        timepicker: false,
        format: 'd-m-Y'
    });

</script>
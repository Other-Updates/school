<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.datetimepicker.js"></script>

<br />
<?php if ($std_info[0]['hostel'] == 0) { ?>
    <div style="color:red; font-size:13px; text-align:center; width:100%; font-weight:bold;">This Student Hostel Type is "NO" ; Kindly Contact Respective Class Tutors. </div>
<?php } ?>
<div class="fees_tit">Student Details</div>
<br />
<table class="staff_table">

    <input type="hidden" class="std_id" value="<?= $std_info[0]['id'] ?>">
    <tr>
        <td>First Name</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['name'] ?></td>
        <td>&nbsp;</td>
        <td>Last Name</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['last_name'] ?></td>
        <td>&nbsp;</td>
        <td rowspan="4" colspan="3" align="center">
            <img id="blah" class="add_staff_thumbnail" src="<?= $this->config->item('base_url') ?>profile_image/student/orginal/<?= $std_info[0]['image'] ?>" alt="Staff Image" /><br />
            <span class="green"></span>
        </td>
        <td rowspan="4">&nbsp;</td>
    </tr>
    <tr>
        <td>Address</td>
        <td>:</td>
        <td colspan="5" class="text_bold"><?= $std_info[0]['address'] ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Roll No</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['std_id'] ?></td><td>&nbsp;</td>
        <td>Father's / Guardians Name</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['parent_name'] ?></td><td>&nbsp;</td>
    </tr>
    <tr>
        <td>DOB</td>
        <td>:</td>
        <td class="text_bold"><?= date('d-m-Y', strtotime($std_info[0]['dob'])) ?></td><td>&nbsp;</td>
        <td>City</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['city'] ?></td><td>&nbsp;</td>

    </tr>
    <tr>
        <td>Academic Year</td>
        <td>:</td>
        <td class="text_bold">
            <?= $std_info[0]['from']; ?>
        </td><td>&nbsp;</td>
        <td>State</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['state'] ?></td><td>&nbsp;</td>
        <td>Student Type</td>
        <td>:</td>
        <td class="text_bold"><?= ($std_info[0]['student_type'] == 1) ? 'Management' : 'Counselling' ?></td>
    </tr>
    <tr>
        <td>Class</td>
        <td>:</td>
        <td class="text_bold">
            <?= $std_info[0]['department'] ?>
        </td><td>&nbsp;</td>
        <td>Country</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['country'] ?></td><td>&nbsp;</td>
        <td>
            Parent's / Guardians Mob No
        </td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['parent_no'] ?></td>
    </tr>
    <tr>
        <td>Group</td>
        <td>:</td>
        <td id='g_td' class="text_bold">
            <?= $std_info[0]['group'] ?>
        </td><td>&nbsp;</td>
        <td>Postal Code</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['postal_code'] ?></td><td>&nbsp;</td>
        <td>
            Student Mob No
        </td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['contact_no'] ?></td>
    </tr>
    <tr>
        <td>Gender</td>
        <td>:</td>
        <td class="text_bold">
            <?= ucfirst($std_info[0]['gender']) ?>
        </td><td>&nbsp;</td>
        <td>Joining Date</td>
        <td>:</td>
        <td class="text_bold">
            <?= date('d-m-Y', strtotime($std_info[0]['join_date'])) ?>
        </td><td>&nbsp;</td>
        <td>
            Emergency Contact No
        </td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['emgy_no'] ?></td>
    </tr>

</table>
<br />
<?php if ($std_info[0]['hostel'] == 1) { ?>
    <div class="fees_tit">Admission Details</div>
    <br />
    <table class="form_table">
        <tr>
            <td width="273">Hostel Name</td>
            <td>
                <select id='h_id' name='block_id' class="mandatory">
                    <option value="">Select</option>
                    <?php
                    foreach ($hostel_name as $hostel) {
                        ?>
                        <option value='<?= $hostel['id'] ?>'><?= $hostel['block'] ?></option>
                        <?php
                    }
                    ?>
                </select><span id="hos_name" style="color:#F00;"></span>
            </td>
        </tr>
        <tr>


            <td><label>Advance Payment</label></td>
            <td>
                <div id='amt_div'>
                    <input type="text" id='std_advance' readonly="readonly" class="int_val"/><span id="adpay" style="color:#F00;"></span>
                </div>
            </td>
        </tr>
        <tr>
            <td><label>Joining Date</label></td>
            <td><input type="text" id="adm_date" name="admission_date" class="date" /><span id="hos1" style="color:#F00;"></span></td>
        </tr>
        <tr>
            <td>Advance Period</td>
            <td>
                <span style="float:left;margin-top: 7PX;">From : &nbsp;</span>
                <span style="float:left;">
                    <select name="start_year" style="width:90px;" class="mandatory" id="start_year">
                        <option value="">Select</option>

                        <?php
                        //echo '<pre>';
                        // print_r($std_info[0]);
                        $inc = explode('-', $std_info[0]['from']);
                        //exit;
                        for ($i = trim($inc[0]); $i <= trim($inc[1]); $i++) {
                            ?>
                            <option value='<?= $i ?>'><?= $i ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </span>
                <span style="float:left;margin-top: 7PX;">
                    &nbsp;&nbsp; To :&nbsp;&nbsp;
                </span>
                <span style="float:left;">
                    <select name="end_year"  style="width:90px;" id="end_year">
                        <option value="">Select</option>

                        <?php
                        $inc = explode('-', $std_info[0]['from']);
                        for ($i = trim($inc[0]); $i <= trim($inc[1]); $i++) {
                            ?>
                            <option value='<?= $i ?>'><?= $i ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </span>
                <span id="dateval" style="color:#F00;"></span> </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" id="submit" class="btn btn-primary "/>
            </td>
        </tr>
    </table>
    </form>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $(".staff_table_sub tr:even").css("background-color", "#FAFAFA");
    });
</script>
<script>
    $("#h_id").live('blur', function ()
    {
        var h_id = $("#h_id").val();

        if (h_id == "")
        {
            $("#hos_name").html("Select Hostel Name");
            $('#h_id').css('border', '1px solid red');
        } else
        {
            $("#hos_name").html("");
            $('#h_id').css('border', '1px solid #CCCCCC');
        }
    });
    $("#std_advance").live('blur', function ()
    {
        var advanceamt = $("#std_advance").val();
        var filter = /^[1-9][0-9]*$/;
        if (advanceamt == "" || advanceamt == null || advanceamt.trim().length == 0)
        {
            $("#adpay").html("Required Field");
            $('#std_advance').css('border', '1px solid red');
        } else if (!filter.test(advanceamt))
        {
            $("#adpay").html("Required");
            $('#std_advance').css('border', '1px solid red');
        } else if (advanceamt.length < 4 || advanceamt.length > 10)
        {
            $('#std_advance').css('border', '1px solid red');
            i = 1;
        } else
        {
            $("#adpay").html("");
            $('#std_advance').css('border', '1px solid #CCCCCC');
        }
    });
    $("#adm_date").live('blur', function ()
    {
        var adm_date = $("#adm_date").val();

        if (adm_date == "")
        {
            $("#hos1").html("Required Field");
            $('#adm_date').css('border', '1px solid red');
        } else
        {
            $("#hos1").html("");
            $('#adm_date').css('border', '1px solid #CCCCCC');
        }
    });
    $("#start_year").live('blur', function ()
    {
        var start_year = $("#start_year").val();
        if (start_year == "")
        {
            $('#start_year').css('border', '1px solid red');
        } else
        {
            $('#start_year').css('border', '1px solid #CCCCCC');
        }
    });
    $("#end_year").live('blur', function ()
    {
        var end_year = $("#end_year").val();
        if (end_year == "")
        {
            $('#end_year').css('border', '1px solid red');
        } else
        {
            $('#end_year').css('border', '1px solid #CCCCCC');
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('#submit').live('click', function () {
            var i = 0;
            var h_id = $("#h_id").val();
            var advanceamt = $("#std_advance").val();
            var filter = /^[1-9][0-9]*$/;
            var adm_date = $("#adm_date").val();
            var start_year = $("#start_year").val();
            var end_year = $("#end_year").val();

            if (h_id == "")
            {
                $("#hos_name").html("Select Hostel Name");
                $('#h_id').css('border', '1px solid red');
                i = 1;
            } else
            {
                $("#hos_name").html("");
                $('#h_id').css('border', '1px solid #CCCCCC');
            }
            if (advanceamt == "" || advanceamt == null || advanceamt.trim().length == 0 || !filter.test(advanceamt))
            {
                $("#adpay").html("Required Field");
                $('#std_advance').css('border', '1px solid red');
                i = 1;
            } else if (advanceamt.length < 4 || advanceamt.length > 10)
            {
                $('#std_advance').css('border', '1px solid red');
                i = 1;
            } else
            {
                $("#adpay").html("");
                $('#std_advance').css('border', '1px solid #CCCCCC');
            }
            if (adm_date == "")
            {

                $('#adm_date').css('border', '1px solid red');
                i = 1;
            } else
            {
                $("#hos1").html("");
                $('#adm_date').css('border', '1px solid #CCCCCC');
            }
            if (start_year == "")
            {
                $('#start_year').css('border', '1px solid red');
                i = 1;
            } else
            {
                $('#start_year').css('border', '1px solid #CCCCCC');
            }
            if (end_year == "")
            {
                $('#end_year').css('border', '1px solid red');
                i = 1;
            } else
            {
                $('#end_year').css('border', '1px solid #CCCCCC');
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
            /*else
             {
             $("#dateval").html("");
             $('#start_year').css('border','1px solid #CCCCCC');
             $('#end_year').css('border','1px solid #CCCCCC');
             }*/
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
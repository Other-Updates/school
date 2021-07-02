<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<div class="fees_tit">Student Details</div><br />
<table class="staff_table">

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
        <td class="text_bold"><?= ($std_info[0]['student_type'] == 1) ? 'Counselling' : 'Management' ?></td>
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
        <td>Section</td>
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
<div class="fees_tit">Advance Payment</div>
<br />
<table  class="staff_table">
    <tr>
        <td width="273">Hostel Name</td>
        <td class="text_bold">
            <?= $std_info[0]['block'][0]['block'] ?>&nbsp;(
            <?php
            if ($std_info[0]['block'][0]['hostel_type'] == 0) {
                echo 'Div';
            } else {
                echo 'Non Div';
            }
            ?> )
        </td>
    </tr>
    <tr>
        <td>Advance Payment</td>
        <td class="text_bold">
<?= $std_info[0]['amount'] ?>
        </td>
    </tr>
    <tr>
        <td>Joining Date</td>
        <td class="text_bold">
<?= date('d-M-Y', strtotime($std_info[0]['admission_date'])) ?>
        </td>
    </tr>
    <tr>
        <td>Period</td>
        <td class="text_bold">

<?= $std_info[0]['start_year'] . "-" . $std_info[0]['end_year'] ?>
        </td>
    </tr>

</table>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $(".staff_table_sub tr:even").css("background-color", "#FAFAFA");
    });
</script>
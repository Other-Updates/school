<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<br />
<div class="fees_tit">Student Details</div>
<br />

<table class="staff_table">
    <tr>
        <td>First Name</td>
        <td>:</td>
        <td class="text_bold"><?= $hostel_details[0]['name'] ?></td>
        <td>&nbsp;</td>
        <td>Last Name</td>
        <td>:</td>
        <td class="text_bold"><?= $hostel_details[0]['last_name'] ?></td>
        <td>&nbsp;</td>
        <td rowspan="4" colspan="3" align="center">
            <img id="blah" class="add_staff_thumbnail" src="<?= $this->config->item('base_url') ?>profile_image/student/orginal/<?= $hostel_details[0]['image'] ?>" alt="Staff Image" /><br />
            <span class="green"></span>
        </td>
        <td rowspan="4">&nbsp;</td>
    </tr>
    <tr>
        <td>Address</td>
        <td>:</td>
        <td colspan="5" class="text_bold"><?= $hostel_details[0]['address'] ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Roll No</td>
        <td>:</td>
        <td class="text_bold"><?= $hostel_details[0]['std_id'] ?></td><td>&nbsp;</td>
        <td>Father's / Guardians Name</td>
        <td>:</td>
        <td class="text_bold"><?= $hostel_details[0]['parent_name'] ?></td><td>&nbsp;</td>
    </tr>
    <tr>
        <td>DOB</td>
        <td>:</td>
        <td class="text_bold"><?= $hostel_details[0]['dob'] ?></td><td>&nbsp;</td>
        <td>City</td>
        <td>:</td>
        <td class="text_bold"><?= $hostel_details[0]['city'] ?></td><td>&nbsp;</td>

    </tr>
    <tr>
        <td>Academic Year</td>
        <td>:</td>
        <td class="text_bold">
            <?= $hostel_details[0]['from']; ?>
        </td><td>&nbsp;</td>
        <td>State</td>
        <td>:</td>
        <td class="text_bold"><?= $hostel_details[0]['state'] ?></td><td>&nbsp;</td>
        <td>Student Type</td>
        <td>:</td>
        <td class="text_bold"><?= ($hostel_details[0]['student_type'] == 1) ? 'Counselling' : 'Management' ?></td>
    </tr>
    <tr>
        <td>Class</td>
        <td>:</td>
        <td class="text_bold">
            <?= $hostel_details[0]['department'] ?>
        </td><td>&nbsp;</td>
        <td>Country</td>
        <td>:</td>
        <td class="text_bold"><?= $hostel_details[0]['country'] ?></td><td>&nbsp;</td>
        <td>
            Parent's / Guardians Mob No
        </td>
        <td>:</td>
        <td class="text_bold"><?= $hostel_details[0]['parent_no'] ?></td>
    </tr>
    <tr>
        <td>Group</td>
        <td>:</td>
        <td id='g_td' class="text_bold">
            <?= $hostel_details[0]['group'] ?>
        </td><td>&nbsp;</td>
        <td>Postal Code</td>
        <td>:</td>
        <td class="text_bold"><?= $hostel_details[0]['postal_code'] ?></td><td>&nbsp;</td>
        <td>
            Student Mob No
        </td>
        <td>:</td>
        <td class="text_bold"><?= $hostel_details[0]['contact_no'] ?></td>
    </tr>
    <tr>
        <td>Gender</td>
        <td>:</td>
        <td class="text_bold">
            <?= ucfirst($hostel_details[0]['gender']) ?>
        </td><td>&nbsp;</td>
        <td>Joining Date</td>
        <td>:</td>
        <td class="text_bold">
            <?= $hostel_details[0]['join_date'] ?>
        </td><td>&nbsp;</td>
        <td>

            Emergency Contact No

        </td>
        <td>:</td>
        <td class="text_bold"><?= $hostel_details[0]['emgy_no'] ?></td>
    </tr>
</table>

<br />
<div class="fees_tit">Room Allocation</div>
<br />
<div>
    <table class="staff_table">
        <tr>
            <td>Hostel Name</td><td class="text_bold"><?= $hostel_details[0]['block'][0]['block'] ?></td>
            <td>Room No</td><td class="text_bold"><?= $hostel_details[0]['room'][0]['room_name'] ?></td>
            <td>Seat No</td><td class="text_bold"><?= $hostel_details[0]['seat_no'] ?></td>
        </tr>
    </table>
    <br />
</div>



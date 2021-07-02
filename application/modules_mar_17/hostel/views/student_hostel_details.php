<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<br />
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
<?php
$this->load->model('hostel/hostel_model');
$room_id = $this->hostel_model->get_room_id($std_info[0]['id']);
if (empty($room_id))
    $room_id = 0;
?>
<br />
<div class="fees_tit">Room Allocation</div>
<br />
<div>
    <table class="staff_table">
        <tr>
            <td style="vertical-align:central">Suggested Room</td>
            <td>
                <select class="all_room1">
                    <option>Select</option>
                    <optgroup label='Same Section'>
                        <?php
                        if (isset($suggested_room) && !empty($suggested_room)) {

                            foreach ($suggested_room as $val1) {
                                $g = 0;
                                $k = 0;
                                if (isset($val1['same_section']) && !empty($val1['same_section'])) {
                                    $g = 1;
                                }
                                if (isset($val1['seat_available']) && !empty($val1['seat_available'])) {
                                    $k = 1;
                                }
                                if ($g == 1 && $k == 1) {
                                    ?>
                                    <option value="<?= $val1['id'] ?>"><?= $val1['room_name'] ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </optgroup>
                    <optgroup label='Available Rooms'>
                        <?php
                        if (isset($suggested_room) && !empty($suggested_room)) {

                            foreach ($suggested_room as $val1) {
                                $g = 0;
                                $k = 0;
                                if (!isset($val1['same_section'])) {
                                    $g = 1;
                                }
                                if (isset($val1['seat_available']) && !empty($val1['seat_available'])) {
                                    $k = 1;
                                }
                                if ($g == 1 && $k == 1) {
                                    ?>
                                    <option value="<?= $val1['id'] ?>"><?= $val1['room_name'] ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </optgroup>

                </select>
            </td>
            <td style="vertical-align:central">All Room</td>
            <td>
                <select class="all_room">
                    <option value=''>Select</option>
                    <?php
                    if (isset($all_room) && !empty($all_room)) {
                        foreach ($all_room as $val) {
                            ?>
                            <option <?= ($room_id[0]['room_id'] == $val['id']) ? 'selected' : '' ?> value="<?= $val['id'] ?>"><?= $val['room_name'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <br />
</div>
<div id='room_details'>
    <?php
    if (isset($room_id[0]['room_id']) && !empty($room_id[0]['room_id'])) {
        $data['roll_no'] = $std_info[0]['std_id'];
        $this->load->model('hostel/hostel_model');
        $data['seat_info'] = $this->hostel_model->get_all_seat_by_room_id($room_id[0]['room_id']);
        //echo "<pre>"; print_r($data['seat_info']); exit;
        echo $this->load->view('hostel/seat_arrangement', $data, TRUE);
    }
    ?>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        $(".staff_table_sub tr:even").css("background-color", "#FAFAFA");
    });
</script>
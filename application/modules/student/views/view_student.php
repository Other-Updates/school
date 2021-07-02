<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<?php
if (isset($from_report) && !empty($from_report)) {
    ?>
    <div class="page-inner" style="padding-left: 0;"><div class="page-title"><span><h3>Personal Details</h3></span> </div></div>
<?php } ?>
<form method="post"  enctype="multipart/form-data">
    <table class="staff_table">
        <tr>
            <td>First Name</td>
            <td>:</td>
            <td class="text_bold"><?= $student_info[0]['name'] ?></td>
            <td>&nbsp;</td>
            <td>Last Name</td>
            <td>:</td>
            <td class="text_bold"><?= $student_info[0]['last_name'] ?></td>
            <td>&nbsp;</td>
            <td rowspan="4" colspan="3" align="center">
                <img id="blah" class="add_staff_thumbnail" src="<?= $this->config->item('base_url'); ?>/profile_image/student/orginal/<?= $student_info[0]['image'] ?>"  alt="Student Image" /><br />
                <span class="green"><?php echo $student_info[0]['image']; ?></span>
            </td>
            <td rowspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>:</td>
            <td colspan="5" class="text_bold"><?= $student_info[0]['address'] ?></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Roll No</td>
            <td>:</td>
            <td class="text_bold"><?= $student_info[0]['std_id'] ?></td><td>&nbsp;</td>
            <td>Father's / Guardians Name</td>
            <td>:</td>
            <td class="text_bold"><?= $student_info[0]['parent_name'] ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td>DOB</td>
            <td>:</td>
            <td class="text_bold"><?= ($student_info[0]['dob'] != '0000-00-00') ? date('d-M-Y', strtotime($student_info[0]['dob'])) : '-' ?></td><td>&nbsp;</td>
            <td>City</td>
            <td>:</td>
            <td class="text_bold"><?= $student_info[0]['city'] ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td>Academic Year</td>
            <td>:</td>
            <td class="text_bold">
                <?= $student_info[0]['from'] ?>
            </td><td>&nbsp;</td>
            <td>State</td>
            <td>:</td>
            <td class="text_bold"><?= $student_info[0]['state'] ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td>Class</td>
            <td>:</td>
            <td class="text_bold">
                <?= $student_info[0]['department'] ?>
            </td><td>&nbsp;</td>
            <td>Country</td>
            <td>:</td>
            <td class="text_bold"><?= $student_info[0]['country'] ?></td><td>&nbsp;</td>
            <td>
                Parent's / Guardians Mob No
            </td>
            <td>:</td>
            <td class="text_bold"><?= $student_info[0]['parent_no'] ?></td>
        </tr>
        <tr>
            <td>Section</td>
            <td>:</td>
            <td id='g_td' class="text_bold">
                <?= $student_info[0]['std_group'][0]['group'] ?>
            </td><td>&nbsp;</td>
            <td>Postal Code</td>
            <td>:</td>
            <td class="text_bold"><?= $student_info[0]['postal_code'] ?></td><td>&nbsp;</td>
            <td>
                Alternate Mobile No
            </td>
            <td>:</td>
            <td class="text_bold"><?= $student_info[0]['contact_no'] ?></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>:</td>
            <td class="text_bold">
                <?= ($student_info[0]['gender'] == 'male') ? 'Male' : 'Female' ?>
            </td><td>&nbsp;</td>
            <td>Joining Date</td>
            <td>:</td>
            <td class="text_bold">
                <?= ($student_info[0]['join_date'] != '0000-00-00') ? date('d-M-Y', strtotime($student_info[0]['join_date'])) : '-' ?>
            </td><td>&nbsp;</td>
            <td>

                Emergency Contact No

            </td>
            <td>:</td>
            <td class="text_bold"><?= $student_info[0]['emgy_no'] ?></td>
        </tr>
        <tr>
            <td>Parent's / Guardians Email Id</td>
            <td>:</td>
            <td class="text_bold">
                <?= $student_info[0]['email_id'] ?>
            </td><td>&nbsp;</td>
            <td>Password</td>
            <td>:</td>
            <td class="text_bold">......

            </td><td></td>
            <td>Chat Option</td>
            <td>:</td>
            <td class="text_bold"><?= ($student_info[0]['chat'] == 1) ? 'Enable' : 'Disable' ?></td>
        </tr>
        <tr>
            <td>Student Type</td>
            <td>:</td>
            <td class="text_bold"><?= ($student_info[0]['student_type'] == 1) ? 'Management' : 'Counselling' ?></td><td>&nbsp;</td>
            <td>Transport</td>
            <td>:</td>
            <td class="text_bold"><?= ($student_info[0]['transport'] == 1) ? 'Yes' : 'No' ?></td><td>&nbsp;</td>
            <td>Hostel</td>
            <td>:</td>
            <td class="text_bold"><?= ($student_info[0]['hostel'] == 1) ? 'Yes' : 'No' ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td>Register No</td>
            <td>:</td>
            <td class="text_bold"><?= ($student_info[0]['regno']) ?></td><td>&nbsp;</td>
            <td>Scholarship</td>
            <td>:</td>
            <td class="text_bold"><?= ($student_info[0]['scholarship'] == 1) ? 'Yes' : 'No' ?></td><td>&nbsp;</td>

            <td>First Graduate</td>
            <td>:</td>
            <td class="text_bold"><?= ($student_info[0]['graduate'] == 1) ? 'Yes' : 'No' ?></td><td>&nbsp;</td>
        </tr>
    </table>
    <br />
    <?php if (isset($student_info['qualification'][0]) && !empty($student_info['qualification'][0])) { ?>
        <table id='app_table' class="staff_table_sub">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Examination</th>
                    <th>Board</th>
                    <th>Percentage (%)</th>
                    <th>Year of Passing</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if (isset($student_info['qualification'][0]) && !empty($student_info['qualification'][0])) {
                    foreach ($student_info['qualification'][0] as $val) {
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $val['examination'] ?></td>
                            <td><?= $val['borad'] ?></td>
                            <td><?= $val['percentage'] ?></td>
                            <td><?= $val['p_year'] ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    <?php } ?>
    <p class="print_admin_use">
        <?php
        if (empty($from_report)) {
            ?>
            <input type="button" value="Back" class="btn btn-danger"  onclick="history.go(-1);return true;" />
            <br />
            <input type="button" class="btn btn-primary print_class" value='Print' style="float:right;"/><br /><br />
        <?php } ?>
    </p>
    <script type="text/javascript">
        $(document).ready(function ()
        {
            $('.print_class').click(function () {
                window.print();
            });
            $(".staff_table_sub tr:even").css("background-color", "#FAFAFA");
        });
    </script>
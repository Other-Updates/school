<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<table class="staff_table">
    <tr>
        <td>Name</td>
        <td>:</td>
        <td class="text_bold"><?= $staff_info[0]['staff_name'] ?></td>
        <td>Joining Date</td>
        <td>:</td>
        <td class="text_bold"><?= date('d-M-Y', strtotime($staff_info[0]['join_date'])) ?></td>
        <td rowspan="4" align="center">
            <img id="blah" class="add_staff_thumbnail" src="<?= $this->config->item('base_url'); ?>/profile_image/staff/orginal/<?= $staff_info[0]['image'] ?>"  alt="Staff Image" /><br />
            <span class="green"><?php echo $staff_info[0]['image']; ?></span>
        </td>
    </tr>
    <tr>
        <td>Address</td>
        <td>:</td>
        <td colspan="4" class="text_bold"><?= $staff_info[0]['address'] ?></td>
    </tr>
    <tr>
        <td>Staff Id</td>
        <td>:</td>
        <td class="text_bold"><?= $staff_info[0]['staff_id'] ?></td>
        <td>Termination Date</td>
        <td>:</td>
        <td class="text_bold"><?= ($staff_info[0]['end_date'] != '0000-00-00') ? date('d-M-Y', strtotime($staff_info[0]['end_date'])) : '-' ?></td>
    </tr>
    <tr>
        <td>State</td>
        <td>:</td>
        <td class="text_bold"><?= $staff_info[0]['state'] ?></td>
        <td>Email Id</td>
        <td>:</td>
        <td class="text_bold"><?= $staff_info[0]['email_id'] ?></td>

    </tr>
    <tr>
        <td>Country</td>
        <td>:</td>
        <td class="text_bold"><?= $staff_info[0]['country'] ?></td>
        <td>Password</td>
        <td>:</td>
        <td class="text_bold">......</td>
        <td></td>
    </tr>
    <tr>
        <td>Postal Code</td>
        <td>:</td>
        <td class="text_bold"><?= $staff_info[0]['postal_code'] ?></td>
        <td>DOB</td>
        <td>:</td>
        <td class="text_bold"><?= date('d-M-Y', strtotime($staff_info[0]['dob'])) ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Gender</td>
        <td>:</td>
        <td class="text_bold">
            <?= ($staff_info[0]['gender'] == 'male') ? 'Male' : 'Female' ?>
        </td>
        <td>Mobile No</td>
        <td>:</td>
        <td class="text_bold"><?= $staff_info[0]['mobile_no'] ?></td>
        <td>Staff Type</td>
    </tr>
    <tr>
        <td>Class</td>
        <td>:</td>
        <td class="text_bold">
            <?= $staff_info[0]['department'] ?>
        </td>
        <td>Designation</td>
        <td>:</td>
        <td class="text_bold">
            <?= $staff_info[0]['designation'] ?>
        </td>
        <td class="text_bold"><?= $staff_info[0]['staff_type']; ?></td>
    </tr>
</table>
<br />
<table id='app_table' class="staff_table_sub">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Examination</th>
            <th>Board</th>
            <th>Percentage (%)</th>
            <th>Year of Passing</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        if (isset($staff_info['qualification'][0]) && !empty($staff_info['qualification'][0])) {
            foreach ($staff_info['qualification'][0] as $val) {
                $i++
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $val['examination'] ?></td>
                    <td><?= $val['borad'] ?></td>
                    <td><?= $val['percentage'] ?></td>
                    <td><?= $val['p_year'] ?></td>
                </tr>
                <?php
            }
        } else
            echo "<tr><td colspan='5'>No Qualification Details...</td></tr>";
        ?>

    </tbody>
</table>

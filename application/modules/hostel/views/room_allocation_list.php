<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<p><a href="<?= $this->config->item('base_url') . 'hostel/room_allocation' ?>" class='btn btn-primary right'>Room Allocation</a></p><br /><br />
<table id="example1" class="table table-bordered table-striped view">
    <thead>
        <tr>
            <th>S.No</td>
            <th>Image</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Academic Year</th>
            <th>Class</th>
            <th>Hostel Name</th>
            <th>Room No</th>
            <th>Seat No</th>
            <th>Advance Amount</th>
            <th>Advance Period</th>
            <th>Joining Date</th>
            <th>Admission Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    if (isset($advance) && !empty($advance)) {
        $i = 1;
        foreach ($advance as $val) {
            ?>
            <tr>
                <td><?= $i ?></td>
                <td>
                    <img id="blah" class="staff_thumbnail" src="<?= $this->config->item('base_url') ?>profile_image/student/thumb/<?= $val['image'] ?>" alt="Staff Image" />
                </td>
                <td><?= $val['roll_no'] ?></td>
                <td><?= $val['name'] ?></td>
                <td><?= $val['from'] ?></td>
                <td><?= $val['nickname'] . '-' . $val['group'] ?></td>
                <td><?= $val['hostel_name'] ?></td>
                <td><?= $val['room_name'] ?></td>
                <td><?= $val['seat_no'] ?></td>
                <td><?= $val['amount'] ?></td>
                <td><?= $val['start_year'] . '-' . $val['end_year'] ?></td>
                <td><?= date('d-M-Y', strtotime($val['admission_date'])) ?></td>
                <td><?= date('d-M-Y', strtotime($val['created_date'])) ?></td>
                <td width="100">
                    <a href="<?= $this->config->item('base_url') . 'hostel/view_student_hostel_details/' . $val['user_id'] . '/' . $val['hostel_id']; ?>" title="View" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>


                </td>
            </tr>
            <?php
            $i++;
        }
    }
    ?>
</table>

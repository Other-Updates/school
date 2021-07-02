<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#example1").dataTable();
        $("#example4").dataTable();
        $("#example5").dataTable();
        $("#example3").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>
<p><a href="<?= $this->config->item('base_url') . 'hostel/admission' ?>" class='btn btn-primary right'>Admission</a></p><br /><br />
<table id="example1" class="table table-bordered table-striped view">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Image</th>
            <th>Roll No</th>
            <th>Name</th>
            <th>Academic Year</th>
            <th>Class</th>
            <th>Hostel Name</th>
            <th>Amount</th>
            <th>Admission Period</th>
            <th>Admission Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    //echo "<pre>"; print_r($advance); exit;
    if (isset($advance) && !empty($advance)) {
        $i = 1;
        foreach ($advance as $val) {
            ?>
            <tr>
                <td><?= $i ?></td>
                <td>
                    <img id="blah" class="staff_thumbnail" src="<?= $this->config->item('base_url') ?>profile_image/student/thumb/<?= $val['image'] ?>" alt="Student Image" />
                </td>
                <td><?= $val['roll_no'] ?></td>
                <td><?= $val['name'] ?></td>
                <td><?= $val['from']; ?></td>
                <td><?= $val['nickname'] . '-' . $val['group'] ?></td>
                <td><?= $val['hostel_name'] ?></td>
                <td><?= $val['amount'] ?></td>
                <td><?= $val['start_year'] . '-' . $val['end_year'] ?></td>
                <td><?= date('d-M-Y', strtotime($val['admission_date'])) ?></td>
                <td>
                    <a href="<?= $this->config->item('base_url') . 'hostel/view_student_admission/' . $val['roll_no'] ?>" title="View" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="<?= $this->config->item('base_url') . 'hostel/update_student_admission/' . $val["roll_no"]; ?>" title="Edit" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
            <?php
            $i++;
        }
    }
    ?>
</table>

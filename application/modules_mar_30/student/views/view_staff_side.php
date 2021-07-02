<style type="text/css">

</style>
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

<?php
$user_det = $this->session->userdata('logged_in');
$permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No&nbsp;</th>
            <th>Image</th>
            <th>Roll No</th>
            <th>Name</th>
            <th>Student Type</th>
            <th>Hostel</th>
            <th>Transport</th>
            <th>Email Id</th>
            <th>Contact No</th>
            <th class="print_admin_use">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($all_student) && !empty($all_student)) {
            $i = 0;
            foreach ($all_student as $val) {
                $i++;
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><a href="#profile_img_<?= $val['id'] ?>" data-toggle="modal"><img class="staff_thumbnail" src="<?= $this->config->item('base_url') . 'profile_image/student/thumb/' . $val['image'] ?>" /></a></td>
                    <td><?= $val['std_id'] ?></td>
                    <td><?= $val['name'] . "&nbsp;" . $val['last_name'] ?></td>
                    <td><?= ($val['student_type'] == 1) ? 'Management' : 'Counselling' ?></td>
                    <td><?= ($val['hostel'] == 1) ? 'Yes' : 'No' ?></td>
                    <td><?= ($val['transport'] == 1) ? 'Yes' : 'No' ?></td>
                    <td><?= $val['email_id'] ?></td>
                    <td><?= $val['contact_no'] ?></td>

                    <td class="print_admin_use">
                        <a href="<?= $this->config->item('base_url') . 'student/view_student/' . $val['id'] ?>" title="View" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                        <?php
                        if ($permission[0]['add_student'] == 1) {
                            ?>
                            <a href="<?= $this->config->item('base_url') . 'student/update_student/' . $val['id'] ?>" title="Edit" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                            <!--<a href="<?= $this->config->item('base_url') . 'student/delete_student/' . $val['id'] ?>">Delete</a>-->
                            <a href="#delete_<?= $val['id'] ?>" title="Delete" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                            <?php
                        }
                        ?>

                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<br />
<input type="button" class="btn btn-primary print_class" value='Print' style="float:right;"/>
<br /><br />
<script type="text/javascript">
    $(document).ready(function ()
    {
        $('.print_class').click(function () {
            window.print();
        });
    });
</script>
<?php
if (isset($all_student) && !empty($all_student)) {
    foreach ($all_student as $val) {
        ?>
        <div id="delete_<?= $val['id'] ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position:relative;top:-11px;"><i class="icon-remove"></i></button>
                        <h3 id="myModalLabel"></h3>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete ?
                    </div>
                    <div class="modal-footer">

                        <a href="<?= $this->config->item('base_url') . 'student/delete_student/' . $val['id'] ?>" type='button' class="btn btn-primary del_class">Yes</a>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} else
    echo "<tr><td colspan='10'></td></tr>";
?>
<?php
if (isset($all_student) && !empty($all_student)) {
    foreach ($all_student as $val) {
        ?>
        <div id="profile_img_<?= $val['id'] ?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Profile Image</h3>
                    </div>
                    <div class="modal-body">
                        <img src="<?= $this->config->item('base_url') . 'profile_image/student/thumb/' . $val['image'] ?>" width="50%" />
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>
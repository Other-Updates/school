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
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No&nbsp;</th>
            <th>Image</th>
            <th>Staff Name</th>
            <th>Class</th>
            <th>Designation</th>
            <th>Email Id</th>
            <th>Mobile No</th>
            <th>Created Date</th>

            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($staff) && !empty($staff)) {
            $i = 0;
            foreach ($staff as $val) {
                $i++;
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><a href="#profile_img_<?= $val['id'] ?>" data-toggle="modal"><img class="staff_thumbnail" src="<?= $this->config->item('base_url') . 'profile_image/staff/thumb/' . $val['image'] ?>" width="100%" /></a></td>
                    <td><?= $val['staff_name'] ?></td>
                    <td><?= $val['nickname'] ?></td>
                    <td><?= $val['designation'] ?></td>
                    <td><?= $val['email_id'] ?></td>
                    <td><?= $val['mobile_no'] ?></td>
                    <td><?= date('d-M-Y', strtotime($val['ldt'])); ?></td>

                    <td>
                        <a href="<?= $this->config->item('base_url') . 'staff/view_staff/' . $val['id'] ?>" title="View" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="<?= $this->config->item('base_url') . 'staff/update_staff/' . $val['id'] ?>" title="Edit" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                        <!--<a href="<?= $this->config->item('base_url') . 'staff/delete_staff/' . $val['id'] ?>">Delete</a>-->
                        <a href="#delete_<?= $val['id'] ?>" title="Delete" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>

<?php
if (isset($all_staff) && !empty($all_staff)) {
    foreach ($all_staff as $val) {
        ?>
        <div id="profile_img_<?= $val['id'] ?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Profile Image</h3>
                    </div>
                    <div class="modal-body">
                        <img src="<?= $this->config->item('base_url') . 'profile_image/staff/thumb/' . $val['image'] ?>"  width="50%"/>
                    </div>
                </div>
            </div>
        </div>
        <?php }
}
?>
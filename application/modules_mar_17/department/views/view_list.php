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
<div class="nav-tabs-custom" id="list_all">
    <ul class="nav nav-tabs">
        <li class="<?= ($status == 1) ? 'active' : '' ?>"><a href="#tab_1" data-toggle="tab">Active</a></li>
        <li class="<?= ($status != 1) ? 'active' : '' ?>"><a href="#tab_2" data-toggle="tab">In-Active</a></li>
        <li class="pull-right"><a href="#" class="text-muted"></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane <?= ($status == 1) ? 'active' : '' ?>" id="tab_1">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Class</th>
                        <th>Nick Name</th>
                        <th>status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($details) && !empty($details)) {
                        $i = 0;
                        foreach ($details as $billto) {
                            if ($billto['status'] == 1) {
                                $i++;
                                ?>
                                <tr><td><?php echo "$i"; ?></td>
                                    <td><?php echo $billto["department"]; ?></td>
                                    <td><?php echo $billto["nickname"]; ?></td>
                                    <td><?= ($billto['status'] == 1) ? 'Active' : 'In-Active'; ?></td>
                                    <td><?php echo ($billto['ldt'] == 0) ? '--' : date("d-M-Y", strtotime($billto["ldt"])); ?></td>

                                    </td>
                                    <td>
                                        <a href="#test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm" title="View"><i class="fa fa-eye"></i></a>
                                        <a href="#test1_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="#test2_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn btn-danger btn-sm" title="In-Active"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
            <?php
        }
    }
}
?>
                </tbody>
            </table>
        </div><!-- /.tab-pane -->
        <div class="tab-pane <?= ($status != 1) ? 'active' : '' ?>" id="tab_2"  >
            <table id="example3" class="table table-bordered table-striped">
                <thead>
                    <tr><th>S.No</th>
                        <th>Class</th>
                        <th>Nick Name</th>
                        <th>status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr></thead>
                <tbody>
<?php
if (isset($list) && !empty($list)) {
    $i = 0;
    foreach ($list as $billto) {
        if ($billto['status'] == 0) {
            $i++;
            ?>
                                <tr><td><?php echo "$i"; ?></td>
                                    <td><?php echo $billto["department"]; ?></td>
                                    <td><?php echo $billto["nickname"]; ?></td>
                                    <td><?= ($billto['status'] == 1) ? 'Active' : 'In-Active'; ?></td>
                                    <td><?php echo ($billto['ldt'] == 0) ? '--' : date("d-M-Y", strtotime($billto["ldt"])); ?></td>
                                </td><td>
                                <a href="#test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm" title="View"><i class="fa fa-eye"></i></a>
                                <a href="#test1_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#test3_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-times"></i></a>
                            </td></tr>
            <?php
        }
    }
}
?>
        </tbody>
    </table>
</div></div><!-- /.tab-pane --></div><!-- /.tab-content -->

<?php
if (isset($list) && !empty($list)) {
    foreach ($list as $billto) {
        ?>
        <div id="test_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog"><div class="modal-content"><div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a><h3 id="myModalLabel">View Department</h3></div><div class="modal-body">
                        <table width="100%" class="staff_table_sub">
                            <tr>
        <?php /* ?><td><strong>S.No</strong></td> <td><?php echo $billto["id"]; ?></td></tr><tr><?php */ ?>
                                <td><strong>Class</strong></td> <td class="text_bold1"><?php echo $billto["department"]; ?></td></tr><tr>
                            <tr> <td><strong>NickName</strong></td> <td class="text_bold1"><?php echo $billto["nickname"]; ?></td></tr>
                            <td><strong>Status</strong></td><td class="text_bold1"><?= ($billto['status'] == 1) ? 'Active' : 'In-Active'; ?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>
<?php
if (isset($details) && !empty($details)) {
    foreach ($details as $billto) {
        ?>

        <div id="test1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1"
             role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Update Class</h3>
                    </div>
                    <div class="modal-body">
                        <table width="100%">
                            <tr>
                            <!--<td><strong>S.No</strong></td>-->
                                <td><input type="hidden" name="id" class="id form-control" id="id" value="<?php echo $billto["id"]; ?>" readonly /></td>
                            </tr>
                            <tr>
                                <td><strong>Class:</strong></td>
                                <td><input type="text" class="department form-control" id="department" onblur="this.value = removeSpaces(this.value)" name="department" value="<?php echo $billto["department"]; ?>" /><input type="hidden" id="desg" class="desg" value="<?php echo $billto["department"]; ?>" /><span class="error_msg" style="color:#F00;"></span> <span class="error_msg1" style="color:#F00;"></span></td>
                            </tr>
                            <tr>
                                <td><strong>NickName:</strong></td>
                                <td><input type="text" class="nickname" id="nickname"  name="nickname" value="<?php echo $billto["nickname"]; ?>" />
                                    <input type="hidden" class="nickname_hidden" value="<?php echo $billto["nickname"]; ?>" />
                                    <span class="nick_error" style="color:#F00;"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <select name="status" id="status" class="status form-control mandatory" >
                                        <option <?= ($billto['status'] == 1) ? 'selected' : ''; ?> value="1">Active</option>
                                        <option <?= ($billto['status'] == 0) ? 'selected' : ''; ?> value="0">In-Active</option>

                                    </select><input type="hidden" id="stat" class="stat" value="<?php echo $billto["status"]; ?>"/></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                             <!--<input type="button" id="update"  value="Update" name="update" />
                 <input type="button" id="no" value="no" name="no" />-->

                        <button type="button" class="btn btn-primary"  id="update"><i class="fa fa-edit"></i> Update</button>
                        <button type="reset" class="btn btn-danger"  id="no" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>

<?php
if (isset($list) && !empty($list)) {
    foreach ($list as $billto) {
        ?>
        <div id="test2_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"> <a class="close" data-dismiss="modal">×</a>

                        <h3 id="myModalLabel">In-Active Class</h3>
                    </div>
                    <div class="modal-body">
                        Do you want to In-Active? &nbsp; <strong><?php echo $billto["department"]; ?></strong>
                        <input type="hidden" value="<?php echo $billto['id']; ?>" class="hid" />
                    </div>
                    <div class="modal-footer">


                        <button class="btn btn-primary delete_yes" id="yes">Yes</button>
                        <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i>No</button>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>

<!--Delete-->
<?php
if (isset($list) && !empty($list)) {
    foreach ($list as $billto) {
        ?>

        <div id="test3_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a><h3 id="myModalLabel">Delete Class</h3>
                    </div><div class="modal-body">
                        Do You want to delete Permanently? &nbsp; <strong><?php echo $billto["department"]; ?></strong>
                        <input type="hidden" value="<?php echo $billto['id']; ?>" class="hidin" />
                    </div><div class="modal-footer">
                        <button class="btn btn-primary delete_yes" id="yesin">Yes</button>
                        <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i> No</button>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>
<script type="text/javascript">
    $("#nickname").blur(function ()
    {
        var name = $(this).val();
        $.ajax(
                {
                    url: BASE_URL + "department/checking_nickname",
                    type: 'POST',
                    data: {nick_name: name},
                    success: function (result)
                    {
                        $("#errormessage1").html(result);

                    }
                });
    });
    // checking nick name duplication update
    $(".nickname").keyup(function ()
    {

        var name = $(this).val();
        var id = $(this).parent().parent().parent().find('.id').val();
        var msg = $(this).offsetParent().find('.nick_error');

        $.ajax(
                {
                    url: BASE_URL + "department/checking_nickname_update",
                    type: 'POST',
                    data: {nick_name: name, id: id},
                    success: function (result)
                    {
                        msg.html(result);

                    }
                });
    });
</script>
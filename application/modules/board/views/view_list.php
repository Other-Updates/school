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
                        <th>Board</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr></thead>
                <tbody>
                    <?php
                    if (isset($details) && !empty($details)) {
                        $i = 0;
                        foreach ($details as $billto) {
                            if ($billto['status'] == 1) {
                                $i++;
                                ?>
                                <tr><td><?php echo "$i"; ?></td>
                                    <td><?php echo $billto["board_type"]; ?></td>
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
                        <th>Board</th>
                        <th>Status</th>
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
                                    <td><?php echo $billto["board_type"]; ?></td>
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
                        <a class="close" data-dismiss="modal">×</a><h3 id="myModalLabel">View Board</h3></div><div class="modal-body">
                        <table width="100%" class="staff_table_sub">
                            <tr>
                                <?php /* ?><td><strong>S.No</strong></td> <td><?php echo $billto["id"]; ?></td></tr><tr><?php */ ?>
                                <td><strong>board</strong></td> <td class="text_bold1"><?php echo $billto["board_type"]; ?></td></tr><tr>
                                <td><strong>Status</strong></td><td class="text_bold1"><?= ($billto['status'] == 1) ? 'Active' : 'In-Active'; ?></td>
                            </tr>
                        </table>
                    </div>

                    <script language="javascript" type="text/javascript">
                        function removeSpaces(string) {
                            return string.split(' ').join('');
                        }
                    </script>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}
?>
<?php
if (isset($list) && !empty($list)) {
    foreach ($list as $billto) {
        ?>
        <div id="test1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1"
             role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Update Board</h3>
                    </div>
                    <div class="modal-body">
                        <table width="100%">
                            <tr>
                           <!-- <td><strong>Id:</strong></td>-->
                                <td><input type="hidden" name="id" class="id form-control" id="id" value="<?php echo $billto["id"]; ?>" readonly="readonly" /></td>
                            </tr>
                            <tr>
                                <td><strong>Board:</strong></td>
                                <td><input type="text" class="board form-control" id="board"  name="board" value="<?php echo $billto["board_type"]; ?>" /><input type="hidden" id="desg" class="desg" value="<?php echo $billto["board_type"]; ?>" /><span class="error_msg" style="color:#F00;"></span> <span class="error_msg1" style="color:#F00;"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <select name="status" id="status" class="status form-control">
                                        <option <?= ($billto['status'] == 1) ? 'selected' : ''; ?> value="1">Active</option>
                                        <option <?= ($billto['status'] == 0) ? 'selected' : ''; ?> value="0">In-Active</option>
                                        <input type="hidden" id="stat" class="stat" value="<?php echo $billto["status"]; ?>"/>
                                    </select></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"  id="update"><i class="fa fa-edit"></i> Update</button>
                        <button type="button" class="btn btn-danger"  id="no" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}
?>

<?php
if (isset($list) && !empty($list)) {
    foreach ($list as $billto) {
        ?>
        <div id="test2_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a><h3 id="myModalLabel">In-Active Board</h3>
                    </div><div class="modal-body">
                        Do you want to In-Active? &nbsp; <strong><?php echo $billto["board_type"]; ?></strong>
                        <input type="hidden" value="<?php echo $billto['id']; ?>" class="hid" />
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary delete_yes" id="yes">Yes</button>
                        <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i> No</button>
                    </div></div></div>
        </div>
    <?php
    }
}
?>

<!--Delete-->
<?php
if (isset($list) && !empty($list)) {
    foreach ($list as $billto) {
        ?>

        <div id="test3_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a><h3 id="myModalLabel">Delete Board</h3>
                    </div><div class="modal-body">
                        Do you want delete permanently? &nbsp; <strong><?php echo $billto["board_type"]; ?></strong>
                        <input type="hidden" value="<?php echo $billto['id']; ?>" class="hidin" />
                    </div><div class="modal-footer">
                        <button class="btn btn-primary delete_yes" id="yesin">Yes</button>
                        <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i> No</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}
?>
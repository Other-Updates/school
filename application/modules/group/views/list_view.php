
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

<div id='g_div'>
    <div class="nav-tabs-custom" id="list_all">
        <ul class="nav nav-tabs">
            <li class="<?= ($status == 1) ? 'active' : '' ?>"><a href="#tab_1" data-toggle="tab">Active</a></li>
            <li class="<?= ($status != 1) ? 'active' : '' ?>"><a href="#tab_2" data-toggle="tab">Inactive</a></li>
            <li class="pull-right"><a href="#" class="text-muted"></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane <?= ($status == 1) ? 'active' : '' ?>" id="tab_1">
                <table id="example1" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Board</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    if (isset($g_list) && !empty($g_list)) {
                        $i = 0;
                        foreach ($g_list as $val) {

                            if ($val['status'] == 1) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $val['department'] ?></td>
                                    <td><?php echo $val['group'] ?></td>
                                    <td><?php echo $val['board_type'] ?></td>
                                    <td><?php echo ($val['status'] == 1) ? 'Active' : 'In-Active'; ?></td>
                                    <td>
                                        <a href="#view_<?php echo $val['id'] ?>" data-toggle="modal" title="View" data-original-title="View" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="#update_<?php echo $val['id'] ?>" data-toggle="modal" title="Edit" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="#delete_<?php echo $val['id'] ?>" data-toggle="modal" title="In-Active" data-original-title="View" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                    ?>
                </table>
            </div><!-- /.tab-pane -->
            <div class="tab-pane <?= ($status != 1) ? 'active' : '' ?>" id="tab_2"  >

                <table id="example3" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Board</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    if (isset($g_list) && !empty($g_list)) {
                        $i = 0;
                        foreach ($g_list as $val) {
                            if ($val['status'] == 0) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $val['department'] ?></td>
                                    <td><?php echo $val['group'] ?></td>
                                    <td><?php echo $val['board_type'] ?></td>
                                    <td><?php echo ($val['status'] == 1) ? 'Active' : 'In-Active'; ?></td>
                                    <td>
                                        <a href="#view_<?php echo $val['id'] ?>" data-toggle="modal" title="View" data-original-title="View" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="#update_<?php echo $val['id'] ?>" data-toggle="modal" title="Edit" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="#delete1_<?php echo $val['id'] ?>" data-toggle="modal" title="Delete" data-original-title="View" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                    ?>

                </table>            </div>
        </div><!-- /.tab-pane -->
    </div><!-- /.tab-content -->
</div>

</div>
</div>

<?php
if (isset($g_list) && !empty($g_list)) {
    foreach ($g_list as $val) {
        ?>
        <div id="update_<?= $val['id'] ?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Edit Section</h3>
                    </div>
                    <div class="modal-body">
                        <table class="update_table" width="100%">
                            <thead>
                                <tr>

                                    <td><input type="hidden" class='update_id ' readonly="readonly" value="<?= $val['id'] ?>" /></td>
                                </tr>
                                <tr>
                                    <th>Class</th>
                                    <td>
                                        <select class='update_depart_id '>

                                            <?php
                                            if (isset($all_depart) && !empty($all_depart)) {
                                                foreach ($all_depart as $value) {
                                                    ?>
                                                    <option <?= ($value['id'] == $val['depart_id']) ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['department'] ?></option>
                                                <?php }
                                                ?><input type="hidden" value="<?= $val['depart_id'] ?>"  class="did" id="did"/><?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Section</th>
                                    <td><input type="text" class='update_group' maxlength="1" value="<?= $val['group'] ?>" />
                                        <input type="hidden" class='ugroup' maxlength="1" value="<?= $val['group'] ?>" />
                                        <span class="group_error" style="color:#F00;"></span></td>
                                </tr>
                                <tr>
                                    <th>Board</th>
                                    <td><select name="board_type"  class="board_type form-control mandatory" >
                                            <?php
                                            if (isset($board) && !empty($board)) {
                                                $i = 0;
                                                foreach ($board as $bil) {
                                                    $select = ($bil['id'] == $val['board_id']) ? 'selected' : ''
                                                    ?>
                                                    <option value="<?php echo $bil['id']; ?>" <?php echo $select; ?>> <?php echo $bil['board_type']; ?> </option>
                                                    <?php
                                                    $i++;
                                                }
                                            }
                                            ?>
                                        </select><span class="group_error" style="color:#F00;"></span></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <select class='update_status '>
                                            <option <?= ($val['status'] == 1) ? 'selected' : ''; ?> value="1">Active</option>
                                            <option <?= ($val['status'] == 0) ? 'selected' : ''; ?> value="0">In-Active</option>
                                            <input type="hidden" class='ustatus' maxlength="1" value="<?= $val['status'] ?>" />
                                        </select>

                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary update_btn"><i class="fa fa-edit"></i> Update</button>
                        <button type="button" class="btn btn-danger" id="no_update" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>                   </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<?php
if (isset($g_list) && !empty($g_list)) {
    foreach ($g_list as $val) {
        ?>
        <div id="update_<?= $val['id'] ?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Edit Section</h3>
                    </div>
                    <div class="modal-body">
                        <table class="update_table" width="100%">
                            <thead>
                                <?php /* ?><tr>
                                  <th>Id</th>
                                  <td><input type="text" class='update_id ' readonly="readonly" value="<?=$val['id']?>" /></td>
                                  </tr><?php */ ?>
                                <tr>
                                    <th>Class</th>
                                    <td>
                                        <select class='update_depart_id '>
                                            <option value="0">Select</option>
                                            <?php
                                            if (isset($all_depart) && !empty($all_depart)) {
                                                foreach ($all_depart as $value) {
                                                    ?>
                                                    <option <?= ($value['id'] == $val['depart_id']) ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['department'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Section</th>
                                    <td><input type="text" class='update_group ' value="<?= $val['group'] ?>" /></td>
                                </tr>
                                <tr>
                                    <th>Board</th>
                                    <td><select name="board_type"  class="board_type form-control mandatory" >
                                            <?php
                                            if (isset($board) && !empty($board)) {
                                                $i = 0;
                                                foreach ($board as $bil) {
                                                    $select = ($bil['id'] == $val['board_id']) ? 'selected' : ''
                                                    ?>
                                                    <option value="<?php echo $bil['id']; ?>" <?php echo $select; ?>> <?php echo $bil['board_type']; ?> </option>
                                                    <?php
                                                    $i++;
                                                }
                                            }
                                            ?>
                                        </select><span class="group_error" style="color:#F00;"></span></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <select class='update_status '>
                                            <option <?= ($val['status'] == 1) ? 'selected' : ''; ?> value="1">Active</option>
                                            <option <?= ($val['status'] == 0) ? 'selected' : ''; ?> value="0">In-Active</option>
                                        </select>

                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary update_btn"><i class="fa fa-edit"></i> Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button></div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<?php
if (isset($g_list) && !empty($g_list)) {
    foreach ($g_list as $val) {
        ?>
        <div id="delete_<?= $val['id'] ?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Section In-Active</h3>
                    </div>
                    <div class="modal-body">
                        Do you want to <strong>In-Active</strong>?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary del_class" value="<?= $val['id'] ?>">Yes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<?php
if (isset($g_list) && !empty($g_list)) {
    foreach ($g_list as $val) {
        ?>
        <div id="delete1_<?= $val['id'] ?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel"> Delete Section</h3>
                    </div>
                    <div class="modal-body">
                        Do you want to delete permanently ?
                        <input type="hidden" value="<?php echo $val['id']; ?>" class="hidin" />
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary delete_yes" id="cool">Yes</button>
                        <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i> No</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>


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

    $(document).ready(function () {

        $("#example1 td:nth-child(3)").each(function ()
        {
            if ($(this).html() == "High")
            {
                $(this).css({'background-color': '#ff0000', 'color': '#FFf', 'font-weight': 'bold'});
            } else if ($(this).html() == "Normal")
            {
                $(this).css({'background-color': '#47c547', 'color': '#FFf', 'font-weight': 'bold'});
            } else
            {
                $(this).css({'background-color': '#ffa500', 'color': '#FFf', 'font-weight': 'bold'});
            }
        });
        $("#example3 td:nth-child(3)").each(function ()
        {
            if ($(this).html() == "High")
            {
                $(this).css({'background-color': '#ff0000', 'color': '#FFf', 'font-weight': 'bold'});
            } else if ($(this).html() == "Normal")
            {
                $(this).css({'background-color': '#47c547', 'color': '#FFf', 'font-weight': 'bold'});
            } else
            {
                $(this).css({'background-color': '#ffa500', 'color': '#FFf', 'font-weight': 'bold'});
            }
        });
    });
</script>
<div class="nav-tabs-custom" id="list_all">
    <ul class="nav nav-tabs">
        <li class="<?= ($status == 1) ? 'active' : '' ?>"><a href="#tab_1" data-toggle="tab">Open</a></li>
        <li class="<?= ($status != 1) ? 'active' : '' ?>"><a href="#tab_2" data-toggle="tab">Close</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane  <?= ($status == 1) ? 'active' : '' ?>" id="tab_1">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.No&nbsp;&nbsp;&nbsp;</th>
                        <th>Subject</th>
                        <th>Priority</th>
                        <th>Admin</th>
                        <th>status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($list) && !empty($list)) {
                        $i = 0;
                        foreach ($list as $billto) {
                            if ($billto['status'] == 1) {
                                $i++
                                ?>
                                <tr><td><?php echo "$i"; ?></td>
                                    <td><?php echo $billto["subject"]; ?></td>
                                    <td class="prio"><?php echo $billto["priority"]; ?></td>
                                    <td><?php echo $billto["name"]; ?></td>
                                    <td><?= ($billto['status'] == 1) ? 'Open' : 'Close'; ?></td>
                                    <td><?php echo ($billto['ldt'] == 0) ? '--' : date("d-M-Y"); ?></td>
                                </td><td>
                                <a href="#test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>


                            </td></tr>
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
                <th>Subject</th>
                <th>Priority</th>
                <th>Admin</th>
                <th>status</th>
                <th>Date</th>
                <th>Action</th></tr>
        </thead>
        <tbody>
            <?php
            if (isset($list) && !empty($list)) {
                $i = 0;
                foreach ($list as $billto) {
                    if ($billto['status'] == 0) {
                        $i++;
                        ?>
                        <tr><td><?php echo "$i"; ?></td>

                            <td><?php echo $billto["subject"]; ?></td>
                            <td><?php echo $billto["priority"]; ?></td>
                            <td><?php echo $billto["name"]; ?></td>
                            <td><?= ($billto['status'] == 1) ? 'Open' : 'Close'; ?></td>
                            <td><?php echo ($billto['ldt'] == 0) ? '--' : date("d-M-Y"); ?></td>
                        </td><td>
                        <a href="#test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="#test3_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                    </td></tr>
                <?php
            }
        }
    }
    ?>
</tbody>
</table>
</div>
</div><!-- /.tab-pane -->
</div><!-- /.tab-content -->
</div>
<?php
if (isset($list) && !empty($list)) {
    foreach ($list as $billto) {
        ?>
        <div id="test_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog"> <div class="modal-content"><div class="modal-header"> <a class="close" data-dismiss="modal">×</a><h4>View Ticket</h4><h3 id="myModalLabel"></h3>
                    </div><div class="modal-body">
                        <table width="100%">
                            <tr>
                            <tr><th>Subject</th> <td><?php echo $billto["subject"]; ?></td>  </tr>
                            <tr><th>Priority</th><td><?php echo $billto["priority"]; ?></td>  </tr>
                            <tr> <th>Description</th> <td><?php echo $billto["description"]; ?></td>  </tr>
                            <tr> <th>Admin</th> <td><?php echo $billto["name"]; ?></td>  </tr>
                            <tr><th>status</th> <td><?= ($billto['status'] == 1) ? 'Open' : 'Close'; ?></td>  </tr>
                            <tr> <th>Date</th><td><?php echo ($billto['ldt'] == 0) ? '--' : date("d-M-Y"); ?></td>
                            </tr>
                        </table>
                    </div>
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

<!--/*UPDATA*/-->

<?php
if (isset($list) && !empty($list)) {
    foreach ($list as $billto) {
        ?>
        <div id="test1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1"
             role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a><h4>Update Ticket</h4>
                        <h3 id="myModalLabel"></h3></div>
                    <div class="modal-body">
                        <table width="100%">
                            <tr>
                                <td><strong></strong></td>
                                <td><input type="hidden" name="id" class="id form-control" id="id" value="<?php echo $billto["id"]; ?>" readonly="readonly" /></td>
                            </tr>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td><input type="text" class="name1" id="name1" name="name1" value="<?php echo $billto["name1"]; ?>" /></td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>E-Mail</strong></td>
                                <td><input type="text"  class="email" id="email" name="email" value="<?php echo $billto["email"]; ?>"/>  </td>
                            </tr><tr>
                                <td width="25%">Subject</td>
                                <td><input type="text"  class="subject" id="subject" name="subject" value="<?php echo $billto["subject"]; ?>"/> </td></tr>
                            <tr>
                                <td width="25%">Priority</td>
                                <td><select  id="priority" name="priority" class="priority"  value="<?php echo $billto["priority"]; ?>">
                                        <option <?= ($billto['priority']) ? 'selected' : ''; ?> value="<?php echo $billto["priority"]; ?>"><?php echo $billto["priority"]; ?></option>
                                        <option value="Normal">Normal</option>
                                        <option value="High">High</option>
                                        <option value="Low">Low</option>
                                    </select></td>
                            </tr><tr>
                                <td>Class</td>
                                <td><select id="department" class="department">
                                        <option value="">Select</option>
                                        <?php
                                        if (isset($desg) && !empty($desg)) {
                                            foreach ($desg as $row) {
                                                ?>
                                                <option <?= ($row['department'] == $billto['department']) ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['department']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select></td></tr>
                            <tr>
                                <td>Post to Admin</td>
                                <td><select id="admin_id" class="admin_id">
                                        <option value="">Select</option>
                                        <?php
                                        if (isset($adm) && !empty($adm)) {
                                            foreach ($adm as $row) {
                                                ?>
                                                <option <?= ($row['name'] == $billto['name']) ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </select></td></tr>
                            <tr>
                                <td width="25%">Description Of Problem</td></tr>
                            <tr><td>&nbsp;</td>
                                <td><textarea name="description" id="description" class="description"><?php echo $billto["description"]; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>status:</strong></td>
                                <td>
                                    <select name="status" id="status" class="status">
                                        <option value="1">Open</option>
                                        <option value="0">Close</option>
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

<!--Delete-->

<?php
if (isset($list) && !empty($list)) {
    foreach ($list as $billto) {
        ?>
        <div id="test2_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a><h4>Close Ticket</h4>
                        <h3 id="myModalLabel"></h3>
                    </div>
                    <div class="modal-body">
                        Do You Want to Close? &nbsp; <strong><?php echo $billto["name1"]; ?></strong>
                        <input type="hidden" value="<?php echo $billto['id']; ?>" class="hid" />
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary delete_yes" id="yes">Yes</button>
                        <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i> No</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}
?>
<!--delete all-->
<?php
if (isset($list) && !empty($list)) {
    foreach ($list as $billto) {
        ?>
        <div id="test3_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a><h4>Remove Ticket</h4> <h3 id="myModalLabel"></h3>
                    </div> <div class="modal-body">
                        Do You Want to Delete permanently? &nbsp; <strong><?php echo $billto["name1"]; ?></strong>
                        <input type="hidden" value="<?php echo $billto['id']; ?>" class="hidin" />
                    </div>
                    <div class="modal-footer">
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
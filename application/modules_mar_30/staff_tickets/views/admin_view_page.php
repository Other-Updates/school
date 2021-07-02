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

        $("#example1 td:nth-child(5)").each(function ()
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
        $("#example3 td:nth-child(5)").each(function ()
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
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Subject</th>
                        <th>Priority</th>
                        <th>Class</th>
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
                                    <td><?php echo $billto["name1"]; ?></td>
                                    <td><?php echo $billto["email"]; ?></td>
                                    <td><?php echo $billto["subject"]; ?></td>
                                    <td class="prio"><?php echo $billto["priority"]; ?></td>
                                    <td><?php echo $billto["dept"]; ?></td>

                                    <td><?= ($billto['status'] == 1) ? 'Open' : 'Close'; ?></td>
                                    <td><?php echo ($billto['ldt'] == 0) ? '--' : date("d-M-Y", strtotime($billto["ldt"])); ?></td>
                                </td><td><a href="#test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye" title="View"></i></a>
                                <a href="#test1_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit" title="Update"></i></a>

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
                <th>Name</th>
                <th>E-Mail</th>
                <th>Subject</th>
                <th>Priority</th>
                <th>Class</th>
                <th>status</th>
                <th>Date</th>
                <th>Action</th></tr>
        </thead>
        <tbody>
            <?php
            if (isset($details) && !empty($details)) {
                $i = 0;
                foreach ($details as $billto) {
                    if ($billto['status'] == 0) {
                        $i++;
                        ?>
                        <tr><td><?php echo "$i"; ?></td>
                            <td><?php echo $billto["name1"]; ?></td>
                            <td><?php echo $billto["email"]; ?></td>
                            <td><?php echo $billto["subject"]; ?></td>
                            <td><?php echo $billto["priority"]; ?></td>
                            <td><?php echo $billto["dept"]; ?></td>
                            <td><?= ($billto['status'] == 1) ? 'Open' : 'Close'; ?></td>
                            <td><?php echo ($billto['ldt'] == 0) ? '--' : date("d-M-Y", strtotime($billto["ldt"])); ?></td>
                        </td><td>
                        <a href="#test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye" title="View"></i></a>
                        <a href="#test3_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times" title="Delete"></i></a>
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
if (isset($details) && !empty($details)) {
    foreach ($details as $billto) {
        ?>

        <div id="test_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog"> <div class="modal-content"><div class="modal-header"> <a class="close" data-dismiss="modal">×</a><h4>View Ticket</h4><h3 id="myModalLabel"></h3>
                    </div><div class="modal-body">
                        <table width="100%" class="staff_table_sub">
                            <tr>
        <?php /* ?>    <tr><th>id</th><td><?php echo $billto["id"]; ?></td></tr><?php */ ?>
                            <tr><td>Name</td><td><?php echo $billto["name1"]; ?></td>  </tr>
                            <tr><td>E-Mail</td><td><?php echo $billto["email"]; ?></td>  </tr>
                            <tr><td>Subject</td> <td><?php echo $billto["subject"]; ?></td>  </tr>
                            <tr><td>Priority</td><td><?php echo $billto["priority"]; ?></td>  </tr>
                            <tr><td>Class</td> <td><?php echo $billto["dept"]; ?></td>  </tr>
                            <tr> <td>Description</td> <td><?php echo $billto["description"]; ?></td>  </tr>

                            <tr><td>status</td> <td><?= ($billto['status'] == 1) ? 'Open' : 'Close'; ?></td>  </tr>
                            <tr> <td>Date</td><td><?php echo ($billto['ldt'] == 0) ? '--' : date("d-M-Y", strtotime($billto["ldt"])); ?></td>
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
}
?>



<!--/*UPDATA*/-->

<?php
if (isset($details) && !empty($details)) {
    foreach ($details as $billto) {
        ?>
        <div id="test1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1"
             role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog"><div class="modal-content">    <div class="modal-header"><a class="close" data-dismiss="modal">×</a>    <h3 id="myModalLabel">Update Tickets</h3></div>
                    <div class="modal-body">
                        <table width="100%" class="staff_table_sub">
                            <tr>

                                <td><strong></strong></td>
                                <td><input type="hidden" name="id" class="id form-control" id="id" value="<?php echo $billto["id"]; ?>" readonly="readonly" /></td>

                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><label><?php echo $billto["name1"]; ?></label><input type="hidden" class="name1" id="name1" name="name1" readonly="readonly" value="<?php echo $billto["name1"]; ?>" /></td>
                            </tr>
                            <tr>
                                <td>E-Mail</strong></td>
                                <td><label><?php echo $billto["email"]; ?></label><input type="hidden"  class="email" id="email" name="email" readonly="readonly" value="<?php echo $billto["email"]; ?>"/>  </td>
                            </tr><tr>
                                <td width="50%">Subject</td>
                                <td><label><?php echo $billto["subject"]; ?></label><input type="hidden"  class="subject" id="subject" name="subject" readonly="readonly" value="<?php echo $billto["subject"]; ?>"/> </td></tr>
                            <tr>
                                <td width="25%">Priority</td>
                                <td><label><?php echo $billto["priority"]; ?></label> <input type="hidden" value="<?php echo $billto["priority"]; ?>" id="priority" class="priority" name="department" readonly="readonly" /></td>
                            </tr>
                            <tr><td>Class</td>
                                <td><label> <?php echo $billto["dept"]; ?></label><input type="hidden" value="<?php echo $billto['department']; ?>" id="department" class="department" name="department" readonly="readonly" /></td></tr>
                            <tr>

                                <td><input type="hidden" value="<?php echo $billto["admin_id"]; ?>" id="admin_id" class="admin_id" name="admin_id" /> </td></tr>
                            <tr><td width="25%">Description Of Problem</td>
                                <td><label><?php echo $billto["description"]; ?></label><input type="hidden" name="description" id="description"  class="description" value="<?php echo $billto["description"]; ?>" />
                                </td></tr><tr>
                                <td>status</td>
                                <td><select name="status" id="status" class="status">
                                        <option value="1">Open</option>
                                        <option value="0">Close</option>
                                    </select></td></tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"  id="update"><i class="fa fa-edit"></i> Update</button>
                        <button type="button" class="btn btn-danger"  id="no" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                    </div>
                </div>
            </div>
        </div>
    <?php }
}
?>

<!--Delete-->

<?php
if (isset($details) && !empty($details)) {
    foreach ($details as $billto) {
        ?>
        <div id="test2_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a><h4>Close Ticket</h4>
                        <h3 id="myModalLabel"></h3>
                    </div>
                    <div class="modal-body">
                        Do You Want Close Ticket? &nbsp; <strong><?php echo $billto["name1"]; ?></strong>
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
}
?>

<!--delete all-->

<?php
if (isset($details) && !empty($details)) {
    foreach ($details as $billto) {
        ?>
        <div id="test3_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a><h4>Delete Ticket</h4>
                        <h3 id="myModalLabel"></h3>
                    </div>
                    <div class="modal-body">
                        Do You Want Remove Ticket permanently? &nbsp; <strong><?php echo $billto["name1"]; ?></strong>
                        <input type="hidden" value="<?php echo $billto['id']; ?>" class="hidin" />
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary delete_yes" id="yesin">Yes</button>
                        <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i>No</button>
                    </div>
                </div>
            </div>
        </div>
    <?php }
}
?>
<script>

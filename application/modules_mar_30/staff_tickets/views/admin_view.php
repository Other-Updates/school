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
<?php
$user_det = $this->session->userdata('logged_in');
?>
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
                        <th>S.No</th>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Subject</th>
                        <th>Priority</th>
                        <th>Class</th>
                        <th>Status</th>
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
            $i++
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
                                <a href="#test1_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit" title="Edit"></i></a>

                            </td></tr>
        <?php }
    }
} ?>
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
                <th>Status</th>
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

                        <a href="#test3_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times" title="Delete"></i></a></td></tr>
        <?php }
    }
} ?>
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
            <div class="modal-dialog"> <div class="modal-content"><div class="modal-header"> <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">View Tickets</h3>
                    </div><div class="modal-body">
                        <table width="100%" class="staff_table_sub">
                            <tr>

        <?php /* ?> <tr><th>id</th><td><?php echo $billto["id"]; ?></td></tr><?php */ ?>
                            <tr><td width="40%">Name</td><td><strong><?php echo $billto["name1"]; ?></strong></td>  </tr>
                            <tr><td>E-Mail</td><td><strong><?php echo $billto["email"]; ?></strong></td>  </tr>
                            <tr><td>Subject</td> <td><strong><?php echo $billto["subject"]; ?></strong></td>  </tr>
                            <tr><td>Priority</td><td><strong><?php echo $billto["priority"]; ?></strong></td>  </tr>
                            <tr><td>Class</td> <td><strong><?php echo $billto["dept"]; ?></strong></td>  </tr>
                            <tr> <td>Description</td> <td><strong><?php echo $billto["description"]; ?></strong></td>  </tr>
                            <tr><td>Status</td> <td><strong><?= ($billto['status'] == 1) ? 'Open' : 'Close'; ?></strong></td>  </tr>
                            <tr> <td>Date</td><td><strong><?php echo ($billto['ldt'] == 0) ? '--' : date("d-M-Y", strtotime($billto["ldt"])); ?></strong></td>

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



<!--/*UPDATA*/-->

<?php
if (isset($details) && !empty($details)) {
    foreach ($details as $billto) {
        ?>
        <div id="test1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1"
             role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog"><div class="modal-content">    <div class="modal-header"><a class="close" data-dismiss="modal">×</a>    <h3 id="myModalLabel">Update Tickets</h3></div>
                    <div class="modal-body">
                        <table class="staff_table_sub">
                            <tr>

                                <td width="40%"><strong></strong></td>
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
                                <td>Subject</td>
                                <td><label><?php echo $billto["subject"]; ?></label><input type="hidden"  class="subject" id="subject" name="subject" readonly="readonly" value="<?php echo $billto["subject"]; ?>"/> </td></tr>
                            <tr>
                                <td>Priority</td>
                                <td><label><?php echo $billto["priority"]; ?></label> <input type="hidden" value="<?php echo $billto["priority"]; ?>" id="priority" class="priority" name="department" readonly="readonly" /></td>
                            </tr>
                            <tr><td>Class</td>
                                <td><label> <?php echo $billto['dept']; ?></label><input type="hidden" value="<?php echo $billto['department']; ?>" id="department" class="department" name="department" readonly="readonly" /></td></tr>
                            <tr>
                                <td></td>
                                <td> <input type="hidden" value="<?php echo $billto["admin_id"]; ?>" id="admin_id" class="admin_id" name="admin_id" /> </td></tr>
                            <tr><td>Description Of Problem</td>
                                <td><label><?php echo $billto["description"]; ?></label><input type="hidden" name="description" id="description"  class="description" value="<?php echo $billto["description"]; ?>" />
                                </td></tr><tr>
                                <td>Status</td>
                                <td><select name="status" id="status" class="status">
                                        <option value="1">open</option>
                                        <option value="0">close</option>
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
} ?>

<!--Delete-->

<?php
if (isset($details) && !empty($details)) {
    foreach ($details as $billto) {
        ?>
        <div id="test2_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Close Tickets</h3>
                    </div>
                    <div class="modal-body">
                        Do You Want Close Ticket? &nbsp; <strong><?php echo $billto["name1"]; ?></strong>
                        <input type="hidden" value="<?php echo $billto['id']; ?>" class="hid" />
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary delete_yes" id="yes">Yes</button>
                        <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i> No</button>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>

<!--delete all-->

<?php
if (isset($details) && !empty($details)) {
    foreach ($details as $billto) {
        ?>
        <div id="test3_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Delete Ticket</h3>
                    </div>
                    <div class="modal-body">
                        Do You Want Delete this Ticket permanently? &nbsp; <strong><?php echo $billto["name1"]; ?></strong>
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
} ?>
<script type="text/javascript">
    $("#update").live("click", function ()
    {
        // for_loading('Loading...Data Updating...'); // loading notification
        var id = $(this).parent().parent().find('.id').val(),
                name1 = $(this).parent().parent().find('.name1').val(),
                email = $(this).parent().parent().find('.email').val(),
                subject = $(this).parent().parent().find('.subject').val(),
                priority = $(this).parent().parent().find('.priority').val(),
                department = $(this).parent().parent().find('.department').val(),
                description = $(this).parent().parent().find('.description').val(),
                admin_id = $(this).parent().parent().find('.admin_id').val(),
                status = $(this).parent().parent().find('.status').val();
        $.ajax({
            url: BASE_URL + "staff_tickets/update_admin_view",
            type: 'POST',
            data: {value1: id, value2: name1, value3: email, value4: subject, value5: priority, value6: department, value7: description,
                value8: status, value9: admin_id},
            success: function (result) {
                $("#list_all").html(result);
                //for_response('Update Successfully...!'); // resutl notification
            }
        });
        $('.modal').css("display", "none");
        $('.fade').css("display", "none");


        $("#yes").live("click", function ()
        {
            // for_loading_del('Loading...Data Deleting...'); // loading notification
            var hid = $(this).parent().parent().find('.hid').val();
            $.ajax({
                url: BASE_URL + "staff_tickets/admin_delete_staff_tickets",
                type: 'POST',
                data: {value1: hid},
                success: function (result) {
                    $("#list_all").html(result);
                    // for_response_del('Delete Successfully...!'); // resutl notification
                }
            });
            $('.modal').css("display", "none");
            $('.fade').css("display", "none");
        });
        $("#no").live("click", function ()
        {
            $('.modal').css("display", "none");
            $('.fade').css("display", "none");
        });
    });

    $("#yesin").live("click", function ()
    {
        for_loading_del('Loading...Data Removing...'); // loading notification
        var hidin = $(this).parent().parent().find('.hidin').val();
        $.ajax({
            url: BASE_URL + "staff_tickets/admin_delete_staff_tickets_inactive",
            type: 'POST',
            data: {value1: hidin},
            success: function (result) {
                $("#list_all").html(result);
                for_response_del('Deleted Successfully...!'); // resutl notification
            }
        });
        $('.modal').css("display", "none");
        $('.fade').css("display", "none");
    });


</script>
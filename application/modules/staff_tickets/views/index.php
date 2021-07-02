<script type="text/javascript">
    var j = 0;
    $('.mandatory1').live('blur', function ()
    {
        var m = $(this).parent().find(".errormessage");

        if ($(this).val() == '' || $(this).val() == null || $(this).val().trim().length == 0 || $(this).val() == '.' || $(this).val() == ',')
        {
            m.html("Required field");
            j = 1;

        } else
            m.html("");
    });
    // name validation
    $('#subject').live('blur', function ()
    {
        var subject = $(this).val();
        var m = $("#sub_error");

        if (subject == '' || subject == null || subject.trim().length == 0)
        {
            m.html("Minimum 10 to 70 characters");

        } else if (subject.trim().length < 10 || subject.trim().length > 70)
        {
            m.html("Minimum 10 to 70 characters");

        } else
        {
            m.html("");
        }
    });
    $('#description').live('blur', function ()
    {

        var description = $(this).val();
        var m = $("#desp_error");

        if (description == '' || description == null || description.trim().length == 0)
        {
            m.html("Minimum 10 to 255 characters");

        } else if (description.trim().length < 10 || description.trim().length > 250)
        {
            m.html("Minimum 10 to 255 characters");

        } else
        {
            m.html("");
        }

    });




</script>



<script type="text/javascript">
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
<?php
$user_det = $this->session->userdata('logged_in');
/* echo "<pre>";
  print_r($user_det);
  exit; */
?>
<div class="box-body table-responsive">
    <form>
        <table width="100%" border="0" class="form_table">
            <tr>
                <td width="15%">Name</td>
                <td width="40%"><label><?php echo $user_det['name']; ?></label><input type="hidden"   id="name1" readonly="readonly" value="<?php echo $user_det['name']; ?>" />  </td>
                <td width="15%">E-Mail</td>
                <td><label><?php echo $user_det['email']; ?></label><input type="hidden"   id="email" readonly="readonly" value="<?php echo $user_det['email']; ?>"/>  </td>
                <td>&nbsp;</td>
            <tr>
                <td>Class</td>
                <td><label><?php echo $desg[0]["department"]; ?></label><input type="hidden" name="department" id="department" class="department" value="<?php echo $desg[0]["department"]; ?>" readonly="readonly"  /></td>
                <td>Subject</td>
                <td><input type="text"  class="mandatory1 mandatory2 " onkeypress="return ValidateFabricName(event)" maxlength="70" placeholder="Enter Your Subject of Problem" id="subject"/> <span style="color:red;" id="sub_error" class="errormessage"></span></td>
            <tr> <td>Priority</td>
                <td><select  id="priority" class="mandatory1 mandatory2">
                        <option value="">Select</option>
                        <option value="High">High</option>
                        <option value="Normal">Normal</option>
                        <option value="Low">Low</option>
                    </select><span style="color:red;" id="priority_error" class="errormessage"></span></td>
                <td>Post to Admin</td>
                <td><select id="admin_id" class="mandatory1 mandatory2">
                        <option value="">Select</option>
                        <?php
                        if (isset($adm) && !empty($adm)) {
                            foreach ($adm as $row) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select><span style="color:red;" id="admin_error" class="errormessage"></span></td>
                <td>&nbsp;</td>
            </tr>
            <td></td>
            <td><input type="hidden"  class="mandatory2" id="staff_id" readonly="readonly" value="<?php echo $user_det['user_id']; ?>" />  </td>
            <tr>

                <td style="vertical-align:top;">Description Of Problem</td>
                <td colspan="3"><textarea style="height:50px;" name="description"  class="mandatory1 " id="description" placeholder="Enter Your Description" ></textarea><span style="color:red;" id="desp_error" class="errormessage"></span>  </td>

                <td>&nbsp;</td>

            </tr>
            <tr>
                <td></td>

            <tr>&nbsp;</tr> <td></td>
            <td><input type="button" value="Submit" name="adding" id="submit" class="btn btn-primary"/>&nbsp;&nbsp;
                <input type="reset" value="Cancel" id="cancel" class="btn btn-danger"/></td>
            </tr>
        </table>
        <br /></form>
    <div class="nav-tabs-custom" id="list_all">
        <ul class="nav nav-tabs">
            <li class="<?= ($status == 1) ? 'active' : '' ?>"><a href="#tab_1" data-toggle="tab">Open</a></li>
            <li class="<?= ($status != 1) ? 'active' : '' ?>"><a href="#tab_2" data-toggle="tab">Close</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
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
                                        </td>
                                        <td>
                                            <a href="#test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
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
            <div class="tab-pane <?= ($status != 1) ? 'Open' : '' ?>" id="tab_2"  >
                <table id="example3" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
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
                                if ($billto['status'] == 0) {
                                    $i++;
                                    ?>
                                    <tr><td><?php echo "$i"; ?></td>
                                        <td><?php echo $billto["subject"]; ?></td>
                                        <td><?php echo $billto["priority"]; ?></td>
                                        <td><?php echo $billto["name"]; ?></td>
                                        <td><?= ($billto['status'] == 1) ? 'Open' : 'Close'; ?></td>
                                        <td><?php echo ($billto['ldt'] == 0) ? '--' : date("d-M-Y"); ?></td>
                                        </td>
                                        <td>
                                            <a href="#test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="#test3_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">View Ticket</h3>
                    </div>
                    <div class="modal-body">
                        <table width="100%" class="staff_table_sub">
                            <tr>
                                <?php /* ?><tr><th>S.No</th><td><?php echo $billto["id"]; ?></td></tr><?php */ ?>
                            <tr><td>Subject</td> <td class="text_bold1"><?php echo $billto["subject"]; ?></td>  </tr>
                            <tr><td>Priority</td><td class="text_bold1"><?php echo $billto["priority"]; ?></td>  </tr>
                            <tr> <td>Description</td> <td class="text_bold1"><?php echo $billto["description"]; ?></td>  </tr>
                            <tr> <td>Admin</td> <td class="text_bold1"><?php echo $billto["name"]; ?></td>  </tr>
                            <tr><td>status</td> <td class="text_bold1"><?= ($billto['status'] == 1) ? 'Open' : 'Close'; ?></td>  </tr>
                            <tr> <td>Date</td><td class="text_bold1"><?php echo ($billto['ldt'] == 0) ? '--' : date("d-M-Y"); ?></td>


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
            <div class="modal-dialog"><div class="modal-content">    <div class="modal-header"><a class="close" data-dismiss="modal">×</a><h4>Update Ticket</h4>
                        <h3 id="myModalLabel"></h3></div>
                    <div class="modal-body">
                        <table width="100%" class="staff_table_sub">
                            <tr>
                            <!--<td><strong>S.No</strong></td>-->
                                <td><input type="hidden" name="id" class="id form-control" id="id" value="<?php echo $billto["id"]; ?>" readonly="readonly" /></td>
                            </tr>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td><input type="text" class="name1" id="name1" name="name1" value="<?php echo $billto["name1"]; ?>" /></td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>E-Mail</strong></td>
                                <td><input type="text"  class="email" id="email" name="email" value="<?php echo $billto["email"]; ?>"/>  </td>
                            </tr><tr><td width="25%">Subject</td>
                                <td><input type="text"  class="subject" id="subject" name="subject" value="<?php echo $billto["subject"]; ?>"/>  </td>
                            </tr>
                            <tr>
                                <td width="25%">Priority</td>
                                <td><select  id="priority" name="priority" class="priority"  value="<?php echo $billto["priority"]; ?>">
                                        <option <?= ($billto['priority']) ? 'selected' : ''; ?> value="<?php echo $billto["priority"]; ?>"><?php echo $billto["priority"]; ?></option>
                                        <option value="Normal">Normal</option>
                                        <option value="High">High</option>
                                        <option value="Low">Low</option>
                                    </select></td>
                            </tr>
                            <tr>
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
                                <td><textarea name="description" rows="5" cols="5" id="description" class="description"><?php echo $billto["description"]; ?></textarea>
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
                        Do You Want to In_Active? &nbsp; <strong><?php echo $billto["name1"]; ?></strong>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a><h4>Delete Ticket</h4>
                        <h3 id="myModalLabel"></h3>
                    </div>
                    <div class="modal-body">
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
<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#submit").click(function ()
        {
            var i = 0;

            var name1 = $("#name1").val();
            var email = $("#email").val();
            var subject = $("#subject").val();
            var priority = $("#priority").val();
            var department = $("#department").val();
            var description = $("#description").val();
            var admin_id = $("#admin_id").val();
            var staff_id = $("#staff_id").val();

            if (priority == '' || priority == null)
            {

                $("#priority_error").html("Select Priority");
                i = 1;
            }
            if (admin_id == '' || admin_id == null)
            {
                $("#admin_error").html("Select Admin");
                i = 1;
            }
            if (description == '' || description == null)
            {
                $("#desp_error").html("Enter your Description");
                i = 1;
            }
            if (subject == '' || subject == null)
            {
                $("#sub_error").html("Enter Your Subject");
                i = 1;
            } else if (subject.trim().length < 10 || subject.trim().length > 70)
            {
                m.html("Minimum 10 to 70 characters");
                i = 1;
            } else if (description.trim().length < 10 || description.trim().length > 250)
            {
                m.html("Minimum 10   to 255 characters");
                i = 1;
            }
            if (i == 0)
            {
                for_loading('Loading...Data Adding...');
                $.ajax({
                    url: BASE_URL + "staff_tickets/insert_staff_tickets",
                    type: 'POST',
                    data: {value1: name1, value2: email, value3: subject, value4: priority, value5: department, value6: description, value7: admin_id, value8: staff_id},
                    success: function (result)
                    {
                        $("#list_all").html(result);
                        for_response('Added Successfully...!');
                    }

                });
                $("#subject").val('');
                $("#priority").val('');
                $("#description").val('');
                $("#admin_id").val('');
            }
        });

        $("#update").live("click", function ()
        {
            for_loading('Loading...Data Updating...'); // loading notification
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
                url: BASE_URL + "staff_tickets/update_staff_tickets",
                type: 'POST',
                data: {value1: id, value2: name1, value3: email, value4: subject, value5: priority, value6: department, value7: description,
                    value8: status, value9: admin_id},
                success: function (result) {
                    $("#list_all").html(result);
                    for_response('Update Successfully...!'); // resutl notification
                }
            });
            $('.modal').css("display", "none");
            $('.fade').css("display", "none");
        });
        $("#yes").live("click", function ()
        {
            for_loading_del('Loading...Data Deleting...'); // loading notification
            var hid = $(this).parent().parent().find('.hid').val();

            $.ajax({
                url: BASE_URL + "staff_tickets/delete_staff_tickets",
                type: 'POST',
                data: {value1: hid},
                success: function (result) {
                    $("#list_all").html(result);
                    for_response_del('Delete Successfully...!'); // resutl notification
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
            url: BASE_URL + "staff_tickets/delete_staff_tickets_inactive",
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
    $("#cancel").click(function ()
    {
        $('.mandatory2').val('');
        $('.errormessage').html('');
    });
</script>



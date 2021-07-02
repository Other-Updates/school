<div class="box-body table-responsive">
    <table width="100%" border="0" class="form_table">
        <tr>
            <td width="110"><b>Board</b></td>
            <td><input type="text" name="board"  value="" class="mandatory mandatory6" placeholder="Enter Board"  id="name" maxlength="50"/> </td>
        <tr>
        <tr><td></td><td colspan="2"><span id="errormessage" style="color:#F00;"></span> </td></tr>
        <td></td>
        <td><input type="button" value="Add" name="adding" id="submit" onclick="return validate()" class="btn btn-primary"/>&nbsp;&nbsp;
            <input type="button" value="Cancel" id="cancel" class="btn btn-danger"/></td>
        </tr>
    </table>
    <br />
    <div class="nav-tabs-custom" id="list_all"><ul class="nav nav-tabs">
            <li class="<?= ($status == 1) ? 'active' : '' ?>"><a href="#tab_1" data-toggle="tab">Active</a></li>
            <li class="<?= ($status != 1) ? 'active' : '' ?>"><a href="#tab_2" data-toggle="tab">Inactive</a></li>
            <li class="pull-right"><a href="#" class="text-muted"></a></li>
        </ul><div class="tab-content"><div class="tab-pane <?= ($status == 1) ? 'active' : '' ?>" id="tab_1">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Board</th>
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
                        if (isset($details) && !empty($details)) {
                            $i = 0;
                            foreach ($details as $billto) {
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
</div>

<?php
if (isset($details) && !empty($details)) {
    foreach ($details as $billto) {
        ?>

        <div id="test_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Board View</h3>
                    </div>
                    <div class="modal-body">
                        <table width="100%" class="staff_table_sub">
                            <tr>
                                <?php /* ?><td><strong>S.No</strong></td> <td><?php echo $billto["id"]; ?></td></tr><tr><?php */ ?>
                                <td><strong>Board</strong></td> <td class="text_bold1"><?php echo $billto["board_type"]; ?></td></tr><tr>
                                <td><strong>Status</strong></td><td class="text_bold1"><?= ($billto['status'] == 1) ? 'Active' : 'In-Active'; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Discard</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<?php
if (isset($details) && !empty($details)) {
    foreach ($details as $billto) {
        ?>

        <div id="test1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1"
             role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Update Board</h3>
                    </div>
                    <div class="modal-body">
                        <table width="100%">
                            <tr>
                            <!--<td><strong>S.No</strong></td>-->
                                <td><input type="hidden" name="id" class="id form-control" id="id" value="<?php echo $billto["id"]; ?>" readonly="readonly" /></td>
                            </tr>
                            <tr>
                                <td><strong>Board:</strong></td>
                                <td><input type="text" class="board form-control" id="board"   name="board" value="<?php echo $billto["board_type"]; ?>" /><span class="error_msg" style="color:#F00;"></span> <span class="error_msg1" style="color:#F00;"></span><input type="hidden" id="desg" class="desg" value="<?php echo $billto["board_type"]; ?>" /></td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <select name="status" id="status" class="status form-control mandatory">
                                        <option <?= ($billto['status'] == 1) ? 'selected' : ''; ?> value="1">Active</option>
                                        <option <?= ($billto['status'] == 0) ? 'selected' : ''; ?> value="0">In-Active</option>
                                        <input type="hidden" id="stat" class="stat" value="<?php echo $billto["status"]; ?>"/>
                                    </select></td>
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
        <?php
    }
}
?>
<?php
if (isset($details) && !empty($details)) {
    foreach ($details as $billto) {
        ?>
        <div id="test2_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"> <a class="close" data-dismiss="modal">×</a>

                        <h3 id="myModalLabel">In-Active Board</h3>
                    </div>
                    <div class="modal-body">
                        Do You Want to In-Active? &nbsp; <strong><?php echo $billto["board_type"]; ?></strong>
                        <input type="hidden" value="<?php echo $billto['id']; ?>" class="hid" />
                    </div>
                    <div class="modal-footer">


                        <button class="btn btn-primary delete_yes" id="yes">Yes</button>
                        <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i>No</button>
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
if (isset($details) && !empty($details)) {
    foreach ($details as $billto) {
        ?>
        <div id="test3_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a><h4>Delete Board</h4><h3 id="myModalLabel">
                    </div><div class="modal-body">
                        Do you want delete Permanently? &nbsp; <strong><?php echo $billto["board_type"]; ?></strong>
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
<script type="text/javascript">
    $(document).ready(function ()
    {
        //	$("#name").focus();
        $("#submit").click(function ()
        {
            var name = $("#name").val();
            var message = document.getElementById("errormessage").innerHTML;
            if (name.trim().length >= 2 && name.trim().length <= 50) {



                if ((message.trim()).length == 0)
                {
                    for_loading('Loading... Data add Please Wait '); // loading notification
                    $.ajax(
                            {
                                url: BASE_URL + "board/insert_board",
                                type: 'POST',
                                data: {value1: name},
                                success: function (result)
                                {
                                    $("#list_all").html(result);
                                    for_response('Successfully Add...!'); // resutl notification

                                }
                            });
                    $("#name").val('');
                } else
                {
                    for_response_del('Already Exist...!'); // resutl notification
                }
            } else
            {
                document.getElementById("errormessage").innerHTML = "Must be Enter Min 2 To Max 50 character";
                $('#name').css('border', '1px solid #F00');
            }

        });

        $("#name").live('keyup', function ()
        {
            var name = $("#name").val();
            $.ajax(
                    {
                        url: BASE_URL + "board/checking_board",
                        type: 'POST',
                        data: {value1: name},
                        success: function (result)
                        {
                            $("#errormessage").html(result);

                        }
                    });

        });
        $("#update").live("click", function ()
        {
            var board = $(this).parent().parent().find(".board").val();

            var i = 0;
            var message = $(".error_msg");
            var message1 = $(".error_msg1").html();
            var id = $(this).parent().parent().find('.id').val();
            var board = $(this).parent().parent().find('.board').val();

            var status = $(this).parent().parent().find('.status').val();
            if (board.trim().length < 2 || board.trim().length > 50)
            {
                //alert("alert");
                message.html("Min 2 To Max 50 character");
                i = 1;
            } else
            {
                message.html("");

            }
            $.ajax(
                    {
                        url: BASE_URL + "board/checking_Update",
                        type: 'POST',
                        data: {value1: board, value2: id},
                        success: function (result)
                        {
                            //alert(result);
                            if (result.trim().length > 0)
                            {
                                i = 1;
                                $(".error_msg1").html(result);
                            }

                        }
                    });
            if (i == 0 && message1.trim().length == 0)
            {
                for_loading('Loading... Data add Please Wait '); // loading notification

                $.ajax({
                    url: BASE_URL + "board/update_board",
                    type: 'POST',
                    data: {value1: id, value2: board, value3: status},
                    success: function (result) {

                        $("#list_all").html(result);
                        for_response('Successfully Update...!'); // resutl notification
                    }

                });
                $('.modal').css("display", "none");
                $('.fade').css("display", "none");

            }




        });
        $("#board").live("blur", function ()
        {
            var name = $(this).val();
            var id = $(this).offsetParent().find(".id").val();
            var message = $(".error_msg1");

            $.ajax(
                    {
                        url: BASE_URL + "board/checking_Update",
                        type: 'POST',
                        data: {value1: name, value2: id},
                        success: function (result)
                        {
                            //alert(result);
                            message.html(result);

                        }
                    });

        });

        $("#yes").live("click", function ()
        {
            for_loading_del('Loading... Data  Please Wait '); // loading notification
            var hid = $(this).parent().parent().find('.hid').val();

            $.ajax({
                url: BASE_URL + "board/delete_board",
                type: 'POST',
                data: {value1: hid},
                success: function (result) {

                    $("#list_all").html(result);
                    for_response_del('Loading Data Successfully...!'); // resutl notification
                }

            });
            $('.modal').css("display", "none");
            $('.fade').css("display", "none");

        });
        $("#no").live("click", function ()
        {
            var $a = desg = $(this).parent().parent().parent().find('.desg').val(),
                    $b = stat = $(this).parent().parent().parent().find('.stat').val(),
                    $c = board = $(this).parent().parent().find('.board').val(),
                    $d = status = $(this).parent().parent().find('.status').val();
            board = $(this).parent().parent().find('.board').val(''),
                    board = $(this).parent().parent().find('.board').val($a),
                    status = $(this).parent().parent().find('.status').val(),
                    status = $(this).parent().parent().find('.status').val($b);
            $b = $d;
            $(".error_msg").html('');
            $(".error_msg1").html('');
            $('.modal').css("display", "none");
            $('.fade').css("display", "none");

        });

        $("#yesin").live("click", function ()
        {
            for_loading_del('Loading... Data Please Wait '); // loading notification
            var hidin = $(this).parent().parent().find('.hidin').val();


            $.ajax({
                url: BASE_URL + "board/delete_board_inactive",
                type: 'POST',
                data: {value1: hidin},
                success: function (result) {

                    $("#list_all").html(result);
                    for_response_del('Loading Data please wait...!'); // resutl notification
                }

            });
            $('.modal').css("display", "none");
            $('.fade').css("display", "none");

        });
        $("#cancel").click(function ()
        {
            $("#errormessage").html('');
            $('#name').css('border', '1px solid #CCCCCC');
            $('.mandatory').val('');
            $('#man1').html('');

        });

    });

</script>



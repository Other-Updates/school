
<script>
    $("#depart_id").live('change', function ()
    {
        $('.group').focus();
        var group_depart = $("#depart_id").val();
        if (group_depart == "")
        {
            $("#v1").html("Select Class");
            //$("#dis").css("display","none");
            $("#test").val('');
        } else
        {

            $("#v1").html("");
            $(".group").val('');
            //$("#dis").css("display","block");
        }
    });

    $('#test').live('blur', function ()
    {
        var group = $(this).val();
        //var depart=$("#depart_id").val();
        if (group == "" || group == null || group.trim().length == 0)
        {
            $("#v2").html("Required Field");
        } else
        {
            $("#v2").html("");
        }
    });

    $(".sec_dup").live('keyup', function ()
    {
        var group = $(this).val();
        var depart = $(".dep").val();
        //alert(depart);
        $.ajax({
            url: BASE_URL + "group/group_validate",
            type: 'POST',
            data: {
                val1: group, val2: depart

            },
            success: function (result) {
                $('#vald').html(result);

            }
        });



    });

</script>




<!--<table style="display:none;">
<tr id="last_row">
        <td><input type="text" class='group length test' name='group[]' id="test"/></td>
    <td><input type="button" value="-" class='remove_comments btn bg-purple btn-sm'/></td>
</tr>
</table>-->
<table class="form_table">
    <tr>
        <td width="120">Class</td>
        <td>
            <select id='depart_id' class="dep">
                <option value="">Select</option>
                <?php
                if (isset($all_depart) && !empty($all_depart)) {
                    foreach ($all_depart as $val) {
                        ?>
                        <option value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                        <?php
                    }
                }
                ?>
            </select><span id="v1" style="color:#F00;"></span>
        </td>
    </tr>
    <tr>
        <td valign="top">Section</td>
        <td>
            <table id='app_table'>
                <tr>
                    <th>Type</th>
                    <th></th>
                </tr>

                <tr><?php $i = 0; ?>
                    <td width="15%"><input type="text" class='group length sec_dup' name='group[]' id="test"/>
                        <span id="v2" style="color:#F00;"></span> </td>

<!--<td><input type="button" value="+" class='add_row btn bg-purple btn-sm' id="dis" style="display:none;"/></td>-->

                </tr>
            </table>
            <span id="vald" style="color:#F00;"></span>
        </td>
    </tr>
    <tr>
        <td></td>
        <td><input type="button" value="Add" id='add_group' class="btn btn-primary" /></td>
    </tr>
</table>
<br />
<div id='g_div'>
    <div class="nav-tabs-custom" id="list_all">
        <ul class="nav nav-tabs">
            <li class="<?= ($status == 1) ? 'active' : '' ?>"><a href="#tab_1" data-toggle="tab">Active</a></li>
            <li class="<?= ($status != 1) ? 'active' : '' ?>"><a href="#tab_2" data-toggle="tab">In-Active</a></li>
            <li class="pull-right"><a href="#" class="text-muted"></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Class</th>
                            <th>Section</th>
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
                                    <td><?= $i; ?></td>
                                    <td><?= $val['department'] ?></td>
                                    <td><?= $val['group'] ?></td>
                                    <td><?= ($val['status'] == 1) ? 'Active' : 'In-Active'; ?></td>
                                    <td>
                                        <a href="#view_<?= $val['id'] ?>" data-toggle="modal" title="View" data-original-title="View" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="#update_<?= $val['id'] ?>" data-toggle="modal" title="Edit" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="#delete_<?= $val['id'] ?>" data-toggle="modal" title="In-Active" data-original-title="View" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
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
                                    <td><?= $i; ?></td>
                                    <td><?= $val['department'] ?></td>
                                    <td><?= $val['group'] ?></td>
                                    <td><?= ($val['status'] == 1) ? 'Active' : 'In-Active'; ?></td>
                                    <td>
                                        <a href="#view_<?= $val['id'] ?>" data-toggle="modal" title="View" data-original-title="View" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="#update_<?= $val['id'] ?>" data-toggle="modal" title="Edit" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="#delete1_<?= $val['id'] ?>" data-toggle="modal" title="Delete" data-original-title="View" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                    ?>

                </table>
            </div>
        </div><!-- /.tab-pane -->
    </div><!-- /.tab-content -->
</div>

</div>
</div>
<?php
if (isset($g_list) && !empty($g_list)) {

    foreach ($g_list as $val) {
        ?>
        <div id="view_<?= $val['id'] ?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style= align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Section View</h3>
                    </div>
                    <div class="modal-body">
                        <table width="100%" class="staff_table_sub">
                            <tbody>
                                <?php /* ?><tr>
                                  <td>Id</td>
                                  <td class="text_bold1"><?=$val['id']?></td>
                                  </tr><?php */ ?>
                                <tr>
                                    <td>Class</td>
                                    <td class="text_bold1"><?= $val['department'] ?> </td>
                                </tr>
                                <tr>
                                    <td>Section</td>
                                    <td class="text_bold1"><?= $val['group'] ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td class="text_bold1"><?= ($val['status'] == 1) ? 'Active' : 'In-Active'; ?></td>
                                </tr>
                            </tbody>
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
                                        <select class='update_depart_id'>

                                            <?php
                                            if (isset($all_depart) && !empty($all_depart)) {
                                                foreach ($all_depart as $value) {
                                                    ?>
                                                    <option <?= ($value['id'] == $val['depart_id']) ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['department'] ?></option>

                                                <?php }
                                                ?>

                                                <input type="hidden" value="<?= $val['depart_id'] ?>"  class="did" id="did"/><?php
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
        <div id="delete_<?= $val['id'] ?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Section In-active</h3>
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
                        <h3 id="myModalLabel">Delete Section</h3>
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
    <?php }
}
?>



<script type="text/javascript">
    $(document).ready(function () {

        $('.add_row').click(function () {
            $('#last_row').clone().appendTo('#app_table');
        });


        $("#add_group").live('click', function ()
        {
            var depart_id = $('#depart_id').val();
            var group = $("#test").val();
            var message = $("#vald").html();
            var i = 0;
            if (depart_id == "")
            {
                $("#v1").html("Select Class");
                i = 1;
            } else
            {
                $("#v1").html("");
            }
            if (group == "" || group == null || group.trim().length == 0)
            {
                $("#v2").html("Required Field");
                i = 1;
            } else
            {
                $("#v2").html("");
            }
            if (message.trim().length > 0)
            {
                i = 1;
            }
            if (i == 1)
            {
                return false;
            } else
            {
                for_loading('Loading... Data add Please Wait '); // loading notification
                $.ajax({
                    url: BASE_URL + "group/insert_group",
                    type: 'POST',
                    data: {
                        depart_id: depart_id,
                        group: group
                    },
                    success: function (result) {
                        $('#g_div').html(result);
                        //$('.close_div').hide();
                        $('#dis').css("display", "none");
                        for_response('Successfully Add...!'); // resutl notification

                    }
                });

                $('#depart_id').val('');
                $('.group').val('');
            }
        });



    });

    /* $("#add_group").click(function(){

     var message=$("#vald").html();
     var depart_id=$('#depart_id').val();
     var group=$("#test").val();
     var i=0;
     if(depart_id=="")
     {
     $("#v1").html("Select Class");
     i=1;
     }
     else
     {
     $("#v1").html("");

     $.ajax({
     url:BASE_URL+"group/group_validate",
     type:'POST',
     data:{
     val1 : group, val2:depart_id

     },
     success:function(result){

     if(result.trim().length>0)
     {
     $('#dis').css("display","none");
     $('#vald').html(result);
     i=1;
     }
     else
     {

     $('#dis').css("display","block");
     }
     }

     });
     }
     g_array='';
     $('.group').each(function(){
     if($(this).val()!='')
     g_array=g_array+$(this).val()+',';
     });

     if(i==0 && message.trim().length==0)
     {
     for_loading('Loading... Data add Please Wait '); // loading notification
     $.ajax({
     url:BASE_URL+"group/insert_group",
     type:'POST',
     data:{
     depart_id : depart_id,
     group:g_array
     },
     success:function(result){
     $('#g_div').html(result);
     //$('.close_div').hide();
     $('#dis').css("display","none");
     for_response('Successfully Add...!'); // resutl notification

     }
     });

     $('#depart_id').val('');
     $('.group').val('');

     }

     });
     });*/
    $(".remove_comments").live('click', function () {
        $(this).closest("tr").remove();
    });


    $('.update_btn').live('click', function () {

        var i = 0;
        var u_id = $(this).parent().parent().find('.update_id').val();
        var u_depart = $(this).parent().parent().find('.update_depart_id').val();
        var u_group = $(this).parent().parent().find('.update_group').val();
        var u_status = $(this).parent().parent().find('.update_status').val();
        var message = $('.group_error').html();
        //alert(u_id+u_depart+u_group+u_status);
        if (u_group == '' || u_group == null || u_group.trim().length == 0)
        {
            $('.group_error').html('Required Field');
            i = 1;
        } else
        {

            $.ajax({
                url: BASE_URL + "group/group_validate_update",
                type: 'POST',
                data: {
                    id: u_id, dep_id: u_depart, group: u_group

                },
                success: function (result)
                {
                    if (result.trim().length > 0)
                    {
                        $('.group_error').html(result);
                        i = 1;
                    }

                }

            });
        }
        if (i == 0 && message.trim().length == 0)
        {
            for_loading('Loading... Data Update Please Wait '); // loading notification
            $.ajax({
                url: BASE_URL + "group/update_group",
                type: 'POST',
                data: {
                    update_id: u_id,
                    udepart_id: u_depart,
                    update_group: u_group,
                    update_status: u_status

                },
                success: function (result) {

                    $('#g_div').html(result);
                    for_response('Successfully Update...!'); // resutl notification
                }

            });
            $('.modal').css("display", "none");
            $('.fade').css("display", "none");
        }
    });

    // checking group duplicate while updating
    $('.update_group').live('blur', function () {

        var i = 0;
        u_id = $(this).offsetParent().find('.update_id').val();
        u_depart = $(this).offsetParent().find('.update_depart_id').val();
        u_group = $(this).val();
        if (u_group == '' || u_group == null || u_group.trim().length == 0)
        {
            $('.group_error').html('Required Field');
            i = 1;
        } else
        {
            $('.group_error').html('');
        }
        if (i == 0)
        {
            $.ajax({
                url: BASE_URL + "group/group_validate_update",
                type: 'POST',
                data: {
                    id: u_id, dep_id: u_depart, group: u_group

                },
                success: function (result)
                {
                    $('.group_error').html(result);

                }

            });

        }
    });
    $('.update_depart_id').live('change', function ()
    {
        //$(".update_group").val('');
        //$(this).parent().parent().find(".update_group").val('');
        $(this).offsetParent().find('.update_group').val('');
    });



    // cancel update
    $('#no_update').live('click', function () {

        var $a = $(this).parent().parent().find('.did').val();
        $(this).parent().parent().find('.update_depart_id').val($a);
        var $b = $(this).parent().parent().find('.ugroup').val();
        $(this).parent().parent().find('.update_group').val($b);
        var $c = $(this).parent().parent().find('.ustatus').val();
        $(this).parent().parent().find('.update_status').val($c);

        $(".group_error").html('');
        $('.modal').css("display", "none");
        $('.fade').css("display", "none");

    });
    $('.del_class').live('click', function () {
        for_loading_del('Loading... Data Delete Please Wait '); // loading notification
        u_id = $(this).val();
        //alert(u_id);
        $.ajax({
            url: BASE_URL + "group/update_status_group",
            type: 'POST',
            data: {
                update_id: u_id

            },
            success: function (result) {
                $('#g_div').html(result);
                $('.modal-backdrop').hide();
                $('.close_div').hide();
                for_response_del('Successfully Removed...!'); // resutl notification
            }
        });
    });
    $("#cool").live("click", function ()
    {
        //for_loading_del('Loading... Data Delete Please Wait '); // loading notification

        var hidin = $(this).parent().parent().find('.hidin').val();


        $.ajax({
            url: BASE_URL + "group/delete_group_inactive",
            type: 'POST',
            data: {value1: hidin},
            success: function (result) {

                $("#list_all").html(result);
                $i = 0;
                if (i == 1)
                {
                    for_response_del('Successfully Removed...!'); // resutl notification
                } else
                {
                    for_response_del('Loading Please wait...!'); // resutl notification
                }
            }

        });
        $('.modal').css("display", "none");
        $('.fade').css("display", "none");

    });

</script>
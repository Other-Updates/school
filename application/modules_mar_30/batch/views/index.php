<style type="text/css">
    .convert_internal{position: relative;left: 16px;}
</style>
<script type="text/javascript">
//$(document).ready(function(){
// $("#fdate").focus();
// });

    $('.mandatory1').live('blur', function ()
    {
        if ($(this).val() == '' || $(this).val() == null)
        {
            $(this).css('border', '1px solid red');
        } else
        {
            $(this).css('border', '1px solid #CCCCCC');
        }
    });
</script>
<div id="batch">

    <table width="100%" border="0" class="form_table">
        <tr>
            <td width="10%">Academic Year:</td>
            <td width="20%">
                <select name="from" id="fdate" class="mandatory" required  title="Select Year">
                    <option value="" selected="selected">Year</option>
                    <?php
                    $year_list = array();
                    foreach ($list as $key => $val) {
                        $year_list[] = $val['from'];
                    }
                    for ($i = 2002; $i < date('Y') + 30; $i++) :
                        if (!in_array($i, $year_list)) {
                            ?>
                            <option value="<?php echo $i . ' - ' . ($i + 1); ?>"><?php echo $i . ' - ' . ($i + 1); ?></option>
                            <?php
                        }
                    endfor;
                    ?>
                </select>
            </td>
            <td>&nbsp;</td>

            <td><input type="button" value="Add" id="add_date" class="btn btn-primary"  />
                &nbsp;&nbsp;
                <button id="cancel" class="btn btn-danger" > Cancel</button>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td width="20%">
                <span id="val" style="color:#F00; font-weight:bold"> </span>
            </td>
        </tr>

    </table>
</div>
<br>
<div id="view_all" class="nav-tabs-custom">

    <div class="tab-content"></div>

    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Academic Year</th>
                <th>Created Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <?php
        $i = 1;
        if (isset($list) && !empty($list)) {
            foreach ($list as $view) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $view['from']; ?></td>
                    <td><?php echo date("d-M-Y", strtotime($view['ldt'])); ?></td>
                    <td><?= ($view['status'] == 1) ? 'Active' : 'In-Active'; ?></td>
                    <td>
                        <?php if ($view['status'] != 1) { ?>
                            <a href="#test1_<?php echo $view['id']; ?>" data-toggle="modal" name="group" class="btn btn-success btn-sm" title="Active" ><i class="fa fa-refresh"></i> Set Default</a>
                        <?php }
                        ?>
                    </td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>

    </table>

</div>

</div>





<?php
if (isset($list) && !empty($list)) {
    foreach ($list as $view) {
        ?>
        <div id="test1_<?php echo $view['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content" >
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Default Academic Year</h3>
                    </div>
                    <div class="modal-body" style="text-align:center;">
                        Do You Want to Set Default? &nbsp; <strong><?php echo $view["from"]; ?></strong>
                        <input type="hidden" value="<?php echo $view['id']; ?>" class="hid" />
                    </div>
                    <div class="modal-footer">
                      <!--<input type="button" class="btn btn-primary update_btn delete update_batch"  name="update" value="Update" />-->
                        <button class="btn btn-primary update_btn delete update_batch"  name="update" status="<?php echo $view['id']; ?>"  id="update_year"><i class="fa fa-check"></i> Yes</button>
                        <button type="button" class="no btn btn-danger" data-dismiss="modal" id="no"><i class="fa fa-times"></i> No</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}
?>


<script type="text/javascript">
    $(document).ready(function () {

        $("#add_date").click(function ()
        {
            var i = 0;
            $(".mandatory").each(function ()
            {
                if ($(this).val() == '')
                {
                    i = 1;
                    $(this).css('border', '1px solid red');
                } else
                {
                    $(this).css('border', '1px solid #CCCCCC');
                }
            });

            fdate = $("#fdate").val();

            if (fdate != '')
            {
                for_loading('Loading... Please Be Patient'); // loading notification
                $.ajax(
                        {
                            url: BASE_URL + "batch/insert_batch",
                            type: 'POST',
                            data: {value1: fdate},
                            success: function (result) {
                                if (result == 1) {
                                    window.location.reload();
                                }
                            }
                        });
                $("#fdate").val('');

            }

        });
    });

    $(".update_batch").live("click", function ()
    {
        var id = $(this).attr('status');
        $.ajax({
            url: BASE_URL + "batch/update_batch",
            type: 'POST',
            data: {value1: id},
            success: function (result) {
                if (result == 1) {
                    window.location.reload();
                }
            }

        });
        $("#fdate").val('');
        $('.modal').css("display", "none");
        $('.fade').css("display", "none");

    });
    $("#no").live("click", function () {

        $(".error_msg").html('');
        $(".error_msg1").html('');
        $('.modal').css("display", "none");
        $('.fade').css("display", "none");
    });



    $("#cancel").click(function ()
    {
        $('#fdate').val('');
        $('#tdate').val('');
        $('#val').html('');
        $('.mandatory').css('border', '1px solid #CCCCCC');
    });
    $("#delete_all").click(function ()

    {
        $('.mandatory').val('');
        $('#val').html('');
        $('.mandatory').css('border', '1px solid #CCCCCC');
        $('#val').css('');
    });


    $("#add_date").click(function () {

        var batch_id = $('#fdate').val();
        var group = $("#tdate").val();
        var i = 0;
        if (batch_id == "")
        {
            $("#val").html("Select Year");
            i = 1;
        }
    });



</script>






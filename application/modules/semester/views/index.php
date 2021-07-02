<div class="box-body table-responsive">
<!--    <table width="100%" border="0" class="form_table">
        <tr>
            <td width="110"><b>Add Term</b></td>
            <td><input type="text" name="semester"  value="" class="mandatory mandatory6" placeholder="Enter Term"  id="name" maxlength="50"/> </td>
        <tr>
        <tr><td></td><td colspan="2"><span id="errormessage" style="color:#F00;"></span> </td></tr>
        <td></td>
        <td><input type="button" value="Add" name="adding" id="submit" onclick="return validate()" class="btn btn-primary"/>&nbsp;&nbsp;
            <input type="button" value="Cancel" id="cancel" class="btn btn-danger"/></td>
        </tr>
    </table>
    <br />-->
    <div class="nav-tabs-custom" id="list_all">
        <div class="tab-content"><div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Term</th>
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

                                $i++
                                ?>
                                <tr><td><?php echo "$i"; ?></td>
                                    <td><?php echo $billto["semester"]; ?></td>
                                    <td><?= ($billto['status'] == 1) ? 'Active' : 'In-Active'; ?></td>
                                    <td><?php echo ($billto['ldt'] == 0) ? '--' : date("d-M-Y", strtotime($billto["ldt"])); ?></td>

                                    </td>
                                    <td>

                                        <?php if ($billto['status'] != 1) { ?>
                                            <a href="#test1_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn btn-success btn-sm" title="Active" ><i class="fa fa-refresh"></i> Set Default</a>
                                        <?php }
                                        ?>

                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div><!-- /.tab-pane -->

        </div><!-- /.tab-pane -->
    </div><!-- /.tab-content -->
</div>


<?php
if (isset($details) && !empty($details)) {
    foreach ($details as $billto) {
        ?>

        <div id="test1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1"
             role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"> <a class="close" data-dismiss="modal">×</a>

                        <h3 id="myModalLabel">Default Term</h3>
                    </div>
                    <div class="modal-body">
                        Do You Want to Set Default? &nbsp; <strong><?php echo $billto["semester"]; ?></strong>
                        <input type="hidden" value="<?php echo $billto['id']; ?>" class="hid" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" status="<?php echo $billto['id']; ?>" id="update"><i class="fa fa-check"></i> Yes</button>
                        <button type="reset" class="btn btn-danger"  id="no" data-dismiss="modal"><i class="fa fa-times"></i> No</button>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>




<script type="text/javascript">

    $("#update").live("click", function ()
    {
        var id = $(this).attr('status');
        $.ajax({
            url: BASE_URL + "semester/update_semester",
            type: 'POST',
            data: {value1: id},
            success: function (result) {
                if (result == 1) {
                    window.location.reload();
                }
            }

        });
        $('.modal').css("display", "none");
        $('.fade').css("display", "none");
    });


    $("#no").live("click", function ()
    {

        $(".error_msg").html('');
        $(".error_msg1").html('');
        $('.modal').css("display", "none");
        $('.fade').css("display", "none");

    });


    $("#cancel").click(function ()
    {
        $("#errormessage").html('');

        $('.mandatory').val('');
        $('#name').css('border', '1px solid #CCCCCC');
        $('#man1').html('');

    });



</script>



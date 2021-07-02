<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>

<link href="<?= $theme_path; ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/jquery.datetimepicker.css" />
<script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.datetimepicker.js"></script>

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
<br />
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Roll No</th>
            <th>Name</th>

            <th>Subject name</th>

            <th>Total Marks</th>
            <th>Submitted Date</th>
            <th>Mark</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //echo "<pre>"; print_r($sub_ass); exit;

        if (isset($sub_ass) && !empty($sub_ass)) {
            $i = 0;
            foreach ($sub_ass as $row) {

                if (isset($row['student'][0]) && !empty($row['student'][0])) {
                    $i++;
                    ?>



                    <tr>
                        <td><?= $i ?></td>
                        <td><?php echo $row['student'][0]['std_id']; ?></td>

                        <td><?php echo $row['student'][0]['name'] . " " . $row['student'][0]['last_name'] ?></td>


                        <td><?php echo $row['subject'][0]['nick_name']; ?></td>

                        <td><?php
            if (isset($row['ass_details'][0])) {


                echo $row['ass_details'][0]['total'];
            } else {

            }
                    ?></td>

                        <td><input style="width:100px;" type="text" class="date submitted_date" value="<?php if ($row['ass_file'][0]['sub_date'] == '0000-00-00' || $row['ass_file'][0]['sub_date'] == '1970-01-01') {
                    echo date('d-m-Y');
                } else {
                    echo date("d-m-Y", strtotime($row['ass_file'][0]['sub_date']));
                } ?>" /></td>
                        <td>
                            <input type="hidden" class="assign_id" value="<?php echo $row['ass_details'][0]['id']; ?>" /> <input type="hidden" class="student_id" value="<?php echo $row['student_id']; ?>" /><input style="width:50px;" type="text" name="mark_ass[]" class="mark_ass int_val" value="<?php echo $row['ass_file'][0]['score']; ?>" maxlength="<?php echo strlen($row['ass_details'][0]['total']); ?>" /><input type="hidden" value="<?php echo $row['ass_details'][0]['total']; ?>" class="total_mark" />
                        </td>

                    </tr>




                    <?php
                }
            }
            ?>
        </tbody>
        <tfoot><tr><td></td><td></td><td></td><td></td><td></td><td><a href="#close_assignment" data-toggle="modal" name="group" class="btn bg-maroon btn-sm">Close</a>&nbsp;<a target="_blank" href="<?= $this->config->item('base_url') . 'assignment/print_assignment_marks_nonupload/' . $row['batch_id'] . '/' . $row['depart_id'] . '/' . $row['group_id'] . '/' . $row['semester'][0]['id'] . '/' . $row['subject'][0]['id'] . '/' . $row['ass_details'][0]['ass_number']; ?>" data-toggle="modal" name="group" class="btn bg-blue btn-sm">View</a></td><td><input type="button" class="btn btn-success" id="insert_mark" value="Update"  /></td></tr></tfoot>
    </table>



    <?php
}
?>
</table>
<script type="text/javascript">
    $(".mark_ass").live('blur', function ()
    {
        //alert($(this).val());
        var score = $(this).val();
        var total = $(this).offsetParent().find('.total_mark').val();



        if (score == null || score == '')
        {
            $(this).css('border', '1px solid red');
            $('#insert_mark').prop('disabled', true);
        } else if (parseFloat(score) > parseInt(total))
        {

            $(this).css('border', '1px solid red');
            $('#insert_mark').prop('disabled', true);
        } else
        {
            $(this).css('border', '1px solid #CCCCCC');
            $('#insert_mark').prop('disabled', false);
        }
    });
</script>

<script type="text/javascript">// <![CDATA[
    $('.date').datetimepicker({
        lang: 'de',
        i18n: {de: {
                months: [
                    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
                ],
                dayOfWeek: ["Su.", "Mo", "Tu", "We", "Th", "Fr", "Sa."]
            }},
        timepicker: false,
        format: 'd-m-Y'
    });

</script>
<div id="close_assignment" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3 id="myModalLabel">Close Project</h3>
            </div>
            <div class="modal-body" >
                Are you sure, want to Close the assignment?

            </div>
            <div class="modal-footer">
                <input type="button" value="Yes" id="close_mark" class="btn btn-primary delete"  />
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    @media print
    {
        select {border: 1px solid #fff !important; box-shadow: inset 0 0px 0px rgba(0,0,0,0.075) !important; border-color:#fff; }
    }
    .modal-title {
        font-size: 20px;
        color: #333;
    }
    .modal-title {
        margin: 0;
        line-height: 1.42857143;
    }
    .bg-info {
        background-color: #26A69A;
    }
    .modal-header {
        min-height: 16.43px;
        padding: 15px;
        border-bottom: 1px solid #e5e5e5;
    }
    .modal {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1050;
        display: none;
        overflow: hidden;
        -webkit-overflow-scrolling: touch;
        outline: 0;
    }
    .modal-footer {
        margin-top: 60px;
    }
</style>
<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
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
<?php
$user_det = $this->session->userdata('logged_in');

$permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
if ($permission[0]['add_student'] == 1) {
    ?>
    <p class="print_admin_use">
        <a href="<?php echo $this->config->item('base_url') . 'student/add_student' ?>" class='btn btn-primary'>Add Student</a>
        <button type="button" class="btn btn-success add_bluk_import"><i class="fa fa-upload position-left"></i> Import Student</button>
        <br /><br />
    </p>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h6 class="modal-title">Import Student</h6>
                </div>
                <form action="<?php echo $this->config->item('base_url') . 'student/import_student'; ?>" enctype="multipart/form-data" name="" method="post" id="student_data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label><strong>Attachment:</strong></label>
                                        <input type="file" name="student_data" id="brand_data" class="form-control">
                                        <span class="error_msg"></span>
                                        <a href="<?php echo $this->config->item('base_url') . 'attachement/student/sample_student.csv'; ?>" download><i class="fa fa-download"></i>&nbsp; Sample Student</a>
                                    </div>
                                </div>

                                <div class="col-md-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" id="import" class="btn btn-success">Submit</button>
                        <button type="button" name="cancel" id="cancel" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php } ?>

<?php //if($permission[0]['add_student']==1 || $user_det['staff_type']=='staff' || $user_det['staff_type']=='admin'){
?>

<table class="form_table" width="100%">
    <tr>
    <input type="hidden" id="select_batch" value="<?php echo $batch[0]['id'] ?>" />
<!--    <td>Batch</td>
    <td>
        <select id='select_batch' class='ajax_class' style="width:110px;">
            <option value="">Select</option>
    <?php
    if (isset($all_batch) && !empty($all_batch)) {

        foreach ($all_batch as $val1) {
            ?>
                                                                                                                                                                                                                                                <option value="<?= $val1['id'] ?>"><?php echo $val1['from'] . '-' . $val1['to'] ?></option>
            <?php
        }
    }
    ?>
        </select>
    </td>-->
    <td>Class</td>
    <td id='td_depart'>
        <select id='depart_id' name='student_group[depart_id]'  style="width:100px;">
            <option value="">Select</option>
            <?php
            if (isset($all_depart) && !empty($all_depart)) {

                foreach ($all_depart as $val) {
                    ?>
                    <option value="<?= $val['id'] ?>"><?= $val['nickname'] ?></option>
                    <?php
                }
            }
            ?>
        </select>
    </td>
    <td>Section</td>
    <td id='g_td'>
        <select id='group_id' name='student_group[group_id]' disabled="disabled" style="width:100px;">
            <option value="">Select</option>
        </select>
    </td>
    <td>Student Type</td>
    <td >
        <select id='s_type' name='s_type'  style="width:100px;" disabled="disabled">

            <option value="3">All</option>
            <option value="1">Management</option>
            <option value="2">Counselling</option>
        </select>
    </td>
    <td>Hostel/Day Scholar</td>
    <td >
        <select id='hostel' name='hostel' style="width:100px;" disabled="disabled">

            <option value="3">All</option>
            <option value="1">Hostel</option>
            <option value="0">Day Scholar</option>
            <option value="2">Transport</option>
        </select>
    </td>
</tr>
</table>
<br />
<script type="text/javascript">
    $('.add_bluk_import').click(function () {

        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#myModal').modal('show');
    });
    $('.ajax_class,#depart_id,#group_id').live('change', function () {
        $("#int_div").html('');

    });
    $('#depart_id').live('change', function () {
        $("#subject_id").val('');
        $("#group_id").val('');
    });
    $('.ajax_class').live('change', function () {
        $("#subject_id").val('');
        $("#depart_id").val('');
        $("#group_id").val('');
    });

    $('#upload').live('click', function () {
        $.ajax({
            url: BASE_URL + "internal/upload",
            type: 'post',
            data: {
                upload: $('#file_name').val()
            },
            success: function (result) {
            }
        });
    });
    $('#depart_id').live('change', function () {
        d_id = $(this).val();
        if (d_id == "" || d_id == null)
        {

            $('#group_id').prop('disabled', true);
        } else
        {
            $('#group_id').prop('disabled', false);
            $.ajax({
                url: BASE_URL + "student/get_all_group1",
                type: 'POST',
                data: {
                    depart_id: d_id

                },
                success: function (result) {
                    $('#g_td').html(result);
                    $('#group_id').focus();
                    /*$('.modal-backdrop').hide();
                     $('.close_div').hide();*/
                }
            });
        }
    });
    $('#select_batch').live('change', function () {

        b_id = $(this).val();
        if (b_id == "" || b_id == null)
        {
            $('#depart_id').prop('disabled', true);
            $('#group_id').prop('disabled', true);
            //window.location.reload();
        } else
        {
            $('#depart_id').prop('disabled', false);
            $.ajax({
                url: BASE_URL + "student/get_all_department1",
                type: 'POST',
                data: {
                    batch_id: b_id

                },
                success: function (result) {
                    $('#td_depart').html(result);

                    /*$('.modal-backdrop').hide();
                     $('.close_div').hide();*/
                }
            });
        }
    });
    /*$('#select_batch').live('change',function(){
     b_id=$(this);
     $.ajax({
     url:BASE_URL+"subject/get_all_sem",
     type:'POST',
     data:{
     batch_id : b_id.val()

     },
     success:function(result){
     $('#td_sem').html(result);

     }
     });
     });*/
    $('#group_id').live('change', function () {
        group_id = $(this).val();
        if (group_id == "" || group_id == null || group_id == 0)
        {
            $('#s_type').prop('disabled', true);
            $('#hostel').prop('disabled', true);
        } else
        {
            $('#s_type').prop('disabled', false);
            $('#hostel').prop('disabled', false);
            $('#s_type').val('');
            $('#hostel').val('');
            $.ajax({
                url: BASE_URL + "student/get_all_student_for_staff",
                type: 'post',
                data: {
                    select_batch: $('#select_batch').val(),
                    depart_id: $('#depart_id').val(),
                    group_id: group_id

                },
                success: function (result) {
                    $('#student_div').html(result);
                    $('.std_class').html('');
                }
            });
        }
    });
    // student type
    $('#s_type').live('change', function () {
        s_type = $(this).val();
        hostel = $('#hostel').val('');
        if (s_type == 3)
        {

            $.ajax({
                url: BASE_URL + "student/get_all_student_for_staff",
                type: 'post',
                data: {
                    select_batch: $('#select_batch').val(),
                    depart_id: $('#depart_id').val(),
                    group_id: $('#group_id').val()

                },
                success: function (result) {
                    $('#student_div').html(result);
                    $('.std_class').html('');
                }
            });
        } else
        {

            $.ajax({
                url: BASE_URL + "student/get_all_student_type",
                type: 'post',
                data: {
                    select_batch: $('#select_batch').val(),
                    depart_id: $('#depart_id').val(),
                    group_id: $('#group_id').val(),
                    s_type: s_type
                },
                success: function (result) {
                    $('#student_div').html(result);

                }
            });
        }
    });
    // hostel/day scholar
    $('#hostel').live('change', function () {
        hostel = $(this).val();
        s_type = $('#s_type').val();
        if (hostel == 3)
        {
            $.ajax({
                url: BASE_URL + "student/get_all_student_type",
                type: 'post',
                data: {
                    select_batch: $('#select_batch').val(),
                    depart_id: $('#depart_id').val(),
                    group_id: $('#group_id').val(),
                    s_type: s_type
                },
                success: function (result) {
                    $('#student_div').html(result);
                    $('.std_class').html('');
                }
            });
        } else if (s_type != 3 && hostel != 3)
        {
            $.ajax({
                url: BASE_URL + "student/get_all_student_type_hostel",
                type: 'post',
                data: {
                    select_batch: $('#select_batch').val(),
                    depart_id: $('#depart_id').val(),
                    group_id: $('#group_id').val(),
                    s_type: s_type,
                    hostel: hostel
                },
                success: function (result) {
                    $('#student_div').html(result);

                }
            });
        } else if (s_type == 3 && hostel != 3)
        {
            $.ajax({
                url: BASE_URL + "student/get_all_student_hostel",
                type: 'post',
                data: {
                    select_batch: $('#select_batch').val(),
                    depart_id: $('#depart_id').val(),
                    group_id: $('#group_id').val(),
                    hostel: hostel
                },
                success: function (result) {
                    $('#student_div').html(result);

                }
            });
        }
    });
</script>
<div id='student_div'>

</div>

<?php if ($permission[0]['add_student'] == 1) { ?>
    <div class='std_class'>
        <table id="example1"   class="table table-bordered table-striped dataTable">
            <thead>
                <tr>
                    <th>S.No&nbsp;</th>
                    <th>Image</th>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Academic Year</th>
                    <th>Class</th>
                    <th>Parent's Email Id</th>
                    <th>Contact No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($all_student) && !empty($all_student)) {
                    $i = 0;
                    foreach ($all_student as $val) {
                        $i++;
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><a href="#profile_img_<?= $val['id'] ?>" data-toggle="modal">
                                    <?php
                                    if (!empty($val['image'])) {
                                        $file = FCPATH . 'profile_image/student/thumb/' . $val['image'];
                                        $exists = file_exists($file);
                                    }
                                    $cust_image = (!empty($exists) && isset($exists)) ? $val['image'] : "avatar5.png";
                                    ?>
                                    <img class="staff_thumbnail" src="<?= $this->config->item('base_url') . 'profile_image/student/thumb/' . $cust_image ?>" />
                                </a></td>
                            <td><?= $val['std_id'] ?></td>
                            <td><?= $val['name'] . "&nbsp;" . $val['last_name'] ?></td>
                            <td><?= $val['from'] ?></td>
                            <td><?php print_r($val['nickname'] . '-' . $val['std_group'][0]['group']); ?></td>
                            <td><?= $val['email_id'] ?></td>
                            <td><?= $val['contact_no'] ?></td>

                            <td>
                                <a href="<?= $this->config->item('base_url') . 'student/view_student/' . $val['id'] ?>" title="View" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="<?= $this->config->item('base_url') . 'student/update_student/' . $val['id'] ?>" title="Edit" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                                <!--<a href="<?= $this->config->item('base_url') . 'student/delete_student/' . $val['id'] ?>">Delete</a>-->
                                <a href="#delete_<?= $val['id'] ?>" title="Delete" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
        if (isset($all_student) && !empty($all_student)) {
            foreach ($all_student as $val) {
                ?>
                <div id="delete_<?= $val['id'] ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position:relative;top:-11px;"><i class="icon-remove"></i></button>
                                <h3 id="myModalLabel">Delete Student</h3>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete ?
                            </div>
                            <div class="modal-footer">

                                <a href="<?= $this->config->item('base_url') . 'student/delete_student/' . $val['id'] ?>" type='button' class="btn btn-primary del_class">Yes</a>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    <?php } ?>
</div>
<?php
if (isset($all_student) && !empty($all_student)) {
    foreach ($all_student as $val) {
        ?>
        <div id="profile_img_<?= $val['id'] ?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <a class="close1" data-dismiss="modal">×</a>
                        <img src="<?= $this->config->item('base_url') . 'profile_image/student/orginal/' . $val['image'] ?>" width="50%" />
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
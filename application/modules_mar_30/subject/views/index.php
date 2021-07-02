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
<script type="text/javascript">
//$(document).ready(function(){ $("#batch").focus(); });
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
    function removeSpaces(string) {
        return string.split(' ').join('');
    }
//    $("#batch").live('change', function ()
//    {
//        b_id = $(this).val();
//        if (b_id == "" || b_id == null)
//        {
//            $('#semester').prop('disabled', true);
//        } else
//        {
//
//            $('#semester').prop('disabled', false);
//            $('#department').prop('disabled', true);
//            $('#group1').prop('disabled', true);
//            $("#com_error").html('');
//            //$('#semester').focus();
//            $('#semester').val('');
//            $('#department').val('');
//            $('#group1').val('');
//            $('.master').html('');
//            $('all').hide();
//        }
//    });
//    $("#semester").live('change', function ()
//    {
//        b_id = $(this).val();
//        if (b_id == "" || b_id == null)
//        {
//            $('#department').prop('disabled', true);
//        } else
//        {
//
//            $('#department').prop('disabled', false);
//            $('#group1').prop('disabled', true);
//            $("#com_error").html('');
//            //$('#department').focus();
//            $('#department').val('');
//            $('#group1').val('');
//            $('.master').html('');
//            $('all').hide();
//        }
//    });
</script>


<?php
$this->load->model('master/master_model');
$user_det = $this->session->userdata('logged_in');
$permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
$staff = $this->session->userdata('logged_in');
?>
<?php
if (isset($master) && !empty($master)) {
    foreach ($master as $row) {

    }
}
?>

<?php if ($staff['staff_type'] == 'staff') { ?>
    <input type="hidden" value="<?= $user_det['department_id'] ?>" class="hide_depart"/>
<?php } ?>

<div id="subject">

    <table width="100%" border="0" class="form_table">
        <tr>
        <input type="hidden" id="batch" value="<?php echo $batch[0]['id'] ?>" />
        <input type="hidden" id="semester" value="<?php echo $term[0]['id'] ?>" />
      <!--            <td width="10%">Batch</td>
                  <td width="23%">
                      <select id='batch' name='batch'  class="mandatory validate">
                          <option value="" selected="selected">Select</option>
        <?php
        if (isset($all_batch) && !empty($all_batch)) {

            foreach ($all_batch as $view) {
                ?>
                                                                                                                                                                                                                                <option value="<?= $view['id'] ?>"><?php echo $view['from'] . '-' . $view['to'] ?></option>
                <?php
            }
        }
        ?>
                      </select>

                  </td>-->
<!--        <td width="10%">Term </td>
       <td>
           <select id='semester' name='semester'  class="mandatory validate" disabled="disabled">
               <option value="" selected="selected">Select</option>
        <?php
        if (isset($all_semester) && !empty($all_semester)) {

            foreach ($all_semester as $view) {
                ?>
                                                                                                                                                                                                                                <option value="<?= $view['id'] ?>"><?php echo $view['semester'] ?></option>
                <?php
            }
        }
        ?>
           </select>
       </td>-->
        </tr>

        <tr>
            <td width="10%">Class </td>

            <td width="25%">
                <?php if (isset($row['subject']) && !empty($row['subject'])) { ?>
                    <?php if ($staff['staff_type'] == 'staff' && $row['subject'] == 1) { ?>
                        <select id='department' name='student_group[group_id]'  class="u_department mandatory validate staff_button depar_value" >
                            <option value="">Select</option>
                            <?php
                            if (isset($all_department) && !empty($all_department)) {
                                foreach ($all_department as $val) {
                                    ?>
                                    <option value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                    <?php if ($staff['staff_type'] == 'staff' && $row['subject'] == 0) { ?>
                        <select id='department' name='student_group[group_id]'  class="u_department mandatory validate">
                            <option value="">Select</option>
                            <?php
                            if (isset($sub_department) && !empty($sub_department)) {
                                foreach ($sub_department as $val) { {
                                        ?>
                                        <option value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </select>

                    <?php if ($staff['staff_type'] == 'admin' && $row['subject'] == 1) { ?>
                        <select id='department' name='student_group[group_id]'  class="u_department mandatory validate">
                            <option value="">Select</option>
                            <?php
                            if (isset($all_department) && !empty($all_department)) {
                                foreach ($all_department as $val) {
                                    ?>
                                    <option value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                    <?php if ($staff['staff_type'] == 'admin' && $row['subject'] == 0) { ?>
                        <select id='department' name='student_group[group_id]'  class="u_department mandatory validate">
                            <option value="">Select</option>
                            <?php
                            if (isset($all_department) && !empty($all_department)) {
                                foreach ($all_department as $val) {
                                    ?>
                                    <option value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                <?php } else { ?>
                    <select id='department' name='student_group[group_id]'  class="u_department mandatory validate">
                        <option value="">Select</option>
                        <?php
                        if (isset($all_department) && !empty($all_department)) {
                            foreach ($all_department as $val) {
                                ?>
                                <option value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                <?php } ?>
                <span id="com_error" style="color:#00F" ></span>

            </td>
            <td>Section </td>
            <td id='g_td'>
                <select id='group1' name='student_group'  class="grp mandatory validate" disabled="disabled">
                    <option value="">Select</option>
                </select>
            </td>

            <td></td><td></td><td></td>
            <td>
                <?php if (isset($row['subject']) && !empty($row['subject'])) { ?>
                    <?php if ($staff['staff_type'] == 'admin' && $row['subject'] == 1 || $staff['staff_type'] == 'staff' && $row['subject'] == 1) { ?>
                        <button id="but" class="btn btn-primary " disabled="disabled">Add subject</button>
                        <button type="button" class="btn btn-warning add_bluk_import"><i class="icon-plus-circle2 position-left"></i> Import Subject</button><?php
                    }
                }
                ?>
                <input type="button" value="View-Sub" class="btn btn-success src" id="srch" />

            </td>
        </tr>

    </table>
    </br>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h6 class="modal-title">Import Subject</h6>
                </div>
                <form action="<?php echo $this->config->item('base_url') . 'subject/import_subject'; ?>" enctype="multipart/form-data" name="" method="post" id="student_data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label><strong>Attachment:</strong></label>
                                        <input type="file" name="subject_data" id="brand_data" class="form-control">
                                        <span class="error_msg"></span>
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
    <table  class="show-me form_table" id="cls" width="100%" border="0" style="display:none">

        <tr>
            <td width="10%">Subject:</td>
            <td width="23%">
                <input type="text" id="sub" class="subject mandatory validate" />
            </td>
            <td width="10%">Nick Name:</td>
            <td width="23%">
                <input type="text" id="nicky" class="nick_sub mandatory validate" />
            </td>
            <td width="10%">Subject Code</td>
            <td width="20%"><input type="text" id="scode" name="scode" class=" validate mandatory duplication" maxlength="10" /></td>
            <td> </td>
        </tr>
        <tr>
            <td width="10%">Staff Class </td>
            <td width="25%">
                <select  name='student_group'  class="u_department mandatory staff validate depar">
                    <option value="">Select</option>
                    <?php
                    if (isset($all_department) && !empty($all_department)) {
                        foreach ($all_department as $val) {
                            ?>
                            <option value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
            <td>Staff</td>
            <td id='s_view'>
                <select id='staff' name='student_staff'  class="u_group mandatory validate dupe">
                    <option value="">Select</option>
                </select>
            </td>
            <td><span style="color:#F00" id="dupli" class="len"> </span></td>
        </tr>
        <tr>
            <td>Total Mark</td>
            <td><input type="text" id="grade_point" class="int_val validate mandatory" /></td>
            <td>Pass Mark</td>
            <td><input type="text" id="pass_mark" class="validate mandatory" /></td>
            <td colspan="2"><input type="checkbox" id="check_practical"  value="0" class="" />
                If You Want Practical Mark?</td>
        </tr>
        <tr class="practical" style="display:none">
            <td>Practical Mark</td>
            <td><input type="text" id="practical_mark" class=""  /></td>
            <td>Practical Pass Mark</td>
            <td><input type="text" id="practical_pass_mark" class=""  /></td>
        </tr>
        <tr>
            <td></td><td></td><td><span style="color:#F00" id="valu"> </span></td>
            <td>
                <input type="button" value="Save" id="add_subject" class="btn btn-primary dis"  />
                <input type="reset" value="Cancel" id="cancel" class="btn btn-danger " />
            </td>
        </tr>
    </table>
    <div id="testing_subject">

        <?php if ($user_det['staff_type'] == 'staff') { ?>

            <table width="100%" class=" all vie_stf table table-bordered table-striped dataTable" id="example7" >
                <thead>
                    <tr><th width="10%">S.no </th><th>Subject Code</th><th>Subject</th><th>Nick Name</th><th>Term</th><th>Class</th><th>Section</th></tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    if (isset($sub_view) && !empty($sub_view)) {

                        foreach ($sub_view as $val) {
                            ?>

                            <tr><td><?= $i + 1; ?></td><td><?= $val['scode'] ?></td><td><?= $val['subject_name'] ?></td><td><?= $val['nick_name'] ?></td>

                                <td><?= $val['semester'] ?></td><td><?= $val['nickname'] ?></td><td><?= $val['group'] ?></tr>


                            <?php
                            $i++;
                        }
                    } else
                        echo "<tr><td colspan='10' aline='center'>No records available</td> </tr>"
                        ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>
<div>

</div>
<div>
    <table width="100%" class=" all vie_stf table table-bordered table-striped dataTable master" id="example7" style="display:none">
        <thead>
            <tr><th width="10%">S.no</th><th>Subject Code</th><th>Subject</th><th>Staff Name</th><th>Class</th><th>Section</th></tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            if (isset($sub_view) && !empty($sub_view)) {

                foreach ($sub_view as $val) {
                    ?>

                    <tr><td><?= $val['scode'] ?></td><td><?= $val['subject_name'] ?></td><td><?= $val['staff_name'] ?></td><td><?= $val['department'] ?></td>
                        <td><?= $val['group'] ?></td></tr>

                    <?php
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>
</div>


<!--  table veiw perpose-->
<?php
foreach ($master as $row)
    ;
?>
<?php if (isset($row['subject']) && !empty($row['subject'])) { ?>
    <?php if ($staff['staff_type'] == 'admin' && $row['subject'] == 1 || $staff['staff_type'] == 'staff' && $row['subject'] == 1) { ?>
        <br />
        <div id="view_all">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Subject Code</th>
                        <th>Subject</th>
                        <th>Nick Name</th>
                        <th>Total Mark</th>
                        <th>Pass Mark</th>
                        <th>Practical Mark</th>
                        <th>Practical Pass Mark</th>
                        <th>Staff Name</th>
                        <th>Academic Year</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Term</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    if (isset($all_view) && !empty($all_view)) {
                        foreach ($all_view as $view) {
                            ?>
                            <tr>
                                <td><?= $i + 1 ?></td>

                                <td><?= $view['scode'] ?></td>
                                <td><?= $view['subject_name'] ?></td>
                                <td><?= $view['nick_name'] ?></td>
                                <td><?= $view['grade_point'] ?></td>
                                <td><?= $view['pass_mark'] ?></td>
                                <td><?= ($view['practical_mark'] != '' && $view['practical_mark'] != 0) ? $view['practical_mark'] : '-'; ?></td>
                                <td><?= ($view['practical_pass_mark'] != '' && $view['practical_pass_mark'] != 0) ? $view['practical_pass_mark'] : '-'; ?></td>
                                <td><?= $view['staff_name'] ?></td>
                                <td><?= $view['from'] ?></td>
                                <td><?= $view['nickname'] ?></td>
                                <td><?= $view['group'] ?></td>
                                <td><?= $view['semester'] ?></td>
                                <td>
                                    <a href="#test_<?php echo $view["id"]; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm" title="View">
                                        <i class="fa fa-eye"></i></a>
                                    <a href="#update_<?php echo $view["id"]; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm" title="Edit">
                                        <i class="fa fa-edit"></i></a>
                                    <?php /* ?><a href="#delete_<?php echo $view["id"]; ?>" data-toggle="modal" name="group"
                                      class="btn btn-danger btn-sm" title="Delete">
                                      <i class="fa fa-times"></i></a><?php */ ?>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>

                </tbody>
            </table><?php
        }
    }
    ?>
</div>

<!--/*   pop up box view-->
<?php
$i = 0;
if (isset($all_view) && !empty($all_view)) {
    foreach ($all_view as $view) {
        ?>

        <div id="test_<?php echo $view['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
             align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">View Subject</h3>
                    </div>

                    <div class="modal-body"  >
                        <table class="staff_table_sub">

                            <tr>
                                <td>Subject</td><td class="text_bold1"><?php echo $view['subject_name']; ?>  </td>
                            </tr>
                            <tr>
                                <td>Nick Name</td><td class="text_bold1"><?php echo $view['nick_name']; ?>  </td>
                            </tr>
                            <tr>
                                <td>Subject Code</td><td class="text_bold1"><?php echo $view['scode']; ?>  </td>
                            </tr>
                            <tr>
                                <td>Total Mark</td><td class="text_bold1"><?php echo $view['grade_point']; ?>  </td>
                            </tr>
                            <tr>
                                <td>Pass Mark</td><td class="text_bold1"><?php echo $view['pass_mark']; ?>  </td>
                            </tr>
                            <?php if ($view['check_practical'] == 1) { ?>
                                <tr>
                                    <td>Practical Mark</td><td class="text_bold1"><?php echo $view['practical_mark']; ?>  </td>
                                </tr>
                                <tr>
                                    <td>Practical Pass Mark</td><td class="text_bold1"><?php echo $view['practical_pass_mark']; ?>  </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td>Staff</td><td class="text_bold1"> <?php echo $view['staff_name']; ?></td>
                            </tr>
                            <tr>
                                <td>Class</td><td class="text_bold1"> <?php echo $view['department']; ?> </td>
                            </tr>
                            <tr>
                                <td>Section</td><td class="text_bold1"> <?php echo $view['group']; ?></td>
                            </tr>
                            <tr>
                                <td>Term</td><td class="text_bold1"> <?php echo $view['semester']; ?></td>
                            </tr>
                            <tr>
                                <td>Academic Year</td><td class="text_bold1"> <?= $view['from'] ?> </td>
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
        $i++;
    }
}
?>


<!--delete option-->
<?php
$i = 0;
if (isset($all_view) && !empty($all_view)) {
    foreach ($all_view as $update) {
        ?>
        <div id="close">
            <div id="delete_<?php echo $update['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="false" align="center">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal">×</a>
                            <h3 id="myModalLabel">Delete Subject</h3>
                        </div>
                        <div class="modal-body" >
                            Are you sure want you want Remove subject <b><?php echo $update['subject_name']; ?> ?
                                <input type="hidden" value="<?php echo $update['id']; ?>" class="hid" /></b>
                        </div>
                        <div class="modal-footer">
                            <input type="button" value="Yes" id="yes" class="btn btn-primary delete_sub"  />
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $i++;
    }
}
?>

<!--update pop up-->
<?php
$i = 1;
if (isset($all_view) && !empty($all_view)) {
    foreach ($all_view as $update) {  //echo "<pre>"; print_r($update);
        ?>

        <div id="update_<?php echo $update['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
             align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Update Subject</h3>
                    </div>
                    <div class="modal-body">

                        <div class="box-body table-responsive">
                            <div id="subject">
                                <table width="100%" border="0" class="form_table">
                                    <input type="hidden" name="uid" class="u_id " value="<?php echo $update['id']; ?>" />

                                    <tr>
                                        <td>Academic Year </td>
                                        <td>
                                            <select id='batch' name='batch'  class="u_batch u_val mandatory" disabled="disabled">

                                                <?php
                                                if (isset($all_batch) && !empty($all_batch)) {

                                                    foreach ($all_batch as $view) {
                                                        ?>
                                                        <option <?= ( $view['id'] == $update['batch_id']) ? 'selected' : ''; ?>
                                                            value="<?= $view['id'] ?>" ><?php echo $view['from']; ?>

                                                        </option>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                            <input type="hidden" value="<?php echo $update['batch_id'] ?>"  id="batc" class="batc"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Term </td>
                                        <td>
                                            <select id='semester' name='semester'  class="u_semester u_val mandatory"  disabled="disabled" >
                                                <?php
                                                if (isset($all_semester) && !empty($all_semester)) {

                                                    foreach ($all_semester as $view) {
                                                        ?>
                                                        <option <?= ($view['semester'] == $update['semester']) ? 'selected' : ''; ?>
                                                            value="<?= $view['id'] ?>"><?php echo $view['semester'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                            </select>
                                            <input type="hidden" value="<?php echo $update['semester_id'] ?>" id="sem" class="sem" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Class</td>
                                        <td>
                                            <?php if ($staff['staff_type'] == 'staff') { ?>
                                                <select id='department_<?= $i ?>' name='student_group'  class="u_department u_grp u_val mandatory " >

                                                    <?php
                                                    if (isset($all_department) && !empty($all_department)) {
                                                        foreach ($all_department as $val) {
                                                            if ($val['id'] == $staff['department_id']) {
                                                                ?>
                                                                <option <?= ($val['id'] == $update['depart_id']) ? 'selected' : ''; ?>
                                                                    value="<?= $val['id'] ?>"><?= $val['department'] ?></option>

                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>

                                                </select>
                                            <?php } else { ?>
                                                <select id='department_<?= $i ?>' name='student_group'  class="u_department u_grp u_val mandatory" >

                                                    <?php
                                                    if (isset($all_department) && !empty($all_department)) {
                                                        foreach ($all_department as $val) {
                                                            ?>
                                                            <option <?= ($val['id'] == $update['depart_id']) ? 'selected' : ''; ?>
                                                                value="<?= $val['id'] ?>"><?= $val['department'] ?></option>

                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </select>
                                            <?php } ?>
                                            <input type="hidden" value="<?php echo $update['depart_id'] ?>" id="depid" class="depid" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Section </td>
                                        <td class='u_td<?= $i ?>'>
                                            <select id='group' name='group'  class="mandatory u_group u_val mandatory" >


                                                <?php
                                                if (isset($update['get_group']) && !empty($update['get_group'])) {
                                                    foreach ($update['get_group'] as $val) {
                                                        ?>
                                                        <option <?= ($val['id'] == $update['group_id']) ? 'selected' : ''; ?>
                                                            value="<?= $val['id'] ?>"> <?= $val['group'] ?> </option>

                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                            <input type="hidden" value="<?php echo $update['group_id'] ?>" id="section" class="section" />
                                        </td>

                                    </tr>

                                    <tr>
                                        <td width="25%">Subject:</td>
                                        <td> <input type="text" class="u_subject u_val mandatory"  value="<?php echo $update['subject_name']; ?>" />
                                            <input type="hidden" class="usubject" id="usubject" value="<?php echo $update['subject_name']; ?>" />
                                            <span class="subject_error errormessage" style="color:#F00;"></span></td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Nick Name</td>
                                        <td> <input type="text" class="u_nick u_val mandatory" id="u_nick"  value="<?php echo $update['nick_name']; ?>" />
                                            <input type="hidden" class="u_nick1" id="u_nick1" value="<?php echo $update['nick_name']; ?>" />
                                            <span class="nick_error errormessage" style="color:#F00;"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Subject Code </td>
                                        <td>
                                            <input type="text" class="u_scode u_val mandatory" maxlength="10" value="<?php echo $update['scode']; ?>" />
                                            <input type="hidden" class="uscode" id="uscode" value="<?php echo $update['scode']; ?>" />
                                            <span class="scode_error errormessage" style="color:#F00;"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Mark </td>
                                        <td>
                                            <input type="text" class="u_grade u_val mandatory"  value="<?php echo $update['grade_point']; ?>" />
                                            <input type="hidden" class="ugrade" id="ugrade" value="<?php echo $update['grade_point']; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pass Mark </td>
                                        <td>
                                            <input type="text" class="u_pass_mark u_val mandatory"  value="<?php echo $update['pass_mark']; ?>" />
                                            <input type="hidden" class="upass_mark" id="upass_mark" value="<?php echo $update['pass_mark']; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="checkbox" id="u_check_practical"  value="<?php echo $update['check_practical']; ?>" class="u_check_practical" <?php echo ($update['check_practical'] == 1) ? 'checked' : ''; ?>/> If You Want Practical Mark?</td>
                                    </tr>
                                    <?php //if ($update['check_practical'] == 1) { ?>
                                    <tr class="u_practical" style="display:<?php echo ($update['check_practical'] == 1) ? '-' : 'none'; ?>">
                                        <td>Practical Mark </td>
                                        <td>
                                            <input type="text" class="u_practical_mark"  value="<?php echo $update['practical_mark']; ?>" />
                                            <input type="hidden" class="upractical_mark" id="upractical_mark" value="<?php echo $update['practical_mark']; ?>" />
                                        </td>
                                    </tr>
                                    <tr class="u_practical" style="display:<?php echo ($update['check_practical'] == 1) ? '-' : 'none'; ?>">
                                        <td>Practical Pass Mark </td>
                                        <td>
                                            <input type="text" class="u_practical_pass_mark"  value="<?php echo $update['practical_pass_mark']; ?>" />
                                            <input type="hidden" class="upractical_pass_mark" id="upractical_pass_mark" value="<?php echo $update['practical_pass_mark']; ?>" />
                                        </td>
                                    </tr>
                                    <?php // } ?>
                                    <tr>
                                        <td width="10%">Staff Class </td>
                                        <td width="25%">
                                            <select  name='student_group' id="depart_<?= $i ?>" class="u_department_staff mandatory staff validate staff_depart">
                                                <?php
                                                if (isset($all_department) && !empty($all_department)) {
                                                    foreach ($all_department as $val) {
                                                        ?>
                                                        <option <?= ($val['id'] == $update['depart_id']) ? 'selected' : ''; ?> value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                            <input type="hidden" value="<?php echo $update['depart_id'] ?>" id="staff" class="staff" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Staff</td>
                                        <td id='update_s_view<?= $i ?>'>
                                            <select id='staff' name='student_staff'  class="u_staff mandatory validate">

                                                <?php
                                                $this->load->model('subject/subject_model');
                                                $all_stf = $this->subject_model->get_all_staff($update['depart_id']);
                                                ?>
                                                <?php
                                                if (isset($all_stf) && !empty($all_stf)) {

                                                    foreach ($all_stf as $view) {
                                                        ?>
                                                        <option <?= ($view['id'] == $update['staff_id']) ? 'selected' : ''; ?>
                                                            value="<?= $view['id'] ?>"><?php echo $view['staff_name'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                            <input type="hidden" value="<?php echo $update['staff_id'] ?>" id="staffid"  class="staffid" />  </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-primary delete" id="update" name="update" value="Update" />
                        <button type="button"  class="btn btn-danger " id="no" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $i++;
    }
}
?>
<input type="hidden" value="<?= $staff['staff_type']; ?>" id="us_type" />
<input type="hidden" value ="0" id=" chk_valu"  />
<script type="text/javascript">
    $('.add_bluk_import').click(function () {

        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#myModal').modal('show');
    });
    $('#check_practical').change(function () {
        if (this.checked) {
            $(this).val("1");
            $('.practical').show();
            $('#practical_mark').addClass("mandatory validate");
            $('#practical_pass_mark').addClass("mandatory validate");
        } else {
            $(this).val("0");
            $('.practical').hide();
            $('#practical_mark').removeClass("mandatory validate");
            $('#practical_pass_mark').removeClass("mandatory validate");
        }
    });

    $('#u_check_practical').live("change", function () {
        if (this.checked) {
            $(this).val("1");
            $('.u_practical').show();
            $('.u_practical_mark').addClass("u_val mandatory");
            $('.u_practical_mark').addClass("u_val mandatory");
        } else {
            $(this).val("0");
            $('.u_practical').hide();
            $('.u_practical_mark').removeClass("u_val mandatory");
            $('.u_practical_mark').removeClass("u_val mandatory");
        }
    });

    $(document).ready(function () {


        var s_ty = $("#us_type").val()
        if (s_ty == 'admin')
        {
            $('.btn-primary').prop('disabled', false);
        }

        $("#but").live('click', function () {
            $("#cls").toggle();
        });
        $("#add_subject").click(function ()
        {
            var scode = $("#scode").val();
            var batch = $("#batch").val();
            var department = $("#department").val();
            var group = $("#group1").val();
            var semester = $("#semester").val();
            var staff = $("#staff").val();
            var subject = $("#sub").val();
            var nick = $("#nicky").val();
            var grade = $("#grade_point").val();
            var staff_dep = $(".depar").val();
            var mark = $("#grade_point").val();
            var pass_mark = $("#pass_mark").val();
            var check_practical = $("#check_practical").val();
            var i = 0;
            if (check_practical == 1)
            {
                var practical_mark = $("#practical_mark").val();
                var practical_pass_mark = $("#practical_pass_mark").val();
                if (practical_mark == '') {
                    i = 1;
                    $('#practical_mark').css('border', '1px solid red');
                } else {
                    $('#practical_mark').css('border', '1px solid #CCCCCC');
                }
                if (practical_pass_mark == '') {
                    i = 1;
                    $('#practical_pass_mark').css('border', '1px solid red');
                } else {
                    $('#practical_pass_mark').css('border', '1px solid #CCCCCC');
                }
            }
            if (batch == '') {
                i = 1;
                $('#batch').css('border', '1px solid red');
            } else {
                $('#batch').css('border', '1px solid #CCCCCC');
            }
            if (department == '') {
                i = 1;
                $('#department').css('border', '1px solid red');
            } else {
                $('#department').css('border', '1px solid #CCCCCC');
            }
            if (semester == '') {
                i = 1;
                $('#semester').css('border', '1px solid red');
            } else {
                $('#semester').css('border', '1px solid #CCCCCC');
            }
            if (group == '') {
                i = 1;
                $('#group1').css('border', '1px solid red');
            } else {
                $('#group1').css('border', '1px solid #CCCCCC');
            }
            if (staff == '') {
                i = 1;
                $('#staff').css('border', '1px solid red');
            } else {
                $('#staff').css('border', '1px solid #CCCCCC');
            }
            if (subject == '' || subject.trim().length == 0) {
                i = 1;
                $('#sub').css('border', '1px solid red');
            } else {
                $('#sub').css('border', '1px solid #CCCCCC');
            }
            if (scode == '' || scode.trim().length == 0) {
                i = 1;
                $('#scode').css('border', '1px solid red');
            } else {
                $('#scode').css('border', '1px solid #CCCCCC');
            }
            if (nick == '' || nick.trim().length == 0) {
                i = 1;
                $('#nicky').css('border', '1px solid red');
            } else {
                $('#nicky').css('border', '1px solid #CCCCCC');
            }
            //if(grade=='' || grade.trim().length==0 ){i=1; $('#grade_point').css('border','1px solid red');}else{$('#grade_point').css('border','1px solid #CCCCCC');}
            if (staff_dep == '' || staff_dep == null || staff_dep == 0) {
                i = 1;
                $('.depar').css('border', '1px solid red');
            } else {
                $('.depar').css('border', '1px solid #CCCCCC');
            }
            if (mark == '' || mark.trim().length == 0) {
                i = 1;
                $('#grade_point').css('border', '1px solid red');
            } else {
                $('#grade_point').css('border', '1px solid #CCCCCC');
            }
            if (pass_mark == '' || pass_mark.trim().length == 0) {
                i = 1;
                $('#pass_mark').css('border', '1px solid red');
            } else {
                $('#pass_mark').css('border', '1px solid #CCCCCC');
            }
            if (i == 0)
            {
                var myObject = new Object();
                if (check_practical == 1) {
                    datas = {value1: batch, value2: department, value3: group, value4: semester, value5: staff, value6: subject, value8: scode,
                        value9: nick, grade: grade, pass_mark: pass_mark, check_practical: check_practical, practical_pass_mark: practical_pass_mark, practical_mark: practical_mark};
                } else {
                    datas = {value1: batch, value2: department, value3: group, value4: semester, value5: staff, value6: subject, value8: scode,
                        value9: nick, grade: grade, pass_mark: pass_mark};
                }

                $.ajax({
                    url: BASE_URL + "subject/insert_subject",
                    type: 'POST',
                    data: datas,
                    success: function (result) {

                        $("#view_all").html(result);
                        $("#view_all").html();
                        $("#cls").css('display', 'none');
                        for_response('Subject Added Successfully...!'); // resutl notification
                    }
                });
                $("#scode").val('');
                // $("#batch").val('');
                $("#department").val('');
                $("#group1").val('');
                $("#pass_mark").val('');
                $("#staff").val('');
                $(".subject").val('');
                $(".depar").val('');
                $("#nicky").val('');
                $("#grade_point").val('');
            }
        });
        $("#cancel").click(function () {
            // $('#semester').prop('disabled', true);
            $('#department').prop('disabled', true);
            $('#group1').prop('disabled', true);
            $("#grade_point").val('');
            $('.validate').val('');
            $('#group1').val('');
            $('#dupli').html('');
            $('#dupli').html('');
            $('#com_error').html('');
            $('.validate').css('border', '1px solid #CCCCCC');
            $('.mandatory').css('border', '1px solid #CCCCCC');
            $("#phone").css('border', '1px solid #CCCCCC');
        });
        $("#update").live("click", function () {
            i = 0;
            var subject_error = $(this).parent().parent().find('.subject_error').html();
            var nick_error = $(this).parent().parent().find('.nick_error').html();
            var scode_error = $(this).parent().parent().find('.scode_error').html();
            var subject = $(this).parent().parent().find('.u_subject').val();
            var department = $(this).parent().parent().find('.u_department').val();
            var staff = $(this).parent().parent().find('.u_staff').val();
            var batch = $(this).parent().parent().find('.u_batch').val();
            var group = $(this).parent().parent().find('#group').val();
            var scode = $(this).parent().parent().find('.u_scode').val();
            var semester = $(this).parent().parent().find('.u_semester').val();
            var nickname = $(this).parent().parent().find('.u_nick').val();
            var grade = $(this).parent().parent().find('.u_grade').val();
            var pass_mark = $(this).parent().parent().find('.u_pass_mark').val();
            var check_practical = $(this).parent().parent().find('.u_check_practical').val();

            var id = $(this).parent().parent().find('.u_id').val();
            if (check_practical == 1)
            {
                $('.u_practical').show();
                $('.u_practical_mark').addClass("u_val mandatory");
                $('.u_practical_mark').addClass("u_val mandatory");


                var practical_mark = $(this).parent().parent().find('.u_practical_mark').val();
                var practical_pass_mark = $(this).parent().parent().find('.u_practical_pass_mark').val();

                if (pass_mark == '' || pass_mark.trim().length == 0) {
                    i = 1;
                    $('.u_pass_mark').css('border', '1px solid red');
                }
                if (practical_mark == '' || practical_mark.trim().length == 0) {
                    i = 1;
                    $('.u_practical_mark').css('border', '1px solid red');
                }
                if (practical_pass_mark == '' || practical_pass_mark.trim().length == 0) {
                    i = 1;
                    $('.u_practical_pass_mark').css('border', '1px solid red');
                }
            }
            if (batch == '') {
                i = 1;
                $('.u_batch').css('border', '1px solid red');
            }
            if (department == '') {
                i = 1;
                $('.u_department').css('border', '1px solid red');
            }
            if (semester == '') {
                i = 1;
                $('.u_semester').css('border', '1px solid red');
            }
            if (group == '') {
                i = 1;
                $('#group').css('border', '1px solid red');
            }
            if (staff == '') {
                i = 1;
                $('.u_staff').css('border', '1px solid red');
            }
            if (subject == '' || subject.trim().length == 0) {
                i = 1;
                $('.u_subject').css('border', '1px solid red');
            }
            if (scode == '' || scode.trim().length == 0) {
                i = 1;
                $('.u_scode').css('border', '1px solid red');
            }
            if (nickname == '' || nickname.trim().length == 0) {
                i = 1;
                $('.u_nick').css('border', '1px solid red');
            }
            if (grade == '' || grade.trim().length == 0) {
                i = 1;
                $('.u_grade').css('border', '1px solid red');
            }

            if (subject_error.trim().length > 0 || nick_error.trim().length > 0 || scode_error.trim().length > 0)
            {
                i = 1;
                alert('Correct the errors');
            }
            if (i == 0)
            {
                if (check_practical == 1) {
                    datas = {value1: id, value2: subject, value3: staff, value4: batch, value5: group, value6: semester,
                        value7: department, value8: scode, value9: nickname, grade: grade, pass_mark: pass_mark, check_practical: check_practical, practical_pass_mark: practical_pass_mark, practical_mark: practical_mark};
                } else {
                    datas = {value1: id, value2: subject, value3: staff, value4: batch, value5: group, value6: semester, value7: department, value8: scode, value9: nickname, grade: grade, pass_mark: pass_mark, check_practical: check_practical};
                }
                for_loading('Loading... Updateing Data'); // loading notification
                $.ajax({
                    url: BASE_URL + "subject/update_subject",
                    type: 'POST',
                    data: datas,
                    success: function (result) {
                        // $("#view_all").html(result);
                        for_response('Subject Updated Successfully...!'); // resutl notification
                        window.location.reload();
                    }
                });
                $('.modal').css("display", "none");
                $('.fade').css("display", "none");
            }
        });
        $("#no").live("click", function ()
        {
//            var u_check_practical = $(this).parent().parent().find('.u_check_practical').val();
//            $(this).parent().parent().find('.u_check_practical').val(u_check_practical);
//
//            if (u_check_practical == 1) {
//                $(this).val("1");
//                $('.u_practical').show();
//                $('.u_practical_mark').addClass("u_val mandatory");
//                $('.u_practical_mark').addClass("u_val mandatory");
//            } else {
//                $(this).val("0");
//                $('.u_practical').hide();
//                $('.u_practical_mark').removeClass("u_val mandatory");
//                $('.u_practical_mark').removeClass("u_val mandatory");
//            }
//            var $a = $(this).parent().parent().find('.usubject').val();
//            $(this).parent().parent().find('.u_subject').val($a);
//            var $b = $(this).parent().parent().find('.uscode').val();
//            $(this).parent().parent().find('.u_scode').val($b);
//            var $y = u_nick1 = $(this).parent().parent().find('.u_nick1').val();
//            $(this).parent().parent().find('.u_nick').val($y);
//            var $c = $(this).parent().parent().find('.batc').val();
//            $(this).parent().parent().find('.u_batch').val($c);
//            var $d = $(this).parent().parent().find('.depid').val();
//            $(this).parent().parent().find('.u_department').val($d);
//            var $e = $(this).parent().parent().find('.sem').val();
//            $(this).parent().parent().find('.u_semester').val($e);
//            var $f = $(this).parent().parent().find('.staffid').val();
//            $(this).parent().parent().find('.u_staff').val($f);
//            var $g = $(this).parent().parent().find('.staff').val();
//            $(this).parent().parent().find('.u_department_staff').val($g);
//            var $h = $(this).parent().parent().find('section').val();
//            $(this).parent().parent().find('u_group').val();
//            var $grade = $(this).parent().parent().find('.ugrade').val();
//            $(this).parent().parent().find('.u_grade').val($grade);
//            $('.mandatory').css('border', '1px solid #CCCCCC');
//            m.html
            window.location.reload();
        });
        $(".delete_sub").live("click", function () {
            for_loading_del('Loading... Delete Data'); // loading notification
            var hidin = $(this).parent().parent().find('.hid').val();
            $.ajax({
                url: BASE_URL + "subject/delete_subject",
                type: 'POST',
                data: {value1: hidin},
                success: function (result) {
                    $("#view_all").html(result);
                    for_response_del('Data Delete Successfully...!'); // resutl notification
                }

            });
            $('.modal').css("display", "none");
            $('.fade').css("display", "none");
        });
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
        $('#department').live('change', function () {
            //$('.master').html('');
            //$('.all').hide();
            d_id = $(this).val();
            $.ajax({
                url: BASE_URL + "subject/get_all_group",
                type: 'POST',
                data: {
                    depart_id: d_id

                },
                success: function (result) {
                    $('#g_td').html(result);
                    $('#group1').focus();
                    /*$('.modal-backdrop').hide();
                     $('.close_div').hide();*/
                }
            });
        });
        $('.u_grp').live('change', function () {
            department = $(this).parent().parent().find('.u_department').val();
            idnum = ($(this).attr('id'));
            var splitNumber = idnum.split('_');
            var ids = splitNumber[1];
            $.ajax({
                url: BASE_URL + "subject/get_all_gp",
                type: 'POST',
                data: {
                    depart_id: department

                },
                success: function (result) {
                    $('.u_td' + ids).html(result);
                    /*$('.modal-backdrop').hide();
                     $('.close_div').hide();*/
                }
            });
        });
        $('.find').live('change', function () {
            department = $(this).parent().parent().find('.u_department').val();
            idnum = ($(this).attr('id'));
            var splitNumber = idnum.split('_');
            var ids = splitNumber[1];
            $.ajax({
                url: BASE_URL + "subject/get_update_staff",
                type: 'POST',
                data: {
                    depart_id: department

                },
                success: function (result) {

                    $('.staff').html(result);
                    /*$('.modal-backdrop').hide();
                     $('.close_div').hide();*/
                }
            });
        });
        $('.staff').live('change', function () {
            d_id = $(this);
            $.ajax(
                    {
                        url: BASE_URL + "subject/get_all_staff",
                        type: 'POST',
                        data: {depart_id: d_id.val()},
                        success: function (result) {

                            $("#s_view").html(result);
                            $('#staff').focus();
                        }
                    });
        });
        $(".src").live("click", function ()
        {
            i = 0;
            //for_loading_del('Loading... Delete Data'); // loading notification
            batch = $("#batch").val(),
                    department = $("#department").val(),
                    group = $("#group1").val(),
                    semester = $("#semester").val();
            //alert(batch + department + group + semester);
            if (batch == '')
            {
                i = 1;
                $('#batch').css('border', '1px solid red');
            }
            if (semester == '')
            {
                i = 1;
                $('#semester').css('border', '1px solid red');
            }
            if (group == '')
            {
                i = 1;
                $('#group1').css('border', '1px solid red');
            }
            if (department == '')
            {
                i = 1;
                $('#department').css('border', '1px solid red');
            }
            if (i == 0)
            {
                $.ajax(
                        {
                            url: BASE_URL + "subject/staff_subject",
                            type: 'POST',
                            data: {value1: batch, value2: department, value3: group, value4: semester},
                            success: function (result) {
                                $(".master").html(result);
                                $('.all').show();
                                $('#testing_subject').html('');
                                // for_response_del('Data Delete Successfully...!'); // resutl notification
                            }
                        });
            }
        });
<?php /* ?> $('.dupe').live('change',function(){
  scode=$("#scode").val(),
  batch=$("#batch").val(),
  department=$("#department").val(),
  group=$("#group1").val(),
  semester=$("#semester").val(),
  staff=$("#staff").val(),
  subject=$("#sub").val();

  $.ajax(
  {
  url:BASE_URL+"subject/validate_subject",
  type:'POST',
  data:{ value1:batch,value2:department,value3:group,value4:semester,value5:staff,value6:subject,value8:scode},
  success:function(result){
  $("#valu").html(result);
  len=( (result + '').length );
  if(len>2){$("#add_subject").attr("disabled", true);}
  else{$("#add_subject").attr("disabled", false);}
  //for_response('Data Insert Successfully...!'); // resutl notification
  }
  });
  });	<?php */ ?>

        $('.u_department_staff').live('change', function () {
            department = $(this).parent().parent().find('.staff_depart').val();
            idno = ($(this).attr('id'));
            var splitNumber = idno.split('_');
            var id = splitNumber[1];
            $.ajax({
                url: BASE_URL + "subject/get_all_staff_update",
                type: 'POST',
                data: {depart_id: d_id.val()},
                success: function (result) {
                    $("#update_s_view" + id).html(result);
                }
            });
        });
        $("#sub").blur(function () {
            var m = $("#chk_valu").val();
            batch = $("#batch").val();
            department = $("#department").val();
            group = $("#group1").val();
            semester = $("#semester").val();
            subject = $("#sub").val();
            $.ajax({
                url: BASE_URL + "subject/checking_deplicate_sub",
                type: 'POST',
                data: {value1: batch, value2: department, value3: group, value4: semester, value6: subject},
                success: function (result)
                {
                    $("#dupli").html(result);
                    len = ((result + '').length);
                    if (len > 2) {
                        $("#add_subject").attr("disabled", true);
                    } else {
                        if (m == 1)
                        {
                            $("#add_subject").attr("disabled", true);
                        } else
                        {
                            $("#add_subject").attr("disabled", false);
                        }
                    }
                }
            });
        });
        $("#nicky").blur(function () {
            var m = $("#chk_valu").val();
            batch = $("#batch").val();
            department = $("#department").val();
            group = $("#group1").val();
            semester = $("#semester").val();
            nick = $(this).val();
            $.ajax({
                url: BASE_URL + "subject/checking_deplicate_nick",
                type: 'POST',
                data: {value1: batch, value2: department, value3: group, value4: semester, value6: nick},
                success: function (result)
                {
                    $("#dupli").html(result);
                    len = ((result + '').length);
                    if (len > 2) {
                        $("#add_subject").attr("disabled", true);
                    } else
                    {
                        if (m == 1)
                        {
                            $("#add_subject").attr("disabled", true);
                        } else
                        {
                            $("#add_subject").attr("disabled", false);
                        }
                    }
                }
            });
        });
        $("#scode").blur(function () {
            batch = $("#batch").val();
            department = $("#department").val();
            group = $("#group1").val();
            semester = $("#semester").val();
            scode = $(this).val();
            if (scode.trim().length > 0)
            {
                $.ajax({
                    url: BASE_URL + "subject/checking_deplicate_scode",
                    type: 'POST',
                    data: {value1: batch, value2: department, value3: group, value4: semester, value6: scode},
                    success: function (result)
                    {
                        $("#dupli").html(result);
                        len = ((result + '').length);
                        if (len > 2) {
                            $("#add_subject").attr("disabled", true);
                        } else {
                            $("#add_subject").attr("disabled", false);
                        }
                    }
                });
            }
        });
        $(".u_subject").blur(function () {
            id = $(this).parent().parent().parent().parent().parent().find('.u_id').val();
            batch = $(this).parent().parent().parent().parent().find('.u_batch').val();
            department = $(this).parent().parent().parent().parent().find('.u_department').val();
            group = $(this).parent().parent().parent().find('.u_group').val();
            semester = $(this).parent().parent().parent().parent().find('.u_semester').val();
            subject = $(this).val();
            $.ajax({
                url: BASE_URL + "subject/update_checking_deplicate_sub",
                type: 'POST',
                data: {id: id, batch: batch, department: department, group: group, semester: semester, subject: subject},
                success: function (result)
                {

                    $(this).offsetParent().find('.subject_error').html(result);
                }
            });
        });
        $('.staff_button').live('change', function () {
            stf_button = $(".depar_value").val();
            stf_id = $(".hide_depart").val();
            var m = $("#com_error");
            $('.btn-primary').prop('disabled', true);
            if (stf_button == stf_id) {
                $('.btn-primary').prop('disabled', false);
                m.html('');
                $('#chk_valu').val(0);
            } else
            {
                //alert('You could not subject to another class');
                $('#chk_valu').val(1);
                m.html("You could not Add Subject to another Class.But you can Search!")
            }
        });
    });

    $(".u_nick").live('blur', function () {
        //alert('hi');
        id = $(this).parent().parent().parent().parent().parent().find('.u_id').val();
        batch = $(this).parent().parent().parent().parent().find('.u_batch').val(),
                department = $(this).parent().parent().parent().parent().find('.u_department').val(),
                group = $(this).parent().parent().parent().find('.u_group').val(),
                semester = $(this).parent().parent().parent().parent().find('.u_semester').val(),
                nick = $(this).val();

        $.ajax({
            url: BASE_URL + "subject/update_checking_deplicate_nick",
            type: 'POST',
            data: {id: id, batch: batch, department: department, group: group, semester: semester, nick: nick},
            success: function (result)
            {
                $(this).offsetParent().find('.nick_error').html(result);
            }
        });
    });

    $(".u_scode").live('blur', function () {
        //alert('hi');
        id = $(this).parent().parent().parent().parent().parent().find('.u_id').val();
        batch = $(this).parent().parent().parent().parent().find('.u_batch').val(),
                department = $(this).parent().parent().parent().parent().find('.u_department').val(),
                group = $(this).parent().parent().parent().find('.u_group').val(),
                semester = $(this).parent().parent().parent().parent().find('.u_semester').val(),
                scode = $(this).val();
        if (scode.trim().length > 0)
        {
            $.ajax({
                url: BASE_URL + "subject/update_checking_deplicate_scode",
                type: 'POST',
                data: {id: id, batch: batch, department: department, group: group, semester: semester, scode: scode},
                success: function (result)
                {
                    $(this).offsetParent().find('.scode_error').html(result);
                }
            });
        }
    });

    $('#group1').live('change', function () {


    });


</script>



<?php $staff = $this->session->userdata('logged_in'); ?><?php
if (isset($master) && !empty($master)) {
    foreach ($master as $row) {

    }
}
?>
<?php if ($staff['staff_type'] == 'admin' && $row['subject'] == 1 || $staff['staff_type'] == 'staff' && $row['subject'] == 1) { ?>
    <!--  table veiw perpose-->
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
                    <th>Staff</th>
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
                            <td><?= ($view['practical_mark'] != '') ? $view['practical_mark'] : '-'; ?></td>
                            <td><?= ($view['practical_pass_mark'] != '') ? $view['practical_pass_mark'] : '-'; ?></td>
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
        </table><?php } ?>
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
                                <td>Academic Year</td><td class="text_bold1"> <?= $view['from'] ?></td>
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
                                                            value="<?= $view['id'] ?>" ><?php echo $view['from'] ?>

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
                                            <select id='semester' name='semester'  class="u_semester u_val mandatory" disabled="disabled" >

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
                                                </select>        <?php } ?>
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
                                            <input type="text" class="u_scode u_val mandatory"  value="<?php echo $update['scode']; ?>" />
                                            <input type="hidden" class="uscode" id="uscode" value="<?php echo $update['scode']; ?>" />
                                            <span class="scode_error errormessage" style="color:#F00;"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Credits </td>
                                        <td>
                                            <input type="text" class="u_grade u_val mandatory"  value="<?php echo $update['grade_point']; ?>" />
                                            <input type="hidden" class="ugrade" id="ugrade" value="<?php echo $update['grade_point']; ?>" />
                                        </td>
                                    </tr>
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
                                            <input type="hidden" value="<?php echo $update['staff_id'] ?>" id="staffid" class="staffid" />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-primary delete" id="update" name="update" value="Update" />
                        <button type="button" class="btn btn-danger" id="no" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $i++;
    }
}
?>
<table width="100%" class=" all my_table_style" id="vie_stf" style="display:none">
    <thead>
        <tr style="background-color: rgb(250, 250, 250);"><th>Sub-code</th><th>Subject</th><th>Staff Name</th></tr>
    </thead>
    <tbody>
        <?php
        if (isset($sub_view) && !empty($sub_view)) {

            foreach ($sub_view as $val) {
                ?>

                <tr><td><?= $val['scode'] ?></td><td><?= $val['subject_name'] ?></td><td><?= $val['staff_name'] ?></td></tr>

                <?php
            }
        }
        ?>
    </tbody>
</table>
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

    function removeSpaces(string) {
        return string.split(' ').join('');
    }
</script>
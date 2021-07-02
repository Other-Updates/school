<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<a href="<?= $this->config->item('base_url') . 'assignment/add_assignment' ?>" class='btn btn-primary'>Add Project</a>
<p>&nbsp;</p>
<div>


    <div id="list_all">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <th>S.No</th>
            <th>Academic Year</th>
            <th>Term</th>

            <th>Section&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th>Subject</th>
            <th>Staff Name</th>
            <th>Project Number</th>
            <th>Project Date&nbsp;&nbsp;</th>
            <th>Due Date</th>


            <th>Marks&nbsp;&nbsp;</th>
            <th>Action</th>
            </thead>

            <tbody>
                <?php
//echo "<pre>"; print_r($list); exit;
                $user_det = $this->session->userdata('logged_in');
                if ($user_det['staff_type'] == 'staff') {
                    if (isset($list) && !empty($list)) {
                        $i = 0;
                        $c = count($list);
                        for ($j = 0; $j < $c; $j++) {

                            if (isset($list[$j])) {
                                $r = count($list[$j]);
                                for ($x = 0; $x < $r; $x++) {
                                    $i++;
                                    ?>
                                    <tr><td><?php echo $i; ?></td>
                                        <td><?php
                                            if (isset($list[$j][$x]['from'])) {
                                                echo $list[$j][$x]['from'];
                                            }
                                            ?></td>
                                        <td><?php if (isset($list[$j][$x]['semester'])) echo $list[$j][$x]['semester']; ?></td>

                                        <td><?php
                                            if (isset($list[$j][$x]['department'])) {
                                                echo $list[$j][$x]['nickname'] . "-";
                                            }
                                            if (isset($list[$j][$x]['group'][0]['group'])) {
                                                echo $list[$j][$x]['group'][0]['group'];
                                            }
                                            ?></td>
                                        <td><?php
                                            if (isset($list[$j][$x]['subject_name'])) {
                                                echo $list[$j][$x]['nick_name'];
                                            }
                                            ?></td>
                                        <td><?php
                                            if (isset($list[$j][$x]['staff'][0]['name'])) {
                                                echo $list[$j][$x]['staff'][0]['name'];
                                            }
                                            ?></td>
                                        <td><?php
                                            if (isset($list[$j][$x]['ass_number'])) {
                                                echo $list[$j][$x]['ass_number'];
                                            }
                                            ?></td>
                                        <td><?php
                                            if (isset($list[$j][$x]['ldt'])) {
                                                echo date('d-m-Y', strtotime($list[$j][$x]['ldt']));
                                            }
                                            ?></td>
                                        <td><?php
                                            if (isset($list[$j][$x]['due_date'])) {
                                                echo date('d-m-Y', strtotime($list[$j][$x]['due_date']));
                                            }
                                            ?></td>


                                        <td><?php
                                            if (isset($list[$j][$x]['total'])) {
                                                echo $list[$j][$x]['total'];
                                            }
                                            ?></td>
                                        <td><a href="#view_<?php
                                            if (isset($list[$j][$x]['id'])) {
                                                echo $list[$j][$x]['id'];
                                            }
                                            ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>


                                            <?php if ($list[$j][$x]['close_status'] == 0) { ?>
                                                <a href="#delete_<?php
                                                if (isset($list[$j][$x]['id'])) {
                                                    echo $list[$j][$x]['id'];
                                                }
                                                ?>" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                               <?php } ?>
                                        </td></tr>

                                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.tab-pane -->

        <?php
        if (isset($list) && !empty($list)) {
            $c = count($list);
            for ($j = 0; $j < $c; $j++) {
                if (isset($list[$j])) {
                    $r = count($list[$j]);
                    for ($x = 0; $x < $r; $x++) {
                        ?>
                        <div id="view_<?php echo $list[$j][$x]['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <a class="close" data-dismiss="modal">×</a>
                                        <h3 id="myModalLabel">Project View</h3>
                                    </div>
                                    <div class="modal-body" >
                                        <table class="staff_table_sub">
                                            <tr>
                                                <td>Batch</td><td class="text_bold1"><?php echo $list[$j][$x]['from'] . "-" . $list[$j][$x]['to']; ?>  </td>
                                            </tr>
                                            <tr>
                                                <td>Term</td><td class="text_bold1"> <?php echo $list[$j][$x]['semester']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Section</td><td class="text_bold1"><?php echo $list[$j][$x]['department'] . "-" . $list[$j][$x]['group'][0]['group'];
                        ?></td>
                                            </tr>

                                            <tr>
                                                <td>Question</td><td class="text_bold1"> <?php echo $list[$j][$x]['question']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Project File</td><td class="text_bold1"> <?php
                                                    if (isset($list[$j][$x]['ass_file']) && !empty($list[$j][$x]['ass_file'])) {
                                                        ?>
                                                        <a  href="<?= $this->config->item('base_url') ?>assignment_files/questions/<?= $list[$j][$x]['ass_file'] ?>" download="<?= $list[$j][$x]['ass_file'] ?>"><?= $list[$j][$x]['ass_file'] ?>

                                                        </a>
                                                        <?php
                                                    } else {
                                                        echo "No Files attached";
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <td>Subject</td><td class="text_bold1"> <?php echo $list[$j][$x]['subject_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Project Number</td><td class="text_bold1"> <?php echo $list[$j][$x]['ass_number']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Project Type</td><td class="text_bold1"> <?= ($list[$j][$x]['ass_type'] == 0) ? "Non Upload" : "Upload"; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Comments</td><td class="text_bold1"> <?php echo $list[$j][$x]['comments']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Project Date</td><td class="text_bold1"> <?php echo date('d-m-Y', strtotime($list[$j][$x]['ldt'])); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Due Date</td><td class="text_bold1"> <?php echo date('d-m-Y', strtotime($list[$j][$x]['due_date'])); ?></td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
        }
        ?>

        <?php
        if (isset($list) && !empty($list)) {
            $c = count($list);
            for ($j = 0; $j < $c; $j++) {
                if (isset($list[$j][0])) {
                    $r = count($list[$j]);
                    for ($x = 0; $x < $r; $x++) {
                        ?>

                        <div id="delete_<?php echo $list[$j][$x]['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <a class="close" data-dismiss="modal">×</a>
                                        <h3 id="myModalLabel">Delete Project</h3>
                                    </div>
                                    <div class="modal-body" >
                                        Are you sure, want to delete?
                                        <input type="hidden" value="<?php echo $list[$j][$x]['id']; ?>" class="hid" />
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" value="Yes" id="yes" class="btn btn-primary delete"  />
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                }
            }
        }
    } else if ($user_det['staff_type'] == 'admin') {
        //echo "<pre>"; print_r($list); exit;
        if (isset($list) && !empty($list)) {
            $i = 0;
            foreach ($list as $billto) {
                $i++;
                ?>
                <tr><td><?php echo $i; ?></td>
                    <td><?php echo $billto["from"]; ?></td>
                    <td><?php echo $billto["semester"]; ?></td>

                    <td><?php
                        echo $billto["nickname"] . "-";
                        if (isset($billto['group'][0])) {
                            echo $billto['group'][0]['group'];
                        } else {
                            echo '--';
                        }
                        ?></td>
                    <td><?php echo $billto['nick_name']; ?></td>
                    <td><?php echo $billto['staff'][0]['name']; ?></td>
                    <td><?php echo $billto["ass_number"]; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($billto["ldt"])); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($billto["due_date"])); ?></td>


                    <td><?php echo $billto['total']; ?></td>
                    <td><a href="#view1_<?php echo $billto["id"]; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>

                        <?php if ($billto["close_status"] == 0) { ?>
                            <a href="#delete1_<?php echo $billto["id"]; ?>" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                        <?php } ?>
                    </td></tr>

                <?php
            }
        }
        ?>
    </tbody>
    </table>
    </div>
    <!-- /.tab-pane -->

    <?php
    if (isset($list) && !empty($list)) {
        foreach ($list as $billto) {
            ?>
            <div id="view1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal">×</a>
                            <h3 id="myModalLabel">Project View</h3>
                        </div>
                        <div class="modal-body" >
                            <table class="staff_table_sub">
                                <tr>
                                    <td>Academic Year</td><td class="text_bold1"><?php echo $billto["from"]; ?>  </td>
                                </tr>
                                <tr>
                                    <td>Term</td><td class="text_bold1"> <?php echo $billto['semester']; ?></td>
                                </tr>
                                <tr>
                                    <td>Section</td><td class="text_bold1"><?php
                                        echo $billto["department"] . "-";
                                        if (isset($billto['group'][0])) {
                                            echo $billto['group'][0]['group'];
                                        } else {
                                            echo '--';
                                        }
                                        ?></td>
                                </tr>

                                <tr>
                                    <td>Question</td><td class="text_bold1"> <?php echo $billto['question']; ?></td>
                                </tr>
                                <tr>
                                    <td>Project File</td><td class="text_bold1"> <?php
                                        if (isset($billto['ass_file']) && !empty($billto['ass_file'])) {
                                            ?>
                                            <a  href="<?= $this->config->item('base_url') ?>assignment_files/questions/<?= $billto['ass_file'] ?>" download="<?= $billto['ass_file'] ?>"><?= $billto['ass_file'] ?>
                                            </a>
                                            <?php
                                        } else {
                                            echo "No Files attached";
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>Subject</td><td class="text_bold1"> <?php echo $billto['subject_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Project Number</td><td class="text_bold1"> <?php echo $billto["ass_number"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Project Type</td><td class="text_bold1"> <?= ($billto['ass_type'] == 0) ? "Non Upload" : "Upload"; ?></td>
                                </tr>
                                <tr>
                                    <td>Comments</td><td class="text_bold1"> <?php echo $billto["comments"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Project Date</td><td class="text_bold1"> <?php echo date('d-m-Y', strtotime($billto["ldt"])); ?></td>
                                </tr>
                                <tr>
                                    <td>Due Date</td><td class="text_bold1"> <?php echo date('d-m-Y', strtotime($billto["due_date"])); ?></td>
                                </tr>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <?php
    if (isset($list) && !empty($list)) {
        foreach ($list as $billto) {
            ?>

            <div id="delete1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal">×</a>
                            <h3 id="myModalLabel">Delete Project</h3>
                        </div>
                        <div class="modal-body" >
                            Are you sure, want to delete?
                            <input type="hidden" value="<?php echo $billto['id']; ?>" class="hid" />
                        </div>
                        <div class="modal-footer">
                            <input type="button" value="Yes" id="yes" class="btn btn-primary delete"  />
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    }
}
?>
<script type="text/javascript">
    $("#yes").live("click", function ()
    {
        //for_loading('Loading... Delete Data'); // loading notification
        var hid = $(this).parent().parent().find('.hid').val();

        $.ajax({
            url: BASE_URL + "assignment/delete_assignment",
            type: 'POST',
            data: {id: hid},
            success: function (result) {

                $("#list_all").html(result);
                //for_response('Data Delete Successfully...!'); // resutl notification
            }

        });
        $('.modal').css("display", "none");
        $('.fade').css("display", "none");

    });
</script>
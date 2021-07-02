<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<div class="message-container">
    <div class="message-form-content">
        <div class="message-form-header">
            <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/internal_mark.png"></div>
            Mark Details
        </div>
        <div class="message-form-inner">
            <!--            <div class="row user_print_use">
                            <div class="six columns">
                                <div class="form-row">
                                    <label class="field-name" style="width:107px;">Select Term :</label>
                                    <select id='select_sem'>
                                        <option value="0">Select</option>
            <?php
            if (isset($all_sem) && !empty($all_sem)) {

                foreach ($all_sem as $val1) {
                    ?>
                                                                                                                                                                                <option class="se_id" value="<?= $val1['id'] ?>"><?php echo $val1['semester'] ?></option>
                    <?php
                }
            }
            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="six columns">
                                <div class="form-row">
                                    <div id='subject_det'></div>
                                </div>
                            </div>
                        </div>-->

            <div id='internals'>
                <?php
                $user_info = $this->session->userdata('user_info');
                $this->load->model('admin/admin_model');
                $mark_info = $this->admin_model->get_internal_details();
                ?>
<!--<script src="<?= $theme_path; ?>/js/highcharts.js"></script>
<script src="<?= $theme_path; ?>/js/drilldown.src.js"></script>-->
                <br />
                <div class="row">
                    <div class="six columns">
                        <table class="view_table" width="100%">
                            <tr>
                                <td width="40%">Roll No</td>
                                <td class="text_bold" style="color:red"><?= $user_info[0]['std_id'] ?></td>
                            </tr>
                            <tr>
                                <td>Batch</td>
                                <td class="text_bold"><?= $user_info[0]['from']; ?></td>
                            </tr>
                            <tr>
                                <td>Semester</td>
                                <td class="text_bold"><?php
                                    if (isset($all_sem[0]['semester'])) {
                                        echo $all_sem[0]['semester'];
                                    }
                                    ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="six columns">
                        <table class="view_table" width="100%">
                            <tr>
                                <td width="40%">Student Name</td>
                                <td class="text_bold"><?= ucfirst($user_info[0]['name']) ?></td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td class="text_bold"><?= $user_info[0]['department'] . '-' . $user_info[0]['group'] ?></td>
                            </tr>
                            <tr>
                                <td>Join Date</td>
                                <td class="text_bold"><?= date('d-m-Y', strtotime($user_info[0]['join_date'])) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <br /><br />
                <div class="full_width">
                    <table  class="table table-bordered table-striped  my_table_style">
                        <thead>
                            <tr>
                                <th>Roll No</th>
                                <th>Student Name</th>
                                <?php
                                $sum = array();
                                $sum1 = array();

                                if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
                                    foreach ($all_subject[0]['subject'] as $val) {
                                        ?>
                                        <th colspan="<?php echo ($val['check_practical'] == 1) ? 2 : 0 ?>">
                                            <?= ucwords($val['nick_name']); ?> - Theory( <?php echo $sum[] = ($val['grade_point']) ?> )

                                            <?php if ($val['check_practical'] == 1) { ?>

                                                - Practical( <?php echo $sum1[] = ($val['practical_mark']); ?> )


                                            <?php }
                                            ?>
                                        </th>

                                        <?php
                                    }
                                }
                                ?>
                                <th>Total - ( <?php echo round((array_sum($sum) + array_sum($sum1))) ?> )

                                </th>
                                <th>Result</th>
                                <th>Mark Sheet</th>
                            </tr>
<!--                            <tr>
                                <th></th>
                                <th></th>

                            <?php
                            if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
                                foreach ($all_subject[0]['subject'] as $val) {
                                    ?>
                                                                                                                                        <th  colspan="<?php echo ($val['check_practical'] == 1) ? 2 : 0 ?>">
                                                                                                                                            Pass Mark - Theory( <?php echo $val['pass_mark'] ?> )
                                    <?php if ($val['check_practical'] == 1) { ?>
                                                                                                                                                                                                - Practical( <?php echo $sum1[] = ($val['practical_pass_mark']) ?> )
                                    <?php }
                                    ?>
                                                                                                                                        </th>
                                    <?php
                                }
                            }
                            ?>
                                <th></th>
                                <th></th>
                            </tr>-->
                        </thead>

                        <?php
                        if (isset($all_grade[0]['external_details']) && !empty($all_grade[0]['external_details'])) {
                            ?>

                            <?php
                            $j = 1;
                            $i = 0;
                            foreach ($all_grade[0]['external_details'] as $val) {
                                ?>
                                <tr>
                                    <td style="text-align:center;">
                                        <?php echo ucwords($val['roll_no']); ?>

                                    </td>
                                    <td style="text-align:center;">
                                        <?php echo ucwords($val['name']); ?>
                                    </td>
                                    <?php
                                    if (isset($val['grade_details']) && !empty($val['grade_details'])) {
                                        foreach ($val['grade_details'] as $val1) {
                                            ?>
                                            <td style="text-align:center;">
                                                <?php echo $val1['grade_point']; ?>
                                            </td>

                                            <?php if ($val1['practical_mark'] != '') { ?>
                                                <td style="text-align:center;">
                                                    <?php echo $val1['practical_mark'] ?>
                                                </td>

                                            <?php } ?>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <td><?= $val1['total'] ?></td>
                                    <td><label class="btn btn-<?php echo ($val1['result'] == '1') ? 'success' : 'danger' ?> btn-sm"><?php echo ($val1['result'] == '1') ? 'Pass' : 'Fail' ?></label></td>
                                    <td><a href="<?= $this->config->item('base_url') . 'users/mark_sheet/' . $user_info[0]['id']; ?>" title="Mark Sheet" target="_blank" class="btn bg-navy btn-sm">View</a></td>
                                </tr>
                                <?php
                                $j++;
                            }
                        } else
                            echo "<tr><td colspan=15'>Student Not Created Yet..</td></tr>";
                        ?>
                    </table>

                    <br>
                    <table class="table table-bordered table-striped dataTable">
                        <tr>
                            <th  style="width: 25%;">Subject Name</th>
                            <th style="text-align:center;width: 10%;">Theory</th>
                            <th  style="text-align:center;width: 10%;">Pass Mark</th>
                            <th  style="text-align:center;width: 10%;">Practical Mark</th>
                            <th style="text-align:center;width: 10%;">Practical Pass Mark</th>
                        </tr>
                        <?php
                        if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
                            foreach ($all_subject[0]['subject'] as $result1) {
                                ?>
                                <tr>
                                    <td  style="width: 25%;"><?= $result1['subject_name'] ?></td>
                                    <td  style="text-align:center;width: 10%;"><?php echo ($result1['grade_point'] != '') ? $result1['grade_point'] : '-' ?></td>
                                    <td  style="text-align:center;width: 10%;"><?php echo ($result1['pass_mark'] != '') ? $result1['pass_mark'] : '-' ?></td>
                                    <td  style="text-align:center;width: 10%;"><?php echo ($result1['practical_mark'] != '') ? $result1['practical_mark'] : '-' ?></td>
                                    <td  style="text-align:center;width: 10%;"><?php echo ($result1['practical_pass_mark'] != '') ? $result1['practical_pass_mark'] : '-' ?></td>
                                </tr>
                                <?php
                            }
                        } else
                            echo "<tr><td colspan=5'>No Subject Found..</td></tr>";
                        ?>

                    </table>
                    <br />

                </div>
            </div>
<!--            <script src="<?= $theme_path; ?>/js/highcharts.js"></script>
            <script src="<?= $theme_path; ?>/js/drilldown.src.js"></script>-->



            <script type="text/javascript">
//                $('#select_sem').live('change', function () {
//
//                    if (Number($(this).val()) != 0)
//                    {
//                        $.ajax({
//                            url: BASE_URL + "users/get_subject_by_sem_id",
//                            type: 'POST',
//                            data: {
//                                sem_id: $(this).val()
//                            },
//                            success: function (result) {
//                                $("#subject_det").html(result);
//                            }
//                        });
//                    } else
//                    {
//                        $("#subject_det").html('');
//                        window.location.reload();
//
//                    }
//
//                });
//                $('#select_sem').live('change', function () {
//                    if (Number($(this).val()) != 0)
//                    {
//                        $.ajax({
//                            url: BASE_URL + "users/get_all_internals_by_id",
//                            type: 'POST',
//                            data: {
//                                sem_id: $(this).val()
//                            },
//                            success: function (result) {
//                                $("#internals").html(result);
//                            }
//                        });
//                    }
//
//                });
//                $('#subject_id').live('change', function () {
//                    if (Number($(this).val()) != 0 && $('#select_sem').val() != 0)
//                    {
//                        $('#select_sem').css('border-color', '');
//                        $.ajax({
//                            url: BASE_URL + "users/get_internal_by_subject_id",
//                            type: 'POST',
//                            data: {
//                                subject_id: $(this).val(),
//                                sem_id: $('#select_sem').val()
//                            },
//                            success: function (result) {
//                                $("#internals").html(result);
//                            }
//                        });
//                    } else
//                        $('#select_sem').css('border-color', 'red');
//
//                });
//                $.ajax({
//                    url: BASE_URL + "users/get_all_internals_by_id",
//                    type: 'POST',
//                    data: {
//                        sem_id: $('.se_id').val()
//                    },
//                    success: function (result) {
//                        $("#internals").html(result);
//                    }
//                });
            </script>


            <div class="admin_print_use">
                <br />

                <input type="button" value='Print' class="btn btn-primary print_btn right"/>

                <br /><br />
            </div>
            <script type="text/javascript">
                $('.print_btn').live('click', function () {
                    window.print();
                });
            </script>
        </div>
    </div>
</div>


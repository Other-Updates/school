<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<div class="message-container">
    <div class="message-form-content">
        <div class="message-form-header">
            <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/internal_mark.png"></div>
            Mark Details
        </div>
        <div class="message-form-inner">
            <div class="row user_print_use">
                <div class="six columns">
                    <div class="form-row">
                        <label class="field-name" style="width:107px;">Select Exam :</label>
                        <select id='select_exam'>
                            <option value="0">Select</option>
                            <?php
                            if (isset($all_exam) && !empty($all_exam)) {

                                foreach ($all_exam as $val1) {
                                    ?>
                                    <option class="exam_id" value="<?= $val1['id'] ?>"><?php echo $val1['exam'] ?></option>
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
            </div>

            <div id='internals'>

            </div>
<!--            <script src="<?= $theme_path; ?>/js/highcharts.js"></script>
            <script src="<?= $theme_path; ?>/js/drilldown.src.js"></script>-->



            <script type="text/javascript">
                $('#select_exam').live('change', function () {
                    if (Number($(this).val()) != 0)
                    {
                        $.ajax({
                            url: BASE_URL + "users/get_all_internals_by_id",
                            type: 'POST',
                            data: {
                                exam_id: $(this).val()
                            },
                            success: function (result) {
                                if (result != '')
                                    $("#internals").html(result);
                                else
                                    $("#internals").html('');

                            }
                        });
                    } else {
                        $("#internals").html('');
                    }

                });
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
//
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

        </div>
    </div>
</div>


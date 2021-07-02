<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<div class="message-container">
    <div class="message-form-content">
        <div class="message-form-header">
            <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/subject.png"></div>
            Subject
        </div>
        <div class="message-form-inner">

            <div class="form-row user_print_use">
                <label class="field-name">Select Term :</label>
                <select id='semester_id' name='student_group[depart_id]' >
                    <option value="0">Choose Term</option>
                    <?php
                    if (isset($semester) && !empty($semester)) {
                        foreach ($semester as $val) {
                            ?>
                            <option value="<?= $val['id'] ?>"><?= $val['semester'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>




            <div id="view_all" class="viw_all my_table_style " display="none" >
                <table width="100%" class="table demo my_table_style">
                    <thead>
                    <th colspan="4"><?php echo $sub[0]['semester']; ?></th>
                    </thead>
                    <thead>
                        <tr style="background-color: rgb(250, 250, 250);"><th>Sub-code</th><th>Subject</th><th>Credits</th><th data-hide="phone">Staff Name</th></tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($sub) && !empty($sub)) {

                            foreach ($sub as $val) {
                                ?>

                                <tr><td><?= $val['scode'] ?></td><td><?= $val['nick_name'] ?></td><td><?= $val['grade_point'] ?></td><td><?= $val['staff_name'] ?></td></tr>

                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <br />
                <div>
                    <table border="0" width="100%">
                        <?php
                        if (isset($sub) && !empty($sub)) {
                            foreach ($sub as $val) {
                                ?>
                                <tr><td width="26%"><?php echo $val['nick_name']; ?></td>
                                    <td width="22%">-</td><td width="52%"><?php echo $val['subject_name']; ?></td></tr>
                            <?php }
                        }
                        ?>
                    </table>
                </div>
                <p class="user_print_use">
                    <input type="button"  class='btn btn-primary print_btn right' value="Print" />
                </p>

                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.print_btn').click(function () {
                            window.print();
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</div>









<script type="text/javascript">


    $('#semester_id').live('change', function () {

        d_id = $("#semester_id").val();
        if (d_id != 0)
        {
            $.ajax({
                url: BASE_URL + "users/view",
                type: 'POST',
                data: {
                    value1: d_id

                },
                success: function (result) {

                    $("#view_all").html(result);
                    $('.viw_all').show();
//					$('.close_div').hide();
                }

            });
        }
    });


    $(document).ready(function ()

    {


    });





</script>
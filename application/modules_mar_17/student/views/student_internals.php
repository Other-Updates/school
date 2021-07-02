<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/highcharts.js"></script>
<script src="<?= $theme_path; ?>/js/drilldown.src.js"></script>
<div class="page-inner" style="padding-left: 0;"><div class="page-title"><span><h3>Internal Details</h3></span> </div></div>
<table>
    <tr>
        <td width="150">
            Select Term
        </td>
        <td>
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
        </td>

        <td>
            <div id='subject_det'></div>
        </td>
    </tr>

</table>
<input type="hidden" value="<?= $std_info['student_info1'][0]['student_id'] ?>" id='std_id' />
<input type="hidden" value="<?= $std_info['student_info1'][0]['batch_id'] ?>" id='batch_id' />
<input type="hidden" value="<?= $std_info['student_info1'][0]['depart_id'] ?>" id='depart_id' />
<input type="hidden" value="<?= $std_info['student_info1'][0]['group_id'] ?>" id='group_id' />
</div>
</div>
<div class="six columns">
    <div class="form-row">

    </div>
</div>
</div>

<div id='internals'></div>






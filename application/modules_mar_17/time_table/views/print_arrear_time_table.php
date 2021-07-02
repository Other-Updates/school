<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<table id='app_table' class="staff_table_sub" border="1">
    <thead>
        <tr>
            <th colspan="6"><span style="color:#058DCE"> &nbsp; Arrear Time Table&nbsp;-&nbsp;<?php if (isset($arrear_time) && !empty($arrear_time)) {
    echo $arrear_time[0]['subject_info'][0]['department'];
}
?>&nbsp;-&nbsp;<?php echo date('Y'); ?></span></th>
        </tr>
        <tr>
            <th>Term</th>
            <th>Subject Code</th>
            <th>Subject</th>
            <th>Date</th>
            <th data-hide='phone,tablet'>From Time</th>
            <th data-hide='phone,tablet'>To Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($arrear_time) && !empty($arrear_time)) {

            foreach ($arrear_time as $val1) {
                ?>

                <tr>
                    <td class="sno" ><?= $val1['subject_info'][0]['semester'] ?></td>
                    <td>
                        <?= $val1['subject_info'][0]['scode'] ?>

                    </td>
                    <td>
                        <?= $val1['subject_info'][0]['subject_name'] ?>

                    </td>
                    <td><?= date('d-M-Y', strtotime($val1['date_of_exam'])) ?></td>
                    <td>
                        <?= $val1['in_time'] ?>
                    </td>
                    <td>
                        <?= $val1['out_time'] ?>
                    </td>
                </tr>
                <?php
            }
        } else
            echo "<tr><td colspan='6'>No Records Found</td></tr>";
        ?>
    </tbody>
</table>
<p class="print_admin_use">
    <br />
    <input type="button" value='Print' class='print_btn btn btn-primary fright' />
    <br /><br />
</p>
<script type="text/javascript">
    $(document).ready(function () {
        $('.print_btn').click(function () {
            window.print();
        });
    });
</script>

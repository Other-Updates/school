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
<br />

<table id="example2" class="table table-bordered table-striped">
    <thead>
        <tr>

            <th>Roll No</th>
            <th>Name</th>
            <th>Academic Year</th>
            <th>Class</th>
            <th>Room No</th>
            <th>Period</th>
            <th>Joining Date</th>
            <th>Advance Amount</th>
            <th>No of Working Days</th>
            <th>Bill Amount</th>
            <th>Refundable Amount</th>
        </tr>
    </thead>
    <?php
    $total_sum = array();
    $ab_sum = array();
    $paid_sum = array();
    $bal_sum = array();

    if (isset($non_report) && !empty($non_report)) {
        foreach ($non_report as $val) {
            $du_date1 = date('d-M-Y', strtotime($val['admission_date']));
            $delay1 = date('d-M-Y') - $du_date1;
            $total_sum[] = $val['amount'];
            ?>
            <tr>

                <td><?= $val['std_id'] ?></td>
                <td><?= $val['name'] ?></td>
                <td><?= $val['from'] ?></td>
                <td><?= $val['nickname'] . '-' . $val['group'] ?></td>
                <td><?= $val['room_name'] . '-' . $val['seat_no'] ?></td>
                <td  style="text-align:right;"><?= $val['start_year'] ?>-<?= $val['end_year'] ?></td>
                <td  style="text-align:right;"><?= $val['admission_date'] ?></td>
                <td  style="text-align:right;">
                    Rs <?= $val['amount'] ?> ( <?= $val['per_day'] ?> )
                </td>
                <td  style="text-align:right;">
                    <?= $delay1 ?>
                </td>
                <td  style="text-align:right;">
                    Rs <?php echo $delay1 * $val['per_day'];
            $paid_sum[] = $delay1 * $val['per_day'];
                    ?>
                </td>
                <td style="text-align:right;">
                    Rs <?php echo $val['amount'] - ($delay1 * $val['per_day']);
            $bal_sum[] = $val['amount'] - ($delay1 * $val['per_day']);
            ?>
                </td>
            </tr>


            <?php
        }
    }
    ?>
    <tfoot>
        <tr style="background: #058DCE;">

            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="text-align:right; color:#FFF;">Rs <?= array_sum($total_sum); ?></th>
            <th style="text-align:right; color:#FFF;"></th>
            <th style="text-align:right; color:#FFF;">Rs <?= array_sum($paid_sum); ?></th>
            <th style="text-align:right; color:#FFF;">Rs <?= array_sum($bal_sum); ?></th>
        </tr>
    </tfoot>
</table>

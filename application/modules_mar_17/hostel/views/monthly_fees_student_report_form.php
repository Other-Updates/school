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
<?php
if ($student_list[0]['hostel_type'] == 0) {
    ?>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Roll No</th>
                <th>Name</th>
                <th>Academic Year</th>
                <th>Class</th>
                <th>Hostel Name</th>
                <th>Room No</th>
                <th>Amount</th>
                <th>No of Absent</th>
                <th>Paid Amount</th>
                <th>Balance</th>
                <th>Status</th>
            </tr>
        </thead>
        <?php
        $total_sum = array();
        $ab_sum = array();
        $paid_sum = array();
        $bal_sum = array();
        if ($student_list[0]['roll_no']) {
            foreach ($student_list[0]['roll_no'] as $val) {
                ?>
                <tr>
                    <td>
                        <a href="#profile_img" data-toggle="modal"><img class="staff_thumbnail" src="<?= $this->config->item('base_url') ?>profile_image/student/thumb/<?= $val['image'] ?>" /></a>
                    </td>
                    <td><?= $val['roll_no'] ?></td>
                    <td><?= $val['name'] ?></td>
                    <td><?= $val['from'] ?></td>
                    <td><?= $val['nickname'] . '-' . $val['group'] ?></td>
                    <td><?= $student_list[0]['block'] ?></td>
                    <td><?= $val['room_name'] . '-' . $val['seat_no'] ?></td>
                    <td  style="text-align:right;">Rs <?= $student_list[0]['per_head'] ?></td>
                    <td  style="text-align:right;">
                        <?php
                        $ab = 0;
                        if (isset($val['payment_details'][0]['no_of_days_ap']) && !empty($val['payment_details'][0]['no_of_days_ap'])) {

                            $ab = $val['payment_details'][0]['no_of_days_ap'];
                        }
                        echo $ab;
                        ?>
                    </td>
                    <td  style="text-align:right;">
                        Rs <?php
                        $paid = 0;
                        if (isset($val['payment_details'][0]['no_of_days_ap']) && !empty($val['payment_details'][0]['no_of_days_ap'])) {
                            $paid = $val['payment_details'][0]['amount'];
                        } else
                            $paid = $val['payment_details'][0]['amount'];
                        echo $paid;
                        ?>
                    </td>
                    <td  style="text-align:right;">
                        Rs <?php
                        $bal = $student_list[0]['per_head'] - $paid;
                        if (isset($val['payment_details'][0]['no_of_days_ap']) && !empty($val['payment_details'][0]['no_of_days_ap'])) {
                            $bal = 0;
                        }
                        echo $bal;

                        $total_sum[] = $student_list[0]['per_head'];
                        $ab_sum[] = $ab;
                        $paid_sum[] = $paid;
                        $bal_sum[] = $bal;
                        ?>
                    </td>
                    <td>
                        <?= ($bal == 0) ? 'Paid' : 'Pending' ?>
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
                <th style="text-align:right; color:#FFF;"><?= array_sum($ab_sum); ?></th>
                <th style="text-align:right; color:#FFF;">Rs <?= array_sum($paid_sum); ?></th>
                <th style="text-align:right; color:#FFF;">Rs <?= array_sum($bal_sum); ?></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <?php
}
if ($student_list[0]['hostel_type'] == 1) {
    ?>
    <table id="example3" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Roll No</th>
                <th>Name</th>
                <th>Academic Year</th>
                <th>Class</th>
                <th>Hostel Name</th>
                <th>Room No</th>
                <th>Advance Amount</th>
                <th>Monthly Fees</th>
                <th>Balance</th>
            </tr>
        </thead>
        <?php
        $total_sum = array();
        $ab_sum = array();
        $paid_sum = array();
        $bal_sum = array();
        $advance = 0;
        $par = 0;
        $bal = 0;
        if ($student_list[0]['roll_no']) {
            foreach ($student_list[0]['roll_no'] as $val) {
                ?>
                <tr>
                    <td>
                        <a href="#profile_img" data-toggle="modal"><img class="staff_thumbnail" src="<?= $this->config->item('base_url') ?>profile_image/student/thumb/<?= $val['image'] ?>" /></a>
                    </td>
                    <td><?= $val['roll_no'] ?></td>
                    <td><?= $val['name'] ?></td>
                    <td><?= $val['from'] ?></td>
                    <td><?= $val['department'] . '-' . $val['group'] ?></td>
                    <td><?= $student_list[0]['block'] ?></td>
                    <td><?= $val['room_name'] . '-' . $val['seat_no'] ?></td>
                    <td  style="text-align:right;">
                        Rs <?php
                        $advance = $advance + $val['advance_amount'];
                        echo $val['advance_amount'];
                        ?>
                    </td>
                    <td  style="text-align:right;">
                        Rs <?php
                        $par = $par + $student_list[0]['per_head'];
                        echo $student_list[0]['per_head'];
                        ?>
                    </td>
                    <td  style="text-align:right;">
                        Rs <?php
                        $bal = $bal + ($val['advance_amount'] - $student_list[0]['per_head']);
                        echo $val['advance_amount'] - $student_list[0]['per_head'];
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
                <th></th><th></th>
                <th style="text-align:right; color:#FFF;">Rs <?= $advance ?></th>
                <th style="text-align:right; color:#FFF;">Rs <?= $par ?></th>
                <th style="text-align:right; color:#FFF;">Rs <?= $bal ?></th>

            </tr>
        </tfoot>
    </table>
    <?php
}
?>
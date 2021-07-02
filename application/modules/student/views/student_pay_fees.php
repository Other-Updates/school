<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<div id='exam_info'>
    <div class="page-inner" style="padding-left: 0;"><div class="page-title"><span><h3>Term / Other Fees</h3></span> </div></div>

    <table class="table table-bordered table-striped dataTable" width="100%">
        <thead>
            <tr>
                <th>Year&nbsp;&nbsp;</th>
                <th>Bill Name&nbsp;&nbsp;</th>
                <th>From Date</th>
                <th>Due Date</th>
                <th>Amount&nbsp;&nbsp;</th>
                <th>Paid Amount</th>
                <th>Balance&nbsp;&nbsp;</th>
                <th>Status&nbsp;&nbsp;</th>
            </tr>
        </thead>
        <?php
        if (isset($fees_info[0]['exam_info']) && !empty($fees_info[0]['exam_info'])) {
            foreach ($fees_info[0]['exam_info'] as $val) {
                $complete_status = 0;
                if (isset($val['payment_history']) && !empty($val['payment_history'])) {
                    foreach ($val['payment_history'] as $pay_his) {
                        $complete_status = $pay_his['complete_status'];
                    }
                }
                ?>

                <?php
                $n_val = 0;
                if ($fees_info[0]['student_type'] == 2) {
                    if (isset($val['edit_amt']) && !empty($val['edit_amt']))
                        $n_val = $val['edit_amt'][0]['amount'];
                    else
                        $n_val = $val['amount'];
                }
                else {
                    if (isset($val['edit_amt']) && !empty($val['edit_amt']))
                        $n_val = $val['edit_amt'][0]['amount'];
                    else
                        $n_val = $val['amount'] + $val['management_amount'];
                }
                $f_amt = 0;
                if ($val['fain'] == 'yes') {
                    if (date('Y-m-d') > $val['due_date']) {
                        $datetime1 = date_create(date('Y-m-d'));
                        $datetime2 = date_create($val['due_date']);
                        $interval = date_diff($datetime1, $datetime2);
                        $days = $interval->format('%d');
                        if ($val['fain_type'] == 'day')
                            $f_amt = $val['fain_amount'] * $days;
                        else if ($val['fain_type'] == 'week') {
                            $per = $days / 7;
                            if (intval($per) > 0)
                                $f_amt = $val['fain_amount'] * intval($per);
                            else
                                $f_amt = $val['fain_amount'] + intval($per);
                        }
                        else if ($val['fain_type'] == 'month') {
                            $per = $days / 30;
                            if (intval($per) > 0)
                                $f_amt = $val['fain_amount'] * intval($per);
                            else
                                $f_amt = $val['fain_amount'] + intval($per);
                        }
                    }
                }
                ?>


                <?php $full_amt = $n_val + $f_amt ?>
                <?php
                $pay_history = array();
                if (isset($val['payment_history']) && !empty($val['payment_history'])) {
                    foreach ($val['payment_history'] as $pay_his) {
                        $pay_history[] = $pay_his['amount'];
                    }
                }
                $paid_amt = 0;
                $paid_amt = array_sum($pay_history);
                $bal_amt = $full_amt - $paid_amt;
                ?>
                <tr>
                    <th>Year-<?= $val['semester_id'] ?></th>
                    <th><?= $val['bill_name'] ?></th>
                    <th><?= date('d-M-Y', strtotime($val['from_date'])) ?></th>
                    <th><?= date('d-M-Y', strtotime($val['due_date'])) ?></th>
                    <th><?= $full_amt ?></th>
                    <th><?= $paid_amt ?></th>
                    <th><?= $bal_amt ?></th>
                    <th><label><?= ($complete_status == 1) ? 'Paid' : 'Pending' ?></label></th>
                </tr>
                <?php
            }
        } else
            echo "<tr><td colspan='8'>Data Not Found...</td></tr>";
        ?>
    </table>
</div>
<div id='hostel_info' >
    <div class="page-inner" style="padding-left: 0;"><div class="page-title"><span><h3>Hostel Fees</h3></span> </div></div>
    <table class="table table-bordered table-striped dataTable">
        <thead>
            <tr>
                <th>Month & Year</th>
                <th>From Date</th>
                <th>Due Date</th>
                <th>Food Fees</th>
                <th>Fine</th>
                <th>Total Amount</th>
                <th>Paid</th>
                <th>Status</th>
            </tr>
        </thead>
        <?php
        if (isset($my_monthly_fees[0]['monthly_fees']) && !empty($my_monthly_fees[0]['monthly_fees'])) {
            foreach ($my_monthly_fees[0]['monthly_fees'] as $val) {
                ?>
                <tr>
                    <td>
                        <?php
                        $month_arr = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                        foreach ($month_arr as $key => $val1) {
                            if ($key + 1 == $val['month'])
                                echo $val1;
                        }
                        echo '-' . $val['year'];
                        ?>
                    </td>
                    <td><?= date('d-M-Y', strtotime($val['from_date'])) ?></td>
                    <td><?= date('d-M-Y', strtotime($val['due_date'])) ?></td>
                    <td>
                        Rs <?= $val['per_head'] ?>
                        ( Rs <?= $val['per_day'] ?> / Day )
                    </td>
                    <td>
                        <?php
                        $f_amt = 0;
                        if ($val['fine_type'] == 'yes') {
                            if (date('Y-m-d') > $val['due_date']) {
                                $datetime1 = date_create(date('Y-m-d'));
                                $datetime2 = date_create($val['due_date']);
                                $interval = date_diff($datetime1, $datetime2);
                                $days = $interval->format('%d');

                                if ($val['fine_option'] == 'day')
                                    $f_amt = $val['fain_amount'] * $days;
                                else if ($val['fine_option'] == 'week') {
                                    $per = $days / 7;
                                    if (intval($per) > 0)
                                        $f_amt = $val['fain_amount'] * intval($per);
                                    else
                                        $f_amt = $val['fain_amount'] + intval($per);
                                }
                                else if ($val['fine_option'] == 'month') {
                                    $per = $days / 30;
                                    if (intval($per) > 0)
                                        $f_amt = $val['fain_amount'] * intval($per);
                                    else
                                        $f_amt = $val['fain_amount'] + intval($per);
                                }
                            }
                        }
                        echo $f_amt;
                        ?>
                    </td>
                    <td>
                        Rs <span id='net_<?= $val['id'] ?>'>
                            <?php
                            echo $val['per_head'] + $f_amt;
                            ?>
                        </span>
                    </td>
                    <td>
                        <?php
                        if (isset($val['payment_details'][0]['amount']) && !empty($val['payment_details'][0]['amount'])) {
                            echo "Rs " . $val['payment_details'][0]['amount'];
                            if ($val['payment_details'][0]['no_of_days_ap'] > 0) {
                                echo "( " . $val['payment_details'][0]['no_of_days_ap'] . " )";
                            }
                        } else
                            echo "Rs 0";
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($val['payment_details'][0]['amount']) && !empty($val['payment_details'][0]['amount'])) {
                            echo "Paid";
                        } else {
                            echo "Pending";
                        }
                        ?>
                    </td>

                </tr>

                <?php
            }
        } else
            echo "<tr><td colspan='9'>Data Not Found...</td></tr>";
        ?>
    </table>
</div>




<!--<div class="page-inner" style="padding-left: 0;"><div class="page-title"><span><h3>Placement Details</h3></span> </div></div>
<table  class="table table-bordered table-striped dataTable" >
    <thead>
        <tr>
            <th>Class</th>
            <th>%</th>
            <th>Company Name</th>
            <th>Venue</th>
            <th>Date</th>
            <th>Salary</th>
            <th>Eligibility Student</th>
            <th>Interested Student</th>
            <th>Placed Student</th>
            <th>Participated</th>
            <th>Placed</th>

        </tr>
    </thead>
<?php
$this->load->model('placement/placement_model');
if (isset($all_placement) && !empty($all_placement)) {
    foreach ($all_placement as $val) {
        $depart = $this->placement_model->get_department($val['department']);
        if (isset($depart) && !empty($depart))
            $deprt_name = $depart[0]['nickname'];
        else
            $deprt_name = '-';
        ?>
                    <tr>
                        <td><?= $deprt_name ?></td>
                        <td><?= $val['percentage'] ?></td>
                        <td><?= $val['company_name'] ?></td>
                        <td><?= $val['venue'] ?></td>
                        <td><?= $val['date'] ?></td>
                        <td><?= $val['salary'] ?></td>
                        <td><?= $val['eligibility_student'][0]['eligibility_student'] ?></td>
                        <td><?= $val['interested_student'][0]['interested_student'] ?></td>
                        <td><?= $val['placed_student'][0]['placed_student'] ?></td>
                        <td><?= ($val['participation'] == 1) ? 'Yes' : 'No' ?></td>
                        <td><?= ($val['placed'] == 1) ? 'Yes' : 'No' ?></td>

                    </tr>
        <?php
    }
} else
    echo "<tr><td colspan='9'>Data Not Found...</td></tr>";
?>
</table>-->




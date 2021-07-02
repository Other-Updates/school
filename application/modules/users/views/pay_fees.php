<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<link href="<?= $theme_path; ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/datatables/stu_data_table.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    table, td, th {
        font-size:10px;
    }
</style>
<div class="message-container">
    <div class="message-form-content">
        <div class="message-form-header">
            <div class="message-form-user">
                <img src="<?= $theme_path; ?>/images/icons/events/rs.png">
            </div>
            Fees
        </div>
        <div class="message-form-inner">
            <script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>

            <div id='exam_info'>
                <div class="page-inner" style="padding-left: 0;"><div class="page-title"><span>Term / Other Fees</span> </div></div>
                <br />
                <table id="example1" class="table table-bordered table-striped" width="100%">
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
                            <th>Action&nbsp;&nbsp;</th>
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
                                <th>
                                    <?php
                                    if ($complete_status == 1) {
                                        ?>
                                        <a href="<?= $this->config->item('base_url') ?>users/view_fees/<?= $val['id'] ?>" style="text-decoration:none" class="btn btn-danger btn-sm">Payment History</a>
                                    <?php } else { ?>
                                        <a href="<?= $this->config->item('base_url') ?>users/view_fees/<?= $val['id'] ?>" style="text-decoration:none"class="btn btn-danger btn-sm">View More</a>
                                        <?php
                                    }
                                    ?>
                                </th>
                            </tr>

                            <?php
                        }
                    }
                    ?>
                </table>
                <br />
            </div>
            <br />
            <div id='hostel_info' style="display:none">
                <div class="page-inner" style="padding-left: 0;"><div class="page-title"><span>Hostel Fees</span> </div></div>
                <br />
                <table id="example3" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>Bill Name</th>
                            <th>From Date</th>
                            <th>Due Date</th>
                            <th>Amount</th>
                            <th>Paid Amount</th>
                            <th>Balance&nbsp;&nbsp;</th>
                            <th>Status&nbsp;&nbsp;</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <?php
                    if (isset($fees_info[0]['hostel_info']) && !empty($fees_info[0]['hostel_info'])) {
                        foreach ($fees_info[0]['hostel_info'] as $val) {
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
                                <th><?= $val['bill_name'] ?></th>
                                <th><?= date('d-M-Y', strtotime($val['from_date'])) ?></th>
                                <th><?= date('d-M-Y', strtotime($val['due_date'])) ?></th>
                                <th><?= $full_amt ?></th>
                                <th><?= $paid_amt ?></th>
                                <th><?= $bal_amt ?></th>
                                <th><label><?= ($complete_status == 1) ? 'Paid' : 'Pending' ?></label></th>
                                <th>
                                    <?php
                                    if ($complete_status == 1) {
                                        ?>
                                        <a href="<?= $this->config->item('base_url') ?>users/view_hostel_fees/<?= $val['id'] ?>" style="text-decoration:none" class="btn btn-danger btn-sm">Payment History</a>
                                    <?php } else { ?>
                                        <a href="<?= $this->config->item('base_url') ?>users/view_hostel_fees/<?= $val['id'] ?>" style="text-decoration:none"class="btn btn-danger btn-sm">View More</a>
                                        <?php
                                    }
                                    ?>
                                </th>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
                <br />

            </div>
            <div id='transport_info' style="display:none;">
                <div class="page-inner" style="padding-left: 0;"><div class="page-title"><span>Transport Fees</span> </div></div>
                <?php
                if (isset($fees_info[0]['transport_info']) && !empty($fees_info[0]['transport_info'])) {
                    foreach ($fees_info[0]['transport_info'] as $val) {
                        $complete_status = 0;
                        if (isset($val['payment_history']) && !empty($val['payment_history'])) {
                            foreach ($val['payment_history'] as $pay_his) {
                                $complete_status = $pay_his['complete_status'];
                            }
                        }
                        ?>
                        <div id='ex_div_<?= $val['id'] ?>' class="view_table">
                            <?php
                            if ($complete_status == 0) {
                                ?>
                                <table width="100%">
                                    <tr><td colspan="2"><?= $val['bill_name'] ?></td></tr>
                                    <tr><td>From Date</td><td class="text_bold green"><?= date('d-m-Y', strtotime($val['from_date'])) ?></td></tr>
                                    <tr><td>Due Date</td><td class="text_bold"><?= date('d-m-Y', strtotime($val['due_date'])) ?></td></tr>
                                    <?php
                                    $n_val = 0;
                                    if ($fees_info[0]['student_type'] == 2) {
                                        if (isset($val['edit_amt']) && !empty($val['edit_amt']))
                                            $n_val = $val['edit_amt'][0]['amount'];
                                        else
                                            $n_val = $val['amount'];
                                        ?>
                                        <tr><td>Amount</td><td class="text_bold">
                                                <?= $n_val ?>
                                                <input type="button"  class='edit_btn' id='edit_btn_<?= $val['id'] ?>' value='Edit' />
                                                <input type="text" placeholder="Amount" class='edit_amt' id='edit_amt_<?= $val['id'] ?>' style="display:none;" />
                                                <input type="text" placeholder="Reason" class='edit_text' id='edit_text_<?= $val['id'] ?>' style="display:none;" />
                                            </td></tr>
                                        <?php
                                    }else {
                                        if (isset($val['edit_amt']) && !empty($val['edit_amt']))
                                            $n_val = $val['edit_amt'][0]['amount'];
                                        else
                                            $n_val = $val['amount'] + $val['management_amount'];
                                        ?>
                                        <tr><td>Amount</td><td class="text_bold">
                                                <?= $n_val ?>
                                                <input type="button" class='edit_btn1' id='edit_btn1_<?= $val['id'] ?>' value='Edit' />
                                                <input type="text" placeholder="Amount" class='edit_amt' id='edit_amt_<?= $val['id'] ?>' style="display:none;" />
                                                <input type="text"  placeholder="Reason" class='edit_text' id='edit_text_<?= $val['id'] ?>' style="display:none;" />
                                            </td></tr>
                                    <?php } ?>
                                    <tr>
                                    <input type="hidden" value="<?= $n_val ?>" id='bill_amt_<?= $val['id'] ?>' >
                                    <td>Fine</td>
                                    <td class="text_bold">
                                        <?php
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
                                            ?>
                                            <span id='ful_fine_<?= $val['id'] ?>'><?= $f_amt ?></span> (<?= $val['fain_amount'] . ' / ' . ucfirst($val['fain_type']) ?>)

                                        <?php }else { ?>
                                            <span id='ful_fine_<?= $val['id'] ?>'>0</span>
                                        <?php } ?>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Total
                                        </td>
                                        <td class="text_bold">
                                            <?php $full_amt = $n_val + $f_amt ?>
                                            <span id='fulamt_text_<?= $val['id'] ?>'><?= $full_amt ?></span>
                                            <input type="hidden" value="<?= $full_amt ?>" id='ful_amt_<?= $val['id'] ?>' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Paid Amount
                                        </td>
                                        <td class="text_bold">
                                            <?php
                                            $pay_history = array();
                                            if (isset($val['payment_history']) && !empty($val['payment_history'])) {
                                                foreach ($val['payment_history'] as $pay_his) {
                                                    $pay_history[] = $pay_his['amount'];
                                                }
                                            }
                                            $paid_amt = 0;
                                            $paid_amt = array_sum($pay_history)
                                            ?>
                                            <span id='paid_text_<?= $val['id'] ?>'><?= $paid_amt ?></span>
                                            <input type="hidden" value="<?= $paid_amt ?>" id='paid_amt_<?= $val['id'] ?>' />
                                            <a href="#history_<?= $val['id'] ?>" data-toggle="modal" title="In-Active" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Payment Mode</td>
                                        <td class="text_bold">
                                            <select  id='p_mode_<?= $val['id'] ?>' class='payment_mode'>
                                                <option value=''>Select</option>
                                                <option selected="selected" value='1'>Cash</option>
                                                <option value='2'>Cheque</option>
                                                <option value='3'>DD</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr  id='p_amt_<?= $val['id'] ?>'>
                                        <td>Paying Amount</td>
                                        <td class="text_bold">
                                            <input type="hidden" value="<?= $fees_info[0]['std_id'] ?>" id='roll_no_<?= $val['id'] ?>' />
                                            <input type="text" class='pay_amt' id='pay_amt_<?= $val['id'] ?>' />
                                            <input type="text" value="<?= $full_amt - $paid_amt ?>" readonly="readonly" id='bal_amt_<?= $val['id'] ?>'  placeholder="Balance" />
                                            <input type="button" value="Pay"  id='pay_btn_<?= $val['id'] ?>' class="btn btn-primary pay_btn" />
                                            <input type="button" value="Complete" style="display:none"  id='com_btn_<?= $val['id'] ?>' class="btn btn-warning com_pay"/>
                                        </td>
                                    </tr>
                                    <tr  id='p_del_<?= $val['id'] ?>' style="display:none">
                                        <td>Payment Details</td>
                                        <td class="text_bold">

                                            <input type="text" id='pay_bank_<?= $val['id'] ?>'   placeholder="Bank Name"/>
                                            <input type="text" id='pay_branch_<?= $val['id'] ?>'  placeholder="Brach"/>
                                            <input type="text" id='pay_cheque_<?= $val['id'] ?>'   placeholder="Cheque / DD No"/>
                                            <input type="text"  class='pay_1amt' id='pay_1amt_<?= $val['id'] ?>' placeholder="Paying Amount"/>
                                            <input type="text" value="<?= $full_amt - $paid_amt ?>"  readonly="readonly" id='bal_1amt_<?= $val['id'] ?>'  placeholder="Balance" />
                                            <input type="button" value="Pay" id='pay_1btn_<?= $val['id'] ?>'  class="btn btn-success pay_btn" />
                                            <input type="button" value="Complete" style="display:none"  id='com_1btn_<?= $val['id'] ?>' class="btn btn-warning com_pay"/>
                                        </td>
                                    </tr>
                                </table>
                                <?php
                            } else {
                                ?>
                                <table>
                                    <tr>
                                        <td width="272"><?= $val['bill_name'] ?></td>
                                        <td>Amount Paid Successfully...</td>
                                        <td><a href="#history_<?= $val['id'] ?>" data-toggle="modal" title="In-Active" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a></td>
                                    </tr>
                                </table>
                                <?php
                            }
                            ?>
                            <br />
                        </div>
                        <?php
                    }
                } else
                    echo "No Transport Fees for this Student...";
                ?>
            </div>
        </div>
    </div>
</div>
<!-- DATA TABES SCRIPT -->
<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#example1").dataTable();
        $("#example4").dataTable();
        $("#example5").dataTable();
        $("#example3").dataTable();
        $("#example4").dataTable();
        $("#example5").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });

    $('.public').live('click', function () {
        $('.pub').show();

    });
    $('.hid').live('click', function () {
        $('.pub').hide();
    });
</script>
<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<?php
if (isset($balance) && !empty($balance))
    echo "";
else {
    ?>
    <table class="staff_table">
        <tr>
            <td width="40%">Academic Year</td>
            <td width="10">:</td>
            <td class="text_bold">
                <?= $fees_info[0]['from']; ?>
            </td>
        </tr>
        <tr>
            <td>Class</td>
            <td>:</td>
            <td class="text_bold">
                <?= $fees_info[0]['department'] ?>
            </td>
        </tr>
        <tr>
            <td>Term</td>
            <td>:</td>
            <td class="text_bold">
                Year-<?= $fees_info[0]['semester_id'] ?>
            </td>
        </tr>
    </table>
<?php } ?>
<table class="staff_table">
    <tr>
        <td width="40%">Bill Name</td>
        <td width="10">:</td>
        <td class="text_bold"><?= $fees_info[0]['bill_name'] ?></td>
    </tr>
    <tr>
        <td>From Date</td>
        <td>:</td>
        <td class="text_bold"><?= date('d-M-Y', strtotime($fees_info[0]['from_date'])) ?></td>
    </tr>
    <tr>
        <td>Due Date</td>
        <td>:</td>
        <td class="text_bold"><?= date('d-M-Y', strtotime($fees_info[0]['due_date'])) ?></td>
    </tr>
    <?php
    if (isset($fees_info[0]['fees_details']) && !empty($fees_info[0]['fees_details'])) {
        foreach ($fees_info[0]['fees_details'] as $val) {
            if ($val['master_option'] == 'on') {
                ?>
                <tr>
                    <td><?= $val['fees_name'] ?></td>
                    <td>:
                    </td>
                    <td class="text_bold">Rs <?= $val['amount'] ?></td>
                </tr>
                <?php
            }
        }
    }
    ?>
    <tr>
        <td>Total Amount</td>
        <td>:</td>
        <td class="text_bold">Rs <?= $fees_info[0]['amount'] ?></td>
    </tr>
    <tr  style="visibility:<?= ($fees_info[0]['management_amount'] == 0) ? 'hidden' : '' ?>;">
        <td>Management</td>
        <td>:</td>
        <td class="text_bold">Rs <?= $fees_info[0]['management_amount'] ?></td>
    </tr>
    <tr style="visibility:<?= ($fees_info[0]['management_amount'] == 0) ? 'hidden' : '' ?>;">
        <td>Total Amount for Management</td>
        <td>:</td>
        <td class="text_bold">Rs <?= $fees_info[0]['amount'] + $fees_info[0]['management_amount'] ?></td>
    </tr>
    <tr>
        <td>Fine</td>
        <td>:</td>
        <td class="text_bold">
            <?= ($fees_info[0]['fain'] == 'yes') ? 'Yes' : 'No' ?>

        </td>
    </tr>

    <tr class='amt_tr' style="display:<?= ($fees_info[0]['fain'] == 'no') ? 'none' : '' ?>">
        <td>Fine Type</td>
        <td>:</td>
        <td class="text_bold">Rs <?= $fees_info[0]['fain_amount'] ?> / <?= ucfirst($fees_info[0]['fain_type']) ?></td>
    </tr>
</table><br />
<div class="right">
    <?php
    if (isset($balance) && !empty($balance))
        echo "";
    else {
        ?>
        <?php
        if ($fees_info[0]['status'] == 1) {
            ?>
            <a href="<?= $this->config->item('base_url') . 'fees/update_exam_fees_view/' . $fees_info[0]['id'] . '/2/exam_fees' ?>" title="Verified" class="btn bg-maroon">
                Verified
            </a>
        <?php } else if ($fees_info[0]['status'] == 2) { ?>
            <input type="button" disabled="disabled" class="btn bg-maroon" value='Verified'/>
            <a href="<?= $this->config->item('base_url') . 'fees/update_exam_fees_view/' . $fees_info[0]['id'] . '/3/exam_fees' ?>" title="Closed" class="btn btn-danger">Closed</a>

        <?php } else if ($fees_info[0]['status'] == 3) { ?>
            <input type="button" disabled="disabled" class="btn btn-danger" value='Closed'/>
        <?php } ?>
    <?php } ?>
</div><br /><br />
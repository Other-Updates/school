<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
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
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Seat No</th>
            <th>Roll No</th>
            <th>Name</th>
            <th>Academic Year</th>
            <th>Class</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    $i = 1;
//echo "<pre>";print_r($seat_info);exit;
    foreach ($seat_info[0]['seat_info'] as $val) {
        if (isset($val[0]['name']) && !empty($val[0]['name'])) {
            //print_r($val);exit;
            ?>
            <tr>
                <td>Seat<?= $i ?></td>
                <td><?= $val[0]['std_id'] ?></td>
                <td><?= $val[0]['name'] ?></td>
                <td><?= $val[0]['from'] ?></td>
                <td><?= $val[0]['department'] . '-' . $val[0]['group'] ?></td>
                <td>
                    <?php
                    if ($roll_no == $val[0]['std_id']) {
                        ?>
                        <input type="button" class="btn btn-primary btn-sm" disabled="disabled" value='Current Position'/>
                    <?php } else { ?>
                        <input type="button" id="seat<?= $i ?>" class="btn btn-primary btn-sm replace_btn <?= $val[0]['seat_id'] ?>" value='Replace'/>
                    <?php } ?>
                </td>
            </tr>
            <?php
        } else {
            ?>
            <tr>
                <td>Seat<?= $i ?></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td><input type="button" class="btn btn-sm btn-success seat_btn" id="seat<?= $i ?>" value='Book'/></td>
            </tr>

            <?php
        }
        $i++;
    }
    ?>
</table>
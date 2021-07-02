<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template');
?>
<table class="staff_table">
    <tr>
        <td width="20%">Academic year</td>
        <td width="30%" class="text_bold"><?= $get_info[0]['batch_info'][0]['from']; ?></td>
        <td width="20%">Class</td>
        <td width="30%" class="text_bold"><?= $get_info[0]['department'] ?></td>
    </tr>
    <tr>
        <td>Section</td>
        <td class="text_bold"><?= $get_info[0]['group'] ?></td>
        <td></td>
        <td class="text_bold"></td>
    </tr>
</table>
<table class="table table-bordered table-striped dataTable">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Roll No</th>
            <th>Name</th>
            <?php
            if (isset($all_sem) && !empty($all_sem)) {
                foreach ($all_sem as $val) {
                    ?>
                    <td><?= $val['semester'] ?></td>
                    <?php
                }
            }
            ?>
            <td>CGPA</td>
            <td>Mark Sheet</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (isset($all_cgpa) && !empty($all_cgpa)) {
            foreach ($all_cgpa as $val) {
                $total = array();
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $val['roll_no'] ?></td>
                    <td><?= ucfirst($val['name']) ?></td>
                    <?php
                    $j = 0;
                    if (isset($val['semester']) && !empty($val['semester'])) {
                        foreach ($val['semester'] as $val2) {
                            ?>
                            <td><?php
                                echo $val2['total_cgp'][0]['total_cgb'];
                                $total[] = $val2['total_cgp'][0]['total_cgb'];
                                ?>
                            </td>
                            <?php
                            $j++;
                        }
                    }
                    ?>
                    <td>
                        <?= round(array_sum($total) / $j, 2) ?>
                    </td>
                    <td>
                        <a href="<?= $this->config->item('base_url') . 'internal/mark_sheet/' . $val['id'] ?>" title="Mark Sheet" target="_blank" class="btn bg-navy btn-sm" >View</a>

                    </td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>
<div class="admin_print_use">
    <input type="button" value='Print' class="btn btn-primary print_btn right"/>
    <br /><br />
</div>
<script type="text/javascript">
    $('.print_btn').live('click', function () {
        window.print();
    });
</script>
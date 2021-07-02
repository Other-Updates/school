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
        <td>Exam</td>
        <td class="text_bold"><?= $all_sem[0]['exam'] ?></td>
    </tr>
</table>
<table class="table table-bordered table-striped dataTable">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Roll No</th>
            <th>Name</th>
            <td>CGPA</td>
            <td class="header">Mark Sheet</td>
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
                    if (isset($val['exam']) && !empty($val['exam'])) {
                        foreach ($val['exam'] as $val2) {
                            $total[] = $val2['total'][0]['total'];
                            $j++;
                        }
                    }
                    ?>
                    <td>
                        <?= round(array_sum($total) / $j, 2) ?>
                    </td>
                    <td class="header">
                        <a href="<?= $this->config->item('base_url') . 'internal/mark_sheet_cbse/' . $val['id'] . '/' . $val2['exam_id'] ?>" title="Mark Sheet" target="_blank" class="btn bg-navy btn-sm" >View</a>

                    </td>

                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>
<br />
<table  class="table table-bordered table-striped dataTable">
    <thead>
        <tr>
            <th>Letter Grade</th>
            <th>Grade Point</th>
            <th>Mark Range</th>
        </tr>
    </thead>
    <tr><td>A1</td><td>10</td><td>91-100</td></tr>
    <tr><td>A2</td><td>9</td><td>81-90</td></tr>
    <tr><td>B1</td><td>8</td><td>71-80</td></tr>
    <tr><td>B2</td><td>7</td><td>61-70</td></tr>
    <tr><td>C1</td><td>6</td><td>51-60</td></tr>
    <tr><td>C2</td><td>5</td><td>41-50</td></tr>
    <tr><td>D</td><td>4</td><td>33-40</td></tr>
    <tr><td>E1</td><td>2</td><td>21-32</td></tr>
    <tr><td>E2</td><td>0</td><td> < 50 </td></tr>
</table>
<div class="admin_print_use header">
    <input type="button" value='Print' class="btn btn-primary print_btn right"/>
    <br /><br />
</div>
<script type="text/javascript">
    $('.print_btn').live('click', function () {
        window.print();
    });
</script>
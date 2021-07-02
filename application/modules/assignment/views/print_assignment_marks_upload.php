<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<br />

<div id="ass_view_closed">
    <?php //echo "<pre>"; print_r($sub_ass); exit; ?>
    <table class="staff_table">
        <tr>
            <td>Academic Year</td><td class="text_bold"><?php echo $sub_ass[0]['from']; ?></td><td>Term</td><td class="text_bold"><?php echo $sub_ass[0]['semester'][0]['semester']; ?></td><td>Class</td><td class="text_bold"><?php echo $sub_ass[0]['department']; ?></td>
        </tr>
        <tr>
            <td>Section</td><td class="text_bold"><?php
                if (isset($sub_ass[0]['group'][0]['group'])) {
                    echo $sub_ass[0]['group'][0]['group'];
                }
                ?></td><td>Subject</td><td class="text_bold"><?php echo $sub_ass[0]['subject'][0]['subject_name']; ?></td><td>Project Number</td><td class="text_bold"><?php echo $sub_ass[0]['ass_details'][0]['ass_number']; ?></td>
        </tr>
    </table>
    <p></p>
    <table class="table table-bordered table-striped dataTable">
        <thead>
            <tr>
                <th width="2%">S.No</th>
                <th>Roll No</th>
                <th>Name</th>
                <th>Subject name</th>
                <th>File Name</th>
                <th>Submitted Date</th>
                <th>Marks</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($sub_ass) && !empty($sub_ass)) {
                $i = 0;
                foreach ($sub_ass as $row) {
                    $i++;
                    if (isset($row['student'][0]) && !empty($row['student'][0])) {
                        ?>



                        <tr>
                            <td><?= $i ?></td>
                            <td><?php echo $row['student'][0]['std_id']; ?></td>

                            <td><?php echo $row['student'][0]['name']; ?></td>


                            <td><?php echo $row['subject'][0]['nick_name']; ?></td>
                            <td><?php
                                if (isset($row['ass_file'][0])) {
                                    ?>
                                    <?php echo $row['ass_file'][0]['file_name']; ?>
                                    <?php
                                } else {

                                }
                                ?></td>
                            <td><?php
                                if (isset($row['ass_file'][0])) {
                                    echo date('d-M-Y', strtotime($row['ass_file'][0]['sub_date']));
                                }
                                ?></td>
                            <td><?php
                                if (isset($row['ass_details'][0])) {
                                    if ($row['ass_file']) {
                                        echo $row['ass_file'][0]['score'] . "/" . $row['ass_details'][0]['total'];
                                    } else {
                                        echo "0/" . $row['ass_details'][0]['total'];
                                    }
                                } else {

                                }
                                ?></td>




                        </tr>


                        <?php
                    }
                }
            }
            ?>
        </tbody>

    </table>
</div>
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


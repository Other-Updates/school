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

<table width="100%" class=" all vie_stf table table-bordered table-striped dataTable" id="example7" style="display:none">
    <thead>
        <tr><th width="10%">S.no </th>
            <th>Subject Code</th>
            <th>Subject</th>
            <!--<th>Nick Name</th>-->
            <th>Total / Credits</th>
            <th>Pass Mark</th>
            <th>Practical Mark</th>
            <th>Practical Pass Mark</th>
            <!--<th>Staff Name</th>-->
            <th>Class</th>
            <th>Section</th>
            <th>Board</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        if (isset($sub_view) && !empty($sub_view)) {

            foreach ($sub_view as $val) {
                ?>

                <tr><td><?= $i + 1; ?></td>
                    <td><?= $val['scode'] ?></td>
                    <td><?= $val['subject_name'] ?></td>
                    <!--<td><?= $val['nick_name'] ?></td>-->
                    <td><?= $val['grade_point'] ?></td>
                    <td><?= ($val['pass_mark'] != '' && $val['pass_mark'] != 0) ? $val['pass_mark'] : '-'; ?></td>
                    <td><?= ($val['practical_mark'] != '' && $val['practical_mark'] != 0) ? $val['practical_mark'] : '-'; ?></td>
                    <td><?= ($val['practical_pass_mark'] != '' && $val['practical_pass_mark'] != 0) ? $val['practical_pass_mark'] : '-'; ?></td>
                    <!--<td><?= $val['staff_name'] ?></td>-->
                    <td><?= $val['nickname'] ?></td><td><?= $val['group'] ?></td>
                    <td><?= $val['board_type'] ?></td>
                </tr>
                <?php
                $i++;
            }
        } else
            echo "<tr><td colspan='10' aline='center'>No records available</td> </tr>"
            ?>
    </tbody>
</table>


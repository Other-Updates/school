<style type="text/css">
    // @media print{@page {size: landscape}}
</style>
<?php
$user_info = $this->session->userdata('user_info');
$this->load->model('admin/admin_model');
$mark_info = $this->admin_model->get_internal_details();
?>
<!--<script src="<?= $theme_path; ?>/js/highcharts.js"></script>
<script src="<?= $theme_path; ?>/js/drilldown.src.js"></script>-->
<br />
<div class="row">
    <div class="six columns">
        <table class="view_table" width="100%">
            <tr>
                <td width="40%">Roll No</td>
                <td class="text_bold" style="color:red"><?= $user_info[0]['std_id'] ?></td>
            </tr>
            <tr>
                <td>Batch</td>
                <td class="text_bold"><?= $user_info[0]['from']; ?></td>
            </tr>
            <tr>
                <td>Semester</td>
                <td class="text_bold"><?php
                    if (isset($all_info[0]['semester'])) {
                        echo $all_info[0]['semester'];
                    }
                    ?></td>
            </tr>
        </table>
    </div>
    <div class="six columns">
        <table class="view_table" width="100%">
            <tr>
                <td width="40%">Student Name</td>
                <td class="text_bold"><?= ucfirst($user_info[0]['name']) ?></td>
            </tr>
            <tr>
                <td>Department</td>
                <td class="text_bold"><?= $user_info[0]['department'] . '-' . $user_info[0]['group'] ?></td>
            </tr>
            <tr>
                <td>Join Date</td>
                <td class="text_bold"><?= date('d-m-Y', strtotime($user_info[0]['join_date'])) ?></td>
            </tr>
        </table>
    </div>
</div>

<br /><br />
<div class="full_width">
    <table  class="table table-bordered table-striped  my_table_style">
        <thead>
            <tr>
                <th>Roll No</th>
                <th>Student Name</th>
                <?php
                $sum = array();
                $sum1 = array();

                if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
                    foreach ($all_subject[0]['subject'] as $val) {
                        ?>
                        <th colspan="<?php echo ($val['check_practical'] == 1) ? 2 : 0 ?>">
                            <?= ucwords($val['nick_name']); ?> - Theory( <?php echo $sum[] = ($val['grade_point']) ?> )

                            <?php if ($val['check_practical'] == 1) { ?>

                                - Practical( <?php echo $sum1[] = ($val['practical_mark']); ?> )


                            <?php }
                            ?>
                        </th>

                        <?php
                    }
                }
                ?>
                <th>Total - ( <?php echo round((array_sum($sum) + array_sum($sum1))) ?> )

                </th>
                <th>Result</th>
            </tr>
            <tr>
                <th></th>
                <th></th>

                <?php
                if (isset($all_subject[0]['subject']) && !empty($all_subject[0]['subject'])) {
                    foreach ($all_subject[0]['subject'] as $val) {
                        ?>
                        <th  colspan="<?php echo ($val['check_practical'] == 1) ? 2 : 0 ?>">
                            Pass Mark - Theory( <?php echo $val['pass_mark'] ?> )
                            <?php if ($val['check_practical'] == 1) { ?>
                                - Practical( <?php echo $sum1[] = ($val['practical_pass_mark']) ?> )
                            <?php }
                            ?>
                        </th>
                        <?php
                    }
                }
                ?>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <?php
        if (isset($all_grade[0]['external_details']) && !empty($all_grade[0]['external_details'])) {
            ?>

            <?php
            $j = 1;
            $i = 0;
            foreach ($all_grade[0]['external_details'] as $val) {
                ?>
                <tr>
                    <td>
                        <?php echo ucwords($val['roll_no']); ?>

                    </td>
                    <td>
                        <?php echo ucwords($val['name']); ?>
                    </td>
                    <?php
                    if (isset($val['grade_details']) && !empty($val['grade_details'])) {
                        foreach ($val['grade_details'] as $val1) {
                            ?>
                            <td>
                                <?php echo $val1['grade_point']; ?>
                            </td>

                            <?php if ($val1['practical_mark'] != '') { ?>
                                <td>
                                    <?php echo $val1['practical_mark'] ?>
                                </td>

                            <?php } ?>
                            <?php
                        }
                    }
                    ?>
                    <td><?= $val1['total'] ?></td>
                    <td><label class="btn btn-<?php echo ($val1['result'] == '1') ? 'success' : 'danger' ?> btn-sm"><?php echo ($val1['result'] == '1') ? 'Pass' : 'Fail' ?></label></td>
                </tr>
                <?php
                $j++;
            }
        } else
            echo "<tr><td colspan=15'>Student Not Created Yet..</td></tr>";
        ?>
    </table>

</div>

<div id="container1" style="height: 300px"></div>
<div id="container2" style="height: 300px; width: 600px; margin: 0 auto"></div>
<!--<script type="text/javascript">
// Internationalization
    Highcharts.setOptions({
        lang: {
            drillUpText: 'â—? Back to {series.name}'
        }
    });

    var options = {
        chart: {
            height: 300
        },
        title: {
            //text: 'Internal Mark Details'
        },
        xAxis: {
            categories: true
        },
        /*
         drilldown: {
         series: [{
         id: 'fruits',
         name: 'Fruits',
         data: [
         ['Apples', 4],
         ['Pears', 6],
         ['Oranges', 2],
         ['Grapes', 8]
         ]
         }, {
         id: 'cars',
         name: 'Cars',
         data: [{
         name: 'Toyota',
         y: 4,
         drilldown: 'toyota'
         },
         ['Volkswagen', 3],
         ['Opel', 5]
         ]
         }, {
         id: 'toyota',
         name: 'Toyota',
         data: [
         ['RAV4', 3],
         ['Corolla', 1],
         ['Carina', 4],
         ['Land Cruiser', 5]
         ]
         }]
         },
         */
        legend: {
            enabled: false
        },
        /*
         plotOptions: {
         series: {
         dataLabels: {
         enabled: true
         },
         shadow: false
         },
         pie: {
         size: '80%'
         }
         },*/

        series: [{
                name: 'Internals',
                colorByPoint: true,
<?= $data ?>
            }]
    };

// Column chart
    options.chart.renderTo = 'container1';
    options.chart.type = 'column';
    var chart1 = new Highcharts.Chart(options);

// Pie
    options.chart.renderTo = 'container2';
    options.chart.type = 'pie';
    var chart2 = new Highcharts.Chart(options);
</script>

<p class="user_print_use">
    <input type="button"  class='btn btn-primary print_btn right' value="Print" />
</p>-->
<script type="text/javascript">
    $(document).ready(function () {

        // window.print();

    });
</script>


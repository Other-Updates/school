<style type="text/css">
    @media print{@page {size: landscape}}
</style>
<?php
$user_info = $this->session->userdata('user_info');
$this->load->model('admin/admin_model');
$mark_info = $this->admin_model->get_internal_details();
?>
<script src="<?= $theme_path; ?>/js/highcharts.js"></script>
<script src="<?= $theme_path; ?>/js/drilldown.src.js"></script>
<br />
<div class="row">
    <div class="six columns">
        <table class="view_table" width="100%">
            <tr>
                <td width="40%">Roll No</td>
                <td class="text_bold" style="color:red"><?= $user_info[0]['std_id'] ?></td>
            </tr>
            <tr>
                <td>Academic Year</td>
                <td class="text_bold"><?= $user_info[0]['from']; ?></td>
            </tr>
            <tr>
                <td>Term</td>
                <td class="text_bold"><?= $all_info[0]['semester'] ?></td>
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
                <td>Class</td>
                <td class="text_bold"><?= $user_info[0]['department'] . '-' . $user_info[0]['group'] ?></td>
            </tr>
            <tr>
                <td>Subject</td>
                <td class="text_bold"><?= $all_info[0]['subject_name'] ?></td>
            </tr>
        </table>
    </div>
</div>

<br /><br />
<table width="100%" class="my_table_style">
    <thead>
        <tr>
            <th></th>
            <?php
            $int_total = explode(",", $all_info[0]['internal_total']);
            $int = explode(",", $all_info[0]['internals']);
            $count = -1;
            if (isset($int_total) && !empty($int_total)) {
                foreach ($int_total as $key => $val) {
                    $count++;
                }
            }
            ?>
            <th colspan="<?= $count ?>">Marks</th>
            <th>Total</th>
        </tr>
    </thead>
    <tr>
        <td><strong>Internals</strong></td>
        <?php
        $int_total = explode(",", $all_info[0]['internal_total']);
        $int = explode(",", $all_info[0]['internals']);
        $ii = count($int_total) - 1;
        unset($int_total[$ii]);
        if (isset($int_total) && !empty($int_total)) {
            foreach ($int_total as $key => $val) {
                if ($int[$key] != '') {
                    ?>
                    <td>
                        <?= $int[$key] . '/' . $val ?>
                    </td>
                    <?php
                } else {
                    ?>
                    <td>
                        -
                    </td>
                    <?php
                }
            }
        }
        ?>
        <td class="green"><?= $all_info[0]['internals_total'] ?></td>
    </tr>
    <tr style="display:none;">
        <td><strong>Model</strong></td>
        <td colspan="<?= $count ?>"><?= ($all_info[0]['model'] != 0) ? $all_info[0]['model'] . '/' . $mark_info[0]['model_mark'] : '-' ?></td>
        <td class="green"><?= $all_info[0]['model_total'] ?></td>
    </tr>
    <tr>
        <td><strong>Assignment</strong></td>
        <td colspan="<?= $count ?>"></td>
        <td class="green"><?= round($all_info[0]['assignment'], 2) ?></td>
    </tr>
    <tr>
        <td><strong>Attendance</strong></td>
        <td colspan="<?= $count ?>"></td>
        <td class="green"><?= round($all_info[0]['attendance'], 2) ?></td>
    </tr>
    <tr style="display:none;">
        <td ><strong>External</strong></td>
        <td colspan="<?= $count ?>"></td>
        <td class="green"><?= $all_info[0]['exam_mark'] ?></td>
    </tr>
    <tr>
        <td><strong>Internal Total</strong></td>
        <td colspan="<?= $count ?>"></td>
        <td class="red"><?= round($all_info[0]['total'], 2) ?></td>
    </tr>
    <tr>
        <td><strong>Grade Point</strong></td>
        <td colspan="<?= $count ?>"></td>
        <td class="<?= ($all_info[0]['subject_grade'][0]['grade'] == 0) ? 'red' : 'green' ?>">
            <?php
            if ($all_info[0]['subject_grade'][0]['grade'] == 10)
                echo "S";
            else if ($all_info[0]['subject_grade'][0]['grade'] == 9)
                echo "A";
            else if ($all_info[0]['subject_grade'][0]['grade'] == 8)
                echo "B";
            else if ($all_info[0]['subject_grade'][0]['grade'] == 7)
                echo "C";
            else if ($all_info[0]['subject_grade'][0]['grade'] == 6)
                echo "D";
            else if ($all_info[0]['subject_grade'][0]['grade'] == 5)
                echo "E";
            else if ($all_info[0]['subject_grade'][0]['grade'] == 0)
                echo "U";
            echo " - ";
            echo round($all_info[0]['subject_grade'][0]['grade'], 2)
            ?></td>
    </tr>
</table>

<?php
$data = "data: [";

$data = $data . "{";
$data = $data . "name: 'Internals',";
$data = $data . "y: " . $all_info[0]['internals_total'] . "";
$data = $data . "},";

/* $data=$data."{";
  $data=$data."name: 'Model',";
  $data=$data."y: ".$all_info[0]['model_total']."";
  $data=$data."},"; */

$data = $data . "{";
$data = $data . "name: 'Assignment',";
$data = $data . "y: " . $all_info[0]['assignment'] . "";
$data = $data . "},";

$data = $data . "{";
$data = $data . "name: 'Attendance',";
$data = $data . "y: " . $all_info[0]['attendance'] . "";
$data = $data . "}";

/* $data=$data."{";
  $data=$data."name: 'External',";
  $data=$data."y: ".$all_info[0]['exam_mark']."";
  $data=$data."}"; */

$data = $data . "]";
?>

<div id="container1" style="height: 300px"></div>
<div id="container2" style="height: 300px; width: 600px; margin: 0 auto"></div>
<script type="text/javascript">
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
            text: 'Internal Mark Details'
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
                name: 'Marks',
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
</p>
<script type="text/javascript">
    $(document).ready(function () {
        $('.print_btn').click(function () {
            window.print();
        });
    });
</script>
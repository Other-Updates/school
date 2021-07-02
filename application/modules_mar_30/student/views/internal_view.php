<!--<style type="text/css">
@media print{@page {size: landscape}}
</style>-->
<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?> 
<?php
	$this->load->model('admin/admin_model');
	$mark_info=$this->admin_model->get_internal_details();
?>
<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
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
<br />
<table class="table table-bordered table-striped dataTable">
<thead>
	<tr>
    	<th>&nbsp;</th>
         <?php
			$int_total=explode(",", $all_info[0]['internal_total']);
			$int=explode(",", $all_info[0]['internals']);
			$count=-1;
			if(isset($int_total) && !empty($int_total))
			{
				foreach($int_total as $key=>$val)
				{
					$count++;	
				}
			}
		?>
        <th colspan="<?=$count?>">Marks</th>
        <th>Total</th>
    </tr>
    </thead>
	<tr>
    	<td><strong>Internals</strong></td>
        <?php
			$int_total=explode(",", $all_info[0]['internal_total']);
			$int=explode(",", $all_info[0]['internals']);
			$ii=count($int_total)-1;
			unset($int_total[$ii]);
			if(isset($int_total) && !empty($int_total))
			{
				foreach($int_total as $key=>$val)
				{
					if($int[$key]!='')
					{
						?>
                        	<td>
                            	<?= $int[$key].'/'.$val?>
                            </td>
                        <?php
					}
					else
					{
						?>
                        	<td>
                            	-
                            </td>
                        <?php
					}
				}
			}	
		?>
        <td class="green"><?= $all_info[0]['internals_total']?></td>
    </tr>
    <tr style="display:none;">
    	<td><strong>Model</strong></td>
        <td colspan="<?=$count?>"><?= ($all_info[0]['model']!=0)?$all_info[0]['model'].'/'.$mark_info[0]['model_mark']:'-'?></td>
        <td class="green"><?= $all_info[0]['model_total']?></td>
    </tr>
    <tr>
    	<td><strong>Assignment</strong></td>
        <td colspan="<?=$count?>"></td>
        <td class="green"><?= round($all_info[0]['assignment'],2)?></td>
    </tr>
    <tr>
    	<td><strong>Attendance</strong></td>
        <td colspan="<?=$count?>"></td>
        <td class="green"><?= round($all_info[0]['attendance'],2)?></td>
    </tr>
     <tr style="display:none;">
    	<td ><strong>External</strong></td>
        <td colspan="<?=$count?>"></td>
        <td class="green"><?= $all_info[0]['exam_mark']?></td>
    </tr>
    <tr>
    	<td><strong>Internal Total</strong></td>
        <td colspan="<?=$count?>"></td>
        <td class="red"><?= round($all_info[0]['total'],2)?></td>
    </tr>
    <tr>
    	<td><strong>Grade Point</strong></td>
        <td colspan="<?=$count?>"></td>
        <td class="<?=($all_info[0]['subject_grade'][0]['grade']==0)?'red':'green'?>">
		<?php  
			if($all_info[0]['subject_grade'][0]['grade']==10)
				echo "S";
			else if($all_info[0]['subject_grade'][0]['grade']==9)	
				echo "A";
			else if($all_info[0]['subject_grade'][0]['grade']==8)	
				echo "B";
			else if($all_info[0]['subject_grade'][0]['grade']==7)	
				echo "C";
			else if($all_info[0]['subject_grade'][0]['grade']==6)	
				echo "D";
			else if($all_info[0]['subject_grade'][0]['grade']==5)	
				echo "E";
			else if($all_info[0]['subject_grade'][0]['grade']==0)	
				echo "U";
			echo " - ";	
			echo round($all_info[0]['subject_grade'][0]['grade'],2)
		?></td>
    </tr>
</table>

<?php 
		$data="data: [";
		
		$data=$data."{";
		$data=$data."name: 'Internals',";
		$data=$data."y: ".$all_info[0]['internals_total']."";
		$data=$data."},";
		
		/*$data=$data."{";
		$data=$data."name: 'Model',";
		$data=$data."y: ".$all_info[0]['model_total']."";
		$data=$data."},";*/
		
		$data=$data."{";
		$data=$data."name: 'Assignment',";
		$data=$data."y: ".$all_info[0]['assignment']."";
		$data=$data."},";
		
		$data=$data."{";
		$data=$data."name: 'Attendance',";
		$data=$data."y: ".$all_info[0]['attendance']."";
		$data=$data."}";
		
		/*$data=$data."{";
		$data=$data."name: 'External',";
		$data=$data."y: ".$all_info[0]['exam_mark']."";
		$data=$data."}";*/
		
		$data=$data."]";

?>
<div class="row" style="width:98%;">
<div class="col-lg-6">
<div id="container1" style="height: 300px; width:100%;"></div>
</div>
<div class="col-lg-6">
<div id="container2" style="height: 300px; width: 100%;"></div>
</div>
</div>
<script type="text/javascript">
// Internationalization
Highcharts.setOptions({
    lang: {
        drillUpText: '◁ Back to {series.name}'
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
       <?=$data?>
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

<!--<style type="text/css">
@media print{@page {size: landscape}}
</style>-->
<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?> 
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

<?php
	$this->load->model('admin/admin_model');
	$mark_info=$this->admin_model->get_internal_details();
?>

<br />
<div class="full_width">
<table class="table table-bordered table-striped dataTable">
<thead>
  <tr>
    <th rowspan="2">Subject</th>
    <th colspan="<?=$mark_info[0]['no_internal']+1?>" style="text-align:center;">Internal</th>
    <th style="display:none;" colspan="2">Model</th>
    <th rowspan="2">Assignment</th>
    <th rowspan="2">Attendance</th>
    <th style="display:none;" rowspan="2">External</th>
    <th rowspan="2">Internal Total</th>
    <th rowspan="2">Grade Point</th>
  </tr>
  <tr>
  	<?php 
			for($i=1;$i<=$mark_info[0]['no_internal'];$i++)
			{
			?>
            	<th>Int-<?=$i?></th>
            <?php	
			}
		?>
    <th>Total</th>
    <th style="display:none;" >Model-1</th>
    <th style="display:none;" >Total</th>
   
  </tr>
  </thead>
   <?php
	if(isset($all_info) && !empty($all_info))
	{
		$data="data: [";
		$j=1;
		
		foreach($all_info as $val)
		{
			$total=$val['subject_grade'][0]['total_cgb'];
			?>
            <tr>
                <td><?=$val['nick_name']?></td>
                
                 <?php
				 		$int_total=explode(",", $val['internal_total']);
						$int=explode(",", $val['internals']);
						$ii=count($int_total)-1;
						unset($int_total[$ii]);
				
						if(isset($int_total) && !empty($int_total))
						{
							$cols=0;
							foreach($int_total as $key=>$val1)
							{
								if($int[$key]!='')
								{
									?>
										<td>
											<?= $int[$key].'/'.$val1?>
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
								$cols++;
								
							}
						}	
					?>
                
                <td><?=$val['internals_total']?></td>
                <td style="display:none;" ><?=($val['model']!=0)?$val['model'].'/'.$mark_info[0]['model_mark']:'-'?></td>
                <td style="display:none;" ><?=$val['model_total']?></td>
                <td><?=round($val['assignment'],2)?></td>
                <td><?=round($val['attendance'],2)?></td>
                <td  style="display:none;"><?=$val['exam_mark']?></td>
                <td class="red"><?=$val['total']?></td>
                <td class="<?=($val['subject_grade'][0]['grade']==0)?'red':'green'?>">
					<?php
							if($val['subject_grade'][0]['grade']==10)
								echo "S";
							else if($val['subject_grade'][0]['grade']==9)	
								echo "A";
							else if($val['subject_grade'][0]['grade']==8)	
								echo "B";
							else if($val['subject_grade'][0]['grade']==7)	
								echo "C";
							else if($val['subject_grade'][0]['grade']==6)	
								echo "D";
							else if($val['subject_grade'][0]['grade']==5)	
								echo "E";
							else if($val['subject_grade'][0]['grade']==0)	
								echo "U";
							echo " - ";	 
						echo $val['subject_grade'][0]['grade'];?>
                 </td>
            </tr>
            
     <?php
	 	$data=$data."{";
		$data=$data."name: '".$val['nick_name']."',";
		$data=$data."y: ".$val['total']."";
		$data=$data."}";
		if(count($all_info)!=$j)
		$data=$data.",";
		$j++;
		}
		$data=$data."]";
	}
	?>   <tr>
            <td colspan="<?=$cols+5?>" style="text-align:right;">GPA</td><td class="green"><?=round($total,2)?></td>
         </tr>
</table>
</div>
<div class="row" style="width:98%;">
<div class="col-lg-6">
<div id="container1" style="height: 300px; width:100%"></div>
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
        name: 'Internals',
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



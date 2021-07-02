<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<link href="<?= $theme_path; ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/datatables/stu_data_table.css" rel="stylesheet" type="text/css" />
<style type="text/css">
table, td, th {
	font-size:10px;
}
</style>
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user">
    	<img src="<?= $theme_path; ?>/images/icons/events/placement.png">
    </div>
    Campus Interview		
</div>
<div class="message-form-inner">
<table id="example1" class="table table-bordered table-striped" style="font-size:10px;">
<thead>
	<tr>
        <th>Department</th>
        <th>%</th>   	
        <th>Company Name</th>
        <th>Venue</th>
        <th>Date</th>
        <th>Salary</th>
        <th>Eligibility Student</th>
      <!--  <th>Interested Student</th>
        <th>Placed Student</th>-->
        <th>Participated</th>
        <th>Placed</th>
        <th>Action</th>
    </tr>
</thead>    
    <?php 
		$this->load->model('placement/placement_model');
		if(isset($all_placement) && !empty($all_placement))
		{
			foreach($all_placement as $val)
			{
				$depart=$this->placement_model->get_department($val['department']);
				if(isset($depart) && !empty($depart))
					$deprt_name=$depart[0]['nickname'];
				else
					$deprt_name='-';		
				?>
                <tr>
              		<td><?=$deprt_name?></td>
                    <td><?=$val['percentage']?></td>
                    <td><?=$val['company_name']?></td>
                    <td><?=$val['venue']?></td>
                    <td><?=$val['date']?></td>
                    <td><?=$val['salary']?></td>
                    <td><?=$val['eligibility_student'][0]['eligibility_student']?></td>
                    <!--<td><?=$val['interested_student'][0]['interested_student']?></td>
                    <td><?=$val['placed_student'][0]['placed_student']?></td>-->
                    <td><?=($val['participation']==1)?'Yes':'No'?></td>
                    <td><?=($val['placed']==1)?'Yes':'No'?></td>
                    <td>
                    	<a href="<?=$this->config->item('base_url').'users/view_placement/'.$val['id']?>" title="View" class="btn btn-success btn-sm">View</a>
                                       
                    </td>
                </tr>
                <?php
			}	
		}
	?>
</table>

 </div></div></div>
 <!-- DATA TABES SCRIPT -->
<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		$("#example1").dataTable();
		$("#example4").dataTable();
		$("#example5").dataTable();
		$("#example3").dataTable();
		 $("#example4").dataTable();
		 $("#example5").dataTable();
		$('#example2').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": false
		});
	});
	
	$('.public').live('click',function(){
		$('.pub').show()
	
	});
	$('.hid').live('click',function(){
		$('.pub').hide()
	});
</script>
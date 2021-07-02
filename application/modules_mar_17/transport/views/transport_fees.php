<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
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
<p><a href="<?=$this->config->item('base_url').'transport/transport_addmission'?>" class='btn btn-primary right'>Transport Fees</a></p><br /><br />
<table id="example1" class="table table-bordered table-striped view">
<thead>
	<tr>
    	<th>S.No</th>
        <th>Image</th>
        <th>Roll No</th>
        <th>Name</th>
        <th>Batch</th>
        <th>Department</th>
        <th>Stage</th>
        <th>Amount</th>
        <th>Payment Period</th>
        <th>Payment Date</th>
        <th>Action</th>
    </tr>
</thead>    
    <?php 
	//echo "<pre>"; print_r($advance); exit;
		if(isset($transport_list) && !empty($transport_list))
		{
			$i=1;
			foreach($transport_list as $val)
			{
				?>
                <tr>
                    <td><?=$i?></td>
                    <td>
                    	<img id="blah" class="staff_thumbnail" src="<?=$this->config->item('base_url')?>profile_image/student/thumb/<?=$val['image']?>" alt="Student Image" />
                    </td>
                     <td><?=$val['std_id']?></td>
                    <td><?=$val['name']?></td>
                    <td><?=$val['from'].'-'.$val['to']?></td>
                    <td><?=$val['department'].'-'.$val['group']?></td>
                    <td><?=$val['stage_name']?></td>
                    <td><?=$val['t_amount']?></td>
                    <td>[<?=$val['date_from'].']==['.$val['date_to']?>]</td>
                    <td><?=date('d-M-Y',strtotime($val['created_date']))?></td>
                    <td>
                    	<a href="<?=$this->config->item('base_url').'transport/view_student_transport/'.$val['std_id']?>" title="View" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                    	<a href="<?=$this->config->item('base_url').'transport/update_student_transport/'.$val["std_id"]; ?>" title="Edit" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>                       
                    </td>
                </tr>
                <?php
				$i++;
			}	
		}
	?>
</table>

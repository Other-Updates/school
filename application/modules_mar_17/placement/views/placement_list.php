<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<p class="print_admin_use"><a href="<?=$this->config->item('base_url').'placement/'?>" class='btn btn-primary right'>Add Placement</a></p><br /><br />
<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr>
    	<th>Batch</th>
        <th>Department</th>
        <th>CGPA</th>   	
        <th>Company</th>
        <th>Venue</th>
        <th>Date</th>
        <th>Salary</th>
        <th>Eligibility Student</th>
        <th>Interested Student</th>
        <th>Placed Student</th>
        <th class="print_admin_use">Action</th>
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
				$batch=$this->placement_model->get_batch($val['batch_id']);
				if(isset($batch) && !empty($batch))
					$batch_name=$batch[0]['from'].'-'.$batch[0]['to'];
				else
					$batch_name='-';			
				?>
                <tr>
                	<td><?=$batch_name?></td>
              		<td><?=$deprt_name?></td>
                    <td><?=$val['percentage']?></td>
                    <td><?=$val['company_name']?></td>
                    <td><?=$val['venue']?></td>
                    <td><?=$val['date']?></td>
                    <td><?=$val['salary']?></td>
                    <td><?=$val['eligibility_student'][0]['eligibility_student']?></td>
                    <td><?=$val['interested_student'][0]['interested_student']?></td>
                    <td><?=$val['placed_student'][0]['placed_student']?></td>
                    <td  class="print_admin_use">
                    	<a href="<?=$this->config->item('base_url').'placement/view_placement/'.$val['id']?>" title="View" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                    	<a href="<?=$this->config->item('base_url').'placement/edit_placement/'.$val["id"]; ?>" title="Edit" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>                        
                    </td>
                </tr>
                <?php
			}	
		}
	?>
</table>

 
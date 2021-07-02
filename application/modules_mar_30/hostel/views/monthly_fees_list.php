<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<p><a href="<?=$this->config->item('base_url').'hostel/add_monthly_fees'?>" class='btn btn-primary right'>Add Monthly Fees</a></p><br /><br />
<table id="example1" class="table table-bordered table-striped view">
<thead>
	<tr>    	
        <th>Hostel Name</th>
        <th>Month & Year</th>
        <th>From Date</th>
        <th>Due Date</th>
        <th>Fine</th>
        <th>Total Fees</th>
        <th>Monthly Fees / Head</th>
        <th>Monthly Fees / Day</th>
        <th>Created Date</th>
        <th>Action</th>
    </tr>
</thead>    
    <?php 
		if(isset($monthly_fees) && !empty($monthly_fees))
		{
			$i=1;
			foreach($monthly_fees as $val)
			{
				?>
                <tr>
              		<td><?=$val['block']?></td>
                    <td>
						<?php
							$month_arr=array('January','February','March','April','May','June','July','August','September','October','November','December');
							foreach($month_arr as $key=>$val1)
							{
								if($key+1==$val['month'])
									echo $val1; 
							}
                            echo '-'.$val['year'];
                        ?>
                    </td>
                    <td><?=date('d-M-Y',strtotime($val['from_date']))?></td>
                    <td><?=date('d-M-Y',strtotime($val['due_date']))?></td>
                    <td>
						<?php
							echo ucfirst($val['fine_type']);
							if($val['fine_type']=='yes')
							{
								echo " ( ".$val['fine_amount']." / ".$val['fine_option']." ) ";
							}
						?>
                    </td>
                    <td><b>Rs <?=$val['total_amount']?></b></td>
                    <td><b>Rs <?=$val['per_head']?></b></td>
                    <td><b>Rs <?=$val['per_day']?></b></td>
                    <td><?=date('d-M-Y',strtotime($val['created_date']))?></td>
                    <td>
                    	<a href="<?=$this->config->item('base_url').'hostel/view_monthly_fees/'.$val['id']?>" title="View" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                    	<a href="<?=$this->config->item('base_url').'hostel/update_monthly_fees/'.$val["id"]; ?>" title="Edit" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>                        
                    </td>
                </tr>
                <?php
				$i++;
			}	
		}
	?>
</table>

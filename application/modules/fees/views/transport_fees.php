<p><a href="<?=$this->config->item('base_url').'fees/add_transport_fees'?>" class='btn btn-primary right'>Add Transport Fees</a></p><br /><br />
<table id="example1" class="table table-bordered table-striped">
	<thead>
    	<tr>
            <td>Bill Name</td>
            <td>Amount</td>
            <td>For Management</td>
            <td>From Date</td>
            <td>Due Date</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
    </thead>    
    <tbody>    
        <?php 
			if(isset($all_sem_fees) && !empty($all_sem_fees))
			{
				
				foreach($all_sem_fees as $val)
				{
					?>
					<tr>
                        <td><?=$val['bill_name']?></td>
						<td><?=$val['amount']?></td>
						<td><?=$val['amount']+$val['management_amount']?></td>
						<td><?=date('d-M-Y',strtotime($val['from_date']))?></td>
						<td><?=date('d-M-Y',strtotime($val['due_date']))?></td>
                        <td>
							<?php 
								if($val['status']==1)
									echo 'Open';
								else if($val['status']==2)
									echo 'Verified';
								else	
								echo 'Closed';
							?>
                        </td>
						<td>
                        	
                        	 <a href="<?=$this->config->item('base_url').'fees/transport_fees_view/'.$val['id']?>" title="View" class="btn bg-maroon btn-sm">
                        	<i class="fa fa-eye"></i>
                            </a>
                            <?php
							if($val['status']==1){	
							?>
                            <a href="<?=$this->config->item('base_url').'fees/update_transport_fees_view/'.$val['id']?>" title="Edit" class="btn bg-navy btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                        	<?php }?>
                        </td>
					</tr>
					<?php
				}
			}
		?>
    </tbody>
</table>
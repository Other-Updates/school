<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); 
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
<style type="text/css">
@media print
{
	.bill_method,input,select,label,.feedback-panel,.hide_tr,input, .btn, #bill_div, .print_use1 {display:none;}
}
</style>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<br />
<table class="table table-bordered table-striped dataTable">
<thead>
	<tr>
    	<th>Image</th>
        <th>Roll No</th>
        <th>Name</th>
        <th>Student Type</th>
        <th>Amount</th>
        <th>Paid Amount</th>
        <th>Balance</th>
        <th>Status</th>
        <th class="hide_tr">Action</th>
    </tr>
</thead>    
    <?php 
	if(isset($all_student) && !empty($all_student))
	{
		foreach($all_student as $val)
		{
			if(isset($val['exam_info'][0]['edit_amt']) && !empty($val['exam_info'][0]['edit_amt']))
			{
				$total=$val['exam_info'][0]['edit_amt'][0]['amount'];
			}
			else
			{
				if($val['student_type']==1)
					$total=$fees_info[0]['amount']+$fees_info[0]['management_amount'];
				else
					$total=$fees_info[0]['amount'];	
			}
			$sum=array();
			if(isset($val['exam_info'][0]['payment_history']) && !empty($val['exam_info'][0]['payment_history']))
			{
				
				foreach($val['exam_info'][0]['payment_history'] as $val1)
				{
					$sum[]=$val1['amount'];
				}
				$f_amt=0;
				if($val['exam_info'][0]['fain']=='yes')
				{
					if($val['exam_info'][0]['due_date'] < $val['exam_info'][0]['payment_history'][0]['created_date'])
					{
						$datetime1 = date_create($val['exam_info'][0]['due_date']);
						$datetime2 = date_create($val['exam_info'][0]['payment_history'][0]['created_date']);
						$interval = date_diff($datetime1, $datetime2);
						$days=$interval->format('%d');
						if($val['exam_info'][0]['fain_type']=='day')
						{
							$f_amt=$val['exam_info'][0]['fain_amount']*$days;
						}
						else if($val['exam_info'][0]['fain_type']=='week')
						{
							$per=$days/7;
							if(intval($per)>0)
								$f_amt=$val['exam_info'][0]['fain_amount']*intval($per);
							else
								$f_amt=$val['exam_info'][0]['fain_amount']+intval($per);
							
						}
						else if($val['exam_info'][0]['fain_type']=='month')
						{
							$per=$days/30;
							if(intval($per)>0)
								$f_amt=$val['exam_info'][0]['fain_amount']*intval($per);
							else
								$f_amt=$val['exam_info'][0]['fain_amount']+intval($per);
						}		
					}
					
				}
				$net=$total+$f_amt;
			}
			else
			{
				if(isset($val['exam_info'][0]['fain']) && !empty($val['exam_info'][0]['fain']))
				{
					$f_amt=0;
					if($val['exam_info'][0]['fain']=='yes')
					{
						if(date('Y-m-d') > $val['exam_info'][0]['due_date'])
						{
							$datetime1 = date_create(date('Y-m-d'));
							$datetime2 = date_create($val['exam_info'][0]['due_date']);
							$interval = date_diff($datetime1, $datetime2);
							$days=$interval->format('%d');
							if($val['exam_info'][0]['fain_type']=='day')
							{
								$f_amt=$val['exam_info'][0]['fain_amount']*$days;
							}
							else if($val['exam_info'][0]['fain_type']=='week')
							{
								$per=$days/7;
								if(intval($per)>0)
									$f_amt=$val['exam_info'][0]['fain_amount']*intval($per);
								else
									$f_amt=$val['exam_info'][0]['fain_amount']+intval($per);
								
							}
							else if($val['exam_info'][0]['fain_type']=='month')
							{
								$per=$days/30;
								if(intval($per)>0)
									$f_amt=$val['exam_info'][0]['fain_amount']*intval($per);
								else
									$f_amt=$val['exam_info'][0]['fain_amount']+intval($per);
							}		
						}
						
					}
					$net=$total+$f_amt;
				}
			}
			
			$bal=$net-array_sum($sum);
			if($bal==0)
			{
				if($payment_status==2)
				continue;
			}
			else
			{
				if($payment_status==1)
				continue;
			}
			?>
            	<tr>
                	<td>
                    <a href="#profile_img" data-toggle="modal"><img class="staff_thumbnail" src="<?=$this->config->item('base_url')?>profile_image/student/thumb/<?=$val['image']?>" /></a>
                    </td>
                    <td><?=$val['std_id']?></td>
                    <td><?=$val['name']?></td>
                    <td><?=($val['student_type']==1)?'Management':'Counselling'?></td>
                    <td>
						<?php	
							echo $net;	
						?>
                    </td>
                    <td>
                    	<?php
							echo array_sum($sum);
						?>
                    </td>
                    <td>
                    	<?=$bal;?>
                    </td>
                    <td>
                    	<?php 
							if($bal==0)
							{
								echo 'Paid';
							}
							else
							{
								echo 'Pending';
							}
						?>
                    </td>
                    <td class="hide_tr">
                    	<a href="#history_<?=$val['id']?>" data-toggle="modal" title="Payment History" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a>
                    </td>
                </tr>
                
                
            <?php 
		}
	}
	else
	{
		echo "<tr><td colspan='9'>No Data Found...</td></tr>";
	}
	?>
    </table>
	<?php 
	if(isset($all_student) && !empty($all_student))
	{
		foreach($all_student as $val)
		{
			?>
			<div id="history_<?=$val['id']?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
			<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
					<a class="close" data-dismiss="modal">×</a>
			   <h3 id="myModalLabel">Payment History</h3>
			  </div>
			  <div class="modal-body">
              <table class="staff_table_sub">
              <thead>
              	<tr>
                	<th>Date</th>
                    <th>Payment Mode</th>
                    <th>Amount</th>
                    <th>Bank Details</th>
                </tr>
               </thead> 
             
			   	<?php 
					$pay_history=array();
					if(isset($val['exam_info'][0]['payment_history']) && !empty($val['exam_info'][0]['payment_history']))
					{
						foreach($val['exam_info'][0]['payment_history'] as $pay_his)
						{
							if($pay_his['payment_mode']==1)
							{
								$p_mode='Cash';
								$details='-';
							}
							else if($pay_his['payment_mode']==2)
							{
								$p_mode='Cheque';
								$details=$pay_his['bank_name'].' / '.$pay_his['barch'].' / '.$pay_his['cheque_no'];
							}
							else if($pay_his['payment_mode']==3)
							{
								$p_mode='DD';
								$details=$pay_his['bank_name'].' / '.$pay_his['barch'].' / '.$pay_his['cheque_no'];
							}
							?>
                            <tr>
                                <td><?=date('d-m-Y',strtotime($pay_his['created_date']))?></td>
                                <td><?=$p_mode?></td>
                                <td><?=$pay_his['amount']?></td>
                                <td><?=$details?></td>
                            </tr>
                            <?php
							$pay_history[]=$pay_his['amount'];
						}
					}
					else
						echo "<tr><td colspan='4'>Payment Not Created Yet...</td></tr>";
				?>		
                <tfoot>
                	<tr>
                	<th>Total</th>
                    <th></th>
                    <th><?=array_sum($pay_history)?></th>
                    <th></th>
                </tr>
                </tfoot>
             </table>
             	<?php 
					if(isset($val['exam_info'][0]['edit_amt']) && !empty($val['exam_info'][0]['edit_amt']))
					{
						?>
                        	<table>
                            	<tr>
                                	<th colspan="2">Amount Modified</th>
                                </tr>
                                <tr>
                                	<td>Amount</td>
                                    <td><?=$val['exam_info'][0]['edit_amt'][0]['amount']?></td>
                                </tr>
                                 <tr>
                                	<td>Reason</td>
                                    <td><?=$val['exam_info'][0]['edit_amt'][0]['reason']?></td>
                                </tr>
                            </table>
                        <?php
					}
				?>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
			  </div>
			  </div>
			  </div>
			</div>
<?php
		}
	}
?>
<br />
<input type="button" class="btn btn-primary right" id='print_page' value="Print" />
<br /><br />
    <script type="text/javascript">
    $(document).ready(function(){
		$('#print_page').click(function(){
			window.print();	
		});	
	});
    </script>	
<div id="profile_img" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<a class="close" data-dismiss="modal">×</a>
<h3 id="myModalLabel">Profile Image</h3>
</div>
<div class="modal-body">
<img src="<?=$this->config->item('base_url')?>profile_image/student/thumb/<?=$val['image']?>" width="50%" />
</div>
</div>
</div>
</div>    
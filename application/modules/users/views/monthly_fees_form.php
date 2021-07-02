<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/internal_mark.png"></div>
    Hostel Details
</div>
<div class="message-form-inner">
    <div id='hostel_info' >
    <?php if(isset($hostel) && !empty($hostel)) { ?>
<table  width="100%" border="0" style="border:0">
	<tr>
    	<td >Hostel Name</td>
        <td class="text_bold">
        	<?=$hostel[0]['block'][0]['block']?>&nbsp;(
            <?php if($hostel[0]['block'][0]['hostel_type']==0){ echo 'Div'; } else { echo 'Non Div';} ?> )
        </td>
    </tr>
    <tr>
    	<td>Advance Payment</td>
        <td class="text_bold">
        	<?=$hostel[0]['amount']?>
        </td>
    </tr>
    <tr>
    	<td>Joining Date</td>
        <td class="text_bold">
        	<?=date('d-M-Y',strtotime($hostel[0]['admission_date']))?>
        </td>
    </tr>
    <tr>
    	<td>Period</td>
        <td class="text_bold">
        	
            <?=$hostel[0]['start_year']."-".$hostel[0]['end_year']?>
        </td>
    </tr>
    
</table>
<?php } ?>
<?php if(isset($room) && !empty($room)) { ?>
<h4>Room Details</h4>
<table class="staff_table">
    	<tr>
        	
            <td>Room No</td><td class="text_bold"><?=$room[0]['room'][0]['room_name']?></td>
            <td>Seat No</td><td class="text_bold"><?=$room[0]['seat_no']?></td>
        </tr>
    </table>
    <?php } ?>
    <h4>Fees Details</h4>
	<table class="table my_table_style">
    <thead>
    <tr>
        <th>Month & Year</th>
        <th>From Date</th>
        <th>Due Date</th>
        <th>Food Fees</th>
        <th>Fine</th>
        <th>Total Amount</th>
        <th>Paid</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
	<?php
		if(isset($my_monthly_fees[0]['monthly_fees']) && !empty($my_monthly_fees[0]['monthly_fees']))
		{
			foreach($my_monthly_fees[0]['monthly_fees'] as $val)
			{
			
					?>
                   	   
                 
				
					<tr>
                    	
                       
                   
                    	
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
                        Rs <?=$val['per_head']?>
                        ( Rs <?=$val['per_day']?> / Day )
                        </td>           
                    	
                        <td>
                        	<?php 
								$f_amt=0;
								if($val['fine_type']=='yes'){
									if(date('Y-m-d')>$val['due_date'])
									{
									$datetime1 = date_create(date('Y-m-d'));
									$datetime2 = date_create($val['due_date']);
									$interval = date_diff($datetime1, $datetime2);
									$days=$interval->format('%d');
									
										if($val['fine_option']=='day')
											$f_amt=$val['fain_amount']*$days;
										else if($val['fine_option']=='week')
										{
											$per=$days/7;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
											
										}
										else if($val['fine_option']=='month')
										{
											$per=$days/30;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
										}		
									}
									
								}
								echo $f_amt;
							?>
       
                        </td>
                  
                    	
                        <td>
                        Rs <span id='net_<?=$val['id']?>'>
							<?php 
                                echo $val['per_head']+$f_amt;
                            ?>
                        	</span>
                        </td>
                    	<td>
                        <?php 
						if(isset($val['payment_details'][0]['amount']) && !empty($val['payment_details'][0]['amount']))
						{
							echo "Rs ".$val['payment_details'][0]['amount'];
							if($val['payment_details'][0]['no_of_days_ap']>0)
							{
								echo "( ".$val['payment_details'][0]['no_of_days_ap']." )";
							}
						}
						else
							echo "Rs 0";
						?>
                        </td>
                        <td>
                         <?php 
							if(isset($val['payment_details'][0]['amount']) && !empty($val['payment_details'][0]['amount']))
							{
								echo "Paid";
							}
							else
							{
								echo "Pending";
							}
							?>
                        </td>
                        <td>
                        <a href="<?=$this->config->item('base_url').'users/view_hostel_fees/'.$val['id']?>"  class="btn btn-danger btn-sm">View</a>
                        </td>
                    </tr>
				
				<?php 
				
			}	
		}
		else
			echo "<tr><td colspan='9'>No Hostel Fees for this Student...</td></tr>";
	?>
    </table>
</div>
<?php
		if(isset($my_monthly_fees[0]['monthly_fees']) && empty($my_monthly_fees[0]['monthly_fees']))
		{
			foreach($my_monthly_fees[0]['monthly_fees'] as $val)
			{
					?>
                     <table>
                        	<tr style="background: #FAFAFA;">
                            	<td width="272" style="font-weight: bold;">
                                	<?php
									$month_arr=array('January','February','March','April','May','June','July','August','September','October','November','December');
									echo $val['year'].'-';
									foreach($month_arr as $key=>$val1)
									{
										if($key+1==$val['month'])
											echo $val1; 
									}
									?>	
                                </td>
                                <td><b>Rs <?=$val['payment_details'][0]['amount']?></b> Amount Paid Successfully on <b><?=date('d-M-Y',strtotime($val['payment_details'][0]['created_date']))?></b>....</td>
                                <td width="30%"><a href="#history_<?=$val['id']?>" data-toggle="modal" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a>
                                <input type="button" id='print_fees_<?=$val['id']?>' class="btn bg-maroon btn-sm print_btn" value="View" />
                                </td>
                            </tr>
                        </table>
                    <div id="history_<?=$val['id']?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
			<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
					<a class="close" data-dismiss="modal">×</a>
			   <h3 id="myModalLabel">Payment History</h3>
			  </div>
			  <div class="modal-body">
             	<table class="staff_table">
					<tr>
                    	<td>Hostel Name</td>
                        <td><?=$my_monthly_fees[0]['block'] ?></td>
                    </tr>
                    <tr>
                    	<td>Month & Year</td>
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
                    </tr>
                     <tr>
                    	<td>From Date</td>
                        <td><?=date('d-M-Y',strtotime($val['from_date']))?></td>
                    </tr>
                     <tr>
                    	<td>Due Date</td>
                        <td><?=date('d-M-Y',strtotime($val['due_date']))?></td>
                    </tr>
                    <tr>
                    	<td>Food Fees</td>
                        <td>
                        Rs <?=$val['per_head']?>
                        ( Rs <?=$val['per_day']?> / Day )
                        </td>
                    </tr>
                    <tr>
                    	<td>No of Absent</td>
                        <td>
                        	<?=$val['payment_details'][0]['no_of_days_ap']?>	
                           	
                        </td>
                    </tr>
                    <tr>
                    	<td>Fine</td>
                        <td>
                        	<?php 
								$f_amt=0;
								if($val['fine_type']=='yes'){
									if(date('Y-m-d')>$val['payment_details'][0]['created_date'])
									{
									$datetime1 = date_create(date('Y-m-d'));
									$datetime2 = date_create($val['due_date']);
									$interval = date_diff($datetime1, $datetime2);
									$days=$interval->format('%d');
									
										if($val['fine_option']=='day')
											$f_amt=$val['fain_amount']*$days;
										else if($val['fine_option']=='week')
										{
											$per=$days/7;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
											
										}
										else if($val['fine_option']=='month')
										{
											$per=$days/30;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
										}		
									}
									
								}
								echo $f_amt;
							?>
                        </td>
                    </tr>
                    <tr>
                    	<td>Total Amount</td>
                        <td>
                        Rs <span id='net_<?=$val['id']?>'>
							<?php 	
                                echo $val['payment_details'][0]['amount'];
                            ?>
                        	</span>
                        </td>
                    </tr>
                   
				</table>
             	
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
			  </div>
			  </div>
			  </div>
			</div>
					<?php
					}}?>
</div>
</div>
</div>
					
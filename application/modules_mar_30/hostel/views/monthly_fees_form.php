<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<?php 
/*echo "<pre>";
print_r($my_monthly_fees);
exit;*/
?>

<div id='hostel_info' >
<br />
<div class="fees_tit">Monthly Fees</div>
<br />
	<?php
		if(isset($my_monthly_fees[0]['monthly_fees']) && !empty($my_monthly_fees[0]['monthly_fees']))
		{
			foreach($my_monthly_fees[0]['monthly_fees'] as $val)
			{
				if(isset($val['payment_details'][0]['id']) && !empty($val['payment_details'][0]['id']))
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
                    <?php
				}else
				{
				?>
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
                            <input type="text" id='ab_<?=$val['id']?>' class='ab_class' />
                            <input type="hidden"  id='food_<?=$val['id']?>' value='<?=$val['per_head']?>' />
                            <input type="hidden"  id='per_<?=$val['id']?>' value='<?=$val['per_day']?>'  />
                           
                        </td>
                    </tr>
                    <tr>
                    	<td>Fine</td>
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
									
										if(strtolower($val['fine_option'])=='day')
											$f_amt=$val['fine_amount']*$days;
										else if(strtolower($val['fine_option'])=='week')
										{
											$per=$days/7;
											if(intval($per)>0)
												$f_amt=$val['fine_amount']*intval($per);
											else
												$f_amt=$val['fine_amount']+intval($per);
											
										}
										else if(strtolower($val['fine_option'])=='month')
										{
											$per=$days/30;
											if(intval($per)>0)
												$f_amt=$val['fine_amount']*intval($per);
											else
												$f_amt=$val['fine_amount']+intval($per);
										}		
									}
								}
								echo $f_amt;
							?>
                             <input type="hidden"  id='fine_<?=$val['id']?>' value='<?=$f_amt?>'  />
                        </td>
                    </tr>
                    <tr>
                    	<td>Total Amount</td>
                        <td>
                        Rs <span id='net_<?=$val['id']?>'>
							<?php 
                                echo $val['per_head']+$f_amt;
                            ?>
                        	</span>
                        </td>
                    </tr>
                    <tr>
                    	<td></td>
                        <td><input type="button" id='save_<?=$val['id']?>' class="btn btn-success save_btn" value="Save" /></td>
                    </tr>
				</table>
				<?php 
				}
			}	
		}
		else
			echo "No Hostel Fees for this Student...";
	?>
</div>
<?php
		if(isset($my_monthly_fees[0]['monthly_fees']) && !empty($my_monthly_fees[0]['monthly_fees']))
		{
			foreach($my_monthly_fees[0]['monthly_fees'] as $val)
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
             	<table class="staff_table">
					<tr>
                    	<td>Hostel Name</td>
                        <td class="text_bold"><?=$my_monthly_fees[0]['block'] ?></td>
                    </tr>
                    <tr>
                    	<td>Month & Year</td>
                        <td class="text_bold">
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
                        <td class="text_bold"><?=date('d-M-Y',strtotime($val['from_date']))?></td>
                    </tr>
                     <tr>
                    	<td>Due Date</td>
                        <td class="text_bold"><?=date('d-M-Y',strtotime($val['due_date']))?></td>
                    </tr>
                    <tr>
                    	<td>Food Fees</td>
                        <td class="text_bold">
                        Rs <?=$val['per_head']?>
                        ( Rs <?=$val['per_day']?> / Day )
                        </td>
                    </tr>
                    <tr>
                    	<td>No of Absent</td>
                        <td class="text_bold">
                        	<?=$val['payment_details'][0]['no_of_days_ap']?>	
                           	
                        </td>
                    </tr>
                    <tr>
                    	<td>Fine</td>
                        <td class="text_bold">
                        	<?php 
								$f_amt=0;
								if($val['fine_type']=='yes'){
									
									$datetime1 = date_create($val['payment_details'][0]['created_date']);
									$datetime2 = date_create($val['due_date']);
									$interval = date_diff($datetime1, $datetime2);
									$days=$interval->format('%d');
										
										if(strtolower($val['fine_option'])=='day')
										{
											
											$f_amt=$val['fine_amount']*$days;
										}
										else if(strtolower($val['fine_option'])=='week')
										{
											$per=$days/7;
											if(intval($per)>0)
												$f_amt=$val['fine_amount']*intval($per);
											else
												$f_amt=$val['fine_amount']+intval($per);
											
										}
										else if(strtolower($val['fine_option'])=='month')
										{
											$per=$days/30;
											if(intval($per)>0)
												$f_amt=$val['fine_amount']*intval($per);
											else
												$f_amt=$val['fine_amount']+intval($per);
										}		
									}
									
								
								echo "Rs&nbsp;".$f_amt;
								if($val['fine_type']=='yes'){
								echo "&nbsp;(".$val['fine_option'].")";
								}
							?>
                            
                        </td>
                    </tr>
                    <tr>
                    	<td>Total Amount</td>
                        <td class="text_bold">
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
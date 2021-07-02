<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
	<?php 
	if(isset($from_site) && !empty($from_site)){
	?>
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/internal_mark.png"></div>
    <?php }?>
    <?php
	$month_arr=array('January','February','March','April','May','June','July','August','September','October','November','December');
	foreach($month_arr as $key=>$val1)
	{
		if($key+1==$fees_info[0]['month'])
			echo $val1; 
	}
	echo '-'.$fees_info[0]['year'].' ';
	?>
    Monthly Fees
</div>
	<?php //echo "<pre>"; print_r($fees_info); exit; ?>
             	<table class="view_table" width="100%">
                	<tr>
                    	<td>Student Name</td><td><?=$fees_info[0]['std_details'][0]['name']."&nbsp;".$fees_info[0]['std_details'][0]['last_name']?></td>
                    </tr>
                    <tr>
                    <td>Roll No</td>
                    <td><?=$fees_info[0]['monthly_fees'][0]['roll_no']?></td>
                    </tr>
					<tr>
                    	<td>Hostel Name</td>
                        <td class="text_bold"><?=$fees_info[0]['block'] ?></td>
                    </tr>
                     <tr>
                    	<td>From Date</td>
                        <td class="text_bold green"><?=date('d-M-Y',strtotime($fees_info[0]['from_date']))?></td>
                    </tr>
                     <tr>
                    	<td>Due Date</td>
                        <td class="text_bold red"><?=date('d-M-Y',strtotime($fees_info[0]['due_date']))?></td>
                    </tr>
                    <tr>
                    	<td>Food Fees</td>
                        <td class="text_bold">
                        Rs <?=$fees_info[0]['per_head']?>
                        ( Rs <?=$fees_info[0]['per_day']?> / Day )
                        </td>
                    </tr>
                    <tr>
                    	<td>No of Absent</td>
                        <td class="text_bold">
                        	<?php
                            if(isset($fees_info[0]['monthly_fees'][0]['no_of_days_ap']) &&  !empty($fees_info[0]['monthly_fees'][0]['no_of_days_ap'])){
							echo "Rs ".$fees_info[0]['monthly_fees'][0]['no_of_days_ap'];
							}else
							echo "Rs 0";
							?>	
                           	
                        </td>
                    </tr>
                    <tr>
                    	<td>Fine</td>
                        <td class="text_bold">
                        	<?php 
								$f_amt=0;
								if($fees_info[0]['fine_type']=='yes'){
									
									$datetime1 = date_create($fees_info[0]['monthly_fees'][0]['created_date']);
									$datetime2 = date_create($fees_info[0]['due_date']);
									$interval = date_diff($datetime1, $datetime2);
									$days=$interval->format('%d');
									
										if(strtolower($fees_info[0]['fine_option'])=='day')
										{
											$f_amt=$fees_info[0]['fine_amount']*$days;
										}
										else if(strtolower($fees_info[0]['fine_option'])=='week')
										{
											$per=$days/7;
											if(intval($per)>0)
												$f_amt=$fees_info[0]['fine_amount']*intval($per);
											else
												$f_amt=$fees_info[0]['fine_amount']+intval($per);
											
										}
										else if(strtolower($fees_info[0]['fine_option'])=='month')
										{
											$per=$days/30;
											if(intval($per)>0)
												$f_amt=$fees_info[0]['fine_amount']*intval($per);
											else
												$f_amt=$fees_info[0]['fine_amount']+intval($per);
										}		
									}
									
								
								echo "Rs&nbsp;".$f_amt;
								if($fees_info[0]['fine_type']=='yes'){
								echo "&nbsp;(".$fees_info[0]['fine_option'].")";
								}
							?>
                        </td>
                    </tr>
                    <tr>
                    	<td>Total Amount</td>
                        <td class="text_bold">
                        Rs <span id='net_<?=$fees_info[0]['id']?>'>
							<?php 
								 if(isset($fees_info[0]['monthly_fees'][0]['no_of_days_ap']) &&  !empty($fees_info[0]['monthly_fees'][0]['no_of_days_ap']))
                                echo $fees_info[0]['monthly_fees'][0]['amount']+$f_amt;
								else
								echo $fees_info[0]['per_head']+$f_amt;
                            ?>
                        	</span>
                        </td>
                    </tr>
                     <tr>
                    	<td>Status</td>
                        <td class="text_bold">
                       <span id='net_<?=$fees_info[0]['id']?>'>
							<?php 
								 if(isset($fees_info[0]['monthly_fees'][0]['roll_no']) &&  !empty($fees_info[0]['monthly_fees'][0]['roll_no']))
                                echo "Paid";
								else
								echo "Pending";
                            ?>
                        	</span>
                        </td>
                    </tr>
                    <tr class="user_print_use">
                    <td>&nbsp;</td>
                    <td></td>
                    </tr>
                   
				</table>
                <p class="print_admin_use">
<br />
<input type="button" value='Print' class='print_btn btn btn-primary fright' />
<br /><br />
</p>
            </div>
            
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.print_btn').click(function(){
		window.print();	
	});	
});
</script>
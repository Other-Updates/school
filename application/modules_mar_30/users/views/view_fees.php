<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); 
$std_info=$this->session->userdata('user_info');
?>
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user">
    	<img src="<?= $theme_path; ?>/images/icons/events/rs.png">
    </div>
    <?=ucfirst($fees_info[0]['bill_name'])?>		
</div>
<div class="message-form-inner">
<div class="view_table">
<?php 
if(isset($balance) && !empty($balance))
{
?>
    <table>
        
        <tr>
            <td width="50%">Year</td>
            <td class="text_bold">
                 Year-<?=$fees_info[0]['semester_id']?> 
            </td>
        </tr>
    </table>
<?php }?>
            <table width="100%">
            		<tr>
                        <td width="50%">Bill Name</td>
                        
                        <td class="text_bold"><?=$fees_info[0]['bill_name']?></td>
                    </tr>
                    <tr>
                        <td>From Date</td>
                       
                        <td class="text_bold"><?=date('d-M-Y',strtotime($fees_info[0]['from_date']))?></td>
                    </tr>
                    <tr>
                        <td>Due Date</td>
                        
                        <td class="text_bold"><?=date('d-M-Y',strtotime($fees_info[0]['due_date']))?></td>
                    </tr>
                    <?php 
                        if(isset($fees_info[0]['fees_details']) && !empty($fees_info[0]['fees_details']))
                        {
                            foreach($fees_info[0]['fees_details'] as $val)
                            {
								if($val['master_option']=='on'){
                                ?>
                                <tr>
                                    <td><?=$val['fees_name']?></td>
                                    
                                    <td class="text_bold">Rs <?=$val['amount']?></td>
                                </tr>
                                <?php
								}
                            }
                        }
                    ?>
                   
						<?php 
							$n_val=0;
								if($fees_info1[0]['student_type']==2){
									if(isset($fees_info1[0]['exam_info'][0]['edit_amt']) && !empty($fees_info1[0]['exam_info'][0]['edit_amt']))
										$n_val=$fees_info1[0]['exam_info'][0]['edit_amt'][0]['amount'];
									else
										$n_val=$fees_info[0]['amount'];
								}
								else{
									if(isset($fees_info1[0]['exam_info'][0]['edit_amt']) && !empty($fees_info1[0]['exam_info'][0]['edit_amt']))
										$n_val=$fees_info1[0]['exam_info'][0]['edit_amt'][0]['amount'];
									else
										$n_val=$fees_info[0]['amount']+$fees_info[0]['management_amount'];
								 }
										$f_amt=0;
										if($fees_info1[0]['exam_info'][0]['fain']=='yes'){
											if(date('Y-m-d')>$fees_info1[0]['exam_info'][0]['due_date'])
											{
											$datetime1 = date_create(date('Y-m-d'));
											$datetime2 = date_create($fees_info1[0]['exam_info'][0]['due_date']);
											$interval = date_diff($datetime1, $datetime2);
											$days=$interval->format('%d');
												if($fees_info1[0]['exam_info'][0]['fain_type']=='day')
													$f_amt=$fees_info1[0]['exam_info'][0]['fain_amount']*$days;
												else if($fees_info1[0]['exam_info'][0]['fain_type']=='week')
												{
													$per=$days/7;
													if(intval($per)>0)
														$f_amt=$fees_info1[0]['exam_info'][0]['fain_amount']*intval($per);
													else
														$f_amt=$fees_info1[0]['exam_info'][0]['fain_amount']+intval($per);
													
												}
												else if($fees_info1[0]['exam_info'][0]['fain_type']=='month')
												{
													$per=$days/30;
													if(intval($per)>0)
														$f_amt=$fees_info1[0]['exam_info'][0]['fain_amount']*intval($per);
													else
														$f_amt=$fees_info1[0]['exam_info'][0]['fain_amount']+intval($per);
												}		
											}
										}

                        	$full_amt=$n_val+$f_amt;
							
							?>
                    <tr style="display:<?=$fees_info1[0]['student_type']==1?'block':'none'?>">
                        <td>Management</td>                        
                        <td class="text_bold">Rs <?=$fees_info[0]['management_amount']?></td>
                    </tr>
                     <?php 
					if($f_amt==0){
					?>
                     <tr class='amt_tr'>
                        <td>Fine</td>
                     	
                        <td class="text_bold">Rs 0</td>
                    </tr>
                    <?php }else{?>
                    <tr class='amt_tr'>
                        <td>Fine</td>
                     	
                        <td class="text_bold">Rs <?=$f_amt?> (<?=$fees_info[0]['fain_amount']?> / <?=ucfirst($fees_info[0]['fain_type'])?>)</td>
                    </tr>
                    <?php }?>
                    <tr >
                        <td>Total Amount</td>
                        <td class="text_bold">Rs <?=$n_val+$f_amt?></td>
                    </tr>
                    <tr>
                    	<td>Value in Words</td>
                         <td class="text_bold">
                         	<?php
                              $money=$n_val+$f_amt;
							  $this->load->library('to_words'); 
							  $count=count(explode('.',$money));
							  
							  if($count==1)
							  {
							  $formatedNumber=$money;
							  $st=0;
							  }
							  else
							  {
							  $formatedNumber=number_format($money, 2, '.', '');
							  $st=1;
							  }
							  echo $this->to_words->currencyToWords($formatedNumber,$st);
							?>
                         </td>
                    </tr>
                </table>
</div>
 <p class="user_print_use">
<input type="button"  class='btn btn-primary print_btn right' value="Print" /> 
</p>
<script type="text/javascript">
$(document).ready(function(){
	$('.print_btn').click(function(){
		window.print();	
	});	
});
</script> 						
			<?php /*?><div id="history" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
			<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				
			   <p id="myModalLabel"><div class="page-title"><span>Payment History</span></div></p>
			  </div>
			  <div class="modal-body">
              <table class="table" border="1">
              <thead>
              	<tr bgcolor="#FAFAFA">
                	<th>Date</th>
                    <th>Payment Mode</th>
                    <th>Amount</th>
                    <th>Bank Details</th>
                </tr>
               </thead> 
             
			   	<?php 
					$pay_history=array();
					if(isset($fees_info1[0]['exam_info'][0]['payment_history']) && !empty($fees_info1[0]['exam_info'][0]['payment_history']))
					{
						foreach($fees_info1[0]['exam_info'][0]['payment_history'] as $pay_his)
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
                                <td><?=date('d-M-Y',strtotime($pay_his['created_date']))?></td>
                                <td><?=$p_mode?></td>
                                <td align="right">Rs <?=$pay_his['amount']?></td>
                                <td><?=$details?></td>
                            </tr>
                            <?php
							$pay_history[]=$pay_his['amount'];
						}
					}
					else
						echo "<tr><td colspan='4'>No Payment Details</td></tr>";
						
					$ful_bal=($n_val+$f_amt)-array_sum($pay_history);	
				?>		
                <tfoot>
                	<tr>
                	<th>Paid Amount</th>
                    <th></th>
                    <th  align="right">Rs <?=array_sum($pay_history)?></th>
                    <th></th>
                </tr>
                <?php if($ful_bal!=0){?>
                	<tr>
                        <th>Balance</th>
                        <th></th>
                        <th  align="right">Rs <?=($n_val+$f_amt)-array_sum($pay_history)?></th>
                        <th></th>
                	</tr>
                    <?php 
				}
					$final=($n_val+$f_amt)-array_sum($pay_history);
					?>
                     <tr>
                        <th>Status</th>
                        <th></th>
                        <th  align="right"><?=($final==0)?'Paid':'Pending'?></th>
                        <th></th>
                	</tr>
                </tfoot>
             </table>
             	<?php 
					if(isset($fees_info1[0]['exam_info'][0]['edit_amt']) && !empty($fees_info1[0]['exam_info'][0]['edit_amt']))
					{
						?>
                        	<table>
                            	<tr>
                                	<th colspan="2"><div class="page-title" style="font-weight:normal;"><span>Amount Modified</span></div></th>
                                </tr>
                                <tr>
                                	<td>Amount</td>
                                    <td><?=$fees_info1[0]['exam_info'][0]['edit_amt'][0]['amount']?></td>
                                </tr>
                                 <tr>
                                	<td>Reason</td>
                                    <td><?=$fees_info1[0]['exam_info'][0]['edit_amt'][0]['reason']?></td>
                                </tr>
                            </table>
                        <?php
					}
				?>
			 			 </div>
			 
			 		 </div>
			 	 </div>
			</div><?php */?>
            
            
		</div>
	</div>
</div>
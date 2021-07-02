<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>

<table class="staff_table">
            	<tr>
                	<td width="200">Hostel Name</td>
                    <td class="text_bold" >
                    	<?=$monthly_fees[0]['block']?>
                    </td>
                </tr>
                <tr>
                	<td>Month</td>
                    <td class="text_bold"><?php
					switch($monthly_fees[0]['month'])
					{
						case 1:
						echo "January";
						break;
						case 2:
						echo "February";
						break;
						case 3:
						echo "March";
						break;
						case 4:
						echo "April";
						break;
						case 5:
						echo "May";
						break;
						case 6:
						echo "June";
						break;
						case 7:
						echo "July";
						break;
						case 8:
						echo "August";
						break;
						case 9:
						echo "September";
						break;
						case 10:
						echo "October";
						break;
						case 11:
						echo "November";
						break;
						case 12:
						echo "December";
						break;
						default:
						echo "Month Not Selected";
						break;
					}
					echo "&nbsp;".$monthly_fees[0]['year'];
					?>
                        
                    </td>
                </tr>
                <tr>
                	<td>Date</td>
                    <td class="text_bold">
                    	<?= date('d-m-Y',strtotime($monthly_fees[0]['from_date']))."&nbsp;&nbsp;&nbsp;".date('d-m-Y',strtotime($monthly_fees[0]['due_date'])) ?>
                    </td>
                </tr>
               <tr>
               	<td>Fine Option</td>
                <td class="text_bold">
                	<?php if($monthly_fees[0]['fine_type']=='no'){ echo "No Fine";}else { echo $monthly_fees[0]['fine_option'];}?>
                </td>
                </tr>
                <tr>
                <td>Fine Amount</td>
                <td class="text_bold" >
                	<?= $monthly_fees[0]['fine_amount']?>
                </td>                
               </tr>
                <tr>
                	<td>
                    	Bill Details
                    </td>
                    <td style="padding:0; padding-bottom:2px;">
                    	<table id='app_table' class="staff_table_sub">
                            
                                <th width="20%">
                                   Bill Name
                                </th>
                                <th>
                                	Amount
                                </th>
                                <?php if(isset($monthly_fees[0]['bill_details']) && !empty($monthly_fees[0]['bill_details'])) {
									foreach($monthly_fees[0]['bill_details'] as $val) {?>
                                <tr>
                                <td >         
                                    <?= $val['bill_name']?>
                                </td>
                                
                                <td ><?= $val['amount']?></td>
                            	</tr>
                                <?php }} ?>
                                <tr>
                                <td>Total Amount</td><td><?= $monthly_fees[0]['total_amount']	?></td>
                                </tr>
                    	</table>
                        
                    </td>
                </tr>
                
                <tr>
                <td>No of Students</td>
                    <td class="text_bold">
                    	<?= $monthly_fees[0]['no_of_student']?>
                    </td>
                    </tr>
                    <tr>
                	<td>Monthly Fees / Head</td>
                    <td class="text_bold">
                    	<?= $monthly_fees[0]['per_head']?>
                    </td>
                	</tr>
                    <tr>
                	<td>Monthly Fees / Day</td>
                    <td class="text_bold">
                    	<?=$monthly_fees[0]['per_day']?>
                    </td>
                </tr>
            </table>	
            
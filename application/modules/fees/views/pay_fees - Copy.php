<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.1.min.js"></script>
</head> 
<body>
  <div id="map" style="width: 500px; height: 400px;"></div>

  <script type="text/javascript">
  function test(){
    // Define your locations: HTML content for the info window, latitude, longitude
    var locations = [
      ['<h4>Bondi Beach</h4>', -33.890542, 151.274856],
      ['<h4>Coogee Beach</h4>', -33.923036, 151.259052],
      ['<h4>Cronulla Beach</h4>', -34.028249, 151.157507],
      ['<h4>Manly Beach</h4>', -33.80010128657071, 151.28747820854187],
      ['<h4>Maroubra Beach</h4>', -33.950198, 151.259302]
    ];
    
<<<<<<< .mine
    // Setup the different icons and shadows
    var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';
    
    var icons = [
      iconURLPrefix + 'red-dot.png',
      iconURLPrefix + 'green-dot.png',
      iconURLPrefix + 'blue-dot.png',
      iconURLPrefix + 'orange-dot.png',
      iconURLPrefix + 'purple-dot.png',
      iconURLPrefix + 'pink-dot.png',      
      iconURLPrefix + 'yellow-dot.png'
    ]
    var icons_length = icons.length;
    
    
    var shadow = {
      anchor: new google.maps.Point(15,33),
      url: iconURLPrefix + 'msmarker.shadow.png'
    };
||||||| .r1779
    <a href="#profile_img" data-toggle="modal"><img class="add_staff_thumbnail" src="<?=$this->config->item('base_url')?>profile_image/student/thumb/<?=$fees_info[0]['image']?>" /></a>
    </td>
    </tr>
    <tr><td>Batch</td><td>:</td><td class="text_bold"><?=$fees_info[0]['from'].'-'.$fees_info[0]['to']?></td></tr>
    <tr><td>Department</td><td>:</td><td class="text_bold"><?=$fees_info[0]['department'].'-'.$fees_info[0]['group']?></td></tr>
    <tr><td>Email Id</td><td>:</td><td class="text_bold"><?=$fees_info[0]['email_id']?></td></tr>
    <tr><td>&nbsp;</td></tr>
</table>
<div id='exam_info'>
	<div class="fees_tit">Semester / Other Fees</div>
    <?php
		if(isset($fees_info[0]['exam_info']) && !empty($fees_info[0]['exam_info']))
		{
			foreach($fees_info[0]['exam_info'] as $val)
			{
				 $complete_status=0;
				if(isset($val['payment_history']) && !empty($val['payment_history']))
				{
					foreach($val['payment_history'] as $pay_his)
					{
						$complete_status=$pay_his['complete_status'];
					}
				}
				?>
                <div id='ex_div_<?=$val['id']?>'>
                <input type="hidden"  class='exam_type' id='exam_type_<?=$val['id']?>' value='semester' />
                <input type="hidden" value="<?=$fees_info[0]['std_id']?>" id='roll_no_<?=$val['id']?>' />
                <?php 
				if($complete_status==0)
				{
				?>
                
				<table class="staff_table" width="100%">
					<tr><td colspan="3"><?=$val['bill_name']?></td></tr>
					<tr><td width="252">From Date</td><td width="10">:</td><td class="text_bold green"><?=date('d-m-Y',strtotime($val['from_date']))?></td></tr>
                    <tr><td>Due Date</td><td>:</td><td class="text_bold red"><?=date('d-m-Y',strtotime($val['due_date']))?></td></tr>
                    <?php
						$n_val=0;
                    	if($fees_info[0]['student_type']==2){
							if(isset($val['edit_amt']) && !empty($val['edit_amt']))
								$n_val=$val['edit_amt'][0]['amount'];
							else
								$n_val=$val['amount'];
					?>
                    <tr><td>Amount</td><td>:</td><td class="text_bold">
                    	<?=$n_val?>
                    	<input type="button"  class='edit_btn btn bg-navy btn-sm' id='edit_btn_<?=$val['id']?>' value='Edit' />&nbsp; &nbsp; 
                        <input type="text" placeholder="Amount" class='edit_amt' id='edit_amt_<?=$val['id']?>' style="display:none;" />&nbsp;
                        <input type="text" placeholder="Reason" class='edit_text' id='edit_text_<?=$val['id']?>' style="display:none;" />
                        </td></tr>
                    <?php }else{
							if(isset($val['edit_amt']) && !empty($val['edit_amt']))
								$n_val=$val['edit_amt'][0]['amount'];
							else
								$n_val=$val['amount']+$val['management_amount'];
						?>
                     <tr><td class="vtop">Amount</td><td class="vtop">:</td><td class="text_bold">
                    	<?=$n_val?>
                     	<input type="button" class='edit_btn1 btn bg-navy btn-sm' id='edit_btn1_<?=$val['id']?>' value='Edit' />&nbsp; &nbsp; 
                   	<input type="text" placeholder="Amount" class='edit_amt' id='edit_amt_<?=$val['id']?>' style="display:none;" /> &nbsp; 
                         <input type="text"  placeholder="Reason" class='edit_text' id='edit_text_<?=$val['id']?>' style="display:none;" />
                        </td></tr>
                     <?php }?> 
                    <tr>
                    <input type="hidden" value="<?=$n_val?>" id='bill_amt_<?=$val['id']?>' >
                    	<td>Fine</td>
                        <td>:</td>
                    	<td class="text_bold">
                        	 	<?php
								$f_amt=0;
								if($val['fain']=='yes')
								{
									if(date('Y-m-d') > $val['due_date'])
									{
										$datetime1 = date_create(date('Y-m-d'));
										$datetime2 = date_create($val['due_date']);
										$interval = date_diff($datetime1, $datetime2);
										$days=$interval->format('%d');
										if($val['fain_type']=='day')
										{
											$f_amt=$val['fain_amount']*$days;
										}
										else if($val['fain_type']=='week')
										{
											$per=$days/7;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
											
										}
										else if($val['fain_type']=='month')
										{
											$per=$days/30;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
										}		
									}
								?>
                        	<span id='ful_fine_<?=$val['id']?>'><?=$f_amt?></span> (<?=$val['fain_amount'].' / '.ucfirst($val['fain_type'])?>)
                            
                            <?php }else{?>
                            <span id='ful_fine_<?=$val['id']?>'>0</span>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Total
                        </td>
                        <td>:</td>
                    	<td class="text_bold">
                        	<?php $full_amt=$n_val+$f_amt?>
                            <span id='fulamt_text_<?=$val['id']?>'><?=$full_amt?></span>
                            <input type="hidden" value="<?=$full_amt?>" id='ful_amt_<?=$val['id']?>' />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Paid Amount
                        </td>
                        <td>:</td>
                    	<td class="text_bold">
                        	<?php 
							$pay_history=array();
							if(isset($val['payment_history']) && !empty($val['payment_history']))
							{
								foreach($val['payment_history'] as $pay_his)
								{
									$pay_history[]=$pay_his['amount'];
								}
							}
							$paid_amt=0;
							$paid_amt=array_sum($pay_history)?>
                            <span id='paid_text_<?=$val['id']?>'><?=$paid_amt?></span>
                            <input type="hidden" value="<?=$paid_amt?>" id='paid_amt_<?=$val['id']?>' />
                             <a href="#history_<?=$val['id']?>" data-toggle="modal" title="In-Active" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a>
                             <input type="button" id='print_fees_<?=$val['id']?>' class="btn bg-maroon btn-sm print_btn" value="View" />
                        </td>
                    </tr>
                    <tr>
                    	<td>Payment Mode</td>
                        <td>:</td>
                    	<td class="text_bold">
                        	<select  id='p_mode_<?=$val['id']?>' class='payment_mode mandatory'>
                            	<option value=''>Select</option>
                                <option selected="selected" value='1'>Cash</option>
                                <option value='2'>Cheque</option>
                                <option value='3'>DD</option>
                            </select>
                        </td>
                    </tr>
                    </table>
                    <table class="staff_table">
                    <tr id='p_amt_<?=$val['id']?>'>
                    	<td width="252">Paying Amount</td>
                        <td width="10">:</td>
                    	<td class="text_bold">
                        	
                        	<input type="text" class='pay_amt mandatory' id='pay_amt_<?=$val['id']?>' />&nbsp;
                            <input type="text"  class="" value="<?=$full_amt-$paid_amt?>" readonly="readonly" id='bal_amt_<?=$val['id']?>'  placeholder="Balance" /><br />
                            <input type="button" value="Pay"  id='pay_btn_<?=$val['id']?>'  class="btn btn-success pay_btn btn-sm" /><br />
                            <input type="button" value="Complete" style="display:none;"  id='com_btn_<?=$val['id']?>' class="btn btn-warning btn-sm com_pay"/>
                        </td>
                    </tr>
                    </table>
                    <table class="staff_table">
                    <tr id='p_del_<?=$val['id']?>' style="display:none">
                    	<td width="252">Payment&nbsp;Details</td>
                        <td width="10">:</td>
                    	<td class="text_bold">
                        	
                            <input type="text" id='pay_bank_<?=$val['id']?>'   placeholder="Bank Name"/>
                            <input type="text" id='pay_branch_<?=$val['id']?>'  placeholder="Brach"/>
                            <input type="text" id='pay_cheque_<?=$val['id']?>'   placeholder="Cheque / DD No"/>
                            <input type="text"  class='pay_1amt' id='pay_1amt_<?=$val['id']?>' placeholder="Paying Amount"/>
                            <input type="text" value="<?=$full_amt-$paid_amt?>"  readonly="readonly" id='bal_1amt_<?=$val['id']?>'  placeholder="Balance" /><br />
                            <input type="button" value="Pay" id='pay_1btn_<?=$val['id']?>'  class="btn btn-success pay_btn btn-sm" /><br />
                            <input type="button" value="Complete" style="display:none"  id='com_1btn_<?=$val['id']?>' class="btn btn-warning com_pay btn-sm"/>
                        </td>
                    </tr>
				</table>
                  <?php 
				}
				else
				{
					$total_amt=array();
					if(isset($val['payment_history']) && !empty($val['payment_history']))
					{
						foreach($val['payment_history'] as $pay_his)
						{
							$total_amt[]=$pay_his['amount'];
							$last_date=$pay_his['created_date'];
						}
					}
					?>
                    	<table>
                        	<tr style="background: #FAFAFA;">
                            	<td width="272"><?=$val['bill_name']?></td>
                                <td><b>Rs <?=array_sum($total_amt)?></b> Amount Paid Successfully on <b><?=date('d-M-Y',strtotime($last_date))?></b>....</td>
                                <td width="30%"><a href="#history_<?=$val['id']?>" data-toggle="modal" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a>
                                <input type="button" id='print_fees_<?=$val['id']?>' class="btn bg-maroon btn-sm print_btn" value="View" />
                                </td>
                            </tr>
                        </table>
                    <?php
				}
				?>
                <br />
                </div>
				<?php 
			}	
		}
		else
		{
			echo "No Semester / Other Fees for this Student...";
		}
	?>
</div>
<div id='hostel_info' style="display:none;">
<div class="fees_tit">Hostel Fees</div>
	<?php
		if(isset($fees_info[0]['hostel_info']) && !empty($fees_info[0]['hostel_info']))
		{
			foreach($fees_info[0]['hostel_info'] as $val)
			{
				$complete_status=0;
				if(isset($val['payment_history']) && !empty($val['payment_history']))
				{
					foreach($val['payment_history'] as $pay_his)
					{
						$complete_status=$pay_his['complete_status'];
					}
				}
				?>
                <input type="hidden"  class='exam_type' id='exam_type_<?=$val['id']?>' value='hostel' />
                <input type="hidden" value="<?=$fees_info[0]['std_id']?>" id='roll_no_<?=$val['id']?>' />
                <div id='ex_div_<?=$val['id']?>'>
				<?php 
				if($complete_status==0)
				{
				?>
				<table class="staff_table">
					<tr><td colspan="3"><?=$val['bill_name']?></td></tr>
					<tr><td width="252">From Date</td><td width="10">:</td><td class="text_bold green"><?=date('d-m-Y',strtotime($val['from_date']))?></td></tr>
                    <tr><td>Due Date</td><td>:</td><td class="text_bold red"><?=date('d-m-Y',strtotime($val['due_date']))?></td></tr>
                    <?php
						$n_val=0;
                    	if($fees_info[0]['student_type']==2){
							if(isset($val['edit_amt']) && !empty($val['edit_amt']))
								$n_val=$val['edit_amt'][0]['amount'];
							else
								$n_val=$val['amount'];
					?>
                    <tr><td>Amount</td><td>:</td><td class="text_bold">
                    	<?=$n_val?>
                    	<input type="button"  class='edit_btn btn bg-navy btn-sm' id='edit_btn_<?=$val['id']?>' value='Edit' />
                        <input type="text" placeholder="Amount" class='edit_amt' id='edit_amt_<?=$val['id']?>' style="display:none;" />&nbsp;
                        <input type="text" placeholder="Reason" class='edit_text' id='edit_text_<?=$val['id']?>' style="display:none;" />
                        </td></tr>
                    <?php }else{
							if(isset($val['edit_amt']) && !empty($val['edit_amt']))
								$n_val=$val['edit_amt'][0]['amount'];
							else
								$n_val=$val['amount']+$val['management_amount'];
						?>
                     <tr><td>Amount</td><td>:</td><td class="text_bold">
                    	<?=$n_val?>
                     	<input type="button" class='edit_btn1 btn bg-navy btn-sm' id='edit_btn1_<?=$val['id']?>' value='Edit' />&nbsp;
                     	<input type="text" placeholder="Amount" class='edit_amt' id='edit_amt_<?=$val['id']?>' style="display:none;" />&nbsp;
                         <input type="text"  placeholder="Reason" class='edit_text' id='edit_text_<?=$val['id']?>' style="display:none;" />
                        </td></tr>
                     <?php }?> 
                    <tr>
                    <input type="hidden" value="<?=$n_val?>" id='bill_amt_<?=$val['id']?>' >
                    	<td>Fine</td><td>:</td>
                    	<td class="text_bold">
                        	 	<?php
								$f_amt=0;
								if($val['fain']=='yes'){
									if(date('Y-m-d')>$val['due_date'])
									{
									$datetime1 = date_create(date('Y-m-d'));
									$datetime2 = date_create($val['due_date']);
									$interval = date_diff($datetime1, $datetime2);
									$days=$interval->format('%d');
									
										if($val['fain_type']=='day')
											$f_amt=$val['fain_amount']*$days;
										else if($val['fain_type']=='week')
										{
											$per=$days/7;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
											
										}
										else if($val['fain_type']=='month')
										{
											$per=$days/30;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
										}		
									}
								?>
                        	<span id='ful_fine_<?=$val['id']?>'><?=$f_amt?></span> (<?=$val['fain_amount'].' / '.ucfirst($val['fain_type'])?>)
                            
                            <?php }else{?>
                            <span id='ful_fine_<?=$val['id']?>'>0</span>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Total
                        </td><td>:</td>
                    	<td class="text_bold">
                        	<?php $full_amt=$n_val+$f_amt?>
                            <span id='fulamt_text_<?=$val['id']?>'><?=$full_amt?></span>
                            <input type="hidden" value="<?=$full_amt?>" id='ful_amt_<?=$val['id']?>' />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Paid Amount
                        </td><td>:</td>
                    	<td class="text_bold">
                        	<?php 
							$pay_history=array();
							if(isset($val['payment_history']) && !empty($val['payment_history']))
							{
								foreach($val['payment_history'] as $pay_his)
								{
									$pay_history[]=$pay_his['amount'];
								}
							}
							$paid_amt=0;
							$paid_amt=array_sum($pay_history)?>
                            <span id='paid_text_<?=$val['id']?>'><?=$paid_amt?></span>
                            <input type="hidden" value="<?=$paid_amt?>" id='paid_amt_<?=$val['id']?>' />
                             <a href="#history_<?=$val['id']?>" data-toggle="modal" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a>
                             <input type="button" id='print_fees_<?=$val['id']?>' class="btn bg-maroon btn-sm print_btn" value="View" />
                        </td>
                    </tr>
                    <tr>
                    	<td>Payment Mode</td><td>:</td>
                    	<td class="text_bold">
                        	<select  id='p_mode_<?=$val['id']?>' class='payment_mode'>
                            	<option value=''>Select</option>
                                <option selected="selected" value='1'>Cash</option>
                                <option value='2'>Cheque</option>
                                <option value='3'>DD</option>
                            </select>
                        </td>
                    </tr>
                    <tr  id='p_amt_<?=$val['id']?>'>
                    	<td>Paying Amount</td><td>:</td>
                    	<td class="text_bold">
                        	<input type="hidden" value="<?=$fees_info[0]['std_id']?>" id='roll_no_<?=$val['id']?>' />
                        	<input type="text" class='pay_amt' id='pay_amt_<?=$val['id']?>' />&nbsp;
                            <input type="text" value="<?=$full_amt-$paid_amt?>" readonly="readonly" id='bal_amt_<?=$val['id']?>'  placeholder="Balance" /><br />
                            <input type="button" value="Pay"  id='pay_btn_<?=$val['id']?>'  class="btn btn-success pay_btn btn-sm" /><br />
                            <input type="button" value="Complete" style="display:none"  id='com_btn_<?=$val['id']?>' class="btn btn-warning com_pay btn-sm"/>
                        </td>
                    </tr>
                    <tr  id='p_del_<?=$val['id']?>' style="display:none">
                    	<td>Payment Details</td><td>:</td>
                    	<td class="text_bold">
                        	
                            <input type="text" id='pay_bank_<?=$val['id']?>'   placeholder="Bank Name"/>
                            <input type="text" id='pay_branch_<?=$val['id']?>'  placeholder="Brach"/>
                            <input type="text" id='pay_cheque_<?=$val['id']?>'   placeholder="Cheque / DD No"/>
                            <input type="text"  class='pay_1amt' id='pay_1amt_<?=$val['id']?>' placeholder="Paying Amount"/>
                            <input type="text" value="<?=$full_amt-$paid_amt?>"  readonly="readonly" id='bal_1amt_<?=$val['id']?>'  placeholder="Balance" /><br />
                            <input type="button" value="Pay" id='pay_1btn_<?=$val['id']?>'  class="btn btn-success pay_btn btn-sm" />
                            <input type="button" value="Complete" style="display:none"  id='com_1btn_<?=$val['id']?>' class="btn btn-warning com_pay"/>
                        </td>
                    </tr>
				</table>
                  <?php 
				}else
				{
					$total_amt=array();
					if(isset($val['payment_history']) && !empty($val['payment_history']))
					{
						foreach($val['payment_history'] as $pay_his)
						{
							$total_amt[]=$pay_his['amount'];
							$last_date=$pay_his['created_date'];
						}
					}
					?>
                    	<table class="staff_table">
                        	<tr bgcolor="#FAFAFA">
                            	<td width="272"><?=$val['bill_name']?></td>
                               <td><b><?=array_sum($total_amt)?></b> Amount Paid Successfully on <b><?=date('d-M-Y',strtotime($last_date))?></b>....</td>
                                <td  width="30%"><a href="#history_<?=$val['id']?>" data-toggle="modal" title="In-Active" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a>
                                <input type="button" id='print_fees_<?=$val['id']?>' class="btn bg-maroon print_btn btn-sm" value="View" />
                                </td>
                            </tr>
                        </table>
                    <?php
				}
				?>
                <br />
                </div>
				<?php 
			}	
		}
		else
			echo "No Hostel Fees for this Student...";
	?>
</div>
<div id='transport_info'  style="display:none;">
<div class="fees_tit">Transport Fees</div>
	<?php
		if(isset($fees_info[0]['transport_info']) && !empty($fees_info[0]['transport_info']))
		{
			foreach($fees_info[0]['transport_info'] as $val)
			{
				$complete_status=0;
				if(isset($val['payment_history']) && !empty($val['payment_history']))
				{
					foreach($val['payment_history'] as $pay_his)
					{
						$complete_status=$pay_his['complete_status'];
					}
				}
				?>
                <div id='ex_div_<?=$val['id']?>'>
				<?php 
				if($complete_status==0)
				{
				?>
				<table class="staff_table">
					<tr><td colspan="3"><?=$val['bill_name']?></td></tr>
					<tr><td width="252">From Date</td><td width="10">:</td><td class="text_bold green"><?=date('d-m-Y',strtotime($val['from_date']))?></td></tr>
                    <tr><td>Due Date</td><td>:</td><td  class="text_bold red"><?=date('d-m-Y',strtotime($val['due_date']))?></td></tr>
                    <?php
						$n_val=0;
                    	if($fees_info[0]['student_type']==2){
							if(isset($val['edit_amt']) && !empty($val['edit_amt']))
								$n_val=$val['edit_amt'][0]['amount'];
							else
								$n_val=$val['amount'];
					?>
                    <tr><td>Amount</td><td>:</td><td class="text_bold">
                    	<?=$n_val?>
                    	<input type="button"  class='edit_btn btn bg-navy btn-sm' id='edit_btn_<?=$val['id']?>' value='Edit' />&nbsp;
                        <input type="text" placeholder="Amount" class='edit_amt' id='edit_amt_<?=$val['id']?>' style="display:none;" />&nbsp;
                        <input type="text" placeholder="Reason" class='edit_text' id='edit_text_<?=$val['id']?>' style="display:none;" />
                        </td></tr>
                    <?php }else{
							if(isset($val['edit_amt']) && !empty($val['edit_amt']))
								$n_val=$val['edit_amt'][0]['amount'];
							else
								$n_val=$val['amount']+$val['management_amount'];
						?>
                     <tr><td>Amount</td><td>:</td><td class="text_bold">
                    	<?=$n_val?>
                     	<input type="button" class='edit_btn1 btn bg-navy btn-sm' id='edit_btn1_<?=$val['id']?>' value='Edit' />&nbsp;
                     	<input type="text" placeholder="Amount" class='edit_amt' id='edit_amt_<?=$val['id']?>' style="display:none;" />&nbsp;
                         <input type="text"  placeholder="Reason" class='edit_text' id='edit_text_<?=$val['id']?>' style="display:none;" />
                        </td></tr>
                     <?php }?> 
                    <tr>
                    <input type="hidden" value="<?=$n_val?>" id='bill_amt_<?=$val['id']?>' >
                    	<td>Fine</td><td>:</td>
                    	<td class="text_bold">
                        	 	<?php
								$f_amt=0;
								if($val['fain']=='yes'){
									if(date('Y-m-d')>$val['due_date'])
									{
									$datetime1 = date_create(date('Y-m-d'));
									$datetime2 = date_create($val['due_date']);
									$interval = date_diff($datetime1, $datetime2);
									$days=$interval->format('%d');
										if($val['fain_type']=='day')
											$f_amt=$val['fain_amount']*$days;
										else if($val['fain_type']=='week')
										{
											$per=$days/7;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
											
										}
										else if($val['fain_type']=='month')
										{
											$per=$days/30;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
										}		
									}
								?>
                        	<span id='ful_fine_<?=$val['id']?>'><?=$f_amt?></span> (<?=$val['fain_amount'].' / '.ucfirst($val['fain_type'])?>)
                            
                            <?php }else{?>
                            <span id='ful_fine_<?=$val['id']?>'>0</span>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Total
                        </td><td>:</td>
                    	<td class="text_bold">
                        	<?php $full_amt=$n_val+$f_amt?>
                            <span id='fulamt_text_<?=$val['id']?>'><?=$full_amt?></span>
                            <input type="hidden" value="<?=$full_amt?>" id='ful_amt_<?=$val['id']?>' />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Paid Amount
                        </td><td>:</td>
                    	<td class="text_bold">
                        	<?php 
							$pay_history=array();
							if(isset($val['payment_history']) && !empty($val['payment_history']))
							{
								foreach($val['payment_history'] as $pay_his)
								{
									$pay_history[]=$pay_his['amount'];
								}
							}
							$paid_amt=0;
							$paid_amt=array_sum($pay_history)?>
                            <span id='paid_text_<?=$val['id']?>'><?=$paid_amt?></span>
                            <input type="hidden" value="<?=$paid_amt?>" id='paid_amt_<?=$val['id']?>' />
                             <a href="#history_<?=$val['id']?>" data-toggle="modal" title="In-Active" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a>
                        </td>
                    </tr>
                    <tr>
                    	<td>Payment Mode</td><td>:</td>
                    	<td class="text_bold">
                        	<select  id='p_mode_<?=$val['id']?>' class='payment_mode'>
                            	<option value=''>Select</option>
                                <option selected="selected" value='1'>Cash</option>
                                <option value='2'>Cheque</option>
                                <option value='3'>DD</option>
                            </select>
                        </td>
                    </tr>
                    <tr  id='p_amt_<?=$val['id']?>'>
                    	<td>Paying Amount</td><td>:</td>
                    	<td class="text_bold">
                        	<input type="hidden" value="<?=$fees_info[0]['std_id']?>" id='roll_no_<?=$val['id']?>' />
                        	<input type="text" class='pay_amt' id='pay_amt_<?=$val['id']?>' />&nbsp;
                            <input type="text" value="<?=$full_amt-$paid_amt?>" readonly="readonly" id='bal_amt_<?=$val['id']?>'  placeholder="Balance" /><br />
                            <input type="button" value="Pay"  id='pay_btn_<?=$val['id']?>'  class="btn btn-success pay_btn btn-sm" /><br />
                            <input type="button" value="Complete" style="display:none"  id='com_btn_<?=$val['id']?>' class="btn btn-warning com_pay btn-sm"/>
                        </td>
                    </tr>
                    <tr  id='p_del_<?=$val['id']?>' style="display:none">
                    	<td>Payment Details</td><td>:</td>
                    	<td class="text_bold">
                        	
                            <input type="text" id='pay_bank_<?=$val['id']?>'   placeholder="Bank Name"/>
                            <input type="text" id='pay_branch_<?=$val['id']?>'  placeholder="Brach"/>
                            <input type="text" id='pay_cheque_<?=$val['id']?>'   placeholder="Cheque / DD No"/>
                            <input type="text"  class='pay_1amt' id='pay_1amt_<?=$val['id']?>' placeholder="Paying Amount"/>
                            <input type="text" value="<?=$full_amt-$paid_amt?>"  readonly="readonly" id='bal_1amt_<?=$val['id']?>'  placeholder="Balance" /><br />
                            <input type="button" value="Pay" id='pay_1btn_<?=$val['id']?>'  class="btn btn-success pay_btn btn-sm" />
                            <input type="button" value="Complete" style="display:none"  id='com_1btn_<?=$val['id']?>' class="btn btn-warning com_pay"/>
                        </td>
                    </tr>
				</table>
                  <?php 
				}else
				{
					?>
                    	<table>
                        	<tr>
                            	<td width="272"><?=$val['bill_name']?></td>
                                <td>Amount Paid Successfully...</td>
                                <td><a href="#history_<?=$val['id']?>" data-toggle="modal" title="In-Active" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a></td>
                            </tr>
                        </table>
                    <?php
				}
				?>
                <br />
                </div>
				<?php 
			}	
		}
		else
			echo "No Transport Fees for this Student...";
	?>
</div>
=======
    <a href="#profile_img" data-toggle="modal"><img class="add_staff_thumbnail" src="<?=$this->config->item('base_url')?>profile_image/student/orginal/<?=$fees_info[0]['image']?>" /></a>
    </td>
    </tr>
    <tr><td>Batch</td><td>:</td><td class="text_bold"><?=$fees_info[0]['from'].'-'.$fees_info[0]['to']?></td></tr>
    <tr><td>Department</td><td>:</td><td class="text_bold"><?=$fees_info[0]['department'].'-'.$fees_info[0]['group']?></td></tr>
    <tr><td>Email Id</td><td>:</td><td class="text_bold"><?=$fees_info[0]['email_id']?></td></tr>
    <tr><td>&nbsp;</td></tr>
</table>
<div id='exam_info'>
	<div class="fees_tit">Semester / Other Fees</div>
    <?php
		if(isset($fees_info[0]['exam_info']) && !empty($fees_info[0]['exam_info']))
		{
			foreach($fees_info[0]['exam_info'] as $val)
			{
				 $complete_status=0;
				if(isset($val['payment_history']) && !empty($val['payment_history']))
				{
					foreach($val['payment_history'] as $pay_his)
					{
						$complete_status=$pay_his['complete_status'];
					}
				}
				?>
                <div id='ex_div_<?=$val['id']?>'>
                <input type="hidden"  class='exam_type' id='exam_type_<?=$val['id']?>' value='semester' />
                <input type="hidden" value="<?=$fees_info[0]['std_id']?>" id='roll_no_<?=$val['id']?>' />
                <?php 
				if($complete_status==0)
				{
				?>
                
				<table class="staff_table" width="100%">
					<tr><td colspan="3"><?=$val['bill_name']?></td></tr>
					<tr><td width="252">From Date</td><td width="10">:</td><td class="text_bold green"><?=date('d-m-Y',strtotime($val['from_date']))?></td></tr>
                    <tr><td>Due Date</td><td>:</td><td class="text_bold red"><?=date('d-m-Y',strtotime($val['due_date']))?></td></tr>
                    <?php
						$n_val=0;
                    	if($fees_info[0]['student_type']==2){
							if(isset($val['edit_amt']) && !empty($val['edit_amt']))
								$n_val=$val['edit_amt'][0]['amount'];
							else
								$n_val=$val['amount'];
					?>
                    <tr><td>Amount</td><td>:</td><td class="text_bold">
                    	<?=$n_val?>
                    	<input type="button"  class='edit_btn btn bg-navy btn-sm' id='edit_btn_<?=$val['id']?>' value='Edit' />&nbsp; &nbsp; 
                        <input type="text" placeholder="Amount" class='edit_amt' id='edit_amt_<?=$val['id']?>' style="display:none;" />&nbsp;
                        <input type="text" placeholder="Reason" class='edit_text' id='edit_text_<?=$val['id']?>' style="display:none;" />
                        </td></tr>
                    <?php }else{
							if(isset($val['edit_amt']) && !empty($val['edit_amt']))
								$n_val=$val['edit_amt'][0]['amount'];
							else
								$n_val=$val['amount']+$val['management_amount'];
						?>
                     <tr><td class="vtop">Amount</td><td class="vtop">:</td><td class="text_bold">
                    	<?=$n_val?>
                     	<input type="button" class='edit_btn1 btn bg-navy btn-sm' id='edit_btn1_<?=$val['id']?>' value='Edit' />&nbsp; &nbsp; 
                   	<input type="text" placeholder="Amount" class='edit_amt' id='edit_amt_<?=$val['id']?>' style="display:none;" /> &nbsp; 
                         <input type="text"  placeholder="Reason" class='edit_text' id='edit_text_<?=$val['id']?>' style="display:none;" />
                        </td></tr>
                     <?php }?> 
                    <tr>
                    <input type="hidden" value="<?=$n_val?>" id='bill_amt_<?=$val['id']?>' >
                    	<td>Fine</td>
                        <td>:</td>
                    	<td class="text_bold">
                        	 	<?php
								$f_amt=0;
								if($val['fain']=='yes')
								{
									if(date('Y-m-d') > $val['due_date'])
									{
										$datetime1 = date_create(date('Y-m-d'));
										$datetime2 = date_create($val['due_date']);
										$interval = date_diff($datetime1, $datetime2);
										$days=$interval->format('%d');
										if($val['fain_type']=='day')
										{
											$f_amt=$val['fain_amount']*$days;
										}
										else if($val['fain_type']=='week')
										{
											$per=$days/7;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
											
										}
										else if($val['fain_type']=='month')
										{
											$per=$days/30;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
										}		
									}
								?>
                        	<span id='ful_fine_<?=$val['id']?>'><?=$f_amt?></span> (<?=$val['fain_amount'].' / '.ucfirst($val['fain_type'])?>)
                            
                            <?php }else{?>
                            <span id='ful_fine_<?=$val['id']?>'>0</span>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Total
                        </td>
                        <td>:</td>
                    	<td class="text_bold">
                        	<?php $full_amt=$n_val+$f_amt?>
                            <span id='fulamt_text_<?=$val['id']?>'><?=$full_amt?></span>
                            <input type="hidden" value="<?=$full_amt?>" id='ful_amt_<?=$val['id']?>' />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Paid Amount
                        </td>
                        <td>:</td>
                    	<td class="text_bold">
                        	<?php 
							$pay_history=array();
							if(isset($val['payment_history']) && !empty($val['payment_history']))
							{
								foreach($val['payment_history'] as $pay_his)
								{
									$pay_history[]=$pay_his['amount'];
								}
							}
							$paid_amt=0;
							$paid_amt=array_sum($pay_history)?>
                            <span id='paid_text_<?=$val['id']?>'><?=$paid_amt?></span>
                            <input type="hidden" value="<?=$paid_amt?>" id='paid_amt_<?=$val['id']?>' />
                             <a href="#history_<?=$val['id']?>" data-toggle="modal" title="In-Active" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a>
                             <input type="button" id='print_fees_<?=$val['id']?>' class="btn bg-maroon btn-sm print_btn" value="View" />
                        </td>
                    </tr>
                    <tr>
                    	<td>Payment Mode</td>
                        <td>:</td>
                    	<td class="text_bold">
                        	<select  id='p_mode_<?=$val['id']?>' class='payment_mode mandatory'>
                            	<option value=''>Select</option>
                                <option selected="selected" value='1'>Cash</option>
                                <option value='2'>Cheque</option>
                                <option value='3'>DD</option>
                            </select>
                        </td>
                    </tr>
                    </table>
                    <table class="staff_table">
                    <tr id='p_amt_<?=$val['id']?>'>
                    	<td width="252">Paying Amount</td>
                        <td width="10">:</td>
                    	<td class="text_bold">
                        	
                        	<input type="text" class='pay_amt mandatory' id='pay_amt_<?=$val['id']?>' />&nbsp;
                            <input type="text"  class="" value="<?=$full_amt-$paid_amt?>" readonly="readonly" id='bal_amt_<?=$val['id']?>'  placeholder="Balance" /><br />
                            <input type="button" value="Pay"  id='pay_btn_<?=$val['id']?>'  class="btn btn-success pay_btn btn-sm" /><br />
                            <input type="button" value="Complete" style="display:none;"  id='com_btn_<?=$val['id']?>' class="btn btn-warning btn-sm com_pay"/>
                        </td>
                    </tr>
                    </table>
                    <table class="staff_table">
                    <tr id='p_del_<?=$val['id']?>' style="display:none">
                    	<td width="252">Payment&nbsp;Details</td>
                        <td width="10">:</td>
                    	<td class="text_bold">
                        	
                            <input type="text" id='pay_bank_<?=$val['id']?>'   placeholder="Bank Name"/>
                            <input type="text" id='pay_branch_<?=$val['id']?>'  placeholder="Brach"/>
                            <input type="text" id='pay_cheque_<?=$val['id']?>'   placeholder="Cheque / DD No"/>
                            <input type="text"  class='pay_1amt' id='pay_1amt_<?=$val['id']?>' placeholder="Paying Amount"/>
                            <input type="text" value="<?=$full_amt-$paid_amt?>"  readonly="readonly" id='bal_1amt_<?=$val['id']?>'  placeholder="Balance" /><br />
                            <input type="button" value="Pay" id='pay_1btn_<?=$val['id']?>'  class="btn btn-success pay_btn btn-sm" /><br />
                            <input type="button" value="Complete" style="display:none"  id='com_1btn_<?=$val['id']?>' class="btn btn-warning com_pay btn-sm"/>
                        </td>
                    </tr>
				</table>
                  <?php 
				}
				else
				{
					$total_amt=array();
					if(isset($val['payment_history']) && !empty($val['payment_history']))
					{
						foreach($val['payment_history'] as $pay_his)
						{
							$total_amt[]=$pay_his['amount'];
							$last_date=$pay_his['created_date'];
						}
					}
					?>
                    	<table>
                        	<tr style="background: #FAFAFA;">
                            	<td width="272"><?=$val['bill_name']?></td>
                                <td><b>Rs <?=array_sum($total_amt)?></b> Amount Paid Successfully on <b><?=date('d-M-Y',strtotime($last_date))?></b>....</td>
                                <td width="30%"><a href="#history_<?=$val['id']?>" data-toggle="modal" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a>
                                <input type="button" id='print_fees_<?=$val['id']?>' class="btn bg-maroon btn-sm print_btn" value="View" />
                                </td>
                            </tr>
                        </table>
                    <?php
				}
				?>
                <br />
                </div>
				<?php 
			}	
		}
		else
		{
			echo "No Semester / Other Fees for this Student...";
		}
	?>
</div>
<div id='hostel_info' style="display:none;">
<div class="fees_tit">Hostel Fees</div>
	<?php
		if(isset($fees_info[0]['hostel_info']) && !empty($fees_info[0]['hostel_info']))
		{
			foreach($fees_info[0]['hostel_info'] as $val)
			{
				$complete_status=0;
				if(isset($val['payment_history']) && !empty($val['payment_history']))
				{
					foreach($val['payment_history'] as $pay_his)
					{
						$complete_status=$pay_his['complete_status'];
					}
				}
				?>
                <input type="hidden"  class='exam_type' id='exam_type_<?=$val['id']?>' value='hostel' />
                <input type="hidden" value="<?=$fees_info[0]['std_id']?>" id='roll_no_<?=$val['id']?>' />
                <div id='ex_div_<?=$val['id']?>'>
				<?php 
				if($complete_status==0)
				{
				?>
				<table class="staff_table">
					<tr><td colspan="3"><?=$val['bill_name']?></td></tr>
					<tr><td width="252">From Date</td><td width="10">:</td><td class="text_bold green"><?=date('d-m-Y',strtotime($val['from_date']))?></td></tr>
                    <tr><td>Due Date</td><td>:</td><td class="text_bold red"><?=date('d-m-Y',strtotime($val['due_date']))?></td></tr>
                    <?php
						$n_val=0;
                    	if($fees_info[0]['student_type']==2){
							if(isset($val['edit_amt']) && !empty($val['edit_amt']))
								$n_val=$val['edit_amt'][0]['amount'];
							else
								$n_val=$val['amount'];
					?>
                    <tr><td>Amount</td><td>:</td><td class="text_bold">
                    	<?=$n_val?>
                    	<input type="button"  class='edit_btn btn bg-navy btn-sm' id='edit_btn_<?=$val['id']?>' value='Edit' />
                        <input type="text" placeholder="Amount" class='edit_amt' id='edit_amt_<?=$val['id']?>' style="display:none;" />&nbsp;
                        <input type="text" placeholder="Reason" class='edit_text' id='edit_text_<?=$val['id']?>' style="display:none;" />
                        </td></tr>
                    <?php }else{
							if(isset($val['edit_amt']) && !empty($val['edit_amt']))
								$n_val=$val['edit_amt'][0]['amount'];
							else
								$n_val=$val['amount']+$val['management_amount'];
						?>
                     <tr><td>Amount</td><td>:</td><td class="text_bold">
                    	<?=$n_val?>
                     	<input type="button" class='edit_btn1 btn bg-navy btn-sm' id='edit_btn1_<?=$val['id']?>' value='Edit' />&nbsp;
                     	<input type="text" placeholder="Amount" class='edit_amt' id='edit_amt_<?=$val['id']?>' style="display:none;" />&nbsp;
                         <input type="text"  placeholder="Reason" class='edit_text' id='edit_text_<?=$val['id']?>' style="display:none;" />
                        </td></tr>
                     <?php }?> 
                    <tr>
                    <input type="hidden" value="<?=$n_val?>" id='bill_amt_<?=$val['id']?>' >
                    	<td>Fine</td><td>:</td>
                    	<td class="text_bold">
                        	 	<?php
								$f_amt=0;
								if($val['fain']=='yes'){
									if(date('Y-m-d')>$val['due_date'])
									{
									$datetime1 = date_create(date('Y-m-d'));
									$datetime2 = date_create($val['due_date']);
									$interval = date_diff($datetime1, $datetime2);
									$days=$interval->format('%d');
									
										if($val['fain_type']=='day')
											$f_amt=$val['fain_amount']*$days;
										else if($val['fain_type']=='week')
										{
											$per=$days/7;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
											
										}
										else if($val['fain_type']=='month')
										{
											$per=$days/30;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
										}		
									}
								?>
                        	<span id='ful_fine_<?=$val['id']?>'><?=$f_amt?></span> (<?=$val['fain_amount'].' / '.ucfirst($val['fain_type'])?>)
                            
                            <?php }else{?>
                            <span id='ful_fine_<?=$val['id']?>'>0</span>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Total
                        </td><td>:</td>
                    	<td class="text_bold">
                        	<?php $full_amt=$n_val+$f_amt?>
                            <span id='fulamt_text_<?=$val['id']?>'><?=$full_amt?></span>
                            <input type="hidden" value="<?=$full_amt?>" id='ful_amt_<?=$val['id']?>' />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Paid Amount
                        </td><td>:</td>
                    	<td class="text_bold">
                        	<?php 
							$pay_history=array();
							if(isset($val['payment_history']) && !empty($val['payment_history']))
							{
								foreach($val['payment_history'] as $pay_his)
								{
									$pay_history[]=$pay_his['amount'];
								}
							}
							$paid_amt=0;
							$paid_amt=array_sum($pay_history)?>
                            <span id='paid_text_<?=$val['id']?>'><?=$paid_amt?></span>
                            <input type="hidden" value="<?=$paid_amt?>" id='paid_amt_<?=$val['id']?>' />
                             <a href="#history_<?=$val['id']?>" data-toggle="modal" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a>
                             <input type="button" id='print_fees_<?=$val['id']?>' class="btn bg-maroon btn-sm print_btn" value="View" />
                        </td>
                    </tr>
                    <tr>
                    	<td>Payment Mode</td><td>:</td>
                    	<td class="text_bold">
                        	<select  id='p_mode_<?=$val['id']?>' class='payment_mode'>
                            	<option value=''>Select</option>
                                <option selected="selected" value='1'>Cash</option>
                                <option value='2'>Cheque</option>
                                <option value='3'>DD</option>
                            </select>
                        </td>
                    </tr>
                    <tr  id='p_amt_<?=$val['id']?>'>
                    	<td>Paying Amount</td><td>:</td>
                    	<td class="text_bold">
                        	<input type="hidden" value="<?=$fees_info[0]['std_id']?>" id='roll_no_<?=$val['id']?>' />
                        	<input type="text" class='pay_amt' id='pay_amt_<?=$val['id']?>' />&nbsp;
                            <input type="text" value="<?=$full_amt-$paid_amt?>" readonly="readonly" id='bal_amt_<?=$val['id']?>'  placeholder="Balance" /><br />
                            <input type="button" value="Pay"  id='pay_btn_<?=$val['id']?>'  class="btn btn-success pay_btn btn-sm" /><br />
                            <input type="button" value="Complete" style="display:none"  id='com_btn_<?=$val['id']?>' class="btn btn-warning com_pay btn-sm"/>
                        </td>
                    </tr>
                    <tr  id='p_del_<?=$val['id']?>' style="display:none">
                    	<td>Payment Details</td><td>:</td>
                    	<td class="text_bold">
                        	
                            <input type="text" id='pay_bank_<?=$val['id']?>'   placeholder="Bank Name"/>
                            <input type="text" id='pay_branch_<?=$val['id']?>'  placeholder="Brach"/>
                            <input type="text" id='pay_cheque_<?=$val['id']?>'   placeholder="Cheque / DD No"/>
                            <input type="text"  class='pay_1amt' id='pay_1amt_<?=$val['id']?>' placeholder="Paying Amount"/>
                            <input type="text" value="<?=$full_amt-$paid_amt?>"  readonly="readonly" id='bal_1amt_<?=$val['id']?>'  placeholder="Balance" /><br />
                            <input type="button" value="Pay" id='pay_1btn_<?=$val['id']?>'  class="btn btn-success pay_btn btn-sm" />
                            <input type="button" value="Complete" style="display:none"  id='com_1btn_<?=$val['id']?>' class="btn btn-warning com_pay"/>
                        </td>
                    </tr>
				</table>
                  <?php 
				}else
				{
					$total_amt=array();
					if(isset($val['payment_history']) && !empty($val['payment_history']))
					{
						foreach($val['payment_history'] as $pay_his)
						{
							$total_amt[]=$pay_his['amount'];
							$last_date=$pay_his['created_date'];
						}
					}
					?>
                    	<table class="staff_table">
                        	<tr bgcolor="#FAFAFA">
                            	<td width="272"><?=$val['bill_name']?></td>
                               <td><b><?=array_sum($total_amt)?></b> Amount Paid Successfully on <b><?=date('d-M-Y',strtotime($last_date))?></b>....</td>
                                <td  width="30%"><a href="#history_<?=$val['id']?>" data-toggle="modal" title="In-Active" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a>
                                <input type="button" id='print_fees_<?=$val['id']?>' class="btn bg-maroon print_btn btn-sm" value="View" />
                                </td>
                            </tr>
                        </table>
                    <?php
				}
				?>
                <br />
                </div>
				<?php 
			}	
		}
		else
			echo "No Hostel Fees for this Student...";
	?>
</div>
<div id='transport_info'  style="display:none;">
<div class="fees_tit">Transport Fees</div>
	<?php
		if(isset($fees_info[0]['transport_info']) && !empty($fees_info[0]['transport_info']))
		{
			foreach($fees_info[0]['transport_info'] as $val)
			{
				$complete_status=0;
				if(isset($val['payment_history']) && !empty($val['payment_history']))
				{
					foreach($val['payment_history'] as $pay_his)
					{
						$complete_status=$pay_his['complete_status'];
					}
				}
				?>
                <div id='ex_div_<?=$val['id']?>'>
				<?php 
				if($complete_status==0)
				{
				?>
				<table class="staff_table">
					<tr><td colspan="3"><?=$val['bill_name']?></td></tr>
					<tr><td width="252">From Date</td><td width="10">:</td><td class="text_bold green"><?=date('d-m-Y',strtotime($val['from_date']))?></td></tr>
                    <tr><td>Due Date</td><td>:</td><td  class="text_bold red"><?=date('d-m-Y',strtotime($val['due_date']))?></td></tr>
                    <?php
						$n_val=0;
                    	if($fees_info[0]['student_type']==2){
							if(isset($val['edit_amt']) && !empty($val['edit_amt']))
								$n_val=$val['edit_amt'][0]['amount'];
							else
								$n_val=$val['amount'];
					?>
                    <tr><td>Amount</td><td>:</td><td class="text_bold">
                    	<?=$n_val?>
                    	<input type="button"  class='edit_btn btn bg-navy btn-sm' id='edit_btn_<?=$val['id']?>' value='Edit' />&nbsp;
                        <input type="text" placeholder="Amount" class='edit_amt' id='edit_amt_<?=$val['id']?>' style="display:none;" />&nbsp;
                        <input type="text" placeholder="Reason" class='edit_text' id='edit_text_<?=$val['id']?>' style="display:none;" />
                        </td></tr>
                    <?php }else{
							if(isset($val['edit_amt']) && !empty($val['edit_amt']))
								$n_val=$val['edit_amt'][0]['amount'];
							else
								$n_val=$val['amount']+$val['management_amount'];
						?>
                     <tr><td>Amount</td><td>:</td><td class="text_bold">
                    	<?=$n_val?>
                     	<input type="button" class='edit_btn1 btn bg-navy btn-sm' id='edit_btn1_<?=$val['id']?>' value='Edit' />&nbsp;
                     	<input type="text" placeholder="Amount" class='edit_amt' id='edit_amt_<?=$val['id']?>' style="display:none;" />&nbsp;
                         <input type="text"  placeholder="Reason" class='edit_text' id='edit_text_<?=$val['id']?>' style="display:none;" />
                        </td></tr>
                     <?php }?> 
                    <tr>
                    <input type="hidden" value="<?=$n_val?>" id='bill_amt_<?=$val['id']?>' >
                    	<td>Fine</td><td>:</td>
                    	<td class="text_bold">
                        	 	<?php
								$f_amt=0;
								if($val['fain']=='yes'){
									if(date('Y-m-d')>$val['due_date'])
									{
									$datetime1 = date_create(date('Y-m-d'));
									$datetime2 = date_create($val['due_date']);
									$interval = date_diff($datetime1, $datetime2);
									$days=$interval->format('%d');
										if($val['fain_type']=='day')
											$f_amt=$val['fain_amount']*$days;
										else if($val['fain_type']=='week')
										{
											$per=$days/7;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
											
										}
										else if($val['fain_type']=='month')
										{
											$per=$days/30;
											if(intval($per)>0)
												$f_amt=$val['fain_amount']*intval($per);
											else
												$f_amt=$val['fain_amount']+intval($per);
										}		
									}
								?>
                        	<span id='ful_fine_<?=$val['id']?>'><?=$f_amt?></span> (<?=$val['fain_amount'].' / '.ucfirst($val['fain_type'])?>)
                            
                            <?php }else{?>
                            <span id='ful_fine_<?=$val['id']?>'>0</span>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Total
                        </td><td>:</td>
                    	<td class="text_bold">
                        	<?php $full_amt=$n_val+$f_amt?>
                            <span id='fulamt_text_<?=$val['id']?>'><?=$full_amt?></span>
                            <input type="hidden" value="<?=$full_amt?>" id='ful_amt_<?=$val['id']?>' />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Paid Amount
                        </td><td>:</td>
                    	<td class="text_bold">
                        	<?php 
							$pay_history=array();
							if(isset($val['payment_history']) && !empty($val['payment_history']))
							{
								foreach($val['payment_history'] as $pay_his)
								{
									$pay_history[]=$pay_his['amount'];
								}
							}
							$paid_amt=0;
							$paid_amt=array_sum($pay_history)?>
                            <span id='paid_text_<?=$val['id']?>'><?=$paid_amt?></span>
                            <input type="hidden" value="<?=$paid_amt?>" id='paid_amt_<?=$val['id']?>' />
                             <a href="#history_<?=$val['id']?>" data-toggle="modal" title="In-Active" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a>
                        </td>
                    </tr>
                    <tr>
                    	<td>Payment Mode</td><td>:</td>
                    	<td class="text_bold">
                        	<select  id='p_mode_<?=$val['id']?>' class='payment_mode'>
                            	<option value=''>Select</option>
                                <option selected="selected" value='1'>Cash</option>
                                <option value='2'>Cheque</option>
                                <option value='3'>DD</option>
                            </select>
                        </td>
                    </tr>
                    <tr  id='p_amt_<?=$val['id']?>'>
                    	<td>Paying Amount</td><td>:</td>
                    	<td class="text_bold">
                        	<input type="hidden" value="<?=$fees_info[0]['std_id']?>" id='roll_no_<?=$val['id']?>' />
                        	<input type="text" class='pay_amt' id='pay_amt_<?=$val['id']?>' />&nbsp;
                            <input type="text" value="<?=$full_amt-$paid_amt?>" readonly="readonly" id='bal_amt_<?=$val['id']?>'  placeholder="Balance" /><br />
                            <input type="button" value="Pay"  id='pay_btn_<?=$val['id']?>'  class="btn btn-success pay_btn btn-sm" /><br />
                            <input type="button" value="Complete" style="display:none"  id='com_btn_<?=$val['id']?>' class="btn btn-warning com_pay btn-sm"/>
                        </td>
                    </tr>
                    <tr  id='p_del_<?=$val['id']?>' style="display:none">
                    	<td>Payment Details</td><td>:</td>
                    	<td class="text_bold">
                        	
                            <input type="text" id='pay_bank_<?=$val['id']?>'   placeholder="Bank Name"/>
                            <input type="text" id='pay_branch_<?=$val['id']?>'  placeholder="Brach"/>
                            <input type="text" id='pay_cheque_<?=$val['id']?>'   placeholder="Cheque / DD No"/>
                            <input type="text"  class='pay_1amt' id='pay_1amt_<?=$val['id']?>' placeholder="Paying Amount"/>
                            <input type="text" value="<?=$full_amt-$paid_amt?>"  readonly="readonly" id='bal_1amt_<?=$val['id']?>'  placeholder="Balance" /><br />
                            <input type="button" value="Pay" id='pay_1btn_<?=$val['id']?>'  class="btn btn-success pay_btn btn-sm" />
                            <input type="button" value="Complete" style="display:none"  id='com_1btn_<?=$val['id']?>' class="btn btn-warning com_pay"/>
                        </td>
                    </tr>
				</table>
                  <?php 
				}else
				{
					?>
                    	<table>
                        	<tr>
                            	<td width="272"><?=$val['bill_name']?></td>
                                <td>Amount Paid Successfully...</td>
                                <td><a href="#history_<?=$val['id']?>" data-toggle="modal" title="In-Active" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a></td>
                            </tr>
                        </table>
                    <?php
				}
				?>
                <br />
                </div>
				<?php 
			}	
		}
		else
		{
			echo "No Transport Fees for this Student...";
		}
	?>
</div>
>>>>>>> .r2968

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(-37.92, 151.25),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false,
      streetViewControl: false,
      panControl: false,
      zoomControlOptions: {
         position: google.maps.ControlPosition.LEFT_BOTTOM
      }
    });

    var infowindow = new google.maps.InfoWindow({
      maxWidth: 160
    });

    var marker;
    var markers = new Array();
    
    var iconCounter = 0;
    
    // Add the markers and infowindows to the map
    for (var i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon : icons[iconCounter],
        shadow: shadow
      });

      markers.push(marker);

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
      
      iconCounter++;
      // We only have a limited number of possible icon colors, so we may have to restart the counter
      if(iconCounter >= icons_length){
      	iconCounter = 0;
      }
    }

    function AutoCenter() {
      //  Create a new viewpoint bound
      var bounds = new google.maps.LatLngBounds();
      //  Go through each...
      $.each(markers, function (index, marker) {
        bounds.extend(marker.position);
      });
      //  Fit these bounds to the map
      map.fitBounds(bounds);
    }
    AutoCenter();
	}
<<<<<<< .mine
  </script> 
</body>
</html>||||||| .r1779
?>
<?php 
	if(isset($fees_info[0]['hostel_info']) && !empty($fees_info[0]['hostel_info']))
	{
		foreach($fees_info[0]['hostel_info'] as $val)
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
					if(isset($val['payment_history']) && !empty($val['payment_history']))
					{
						foreach($val['payment_history'] as $pay_his)
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
					if(isset($val['edit_amt']) && !empty($val['edit_amt']))
					{
						?>
                        	<table class="staff_table_sub">
                            	<thead>
                                <tr>
                                	<th colspan="2">Amount Modified</th>
                                </tr>
                                </thead>
                                <tr>
                                	<td>Amount</td>
                                    <td><?=$val['edit_amt'][0]['amount']?></td>
                                </tr>
                                 <tr>
                                	<td>Reason</td>
                                    <td><?=$val['edit_amt'][0]['reason']?></td>
                                </tr>
                            </table>
                        <?php
								$n_val=$val['edit_amt'][0]['amount'];
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
<?php 
	if(isset($fees_info[0]['transport_info']) && !empty($fees_info[0]['transport_info']))
	{
		foreach($fees_info[0]['transport_info'] as $val)
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
					if(isset($val['payment_history']) && !empty($val['payment_history']))
					{
						foreach($val['payment_history'] as $pay_his)
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
					if(isset($val['edit_amt']) && !empty($val['edit_amt']))
					{
						?>
                        	<table class="staff_table_sub">
                            	<thead>
                                <tr>
                                	<th colspan="2">Amount Modified</th>
                                </tr>
                                </thead>
                                <tr>
                                	<td>Amount</td>
                                    <td><?=$val['edit_amt'][0]['amount']?></td>
                                </tr>
                                 <tr>
                                	<td>Reason</td>
                                    <td><?=$val['edit_amt'][0]['reason']?></td>
                                </tr>
                            </table>
                        <?php
								$n_val=$val['edit_amt'][0]['amount'];
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

<div id="profile_img" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<a class="close" data-dismiss="modal">×</a>
<h3 id="myModalLabel">Profile Image</h3>
</div>
<div class="modal-body">
<img src="<?=$this->config->item('base_url')?>profile_image/student/thumb/<?=$fees_info[0]['image']?>" width="50%" />
</div>
</div>
</div>
</div>=======
?>
<?php 
	if(isset($fees_info[0]['hostel_info']) && !empty($fees_info[0]['hostel_info']))
	{
		foreach($fees_info[0]['hostel_info'] as $val)
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
					if(isset($val['payment_history']) && !empty($val['payment_history']))
					{
						foreach($val['payment_history'] as $pay_his)
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
					if(isset($val['edit_amt']) && !empty($val['edit_amt']))
					{
						?>
                        	<table class="staff_table_sub">
                            	<thead>
                                <tr>
                                	<th colspan="2">Amount Modified</th>
                                </tr>
                                </thead>
                                <tr>
                                	<td>Amount</td>
                                    <td><?=$val['edit_amt'][0]['amount']?></td>
                                </tr>
                                 <tr>
                                	<td>Reason</td>
                                    <td><?=$val['edit_amt'][0]['reason']?></td>
                                </tr>
                            </table>
                        <?php
								$n_val=$val['edit_amt'][0]['amount'];
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
<?php 
	if(isset($fees_info[0]['transport_info']) && !empty($fees_info[0]['transport_info']))
	{
		foreach($fees_info[0]['transport_info'] as $val)
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
					if(isset($val['payment_history']) && !empty($val['payment_history']))
					{
						foreach($val['payment_history'] as $pay_his)
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
					if(isset($val['edit_amt']) && !empty($val['edit_amt']))
					{
						?>
                        	<table class="staff_table_sub">
                            	<thead>
                                <tr>
                                	<th colspan="2">Amount Modified</th>
                                </tr>
                                </thead>
                                <tr>
                                	<td>Amount</td>
                                    <td><?=$val['edit_amt'][0]['amount']?></td>
                                </tr>
                                 <tr>
                                	<td>Reason</td>
                                    <td><?=$val['edit_amt'][0]['reason']?></td>
                                </tr>
                            </table>
                        <?php
								$n_val=$val['edit_amt'][0]['amount'];
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

<div id="profile_img" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<a class="close" data-dismiss="modal">×</a>
<h3 id="myModalLabel">Profile Image</h3>
</div>
<div class="modal-body">
<img src="<?=$this->config->item('base_url')?>profile_image/student/orginal/<?=$fees_info[0]['image']?>" width="50%" />
</div>
</div>
</div>
</div>>>>>>>> .r2968

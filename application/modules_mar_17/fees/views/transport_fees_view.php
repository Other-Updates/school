<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>


            <table class="staff_table">
            		<tr>
                        <td width="40%">Bill Name</td>
                        <td width="10">:</td>
                        <td class="text_bold"><?=$fees_info[0]['bill_name']?></td>
                    </tr>
                    <tr>
                        <td>From Date</td>
                        <td>:</td>
                        <td class="text_bold"><?=date('d-M-Y',strtotime($fees_info[0]['from_date']))?></td>
                    </tr>
                    <tr>
                        <td>Due Date</td>
                        <td>:</td>
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
                                    <td>:
                                        </td>
                                    <td class="text_bold"><?=$val['amount']?></td>
                                </tr>
                                <?php
								}
                            }
                        }
                    ?>
                    <tr>
                        <td>Total</td>
                        <td>:</td>
                        <td class="text_bold"><?=$fees_info[0]['amount']?></td>
                    </tr>
                    <tr  style="display:<?=($fees_info[0]['management_amount']=='0')?'none':''?>" >
                        <td>Management</td>
                        <td>:</td>
                        <td class="text_bold"><?=$fees_info[0]['management_amount']?></td>
                    </tr>
                    <tr  style="display:<?=($fees_info[0]['management_amount']=='0')?'none':''?>">
                        <td></td>
                        <td>:</td>
                        <td class="text_bold"><?=$fees_info[0]['amount']+$fees_info[0]['management_amount']?></td>
                    </tr>
                     <tr>
                        <td></td>
                        <td>:</td>
                        <td class="text_bold">
                            <?=($fees_info[0]['fain']=='yes')?'Yes':'No'?>
                           
                        </td>
                    </tr>
                   
                     <tr class='amt_tr' style="display:<?=($fees_info[0]['fain']=='no')?'none':''?>">
                        <td></td>
                        <td>:</td>
                        <td class="text_bold"><?=$fees_info[0]['fain_amount']?> / <?=ucfirst($fees_info[0]['fain_type'])?></td>
                    </tr>
                </table><br />
                <div class="right">
 <?php 
						if($fees_info[0]['status']==1)
						{
						?>
 						<a href="<?=$this->config->item('base_url').'fees/update_exam_fees_view/'.$fees_info[0]['id'].'/2/transport_fees'?>" title="Verified" class="btn bg-maroon">
                        	Verified
                        </a>
                        <?php }else if($fees_info[0]['status']==2){?>
                        	<input type="button" disabled="disabled" class="btn bg-maroon" value='Verified'/>
                            <a href="<?=$this->config->item('base_url').'fees/update_exam_fees_view/'.$fees_info[0]['id'].'/3/transport_fees'?>" title="Closed" class="btn btn-danger">Closed</a>
                            
						 <?php }else if($fees_info[0]['status']==3){?>
                         		<input type="button" disabled="disabled" class="btn btn-danger" value='Closed'/>
						 <?php }?>
						 </div><br /><br />
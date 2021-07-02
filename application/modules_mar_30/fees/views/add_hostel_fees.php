    <?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
		<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/jquery.datetimepicker.css" />
		<script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.datetimepicker.js"></script>
        <form method="post">
            <table>
            		<tr>
                        <td>Bill Name</td>
                        <td></td>
                        <td><input type="text" name='fees_info[bill_name]' value='Hostel Fees' /></td>
                    </tr>
                    <tr>
                        <td>From Date</td>
                        <td></td>
                        <td><input type="text" name='fees_info[from_date]'  class='date'/></td>
                    </tr>
                    <tr>
                        <td>Due Date</td>
                        <td></td>
                        <td><input type="text"  name='fees_info[due_date]'  class='date'/></td>
                    </tr>
                    <?php 
                        if(isset($master_fees) && !empty($master_fees))
                        {
                            foreach($master_fees as $val)
                            {
                                ?>
                                <tr>
                                    <td><?=$val['fees_name']?></td>
                                    <td>
                                        <input type="hidden" value='<?=$val['id']?>'  name='fees_details[master_fees_id][<?=$val['id']?>]' />
                                        <input type="checkbox" id='<?=$val['id']?>'  name='fees_details[master_option][<?=$val['id']?>]' class='master_fees_check' /></td>
                                    <td><input type="text" id='fees_amt_<?=$val['id']?>'  name='fees_details[amount][<?=$val['id']?>]' readonly="readonly" class='fees_amount' /></td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td><input type="text" name='fees_info[amount]' id='total' readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input style="display:none;" type="checkbox" id='mge_check'  /></td>
                        <td><input type="text" id='mge_amt' name='fees_info[management_amount]' style="display:none;" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><input type="text" id='full_mge_total' style="display:none;"  readonly="readonly"/></td>
                    </tr>
                     <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <input type="radio" id='fain_yes' class='fain_type' name='fees_info[fain]' value="yes" /> Yes
                            <input type="radio" class='fain_type'  value="no" id='fain_no' name='fees_info[fain]' checked="checked"   /> No 
                        </td>
                    </tr>
                    <tr class='type_tr' style="display:none">
                        <td></td>
                        <td></td>
                        <td>
                            <input type="radio" name='fees_info[fain_type]' class='pain_option' checked="checked" value='Day'/> Day
                            <input value='Week' name='fees_info[fain_type]' class='pain_option' name='fees_info[fain_type]' type="radio" /> Week 
                            <input value='Month' name='fees_info[fain_type]' class='pain_option'  name='fees_info[fain_type]' type="radio" /> Month 
                        </td>
                    </tr>
                     <tr class='amt_tr' style="display:none">
                        <td></td>
                        <td></td>
                        <td><input type="text"  name='fees_info[fain_amount]' style="width:100px; float:left;" class='fain_amt' /><span  style="position: relative; left: 6px;top: 6px;"  class='per_fees_type'>  / Day</span> </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" class="btn btn-primary"/></td>
                    </tr>
                </table>
                
    </form>
<script type="text/javascript">// <![CDATA[
			$('.date').datetimepicker({
			 lang:'de',
			 i18n:{de:{
			  months:[
			   'January','February','March','April','May','June','July','August','September','October','November','December'
			  ],
			  dayOfWeek:["Su.", "Mo", "Tu", "We", "Th", "Fr", "Sa."]
			 }},
			timepicker:false,
			format:'d-m-Y'
			});
			</script>
            <script type="text/javascript">
	$(document).ready(function(){
		$('#fees_info').hide();
		$('#select_batch').live('change',function(){
			$('#depart_id').val(0);
			$('#select_sem').val(0);
			$('#fees_info').hide();
		});	
	});
	$('#depart_id').live('change',function(){
		$('#select_sem').val(0);
		$('#fees_info').hide();
	});	
	$('#select_sem').live('change',function(){
		$('#fees_info').show();
		if($('#select_sem').val()!=0)
		{
		$.ajax({
		  url:BASE_URL+"fees/check_fees_info",
		  type:'POST',
		  data:{ 
					batch_id : $('#select_batch').val(),
					depart_id : $('#depart_id').val(),
					semester_id : $('#select_sem').val()
					
			   },
		  success:function(result){
			  $('#fees_info').html(result);
		  }    
		});	 
		}
		$('#fees_info').html('');
	});	
	$('.master_fees_check').live('click',function(){
		if($(this).attr('checked')=='checked')
		{
			fees_id=$(this).attr('id');
			$('#fees_amt_'+fees_id).removeAttr('readonly');
			$('#fees_amt_'+fees_id).addClass('mandatory');
		}
		else
		{
			$('#fees_amt_'+fees_id).removeClass('mandatory');
			$('#fees_amt_'+fees_id).css('border-color','');
			fees_id=$(this).attr('id');
			$('#fees_amt_'+fees_id).attr('readonly','readonly');
			$('#fees_amt_'+fees_id).val('');
			total=0;
			$('.fees_amount').each(function(){
				total=total+Number($(this).val());	
			});
			$('#total').val(total.toFixed(2));
			$('#full_mge_total').val((Number($("#total").val())+Number($('#mge_amt').val())).toFixed(2));
		}
	});
	$('#mge_amt,#full_mge_total').hide();
	$('#mge_check').live('click',function(){
		if($(this).attr('checked')=='checked')
		{	
			$('#mge_amt,#full_mge_total').show();
			$('#mge_amt').removeAttr('readonly');
			$('#mge_amt').addClass('mandatory');			
		}
		else
		{
			$('#mge_amt').removeClass('mandatory');		
			$('#mge_amt').css('border-color','');		
			$('#mge_amt,#full_mge_total').hide();
			$('#mge_amt').val('');
			$('#full_mge_total').val('');
			$('#mge_amt').attr('readonly','readonly');
		}
	});
	$('.fees_amount').live('keyup',function(){
		total=0;
		$('.fees_amount').each(function(){
			total=total+Number($(this).val());	
		});
		$('#total').val(total.toFixed(2));
		$('#full_mge_total').val((Number($("#total").val())+Number($('#mge_amt').val())).toFixed(2));
	});
	$('#mge_amt').live('keyup',function(){
		$('#full_mge_total').val((Number($("#total").val())+Number($('#mge_amt').val())).toFixed(2));
	});
	$('.fain_type').live('click',function(){
		if($(this).val()=='yes')
		{
			$('.amt_tr').show();	
			$('.type_tr').show();	
		}
		else
		{
			$('.amt_tr').hide();	
			$('.type_tr').hide();	
		}
	});
	$('.pain_option').live('click',function(){
		$('.per_fees_type').html('  / '+$(this).val());	
	});
</script>
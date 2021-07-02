<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.datetimepicker.js"></script>
<script type='text/javascript' src='<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<div id="up_close">
<div class="fees_tit">Update Transport Fees</div><br />
<br />
<input type="hidden" value="<?=$stud_trans[0]['std_reg']?>" id="roll_no" name="std_reg"/>
<input type="hidden" value="<?=$stud_trans[0]['id']?>" id="trns_std_id" name="id" />
<table class="staff_table">
	<tr>
    	<td width="273">Stage</td>
        <td class="text_bold">
        	<input type="text" style="float:left;" name="stage" id="get_stage" class="stage_class" 
            value="<?=$stud_trans[0]['stage']?>" autocomplete="off" />
            <span id="hos_name" style="color:#F00;"></span>
        </td>
    </tr>
    
</table> 
<div id="bus_route">

</div>
<div id="update_trans">
<table  class="staff_table">
	<tr>
    	<td width="273">Bus No</td>
        <td class="text_bold">
            <select id="bus_id_update" name='bus_id'  
            	class="u_bus mandatory validate bus_class_up" >
               <option value="<?=$stud_trans[0]['bus_id']?>"><?=$stud_trans[0]['bus_no']?></option>
            </select>
        </td>
        
    </tr>
    <tr>
    	<td>Route Name</td>
        <td class="text_bold">
            <select id="route_id_update" name='route_id'  
            class="u_bus mandatory validate" >
               <option value="<?=$stud_trans[0]['route_id']?>"><?=$stud_trans[0]['route_id']?></option>
            </select>
        </td>
    </tr>
    <tr>
    	<td>Route Amount</td>
        <td class="text_bold">
        	<input type="text" value="<?=$stud_trans[0]['amount_id']?>" id="amount_id"  name="amount_id" disabled="disabled"/>
        </td>
    </tr>
</table>
</div>
<div id="update_year_show"></div>
<?php if($stud_trans[0]['a_amt'] != ""){?>
    <div id="advance_pay">
            <table class="staff_table">
                <tr>
                    <td width="273"><p style="color:blue; font:bold;">Amount Paying</p></td>
                    <td class="text_bold"><input type="text" id="a_amt" name="a_amt" value="<?=$stud_trans[0]['a_amt']?>" class="adva_amount"  /></td>
                </tr>
                <tr>
                    <td width="273"><p style="color:blue; font:bold;">Reason</p></td>
                    <td class="text_bold"><input type="text" id="reason" name="reason" value="<?=$stud_trans[0]['reason']?>" class="adva_amount"  /></td>
                </tr>
            </table>
	</div>
<?php } else { ?>
<div id="advance_pay1" style="display:none;">
            <table class="staff_table">
                <tr>
                    <td width="273"><p style="color:blue; font:bold;">Amount Paying</p></td>
                    <td class="text_bold"><input type="text" id="a_amt" name="a_amt" value="<?=$stud_trans[0]['a_amt']?>" class="adva_amount"  /></td>
                </tr>
                <tr>
                    <td width="273"><p style="color:blue; font:bold;">Reason</p></td>
                    <td class="text_bold"><input type="text" id="reason" name="reason" value="<?=$stud_trans[0]['reason']?>" class="adva_amount"  /></td>
                </tr>
            </table>
	</div>
    <?php } ?>
    
    
    <table class="staff_table">
   
    <tr>
        <td width="273">Term</td>
        <td class="text_bold">
        <select id='period' class="t_port s_mon">
        		 <option value='1'>Select</option>
                <option <?=(1 == $stud_trans[0]['f_days'] )?'selected':'';?> value='1'>Half-Yearly</option>
                <option <?=(2 == $stud_trans[0]['f_days'] )?'selected':'';?> value='2'>One Year</option>
        </select>
        </td>
        <td style="display:none;">
        	 <input type="text" id="amount_year" class="mount_year" /> 
             <!--<input type="text" id="amount_difference" class="mount_year" />--> 
        </td>
    </tr>
    <tr>
    	<td width="273">Fine</td>
        <td class="text_bold">
        	<input type="text" value="<?=$stud_trans[0]['get_fine']?>" id="get_fine"  name="get_fine"/>
        </td>
    </tr> 
    <tr>
    	<td width="273">Period</td>
        <td class="text_bold">
        	<span style="float:left;margin-top: 6PX;">From : &nbsp;</span>
			 <span style="float:left;">
            <select name="date_from" id="date_from" class="mandatory to alert_year t_port" title="Select Year"  style="width:90px;">
            <option value="" selected="selected">Year</option>
            <?php for ($i =$std_info[0]['from']; $i <= $std_info[0]['to']; $i++) : ?>
            <option <?=($i == $stud_trans[0]['date_from'] )?'selected':'';?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
            </select> 
            
             <select class="month_from" name="fdate_up"  id="fdate_up" style="float:left;width:90px;">
                    <option value="<?=$stud_trans[0]['fdate']?>"><?php
					switch($stud_trans[0]['fdate'])
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
                
                ?></option>
                		<option value="0" >Select </option>
                        <option class="31" <?=($stud_trans[0]['fdate']==1)?'selected':'';?> value="1">January</option>
                        <option class="28" <?=($stud_trans[0]['fdate']==2)?'selected':'';?> value="2">February</option>
                        <option class="31" <?=($stud_trans[0]['fdate']==3)?'selected':'';?> value="3">March</option>
                        <option class="30" <?=($stud_trans[0]['fdate']==4)?'selected':'';?> value="4">April</option>
                        <option class="31" <?=($stud_trans[0]['fdate']==5)?'selected':'';?> value="5">May</option>
                        <option class="30" <?=($stud_trans[0]['fdate']==6)?'selected':'';?> value="6">June</option>
                        <option class="31" <?=($stud_trans[0]['fdate']==7)?'selected':'';?> value="7">July</option>
                        <option class="31" <?=($stud_trans[0]['fdate']==8)?'selected':'';?> value="8">August</option>
                        <option class="30" <?=($stud_trans[0]['fdate']==9)?'selected':'';?> value="9">September</option>
                        <option class="31" <?=($stud_trans[0]['fdate']==10)?'selected':'';?> value="10">October</option>
                        <option class="30" <?=($stud_trans[0]['fdate']==11)?'selected':'';?> value="11">November</option>
                        <option class="31" <?=($stud_trans[0]['fdate']==12)?'selected':'';?> value="12">December</option>
                    </select>
            </span>
            <span style="float:left;margin-top: 6PX;">
            &nbsp;&nbsp; To :&nbsp;&nbsp;
            </span>
            <span style="float:left;">
           	<select name="date_to" id="date_to" class="mandatory to alert_year t_port"   title="Select Year"  style="width:90px;">
            <option value="" selected="selected">Year</option>
            <?php for ($i =$std_info[0]['from']; $i <= $std_info[0]['to']; $i++) : ?>
            <option <?=($i == $stud_trans[0]['date_to'] )?'selected':'';?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
            </select>
            
            <select class="month_to" name="tdate_up" id="tdate_up" style="float:left;width:90px;">
                <option value="<?=$stud_trans[0]['tdate']?>"><?php
                switch($stud_trans[0]['tdate'])
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
                
                ?></option>
                <option value="0" >Select </option>
                        <option class="31" <?=($stud_trans[0]['tdate']==1)?'selected':'';?> value="1">January</option>
                        <option class="28" <?=($stud_trans[0]['tdate']==2)?'selected':'';?> value="2">February</option>
                        <option class="31" <?=($stud_trans[0]['tdate']==3)?'selected':'';?> value="3">March</option>
                        <option class="30" <?=($stud_trans[0]['tdate']==4)?'selected':'';?> value="4">April</option>
                        <option class="31" <?=($stud_trans[0]['tdate']==5)?'selected':'';?> value="5">May</option>
                        <option class="30" <?=($stud_trans[0]['tdate']==6)?'selected':'';?> value="6">June</option>
                        <option class="31" <?=($stud_trans[0]['tdate']==7)?'selected':'';?> value="7">July</option>
                        <option class="31" <?=($stud_trans[0]['tdate']==8)?'selected':'';?> value="8">August</option>
                        <option class="30" <?=($stud_trans[0]['tdate']==9)?'selected':'';?> value="9">September</option>
                        <option class="31" <?=($stud_trans[0]['tdate']==10)?'selected':'';?> value="10">October</option>
                        <option class="30" <?=($stud_trans[0]['tdate']==11)?'selected':'';?> value="11">November</option>
                        <option class="31" <?=($stud_trans[0]['tdate']==12)?'selected':'';?> value="12">December</option>
                    </select> 
            </span>
        </td> 
    </tr>
</table>
   <?php /*?> <?php if($stud_trans[0]['fdate'] != ""){?>
	<table class="staff_table" id="month">
            <tr>
                <td width="273">Month</td>
                <td width="" class="text_bold">
                    <span style="float:left;margin-top: 6PX;">From : &nbsp;</span>
                     <span style="float:left;">
                   <select class="month_from" name="fdate_up"  id="fdate_up" style="float:left;width:100px;">
                    <option value="<?=$stud_trans[0]['fdate']?>"><?php
					switch($stud_trans[0]['fdate'])
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
                
                ?></option>
                        <option class="31" <?=($stud_trans[0]['fdate']==1)?'selected':'';?> value="1">January</option>
                        <option class="28" <?=($stud_trans[0]['fdate']==2)?'selected':'';?> value="2">February</option>
                        <option class="31" <?=($stud_trans[0]['fdate']==3)?'selected':'';?> value="3">March</option>
                        <option class="30" <?=($stud_trans[0]['fdate']==4)?'selected':'';?> value="4">April</option>
                        <option class="31" <?=($stud_trans[0]['fdate']==5)?'selected':'';?> value="5">May</option>
                        <option class="30" <?=($stud_trans[0]['fdate']==6)?'selected':'';?> value="6">June</option>
                        <option class="31" <?=($stud_trans[0]['fdate']==7)?'selected':'';?> value="7">July</option>
                        <option class="31" <?=($stud_trans[0]['fdate']==8)?'selected':'';?> value="8">August</option>
                        <option class="30" <?=($stud_trans[0]['fdate']==9)?'selected':'';?> value="9">September</option>
                        <option class="31" <?=($stud_trans[0]['fdate']==10)?'selected':'';?> value="10">October</option>
                        <option class="30" <?=($stud_trans[0]['fdate']==11)?'selected':'';?> value="11">November</option>
                        <option class="31" <?=($stud_trans[0]['fdate']==12)?'selected':'';?> value="12">December</option>
                    </select>
                    </span> <?php //$year=date('d-m-Y',strtotime("+12month",strtotime($std_info[0]['join_date'])));?>
                    <span style="float:left;margin-top: 6PX;">
                    &nbsp;&nbsp; To :&nbsp;&nbsp;
                    </span>
                    <span style="float:left;">
                    
                <select class="month_to" name="tdate_up" id="tdate_up" style="float:left;width:100px;">
                <option value="<?=$stud_trans[0]['tdate']?>"><?php
                switch($stud_trans[0]['tdate'])
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
                
                ?></option>
                        <option class="31" <?=($stud_trans[0]['tdate']==1)?'selected':'';?> value="1">January</option>
                        <option class="28" <?=($stud_trans[0]['tdate']==2)?'selected':'';?> value="2">February</option>
                        <option class="31" <?=($stud_trans[0]['tdate']==3)?'selected':'';?> value="3">March</option>
                        <option class="30" <?=($stud_trans[0]['tdate']==4)?'selected':'';?> value="4">April</option>
                        <option class="31" <?=($stud_trans[0]['tdate']==5)?'selected':'';?> value="5">May</option>
                        <option class="30" <?=($stud_trans[0]['tdate']==6)?'selected':'';?> value="6">June</option>
                        <option class="31" <?=($stud_trans[0]['tdate']==7)?'selected':'';?> value="7">July</option>
                        <option class="31" <?=($stud_trans[0]['tdate']==8)?'selected':'';?> value="8">August</option>
                        <option class="30" <?=($stud_trans[0]['tdate']==9)?'selected':'';?> value="9">September</option>
                        <option class="31" <?=($stud_trans[0]['tdate']==10)?'selected':'';?> value="10">October</option>
                        <option class="30" <?=($stud_trans[0]['tdate']==11)?'selected':'';?> value="11">November</option>
                        <option class="31" <?=($stud_trans[0]['tdate']==12)?'selected':'';?> value="12">December</option>
                    </select></span>
                </td> 
            </tr>
</table>  
<?php } ?><?php */?>
<table class="staff_table">
	<tr>
    	<td width="273">Previous Paid Amount</td>
            <td class="text_bold">
                   <input type="text" id="p_amt" value="<?=$stud_trans[0]['total']?>"  disabled="disabled"/>
        </td>
    </tr>
    <tr>
    	<td width="273">Current Amount</td>
            <td class="text_bold">
                   <input type="text" id="amount_difference" class="mount_year" /> 
        </td>
    </tr>
 	</table>
    <table class="staff_table" id="exe" style="display:none;">
	 <tr >
    	<td width="273">Excess</td>
            <td class="text_bold">
                <input type="text" name="bal_amount" id="bal_amt1" maxlength="6"  disabled="disabled" />
            </td>
    </tr>
    </table>
    <table class="staff_table" id="balz" style="display:none;">
	 <tr>
    	<td width="273">Balance</td>
            <td class="text_bold">
                <input type="text" name="bal_amount" id="bal_amt" maxlength="6"  disabled="disabled" />
            </td>
    </tr>
    </table>
    <table class="staff_table">
    <tr>
    	<td width="273">Payment modet</td>
           
                <td class="text_bold">
                    <select  id='p_mode_trans' name="p_mode_trans" class='payment_mode'>
                        <option value=''>Select</option>
                        <option <?=($stud_trans[0]['payment_mode']==1)?'selected':'';?> value='1'>Cash</option>
                        <option <?=($stud_trans[0]['payment_mode']==2)?'selected':'';?> value='2'>Cheque</option>
                        <option <?=($stud_trans[0]['payment_mode']==3)?'selected':'';?> value='3'>DD</option>
                    </select>
                </td>
    </tr>
    </table>
    <div id="trans_update" style="display:none;">
    	<table class="staff_table">
        	<tr><td width="273"></td><td class="text_bold"><input type="text" name="bank_name" class="bank_name t_port" placeholder="Bank Name"/></td></tr>
            <tr><td width="273"></td><td class="text_bold"><input type="text" name="branch_name"  class="branch_name t_port" placeholder="Branch Name"/></td></tr>
            <tr><td width="273"></td><td class="text_bold"><input type="text" name="bank_dd" class="bank_dd t_port" placeholder="Cheque / DD No"/></td></tr>
            <tr><td width="273"></td><td class="text_bold"><input type="text" name="bank_amount" class="bank_amount t_port" placeholder="Amount"/></td></tr>
    </table>
    	
    </div>
    <?php if($stud_trans[0]['bank_name'] != ""){?>
    <table class="staff_table">
    <tr>
    	<td  width="273">Bank Name</td>
        <td class="text_bold">
        	<input type="text" value="<?=$stud_trans[0]['bank_name']?>" name="bank_name" class="bank_name" />
        </td>
    </tr>
    <tr >
    	<td width="273">Branch Name</td>
        <td class="text_bold">
        	<input type="text" value="<?=$stud_trans[0]['branch_name']?>" name="branch_name" class="branch_name" />
        </td>
    </tr>
    <tr >
    	<td width="273">Cheque / DD No</td>
        <td class="text_bold">
        	<input type="text" value="<?=$stud_trans[0]['bank_dd']?>" name="bank_dd" class="bank_dd" />
        </td>
    </tr>
    <tr >
    	<td width="273">Cheque / DD Amount</td>
        <td class="text_bold">
        	<input type="text" value="<?=$stud_trans[0]['bank_amount']?>" name="bank_amount" class="bank_amount" />
        </td>
    </tr>
    </table>
    <?php } ?>
   <table class="staff_table">
    <tr>
    	<td width="273">Bal / Exs Amount</td>
        <td class="text_bold">
        	<input type="text" value="" name="total_update" class="total" id="total_update"/>
        </td>
    </tr>
    <tr>
    	<td width="273">Paid On</td>
        <td class="text_bold">
        	<label><?=date('d-M-Y',strtotime($stud_trans[0]['created_on']))?></label>
        </td>
    </tr>
    <tr>
    	<td width="273"></td>
        <td class="text_bold">
        	<input type="submit" class="btn btn-primary" value="Update" id="total_up_btn" />
        </td>
    </tr>
    
</table>
</div>
<div id="element_show">
</div>
<script type="text/javascript">
$(document).ready(function()
{
  $(".staff_table_sub tr:even").css("background-color", "#FAFAFA");
});

$().ready(function() {
	$("#get_stage").autocomplete(BASE_URL+"transport/get_stage_list", {
		width: 260,
		autoFocus: true,
		matchContains: true,
		selectFirst: false
	});
});
 


	
  
 <!--bus route ajax-->
$("#get_stage").live('blur',function()
{
	var s_id=$(this).val();
	$.ajax({	
	  url:BASE_URL+"transport/transport_bus_no1",
	  type:'get',
	  data:{ 
				source:s_id,
		   },
	  success:function(result){
		  
			result = result.trim();
			if(result == 'fail')
			{ 
			}
			else
			{ 
				$('#bus_route').html(result);
				$("#update_trans").css('display','none');
				
			}
	  }    
	});
});
</script>
<script>
$("#h_id").live('blur',function()
{
	var h_id=$("#h_id").val();
	
	if(h_id=="")
	{
		$("#hos_name").html("Select Hostel Name");
	}
	else
	{
		$("#hos_name").html("");
	}
});
</script>
<script>
$(document).ready(function(){
	$('#submit').live('click',function(){
		var i=0;
		var h_id=$("#h_id").val();
	
		if(h_id=="")
		{
			$("#hos_name").html("Select Hostel Name");
			i=1;
		}
		else
		{
			$("#hos_name").html("");
		}
		if(i==1)
		{
			return false;
		}
		else
		{
			return true;
		}
	});
});
<!-- stage ajax-->
	$("#bus_id_update").live('change',function()
{
	var bus_id=$(this).val();
	var stage=$("#get_stage").val();
	
	$.ajax({	
	  url:BASE_URL+"transport/transport_amount_update",
	  type:'get',
	  data:{ 
				bus_id:bus_id, stage:stage,
		   },
	  success:function(result){
		  
			$('#route_up').html(result);
	  }    
	});
    });
	
	<!--total amount shown-->
	
$("#bus_id_update").live('change',function()
{
	var bus_id=$(this).val();
	var stage=$("#get_stage").val();
	
	$.ajax({	
	  url:BASE_URL+"transport/transport_total",
	  type:'get',
	  data:{ 
				bus_id:bus_id, stage:stage,
		   },
	  success:function(result){
		  	result = result.trim();
			$("#total_update:text").val(result);
	  }    
	});
});

<!--last fees shown-->
$('#bus_id_update').live('change',function()
{
	var std_roll=$("#roll_no").val();	
	
	$.ajax({	
	  url:BASE_URL+"transport/transport_year",
	  type:'get',
	  data:{ 
				std_roll:std_roll
		   },
	  success:function(result){
		
			$('#update_year_show').html(result);
	  }    
	});
 });
 
<!-- route shown-->

$("#route_id_update").live('change',function()
{
var bus_id=$("#bus_id_update").val();
var stage=$("#get_stage").val();

$.ajax({	
  url:BASE_URL+"transport/transport_amount2",
  type:'get',
  data:{ 
			bus_id:bus_id, stage:stage,
	   },
  success:function(result){
	  
		$('#amount_up').html(result);
		$('#update_year_show').css('display','none');
		$('.s_mon').val('');
  }    
});
});

<!--fine amount update keyup functional--> 
	$("#get_fine").live('keyup',function()
	{
		var bank=$(this).val();
		var period=$('.s_mon').val();
		
		if( period != 1)
		{
			
			if(bank == "")
			{
				var bank2=$('#amount_id').val();
				$("#total_update:text").val(bank2);
			}
			
			var ad_amount=$('#a_amt').val();
			
			if(ad_amount == '')
			{
			var bank2=parseInt($('#amount_id').val());	
			var bank=parseInt($(this).val());
			$("#total_update:text").val(bank+bank2);
			$("#amount_difference:text").val(bank+bank2);
			}
			else
			{
			var ad_amount=parseInt($('#a_amt').val());
			var bank=parseInt($(this).val());
			$("#total_update:text").val(bank+ad_amount);
			$("#amount_difference:text").val(bank+ad_amount);
			}
		}
		if( period = 1)
		{
			
			if(bank == "")
			{
				var bank2=$('#amount_year').val();
				$("#total_update:text").val(bank2);
				$("#amount_difference:text").val(bank2);
			}
			
			var ad_amount=$('#a_amt').val();
			
			if(ad_amount == '')
			{
			var bank2=parseInt($('#amount_year').val());	
			var bank=parseInt($(this).val());
			$("#total_update:text").val(bank+bank2);
			$("#amount_difference:text").val(bank+bank2);
			}
			else
			{
			var ad_amount=parseInt($('#a_amt').val());
			var bank=parseInt($(this).val());
			$("#total_update:text").val(bank+ad_amount);
			$("#amount_difference:text").val(bank+ad_amount);
			}
		}
	});
	
<!--advance amount-->
$("#a_amt").live('keyup',function()
	{
		var bank=$(this).val();
		if(bank == "")
		{
			var bank1=$('#amount_id').val();
			$("#total_update:text").val(bank1);
		}
		else 
		{
		$("#total_update:text").val(bank);
		}
});


$("#tdate_up").live('change',function()
	{
	var c_amount=$("#amount_difference").val();
	var p_amount=$("#p_amt").val();
	alert(p_amount+c_amount)
	if(p_amount>c_amount)
	{
		std_giv=p_amount-c_amount;
		diff='Bal:'+std_giv;
		ad=Math.abs(diff);
		$("#bal_amt").val(ad);
		$("#total_update").val(std_giv);
			
	}
	if(p_amount<c_amount)
	{
		mang_giv=c_amount-p_amount;
		diff='Adv:'+mang_giv;
		ad1=Math.abs(diff);
		$("#bal_amt").val(ad1);
		$("#total_update").val(mang_giv);	
	}
	
});
$("#fdate_up").live('change',function()
	{
	var c_amount=parseFloat($("#amount_difference").val());
	var p_amount=parseFloat($("#p_amt").val());
	//alert(c_amount+p_amount)
	if(p_amount>c_amount)
	{
		std_giv=p_amount-c_amount;
		ad=Math.abs(std_giv);
		$("#bal_amt").val(ad);
		$("#bal").css('display','block');
		$("#balz").css('display','block');
		$("#exe").css('display','none');
		$("#total_update").val('nil');
			
	}
	else if(p_amount<c_amount)
	{
		mang_giv=c_amount-p_amount;
		diff=mang_giv;
		ad1=Math.abs(diff);
		$("#bal_amt1").val(ad1);
		$("#exe").css('display','block');
		$("#balz").css('display','none');
		$("#total_update").val(ad1);	
			
	}
	else if(p_amount==c_amount)
	{
		mang_giv=c_amount-p_amount;
		diff=mang_giv;
		ad1=Math.abs(diff);
		$("#bal_amt1").val(ad1);
		$("#exe").css('display','none');
		$("#balz").css('display','block');
		$("#total_update").val(ad1);	
			
	}
	
	
});

/*$("#date_to").live('change',function()
	{
		
	var fyear=$("#date_from").val();
	var tyear=$(this).val();
	var stage_amount=$("#amount_id").val();
	var p_amount=$("#p_amt").val();
	
	if(fyear != tyear)
	{
		rate_pre_month=stage_amount/12;
		total_amount=12*rate_pre_month;
		$("#bal_amt").val(total_amount);
		p_amt=total_amount-p_amount;
		$("#total_update").val(p_amt);	
	}
	
});*/


	
<!--	amount_ajax-->

	$("#stage_id").live('change',function()
{
	var stage_id=$("#stage_id").val();
	
	$.ajax({	
	  url:BASE_URL+"transport/transport_amount",
	  type:'get',
	  data:{ 
				stage_id:stage_id,
		   },
	  success:function(result){
			$('#amount').html(result);
	  }    
	});
    });
	
	
	
$("#total_up_btn").live('click',function() 
	{
	var id=$("#trns_std_id").val(); 
	var period_amount=$(".mount_year").val();       
	var stage=$("#get_stage").val();   
	var date_from=$("#date_from").val(); 
	var date_to=$("#date_to").val();
	var bus_id=$("#bus_id_update").val();
	var amount_id=$("#amount_id").val();
	var route_id=$("#route_id_update").val();
	var a_amt=$("#a_amt").val();
	var reason=$("#reason").val();
	var fmon=$("#fdate_up").val();
	var tmon=$("#tdate_up").val();
	var period=$("#period").val();
	var get_fine=$("#get_fine").val();
	var payment_mode=$("#p_mode_trans").val();
	var bank_name=$(".bank_name").val();
	var branch_name=$(".branch_name").val();
	var bank_dd=$(".bank_dd").val();
	var bank_amount=$(".bank_amount").val();
	var total=$("#total_update").val();
	var std_reg=$("#roll_no").val();
	var balz=$("#bal_amt").val();
	var excess=$("#bal_amt1").val();
	$.ajax({	
	  url:BASE_URL+"transport/update_student_transport1",
	  type:'post',
	  data:{ 
				stage:stage,
				id:id, 
				fmon:fmon,
				tmon:tmon,
				date_from:date_from,
				date_to:date_to,
				period_amount:period_amount,
				bus_id:bus_id,
				amount_id:amount_id,
				route_id:route_id,
				balz:balz,
				excess:excess,
				a_amt:a_amt,
				period:period,
				reason:reason,
				get_fine:get_fine,
				payment_mode:payment_mode,
				bank_name:bank_name,
				bank_dd:bank_dd,
				bank_amount:bank_amount,
				branch_name:branch_name,
				total:total,
				std_reg:std_reg
		   },
	  success:function(result){
		  $('#up_close').html('');
		  $('#element_show').html(result);
		   //window.location.replace(BASE_URL+"transport/transport_student/"+std_reg); 
			
	  }    
	});
});
	

	

</script>
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
	
	$(".edit_update").live('click',function()
	{
		
		$("#advance_pay1").toggle();
		var bank=$('#amount_id').val();
		$("#total:text").val(bank);
		$("#reason").val('');
		$("#a_amt").val('');
	});
	
	$("#p_mode_trans").live('change',function()
	{
		var bank=$(this).val();
		
		if((bank == 3) || (bank == 2 ))
		{
			$("#trans_update").css('display','block');
		}
		if((bank == 1))
		{
			$("#trans_update").css('display','none');
		}
		
		
	});
	$("#get_due_date").live('change',function()
	{
		due=$(this).val();
		today= $('.tody').val();
		$.ajax({	
	  url:BASE_URL+"transport/days",
	  type:'get',
	  data:{ 
				due:due,today:today
		   },
	  success:function(result){
			$('#span').html(result);
	  }    
	});
	});
	
	$("#route_id").live('mouseover',function()
	{
		var bank=$('#amount_id').val();
		$("#total:text").val(bank);
		
	});
	
	$("#a_amt").live('keyup',function()
	{
		var bank=$(this).val();
		if(bank == "")
		{
			var bank1=$('#amount_id').val();
			$("#total:text").val(bank1);
		}
		else 
		{
		$("#total:text").val(bank);
		}
	});

   $(".s_mon").live('change',function()
	{
		var month=$(this).val(); 
		if(month == 1) 
		{
			
			$('select[name=fdate_up] option[value=0]').attr('selected', 'selected');
			var stage_amount=$('#amount_id').val();
			var cost= stage_amount/2;
			$("#total_update:text").val(cost);
			$("#amount_year:text").val(cost); 
			$("#amount_difference:text").val(cost); 
			$("#get_fine").val('');	
		}
		else
		{
			$('select[name=fdate_up] option[value=0]').attr('selected', 'selected');
			var stage_amount=$('#amount_id').val();
			var cost= stage_amount/1;
			$("#total_update:text").val(cost);
			$("#amount_year:text").val(cost); 
			$("#amount_difference").val(cost);
			$("#get_fine").val('');
			
		}
		
	});    

	
	
</script>
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

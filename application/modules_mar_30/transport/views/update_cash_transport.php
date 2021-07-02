<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.datetimepicker.js"></script>
<script type='text/javascript' src='<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
   
   
   

<div class="fees_tit">Update Transport Fees</div><br />


<br /><form method="post">
<table class="staff_table">
	<tr>
    	<td width="273">Stage</td>
        <td class="text_bold">
        	<input type="text" style="float:left;" name="roll_no" id="get_stage" class="stage_class" 
            value="<?=$stud_trans[0]['stage']?>" autocomplete="off" />
            <span id="hos_name" style="color:#F00;"></span>
        </td>
    </tr>
    <tr></form>
</table> 
<input type="hidden" value="<?=$stud_trans[0]['std_reg']?>" id="roll_no" />
<table  class="staff_table">
	<tr>
    	<td width="273">Bus No</td>
        <td class="text_bold">
        	<input type="text" value="<?=$stud_trans[0]['bus_no']?>"  id="bus_id"/>
        </td>
    </tr>
    <tr>
    	<td>Route Name</td>
        <td class="text_bold">
        	<input type="text" value="<?=$stud_trans[0]['route_id']?>" id="route_id" />
        </td>
    </tr>
    <tr>
    	<td>Route Amount</td>
        <td class="text_bold">
        	<input type="text" value="<?=$stud_trans[0]['amount_id']?>" id="amount_id" />
        </td>
    </tr>
    <tr>
    	<td>Fine</td>
        <td class="text_bold">
        	<input type="text" value="<?=$stud_trans[0]['get_fine']?>" id="get_fine" />
        </td>
    </tr>
    
    <tr>
    	<td>Fine Days</td>
        <td class="text_bold">
        	<input type="text" value="<?=$stud_trans[0]['f_days']?>"  id="f_days"/>
        </td>
    </tr>
    <tr>
    	<td width="200">Period</td>
        <td>
        	<span style="float:left;margin-top: 6PX;">From : &nbsp;</span>
			 <span style="float:left;">
           <input type="text" class="date"  name="date" id="date_from" value="<?=$stud_trans[0]['date_from']?>" style="width:90px;"/>
            </span> <?php ?>
            <span style="float:left;margin-top: 6PX;">
            &nbsp;&nbsp; To :&nbsp;&nbsp;
            </span>
            <span style="float:left;">
           <input type="text" class="date"  name="date" id="date_to"  
           value="<?=$stud_trans[0]['date_to']?>" style="width:90px;"/>
            </span>
        </td> 
    </tr>
      
    <tr>
    	<td>Payment modet</td>
           
                <td>
                    <select  id='p_mode_trans' class='payment_mode'>
                        <option value=''>Select</option>
                        <option <?=($stud_trans[0]['payment_mode']==1)?'selected':'';?> value='1'>Cash</option>
                        <option <?=($stud_trans[0]['payment_mode']==2)?'selected':'';?> value='2'>Cheque</option>
                        <option <?=($stud_trans[0]['payment_mode']==3)?'selected':'';?> value='3'>DD</option>
                    </select>
                </td>
         <div id="trans" style="display:none;">
    	<table>
        	<tr><td width="200"></td><td><input type="text"  class="bank_name" placeholder="Bank Name"/></td></tr>
            <tr><td width="200"></td><td><input type="text"  class="branch_name" placeholder="Branch Name"/></td></tr>
            <tr><td width="200"></td><td><input type="text"  class="bank_dd" placeholder="Cheque / DD No"/></td></tr>
            <tr><td width="200"></td><td><input type="text"  class="bank_amount" placeholder="Amount"/></td></tr>
    	</table>
    	
    </div>
    	<td>Amount Paid</td>
        <td class="text_bold">
        	<input type="text" value="<?=$stud_trans[0]['total']?>"  class="total" />
        </td>
    </tr>

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
 
 
 <!--bus-ajax-->
$(".stage_class").live('blur',function()
{
	var s_id=$(this).val();
	$.ajax({	
	  url:BASE_URL+"transport/transport_bus_no",
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
				$('#bus').html(result);
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
	$(".bus_class").live('change',function()
{
	var bus_id=$(this).val();
	var stage=$("#get_stage").val();
	
	$.ajax({	
	  url:BASE_URL+"transport/transport_amount",
	  type:'get',
	  data:{ 
				bus_id:bus_id, stage:stage,
		   },
	  success:function(result){
		  
			$('#amount').html(result);
	  }    
	});
    });
	
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
	
	
	
	$("#submit_trans").live('click',function() 
	{
		
	var stage=$("#get_stage").val();   
	var date_from=$("#date_from").val(); 
	var date_to=$("#date_to").val();
	var bus_id=$("#bus_id").val();
	var amount_id=$("#amount_id").val();
	var route_id=$("#route_id").val();
	var a_amt=$("#a_amt").val();
	var reason=$("#reason").val();
	var f_days=$("#days").val();
	var get_fine=$("#get_fine").val();
	var due_date=$("#get_due_date").val();
	var payment_mode=$("#p_mode_trans").val();
	var bank_name=$(".bank_name").val();
	var branch_name=$(".branch_name").val();
	var bank_dd=$(".bank_dd").val();
	var bank_amount=$(".bank_amount").val();
	var total=$("#total").val();
	var bank_amount=$(".bank_amount").val();
	var std_reg=$(".std_reg").val();
	$.ajax({	
	  url:BASE_URL+"transport/update_student_transport1",
	  type:'get',
	  data:{ 
				stage:stage,
				date_from:date_from,
				date_to:date_to,
				bus_id:bus_id,
				amount_id:amount_id,
				route_id:route_id,
				a_amt:a_amt,
				reason:reason,
				f_days:f_days,
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
			 window.location.replace(BASE_URL+"transport/transport_fees"); 
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
	
	$(".edit_clas").live('click',function()
	{
		
		$("#advance_pay").toggle();
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
			$("#trans").css('display','block');
		}
		if((bank == 1))
		{
			$("#trans").css('display','none');
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
    			
             

	
	<!--update ajax-->
	$("#update_trans").live('click',function() 
	{
		

	var f_year=$("#date_from").val(); 
	var e_year=$("#date_to").val();
	var std_id1=$("#reg").val();
	var bus_id1=$("#bus_id").val();
	var stage_id1=$("#stage_id").val();
	var amount_id1=$("#amount_id").val();
	var t_amount=$("#t_amount").val();
	var std_reg=$("#std_reg").val();
	var s_id_route=$("#s_id").val();
	
	
	$.ajax({	
	  url:BASE_URL+"transport/update_student_transport1",
	  type:'get',
	  data:{ 
				f_year:f_year,e_year:e_year,std_id1:std_id1,bus_id1:bus_id1,stage_id1:stage_id1,amount_id1:amount_id1,
				t_amount:t_amount,s_id_route:s_id_route
		   },
	  success:function(result){
			 window.location.replace(BASE_URL+"transport/transport_fees"); 
	  }    
	});
    });
	
	$("#p_mode_trans").live('change',function()
	{
		var bank=$(this).val();
		
		if((bank == 3) || (bank == 2 ))
		{
			$("#trans").css('display','block');
		}
		if((bank == 1))
		{
			$("#trans").css('display','none');
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
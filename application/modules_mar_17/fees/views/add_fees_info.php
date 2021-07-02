    <?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
		<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/jquery.datetimepicker.css" />
		<script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.datetimepicker.js"></script>
<table>
		<tr>
        	<td width="308">Bill Name</td>
            <td></td>
            <td><input type="text" class="mandatory" id="bill_name" name='fees_info[bill_name]'/><span id="bi_na" style="color:#F00;"></span></td>
        </tr>
        <tr>
        	<td>From Date</td>
            <td></td>
            <td><input type="text"   name='fees_info[from_date]' id="from_date"  class='date mandatory'/></td>
        </tr>
        <tr>
        	<td>Due Date</td>
            <td></td>
            <td><input type="text"   name='fees_info[due_date]' id="due_date"  class='date mandatory'/></td>
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
                        <td><input type="text" id='fees_amt_<?=$val['id']?>'  name='fees_details[amount][<?=$val['id']?>]' readonly="readonly" class='fees_amount mandatory1 int_val' id="nonzero" /></td>
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
        	<td>Management</td>
            <td><input type="checkbox" id='mge_check'  /></td>
            <td><input type="text" id='mge_amt' name='fees_info[management_amount]' style="display:none;" readonly="readonly"/></td>
        </tr>
        <tr>
        	<td></td>
            <td></td>
            <td><input type="text" id='full_mge_total' style="display:none;"  readonly="readonly"/></td>
        </tr>
         <tr>
        	<td>Fine</td>
            <td></td>
            <td>
            	<input type="radio" id='fain_yes' class='fain_type' name='fees_info[fain]' value="yes" /> Yes
                <input type="radio" class='fain_type'  value="no" id='fain_no' name='fees_info[fain]' checked="checked"/> No 
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
            <td>
            <input type="text"  name='fees_info[fain_amount]' style="width:100px; float:left;" id="fine_amt" class='fain_amt' /><span  style="position: relative; left: 6px; top: 6px;"  class='per_fees_type'>  / Day</span> <span id="fin" style="color:#F00;"></span>
            
            
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
        <td></td>
        <td></td>
        <td><input type="submit" id="submit" class="btn btn-primary"/></td>
        </tr>
    </table>
    <script>
	$("#fine_amt").live('blur',function()
	{
		var fine_amt=$("#fine_amt").val();
		var filter=/^[0-9]{1,5}$/;
		if(fine_amt=="")
		{
			$("#fin").html("Required Field");
		}
		else if(!filter.test(fine_amt))
		{
			$("#fin").html("Numeric only max Length 5");
		}
		else
		{
			$("#fin").html("");
		}
	});
	$("#bill_name").live('blur',function()
	{
		var bill_name=$("#bill_name").val();
		var filter=/\w+.*$/;
		if(bill_name=="")
		{
			$("#bi_na").html("Required Field");
		}
		else if(!filter.test(bill_name))
		{
			$("#bi_na").html("Numeric and Alphanumeric");
		}
		else
		{
			$("#bi_na").html("");
		}
	});
	</script>
    <script>
 $(document).ready(function()
 {
  $("#submit").live('click',function()
  {
	  var i=0;
	  if($("#fain_yes").prop("checked"))
		{
	  var fine_amt=$("#fine_amt").val();
		var filter=/^[0-9]{1,5}$/;
		if(fine_amt=="")
		{
			$("#fin").html("Required Field");
			i=1;
		}
		else if(!filter.test(fine_amt))
		{
			$("#fin").html("Numeric only max Length 5");
			i=1;
		}
		}
		var bill_name=$("#bill_name").val();
		var bfilter=/\w+.*$/;
		if(bill_name=="")
		{
			$("#bi_na").html("Required Field");
			$("#bill_name").css('border','1px solid red');
			i=1;
		}
		else if(!bfilter.test(bill_name))
		{
			$("#bi_na").html("Numeric and Alphanumeric");
			i=1
		}
		var fromdate=$('#from_date').val();
		if(fromdate=="")
		{
			$("#from_date").css('border','1px solid red');
			i=1;
		}
		var duedate=$('#due_date').val();
		if(duedate=="")
		{
			$("#due_date").css('border','1px solid red');
			i=1;
		}
	
		//$("#from_date").css('border','1px solid red');
		//$("#due_date").css('border','1px solid red');
		
		//else
		//{
			//$("#bi_na").html("");
		//}
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
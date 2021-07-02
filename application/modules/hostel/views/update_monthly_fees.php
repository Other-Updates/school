<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<script type="text/javascript">
$('.mandatory1').live('blur',function() 
	{
		var m=$(this).parent().find(".val");
		
		if($(this).val()=='' || $(this).val()==null || $(this).val().trim().length==0 || $(this).val()=='.' || $(this).val()==',' || $(this).val()==0 )
		{		
			m.html("Required field");	
			i=1;
			
		} 
		else
		{
			m.html("");		
		}
	});	
</script>
<table style="display:none;">
<tr id="last_row">
	<td>
    	 <input type="text" placeholder="Bill Name" class='bill_name' name='bill_name[]' id="test"/>
    </td>
    <td>    
    	<input type="text" placeholder="Amount" class='bill_amount' name='amount[]' id="test"/>
    </td>
    <td><input type="button" value="-" class='remove_comments btn bg-purple btn-sm'/></td>
</tr>
</table>
<form method="post" action="">
			<table class="form_table">
            	<tr>
                	<td width="200">Hostel Name</td>
                    <td><input type="hidden" name="m_id" value="<?=$monthly_fees[0]['id']?>">
                    	<select class='hostel_name' name="block_id">
                        	<option value="<?=$monthly_fees[0]['block_id']?>"><?=$monthly_fees[0]['block']?></option>
                    	 <?php
								if(isset($hostel_info) && !empty($hostel_info))
								{
									foreach($hostel_info as $val)
									{
										?>
										
											<option <?=($val['id']==$monthly_fees[0]['block_id'])?'selected':'';?> value="<?=$val['id']?>"><?=$val['block']?></option>
											
										<?php
										$i++;
									}
								}
							?>
                            </select>
                    </td>
                </tr>
                <tr>
                	<td>Month</td>
                    <td>
                    	<select class="month" name="fees_month" style="float:left;width:100px;">
                        	<option value="<?=$monthly_fees[0]['month']?>"><?php
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
					
					?></option>
                            <option class="31" <?=($monthly_fees[0]['month']==1)?'selected':'';?> value="1">January</option>
                            <option class="28" <?=($monthly_fees[0]['month']==2)?'selected':'';?> value="2">February</option>
                            <option class="31" <?=($monthly_fees[0]['month']==3)?'selected':'';?> value="3">March</option>
                            <option class="30" <?=($monthly_fees[0]['month']==4)?'selected':'';?> value="4">April</option>
                            <option class="31" <?=($monthly_fees[0]['month']==5)?'selected':'';?> value="5">May</option>
                            <option class="30" <?=($monthly_fees[0]['month']==6)?'selected':'';?> value="6">June</option>
                            <option class="31" <?=($monthly_fees[0]['month']==7)?'selected':'';?> value="7">July</option>
                            <option class="31" <?=($monthly_fees[0]['month']==8)?'selected':'';?> value="8">August</option>
                            <option class="30" <?=($monthly_fees[0]['month']==9)?'selected':'';?> value="9">September</option>
                            <option class="31" <?=($monthly_fees[0]['month']==10)?'selected':'';?> value="10">October</option>
                            <option class="30" <?=($monthly_fees[0]['month']==11)?'selected':'';?> value="11">November</option>
                            <option class="31" <?=($monthly_fees[0]['month']==12)?'selected':'';?> value="12">December</option>
                        </select>
                        <select name="fees_year"  style="width:100px;float:left;">
                            <option value="<?=$monthly_fees[0]['year']?>"><?=$monthly_fees[0]['year']?></option>
							<?php
                                for($i=2008;$i<=2050;$i++)
                                {
                                    ?>
                                    <option <?=($i==$monthly_fees[0]['year'])?'selected':'';?> value='<?=$i?>'><?=$i?></option>
                                    <?php
                                }
                            ?> 
                        </select>
                    </td>
                </tr>
                <tr>
                	<td>Date</td>
                    <td>
                    	<input type="text" style="float:left; margin-right:10px;" name="from_date" id="from_date" value="<?=$monthly_fees[0]['from_date']?>" class="date mandatory" />
                        <input type="text" style="float:left;" name="due_date" id="due_date" value="<?=$monthly_fees[0]['due_date']?>" class="date mandatory" /><span id="fin1" style="color:#F00;" class="val"></span>
                    </td>
                </tr>
               <tr>
               	<td>Fine</td>
                <td>
                	 <span style="float:left;">
                	 <input type="radio" id='fain_yes' class='fain_type' <?=($monthly_fees[0]['fine_type']=='yes')?'checked':'' ?> name="fine_type"  value="yes" /> Yes
                     <input type="radio" id='fain_no' class='fain_type' <?=($monthly_fees[0]['fine_type']=='no')?'checked':'' ?>  name="fine_type" value="no"     /> No
                     </span>
                    <span style="float:left;display:<?=($monthly_fees[0]['fine_type']=='yes')?'':'none'; ?>" id='type_div'> 
                    &nbsp;&nbsp;&nbsp;&nbsp; 
                     <input type="radio"   name="fine_option" <?=($monthly_fees[0]['fine_option']=='Day')?'checked':'' ?> class='pain_option'  value='Day'/> Day
                     <input value='Week'   name="fine_option" <?=($monthly_fees[0]['fine_option']=='Week')?'checked':'' ?> class='pain_option'  type="radio" /> Week 
                     <input value='Month' name="fine_option" <?=($monthly_fees[0]['fine_option']=='Month')?'checked':'' ?> class='pain_option'   type="radio" /> Month  
                      &nbsp;&nbsp;&nbsp;&nbsp; 
                     </span>
                     <span style="float:left;display:<?=($monthly_fees[0]['fine_type']=='yes')?'':'none'; ?>" id='amt_div'> 
                     <input type="text"  placeholder="Fine Amount" value="<?=$monthly_fees[0]['fine_amount'] ?>"  name="fine_amount" style="width:100px; float:left" class='fain_amt int_val' id="fine_amt" /><span class='per_fees_type' style="float:left; position:relative; top:10px; padding-left:5px;">  / Day</span>  <span id="fin" style="color:#F00;position: relative; left: 16px; top: 9px;" class="val"></span>
                     </span>
                </td>
               </tr>
                <tr>
                	<td style="vertical-align:top">
                    	Bill Details
                    </td>
                    <td>
                    	<table id='app_table'>
                        <?php if(isset($monthly_fees[0]['bill_details']) && !empty($monthly_fees[0]['bill_details'])) {
									foreach($monthly_fees[0]['bill_details'] as $val) {?>
                            <tr>
                                <td width="210">
                                    <input type="text" placeholder="Bill Name" value="<?= $val['bill_name']?>" class='bill_name mandatory' name='bill_name[]' id="bill_name"/><span id="fin2" style="color:#F00;" class="val"></span>
                                </td>
                                <td width="210">         
                                    <input type="text" placeholder="Amount" value="<?= $val['amount']?>" class='bill_amount mandatory1 mandatory ba1 int_val nmformat' name='amount[]' id="bill_amount"/><span id="fin3" style="color:#F00;" class="val"></span>
                                </td>
                               <?php } }?> 
                                <td><input type="button" value="+" class='add_row btn bg-purple btn-sm' id="dis"/></td>
                            </tr>
                            
                    	</table>
                        <table>
                            <tr>
                                <td width="210">
                                  
                                </td>
                                <td >         
                                    <input type="text" placeholder="Total Amount" value="<?=$monthly_fees[0]['total_amount']?>"  name="total_amount"  readonly="readonly" class='group length total_bill_amount mandatory1 mandatory' id="test"/>
                                </td>
                                
                                <td ></td>
                                 
                            </tr>
                    	</table>
                    </td>
                </tr>
                <tr>
                	<td>Monthly Fees / Head</td>
                    <td>
                    	<table>
                            <tr>
                                <td width="210">
                                  	<input type="text" style="width:100px;float:left;" readonly value="<?=$monthly_fees[0]['total_amount']?>" class="monthly_fees_head"  /><span style="float:left;margin-top:9px;">&nbsp;/&nbsp;</span>
                                    <input   style="width:90px;float:left;"  name="no_of_student"class="no_of_student mandatory" type="text" value="<?=$monthly_fees[0]['no_of_student']?>" readonly="readonly"  /> 
                                </td>
                                <td >         
                                    <input type="text" value="<?=$monthly_fees[0]['per_head']?>"  placeholder="Toatl Amount"  name="per_head"  readonly="readonly" class='group length total_monthly_fees_head'  id="test"/>
                                </td>
                                
                                <td ></td>
                                 
                            </tr>
                    	</table>
                    </td>
                </tr>
                <tr>
                	<td>Monthly Fees / Day</td>
                    <td>
                    	<table>
                            <tr>
                                <td width="210">
                                  <input type="text"  style="width:100px;float:left;" readonly class="monthly_fees_day" value="<?=$monthly_fees[0]['per_head']?>"  placeholder="Toatl Amount"  />
                                  <span style="float:left;margin-top:9px;">&nbsp;/&nbsp;</span>
                                  <input   style="float:left;width:90px;" class="no_of_days"  name="no_of_days" type="text" value="<?=$monthly_fees[0]['no_of_days']?>" readonly="readonly"  /> 
                                </td>
                                <td >         
                                    <input type="text"   name="per_day"  readonly="readonly" class='group length total_monthly_fees_day'  id="test" value="<?=$monthly_fees[0]['per_day']?>"/>
                                </td>
                                
                                <td ></td>
                                 
                            </tr>
                    	</table>
                    </td>
                </tr>
            </table>	
        	<input type="submit" id="submit" value="Update" class="btn btn-primary right" /><input type="reset" id="cancel" class="btn btn-danger " />
 </form>           





<script type="text/javascript">	
		$('.pain_option').live('click',function(){
			$('.per_fees_type').html('  / '+$(this).val());	
		});
		$('#fain_yes').live('click',function(){
		 	$('#type_div').show();  
			$('#amt_div').show();  		
		 });
		 $('.pain_option').live('click',function(){
		 	$('#amt_div').show();  	
		 });
		 $('#fain_no').live('click',function(){
		 	$('#amt_div').hide(); 
			$('#type_div').hide();   	
		 });
		$('.add_row').live('click',function(){
		 	$('#last_row').clone().appendTo('#app_table');  	
		 });
	   $(".remove_comments").live('click',function(){
			$(this).closest("tr").remove();
			sum=0;
			 $(".bill_amount").each(function(){
					sum=sum+Number($(this).val()); 
			 });
			   $(".total_bill_amount").val(sum.toFixed(2));
			    $(".monthly_fees_head").val(sum.toFixed(2));
				var a=sum.toFixed(2)/$(".no_of_student").val();
			  $(".total_monthly_fees_head").val(a.toFixed(2));
			   $(".monthly_fees_day").val(sum.toFixed(2));
			   var b=sum.toFixed(2)/$(".no_of_days").val();
			   $(".total_monthly_fees_day").val(b.toFixed(2));
	   });
	    $(".bill_amount").live('keyup',function(){
			sum=0;
			 $(".bill_amount").each(function(){
					sum=sum+Number($(this).val()); 
			 });
			  $(".total_bill_amount").val(sum.toFixed(0));
			  $(".monthly_fees_head").val(sum.toFixed(0));
			  console.log(sum);
			  console.log($('.no_of_student').val());
			  total_monthly_fees_head=sum/$('.no_of_student').val();
			  console.log(total_monthly_fees_head.toFixed(0));
			  $(".total_monthly_fees_head").val(total_monthly_fees_head.toFixed(0));
			  $(".monthly_fees_day").val(Number($(".total_monthly_fees_head").val()));
			  total_monthly_fees_day=Number($(".total_monthly_fees_head").val())/Number($('.no_of_days').val());
			  $(".total_monthly_fees_day").val(total_monthly_fees_day.toFixed(0));
			  
	   });
	   $(".no_of_student,.no_of_days").live('keyup',function(){
			sum=0;
			 $(".bill_amount").each(function(){
					sum=sum+Number($(this).val()); 
			 });
			  $(".total_bill_amount").val(sum.toFixed(0));
			  $(".monthly_fees_head").val(sum.toFixed(0));
			  total_monthly_fees_head=sum/$('.no_of_student').val();
			  $(".total_monthly_fees_head").val(total_monthly_fees_head.toFixed(0));
			  $(".monthly_fees_day").val(Number($(".total_monthly_fees_head").val()));
			  total_monthly_fees_day=Number($(".total_monthly_fees_head").val())/Number($('.no_of_days').val());
			  $(".total_monthly_fees_day").val(total_monthly_fees_day.toFixed(0));
			  
	   });
	     $(".hostel_name,.month").live('change',function(){
			sum=0;
			 $(".bill_amount").each(function(){
					sum=sum+Number($(this).val()); 
			 });
			  $(".total_bill_amount").val(sum.toFixed(0));
			  $(".monthly_fees_head").val(sum.toFixed(0));
			  total_monthly_fees_head=sum/$('.no_of_student').val();
			  $(".total_monthly_fees_head").val(total_monthly_fees_head.toFixed(0));
			  $(".monthly_fees_day").val(Number($(".total_monthly_fees_head").val()));
			  total_monthly_fees_day=Number($(".total_monthly_fees_head").val())/Number($('.no_of_days').val());
			  $(".total_monthly_fees_day").val(total_monthly_fees_day.toFixed(0));
			  
	   });
	    $(".month").live('change',function(){
			days=$(this).find('option:selected').attr("class");
			$('.no_of_days').val(days);
	   });
	    $(".hostel_name").live('change',function(){
			no_of_student=0;
			$.ajax({	
			  url:BASE_URL+"hostel/get_no_of_student_by_hostel_id",
			  type:'POST',
			  data:{ 
						h_id:$(this).val(),
				   },
			  success:function(result){
					$('.no_of_student').val($.trim(result));
			  }    
			});	
	   });
	   
	   
	   
	   
</script>
 <script>
	$("#fine_amt").live('blur',function()
	{
		var fine=$("#fine_amt").val();
		var filter=/^[0-9]{1,5}$/;
		if(fine=="" || fine==null || fine.trim().length==0)
		{
			$("#fin").html("Required Field");
		}
		else if(!filter.test(fine))
		{
			$("#fin").html("Numeric only max Length 5");
		}
		else
		{
			$("#fin").html("");
		}
	});
	$("#from_date").live('blur',function()
	{
		var from_date=$("#from_date").val();
		
		if(from_date=="" || from_date==null || from_date.trim().length==0)
		{
			$("#fin1").html("Required Field");
		}
			else
		{
			$("#fin1").html("");
		}
	});
	$("#due_date").live('blur',function()
	{
		var due_date=$("#due_date").val();
		
		if(due_date=="" || due_date==null || due_date.trim().length==0)
		{
			$("#fin1").html("Required Field");
		}
			else
		{
			$("#fin1").html("");
		}
	});
	$("#bill_name").live('blur',function()
	{
		var bill_name=$("#bill_name").val();
		if(bill_name=="" || bill_name==null || bill_name.trim().length==0)
		{
			$("#fin2").html("Required Field");
		}
			else
		{
			$("#fin2").html("");
		}
	});
	$("#bill_amount").live('blur',function()
	{
		var bill_amount=$("#bill_amount").val();
		if(bill_amount=="" || bill_amount==null || bill_amount.trim().length==0 || bill_amount==0)
		{
			$("#fin3").html("Required Field");
			$("#bill_amount").css('border','1px solid red');
		}
			else
		{
			$("#fin3").html("");
			$("#bill_amount").css('border','1px solid #CCCCCC');
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
	  var fine=$("#fine_amt").val();
		var filter=/^[0-9]{1,5}$/;
		if(fine=="" || fine==null || fine.trim().length==0)
		{
			$("#fin").html("Required Field");
			i=1;
		}
		else if(!filter.test(fine))
		{
			$("#fin").html("Numeric only max Length 5");
			i=1;
		}
		}
		var from_date=$("#from_date").val();
		var due_date=$("#due_date").val();
		if(from_date=="" || from_date==null || from_date.trim().length==0)
		{
			$("#fin1").html("Required Field");
			i=1;
		}
		else if(due_date=="" || due_date==null || due_date.trim().length==0)
		{
			$("#fin1").html("Required Field");
			i=1;
		}
		else
		{
			$("#fin1").html("");
		}
		var bill_name=$("#bill_name").val();
		if(bill_name=="" || bill_name==null || bill_name.trim().length==0)
		{
			$("#fin2").html("Required Field");
			i=1;
		}
			else
		{
			$("#fin2").html("");
		}
		var bill_amount=$("#bill_amount").val();
		if(bill_amount=="" || bill_amount==null || bill_amount.trim().length==0 || bill_amount==0)
		{
			$("#fin3").html("Required Field");
			$("#bill_amount").css('border','1px solid red');
			i=1;
		}
			else
		{
			$("#fin3").html("");
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
 	$("#cancel").live('click',function()
	{
	   $('.mandatory').val('');
	   $('.val').html("");
	   $('.mandatory').css('border','1px solid #CCCCCC');
	   //$('.pain').hide();
		
	});
 </script>
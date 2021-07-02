<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery.number.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/jquery.number.min.js" type="text/javascript"></script>
<script type="text/javascript">
$('.mandatory1').live('blur',function() 
	{
		var m=$(this).parent().find(".errormessage");
		
		if($(this).val()=='' || $(this).val()==null || $(this).val().trim().length==0 || $(this).val()=='.' || $(this).val()==',')
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
<table style="display:none;" class="staff_table">
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
<form method="post" name="sform">
			<table class="staff_table">
            	<tr>
                	<td>Hostel Name</td>
                    <td>
                    	<select class='hostel_name mandatory1 mandatory' name="hostel_monthly_fees[block_id]">
                        	<option value="">Select</option>
                    	 <?php
								if(isset($hostel_info) && !empty($hostel_info))
								{
									foreach($hostel_info as $val)
									{
										?>
										
											<option value="<?=$val['id']?>"><?=$val['block']?></option>>
											
										<?php
										$i++;
									}
								}
							?>
                            </select>
                            <span style="color:red;" id="hostel_error" class="errormessage"></span> 
                    </td>
                </tr>
                <tr>
                	<td>Month</td>
                    <td>
                    	<select class="month mandatory1 mandatory" name="hostel_monthly_fees[month]" style="float:left;width:95px;">
                        	<option value="">Select</option>
                            <option class="31" value="1">January</option>
                            <option class="28" value="2">February</option>
                            <option class="31" value="3">March</option>
                            <option class="30" value="4">April</option>
                            <option class="31" value="5">May</option>
                            <option class="30" value="6">June</option>
                            <option class="31" value="7">July</option>
                            <option class="31" value="8">August</option>
                            <option class="30" value="9">September</option>
                            <option class="31" value="10">October</option>
                            <option class="30" value="11">November</option>
                            <option class="31" value="12">December</option>
                        </select>&nbsp;&nbsp;
                        <select name="hostel_monthly_fees[year]"  style="width:95px;float:left; margin-left:10px;" class="mandatory1 mandatory year">
                            <option value="">Select</option>
							<?php
                                for($i=2008;$i<=2050;$i++)
                                {
                                    ?>
                                    <option value='<?=$i?>'><?=$i?></option>
                                    <?php
                                }
                            ?> 
                        </select>
                        <span style="color:red;" id="month_error" class="errormessage"></span> 
                    </td>
                </tr>
                <tr>
                	<td>Date</td>
                    <td>
                    	<input type="text" style="float:left;" name="hostel_monthly_fees[from_date]" placeholder="From Date" class="date mandatory1 mandatory from_date" />
                        <input type="text" style="float:left; margin-left:10px;" name="hostel_monthly_fees[due_date]"placeholder="Due Date" class="date mandatory1 mandatory due_date" />
                        <span style="color:red;" id="date_error" class="errormessage"></span> 
                    </td>
                </tr>
               <tr>
               	<td>Fine</td>
                <td>
                	 <span style="float:left;">
                	 <input type="radio" id='fain_yes' class='fain_type' name="hostel_monthly_fees[fine_type]"  value="yes" /> Yes &nbsp;&nbsp;
                     <input type="radio" id='fain_no' class='fain_type'  name="hostel_monthly_fees[fine_type]" value="no"  checked="checked"   /> No
                     </span>
                    <span style="float:left;display:none; padding-left:20px;" id='type_div' class="pain"> 
                    &nbsp;&nbsp;&nbsp;&nbsp; 
                     <input type="radio"   name="hostel_monthly_fees[fine_option]" class='pain_option' checked="checked" value='Day'/> Day
                     <input value='Week'   name="hostel_monthly_fees[fine_option]"class='pain_option' name='fees_info[fain_type]' type="radio" /> Week 
                     <input value='Month' name="hostel_monthly_fees[fine_option]" class='pain_option'  name='fees_info[fain_type]' type="radio" /> Month  
                      &nbsp;&nbsp;&nbsp;&nbsp; 
                     </span>
                     <span style="float:left;display:none;" id='amt_div'  class="pain">  
                    
                     <input type="text"  placeholder="Fine Amount"  name="hostel_monthly_fees[fine_amount]" style="width:100px; float:left" class='fine_amt' id="fine_amt" /><span class='per_fees_type' style="float:left; position: relative; top: 8px;left: 10px;">  / Day</span> <span id="fin" style="color:#F00; position: relative; left: 16px; top: 9px;"  class="errormessage"></span>
                     </span>
                     <span style="color:red;" id="fine_error" class="errormessage"></span> 
                </td>
               </tr>
                <tr>
                	<td width="30%">
                    	Bill Details
                    </td>
                    <td width="70%">
                    	<table id='app_table'>
                            <tr>
                                <td width="210">
                                    <input type="text" placeholder="Bill Name" class='bill_name mandatory1 mandatory bn1' name='bill_name[]' id="test"/>
                                    <span style="color:red;" id="bill_name_error" class="errormessage"></span> 
                                </td>
                                <td width="210">         
                                    <input type="text" placeholder="Amount" class='bill_amount mandatory1 mandatory ba1 int_val nmformat' name='amount[]' id="amount"/>
                                    <span style="color:red;" id="bill_amount_error" class="errormessage"></span> 
                                </td>
                                
                                <td ><input type="button" value="+" class='add_row btn bg-purple btn-sm' id="dis"/></td>
                            </tr>
                    	</table>
                        <table>
                            <tr>
                                <td width="28.5%">
                                  
                                </td>
                                <td >         
                                    <input type="text" placeholder="Total Amount"  name="hostel_monthly_fees[total_amount]"  readonly="readonly" class='group length total_bill_amount mandatory1 mandatory' id="test" />
                                    <span style="color:red;" id="total_amount_error" class="errormessage"></span> 
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
                                <td width="28.5%">
                                  	<input type="text" style="width:100px;float:left;" readonly="readonly" placeholder="Total Amount" class="monthly_fees_head"  /><span style="float:left;margin-top:9px;">&nbsp;&nbsp;/&nbsp;&nbsp;</span>
                                    <input   style="width:70px;float:left;"  name="hostel_monthly_fees[no_of_student]" class="no_of_student mandatory" type="text" readonly="readonly"  /> 
                                </td>
                                <td >         
                                    <input type="text"  placeholder="Total Amount"  name="hostel_monthly_fees[per_head]"  readonly="readonly" class='group length total_monthly_fees_head' id="test"/>
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
                                <td width="28.5%">
                                  <input type="text"  style="width:100px;float:left;" readonly="readonly" class="monthly_fees_day"  placeholder="Toatl Amount"  />
                                  <span style="float:left; margin-top:9px;">&nbsp;&nbsp;/&nbsp;&nbsp;</span>
                                  <input   style="float:left;width:70px;" class="no_of_days"  name="hostel_monthly_fees[no_of_days]" type="text" readonly="readonly"  /> 
                                </td>
                                <td >         
                                    <input type="text" placeholder="Total Amount"  name="hostel_monthly_fees[per_day]"  readonly="readonly" class='group length total_monthly_fees_day' id="test"/>
                                </td>
                                
                                <td ></td>
                                 
                            </tr>
                    	</table>
                    </td>
                </tr>
            </table>	<br />
		    <input type="submit" class="btn btn-primary right" /><input type="reset" id="cancel" class="btn btn-danger " /><br /><br />
 </form>           





<script type="text/javascript">	


				

			
		
		
		$('.pain_option').live('click',function(){
			$('.per_fees_type').html('  / '+$(this).val());	
		});
		$('#fain_yes').live('click',function(){
			
		 	$('#type_div').show();  
			$('#amt_div').show();  
			$('.fine_amt').addClass('mandatory');		
		 });
		 $('.pain_option').live('click',function(){
		 	$('#amt_div').show();  	
		 });
		 $('#fain_no').live('click',function(){
		 	$('#amt_div').hide(); 
			$('#type_div').hide();  
			$('.fine_amt').removeClass('mandatory'); 	
			$('.fine_amt').css('border','1px solid #CCCCCC');
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
	   
	// submit function
	   $("form[name=sform]").submit(function()
  {
	
   var i=0;
   var hostel_name=$(".hostel_name").val();
   var month=$(".month").val();
   var year=$(".year").val();
   var from_date=$(".from_date").val();
   var due_date=$(".due_date").val();
   var bill_name=$(".bn1").val();
   var bill_amount=$(".ba1").val();
   var no_of_student=$(".no_of_student").val();
   
   if(no_of_student==0 || no_of_student==null || no_of_student=="" || no_of_student.trim().length==0)
   {
	   $(".no_of_student").css('border','1px solid red');
			i=1;
   }
   if (hostel_name==null || hostel_name=="" || hostel_name==0 || hostel_name.trim().length==0) 
		  {
			$("#hostel_error").html("Required field");
			$(".hostel_name").css('border','1px solid red');
			i=1; 
		  }
      if (month==null || month=="") 
		  {
			$("#month_error").html("Required field");
			$(".month").css('border','1px solid red');
			i=1; 
		  }
		  
		  if (year==null || year=="") 
		  {
			$("#month_error").html("Required field");
			$(".year").css('border','1px solid red');
			i=1; 
		  }
		  if (from_date==null || from_date=="" || from_date==0 || from_date.trim().length==0) 
		  {
			$("#date_error").html("Required field");
			$(".from_date").css('border','1px solid red');
			i=1; 
		  }
		  if (due_date==null || due_date=="" || due_date==0 || due_date.trim().length==0)
		  {
			$("#date_error").html("Required field");
			$(".due_date").css('border','1px solid red');
			i=1; 
		  }
		  if (bill_name==null || bill_name=="" || bill_name==0 || bill_name.trim().length==0)
		  {
			 
			$("#bill_name_error").html("Required field");
			$(".bn1").css('border','1px solid red');
			i=1; 
		  }
		  
		  if (bill_amount==null || bill_amount=="" || bill_amount==0 || bill_amount.trim().length==0)
		  {
			$("#bill_amount_error").html("Required field");
			$(".ba1").css('border','1px solid red');
			i=1; 
		  }
		  else
		  {
		  }
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
		   
		    if(i==1)
   {
	  
	   return false;
   }
   else
   {
	  
   return true;
   }
     
   });
	$("#cancel").live('click',function()
	{
	   $('.mandatory').val('');
	   $('.errormessage').html("");
	   $('.mandatory').css('border','1px solid #CCCCCC');
	   $('.pain').hide();
		
	});
	
</script>

<script>
//fine amount validation

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
	</script>
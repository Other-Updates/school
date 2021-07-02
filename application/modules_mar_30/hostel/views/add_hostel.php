<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<table class="form_table">
	<tr>
    	<td width="360">Hostel Name</td>
        <td><input type="text" id='h_name' class="mandatory mandatory1 duplication " /><span style="color:red;" id="hostel_error" class="errormessage"></span><span id="duplic" style="color:#F00;" class="errormessage"></span></td>
    </tr>
    <tr>
    	<td>Hostel For</td>
        <td><input type="radio" name="gender" checked="checked" value='male' class="h_for" /> Male &nbsp;&nbsp;&nbsp;<input type="radio" value='female' class="h_for" name="gender" /> Female</td>
    </tr>
    <tr>
    	<td>Hostel Type</td>
        <td><input type="radio" name="type" value='0' checked="checked" class='d_system h_type'/> Dividing System &nbsp;&nbsp;&nbsp;<input type="radio" class='non_d_system h_type' name="type"  value='1'/> Non Dividing System</td>
    </tr>
    <tr>
    	<td><span id="refu">Refundable Amount</span><span id="deposit" style="display:none;">Deposit Amount</span> </td>
        <td ><input type="text"  style="float:left;" id='h_amt' class="mandatory mandatory1 int_val"/></span><span id='non_dy'  style="float:left;display:none;"><span  style="float:left; padding-left:10px;">Per Day &nbsp;&nbsp;</span><input type="text"  id='h_per_amt' class="mandatory mandatory1 int_val"/></span></td>
    </tr>
    <tr>
    <td></td><td><span style="color:red;" id="amount_error" class="errormessage"></span></td>
    </tr>
    <tr>
    	<td></td>
        <td><input type="button" class='btn btn-primary' id='add_hostel' value='Add'/>&nbsp;&nbsp;<input type="button" class="btn btn-danger" id="cancel" value="Cancel" /></td>
    </tr>
</table>
<br />
<div id='hostel_info'>
	<?php echo $this->load->view('hostel/view_hostel');?>
</div>

<script type="text/javascript">
$("#h_name").live('blur',function() 
	{
		var hostel=$("#h_name").val();
		var m=$("#hostel_error");
  		
		  if(hostel=='' || hostel==null || hostel.trim().length==0)
		  {
			  m.html("Required field");
			 
		  }
		 
		  else
		  {
			m.html("");
		  }
		});
		$("#h_amt").live('blur',function() 
	{
		var h_amt=$("#h_amt").val();
		//var filter=/^[0-9]{2,10}$/;
		var m=$("#amount_error");
  		
		  if(h_amt=='' || h_amt==null || h_amt.trim().length==0)
		  {
			  m.html("Required field");
			 
		  }
		 // else if(!fileer.test(h_amt))
//		  {
//			  m.html("Numeric Only");
//		  }
		 
		  else
		  {
			m.html("");
		  }
		});
		
		$("#h_per_amt").live('blur',function()
		{
			var h_per_amt=$('#h_per_amt').val();
			if(h_per_amt=='' || h_per_amt==null || h_per_amt.trim().length==0)
			{
				
				$("#amount_error").html('Required Field');
			}
			else
			{
				$("#amount_error").html('');
				
			}
		});


//$(".hostelname_val").live('blur',function() 
//	{
//		//alert("hi");
//		var hostel=$(this).val();
//		var m=$("#val1");
//		if(hostel=='' || hostel==null || hostel.trim().length==0)
//		  {
//			  m.html("Required field");
//			 
//		  }
//		  else
//		  {
//			  alert(hostel);
//			m.html("");
//	      }
//		});
//		
//		$(".amount_val").live('blur',function() 
//	   {
//		var h_amt=$(this).val();
//		//var filter=/^[0-9]{2,10}$/;
//		var m=$("#val2");
//  		 if(h_amt=='' || h_amt==null || h_amt.trim().length==0)
//		  {
//			  m.html("Required field");
//		  }
//		  //else if(!fileer.test(h_amt))
////		  {
////		  m.html("Numeric Only");
////		  }
//		  else
//		  {
//			  alert(h_amt);
//			m.html("");
//		  }
//		});

	// validation while updating
	
	
$('.non_d_system').live('click',function(){
	$('#non_dy').show();
	$('#deposit').show();
	$('#refu').hide();
});
$('.d_system').live('click',function(){
	$('#non_dy').hide();
	$('#refu').show();
	$('#deposit').hide();
	
});

$('#add_hostel').live('click',function(){
	var i=0;
	var h_name=$('#h_name').val();
	var h_amt=$('#h_amt').val();
	var h_per_amt=$('#h_per_amt').val();
	if(h_name==0 || h_name==null || h_name=="" || h_name.trim().length==0)
	{
		$('#hostel_error').html('Required Filed');
		$("#h_name").css('border','1px solid red');
		i=1;
	}
	if(h_amt==0 || h_amt==null || h_amt=="" || h_amt.trim().length==0)
	{
		$('#amount_error').html('Required Filed');
		$("#h_amt").css('border','1px solid red');
		i=1;
	}
	if($(".non_d_system").prop("checked"))
	{
	if(h_per_amt==0 || h_per_amt==null || h_per_amt=="" || h_per_amt.trim().length==0)
	{
		$('#amount_error').html('Required Filed');
		$("#h_per_amt").css('border','1px solid red');
		i=1;
	}
	}
	$('.h_for').each(function(){
		if($(this).attr('checked')=='checked')	
			h_for=$(this).val();
	});
	$('.h_type').each(function(){
		if($(this).attr('checked')=='checked')	
 			h_type=$(this).val();
	});
	if(i==0)
	{
		for_loading("Loading...Hostel Added");
	$.ajax({	
	  url:BASE_URL+"hostel/inset_hostel",
	  type:'POST',
	  data:{ 
				block:h_name,
				total_amount:h_amt,
				per_day:h_per_amt,
				block_for:h_for,
				hostel_type:h_type
		   },
	  success:function(result){
			$('#hostel_info').html(result);
			for_response("Hostel Added Successfully");
	  }    
	});	
	$('.mandatory1').val('');
	$("#h_name").css('border','1px solid #CCCCCC');
	$("#h_amt").css('border','1px solid #CCCCCC');
	$(".#h_per_amt").css('border','1px solid #CCCCCC');
	}
});
$("#cancel").live('click',function() {
	$('.mandatory1').val('');
	$('.errormessage').html('');
	$('#h_name').css('border','1px solid #CCCCCC');
	$('#h_amt').css('border','1px solid #CCCCCC');
	$('#h_per_amt').css('border','1px solid #CCCCCC');
	$("#add_hostel").attr("disabled", false);
});
	 //	Hostel name duplication checking
	  $(".duplication").blur(function()
  			{
				
         	block=$("#h_name").val(),
		    //alert(block);
		 $.ajax(
		 {
		  url:BASE_URL+"hostel/add_duplicate_hostel",
		  type:'POST',
		   data:{ value1:block},
		  success:function(result)
		  {
		     $("#duplic").html(result);
      		len=( (result + '').length );
			if(len>2){$("#add_hostel").attr("disabled", true);}
			else{$("#add_hostel").attr("disabled", false);}
		  	
		  }    		
		});
   }); 
</script>

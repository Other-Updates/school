
<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>  

 
 <script type="text/javascript">
 	var i=0;
	$('.mandatory1').live('blur',function() 
	{
		var m=$(this).parent().find(".errormessage");
		
		if($(this).val()=='' || $(this).val()==null || $(this).val().trim().length==0 || $(this).val()=='.' || $(this).val()==',')
		{		
			m.html("Required field");	
			i=1;
			
		} 
		else
			m.html("");		
	});	
	// name validation
	$("#name").live('blur',function() 
	{
		var name=$("#name").val();
		var filter= /^[a-zA-Z.\s]{3,50}$/;
		var m=$("#name_error");
  		
		  if(name=='' || name==null || name.trim().length==0)
		  {
			  m.html("Required field");
			  i=1;
		  }
		  else if (!filter.test(name)) 
		  {
			m.html("(Eg:itwosts.c)Minimum 3 to 20 characters");	
			  i=1;
		  }
		  else
		  {
			m.html("");
		  }
		});
	// password validation
		$("#password").live('blur',function() 
	    {
		var pass=$("#password").val();
		//var filter=/\w+.*$/;
		var m=$("#pass_error");
		if(pass.trim().length>0)
		{
  		if(pass.length<6 || pass.length>20) 
		  {
			m.html("Minimum 6 to Maximum 20");	
			 i=1;
		  }
		  else
		  {
			m.html("");
		  }
		}
		else
		{
			m.html("");
		}
		});
		// mobile validation
		$("#phone").live('blur',function() 
	    {
		var phone=$("#phone").val();
		var filter=/^[0-9]{10,12}$/;
		var m=$("#phone_error");
		if(phone=='' || phone==null || phone.trim().length==0)
		  {
			  m.html("Required field");
			  i=1;
		  }
  		else if (!filter.test(phone)) 
		  {
			m.html("Minimum 10 to 12 characters");	
			 
		  }
		  else if (phone==0) 
		  {
			m.html("Invalid");	
			 
		  }
		  else
		  {
			m.html("");
		  }
		});
		// address validation
		$("#address").live('blur',function() 
	    {
			
		var address=$("#address").val();
		var m=$("#add_error");
		if(address=='' || address==null || address.trim().length==0)
		  {
			  m.html("Required field");
			  i=1;
		  }
  		else if (address.length<6 || address.length>250) 
		  {
			 
			m.html("Minimum 6 to 250 characters");	
			 i=1;
		  }
		  else
		  {
			m.html("");
		  }
		});
		$('#email').live("blur",function()
 		{
	 		var email=$(this).val();
			 var id=$("#aid").val();
	 var error_msg=$("#errormessage");
	 var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	if(!filter.test(email))
	{
		error_msg.html("Enter valid email");
	}
	else
	{
		
	 $.ajax({
      url:BASE_URL+"admin/checking_email_update",
      type:'POST',
      data:{ value1 : email,value2:id},
      success:function(result){
      if((result.trim()).length>0)
	  {
		  
     error_msg.html(result);
	
	  }
	  else
	  {
		  
		  
	  }
      }    
    
    });
	}
 });
 </script>
<form action="" method="post" name="sform">
<div class="row">
<div class="col-lg-6">
<table class="staff_table">
<tr>
<tr>
<td><input type="hidden" name="aid" id="aid" value="<?php echo $list_admin[0]['id'] ?>"></td>
</tr>
	<td width="150">Name</td>
    <td><input type="text" name="name" id="name" class="mandatory1 mandatory" value="<?php echo $list_admin[0]['name']; ?>" autocomplete="off" onkeypress="return validateAlphabets(event);" maxlength="50" tabindex="1" /> <span style="color:red;" id="name_error" class="errormessage"></span> </td>
    
</tr>
<tr>
	<td>Password</td>
    <td><input type="password" name="password"   id="password" autocomplete="off" maxlength="20" tabindex="3" /> <span style="color:red;" id="pass_error" class="errormessage"></span>  </td>
    
</tr>
<tr>
	<td>Designation</td>
    <td><select name="designation" tabindex="5">
    <?php 
                    if(isset($desg) && !empty($desg)){
                        foreach($desg as $val)
                        {
                            ?>
     <option <?=($val['id']==$list_admin[0]['designation_id'])?'selected':''?> value="<?=$val['id']?>"><?=$val['designation']?></option>
                            <?php 
                        }
                    }
                ?>
    </select> <span style="color:red;" id="desg_error" class="errormessage"></span> </td>
	
</tr>
<tr>
	<td style="vertical-align:top">Address</td>
    <td><textarea id="address" name="address" class="mandatory1 mandatory" tabindex="6" style="height: 92px;"><?php echo $list_admin[0]['address']; ?></textarea> <span style="color:red;" id="add_error" class="errormessage"></span> </td>
</tr>
<tr>

</tr>
</table>
</div>
<div class="col-lg-6">
<table class="staff_table">
<tr>
<tr>
<td><input type="hidden" name="aid" id="aid" value="<?php echo $list_admin[0]['id'] ?>"></td>
</tr>
	
    <td width="150">Email ID</td>
    <td><input type="text" name="email" class="mandatory1 mandatory" id="email" value="<?php echo $list_admin[0]['email_id']; ?>" autocomplete="off" tabindex="2" /> <span style="color:red;" id="errormessage" class="errormessage"></span> </td>
</tr>
<tr>
	
    <td>Phone Number</td>
    <td><input type="text" name="phone" class="int_val mandatory1 mandatory" id="phone" value="<?php echo $list_admin[0]['phone_no']; ?>" autocomplete="off" maxlength="12" tabindex="4"   /><span style="color:red;" id="phone_error" class="errormessage"></span> </td>
</tr>
<tr>
	
	<td>Status</td>
    <td><select name="status" class="status" tabindex="7">
    <option value='<?php echo $list_admin[0]['status']; ?>' selected='selected'><?php echo ($list_admin[0]["status"]==1)?'Active':'Inactive'; ?></option>
    <?php 
	if($list_admin[0]["status"]==1)
	{
		?>
         <option value="0">Inactive</option>
         <?php 
	} else
	{
		?>
    <option value="1">Active</option>
   <?php
	}
	?>
    </select> <span style="color:red;" id="status_error" class="errormessage"></span> </td>
</tr>
<tr>
<td></td>
<td>
<input type="submit" value="Update" name="adding" id="submit" class="btn btn-primary" tabindex="8" />
<input type="reset" value="Cancel" id="cancel" class="btn btn-danger" tabindex="9"/>
</td>
</tr>

</table>
</div>
</div>

</form>
<script type="text/javascript">
$("form[name=sform]").submit(function()
  {
   var i=0;
   var message1=document.getElementById("errormessage").innerHTML;
   var email=$("#email").val();
   var name=$("#name").val();
   var password=$("#password").val();
   var filter= /^[a-zA-Z.\s]{3,50}$/;
   var phone=$("#phone").val();
   var pfilter=/^[0-9]{10,12}$/;
   var efilter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
   var phfilter=/\w+.*$/;
   var address=$("#address").val();
		if(name=="" || name==null || name.trim().length==0)
		{
		$("#name_error").html("Required field");
		$("#name").css('border','1px solid red');
			i=1;	
		}
		else if (!filter.test(name)) 
		  {
			$("#name_error").html("Minimum 3 to 20 characters");
			i=1;	
			 
		  }
		if(email=="" || email==null || email.trim().length==0)
		{
		$("#errormessage").html("Required field");
		$("#email").css('border','1px solid red');
			i=1;	
		}
		else if (!efilter.test(email)) 
		  {
			$("#errormessage").html("Enter valid email id");
			i=1;	
			 
		  }
		if(phone=="" || phone==null || phone.trim().length==0 || phone==0)
		{
		$("#phone_error").html("Required field");
		$("#phone").css('border','1px solid red');
			i=1;	
		}
		else if (!pfilter.test(phone)) 
		  {
			$("#phone_error").html("Minimum 10 to 12 characters");	
			 i=1;
		  }	
		if(address=="" || address==null || address.trim().length==0)
		{
		$("#add_error").html("Required field");
		$("#address").css('border','1px solid red');
			i=1;	
		}		
  		else if (address.length<6 || address.length>250) 
		  {
			 
			$("#add_error").html("Minimum 6 to 250 characters");
			i=1;	 
		  }
		  else
		  {
		  }
   if((message1.trim()).length >0 || i==1 || $("#pass_error").html().trim().length>0)
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
	 $("#name_error").html("");
	 $("#phone_error").html("");
	 $("#errormessage").html("");
	 $("#add_error").html("");
	 $("#pass_error").html("");
	 
 });
 

</script>
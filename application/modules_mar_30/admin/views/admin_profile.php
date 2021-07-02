<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<script type="text/javascript">
 $('.mandatory').live('blur',function() 
	{
		var m=$(this).parent().find(".errormessage");
		
		if($(this).val()=='' || $(this).val()==null || $(this).val().trim().length==0 || $(this).val()=='.' || $(this).val()==',')
		{		
			m.html("Required field");	
			
		} 
		else
			m.html("");		
	});	
	// name validation
	$("#name").live('blur',function() 
	{
		var name=$("#name").val();
		var filter= /^[a-zA-Z.\s]{3,50}$/;
		var m=$(this).parent().find(".errormessage");
  		if (!filter.test(name)) 
		  {
			m.html("Minimum 3 to 50 characters");	
			 
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
		var m=$(this).parent().find(".errormessage");
  		if (!filter.test(phone)) 
		  {
			m.html("Minimum 10 to 12 characters");	
			 
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
		var m=$(this).parent().find(".errormessage");
		//alert(address.length);
  		if (address.length<6 || address.length>250) 
		  {
			 
			m.html("Minimum 6 to 250 characters");	
			 
		  }
		  else
		  {
			m.html("");
		  }
		});
		// password validation
		$("#new_password").live('blur',function() 
	    {
			//alert("hi");
		var pass=$("#new_password").val();
		var filter=/^((?=.*[a-zA-Z])(?=.*\d)(?=.*[#@%$]).{6,20})$/;
		var m=$("#pass_error");
		if(pass==null || pass=="" || pass.trim().length==0)
		{
			m.html("Required field");
		}
  		else if (!filter.test(pass)) 
		  {
			m.html("Eg:(12!@we),Minimum 6 to 20 characters");	
			 
		  }
		  else
		  {
			m.html("");
		  }
		});
		
		
		$("#new_password1").live('blur',function() 
	    {
			//alert("hi");
		var pass=$("#new_password1").val();
		var filter=/^((?=.*[a-zA-Z])(?=.*\d)(?=.*[#@%$]).{6,20})$/;
		var m=$("#pass_error1");
		if(pass==null || pass=="" || pass.trim().length==0)
		{
			m.html("Required field");
		}
  		else if (!filter.test(pass)) 
		  {
			m.html("Eg:(12!@we),Minimum 6 to 20 characters");	
			 
		  }
		  else
		  {
			m.html("");
		  }
		});
		
</script>
<div class="row">
 <form class="editprofileform" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/admin_profile_update" enctype="multipart/form-data" name="sform">
<div class="col-md-3 profile-left">

    <h4>Your Profile Photo</h4>
    
    <div class="profilethumb">
        <a href="#">size 120*140</a>
        <img id="blah" class="add_staff_thumbnail" src="<?= $this->config->item("base_url").'profile_image/admin/original/'.$list[0]['image']; ?>"/><br />
        <input type='file' name="admin_image" id="imgInp" />
       <span style="color:red;" id="size_error"></span>
    </div><!--profilethumb-->
    <div class="db_download">
    <h4>Database Download</h4>
    <a title="Click to Download the Database" href="<?=$this->config->item('base_url').'admin/download_db' ?>" data-toggle="modal" name="group" ><img style="height:50px;width:50px;" src="<?= $theme_path; ?>/img/database_down.png"></a>
    </div>
</div>
<div class="col-md-9">  
        <h4>Login Information</h4>
        <p>
            <label>Username</label>
            <input type="text" id="name" name="username" maxlength="50" value="<?php echo $list[0]['name']; ?>" class="input-xlarge mandatory">
            <span style="color:red;" id="name_error" class="errormessage"></span>
        </p>
        <p>
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $list[0]['email_id']; ?>" class="input-xlarge mandatory" id="check_email">
            <span style="color:red;" id="errormessage" class="errormessage"></span>
        </p>
        <br />
        <h4>Password Change</h4>
        <table width="100%">
  <tr>
    <td width="9%"><label>New Password</label></td>
    
    <td><input type="password" name="new_password" id="new_password"  class="input-xlarge">
    <span style="color:#F00;" id="pass_error" ></span></td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label>Confirm&nbsp;Password</label></td>
   
    <td><input type="password" name="con_password" id="con_password"  class="input-xlarge" onchange="checkPass(); return false;">
    </span>
    </td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  <td><span style="color:#F00;" id="confirmMessage" class="confirmMessage"></span></td>
  </tr>
  <tr>
    
    <td>&nbsp;</td>
    <td style="padding:0 0 0 2px;">
    <input type="button" class="btn btn-primary delete"  name="update" id="change" value="Change" onclick="change_password();" />
    <input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel" value="Cancel" />
    </td>
  </tr>
</table>
        <!--<br />
         <h4>Password Change for social network</h4>
        <table width="100%">
  <tr>
    <td width="9%"><label>New Password</label></td>
    
    <td><input type="password" name="new_password" id="new_password1"  class="input-xlarge">
    <span style="color:#F00;" id="pass_error1" ></span></td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label>Confirm&nbsp;Password</label></td>
   
    <td><input type="password" name="con_password" id="con_password1"  class="input-xlarge" onchange="checkPass1(); return false;">
    
    </td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  <td><span style="color:#F00;" id="confirmMessage1" class="confirmMessage1"></span></td>
  </tr>
  <tr>
    
    <td>&nbsp;</td>
    <td style="padding:0 0 0 2px;">
    <input type="button" class="btn btn-primary delete"  name="update" id="change" value="Change" onclick="change_password1();" />
    <input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel1" value="Cancel" />
    </td>
  </tr>
</table>-->
        <br>
        
        <h4>Personal Information</h4>
        <p>
            <label>Designation</label>
            
            <select class="input-xlarge" name="designation">
    		<?php 
                    if(isset($desg) && !empty($desg)){
                        foreach($desg as $val)
                        {
                            ?>
                                <option <?=($val['id']==$list[0]['designation_id'])?'selected':''?> value="<?=$val['id']?>"><?=$val['designation']?></option>
                            <?php 
                        }
                    }
                ?>
				</select>
                  
        </p>
        <p>
            <label>Phone No</label>
            <input type="text" name="phone" id="phone" value="<?php echo $list[0]['phone_no']; ?>" class="input-xlarge mandatory int_val">
             <span style="color:red;" id="phone_error" class="errormessage"></span>
        </p>
        <p>
            <label>Address</label>
            <textarea name="address" id="address" style="height:70px;" class="mandatory"><?php echo $list[0]['address']; ?></textarea>
             <span style="color:red;" id="add_error" class="errormessage"></span>
        </p>
        
        <br>
        
        
        <p>
            <input type="submit" class="btn btn-primary" value="Update Profile" /> &nbsp; <?php /*?><a href="#deactive_<?php echo $list[0]['id']; ?>" data-toggle="modal" class="btn btn-danger">Deactivate your account</a><?php */?>
        </p>
    
</div>
</div>
</form>

 
<script type="text/javascript">
	 function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        if($(this).val()=="" || $(this).val()==null)
							{
								
							}
							else
							{
                        readURL(this);
							}
    });
	
$("#imgInp").change(function() {

    var val = $(this).val();
	//alert(val);
    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png': case '':
		    $(this).val();
            $("#size_error").html("");
            break;
        default:
            $(this).val();
           
           $("#size_error").html("Invalid File Type");
            break;
    }
});
$('#imgInp').bind('change', function() {

  //alert(this.files[0].size);
  if(this.files[0].size>1048576)
  {
	  var size_error="Profile Image:maximum size 1MB";
	  $("#size_error").html(size_error);
	  
  }
  else
  {
	  
  }

});
   $(document).ready(function()
 {
  $("#change_password").click(function()
  {
	  $("#password").show();
  });
  $("#cancel").click(function()
  {
	  $("#new_password").val('');
	  $("#con_password").val('');
	  $("#pass_error").html('');
	  $("#confirmMessage").html('');
	  $("#con_password").css("background-color","");
	  
	  
  });
  $("#cancel1").click(function()
  {
	  $("#new_password1").val('');
	  $("#con_password1").val('');
	  $("#pass_error1").html('');
	  $("#confirmMessage1").html('');
	  $("#con_password1").css("background-color","");
	  
	  
  });
  $("form[name=sform]").submit(function()
  {
	  var i=0;
   var message1=document.getElementById("errormessage").innerHTML;
   var message2=document.getElementById("size_error").innerHTML;
   var name=$("#name").val();
   var filter= /^[a-zA-Z.\s]{3,50}$/;
   var phone=$("#phone").val();
		var pfilter=/^[0-9]{10,12}$/;
		var address=$("#address").val();
  		if (!filter.test(name)) 
		  {
			$("#name_error").html("Minimum 3 to 50 characters");
			i=1;	
			 
		  }
		
  		if (!pfilter.test(phone)) 
		  {
			$("#phone_error").html("Minimum 10 to 12 characters");	
			 i=1;
		  }			
  		if (address.length<6 || address.length>250) 
		  {
			 
			$("#add_error").html("Minimum 6 to 250 characters");
			i=1;	 
		  }
   if((message1.trim()).length >0 || (message2.trim()).length >0 || i==1)
   {
	   
	   return false;
   }
   else
   {
	  
   return true;
   }
     
   });
 });
 
    $('#check_email').live("blur",function()
 {
	 var email=$("#check_email").val();
	 
	 var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	 if(!filter.test(email))
	 {
		 document.getElementById("errormessage").innerHTML="Enter valid email id";
	 }
	 else
	 {
	 $.ajax({
      url:BASE_URL+"admin/checking_email_admin",
      type:'POST',
      data:{ value1 : email},
      success:function(result){
      if((result.trim()).length>0)
	  {
   		document.getElementById("errormessage").innerHTML=result;	
	  }
	  else
	  {
		  
		 document.getElementById("errormessage").innerHTML="";	
		  
	  }
      }    
    
    });
	 }
 });
</script>
<div id="deactive_<?php echo $list[0]['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
   <div class="modal-dialog">
    <div class="modal-content">
    <form action="<?php echo $this->config->item('base_url'); ?>admin/deactivate_admin" method="post">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel"></h3>
    </div>
  <div class="modal-body" >
   	<b>Are you sure want to deactivate your account permanently?
    <input type="hidden" value="<?php echo $list[0]['id']; ?>" class="d_id" name="d_id" /></b>

  </div>
  <div class="modal-footer">
   <input type="submit" value="Yes" id="yesin" class="btn btn-primary delete"  />
   <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
  
  </div>
  </form>
  </div>
   
  </div>
</div>
<script type="text/javascript">
		function checkPass()
			{
				//Store the password field objects into variables ...
				var pass1 = document.getElementById('new_password');
				var pass2 = document.getElementById('con_password');
				//Store the Confimation Message Object ...
				var message = document.getElementById('confirmMessage');
				//Set the colors we will be using ...
				var goodColor = "#66cc66";
				var badColor = "#ff6666";
				//Compare the values in the password field 
				//and the confirmation field
				if((pass1.value!="" || pass1.value!=null) && (pass2.value!="" || pass2.value!=null))
				{
				if(pass1.value == pass2.value){
					//The passwords match. 
					//Set the color to the good color and inform
					//the user that they have entered the correct password 
					pass2.style.backgroundColor = goodColor;
					message.style.color = goodColor;
					message.innerHTML = "Passwords Match!"
					
				}else {
					//The passwords do not match.
					//Set the color to the bad color and
					//notify the user.
					pass2.style.backgroundColor = badColor;
					message.style.color = badColor;
					message.innerHTML = "Passwords Do Not Match!"
				}
				}
			} 
			function checkPass1()
			{
				//Store the password field objects into variables ...
				var pass1 = document.getElementById('new_password1');
				var pass2 = document.getElementById('con_password1');
				//Store the Confimation Message Object ...
				var message = document.getElementById('confirmMessage1');
				//Set the colors we will be using ...
				var goodColor = "#66cc66";
				var badColor = "#ff6666";
				//Compare the values in the password field 
				//and the confirmation field
				if((pass1.value!="" || pass1.value!=null) && (pass2.value!="" || pass2.value!=null))
				{
				if(pass1.value == pass2.value){
					//The passwords match. 
					//Set the color to the good color and inform
					//the user that they have entered the correct password 
					pass2.style.backgroundColor = goodColor;
					message.style.color = goodColor;
					message.innerHTML = "Passwords Match!"
				}else{
					//The passwords do not match.
					//Set the color to the bad color and
					//notify the user.
					pass2.style.backgroundColor = badColor;
					message.style.color = badColor;
					message.innerHTML = "Passwords Do Not Match!"
				}
				}
			} 
			function change_password()
			 {
				
				var i=0;
				var message1 =$("#confirmMessage");
				var message2 =$("#pass_error");
			    var con_password=$("#con_password").val();
			    var new_password=$("#new_password").val();
			   
			   if(new_password=='')
			   {
				  message1.html("Required Field");
				  i=1; 
			   }
			   if(con_password=='')
			   {
				  message2.html("Required Field");
				  i=1; 
			   }
			   else if(new_password != con_password)
			   {
				   message1.html("Passwords Do Not Match!");
				   i=1;
			   }
			  if(i==0 && message2.html().trim().length==0)
			  {
			 	for_loading('Changing Password...');
				 $.ajax({
				  url:BASE_URL+"admin/admin_password_change",
				  type:'POST',
				  data:{ new_password : new_password,
				  },
				  success:function(result){
				  
				  for_response('Password Changed Successfully...');
				 //alert(result);
				// window.location.href=BASE_URL+"admin/logout";
				 
				  
				  }    
				
				});
				 $("#new_password").val('');
	  $("#con_password").val('');
	  $("#pass_error").html('');
	  $("#confirmMessage").html('');
	  $("#con_password").css("background-color","");  
			  }
			  else
			  {
				  
			  }
				
			   
			   
 }
 function change_password1()
			 {
				
				var j=0;
				var message1 =$("#confirmMessage1");
				var message2 =$("#pass_error1");
			    var con_password=$("#con_password1").val();
			    var new_password=$("#new_password1").val();
				
			   if(new_password=='')
			   {
				  message1.html("Required Field");
				  i=1; 
			   }
			   if(con_password=='')
			   {
				  message2.html("Required Field");
				  i=1; 
			   }
			   else if(new_password != con_password)
			   {
				   message1.html("Passwords Do Not Match!");
				  j=1;
			   }
			   if(j==0 && message2.html().trim().length==0)
			   {
				   for_loading('Changing Password...');
				 $.ajax({
				  url:BASE_URL+"admin/admin_password_change_social",
				  type:'POST',
				  data:{ new_password : new_password,
				  },
				  success:function(result){
				  
				 for_response('Password Changed Successfully...');
				 
				  
				  }    
				
				});
				 $("#new_password1").val('');
				  $("#con_password1").val('');
				  $("#pass_error1").html('');
				  $("#confirmMessage1").html('');
				  $("#con_password1").css("background-color","");  
			  }
			  else
			  {
				  
			  }
				
			   
 }
		</script>
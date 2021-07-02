<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<script type="text/javascript">
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
			m.html("Eg(12!@qw)Minimum 6 to 20 characters");	
			 
		  }
		  else
		  {
			m.html("");
		  }
		});
</script>
<style>

</style>
  <div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/profile.png"></div>
    General Settings			
</div>
<form class="editprofileform" method="post" action="<?php echo $this->config->item('base_url'); ?>users/student_profile_update" enctype="multipart/form-data" name="sform">
<div class="page-inner"><div class="page-title"><span>Profile Images</span> </div></div>
<div class="message-divider"></div>
<div class="profile-left">
<div class="message-form-inner" style="float:left;">  
<div class="row profilethumb">
<div class="three user_profile_img">
<a href="#">size 150*150</a>       
<p class="user_profile_img_tit">Profile Image </p>
<?php

       if($all[0]['image']!='')
       {
       ?>
                            <img id="blah" class="add_staff_thumbnail" src="<?= $this->config->item("base_url").'profile_image/student/orginal/'.$all[0]['image']; ?>"/>
                               <?php
       }
       else
       {
       ?>
                            <img id="blah" class="add_staff_thumbnail"  src="<?= $this->config->item('base_url')?>profile_image/student/orginal/avatar5.png" />
                            <?php 
       }
       ?>
        <br />
       
        <input type='file' name="student_image" id="imgInp" />
        
</div>

<div class="four user_profile_img four_1">
<a href="#">size 980*170</a>       
<p class="user_profile_img_tit">Change Cover Image</p>
<?php
       if($all[0]['cover_image']!='')
       {
       ?>
<img id="cover_id" class="cover_thumbnail" src="<?= $this->config->item("base_url").'cover_image/student/original/'.$all[0]['cover_image']; ?>"/>
<?php 
	   }
	   else
	   {
	   ?>
       <img id="cover_id" class="cover_thumbnail"  src="<?= $this->config->item('base_url')?>cover_image/student/original/Tulips.jpg"/>
       <?php 
	   }
	   ?>
       <br />
     <input type='file' name="cover_image" id="cover"  />
    
</div>

<div class="four user_profile_img">
<a href="#">size 1200*800</a>       
<p class="user_profile_img_tit">Backgroud Image</p>
<?php
       if($all[0]['background_image']!='')
       {
       ?>
<img id="back_id" class="cover_thumbnail" src="<?= $this->config->item("base_url").'background_image/student/'.$all[0]['background_image']; ?>"/>
<?php 
	   }
	   else
	   {
	   ?>
       <img  id="back_id" class="cover_thumbnail" src="<?= $this->config->item('base_url')?>background_image/student/Chrysanthemum.jpg"/>
       <?php
	   }
	   ?>
       <br />
<input type='file' name="background_image" id="bge"  />

</div> 
</div>
</form>
<input type="submit" value="Update" class="btn btn-primary fright" />
<span id="size_error" style="color:#F00"></span>
</div>
</div>
<div class="page-inner"><div class="page-title"><span>Change Password</span></div></div>
<div class="message-divider"></div>
<div class="message-form-inner view_table">
  
    
<table width="100%" border="0" style="border:0">
  <tr>
    <td style="vertical-align:top" width="150">New Password</td>
    <td><input type="password" name="new_password" id="new_password"  class="input-xlarge"><span id="pass_error" style="color:#F00;" class="confirmMessage"></span></td>
  </tr>
  <tr>
    <td style="vertical-align:top">Confirm&nbsp;Password</td>
    <td><input type="password" name="con_password" id="con_password"  class="input-xlarge" onchange="checkPass(); return false;">
    <span id="confirmMessage" style="color:#F00;" class="confirmMessage"></span>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="padding:0 0 0 2px;">
    <input type="button" class="btn btn-primary delete"  name="update" id="change" value="Change" onclick="change_password();" />
    <input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel" value="Cancel" />
    <div id="rs_div"></div>
    </td>
  </tr>
</table>
 


</div>
<div class="page-inner"><div class="page-title"><span>Official Details</span></div></div>
<div class="message-form-inner view_table">
<div class="row">
<div class="six columns">
<table width="100%">
		   <tbody>	
		   <tr>
		   		<td width="140">Name</td>
				<td>:</td>
				<td class="text_bold"><?php echo $all[0]['name']."&nbsp;".$all[0]['last_name']; ?></td>
		   </tr>
		   <tr>
		   		<td>Class</td>
				<td width="5" >:</td>
				<td class="text_bold"><?php echo $all[0]['department']."-".$all[0]['std_group'][0]['group']; ?></td>
				
		   </tr>
		   <tr>
		   		<td>Date Of Admission</td>
				<td>:</td>
				<td class="text_bold"><?php echo date('d-m-Y',strtotime($all[0]['join_date'])); ?></td>
		   </tr>
		   </tbody>
</table>
</div>
<div class="six columns">
<table width="100%">
		   <tbody>	
		   <tr>
				<td width="140">Roll Number</td>
				<td width="5" >:</td>
				<td class="text_bold"><?php echo $all[0]['std_id']; ?></td>
		   </tr>
		   <tr>
				 <td >E-Mail</td>
				<td >:</td>
				<td class="text_bold"><?php echo $all[0]['email_id']; ?></td>
		   </tr>
		   <tr>
				 <td >Batch</td>
				<td >:</td>
				<td class="text_bold"><?php echo $all[0]['from']."-".$all[0]['to']; ?></td>
		   </tr>
		   </tbody>
</table>


</div>
</div>



</div>
<div class="page-inner"><div class="page-title"><span>Personal Details</span></div></div>
<div class="message-form-inner view_table">
<div class="row">
<div class="six columns">
<table width="100%">
	<tbody>
		   <tr>
				<td width="140" >Date Of Birth</td>
				<td width="5" >:</td>
				<td class="text_bold"><?php echo date('d-m-Y',strtotime($all[0]['dob'])); ?></td>
				 
		   </tr>
		    <tr>
				<td colspan="1">Current Age  </td>
				<td>:</td>
				<td class="text_bold">
				<?php 
				$d1=date('Y',strtotime($all[0]['dob']));
				$d2=date('Y');
				echo $d2-$d1; ?>			</td>
				
			</tr>
		    <tr>
		   		<td>Parent Name</td>
				<td>:</td>
				<td class="text_bold"><?php echo $all[0]['parent_name']; ?></td>
               
                
		   </tr>
		   <tr>
		   		<td>Student Mobile No</td>
				<td>:</td>
				<td class="text_bold"><?php echo $all[0]['contact_no']; ?></td>
                
                
		   </tr>
		   
		   </tbody>
</table>
</div>
<div class="six columns">
<table width="100%">
	<tbody>
		   <tr>
				
				<td width="140" >Age( While Admission )  </td>
				<td width="5">:</td>
				<td class="text_bold"><?php 
				$d1=date('Y',strtotime($all[0]['dob']));
				$d2=date('Y',strtotime($all[0]['join_date']));
				echo $d2-$d1; ?></td>
		   </tr>
		    <tr>
				
                <td>Emergency No</td>
                <td>:</td>
                <td class="text_bold"><?php echo $all[0]['emgy_no']; ?></td>
			</tr>
		    <tr>
		   		
                <td>Parent/Guardian No</td>
				<td>:</td>
				<td class="text_bold"><?php echo $all[0]['parent_no']; ?></td>
                
		   </tr>
		   <tr>
		   		
                <td ></td>
				<td></td>
				<td></td>
                
		   </tr>
		   
		   </tbody>
</table>
</div>
</div>

</div>
<div class="page-inner"><div class="page-title"><span>Communication Address</span></div></div>
<div class="message-form-inner view_table">
<table width="100%">
		   <tbody>	
		   <tr>
				<td width="140">Address</td>  
				<td width="5">:</td>
				<td class="text_bold">
                <?php echo $all[0]['address']; ?>
                </td>
				</tr>
		   </tbody>
</table>
<div class="row">
<div class="six columns">
<table width="100%">
		   <tbody>	
		   
				<tr>
		   		<td width="140">City</td>
				<td width="5">:</td>
				<td class="text_bold"><?php echo $all[0]['city']; ?></td>                
		   </tr>
           <tr>
           		<td>Country</td>
				<td>:</td>
				<td class="text_bold"><?php echo $all[0]['country']; ?></td>                
           </tr>
           
		   </tbody>
</table>
</div>
<div class="six columns">
<table width="100%">
		   <tbody>	
		   
		   <tr>		   		
                <td width="140">State</td>
				<td width="5">:</td>
				<td class="text_bold"><?php echo $all[0]['state']; ?></td>
		   </tr>
           <tr>           
                <td>Postal Code</td>
				<td>:</td>
				<td class="text_bold"><?php echo $all[0]['postal_code']; ?></td>
           </tr>
           
		   </tbody>
</table>
</div>
</div>


</div>

<div class="page-inner"><div class="page-title"><span>Educational Details</span></div></div>
<div class="message-form-inner">
<table width="100%" class="table demo my_table_style">
		   <thead>	
		   <tr>
                <th data-toggle="true">S.No</th>
                <th>Examination</th>
                <th>Board</th>
                <th data-hide="phone">Percentage (%)</th>
                <th data-hide="phone">Year of Passing</th>
			</tr>
            </thead>
            <tbody>
			<?php 
				$i=1;
                if(isset($all['qualification'][0]) && !empty($all['qualification'][0])){
                    foreach($all['qualification'][0] as $val)
                    {
                    ?>
                   		<tr>
                        	<td align="center"><?=$i?></td>
                            <td align="center"><?=$val['examination']?></td>
                            <td align="center"><?=$val['borad']?></td>
                            <td align="center"><?=$val['percentage']?></td>
                            <td align="center"><?=$val['p_year']?></td>
                        </tr>
        			<?php
					$i++; 
					}
				}
		?>
		   </tbody>
</table>


</div>
</div>
</div>
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
	$('#imgInp').bind('change', function() {

  
  if(this.files[0].size>1048576)
  {
	  
	  $("#size_error").html("Profile Image:maximum size 1MB");
	 
  }
  else
  {
	  $("#size_error").html("");
  }

});
	// upload
	/*function readImage(file) {
  
    var reader = new FileReader();
    var image  = new Image();
  
    reader.readAsDataURL(file);  
    reader.onload = function(_file) {
        image.src    = _file.target.result;              // url.createObjectURL(file);
        image.onload = function() {
            var w = this.width,
                h = this.height,
                t = file.type,                           // ext only: // file.type.split('/')[1],
                n = file.name,
                s = ~~(file.size/1024) +'KB';
            $('#blah').attr('src', e.target.result);
        };
        image.onerror= function() {
			var type_error="Invalid file type:";
	  $("#size_error").html(type_error);
	  
            //alert('Invalid file type: '+ file.type);
        };      
    };
    
}*/
$("#imgInp").change(function() {

    var val = $(this).val();

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png': case '': case 'jpeg':
           
            break;
        default:
            $(this).val();
            // error message here
           $("#size_error").html("Invalid File Type");
            break;
    }
});

	$('.add_row').click(function(){
		$('#last_row').clone().appendTo('#app_table');
		var i=4;  
		$('.dy_no').each(function(){
			$(this).html(i);
			i++;	
		});	
	 });
	$(".remove_comments").live('click',function(){
		$(this).closest("tr").remove();
		var i=4;  
		$('.dy_no').each(function(){
			$(this).html(i);
			i++;	
		});	
   });
   
   //cover
   function readURLC(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#cover_id').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#cover").change(function(){
        if($(this).val()=="" || $(this).val()==null)
							{
								
							}
							else
							{
                        readURLC(this);
							}
    });
	$('#cover').bind('change', function() {

  //alert(this.files[0].size);
  if(this.files[0].size>1500000)
  {
	  var cover_error="Cover image : maximum size 1.5MB";
	  $("#size_error").html(cover_error);
	  
  }
  else
  {
	  $("#size_error").html("");
  }

});
$("#cover").change(function() {

    var val = $(this).val();

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png': case '': case 'jpeg':
            
            break;
        default:
            $(this).val();
            // error message here
           $("#size_error").html("Invalid File Type");
            break;
    }
});
   // background
   function readURLB(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#back_id').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#bge").change(function(){
        if($(this).val()=="" || $(this).val()==null)
							{
								
							}
							else
							{
                        readURLB(this);
							}
    });
	$('#bge').bind('change', function() {

  //alert(this.files[0].size);
  if(this.files[0].size>1500000)
  {
	  var back_error="Background image : maximum size 1.5MB";
	  $("#size_error").html(back_error);
	  
  }
  else
  {
	  $("#size_error").html("");
  }

});
$("#bge").change(function() {

    var val = $(this).val();

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png': case '': case 'jpeg':
            
            break;
        default:
            $(this).val();
            // error message here
           $("#size_error").html("Invalid File Type");
            break;
    }
});	
   
$(document).ready(function()
 {
  $("#cancel").click(function()
  {
	  $("#new_password").val('');
	  $("#con_password").val('');
	  $("#confirmMessage").html('');
	  $("#pass_error").html('');
	  $("#con_password").css("background-color","");
	 
  });
  $("form[name=sform]").submit(function()
  {
   var message=$("#size_error").html();
   
   if((message.trim()).length >0)
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
 <script type="text/javascript">
 function change_password()
 {
	
	var i=0;
	var message1 =$("#confirmMessage");
	var message2 =$("#pass_error");
	var con_password=$("#con_password").val();
	var new_password=$("#new_password").val();
    if(new_password=='') 
			   {
				  message2.html("Required Field");
				 
				  i=1; 
			   }
			   if(con_password=='') 
			   {
				  message1.html("Required Field");
				 
				  i=1; 
			   }
			   else if(new_password != con_password)
			   {
				   message1.html("Passwords Do Not Match!");
				   i=1;
			   }
  if(i==0)
  {
   $('#rs_div').html('<img src="<?php echo $theme_path; ?>/img/loader_gr.gif" />');
     $.ajax({
      url:BASE_URL+"users/student_password_change",
      type:'POST',
      data:{ new_password : new_password,
	  },
      success:function(result){
      
	 //alert(result);
	  $('#rs_div').html('');
     
	  
      }    
    
    });
	$("#new_password").val('');
	  $("#con_password").val('');
	  $("#confirmMessage").html('');
	  $("#pass_error").html('');
	  $("#con_password").css("background-color","");	  
  }
  else
  {
	  
  }
  	
   
 }
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
		</script>

<br />
<br />

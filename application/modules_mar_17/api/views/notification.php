<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<div class="row">
 <form class="editprofileform" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/admin_profile_update" enctype="multipart/form-data">
<div class="col-md-3 profile-left">

    <h4>Your Profile Photo</h4>
    
    <div class="profilethumb">
        <a href="#">size 120*140</a>
        <img id="blah" class="add_staff_thumbnail" src="<?= $this->config->item("base_url").'profile_image/admin/original/'.$list[0]['image']; ?>"/>
       
        <input type='file' name="admin_image" id="imgInp" />
       <input type="hidden" name="aid" id="aid" value="<?php echo $list[0]['id']; ?>" />
    </div><!--profilethumb-->
    
</div>
<div class="col-md-9">
   
        <h4>Login Information</h4>
        <p>
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $list[0]['name']; ?>" class="input-xlarge">
        </p>
        <p>
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $list[0]['email_id']; ?>" class="input-xlarge">
        </p>
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
            <label style="padding:0">Password</label>
            <a href="#" data-toggle="modal" name="group" id="change_password"><strong>Change Password?</strong></a>
        </p>
        <div id="password" style="display:none">
        <p>
            <label>New Password</label>
            <input type="text" name="new_password" id="new_password"  class="input-xlarge">
        </p>
        <p>
            <label>Confirm&nbsp;Password</label>
            <input type="text" name="con_password" id="con_password"  class="input-xlarge" onKeyUp="checkPass(); return false;">
            
        </p>
        <p>
        	<label>&nbsp;</label>
        	<a href="#" data-toggle="modal" name="group" id="cancel" class="btn bg-maroon">Cancel</a>
        </p>
        <p><span id="confirmMessage" class="confirmMessage"></span></p>
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
        </div>
        <br>
        
        <h4>Personal Information</h4>
        
        <p>
            <label>Phone No</label>
            <input type="text" name="phone" value="<?php echo $list[0]['phone_no']; ?>" class="input-xlarge">
        </p>
        <p>
            <label>Address</label>
            <textarea name="address" style="height:100px;"><?php echo nl2br($list[0]['address']); ?></textarea>
        </p>
        
        <br>
        
        <h4>Notifications</h4>
        <p>
            <input type="checkbox"> Email me when someone mentions me... <br>
            <input type="checkbox"> Email me when someone follows me...
        </p>
        
        <br>
        <p>
            <input type="submit" class="btn btn-primary" value="Update Profile" /> &nbsp; <a href="#deactive_<?php echo $list[0]['id']; ?>" data-toggle="modal" class="btn btn-danger">Deactivate your account</a>
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
        readURL(this);
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
   $(document).ready(function()
 {
  $("#change_password").click(function()
  {
	  $("#password").show();
  });
  $("#cancel").click(function()
  {
	  $("#password").hide();
  });
  
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
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
		{
			m.html("");		
		}
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
			m.html("(Eg:itwosts.c)Minimum 3 to 50 characters");	
			
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
		var m=$("#pass_error");
		 if(pass=='' || pass==null || pass.trim().length==0)
		  {
			  m.html("Required field");
			  i=1;
		  }
  		else if(pass.length<6 || pass.length>20) 
		  {
			m.html("Minimum 6 to Maximum 20");	
			 i=1;
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
		
 </script>
<div class="row">
<div class="col-lg-6">
<table class="staff_table">
<tr>
	<td width="150">Name</td>
    <td><input type="text" tabindex="1" name="name"  id="name" class="mandatory1 mandatory" autocomplete="off" onkeypress="return validateAlphabets(event);" maxlength="50" /> <span style="color:red;" id="name_error" class="errormessage"></span> </td>
</tr>
<tr>
	<td>Password</td>
    <td><input type="password" tabindex="3" name="password"  class="mandatory1 mandatory" id="password" autocomplete="off" maxlength="20" /> <span style="color:red;" id="pass_error" class="errormessage"></span>  </td>
</tr>
<tr>
	<td>Designation</td>
    <td><select id="designation" class="mandatory1 mandatory" tabindex="5">
    <option value="">Select Designation</option>
    <?php 
    if(isset($desg) && !empty($desg))
{	
foreach($desg as $row) 
{
?>
<option value="<?php echo $row['id']; ?>"><?php echo $row['designation']; ?></option>
<?php 
}}
?>
    </select> <span style="color:red;" id="desg_error" class="errormessage"></span> </td>	
</tr>
<tr>
	<td style="vertical-align:top">Address</td>
    <td><textarea id="address" tabindex="6" class="mandatory1 mandatory" style="height: 60px;"></textarea> <span style="color:red;" id="add_error" class="errormessage"></span> </td>
</tr>

</table>

</div>
<div class="col-lg-6">
<table class="staff_table">
<tr>
    <td width="150">Email ID</td>
    <td><input type="text" tabindex="2" name="email" class="mandatory1 mandatory" id="email" autocomplete="off"   /> <span style="color:red;" id="errormessage" class="errormessage"></span> </td>
</tr>
<tr>
    <td>Phone Number</td>
    <td><input type="text" tabindex="4" name="phone" class="int_val mandatory1 mandatory" id="phone" autocomplete="off" maxlength="12"   /><span style="color:red;" id="phone_error" class="errormessage"></span> </td>
</tr>
<tr>
	
	<td>Status</td>
    <td><select name="status" id="status" class="mandatory1 mandatory" tabindex="7">
    <option value="">Select Status</option>
    <option value="1">Active</option>
    <option value="0">Inactive</option>
    </select> <span style="color:red;" id="status_error" class="errormessage"></span> </td>
</tr>

<tr>
<td></td>
<td>
<input type="button" value="Add" name="adding" id="submit" class="btn btn-primary" tabindex="8" />
<input type="button" value="Cancel" id="cancel" class="btn btn-danger" tabindex="9"/>
</td>
</tr>

</table>


</div>
</div>
<div class="nav-tabs-custom" id="list_all">
                                <ul class="nav nav-tabs">
                                    <li class="<?=($status==1)?'active':''?>"><a href="#tab_1" data-toggle="tab">Active</a></li>
                                    <li class="<?=($status!=1)?'active':''?>"><a href="#tab_2" data-toggle="tab">Inactive</a></li>
                                    
                                    
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane <?=($status==1)?'active':''?>" id="tab_1">
                                       
<table id="example1" class="table table-bordered table-striped">
<thead>
	<th>S.No</th>
    <th>Name</th>
     <th>Designation</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Status</th>
    <th>Created Date</th>
    <th>Action</th>
</thead>

<tbody>
<?php 

if(isset($list) && !empty($list))
{	
$row_count = 0;
foreach($list as $billto) 
{
	
	if($billto['status']==1)
	{
		$row_count++;
	?>			
					<tr><td><?php echo $row_count; ?></td>
                    <td><?php echo $billto["name"]; ?></td>
                     <td><?php echo $billto["designation"]; ?></td>
                    <td><?php echo $billto["email_id"]; ?></td>
                    <td><?php echo $billto["phone_no"]; ?></td>
                    <td><?php echo ($billto["status"]==1)?'Active':'Inactive'; ?></td>
                    <td><?php echo ($billto['ldt']==0)?'--':date("d-M-Y",strtotime($billto["ldt"])); ?></td>
                    <td><a href="#test_<?php echo $billto["id"]; ?>" title="View" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="<?=$this->config->item('base_url').'admin/update_admin/'.$billto["id"]; ?>" data-toggle="modal" title="Update" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="#delete_<?php echo $billto["id"]; ?>" title="In-Active" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                    </td></tr>

			<?php 		
				}
				
				}}
?>
</tbody>
</table>

                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane <?=($status!=1)?'active':''?>" id="tab_2">
                                        
<table id="example3" class="table table-bordered table-striped">
<thead>
	<th>S.No</th>
    <th>Name</th>
    <th>Designation</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Status</th>
    <th>Date</th>
    <th>Action</th>
</thead>

<tbody>
<?php 

if(isset($list) && !empty($list))
{	
$row = 0;
foreach($list as $billto) 
{
	if($billto['status']==0)
	{
		$row++;
	?>			
					<tr><td><?php echo $row; ?></td>
                    <td><?php echo $billto["name"]; ?></td>
                    <td><?php echo $billto["designation"]; ?></td>
                    <td><?php echo $billto["email_id"]; ?></td>
                    <td><?php echo $billto["phone_no"]; ?></td>
                    <td><?php echo ($billto["status"]==1)?'Active':'Inactive'; ?></td>
                    <td><?php echo ($billto['ldt']==0)?'--':date("d-M-Y",strtotime($billto["ldt"])); ?></td>
                    <td><a href="#test_<?php echo $billto["id"]; ?>" title="View" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="<?=$this->config->item('base_url').'admin/update_admin/'.$billto["id"]; ?>" data-toggle="modal" title="Update" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="#indelete_<?php echo $billto["id"]; ?>" title="Delete" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                    </td></tr>

			<?php 		
				}
				
				}
				}
?>
</tbody>
</table>

                                    </div><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->
                            </div>


<script type="text/javascript">

 $(document).ready(function()
 {
  $("#submit").live('click',function()
  {
 var i=0;
   var name=$("#name").val(),
   email=$("#email").val(),
   password=$("#password").val(),
   phone=$("#phone").val(),
   address=$("#address").val(),
   designation=$("#designation").val()
   status=$("#status").val(),
   hidden_msg=document.getElementById("errormessage").innerHTML;
   var nfilter= /^[a-zA-Z.\s]{3,50}$/;
   var phfilter=/^[0-9]{10,12}$/;
   var efilter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
   
   if(email=='' || email==null || email.trim().length==0)
		  {
			  $("#errormessage").html("Required field");
			  $("#email").css('border','1px solid red');
			  i=1;
		  }
		 if(designation=='')
		  {
			  $("#desg_error").html("Required field");
			  $("#designation").css('border','1px solid red');
			  i=1;
		  }
		  if(status=='')
		  {
			  $("#status_error").html("Required field");
			  $("#status").css('border','1px solid red');
			  i=1;
		  } 
		 else if (!efilter.test(email)) 
		  {
			$("#errormessage").html("Enter valid email id");	
			  i=1;
		  }
   if(name=='' || name==null || name.trim().length==0)
		  {
			  $("#name_error").html("Required field");
			  $("#name").css('border','1px solid red');
			  i=1;
		  }
		  else if (!nfilter.test(name)) 
		  {
			$("#name_error").html("(Eg:itwosts.c)Minimum 3 to 50 characters");	
			  i=1;
		  }
		if(password=='' || password==null || password.trim().length==0)
		  {
			  $("#pass_error").html("Required field");
			  $("#password").css('border','1px solid red');
			  i=1;
		  }
  		else if(password.length<6 || password.length>20) 
		  {
			m.html("Minimum 6 to Maximum 20");	
			 i=1;
		  }
		if(phone=='' || phone==null || phone.trim().length==0)
		  {
			  $("#phone_error").html("Required field");
			  $("#phone").css('border','1px solid red');
			  i=1;
		  }
  		else if (!phfilter.test(phone)) 
		  {
			$("#phone_error").html("Minimum 10 to 12 characters");	
			  i=1;
		  }
		  if(address=='' || address==null || address.trim().length==0)
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
		 
   if((hidden_msg.trim()).length==0 && i==0)
   {
	    for_loading('Loading... Data Adding...');
     $.ajax({
      url:BASE_URL+"admin/insert_admin",
      type:'POST',
      data:{ value1 : name,value2:email,value3:password,value4:phone,value5:status,value6:address,value7:designation},
      success:function(result){
	
      $("#list_all").html(result);
	  for_response('Add Successfully...!'); //
	    $(".after_email").html('');
      }    
    
    });
	$('.mandatory1').val('');
	$('.mandatory').css('border','1px solid #CCCCCC');
	
   }
   else
   {
	  
  
 
	   
   }
	
	  //resutl notification 
   }); 
  
   $("#cancel").click(function()
   {
	   $('.mandatory1').val('');
	   $('.errormessage').html("");
	   $('.mandatory').css('border','1px solid #CCCCCC');
   });
   $("#email").blur(function()
  {
	  
   var email=$("#email").val();
	 var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	 if(email=='' || email==null || email.trim().length==0)
	 {
		  document.getElementById("errormessage").innerHTML="Required field";
	 }
	 else if(!filter.test(email))
	 {
		 document.getElementById("errormessage").innerHTML="Enter valid email id";
	 }
	 else
	 {
     $.ajax({
      url:BASE_URL+"admin/checking_email_insert",
      type:'POST',
      data:{ value1 : email},
      success:function(result){
		  
      $("#errormessage").html(result);
	  
	  
      }    
    
    });
	 }
   });
   
   
 });


 
$("#yes").live("click",function()
  {
	   for_loading_del('Loading... In-Active wait...'); // loading notification
   var hid=$(this).parent().parent().find('.hid').val();

     $.ajax({
      url:BASE_URL+"admin/delete_admin_active",
      type:'POST',
      data:{ value1 : hid},
	  
      success:function(result){
      
      $("#list_all").html(result);
	   for_response_del('In-Active  Successfully...!'); // resutl notification  
	  
      }    
    
    });
	
		

	
	 $('.modal').css("display", "none");
    $('.fade').css("display", "none"); 
	  
   }); 
   
    $("#no").live("click",function()
  {
   $('.modal').css("display", "none");
    $('.fade').css("display", "none");
	  
	  
   }); 
   
   $("#yesin").live("click",function()
  {
	   for_loading_del('Loading... Data Removing wait...'); // loading notification
   var hidin=$(this).parent().parent().find('.hidin').val();

     $.ajax({
      url:BASE_URL+"admin/delete_admin_inactive",
      type:'POST',
      data:{ value1 : hidin},
	  
      success:function(result){
      
      $("#list_all").html(result);
	  for_response_del('Remove Successfully...!'); // resutl notification   
      }    
    
    });
	 $('.modal').css("display", "none");
    $('.fade').css("display", "none"); 
	  
   }); 
</script>

 <?php 
if(isset($list) && !empty($list))
{	
foreach($list as $billto) 
{
	?>
<div id="test_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
   <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel">Admin View</h3>
    </div>
  <div class="modal-body" >
<table class="view_table">
<tr>
	<td>Name</td><td class="text_bold"> <?php echo $billto['name']; ?></td>
</tr>
<tr>
	<td>Designation</td><td class="text_bold"> <?php echo $billto['designation']; ?></td>
</tr>
<tr>
	<td>Email ID</td><td class="text_bold"> <?php echo $billto['email_id']; ?> </td>
</tr>
<tr>
	<td>Phone Number</td><td class="text_bold"> <?php echo $billto['phone_no']; ?></td>
</tr>
<tr>
	<td>Address</td><td class="text_bold"> <?php echo nl2br($billto['address']); ?></td>
</tr>
<tr>
	<td>Status</td><td class="text_bold"> <?php  echo ($billto["status"]==1)?'Active':'Inactive'; ?></td>
</tr>
</table>

  </div>
  <div class="modal-footer">   
      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
   </div>
   </div>  
  </div>
</div>
<?php
}}
?>

 <?php 
if(isset($list) && !empty($list))
{	
foreach($list as $billto) 
{
	?>
    <div id="close">
<div id="delete_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
   <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel">Admin Inactive</h3>
    </div>
  <div class="modal-body" >
   	Are you sure want to move  <b><?php echo $billto['name']; ?></b> to Inactive?
    <input type="hidden" value="<?php echo $billto['id']; ?>" class="hid" />
    <input type="hidden" value="<?php echo $billto['status']; ?>" class="status" />
  </div>
  <div class="modal-footer">
   <input type="button" value="In-Active" id="yes" class="btn btn-primary delete"  />
   <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
  </div>
  </div>
  </div>
</div>
</div>
<?php
}}
?>
<?php 
if(isset($list) && !empty($list))
{	
foreach($list as $billto) 
{
	?>
    <div id="close">
<div id="indelete_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
   <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel">Delete Admin</h3>
    </div>
  <div class="modal-body" >
   	Are you sure want to delete <b><?php echo $billto['name']; ?></b> permanently?
    <input type="hidden" value="<?php echo $billto['id']; ?>" class="hidin" />

  </div>
  <div class="modal-footer">
   <input type="button" value="Yes" id="yesin" class="btn btn-primary delete"  />
   <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
  </div>
  </div>
  </div>
</div>
</div>
<?php
}}
?>
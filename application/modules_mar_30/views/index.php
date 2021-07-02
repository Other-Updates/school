<div class="box-body table-responsive">
<table width="100%" border="0" class="form_table">
    <tr>
       <td width="110"><b>Add Department</b></td>
        <td width="120"><input type="text" name="department"  value="" class="mandatory mandatory6" placeholder="Enter Department" onkeypress="return validateAlphabets(event);" id="name"/><td><span id="color" style="color:#FC3;margin-left:30%"><h5><blink>You must add the group after department entry</blink></h5></span></td></td>
        <tr>
 	    <td width="110"><b>Nick Name</b></td>
        <td><input type="text" name="nick_name" placeholder="Ex:CSE" class="mandatory mandatory6" id="nickname" /></td>
        </tr>
    <tr>
    <tr><td></td><td colspan="2"><span id="errormessage" style="color:#F00;"></span> <span id="errormessage1" style="color:#F00;"></span> </td></tr>
    	<td></td>
    	<td><input type="button" value="Add" name="adding" id="submit" onclick="return validate()" class="btn btn-primary"/>&nbsp;&nbsp;
        <input type="reset" value="Cancel" id="cancel" class="btn btn-danger"/></td>
    </tr>
</table>

<br />

<span id="error" style="color:#F00;"></span>
<div class="nav-tabs-custom" id="list_all"><ul class="nav nav-tabs">
 <li class="<?=($status==1)?'active':''?>"><a href="#tab_1" data-toggle="tab">Active</a></li>
 <li class="<?=($status!=1)?'active':''?>"><a href="#tab_2" data-toggle="tab">Inactive</a></li>
 <li class="pull-right"><a href="#" class="text-muted"></a></li>
 </ul><div class="tab-content"><div class="tab-pane <?=($status==1)?'active':''?>" id="tab_1">
	<table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>S.No</th>
                <th>Department</th>
                <th>Nick Name</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
			<?php 
                if(isset($details) && !empty($details))
                {
					$i=0;
                    foreach($details as $billto)
                    {
                        if($billto['status']==1)
                        
                        {
							$i++
            ?>   
                 <tr><td><?php echo "$i"; ?></td>
                 <td><?php echo $billto["department"]; ?></td>
                  <td><?php echo $billto["nickname"]; ?></td>
                 <td><?=($billto['status']==1)?'Active':'In-Active';?></td>
                <td><?php echo ($billto['ldt']==0)?'--':date("d-M-Y",strtotime($billto["ldt"])); ?></td>
                 
                 </td>
                 <td>
                 <a href="#test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm" title="View"><i class="fa fa-eye"></i></a>
                 <a href="#test1_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                 <a href="#test2_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn btn-danger btn-sm" title="In-Active"><i class="fa fa-times"></i></a>
                </td>
                </tr>
           <?php   
            }}}
        ?>
        </tbody>
	    </table>
   </div><!-- /.tab-pane -->
   <div class="tab-pane <?=($status!=1)?'active':''?>" id="tab_2"  >
	<table id="example3" class="table table-bordered table-striped">
		<thead>
        <tr><th>S.No</th>
            <th>Department</th>
            <th>Nick Name</th>
            <th>status</th>
            <th>Date</th>
            <th>Action</th>
        </tr></thead>
		<tbody>
		<?php 
			if(isset($details) && !empty($details))
			{
				$i=0;
				foreach($details as $billto) 
				{
					if($billto['status']==0)
					
					{
						$i++;
		?>   
         <tr><td><?php echo "$i"; ?></td>
         <td><?php echo $billto["department"]; ?></td>
         <td><?php echo $billto["nickname"]; ?></td>
         <td><?=($billto['status']==1)?'Active':'In-Active';?></td>
        <td><?php echo ($billto['ldt']==0)?'--':date("d-M-Y",strtotime($billto["ldt"])); ?></td>
         </td><td>
<a href="#test_<?php echo $billto['id'];?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm" title="View"><i class="fa fa-eye"></i></a>
<a href="#test1_<?php echo $billto['id'];?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
 <a href="#test3_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-times"></i></a>
        </td></tr>
           <?php   
            }}}
        ?>
        </tbody>
		</table>
	</div></div><!-- /.tab-pane --></div><!-- /.tab-content -->
    </div>

<?php 
if(isset($details) && !empty($details))
{
foreach($details as $billto) 
{
 ?>   

<div id="test_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  <div class="modal-dialog">
  <div class="modal-content">
     <div class="modal-header"><a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel">Department View</h3>
    </div>
  <div class="modal-body">
  <table width="100%" class="staff_table_sub">
        <tr>
        <?php /*?><td><strong>S.No</strong></td> <td><?php echo $billto["id"]; ?></td></tr><tr><?php */?>
        <td><strong>Department</strong></td> <td class="text_bold1"><?php echo $billto["department"]; ?></td></tr><tr>
        <tr> <td><strong>NickName</strong></td> <td class="text_bold1"><?php echo $billto["nickname"]; ?></td></tr>
        <td><strong>Status</strong></td><td class="text_bold1"><?=($billto['status']==1)?'Active':'In-Active';?></td>
        </tr>
  </table>
  </div>
  <div class="modal-footer">
     <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Discard</button>    
  </div>
  </div>
  </div>
</div>
<?php }} ?>
<?php 
if(isset($details) && !empty($details))
{
foreach($details as $billto) 
{
 ?>   

<div id="test1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" 
  role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  	<div class="modal-dialog">
  	<div class="modal-content">
    <div class="modal-header"><a class="close" data-dismiss="modal">×</a>   
    <h3 id="myModalLabel">Update Department</h3>
    </div>
  	<div class="modal-body">
     	 <table width="100%">
         <tr>
         <!--<td><strong>S.No</strong></td>-->
        <td><input type="hidden" name="id" class="id form-control" id="id" value="<?php echo $billto["id"]; ?>" readonly /></td>
         </tr>         
         <tr>
         <td><strong>Department:</strong></td>
         <td><input type="text" class="department form-control" id="department" onblur="this.value=removeSpaces(this.value)" name="department" value="<?php echo $billto["department"]; ?>" /><input type="hidden" id="desg" class="desg" value="<?php echo $billto["department"]; ?>" /><span class="error_msg" style="color:#F00;"></span> <span class="error_msg1" style="color:#F00;"></span></td>
         </tr>
         <tr>
         <td><strong>NickName:</strong></td>
         <td><input type="text" class="nickname"  name="nickname" value="<?php echo $billto["nickname"];?>" />
         <input type="hidden" class="nickname_hidden" value="<?php echo $billto["nickname"]; ?>" />
         <span class="nick_error" style="color:#F00;"></span></td>
         </tr>
         <tr>
         <td><strong>Status:</strong></td>
         <td>
         <select name="status" id="status" class="status form-control mandatory" >
         <option <?=($billto['status']==1)?'selected':'';?> value="1">Active</option>
        <option <?=($billto['status']==0)?'selected':'';?> value="0">In-Active</option>
        
         </select><input type="hidden" id="stat" class="stat" value="<?php echo $billto["status"]; ?>"/></td>
         </tr>
         </table>
  	</div>
  		<div class="modal-footer">
   			 <!--<input type="button" id="update"  value="Update" name="update" />
             <input type="button" id="no" value="no" name="no" />-->
             
             <button type="button" class="btn btn-primary"  id="update"><i class="fa fa-edit"></i> Update</button>
    		 <button type="reset" class="btn btn-danger"  id="no" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
    
  		</div>
</div>
</div>        
</div>
<?php }} ?>
<?php 
if(isset($details) && !empty($details))
{
foreach($details as $billto) 
{
 ?>   
<div id="test2_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
<div class="modal-dialog">
  <div class="modal-content">
     <div class="modal-header"> <a class="close" data-dismiss="modal">×</a>
   
    <h3 id="myModalLabel">In-Active Department</h3>
    </div>
  <div class="modal-body">
     Do you want to In-Active? &nbsp; <strong><?php echo $billto["department"]; ?></strong>
     <input type="hidden" value="<?php echo $billto['id']; ?>" class="hid" />
  </div>
  <div class="modal-footer">
   	
    
    <button class="btn btn-primary delete_yes" id="yes">Yes</button>
    <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i>No</button>
  </div>
</div>
</div>  
</div>
<?php }} ?>


<!--delete all-->
<?php 
if(isset($details) && !empty($details))
{
foreach($details as $billto) 
{
 ?>   
<div id="test3_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a><h4>Delete Department</h4><h3 id="myModalLabel">
</div><div class="modal-body">
     Do you want to delete Permanently? &nbsp; <strong><?php echo $billto["department"]; ?></strong>
     <input type="hidden" value="<?php echo $billto['id']; ?>" class="hidin" />
  </div><div class="modal-footer">
    <button class="btn btn-primary delete_yes" id="yesin">Yes</button>
    <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i> No</button>
  </div>
</div>
</div>  
</div>
<?php }} ?>
<script type="text/javascript">
 $(document).ready(function()
 {
	// $("#name").focus();
	 
  $("#submit").click(function()
  {
         var name=$("#name").val();
		  var nickname=$("#nickname").val();
		 var message=document.getElementById("errormessage").innerHTML;
		  var message1=document.getElementById("errormessage1").innerHTML;
		  if (name.trim().length>=2 && name.trim().length<=50) {
          
        
		
		 if((message.trim()).length==0 && (message1.trim()).length==0)
		 {
			  for_loading('Loading... Data add Please Wait '); // loading notification
		 $.ajax(
		 {
		  url:BASE_URL+"department/insert_department",
		  type:'POST',
		  data:{ value1 : name,value2 : nickname},
		  success:function(result)
		  {
		     $("#list_all").html(result);
			 for_response('Successfully Add...!'); // resutl notification
			
		  }    		
		});
		$("#name").val('');
		$("#nickname").val('');
		 }
		 else
		 {
			for_response_del('Already Exist...!'); // resutl notification 
		 }
		  }
  			else
			{
				document.getElementById("errormessage").innerHTML="Must be Enter Min 2 To Max 50 character";
		}
		
   }); 
   
   $("#name").blur(function()
  {
        var name=$("#name").val();	   
		 $.ajax(
		 {
		  url:BASE_URL+"department/checking_department",
		  type:'POST',
		  data:{ value1 : name},
		  success:function(result)
		  {
		     $("#errormessage").html(result);
			
		  }    		
		});
   }); 
   // checking nick name duplication insert
   $("#nickname").blur(function()
  {	  
        var name=$(this).val();	   
		 $.ajax(
		 {
		  url:BASE_URL+"department/checking_nickname",
		  type:'POST',
		  data:{ nick_name : name},
		  success:function(result)
		  {
		     $("#errormessage1").html(result);
			
		  }    		
		});
   }); 
   // checking nick name duplication update
   $(".nickname").blur(function()
  {
	  
        var name=$(this).val();	 
		var id=$(this).parent().parent().parent().find('.id').val(); 
		var msg=$(this).offsetParent().find('.nick_error'); 
		
		 $.ajax(
		 {
		  url:BASE_URL+"department/checking_nickname_update",
		  type:'POST',
		  data:{ nick_name : name,id:id},
		  success:function(result)
		  {
		     msg.html(result);
			
		  }    		
		});
   }); 
   $("#update").live("click",function()
  {	  
var department=$(this).parent().parent().find(".department").val();
//var nickname=$(this).parent().parent().find(".nickname").val();
  var i=0;
		 var message=$(".error_msg");
		 var message1=$(".error_msg1").html();
		  if (department.trim().length<2 || department.trim().length>50)
		//   if (nickname.trim().length<2 || nickname.trim().length>50)
		   {
			   //alert("alert");
			   message.html("Min 2 To Max 50 character");
			   i=1;
		  }
		  else
		  {
			  message.html("");
		  }
		 if(i==0 && message1.trim().length==0)
		 {
   for_loading('Loading... Data add Please Wait '); // loading notification
   var id=$(this).parent().parent().find('.id').val(),
   department=$(this).parent().parent().find('.department').val(),
   status=$(this).parent().parent().find('.status').val(),
   nickname=$(this).parent().parent().find('.nickname').val();
 //  alert(nickname); exit;
     $.ajax({
      url:BASE_URL+"department/update_department",
      type:'POST',
      data:{ value1 : id,value2:department,value3:status,value4:nickname},
      success:function(result){

      $("#list_all").html(result);
	   for_response('Successfully Update...!'); // resutl notification 
      }   
	   
	 });
	 $('.modal').css("display", "none");
    $('.fade').css("display", "none"); 
  
		 }
		 else
		 {
			for_response_del(''); // resutl notification 
		 }
		  
  			
			
		  });
		    $("#department").live("blur",function()
           {
        var name=$(this).val();	
		var id=$(this).offsetParent().find(".id").val();
		var message=$(".error_msg1");
		
		 $.ajax(
		 {
		  url:BASE_URL+"department/checking_Update",
		  type:'POST',
		  data:{ value1 : name ,value2 : id},
		  
		  success:function(result)
		  {
			  //alert(result);
		     message.html(result);
			
		  }    		
		});
   
    });
	
   $("#yes").live("click",function()
  {
   for_loading_del('Loading...  Please Wait '); // loading notification
   var hid=$(this).parent().parent().find('.hid').val();
   
    $.ajax({
      url:BASE_URL+"department/delete_department",
      type:'POST',
      data:{ value1 : hid},

      success:function(result){
      
      $("#list_all").html(result);
	  for_response_del('Loading Data...!'); // resutl notification  
      }    
    
    });
	 $('.modal').css("display", "none");
    $('.fade').css("display", "none"); 
	  
   }); 
    $("#no").live("click",function()
  {
      // dept
   
   var h_dept=$(this).parent().parent().parent().find('.desg').val();
   $(this).parent().parent().find('.department').val(h_dept);
   // nick
   
   var h_nick=$(this).parent().parent().parent().find('.nickname_hidden').val();
   $(this).parent().parent().find('.nickname').val(h_nick);
   // status
   
   var h_status=$(this).parent().parent().parent().find('.stat').val();
   $(this).parent().parent().find('.status').val(h_status);
   
	  $(".error_msg").html('');
	$(".error_msg1").html('');
	$(".nick_error").html('');
   $('.modal').css("display", "none");
    $('.fade').css("display", "none");
		 
	 
	 }); 
	  });
	 $("#yesin").live("click",function()
  {
 for_loading_del('Loading... Data Delete Please Wait '); // loading notification
   var hidin=$(this).parent().parent().find('.hidin').val();
    var message=document.getElementById("error").innerHTML;
     $.ajax({
      url:BASE_URL+"department/delete_department_inactive",
      type:'POST',
      data:{ value1 : hidin},
      success:function(result){
	  $i=0;
	  if(i==1)
	   {
		   for_response_del('Successfully Removed...!'); // resutl notification  
      }    
    else
	{
		 for_response_del('Loading Please wait...!'); // resutl notification 
	}
	 $("#list_all").html(result);
	  }
    });
  $('.modal').css("display", "none");
    $('.fade').css("display", "none"); 
   
   }); 
   $("#cancel").click(function()
   {
	   $("#errormessage").html('');
	   $("#errormessage1").html('');
    $('.mandatory6').val('');
	$('#man1').html('');
	
   });


</script>


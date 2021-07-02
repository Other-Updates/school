<script type="text/javascript">
$(document).ready(function() {
	 
     $("#example1 td:nth-child(5)").each(function ()
	  {
        if ($(this).html()== "High")
		 {
             $(this).css({'background-color':'#ff0000','color':'#FFf','font-weight':'bold'});
		 }
		 else if($(this).html()== "Normal")
		 {
			 $(this).css({'background-color':'#47c547','color':'#FFf','font-weight':'bold'});
		 }
		 else
		 {
			 $(this).css({'background-color':'#ffa500','color':'#FFf','font-weight':'bold'});
		 }
		 
		 
	  });
	  $("#example3 td:nth-child(5)").each(function ()
	  {
        if ($(this).html()== "High")
		 {
            $(this).css({'background-color':'#ff0000','color':'#FFf','font-weight':'bold'});
		 }
		 else if($(this).html()== "Normal")
		 {
			 $(this).css({'background-color':'#47c547','color':'#FFf','font-weight':'bold'});
		 }
		 else
		 {
			  $(this).css({'background-color':'#ffa500','color':'#FFf','font-weight':'bold'});
		 }
		 
		 
	  });
	
});
</script>
<?php 
echo "<pre>";
print_r($this->session->userdata('user_info'));
exit;
?>
<div class="box-body table-responsive">
<table width="100%" border="0" class="form_table">
    <tr>
        <td width="22%">Name</td>
        <td width="28%"><input type="text"  class="mandatory" id="name1" readonly="readonly" value="<?php echo $student_id['name']; ?>" />  </td>   
        <td width="17%">E-Mail</td>
        <td width="15%"><input type="text"  class="mandatory" id="email" readonly="readonly" value="<?php echo $student_id['email']; ?>"/>  </td>
        <td width="18%">&nbsp;</td>
    </tr>
     <tr>
        <td width="22%">Subject</td>
        <td><input type="text"  class="mandatory" id="subject"/>  </td>    
        <td width="17%">Priority</td>
        <td><select  id="priority">
        <option value="">Select</option>
        <option value="Normal">Normal</option> 
        <option value="High">High</option> 
         <option value="Low">Low</option> 
        </select></td>
        <td>&nbsp;</td>
    </tr>
     <tr>
    <td>Department</td>
    <td><select id="department">
    <option value="">Select</option>
    <?php 
    if(isset($desg) && !empty($desg))
{	
foreach($desg as $row) 
{
?>
<option value="<?php echo $row['id']; ?>"><?php echo $row['department']; ?></option>
<?php 
}}
?>
    </select></td>
    <td>Post to Admin</td>
    <td><select id="admin_id">
    <option value="">Select</option>
    <?php 
    if(isset($adm) && !empty($adm))
{	
foreach($adm as $row) 
{
?>
<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
<?php 
}}
?>
    </select></td>
    <td>&nbsp;</td>
    </tr>
    
    
         <tr>
        <td>Description Of Problem</td>
        <td colspan="3"><textarea name="text" id="description" style="width:100%"></textarea>  </td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td></td>
    	<td><input type="button" value="Submit" name="adding" id="submit" class="btn btn-primary"/>&nbsp;&nbsp;
        <input type="button" value="Cancel" id="cancel" class="btn btn-danger"/></td>
    </tr>
</table>
<br />
<div class="nav-tabs-custom" id="list_all">
           <ul class="nav nav-tabs">
               <li class="<?=($status==1)?'active':''?>"><a href="#tab_1" data-toggle="tab">Open</a></li>
               <li class="<?=($status!=1)?'active':''?>"><a href="#tab_2" data-toggle="tab">Close</a></li>
              
           </ul>
    <div class="tab-content">
         <div class="tab-pane active" id="tab_1">
                                      
			<table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>id&nbsp;&nbsp;&nbsp;</th>
                <th>Name</th>
                 <th>E-Mail</th>
                  <th>Subject</th>
                   <th>Priority</th>
                    <th>Department</th>
                    <th>Description</th>
                    <th>Admin</th>
                     <th>status</th>
                     
                      <th>Date</th>
                       
                       <th>Action</th>
            </tr>
            </thead>
            <tbody>
			<?php 
                if(isset($list) && !empty($list))
                {
                    foreach($list as $billto) 
                    {
                        if($billto['status']==1)
                        
                        {
            ?>   
                 <tr><td><?php echo $billto["id"]; ?></td>
                 <td><?php echo $billto["name1"]; ?></td>
                 <td><?php echo $billto["email"]; ?></td>
                 <td><?php echo $billto["subject"]; ?></td>
                 <td class="prio"><?php echo $billto["priority"]; ?></td>
                 <td><?php echo $billto["department"]; ?></td>
                 <td style="width:150px;"><?php echo $billto["description"]; ?></td>
                 <td><?php echo $billto["name"]; ?></td>
                 <td><?=($billto['status']==1)?'Open':'Close';?></td>
                <td><?php echo ($billto['ldt']==0)?'--':date("d-M-Y h:m",strtotime($billto["ldt"])); ?></td>
                 
                 </td>
                 <td>
                 <a href="#test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                 <a href="#test1_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                 <a href="#test2_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                </td>
                </tr>
           <?php   
            }}}
        ?>
        </tbody>
	    </table>
                                    </div><!-- /.tab-pane -->
                                     <div class="tab-pane <?=($status!=1)?'Open':''?>" id="tab_2"  >                            
	<table id="example3" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                 <th>E-Mail</th>
                  <th>Subject</th>
                   <th>Priority</th>
                    <th>Department</th>
                    <th>Description</th>
                    <th>Admin</th>
                <th>status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
			<?php 
                if(isset($list) && !empty($list))
                {
                    foreach($list as $billto) 
                    {
                        if($billto['status']==0)
                        
                        {
            ?>   
                 <tr><td><?php echo $billto["id"]; ?></td>
                 <td><?php echo $billto["name1"]; ?></td>
                 <td><?php echo $billto["email"]; ?></td>
                 <td><?php echo $billto["subject"]; ?></td>
                 <td><?php echo $billto["priority"]; ?></td>
                 <td><?php echo $billto["department"]; ?></td>
                 <td style="width:150px;"><?php echo $billto["description"]; ?></td>
                 <td><?php echo $billto["name"]; ?></td>
                 <td><?=($billto['status']==1)?'Open':'Close';?></td>
                <td><?php echo ($billto['ldt']==0)?'--':date("d-M-Y h:m",strtotime($billto["ldt"])); ?></td>
                 
                 </td>
                 <td>
                 <a href="#test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                 <a href="#test1_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                 <a href="#test3_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                </td>
                </tr>
           <?php   
            }}}
        ?>
        </tbody>
	    </table>
</div>
                                    </div><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->
                            </div>

<?php 
if(isset($list) && !empty($list))
{
foreach($list as $billto) 
{
 ?>   

<div id="test_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel"></h3>
    </div>
  <div class="modal-body">
  <table width="100%">
        <tr>
                <tr><th>id</th><td><?php echo $billto["id"]; ?></td></tr>
                <tr><th>Name</th><td><?php echo $billto["name1"]; ?></td>  </tr>
                 <tr><th>E-Mail</th><td><?php echo $billto["email"]; ?></td>  </tr>
                 <tr><th>Subject</th> <td><?php echo $billto["subject"]; ?></td>  </tr>
                  <tr><th>Priority</th><td><?php echo $billto["priority"]; ?></td>  </tr>
                    <tr><th>Department</th> <td><?php echo $billto["department"]; ?></td>  </tr>
                   <tr> <th>Description</th> <td><?php echo $billto["description"]; ?></td>  </tr>
                    <tr> <th>Admin</th> <td><?php echo $billto["name"]; ?></td>  </tr>
                <tr><th>status</th> <td><?=($billto['status']==1)?'Open':'Close';?></td>  </tr>
               <tr> <th>Date</th><td><?php echo ($billto['ldt']==0)?'--':date("d-M-Y h:m",strtotime($billto["ldt"])); ?></td>
              
               </tr>             
  </table>
  </div>
  <div class="modal-footer">
     <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>    
  </div>
  </div>
  </div>
</div>
<?php }} ?>



<!--/*UPDATA*/-->

<?php 
if(isset($list) && !empty($list))
{
foreach($list as $billto) 
{
 ?>   

<div id="test1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" 
  role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  	<div class="modal-dialog"><div class="modal-content">    <div class="modal-header"><a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel"></h3></div>
  	<div class="modal-body">
     	 <table width="100%">
         <tr>
         <td><strong>Id:</strong></td>
         <td><input type="text" name="id" class="id form-control" id="id" value="<?php echo $billto["id"]; ?>" readonly="readonly" /></td>
         </tr>         
         <tr>
         <td><strong>Name</strong></td>
         <td><input type="text" class="name1" id="name1" name="name1" value="<?php echo $billto["name1"]; ?>" /></td>
         </tr>
          <tr>
        <td width="25%"><strong>E-Mail</strong></td>
        <td><input type="text"  class="email" id="email" name="email" value="<?php echo $billto["email"]; ?>"/>  </td>
    </tr>
     <tr>
        <td width="25%">Subject</td>
        <td><input type="text"  class="subject" id="subject" name="subject" value="<?php echo $billto["subject"]; ?>"/>  </td>
    </tr>
    <tr>
        <td width="25%">Priority</td>
        <td><select  id="priority" name="priority" class="priority"  value="<?php echo $billto["priority"]; ?>">
        <option <?=($billto['priority'])?'selected':'';?> value="<?php echo $billto["priority"]; ?>"><?php echo $billto["priority"]; ?></option>
        <option value="Normal">Normal</option> 
        <option value="High">High</option> 
        <option value="Low">Low</option> 
        </select></td>
    </tr>
     <tr>
    <td>Department</td>
    <td><select id="department" class="department">
    <option value="">Select</option>
    <?php 
    if(isset($desg) && !empty($desg))
		{	
		foreach($desg as $row) 
		{
		?>
		<option <?=($row['department']==$billto['department'])?'selected':'';?> value="<?php echo $row['id']; ?>"><?php echo $row['department']; ?></option>
		<?php 
		}}
?>
    </select></td></tr>
    <tr>
    <td>Post to Admin</td>
    <td><select id="admin_id" class="admin_id">
    <option value="">Select</option>
    <?php 
    if(isset($adm) && !empty($adm))
{	
foreach($adm as $row) 
{
?>
<option <?=($row['name']==$billto['name'])?'selected':'';?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
<?php 
}}
?>
    </select></td></tr>
    
         <tr>
        <td width="25%">Description Of Problem</td></tr>
        <tr><td>&nbsp;</td>
        <td><textarea name="description" rows="5" cols="5" id="description" class="description"><?php echo $billto["description"]; ?></textarea>  
        </td>
    </tr>
         <tr>
         <td><strong>status:</strong></td>
         <td>
         <select name="status" id="status" class="status">
         <option value="1">Open</option>
         <option value="0">Close</option>
         </select></td>
         </tr>
         </table>
  	</div>
  		<div class="modal-footer">             
             <button type="button" class="btn btn-primary"  id="update"><i class="fa fa-edit"></i> Update</button>
    		 <button type="button" class="btn btn-danger"  id="no" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
    
  		</div>
</div>
</div>        
</div>
<?php }} ?>

<!--Delete-->

<?php 
if(isset($list) && !empty($list))
{
foreach($list as $billto) 
{
 ?>   
<div id="test2_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel"></h3>
    </div>
  <div class="modal-body">
     Do You Want Delete? &nbsp; <strong><?php echo $billto["name1"]; ?></strong>
     <input type="hidden" value="<?php echo $billto['id']; ?>" class="hid" />
  </div>
  <div class="modal-footer">   
    <button class="btn btn-primary delete_yes" id="yes">Delete</button>
    <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i> Discard</button>
  </div>
</div>
</div>  
</div>
<?php }} ?>


<!--delete all-->

<?php 
if(isset($list) && !empty($list))
{
foreach($list as $billto) 
{
 ?>   
<div id="test3_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel"></h3>
    </div>
  <div class="modal-body">
   Do You Want Delete Paremenently? &nbsp; <strong><?php echo $billto["name1"]; ?></strong>
     <input type="hidden" value="<?php echo $billto['id']; ?>" class="hidin" />
  </div>
  <div class="modal-footer">
   
    
    <button class="btn btn-primary delete_yes" id="yesin">Delete</button>
    <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i> Discard</button>
  </div>
</div>
</div>  
</div>
<?php }} ?>
<script type="text/javascript">
 $(document).ready(function()
 {
  $("#submit").click(function()
  {
	  for_loading('Loading...Data Adding...'); // loading notification
         name1=$("#name1").val();	 
		 email=$("#email").val();
		 subject=$("#subject").val();
		 priority=$("#priority").val();
		 department=$("#department").val();
		 description=$("#description").val();
		 admin_id=$("#admin_id").val();	 
		$.ajax(
		 {
		  url:BASE_URL+"staff_tickets/insert_staff_tickets",
		  type:'POST',
		  data:{ value1 : name1,value2 : email,value3 : subject,value4 : priority,value5 : department,value6 : description,value7 : admin_id},
		  success:function(result)
		  {
		     $("#list_all").html(result);
			 for_response('Add Successfully...!'); // resutl notification 
		  }    		
		});
		$("#subject").val('')
		$("#priority").val('')
		$("#department").val('')
		$("#description").val('')
		$("#admin_id").val('')
   });
   
   
 <!-- Update--> 
   
   
   $("#update").live("click",function()
  {	  
   for_loading('Loading...Data Updating...'); // loading notification
   var id=$(this).parent().parent().find('.id').val(),
   name1=$(this).parent().parent().find('.name1').val(),
   email=$(this).parent().parent().find('.email').val(),
   subject=$(this).parent().parent().find('.subject').val(),
   priority=$(this).parent().parent().find('.priority').val(),
   department=$(this).parent().parent().find('.department').val(),
   description=$(this).parent().parent().find('.description').val(),
   admin_id=$(this).parent().parent().find('.admin_id').val(),
   status=$(this).parent().parent().find('.status').val();
   
   

$.ajax({
      url:BASE_URL+"staff_tickets/update_staff_tickets",
      type:'POST',
      data:{ value1:id,value2:name1,value3:email,value4:subject,value5:priority,value6:department,value7:description,
	  value8:status,value9:admin_id},
      success:function(result){
      $("#list_all").html(result); 
	   for_response('Update Successfully...!'); // resutl notification 
      }   
   }); 
   
   $('.modal').css("display", "none");
    $('.fade').css("display", "none"); 
    });
	
   $("#yes").live("click",function()
  {
  for_loading('Loading...Data Deleting...'); // loading notification
   var hid=$(this).parent().parent().find('.hid').val();
   
    $.ajax({
      url:BASE_URL+"staff_tickets/delete_staff_tickets",
      type:'POST',
      data:{ value1 : hid},

      success:function(result){
      
      $("#list_all").html(result);
	   for_response('Delete Successfully...!'); // resutl notification  
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
	  });
	 $("#yesin").live("click",function()
  {
	   for_loading('Loading...Data Removing...'); // loading notification
   var hidin=$(this).parent().parent().find('.hidin').val();
  

     $.ajax({
      url:BASE_URL+"staff_tickets/delete_staff_tickets_inactive",
      type:'POST',
      data:{ value1 : hidin},
   
      success:function(result){
      
      $("#list_all").html(result); 
	   for_response('Remove Successfully...!'); // resutl notification  
      }    
    
    });
  $('.modal').css("display", "none");
    $('.fade').css("display", "none"); 
   
   }); 
   $("#cancel").click(function()
   {
    $('.mandatory').val('');
   });
</script>



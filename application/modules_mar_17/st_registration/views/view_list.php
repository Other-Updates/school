<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
      <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
    $("#example4").dataTable();
    $("#example5").dataTable();
    $("#example3").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
<div class="nav-tabs-custom" id="list_all">
 <div class="tab-pane" id="tab_2"> 

   <table id="example3" class="table table-bordered table-striped">
      <thead>
    	<tr>
            <th>S.no</th>
            <th>Application Number</th>
            <th>Student Name</th>
            <th>Address</th>
            <th>Email ID</th>
            <th>Phone Number</th>
            <th>Year</th>
            <th>Action</th>
        </tr>
        </thead>

<?php $i=0;
			if(isset($details) && !empty($details))
			{
				foreach ($details as $view)
				{
					?>
     
					<tr>
                        <td><?php echo  $i+1; ?></td>
                        <td><?php echo $view['admission_form_no'];?></td>
                         <td><?php echo $view['student_name'];?></td>
                          <td><?php echo $view['address'];?></td>
                           <td><?php echo $view['email'];?></td>
                           <td><?php echo $view['phone_no'];?></td>
                           <td><?php echo $view['year'];?></td>
                                                 
                        <td>
                        <a href="#view_batch<?php  echo $view['id']; ?>" title="View" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="#test1_<?php  echo $view['id']; ?>" title="Edit" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="#delete_batch<?php  echo $view['id']; ?>" title="Delete" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
					<?php $i++;} } ?> 

	</table>
 	</div>
    
    
 <!--View form-->
 <?php $i=0;
   			if(isset($details) && !empty($details))
			{
				foreach ($details as $view)
				{?>
	
         <div id="view_batch<?=$view['id']?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style= align="center">
         <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                   <h3 id="myModalLabel">View Student</h3>
                  </div>
                  <div class="modal-body">
                      <table class="staff_table_sub">
                             <tbody>
                                 
                                    <tr>
                                     <td>Application Number</td>
                                     <td class="text_bold1"><?=$view['admission_form_no']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Student Name</td>
                                     <td class="text_bold1"><?=$view['student_name']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Email ID</td>
                                     <td class="text_bold1"><?=$view['email']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Phone Number</td>
                                     <td class="text_bold1"><?=$view['phone_no']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Year</td>
                                     <td class="text_bold1"><?=$view['year']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Address</td>
                                     <td class="text_bold1"><?=$view['address']?> </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Discard</button>
                  </div>
                  </div>
                  </div>
                </div>
<?php $i++;}} ?> 



<!--end--!>

 
        
        <?php
   			if(isset($details) && !empty($details))
			{
				foreach ($details as $view)
				{?>
	
        <!--<form action="<?php //echo $this->config->item('base_url'); ?>admin/update_admin" method="post">-->
<div id="test1_<?php echo $view['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
<div class="modal-dialog">
<div class="modal-content" >
  <div class="modal-header">
   <a class="close" data-dismiss="modal">×</a>
   <h3 id="myModalLabel">Update Registration</h3>
  </div>
  <div class="modal-body" style="margin-left: 100px;">
<table width="100%" border="0">
  <tr>
    <td width="25%">Application Number</td>
    <td width="47%"><input type="text" name="admiss" class="admiss" value="<?php echo $view['admission_form_no']; ?>" /></td>
  </tr>
  <tr>
    <td width="25%">Student Name</td>
    <td width="47%"><input type="text" name="student" class="student" value="<?php echo $view['student_name']; ?>" /></td>
  </tr>
  <tr>
    <td width="25%">Address</td>
    <td width="47%"><input type="text" name="address_edi" class="address_edi" value="<?php echo $view['address']; ?>" /></td>
  </tr>
  <tr>
    <td width="25%">Email ID</td>
    <td width="47%"><input type="text" name="phone_no_num" class="phone_no_num" value="<?php echo $view['phone_no']; ?>" /></td>
  </tr>
   <tr>
    <td width="25%">Phone Number</td>
    <td width="47%"><input type="text" name="email_edi" class="email_edi" value="<?php echo $view['email']; ?>" /></td>
  </tr>
  <tr>
    <td>Year:</td>
    <td>
    <select name="year_edi" required autofocus id="year_edi" class="from form-control mandatory1 mandatory u_frm"  >
    <option value="" >Year</option>
    <?php for ($i = 2015; $i < date('Y')+100; $i++) : ?>
    <option <?=($view['year']==$i)?'selected':'';?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php endfor; ?>
    </select>     
    </td>
  </tr>
  
  
</table>
  </div>
  <div class="modal-footer">   
    <!--<input type="button" class="btn btn-primary update_btn delete update_batch"  name="update" value="Update" />-->
    <button class="btn btn-primary update_btn delete update_batch"  name="update" id="update_year"><i class="fa fa-edit"></i> Update</button>
    <button type="button" class="no btn btn-danger" data-dismiss="modal" id="no"><i class="fa fa-times"></i> Discard</button>
  </div>
  </div>
  </div>
</div>

<?php }}?> 




<?php 
if(isset($details) && !empty($details))
{
foreach($details as $view) 
{
 ?>   
<div id="delete_batch<?php echo $view['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
            <h3 id="myModalLabel">Delete Student Details</h3>
    <h3 id="myModalLabel"></h3>
    </div>
  <div class="modal-body">
  Do you want to Delete Permanently? &nbsp; <strong></strong>
     <input type="hidden" value="<?php echo $view['id']; ?>" class="hidin" />
  </div>
  <div class="modal-footer">
   
    
    <button class="btn btn-primary delete_yes" id="yesin">Yes</button>
    <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i> No</button>
  </div>
</div>
</div>  
</div>
<?php }} ?>





<script type="text/javascript">
$(document).ready(function(){
	$("#submit").live('click',function()
	 {
		var i=0;
		var admission_form_no=$("#admission_form_no").val(),
		address=$("#address").val(),
		student_name=$("#student_name").val(),
		phone=$("#phone").val(),
		address=$("#address").val(),
		email=$("#email").val(),
		year=$("#year").val();
		// for_loading('Loading... Data Adding...');
		$.ajax({
			url:BASE_URL+"st_registration/insert_admission",
			type:'POST',
			data:{ value1 : admission_form_no,value2 : student_name,value3 : address,value4 : year,value5 : phone,value6 : email},
			success:function(result)
				{
					//alert(result);
					$("#list_all").html(result);
					//for_response('Add Successfully...!'); //
					//$(".after_email").html('');
				}

		});
	});
});
</script>



















<script type="text/javascript">
$(document).ready(function(){
	$("#submit").live('click',function()
	 {
		var i=0;
		var admission_form_no=$("#admission_form_no").val(),
		address=$("#address").val(),
		student_name=$("#student_name").val(),
		phone=$("#phone").val(),
		address=$("#address").val(),
		email=$("#email").val(),
		year=$("#year").val();
		// for_loading('Loading... Data Adding...');
		$.ajax({
			url:BASE_URL+"st_registration/insert_admission",
			type:'POST',
			data:{ value1 : admission_form_no,value2 : student_name,value3 : address,value4 : year,value5 : phone,value6 : email},
			success:function(result)
				{
					//alert(result);
					$("#list_all").html(result);
					//for_response('Add Successfully...!'); //
					//$(".after_email").html('');
				}

		});
	});
});

// inactive query	   
	  $("#yesin").live("click",function()
	  {
	   for_loading_del('Loading... Please wait'); // loading notification
	    var hidin=$(this).parent().parent().find('.hidin').val();
	
	  $.ajax(
		 {
			  url:BASE_URL+"st_registration/delete_list",
			  type:'POST',
			  data:{ value1 : hidin},
			  success:function(result){
				  //alert(result);
			  $("#view_all").html(result);
			  for_response_del('Move To Alumni Successfully...!'); // resutl notification
		 }    
	  });
	  $('.modal').css("display", "none");
    $('.fade').css("display", "none");
	
	}); 
	
	
	<!--remove-->
	 $("#yesin").live("click",function()
  {
	for_loading_del('Loading... Removeing...'); // loading notification  
   var hidin=$(this).parent().parent().find('.hidin').val();
  	
//alert(hidin);
     $.ajax({
      url:BASE_URL+"st_registration/delete_batch",
      type:'POST',
      data:{ value1 : hidin},
   
      success:function(result){
      alert(result);
      //$("#view_all").html(result);
	   for_response_del(' Deleted Successfully...!'); // resutl notification 
      }    
    
    });
  $('.modal').css("display", "none");
    $('.fade').css("display", "none"); 
   
   }); 


</script>
 
 </div>
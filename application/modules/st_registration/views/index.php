<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>  
<h3>Student Admission</h3> 
<div align="right">
 <a href="<?php $this->config->item("base_url"); ?>st_registration/report" title="Report" data-toggle="modal" name="group" class="btn btn-primary">Report</a>
</div>
<div class="row">
	<div class="col-lg-6">
		<table class="staff_table">
            <tr>
                <td width="150">Application NO</td>
                <td><input type="text" tabindex="1" name="admission_form_no"  id="admission_form_no" class="admission_form_no mandatory mandatory1"/>
                <span style="color:red;" id="v1" class="v1"></span> </td>
            </tr>
            <tr>
            <td>Student Name</td>
                <td><input type="text" tabindex="2" name="student_name"  class="student_name mandatory1 mandatory" id="student_name"/> 
                <span style="color:red;" id="v2" class="v2"></span> </td>
            </tr>
            <tr>
                <td style="vertical-align:top">Address</td>
                <td><textarea id="address" name="address" tabindex="3" class="address mandatory1 mandatory" style="height: 60px;"></textarea> 
                <span style="color:red;" id="v3" class="v3"></span>  </td>
            </tr>
	 </table>
	</div>
	<div class="col-lg-6">
        <table class="staff_table">
        <tr>
            <td width="150">Email ID</td>
            <td><input type="text" tabindex="4" name="email" class="email mandatory1 mandatory" id="email" /> 
            <span style="color:red;" id="v4" class="v4"></span> 
            </td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td><input type="text" tabindex="5" name="phone" class="int_val mandatory1 mandatory phone" id="phone" maxlength="12" />
            <span style="color:red;" id="v5" class="v5"></span> 
             </td>
        </tr>
        <tr>
            <td>Year</td>
            <?php $i = date("Y"); ?>
            <td><select name="year" id="year" class="mandatory year" tabindex="6" required  title="Select Year">
            <option value="" selected="selected">Year</option>
            <?php for ($i; $i < date('Y')+100; $i++) : ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
            </select>
            <span style="color:red;" id="v6" class="v6"></span> </td>
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

<div class="tab-pane" id="list_all"> 

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
	
         <div id="view_batch<?=$view['id']?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
         aria-hidden="false" style= align="center">
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


<!--View form end-->


 <!--Update form Start-->
        
 <?php
   if(isset($details) && !empty($details))
	{
	foreach ($details as $view)
	 {?>
	
       
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
    <input type="hidden" value="<?php echo $view['id']; ?>" name="id_name" id="id_name" class="id_name" />
    <td width="47%"><input type="text" name="admiss" class="admiss" id="admiss" value="<?php echo $view['admission_form_no']; ?>" /></td>
  </tr>
  <tr>
    <td width="25%">Student Name</td>
    <td width="47%"><input type="text" name="student" class="student" id="student" value="<?php echo $view['student_name']; ?>" /></td>
  </tr>
  <tr>
    <td width="25%">Address</td>
    <td width="47%"><input type="text" name="address_edi" class="address_edi" id="address_edi" value="<?php echo $view['address']; ?>" /></td>
  </tr>
  <tr>
    <td width="25%">Email ID</td>
    <td width="47%"><input type="text" name="phone_no_num" class="phone_no_num" id="phone_no_num" value="<?php echo $view['email']; ?>" /></td>
  </tr>
   <tr>
    <td width="25%">Phone Number</td>
    <td width="47%"><input type="text" name="email_edi" class="email_edi" id="email_edi" value="<?php echo $view['phone_no']; ?>" /></td>
  </tr>
  <tr>
    <td>Year:</td>
    <td>
    <select name="year_edi" required autofocus id="year_edi"  class="from form-control mandatory1 mandatory year_edi"  >
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
        <button class="btn btn-primary update_btn delete update_batch"  name="update" id="update_year"><i class="fa fa-edit">
        </i> Update</button>
        <button type="button" class="no btn btn-danger" data-dismiss="modal" id="no"><i class="fa fa-times"></i> Discard</button>
      </div>
  </div>
  </div>
</div>

<?php }}?> 
 <!--Update form End-->
 <!--Delete form Start-->
<?php 
if(isset($details) && !empty($details))
{
foreach($details as $view) 
{
 ?>   
<div id="delete_batch<?php echo $view['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
aria-hidden="false" align="center">
	<div class="modal-dialog">
 		 <div class="modal-content">
    			<div class="modal-header">
   					 <a class="close" data-dismiss="modal">×</a>
           				 <h3 id="myModalLabel">Delete Student Details</h3>
			    </div>
  				<div class="modal-body">
  					Do you want to Delete Permanently? &nbsp; <strong></strong>
    			    <input type="hidden" value="<?php echo $view['id']; ?>" class="hidin" />
  				</div>
  				<div class="modal-footer">
    				<button class="btn btn-primary delete_yes" id="yesin">Yes</button>
    				<button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no">
                    <i class="fa fa-times"></i> No</button>
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
		//alert(student_name);
		if(admission_form_no=='')
	{
		$(".v1").html("Required Field");
		i=1;
	}
	else
	{
		$(".v1").html("");
	}
	var student_name=$(".student_name").val();
	if(student_name=='')
	{
		$(".v2").html("Required Field");
		i=1;
	}
	else
	{
		$(".v2").html("");
	}
	var address=$(".address").val();
	if(address=='')
	{
		$(".v3").html("Required Field");
		i=1;
	}
	else
	{
		$(".v3").html("");
	}
	var email=$(".email").val();
	if(email=='')
	{
		$(".v4").html("Required Field");
		i=1;
	}
	else
	{
		$(".v4").html("");
	}
	var phone=$(".phone").val();
	if(phone=='')
	{
		$(".v5").html("Required Field");
		i=1;
	}
	else
	{
		$(".v5").html("");
	}
	var year=$(".year").val();
	if(year=='')
	{
		$(".v6").html("Required Field");
		i=1;
	}
	else
	{
		$(".v6").html("");
	}
	if(i==1)
	{
		return false;
	}
	else
	{
		 for_loading('Loading... Data Adding...');
		$.ajax({
			url:BASE_URL+"st_registration/insert_admission",
			type:'POST',
			data:{ value1 : admission_form_no,value2 : student_name,value3 : address,value4 : year,value5 : phone,value6 : email},
			success:function(result)
				{
					//alert(result);
					$("#list_all").html(result);
					for_response('Add Successfully...!'); //
					//$(".after_email").html('');
				}
		});
	}
		$("#admission_form_no").val(''),
		$("#address").val(''),
		$("#student_name").val(''),
		$("#phone").val(''),
		$("#address").val(''),
		$("#email").val(''),
		$("#year").val('');
	});
});
$("#update_year").live('click',function()
	 {
		var i=0;
		var admiss=$(this).parent().parent().parent().find('.admiss').val(),
		 id_name=$(this).parent().parent().parent().find('.id_name').val(),
		 student=$(this).parent().parent().parent().find('.student').val(),
		 address_edi=$(this).parent().parent().parent().find('.address_edi').val(),
		 phone_no_num=$(this).parent().parent().parent().find('.phone_no_num').val(),
		 email_edi=$(this).parent().parent().parent().find('.email_edi').val(),
    	 year_edi=$(this).parent().parent().parent().find('.year_edi').val();
		 
		//alert(year_edi);return false;
		for_loading('Loading... Data Adding...');
		$.ajax({
			url:BASE_URL+"st_registration/update_st_registration",
			type:'POST',
			data:{ 
			value1 : admiss,
			value2 : student,
			value3 : address_edi,
			value4 : phone_no_num,
			value5 : email_edi,
			value6 : year_edi,
			value7 : id_name
			
			},
			success:function(result)
				{
					//alert(result);
					$("#list_all").html(result);
					//for_response('Add Successfully...!'); //
				}
		});
		 $('.modal').css("display", "none");
    	$('.fade').css("display", "none");
	
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
			  $("#list_all").html(result);
			  for_response_del('Successfully...!'); // resutl notification
			 }    
	 	 });
	    $('.modal').css("display", "none");
    	$('.fade').css("display", "none");
	}); 
</script>
<script>
$(".admission_form_no").live('blur',function(){
	
	var admission_form_no=$(".admission_form_no").val();
	if(admission_form_no=='')
	{
		$(".v1").html("Required Field");
	}
	else
	{
		$(".v1").html("");
	}
});
$(".student_name").live('blur',function(){
	
	var student_name=$(".student_name").val();
	if(student_name=='')
	{
		$(".v2").html("Required Field");
	}
	else
	{
		$(".v2").html("");
	}
	
});
$(".address").live('blur',function(){
	
	var address=$(".address").val();
	if(address=='')
	{
		$(".v3").html("Required Field");
	}
	else
	{
		$(".v3").html("");
	}
});
$(".email").live('blur',function(){
	
	var email=$(".email").val();
	if(email=='')
	{
		$(".v4").html("Required Field");
	}
	else
	{
		$(".v4").html("");
	}
});
$(".phone").live('blur',function(){
	
	var phone=$(".phone").val();
	if(phone=='')
	{
		$(".v5").html("Required Field");
	}
	else
	{
		$(".v5").html("");
	}
});
$(".year").live('blur',function(){
	
	var year=$(".year").val();
	if(year=='')
	{
		$(".v6").html("Required Field");
	}
	else
	{
		$(".v6").html("");
	}
});
</script>
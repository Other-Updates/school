<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?> 
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/thumb.jpg"></div>
    Assignment		
</div>
<div class="message-form-inner view_table">
    
<form method="post"  enctype="multipart/form-data" name="sform" action="<?php echo $this->config->item('base_url'); ?>users/insert_student_assignment" >
<input type="hidden" name="ass_id" value="<?php echo $assignment[0]['id']; ?>">
<div class="row">
<div class="six columns">
<table width="100%">
	<tr>
    	<td width="40%">Semester</td>
        <td class="text_bold"><?php echo $assignment[0]['semester']; ?></td>
    </tr>
    <tr>
    	<td>Posted Staff</td>
        <td class="text_bold"><?php echo $assignment[0]['staff'][0]['name']; ?></td>
    </tr>
    <tr>
    	<td>Assignment Title</td>
        <td class="text_bold"><?php echo $assignment[0]['question']; ?></td>  
    </tr>
</table>
</div>
<div class="six columns">
<table width="100%">
	<tr>
        <td width="40%">Subject</td>
        <td  class="text_bold"><?php echo $assignment[0]['subject_name']; ?></td>
    </tr>
    <tr>
      	<td>Posted On</td>
        <td class="text_bold" style="color:green"><?php echo date('d-m-Y',strtotime($assignment[0]['ldt'])); ?></td>
    </tr>
    <tr>
        <td>Due Date</td>
        <td  class="text_bold" style="color:red;"><?php echo date('d-m-Y',strtotime($assignment[0]['due_date'])); ?></td>    
    </tr>
    <tr>     
    
</table>
</div>
<table width="100%">
    <tr>
    <td width="20%">Comments</td>
    <td class="text_bold"><?php echo $assignment[0]['comments']; ?></td>
        </tr>
      
    
</table>
</div>


<?php 
if($assignment[0]['ass_type']==0)
{
?>
<table id='app_table' width="100%">
<tr>
	<td width="5%">Your Score</td><td class="text_bold" width="20%"><?php echo $checking[0]['score']."/".$assignment[0]['total']; ?></td>
    </tr>
</table>
<?php 
}
else 
{
		if(!empty($checking))
		{
			?>
	<table id='app_table' width="100%">
	<td width="20%">Your Score</td><td class="text_bold" width="30%"><?php echo $checking[0]['score']."/".$assignment[0]['total']; ?></td>
    <td width="20%">Submitted File</td><td class="text_bold"><a target="_blank" href="<?=$this->config->item('base_url').'assignment_files/'.$checking[0]['file_name']; ?>"><?php echo $checking[0]['file_name']; ?></a></td>
</table>
<?php
		}
		else
		{
 ?>
<table id='app_table'>
	<td>Upload Data</td><td><input type="file" name="ass_file" id="ass_file" class="mandatory"><span style="color:red;" id="file_error" class="errormessage"></span></td>
    <td></td><td><input type="submit" value="Submit" name="btnSub" class="btn btn-primary"></td>
</table>
<?php 

		}
}
		?>
</form>
</div>
</div>
</div>
<script type="text/javascript">
$('.mandatory').live('blur',function() 
	{
		if($(this).val()=='' || $(this).val()==null || $(this).val().trim().length==0 || $(this).val()=='.' || $(this).val()==',')
		{		
			$("#ass_file").css('border','1px solid red');	
			
			
		} 
		else
			$('#ass_file').css('border','1px solid #CCCCCC');		
	});
 $("#ass_file").live('change',function() {
				
				var val = $(this).val();
				//alert(val);
				switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
					 case 'doc': case 'docx': case 'pdf': case '':
						$(this).val();
						$("#file_error").html("");
						break;
					default:
						$(this).val();
					   
					   $("#file_error").html("Upload Pdf/Doc/Docx");
						break;
				}
			});
			
			$(document).ready(function()
 		{
		 $("form[name=sform]").submit(function()
  	 	{
			var i=0;
	  		var val = $('#ass_file').val();
	 		var message=$("#file_error").html();
	  		if(message.trim().length>0 || val=="" || val==null)
			  {
				 i=1;
				 $("#ass_file").css('border','1px solid red');   
			  }
			  else
			  {
				  $('#ass_file').css('border','1px solid #CCCCCC');
			  }
			  if(i==0)
			  {
				  alert("Your file is uploaded Successfully");
				  return true;
			  }
			  else
			  {
				  return false;
			  }
	  
 	 });
	});
</script>







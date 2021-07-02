<h3>Staff Syllabus</h3>
<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); 
?>
<table class="form_table">
  <tr>
    <td>Batch</td>
    <td>&nbsp;</td>
    <td>
   <select id='select_batch' class='ajax_class'>
        <option value="0">Select</option>
        <?php 
            if(isset($all_batch) && !empty($all_batch)){
                
                foreach($all_batch as $val1)
                {
                    ?>
                        <option value="<?=$val1['id']?>"><?php echo $val1['from'].'-'.$val1['to']?></option>
                    <?php 
                }
            }
        ?>
    </select>
    </td>
    <td>&nbsp;</td>
    <td>Section</td>
    <td>&nbsp;</td>
    <td id='g_td'>
        <select id='group_id' name='student_group[group_id]' disabled="disabled" >
            	<option value="0">Select</option>
        </select>
    </td>
    
  </tr>
  
  <tr>
  	<td>Semester</td>
    <td>&nbsp;</td>
    <td id='td_sem'>
    <select id='select_sem'  class='ajax_class' disabled="disabled">
            	<option value="0">Select</option>
				<?php 
                    if(isset($all_semester) && !empty($all_semester)){
						
                        foreach($all_semester as $val1)
                        {
                            ?>
                                <option value="<?=$val1['id']?>"><?php echo $val1['semester']?></option>
                            <?php 
                        }
                    }
                ?>
    </select>
    </td> 
    <td>&nbsp;</td>
    <td>Subject</td>
    <td>&nbsp;</td>
    <td id='sub_td'>
        <select id='subject_id' disabled="disabled">
            	<option value="0">Select</option>
        </select>
    </td>
    
    
  </tr>
   <tr>
  	<td>Department</td>
    <td>&nbsp;</td>
    <td id='td_depart'>
       <select id='depart_id' name='student_group[depart_id]' disabled="disabled">
            	<option value="0">Select</option>
				<?php 
                    if(isset($all_depart) && !empty($all_depart)){
                        foreach($all_depart as $val)
                        {
                            ?>
                                <option value="<?=$val['id']?>"><?=$val['department']?></option>
                            <?php 
                        }
                    }
                ?>
    </select>
    </td>
    <td>&nbsp;</td>
    
  	<td>Subject Code</td>
    <td>&nbsp;</td>
    <td id='sub_code'>
      <input type="text" id="sub_code_id" class="sub_code_id" value="" readonly="readonly" />
    </td>
    <td>&nbsp;</td>
  
  </tr>
 
   
  
 
</table>
<br />
<table style="display:none;">
<tr id="last_row" >
	<td class="dy_no"></td>
  
            <td><!--<select id="text" name='unit_group[]' class="unit_group" id="unit_group">
            <option value="1">Unit-I</option>
            <option value="2">Unit-II</option>
            <option value="3">Unit-III</option>
            <option value="4">Unit-IV</option>
            <option value="5">Unit-V</option>--><input type="text" name='unit_group[]' class="unit_group" id="unit_group" id="col0" tabindex="29" /></td>
            <td><input type="text" name='topic_group[]' class="topic_group" id="topic_group" id="col1" tabindex="30" /></td>
            <td><input type="text" name='hour_group[]' id="hour_group" cl class="float_val hour_group" id="col2" tabindex="31" /></td>
    
     <td><input type="button" value="-" class='remove_comments btn bg-purple btn-sm'/></td>
</tr>
</table>
<table id='app_table'>
	<thead>
    	<tr>
        	<td></td>
            <th>Unit</th>
            <th>Topic</th>
            <th>Hours</th>
            
            <th><input type="button" value="+" class='add_row btn bg-purple btn-sm'/></th>
        </tr>
    </thead>
    <tbody>
    	<tr>
        	<td></td>
            <td><!--<select id="text" name='unit_group[]' class="unit_group" id="unit_group">
            <option value="1">Unit-I</option>
            <option value="2">Unit-II</option>
            <option value="3">Unit-III</option>
            <option value="4">Unit-IV</option>
            <option value="5">Unit-V</option>--><input type="text" name='unit_group[]' class="unit_group" id="unit_group" id="col0" tabindex="29" /></td>
            <td><input type="text" name='topic_group[]' class="topic_group" id="topic_group" id="col1" tabindex="30" /></td>
            <td><input type="text" name='hour_group[]' id="hour_group" cl class="float_val hour_group" id="col2" tabindex="31" /></td>
        </tr>
    </tbody>
</table>
<br />
<center><input type="button" value="submit" id="submit" class="submit btn btn-primary" /></center>


<!--..........................................................TABLE VIEW.................................................................................-->
<div class='std_class' id="g_div">
<table id="example1"   class="table table-bordered table-striped dataTable">
	<thead>
    	<tr>
        	<th>S.No</th>
            <th>Batch</th>
            <th>Semester</th>
            <th>Department</th>
            <th>Section</th>
            <th>Subject</th>
            <th>Subject Code</th>
            <th>Unit</th>
            <th>Topic</th>
            <th>Hours</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
	<?php 
			
        if(isset($all_syllabus) && !empty($all_syllabus)){
			$i=0;
            foreach($all_syllabus as $val)
               {
               $i++; ?>
             <tr>
             <td><?=$i?></td>
                                <td><?=$val['from']?>-<?=$val['to']?></td>
                                <td><?=$val['semester']?></td>
                                <td><?=$val['department']?></td>
                                <td><?=$val['group']?></td>
                                <td><?=$val['nick_name']?></td>
                                <td><?=$val['scode']?></td>
                                <td><?=$val['unit_group']?></td>
                                <td><?=$val['topic_group']?></td>
                                <td><?=$val['hour_group']?></td>
<td> <a href="<?=$this->config->item('base_url').'staff_syllabus/staff_syllabus_view/'.$val['subject_id']?>" title="View" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
<a href="<?=$this->config->item('base_url').'staff_syllabus/staff_syllabus_update/'.$val['subject_id']?>" title="Edit" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
 <a href="#test2_<?php echo $val['id']; ?>" data-toggle="modal" name="group" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-times"></i></a>
</td></tr>
                        <?php 
                    }
                }
            ?>
    </tbody>
</table>
</div>
<!--..............................................TABLE VIEW.................................................................................-->



<?php 
if(isset($all_syllabus) && !empty($all_syllabus))
{
foreach($all_syllabus as $val) 
{
 ?>   
<div id="test2_<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
<div class="modal-dialog">
  <div class="modal-content">
     <div class="modal-header"> <a class="close" data-dismiss="modal">×</a>
   
    <h3 id="myModalLabel">Delete Syllabus</h3>
    </div>
  <div class="modal-body">
     Do you want to delete? &nbsp; 
    <input type="hidden" value="<?php echo $val['id']; ?>" class="hid" />
  </div>
  <div class="modal-footer">
   	
    
    <button class="btn btn-primary delete_yes" id="yes">Yes</button>
    <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i>No</button>
  </div>
</div>
</div>  
</div>
<?php }} ?>

<?php 
if(isset($all_syllabus) && !empty($all_syllabus))
{
foreach($all_syllabus as $val) 
{
 ?>   
<div id="test_<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  <div class="modal-dialog">
  <div class="modal-content">
     <div class="modal-header"><a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel">Syllabus View</h3>
    </div>
  <div class="modal-body">
  <table width="100%" class="staff_table_sub">
        <tr>
    <tr><td width="8%">Batch</td>
    <td class="text_bold" width="10%"><label><?=$val['from']?>-<?=$val['to']?></label></td></tr>
    <tr><td width="8%"> Semester</td>
    <td class="text_bold" width="10%"><label><?=$val['semester'] ?></label></td></tr>
    <tr><td width="8%">Department</td>
    <td class="text_bold" width="10%"><label><?=$val['department'] ?></label></td></tr>
    <tr><td width="8%">Section</td>
    <td class="text_bold" width="10%"><label><?=$val['group'] ?></label></td></tr>
    <tr><td width="8%">Subject</td>
    <td class="text_bold" width="10%"><label><?=$val['nick_name'] ?></label></td></tr>
    <tr><td width="8%">Subject Code</td>
    <td class="text_bold" width="10%"><label><?=$val['scode'] ?></label></td></tr>
    <tr><td width="8%">Unit</td>
    <td class="text_bold" width="10%"><label><?=$val['unit_group'] ?></label></td></tr>
     <tr><td width="8%">Topic</td>
    <td class="text_bold" width="10%"><label><?=$val['topic_group'] ?></label></td></tr>
    <tr> <td width="8%">Hours</td>
    <td class="text_bold" width="10%"><label><?=$val['hour_group'] ?></label></td></tr>
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




<script type="text/javascript">
$(document).ready(function(){ $("#select_batch").focus(); });
$('.ajax_class,#depart_id,#group_id').live('change',function(){
	$("#int_div").html('');
	
});
$('.add_row').click(function(){
		$('#last_row').clone().appendTo('#app_table'); 
		$('.dy_no').each(function(){
			$(this).html();
			
		});	
	 });
	$(".remove_comments").live('click',function(){
		$(this).closest("tr").remove();
		  
		$('.dy_no').each(function(){
			$(this).html();
			
		});	
   });
$('#depart_id').live('change',function(){
	$("#subject_id").val('');
	$("#group_id").val('');
});
$('.ajax_class').live('change',function(){
	$("#subject_id").val('');
	$("#depart_id").val('');
	$("#group_id").val('');
});

 $('#upload').live('click',function(){
		$.ajax({
		  url:BASE_URL+"internal/upload",
		  type:'post',
		  data:{ 
				upload:	$('#file_name').val()
			   },
		  success:function(result){
		  }    
		});	 
});
 	  $('#depart_id').live('change',function(){
			d_id=$(this).val();
			if(d_id=="" || d_id==null)
			{
				$("#group_id").attr('disabled',true);
				$("#subject_id").attr('disabled',true);
			}
			else
			{
				$("#group_id").attr('disabled',false);
			$.ajax({
			  url:BASE_URL+"student/get_all_group",
			  type:'POST',
			  data:{ 
						depart_id : d_id
						
				   },
			  success:function(result){
					$('#g_td').html(result);
					
					/*$('.modal-backdrop').hide();
					$('.close_div').hide();*/
			  }    
			});	
			}
	   });
	    $('#select_batch').live('change',function(){
			b_id=$(this).val();
			if(b_id=="" || b_id==null)
			{
				$("#select_sem").attr('disabled',true);
				$("#depart_id").attr('disabled',true);
				$("#group_id").attr('disabled',true);
				$("#subject_id").attr('disabled',true);
			}
			else
			{
				$("#depart_id").attr('disabled',false);
			$.ajax({
			  url:BASE_URL+"subject/get_all_department_internal",
			  type:'POST',
			  data:{ 
						batch_id : b_id
						
				   },
			  success:function(result){
					$('#td_depart').html(result);
					/*$('.modal-backdrop').hide();
					$('.close_div').hide();*/
			  }    
			});	
			}
	   });
	    $('#select_batch').live('change',function(){
			b_id=$(this).val();
			if(b_id=="" || b_id==null)
			{
				$("#select_sem").attr('disabled',true);
				$("#depart_id").attr('disabled',true);
				$("#group_id").attr('disabled',true);
				$("#subject_id").attr('disabled',true);
				
			}
			else
			{
				$("#select_sem").attr('disabled',false);
			$.ajax({
			  url:BASE_URL+"subject/get_all_sem",
			  type:'POST',
			  data:{ 
						batch_id : b_id
						
				   },
			  success:function(result){
					$('#td_sem').html(result);
					
					/*$('.modal-backdrop').hide();
					$('.close_div').hide();*/
			  }    
			});	
			}
	   });
	    $('#select_sem').live('change',function(){
			if($(this).val()=="" || $(this).val()==null)
			{
				$("#depart_id").attr('disabled',true);
				$("#group_id").attr('disabled',true);
				$("#subject_id").attr('disabled',true);
			}
			else
			{
			$("#depart_id").attr('disabled',false);
			
			}
		});
	   $('#group_id').live('change',function(){
			group=$(this).val();
			if(group=="" || group==null)
			{
				$("#subject_id").attr('disabled',true);
				$("#subject_id").val('');
			}
			else
			{
				$("#subject_id").attr('disabled',false);
			$.ajax({
			  url:BASE_URL+"internal/get_all_subject",
			  type:'post',
			  data:{ 
					select_batch:$('#select_batch').val(),
					depart_id:$('#depart_id').val(),
					group_id:group,
					select_sem:$("#select_sem").val()
				   },
			  success:function(result){
				  
				  
					$('#sub_td').html(result);
					
			  }    
			});	 
			}
	   });
	
	 $("#submit").click(function(){
			
			 var select_batch=$('#select_batch').val();
			 var select_sem=$('#select_sem').val();
			 var group_id=$('#group_id').val();
			 var subject_id=$('#subject_id').val();
			 var depart_id=$('#depart_id').val();
			 var sub_code_id=$('#sub_code_id').val();
			 //alert(select_batch);
			 y_array='';
			 $('.unit_group').each(function(){
				 if($(this).val()!='')
				 y_array=y_array+$(this).val()+',';
				
			 });
			 
			 x_array='';
			 $('.topic_group').each(function(){
				 if($(this).val()!='')
				 x_array=x_array+$(this).val()+',';
			 });
			  z_array='';
			 $('.hour_group').each(function(){
				 if($(this).val()!='')
				 z_array=z_array+$(this).val()+',';
			 });
			// for_loading('Loading... Data add Please Wait '); // loading notification
			$.ajax({
			  url:BASE_URL+"staff_syllabus/insert_staff_syllabus",
			  type:'post',
			  data:{ 
						select_batch : select_batch,
						group_id : group_id,
						select_sem : select_sem ,
						subject_id : subject_id,
						depart_id : depart_id,
						sub_code_id : sub_code_id,
						value4 : y_array,
						value5 : x_array,
						value6 : z_array,
					
				   },
			  success:function(result)
			  	  {
					$('#g_div').html(result);
					
					//for_response('Successfully Add...!'); 
					if(result)
					{
					}
			 
			  }    
			});
			var select_batch=$('#select_batch').val('');
			 var group_id=$('#group_id').val('');
			  var select_sem=$('#select_sem').val('');
			   var subject_id=$('#subject_id').val('');
			    var depart_id=$('#depart_id').val('');
				 var sub_code_id=$('#sub_code_id').val('');
				  var unit_group=$('#unit_group').val('');
				   var topic_group=$('#topic_group').val('');
				   var hour_group=$('#hour_group').val('');
				 });
				 
	$("#yes").live("click",function()
  {
   for_loading_del('Loading...  Please Wait '); // loading notification
   var hid=$(this).parent().parent().find('.hid').val();
  
    $.ajax({
      url:BASE_URL+"staff_syllabus/delete_syllabus",
      type:'get',
      data:{ value1 : hid},
      
      success:function(result){
      
      $("#list_all").html(result);
	  for_response_del('Loading Data...!'); // resutl notification  
      }    
    
    });
	 $('.modal').css("display", "none");
    $('.fade').css("display", "none"); 
	  
   }); 
   $("#subject_id").live("change",function()
  {
	  //alert(master_ve);
         var subject_id=$(this).val();
		// alert(subject_id);
		 $.ajax(
		 {
		  url:BASE_URL+"staff_syllabus/search_sub_code",
		  type:'GET',
		  data:{ value1 : subject_id},
		  success:function(result)
		  
		  {
			 
		     $("#sub_code").html(result);
		  }    		
		});
  });
</script>

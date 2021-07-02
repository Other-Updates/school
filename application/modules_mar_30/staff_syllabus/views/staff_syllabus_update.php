 <table class="staff_table"> 
<?php 
	 if(isset($all_syllabus_one) && !empty($all_syllabus_one))
	 {
     	foreach($all_syllabus_one as $val)
        {
			//echo "<pre>";print_r($val);exit;
			?>
<?php 
                    }
                }
            ?>
             <tr>
<th>Batch:</th> 
<td class="text_bold" width="8%"><label><?=$val['from']?>-<?=$val['to']?></label></td>
<input type="hidden" class="select_batch" id="select_batch" value="<?=$val['from']?>-<?=$val['to']?>" />
<th>Semester:</th>
<td  class="text_bold" width="8%"><label><?=$val['semester']?></label></td>
<input type="hidden" class="select_sem" id="select_sem" value="<?=$val['semester']?>" />
<th>Department:</th>
<td  class="text_bold" width="8%"><label><?=$val['department']?></label></td>
<input type="hidden" class="depart_id" id="depart_id" value="<?=$val['department']?>" />
<th>Section:</th><td width="8%"  class="text_bold">
<label><?=$val['group']?></label></td>
<input type="hidden" class="group_id" id="group_id" value="<?=$val['group']?>" />
<th>Subject:</th>
<td width="8%"  class="text_bold"><label><?=$val['nick_name']?></label></td>
<input type="hidden" class="subject_id" id="subject_id" value="<?=$val['nick_name']?>" />
<th>Subject Code:</th>
<td width="10%"  class="text_bold"><label><?=$val['scode']?></label></td>
<input type="hidden" class="sub_code_id" id="sub_code_id" value="<?=$val['scode']?>" />
</tr>
</table>
<table id='app_table'>
	<thead>
    	<tr>
        	<td></td>
            <th>Unit</th>
            <th>Topic</th>
            <th>Hours</th>
        </tr>
    </thead>
    <tbody>
    	<tr>
         <?php 
	 if(isset($all_syllabus_update) && !empty($all_syllabus_update))
	 {
     	foreach($all_syllabus_update as $val)
        {
			?>
        	<td></td>
            <td><input type="text" name='unit_group[]' class="unit_group" id="unit_group" value="<?=$val['unit_group'] ?>" id="col0" tabindex="29" /></td>
            <td><input type="text" name='topic_group[]' value="<?=$val['topic_group'] ?>" class="topic_group" id="topic_group" id="col1" tabindex="30" /></td>
            <td><input type="text" name='hour_group[]' value="<?=$val['hour_group'] ?>" id="hour_group" cl class="float_val hour_group" id="col2" tabindex="31" /></td>
        </tr>
    <?php 
                    }
                }
            ?>
             </tbody>
             <th><input type="button" value="+" class='add_row btn bg-purple btn-sm'/></th>
</table>

<table style="display:none;">
<tr id="last_row" >
 <td><input type="button" value="-" class='remove_comments btn bg-purple btn-sm'/></td>
	<td class="dy_no">
<input type="text" name='unit_group[]' class="unit_group" id="unit_group" id="col0" /></td>
<td><input type="text" name='topic_group[]'  class="topic_group" id="topic_group" id="col1" tabindex="30" /></td>
<td><input type="text" name='hour_group[]' id="hour_group"  class="float_val hour_group" id="col2" tabindex="31" /></td>
</tr>
</table>
<br />
<center><input type="button" value="Update" id="update" class="update btn btn-primary" /></center>
<script>
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
	</script>
	<script>
 $("#update").click(function(){
			 var select_batch=$('#select_batch').val();
			 var select_sem=$('#select_sem').val();
			 var group_id=$('#group_id').val();
			 var subject_id=$('#subject_id').val();
			 var depart_id=$('#depart_id').val();
			 var sub_code_id=$('#sub_code_id').val();
			//alert(sub_code_id);exit;
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
			 for_loading('Loading... Data Loading Please Wait '); // loading notification
			$.ajax({
			  url:BASE_URL+"staff_syllabus/staff_syllabus_update",
			  type:'GET',
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
					
					if(result){
					 window.location.replace(BASE_URL+"staff_syllabus"); }// resutl notification
			     
			}
			});
			$('#master_ve').val('');
			$('.r_amount').each(function(){
				 if($(this).val()!='')
				x_array=x_array+$(this).val('');
			 });
			$('.stage_name').each(function(){
				 if($(this).val()!='')
				y_array=y_array+$(this).val('');
			 });
		 });
 
  
   
   
   
</script>


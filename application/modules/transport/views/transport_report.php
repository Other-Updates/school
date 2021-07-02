<div id="select_trans">
<table class="form_table" width="100%">
  <tr>
   <td>Batch</td>
    <td>
   <select id='select_batch' class='ajax_class' style="width:100px;">
        <option value="">Select</option>
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
   
    <td>Department</td>
    

    <td id='td_depart'>
       <select id='depart_id' name='student_group[depart_id]' disabled="disabled" style="width:100px;">
            	<option value="">Select</option>
				<?php 
                    if(isset($all_depart) && !empty($all_depart)){
						
                        foreach($all_depart as $val)
                        {
                            ?>
                                <option value="<?=$val['id']?>"><?=$val['nickname']?></option>
                            <?php 
                        }
                    }
                ?>
    </select>
  </td>
  <td>Section</td>
  <td id='g_td'>
        <select id='group_id' name='student_group[group_id]' disabled="disabled" style="width:100px;">
            	<option value="">Select</option>
        </select>
    </td>
 	<td>Student Type</td>
  <td >
        <select id='s_type' name='s_type'  style="width:100px;" disabled="disabled">
            	
                <option value="3">All</option>
                <option value="1">Management</option> 
                <option value="2">Counselling</option> 
        </select>
    </td>
  </tr>
</table>
</div>
<br />


<script type="text/javascript">
$('#select_batch').live('change',function(){
			
			b_id=$(this).val();
			if(b_id=="" || b_id==null)
			{
				$('#depart_id').prop('disabled',true);
				$('#group_id').prop('disabled',true);
				window.location.reload();
			}
			else
			{
				$('#depart_id').prop('disabled',false);
			$.ajax({
			  url:BASE_URL+"transport/get_all_department1",
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
	   
	   <!--get_all group-->
	   
	    $('#depart_id').live('change',function(){
			d_id=$(this).val();
			if(d_id=="" || d_id==null)
			{
				
				$('#group_id').prop('disabled',true);
			}
			else
			{
				$('#group_id').prop('disabled',false);
			$.ajax({
			  url:BASE_URL+"student/get_all_group1",
			  type:'POST',
			  data:{ 
						depart_id : d_id
						
				   },
			  success:function(result){
					$('#g_td').html(result);
					$('#group_id').focus();
					/*$('.modal-backdrop').hide();
					$('.close_div').hide();*/
			  }    
			});	
			}
	   });
	   
	    $('#view_tr_std').live('click',function(){
			std_id=$(this).val();
			$.ajax({
			  url:BASE_URL+"transport/view_student_transport1",
			  type:'POST',
			  data:{ 
						std_id:std_id
						
				   },
			  success:function(result){
					$('#student_div').html(result);
					$('.std_class').html('');
					$('#select_trans').css('display','none'); 
			  }    
			});	
			
	   });
	   
	   // student type
	  $('#group_id').live('change',function(){
			group_id=$(this).val();
			if(group_id=="" || group_id==null || group_id==0)
			{
				$('#s_type').prop('disabled',true);
				$('#hostel').prop('disabled',true);
			}
			else
			{
				$('#s_type').prop('disabled',false);
				$('#hostel').prop('disabled',false);
				$('#s_type').val('');
				$('#hostel').val('');
			$.ajax({
			  url:BASE_URL+"transport/get_all_student_for_staff",
			  type:'post',
			  data:{ 
					select_batch:$('#select_batch').val(),
					depart_id:$('#depart_id').val(),
					group_id:group_id
						
				   },
			  success:function(result){
					$('#student_div').html(result);
					$('.std_class').html('');
			  }    
			});	 
			}
	   });
	   
	   
	   $('#s_type').live('change',function(){
			s_type=$(this).val();
			if(s_type==3)
			{
				
				$.ajax({
			  url:BASE_URL+"transport/get_all_student_for_staff",
			  type:'post',
			  data:{ 
					select_batch:$('#select_batch').val(),
					depart_id:$('#depart_id').val(),
					group_id:$('#group_id').val()
						
				   },
			  success:function(result){
					$('#student_div').html(result);
					$('.std_class').html('');
			  }    
			});	 
			}
			else
			{
				
			$.ajax({
			  url:BASE_URL+"transport/get_all_student_type",
			  type:'post',
			  data:{ 
					select_batch:$('#select_batch').val(),
					depart_id:$('#depart_id').val(),
					group_id:$('#group_id').val(),
					s_type:s_type	
				   },
			  success:function(result){
					$('#student_div').html(result);
					
			  }    
			});	 
			}
	   });
	   
	   
</script>
 <div id='student_div'>
 	
 </div>
<div class='std_class'>
<table id="example1"   class="table table-bordered table-striped dataTable">
	<thead>
    	<tr>
        	<th>S.No&nbsp;</th>
            <th>Image</th>
            <th>Roll No</th>
            <th>Name</th>
            <th>Batch</th>
            <th>Department</th>
            <th>Contact No</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
			<?php 
			
                if(isset($transport_student_list) && !empty($transport_student_list)){
					
					$i=0;
                    foreach($transport_student_list as $val)
                    {
                       $i++; ?>
                           <tr>
                           		<td><?=$i?></td>
                                <td><a href="#profile_img_<?= $val['id'] ?>" data-toggle="modal"><img class="staff_thumbnail" src="<?=$this->config->item('base_url').'profile_image/student/thumb/'.$val['image']?>" /></a></td>
                                <td><?=$val['std_id']?></td>
                                <td><?=$val['name']."&nbsp;".$val['last_name']?></td>
                                <td><?=$val['from'].'-'.$val['to']?></td>
                                <td><?php print_r($val['nickname'].'-'.$val['group']);?></td>
                                <td><?=$val['contact_no']?></td>
                                <td>Pending</td>
                                
                                <td>
                                	<button id="view_tr_std" value="<?=$val['std_id']?>"  title="View" 
                                    class="btn bg-maroon btn-sm" >View</button>
                                   <?php /*?> <a href="<?=$this->config->item('base_url').'student/update_student/'.$val['id']?>" title="Edit" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a><?php */?>
                                </td>
                           </tr>
                        <?php 
                    }
                }
            ?>
    </tbody>
</table>
</div>
<?php 
	if(isset($transport_student_list) && !empty($transport_student_list))
	{
		foreach($transport_student_list as $val)
		{
			?>
            <div id="profile_img_<?= $val['id'] ?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-body">
            <a class="close1" data-dismiss="modal">×</a>
                <img src="<?=$this->config->item('base_url').'profile_image/student/orginal/'.$val['image']?>" width="50%" />
    	</div>
    </div>
  </div>
</div>	
<?php }} ?>		

<script type="text/javascript">
$(document).ready(function()
{
  $('.print_class').click(function(){
	 $('#select_trans').css('display','none');   
	window.print();
	 
  });
});
</script>
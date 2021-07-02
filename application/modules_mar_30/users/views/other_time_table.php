<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/time_table.png"></div>
    Internal Time Table			
</div>
<div class="message-form-inner">
<div class="form-row user_print_use">
<?php 
//echo "<pre>"; print_r($all_sem); exit;
     			
?>
<label class="field-name">Select Internal :</label>                                   
<select id='select_sem'>
            	<option value="">Select Semester</option>
				<?php 
                    if(isset($all_sem) && !empty($all_sem)){
						
                        foreach($all_sem as $val1)
                        {
                            ?>
                                <option value="<?=$val1['id']?>"><?php echo $val1['semester']?></option>
                            <?php 
                        }
                    }
                ?>
    </select>
    <select id='int_id' style="display:none;">
            	<option>Select Internal</option>
              	<option value="1">Internal-1</option>
                <option value="2">Internal-2</option>
                <option value="3">Internal-3</option>
    </select>
    
</div>
<div id='other_time_table'>
   <table id='app_table' class="table demo my_table_style">
   <thead>
    <tr>
        <th colspan="5"><span style="color:#058DCE">Time Table of <?php if(isset($all_info) && !empty($all_info)){
			echo $all_info[0]['sem'][0]['semester']."&nbsp;Internal No-".$all_info[0]['time_table_type'];} ?></span></th>
    </tr>
    <tr>
        <th>S.No</th>
        <th>Subject</th>
        <th>Date</th>
        <th data-hide='phone,tablet'>From Time</th>
        <th data-hide='phone,tablet'>To Time</th>
    </tr>
    </thead>
   		 <?php
			if(isset($all_info[0]['time_info']) && !empty($all_info[0]['time_info']))
			{
				$k=1;
				foreach($all_info[0]['time_info'] as $val1)
				{
					
				?>
				
        <tr>
            <td class="sno" align="center"><?=$k?></td>
            <td align="center">
            	<?=$val1['nick_name']?>                 
                    
            </td>
            <td align="center"><?=date('d-M-Y',strtotime($val1['date']))?></td>
            <td align="center">
            	<?=$val1['time_in']?>
            </td>
            <td align="center">
            	<?=$val1['time_out']?>
            </td>
        </tr>
 		<?php
			$k++;
			}
			
		}
		else
			echo "<tr><td colspan='5'>No Records Found</td></tr>";
		?>     	
</table>
<div>
<br />
<table class="view_table">
<?php 
if(isset($all_info[0]['time_info']) && !empty($all_info[0]['time_info']))
				{
                foreach($all_info[0]['time_info'] as $val)
                { ?>
	<tr>
    <td width="100"><?php echo $val['nick_name']; ?></td>
    <td width="5">:</td>
    <td class="text_bold"><?php echo ucfirst(strtolower($val['subject_name'])); ?></td></tr>
    <?php }} ?>
</table>
</div> 
<p class="user_print_use">
<input type="button"  class='btn btn-primary print_btn right' value="Print" /> 
</p>
</div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.print_btn').click(function(){
		window.print();	
	});	
});
</script>
<script type="text/javascript">
	$('#select_sem').live('change',function(){
		var ss=$(this).val();
		if(ss=='' || ss==null)
		{
			
			$('#int_id').hide();
		}
		else
		{
			$('#int_id').show();
			$('#int_id').val('');
		}
	});
	$('#int_id').live('change',function(){
		if($(this).val()!='Select'){
			$.ajax({	
			  url:BASE_URL+"users/get_other_time_table/1",
			  type:'POST',
			  data:{ 
						int_id:$(this).val(),
						sem_id:$('#select_sem').val()	
						
				   },
			  success:function(result){
					$("#other_time_table").html(result);
			  }    
			});
		}
	});	
</script>
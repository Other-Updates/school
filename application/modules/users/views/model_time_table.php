<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/time_table.png"></div>
    Model Time Table			
</div>
<div class="message-form-inner">
<div class="form-row user_print_use">
<?php 
     if(isset($all_sem[0]['semester']) && !empty($all_sem[0]['semester'])){				
?>
<label class="field-name">Select Model :</label>                                   
<select id='select_sem'>
            	<option value="0">Select</option>
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
    <?php }?>  
</div>
<div id='other_time_table'>
   <table id='app_table' class="table demo my_table_style">
   <thead>
   <tr>
        <th colspan="5"><span style="color:#058DCE">Current Model Time Table</span></th>
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
            <td class="sno"><?=$k?></td>
            <td>
            	<?=$val1['nick_name']?>                 
                    
            </td>
            <td><?=date('d-M-Y',strtotime($val1['date']))?></td>
            <td>
            	<?=$val1['time_in']?>
            </td>
            <td>
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
    <td><?php echo $val['nick_name']; ?></td>
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
		if($(this).val()!='Select'){
			$.ajax({	
			  url:BASE_URL+"users/get_model_time_table/2",
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
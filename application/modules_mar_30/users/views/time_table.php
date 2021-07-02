<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); 
	$title=explode(",", $all_info[0]['time']);
	$this->load->model('time_table/time_table_model');
	$total_hours=$this->time_table_model->get_values_by_type('total_hours');
	$total_days=$this->time_table_model->get_values_by_type('total_day_order');
?>
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/time_table.png"></div>
    Time Table			
</div>
<div class="message-form-inner">
<div class="form-row user_print_use">
<?php 
if(isset($all_info[0]['time_info']) && !empty($all_info[0]['time_info']))
	{
		
		
?>
<label class="field-name">Select Semester :</label>                                   
<select id='time_tb'>
    <option>Select</option>
    <?php                         
        if(isset($all_sem) && !empty($all_sem))
        {
            foreach($all_sem as $val)
            {
                ?>
                    <option value='<?=$val['id']?>'><?=$val['semester']?></option>
                <?php
            }
        } 
    ?>
</select>
</div>
       
<div id='time_table'>  
<table class="table demo my_table_style time_table">
	<thead>
    	<tr>
        
        	<th colspan="<?=$total_hours[0]['details']+1?>"><span style="color:#058DCE">Current Time Table</span></th>
        </tr>
    	<tr style="background-color: rgb(250, 250, 250);">
        	<th class="tt_m" style="font-size:11px;"><strong>Days / <br />Hours</strong></th>
        	<?php 
				$j=1;
				foreach($title as $val)
				{
					if($val!=''){
						if($j%2!=0)
						{
							echo "<th style='font-size:11px;' data-hide='phone,tablet'>";
						}
					?>
				   		
                      
                         <?=$val?>
                              <br />          
                       
					<?php
						if($j%2==0)
						{
							echo "</th>";
						}
						$j++;
					}
					
				}
			?>
        </tr>
    </thead>
  
   <tbody>
	<?php 
	$k=0;$i=1;
    foreach($all_info[0]['time_info'] as $val1)
    {
		if($k==0 || $k%$total_hours[0]['details']==0)
		{
		echo "<tr><td class='tt_m' style='font-size:12px;font-weight:bold'>Day".$i."</td>";
		$i++;
		}
		echo "<td style='font-size:11px;'>";
		?>

                        <?php print_r($val1['nick_name'])?>
                        
                          
         <?php 
		 $this->load->model('time_table/time_table_model');
		$staff=$this->time_table_model->get_staff_info($val1['supject_id']); 
		 ?>
         <br />
         <span class='select_staff'><?=$staff[0]['staff_name']?></span>
        <?php
		echo "</td>";
		$k++;	
    }
    ?>
    </tbody>
</table>
<br />

<table class="view_table" id="test" width="100%">
<?php 
				if(isset($all_subject) && !empty($all_subject))
				{
                foreach($all_subject as $val1)
					{
						
						 
							 ?>
							<tr><td><?php echo $val1['nick_name']; ?></td>
							<td width="5">:</td>
							<td class="text_bold"><?php echo $val1['subject_name']; ?></td></tr>
                            <?php
						 
						 
						}
				}
					?>
</table>
<?php }else{
	echo "Class Time Table Not Created Yet...";
}
	?> 
<p class="user_print_use">
<input type="button"  class='btn btn-primary print_btn right' value="Print" /> 
</p>     
</div>
</div>
</div>
</div>
<script type="text/javascript">
	
	$('#time_tb').live('change',function(){
		if($(this).val()!='Select'){
			$.ajax({	
			  url:BASE_URL+"users/get_time_table",
			  type:'POST',
			  data:{ 
						sem_id:$(this).val()
						
				   },
			  success:function(result){
					$("#time_table").html(result);
			  }    
			});
		}
		else
		{
			window.location.reload();
		}
	});	
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('.print_btn').click(function(){
		window.print();	
	});	
	var arr = $("#test tr");

$.each(arr, function(i, item) {
    var currIndex = $("#test tr").eq(i);
    var matchText = currIndex.children("td").first().text();
    $(this).nextAll().each(function(i, inItem) {
        if(matchText===$(this).children("td").first().text()) {
            $(this).remove();
        }
    });
});
});
</script>
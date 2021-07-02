<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/time_table.png"></div>
   Arrear Time Table			
</div>
<div class="message-form-inner">
<div class="form-row user_print_use">

</div>

<div id='other_time_table'>
    <table id='app_table' class="table demo my_table_style">
    <thead>
    <tr>
        <th colspan="6"><span style="color:#058DCE"> &nbsp; Arrear Time Table</span></th>
    </tr>
    <tr>
        <th>Semester</th>
        <th>Subject Code</th>
        <th>Subject</th>
        <th>Date</th>
        <th data-hide='phone,tablet'>From Time</th>
        <th data-hide='phone,tablet'>To Time</th>
    </tr>
    </thead>
   		 <?php
			if(isset($arrear_time) && !empty($arrear_time))
			{
				
				foreach($arrear_time as $val1)
				{
					
				?>
				
        <tr>
            <td class="sno" align="center"><?=$val1['subject_info'][0]['semester']?></td>
            <td align="center">
            	<?=$val1['subject_info'][0]['scode']?>                 
                    
            </td>
            <td align="center">
            	<?=$val1['subject_info'][0]['subject_name']?>                 
                    
            </td>
            <td align="center"><?=date('d-M-Y',strtotime($val1['date_of_exam']))?></td>
            <td align="center">
            	<?=$val1['in_time']?>
            </td>
            <td align="center">
            	<?=$val1['out_time']?>
            </td>
        </tr>
 		<?php
			
			}
			
		}
		else
			echo "<tr><td colspan='6'>No Records Found</td></tr>";
		?>     	
</table>
<div>
<br />

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

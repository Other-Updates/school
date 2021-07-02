<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<link href="<?= $theme_path; ?>/css/footable.core.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/footable-demos.css" rel="stylesheet" type="text/css" />
<script src="<?= $theme_path; ?>/js/footable.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function () {
		$('table').footable();
	});
</script>

<table id='app_table' class="table demo my_table_style">
<thead>
<tr>
        <th colspan="5"><span style="color:#058DCE"><?php  echo $all_info[0]['sem'][0]['semester'];  ?> </span></th>
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
			if(isset($int_info[0]['time_info']) && !empty($int_info[0]['time_info']))
			{
				$k=1;
				foreach($int_info[0]['time_info'] as $val1)
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
		{
			echo "<tr><td colspan='5'>No Records Found</td></tr>";
		}
		?>     	
</table>
<div>
<br />
<table class="view_table">
<?php 
if(isset($int_info[0]['time_info']) && !empty($int_info[0]['time_info']))
				{
                foreach($int_info[0]['time_info'] as $val)
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
<script type="text/javascript">
$(document).ready(function(){
	$('.print_btn').click(function(){
		window.print();	
	});	
});
</script>

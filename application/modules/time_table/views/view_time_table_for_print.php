<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); 
if(isset($all_info) && !empty($all_info))
{
	
$title=explode(",", $all_info[0]['time']);

?>
<link rel="stylesheet" type="text/css" media="print" href="<?= $theme_path; ?>/css/media_print.css" /> 
<style type="text/css">
.select_staff1{font-weight:bold;}
@media print{@page {size: landscape}
.feedback-panel
{
	display:none;
}
</style>    
<h3 style="margin:0 0 10px 0;">Class Time Table</h3>
<table border="1" class="staff_table_sub time_table" style="border-color:#ddd; font-size:10px;">
	<thead>
    	<tr style="background-color: rgb(250, 250, 250);">
        	<td class="tt_m"><strong>Days/Hours</strong></td>
        	<?php 
				$this->load->model('time_table/time_table_model');
				$total_hours=$this->time_table_model->get_values_by_type('total_hours');
				$total_days=$this->time_table_model->get_values_by_type('total_day_order');
				$j=1;$k=1;
				foreach($title as $val)
				{
					if($val!=''){
						if($j%2!=0)
						{
							echo "<td>".$k."/";
							$k++;
						}
					?>
				   		
                    
                    <?=$val?><br/>
                                   
                       
					<?php
						if($j%2==0)
						{
							echo "</td>";
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
	if(isset($all_info) && !empty($all_info)) {
    foreach($all_info[0]['time_info'] as $val1)
    {
		if($k==0 || $k%$total_hours[0]['details']==0)
		{
		echo "<tr><td class='tt_m'>Day".$i."</td>";
		$i++;
		}
		echo "<td>";
		?>
      
  			<?=$val1['nick_name']?><br>
                        
                   
         <?php 
		$staff=$this->time_table_model->get_staff_info($val1['supject_id']); 
		 ?>
         <span class='select_staff1'><?=$staff[0]['staff_name']?></span>
        <?php
		echo "</td>";
		$k++;	
    }}
    ?>
    </tbody>
</table>
<br />
<div>
<table class="staff_table">
<?php 
if(isset($all_subject) && !empty($all_subject))
				{
                foreach($all_subject as $val)
                { ?>
	<tr>
    <td width="137"><?php echo $val['nick_name']; ?></td>
    <td width="5">:</td>
    <td class="text_bold"><?php echo ucfirst(strtolower($val['subject_name'])); ?></td></tr>
    <?php }} ?>
</table>
</div>   
<br />
<input type="button" value='Print' class='print_time btn btn-primary fright' />
<br /><br />
<script type="text/javascript">
$(".print_time").live('click',function(){
	
	window.print();
	});
</script>
<?php
}
else
{
	echo "Time Table Not Created";
}

?>
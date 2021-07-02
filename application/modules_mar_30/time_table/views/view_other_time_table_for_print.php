<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<link rel="stylesheet" type="text/css" media="print" href="<?= $theme_path; ?>/css/media_print.css" />
<style type="text/css">

.feedback-panel
{
	display:none;
}
</style>  

<h3 style="margin:0 0 10px 0;"><?php 
if(isset($int_info) && !empty($int_info)) 
{
	if($int_info[0]['time_table_method']=='internal') 
	{
		echo ucfirst($int_info[0]['time_table_method'])."-".$int_info[0]['time_table_type'];
	} 
	else if($int_info[0]['time_table_method']=='external')
	  {
	echo "Model Exam";
	}
	else 
	{
		echo "Exam";
	}
}?></h3>
<table id='app_table' class="staff_table_sub" border="1">
    <tr>
        <th>S.No</th>
        <th>Subject</th>
        <th>Date</th>
        <th>From Time</th>
        <th>To Time</th>
    </tr>
   	  <?php 
		if(isset($int_info[0]['time_info']) && !empty($int_info[0]['time_info']))
		{
			$k=1;
			foreach($int_info[0]['time_info'] as $val1)
			{
				?>
                <tr>
                    <td class="sno"><?=$k?></td>
                    <td><?=$val1['nick_name']?></td>
                    <td><?=date('d-m-Y',strtotime($val1['date']))?></td>
                    <td><?=$val1['time_in']?></td>
                    <td><?=$val1['time_out']?></td>
                </tr>
 		<?php
			$k++;
			}
		}
		?>     	
</table>
<p class="print_admin_use">
<br />
<input type="button" value='Print' class='print_time btn btn-primary fright' />
<br /><br />
</p>
<div>
<table class="staff_table">
<?php 
if(isset($int_info[0]['time_info']) && !empty($int_info[0]['time_info']))
				{
                foreach($int_info[0]['time_info'] as $val)
                { ?>
	<tr>
    <td width="137"><?php echo $val['nick_name']; ?></td>
    <td width="5">:</td>
    <td class="text_bold"><?php echo ucfirst(strtolower($val['subject_name'])); ?></td></tr>
    <?php }} ?>
</table>
</div>
<script type="text/javascript">
$(".print_time").live('click',function(){
	
	window.print();
	});
</script>
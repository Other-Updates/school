<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); 
$title=explode(",", $all_info[0]['time']);
?>
 		<link href="<?= $theme_path; ?>/img/favicon.png" rel="shortcut icon" type="img/x-icon">
    	<link rel="stylesheet" type="text/css" media="all" href="<?= $theme_path; ?>/css/bootstrap.css" />      
        <link href="<?= $theme_path; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= $theme_path; ?>/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= $theme_path; ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <link href="<?= $theme_path; ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <link href="<?= $theme_path; ?>/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= $theme_path; ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<br />        
<table border="0" class="staff_table_sub time_table" style="border-color:#ddd;">
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
							echo "<td>".$k;
							$k++;
						}
					?>
				   		
                         <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <div class="input-group" style="width:100px;">
                                    <input type="text" class="form-control timepicker timearray" value="<?=$val?>"/>
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>                     
                       
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
    foreach($all_info[0]['time_info'] as $val1)
    {
			
		if($k==0 || $k%$total_hours[0]['details']==0)
		{
		echo "<tr><td class='tt_m'>Day".$i."</td>";
		$i++;
		}
		echo "<td>";
		?>
        <select class="select_subject check_class">
            
            <?php 
                if(isset($all_subject) && !empty($all_subject))
				
                foreach($all_subject as $val)
                {
					
		
                    ?>
                        <option value="<?=$val['id']?>" <?=($val['id']==$val1['supject_id'])?'selected':''?>><?=$val['nick_name']?></option>
                        
                    <?php
                }
            ?>                 
         </select>
         <?php 
		$staff=$this->time_table_model->get_staff_info($val1['supject_id']); 
		 ?>
         <span class='select_staff'><?=$staff[0]['staff_name']?></span>
        <?php
		echo "</td>";
		$k++;	
    }
    ?>
    </tbody>
</table>   
<br />

<div class="right"> 
<input type="button" value='Update' class='update_time btn btn-primary' />
<?php 

?>
<a href="<?= $this->config->item('base_url').'time_table/print_time_table/'.$print_id['select_batch'].'/'.$print_id['depart_id'].'/'.$print_id['group_id'].'/'.$print_id['select_sem']?>" target="_blank" type='button' class='btn btn-success'>View</a>
<br /><br />
</div>
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
</div><br /><br />
<input type="hidden" value="<?=$all_info[0]['id']?>" class='hide_id' />
        <script src="<?= $theme_path; ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script src="<?= $theme_path; ?>/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
		<script src="<?= $theme_path; ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
		<script type="text/javascript">
            var BASE_URL = '<?php echo $this->config->item('base_url');  ?>';
        </script>
        <script type="text/javascript">
           
			
			$(".timepicker").timepicker({
                    showInputs: false
                });
        </script>
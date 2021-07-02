<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); 
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
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/jquery.datetimepicker.css" />
		<script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.datetimepicker.js"></script>
<br />
<?php
$count_original=count($all_subject);
$count_entered=count($int_info[0]['time_info']);
$remain=$count_original-$count_entered;
?>

<table border="0" id='app_table' class="staff_table_sub">
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
            <td>
            	<select class="select_subject check_other_class">
                        
                        <?php 
							if(isset($all_subject) && !empty($all_subject))
							{
								foreach($all_subject as $val)
								{
									?>
										<option <?=($val1['subject_id']==$val['id'])?'selected':''?>  value="<?=$val['id']?>"><?=$val['nick_name']?></option>
									<?php
								}
							}
						?>                 
                     </select>
            </td>
            <td><input type="text" value="<?=date('d-m-Y',strtotime($val1['date']))?>" class="int_date date"/></td>
            <td>
            	<div class="bootstrap-timepicker">
                            <div class="form-group">
                                <div class="input-group" style="width:100px;">
                                    <input type="text" value="<?=$val1['time_in']?>"  class="form-control timepicker timein" />
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>   
            </td>
            <td>
            	<div class="bootstrap-timepicker">
                            <div class="form-group">
                                <div class="input-group" style="width:100px;">
                                    <input type="text" value="<?=$val1['time_out']?>" class="form-control timepicker timeout"/>
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>   
            </td>
        </tr>
 		<?php
			$k++;
			}
			if($remain>0)
			{
				$row=$k;
				for($r=0;$r<$remain;$r++)
				{
					
			?>
         
           <tr>
            <td><?=$row?></td>
            <td>
            	<select class="select_subject check_other_class">
                        <option value="">Select</option>
                        <?php 
							if(isset($all_subject) && !empty($all_subject))
							{
								foreach($all_subject as $val)
								{
									?>
										<option value="<?=$val['id']?>"><?=$val['nick_name']?></option>
									<?php
								}
							}
						?>                 
                     </select>
            </td>
            <td><input type="text" class="int_date date"/></td>
            <td>
            	<div class="bootstrap-timepicker">
                            <div class="form-group">
                                <div class="input-group" style="width:100px;">
                                    <input type="text"   class="form-control timepicker timein" />
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>   
            </td>
            <td>
            	<div class="bootstrap-timepicker">
                            <div class="form-group">
                                <div class="input-group" style="width:100px;">
                                    <input type="text"  class="form-control timepicker timeout"/>
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>   
            </td>
            </tr>
            
			<?php 
			$row++;
			}
			}
		}
		else
			echo "<tr><td colspan='5'>Subject Not Created Yet..</td></tr>";
		?>     	
</table>
<br />
<div class="fright">
<input type="hidden" value='<?=$int_info[0]['id']?>' id='update_other_time_id' class="btn btn-primary"/>
<?php
if($int_info[0]['time_table_method']=='internal')
{
?>
<input type="button" value='Update' id='update_other_time_btn' class="btn btn-primary" />
<?php }else if($int_info[0]['time_table_method']=='external')
{?>
<input type="button" value='Update' id='update_other_time_btn1' class="btn btn-primary" />
<?php 
 }else if($int_info[0]['time_table_method']=='exam')
{?>
<input type="button" value='Update' id='update_other_time_btn2' class="btn btn-primary" />

<?php }?>
<a href="<?=$this->config->item('base_url').'time_table/print_other_time_table/'.$int_info[0]['batch_id'].'/'.$int_info[0]['depart_id'].'/'.$int_info[0]['group_id'].'/'.$int_info[0]['semester_id'].'/'.$int_info[0]['time_table_method'].'/'.$int_info[0]['time_table_type']?>" target="_blank" class="btn btn-success">View</a>
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
    <td  width="137"><?php echo $val['nick_name']; ?></td>
    <td width="5">:</td>
    <td class="text_bold"><?php echo ucfirst(strtolower($val['subject_name'])); ?></td></tr>
    <?php }} ?>
</table>
</div>
<br /><br />
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
         <script type="text/javascript">// <![CDATA[
			$('.date').datetimepicker({
			 lang:'de',
			 i18n:{de:{
			  months:[
			   'January','February','March','April','May','June','July','August','September','October','November','December'
			  ],
			  dayOfWeek:["Su.", "Mo", "Tu", "We", "Th", "Fr", "Sa."]
			 }},
			timepicker:false,
			format:'d-m-Y'
			});
			// adding new row
			
		</script> 
<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<form method="post" action="<?=$this->config->item('base_url').'staff_attendence/'?>">
	<table class="table table-bordered table-striped">
    	<tr>
        	<td width="10%">Date</td>
            <td width="20%"><input type="text" class='date mandatory' name="date" id="join_date"/></td>
            <td><input type="submit" value="View" class="btn btn-info" /></td>
            <td><span class="pull-right">Date : <strong><?=date('d-m-Y',strtotime($date));?></strong></span>&nbsp;&nbsp;</td>
        </tr>
    </table>
	<br />
    
</form>
<?php
if(isset($date) && !empty($date))
{
?>
<input type="hidden" id='st_date'  value="<?=date('Y-m-d',strtotime($date));?>" />
<input type="hidden" id='formate_date'  value="<?=date('d-m-Y',strtotime($date));?>" />
<?php 
}
if(isset($staff_attendance) && !empty($staff_attendance))
{
	?>
    <table id="example1" class="table table-bordered table-striped dataTable">
    	<thead>
        	<tr>
            	<th>Staff ID</th>
                <th>Access Code No</th>
                <th>Staff Name</th>
                <th>In Time</th>
                <th>Out Time</th>
                <th>Working Hrs</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
		<?php
		//echo "<pre>";print_r($staff_attendance);
		
        foreach($staff_attendance as $val)
        {
            ?>
            <tr>
            	<td>
					<?=$val['staff_id']?>
                    <input type="hidden"  class="staff_id" value="<?=$val['staff_id']?>" />
                </td>
                <td>
					<?=$val['access_card_no']?>
                    <input type="hidden" class="access_card_no" value="<?=$val['access_card_no']?>" />
                </td>
                <td><?=ucfirst($val['staff_name'])?></td>
                <td class="in_div">
                	<?php
						$in_time=0;
                    	if(isset($val['in_time'][0]['time']) && !empty($val['in_time'][0]['time']))
						{
							 $in_time=$val['in_time'][0]['time'];
							 echo date('d-m-Y h:i',strtotime($in_time));
							 ?>
                             <input type="hidden" class='date_class mandatory in_time' value="<?=date('h:i',strtotime($in_time))?>"  placeholder="in time missing"  name="date" />
                             <?php
						}
						else
						{
							?>
                            	<input type="text" class='date_class mandatory in_time'  placeholder="in time missing"  name="date" />
                            <?php
						}
					?>
                </td>
                <td  class="out_div">
                	<?php
						$out_time=0;$set=0;
                    	if(isset($val['out_time'][0]['time']) && !empty($val['out_time'][0]['time']))
						{
							$out_time=$val['out_time'][0]['time'];
							if($out_time==$in_time)
							{
								$set=1;
								?>
                                <input type="text" class='date_class mandatory out_time'  placeholder="out time missing"  name="date" />
                                <?php
							}
							else
							{
								echo date('d-m-Y h:i',strtotime($out_time));
							}
						}
						else
						{
							?>
                            	<input type="text" class='date_class mandatory out_time' placeholder="out time missing" name="date" id="join_date"/>
                            <?php
						}
					?>
                </td>
                <td class="diff_time">
                	<?php
						$ii=0;
						if($set==0 && $out_time!='' && $in_time!='')
						{
							$ii=1;
							$date_1=$in_time;
							$date_2=$out_time;
							$datetime1 = date_create($date_1);
							$datetime2 = date_create($date_2);
							$interval = date_diff($datetime1, $datetime2);
							echo  $interval->format('%h:%i');
						}
						else
							echo '-';
					?>
                </td>
                <td>
                	<?php
                    	if($ii==0)
						{
					?>
                	<input type="button" class="btn btn-success add_time btn-sm" value="Update"/>
                    <?php
						}
					?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
	</table>
	<?php
}
?>
<script>
		
			$('.add_time').live('click',function(){
				var this_val=$(this);
				var in_t=$(this).closest('tr').find('.in_time').val();
				var out_t=$(this).closest('tr').find('.out_time').val();
				var id=$(this).closest('tr').find('.staff_id').val();
				var card_no=$(this).closest('tr').find('.access_card_no').val();
				var date=$('#st_date').val();
				var formate_date=$('#formate_date').val();
				var diff_time=$(this).closest('tr').find('.diff_time');
				var in_div=$(this).closest('tr').find('.in_div');
				var out_div=$(this).closest('tr').find('.out_div');
				if(in_t!='' && out_t!='')
				{
					$.ajax({	
					  url:BASE_URL+"staff_attendence/update_staff_attendance",
					  type:'GET',
					  data:{ 
								in_time :date+' '+in_t,
								out_time:date+' '+out_t,
								staff_id:id,
								access_card_no:card_no,
								st_date:date,
								
						   },
					  success:function(result){
						 diff_time.html(result);
						 in_div.html(formate_date+' '+in_t);
						 out_div.html(formate_date+' '+out_t);
						this_val.css('display','none');
					  }    
					});
				}
			});
</script>

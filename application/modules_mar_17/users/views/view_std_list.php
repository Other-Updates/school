<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<br />
<div class="page-title"><span>Eligibility Students</span></div>
<br />
<div>
<table id='app_table' class="table demo my_table_style">
<thead>
	<tr>
    	<th>Image</th>
        <th>Roll&nbsp;No</th>
        <th>Name</th>
        <th>Batch</th>   
        <th data-hide='phone,tablet'>Department</th>
        <th data-hide='phone,tablet'>Group</th>
        <!--<th>Contact&nbsp;No</th>-->
        <th data-hide='phone,tablet'>CGPA</th>
    </tr>
</thead>    
    <?php 
	$count=0;$count1=0;
	if(isset($mark) && !empty($mark))
	{
		
		foreach($mark as $val)
		{
			$count++;
			$per=0;
			$sum=array();
			$i=0;
			$arrear_check=0;
			foreach($val['student'] as $val1)
			{
				$sum[]=$val1['total_cgb'];
				if($val1['grade']==0)
					$arrear_check=1;
				$i++;
			}
			$per=array_sum($sum)/$i;
			if($per < $get_mark['mark'])
			{
			$count1++;	
			continue;
			}
			if($get_mark['arrear']=='yes')
			{
				if($arrear_check==1)
				continue;
			}
			?>
            	<tr>
                	<td>
                    <a href="#profile_img" data-toggle="modal"><img class="stu_thumbnail" src="<?=$this->config->item('base_url')?>profile_image/student/thumb/<?=$val['image']?>" /></a>
                    </td>
                    <td>
						<input type="hidden" name="std_id[]" class="std_id"  value="<?=$val['std_id']?>"	 />
						<?=$val['roll_no']?></td>
                    <td><?=ucfirst($val['name'])?></td>
                    <td>
						<?php	
							echo $val['from'].'-'.$val['to'];	
						?>
                    </td>
                    <td>
                    	<?php
							echo $val['department'];
						?>
                    </td>
                    <td>
                    	<?=$val['group'];?>
                    </td>
                  <!--  <td>
                    	<?php 
							//echo $val['contact_no'];
						?>
                    </td>-->
                    <td style="color:#063;font-weight:bold;">
                    	<?php 
							echo round($per,2);
						?>
                    </td>
                </tr>
                
                
            <?php 
		}
	}
	if($count1==$count)
	{
		echo "<tr><td colspan='9'>No Data Found...</td></tr>";
	}
	?>
    </table>

    <br />
    <?php
    if(isset($participate_status[0]['participation']))
	{
		if($participate_status[0]['participation']!=1)
		{
	?>
          <input type="submit" class="btn btn-primary delete" style="float:right;margin-left:10px;" value="Click to Participate" id="participate_btn" />
    <?php 
		}
	}
	?>   
     <br /> <br />
 
     </div> 
    </form>

<div id="profile_img" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-body center">
<button type="button" class="close1" data-dismiss="modal" aria-hidden="true">×</button>
<img src="<?=$this->config->item('base_url')?>profile_image/student/orginal/<?=$val['image']?>" /> 
</div>
</div>    
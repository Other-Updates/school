<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); 
?>
<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
 <link href="<?= $theme_path ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
 <script src="<?= $theme_path ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

 <script type="text/javascript">
 
 $('#reservation').daterangepicker();
   
 </script>
<style type="text/css">
@media print
{
	.bill_method,input,select,label,.feedback-panel,.hide_tr,input, .btn, #bill_div, .print_use1 {display:none;}
}
</style>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<br />
<br />
<?php
$from_page=0; 

if(isset($from) && !empty($from))
	$from_page=1; 
?>
<div style="width:100%;">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="<?=($from_page==0)?'active':''?>"><a href="#tab_1" data-toggle="tab">Eligibility Students</a></li>
            <li class="<?=($from_page==1)?'active':''?>"><a href="#tab_2" data-toggle="tab">Participated Students</a></li> 
            <li class=""><a href="#tab_3" data-toggle="tab">Placed Students</a></li> 
        </ul>
        <div class="tab-content">
            <div class="tab-pane <?=($from_page==0)?'active':''?>" id="tab_1">
<table class="table table-bordered table-striped dataTable">
<thead>
	<tr>
    	<th>Image</th>
        <th>Roll No</th>
        <th>Name</th>
        <th>Batch</th>   
        <th>Department</th>
        <th>Group</th>
        <th>Contact No</th>
        <th>CGPA</th>
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
                    <a href="#profile_img" data-toggle="modal"><img class="staff_thumbnail" src="<?=$this->config->item('base_url')?>profile_image/student/thumb/<?=$val['image']?>" /></a>
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
                    <td>
                    	<?php 
							echo $val['contact_no'];
						?>
                    </td>
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
    <p class="print_admin_use">
       <input type="button" class="btn btn-warning print_btn" style="float:right;margin-left:10px;" value="Print" id="" />
     <br /> <br />
     </p>
            </div><!-- /.tab-pane -->
            <div class="tab-pane <?=($from_page==1)?'active':''?>" id="tab_2">
             
              <table class="table table-bordered table-striped dataTable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Batch</th>   
                        <th>Department</th>
                        <th>Group</th>
                        <th>Contact No</th>
                        <th>CGPA</th>
                        <th>Action</th>
                    </tr>
                </thead>    
                    <?php 
                    if(isset($get_placement[0]['interested_std']) && !empty($get_placement[0]['interested_std']))
                    {
                        foreach($get_placement[0]['interested_std'] as $val)
                        {
                           
                            ?>
                                <tr>
                                    <td>
                                    <a href="#profile_img" data-toggle="modal"><img class="staff_thumbnail" src="<?=$this->config->item('base_url')?>profile_image/student/thumb/<?=$val['image']?>" /></a>
                                    </td>
                                    <td>
                                    
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
                                    <td>
                                        <?php 
                                            echo $val['contact_no'];
                                        ?>
                                    </td>
                                    <td style="color:#063;font-weight:bold;">
                                        <?php 
                                            echo round($val['internal_details'][0]['total_mark'],2);
                                        ?>
                                    </td>
                                     <td style="color:#063;font-weight:bold;">
                                       	<input type="button" class="btn btn-success placed_btn" id='<?=$val['placement_student_id']?>'  value="Placed" <?=($val['placed']==1)?'disabled':''?> />
                                    </td>
                                </tr>
                                
                                
                            <?php 
                        }
                    }
                    else
                    {
                        echo "<tr><td colspan='9'>No Data Found...</td></tr>";
                    }
                    
                    ?>
                    </table>
                    <p class="print_admin_use">
                       <input type="button" class="btn btn-warning print_btn" style="float:right;margin-left:10px;" value="Print" />
                     <br /> <br />
                     </p>
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
                 <table class="table table-bordered table-striped dataTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Roll No</th>
                            <th>Name</th>
                            <th>Batch</th>   
                            <th>Department</th>
                            <th>Group</th>
                            <th>Contact No</th>
                            <th>CGPA</th>
                        </tr>
                    </thead>    
                        <?php  $k=0;
                        if(isset($get_placement[0]['interested_std']) && !empty($get_placement[0]['interested_std']))
                        {
                           
                            foreach($get_placement[0]['interested_std'] as $val)
                            {
                               if($val['placed']==0)
							   {
							   		continue;
							   }
							   $k++;
                                ?>
                                    <tr>
                                        <td>
                                        <a href="#profile_img" data-toggle="modal"><img class="staff_thumbnail" src="<?=$this->config->item('base_url')?>profile_image/student/thumb/<?=$val['image']?>" /></a>
                                        </td>
                                        <td>
                                        
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
                                        <td>
                                            <?php 
                                                echo $val['contact_no'];
                                            ?>
                                        </td>
                                        <td style="color:#063;font-weight:bold;">
                                            <?php 
                                                echo round($val['internal_details'][0]['total_mark'],2);
                                            ?>
                                        </td>
                                    </tr>
                                    
                                    
                                <?php 
                            }
                        }
                        if($k==0)
                        {
                            echo "<tr><td colspan='9'>No Data Found...</td></tr>";
                        }
                        
                        ?>
                        </table>
                    <p class="print_admin_use">
                       <input type="button" class="btn btn-warning print_btn" style="float:right;margin-left:10px;" value="Print" />
                     <br /> <br />
                     </p>
            </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->
</div>
     <script type="text/javascript">
		 $('.print_btn').click(function(){
			window.print();	 
		 });
	</script>
    
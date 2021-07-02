<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
 <link href="<?= $theme_path; ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
<?php 
$user_det = $this->session->userdata('logged_in');
//echo "<pre>";print_r($list);exit;
?>
<?php /*?><h4><?php echo ucfirst($user_det['name']); ?> Time Table</h4><?php */?>
<table id="example7" class="table table-bordered table-striped dataTable">
<thead>
    	<tr>
        	<th class="tt_m">Days/Hours</th>
        	<?php 
				$this->load->model('time_table/time_table_model');
				$total_hours=$this->time_table_model->get_values_by_type('total_hours');
				/*echo "<pre>";
				print_r($total_hours);
				exit;*/
				$total_days=$this->time_table_model->get_values_by_type('total_day_order');
				/*echo "<pre>";
				print_r($total_days);
				exit;*/
				for($j=1;$j<=$total_hours[0]['details'];$j++)
				{
					?>
				   		<th><?=$j?></th>
					<?php
				}
			?>
        </tr>
</thead>
    <tbody>
			<?php 
				$k=0;$i=1;
					
				if(isset($list) && !empty($list))
				{
						/*echo "<pre>";
						echo $list[0][1]['subject_info'][0]['subject_name'];
						exit;*/	
						 //$c=count($list);
						
					foreach($list as $val)
					{
						$c=count($list);
						//echo "<pre>";print_r($val);
						if($k==0 || $k%$total_hours[0]['details']==0)
						{
						echo "<tr><td class='tt_m'>Day".$i."</td>";
						$i++;
						}
						echo "<td>";
						$r=0;
						$a=0;
							$b=0;
							$g=0;
							$d=0;
						for($j=0;$j<$c;$j++)
						{
							
						 if(isset($val[$j]['subject_info'][0]['subject_name']) && !empty($val[$j]['subject_info'][0]['subject_name']))
						 {
							 $r=1;
						$a=$val[$j]['subject_info'][0]['nick_name'];
						 }
						 if(isset($val[$j]['subject_info'][0]['department']) && !empty($val[$j]['subject_info'][0]['department']))
						 {
							 $r=1;
							$b= $val[$j]['subject_info'][0]['nickname'];
						 }
						 if(isset($val[$j]['subject_info'][0]['group']) && !empty($val[$j]['subject_info'][0]['group']))
						 {
							$r=1; 
							$g=$val[$j]['subject_info'][0]['group'];
						 }
						
						if(isset($val[$j]['subject_info'][0]['semester']) && !empty($val[$j]['subject_info'][0]['semester']))
						 {
							 $r=1;
							$d= $val[$j]['subject_info'][0]['semester'];
						 }
						 
						}
						if($r==1)
						{
						echo "<b style='color:#2E2EFE'>".$a.'<br>'."</b>"; 
						echo "<b style='color:#B43104'>".$b.'-'.$g.'<br>'."</b>";
						echo "<b style='color:#088A08'>".$d.'<br>'."</b>";
						}
						else
						{
						echo "<b style='color:#FF0000'>Free</b>";
						}
						echo "</td>";
						$k++;	
					}	
					
				}
				else
				{
					echo "<tr><td colspan='9'>No Records Found</td></tr>";
				}
			?>
    </tbody>
</table>
<p class="print_admin_use">
<br />
<input type="button" class="btn btn-primary print_btn fright"  value='Print'/>
<br /><br />
</p>
<table id="test" class="staff_table">
<?php 
if(isset($list) && !empty($list))
				{
                foreach($list as $val)
					{
						$c=count($list);
						//echo "<pre>";print_r($val);
						
						for($j=0;$j<$c;$j++)
						{
							$a=0;
							$b=0;
							$c=0;
							$d=0;
						 if(isset($val[$j]['subject_info'][0]['subject_name']) && !empty($val[$j]['subject_info'][0]['subject_name']))
						 {
							 ?>
							<tr>
                            <td width="137"><?php echo $val[$j]['subject_info'][0]['nick_name']; ?></td>
							<td width="5">:</td>
							<td class="text_bold"><?php echo $val[$j]['subject_info'][0]['subject_name']; ?></td></tr>
                            <?php
						 }
						 
						}
						
						/*echo "<b style='color:#2E2EFE'>".$a.'<br>'."</b>";
						echo "<b style='color:#B43104'>".$b.'-'.$c.'<br>'."</b>";
						echo "<b style='color:#088A08'>".$d.'<br>'."</b>";*/
						
						
						
					}	}
					?>
</table>
<style>
@media print{
	.btn
	{
		display:none;
	}	
}
</style>

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
<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>  
<link rel="stylesheet" type="text/css" media="print" href="<?= $theme_path; ?>/css/media_print.css" />
<style type="text/css">
.convert_internal{position: relative;left: 16px;}
input[type="text"]{ width:50px;}
@media print{@page {size: landscape}
.feedback-panel
{
	display:none;
}}
</style>
<input type="hidden" class="int_convert_mark" value="<?=$mark_info[0]['int_convert_mark']?>"/>
<input type="hidden" class="total_int_mark" value="<?=$mark_info[0]['total_int_mark']?>" />
<input type="hidden" class="convert_mark_model" value="<?=$mark_info[0]['model_convert_mark']?>" />
<input type="hidden" class="update_id" value="<?=$all_info[0]['id']?>" />
<table  class="staff_table_sub" style="font-size:10px; border-color:#ddd;" border="1">
<thead>
<tr>
	<th>S.No</th>
    <th>Roll No</th>
    <th>Student Name</th>
	<?php
	$fullval=explode(",", $all_info[0]['internal_total']);	
	//print_r($fullval);
		if(isset($mark_info[0]['no_internal']) && !empty($mark_info[0]['no_internal']))
		{
			$jj=0;
			for($j=1;$j<=$mark_info[0]['no_internal'];$j++)
			{
				?>
					 <th>Internal-<?=$j?>
                     <?=$fullval[$jj]?>
                     </th>
				<?php
				$jj++;
			}
		}
	?>
    <th style="display:none;">Model <?=$all_info[0]['model_total']?></h>
   	<th>Internal Total</th>
    <th style="display:none;">Model Total</th>
    <th>Assignment</th>
    <th>Attendance</th>
    <th style="display:none;">External</th>
    <th>Total</th>    
</tr>
</thead>
<?php	
	if(isset($all_student) && !empty($all_student))
	{
		$j=1;
		foreach($all_student as $val)
		{
			?>
            	<tr>
                    <td><?=$j?></td>
                    <td><?=$val['std_id']?></td>
                    <td><?=$val['name']?></td>
                   	<?php
						//print_r($val['internal_details'][0]['internals']);
						if(isset($val['internal_details'][0]['internals']))
						$intfullval=explode(",", $val['internal_details'][0]['internals']);	
						if(isset($mark_info[0]['no_internal']) && !empty($mark_info[0]['no_internal']))
						{
							$kk=0;
							for($i=1;$i<=$mark_info[0]['no_internal'];$i++)
							{
								?>
									<td>
                                    <span>
                                    	<?=$intfullval[$kk]?>					
                                        <?php 
											$convert_int=($intfullval[$kk]/$fullval[$kk])*$mark_info[0]['int_convert_mark'];
										?>
                                    	<i class="fa fa-retweet"></i>
                                       <?=round($convert_int,2)?>
                                       </span>
                                    </td>
								<?php
							$kk++;
							}
						}
					?>
                    <td style="display:none;">
                    	<?=$val['internal_details'][0]['model']?>
                                    	<i class="fa fa-retweet"></i>
                       <?=$val['internal_details'][0]['model_total']?>
                    </td>
                    <td>
                    
                    <?=$val['internal_details'][0]['internals_total']?>
                    </td>
                    <td style="display:none;">
                    <?=$val['internal_details'][0]['model_total']?>
                    </td>
                   	<?php
						$assign=array();
						if(isset($val['assignment']) && !empty($val['assignment']))
						{
							foreach($val['assignment'] as $all_val)
							{
								if($all_val['total']!=0)
								$assign[]=$all_val['score']/$all_val['total'];
							}
						}
						 $tot_hr_st = 0; 
						  $std_pr = 0;
						  $att_mark=0;
						  $this->db->select("COUNT(attendance_staff_det.id) AS hour_count");
						  //$this->db->where('attendance_stud_deta.std_id',$stud_det[0]['id']);
						  $this->db->where('attendance.semester_id',$ajax_val['select_sem']);  
						  $this->db->join('attendance','attendance.id = attendance_staff_det.attend_id');
						  $qer = $this->db->get('attendance_staff_det')->result_array();
						  //echo $this->db->last_query();
						  $tot_hrs = $qer[0]['hour_count'];   
						  
						 
						  $tot_od_ml_hrs = 0; 
						  $this->db->select("*,SUM(atten_od_ml_dates.hrs) AS hour_countl");
						  $this->db->where('atten_od_ml_dates.stud_id',$val['id']);
						  $this->db->where('atten_od_ml_std.semester_id',$ajax_val['select_sem']);
						  $this->db->where('atten_od_ml_std.stud_id',$val['id']);
						  $this->db->join('atten_od_ml_std','atten_od_ml_std.id = atten_od_ml_dates.atten_od_ml_std_id');
						  $qer = $this->db->get('atten_od_ml_dates')->result_array();
						  
						  if(isset($qer[0]['hour_countl']) && !empty($qer[0]['hour_countl'])){ $tot_od_ml_hrs = $qer[0]['hour_countl']; $att_mod = $qer[0]['atten_mode']; }else{ $tot_od_ml_hrs =0; $att_mod = 0; }  
						  
						  $this->db->select("COUNT(attendance_stud_deta.id) AS hour_count");
						  $this->db->where('attendance_stud_deta.std_id',$val['id']);
						  $this->db->where('attendance.semester_id',$ajax_val['select_sem']);  
						  $this->db->join('attendance','attendance.id = attendance_stud_deta.attend_id');
						  $qer = $this->db->get('attendance_stud_deta')->result_array();
						  
						  $tot_hr_st = $qer[0]['hour_count'];  
						  $tot_hr_st1 = $tot_hr_st + $tot_od_ml_hrs;
						  $per_tmp = $tot_hr_st1 * 100;
						  if($tot_hrs!=0)
						  $std_pr = $per_tmp / $tot_hrs; 
						  $absen_tmp_hr = $tot_hrs - $tot_hr_st; 
						  $absen_hr = ($absen_tmp_hr>0)?$absen_tmp_hr:'--';
						
						  $att_mark=($std_pr / 100)*$mark_info[0]['att_mark'];
						
					?>
                    <td>
                    <?=round(array_sum($assign),2)?>
                    </td>
                     <td>
                    <?=round($val['internal_details'][0]['attendance'],2)?>
                    </td>
                    <td style="display:none;">
                    <?=$val['internal_details'][0]['exam_mark']?>
                    </td>
                    <td>
                    <?=round($val['internal_details'][0]['total'],2)?>
                    </td>
                </tr>
            <?php
			$j++;
		}
	}
?>
</table>
 <br />
<input type="button" value='Print' class='print_time btn btn-primary fright' />
<br /><br />
<script type="text/javascript">
$(".print_time").live('click',function(){
	
	window.print();
	});
</script>
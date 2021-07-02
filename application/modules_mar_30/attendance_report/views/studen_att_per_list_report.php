<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>  
<?php
$this->db->select('details');	
$this->db->from('mas_college_det');	
$this->db->where('typ_e','total_hours');
$query['tot_hou'] = $this->db->get()->result_array();
$total_cls_hrs = $query['tot_hou'][0]['details'];

$this->db->select('*');	
$this->db->where('id',$attn_ins['batch_id']);
$query1= $this->db->get('batch')->result_array();
$batch = $query1[0]['from']."-".$query1[0]['to'];

$this->db->select('semester');	
$this->db->where('id',$attn_ins['sem_id']);
$query2= $this->db->get('semester')->result_array();
$semester = $query2[0]['semester'];

$this->db->select('department');	
$this->db->where('id',$attn_ins['dept_id']);
$query2= $this->db->get('department')->result_array();
$department = $query2[0]['department'];

$this->db->select('group');	
$this->db->where('id',$attn_ins['group_id']);
$query2= $this->db->get('group')->result_array();
$group = $query2[0]['group'];
?>
<br />
<table id="example1" class="table table-bordered table-striped dataTable" border="1">
  <tr>
    <th colspan="8" scope="col"><strong>Attendance Report</strong>&nbsp;</th>
  </tr>
  <tr>
    <th colspan="8" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th width="92" scope="col">&nbsp;</th>
    <th width="97" scope="col"><?=$batch?></th>
    <th width="98" scope="col">&nbsp;</th>
    <th width="99" scope="col"><?=$semester?></th>
    <th width="132" scope="col"><?=$department?> - <?=$group?></th>
    <th width="134" scope="col">Dates</th>
    <th colspan="2" scope="col"><?=$attn_ins['fm_date']?> To <?=$attn_ins['to_date']?></th>
  </tr>
   <tr>
    <th colspan="8" scope="col">&nbsp;</th>
  </tr>
</table>
  

<table id="example1" class="table table-bordered table-striped dataTable" border="1">
<thead>
  <tr>
    <th width="45"><strong>S.No &nbsp;&nbsp;</strong></th>
    <th width="107"><strong>Student Roll No</strong></th>
    <th width="95"><strong>Student Name</strong></th>  
    <th width="119"><strong>Worked (Hrs) :<br /> <?=$tot_hrs?> / Present (Hrs)</strong></th>
    <th width="86"><strong>Absent (Hrs)</strong></th>
    <th width="125"><strong>Worked (Days) :<br /> <?php echo $tot_hrs/$total_cls_hrs; ?> /Present (Days)</strong></th>
    <th>OD</th>
    <th>ML</th>
    <th width="67"><strong>Absent (Days)</strong></th>
    <th width="148"><strong>Total present in  %</strong> </th>     
  </tr>
</thead>  
  <?php   
/* echo "<pre>";
 print_r($attn_ins);
 exit;*/
 if($tot_hrs>0) { // this is for checking the total worked hours

 if(isset($stud_list) && !empty($stud_list))
  {
	  $i =1;
	  foreach($stud_list as $st_lit)
	  {
		$tot_hr_st = 0;	
		$std_pr = 0;
		$per_tmp = 0;
		$std_pr = 0;	
		//THIS IS FOR GETTING THE PRESENT COUNT	
		$this->db->select("COUNT(id) AS hour_count");
		if($subj_id=='all'){ $atten_wr = array('std_id'=>$st_lit['id'],'atten_mode'=>'p','date >=' =>$fm_date,'date <='=>$to_date); }else{
		$atten_wr = array('std_id'=>$st_lit['id'],'subj_id'=>$subj_id,'atten_mode'=>'p','date >=' =>$fm_date,'date <='=>$to_date);	
			}
		$qer = $this->db->get_where('attendance_stud_deta',$atten_wr)->result_array();
		$tot_hr_st = $qer[0]['hour_count'];	
		
		//THIS IS FOR GETTING THE NOT PRESENT COUNT
		$this->db->select("COUNT(id) AS hour_count");
		if($subj_id=='all'){ $atten_wr1 = array('std_id'=>$st_lit['id'],'atten_mode '=>'ml','date >=' =>$fm_date,'date <='=>$to_date); }else{
		$atten_wr1 = array('std_id'=>$st_lit['id'],'subj_id'=>$subj_id,'atten_mode '=>'ml','date >=' =>$fm_date,'date <='=>$to_date);	
			}
		$qer1 = $this->db->get_where('attendance_stud_deta',$atten_wr1)->result_array();
		$tot_ml_hrs = $qer1[0]['hour_count'];	
		
		//THIS IS FOR GETTING THE OD COUNT
		$this->db->select("COUNT(id) AS hour_count");
		if($subj_id=='all'){ $atten_wr2 = array('std_id'=>$st_lit['id'],'atten_mode'=>'od','date >=' =>$fm_date,'date <='=>$to_date); }else{
		$atten_wr2 = array('std_id'=>$st_lit['id'],'subj_id'=>$subj_id,'atten_mode'=>'od','date >=' =>$fm_date,'date <='=>$to_date);	
			}
		$qer2 = $this->db->get_where('attendance_stud_deta',$atten_wr2)->result_array();
		$tot_od_hrs = $qer2[0]['hour_count'];	
		
		$od_ml_rsh = $tot_ml_hrs + $tot_od_hrs; 						
		$tot_od_per = $tot_od_hrs + $tot_hr_st;		
		
		$per_tmp = $tot_od_per * 100;
		$std_pr = $per_tmp / $tot_hrs; 	// calculationg persentage
		$absen_tmp_hr = $tot_hrs - $tot_od_per; 
		$absen_hr = ($absen_tmp_hr>0)?$absen_tmp_hr:'--';
	  ?>
  
  <tr>
    <td><?=$i?></td>
    <td><?=$st_lit['std_id']?></td>
    <td><?=$st_lit['name']?></td>
    <td align="center"><?=$tot_hr_st?></td>
    <td align="center"><?php echo $absen_hr; ?></td>
    <td align="center"><?php echo round($tot_od_per/$total_cls_hrs,2); ?></td>
    <td align="center"><?=$tot_od_hrs?></td>
    <td align="center"><?=$tot_ml_hrs?></td>
    <td align="center"><?php if($absen_hr!='--'){ echo round($absen_hr/$total_cls_hrs,2); }else{ echo '--'; } ?></td>
    <td align="center"><?php echo round($std_pr,2); ?></td>
   </tr>
  <?php $i++; } } }else{ ?>
  <tr>
    <td colspan="10" align="center" style="color:#F00"><strong>Sorry No Data Found...!</strong></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<?php
header("Content-Type: application/force-download");
  header("Content-Type: application/octet-stream");
  header("Content-Type: application/download");
  if($attn_ins['rep_id']==1) // this is for word documents
  {
  	header("Content-Disposition: attachment; filename=\"export_".date("Y-m-d").".doc\"");
  }
  else if($attn_ins['rep_id']==2) // this is for exel documents
  {
	  header("Content-Disposition: attachment; filename=\"export_".date("Y-m-d").".xls\"");
  }
  header("Content-Transfer-Encoding: binary");
  header("Pragma: no-cache");
  header("Expires: 0");
?>


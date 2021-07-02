<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<script type="text/javascript">
	$(function() {
		$("#example1").dataTable();
		$("#example4").dataTable();
		$("#example5").dataTable();
		$("#example3").dataTable();
		$('#example2').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": false
		});
	});
</script>
<link rel="stylesheet" type="text/css" media="print" href="<?= $theme_path; ?>/css/media_print.css" /> 
<style type="text/css">
@media print{@page {size: landscape}}
.feedback-panel
{
	display:none;
}
</style>   
<?php
$this->db->select('details');	
$this->db->from('mas_college_det');	
$this->db->where('typ_e','total_hours');
$query['tot_hou'] = $this->db->get()->result_array();
$total_cls_hrs = $query['tot_hou'][0]['details'];
?>
<br />
<table id="example1" class="table table-bordered table-striped dataTable" style="font-size:11px;">
<thead>
  <tr>
    <th><strong>S.No &nbsp;&nbsp;</strong></th>
    <th><strong>Student Roll No</strong></th>
    <th><strong>Student Name</strong></th>  
    <th><strong>Worked (Hrs) :<br /> <?=$tot_hrs?> / Present (Hrs)</strong></th>
    <th><strong>Absent (Hrs)</strong></th>
    <th><strong>Worked (Days) :<br /> <?php echo $tot_hrs/$total_cls_hrs; ?> /Present (Days)</strong></th>
    <th>OD</th>
    <th>ML</th>
    <th><strong>Absent (Days)</strong></th>
    <th><strong>Total present in  %</strong> </th>     
  </tr>
</thead>  
  <?php   
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
  <tfoot>
  <tr class="print_use">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="2" align="center">Format</td>
    <td align="center">
      <select name="rep_id" id="rep_id" style="width:100px;">
        <option value="0">Select</option>
        <option value="1">MS-Word</option>
        <option value="2">MS-Excel</option>
        </select>
    </td>
    <td align="center"><form><button type="button" name="repo_bt" id="repo_bt" disabled="disabled" class="btn bg-maroon" >Report</button>&nbsp;</form></td>
  </tr>
  </tfoot>
</table>
<br />
<button type="button" name="print_bt" id="print_bt"  class="btn btn-primary fright" >Print</button>
<br /><br />



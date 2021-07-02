<?php
	$theme_path = $this->config->item('theme_locations').$this->config->item('active_template');
	$cur_date =  $this->user_auth->get_curdate();
	$cur_dat_al = date ('Y-m-d',strtotime($cur_date) );	
?>	

<table width="403" class="staff_table_sub">
<thead>
  <tr style="background-color: rgb(250, 250, 250);">
    <th width="72">S.No</th>
    <th width="72">Hour No</th>
    <th width="78">Subject</th>
    <th width="116"><input name="check_all_" type="checkbox" id="check_all_" value="" class="check_all" /><label for="check_all_">&nbsp;Check All</label></th>
   <th width="41">&nbsp;</th>
   
  </tr>
</thead>  
   <?php
  	$this->db->select('id');		
	$this->db->where('std_id',$ids['rol_no']); 
	$sud_id = $this->db->get('student')->result_array();
	$re_arr  = explode(",",$ids['date_vl']);
	$date = $re_arr [0]; $atten_id = $re_arr[1];	
	
	$this->db->select('attendance_staff_det.*,subject_details.*');	
		$this->db->select('attendance_staff_det.id as atten_stf_id');			
	$this->db->where('attendance_staff_det.attend_id',$atten_id);$this->db->where('attendance_staff_det.date',$date); 
	$this->db->join('subject_details','subject_details.id = attendance_staff_det.subj_id');
	$stf_att_dte = $this->db->get('attendance_staff_det')->result_array();
	/*echo "<pre>";		
		print_r($stf_att_dte);
		exit;*/
			
	$j=1;
	foreach($stf_att_dte as $stf_vl)
	{
		$this->db->select('*');
		$ge_wr = array('std_id'=>$sud_id[0]['id'],'attend_id'=>$stf_vl['attend_id'],'date'=>$stf_vl['date'],'hours_no'=>$stf_vl['hours_no']);		
		$nu_rws = $this->db->get_where('attendance_stud_deta',$ge_wr)->num_rows();
		//echo $nu_rws;
		if($nu_rws<1)
		{			
	?>    
  <tr>
    <td ><?=$j?></td>
    <td ><?=$stf_vl['hours_no']?></td>
    <td ><?=$stf_vl['subject_name']?></td>
    <td ><input name="selelv_<?=$j?>" id="selelv_<?=$j?>" class="sele_chk" type="checkbox" value="<?=$stf_vl['atten_stf_id']?>-<?=$stf_vl['subj_id']?>" />
    <input name="hrs_no_<?=$j?>" id="hrs_no_<?=$j?>" type="hidden" value="<?=$stf_vl['hours_no']?>" />
    </td>  
    <td><span id="texval_<?=$j?>" style="color:red; font-weight:bold;"></span></td>  
  </tr>

  <?php $j++; } }  ?>
  
</table>
<br />
<?php if($j>1){ ?>
<div class="fright">
<input name="stud_id" id="stud_id" type="hidden" value="<?=$sud_id[0]['id']?>" /> <input name="atten_id" id="atten_id" type="hidden" value="<?=$atten_id?>" />
<input name="sub_vl" id="sub_vl" value="Save" type="button" class="btn btn-primary" disabled="disabled"/><span id="val_res"></span>  
</div>
<?php } ?>
<br /><br />
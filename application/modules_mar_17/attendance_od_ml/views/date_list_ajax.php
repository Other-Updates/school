<?php
	$theme_path = $this->config->item('theme_locations').$this->config->item('active_template');
	$cur_date =  $this->user_auth->get_curdate();
	$cur_dat_al = date ('Y-m-d',strtotime($cur_date) ); 
	$get_whe = array('typ_e'=>'sem_strt_date','statu_s'=>'1');			
	$sem_strt_dt = $this->db->get_where('mas_college_det',$get_whe)->result_array();	
	$sem_str_dat = date ('Y-m-d',strtotime($sem_strt_dt[0]['details']));
	
	$date1=date_create($sem_str_dat);
	$date2=date_create($cur_dat_al);
	$diff=date_diff($date1,$date2);
	
	$tot_pre_days = $diff->format("%a");
	
	$this->db->select('details');	
	$this->db->from('mas_college_det');	
	$this->db->where('typ_e','total_hours');
	$query['tot_hou'] = $this->db->get()->result_array();
	$total_cls_hrs = $query['tot_hou'][0]['details'];
?>
<input type="hidden" value="<?=$total_cls_hrs?>" id="tot_hrs" name="tot_hrs"/>
<table class="staff_table_sub">
<thead>
  <tr style="background-color: rgb(250, 250, 250);">
    <th width="33">S.No</th>
    <th width="33">Date</th>
    <th width="41">Select</th>
   <?php /*?> <?php if($ids['leav_type']==2)
	{ ?><?php */?>
    <th width="80">No of Hrs</th>
     <th width="96">&nbsp;</th>
    <?php /*?> <?php } ?><?php */?>
  </tr>
</thead>  
   <?php
   
    if($ids['leav_type']==2)
	{
		$this->db->select('id');		
		$get_wher = array('std_id'=>$ids['rol_no']); 
		$sud_tbl_id = $this->db->get_where('student',$get_wher)->result_array();	
		
	}
   
    $j = 1;
    for($i = $tot_pre_days; $i>0; $i--){
		
	$newdate = strtotime ( '-'.$i.' day' , strtotime ( $cur_date ) ) ;
	$newdate = date ( 'd-m-Y' , $newdate );
	$newdate_al = date ('Y-m-d',strtotime($newdate) ); 
	$tot_rem_hrs = 0;
	if($ids['leav_type']==1)
	{
		$this->db->select('*');
		$get_wher = array('date'=>$newdate_al);
		$no_row = $this->db->get_where('attendance',$get_wher)->result_array();	
		//echo "<pre>";print_r($no_row);
		$atten_hrs = (isset($no_row[0]['leav_hrs']) && !empty($no_row[0]['leav_hrs']))?$no_row[0]['leav_hrs']:0;
		
		$this->db->select('COUNT(id) AS cnt_ant');		
		$get_wher1 = array('date'=>$newdate_al); 
		$no_rows1 = $this->db->get_where('attendance_staff_det',$get_wher1)->result_array();
		//echo "<pre>";print_r($no_rows1);
		if($no_rows1[0]['cnt_ant']!=0){ $tot_stf_hrs = $no_rows1[0]['cnt_ant'];}else{ $tot_stf_hrs = 0; }
		$hr_tmp = $tot_stf_hrs + $atten_hrs;
		//echo $hr_tmp;
		$tot_rem_hrs = $total_cls_hrs - $hr_tmp;
		 		
	}	
	
	if($no_row<1 || abs($tot_rem_hrs)>0)	
	{		
	?>    
  <tr>
    <td ><?=$j?></td>
    <td ><?=$newdate?></td>
    <td ><input name="selelv_<?=$j?>" id="selelv_<?=$j?>" class="sele_chk" type="checkbox" value="<?=$newdate_al?>,<?=abs($tot_rem_hrs)?>" /></td>
   <?php /*?>  <?php if($ids['leav_type']==2)
	{ ?><?php */?>
    <td><input type="text" name="lvhrs_<?=$j?>" id="lvhrs_<?=$j?>" value="<?=abs($tot_rem_hrs)?>" class="lv_hrs" onKeyPress="validatenumber(event);" disabled="disabled" <?php if($ids['leav_type']==1){ ?> readonly="readonly" <?php } ?> style="width:80px;"/></td>
    <td><span id="texval_<?=$j?>" style="color:red; font-weight:bold;"></span></td>
   <?php /*?> <?php } ?><?php */?>
  </tr>

  <?php $j++; } } ?>
  
</table>
<br />
<div class="fright">
<input name="sub_vl" id="sub_vl" value="Save" type="button" class="btn btn-primary"/><span id="val_res"></span>  
</div>
<br /><br />
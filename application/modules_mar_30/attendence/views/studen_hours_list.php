<?php 
$tot_hours = $tot_hou[0]['details'];
$dat_e_al = date("Y-m-d", strtotime($dat_e));			
 ?>
<input name="tot_hours" id="tot_hours" type="hidden" value="<?=$tot_hours?>" />
<table class="staff_table_sub attendence_style">
  <tr>
    <th colspan="3" scope="col">No.of Student Presents <i class="fa fa-angle-right"></i></th>
    
        <td width="213" align="center"><span id="pres_strth"></span> / <spna id="tot_strth"><?=$tot_stud?></span></td>
     
    </tr>
  <tr>
    <td width="37"><strong>S.No</strong></td>
    <td width="123"><strong>Student Roll No</strong></td>
    <td width="154"><strong>Student Name</strong></td>
   
        <td align="center"><input name="check_all_" type="checkbox" id="check_all_" value="" class="check_all" /><label for="check_all_">&nbsp;Check All</label></td>
     
  </tr>
  <?php   
/* echo "<pre>";
		print_r($frm_inp);
		exit;*/
  if(isset($stud_list) && !empty($stud_list))
  {
  $i =1;
  foreach($stud_list as $st_lit)
  {
  ?>
  <tr>
    <td><?=$i?></td>
    <td><?=$st_lit['std_id']?></td>
    <td><?=$st_lit['name']?></td>
    <?php
	
				
			$this->db->select('id');	
			$this->db->where('std_id',$st_lit['id']);$this->db->where('hours_no',$frm_inp['hrs_nos']);$this->db->where('date',$dat_e_al);			
			$query = $this->db->get('attendance_stud_deta')->num_rows();
				
		?>
        <td align="center"><input value="<?=$st_lit['id']?>" class="pres_" name="pres_<?=$i?>" id="pres_<?=$i?>" type="checkbox" onclick="count_pres(this.id)" <?php if($query>0){ ?> checked="checked" <?php } ?>/></td>
     <?php
	
	
	
	?>
  </tr>
  <?php $i++; } } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
       
        <td align="center"><input class="saves btn btn-primary btn-sm" disabled="disabled" name="saves_" id="saves_" type="button" value="Save Hour"/></td>
    
  </tr>
</table>

<!--THIS IS FOR SHOWING THE POP UP WHEN STAFFS ENTERS THE PWD-->

 	<a href="#stf_pwd_" id="pwd_pop_" data-toggle="modal" name="group"></a>			
	<div id="stf_pwd_" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"	align="center">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<a class="close" data-dismiss="modal" onclick="delsel_staff();">×</a>
		<h3 id="myModalLabel"></h3>
	</div>
	
	<div class="modal-body" >
    <table width="100%" border="0">
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong>Please Enter your Password</strong></td>
        <td width="2%">&nbsp;</td>
        <td><input type="password" name="stf_pwd_val_" id="stf_pwd_val_" value="" /></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><div id="res_pwd_"></div></td>
        </tr>
	</table>
      
	</div>
	<div class="modal-footer">
     <button type="button" id="pwdbut_" class="btn btn-primary">Enter</button>
		<button id="clsbut_" type="button" class="btn btn-danger" data-dismiss="modal" onclick="delsel_staff('');"><i class="fa fa-times"></i> Close</button>
	</div>
</div>
</div>
</div>

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
?>

<?php /*?><script type="text/javascript" src="<?=$theme_path; ?>/js/auto_com/jquery.js"></script><?php */?>
<script type='text/javascript' src='<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#rol_no").autocomplete("attendance_od_ml/get_sutent_list", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});
/*$('#course').live('blur',function(){
	alert($(this).val());
});*/

</script>
<?php
/*echo "<pre>";
print_r($stud_res);
exit;
*/?>
<table class="table table-bordered table-striped dataTable" id="example1">
<thead>
  <tr>
    <th>S.no</th>
    <th>Batch</th>
    <th>Department</th>
    <th>Roll No</th>
    <th>Student Name</th>
    <th>Gender</th>
    <th>Email Id</th>
    <th>Contact No</th>
    <th>Uptained Mark</th>
    <th>No of Questions Attened</th>
    <th>Time Taken</th>    
  </tr>
</thead>  
  <?php
  if(isset($stud_res) && !empty($stud_res))
  {
  $i =1;
  foreach($stud_res as $st_lit)
  {
	$this->db->select('*');
	$this->db->where('student.id',$st_lit['stud_id']);
	$this->db->join('batch','batch.id=student.batch_id');
	$this->db->join('student_group','student_group.student_id=student.id');
	$this->db->join('department','department.id=student_group.depart_id');
	$query = $this->db->get('student')->result_array();
	//echo $this->db->last_query();
	
  ?>

  <tr>
    <td><?=$i?></td>
    <td><?=$query[0]['from']?> - <?=$query[0]['to']?></td>
    <td><?=$query[0]['department']?></td>
    <td><?=$query[0]['std_id']?></td>
    <td><?=$query[0]['name'];?> <?=$query[0]['last_name'];?></td>
    <td><?=$query[0]['gender'];?></td>
    <td><?=$query[0]['email_id'];?></td>
    <td><?=$query[0]['contact_no'];?></td>
    <td><?=$st_lit['upt_mark'];?></td>
    <td><?=$st_lit['atten_ques'];?></td>
    <td><?=$st_lit['time_limt'];?></td>
  </tr>
  
  
  <?php
  $i++;
  }
  } ?>
  
  
  
  <?php
  if(isset($qus_list) && !empty($qus_list))
  {
  foreach($qus_list as $st_lit)
  {
?>   
<div id="delete_<?php echo $st_lit['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden=			        	"false" align="center">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
					<h3 id="myModalLabel">Placement Action</h3>
	</div>
                            <div class="modal-body">
                          Are You Sure Want Delete? &nbsp; <strong></strong>
                            <input type="hidden" value="<?php echo $st_lit['id']; ?>" class="id" />
                            </div>
                            <div class="modal-footer">
                            
                            <button class="btn btn-primary id delt " id="delt">Delete</button>
                            <button type="button" class="btn btn-danger "  data-dismiss="modal" id="no"><i class="fa fa-times"></i> Cancel</button>
</div>
</div>
</div>  
</div>
<?php }} ?>
</table>


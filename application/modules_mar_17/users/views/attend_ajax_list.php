<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<link href="<?= $theme_path; ?>/css/fixed_header.css" rel="stylesheet" type="text/css" />
<?php
$this->db->select('details');	
$this->db->from('mas_college_det');	
$this->db->where('typ_e','total_hours');
$query['tot_hou'] = $this->db->get()->result_array();
$total_cls_hrs = $query['tot_hou'][0]['details'];
if(isset($att_det['day_list']) && !empty($att_det['day_list']))
{
?>
<div>Note * : <span class="green">P : Present</span>, <span class="purple">NT : Attendance Not Taken</span>, <span class="red">A : Absent</span>, <span class="maroon">ML : Medical Leave</span>, <span class="navy">OD : On Duty</span></div>
<div class="fixed-table-container sort-decoration">
<div class="fixed-table-container-inner">
<table class="table demo my_table_style" id="tablesorter-demo">
<thead>
   <tr height="0" style="background-color: #F1F1F1;">
    <th class="first"><div class="th-inner one">&nbsp;&nbsp;&nbsp;#<br />&nbsp;</div></th>
    <th width="350" style="text-align:center"><div class="th-inner">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date<br />&nbsp;</div></th>
    <th width="100"><div class="th-inner">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Day<br />&nbsp;</div></th>
    <th width="400"><div class="th-inner">&nbsp;&nbsp;Day&nbsp;Type<br />&nbsp;</div></th>
    <?php for($i=1;$i<=$total_cls_hrs;$i++){?>
    <th><div class="th-inner">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$i?><br/>&nbsp;&nbsp;Hour</div></th>
	<?php } ?>
  </tr>
</thead>  

  <?php
  /*echo "<pre>";	
		print_r($att_det['day_list']);*/
		//exit;
 $sem_id = $att_det['stud_details']['sem_id'];
 $std_id = $att_det['stud_details'][0]['id'];	
  $j =1;
  foreach($att_det['day_list'] as $dts)
  {	
   $aten_day = date("l",strtotime($dts['date'])); 
   $att_md = ($dts['atten_mod']=='h')?'Holiday':''; 
   $lev_hrs = $total_cls_hrs - $dts['leav_hrs'];   
   ?>
   <tr>
    <td scope="col"><?=$j?></td>
    <td scope="col"><?=date('d-m-Y',strtotime($dts['date']))?></td>
    <td scope="col"><?=$aten_day?></td>
    <td scope="col"><?=$att_md?></td>
    <?php for($i=1;$i<=$total_cls_hrs;$i++)
	{
		$font_cl ='';
		$where_cons = array('attend_id'=> $dts['id'],'hours_no'=>$i);		
		$nu_rows = $this->db->get_where('attendance_staff_det',$where_cons)->num_rows(); 
		if($nu_rows>0)
		{	
			$where_con = array('attend_id'=> $dts['id'],'std_id'=>$std_id,'hours_no'=>$i);		
			$nu_row = $this->db->get_where('attendance_stud_deta',$where_con)->num_rows(); 
			$det_data =  $this->db->get_where('attendance_stud_deta',$where_con)->result_array(); 
			if($nu_row>0)
			{
				$prn_vl = $det_data[0]['atten_mode']; if($det_data[0]['atten_mode']=='p'){ $font_cl = 'color:green;'; }else if($det_data[0]['atten_mode']=='od'){ $font_cl = 'color:#007DFF;'; }else if($det_data[0]['atten_mode']=='ml'){ $font_cl = 'color:#85144b;'; }
				
				if($dts['atten_mod']=='h') { $prn_vl = ''; }
			}
			else
			{
				$prn_vl = 'A'; $font_cl = 'color:red';
			}
		}
		else if($dts['atten_mod']=='h') { $prn_vl = ''; }
		else
		{	
			$prn_vl = ($lev_hrs<$i)?'H':'NT'; $font_cl = ($lev_hrs<$i)?'':'#932ab6';			
		}
		
		?>
    
    <th width="100" scope="col" style="text-transform:uppercase;<?=$font_cl?>"><?=$prn_vl?></th>
    
	<?php } ?>
  </tr>
  <?php $j++; } ?>
</table>
</div>
</div>
<p class="user_print_use">
<input type="button"  class='btn btn-primary print_btn right' value="Print" /> 
</p>
<?php  }else{ echo "Sorry No Data Found...!"; } ?>
<script type="text/javascript">
$(document).ready(function(){
	$('.print_btn').click(function(){
		window.print();	
	});	
});
</script>

<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');
//echo "<pre>";
//print_r($fees_info);
?>
		<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
        <br />
        <div class="fees_tit">Student Details</div>
        <input type="hidden" name="roll_no" value="<?=$trans_info[0]['std_id']?>" class="rol_no" />
<table class="staff_table">
	<tr>
    <td width="252">Student Name</td><td width="10">:</td><td class="text_bold" width="400"><?=$trans_info[0]['name']?></td>
    <td rowspan="4" style="text-align:center;">
    
    <a href="#profile_img" data-toggle="modal"><img class="add_staff_thumbnail" src="<?=$this->config->item('base_url')?>profile_image/student/orginal/<?=$trans_info[0]['image']?>" /></a>
    </td>
    </tr>
    <tr><td>Batch</td><td>:</td><td class="text_bold"><?=$trans_info[0]['from'].'-'.$trans_info[0]['to']?></td></tr>
    <tr><td>Department</td><td>:</td><td class="text_bold"><?=$trans_info[0]['department'].'-'.$trans_info[0]['group']?></td></tr>
    <tr><td>Email Id</td><td>:</td><td class="text_bold"><?=$trans_info[0]['email_id']?></td></tr>
    <tr><td>&nbsp;</td><td></td><td width="10"></td>
    <td><a href="#history_<?=$trans_info[0]['std_id']?>" data-toggle="modal" title="In-Active records" data-original-title="View" name="group" class="btn btn-danger btn-sm">Payment History</a>
    <input type="button" id='print_fees_<?=$trans_info[0]['std_id']?>' class="btn bg-maroon btn-sm print_btn_trans" value="View" /></td></tr>
</table>

<?php 
	if(isset($trans_student) && !empty($trans_student))
	{ 
		foreach($trans_student as $val)
		{
			?>
			<div id="history_<?=$val['std_roll_num']?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
			<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
					<a class="close" data-dismiss="modal">×</a>
			   <h3 id="myModalLabel">Payment History</h3>
			  </div>
			  <div class="modal-body">
              <table class="staff_table_sub">
              <thead>
              	<tr>
                	<th>Paid Date</th>
                    <th>Route</th>
                    <th>Stage</th>
                    <th>Period</th>
                    <th>Amount</th>
                    <th>Payment Mode</th>
                </tr>
               </thead> 
                            <tr>
                                <td><?=date('d-m-Y',strtotime($val['created_date']))?></td>
                                <td><?=$val['root_name']?>=><?=$val['source']?></td>
                                <td><?=$val['stage_name']?></td>
                                <td><?=$val['date_from']?>=<?=$val['date_from']?></td>
                                <td><?=$val['t_amount']?></td>
                               <?php /*?> <td><?=$p_mode?></td><?php */?>
                            </tr>
                      	
                <!--<tfoot>
                	<tr>
                	<th>Total</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </tfoot>-->
             </table>
             	<?php 
					if(isset($val['edit_amt']) && !empty($val['edit_amt']))
					{
						?>
                        	<table class="staff_table_sub">
                            	<thead>
                                <tr>
                                	<th colspan="2">Amount Modified</th>
                                </tr>
                                </thead>
                                <tr>
                                	<td>Amount</td>
                                    <td><?=$val['edit_amt'][0]['amount']?></td>
                                </tr>
                                 <tr>
                                	<td>Reason</td>
                                    <td><?=$val['edit_amt'][0]['reason']?></td>
                                </tr>
                            </table>
                        <?php
								$n_val=$val['edit_amt'][0]['amount'];
					}
				?>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
			  </div>
			  </div>
			  </div>
			</div>
<?php
		}
	}
?>

<div id="profile_img" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<a class="close" data-dismiss="modal">×</a>
<h3 id="myModalLabel">Profile Image</h3>
</div>
<div class="modal-body">
<img src="<?=$this->config->item('base_url')?>profile_image/student/orginal/<?=$fees_info[0]['image']?>" width="50%" />
</div>
</div>
</div>
</div>
<script type="text/javascript">
$('.print_btn_trans').live('click',function(){
	roll_no =$('.rol_no').val();
	//alert(roll_no);
	/*f_arr=$(this).attr('id').split("_");
	fees_info_id=f_arr[2];
	roll_no   	=$('#roll_no_'+f_arr[2]).val();
	exam_type	=$('#exam_type_'+f_arr[2]).val();	*/
	window.open(
		BASE_URL+'transport/fees_details/'+roll_no, 'Fees Deatails', 'height=500,width=700,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes');	 
});
</script>
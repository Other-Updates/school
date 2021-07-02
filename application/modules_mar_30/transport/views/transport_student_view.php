<br />
<div id="view_tabel">
<table id="example3" class="table table-bordered table-striped view">
<thead>
	<tr>
    	<th>S.No</th>
        <th>Bus No</th>
        <th>Stage</th>
        <th>Route</th>
        <th>Bus fare/Year</th>
        <th>Term For</th>
        <th>Term Fees</th>
        <th>Fine</th>
        <th>Excess</th>
        <th>Balance</th>
        <th>Amount Paid</th>
        <th>Payment Period</th>
        <th>Payment Date</th>
        <th>Action</th>
    </tr>
</thead>    
    <?php 
	//echo "<pre>"; print_r($advance); exit;
		if(isset($transport_list) && !empty($transport_list))
		{	
			$i=1;
			foreach($transport_list as $val)
			{
				?>
                <tr>
                    <td><?=$i?></td>
                     <td><?=$val['bus_no']?></td>
                    <td><?=$val['stage']?></td>
                    <td><?=$val['route_id']?></td>
                    <td><?=$val['amount_id']?></td>
                    <td><?php if($val['f_days']==1){ echo "6 Months"; } else { echo " 1 Year";} ?></td>
                    <td><?=$val['period_amount']?></td>
                    <td><?=$val['get_fine']?></td>
                    <td><?=$val['excess']?></td>
                    <td><?=$val['balz']?></td> 
                    <td><?=$val['total']?></td>
                    <td style="color:blue;">(<?php echo $val['date_from'].'-';
					switch($val['fdate'])
					{
						case 1:
						echo "Jan";
						break;
						case 2:
						echo "Feb";
						break;
						case 3:
						echo "Mar";
						break;
						case 4:
						echo "Apr";
						break;
						case 5:
						echo "May";
						break;
						case 6:
						echo "Jun";
						break;
						case 7:
						echo "Jul";
						break;
						case 8:
						echo "Aug";
						break;
						case 9:
						echo "Sep";
						break;
						case 10:
						echo "Oct";
						break;
						case 11:
						echo "Nov";
						break;
						case 12:
						echo "Dec";
						break;
						default:
						echo "";
						break;
					}
					?>) <span style="color:black;">To</span> (<?php echo $val['date_to'].'-';
					switch($val['tdate'])
					{
						case 1:
						echo "Jan";
						break;
						case 2:
						echo "Feb";
						break;
						case 3:
						echo "Mar";
						break;
						case 4:
						echo "Apr";
						break;
						case 5:
						echo "May";
						break;
						case 6:
						echo "Jun";
						break;
						case 7:
						echo "Jul";
						break;
						case 8:
						echo "Aug";
						break;
						case 9:
						echo "Sep";
						break;
						case 10:
						echo "Oct";
						break;
						case 11:
						echo "Nov";
						break;
						case 12:
						echo "Dec";
						break;
						default:
						echo "";
						break;
					}
					?>)</td>
                    <td style="color:blue;"><?=date('d-M-Y',strtotime($val['created_on']))?></td>
                    <td>
                        <a href="#history_<?=$val['id']?>" data-toggle="modal" data-original-title="View" name="group" class="btn bg-maroon btn-sm">View</a>
            <a href="<?=$this->config->item('base_url').'transport/update_student_transport/'.$val['std_reg'].'/'.$val['id'];?>" 
            title="Edit" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>                       
                    </td>
                </tr>
                <?php
				$i++;
			}	
		}
	?>
</table>
</div>
</br>

  <!--POPUP VIEW PERPOSE-->
<?php 
	if(isset($transport_list) && !empty($transport_list))
	{
		foreach($transport_list as $val)
		{ 
			?>
			<div id="history_<?=$val['id']?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
			<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
					<a class="close" data-dismiss="modal">×</a>
			   <h3 id="myModalLabel">Payment View</h3>
			  </div>
			  <div class="modal-body">
              <table class="staff_table_sub">
              <thead>
              	<tr>
                	<th>Date</th>
                    <th>Term</th>
                    <th>Payment Mode</th>
                    <th>Amount</th>
                    <th>Bank Details</th>
                </tr>
               </thead> 
                    <tr>
                        <td><?=date('d-M-Y',strtotime($val['created_on']))?></td>
                         <td><?php if($val['f_days']==1){ echo "6 Months"; } else { echo " 1 Year";} ?></td>
                        <td><?php $val['payment_mode'];
                            if( $val['payment_mode'] != 1 )
                            {echo "Bank"; } else { echo "cash";}?></td>
                        <td><?=$val['total']?></td>
                        <td><?=$val['branch_name']?></td>
                    </tr>
                <tfoot>
                <tr>
                	<th>Total</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </tfoot>
                <?php
		}
	}
?>
             </table>
             	
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
			  </div>
			</div>
		</div>
	</div>



<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
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


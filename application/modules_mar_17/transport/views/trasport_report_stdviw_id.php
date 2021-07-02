


<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>

<style type="text/css">
@media print
{
	.btn{ display:none;}
}
table,tr,td,th{
border: 1px solid black;	
}
</style>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<div class="message-container">
<div class="message-form-content">

<div class="message-form-inner">
<?php /*?><?php 
if(isset($balance) && !empty($balance))
{
?>
    <table width="100%">
        
        <tr>
            <td>
                 Year-<?=$fees_info[0]['semester_id']?> 
            </td>
        </tr>
    </table>
<?php }?><?php */?> 

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
        <th>Payment Period</th>
        <th>Payment Type</th>
        <th>Bank Name</th>
        <th>Branch Name</th>
        <th>Cheque / DD No</th>
        <th>Amount</th>
        <th>Total</th>
        <th>Payment Date</th>
       
    </tr>
</thead>    
    <?php 
	//echo "<pre>"; print_r($advance); exit;
		if(isset($fees_info_trans) && !empty($fees_info_trans))
		{	
			$i=1;
			foreach($fees_info_trans as $val)
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
                    <td><?php if($val['payment_mode']== '1'){ echo "Cash"; } else  echo "Bank";?></td>
                    <td><?php if($val['bank_name'] == ''){echo "**"; } else {echo $val['bank_name'];}?></td>
                    <td><?php if($val['bank_dd'] == ''){echo "**"; } else {echo $val['bank_dd'];}?></td>
                    <td><?php if($val['bank_amount'] == ''){echo "**"; } else {echo $val['bank_amount'];}?></td>
                    <td><?php if($val['branch_name'] == ''){echo "**"; } else {echo $val['branch_name'];}?></td>
                   <td><?=$val['total']?></td> 
                    <td><?=date('d-M-Y',strtotime($val['created_on']))?></td>
                    
                </tr>
                <?php
				$i++;
			}	
		}
	?>
</table>
</div>
<div class="back">
   <input type="button" class="btn btn-primary print_class" value='Print' style="float:right;"/>
   <a href="<?=$this->config->item('base_url').'transport/transport_report/'?>" title="Edit"  style="float:right;" class="btn bg-red btn">Back</a>
</div>
</br>

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
         
  <script type="text/javascript">
$(document).ready(function()
{
  $('.print_class').click(function(){
	 $('#select_trans').css('display','none');   
	window.print();
	 
  });
});
</script>  				
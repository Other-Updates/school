<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>

<br />
<div class="fees_tit">Transport Payment Details</div> <?php /*?><?php print_r($stud_trans); exit;?><?php */?>
<br /> <input type="hidden" value="<?=$stud_trans[0]['std_reg']?>" id="roll_no" />
<table  class="staff_table">
	<tr>
    	<td width="273">Bus No</td>
        <td class="text_bold">
        	<?=$stud_trans[0]['bus_no']?>
        </td>
    </tr>
    <tr>
    	<td>Route Name</td>
        <td class="text_bold">
        	<?=$stud_trans[0]['route_id']?>
        </td>
    </tr>
    <tr>
    	<td>Route Amount</td>
        <td class="text_bold">
        	<?=$stud_trans[0]['amount_id']?>
        </td>
    </tr>
    <tr>
    	<td>Fine</td>
        <td class="text_bold">
        	<?=$stud_trans[0]['get_fine']?>
        </td>
    </tr>
    
    <tr>
    	<td>Fine Days</td>
        <td class="text_bold">
        	<?=$stud_trans[0]['f_days']?>
        </td>
    </tr>
    <tr>
    	<td>Transport Period</td>
        <td class="text_bold">
        	
            [<?=$stud_trans[0]['date_from']."]==[".$stud_trans[0]['date_to']?>]
        </td>
    </tr>
    <tr>
    	<td>Payment modet</td>
        <td class="text_bold">
        	<?php $stud_trans[0]['payment_mode'];
			if( $stud_trans[0]['payment_mode'] != 1 ){echo "Bank"; } else { echo "cash";}?>
        </td>
    </tr>
    <tr>
    	<td>Bank Name</td>
        <td class="text_bold">
        	<?=$stud_trans[0]['bank_name']?>
        </td>
    </tr>
    <tr>
    	<td>Branch Name</td>
        <td class="text_bold">
        	<?=$stud_trans[0]['branch_name']?>
        </td>
    </tr>
    <tr>
    	<td>Cheque / DD No</td>
        <td class="text_bold">
        	<?=$stud_trans[0]['bank_dd']?>
        </td>
    </tr>
    <tr>
    	<td>Amount Paid</td>
        <td class="text_bold">
        	<?=$stud_trans[0]['total']?>
        </td>
    </tr>
    <tr>
    	<td>Payment Date</td>
        <td class="text_bold">
        	<?=date('d-M-Y',strtotime($stud_trans[0]['created_on']))?>
        </td>
    </tr>
   
     <tr align="right"> <td><input type="button" class="btn btn-success" id='print_page' value="Print"/></td></tr>
</table>
 <script type="text/javascript">
    $(document).ready(function(){
		$('#print_page').click(function(){
			window.print();	
		});	
	});
    </script>

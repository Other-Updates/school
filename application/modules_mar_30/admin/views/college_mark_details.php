<script type="text/javascript">
$(document).ready(function(){ $("#int_det").focus(); });
</script>
<form method="post">
<table class="staff_table_sub" width="100%">
<tr>
	<td width="16%">No of Assignment</td>
	<td width="16%"><input type="text" value="<?=$int_info[0]['no_assign']?>" name='internal_details[no_assign]' id="int_det" ></td>
	<td width="3%">&nbsp;</td>
	<td width="16%">Assignment Mark</td>
	<td width="49%"><input type="text"  value="<?=$int_info[0]['assign_mark']?>" name='internal_details[assign_mark]' ></td>
</tr>
<tr>
	<td>Attendance Mark</td>
	<td><input type="text"  value="<?=$int_info[0]['att_mark']?>"  name='internal_details[att_mark]'></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td>No of Internals</td>
	<td><input type="text"  value="<?=$int_info[0]['no_internal']?>"  name='internal_details[no_internal]'></td>
    <td>&nbsp;</td>
    <td><i class="fa fa-retweet"></i> Converted To </td>
    <td><input type="text" name='internal_details[int_convert_mark]'  value="<?=$int_info[0]['int_convert_mark']?>"></td>
    
</tr>
<tr>
	<td>Total Internal Mark</td>
	<td><input type="text"   value="<?=$int_info[0]['total_int_mark']?>" name='internal_details[total_int_mark]'></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td>Model Exam</td>
	<td><input type="text"  value="<?=$int_info[0]['model_mark']?>" name='internal_details[model_mark]'></td>
    <td>&nbsp;</td> 
    <td><i class="fa fa-retweet"></i> Converted To </td>
    <td><input  value="<?=$int_info[0]['model_convert_mark']?>" type="text" name='internal_details[model_convert_mark]' ></td>
</tr>
</table>
<input type="hidden"  name='internal_details[<?=($int_info[0]['id']=='')?'added_by':'modified_by'?>]'  value="<?=$this->user_auth->get_user_id()?>">
<br />
<div class="right">
<input type="submit" class="btn btn-primary">
</div>
<br />
<br />
</form>
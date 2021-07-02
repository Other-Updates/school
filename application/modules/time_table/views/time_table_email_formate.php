<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mail Format</title>
</head>
<body>
<div class='after_email'>
<table  class='after_email' width="550" border="0" align="center" cellpadding="0" cellspacing="0"> 
<tbody>
 <tr> <td align="left" valign="top" bgcolor="#058DCE">
 <table width="483" border="0" align="center" cellpadding="0" cellspacing="0"> 
 <tbody> 
   
 <tr> 
 <td align="left" valign="top" bgcolor="#058DCE">
 <table width="520" border="0" align="center" cellpadding="0" cellspacing="0"> 
 <tbody>
 <tr height="5"></tr>
 <tr> 
 <td align="left" valign="top">
 <table width="520" border="0" align="center" cellpadding="0" cellspacing="0"> <tbody>
 <tr> 
 <td width="60" align="left" valign="top" height="50"><img src="<?php echo $theme_path?>/images/new_logo_i2.png" width="55" height="50" /></td> 
 <td width="313" valign="top"><table width="313" border="0" cellspacing="0" cellpadding="0"> <tbody><tr> <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:20px;color:#ffffff;padding-bottom:2px">iBoard</td> 
</tr> 
</tbody></table></td> </tr></tbody></table></td> </tr> 
<tr height="5"></tr> 
<tr> <td align="left" valign="top"></td> </tr> <tr> <td align="left" valign="top" bgcolor="#FFFFFF"><table width="500" border="0" align="center" cellpadding="0" cellspacing="0"> <tbody>
<tr height="10"><td></td></tr>
<tr style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-top:10px;padding-bottom:6px">
<td></td>
<td align="right">Date : <strong><?php echo date('d-M-Y')?></strong></td></tr>
<tr> <td colspan="2" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-top:10px;padding-bottom:6px"><strong>Hi <?php echo ucfirst($student['name'])?>,</strong></td> </tr>
<tr><td width="50"></td> <td align="left" valign="top">
<br />
<?php 
if($student['time_table_type']=='class_time_table')
{
	echo "Class Time Table Created";
}
if($student['time_table_type']=='class_time_table_update')
{
	echo "Class Time Table Updated";
}
if($student['time_table_type']=='other_time_table')
{
	echo $student['title'];
}
if($student['time_table_type']=='mark_details')
{
	echo 'Mark Details Added';
}
?>
<br />
</td>
</tr>
<tr><td></td><td></td></tr>
<tr>
<td colspan="2">
You can access it here at <br />
<?php echo $this->config->item('base_url').$student['links'];?>&nbsp;<br />
If you have any questions please contact us.
</td>
</tr>
<tr height="50"><td></td></tr>
</tbody>
</table>
<table width="500">
<tbody>
<tr align="right" style="font-family:Arial,Helvetica,sans-serif;font-size:12px; font-weight:bold;color:#666666;">
<td width="300"></td>
<td align="right" style="text-align:center"><?php echo $student['created_by'];?><br />College Management</td>
</tr>   
<tr> 
<td align="left" valign="top" bgcolor="#fff" height="10"></td> 
</tr> 
</tbody>
</table>
</td> 
</tr>
<tr height="10"></tr> 
<tr> 
<td align="center" valign="top" bgcolor="#058DCE" height="10" style="color:#fff; font-size:12px;">Copyright &copy; 2014 i2 Software Tech Solutions. All rights reserved.</td> 
</tr> 
<tr> 
<td align="center" valign="top" bgcolor="#058DCE" height="10" style="color:#fff; font-size:12px;">Powered by i2 Software Tech Solutions (P) LTD</td> 
</tr>
<tr height="10"></tr> 
</tbody>
</table>
</td> 
</tr>      
</tbody>
</table>
</td> 
</tr> 
</tbody>
</table>
</div>
</body>
</html>
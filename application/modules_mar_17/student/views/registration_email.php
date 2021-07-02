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
 <table width="500" border="0" align="center" cellpadding="0" cellspacing="0"> 
 <tbody>
 <tr height="5"></tr>
 <tr> 
 <td align="left" valign="top">
 <table width="445" border="0" align="center" cellpadding="0" cellspacing="0"> <tbody>
 <tr> 
 <td width="60" align="left" valign="top" height="50"><img src="<?php echo $theme_path?>/images/new_logo_i2.png" width="55" height="50" /></td> 
 <td width="313" valign="top"><table width="313" border="0" cellspacing="0" cellpadding="0"> <tbody><tr> <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:20px;color:#ffffff;padding-bottom:2px">iBoard</td> 
</tr> 
</tbody></table></td> </tr></tbody></table></td> </tr> 
<tr height="5"></tr> 
<tr> <td align="left" valign="top"></td> </tr> <tr> <td align="left" valign="top" bgcolor="#FFFFFF"><table width="530" border="0" align="center" cellpadding="0" cellspacing="0"> <tbody>
<tr height="10"><td></td></tr>
<tr align="right" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-top:10px;padding-bottom:6px"><td>Date : <strong><?php echo date('d-M-Y')?></strong></td></tr>
<tr> <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-top:10px;padding-bottom:6px"><strong><?php echo ucfirst($student['name'])?>,</strong></td> </tr>
<tr> <td align="left" valign="top">

<br />		
An access account has been created for you in iboard.<br />
<br />
You can access it here at 
<?php
if(isset($student['from']) && !empty($student['from']))
 echo $this->config->item('base_url').'admin';
else
 echo $this->config->item('base_url'); 
 
 ?><br />
<br />
Your username is: <?php echo $student['email_id'];?><br />
Your password is: <?php echo $student['pwd'];?><br />
<br />
This account will allow you to see and interact with projects. If you have any questions please contact us.<br />

</td>
<tr height="50"><td></td></tr>
<tr align="right" style="font-family:Arial,Helvetica,sans-serif;font-size:12px; font-weight:bold;color:#666666;"><td>College Management</td></tr>   
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
<td align="center" valign="top" bgcolor="#058DCE" height="10" style="color:#fff; font-size:12px;">Copyright © 2014 i2 Software Tech Solutions. All rights reserved.</td> 
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
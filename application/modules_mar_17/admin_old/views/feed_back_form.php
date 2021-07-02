<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php 
if(isset($feedback) && !empty($feedback))
{
	?>
	<table>
	<tr>
    	<td>From Email</td><td><?php echo $feedback['from']; ?></td>
    </tr>
    <tr>
    	<td>Name</td><td><?php echo $feedback['name']; ?></td>
    </tr>
    <tr>
    	<td>Feed Back</td><td><?php echo $feedback['feedback']; ?></td>
    </tr>
</table>
<?php 
}
?>
</body>
</html>
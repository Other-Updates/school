<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type='text/javascript' src='<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<form method="post">
<table >
	<tr>
    	<td width="110">Student Roll No</td>
        <td>
        	<input type="text" style="float:left;" name="roll_no" id="roll_no" autocomplete="off" />
            
            <input type="button" style="float:left;margin-left:10px; padding: 4px 10px;" id='view_std' class="btn bg-maroon" value='View' /><span id="ro1" style="color:#F00;" ></span>
        </td>
    </tr>
</table>
<div id='std_info'>
	
</div>

<script type="text/javascript">
$().ready(function() {
	$("#roll_no").autocomplete(BASE_URL+"hostel/get_student_list", {
		width: 260,
		autoFocus: true,
		matchContains: true,
		selectFirst: false
	});
});
$('#view_std').live('click',function(){
	
	var i=0;
	var roll_no=$("#roll_no").val();
	var filter=/\w+.*$/;
	//var filter=/^[A-Z0-9]+(?:[ _.-][A-Z0-9]+){1,20}$/;

	if(roll_no=="")
	{
		$("#ro1").html("Required Field");
		i=1;
	}
	else if(!filter.test(roll_no))
	{
		$("#ro1").html("Enter Valid Roll No");
		i=1;
	}
	else
	{
		$("#ro1").html("");
		
	}
	if(i==0)
	{
	$.ajax({	
	  url:BASE_URL+"hostel/student_admission",
	  type:'POST',
	  data:{ 
				roll_no:$('#roll_no').val(),
		   },
	  success:function(result){
			$('#std_info').html(result);
	  }    
	});
	}
});
$('#h_id').live('change',function(){
	$.ajax({	
	  url:BASE_URL+"hostel/get_amount_by_hostel_id",
	  type:'POST',
	  data:{ 
				h_id:$('#h_id').val(),
		   },
	  success:function(result){
			$('#amt_div').html(result);
	  }    
	});	
});
$('#edit_adv_amt').live('click',function(){
	$('#std_advance').removeAttr('readonly');
});



</script>
<!--<script>
$("#roll_no").live('blur',function()
{
	var roll_no=$("#roll_no").val();
	var filter=/[^-\s][a-zA-Z0-9-_\\s]+$/;
	if(roll_no=="")
	{
		$("#ro1").html("Required Field");
	}
	else if(!filter.test(roll_no))
	{
		$("#ro1").html("Only Numeric Alphanumeric");
	}
	else
	{
		$("#ro1").html("");
	}
});
</script>-->
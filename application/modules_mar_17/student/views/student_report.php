<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type='text/javascript' src='<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<form method="post">
<table class="print_admin_use" >
	<tr>
    	<td width="26%"></td>
    	<td width="110">Student Roll No</td>
        <td>
        	<input type="text" style="float:left;" name="roll_no" id="roll_no" autocomplete="off" />
            
            <input type="button" style="float:left;margin-left:10px; padding: 4px 10px;" id='view_std' class="btn bg-maroon" value='View' /><span id="ro1" style="color:#F00; position:relative; left:5px; top:9px;" ></span>
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
	for_loading('Loading...'); // loading notification	
	$.ajax({	
	  url:BASE_URL+"student/student_report_ajax",
	  type:'get',
	  data:{ 
				roll_no:$('#roll_no').val(),
		   },
	  success:function(result){
			$('#std_info').html(result);
			for_response('Success...!'); // resutl notification
	  }    
	});
	}
});



</script>
<script type="text/javascript">
$('#select_sem').live('change',function(){
	
	if(Number($(this).val())!=0)
	{
		for_loading('Loading...'); // loading notification	
		$.ajax({	
		  url:BASE_URL+"student/get_subject_by_sem_id",
		  type:'get',
		  data:{ 
					std_id:$('#std_id').val(),
					batch_id:$('#batch_id').val(),
					depart_id:$('#depart_id').val(),
					group_id:$('#group_id').val(),
					sem_id:$(this).val()
			   },
		  success:function(result){
				$("#subject_det").html(result);
				for_response('Success...!'); // resutl notification
		  }    
		});	
	}
		
});
$('#select_sem').live('change',function(){
if(Number($(this).val())!=0)
	{
		for_loading('Loading...'); // loading notification	
	$.ajax({	
	  url:BASE_URL+"student/get_all_internals_by_id",
	  type:'get',
	  data:{ 
	  			std_id:$('#std_id').val(),
				batch_id:$('#batch_id').val(),
				depart_id:$('#depart_id').val(),
				group_id:$('#group_id').val(),
				sem_id:$(this).val()
		   },
	  success:function(result){
			$("#internals").html(result);
			for_response('Success...!'); // resutl notification
	  }    
	});	
	}
		
});
$('#subject_id').live('change',function(){
if(Number($(this).val())!=0 && $('#select_sem').val()!=0)
{
	$('#select_sem').css('border-color','');
	for_loading('Loading...'); // loading notification	
	$.ajax({	
	  url:BASE_URL+"student/get_internal_by_subject_id",
	  type:'get',
	  data:{
		  		std_id:$('#std_id').val(),
				batch_id:$('#batch_id').val(),
				depart_id:$('#depart_id').val(),
				group_id:$('#group_id').val(), 
				subject_id:$(this).val(),
				sem_id:$('#select_sem').val()
		   },
	  success:function(result){
			$("#internals").html(result);
			for_response('Success...!'); // resutl notification
	  }    
	});	
}
else
	$('#select_sem').css('border-color','red');
		
});  

</script>
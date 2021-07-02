<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type='text/javascript' src='<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<table >
	<tr>
    	<td width="110">Student Roll No</td>
        <td>
        	<input type="text" style="float:left"name="rol_no" id="roll_no" autocomplete="off"/>
            <span id="ro1" style="color:#F00;"></span>
            <input type="button" style="float:left;margin-left:10px; padding: 4px 10px;" id='view_std' class="btn bg-maroon" value='View' />
        </td>
    </tr>
</table>
<div id='std_info'>
	
</div>

<script type="text/javascript">
$().ready(function() {
	$("#roll_no").autocomplete(BASE_URL+"hostel/get_student_list1", {
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
	if(roll_no=="")
	{
		$("#ro1").html("Required Field");
		i=1;
	}
	else if(!filter.test(roll_no))
	{
		$("#ro1").html("Enter Valid RollNo");
		i=1;
	}
	else
	{
		$("#ro1").html("");
	}
	if(i==0)
	{
	$.ajax({	
	  url:BASE_URL+"hostel/view_student_fees",
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

$('.all_room').live('change',function(){
	$('.all_room1').val('');
	$.ajax({	
	  url:BASE_URL+"hostel/get_all_seat_by_room",
	  type:'POST',
	  data:{ 
				room_id:$('.all_room').val(),
				roll_no:$("#roll_no").val()
		   },
	  success:function(result){
			$('#room_details').html(result);
	  }    
	});	
});
$('.all_room1').live('change',function(){
	$('.all_room').val('');
	$.ajax({	
	  url:BASE_URL+"hostel/get_all_seat_by_room",
	  type:'POST',
	  data:{ 
				room_id:$('.all_room1').val(),
				roll_no:$("#roll_no").val()
		   },
	  success:function(result){
			$('#room_details').html(result);
	  }    
	});	
});
$('.seat_btn').live('click',function(){
	seat_no=$(this).attr('id');
	if($('.all_room').val()=='')
		all_room=$('.all_room1').val();
	else
		all_room=$('.all_room').val();
	$.ajax({	
	  url:BASE_URL+"hostel/insert_seat",
	  type:'POST',
	  data:{ 
				room_id:all_room,
				roll_no:$('#roll_no').val(),
				user_id:$('.std_id').val(),
				seat_no:seat_no
		   },
	  success:function(result){
			$('#room_details').html(result);
	  }    
	});	
});
$('.replace_btn').live('click',function(){
	seat_no=$(this).attr('id');
	seat_id=$(this).attr('class');
	seat_arr=seat_id.split(" ");
	if($('.all_room').val()=='')
		all_room=$('.all_room1').val();
	else
		all_room=$('.all_room').val();
	$.ajax({	
	  url:BASE_URL+"hostel/replace_seat",
	  type:'POST',
	  data:{ 
				room_id:all_room,
				roll_no:$('#roll_no').val(),
				user_id:$('.std_id').val(),
				seat_id:seat_arr[4],
				seat_no:seat_no
		   },
	  success:function(result){
			$('#room_details').html(result);
	  }    
	});	
});
$('#adv_btn').live('click',function(){
	$.ajax({	
	  url:BASE_URL+"hostel/insert_advance_amt",
	  type:'POST',
	  data:{ 
				amount:$('#adv_text').val(),
				roll_no:$('#roll_no').val()
		   },
	  success:function(result){
			$('#adv_text').hide();
			$('#adv_amt').show();
			$('#adv_amt').html('Rs '+$('#adv_text').val());
			$('#adv_btn').hide();
	  }    
	});	
});
</script>
<script>
//$("#roll_no").live('blur',function()
//{
//	var roll_no=$("#roll_no").val();
//	var filter=/[^-\s][a-zA-Z0-9-_\\s]+$/;
//	if(roll_no=="")
//	{
//		$("#ro1").html("Required Field");
//	}
//	else if(!filter.test(roll_no))
//	{
//		$("#ro1").html("Only Numeric Alphanumeric");
//	}
//	else
//	{
//		$("#ro1").html("");
//	}
//});
//</script>
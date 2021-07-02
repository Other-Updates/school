<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type='text/javascript' src='<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<table >
	<tr>
    	<td width="110">Student Roll No</td>
        <td>
        	<input type="text" style="float:left"name="rol_no" id="roll_no" autocomplete="off" style="width:150px"/>
            
            <input type="button" style="float:left;margin-left:10px; padding: 4px 10px;" id='view_std' class="btn bg-maroon" value='View' />
           <br /><br /> <span id="ro1" style="color:#F00;"></span>
        </td>
    </tr>
</table>
<div id='std_info'>
	
</div>

<script type="text/javascript">
/*$('.print_btn').live('click',function(){
	f_arr=$(this).attr('id').split("_");
	fees_info_id=f_arr[2];
	roll_no   	=$('#roll_no').val();
	window.open(BASE_URL+'hostel/print_hostel_fees/'+fees_info_id+'/'+roll_no, 'height=500,width=450,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes');	 
});*/
$('.print_btn').live('click',function(){
	
	f_arr=$(this).attr('id').split("_");
	fees_info_id=f_arr[2];
	roll_no   	=$('#roll_no').val();
	 myWindow =window.open(
		BASE_URL+'hostel/print_hostel_fees/'+fees_info_id+'/'+roll_no, 'Hostel Fees Deatails', 'height=300,width=300,left=600,top=200,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes');	

});
$().ready(function() {
	$("#roll_no").autocomplete(BASE_URL+"hostel/get_student_list2", {
		width: 260,
		autoFocus: true,
		matchContains: true,
		selectFirst: false
	});
});
$('#view_std').live('click',function(){
	var i=0;
	var roll_no=$("#roll_no").val();
	var filter=/[^-\s][a-zA-Z0-9-_\\s]+$/;
	if(roll_no=="")
	{
		$("#ro1").html("Enter Student Roll No");
		i=1;
	}
	else if(!filter.test(roll_no))
	{
		$("#ro1").html("Only Numeric Alphanumeric");
		i=1;
	}
	else
	{
		$("#ro1").html("");
	}
	if(i==0)
	{
	$.ajax({	
	  url:BASE_URL+"hostel/monthly_fees_form",
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
$('.ab_class').live('keyup',function(){
	f_arr=$(this).attr('id').split("_");
	red_amt=Number($('#per_'+f_arr[1]).val())*Number($(this).val());
	net_val=Number($('#food_'+f_arr[1]).val())-red_amt;
	final_val=Number(net_val)+Number($('#fine_'+f_arr[1]).val());
	$('#net_'+f_arr[1]).html(final_val);
});
$('.save_btn').live('click',function(){
	f_arr=$(this).attr('id').split("_");
		Number($('#ab_'+f_arr[1]).val());
		Number($('#per_'+f_arr[1]).val());
		Number($('#net_'+f_arr[1]).html());
		
	$.ajax({	
	  url:BASE_URL+"hostel/insert_monthly_fees_form",
	  type:'POST',
	  data:{ 
	  			monthly_fees_id:f_arr[1],
				roll_no:$('#roll_no').val(),
				amount:Number($('#net_'+f_arr[1]).html()),
				no_of_days_ap:Number($('#ab_'+f_arr[1]).val()),
		   },
	  success:function(result){
			$('#std_info').html(result);
	  }    
	});	
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
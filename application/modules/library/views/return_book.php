<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>  
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type='text/javascript' src='<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<div class="">
<table class="table table-bordered table-striped">
    <tr>    
        <td>Book / CD / Exam paper NO</td>
        <td><input type="text" style="float:left;" name="roll_no" id="number1" autocomplete="off" /></td>
    </tr>
   
</table>
<br />
<div class="clearfix"></div>
    <div class="row" id='return_div'>
     
        
    </div>
</div>
<input type="hidden" style="float:left;" name="roll_no" id="number" autocomplete="off" />
<input type="hidden" style="float:left;" name="roll_no" id="roll_no" autocomplete="off" />
<script type="text/javascript">
$().ready(function() {
	$("#number1").autocomplete(BASE_URL+"library/get_all_library1", {
		width: 260,
		autoFocus: true,
		matchContains: true,
		selectFirst: false
	});
});

$("#return_b").live('click',function()
{
	for_loading('Loading...');
	$.ajax({
	  url:BASE_URL+"library/insert_return_book",
	  type:'GET',
	  data:{ 
	  		student_id:$('#return_user').val(),
			book_id:$('#return_book').val(),
			fine:$('#fine').val(),
			comments:$('#comments').val(),
			},
		  success:function(result)
	   	  {
			for_response('Book Returned...');
			$("#return_div").html(result);
			$('#number1').val('');
		  }   
	 });
});


</script>
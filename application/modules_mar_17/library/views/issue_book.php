<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>  
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type='text/javascript' src='<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<div class="">
<table class="table table-bordered table-striped">
	<tr>
    	<td>Student ID</td><td><input type="text" style="float:left;" name="roll_no" id="roll_no" autocomplete="off" /></td><td>Issue Date</td><td><input type="text" readonly="readonly" style="float:left;" id="issue_date" value='<?=date('d-m-Y');?>' autocomplete="off" /></td>
    </tr>
    <tr>    
        <td>Book / CD / Exam paper NO</td>
        <td><input type="text" style="float:left;" name="roll_no" id="number" autocomplete="off" /></td>
        <td>Due Date</td>
        <td><input type="text" readonly="readonly" style="float:left;" id="due_date" value='<?=date('d-m-Y', strtotime('+10 days'));?>' autocomplete="off" /></td>
    </tr>
    
    <tr>
    	<td colspan="3"></td>
        <td><input type="button" class=" btn btn-danger" id='search' value="Issue" /></td>
    </tr>
</table>
<div class="clearfix"></div><br />
<div class="row">
    <div class="col-lg-8">
    	<div class="box box-danger">
        	<div class="box-header"> <i class="fa fa-book buzz-out"></i> <h3 class="box-title">Student Books</h3></div>
            <div class="box-body" id='student_book_list'>
            	
            </div>        
        </div>    
    </div>
    <div  class="col-lg-4" >
    	<div class="box box-warning">
        	<div class="box-header"> <i class="fa fa-book buzz-out"></i>  <h3 class="box-title">Books Details</h3></div>
            <div class="box-body" id='book_info'>
            	
            </div>        
        </div>
    
    </div>
</div>
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
$().ready(function() {
	$("#number").autocomplete(BASE_URL+"library/get_all_library", {
		width: 260,
		autoFocus: true,
		matchContains: true,
		selectFirst: false
	});
});

$("#search").live('click',function()
{
	if($('#roll_no').val()=='')
	{
		$('#roll_no').css('border','1px solid red');
	}
	else if($('#number').val()=='')
	{
		$('#number').css('border','1px solid red');
	}
	else
	{
		for_loading('Loading...');
		$.ajax({
		  url:BASE_URL+"library/insert_book_issue",
		  type:'GET',
		  data:{ 
				student_id:$('#roll_no').val(),
				book_id:$('#number').val(),
				return_date:$('#due_date').val(),
				issue_date:$('#issue_date').val(),
				},
			  success:function(result)
			  {
				for_response('Book issued...');
				$("#student_book_list").html(result);
				$('#number').val('');
			  }   
		 });
	}
});


</script>
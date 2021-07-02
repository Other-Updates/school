<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>  
<div class="message-container"> 
<div class="message-form-content">
    <div class="message-form-header">
        <div class="message-form-user">
            <img src="<?=$theme_path;?>/images/icons/events/subject.png">
        </div>
        Book Search
    </div>
    <div class="message-form-inner">
     	<table class="table demo my_table_style">
        	<thead>
            <tr>
                <th>Books</th>
                <th>CD / DVD</th>
                <th>Exam Papers</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="radio"  name="search_opt" class="search_opt" value="books" checked="checked"/></td>
                <td><input type="radio"  name="search_opt" class="search_opt" value="cd"/></td>
                <td><input type="radio"  name="search_opt" class="search_opt" value="exam_papers"/></td>
            </tr>
            <tr>
                <td colspan="2"><input type="text"   class="form-control" id='search_value' style="width:100%"  /></td>
                <td><input type="button" class="btn btn-info print_btn" id='search' value="Search" /></td>
            </tr>
            </tbody>
        </table>
        <div id='result_div'>
        
        </div>
    </div>
</div>
</div>


<script type="text/javascript">
/*$().ready(function() {
	$("#roll_no").autocomplete(BASE_URL+"hostel/get_student_list", {
		width: 260,
		autoFocus: true,
		matchContains: true,
		selectFirst: false
	});
});*/
$("#search").live('click',function()
{
	var search_val='';
	$('.search_opt').each(function(){
		if($(this).attr('checked')=='checked')
		{
			search_val=$(this).val();			
		}
	});
	for_loading('Loading...');
	$.ajax({
	  url:BASE_URL+"library/search_books",
	  type:'GET',
	  data:{ 
	  		search_opt:search_val,
			search_value:$('#search_value').val()
			},
		  success:function(result)
	   	  {
			for_response('Successfully...');
			$("#result_div").html(result);
		  }   
	 });
});
$(".delete1").live('click',function()
{
	var idno=($(this).attr('id'));
  	var splitNumber = idno.split('_');
  	var id=splitNumber[1];
	
	for_loading('Loading Data Please Wait...');
	$.ajax({
	  url:BASE_URL+"library/delete_library_books",
	  type:'POST',
	  data:{ tid:id},
		  success:function(result)
	   	  {
			for_response('Data Deleted Successfully...');
			window.location.reload();
	 		//$("#table_result").html(result);
			$(".modal").css('display','none');
			$(".fade").css('display','none');
		  }   
	 });
});

</script>
<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>  
<div class="">
<table class="table table-bordered table-striped">
	<tr>
    	<td>Books</td>
        <td>CD / DVD</td>
        <td>Exam Papers</td>
    </tr>
    <tr>
    	<td><input type="radio"  name="search_opt" class="search_opt" value="books" checked="checked"/></td>
        <td><input type="radio"  name="search_opt" class="search_opt" value="cd"/></td>
        <td><input type="radio"  name="search_opt" class="search_opt" value="exam_papers"/></td>
    </tr>
    <tr>
    	<td colspan="2"><input type="text"   class="form-control" id='search_value' style="width:100%"  /></td>
        <td colspan="2"><input type="button" class="btn btn-primary" id='search' value="Search" /></td>
    </tr>
</table>
<div id='result_div'>

</div>
</div>

<script type="text/javascript">
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
</script>
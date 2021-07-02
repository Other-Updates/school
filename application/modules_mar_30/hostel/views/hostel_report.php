<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<?php 
/*echo "<pre>";
print_r($my_monthly_fees);
exit;*/
?>
<table>
	<tr>
    	<td>Hostel Name</td>
        <td>
        	<select id='h_id'>
            	<option>Select</option>
                <?php 
					if(isset($hostel_name) && !empty($hostel_name))
					{
						foreach($hostel_name as $val)
						{
							?>
                            <option value="<?=$val['id']?>"><?=$val['block']?></option>
                            <?php
						}
					}
				?>
            </select>
        </td>
    	<td>Year</td>
        <td id='year_td'>
        <select id='year'>
            	<option  value="">Select</option>
        </select>
        </td>
    	<td >Month</td>
        <td id='month_td'>
        <select id="month">
            	<option>Select</option>
        </select>
    	</td>
    	
    </tr>
</table>
<div id='fees_report'>
</div>
<script type="text/javascript">

$('#h_id').live('change',function(){
	$.ajax({	
	  url:BASE_URL+"hostel/get_year",
	  type:'POST',
	  data:{ 
				h_id:$('#h_id').val(),
		   },
	  success:function(result){
			$('#year_td').html(result);
	  }    
	});	
});
$('#year').live('change',function(){
	$.ajax({	
	  url:BASE_URL+"hostel/get_month",
	  type:'POST',
	  data:{ 
				h_id:$('#h_id').val(),
				year:$('#year').val(),
		   },
	  success:function(result){
			$('#month_td').html(result);
	  }    
	});	
});
$('#month').live('change',function(){
	$.ajax({	
	  url:BASE_URL+"hostel/get_student_list_for_report",
	  type:'POST',
	  data:{ 
				h_id:$('#h_id').val(),
				year:$('#year').val(),
				month:$(this).val()
		   },
	  success:function(result){
			$('#fees_report').html(result);
	  }    
	});	
});

</script>


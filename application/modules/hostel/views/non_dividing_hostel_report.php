<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<?php 
/*echo "<pre>";
print_r($my_monthly_fees);
exit;*/
?>
<table>
	<tr>
    	<td style="text-align:right;">Hostel Name&nbsp;&nbsp;</td>
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
    	
    	
    </tr>
</table>
<div id='fees_report'>
</div>
<script type="text/javascript">

$('#h_id').live('change',function(){
	$.ajax({	
	  url:BASE_URL+"hostel/get_non_dividing_student_report",
	  type:'get',
	  data:{ 
				h_id:$('#h_id').val(),
		   },
	  success:function(result){
			$('#fees_report').html(result);
	  }    
	});	
});

</script>


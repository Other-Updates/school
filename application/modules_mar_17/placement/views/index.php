<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
 <link href="<?= $theme_path ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
 <script src="<?= $theme_path ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
 <form method="post">
<table class='print_admin_use'>
		<tr>
        	<td width="200">Batch</td>
            <td width="250">
            	<select id='select_batch' name='batch_id' class='ajax_class mandatory'>
                    <option value="0">Select</option>
                    <?php 
                        if(isset($all_batch) && !empty($all_batch)){
                            
                            foreach($all_batch as $val1)
                            {
                                ?>
                                    <option value="<?=$val1['id']?>"><?php echo $val1['from'].'-'.$val1['to']?></option>
                                <?php 
                            }
                        }
                    ?>
                </select><span id="v1" style="color:#F00;"></span>
            </td>
        </tr>
        <tr>
        	<td width="200">Department</td>
            <td width="250">
            	<select id='depart_id' name="department" class="dep mandatory">
            	<option value="">Select</option>
				<?php 
                    if(isset($all_depart) && !empty($all_depart)){
                        foreach($all_depart as $val)
                        {
                            ?>
                                <option value="<?=$val['id']?>"><?=$val['department']?></option>
                            <?php 
                        }
                    }
                ?>
            </select><span id="v2" style="color:#F00;"></span>
            </td>
			<td align="left">
            </td>
        </tr>
        <tr>
        	<td>CGPA</td>
            <td>
            	<input type="text" name="percentage" id="percentage" class='mark mandatory'/><span id="v3" style="color:#F00;"></span>
            </td>
			<td align="left">
            	
            </td>
        </tr>
        <tr>
        	<td>Arrear Student</td>
            <td>
            	<input type="radio" class="arrear" value="yes" name="arrear" />Yes
                <input type="radio" class="arrear" value="no" checked="checked"  name="arrear"/>No
            </td>
			<td align="left">
            	<input type="button" class="btn btn-primary view_std" value="View" />
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
</table>
<div id='std_div'>
	
	
</div>
<script type="text/javascript">
$("#select_batch").live('blur',function()
{
	//alert("hi");
	var batch_id=$("#select_batch").val();
	if(batch_id=="0")
	{
		$("#v1").html("Required Field");
		$('#select_batch').css('border','1px solid #F00');
	}
	else
	{
		$("#v1").html("");
	}
});

$("#depart_id").live('blur',function()
{
	//alert("hi");
	var depart_id=$("#depart_id").val();
	if(depart_id=="")
	{
		$("#v2").html("Required Field");
	}
	else
	{
		$("#v2").html("");
	}
});
$("#percentage").live('blur',function()
{
	//alert("hi");
	var percentage=$("#percentage").val();
	if(percentage=="" || percentage==0)
	{
		$("#v3").html("Required Field");
	}
	else
	{
		$("#v3").html("");
	}
});
</script>

<script type="text/javascript">
	$('.view_std').live('click',function(){
		
		
		i=0;
		var batch_id=$("#select_batch").val();
		if(batch_id=="0")
		{
			$("#v1").html("Required Field");
			$('#select_batch').css('border','1px solid #F00');
			i=1;
		}
		else
		{
			$("#v1").html("");
		}
		var depart_id=$("#depart_id").val();
		if(depart_id=="")
		{
			$("#v2").html("Required Field");
			$('#depart_id').css('border','1px solid #F00');
			i=1;
		}
		else
		{
			$("#v2").html("");
		}
		var percentage=$("#percentage").val();
		if(percentage=="" || percentage==0)
		{
			$("#v3").html("Required Field");
			$('#percentage').css('border','1px solid #F00');
			i=1;
		}
		else
		{
			$("#v3").html("");
		}
		if(i==1)
		{
		}
		else
		{
			$('.arrear').each(function(){
			if($(this).attr('checked')=='checked')
			{
				arrear_val=$(this).val();
			}
		});
		$.ajax({	
		  url:BASE_URL+"placement/view_std_list",
		  type:'POST',
		  data:{ 
					mark:$('.mark').val(),
					depart_id:$('#depart_id').val(),
					batch_id:$('#select_batch').val(),
					arrear:arrear_val
			   },
		  success:function(result){
				$('#std_div').html(result);
		  }    
		});	
		}
	});
	$('#add_interview').live('click',function(){
		k=0;
		student_id=Array();
		$('.std_id').each(function(){
			student_id[k]=$(this).val();
			k++;
		});	
		$.ajax({	
		  url:BASE_URL+"placement/add_interview_details",
		  type:'POST',
		  data:{ 
					company_name:$('#company_name').val(),
						   venue:$('#venue').val(),
					        date:$('#reservation').val(),
					    comments:$('#company_comment').val(),
						 salary:$('#salary').val(),
						std_id:student_id
			   },
		  success:function(result){
		  }    
		});	
	});
	
</script>
<style type="text/css">
@media print{
	input
	{
		display:none;
	}
	}
</style>
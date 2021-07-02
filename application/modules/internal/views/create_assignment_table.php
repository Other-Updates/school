<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>  
<script type="text/javascript">
	$(function() {
		$("#example1").dataTable();
		$("#example4").dataTable();
		$("#example5").dataTable();
		$("#example3").dataTable();
		$('#example2').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": false
		});
	});
</script>
<style type="text/css">
.convert_internal{position: relative;left: 16px;}
</style>
<input type="hidden" class="int_convert_mark" value="<?=$mark_info[0]['int_convert_mark']?>"/>
<input type="hidden" class="total_int_mark" value="<?=$mark_info[0]['total_int_mark']?>" />
<input type="hidden" class="convert_mark_model" value="<?=$mark_info[0]['model_convert_mark']?>" />
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
	<th>S.No</th>
    <th>Roll No</th>
    <th>Student Name</th>
	<?php
		if(isset($mark_info[0]['no_assign']) && !empty($mark_info[0]['no_assign']))
		{
			for($j=1;$j<=$mark_info[0]['no_assign'];$j++)
			{
				?>
					 <th>Assignment-<?=$j?>
                     <input type="text" style="width:50px;" class='text_total total_<?=$j?>' />
                     </th>
				<?php
			}
		}
	?>
    <th>Total</th>
</tr>
</thead>

<?php	
	if(isset($all_student) && !empty($all_student))
	{
		$j=1;
		foreach($all_student as $val)
		{
			?>
            	<tr>
                    <td><?=$j?></td>
                    <td><?=$val['std_id']?></td>
                    <td><?=$val['name']?></td>
                   	<?php
						if(isset($mark_info[0]['no_assign']) && !empty($mark_info[0]['no_assign']))
						{
							for($i=1;$i<=$mark_info[0]['no_assign'];$i++)
							{
								?>
									<td>
                                    	<input type="text" style="width:50px;" class='text_int int_<?=$i?> _intval_<?=$j?>' />
                                    	<i class="fa fa-retweet convert_internal"></i>
                                        <input type="text" style="width:50px;" readonly="readonly" class='text_convert_<?=$j?> convert_<?=$i?>' />
                                    </td>
								<?php
							}
						}
					?>
                    <td>
                    	<input type="text" style="width:50px;" class='get_model modelscore_<?=$j?>' />
                                    	<i class="fa fa-retweet convert_internal"></i>
                        <input type="text" style="width:50px;" readonly="readonly" class='convertmodel_<?=$j?>' />
                    </td>
                    <td>
                    <input type="hidden" readonly="readonly" class='totalval_<?=$j?>' />
                    <input type="text" readonly="readonly" class='fulltotalval_<?=$j?>' />
                    </td>
                    <td>
                    <input type="text" readonly="readonly" class='modelfullval_<?=$j?>' />
                    </td>
                </tr>
            <?php
			$j++;
		}
	}
?>
</table>
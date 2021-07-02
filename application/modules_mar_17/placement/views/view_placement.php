<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
 <link href="<?= $theme_path ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
 <script src="<?= $theme_path ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
 <form method="post">
 <input type="hidden" value="<?=$placement_id?>"  id='placement_id' />

            	<input type="hidden" id='depart_id' value="<?=$get_placement[0]['department']?>" name="department" class="dep">
            	
          
            	<input type="hidden" name="percentage" value="<?=$get_placement[0]['percentage']?>" class='mark'/>
                
                <input type="hidden" name="batch_id" value="<?=$get_placement[0]['batch_id']?>" id='batch_id'/>
                
                <input type="hidden" name="percentage" value="<?=$get_placement[0]['arrear']?>" class='arrear'/>
                <?php 
				$this->load->model('placement/placement_model');
				$depart=$this->placement_model->get_department($get_placement[0]['department']);
				if(isset($depart) && !empty($depart))
					$deprt_name=$depart[0]['nickname'];
				else
					$deprt_name='-';	
				$batch=$this->placement_model->get_batch($get_placement[0]['batch_id']);
				if(isset($batch) && !empty($batch))
					$batch_name=$batch[0]['from'].'-'.$batch[0]['to'];
				else
					$batch_name='-';	
				?>
<table class="staff_table">
		<tr>
        	<td width="15%">Batch</td>
            <td width="1%">:</td>
            <td class="text_bold" width="15%">
            	<?=$batch_name?>
            </td>
            <td width="15%">Department</td>
            <td width="1%">:</td>
            <td class="text_bold" width="15%">
            	<?=$deprt_name?>
            </td>
            <td width="15%">Date</td>
            <td width="1%" width="15%">:</td>
            <td class="text_bold" width="15%">          
               <?=$get_placement[0]['date']?>           
            </td>
        </tr>
    	<tr>
        	<td>CGPA</td>
            <td>:</td>
            <td class="text_bold">
            	<?=$get_placement[0]['percentage']?>
            </td>
            <td>Arrear</td>
            <td>:</td>
            <td class="text_bold">
            	<?=ucfirst($get_placement[0]['arrear'])?>
            </td>
            <td></td>
            <td></td>
            <td>           
                      
            </td>
        </tr>
        <tr>
        	<td>Company Name</td>
            <td>:</td>
            <td class="text_bold">
            	<?=$get_placement[0]['company_name']?>
            </td>
            <td>venue</td>
            <td>:</td>
            <td class="text_bold">
            	<?=$get_placement[0]['venue']?>
            </td>
            <td>Salary</td>
            <td>:</td>
            <td class="text_bold">           
                <?=$get_placement[0]['salary']?>           
            </td>
        </tr>
        <tr>
        	<td>Comments</td>
            <td>:</td>
            <td colspan="7" class="text_bold"><?=$get_placement[0]['comments']?></td>
        </tr>
    </table>
<div id='std_div'>
	
	
</div>
<script type="text/javascript">
$(document).ready(function(){
	
		$.ajax({	
		  url:BASE_URL+"placement/view_page_std_list",
		  type:'POST',
		  data:{ 
					mark:$('.mark').val(),
					id:$('#placement_id').val(),
					depart_id:$('#depart_id').val(),
					batch_id:$('#batch_id').val(),
					arrear:$('.arrear').val()
			   },
		  success:function(result){
				$('#std_div').html(result);
		  }    
		});
});
	
	$('.placed_btn').live('click',function(){
		$.ajax({	
		  url:BASE_URL+"placement/update_placed_status",
		  type:'POST',
		  data:{ 
					p_std_id:$(this).attr('id'),
					mark:$('.mark').val(),
					id:$('#placement_id').val(),
					depart_id:$('#depart_id').val()
					
			   },
		  success:function(result){
			  $('#std_div').html(result)
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
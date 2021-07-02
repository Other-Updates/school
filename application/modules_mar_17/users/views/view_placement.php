<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
 <link href="<?= $theme_path ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
 <script src="<?= $theme_path ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
 <div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user">
    	<img src="<?= $theme_path; ?>/images/icons/events/placement.png">
    </div>
    Campus Interview - <?=$get_placement[0]['company_name']?>	
</div>
<div class="message-form-inner">
<?php
$user_det = $this->session->userdata('user_info');
?>
<form method="post">
 <input type="hidden" value="<?=$placement_id?>"  name='placement_id'  id='placement_id' />
 <input type="hidden" value="<?=$user_det[0]['id']?>"  name='student_id' id='student_id' />
 <input type="hidden" id='depart_id' value="<?=$get_placement[0]['department']?>" name="department" class="dep">
 <input type="hidden" name="percentage" value="<?=$get_placement[0]['percentage']?>" class='mark'/>
  <input type="hidden" name="batch_id" value="<?=$get_placement[0]['batch_id']?>" id='batch_id'/>
                
                <input type="hidden" name="percentage" value="<?=$get_placement[0]['arrear']?>" class='arrear'/>
<div class="row">
<div class="six columns view_table">
<table>
		<tr>
        	<td width="120">Department</td>
            <td width="5">:</td>
            <td class="text_bold">
            	<?php
                $depart=$this->placement_model->get_department($get_placement[0]['department']);
				if(isset($depart) && !empty($depart))
					$deprt_name=$depart[0]['nickname'];
				else
					$deprt_name='-';		
				echo $deprt_name;?>
            </td>
           
        </tr>
    	<tr>
        	<td>Company Name</td>
            <td>:</td>
            <td class="text_bold">
            	<?=$get_placement[0]['company_name']?>
            </td>           
        </tr>
        <tr>
        	<td>Date</td>
            <td>:</td>
            <td class="text_bold">          
               <?=$get_placement[0]['date']?>           
            </td>
        </tr>
    </table>
</div>
<div class="six columns view_table">
<table>
		<tr>        	
            <td width="120">CGPA</td>
            <td width="5">:</td>
            <td class="text_bold">
            	<?=$get_placement[0]['percentage']?>
            </td>
        </tr>
    	<tr>
            <td>Venue</td>
            <td>:</td>
            <td class="text_bold">
            	<?=$get_placement[0]['venue']?>
            </td>
           
        </tr>
        <tr>
        	<td>Date</td>
            <td>:</td>
            <td class="text_bold">           
                <?=$get_placement[0]['salary']?>           
            </td>
        </tr>
        
    </table>
</div>
<div class="twelve columns view_table">
<table>
		<tr>
        	<td width="120">Comments</td>
            <td width="5">:</td>
			<td class="text_bold"><?=$get_placement[0]['comments']?></td>
        </tr>
</table>        
</div>
</div>
 
<?php /*?><table  class=' table table-borded'>
		<tr>
        	<td width="10%">Department</td>
            <td  width="5%">
            	<?php
                $depart=$this->placement_model->get_department($get_placement[0]['department']);
				if(isset($depart) && !empty($depart))
					$deprt_name=$depart[0]['nickname'];
				else
					$deprt_name='-';		
				echo $deprt_name;?>
            </td>
            <td  width="8.25%">Percentage</td>
            <td  width="10%">
            	<?=$get_placement[0]['percentage']?>
            </td>
            <td  width="5%">Date</td>
            <td  width="30%">
          
               <?=$get_placement[0]['date']?>
           
            </td>
        </tr>
    	<tr>
        	<td width="10%">Company Name</td>
            <td  width="5%">
            	<?=$get_placement[0]['company_name']?>
            </td>
            <td  width="8.25%">venue</td>
            <td  width="10%">
            	<?=$get_placement[0]['venue']?>
            </td>
            <td  width="5%">Date</td>
            <td  width="30%">
           
                <?=$get_placement[0]['salary']?>
           
                                   
            </td>
        </tr>
        <tr>
        	<td colspan="6">
            	Comments<br />
                <?=$get_placement[0]['comments']?>
            </td>
        </tr>
        
    </table><?php */?>
<div id='std_div'>
	
	
</div>
</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({	
		  url:BASE_URL+"users/view_page_std_list",
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
	$('#participate_btn').live('click',function(){
		$.ajax({	
		  url:BASE_URL+"users/participate_campus",
		  type:'POST',
		  data:{ 
					placement_id:$('#placement_id').val(),
					student_id:$('#std_id').val()
			   },
		  success:function(result){
				$('#std_div').html(result);
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
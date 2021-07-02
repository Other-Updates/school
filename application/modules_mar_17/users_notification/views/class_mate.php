<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<link href="<?= $theme_path; ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/datatables/stu_data_table.css" rel="stylesheet" type="text/css" />

    <div class="message-container">
        <div class="message-form-content">
            <div class="message-form-header">
                <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/class_mate.png">
                </div>
               Classmate	
            </div>
            <div class="message-form-inner">
                <div id="back">
                	<table id="example1" class="table table-bordered table-striped" width="100%">
                    <thead>
                    	<tr>
                        	<th>S.No&nbsp;&nbsp;</th>
                        	<th>Profile Image</th>
                            <th>Roll No</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Date of Joining</th>
                        </tr>
                        </thead>
                        <?php 
						if(isset($all_student) && !empty($all_student))
						{
							$i=1;
							foreach($all_student as $val)
							{
								?>
                                <tr>
                                	<td align="center"><?=$i?></td>
                                	<td align="center">
                                    <a href="#class_mate_profile_img_<?=$val['id']?>" role="button" data-toggle="modal"><img class="stu_thumbnail" src="<?=$this->config->item('base_url')?>profile_image/student/thumb/<?=$val['image']?>"></a>
                                    
                                    </td>
                                    <td align="center"><?=$val['std_id']?></td>
                                    <td align="center"><?=strtoupper($val['name'])."&nbsp;".strtoupper($val['last_name'])?></td>
                                    <td align="center"><?=ucfirst($val['gender'])?></td>
                                    <td align="center"><?=date('d-M-Y',strtotime($val['join_date']))?></td>
                                </tr>
                                <?php
								$i++;
							}
						}
						?>
                    </table>
                </div>
            </div>
        </div>
    </div>

 
<!-- Modal -->
<?php if(isset($all_student) && !empty($all_student))
						{
							
							foreach($all_student as $val)
							{
								?>
<div id="class_mate_profile_img_<?=$val['id']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body center">
    <button type="button" class="close1" data-dismiss="modal" aria-hidden="true">×</button>
    <img src="<?=$this->config->item('base_url')?>profile_image/student/orginal/<?=$val['image']?>" width="50%">
  </div>
  </div>    
<?php }} ?>	
<!-- DATA TABES SCRIPT -->
<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		$("#example1").dataTable();
		$("#example4").dataTable();
		$("#example5").dataTable();
		$("#example3").dataTable();
		 $("#example4").dataTable();
		 $("#example5").dataTable();
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
        
<script type="text/javascript">
	$('.update_class').live('click',function(){
		a_tag=$(this);
		
		u_id=$(this).attr('id');
		$('.tr_'+u_id).css('background-color','rgb(242, 252, 242)');
		$.ajax({
		  url:BASE_URL+"users_notification/update_status",
		  type:'get',
		  data:{ 
					update_id : u_id
					
			   },
		  success:function(result){
			  	
		  }    
		});	 	
		a_tag.attr('target','_blank');
		a_tag.attr('href',BASE_URL+$('.links_'+u_id).val());
	});
</script>

<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<link href="<?= $theme_path; ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/datatables/stu_data_table.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.table-striped > tbody > tr:nth-child(odd) > td, .table-striped > tbody > tr:nth-child(odd) > th{ background-color:transparent;}
</style>
    <div class="message-container">
        <div class="message-form-content">
            <div class="message-form-header">
                <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/notes.png">
                </div>
                All Notifications		
            </div>
            <div class="message-form-inner">
                <div id="back" style="height:640px; overflow-y:auto;">
                	<table id="" class="table table-bordered table-striped" width="100%">
                    <thead>
                    	<tr style="background-color: #a0a0a0;">
                        	<th>&nbsp;S.No&nbsp;</th>
                        	<th>Staff Name</th>
                            <th>Notification</th>
                            <th width="18%">Date</th>
                            <th width="20%">Action </th>
                        </tr>
                    </thead>
                        <?php 
						if(isset($unread_notification) && !empty($unread_notification))
						{
							$i=1;
							foreach($unread_notification as $val)
							{
								if($val['read']==1)	
									$color='rgb(242, 252, 242)';
								else
									$color='rgb(255, 254, 232)';
								?>
                                <tr class="tr_<?=$val['update_id']?>" style="background-color:<?=$color?> !important">
                                	<td ><span class='s_no' id="sp_<?=$val['update_id']?>"><?=$i?></span></td>
                                	<td><?=$val['name']?></td>
                                    <td><?=$val['notification']?></td>
                                    <td><?=$val['date']?></td>
                                    <td>
                                    <input type="hidden" value="<?=$val['links']?>" class='links_<?=$val['update_id']?>'/>
                                    <a style="cursor:pointer" id="<?=$val['update_id']?>" class='update_class'>View</a>
                                    &nbsp;&nbsp;<button value="<?=$val['update_id']?>" class='remove_class btn btn-sm'>Remove</button>
                                    </td>
                                    
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
		  type:'post',
		  data:{ 
					update_id : u_id
					
			   },
		  success:function(result){
			  	
		  }    
		});	 	
		a_tag.attr('target','_blank');
		a_tag.attr('href',BASE_URL+$('.links_'+u_id).val());
	});
	$('.remove_class').live('click',function(){
		i=1;
		u_id=$(this).val();
		$('.tr_'+u_id).fadeOut(1000);
		$('#sp_'+u_id).removeAttr('class');
		$('.s_no').each(function(){
			$(this).html(i);	
			i++;
		});	
		$.ajax({
		  url:BASE_URL+"users_notification/update_remove_status",
		  type:'post',
		  data:{ 
					update_id : u_id
					
			   },
		  success:function(result){
			  	
		  }    
		});	 	
	});
</script>
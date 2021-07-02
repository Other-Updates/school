
<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<link href="<?= $theme_path; ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/datatables/stu_data_table.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.table-striped > tbody > tr:nth-child(odd) > td, .table-striped > tbody > tr:nth-child(odd) > th{ background-color:transparent;}
</style>
    <div class="message-container">
        <div class="message-form-content">
        
            <div class="message-form-inner">
                <div id="back">
                	<table class="table" width="100%">
                    <thead>
                    	<tr>
                        	<th>Staff Name</th>
                            <th>Notification</th>
                            <th>Date</th>
                            <th>Action &nbsp;&nbsp;</th>
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
                                <tr class="tr_<?php /*?><?=$val['update_id']?><?php */?>" style="background-color:<?=$color?>">
                                	
                                	<td><?=$val['name']?></td>
                                    <td><?=$val['notification']?></td>
                                    <td><?=$val['date']?></td>
                                    <td>
                                    <input type="hidden" value="<?=$val['links']?>" class='links_<?php /*?><?=$val['update_id']?><?php */?>'/>
                                    <a style="cursor:pointer" id="<?php /*?><?=$val['update_id']?><?php */?>" class='update_class btn btn-success'>View</a>
                                    	<button value="<?php /*?><?=$val['update_id']?><?php */?>" class='btn btn-warning remove_class'>Remove</button>
                                    </td>
                                    
                                </tr>
                                <?php
								$i++;
							}
						}
						else
							echo "<tr><td colspan='4'>No Notification..</td></tr>";
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
		  type:'POST',
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
		$.ajax({
		  url:BASE_URL+"users_notification/update_remove_status",
		  type:'POST',
		  data:{ 
					update_id : u_id
					
			   },
		  success:function(result){
			  	
		  }    
		});	 	
	});
</script>
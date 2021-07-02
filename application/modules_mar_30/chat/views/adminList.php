<?php session_start(); ?>
    <?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
        
<?php $_SESSION['username']= $this->user_auth->get_username(); ?>       

<!-- Chat -->        
<div id="vpb_bottom_notification_wrapper" style="display:none">
<div id="vpb_bottom_notification_header_wrapper"><i class="fa fa-comments-o"></i> Online <span id="vpb_bottom_notification_close" onClick="vpb_bottom_notification_close();"><strong>x</strong></span></div>
<div id="vpb_bottom_notification_contents">
<div class="chat_online chat1">
    <!--<div class="box-header">
    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
    <div class="btn-group" data-toggle="btn-toggle" >
    <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>    
    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
    </div>
    </div>
    </div>-->
    <div class="box-body">
    
   		<?php
  		foreach($listOfUsers->result() as $res)
		{
 		?>		
        <div class="my_chat">
        <div class="my_chat_img">
          <?php $image=$res->image;
										if($image!=""){
										 ?>
                                        <img class="staff_thumbnail" src="<?= $this->config->item('base_url').'profile_image/admin/thumb/'?><?php echo $res->image; ?>" />
                                        <?php
										}
										else
										{
											?>
							<img class="staff_thumbnail" src="<?= $this->config->item('base_url').'profile_image/admin/thumb/avatar5.png'?>" />	
										<?php
                                        }
										?>
        </div>
        <div class="chat_message">
        <p class="message1">
      <?php if($this->user_auth->get_username()==$res->name) { ?>
                   <a href="#" class="name" style="text-decoration:none"><?php echo $res->name; ?></a>
				   <?php } else { ?>  
                   <a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $res->name; ?>');">
                   <?php } ?>      
                   <?php // echo $res->name;  ?>
                                                </a>
        </p>       
        
         <?php
				   $online=$res->online_status;
				   if($online==1)
				   {
				   echo '<div class="chat_text"><i class="fa fa-square text-green"></i> Online';
                   }
				   else
				   {
					   echo '<div class="chat_text"><i class="fa fa-square text-red"></i> Offline';
				   }
				   ?>
         
         </div>
        </div>                       
        </div>
        <?php } ?>
           
    </div>
</div>
</div>
</div>
<div id="vpb_bottom_notification_header_wrapperDefault" onClick="vpb_bottom_notification_open();" class="vpb_tooltip_announcement">&nbsp;</div>
<div id="vpb_pop_up_background"></div>        

        <!-- add new calendar event modal -->

<div class="box-body table-responsive">
<table id="example1" class="table table-striped table-bordered table-hover" id="sample_2">
									<thead>
										<tr>
											<th>Image</th>
											<th>Username</th>
											<th class="hidden-480">Status</th>
										</tr>
									</thead>
									<tbody>

 					<?php
  				
  					foreach($listOfUsers->result() as $res)
					{
						
											
						
 					?>									
										<tr class="odd gradeX">
										<td>
                                        <?php $image=$res->image;
										if($image!=""){
										 ?>
                                        <img class="staff_thumbnail" src="<?= $this->config->item('base_url').'profile_image/admin/thumb/'?><?php echo $res->image; ?>" />
                                        <?php
										}
										else
										{
											?>
							<img class="staff_thumbnail" src="<?= $this->config->item('base_url').'profile_image/admin/thumb/avatar5.png'?>" />	
										<?php
                                        }
										?>
                                        
                                        </td>
											<td class="hidden-480"><?php echo $res->name; ?></td>
											<td class="hidden-480">
                                            <style>
											   .green{
												   
												background-color: #0C6;
												border-radius: 50%;
												padding: 10px;   
												   
											   }
											   .gray{
					   
													background-color:#605759;
													border-radius: 50%;
													padding: 10px;   
													   
												   }
											   .xxx{
												
												display: inline-block;
												margin-bottom: 0;
												text-align: center;
												vertical-align: middle;
												-webkit-user-select: none;
												-moz-user-select: none;
												-ms-user-select: none;
												-o-user-select: none;
												user-select: none;
															   
											   }
											   
											   </style>
                                             <?php
				   $online=$res->online_status;
				   if($online==1)
				   {
				   ?>
                   <div class="xxx green icn-only"> </div>
                   <?php
				   }
				   else
				   {
				   ?>
                   <div class="btn gray icn-only"> </div>
                   <?php } ?>
                   
			   <?php if($this->user_auth->get_username()==$res->name) { ?>
                   <a href="#" style="text-decoration:none"></a>
				   <?php } else { ?>  
                   <a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $res->name; ?>');" class="btn mini bg-purple btn-sm" ><i class="fa fa-comments-o"></i>
                   <?php } ?>      
                   <?php echo "Chat";  ?>
                                                </a>
                                            
                                            
                                            </td>
										</tr>
  <?php
 
 }
 
 ?>                                      
									</tbody>
								</table>
</div>                                
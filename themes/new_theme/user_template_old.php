<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<script type="text/javascript">
            var BASE_URL = '<?php echo $this->config->item('base_url');  ?>';
</script>
<?php 
	$this->load->model('master/master_model');
	$user_det = $this->session->userdata('user_info');
	//print_r($user_det);exit;
	$this->load->model('users/users_model');
	$student_id=$user_det[0]['id'];
	$data["all"]=$this->users_model->get_image_details($student_id);
	if(empty($user_det))
		redirect($this->config->item("base_url"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>School Management</title>
<link rel="shortcut icon" href="<?= $theme_path; ?>/images/fav.png" />
<link href="<?= $theme_path; ?>/css/student_style.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/my_style_stu.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/student_menu.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/popup_bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/ionicons.css" rel="stylesheet" type="text/css" />
<!-- start page loader -->
<link rel="stylesheet" type="text/css" media="all" href="<?= $theme_path; ?>/css/demo.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?= $theme_path; ?>/css/fakeLoader.css" />   
<link rel="stylesheet" type="text/css" media="all" href="<?= $theme_path; ?>/css/media_print_user.css" />
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/bootstrap.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.js"></script>-->
<script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.timeago.js"></script>

 <!--start loader -->
		<script src="<?= $theme_path; ?>/js/fakeLoader.js" type="text/javascript"></script>
		<script>
            $(document).ready(function(){
                $(".fakeloader").fakeLoader({
                    timeToHide:450,<!--starting 1200-->
                    bgColor:"#37474f",
                    spinner:"spinner1"
                });
            });
        </script>
<script type="text/javascript">
$(document).ready(function(){
  $(".rightMenu-title").click(function(){    
	 $("#info1").animate({height:'toggle'});"slow"});
  $(".rightMenu-title1").click(function(){    
	 $("#info2").animate({height:'toggle'});"slow"});  
}); 
</script>
<script type="text/javascript">
$(document).ready(function(){
  $("#messages_btn").click(function(){
    $(".notification1").show();
	$(".notification-container").hide();
  });
   $(".delete_btn").click(function(){
    $(".notification1").hide();
  });
   $("#messages_btn").click(function(){
    $("#messages_btn").addClass('msg_open');
  });
   $("#notifications_btn").click(function(){
    $("#messages_btn").removeClass('msg_open');
  });
  $("#messages_btn").click(function(){
    $(".menu_btn").removeClass('menu_hover_notifications');
  });
   $(".delete_btn").click(function(){
    $(".menu_btn").removeClass('msg_open');
  });
   $("#notifications_btn").click(function(){
    $(".notification1").css('display','none');
  });
  
});
</script>

<link href="<?= $theme_path; ?>/css/footable.core.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/footable-demos.css" rel="stylesheet" type="text/css" />
<script src="<?= $theme_path; ?>/js/footable.js" type="text/javascript"></script>

</head>
<body>
<div class="fakeloader"></div>
<div class="print_header">
<div class="print_header_logo"><img src="<?= $theme_path; ?>/images/kasc-sathy-logo.png" width="75"/></div>
<div class="print_header_tit">
<h2>Collage Name</h2>
<p> <strong></strong></p>
<p>Addres: <strong><br></strong></p>
</div>
</div>	
<div class="row-body topbar">
	<div class="header">
    <a href="<?=$this->config->item('base_url').'users/dashboard'?>"><div class="logo"></div><div class="logo-small"></div></a>
		<div class="search-input"><!--<input type="text" id="search" placeholder="search people, hashtags" x-webkit-speech="x-webkit-speech" onwebkitspeechchange="liveSearch();">--></div>
		
		<a href="<?=$this->config->item('base_url').'users/logout'?>"><div class="menu_btn" title="Log Out"><img src="<?= $theme_path; ?>/images/logout.png" /></div></a>
        
        <a onclick="showNotification('', '1')"><div class="menu_btn" id="notifications_btn" title="Notifications"><img src="<?= $theme_path; ?>/images/notification.png" id="notifications_img" /><span class="notify notify1 label-success notification"></span></div></a>
        <?php if($data['all'][0]['chat']==1){?>
		<a href="#"><div class="menu_btn" id="messages_btn" title="Messages"><img src="<?= $theme_path; ?>/images/message.png" /><span class="notify label-danger notify2 notification2"></span></div></a>
		<?php }?>
        <a href="<?=$this->config->item('base_url').'users/dashboard'?>"><div class="menu_btn" title="Back To Home"><img src="<?= $theme_path; ?>/images/home.png" /></div></a>
        
<div class="notification1" style="display:none">	
		<div class="notification-content">
				<div class="notification-inner">                	
					You Have <span class='notification2'></span> Unread Messages
                    <div class="delete_btn"></div>
				</div>
				<div id="notifications-content">
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu notification_list1">
                                  
                                </ul>    
                 </div>
				<div class="notification-row"><div class="notification-padding"><a href="<?= $this->config->item('base_url').'users/chat'?>">View All Messages</a></div></div>
			</div>	
</div>
        <div class="notification-container">
			<div class="notification-content">
				<div class="notification-inner">                	
					You Have <span class='notification'></span> Notifications
                    <a onclick="showNotification('close')" title="Close Notifications"><div class="delete_btn"></div></a>
				</div>
				<div id="notifications-content">
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu notification_list">
                                     
                                </ul>    
                 </div>
				<div class="notification-row"><div class="notification-padding"><a href="<?= $this->config->item('base_url').'users_notification/all_notification'?>">View All Notifications</a></div></div>
			</div>
		</div>
        
        
        
		<script type="text/javascript">
		
			setInterval(function(){
				$.getJSON(BASE_URL+'api/get_notification',function(result){
				if(result['unread_notification_count'])
				{
					$('.notify1').show();
					$('.notification').html(result['unread_notification_count'].length);
				}
				else
				{
					$('.notify1').hide();
					$('.notification').html(0);
				}
					
				if(result['get_unread_message_count'])
				{
					$('.notify2').show();
					$('.notification2').html(result['get_unread_message_count']);
				}
				else
				{
					$('.notify2').hide();
					$('.notification2').html(0);	
				}
								
				list1='';
				for(ii=0;ii<result['unread_notification'].length;ii++)
				{
					if(result['unread_notification'][ii]['read']==1)
						color='rgb(242, 252, 242)';
					else
						color='rgb(255, 254, 232)';
					if(result['unread_notification'][ii]['notification'].length>30)
						note=result['unread_notification'][ii]['notification'].substring(0, 30)+"...";
					else
						note=result['unread_notification'][ii]['notification'];		
					list1=list1+"<li style='background-color:"+color+"'><a class='all_notification "+result['unread_notification'][ii]['links']+"' id='"+result['unread_notification'][ii]['update_id']+"' ><div><div class='notify_style'><div class='notify_style1'><div class='notify_style2'><i class='fa fa-user'></i> "+result['unread_notification'][ii]['name']+"</div><div class='notify_style3'>"+result['unread_notification'][ii]['date']+"</div></div><div><div>"+note+"</div></div></div></a></li>";
				}
				if(list1=='')
					list1='No Notifications..';	
								
				$('.notification_list').html(list1);	
				
				
				
				list2='';
				for(k=0;k<result['get_unread_message'].length;k++)
				{
					if(result['get_unread_message'][k]['recd']==1)
						color='rgb(242, 252, 242)';
					else
						color='rgb(255, 254, 232)';
					if(result['get_unread_message'][k]['message'].length>30)
						msg=result['get_unread_message'][k]['message'].substring(0, 30)+"...";
					else
						msg=result['get_unread_message'][k]['message'];
									
					list2=list2+"<li style='background-color:"+color+"'><a href='"+BASE_URL+'users/chat'+"'><div><div class='notify_style'><div class='notify_style1'><div class='notify_style2'><i class='fa fa-user'></i> "+result['get_unread_message'][k]['from']+"</div><div class='notify_style3'>"+result['get_unread_message'][k]['sent']+"</div></div><div><div>"+msg+"</div></div></div></a></li>";
				}
				if(list2=='')
					list2='No Messages..';	
								
				$('.notification_list').html(list1);		
				$('.notification_list1').html(list2);				
			});
			},5000);
			
			$.getJSON(BASE_URL+'api/get_notification',function(result){
				
				if(result['unread_notification_count'])
				{
					$('.notify1').show();
					$('.notification').html(result['unread_notification_count']);
				}
				else
				{
					$('.notify1').hide();
					$('.notification').html(0);
				}
					
				if(result['get_unread_message_count'])
				{
					$('.notify2').show();
					$('.notification2').html(result['get_unread_message_count']);
				}
				else
				{
					$('.notify2').hide();
					$('.notification2').html(0);	
				}
								
				list1='';
				for(ii=0;ii<result['unread_notification'].length;ii++)
				{
					if(result['unread_notification'][ii]['read']==1)
						color='rgb(242, 252, 242)';
					else
						color='rgb(255, 254, 232)';
					if(result['unread_notification'][ii]['notification'].length>30)
						note=result['unread_notification'][ii]['notification'].substring(0, 30)+"...";
					else
						note=result['unread_notification'][ii]['notification'];		
					list1=list1+"<li style='background-color:"+color+"'><a class='all_notification "+result['unread_notification'][ii]['links']+"' id='"+result['unread_notification'][ii]['update_id']+"' ><div><div class='notify_style'><div class='notify_style1'><div class='notify_style2'><i class='fa fa-user'></i> "+result['unread_notification'][ii]['name']+"</div><div class='notify_style3'>"+result['unread_notification'][ii]['date']+"</div></div><div><div>"+note+"</div></div></div></a></li>";
				}
				if(list1=='')
					list1='No Notifications..';	
								
				$('.notification_list').html(list1);	
				
				
				
				list2='';
				for(k=0;k<result['get_unread_message'].length;k++)
				{
					if(result['get_unread_message'][k]['recd']==1)
						color='rgb(242, 252, 242)';
					else
						color='rgb(255, 254, 232)';
					if(result['get_unread_message'][k]['message'].length>30)
						msg=result['get_unread_message'][k]['message'].substring(0, 30)+"...";
					else
						msg=result['get_unread_message'][k]['message'];
									
					list2=list2+"<li style='background-color:"+color+"'><a href='"+BASE_URL+'users/chat'+"'><div><div class='notify_style'><div class='notify_style1'><div class='notify_style2'><i class='fa fa-user'></i> "+result['get_unread_message'][k]['from']+"</div><div class='notify_style3'>"+result['get_unread_message'][k]['sent']+"</div></div><div><div>"+msg+"</div></div></div></a></li>";
				}
				if(list2=='')
					list2='No Messages..';	
								
				$('.notification_list').html(list1);		
				$('.notification_list1').html(list2);				
			});
			$('.all_notification').live('click',function(){
				class_name=$(this).attr('class').split(" ");
				
				$.getJSON(BASE_URL+'api/change_read_status/'+$(this).attr('id'),function(result){
					window.location.href = BASE_URL+class_name[1];
				});
				
			});
		$(document).ready(function(){
			$('.notify1,.notify2').hide();
			});
		</script>
        
	</div>
	<div class="search-container"></div>
</div>
<div class="topbar_margin"></div>

<div class="row-body content-feed">
<div class="twelve columns three-col">
					<div class="cover-container">
						<div class="cover-content">
                        <a href="#main_cover_img" id="default.png" class="cover_img" role="button" data-toggle="modal">
							
                            <div class="cover-image">
							<div class="cover-image-style">
                            <?php
							if($data['all'][0]['cover_image']!='')
							{
							?>
                            <img src="<?= $this->config->item('base_url')?>cover_image/student/original/<?=$data['all'][0]['cover_image']?>"/>   <?php
							}
							else
							{
							?>
                            <img src="<?= $this->config->item('base_url')?>cover_image/student/original/Tulips.jpg"/>
                            <?php 
							}
							?>
							</div>
                            
                            

							</div></a>
							<div class="cover-description">
								<div class="cover-avatar-content">
									<div class="cover-avatar">
                                    
                                     <a href="#main_profile_img" id="default.png" class="profile_img" role="button" data-toggle="modal">
                                    
										<span id="avatar1ela">
										<?php
							if($data['all'][0]['image']!='')
							{
							?>
                            <img src="<?= $this->config->item('base_url')?>profile_image/student/orginal/<?=$data['all'][0]['image']?>"/>   <?php
							}
							else
							{
							?>
                            <img  src="<?= $this->config->item('base_url')?>profile_image/student/orginal/avatar5.png"/>
                            <?php 
							}
							?></span></a>
									</div>
								</div>
								<div class="cover-description-content">
									<span id="author1ela"></span><span id="time1ela"></span><div class="cover-username"><a href="<?=$this->config->item('base_url').'users/profile'?>"><?=ucfirst($user_det[0]['name'])?>  <?=ucfirst($user_det[0]['last_name'])?>  </a></div>
									<div class="cover-description-buttons"><div id="subscribe1"><a href="<?=$this->config->item('base_url').'users/profile'?>" title="Edit Profile"><div class="edit_profile_btn"></div></a></div></div>
								</div>
							</div>
						</div>
					</div>
				</div>
                <div class="three columns user_print_use three-mar">
		<div class="sidebar-container widget-welcome">
						<div class="sidebar-content">
							<div class="sidebar-header">Reg.no : <span style="font-size:12px; font-weight:bold; color: #26a69a;;"><?=$data['all'][0]['regno']?></span><?php /*?>Welcome <span><?=ucfirst($user_det[0]['name'])?></span><?php */?></div>
							<div class="sidebar-inner">
								<div class="sidebar-avatar"><?php
							if($data['all'][0]['image']!='')
							{
							?>
                            <img style="width:50;height:50" src="<?= $this->config->item('base_url')?>profile_image/student/orginal/<?=$data['all'][0]['image']?>"/>   <?php
							}
							else
							{
							?>
                            <img style="width:50;height:50"  src="<?= $this->config->item('base_url')?>profile_image/student/orginal/avatar5.png"/>
                            <?php 
							}
							?></a></div>
								<div class="sidebar-avatar-desc">
									<!--<div class="sidebar-avatar-edit">Bala</div>-->
									<div class="sidebar-avatar-edit">Roll No. <span><?=$user_det[0]['std_id']?></span></div>
                                    <div class="sidebar-avatar-edit">Batch <?=$user_det[0]['from'].'-'.$user_det[0]['to'].' '.$user_det[0]['department'].'&nbsp;-&nbsp;'.$user_det[0]['group']?></div>
								</div>
                                <div class="rightMenu-title">
                                <a href="#">Student Details <i class="fa fa-angle-double-down fright"></i></a>
                                </div>
                                <div id="info1" style=" display:none">
                                <table class="info_table">
                                <tbody>
                                <tr>
                                    <td align="left">Reg No</td>
                                    <td align="left"><?=$user_det[0]['std_id']?></td>
                                </tr>
                                <tr>
                                    <td align="left">Date Of Join</td>
                                    <td align="left"> <?=date('d-M-Y',strtotime($user_det[0]['join_date']))?></td>
                                </tr>
                                <tr>
                                    <td align="left">Stu Mobile No</td>
                                    <td align="left"> <?=$user_det[0]['contact_no']?></td>
                                </tr>
                                <tr>
                                    <td align="left">Mentor Name</td>
                                    <td align="left"> <?=ucfirst($user_det[0]['parent_name'])?> </td>
                                </tr>
                                
                            	</tbody>
                            	</table>
								<div class="shadow-B"></div>
								</div>
                                <div class="rightMenu-title1">
                                <a href="#">Personal Details <i class="fa fa-angle-double-down fright"></i></a>
                                </div>
                                <div id="info2" style=" display:none">
                                <table class="info_table">
                                <tbody>
                               
                                 <tr>
                                    <td align="left">Date Of Birth</td>
                                    <td align="left"> <?=date('d-M-Y',strtotime($user_det[0]['dob']))?></td>
                                </tr>
                                <tr>
                                    <td align="left">Nationality</td>
                                    <td align="left"><?=$user_det[0]['country']?></td>
                                </tr>
                                <tr>
                                    <td align="left">Parent No</td>
                                    <td align="left"> <?=$user_det[0]['parent_no']?></td>
                                </tr>                                
                            	</tbody>
                            	</table>
								<div class="shadow-B"></div>
								</div>
							</div>
						</div>
		  </div>
          <div class="sidebar-container widget-types">
              <div class="sidebar-content">
              	<div class="sidebar-header">Main Menu</div>
                 <ul id="nav">
                <li><a href="<?=$this->config->item('base_url').'users/dashboard'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/dashboard.png" class="rotate">--><i class="fa fa-home adm-icon"></i> Dashboard</a></li>
                <li><a href="<?=$this->config->item('base_url').'users/profile'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/profile.png" class="rotate">--><i class="fa fa-user adm-icon"></i> My Profile</a></li>
                <li><a href="<?=$this->config->item('base_url').'users/subject_view'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/subject.png" class="rotate">--><i class="fa fa-book adm-icon"></i> Subject</a></li>                
                <li><a href="#" class="sub" tabindex="1"><!--<img src="<?= $theme_path; ?>/images/icons/events/time_table.png" class="rotate">--><i class="fa fa-table adm-icon"></i> Time Table</a><img src="<?= $theme_path; ?>/images/up.png" alt="" />
                    <ul>
                        <li><a href="<?=$this->config->item('base_url').'users/time_table'?>"><i class="fa fa-angle-double-right"></i> Class Time Table</a></li>
                        <li><a href="<?=$this->config->item('base_url').'users/other_time_table'?>"><i class="fa fa-angle-double-right"></i> Internal Time Table</a></li>
                        <li><a href="<?=$this->config->item('base_url').'users/model_time_table'?>"><i class="fa fa-angle-double-right"></i> Model Time Table</a></li>
                        <li><a href="<?=$this->config->item('base_url').'users/exam_time_table'?>"><i class="fa fa-angle-double-right"></i> Exam Time Table</a></li>
                        <li><a href="<?=$this->config->item('base_url').'users/arrear_time_table'?>"><i class="fa fa-angle-double-right"></i> Arrear Time Table</a></li>
                    </ul>
                </li>
                <li><a href="<?=$this->config->item('base_url').'users/attendance'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/attendence.png" class="rotate">--><i class="fa fa-pencil adm-icon"></i> Attendance</a></li>
                <li><a href="<?=$this->config->item('base_url').'users/student_view'?>"><!--img src="<?= $theme_path; ?>/images/icons/events/assignment.png" class="rotate">--><i class="fa fa-edit adm-icon"></i> Assignment</a></li>
                <li><a href="<?=$this->config->item('base_url').'users/internals'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/internal_mark.png" class="rotate">--><i class="fa fa-check-square adm-icon"></i> Mark Details</a></li>
                <li><a href="<?=$this->config->item('base_url').'users/events_view'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/events.png" class="rotate">--><i class="fa fa-star adm-icon"></i> Events</a></li>               
                <li><a href="<?=$this->config->item('base_url').'users/share_notes_view'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/notes.png" class="rotate">--><i class="fa fa-share-square adm-icon"></i> Class Notes</a></li>
                <?php if($data['all'][0]['chat']==1){?>
                <li><a href="<?=$this->config->item('base_url').'users/chat'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/chat.png" class="rotate">--><i class="fa fa-comments adm-icon"></i> Chat</a></li>
                <?php }?>
                 <li><a href="<?=$this->config->item('base_url').'users/calendar'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/clendar.png" class="rotate">--><i class="fa fa-calendar adm-icon"></i> Calendar</a></li>
                 <li><a href="<?=$this->config->item('base_url').'users_notification/class_mate'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/class_mate.png" class="rotate">--><i class="fa fa-users adm-icon"></i> Classmate</a></li>
                 <!--<li><a href="<?=$this->config->item('base_url').'socialnetwork'?>" target="_blank"><img src="<?= $theme_path; ?>/images/icons/events/social.png" class="rotate">i-Network</a></li>-->
                  <li><a href="<?=$this->config->item('base_url').'users/fees'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/rs.png" class="rotate">--><i class="fa fa-money adm-icon"></i> Fees</a></li>
				<?php 
				if($user_det[0]['hostel']==1)
				{
					?>
                    <li><a href="<?=$this->config->item('base_url').'users/hostel_fees'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/hostel_fees.png" class="rotate">--><i class="fa fa-home adm-icon"></i> Hostel Fees</a></li>
                    <?php
				}
				?>
                <?php 
				if($user_det[0]['transport']==1)
				{
					?>
                
                    <li><a href="<?=$this->config->item('base_url').'users/transport_fees'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/hostel_fees.png" class="rotate">--><i class="fa fa-money adm-icon"></i> Transport Fees</a></li>
                    <?php
				}
				?>
                 <!--<li><a href="#" class="sub" tabindex="1"><img src="<?= $theme_path; ?>/images/icons/events/library.png" class="rotate"><i class="fa fa-list adm-icon"></i> Library</a><img src="<?= $theme_path; ?>/images/up.png" alt="" />
                    <ul>
                        <li><a href="<?=$this->config->item('base_url').'users/search_library'?>"><i class="fa fa-angle-double-right"></i> Search Books</a></li>
                        <li><a href="<?=$this->config->item('base_url').'users/my_books'?>"><i class="fa fa-angle-double-right"></i> Books</a></li>
                       
                    </ul>
                </li>--> 
                 <li><a href="<?=$this->config->item('base_url').'users/plac_test_wel'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/placement_test.png" class="rotate">--><i class="fa fa-check adm-icon"></i> Placement Test</a></li>
                 <li><a href="<?=$this->config->item('base_url').'users/placement_list'?>"><!--<img src="<?= $theme_path; ?>/images/icons/events/placement.png" class="rotate">--><i class="fa fa-certificate adm-icon"></i> Placement</a></li>
                 <!--<li><a href="<?=$this->config->item('base_url').'users/download_form'?>"><img src="<?= $theme_path; ?>/images/icons/events/download.png" class="rotate"><i class="fa fa-download adm-icon"></i> Download Form</a></li>
                  <li><a href="<?=$this->config->item('base_url').'users/videos'?>"><img src="<?= $theme_path; ?>/images/icons/events/video1.png" class="rotate"><i class="fa fa-video-camera adm-icon"></i> Videos Search</a></li>-->
                  
                 <!--<li><a href="#" class="sub" tabindex="1"><img src="<?= $theme_path; ?>/images/icons/events/time_table.png" class="rotate"> khan Academy</a><img src="<?= $theme_path; ?>/images/up.png" alt="" />
                    <ul>
                        <li><a href="<?=$this->config->item('base_url').'users/khan_api_badges'?>"><i class="fa fa-angle-double-right"></i> Badge List</a></li>
                        <li><a href="<?=$this->config->item('base_url').'users/khan_api_cat'?>"><i class="fa fa-angle-double-right"></i> Category List</a></li>
                        <li><a href="<?=$this->config->item('base_url').'users/khan_api_exce'?>"><i class="fa fa-angle-double-right"></i> Excercises List</a></li>
                        <li><a href="<?=$this->config->item('base_url').'users/khan_api_video'?>"><i class="fa fa-angle-double-right"></i> Excercises Videos</a></li>
<?php /*?>                        <li><a href="<?=$this->config->item('base_url').'users/arrear_time_table'?>"><i class="fa fa-angle-double-right"></i> Arrear Time Table</a></li>
<?php */?>                    </ul>
                </li>-->
                

             

                
                </ul>                                                     
              </div>
          </div>
	</div>	
	<div class="nine columns user_print_use1" id="messages">
        
                <?php echo $content;?>	

	</div>
	
</div>

<div id="gallery">
	<div id="gallery-close"></div>
	<div class="image-container">
		<div class="gallery-container">
			<div class="image-content"></div>
			<div id="gallery-prev"></div>
			<div id="gallery-next"></div>
			<div class="close_btn" onclick="gallery('close')"></div>
			<div class="gallery-close" onclick="gallery('close')"></div>
			<div class="gallery-footer">
				<div class="gallery-footer-container">
					  - <a onclick="gallery('close')"><div class="delete_btn"></div></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="share">
	<div class="share-container">
		<div class="share-inner">
			<div class="share-title">Share this post</div>
		</div>
		<div class="message-divider"></div>
		<div class="share-inner">
			<div class="share-desc">Are you sure do you want to share this message on your timeline?</div>
		</div>
		<div class="message-divider"></div>
		<div class="share-menu">
			<div class="share-cancel"><a>Cancel</a></div>

			<div class="share-btn"><a>Share</a></div>
			<div class="share-close"><a onclick="doShare(0, 0)">Close</a></div>
		</div>
	</div>
</div>
<div class="row-body">
	<div class="footer">
		
		<div class="footer-container">
			<div class="footer-languages">
				Copyright &copy; 2017  e-soft. All rights reserved. Powered by <a href="http://www.f2fsolutions.co.in/" target="_blank">f2f Solutions</a>.
			</div>
		</div>
		
	</div>
</div>

<div class="main_bg">

<div class="">
<?php
							if($data['all'][0]['background_image']!='')
							{
							?>
                            <img style="width:100%;" src="<?= $this->config->item('base_url')?>background_image/student/<?=$data['all'][0]['background_image']?>"/>   <?php
							}
							else
							{
							?>
                            <img style="width:100%;" src="<?= $this->config->item('base_url')?>background_image/student/Chrysanthemum.jpg"/>
                            <?php 
							}
							?>
</div>
<div class="slider-overlay slider-overlay-1"></div>
</div>

<!--<div class="main_bg">
<div class="slider-overlay slider-overlay-1 "></div>
</div>-->

<!--cover image-->

</body>
</html>
<script type="text/javascript" src="<?= $theme_path; ?>/js/functions1.js"></script>
<script type="text/javascript">

function checkNewNotifications(x) {
			// Retrieve the current notification values
			xy = $("#notifications_btn .notifications-number").html();
			xz = $("#messages_btn .notifications-number").html();
			
			// If there are not current values, reset them to 0
			if(!xy) {
				xy = 0;
			}
			if(!xz) {
				xz = 0;
			}
			$.ajax({
				type: "POST",
				url: " ",
				data: "for=1",
				success: function(html) {
					// If the response does not include "No notifications" and is not empty show the notification
					if(html.indexOf("No notifications") == -1 && html !== "" && html !== "0") {
						result = jQuery.parseJSON(html);
						if(result.response.global > 0) {
							$("#notifications_btn").html(getNotificationImage()+"<span class=\"notificatons-number-container\"><span class=\"notifications-number\">"+result.response.global+"</span></span>");
						} else {
							$("#notifications_btn").html(getNotificationImage());
						}
						if(result.response.messages > 0) {
							$("#messages_btn").html(getMessagesImageUrl(1)+"<span class=\"notificatons-number-container\"><span class=\"notifications-number\">"+result.response.messages+"</span></span>");
							$("#messages_url").attr("onclick", "showNotification('', '2')");
							$("#messages_url").removeAttr("href");
						} else {
							$("#messages_btn").html(getMessagesImageUrl(1));
							$("#messages_url").removeAttr("onclick");
							$("#messages_url").attr("href", getMessagesImageUrl());
						}
						
						// If the new value is higher than the current one, and the current one is not equal to 0

						if(result.response.global > xy && xy != 0 || result.response.global == 1 && xy == 0) {
							checkAlert();
						} else if(result.response.messages > xz && xz != 0 || result.response.messages == 1 && xz == 0) {
							checkAlert();
						}
					}
					stopNotifications = checkNewNotifications;
			   }
			});
		}
		checkNewNotifications();
</script>
<script type="text/javascript">
	$(function () {
		$('table').footable();
	});
</script>  



         <div class="wrapper row-offcanvas row-offcanvas-left">
        
        <!--AJAX LOADING AND NOTIFICATIONS STARTS HERE-->
        <script type="text/javascript">
		function for_loading(txt)
		{
			//THIS IS FOR NOTIFICATION WHEN AJAX LOAD STARTS, CODE STARTS HERE 
			$('#dyna_div').addClass('my_alert-info').removeClass('my_alert-success');
			$('#tick_img_spn').css('display','none');
			$('#load_img_div').css('display','block');
			$('#main_load_div').css('display','block');
			$('#cls_inf_bt').css('display','none');
			$('#info_txt').html(txt);
			//THIS IS FOR NOTIFICATION WHEN AJAX LOAD STARTS, CODE ENDS HERE
		}
		
		function for_response(txt) 
		{
			//THIS IS FOR NOTIFICATION WHEN AJAX LOAD RESPONSE CAME CODE STARTS HERE
			$('#dyna_div').addClass('my_alert-success').removeClass('my_alert-info');
			$('#main_load_div').css('display','block');			
			$('#cls_inf_bt').css('display','block');
			$('#load_img_div').css('display','none');
			$('#tick_img_spn').css('display','block');
			$('#info_txt').html(txt);
			setTimeout(function(){
			$('#main_load_div').css('display','none');
			}, $('#aja_notf_time').val());
			//THIS IS FOR NOTIFICATION WHEN AJAX LOAD RESPONSE CAME CODE ENDS HERE	
		}
		
		 $(document).ready(function()
 		 {
			$('#cls_inf_bt').click(function(){ $('#main_load_div').css('display','none');}); 
		 });
		</script>
        <input name="" type="hidden" value="1000" id="aja_notf_time"> <!--NOTIFICATION TIMING-->
        <div class="alert_img" id="main_load_div" style="display:none">               
            <div class="my_alert my_alert-info my_alert-dismissable" id="dyna_div">  <!--Alter nate class names "my_alert-success, my_alert-danger, my_alert-warning, my_alert-info"-->
                <div class="fa" id="load_img_div"><img src="<?= $theme_path; ?>/img/loading_small.gif" /></div>
                <i class="fa fa-check" style="display:none" id="tick_img_spn"></i>
                <button id="cls_inf_bt" type="button" class="my_close" data-dismiss="alert" aria-hidden="true">×</button>
                <!--<b>Alert !</b>--> <span id="info_txt">Success alert preview. This alert is dismissable.</span>
            </div>                
        </div>
        <!--AJAX LOADING AND NOTIFICATIONS ENDS HERE-->
<div id="main_profile_img" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-body center">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<span id="avatar1ela">
<?php
if($data['all'][0]['image']!='')
{
?>
<img src="<?= $this->config->item('base_url')?>profile_image/student/orginal/<?=$data['all'][0]['image']?>"/>   <?php
}
else
{
?>
<img  src="<?= $this->config->item('base_url')?>profile_image/student/orginal/avatar5.png"/>
<?php 
}
?></span>    
  </div>
  </div>
<!--<div class="fg_logo">
<a href="http://friendsgoogle.com/" target="_blank"><img src="<?= $theme_path; ?>/images/fg_logo.png" /></a>
</div>-->

<div id="main_cover_img" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-body center">
<div class="cover-image-style">
<button type="button" class="close1" data-dismiss="modal" aria-hidden="true">×</button>
                            <?php
							if($data['all'][0]['cover_image']!='')
							{
							?>
                            <img src="<?= $this->config->item('base_url')?>cover_image/student/original/<?=$data['all'][0]['cover_image']?>" width="100%"/>   <?php
							}
							else
							{
							?>
                            <img src="<?= $this->config->item('base_url')?>cover_image/student/original/Tulips.jpg" width="100%"/>
                            <?php 
							}
							?>
							</div> 
  </div>
  </div>      
function vpb_restriction()
{$.ajax({type:"POST",url:"",data:'',cache:false,beforeSend:function()
{$("#restriction").html('<center><div align="center"><img style="margin-top:100px;" src="icons/loadings.gif" align="absmiddle" height="15" alt="Loading" /></div></center>');},success:function(response)
{$('#restriction').fadeIn(400).html(response);}});}
function vpb_bottom_notification()
{if(!$.cookie('vpb_bottom_notification_seen')){$('#vpb_bottom_notification_header_wrapperDefault').fadeOut('fast');$('#vpb_bottom_notification_wrapper').slideDown('slow');}
else{$('#vpb_bottom_notification_wrapper').hide();$('#vpb_bottom_notification_header_wrapperDefault').show();}}
function vpb_refresh_aptcha()
{return document.getElementById("vpb_captcha_code").value="",document.getElementById("vpb_captcha_code").focus(),document.images['captchaimg'].src=document.images['captchaimg'].src.substring(0,document.images['captchaimg'].src.lastIndexOf("?"))+"?rand="+Math.random()*1000;}
function vpb_refresh_aptcha_index()
{return document.getElementById("vpb_captcha_code_index").value="",document.getElementById("vpb_captcha_code_index").focus(),document.images['captchaimg_index'].src=document.images['captchaimg_index'].src.substring(0,document.images['captchaimg_index'].src.lastIndexOf("?"))+"?rand_index="+Math.random()*1000;}
function vpb_check_others(this_value)
{if(this_value=="Others")
{$('#subject_wrapper_main').hide();$('#subject_wrapper_fake').fadeIn();}
else{}}
function vpb_cancel_fake_subject()
{$('#subject_wrapper_fake').hide();$('#subject_wrapper_main').fadeIn();}
function vpb_bottom_notification_open(){$.cookie('vpb_bottom_notification_seen',null);$('#vpb_bottom_notification_header_wrapperDefault').fadeOut('slow');$('#vpb_bottom_notification_wrapper').slideDown('slow');}
function vpb_bottom_notification_close(){var vpb_no_expire=2000000000;$.cookie('vpb_bottom_notification_seen','Seen',2000000000);$('#vpb_bottom_notification_wrapper').slideUp('slow');$('#vpb_bottom_notification_header_wrapperDefault').fadeIn('slow');}
function send_email_with_ajax_and_jquery()
{$("div#send_seasons_email").slideUp('fast');$("div#send_email_with_ajax_and_jquery").slideDown('slow');$.cookie('vpb_emails_sending_updates','send_email_with_ajax_and_jquery');}
function send_seasons_email()
{$("div#send_email_with_ajax_and_jquery").slideUp('fast');$("div#send_seasons_email").slideDown('slow');$.cookie('vpb_emails_sending_updates','send_seasons_email');}
function change_password_nuknown_link(){$("div.changePasswordNowBoxTitle_vpb").hide();$("div.changePasswordNowBox_vpb").hide();}
function change_password_immediately(){$("div.loginbox_vpb").hide();$("div.loginboxTitle_vpb").hide();$("div.changePasswordNowBoxTitle_vpb").show();$("div.changePasswordNowBox_vpb").show();}
function showForgotPasswordBox_vpb()
{$(document).attr('title','Forgot Password - Vasplus Programming Blog!');$("div.loginbox_vpb").slideUp('fast');$("div.loginboxTitle_vpb").hide();$("div.changePasswordNowBoxTitle_vpb").hide();$("div#changePasswordNowBoxTitle_vpb").hide();$("div.forgotpasswordTitle_vpb").show();$("div.forgotpassword_vpb").slideDown('slow');window.scroll(0,0);}
function showLoginBox_vpb()
{$(document).attr('title','Login - Vasplus Programming Blog!');$("div.forgotpassword_vpb").slideUp('fast');$("div.forgotpasswordTitle_vpb").hide();$("div.signups_vpb").slideUp('fast');$("div.signupsTitle_vpb").hide();$("div.changePasswordNowBox_vpb").slideUp('fast');$("div.changePasswordNowBoxTitle_vpb").hide();$("div.loginboxTitle_vpb").show();$("div.loginbox_vpb").slideDown('slow');window.scroll(0,0);}
function signupBox_vpb()
{$(document).attr('title','Sign Up - Vasplus Programming Blog!');$("div.forgotpassword_vpb").slideUp('fast');$("div.forgotpasswordTitle_vpb").hide();$("div.loginbox_vpb").slideUp('fast');$("div.loginboxTitle_vpb").hide();$("div.signupsTitle_vpb").show();$("div.signups_vpb").slideDown('slow');window.scroll(0,1000);}
function View_More_Screen_Shots(){$("#commentBix_Index_pAG").hide();$("#view_more_screenshots_button").hide();$("#exit_view_more_screenshots_button").show();$("#viewmorescreenshots").slideDown('fast');}
function Exit_Viewed_Screen_Shots(){$("#commentBix_Index_pAG").slideDown('fast');$("#exit_view_more_screenshots_button").hide();$("#view_more_screenshots_button").show();$("#viewmorescreenshots").slideUp();}
function vpb_main_index_pagination(tutorial_id)
{var language=$("#language").val();if(language!="")
{var dataString="page="+tutorial_id+"&language="+language;;}
else
{var dataString='page='+tutorial_id;}
$.ajax({type:"POST",url:"",data:dataString,cache:false,beforeSend:function()
{$("#loading_more_tutorials").html('<br /><img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/>');},success:function(response)
{$("#loading_more_tutorials").html('');$("#vasPLUS_tutorials_Display_Contents").fadeIn().html(response);if(tutorial_id==1){}
else{$('html, body').animate({scrollTop:$("#vasPLUS_tutorials_Display_Contents").offset().top-parseInt(10)+'px'},1600);}}});}
function vpb_ban_this_user()
{var user_ip=$('#ban_user_ip_addres').val();var ban_reason=$('#banning_reason').val();if(user_ip=="")
{$("#ban_user_status").html('<div class="info" style="margin-left:100px; max-width:630px;" align="left">Please enter the IP Address of the user that you want to ban in the required field to proceed.</div>');$('#ban_user_ip_addres').focus();}
else if(ban_reason=="")
{$("#ban_user_status").html('<div class="info" style="margin-left:100px; max-width:630px;" align="left">Please enter the reason for banning the IP Address you have provided in the required field to go.</div>');$('#banning_reason').focus();}
else
{var dataString="ip="+user_ip+"&reason="+ban_reason;$.ajax({type:"POST",url:"ban_and_unban_users.php",data:dataString,beforeSend:function()
{$("#ban_user_status").html('<div style="margin-left:100px;font-family:Verdana, Geneva, sans-serif; font-size:12px; color:gray;" align="left">Please wait <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div>');},success:function(response)
{$('#ban_user_ip_addres').val('');$('#banning_reason').val('');$("#banning_reason").animate({"height":"100px"},"fast");$("#ban_user_status").hide().fadeIn('slow').html(response);}});}}
function vpb_unban_this_user()
{var user_ip=$('#unban_user_ip_addres').val();if(user_ip=="")
{$("#unban_user_status").html('<div class="info" style="margin-left:100px; max-width:630px;" align="left">Please enter the IP Address of the user that you want to ban in the required field to proceed.</div>');$('#unban_user_ip_addres').focus();}
else
{var dataString="unban_this_ip_address="+user_ip;$.ajax({type:"POST",url:"ban_and_unban_users.php",data:dataString,beforeSend:function()
{$("#unban_user_status").html('<div style="margin-left:100px;font-family:Verdana, Geneva, sans-serif; font-size:12px; color:gray;" align="left">Please wait <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div>');},success:function(response)
{$('#unban_user_ip_addres').val('');$("#unban_user_status").hide().fadeIn('slow').html(response);}});}}
function vpb_search_for_this_user()
{var dataString="username="+$('#vpb_search_for_this_user').val();$.ajax({type:"POST",url:"",data:dataString,beforeSend:function()
{$("#vpb_display_users_in_the_system").html('<br clear="all"><img style="margin:80px;" src="icons/loadings.gif" width="200" height="30" alt="Loading...." align="absmiddle" title="Loading...."/><br clear="all">');},success:function(response)
{$("#vpbpaginate1").css({'background-color':'#006699'});$("#vpb_display_users_in_the_system").hide().fadeIn('slow').html(response);}});}
function vpb_entire_users_pagination(page_id)
{var users_page_identity=$("#users_page_identity").val();var dataString="page="+page_id+"&users_page_identity="+users_page_identity;;$.ajax({type:"POST",url:"",data:dataString,cache:false,beforeSend:function()
{$("#vpb_loading_users_in_the_system").html('<br clear="all"><img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/>');},success:function(response)
{$("#vpb_loading_users_in_the_system").html('');$("#vpb_display_users_in_the_system").fadeIn().html(response);}});}
function vpb_edit_banned_content(id)
{$(".cancel_edit_banned_content").hide();$(".edit_banned_content").show();$("#edit_banned_content"+id).hide();$("#cancel_edit_banned_content"+id).show();$(".main_ban_content_box").show();$("#main_ban_content_box"+id).hide();$(".edit_this_ban_content_box_").hide();$("#edit_this_ban_content_box_"+id).show();}
function vpb_cancel_edit_banned_content(id)
{$(".cancel_edit_banned_content").hide();$(".edit_banned_content").show();$(".edit_this_ban_content_box_").hide();$(".main_ban_content_box").show();}
function vpb_save_this_banned_content(id,uid,uip)
{var vpb_banned_content=$("#vpb_banned_content"+uid).val();var dataString={"id":id,"uip":uip,"vpb_banned_content":vpb_banned_content,"page":"vpb_save_this_banned_content"};$(".cancel_edit_banned_content").hide();$(".edit_banned_content").show();$(".edit_this_ban_content_box_").hide();$(".main_ban_content_box").show();$("#main_ban_content_wrapper"+uid).html('<img style="margin:10px;margin-left:0px;" src="icons/loadings.gif" alt="Saving...." align="absmiddle" title="Saving...."/>');$.post('delete_user_account.php',dataString,function(response)
{var response_brought=response.indexOf('ERROR');if(response_brought!=-1)
{$("#main_ban_content_wrapper"+uid).html(response);}
else
{$("#main_ban_content_wrapper"+uid).html(response);}});}
function vpb_edit_user_account(id,username)
{$(".cancel_edit_user_account_").hide();$(".edit_user_account_").show();$("#edit_user_account_"+id).hide();$("#cancel_edit_user_account_"+id).show();$(".hide_email_id").show();$("#hide_email_id"+id).hide();$(".edit_box_").hide();$("#edit_box_"+id).show();}
function vpb_cancel_edit_user_account(id,username)
{$(".cancel_edit_user_account_").hide();$(".edit_user_account_").show();$(".edit_box_").hide();$(".hide_email_id").show();}
function vpb_save_this_user_acct_details(id)
{var fullname_id=$("#fullname_"+id).val();var username_id=$("#username_"+id).val();var email_id=$("#email_"+id).val();var dataString="id="+id+"&username="+username_id+"&email="+email_id+"&fullname="+fullname_id+"&page=vpb_save_this_user_acct_details";$.ajax({type:"POST",url:"delete_user_account.php",data:dataString,beforeSend:function()
{$(".cancel_edit_user_account_").hide();$(".edit_user_account_").show();$(".edit_box_").hide();$(".hide_email_id").show();$("#email_id"+id).html('<img style="margin:10px;margin-left:0px;" src="icons/loadings.gif" alt="Saving...." align="absmiddle" title="Saving...."/>');},success:function(response)
{$("#email_id"+id).html(email_id);$("#fullname_id"+id).html(fullname_id);$("#username_id"+id).html(username_id);}});}
function vpb_disable_users_account(id,username)
{if(confirm('If you are sure that you really want to disable this account then click on OK'))
{var dataString="id="+id+"&username="+username+"&page=disable";$.ajax({type:"POST",url:"delete_user_account.php",data:dataString,beforeSend:function()
{$("#user_account_deletion_status"+id).html('<img style="margin:10px;margin-left:0px;" src="icons/loadings.gif" alt="Deleting...." align="absmiddle" title="Deleting...."/>');},success:function(response)
{$("#user_account_deletion_status"+id).hide();$("#user_account_wrapper"+id).html(response);}});}
return false;}
function vpb_enable_users_account(id,username)
{if(confirm('If you are sure that you really want to enable this account then click on OK'))
{var dataString="id="+id+"&username="+username+"&page=enable";$.ajax({type:"POST",url:"delete_user_account.php",data:dataString,beforeSend:function()
{$("#user_account_deletion_status"+id).html('<img style="margin:10px;margin-left:0px;" src="icons/loadings.gif" alt="Deleting...." align="absmiddle" title="Deleting...."/>');},success:function(response)
{$("#user_account_deletion_status"+id).hide();$("#user_account_wrapper"+id).fadeIn().html(response);}});}
return false;}
function vpb_delete_users_account(id,username)
{if(confirm('If you are sure that you really want to delete this account then click on OK'))
{var dataString="id="+id+"&username="+username+"&page=delete";$.ajax({type:"POST",url:"delete_user_account.php",data:dataString,beforeSend:function()
{$("#user_account_deletion_status"+id).html('<img style="margin:10px;margin-left:0px;" src="icons/loadings.gif" alt="Deleting...." align="absmiddle" title="Deleting...."/>');},success:function(response)
{$("#user_account_wrapper"+id).fadeOut();}});}
return false;}
function updatesSubscription()
{var reg=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;var updates_subscription=$("#updates_subscription").val();if(updates_subscription==""||updates_subscription=="Enter your email...")
{$("#vpb_alert_focus").val('#updates_subscription');vasplus_i_alert('Please enter your email address in the required field to subscribe to our updates.<br>Thank You!');return false;}
else if(reg.test(updates_subscription)==false)
{$("#vpb_alert_focus").val('#updates_subscription');vasplus_i_alert('Sorry, your email address is invalid. Please enter a valid email address to proceed.<br>Thank You!');return false;}
else
{var dataString='updates_subscription='+updates_subscription+'&page=updates_subscription';$.ajax({type:"POST",url:"save_details.php",data:dataString,cache:false,beforeSend:function()
{$("#updateSubscriptionBox").hide();$("#updateSubscriptionStatus").html('<div style="width:215px; padding:10px; background:#FFF;box-shadow: 0 2px 3px #999;-moz-box-shadow: 0 2px 3px #999;-webkit-box-shadow: 0 2px 3px #999;"><div style="" align="center"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div></div>');},success:function(response)
{var updateSubscriptionResult=response.indexOf('subscription_is_completed');if(updateSubscriptionResult!=-1)
{$("#updates_subscription").val("");$("#updateSubscriptionStatus").html('');$("#updateSubscriptionBox").fadeIn();vasplus_i_alert('You have successfully subscribed to our regular updates.<br>Thank You!');return false;}
else
{$("#vpb_alert_focus").val('');$("#updateSubscriptionStatus").html('');$("#updateSubscriptionBox").fadeIn();vasplus_i_alert(response);return false;}}});}}
function sentEmailMessageNow()
{var toemailupdate=$("#toemailupdate").val();var fromemailupdate=$("#fromemailupdate").val();var subjectupdate=$("#subjectupdate").val();var messageupdate=$("#messageupdate").val();if($('input[name=send_to_all]:checked').size()==0)
{var checkbox_option_items="";}
else
{var checkbox_option_items="yes"}
if($('input[name=send_to_all]:checked').size()==0&&toemailupdate=="")
{$("#sentMessageStatus").show();$("#sentMessageStatus").html('<div class="info">Please either check the checkbox to send a general update to all the registered users on this system or fill in the To-Email field to proceed..</div>');$("#toemailupdate").focus();}
else if(fromemailupdate=="")
{$("#sentMessageStatus").show();$("#sentMessageStatus").html('<div class="info">Please fill in the From-Email field to move on. Thanks.</div>');$("#fromemailupdate").focus();}
else if(subjectupdate=="")
{$("#sentMessageStatus").show();$("#sentMessageStatus").html('<div class="info">Please enter the subject of this email update to proceed. Thanks.</div>');$("#subjectupdate").focus();}
else if(messageupdate=="")
{$("#sentMessageStatus").show();$("#sentMessageStatus").html('<div class="info">Please enter the message that you wish to send to go. Thanks.</div>');$("#messageupdate").focus();}
else
{var dataString={'checkbox_option_items':checkbox_option_items,'toemailupdate':toemailupdate,'fromemailupdate':fromemailupdate,'subjectupdate':subjectupdate,'messageupdate':messageupdate,'page':'sendEmailUpdates'};$("#sentMessageStatus").show();$("#sentMessageStatus").html('<div style="padding-top:25px;"><img src="icons/loadings.gif" alt="Sending...." align="absmiddle" title="Sending...."/> <font style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:black;">Please wait...</font></div><br clear="all">');$.post('save_details.php',dataString,function(response)
{var sentMessageResult=response.indexOf('email_sentsuccessfully');if(sentMessageResult!=-1)
{$("#sentMessageStatus").show();$("#sentMessageStatus").fadeIn(2000).html('<div class="success">The email update has been sent successfully. Thanks.</div>');$("#toemailupdate").val('');$("#fromemailupdate").val('');$("#subjectupdate").val('');$("#messageupdate").val('');$("#messageupdate").animate({"height":"100px"},"fast");}
else
{$("#sentMessageStatus").fadeIn(2000).html(response);}});}}
function sentSeasonsEmailMessageNow()
{var toemailupdate=$("#toemailupdates").val();var fromemailupdate=$("#fromemailupdates").val();var subjectupdate=$("#subjectupdates").val();var messageupdate=$("#messageupdates").val();if($('input[name=sendtoalls]:checked').size()==0)
{var checkbox_option_items="";}
else
{var checkbox_option_items="yes"}
if($('input[name=sendtoalls]:checked').size()==0&&toemailupdate=="")
{$("#sentSeasonsMessageStatus").show();$("#sentSeasonsMessageStatus").html('<div class="info">Please either check the checkbox to send a general update to all the registered users on this system or fill in the To-Email field to proceed..</div>');$("#toemailupdates").focus();}
else if(fromemailupdate=="")
{$("#sentSeasonsMessageStatus").show();$("#sentSeasonsMessageStatus").html('<div class="info">Please fill in the From-Email field to move on. Thanks.</div>');$("#fromemailupdates").focus();}
else if(subjectupdate=="")
{$("#sentSeasonsMessageStatus").show();$("#sentSeasonsMessageStatus").html('<div class="info">Please enter the subject of this email update to proceed. Thanks.</div>');$("#subjectupdates").focus();}
else if(messageupdate=="")
{$("#sentSeasonsMessageStatus").show();$("#sentSeasonsMessageStatus").html('<div class="info">Please enter the message that you wish to send to go. Thanks.</div>');$("#messageupdates").focus();}
else
{var dataString={'checkbox_option_items':checkbox_option_items,'toemailupdate':toemailupdate,'fromemailupdate':fromemailupdate,'subjectupdate':subjectupdate,'messageupdate':messageupdate,'page':'sendSeasonsEmailUpdates'};$("#sentSeasonsMessageStatus").show();$("#sentSeasonsMessageStatus").html('<div style="padding-top:25px;"><img src="icons/loadings.gif" alt="Sending...." align="absmiddle" title="Sending...."/> <font style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:black;">Please wait...</font></div><br clear="all">');$.post('save_details.php',dataString,function(response)
{var sentMessageResult=response.indexOf('email_sentsuccessfully');if(sentMessageResult!=-1)
{$("#sentSeasonsMessageStatus").show();$("#sentSeasonsMessageStatus").fadeIn(2000).html('<div class="success">The email update has been sent successfully. Thanks.</div>');$("#toemailupdates").val('');$("#subjectupdates").val('');$("#messageupdates").val('');$("#messageupdates").animate({"height":"100px"},"fast");}
else
{$("#sentSeasonsMessageStatus").fadeIn(2000).html(response);}});}}
function submitTutorial()
{var ttopic=$("#ttopic").val();var tlanguage=$("#tlanguage").val();var turl=$("#turl").val();var durl=$("#durl").val();var tdesc=$("#tdesc").val();if($("#tcode").val()=="Type none if this script requires login before download")
{var tcode="";}
else
{var tcode=$("#tcode").val();}
if(ttopic=="")
{$("#preview").show();$("#preview").html('<div class="info">Please enter the topic for the tutorial to get started. Thanks.</div>');$("#ttopic").focus();}
else if(tlanguage=="")
{$("#preview").show();$("#preview").html('<div class="info">Please enter the major programming language name that will be used for the tutorial during search.\nExample: PHP, Jquery, Ajax, MySql, Wall Script, etc. Thanks.</div>');$("#tlanguage").focus();}
else if(tdesc=="")
{$("#preview").show();$("#preview").html('<div class="info">Please enter the description for this tutorial to go. Thanks.</div>');$("#tdesc").focus();}
else
{var dataString={'ttopic':ttopic,'tlanguage':tlanguage,'turl':turl,'durl':durl,'tdesc':tdesc,'tcode':tcode,'page':'submit_tutorials'};$("#preview").show();$("#preview").html('<div style="padding-left:100px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');$.post('save_details.php',dataString,function(response)
{$("#preview").show();$("#preview").fadeIn(2000).html(response);$("#ttopic").val('');$("#tlanguage").val('');$("#turl").val('');$("#durl").val('');$("#tdesc").val('');$("#tcode").val('');$("#tdesc").animate({"height":"100px"},"fast");});}}
function cancelSearchBox_UsersArea()
{$("#vasplus_search_results").hide();$("#mainUsersPageContent").fadeIn('slow');}
function cancelSearchBoxIndex()
{$("#vasplus_search_resultsIndex").hide();$("#vasplus_pageContents").fadeIn('slow');}
$(document).ready(function()
{$("#siteSearchInput").keyup(function()
{var main_search_term=$(this).val();if(main_search_term==""||main_search_term=="Search")
{cancelSearchBoxIndex();}
else if(main_search_term.length>0&&main_search_term.length<15&&main_search_term!="Search")
{startSearchBox();}});$('input#siteSearchInput').live("keydown",function(vpb_event){if(vpb_event.keyCode==13&&vpb_event.shiftKey==0){startSearchBox_index();startSearchBox();}else{}});$('input#usernamel').live("keydown",function(vpb_event){if(vpb_event.keyCode==13&&vpb_event.shiftKey==0){logins();}else{}});$('input#passl').live("keydown",function(vpb_event){if(vpb_event.keyCode==13&&vpb_event.shiftKey==0){logins();}else{}});});function startSearchBox_index()
{var searchTerm=$("#siteSearchInput").val();if(searchTerm==""||searchTerm=="Search")
{vasplus_i_alert('Please enter your desired search term in the required field to proceed.<br>Thank You!');return false;}
else if(searchTerm.length<1)
{vasplus_i_alert('Sorry but a search term must not be less than one character in length.<br>Thank You!');return false;}
else if(searchTerm.length>20)
{vasplus_i_alert('Sorry but a search term must not be greater than 20 characters in length.<br>Thank You!');return false;}
else
{var dataString='main_search_term='+searchTerm;$.ajax({type:"POST",url:"main_search_index.php",data:dataString,cache:false,beforeSend:function()
{$("#vasplus_pageContents").hide();$("#vasplus_search_resultsIndex").show().html('<br clear="all"><center><div onmousedown="return false;" onmousemove="return false;" onmouseup="return false;" onselectstart="return false;" style="width:740px; border:0px solid; float:left;" id="vpb_loading_rounds" align="center"><img src="icons/vasplus_programming_blog_loading.gif" alt="Loading...." align="absmiddle" title="Loading...."/><br><div align="center" style="margin-top:15px;">Please wait</div></div></center><br clear="all"><br clear="all">');},success:function(response)
{if(response==""){$("#vasplus_search_resultsIndex").hide();$("#vasplus_pageContents").show();}
else
{$("#vasplus_search_resultsIndex").show();$("#vasplus_search_resultsIndex").fadeIn(2000).html(response);}}});}}
function startSearchBox()
{var searchTerm=$("#siteSearchInput").val();if(searchTerm==""||searchTerm=="Search")
{vasplus_i_alert('Please enter your desired search term in the required field to proceed. <br>Thank You!');return false;}
else if(searchTerm.length<1)
{vasplus_i_alert('Sorry but a search term must not be less than one character in length.<br>Thank You!');return false;}
else if(searchTerm.length>30)
{vasplus_i_alert('Sorry but a search term must not be greater than 30 characters in length.<br>Thank You!');return false;}
else
{var dataString='main_search_term='+searchTerm;$.ajax({type:"POST",url:"main_search.php",data:dataString,cache:false,beforeSend:function()
{$("#mainUsersPageContent").hide();$("#vasplus_search_results").show().html('<br clear="all"><center><div onmousedown="return false;" onmousemove="return false;" onmouseup="return false;" onselectstart="return false;" style="width:1060px; border:0px solid; float:left;" id="vpb_loading_rounds" align="center"><img src="icons/vasplus_programming_blog_loading.gif" alt="Loading...." align="absmiddle" title="Loading...."/><br><div align="center" style="margin-top:15px;">Please wait</div></div></center><br clear="all"><br clear="all">');},success:function(response)
{$("#vasplus_search_results").fadeIn().html(response);}});}}
function vpb_close_account_popups()
{vpb_close_ads_popups();}
function vpb_close_ads_popups()
{$("#sendInvitations").html('');$("#inviteFriends").hide();$("#vpb_advertizements").hide();$("#vpb_submitted_jobs_by_clients").hide();$("#vpb_pop_up_background").fadeOut();}
function expand_textarea_invitation_box()
{var new_text=$("#yourmessage").val().substr(0,5000);$("#yourmessage").val('');$("#yourmessage").val(new_text+'\n');$("#yourmessage").focus();$("#expand_textarea_invitation_box").hide();$("#unexpand_textarea_invitation_box").show();$("#unexpand_textarea_invitation_boxd").show();}
function unexpand_textarea_invitation_box()
{$("#yourmessage").animate({"height":"100px"},"fast");$("#unexpand_textarea_invitation_box").hide();$("#unexpand_textarea_invitation_boxd").hide();$("#expand_textarea_invitation_box").show();}
function inviteFriends()
{$("#vpb_pop_up_background").css({"opacity":"0.4"});$("#vpb_pop_up_background").fadeIn();$("#inviteFriends").fadeIn();vasplus_centralized_box('839','20','inviteFriends');window.scroll(0,0);$("#yourmessage").val('Hello There!\n\nGuess what? I think I might have found a great programming website that I thought I want to share with you.\n\nVasplus Programming Blog is a user friendly programming website that focuses on: JavaScript, jQuery, Ajax, PHP, MySQL database, CSS, HTML and fields includes Software Designs, Software Applications and much more.\n\nIt\'s a place to learn programming because free tutorials and demonstrations are given.\n\nVasplus Programming Blog also have a School Management System, Powerful Wall Script and A Private Messaging System which are similar to that of Facebook, Shopping Cart, Online Examination System, News Publishing Blog, etc sold at a very low cost and moreover, signing up is free, easy and effortless. \n\nWell, I should know because I signed up already. Sorry for beating you to it.\n\nWebsite URL: www.vasplus.info\n\nSchool Management System URL: www.school.vasplus.info\n\nRegards.');}
function vasplus_centralized_box(vpb_box_width,vpb_box_height,vpb_box_div_id)
{if(document.getElementById('vpb_pbox_width')==null&&!isNaN(parseInt(vpb_box_width))&&vpb_box_div_id!=undefined)
{var _vpb_new_div_creat_=document.createElement('div');var vpb_hidden_body_items='<input type="hidden" id="vpb_pbox_width" value="'+parseInt(vpb_box_width)+'"><input type="hidden" id="vpb_pbox_height" value="'+parseInt(vpb_box_height)+'"><input type="hidden" id="vpb_pbox_div_id" value="'+vpb_box_div_id+'">';_vpb_new_div_creat_.innerHTML=vpb_hidden_body_items;document.body.appendChild(_vpb_new_div_creat_);}
else
{if(document.getElementById('vpb_pbox_width')!=null&&!isNaN(parseInt(vpb_box_width))&&!isNaN(parseInt(vpb_box_height))&&vpb_box_div_id!=undefined)
{document.getElementById('vpb_pbox_width').value=vpb_box_width;document.getElementById('vpb_pbox_height').value=vpb_box_height;document.getElementById('vpb_pbox_div_id').value=vpb_box_div_id;}
else{}}
if(document.getElementById('vpb_pbox_width')!=null&&document.getElementById('vpb_pbox_width')!=undefined)
{var vpb_pbox_width=vpb_box_width!=undefined&&vpb_box_width!=null?vpb_box_width:document.getElementById('vpb_pbox_width').value;var vpb_pbox_height=vpb_box_height!=undefined&&vpb_box_height!=null?vpb_box_height:document.getElementById('vpb_pbox_height').value;var vpb_pbox_div_id=vpb_box_div_id!=undefined&&vpb_box_div_id!=null?vpb_box_div_id:document.getElementById('vpb_pbox_div_id').value;var winW=window.innerWidth;var winH=window.innerHeight;var vpb_pop_up_box_wrap=document.getElementById(vpb_pbox_div_id);vpb_pop_up_box_wrap.style.left=(winW/2)-(parseInt(vpb_pbox_width)*.5)+"px";vpb_pop_up_box_wrap.style.top=parseInt(vpb_pbox_height)+"px";}
else{}}
window.onresize=function(){vasplus_centralized_box();};function delete_this_advertisement(id)
{if(confirm('If you are sure that you really want to delete this item then click on OK otherwise, click on Cancel.'))
{var dataString="delete_id="+id;$.ajax({type:"POST",url:"advertisement_loader.php",data:dataString,cache:false,beforeSend:function()
{$("#ads_deletion_loading"+id).html('<br clear="all"><div style="padding:10px;" align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');},success:function(response)
{if(response!="finished")
{$("#advertisement_wrapper"+id).slideUp(2000);}
else
{$("#advertisement_wrapper"+id).slideUp(2000);$("#advertisement_is_finished").hide().slideDown(2000).html('<div class="info" align="left">You do not have any more advertisement on Vasplus website at the moment. Thanks...</div>');}}});}
return false;}
function delete_this_submitted_job(id)
{if(confirm('If you are sure that you really want to delete this item then click on OK otherwise, click on Cancel.'))
{var dataString="job_delete_id="+id;$.ajax({type:"POST",url:"jobs_submitted_loader.php",data:dataString,cache:false,beforeSend:function()
{$("#job_deletion_loading"+id).html('<br clear="all"><div style="padding:10px;" align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');},success:function(response)
{if(response!="finished")
{$("#job_wrapper"+id).slideUp(2000);}
else
{$("#job_wrapper"+id).slideUp(2000);$("#job_is_finished").hide().slideDown(2000).html('<div class="info" align="left">There are no more submitted jobs on Vasplus website at the moment. Thanks...</div>');}}});}
return false;}
function vpb_users_advertizements(id)
{$("#vpb_pop_up_background").css({"opacity":"0.4"});$("#vpb_pop_up_background").fadeIn();$("#vpb_advertizements").fadeIn();vasplus_centralized_box('740','20','vpb_advertizements');var dataString="view_this_ad="+id;$.ajax({type:"POST",url:"advertisement_loader.php",data:dataString,cache:false,beforeSend:function()
{$("#vpb_display_user_advertisements").html('<br clear="all"><center><div style="padding:10px; padding-top:14px;" align="center"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div></center><br clear="all">');},success:function(response)
{$("#vpb_display_user_advertisements").fadeIn(2000).html(response);}});}
function edit_payment_status(id,action)
{if(action=="edit")
{$("#edit_payment_status"+id).hide();$("#payment_status_id"+id).hide();$("#cancel_payment_status"+id).show();$("#text_payment_status_id"+id).show();}
else if(action=="cancel")
{$("#cancel_payment_status"+id).hide();$("#text_payment_status_id"+id).hide();$("#edit_payment_status"+id).show();$("#payment_status_id"+id).show();}}
function edit_payment_status_submission(id)
{var payment_status=$("#payment_status"+id).val();var dataString="payment_status_id="+id+"&payment_status="+payment_status;$.ajax({type:"POST",url:"advertisement_loader.php",data:dataString,cache:false,beforeSend:function()
{$("#payment_status_id"+id).html('<div style="padding:10px;" align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;"></font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div>');},success:function(response)
{if(response=="Paid"||response=="paid"||response=="Unpaid"||response=="unpaid"||response=="Expired"||response=="expired")
{$("#cancel_payment_status"+id).hide();$("#text_payment_status_id"+id).hide();$("#edit_payment_status"+id).show();$("#payment_status_id"+id).show();$("#payment_status_id"+id).fadeIn(2000).html(response);}
else
{vasplus_i_alert('Sorry, there was no valid response sent from the server at the moment. Please try again or contact the site developer. Thanks.');return false;}}});}
function signUps()
{var reg=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;var fullnames=$("#fullnames").val();var usernames=$("#usernames").val();var emails=$("#emails").val();var passs=$("#passs").val();if(fullnames=="")
{$("#vpb_alert_focus").val("#fullnames");vasplus_i_alert('Please enter your fullname in the required field to proceed.<br>Thank You!');return false;}
else if(usernames=="")
{$("#vpb_alert_focus").val("#usernames");vasplus_i_alert('Please enter your desired username in the required field to proceed.<br>Thank You!');return false;}
else if(emails=="")
{$("#vpb_alert_focus").val("#emails");vasplus_i_alert('Please enter your email address in the required field to proceed.<br>Thank You!');return false;}
else if(reg.test(emails)==false)
{$("#vpb_alert_focus").val("#emails");vasplus_i_alert('Please enter a valid email address in the required field to proceed.<br>Thank You!');return false;}
else if(passs=="")
{$("#vpb_alert_focus").val("#passs");vasplus_i_alert('Please enter your desired password in the required field to go.<br>Thank You!');return false;}
else
{var dataString={'fullnames':fullnames,'usernames':usernames,'emails':emails,'passs':passs,'page':'signup'};$("#signup_status").html('<br clear="all"><div style="width:464px;border: solid 1px #cbcbcb;box-shadow: 0 0 6px #cbcbcb;-moz-box-shadow: 0 0 6px #cbcbcb;-webkit-box-shadow: 0 0 6px #cbcbcb;padding:13px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div>');$.post('save_details.php',dataString,function(response)
{var signUpResult=response.indexOf('_uid');if(signUpResult!=-1)
{$("#fullnames").val("");$("#usernames").val("");$("#emails").val("");$("#passs").val("");$("#signup_status").html('');$("#vpb_alert_focus").val("");window.location.replace(response);}
else
{$("#signup_status").html('');vasplus_i_alert(response);return false;}});}}
function change_password_now_vpb()
{var newPassword=$("#newPassword").val();var verifyPassword=$("#verifyPassword").val();var username_for_password_to_change=$("#username_for_password_to_change").val();if(newPassword=="")
{$("#change_password_status").html('<div class="info">Please enter your desired new password above to proceed.</div>');$("#newPassword").focus();}
else if(newPassword.length<4)
{$("#change_password_status").html('<div class="info">Sorry, password must not be less than four characters in length please.</div>');$("#newPassword").focus();}
else if(verifyPassword=="")
{$("#change_password_status").html('<div class="info">Please verify the new password you have provided to go.</div>');$("#verifyPassword").focus();}
else if(verifyPassword!=newPassword)
{$("#change_password_status").html('<div class="info">Both new password and verify password fields must be the same to proceed please.</div>');$("#verifyPassword").focus();}
else{var dataString={'username_for_password_to_change':username_for_password_to_change,'newPassword':newPassword,'page':'change_password_now_man'};$("#change_password_status").html('<br clear="all"><div style="width:464px;border: solid 1px #cbcbcb;box-shadow: 0 0 6px #cbcbcb;-moz-box-shadow: 0 0 6px #cbcbcb;-webkit-box-shadow: 0 0 6px #cbcbcb;padding:13px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div>');$.post('save_details.php',dataString,function(response)
{$("#newPassword").val("");$("#verifyPassword").val("");$("#change_password_status").fadeIn('slow').html(response);});}}
function forgotpassword()
{var username_or_email=$("#username_or_email").val();if(username_or_email=="")
{$("#forgotpassword_status").html('<div class="info">Enter either your account username or email address to proceed.</div>');$("#username_or_email").focus();}
else{var dataString='username_or_email='+username_or_email+'&page=forgotpassword';$.ajax({type:"POST",url:"save_details.php",data:dataString,cache:false,beforeSend:function()
{$("#forgotpassword_status").html('<br clear="all"><div style="width:464px;border: solid 1px #cbcbcb;box-shadow: 0 0 6px #cbcbcb;-moz-box-shadow: 0 0 6px #cbcbcb;-webkit-box-shadow: 0 0 6px #cbcbcb;padding:13px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div>');},success:function(response)
{$("#username_or_email").val("");$("#forgotpassword_status").fadeIn('slow').html(response);}});}}
function logins()
{$("#expired_session").hide();var usernamel=$("#usernamel").val();var passl=$("#passl").val();if(usernamel=="")
{$("#vpb_alert_focus").val("#usernamel");vasplus_i_alert('Please enter your username or email address in the reuired field to proceed.<br>Thank You!');return false;}
else if(passl=="")
{$("#vpb_alert_focus").val("#passl");vasplus_i_alert('Please enter your account password in the reuired field to proceed.<br>Thank You!');return false;}
else
{var dataString={'usernamel':usernamel,'passl':passl,'page':'login'};$("#login_status").html('<br clear="all"><div style="width:473px;border: solid 1px #cbcbcb;box-shadow: 0 0 6px #cbcbcb;-moz-box-shadow: 0 0 6px #cbcbcb;-webkit-box-shadow: 0 0 6px #cbcbcb;padding:13px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div>');$.post('save_details.php',dataString,function(response)
{var loginResult=response.indexOf('_uid');if(loginResult!=-1)
{$("#usernamel").val("");$("#passl").val("");$("#vpb_alert_focus").val("");$("#login_status").html('');window.location.replace(response);}
else
{$("#login_status").html('');vasplus_i_alert(response);return false;}});}}
function vpb_auto_logins()
{var uid=$("#social_uid").val();var full_name=$("#social_full_name").val();var user_name=$("#social_user_name").val();var email=$("#social_email").val();var gender=$("#social_gender").val();var birthday=$("#social_birthday").val();var location=$("#social_location").val();var bio=$("#social_bio").val();if(uid==""||uid==undefined||full_name==""||full_name==undefined||user_name==""||user_name==undefined||email==""||email==undefined)
{vasplus_i_alert('Sorry, it appears some information are missing therefore, you will be redirected shortly to login again via Facebook.<br>Thank You!');setTimeout(function(){window.location.replace('http://vasplus.info/fb_login.php');},6000);}
else
{var dataString='uid='+uid+'&full_name='+full_name+'&user_name='+user_name+'&email='+email+'&gender='+gender+'&birthday='+birthday+'&location='+location+'&bio='+bio+'&page=vpb_auto_logins';$.ajax({type:"POST",url:"save_details.php",data:dataString,cache:true,beforeSend:function(){},success:function(response)
{var loginResult=response.indexOf('_uid');if(loginResult!=-1)
{setTimeout(function(){window.location.replace(response);},6000);}
else
{vasplus_i_alert(response);setTimeout(function(){window.location.replace('http://vasplus.info/fb_login.php');},6000);}}});}}
function contactUs()
{var reg=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;var fullnamec=$("#fullnamec").val();var emailc=$("#emailc").val();var subjectc=$("#subjectc").val();var messagec=$("#messagec").val();var vpb_captcha_code=$("#vpb_captcha_code").val();var others_selected=$("#others_selected").val();if(others_selected==""||others_selected=="Type your subject here"){others_selected="";}
if(subjectc=="Others"&&others_selected!=""){subjectc=others_selected;}
if(fullnamec=="")
{$("#vpb_alert_focus").val("#fullnamec");vasplus_i_alert('Please enter your fullname in the required field to proceed.<br>Thank You!');return false;}
else if(emailc=="")
{$("#vpb_alert_focus").val("#emailc");vasplus_i_alert('Please enter your email address in the required field to proceed.<br>Thank You!');return false;}
else if(reg.test(emailc)==false)
{$("#vpb_alert_focus").val("#emailc");vasplus_i_alert('Please enter a valid email address in the required field to proceed.<br>Thank You!');return false;}
else if(subjectc=="")
{$("#vpb_alert_focus").val("#subjectc");vasplus_i_alert('Please select the subject of your message from the listed options to proceed.<br>Thank You!');return false;}
else if(subjectc=="Others"&&others_selected=="")
{$("#vpb_alert_focus").val("#others_selected");vasplus_i_alert('Please type the subject of your message in the field specified to proceed.<br>Thank You!');return false;}
else if(messagec=="")
{$("#vpb_alert_focus").val("#messagec");vasplus_i_alert('Please enter the message that you wish to send to us in the field specified to proceed.<br>Thank You!');return false;}
else if(vpb_captcha_code==""||vpb_captcha_code=="Type the below security code here")
{$("#vpb_alert_focus").val("#vpb_captcha_code");vasplus_i_alert('Please type the security code provided in the required field to go.<br>Thank You!');return false;}
else
{var dataString={'fullnamec':fullnamec,'emailc':emailc,'subjectc':subjectc,'messagec':messagec,'vpb_captcha_code':vpb_captcha_code,'page':'contactus'};$(".mainContacts").hide();$(".fakeContacts").show();$("#contactus_status").html('<br clear="all"><div style="width:470px;border: solid 1px #cbcbcb;box-shadow: 0 0 6px #cbcbcb;-moz-box-shadow: 0 0 6px #cbcbcb;-webkit-box-shadow: 0 0 6px #cbcbcb;padding:13px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div>');$.post('save_details.php',dataString,function(response)
{var sentMessageResult=response.indexOf('sent_successfully');if(sentMessageResult!=-1)
{$(".fakeContacts").hide();$(".mainContacts").show();$("#contactus_status").html('');$("#vpb_alert_focus").val("");vasplus_i_alert("Congrats <b>"+$("#fullnamec").val()+"</b>, your message has been sent successfully. <br>Thank you for contacting us, we will get back to you as soon as possible.<br>Thank You!");$("#fullnamec").val("");$("#emailc").val("");$("#subjectc").val("");$("#messagec").val("");$("#messagec").animate({"height":"50px"},"fast");$("#vpb_captcha_code").val('');$("#others_selected").val('');$('#subject_wrapper_fake').hide();$('#subject_wrapper_main').fadeIn();document.images['captchaimg'].src=document.images['captchaimg'].src.substring(0,document.images['captchaimg'].src.lastIndexOf("?"))+"?rand="+Math.random()*1000;return false;}
else
{$(".fakeContacts").hide();$(".mainContacts").show();$("#contactus_status").html('');vasplus_i_alert(response);return false;}});}}
function advertisements()
{var adsitemname=$("#adsitemname").val();var adswebsiteurl=$("#adswebsiteurl").val();var adsdescription=$("#adsdescription").val();if(adsitemname=="")
{$("#advertise_status").html('<div class="info">Please enter your item name in the required field to proceed.</div>');$("#adsitemname").focus();}
else if(adsdescription=="")
{$("#advertise_status").html('<div class="info">Please enter a brief description for your item in its field.</div>');$("#adsdescription").focus();}
else
{var dataString={'adsitemname':adsitemname,'adswebsiteurl':adswebsiteurl,'adsdescription':adsdescription,'page':'advertise'};$("#advertise_status").html('<br clear="all"><div style="width:464px;border: solid 1px #cbcbcb;box-shadow: 0 0 6px #cbcbcb;-moz-box-shadow: 0 0 6px #cbcbcb;-webkit-box-shadow: 0 0 6px #cbcbcb;padding:13px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div>');$.post('save_details.php',dataString,function(response)
{var savedAdsResult=response.indexOf('save_successfully');if(savedAdsResult!=-1)
{$("#adsitemname").val("");$("#adswebsiteurl").val("");$("#adsdescription").val("");$("#adsdescription").animate({"height":"80px"},"fast");$(".ads_details").hide();$("#adsdescriptioned").hide();$(".ads_payment").show();$("#adsads_paymentdescriptioned").show();$("#ads_details").hide();$("#ads_payment").show();}
else
{$("#advertise_status").fadeIn(2000).html(response);}});}}
function advertisement_payment()
{var adsduration=$("#adsduration").val();if(adsduration=="")
{$("#ads_payment_status").html('<div class="info">Please select your desired advertisement duration from the listed durations to proceed.</div>');}
else
{var dataString='adsduration='+adsduration+'&page=advertisement_payment';$.ajax({type:"POST",url:"save_details.php",data:dataString,cache:false,beforeSend:function()
{$("#ads_payment_status").html('<div style="padding-left:100px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');},success:function(response)
{var AdsPaymentResult=response.indexOf('proceed_to_payment=yes');if(AdsPaymentResult!=-1)
{$("#ads_payment_status").html('');window.location.replace('users.php?page=advertisepayment&'+response);}
else
{$("#ads_payment_status").fadeIn(2000).html(response);}}});}}
function sendInvitation()
{var reg=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;if($("#friendsemail").val()!=""&&$("#friendsemail").val()!="Enter your friend's email address here"){var friendsemail=$("#friendsemail").val();}else{var friendsemail="";}
var yourfullname=$("#yourfullname").val();var youremail=$("#youremail").val();var yourmessage=$("#yourmessage").val();var vpb_captcha_code_index=$("#vpb_captcha_code_index").val();if(friendsemail=="")
{$("#sendInvitations").html('<div class="info">Please enter your friends email address in its field to proceed.</div>');$("#friendsemail").focus();}
else if(reg.test(friendsemail)==false)
{$("#sendInvitations").html('<div class="info">Sorry, your friends email address is invalid. Enter a valid email address please.</div>');$("#friendsemail").focus();}
else if(yourfullname=="")
{$("#sendInvitations").html('<div class="info">Please enter your fullname in its field to proceed.</div>');$("#yourfullname").focus();}
else if(youremail=="")
{$("#sendInvitations").html('<div class="info">Please enter your own email address in its field to move on.</div>');$("#youremail").focus();}
else if(reg.test(youremail)==false)
{$("#sendInvitations").html('<div class="info">Sorry, your own email address is invalid. Enter a valid email address please.</div>');$("#youremail").focus();}
else if(yourmessage=="")
{$("#sendInvitations").html('<div class="info">Please enter your message in its field to go.</div>');$("#yourmessage").focus();}
else if(vpb_captcha_code_index==""||vpb_captcha_code_index=="Type the below code here")
{$("#sendInvitations").html('<div class="info">Please type the security code in the field provided to proceed. Thanks.</div>');$("#vpb_captcha_code_index").focus();}
else
{var dataString={'friendsemail':friendsemail,'yourfullname':yourfullname,'youremail':youremail,'yourmessage':yourmessage,'vpb_captcha_code_index':vpb_captcha_code_index,'page':'send_invitation_to_friends'};$("#sendInvitations").html('<br clear="all"><div style="padding-left:100px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');$.post('save_details.php',dataString,function(response)
{var sendInvitationResult=response.indexOf('invitation_sent');if(sendInvitationResult!=-1)
{$("#friendsemail").val('')
$("#vpb_captcha_code_index").val('')
$("#sendInvitations").fadeIn(2000).html("<div class='success'>Congrats "+yourfullname+", your invitation has been sent successfully. Thanks for spreading the word about vasPLUS Programming Blog.</div>");document.images['captchaimg_index'].src=document.images['captchaimg_index'].src.substring(0,document.images['captchaimg_index'].src.lastIndexOf("?"))+"?rand_index="+Math.random()*1000;}
else
{$("#sendInvitations").fadeIn(2000).html(response);}});}}
function job_submission()
{$("#job_submission_status").html('');$("#job_submissionMain").hide();$("#submit_a_job_description").show();$("#submit_a_job").show();$("#job_submission").hide();$("#cancel_submission").show();}
function cancel_submission()
{$("#job_submission_status").html('');$("#submit_a_job_description").hide();$("#submit_a_job").hide();$("#job_submissionMain").show();$("#cancel_submission").hide();$("#job_submission").show();}
function submitMyJobNow()
{var pprojectname=$("#pprojectname").val();var ptype=$("#ptype").val();var pdescription=$("#pdescription").val();if(pprojectname=="")
{$("#job_submission_status").html('<div class="info">Please enter your company or project or job name or job title in its field to move on.</div>');$("#pprojectname").focus();}
else if(ptype=="")
{$("#job_submission_status").html('<div class="info">Please select your project type from the listed types.</div>');$("#ptype").focus();}
else if(pdescription=="")
{$("#job_submission_status").html('<div class="info">Please enter a brief description for your item in its field.</div>');$("#pdescription").focus();}
else
{var dataString={'pprojectname':pprojectname,'ptype':ptype,'pdescription':pdescription,'page':'job_submission'};$("#job_submission_status").html('<br clear="all"><div style="width:464px;border: solid 1px #cbcbcb;box-shadow: 0 0 6px #cbcbcb;-moz-box-shadow: 0 0 6px #cbcbcb;-webkit-box-shadow: 0 0 6px #cbcbcb;padding:13px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div>');$(".jobsMainsubmit").hide();$(".fakejobsMainSubmit").show();$.post('save_details.php',dataString,function(response)
{var savedJobResult=response.indexOf('job_save_successfully');if(savedJobResult!=-1)
{var fullnamed=response.replace('job_save_successfully&','');$("#job_submission_status").html($("<div class='success'>Thank you <b>"+fullnamed+"</b>, your new job has been submitted successfully.<br>We will get back to you as soon as possible. Thanks!</div>").fadeIn(2000));$("#pprojectname").val('');$("#ptype").val('');$("#pdescription").val('');$("#pdescription").animate({"height":"80px"},"fast");$(".fakejobsMainSubmit").hide();$(".jobsMainsubmit").show();}
else
{$("#job_submission_status").fadeIn(2000).html(response);$(".fakejobsMainSubmit").hide();$(".jobsMainsubmit").show();}});}}
$(document).ready(function(){$('#attachedFile').live('change',function(){var attachedID=$(this).attr("id");$("#attachmentform").naijaclicksUploader({beforeSubmit:function(){$("#preview").show();$("#preview").html('');$("#mainSubmit").hide();$("#fakeSubmit").show();$("#preview").html('<div style="padding-left:0px;"><img src="icons/loadings.gif" alt="Uploading...." align="absmiddle" title="Uploading...."/> <font style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:black;">Please wait...</font></div><br clear="all">');},error:function(){$("#preview").show();$("#fakeSubmit").hide();$("#mainSubmit").show();},target:'#preview',url:'file_uploads.php',success:function(){$("#preview").show();$("#fakeSubmit").hide();$("#mainSubmit").show();}}).submit();});$('#attachedAds').live('change',function(){$("#Adsattachment").naijaclicksUploader({beforeSubmit:function(){$("#advertise_status").show();$("#advertise_status").html('');$(".mainadsSubmit").hide();$(".fakeadsSubmit").show();$("#advertise_status").html('<br clear="all"><div style="width:464px;border: solid 1px #cbcbcb;box-shadow: 0 0 6px #cbcbcb;-moz-box-shadow: 0 0 6px #cbcbcb;-webkit-box-shadow: 0 0 6px #cbcbcb;padding:13px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');},error:function(){$("#advertise_status").show();$(".fakeadsSubmit").hide();$(".mainadsSubmit").show();},target:'#advertise_status',url:'ads_uploads.php',success:function(){$("#advertise_status").show();$(".fakeadsSubmit").hide();$(".mainadsSubmit").show();}}).submit();});$('#jobfile').live('change',function(){$("#Jobsattachment").naijaclicksUploader({beforeSubmit:function(){$("#job_submission_status").show();$("#job_submission_status").html('');$(".jobsMainsubmit").hide();$(".fakejobsMainSubmit").show();$("#job_submission_status").html('<br clear="all"><div style="width:464px;border: solid 1px #cbcbcb;box-shadow: 0 0 6px #cbcbcb;-moz-box-shadow: 0 0 6px #cbcbcb;-webkit-box-shadow: 0 0 6px #cbcbcb;padding:13px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');},error:function(){$("#job_submission_status").show();$(".fakejobsMainSubmit").hide();$(".jobsMainsubmit").show();},target:'#job_submission_status',url:'file_job_uploads.php',success:function(){$("#job_submission_status").show();$(".fakejobsMainSubmit").hide();$(".jobsMainsubmit").show();}}).submit();});});function calculatePriceCharged(str){if(str==""){document.getElementById("price_charged").innerHTML="";return;}
if(window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();}
else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
xmlhttp.onreadystatechange=function(){$('#price_charged').html('<img src="icons/loadings.gif" align="absmiddle" /><div align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:black;">&nbsp;&nbsp;please wait...</font></div>');$("#ads_payment_status").hide();if(xmlhttp.readyState==4&&xmlhttp.status==200){document.getElementById("price_charged").innerHTML=xmlhttp.responseText;}}
xmlhttp.open("GET","calculateAdsPrices.php?q="+str,true);xmlhttp.send();}
jQuery.cookie=function(name,value,options){if(typeof value!='undefined'){options=options||{};if(value===null){value='';options.expires=-1;}
var expires='';if(options.expires&&(typeof options.expires=='number'||options.expires.toUTCString)){var date;if(typeof options.expires=='number'){date=new Date();date.setTime(date.getTime()+(options.expires*24*60*60*1000));}else{date=options.expires;}
expires='; expires='+date.toUTCString();}
var path=options.path?'; path='+(options.path):'';var domain=options.domain?'; domain='+(options.domain):'';var secure=options.secure?'; secure':'';document.cookie=[name,'=',encodeURIComponent(value),expires,path,domain,secure].join('');}else{var cookieValue=null;if(document.cookie&&document.cookie!=''){var cookies=document.cookie.split(';');for(var i=0;i<cookies.length;i++){var cookie=jQuery.trim(cookies[i]);if(cookie.substring(0,name.length+1)==(name+'=')){cookieValue=decodeURIComponent(cookie.substring(name.length+1));break;}}}
return cookieValue;}};function LogoutUserOut()
{$.cookie('fullname_id','');$.cookie('email_id','');setTimeout(function(){window.location.replace('logout.php');},500);return false;}
function vpb_maintenance(action)
{if(action=="set_to_maintenance")
{var action_word="set this website <b>to maintenance mode</b>";}
else if(action=="remove_from_maintenance")
{var action_word="remove this website <b>from maintenance mode</b>";}
else{}
if(confirm('If you are sure that you really want to '+action_word+' then click on OK otherwise, click on Cancel'))
{var dataString="page=maintenance_settings&maintenance_action="+action;$.ajax({type:"POST",url:"save_details.php",data:dataString,cache:false,beforeSend:function()
{if(action=="set_to_maintenance")
{$(".set_to_maintenance").hide();}
else if(action=="remove_from_maintenance")
{$(".remove_from_maintenance").hide();}
else{}
$("#maintenance_loading_image").html('<div style="padding:10px; margin-right:40px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="icons/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div>');},success:function(response)
{$("#maintenance_loading_image").html('');if(action=="set_to_maintenance")
{$(".remove_from_maintenance").show();}
else if(action=="remove_from_maintenance")
{$(".set_to_maintenance").show();}
else{}}});}
return false;}
$(document).ready(function()
{vpb_bottom_notification();vpb_restriction();vpb_main_index_pagination('1');vpb_entire_users_pagination('1');if($.cookie('vpb_emails_sending_updates')=="send_email_with_ajax_and_jquery")
{$("div#send_seasons_email").hide();$("div#send_email_with_ajax_and_jquery").show();}
else if($.cookie('vpb_emails_sending_updates')=="send_seasons_email")
{$("div#send_email_with_ajax_and_jquery").hide();$("div#send_seasons_email").show();}
else{}
if($.browser.msie)
{if($.browser.version<parseInt(9))
{window.location.replace('browser_upgrade.php');}
else{}}
$('#yourmessage').click(function()
{$("#unexpand_textarea_invitation_box").show();$("#unexpand_textarea_invitation_boxd").show();});$("#vpb_pop_up_background").live('click',function()
{vpb_close_ads_popups();});});function vasplus_i_alert(vpb_alert_content)
{$.vasplus_i_alrt({'vpb_confirmation_heading':'Information','vpb_confirmation_body':vpb_alert_content,'vpb_proceed_button':' OK ','vpb_cancel_button':''});}
function vasplus_i_exit_alert()
{$('#vasplus_programming_blog_confirmation_alert_box').fadeOut(function(){$(this).remove();});var vpb_alert_focus=$("#vpb_alert_focus").val();if(vpb_alert_focus!=""){$(vpb_alert_focus).focus();}}
$(document).ready(function()
{$.vasplus_i_alrt=function(vpb_contents){if($('#vasplus_programming_blog_confirmation_alert_box').length){return false;}else{var vasplus_i_laod=['<div id="vasplus_programming_blog_confirmation_alert_box">','<div id="vasplus_programming_blog_confirmation_alert_box_contents">','<div id = "vasplus_programming_blog_confirmation_alert_box_headers">'+vpb_contents.vpb_confirmation_heading+'</div>','<p>'+vpb_contents.vpb_confirmation_body+'</p>','<center><div id="vpb_confirmation_buttons" align="center" style="margin-left:0px;"><div class="vpb_confirmation_buttons_yes" onClick="vasplus_i_exit_alert();">'+vpb_contents.vpb_proceed_button+'</div></div><center></div></div>'].join('');$(vasplus_i_laod).hide().fadeIn('fast').appendTo('body');}}});
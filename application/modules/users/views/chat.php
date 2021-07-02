<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?> 
<script src="<?= $theme_path; ?>/js/chat_js.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>chatty/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>chatty/js/chat.js"></script>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>chatty/css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>chatty/css/screen.css" />    
        
<?php  $bg= $this->session->userdata('user_info'); 
$_SESSION['username']=$bg[0]['name'];
?>   

<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
<div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/chat.png"></div>
Chat
</div>
<div class="message-form-inner attendance_table" style="border-bottom:0">
<?php
foreach($listOfUsers->result() as $res)
{
?>	
<div class="stu_chat">
<div class="stu_chat_img">
<div class="stu_chat_img1"><img src="<?php echo $this->config->item('base_url')."profile_image/student/orginal/".$res->image; ?>" width="50" height="50" /></div>
<div class="stu_chat_img2">
<?php echo $res->name; ?>
<?php
        $online=$res->online_status;
?>		
</div>
<style>

.btng {
    display: inline-block;
    color: #FFF;
    padding: 3px 11px;
    margin-bottom: 0px;
    font-size: 12px;
    font-weight: normal;
    line-height: 1.42857;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-image: none;
    border: 0px solid #FFF;
    border-radius: 4px;
    -moz-user-select: none;
}
</style>
<div class="stu_chat_online">
<div class="btng online" style="background-color:<?=($online==1)?'green':'red'?>;"><?=($online==1)?'Online':'Offline'?></div>

<?php if($this->user_auth->get_username()==$res->name) { ?>

<?php } else { ?>  
<a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $res->name; ?>');" class="btn2 btn-primary2" ><i class="fa fa-envelope-o"></i> Chat</a>
<?php } ?>  
</div>
</div>
</div>

        <?php }?>

<!--<table class="table table-striped table-bordered table-hover" id="sample_2">
    <tbody>
		<?php
        foreach($listOfUsers->result() as $res)
        {
        ?>		
        
        
        
        							
        <tr class="odd gradeX">
            <td><img src="<?php echo $this->config->item('base_url')."profile_image/student/orginal/".$res->image; ?>" width="50" height="50" /></td>
            <td class="hidden-480"><?php echo $res->name; ?></td>
            <td class="hidden-480">
            <?php
            $online=$res->online_status;
            if($online==1)
            {
            ?>
            <a href="#" class="btn green icn-only" style="background-color:#0C6;" ><i class="icon-user icon-white"></i></a>
            <?php
            }
            else
            {
            ?>
            <a href="#" class="btn gray icn-only" style="background-color:#CCC;" ><i class="icon-user icon-white"></i></a>
            <?php } ?>
            
            <?php if($this->user_auth->get_username()==$res->name) { ?>
            <a href="#" style="text-decoration:none"></a>
            <?php } else { ?>  
            <a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $res->name; ?>');" class="btn mini purple" >
            <?php } ?>      
            <?php echo "Chat";  ?>
                                  </a>
		 </td>
        </tr>
        <?php
        }
        ?>                                      
  </tbody>
</table>-->

</div>
</div></div>



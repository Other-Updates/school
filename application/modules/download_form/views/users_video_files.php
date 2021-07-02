<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#dd').attr('src','//www.youtube.com/embed/3CA1Su58SG8?list=PLQndNexFjUWnRdVNiyFf9u2aO0o1CqS8G');	
	});
		
	$('.ff').live('click',function(){
		if($(this).attr('id')==1)
			$('#dd').attr('src','//www.youtube.com/embed/3CA1Su58SG8?list=PLQndNexFjUWnRdVNiyFf9u2aO0o1CqS8G');	
		else if($(this).attr('id')==2)
			$('#dd').attr('src','//www.youtube.com/embed/tvC1WCdV1XU?list=PLAE85DE8440AA6B83');	
		else if($(this).attr('id')==3)
			$('#dd').attr('src','//www.youtube.com/embed/x_9lfHjYtVg?list=PL0EE421AE8BCEBA4A');	
		else if($(this).attr('id')==4)
			$('#dd').attr('src','//www.youtube.com/embed/Hl-zzrqQoSE?list=PLFE2CE09D83EE3E28');
		else if($(this).attr('id')==5)
			$('#dd').attr('src','//www.youtube-nocookie.com/embed/iCUV3iv9xOs?list=PL442FA2C127377F07');				
	});
	
</script>
<style type="text/css">
.ff
{
	width:130px;
}
</style>
<div class="message-container">
    <div class="message-form-content">
    <div class="message-form-header">
        <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/profile.png"></div>
        Videos		
    </div>
        <div class="message-form-inner">
        <div class="row">
            <div id='left' class="nine columns">
                <iframe id='dd' width="100%" height="300"  frameborder="0" allowfullscreen></iframe>
            </div>
            <div id='right' class="three columns" style="height:300px; overflow-y:auto;">
                <table class="view_table" align="center">
                    <tr>
                        <td><input type="button" id="1" class="ff btn btn-primary" value="C Tutorial"></td>
                    </tr>
                    <tr>
                        <td><input type="button" id="2" class="ff btn btn-primary" value="C++ Tutorial"></td>
                    </tr>
                     <tr>
                        <td><input type="button" id="3" class="ff btn btn-primary" value="C# Tutorial"></td>
                    </tr>
                    <tr>
                        <td><input type="button" id="4" class="ff btn btn-primary" value="JAVA Tutorial"></td>
                    </tr>
                    <tr>
                        <td><input type="button" id="5" class="ff btn btn-primary" value="PHP Tutorial"></td>
                    </tr>
                   
                </table>
            </div>
           </div>
        </div>
    </div>
</div>
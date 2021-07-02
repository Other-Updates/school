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
	width:250px;
}
</style>
<section class="content">
    <div>
        <div id='left' style="float:left;width:70%;height:50%;">
            <iframe id='dd' width="720" height="470"  frameborder="0" allowfullscreen></iframe>
        </div>
        <div id='right' style="float:left;width:29%; height:468px; overflow-y:auto;">
            <table>
            	<tr>
                	<td><input type="button" id="1" class="ff btn btn-info btn-lg" value="C Tutorial"></td>
                </tr>
                <tr>
                	<td><input type="button" id="2" class="ff btn btn-info btn-lg" value="C++ Tutorial"></td>
                </tr>
                 <tr>
                	<td><input type="button" id="3" class="ff btn btn-info btn-lg" value="C# Tutorial"></td>
                </tr>
                <tr>
                	<td><input type="button" id="4" class="ff btn btn-info btn-lg" value="JAVA Tutorial"></td>
                </tr>
                <tr>
                	<td><input type="button" id="5" class="ff btn btn-info btn-lg" value="PHP Tutorial"></td>
                </tr>               
            </table>
        </div>
    </div>
</section>
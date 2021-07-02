<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?> 
<div class="message-container"> 
<div class="message-form-content">
    <div class="message-form-header">
        <div class="message-form-user">
            <img src="<?=$theme_path;?>/images/icons/events/subject.png">
        </div>
        Books / CD & DVD / Exam Papers
    </div>
	<?php
		$user_info=$this->session->userdata('user_info');
	?>
    <input type="hidden" value="<?=$user_info[0]['std_id'];?>" id='roll_no' />
    <div class="message-form-inner" id='my_books'>
     	
    </div>
</div>
</div>


<script type="text/javascript">
	$(document).ready(function(e) {
        $.ajax({
		  url:BASE_URL+"library/get_student_info_for_student_side",
		  type:'GET',
		  data:{ roll_no:$('#roll_no').val()},
			  success:function(result)
			  {
				$("#my_books").html(result);
			  }   
		 });
    });
</script>
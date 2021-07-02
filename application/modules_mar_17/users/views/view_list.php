<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?> 
<link href="<?= $theme_path; ?>/css/footable.core.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/footable-demos.css" rel="stylesheet" type="text/css" />
<script src="<?= $theme_path; ?>/js/footable.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function () {
		$('table').footable();
	});
</script>

<div id="view_all" display="none">
 
    <table width="100%" class="table demo my_table_style">
    <thead>
<th colspan="4"><?php echo $sub[0]['semester']; ?></th>
</thead>
   		 <thead>
    	 <tr style="background-color: rgb(250, 250, 250);"><th>Sub-code</th><th>Subject</th><th>Credits</th><th data-hide="phone">Staff Name</th></tr>
      	 </thead>
          <?php
	 if(isset($sub) && !empty($sub ))
	 {
		 
     	foreach($sub as $val)
        {?>
         <tr>
        <td><?=$val['scode']?></td>
        <td><?=$val['nick_name'] ?></td>
        <td><?=$val['grade_point'] ?></td>
        <td><?=$val['staff_name'] ?></td></tr>
   
    <?php 
		}
	 }?>
  </table>    
   
    
</div>
<br />
<div>
<table border="0" width="100%">
<?php 
if(isset($sub) && !empty($sub))
				{
                foreach($sub as $val)
                { ?>
	<tr><td style="font-family:Georgia, 'Times New Roman', Times, serif;font-size:16px;"><?php echo $val['nick_name']; ?></td>
    <td>-</td><td style="font-family:Georgia, 'Times New Roman', Times, serif;font-size:16px;"><?php echo $val['subject_name']; ?></td></tr>
    <?php }} ?>
</table>
</div> 
 <p class="user_print_use">
<input type="button"  class='btn btn-primary print_btn right' value="Print" /> 
</p>
<script type="text/javascript">
$(document).ready(function(){
	$('.print_btn').click(function(){
		window.print();	
	});	
});
</script> 
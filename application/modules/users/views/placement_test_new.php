<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); 
/*$title=explode(",", $all_info[0]['time']);*/
?>
<style>
#txt {
border:2px solid #ddd;
font-family:verdana;
font-size:8pt;
font-weight:bold;
background: red;
width:55px;
text-align:center;
color:#fff;
border-radius: 5px;
}
</style>

<script>
var ct = setInterval("calculate_time()",100); // Start clock.
function calculate_time()
{
 var end_time = "<?php echo $_SESSION["start_time"]; ?>"; // Get end time from session variable (total time in seconds).
 var dt = new Date(); // Create date object.
 var time_stamp = dt.getTime()/1000; // Get current minutes (converted to seconds).
 var total_time = end_time - Math.round(time_stamp); // Subtract current seconds from total seconds to get seconds remaining.
 var mins = Math.floor(total_time / 60); // Extract minutes from seconds remaining.
 var secs = total_time - (mins * 60); // Extract remainder seconds if any.
 if(secs < 10){secs = "0" + secs;} // Check if seconds are less than 10 and add a 0 in front.
 document.getElementById("txt").value = mins + ":" + secs; // Display remaining minutes and seconds.
 // Check for end of time, stop clock and display message.
 if(mins <= 0)
 {
  if(secs <= 0 || mins < 0)
  {
   clearInterval(ct);
   document.getElementById("txt").value = "0:00";
   alert("Sorry!! The time is up....");
	document.getElementById("sub_bt_1").click();
   }
  }
 }
</script>
<script>
 $(document).ready(function(){
  $("#pop_sumb").click(function(){
   $("#sub_bt_1").trigger( "click" );
  });
}); 
</script>
<div class="message-container">
<div class="message-form-content">
  
<div class="message-form-header">
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/placement_test.png"></div>
    Placement Test			
</div>  
<div class="message-form-inner"> 
<div class="user_print_use plac_testing">

<?php if(isset($result_dt) && !empty($result_dt)){ ?>
Your Answers Submitted Successfully...!
<?php
}
else if(isset($qus_list) && !empty($qus_list))
{
	$stud_det = $this->session->userdata('user_info');
		
	$this->db->select('*');	
	$this->db->where('stud_id',$stud_det[0]['id']);
	$this->db->where('status','1');
	$tot_row= $this->db->get('place_test_resul')->num_rows();	
	if($tot_row<1)
	{	
?>

<form name="plac_test" action="users/plac_test_submit" method="post"> 

<div class="left"><strong>Total Time : 30 Minuts</strong></div>
<div class="right"><strong>Timer :</strong> <input id="txt" name="tm" value="" readonly /> <span><strong>Minuts</strong></span></div>
</div>
<br /><br />

<table class="table my_table_style">
<thead>
  <tr>
    <th width="20">#</th>
    <th>Questions</th>
  </tr>
  <tr>
  <th colspan="2" align="left">Multi Choice Questions</th>
  </tr>
</thead> 
 
   
  <?php
  //echo "<pre>"; print_r($qus_list); exit;
  if(isset($qus_list) && !empty($qus_list))
  {
  
  $i =1;
  foreach($qus_list as $st_lit)
  {
	  if($st_lit['question_type']==1)
  {
	$this->db->select('*');	
	$this->db->where('plac_ques_id',$st_lit['id']);	
	
	$this->db->where('status','1');		
	$query = $this->db->get('answer_choice')->result_array();
  ?>

  <tr>
    <td><?=$i?> <input type="hidden" value="<?php echo $st_lit['question_type']; ?>" name="q_type[]" /></td>
    <td><strong><?=$st_lit['question_s'];?></strong>
   
    </td>
  </tr>
  <tr>
  <td colspan="2"><?php if($st_lit['ques_img_name']!='no_image'){ ?>
   <a href="#quest_img<?=$st_lit['id']?>" data-toggle="modal"><img src="<?php echo $this->config->item('base_url');?>/quest_img/thumb/<?=$st_lit['ques_img_name'];?>"/></a>    
    <?php }?> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    <table class="place_questions_opt">      
    <?php
	$j=1;
	foreach($query as $ans_cho)
	{			
	  ?>
      <tr>
        <td width="15"><?=$i.".".$j?></td>
        <td>
        <label><input type="radio" name="choice[<?=$st_lit['id']?>]" value="<?=$ans_cho['option_val']?>" id="<?=$ans_cho['option_val']?>"><span class="questions_opt"><?=$ans_cho['choice']?></span></label></td>
      </tr>      
    <?php
	$j++;
	}
	 ?> 
    </table></td>
  </tr>
  
  
  <?php
  $i++;
  }
  }}?>
</table>

<table class="table my_table_style">
<thead>
  <tr>
  <th colspan="2" align="left">Puzzles</th>
  </tr>
</thead> 

  <?php
  if(isset($qus_list) && !empty($qus_list))
  {
	  
  $i =1;
  foreach($qus_list as $st_lit)
  {
	  if($st_lit['question_type']==2)
  {
	$this->db->select('*');	
	$this->db->where('plac_ques_id',$st_lit['id']);		
	$this->db->where('status','1');		
	$query = $this->db->get('answer_choice')->result_array();	
  ?>

  <tr>
    <td><?=$i?><input type="hidden" value="<?php echo $st_lit['question_type']; ?>" name="q_type[]" /></td>
    <td><strong><?=$st_lit['question_s'];?></strong>
    
    
    </td>
    </tr>
    <tr>
    <td colspan="2"><?php if($st_lit['ques_img_name']!='no_image'){?>
    <a href="#quest_img<?=$st_lit['id']?>" data-toggle="modal"><img class="staff_thumbnail" src="<?php echo $this->config->item('base_url');?>/quest_img/thumb/<?=$st_lit['ques_img_name'];?>"/></a>
    <?php }?></td>
    </tr>
    <tr>
    <td colspan="2">
    <textarea cols="20" rows="4" name="puzzle_answer[<?=$st_lit['id']?>]"></textarea>
    </td>
    
  </tr>
  
  
  <?php
  $i++;
  }
  }}else{
  ?>
  
  <?php } ?>
</table>
<table class="table my_table_style">
<thead>
  <tr>
  <th colspan="2" align="left">Sub Questions</th>
  </tr>
</thead> 

  <?php
  //echo "<pre>"; print_r($qus_list); exit;
  if(isset($qus_list) && !empty($qus_list))
  {
  
  $i =1;
  foreach($qus_list as $st_lit)
  {
	  if($st_lit['question_type']==3)
  {
	$this->db->select('*');	
	$this->db->where('place_quest_id',$st_lit['id']);	
	$this->db->where('status','0');		
	$query_m = $this->db->get('multi_choice_questions')->result_array();
	$j=0;
	foreach($query_m as $m_choice)
	{
		$this->db->select('*');	
		$this->db->where('multi_question_id',$m_choice['id']);		
		$this->db->where('status','0');		
		$query_choice[$j]['multi_choice'] = $this->db->get('multi_choice_answers')->result_array();
		$j++;
	}
		
  ?>

  <tr>
   <td><?=$i?><input type="hidden" value="<?php echo $st_lit['question_type']; ?>" name="q_type[]" /></td>
    <td><strong><?=$st_lit['question_s'];?></strong></td>
    </tr>
    <tr>
    <td colspan="2">
    <?php if($st_lit['ques_img_name']!='no_image'){?>
    <a href="#quest_img<?=$st_lit['id']?>" data-toggle="modal"><img class="staff_thumbnail" src="<?php echo $this->config->item('base_url');?>/quest_img/thumb/<?=$st_lit['ques_img_name'];?>"/></a>
    <?php }?>
    
    </td>
    </tr>
    <tr>
    <td colspan="2">
	<table width="100%" border="0"><?php 
	$mq=0;
	$mc=0;
	$m=1;
	foreach($query_m as $mques)
	{	
	$this->db->select('*');	
	$this->db->where('id',$mques['id']);	
	$this->db->where('status','0');		
	$query_mq[$mq]['mq']= $this->db->get('multi_choice_questions')->result_array();
	
	
	
	?>
    <tr><td width="5%"><?=$i.".".$m?></td><td height="100"><?php echo $query_mq[$mq]['mq'][0]['multi_question']; ?></td></tr>
    <?php 
	
	$mq++;
	$this->db->select('*');	
	$this->db->where('multi_question_id',$mques['id']);	
	$this->db->where('status','0');		
	$query_mc= $this->db->get('multi_choice_answers')->result_array();
	$c=count($query_mc);
	$n=1;
	for($j=0;$j<$c;$j++)
	{
	?>
     <tr><td><?=$i.".".$m.".".$n?></td><td><input type="radio" name="multi_answer[<?=$mques['id']?>]" value="<?=$query_mc[$j]['multi_options'];?>" /><span class="questions_opt"><?php echo $query_mc[$j]['multi_choice'];  ?></span></td></tr>
     <?php 
	 $n++;
	}
	$m++;
	}
	
 
	
	 ?>
    </table></td>
    </tr>
    
    <td>
    
    
          
    
    
    
    </td>
    
    
  
  
  <?php
  $i++;
  }}
  }}?>
 
</table>
<a href="#subit_ok" role="button" data-toggle="modal"><input name="submit" type="submit" value="Submit"  class="btn btn-primary"/></a>
 <input name="dfd" id="sub_bt_1" type="submit" value="Submit"  style="display:none"/> 


<?php  }else{ ?>
Sorry...! No Questions Found...
<?php } ?>
</form>
</div>
</div>

</div>
<div id="plac_img" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-body center">
<button type="button" class="close1" data-dismiss="modal" aria-hidden="true">×</button>
<img src="<?php echo $this->config->item('base_url');?>/quest_img/orginal/<?=$st_lit['ques_img_name'];?>" width="50%"/>
</div>
</div> 

<div id="subit_ok" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<a class="close" data-dismiss="modal">×</a>
<h3 id="myModalLabel">Conformation</h3>
</div>
<div class="modal-body center">
<strong>Are you sure submit the answer?</strong>
</div>
<div class="modal-footer">   
<input type="button" class="btn btn-primary" value="Yes" id="pop_sumb">
<input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel" value="No">
</div>
</div>
<?php 
		if(isset($qus_list) && !empty($qus_list))
		{
			foreach($qus_list as $val)
			{
				?>
<div id="quest_img<?=$val['id']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body center">
<a class="close1" data-dismiss="modal">×</a>
<img src="<?=$this->config->item('base_url').'quest_img/'.$val['ques_img_name']?>"  width="50%"/>
</div>
</div>

<?php
			}} ?>
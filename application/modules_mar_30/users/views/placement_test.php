<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); 
/*$title=explode(",", $all_info[0]['time']);*/
$minutes = 30; // Enter minutes
$seconds = 0; // Enter seconds
$time_limit = ($minutes * 60) + $seconds + 1; // Convert total time into seconds
if(!isset($_SESSION["start_time"])){$_SESSION["start_time"] = mktime(date('G'),date('i'),date('s'),date('m'),date('d'),date('Y')) + $time_limit;} // 
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

<script type="text/javascript">
 $(document).ready(function()
 {
  $("#sem_id").focus(); // THIS IS FOR FOCCUSSING THE FIRST ELEMENT WHEN LOADING THE PAGE
  $("#sem_id").change(function()
  {
	  $("#res_dv").html('<img src="<?=$theme_path; ?>/img/ajax_loader/s_loader_gr.gif" />'); // THIS IS FOR ASSIGNING THE LOADING IMAGE 
	 	  
   var sem_id=$("#sem_id").val();
   if(sem_id=='0')
   {
	   	$("#res_dv").html(''); // THIS IS FOR ASSIGNING THE LOADING IMAGE 		 
   }
   else
   {
   //alert(staff_id);
     $.ajax({
      url:BASE_URL+"users/attendance_list",
      type:'POST',
      data:{ sem_id : sem_id},
      success:function(result){      
      $("#res_dv").html(result);
	 
      }    
    
    });
	
   }
   }); 
   
 });
 
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
</thead>  
   <?php
 
  $i =1;
  foreach($qus_list as $st_lit)
  {
	$this->db->select('*');	
	$this->db->where('plac_ques_id',$st_lit['id']);		
	$this->db->where('status','1');		
	$query = $this->db->get('answer_choice')->result_array();
	
	$this->db->select('*');	
	$this->db->where('id',$st_lit['batch_id']);		
	$this->db->where('status','1');		
	$query_b = $this->db->get('batch')->result_array();
		
  ?>
  <tr>
    <td><?=$i?></td>
    <td><strong><?=$st_lit['question_s'];?></strong> <br/>
   <?php if($st_lit['ques_img_name']!='no_image'){ ?>
   <a href="#plac_img" role="button" data-toggle="modal"><img src="<?php echo $this->config->item('base_url');?>/quest_img/thumb/<?=$st_lit['ques_img_name'];?>"/></a>    
    <?php }?> 
    </td>
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
        <td width="15"><?=$j?></td>
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

  ?>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td><a href="#subit_ok" role="button" data-toggle="modal"><input name="submit" id="sub_bt" type="submit" value="Submit"  class="btn btn-primary"/>
    </a><input name="dfd" id="sub_bt_1" type="submit" value="Submit"  style="display:none"/></td>
  </tr>
</table>

</form>
<?php } }else{ ?>
Sorry...! No Questions Found...
<?php } ?>
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
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
   //document.plac_test.submit();
   document.getElementById("sub_bt").click();
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
 
 
</script>
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/placement_test.png"></div>
    Placement Test			
</div>  
<div class="page-inner"><div class="page-title"><span>Placement Paper</span> </div></div>
<div class="message-divider"></div>
<div class="message-form-inner">
<table class="view_table">
<tr>
<td>Description</td>
<td width="5">:</td>
<td class="text_bold" style="line-height:25px">Placement Papers from Various Companies like TCS, WIPRO, QUARK, INFOSYS, NEWGEN, CANON, DELL and Others IT Companies</td>
</tr>
<tr>
<td>Total&nbsp;Questions</td>
<td width="5">:</td>
<td class="text_bold">25</td>
</tr>
<tr>
<td>Total Time</td>
<td width="5">:</td>
<td class="text_bold red">30mins</td>
</tr>
<tr>
<td>Keywords</td>
<td width="5">:</td>
<td class="text_bold" style="line-height:25px">Placement Paper, IT Placement Papers, Sample Placement Papers, IT Companies Placement Papers, Time and Distance, Data Structure, Biology and Human Welfare.</td>
</tr>
</table> 
<br />
<?php
$stud_det = $this->session->userdata('user_info');
		
	$this->db->select('*');	
	$this->db->where('stud_id',$stud_det[0]['id']);
	$this->db->where('status','1');
	$tot_row= $this->db->get('place_test_resul')->num_rows();	
	if($tot_row<1)
	{	
?>
<a href="<?=$this->config->item('base_url').'users/plac_test_new'?>" ><input name="start" value="Start Test" type="button" class="btn btn-primary right"/></a>
<?php } ?>
</div>
</div>
</div>

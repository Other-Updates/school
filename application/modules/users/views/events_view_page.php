<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<?php $student=$this->session->userdata('user_info');?>
<?php $user_det = $this->session->userdata('logged_in');?>

<form>
 <?php
	if(isset($student) && !empty($student))
	{
 foreach ($student as $row)
{
?>
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
<div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/events.png"></div>
Events			
</div>
<div class="message-form-inner view_table">
<div class="row">
 <?php
	if(isset($details) && !empty($details))
	{
 foreach ($details as $val)
 {
	?>
 
<table width="100%">
		   <tbody>	
           <div class="six columns">

<?php
if($val['image']!=''){
?>
 <img style="width:100%; overflow:hidden;" src="<?=$this->config->item('base_url').'profile_image/events/orginal/'.$val['image']?>" />
 <?php
}else
{
 ?>
 <img style="width:100%; overflow:hidden;" src="<?=$this->config->item('base_url').'profile_image/events/orginal/events.png'?>" />
<?php 
}
?>
</div>
		   <tr>
		   		<td width="130">Event Name</td>
				<td width="2">:</td>
				<td class="text_bold green"><?php echo $val['event_name'];?></td>
                
		   </tr>
</tbody>
</table>           
<div class="six columns">
<table width="100%">
		   <tbody>	
		   <tr>
		   		<td width="130">Department</td>
				<td width="2">:</td>
				 <td>
			   <?php
				if($val['department']=='')
				echo "***";
				else
				echo $val['department']; 
				?>
               </td>
		   </tr>
		   </tbody>
</table>
</div>
<div class="six columns">
<table width="100%">
		   <tbody>	
		   <tr>
				<td width="130">Batch</td>
				<td width="2" >:</td>
				 <td>
				 <?php
				if($val['from']==''&& $val['to']=='')
				echo "***";
				else                                                         
				echo $val['from'].'-'.$val['to']; 
				?>
                </td>
		   </tr>
		   </tbody>
</table>
</div>
<table width="100%">
		   <tbody>	
		   <tr>
		   		<td width="130">Venue</td>
				<td width="2">:</td>
				<td class="text_bold"><?php echo $val['venue'];?></td>
		   </tr>
</tbody>
</table>
</div>
<div class="row">
<div class="six columns">
<table>
<td>Staff Name</td>
<td width="2">:</td>
<td  class="text_bold red"><?php echo $val['staff_name'];?></td>
</tr>
<tr>
<td>Staff department</td>
<td width="2">:</td>
<td  class="text_bold red"><?php echo $val['department'];?></td>
</tr>
		
</table>
</div>
<div class="six columns">
<table width="100%">
		   <tbody>	
		   <tr>
				<td width="130">Date</td>
				<td width="2" >:</td>
				<td class="text_bold red"><?php echo date('d-m-Y',strtotime($val['date']));?></td>
		   </tr>
		   </tbody>
</table>
</div>
</div>
<!--<div class="page-inner"><div class="page-title"><span>Student Details</span></div></div>-->
<div class="row">
<div class="six columns">
<table width="100%">
        <tbody>	
         <tr>
         <input type="hidden" class="eveid" value="<?=$val['id']?>" /> 
            <input type="hidden" class="name" value="<?=$row['name']?>" />
            <input type="hidden" class="id" id="id" value="<?=$row['id']?>"  />
            <input type="hidden" class="email" value="<?=$row['email_id']?>" />
            <input type="hidden" class="phone" value="<?=$row['contact_no']?>" />
            <input type="hidden" class="batch" value="<?=$row['from'].'-'.$row['to']?>" />
            <input type="hidden" class="depart" value="<?php echo $row['department'];?>" />
            <input type="hidden" class="group" value="<?php echo $row['group'];?>" />
         </tr>
        </tbody>
</table>

<table>

<tr>
<td>
 <?php 
	if(isset($participate) && empty($participate))
	{
		
	 if($participate[0]['p_status']==0)
	 {
	?>
    <button type="button" name="submit" id="participate" class=" btn btn-primary btn-sm hid partici">Click Here To Participate</button>  
    <span id="dup" class="dup" style="color:#F00; font-style:italic;"></span>   
    
    <?php 
	}}?>
    </td>
    <td>
    <a href="<?=$this->config->item('base_url').'users/events_view'?>"><input type="button" value="Back" class="btn btn-danger"  /></a>
    </td>
    </tr>
    
</table>

<div id="participate"> </div>
  <?php 
    }
    ?>
    <?php		
    }
    ?>
</div>


    <?php 
    }
    ?>
    <?php		
    }
    ?>
</div>
</div>
</div>
</div>
</form>






<script type="text/javascript">

 $("#participate").live("click",function()
		  {
			
			  var i=0;
			  var eveid=$(".eveid").val();
		   var name=$(".name").val();
		   email=$(".email").val();
		   phone=$(".phone").val();
		   batch=$(".batch").val();
		   depart=$(".depart").val();
		   group=$(".group").val();
		   var id=$('.id').val();
		   
		    //id=$(".eveid").val();
		
		    //alert(id);
		 $.ajax(
		 {
		  url:BASE_URL+"users/participate_check",
		  type:'POST',
		   data:{ eve_id:eveid,value2:id},
		  success:function(result)
		  {
			  
		    $("#dup").html(result);	  
			i=1;
		  }    		
		});
		 // alert(name + phone + batch + depart + group);
		 if(i==1)
		 {
			 return false;
		 }
		 else
		 {
		  $.ajax(
		 {
			  url:BASE_URL+"users/insert_eve",
			  type:'get',
			  data:{ value1 : id,value2:email,value3:phone,value4:batch,value5:depart,value6:group,value7:eveid},
			  
 success:function(result)
		  {
		     window.location.href=BASE_URL+"users/events_view";
      			
		  }    		
		});
		 }
			});	
			
			
			
			
		
			
			/*$(".name").val('');
		
	   		$(".email").val('');
			
			$(".phone").val(''); 
			
			$(".batch").val(''); 
				
			$(".depart").val('');
		
			$(".group").val('');
			
			$("id").val(''); */
				
</script>




<script type="text/javascript">
// STYLE NAME DUPLICATION
<?php /*?>$(".partici").live("click",function()
{
			var i=0;//alert("hi");
         id=$(".eveid").val();
		
		    alert(id);
		 $.ajax(
		 {
		  url:BASE_URL+"users/participate_check",
		  type:'POST',
		   data:{ value1:id},
		  success:function(result)
		  {
			  
		    $("#dup").html(result);	  
			len=((result + '').length);
			if(len>2){$("#participate").attr("disabled",true);
			i=1;}
			else{$("#participate").attr("disabled",false);}
		  }    		
		});
		if(i==1)
		{
			return false;
		}
		else
		{
			return true;
		}
		
 }); 
<?php */?>


</script>

   	

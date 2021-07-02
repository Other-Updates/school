<script>
$('.mandatory1').live('blur',function() 
	{
		var m=$(this).parent().find(".val_one");
		
		if($(this).val()=='' || $(this).val()==null || $(this).val().trim().length==0 || $(this).val()=='.' || $(this).val()==',')
		{
			$(this).css('border','1px solid red');		
			m.html("Required field");	
			i=1;
			
		} 
		else
		{
			$(this).css('border','1px solid #CCCCCC');
			m.html("");		
		}
	});	
$("#rtono").live('blur',function()
{
	var rtono=$("#rtono").val();
	var filter= /\w+.*$/;
	if(rtono=="" || rtono==null || rtono.trim().length==0)
	{
		$("#v1").html("Required Field");
	}
	else if(!filter.test(rtono))
	{
		$("#v1").html("Enter Valid RTO NO");
	}
	else if (rtono.trim().length<3 || rtono.trim().length>20) 
	{
		$("#v1").html("Minimum 3 to Maximum 20");
	}
	else
	{
		$("#v1").html("");
	}
});
$("#busno").live('blur',function()
{
	var busno=$("#busno").val();
	var filter=/\w+.*$/;
	if(busno=="")
	{
		$("#v2").html("Required Field");
	}
	else if(!filter.test(busno))
	{
		$("#v2").html("Required Field");
	}
	else
	{
		$("#v2").html("");
	}
	});
$("#drivname").live('blur',function()
{
	var drivname=$("#drivname").val();
	if(drivname=="0")
	{
		$("#v3").html("Required Field");
	}
	else
	{
		$("#v3").html("");
	}
});
$("#clename").live('blur',function()
{
	var clename=$("#clename").val();
	if(clename=="0")
	{
		$("#v4").html("Required Field");
	}
	else
	{
		$("#v4").html("");
	}
});
</script>
<script>
$("#root").live('blur',function()
{
	var root=$("#root").val();
	var filter=/\w+.*$/;
	if(root=="")
	{
		$("#y1").html("Required Field");
	}
	else if(!filter.test(root))
	{
		$("#y1").html("Required Field");
	}
	else
	{
		$("#y1").html("");
	}
});
$("#source").live('blur',function()
{
	var source=$("#source").val();
	var filter=/\w+.*$/;
	if(source=="")
	{
		$("#y2").html("Required Field");
	}
	else if(!filter.test(source))
	{
		$("#y2").html("Required Field");
	}
	else
	{
		$("#y2").html("");
	}
	});
	$("#busn").live('blur',function()
{
	var busn=$("#busn").val();
	if(busn=="0")
	{
		$("#y3").html("Required Field");
	}
	else
	{
		$("#y3").html("");
	}
});
	</script>
    <script>
	$(".rtono1").live('blur',function() 
	{
		var rtoup=$(this).val();
		var m=$(this).offsetParent().find('.up_rtono');
  		
		  if(rtoup=='' || rtoup==null || rtoup.trim().length==0)
		  {
			  m.html("Required field");
			 $(this).css('border','1px solid red');
		  }
		 
		  else
		  {
			m.html("");
			$(this).css('border','1px solid #CCCCCC');
		  }
		});	
		$(".busno1").live('blur',function() 
	{
		var busup=$(this).val();
		var m=$(this).parent().parent().parent().find('.up_busno');
  		
		  if(busup=='' || busup==null || busup.trim().length==0)
		  {
			  m.html("Required field");
			 $(this).css('border','1px solid red');
		  }
		 
		  else
		  {
			m.html("");
			$(this).css('border','1px solid #CCCCCC');
		  }
		});	
    </script>

<div class="row">
<div class="col-lg-6">
<section class="content-header"><h3>Add Bus</h3></section>
<table class="staff_table">
<tr><td>Bus RTO.No</td><td><input type="text" name="rtono" id="rtono" class="rtono mandatory" />
<span id="v1" class="val" style="color:#F00;"></span></td></tr>
<tr><td>Bus No</td><td><input type="text" name="busno" id="busno" class="busno mandatory bus_dup" /><span id="v2" class="val" style="color:#F00;"></span><span id="dup" class="val" style="color:#F00;"></span></tr></td>
<tr><td>Driver Name</td>
        <td>
        	<select id='drivname' name='drivname'  class="drivname mandatory">
            	<option value="0">Select</option>
				<?php 
                    if(isset($all_staff) && !empty($all_staff)){
                        foreach($all_staff as $val)
                        {
                            ?>
                                <option value="<?=$val['id']?>"><?=$val['staff_name']?></option>
                            <?php 
                        }
                    }
                ?>
            </select><span id="v3" class="val" style="color:#F00;"></span>
        </td></tr>
        <tr><td>In-charge Name</td>
        <td>
        	<select id='clename' name='clename'  class="clename mandatory">
            	<option value="0">Select</option>
				<?php 
                    if(isset($all_cleaner) && !empty($all_cleaner)){
                        foreach($all_cleaner as $value)
                        {
                            ?>
                                <option value="<?=$value['id']?>"><?=$value['staff_name']?></option>
                            <?php 
                        }
                    }
                ?>
            </select><span id="v4" class="val" style="color:#F00;"></span>
        </td></tr>
        <tr><td></td><td><input type="button" value="Add" name="adding" id="submit" onclick="return validate()" class="btn btn-primary"/>&nbsp;&nbsp;
        <input type="button" value="Cancel" id="cancel" class="btn btn-danger"/></td>
    </tr></table>
    <br /><br />
    <table id="example1" class="table table-bordered table-striped" style="font-size:10px;">
            <thead>
            <tr>
                <th>S.No</th>
                <th>Bu&nbsp;RTO.No</th>
                <th>Bus.No</th>
                <th>Driver&nbsp;Name</th>
                <th>In-Charge&nbsp;Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
			<?php 
			
                if(isset($details) && !empty($details))
                {
						
					$i=0;
                    foreach($details as $billto) 
                    {
                       $i++
            ?>   
                 <tr>
                 <td><?php echo "$i"; ?></td>
                 <td><?php echo $billto["rto_no"]; ?></td>
                 <td><?php echo $billto["bus_no"]; ?></td>
                 <td><?php echo $billto['driver'][0]['driver'];?></td>
                 <td><?php echo $billto['cleaner'][0]['cleaner'];?></td>
                 
                 </td>
                 <td>
          <a href="#test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm" title="View"><i class="fa fa-eye"></i></a>
          <a href="#test1_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                 
                </td>
                </tr>
           <?php   
            }}
        ?>
        </tbody>
	    </table>
        
        
<!--VIEW FORM 1........................................................................................................................................-->        
        <?php 
if(isset($details) && !empty($details))
{
foreach($details as $billto) 
{
 ?>   

<div id="test_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel">Bus View</h3>
    </div>
  <div class="modal-body">
  <table width="100%" class="staff_table_sub">
        <tr>
          <td><strong>Bus RTO.No</strong></td> <td class="text_bold1"><?php echo $billto["rto_no"]; ?></td></tr>
          <td><strong>Bus No</strong></td> <td class="text_bold1"><?php echo $billto["bus_no"]; ?></td></tr>
          <td><strong>Driver Name</strong></td> <td class="text_bold1"><?= $billto['driver'][0]['driver'];?></td></tr>
          <td><strong>In-charge Name</strong></td> <td class="text_bold1"><?=$billto['cleaner'][0]['cleaner'];?></td></tr>
  </table>
   </div>
  <div class="modal-footer">
     <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Discard</button>    
  </div>
  </div>
  </div>
</div>
<?php }} ?>
</div>
  
  
 <!-- UPDATE FORM 1...................................................................................................................-->
  <?php 
if(isset($details) && !empty($details))
{
foreach($details as $billto) 
{
 ?>   

<div id="test1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  	<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a>   
    <h3 id="myModalLabel">Update Bus</h3></div>
  	<div class="modal-body">
    <table width="100%">
         <tr>
         <!--<td><strong>S.No</strong></td>-->
        <td><input type="hidden" name="id" class="id id_update" id="id" value="<?php echo $billto["id"]; ?>" readonly="readonly" />
       </td>
         </tr> 
         <tr><td>Bus RTO.No</td><td><input type="text" name="rtono1" id="rtono1" class="rtono1" value="<?php echo $billto["rto_no"]; ?>" />
         <input type="hidden" name="rtono1_up" id="rtono1_up" class="rtono1_up" value="<?php echo $billto["rto_no"]; ?>" /><span id="up_rtono" class="up_rtono" style="color:#F00;"></span></td></tr>
<tr><td>Bus No</td><td><input type="text" name="busno1" id="busno1" class="busno1" value="<?php echo $billto["bus_no"]; ?>" />
<input type="hidden" name="busno1_up" id="busno1_up" class="busno1_up" value="<?php echo $billto["bus_no"]; ?>" />
<span id="dup_up" class="dup_up" style="color:#F00;"></span><span id="up_busno" class="up_busno" style="color:#F00;"></span></tr></td>
<tr><td>Driver Name</td>
        <td>
        	<select id='drivname1' name='drivname1'  class=" drivname1">
				<?php 
                    if(isset($all_staff) && !empty($all_staff)){
                        foreach($all_staff as $val)
                        {
                            ?>
                             <option <?=($val['id']==$billto['driver_id'])?'selected':''?> value="<?=$val['id']?>"><?=$val['staff_name']?></option>
                                                     
                            <?php 
                        }
                    }
					
                ?>
                 <input type="hidden" name="driver_id_up" id="driver_id_up" class="driver_id_up" value="<?php echo $billto["driver_id"] ?>" />
               
            </select>
            
        </td></tr>
        <tr><td>In-Charge Name</td>
        <td>
        	<select id='clename1' name='clename1'  class=" clename1">
            	
				<?php 
                    if(isset($all_cleaner) && !empty($all_cleaner)){
                        foreach($all_cleaner as $value)
                        {
							
                            ?>
                            <option <?=($value['id']==$billto['cleaner_id'])?'selected':''?> value="<?=$value['id']?>"><?=$value['staff_name']?></option>
                               
                            <?php 
                        }
                    }
                ?>
                 <input type="hidden" name="cleaner_id_up" id="cleaner_id_up" class="cleaner_id_up" value="<?php echo $billto["cleaner_id"]; ?>" />
            </select>
           
        </td></tr>        
         
         </tr>
         </table>
    
     	
  	</div>
  		<div class="modal-footer">
   			 <button type="button" class="btn btn-primary"  id="update"><i class="fa fa-edit"></i> Update</button>
    		 <button type="reset" data-dismiss="modal" class="btn btn-danger no_up"  id="no_up" ><i class="fa fa-times"></i> Discard</button>
  		</div>
</div>
</div>        
</div>
<?php }} ?>

<!--**********************************************************************************************************************************************************--> 
<div class="col-lg-6">
<section class="content-header"><h3>Route View</h3></section>
<table class="staff_table">
<tr><td>Route Name</td><td><input type="text" name="root" id="root" class="root mandatory1 route_dup" /><span id="y1" class="val_one" style="color:#F00;"></span></td></tr>
<tr><td>Source</td><td><input type="text" name="source" id="source" class="source mandatory1" /><span id="y2" class="val_one" style="color:#F00;"></span></tr></td>
<tr><td>Bus No</td>
        <td>
  
  <select id='busn' name='busn'  class="mandatory1 route_dup">
            	<option value="">Select</option>
				<?php 
                    if(isset($details) && !empty($details)){
                        foreach($details as $val)
                        {
                            ?>
                                <option value="<?=$val['id']?>"><?=$val['bus_no']?></option>
                            <?php 
                        }
                    }
                ?>
            </select><span id="root_dup" class="root_dup val_one" style="color:#F00;"></span>
<span id="y3" class="val_one" style="color:#F00;"></span>
        </td></tr>
        <tr height="50"><td><p>&nbsp;</p></td><td>&nbsp;</td></tr>
        <tr><td></td><td><input type="button" value="Add" name="adding" id="addin" onclick="return validate()" class="btn btn-primary"/>&nbsp;&nbsp;
        <input type="button" value="Cancel" id="cancel_one" class="btn btn-danger"/></td>
        </tr>
        
        </table><br /><br />
        <table id="example4" class="table table-bordered table-striped" style="font-size:10px">
            <thead>
            <tr>
                <th>S.No</th>
                <th>Route Name</th>
                <th>Source</th>
                <th>Bus No</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
			<?php 
                if(isset($bus_number) && !empty($bus_number))
                {
					$i=0;
                    foreach($bus_number as $billto) 
                    {
                      $i++
            ?>   
                 <tr><td><?php echo "$i"; ?></td>
                 <td><?php echo $billto["root_name"]; ?></td>
                 <td><?php echo $billto["source"]; ?></td>
                 <td><?php echo $billto["bus_no"]; ?></td>
                 </td>
                 <td>
         <a href="#1test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm" title="View"><i class="fa fa-eye"></i></a>
         <a href="#1test1_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                
                </td>
                </tr>
           			<?php   
          			  }
				}
       			 ?>
        </tbody>
	    </table>
        <!--VIEW FORM 2....................................................................................................................................--> 
         <?php 
if(isset($bus_number) && !empty($bus_number))
{
foreach($bus_number as $billto) 
{
 ?>   
<div id="1test_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  <div class="modal-dialog">  <div class="modal-content"> <div class="modal-header"><a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel">Route View</h3></div> <div class="modal-body">
  <table width="100%" class="staff_table_sub">
        <tr>
        <?php /*?><td><strong>S.No</strong></td> <td><?php echo $billto["id"]; ?></td></tr><tr><?php */?>
        <td><strong>Route Name</strong></td> <td class="text_bold1"><?php echo $billto["root_name"]; ?></td></tr>
         <td><strong>Source</strong></td> <td class="text_bold1"><?php echo $billto["source"]; ?></td></tr>
          <td><strong>Bus Number</strong></td> <td class="text_bold1"><?php echo $billto["bus_no"]; ?></td></tr>
         </table> 
  </div>
  <div class="modal-footer">
     <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Discard</button>    
  </div>
  </div>
  </div>
</div>
<?php }} ?>
</div>
 <!-- UPDATE FORM 2.........................................................................................................................................-->
  <?php 
if(isset($bus_number) && !empty($bus_number))
{
foreach($bus_number as $billto) 
{
 ?>   
<div id="1test1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  	<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a>   
    <h3 id="myModalLabel">Update Route</h3></div>
  	<div class="modal-body">
    <table width="100%">
         <tr>
         <!--<td><strong>S.No</strong></td>-->
         <td><input type="hidden" name="id" class="id" id="id" value="<?php echo $billto["id"]; ?>" readonly="readonly" /></td>
         </tr> 
         <tr><td>Route Name</td><td><input type="text" name="root1" id="root1" class="root1 mandatory" value="<?php echo $billto["root_name"]; ?>"  /><span style="color:#F00;" class="errormessage root_error"></span><input type="hidden" class="root1_h"  value="<?php echo $billto["root_name"]; ?>"  /></td></tr>
<tr><td>Source</td>
<td><input type="text" name="source1" id="source1" class="source1 mandatory" value="<?php echo $billto["source"]; ?>"  /><span style="color:#F00;" class="errormessage source_error"></span><input type="hidden" class="source1_h"  value="<?php echo $billto["source"]; ?>"  /></td></tr>
<tr><td>Bus No</td>
        <td>
        	<select id='busn_1' name='busn_1'  class="busn_1 mandatory" >
				<?php 
                    if(isset($details) && !empty($details)){
                        foreach($details as $val)
                        {
                            ?>
                             <option <?=($val['id']==$billto['rbus_no'])?'selected':''?> value="<?=$val['id']?>"><?=$val['bus_no']?></option>
                           
                            <?php 
                        }
                    }
                ?>
            </select><span style="color:#F00;" class="errormessage busno_error"></span>
            <input type="hidden" class="busn_1_h"  value="<?php echo $billto["rbus_no"]; ?>"  />
        </td></tr>
        </table>
    
     	
  	</div>
  		<div class="modal-footer">
   			 <button type="button" class="btn btn-primary"  id="update_1"><i class="fa fa-edit"></i> Update</button>
    		 <button type="reset" class="btn btn-danger"  id="no1" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
  		</div>
</div>
</div>        
</div>
<?php }}?>
</div>


<script type="text/javascript">

$(document).ready(function()
 {
	  $("#submit").click(function()
  {
	     var i=0;
         var rtono=$("#rtono").val();
		 busno=$("#busno").val();
		 drivname=$("#drivname").val();
		 clename=$("#clename").val();
		 var filter= /\w+.*$/;
		 if(rtono=='' || rtono==null)
		  {
			  $("#v1").html("Required Field");
			   $("#rtono").css('border','1px solid red');
			  i=1;
		  }
		  else if(!filter.test(rtono))
			{
				$("#v1").html("Enter Valid RTO NO");
				i=1;
			}
			else if (rtono.trim().length<3 || rtono.trim().length>20) 
			{
				$("#v1").html("Minimum 3 to Maximum 20");
				i=1;
			}
			else
			{
				$("#v1").html("");
			}
		 if(busno=='' || busno==null)
		  {
			  $("#v2").html("Required Field");
			  $("#busno").css('border','1px solid red');
			  i=1;
		  }
		  if(drivname=='0' || drivname==null)
		  {
			  $("#v3").html("Required Field");
			   $("#drivname").css('border','1px solid red');
			  i=1;
		  } 
		  if(clename=='0' || clename==null)
		  {
			  $("#v4").html("Required Field");
			  $("#clename").css('border','1px solid red');
			  i=1;
		  } 
		  else 
		  {
			  
			
		  }
		 if(i==0)
		 {
		  for_loading('Loading... Data add Please Wait '); // loading notification
		 $.ajax(
		 {
		  url:BASE_URL+"transport/insert_transport",
		  type:'get',
		  data:{ value1 : rtono , value2 : busno , value3 : drivname , value4 : clename},
		  success:function(result)
		  {
			//alert(result) ; 
			   //$("#list_all").html('');
		     $("#example1_wrapper").html(result);
			 window.location.reload(BASE_URL+"transport/");
			 for_response('Bus add successfully...!'); // resutl notification
			
		  }    		
		});
		 $("#rtono").val('');
	  $("#busno").val('');
	  $("#drivname").val('');
	  $("#clename").val('');
		 }
  });
}); 
$("#update").live("click",function()
  {	  
  
   var i=0;
   var id=$(this).parent().parent().find('.id').val();
   rtono1=$(this).parent().parent().find('.rtono1').val();
   busno1=$(this).parent().parent().find('.busno1').val();
   drivname1=$(this).parent().parent().find('.drivname1').val();
   clename1=$(this).parent().parent().find('.clename1').val();
   var message=$(this).parent().parent().find('.dup_up').html();
    var block=$(this).parent().parent().find('.rtono1').val(); 
	var blockbus=$(this).parent().parent().find('.busno1').val();
   //alert(message);
   if((message.trim()).length >0)
   {
	   
	 i=1;
	 $(this).parent().parent().find('.busno1').css('border','1px solid red');
	  
   }
   if(block==0 || block=="" || block==null || block.trim().length==0)
	{
		i=1;
		$(this).parent().parent().find('.rtono1').css('border','1px solid red');
		
	}
	 if(blockbus==0 || blockbus=="" || blockbus==null || blockbus.trim().length==0)
	{
		i=1;
		$(this).parent().parent().find('.busno1').css('border','1px solid red');
		
	}
   if(i==0)
   {
   for_loading('Loading... Data add Please Wait '); // loading notification
     $.ajax({
      url:BASE_URL+"transport/update_transport",
      type:'POST',
      data:{ value1 : id,value2:rtono1,value3:busno1,value4:drivname1,value5:clename1},
      success:function(result){
      $("#example1_wrapper").html(result);
	   window.location.reload(BASE_URL+"transport/");
	   for_response('Successfully Update...!'); // resutl notification 
      }   
	   
	 });
	 $('.modal').css("display", "none");
    $('.fade').css("display", "none"); 
  }
	 
   
    });
	 $("#no_up").live("click",function()
	 {
		
		 var rto=$(this).parent().parent().parent().find('.rtono1_up').val();
  		 $(this).parent().parent().find('.rtono1').val(rto);
		 
		 var bus=$(this).parent().parent().parent().find('.busno1_up').val();
  		 $(this).parent().parent().find('.busno1').val(bus);
		 
		  var driv=$(this).parent().parent().parent().find('.driver_id_up').val();
  		 $(this).parent().parent().find('.driver_id').val(driv);
		 
		  var clean=$(this).parent().parent().parent().find('.cleaner_id_up').val();
		 
  		 $(this).parent().parent().find('.cleaner_id').val(clean);
   
   
   
		  $('.modal').css("display", "none");
          $('.fade').css("display", "none");
		 
	 });
	
	 $("#cancel").live("click",function()
  {
	  $("#rtono").val('');
	  $("#busno").val('');
	  $("#drivname").val('');
	  $("#clename").val('');
	   $('.mandatory').val('');
	   $('.val').html('');
	   $('.mandatory').css('border','1px solid #CCCCCC');
   $('.modal').css("display", "none");
    $('.fade').css("display", "none");	  
	 }); 
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
$( "#drivname" ).validate({
  rules: {
    fruit: {
      required: true
    }
  }
});	 

</script>



<script type="text/javascript">
$(document).ready(function()
 {
	  $("#addin").click(function()
  {
	  var i=0;
         var root=$("#root").val();
		 source=$("#source").val();
		 busn=$("#busn").val();
		 
		 if(root=='' || root==null)
		  {
			  $("#y1").html("Required Field");
			   $("#root").css('border','1px solid red');
			  i=1;
		  }
		 if(source=='' || source==null)
		  {
			  $("#y2").html("Required Field");
			   $("#source").css('border','1px solid red');
			  i=1;
		  }
		  if(busn=="" || busn==null)
		  {
			  $("#y3").html("Required Field");
			   $("#busn").css('border','1px solid red');
			  i=1;
		  } 
		  else 
		  {
			
		  }
		 if(i==0)
		 {
		 
		 
		 for_loading('Loading... Data add Please Wait '); // loading notification
		 $.ajax(
		 {
		  url:BASE_URL+"transport/insert1_transport",
		  type:'POST',
		  data:{ value1 : root , value2 : source , value3 : busn},
		  success:function(result)
		  {
			  $("#example4").html('');
			   
		     $("#example4_wrapper").html(result);
			 for_response('Route added successfully ...!'); // resutl notification
		  
		  }    		
		});
			$("#root").val('');
			$("#source").val('');
			$("#busn").val('');
		 }
  });
  
   }); 
   
   //
   $('.root1').live('blur',function()
   {
	   var root1=$(this).val();
	 if(root1=="" || root1==null || root1==0)
	{
		$(this).css('border','1px solid red');
		$(this).offsetParent().find('.root_error').html('Required Field');
		
	}
	else
	{
		$(this).css('border','1px solid #CCCCCC');
	}
   });
   $('.source1').live('blur',function()
   {
	   var source1=$(this).val();
	 if(source1=="" || source1==null || source1==0)
	{
		$(this).css('border','1px solid red');
		$(this).offsetParent().find('.source_error').html('Required Field');
		
	}
	else
	{
		$(this).css('border','1px solid #CCCCCC');
	}
   });
   
   //
   $("#update_1").live("click",function()
  {	  
   
   var id=$(this).parent().parent().find('.id').val();
   
   root1=$(this).parent().parent().find('.root1').val();
   source1=$(this).parent().parent().find('.source1').val();
    busn_1=$(this).parent().parent().find('.busn_1').val();
	var i=0;
	if(root1=="" || root1==null || root1==0)
	{
		$(this).parent().parent().find('.root1').css('border','1px solid red');
		$(this).parent().parent().find('.root_error').html('Required Field');
		i=1;
	}
	if(source1=="" || source1==null || source1==0)
	{
		$(this).parent().parent().find('.source1').css('border','1px solid red');
		$(this).parent().parent().find('.source_error').html('Required Field');
		i=1;
	}
	if(busn_1=="" || busn_1==null || busn_1==0)
	{
		$(this).parent().parent().find('.busn_1').css('border','1px solid red');
		$(this).parent().parent().find('.busno_error').html('Required Field');
		i=1;
	}
	if(i==0)
	{
	    for_loading('Loading... Data add Please Wait '); // loading notification
     $.ajax({
      url:BASE_URL+"transport/update_1_transport",
      type:'POST',
      data:{ value1 : id,value2:root1,value3:source1,value4:busn_1},
      success:function(result){
      $("#example4_wrapper").html(result);
	   for_response('Successfully Update...!'); // resutl notification 
      }   
	 }); 
	 $('.modal').css("display", "none");
    $('.fade').css("display", "none"); 
	}
	else
	{
	}
    });
	$("#cancel_one").live("click",function()
  {
	 $("#root").val('');
	 $("#source").val('');
	 $("#busn").val('');
	 
   $('.modal').css("display", "none");
    $('.fade').css("display", "none");
	 $('.val_one').html('');
	   $('.mandatory1').css('border','1px solid #CCCCCC');	  
	 }); 

	 //duplication checking for bus no 
	 $(".bus_dup").blur(function()
  			{
				
         	busno=$("#busno").val();
		    //alert(busno);
		 $.ajax(
		 {
		  url:BASE_URL+"transport/add_duplicate_busno",
		  type:'POST',
		   data:{ value1:busno},
		  success:function(result)
		  {
		     $("#dup").html(result);
      		len=( (result + '').length );
			if(len>2){$("#submit").attr("disabled", true);}
			else{$("#submit").attr("disabled", false);}
		  	
		  }    		
		});
   }); 
   $(".busno1").blur(function()
  			{
			 	
         	//busno=$("#busno1").val(),
			var busno=$(this).parent().parent().find('.busno1').val();
			//var id=$(this).parent().parent().find('.id_update').val();
			var id=$(this).offsetParent().find('.id_update').val();
			var message=$(this).offsetParent().find('.dup_up');
			//alert(id);
			//id=$(".id_update").val(),
		   
		 $.ajax(
		 {
		  url:BASE_URL+"transport/update_duplicate_busno",
		  type:'POST',
		   data:{ value1:busno,value2:id},
		  success:function(result)
		  {
		     message.html(result);
      		//len=( (result + '').length );
//			if(len>2){$("#update").attr("disabled", true);}
//			else{$("#update").attr("disabled", false);}
		  	
		  }    		
		});
   }); 
   //
   $("#no1").live("click",function()
  {
	
      // root
   
   var root_h=$(this).parent().parent().parent().find('.root1_h').val();
   
   $(this).parent().parent().find('.root1').val(root_h);
   // source
   
   var source_h=$(this).parent().parent().parent().find('.source1_h').val();
   $(this).parent().parent().find('.source1').val(source_h);
   // bus
   
   var bus_h=$(this).parent().parent().parent().find('.busn_1_h').val();
   $(this).parent().parent().find('.busn_1').val(bus_h);
   
	  $(".errormessage").html('');
	$('.mandatory').css('border','1px solid #CCCCCC');
   $('.modal').css("display", "none");
    $('.fade').css("display", "none");
		 
	 
	 }); 
	  
   //route duplication
    $(".route_dup").live('blur',function()
  			{
				
         	routename=$("#root").val();
			srcname=$("#source").val();
			rtono=$("#busn").val();
		    //alert(routename+srcname+rtono);
		 $.ajax(
		 {
		  url:BASE_URL+"transport/add_duplicate_route",
		  type:'POST',
		   data:{ value1:routename,value2:srcname,value3:rtono},
		  success:function(result)
		  {
		     $("#root_dup").html(result);
			 len=( (result + '').length );
			if(len>2){$("#addin").attr("disabled", true);}
			else{$("#addin").attr("disabled", false);}
		  	
		  }    		
		});
   }); 
</script>



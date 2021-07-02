<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type='text/javascript' src='<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<table class="staff_table">
	<tr>
                	<td>Hostel Name</td>
                    <td>
                    	<select class='hostel_name mandatory' id="room" name="hostel_monthly_fees[block_id]" >
                        	<option value="">Select</option>
                    	 <?php
								if(isset($hostel_info) && !empty($hostel_info))
								{
									foreach($hostel_info as $bil)
									{
										?>
											<option value="<?=$bil['id']?>"><?=$bil['block']?></option>
											
										<?php
										$i++;
									}
								}
							?>
                            </select><span id="add1" class="add" style="color:#F00;"></span>
                    </td>
                </tr>
    <tr>
        <td>Room No</td>
        <td><input type="text" name="room_no" id="name" class="mandatory duple"/>
        <span id="add2" class="add" style="color:#F00;"></span>
        <span id="dup"  class="add" style="color:#F00;"></span></td>
    </tr>
    <tr>
        <td>No Of Students</td>
        <td><input type="text" name="no_of_seat" id="seat" class="seatu mandatory int_val"/>
        <span id="add3" class="add" style="color:#F00;"></span></td>
    </tr>
    <tr>
    <td></td>
    <td><input type="button" value="submit" class="btn btn-primary" id="submit" />
    <input type="button" value="cancel" class="btn btn-danger" id="cancel" /></td>
    </tr>
</table>
<div>
   <br />
</div>
<div>
	<table>
    	<tr>
        	<td>Hostel Name</td><td><select class='hostel_search' >
                        	<option value="">Select</option>
                    	 <?php
								if(isset($hostel_info) && !empty($hostel_info))
								{
									foreach($hostel_info as $bil)
									{
										?>
											<option value="<?=$bil['id']?>"><?=$bil['block']?></option>
											
										<?php
										$i++;
									}
								}
							?>
                            </select></td>
        </tr>
    </table>
</div>
<br/>
<div class="nav-tabs-custom" id="list_all">
<ul class="nav nav-tabs">
      <table id="example3" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No&nbsp;</th>
                <th>Hostel Name</th>
                <th>Room No</th>
                <th>No Of Students</th>
                <th>Action</th>
            </tr>
            </thead>
				<?php
					if(isset($list) && !empty($list))
					{
						foreach($list as $billto) 
						{
                    ?>   
              <tr>
                <td><?php echo $billto["id"]; ?></td>
                <td><?php echo $billto["block"]; ?></td>
                <td><?php echo $billto["room_name"]; ?></td>
                <td><?php echo $billto["no_of_seat"]; ?></td>
           <!-- <td>
            <a href="#test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm" title="View"><i class="fa fa-eye">					 			</i></a>-->
          <td> <a href="#test1_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
            </td>
               <?php  
                }
					}
            ?>
        	</tr>
        </table>
        </ul>
        </div>
        
	<?php /*?><?php 
    if(isset($list) && !empty($list))
    {
    foreach($list as $billto) 
    {
    ?>   
   <div id="test_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
     <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header"><a class="close" data-dismiss="modal">×</a>
           		 <h3 id="myModalLabel">Hostel View</h3>
            </div>
       <div class="modal-body">
         <table width="100%" class="staff_table_sub">
            <tr>
            <th><strong>Block for</strong></th>
            <td class="text_bold1"><?php echo $billto["block_id"]; ?></td>
            </tr>
            <tr>
            <th><strong>Room Name</strong></th> 
            <td class="text_bold1"><?php echo $billto["room_name"]; ?></td>
            </tr>
            <tr>
            <th><strong>No of Students</strong></th>
            <td class="text_bold1"><?php echo $billto["no_of_seat"]; ?></td>
            </tr>
          </table>
        </div>
            <div class="modal-footer">
            	<button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Discard</button>    
        	</div>
       </div>
     </div>
  </div>
<?php }} ?><?php */?>

<?php 
if(isset($list) && !empty($list))
{ 
foreach($list as $billto) 
{//echo "<pre>";print_r($billto); exit;
?>   
 <div id="test1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" 
 			   role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
      <div class="modal-dialog">
         <div class="modal-content">
          	<div class="modal-header"><a class="close" data-dismiss="modal">×</a>   
               		 <h3 id="myModalLabel">Update room</h3>
              </div>
          <div class="modal-body">
            <table width="100%">
                <tr>
                <!--<td><strong>S.No</strong></td>-->
                <td><input type="hidden" name="id" class="id form-control idupdup" id="" value="<?php echo $billto["id"]; ?>" readonly /></td>
                </tr>         
                <tr>
                <th><strong>Hostel Name:</strong></th>
                    <td>
                    	<select class="hostel_name room hostel_up_name" id="hsupname" name="hostel_monthly_fees[block_id]">
                    	 <?php
								if(isset($hostel_info) && !empty($hostel_info))
								{
									foreach($hostel_info as $val)
									{
										?>
                                            <option <?=($val['id']==$billto['block_id'])?'selected':'';?> value="<?=$val['id']?>"><?=$val['block']?></option>
										<?php
									}
								}
							?>
                            </select>
                    </td>
                </tr>
                <tr>
                <th><strong>Room No:</strong></th>
                <td><input type="text" class="name form-control name upduplic hsuproomno" id="hsuproomno"  name="hostel" value="<?php echo $billto["room_name"]; ?>" /><span id="dupup"  class="dupup" style="color:#F00;"></span>
                <span id="add4" class="add4" style="color:#F00;"></span></td>
                </tr>
                <tr>
                <td><strong>No of Students:</strong></td>
                <td><input type="text" class="seat form-control hsupstudents" id="hsupstudents"  name="hostel" value="<?php echo $billto["no_of_seat"]; ?>" /><span id="add5" class="add5" style="color:#F00;"></span></td>
                </tr>
                <?php /*?> <input type="hidden" id="desg" class="desg" value="<?php echo $billto["designation"]; ?>" /><?php */?>
             </table>
          </div>
                <div class="modal-footer">
                    <!--<input type="button" id="update"  value="Update" name="update" />
                    <input type="button" id="no" value="no" name="no" />-->
                    <button type="button" class="update1 btn btn-primary"  id="update1"><i class="fa fa-edit"></i> Update</button>
                    <button type="reset" class="btn btn-danger"  id="no" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
            	 </div>
         </div>
    </div>        
</div>
<?php }} ?>

    
<script type="text/javascript">
		$(document).ready(function()
		{
		// $("#name").focus(); 
		
		$("#submit").live('click',function()
		{
		var i=0;
		var room=$("#room").val();
		var name=$("#name").val();
		var seat=$("#seat").val();
		//var room=$("#room").val();
		var mfilter=/\w+.*$/;
		var filter=/^[0-9]{1,5}$/;
		if(room=="")
		{
			$("#add1").html("Required Field");
			$("#room").css('border','1px solid red');
			i=1;
		}
		
		
		if(name=="")
		{
			$("#add2").html("Required Field");
			$("#name").css('border','1px solid red');
			i=1;
		}
		else if(!mfilter.test(name))
		{
			$("#add2").html("Enter Valid Rollno");
			i=1;
		}
		
		if(seat=="")
		{
			$("#add3").html("Required Field");
			$("#seat").css('border','1px solid red');
			i=1;
		}
		else if(!filter.test(seat))
		{
			$("#add3").html("Only Numeric length 1 to 5");
			i=1;
		}
		if(i==0)
		{
			for_loading("Loading...Room Added");
		$.ajax(
		{
		url:BASE_URL+"hostel/insert_room",
		type:'POST',
		data:{ value1 : room, value2: name, value3 : seat},
		success:function(result)
		{
		$("#list_all").html(result);
		for_response("Room Added Successfully");
		}    		
		});
		var room=$("#room").val('');
		var name=$("#name").val('');
		var seat=$("#seat").val('');
		}
		}); 
		
		});
		$("#update1").live("click",function()
			{	var i=0;
				var id=$(this).parent().parent().find('.id').val();
				room=$(this).parent().parent().find('.room').val();	
				name=$(this).parent().parent().find('.name').val();	
				seat=$(this).parent().parent().find('.seat').val();
				var message=$(this).parent().parent().find('.dupup').html();
				 var m=$(this).offsetParent().find('.add4');
				 var mm=$(this).offsetParent().find('.add5');
				var filter=/^[0-9]{1,5}$/;
				if(name=="" || name==null || name.trim().length==0)
				{
					m.html("Required Field");
					i=1;
				}
				
				if(seat=="" || seat==null || seat.trim().length==0)
				{
					mm.html("Required Field");
					i=1;
				}
				else if(!filter.test(seat))
				{
					mm.html("Only Numeric length 1 to 5");
					i=1;
				}
				  if((message.trim()).length >0)
			   {
				   
				 i=1;
				 //$(this).parent().parent().find('.upduplic').css('border','1px solid red');
				  
			   }
			   if(i==1)
			   {
				   return false;
			   }
			   else
			   {
				   for_loading("Loading...Room Updated");
			$.ajax({
			  url:BASE_URL+"hostel/update_room",
			  type:'POST',
			  data:{ value1 : id, value2:room, value3:name, value4:seat},
			  success:function(result){
				// alert(id);
				 
			  $("#list_all").html(result);
			  for_response("Room Updated Successfully");
			 
      }    
    
    });
			var id=$(".id").val('');
			var room=$(".room").val('');
			var name=$(".name").val('');
			var seat=$(".seat").val('');
			$('.modal').css("display", "none");
			$('.fade').css("display", "none");
			   }
			});
			
			
			
			//var id=$(this).parent().parent().find(".id").val();
			
		
			/*$("#update").live("click",function()
			{	 
			
			var i=0; 
			//var id=$(this).parent().parent().find(".id").val();
			var message=$(".error_msg");
			var message1=$(".error_msg1").html();
			var id=$(this).parent().parent().find('#id').val(),
			room=$(this).parent().parent().find('#room').val(),
			name=$(this).parent().parent().find('#name').val(),
			seat=$(this).parent().parent().find('#seat').val();
			
			$.ajax(
			{
			url:BASE_URL+"hostel/checking_Update",
			type:'POST',
			data:{ value1 : id ,value2 : room ,value3 : name ,value4 : seat  },
		
			success:function(result)
			{
			//alert(id);
				if(result.trim().length>0)
			{
				$(".error_msg1").html(result);
				i=1;
			}
			}    		
			});
				if (designation.trim().length<2 || designation.trim().length>40)
			{
			//alert("alert");
				message.html("Min 2 To Max 40 character");
				i=1;
			}
			else
			{
				message.html("");
			}
				if(i==0 && message1.trim().length==0)
			{
				for_loading('Loading... Data add Please Wait '); // loading notification
			
			
			
			$.ajax({
			url:BASE_URL+"hostel/update_room",
			type:'POST',
			data:{ value1 : id, value2:room, value3:name, value4:seat},
			success:function(result){
			$("#list_all").html(result);
			
			//for_response('Successfully Update...!'); // resutl notification 
			}   
			});
			var id=$("#id").val('');
			var room=$("#room").val('');
			var name=$("#name").val('');
			var seat=$("#seat").val('');
			$('.modal').css("display", "none");
			$('.fade').css("display", "none");
			}
			});*/
                
				
                
                //var message=document.getElementById("errormessage").innerHTML;
                
                /*if (name.trim().length>=2 && name.trim().length<=40) {
                if((message.trim()).length==0)
                {*/
                
                // for_loading('Loading... Data add Please Wait '); // loading notification
                
                // for_response('Successfully Add...!'); // resutl notification
                
                // 
                /* $(".designation").live("blur",function()
                {
                var name=$(this).val();	
                
                var id=$(this).offsetParent().find(".id").val();
                
                var message=$(".error_msg1");
                $.ajax(
                {
                url:BASE_URL+"designation/checking_Update",
                type:'POST',
                data:{ value1 : name ,value2 : id},
                
                success:function(result)
                {
                //alert(result);
                message.html(result);
                
                }    		
                });
                });*/
				
			$("#cancel").live("click",function()
			   {
				   $('.add').html('');
				   $('.mandatory').css('border','1px solid #CCCCCC');
				   $('.mandatory').val('');
				 
				   //$('.erro').html();
				   
			   });
</script>

<script>
$("#room").live('blur',function()
{
	var room=$("#room").val();
	if(room=="")
	{
		$("#add1").html("Required Field");
	}
	else
	{
		$("#add1").html("");
	}
});
$("#name").live('blur',function()
{
	var name=$("#name").val();
	var filter=/\w+.*$/;
	
	if(name=="")
	{
		$("#add2").html("Required Field");
	}
	else
	{
		$("#add2").html("");
	}
});
$("#seat").live('blur',function()
{
	var seat=$("#seat").val();
	var filter=/^[0-9]{1,5}$/;
	if(seat=="")
	{
		$("#add3").html("Required Field");
	}
	else if(!filter.test(seat))
	{
		$("#add3").html("Only Numeric length 1 to 5");
	}
	else
	{
		$("#add3").html("");
	}
});
</script>
<script>
  $(".duple").blur(function()
  			{
				
         	hostelname=$("#room").val();
			roomno=$("#name").val();
		    //alert(block);
		 $.ajax(
		 {
		  url:BASE_URL+"hostel/check_duplicate_room",
		  type:'POST',
		   data:{ value1:hostelname,value2:roomno},
		  success:function(result)
		  
		  {
		     $("#dup").html(result);
      		len=( (result + '').length );
			if(len>2){$("#submit").attr("disabled", true);}
			else{$("#submit").attr("disabled", false);}
		  	
		  }    		
		});
   }); 
   
   
   //update
   $(".upduplic").blur(function()
  			{
				//alert("hi");
			//var	hostelname=$(".hostel_up_name").val();
			var hostelname=$(this).offsetParent().find('.hostel_up_name').val();
			var roomno=$(this).val();
			var id=$(this).offsetParent().find('.idupdup').val();
			var message=$(this).offsetParent().find('.dupup');
         	///alert(hostelname);
			
		 $.ajax(
		 {
		  url:BASE_URL+"hostel/check_update_duplicate_room",
		  type:'POST',
		   data:{ value1:hostelname,value2:roomno,value3:id},
		  success:function(result)
		  
		  {
		     message.html(result);
      		/*len=( (result + '').length );
			if(len>2){$("#update1").attr("disabled", true);}
			else{$("#update1").attr("disabled", false);}*/
		  	
		  }    		
		});
   }); 
   
   </script>
   <script>
   
   $(".hsuproomno").live('blur',function()
	{
	var name=$(this).parent().parent().parent().find('.hsuproomno').val();
	var m=$(this).offsetParent().find('.add4');
	if(name=="" || name==null || name.trim().length==0)
	{
		m.html("Required Field");
	}
	else
	{
		m.html("");
	}
});
$(".hsupstudents").live('blur',function()
{
	var student=$(this).parent().parent().parent().find('.hsupstudents').val();
	var m=$(this).offsetParent().find('.add5');
	var filter=/^[0-9]{1,5}$/;
	if(student=="" || student==null || student.trim().length==0)
	{
		m.html("Required Field");
	}
	else if(!filter.test(student))
	{
		m.html("Only Numeric length 1 to 5");
	}
	else
	{
		m.html("");
	}
});
// Hostel Search
$('.hostel_search').live('change',function()
{
	var hostel_name=$(this).val();
	if(hostel_name=="" || hostel_name==null)
	{
	}
	else
	{
		$.ajax(
		 {
		  url:BASE_URL+"hostel/hostel_search",
		  type:'POST',
		   data:{ hostel_name:hostel_name},
		  success:function(result)
		  
		  {
		     $("#list_all").html(result);
		  }    		
		});
	}
});

</script>
<script>
$("#stage").live('blur',function()
{
	var root=$("#stage").val();
	var filter= /^[a-zA-Z.\s]{1,20}$/;
	if(root=="")
	{
		$("#y1").html("Required Field");
	}
	else if(!filter.test(root))
	{
	}
	else
	{
		$("#y1").html("");
	}
});
$("#busfee").live('blur',function()
{
	var source=$("#busfee").val();
	var filter= /^[a-zA-Z.\s]{1,20}$/;
	if(source=="")
	{
		$("#y2").html("Required Field");
	}
	else if(!filter.test(busno))
	{
	}
	else
	{
		$("#y2").html("");
	}
	});
	</script>


<table width="40%">
<tr><td>Stage Name</td><td><input type="text" name="stage" id="stage" class="stage mandatory" /><span id="v1" class="val" style="color:#F00;"></span></td></tr>
<tr><td>Bus Fee</td><td><input type="text" name="busfee" id="busfee" class="busfee mandatory" /><span id="v2" class="val" style="color:#F00;"></span></tr></td>
<tr><td></td><td><input type="button" value="Add" name="submit" id="submit" class="btn btn-primary"/>&nbsp;&nbsp;
<input type="button" value="Cancel" id="
cancel" class="btn btn-danger"/></td>
</tr></table>
<div id="list_all_view">
<table id="example4" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>S.No</th>
                <th>Stage Name</th>
                <th>Bus Fee</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
			<?php 
                if(isset($master_details) && !empty($master_details))
                {
					$i=0;
                    foreach($master_details as $billto) 
					 {
                       $i++
            ?>   
                 <tr><td><?php echo "$i"; ?></td>
                 <td><?php echo $billto["stage_name"]; ?></td>
                 <td><?php echo $billto["bus_fees"]; ?></td>
                 </td><td>
                 <a href="#1test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm" title="View"><i class="fa fa-eye"></i></a>
                 <a href="#1test1_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                
                </td>
                </tr>
           <?php   
            }}
        ?>
        </tbody>
	    </table>
        <?php 
if(isset($master_details) && !empty($master_details))
{
foreach($master_details as $billto) 
{
 ?>   

<div id="1test_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  <div class="modal-dialog">
  <div class="modal-content">
     <div class="modal-header"><a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel">Bus View</h3>
    </div>
  <div class="modal-body">
  <table width="100%" class="staff_table_sub">
        <tr>
        <?php /*?><td><strong>S.No</strong></td> <td><?php echo $billto["id"]; ?></td></tr><tr><?php */?>
        <td><strong>Stage Name</strong></td> <td class="text_bold1"><?php echo $billto["stage_name"]; ?></td></tr>
         <td><strong>Bus Fee</strong></td> <td class="text_bold1"><?php echo $billto["bus_fees"]; ?></td></tr>
          
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
 <?php 
if(isset($master_details) && !empty($master_details))
{
foreach($master_details as $billto) 
{
 ?>   

<div id="1test1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  	<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a>   
    <h3 id="myModalLabel">Update Bus</h3></div>
  	<div class="modal-body">
    <table width="100%">
         <tr>
         <!--<td><strong>S.No</strong></td>-->
        <td><input type="hidden" name="id" class="id form-control" id="id" value="<?php echo $billto["id"]; ?>" readonly="readonly" /></td>
         </tr> 
         <tr><td>Stage Name</td><td><input type="text" name="sname" id="sname" class="sname" value="<?php echo $billto["stage_name"]; ?>" /></td></tr>
<tr><td>Bus Fees</td><td><input type="text" name="bfee" id="bfee" class="bfee" value="<?php echo $billto["bus_fees"]; ?>" /></tr></td>

        </table>
    
     	
  	</div>
  		<div class="modal-footer">
   			 <button type="button" class="btn btn-primary"  id="update_1"><i class="fa fa-edit"></i> Update</button>
    		 <button type="reset" class="btn btn-danger"  id="no" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
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
         var stage=$("#stage").val();
		 busfee=$("#busfee").val();
		// alert(busfee);
				 
		 if(stage=='' || stage==null)
		  {
			  $("#v1").html("Required Field");
			  i=1;
		  }
		 if(busfee=='' || busfee==null)
		  {
			  $("#v2").html("Required Field");
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
		  url:BASE_URL+"transport/insert_master_stage",
		  type:'POST',
		  data:{ value1 : stage , value2 : busfee },
		  
		  success:function(result)
		  {
			
			 //$("#list_all").html('');
		     $("#list_all_view").html(result);
			 //alert(result);
			 for_response('Successfully Add...!'); // resutl notification
		  
		  }    		
		});
		 $("#stage").val('');
	  $("#busfee").val('');
		 }
		 
  });
}); 
$("#update_1").live("click",function()
  {	  
   for_loading('Loading... Data add Please Wait '); // loading notification
   var id=$(this).parent().parent().find('.id').val();
   sname=$(this).parent().parent().find('.sname').val();
   bfee=$(this).parent().parent().find('.bfee').val();
//alert(bfee);
     $.ajax({
      url:BASE_URL+"transport/update_transport_stage",
      type:'POST',
      data:{ value1 : id,value2:sname,value3:bfee},
      success:function(result){
      $("#list_all_view").html(result);
	   for_response('Successfully Update...!'); // resutl notification 
      }   
	   
	 });
	 $('.modal').css("display", "none");
    $('.fade').css("display", "none"); 
    });
	
	 $("#Cancel").live("click",function()
  {
	  $("#stage").val('');
	  $("#busfee").val('');
	  $('.mandatory').css('border','1px solid #CCCCCC');
	   
	 
   $('.modal').css("display", "none");
    $('.fade').css("display", "none");	  
	 }); 
	
   
</script>
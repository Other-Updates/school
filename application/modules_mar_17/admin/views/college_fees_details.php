
<h3> List of Fees  </h3>
<div>
<table>
	<form>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
    	<tr><td width="110">Fees Name:</td><td width="220"><input type="text" name="fees" id="fees" class="structure addfeesmo"/></td>
        <td width="200"><input type="button" value="submit" class="btn btn-primary mandatory" id="add"><span id="msfee" style="color:#F00; padding-left:10px;"></span></td>
        <td style="display:none;">
        <select name="status" id="status"  >
    				<option value="1">Active</option>
    				<option value="0">Inactive</option>
    	</select></td></tr>        
        <tr><td>&nbsp;</td> </tr>
    </form>
</table>    
</div>



<div id="list_all" class="list_all">
<table width="100%" id="example1"  class="all my_table_style list_all table table-bordered table-striped"><thead>
<tr><th>S.No</th><th>Fees Type</th><th>Status</th> <th>Action</th></tr>
</thead>
      <tbody>
          <?php $i=1;
	 if(isset($fee_name) && !empty($fee_name))
	 {
     	foreach($fee_name as $val)
		 
        {
			?>
       		<!--<input type="hidden" id="fee_id" class="upd_id value<?=$i ?>"  />-->
        <tr><td width="5%"><?=$i;?></td><td width="10%"><input type="text" value="<?=$val['fees_name'] ?>" disabled="disabled" class="fees_name<?=$i?> mandatory updatefee" id="ffees"/><span id="feeedit" class="feeedit" style="color:#F00;"></span></td>
        	<td  width="10% "> <select name="status" id="status" disabled="disabled" class="status<?=$i?>">
    				<option <?=($val['status']==1)?'selected':'';?> value="1">Active</option>
        			<option <?=($val['status']==0)?'selected':'';?> value="0">In-Active</option>
    			 </select>
           </td>
           <td width="10%"> 
<input type="button" name="Edit" id='update' data-toggle="modal" value='Edit' title="Edit"  class="btn bg-navy btn-sm success_<?=$i?> "  />
           <input type="button" name="Edit" id='add_update' title="Edit" value='Update' class="btn btn-success up_<?=$i?> "  style="display:none" > 
            </td>
       </tr>
   
    <?php  $i++;
	
		}
	 }?>
   
     </tbody>
  </table>    
</div>


<div id="list">
 
</div>

<script type="text/javascript" language="JavaScript">
$("#add").live("click",function()
  {
	   //for_loading_del('Loading... Data Delete wait...'); // loading notification
	  var i=0;
   var fees=$('.structure').val();
   var status=$('#status').val();
   var fees=$("#fees").val();
		var m=$("#msfee");
  		
		  if(fees=='' || fees==null || fees.trim().length==0)
		  {
			  m.html("Required field");
			  $("#fees").css('border','1px solid red');
			  i=1;
		  }
		  else
		  {
			m.html("");
			$("#fees").css('border','1px solid #CCCCCC');
		  }
		  if(i==0)
		  {
     $.ajax({
      url:BASE_URL+"admin/fees_details",
      type:'POST',
      data:{ value: fees, value1:status},
	  
      success:function(result){
		   $(".list_all").html("");
	      $(".list_all").html(result);
		   
	  // for_response_del('Delete Successfully...!'); // resutl notification  
      }    
    });
		 }
	 $("#fees").val('');
	
    });
	
	
	
	
	$("#update").live('click',function() 
	{
		
	   idno=($(this).attr('class'));
	   var splitNumber = idno.split('_');
	   var id=splitNumber[1];
       $(".fees_name"+id).attr("disabled",false);
	   $(".status"+id).attr("disabled",false);
	   $(".success_"+id).css("display",'none');
	   $(".up_"+id).css("display",'block');
   
	});
	
	$("#add_update").live('click',function() {
	   idno=($(this).attr('class'));
	   var splitNumber = idno.split('_');
	   var id=splitNumber[1]; //console.log(id);
	   var f_name=$(".fees_name"+id).val();
	   var f_status=$(".status"+id).val();
	
	   var i=0;
	   var updatefee=$(this).parent().parent().find('.updatefee').val();
		var m=$(this).parent().parent().find('.feeedit');
		 if(updatefee=='' || updatefee==null || updatefee.trim().length==0)
		  {
			  m.html("Required field");
			  i=1;
		  }
		  else
		  {
			m.html("");
		  }
	   
	  	//alert(f_name); 
		if(i==0)
		{
	    $.ajax(
		 {
			  url:BASE_URL+"admin/update_fees_name",
			  type:'get',
			  data:{ value1:id, value2:f_name, value3:f_status},
			  success:function(result){
			  $("#list").html(result);
			  // for_response_del('Data Delete Successfully...!'); // resutl notification   
         }   
	   });
		
       $(".fees_name"+id).attr("disabled",true);
	   $(".status"+id).attr("disabled",true);
	   $(".success_"+id).css("display",'block');
	   $(".up_"+id).css("display",'none');
		}
});
</script>

<script type="text/javascript">
$(".addfeesmo").live('blur',function() 
	{
		var fees=$(".addfeesmo").val();
		var m=$("#msfee");
  		
		  if(fees=='' || fees==null || fees.trim().length==0)
		  {
			  m.html("Required field");
			   $("#fees").css('border','1px solid red');
			  
		  }
		  else
		  {
			m.html("");
			$("#fees").css('border','1px solid #CCCCCC');
		  }
		});
</script>
<script type="text/javascript">
$(".updatefee").live('keyup',function() 
	{
		//alert("hi");
		//var updatefee=$(".updatefee").val();
		//var updatefee=$(this).offsetParent().find(".updatefee").val();
		var updatefee=$(this).parent().parent().find('.updatefee').val();
		var m=$(this).parent().parent().find('.feeedit');
		 if(updatefee=='' || updatefee==null || updatefee.trim().length==0)
		  {
			  m.html("Required field");
			   
		  }
		  else
		  {
			m.html("");
		  }
		});
</script>
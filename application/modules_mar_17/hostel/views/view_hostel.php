<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); 
$this->load->model('hostel/hostel_model');
$hostel_info=$this->hostel_model->get_all_hostel_details();
/*echo "<pre>";
print_r($hostel_info);*/
?>
<div id='hostel_info'>

<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr>
    	<th>S.No</th>
        <th>Hostel Name</th>
        <th>Hostel For</th>
        <th>Hostel Type</th>
        <th>Amount</th>
        <th>Action</th>
    </tr>
</thead>    
    <?php
    	if(isset($hostel_info) && !empty($hostel_info))
		{
			$i=1;
			foreach($hostel_info as $val)
			{
				?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=$val['block']?></td>
                    <td><?=ucfirst($val['block_for'])?></td>
                    <td><?=($val['hostel_type']==0)?'Dividing System':'Non Dividing System'?></td>
                    <td>
                    	Rs<?=$val['total_amount']?>
                    	<?php
						if($val['hostel_type']==1)
						{
							echo " ( Rs ".$val['per_day']." )";
						}
						?>
                    </td>
                    <td><a href="#edit_<?php echo $val["id"]; ?>" title="Edit" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a></td>
                </tr>
                <?php
				$i++;
			}
		}
	?>
</table>
</div>
<?php 
if(isset($hostel_info) && !empty($hostel_info))
{	
foreach($hostel_info as $val) 
{
	?>
<div id="edit_<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
   <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel">Edit Hostel</h3>
    </div>
  <div class="modal-body" >
<table class="view_table">
<tr>
    	<td>Hostel Name</td>
        <td><input type="text" class='u_h_name mandatory duplicationup' id="h_name1" value="<?=$val['block']?>" />
        <input type="hidden" class='u_id update_duplicate' value="<?=$val['id']?>" /><input type="hidden" class='u_h_name1' value="<?=$val['block']?>" /><span style="color:red;" class="hostel_error errormessage" ></span><span id="duplica" class="duplica" style="color:#F00;"></span></td>
    </tr>
    <tr>
    	<td>Hostel For</td>
        <td><input type="radio" name="u_gender<?=$val['id']?>" value='male' <?=($val['block_for']=='male')?'checked':'' ?>  class="u_h_for1 testing" /> Male &nbsp;&nbsp;&nbsp;<input type="radio" value='female' <?=($val['block_for']=='female')?'checked':'' ?> class="u_h_for2 testing" name="u_gender<?=$val['id']?>" /> Female
        <input type="hidden" value="<?=$val['block_for']?>" class="hidden_gender" /></td>
    </tr>
    <tr>
    	<td>Hostel Type</td>
        <td><input type="radio" name="u_type<?=$val['id']?>" value='0' <?=($val['hostel_type']==0)?'checked':'' ?> class='u_d_system u_h_type1' id="my_radio"/> Dividing System &nbsp;&nbsp;&nbsp;<input type="radio" class='u_non_d_system u_h_type2' name="u_type<?=$val['id']?>"  value='1' <?=($val['hostel_type']==1)?'checked':'' ?> id="my_radio1"/> Non Dividing System</td>
    </tr>
    <tr>
    	<td><label id="refund">Refundable Amount</label><label id="depo" style="display:none;">Deposit Amount</label> </td>
        <td><input type="text"  style="float:left;" class='u_h_amt mandatory int_val' value="<?=$val['total_amount']?>"/><input type="hidden"  style="float:left;" class='u_h_amt1' value="<?=$val['total_amount']?>"/></td>
    </tr>
    
    <tr  class='non_dy' style="display:<?=($val['hostel_type']==1)?'':'none' ?>;">
    <td>&nbsp;&nbsp;<span  style="float:left;">Per Day </span></td><td><input type="text" value="<?php
						if($val['hostel_type']==1)
						{
							echo $val['per_day'];
						}
						?>"  class='u_h_per_amt mandatory int_val'/><input type="hidden" value="<?php
						if($val['hostel_type']==1)
						{
							echo $val['per_day'];
						}
						?>"  class='u_h_per_amt1'/></td>
    </tr>
    <tr>
    <td></td><td><span style="color:red;" class="amount_error errormessage" ></span></td>
    </tr>
    
</table>

  </div>
  <div class="modal-footer">   
      <button class="btn btn-primary update_btn delete update_hostel" id="view_hostel" ><i class="fa fa-edit"></i> Update</button>
    <button type="button" class="no btn btn-danger" data-dismiss="modal" id="no"><i class="fa fa-times"></i> Discard</button>
   </div>
   </div>  
  </div>
</div>
<?php
}}
?>
<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$("#example1").dataTable();
	$("#example4").dataTable();
	$("#example5").dataTable();
	 $("#example3").dataTable();
	$('#example2').dataTable({
		"bPaginate": true,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": true,
		"bInfo": true,
		"bAutoWidth": false
	});
});
</script>   
<script>
$(".u_h_name").live('blur',function() 
	{
		var hostel=$(this).val();
		var m=$(this).offsetParent().find('.hostel_error');
  		
		  if(hostel=='' || hostel==null || hostel.trim().length==0)
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
		$(".u_h_amt").live('blur',function() 
	{
		var h_amt=$(this).val();
		var m=$(this).parent().parent().parent().find('.amount_error');
  		
		  if(h_amt=='' || h_amt==null || h_amt.trim().length==0)
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
		$(".u_h_per_amt").live('blur',function()
		{
			var h_per_amt=$(this).val();
			var m=$(this).offsetParent().find('.amount_error');
			
			if(h_per_amt=='' || h_per_amt==null || h_per_amt.trim().length==0)
			{
				
				//m.html('Required Field');
				$(this).css('border','1px solid #CCCCCC');
			}
			else
			{
				m.html('');
				$(this).css('border','1px solid #CCCCCC');
			}
		});
</script>
<script type="text/javascript">
$('.u_non_d_system').live('click',function(){
	$(this).offsetParent().find('.non_dy').show();
	
	$('#depo').show();
	$('#refund').hide();
	
	
});
$('.u_d_system').live('click',function(){
	$(this).offsetParent().find('.non_dy').hide();
	
	$('#refund').show();
	$('#depo').hide();
	
	
});

$('.update_hostel').live('click',function(){
	
	var i=0;
	var id=$(this).parent().parent().find('.u_id').val();
	var block=$(this).parent().parent().find('.u_h_name').val();
	var total_amount=$(this).parent().parent().find('.u_h_amt').val();
	var per_day=$(this).parent().parent().find('.u_h_per_amt').val();
	var message=$(this).parent().parent().find('.duplica').html();
	if($(this).parent().parent().find('.u_h_for1').attr('checked')=='checked')
	{
		h_for=$(this).parent().parent().find('.u_h_for1').val();
	}
	if($(this).parent().parent().find('.u_h_for2').attr('checked')=='checked')
	{
		h_for=$(this).parent().parent().find('.u_h_for2').val();
	}
	if($(this).parent().parent().find('.u_h_type1').attr('checked')=='checked')
	{
		h_type=$(this).parent().parent().find('.u_h_type1').val();
	}
	if($(this).parent().parent().find('.u_h_type2').attr('checked')=='checked')
	{
		h_type=$(this).parent().parent().find('.u_h_type2').val();
		if(per_day==0 || per_day=="" || per_day==null || per_day.trim().length==0)
		{
			i=1;
			$(this).parent().parent().find('.u_h_per_amt').css('border','1px solid red');
			
		}
	}
	if(block==0 || block=="" || block==null || block.trim().length==0)
	{
		i=1;
		$(this).parent().parent().find('.u_h_name').css('border','1px solid red');
		
	}
	if(total_amount==0 || total_amount=="" || total_amount==null || total_amount.trim().length==0)
	{
		i=1;
		$(this).parent().parent().find('.u_h_amt').css('border','1px solid red');
		
	}
	 if((message.trim()).length >0)
   {
	   
	 i=1;
	 //$(this).parent().parent().find('.duplicationup').css('border','1px solid red');
	  
   }
	
	if(i==0)
	{
		for_loading("Loading...Hostel Updated");
	$.ajax({	
	  url:BASE_URL+"hostel/update_hostel",
	  type:'post',
	  data:{ 
	  			id:id,
				block:block,
				total_amount:total_amount,
				per_day:per_day,
				block_for:h_for,
				hostel_type:h_type
		   },
	  success:function(result){
			$('#hostel_info').html(result);
			for_response("Hostel Updated Successfully");
	  }    
	});	
	 $('.modal').css("display", "none");
    $('.fade').css("display", "none");
	}
});
$("#no").live("click",function()
  {
	  	var a=$(this).parent().parent().find('.u_h_name1').val();
		var b=$(this).parent().parent().find('.u_h_amt1').val();
		var c=$(this).parent().parent().find('.u_h_per_amt1').val();
		var h_gender=$(this).parent().parent().find('.hidden_gender').val();
		// changing
	    var block=$(this).parent().parent().find('.u_h_name').val(a);
		var total_amount=$(this).parent().parent().find('.u_h_amt').val(b);
		var per_day=$(this).parent().parent().find('.u_h_per_amt').val(c);
		if(h_gender=='male')
		{
			$(this).parent().parent().find('.u_h_for1').prop('checked',true);
		}
		else
		{
			$(this).parent().parent().find('.u_h_for2').prop('checked',true);
		}
		// duplicate
		
 	  $(".errormessage").html('');
	  $(".duplica").html('');
	$(".mandatory").css('border','1px solid #CCCCCC');
	$(".duplicationup").css('border','1px solid #CCCCCC');
   $('.modal').css("display", "none");
    $('.fade').css("display", "none");
		 
	 
	 });


 $(".duplicationup").keyup(function()
  			{
				//alert("hi");
         	//block=$(this).val()
			//id=$(".update_duplicate").val(),
			var block=$(this).parent().parent().find('.duplicationup').val();
			var id=$(this).offsetParent().find('.update_duplicate').val();
			var message=$(this).offsetParent().find('.duplica');
			//alert(id);
		  
		 $.ajax(
		 {
		  url:BASE_URL+"hostel/update_duplicate_hostel",
		  type:'POST',
		   data:{ value1:block,value2:id},
		  success:function(result)
		  {
			  //alert(result);
		     message.html(result);
      		/*len=( (result + '').length );
			if(len>2){$("#view_hostel").attr("disabled", true);}
			else{$("#view_hostel").attr("disabled", false);}*/
		  	
		  }    		
		});
   }); 
</script>
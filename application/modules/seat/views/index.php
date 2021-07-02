<?php  $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<section class="content-header">
                    <h3>Exam Room Allocation</h3>
                </section>

<div style="display:none">
		<table style="width:30%;float:left;" id='add_table'>
          <tr>
                <td>Batch</td><td>Department</td><td>Section</td>
              </tr>
              <tr>
                
                <td>
               <select id='select_batch' class='ajax_class' style="width:103px;">
                    <option value="">Select</option>
                    <?php 
                        if(isset($all_batch) && !empty($all_batch)){
                            
                            foreach($all_batch as $val1)
                            {
                                ?>
                                    <option value="<?=$val1['id']?>"><?php echo $val1['from'].'-'.$val1['to']?></option>
                                <?php 
                            }
                        }
                    ?>
                </select>
                </td>
               
                
                <td id='td_depart'>
                   <select id='depart_id'   style="width:100px;">
                            <option value="">Select</option>
                   </select>
              </td>
              
              <td id='g_td'>
                    <select id='group_id'  style="width:80px;">
                            <option value="">Select</option>
                    </select>
                </td>
                <td>
                    <input type="text"  class="form-control total_seat"    style="width:40px;" />
                     <input type="hidden" class="cols_no"  />
                     <input type="hidden" class="cols_count" />
                </td>
                <td>
                    <input type="text" class="form-control total_std req"   readonly="readonly" style="width:40px;"  />
                </td>
                <td>
                    <!--<input type="button" class="btn btn-danger remove_row" style="height: 30px" value="-" title="Select other deprtment student in this column" />-->
                </td>
              </tr>   
</table>
</div>
<div id="view_all" class="nav-tabs-custom">

<ul class="nav nav-tabs">
<li class="active"><a href="#tab_1" data-toggle="tab">Room List</a></li>
<li class=""><a href="#tab_2" data-toggle="tab">Add Room</a></li>
</ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
   				<div class="box-group">
                <table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
                    <thead>
                    	<tr>
                        	<td>S.NO</td>
                            <td>Block</td>
                            <td>Floor</td>
                            <td>Room NO</td>
                            <td>No of Seat</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                	<tbody>
                    	<?php 
						if(isset($all_exam_hall) && !empty($all_exam_hall))
						{
							$i=1;
							foreach($all_exam_hall as $val)
							{
						?>
                       	 <tr>
                         	<td><?=$i?></td>
                        	<td><?=$val['block']?></td>
                            <td><?=$val['floor']?></td>
                            <td><?=$val['room_no']?></td>
                            <td><?=$val['total_seat']?></td>
                            <td>
                            	 <a href="<?= $this->config->item('base_url').'seat/seat_view_room/'.$val['id']?>" title="View Room" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="#delete_<?php echo $val['id']; ?>" title="Delete Room" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                            </td>
                         </tr>
                       <?php 
					   		$i++;
							}
						}
					   ?>         
                    </tbody>
                </table>
                	
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                     
                                       
                                        
                </div>
        </div>
        <div class="tab-pane " id="tab_2"> 
        <form method="post" action="<?=$this->config->item('base_url').'seat/insert_seat/';?>">
            <table>
                <tr>
                    <td><input type="text" class="form-control input-circle my_seat" value="q"  placeholder="Block" name="hall[block]"></td>
                    <td><input type="text" class="form-control input-circle my_seat"  value="q1"  placeholder="Floor" name="hall[floor]"></td>
                    <td><input type="text" class="form-control input-circle my_seat"  value="q2"  placeholder="Room NO" name="hall[room_no]"></td>
                    <td></td>
                    </tr>
                    <tr>
                    <td><input type="text" class="form-control input-circle my_seat int_val" value="2" id="cols" placeholder="Colunms" name="hall[rows]"></td>
                    <td><input type="text" class="form-control input-circle my_seat int_val" value="4" id="total_seat" placeholder="No of Seat"  name="hall[total_seat]"></td>
                    <td><input type="text" readonly="readonly" class="form-control input-circle my_seat" value="2"  id="rows" placeholder="Rows" name="hall[cols]"></td>
                    <td><input type="button" class="btn btn-success" id='create_seat' value="Create"/></td>
                </tr>
            </table>
            <div id='seat_div'>
            </div>
           	
            <br />
        </form>    
        </div>
    </div>
</div>
<?php 
if(isset($all_exam_hall) && !empty($all_exam_hall))
{	
foreach($all_exam_hall as $view) 
{
	?>
<form action="<?=$this->config->item('base_url').'seat/seat_delete/'?>" method="post">    
    <div id="close">
            <div id="delete_<?php echo $view['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
              <div class="modal-dialog">
              <div class="modal-content">
              <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3 id="myModalLabel">Delete Room</h3>
              </div>
              <div class="modal-body" >
                <b>Are you sure you want to Delete this Room? 
                <input type="hidden" value="<?php echo $view['id']; ?>" name="id" class="id" /></b>
              </div>
              <div class="modal-footer">
               <!--<input type="button" value="Yes"  class="btn btn-primary delete_yes"  />
               <input type="button" value="No" class="btn btn-primary delete_all " id="no" />-->
               
               <button class="btn btn-primary delete_yes" id="no">Yes</button>
               <button type="button" class="btn btn-danger delete_all" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
               
             </div>
             </div>
             </div>
        </div>
    </div>
</form>
<?php
}}?> 
<script>
//[].reverse.call($("#myTable tbody tr")).appendTo("#myTable tbody")
$('#create_seat1').live('click',function(){
	var i=0;
	var result=0;
	var j=0;
	
	
	
	$('.req').each(function(){
		if(j!=0)
		{
			if(Number($(this).val())==0 || Number($(this).val())=='')
			{
				result=1;
				$(this).css('border','1px solid red');	
			}
		}
		j++;
	});
	
	$('.total_seat').each(function(){
		var tt=$(this).closest('tr').find('.total_std').val();
		if(i!=0)
		{
			if(Number($(this).val())!='')
			{
				if(Number($(this).val())>Number($('#rows').val()))
				{
					result=1;
					$(this).css('border','1px solid red');	
				}
				else
				{
					$('.g_id').each(function() 
					{	
						var t=0;
						$('.sss_'+$(this).val()).each(function() {
							  t=t+Number($(this).val());
						});
							
						if(t>$('.ccc_'+$(this).val()).val())
						{
							result=1;
							$('.sss_'+$(this).val()).css('border','1px solid red');	
						}
						else
						{
							$('.sss_'+$(this).val()).css('border','');	
						}
					});	
					if(Number($(this).val())>Number(tt))
					{
						result=1;
						$(this).css('border','1px solid red');	
					}
					else
					{
						$(this).css('border','');	
					}
					var ff=$(this).attr('class').split(" ");
					//console.log(ff[2]);
					var dd=0;
					$('.'+ff[2]).each(function(){
						dd=dd+Number($(this).val());
					});
					if(Number(dd)>Number($('#rows').val()))
					{
						result=1;
						$(this).css('border','1px solid red');	
					}
					else
					{
						$(this).css('border','');	
					}
		
				}
			}
		}
		i++;
	});
	if(result==1)
		return false;
	else
		return true;	
});
$('#cols,#total_seat').blur(function(){
	if(Number($('#cols').val())!=0 && Number($('#total_seat').val())!=0)
	{
		var f=Number($('#total_seat').val())/Number($('#cols').val());
		if(f%1!=0)
		{
			alert('Invalid Cols and Total Seat');
		}
		else
			$('#rows').val(f);
	}
});

	$('.add_row').live('click',function(){
		
		var cols_count=Number($(this).attr('id'))+1;
		
		$(this).attr('id',cols_count);
		
		
		var cols_no= $(this).closest('tr').find('.cols_no').val();
		var cl=$('#add_table').clone();
		cl.find('#select_batch').attr('name','cols['+cols_no+']['+cols_count+'][batch_id]');
		cl.find('.total_seat').attr('name','cols['+cols_no+']['+cols_count+'][set_seat]');
		
		cl.find('.total_seat').addClass('seat_cls_'+cols_no);
		cl.find('.total_seat').addClass('req');
		cl.find('.total_seat').addClass('test1');
		
		cl.find('.total_std').attr('name','cols['+cols_no+']['+cols_count+'][total_std]');
		
		cl.find('.total_seat').addClass('test2');
		
		cl.find('.cols_no').attr('name','cols['+cols_no+']['+cols_count+'][cols_no]');
		
		
		cl.find('.cols_no').val(cols_no);
		cl.find('.cols_count').val(cols_count);
		
		$(this).parent().parent().parent().parent().parent().find('.sub_cols').append(cl);
	});

	$('#create_seat').live('click',function()
	{
		result=0;
	
		$('.my_seat').each(function() 
		{
    		if($(this).val()=='' || $(this).val()==null || $(this).val().trim().length==0 || $(this).val()=='.' || $(this).val()==',')
    		{		
				$(this).css('border','1px solid red');	
				result=1;
   			} 
			else{
				$(this).css('border','1px solid #CCCCCC');
				//$(this).tooltip('hide');
			}	
			
		});	
		if(Number($('#cols').val())!=0 && Number($('#total_seat').val())!=0)
		{
			var f=Number($('#total_seat').val())/Number($('#cols').val());
			if(f%1!=0)
			{
				alert('Invalid Cols and Total Seat');
				result=1;
			}
			else
				$('#rows').val(f);
		}
		var urows=$('#rows').val();
		var ucols=$('#cols').val();
		if(urows!='' && ucols!='' && result==0)
		{
			$.ajax({
					url:BASE_URL+"seat/create_seat_layout",
					type:"GET",
					data:
						{
							urows:urows,
							ucols:ucols
						},
					success:function(result)
					{
						$('#seat_div').html(result);
					}
			 });
			/*	$.ajax({
					url:BASE_URL+"seat/seat_layout_view",
					type:"GET",
					data:
						{
							urows:urows,
							ucols:ucols
						},
					success:function(result)
					{
						$('#seat_view').html(result);
					}
				 });	*/ 
		}
	});
	  $('#depart_id').live('change',function(){
			d_id=$(this).val();
			g_td=$(this).closest('tr').find('#g_td');
			cols_no=$(this).closest('tr').find('.cols_no');
			cols_count=$(this).closest('tr').find('.cols_count');
			if(d_id=="" || d_id==null)
			{
				
				$('#group_id').prop('disabled',true);
			}
			else
			{
				$('#group_id').prop('disabled',false);
			$.ajax({
			  url:BASE_URL+"student/get_all_group11",
			  type:'POST',
			  data:{ 
						depart_id : d_id,
						cols_no : cols_no.val(),
						cols_count : cols_count.val()
						
						
				   },
			  success:function(result){
					g_td.html(result);
					/*$('.modal-backdrop').hide();
					$('.close_div').hide();*/
			  }    
			});	
			}
	   });
	    $('#select_batch').live('change',function(){
			td_depart=$(this).closest('tr').find('#td_depart');
			cols_no=$(this).closest('tr').find('.cols_no');
			cols_count=$(this).closest('tr').find('.cols_count');
			b_id=$(this).val();
			if(b_id=="" || b_id==null)
			{
				$('#depart_id').prop('disabled',true);
				$('#group_id').prop('disabled',true);
				//window.location.reload();
			}
			else
			{
				$('#depart_id').prop('disabled',false);
			$.ajax({
			  url:BASE_URL+"student/get_all_department11",
			  type:'POST',
			  data:{ 
						batch_id : b_id,
						cols_no : cols_no.val(),
						cols_count : cols_count.val()
						
				   },
			  success:function(result){
					td_depart.html(result);
					
					/*$('.modal-backdrop').hide();
					$('.close_div').hide();*/
			  }    
			});	
			}
	   });
	    $('#group_id').live('change',function(){
			my_td=$(this).closest('tr').find('.total_std');
			my_batch_id=$(this).closest('tr').find('#select_batch');
			my_depart_id=$(this).closest('tr').find('#depart_id');
			my_td=$(this).closest('tr').find('.total_std');
			b_id=$(this).val();
					
			var lastClass =$(this).closest('tr').find('.total_seat').attr('class').split(' ').pop();
			$(this).closest('tr').find('.total_seat').removeClass(lastClass);
			var lastClass1 =$(this).closest('tr').find('.total_std').attr('class').split(' ').pop();
			$(this).closest('tr').find('.total_std').removeClass(lastClass1);
			
			$(this).closest('tr').find('.total_seat').addClass('sss_'+b_id);
			$(this).closest('tr').find('.total_std').addClass('ccc_'+b_id);
			
			
			
			
			if(b_id=="" || b_id==null)
			{
				//$('#depart_id').prop('disabled',true);
				//$('#group_id').prop('disabled',true);
				//window.location.reload();
			}
			else
			{
				//$('#depart_id').prop('disabled',false);
			$.ajax({
			  url:BASE_URL+"seat/get_all_std",
			  type:'GET',
			  data:{ 
						batch_id : my_batch_id.val(),
						depart_id : my_depart_id.val(),
						group_id:$(this).val()
						
				   },
			  success:function(result){
				  var tt=Number(result);
				  my_td.val(tt);
				 }    
			});	
			}
	   });
	   $('.total_seat1').live('blur',function(){
		   
		    arr_list=[];
			var k=0;
		    $('.total_seat').each(function(){
				arr=[];
				my_batch_id=$(this).closest('tr').find('#select_batch');
				my_depart_id=$(this).closest('tr').find('#depart_id');
				my_group_id=$(this).closest('tr').find('#group_id');
				my_cols_no=$(this).closest('tr').find('.cols_no');
				total_seat=$(this).val();
				arr[0]=my_batch_id.val();
				arr[1]=my_depart_id.val();
				arr[2]=my_group_id.val();
				arr_list[my_cols_no.val()]=arr;
				k++;
			});
		   console.log(arr_list);
		   $.ajax({
			  url:BASE_URL+"seat/get_all_seat_view",
			  type:'GET',
			  data:{ 
						list : arr_list
						
				   },
			  success:function(result){
				  alert('ss');
				    seat_view.html(result);
				 }    
			});	
		/*	my_batch_id=$(this).closest('tr').find('#select_batch');
			my_depart_id=$(this).closest('tr').find('#depart_id');
			my_group_id=$(this).closest('tr').find('#group_id');
			b_id=$(this).val();
			if(b_id=="" || b_id==null)
			{
				//$('#depart_id').prop('disabled',true);
				//$('#group_id').prop('disabled',true);
				//window.location.reload();
			}
			else
			{
				//$('#depart_id').prop('disabled',false);
			$.ajax({
			  url:BASE_URL+"seat/get_all_std",
			  type:'GET',
			  data:{ 
						batch_id : my_batch_id.val(),
						depart_id : my_depart_id.val(),
						group_id : my_group_id.val()
						
				   },
			  success:function(result){
				  var tt=Number(result);
				  my_td.val(tt);
				 }    
			});	
			}*/
	   });
</script>



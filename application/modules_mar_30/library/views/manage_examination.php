<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>  
<div class="row">
	<div class="col-lg-12">
		<table class="staff_table" width="100%">
            <tr>
                <td width="150">Exam Paper NO</td>
                <td><input type="text" tabindex="1" name="exam_no"  id="exam_no" class="mandatory mandatory1"/>
                <span style="color:red;" id="v1" class="v1"></span> </td>
                <td width="150">Subject</td>
                <td><input type="text" tabindex="1" name="subject"  id="subject" class="mandatory mandatory1 subject"/>
                <span style="color:red;" id="v1" class="v1"></span> </td></td>
            </tr>
            
        <tr>
            <td>Year</td>
            <td><input type="text" tabindex="2" name="year" class="mandatory1 mandatory year" id="year"  />
            <span style="color:red;" id="v2" class="v2"></span> </td>
            <td>No. of Pages</td>
            <td><input type="text" tabindex="3" name="page" class=" mandatory1 mandatory page" id="page"  />
            <span style="color:red;" id="v3" class="v3"></span> </td>
            </td>
        </tr>
        <tr>
            <td>Publisher</td>
            <td><input type="text" tabindex="4" name="publisher" class="mandatory1 mandatory publisher" id="publisher"  />
            <span style="color:red;" id="v4" class="v4"></span> </td>            
            <td>Select Rack</td>           
            <td><select name="select_rack" id="select_rack" class="mandatory select_rack"  >
            <option value="" selected="selected">Select</option>
           <?php 
			if(isset($rack) && !empty($rack))
			{
				foreach ($rack as $rack_val)
				{
					?>
          
            <option value="<?php echo $rack_val['brid']; ?>"><?php echo $rack_val['bk_rack']; ?></option>
            <?php }}; ?>
            </select></td>
        </tr>
        <tr>
            <td>Row</td>
            <td><input type="text" tabindex="4" class="book_row mandatory1 mandatory" id="select_row"/>
           </td>
            <td></td>
            <td>
                <input type="button" value="Add" name="adding" id="submit" class="btn btn-primary" tabindex="8" />
                <input type="button" value="Cancel" id="cancel" class="btn btn-danger" tabindex="9"/>
            </td>
        </tr>
        </table>
	</div>
</div>
<br /><br />
<div class="tab-pane" id="view_all"> 
<table id="example3" class="table table-bordered table-striped">
   
      <thead>
    	<tr>
            <th>S.no</th>
            <th>Exam Paper No</th>
            <th>Subject</th>
            <th>Rack</th>
            <th>Row</th>
            <th>Year</th>
            <th>No. of Pages</th>
            <th>Publisher</th>
            <th>Action</th>
        </tr>
        </thead>

<?php $i=0;
			if(isset($details) && !empty($details))
			{
				foreach ($details as $view)
				{
					?>
     
					<tr>
                        <td><?php echo  $i+1; ?></td>
                         <td><?php echo $view['exam_no'];?></td>
                        <td><?php echo $view['subject'];?></td>
                        <td><?php 
										if(isset($rack) && !empty($rack))
										{
										foreach ($rack as $rack_val)
										{
										?>
										<?=($view['rack']==$rack_val['brid'])?$rack_val['bk_rack']:''?> 
										<?php 
										}
										} 
										?>
									 </td>
                        <td><?php echo $view['row'];?></td>
                         <td><?php echo $view['year'];?></td>
                          <td><?php echo $view['no_of_page'];?></td>
                           <td><?php echo $view['publisher'];?></td> 
                             <td>
                        <a href="#view_batch<?php  echo $view['id']; ?>" title="View" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="#test1_<?php  echo $view['id']; ?>" title="Edit" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="#delete_batch<?php  echo $view['id']; ?>" title="Delete" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                        </td>                    
                       
                    </tr>
					<?php $i++;} } ?> 

	</table>
    </table>
 	</div>
<!--View form-->
 <?php $i=0;
   			if(isset($details) && !empty($details))
			{
				foreach ($details as $view)
				{?>
	
         <div id="view_batch<?=$view['id']?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
         aria-hidden="false" style= align="center">
         	<div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                   <h3 id="myModalLabel">View Exam Paper</h3>
                  </div>
                  <div class="modal-body">
                      <table class="staff_table_sub">
                             <tbody>
                                    <tr>
                                     <td>Exam Paper NO</td>
                                     <td class="text_bold1"><?=$view['exam_no']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Subject</td>
                                     <td class="text_bold1"><?=$view['subject']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Rack</td>
                                     <td class="text_bold1">
									 <?php 
										if(isset($rack) && !empty($rack))
										{
										foreach ($rack as $rack_val)
										{
										?>
										<?=($view['rack']==$rack_val['brid'])?$rack_val['bk_rack']:''?> 
										<?php 
										}
										} 
										?>
									 
                                     
                                      </td>
                                    </tr>
                                    <tr>
                                     <td>Row</td>
                                     <td class="text_bold1"><?=$view['row']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Year</td>
                                     <td class="text_bold1"><?=$view['year']?> </td>
                                    </tr>
                                    <tr>
                                     <td>No. of Pages</td>
                                     <td class="text_bold1"><?=$view['no_of_page']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Publisher</td>
                                     <td class="text_bold1"><?=$view['publisher']?> </td>
                                    </tr>
                                                                        
                                </tbody>
                            </table>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Discard</button>
                  </div>
                  </div>
                  </div>
                </div>
<?php $i++;}} ?> 


<!--View form end-->

 <!--Update form Start-->
        
 <?php
   if(isset($details) && !empty($details))
	{
	foreach ($details as $view)
	 {?>
	
       
<div id="test1_<?php echo $view['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content" >
 		 <div class="modal-header">
           <a class="close" data-dismiss="modal">×</a>
           <h3 id="myModalLabel">Update Exam Paper</h3>
          </div>
 		 <div class="modal-body">
        <table width="100%" border="0">  
          <tr>
            <td width="25%">Exam NO Paper</td>
            <td width="47%"><input type="text"  class="exam_ed"  value="<?php echo $view['exam_no']; ?>" /></td>
          </tr>
          <tr>
            <td width="25%">Subject</td>
            <input type="hidden" value="<?php echo $view['id']; ?>" name="id" id="id_name" class="id_name" />
            <td width="47%"><input type="text" name="subject_ed" class="subject_ed" id="subject_ed" value="<?php echo $view['subject']; ?>" /></td>
          </tr>
          <tr>
            <td>Select Rack</td>
           
            <td><select name="select_rack" id="" class="mandatory select_rack_ed"  >
            <option value="" selected="selected">Select</option>
           <?php 
            if(isset($rack) && !empty($rack))
            {
                foreach ($rack as $rack_val)
                {
                    ?>
                    <option <?=($view['rack']==$rack_val['brid'])?'selected':''?> value="<?php echo $rack_val['brid']; ?>"><?php echo $rack_val['bk_rack']; ?></option>
                    <?php 
                }
            } 
            ?>
            </select></td>
        </tr>
        <tr>
            <td>Select Row</td>
            <td><input type="text" tabindex="4" class="book_row mandatory1 mandatory select_row_ed" value="<?=$view['row']?>"/>
           </td>
        </tr>
          <tr>
            <td width="25%">Year</td>
            <td width="47%"><input type="text" name="year_ed" class="year_ed" id="year_ed" value="<?php echo $view['year']; ?>" /></td>
          </tr>
          <tr>
            <td width="25%">No. of Pages</td>
            <td width="47%"><input type="text" name="no_of_page_ed" class="no_of_page_ed" id="no_of_page_ed" value="<?php echo $view['no_of_page']; ?>" /></td>
          </tr>
          <tr>
            <td width="25%">Publisher</td>
            <td width="47%"><input type="text" name="publisher_ed" class="publisher_ed" id="publisher_ed" value="<?php echo $view['publisher']; ?>" /></td>
          </tr>
        </table>
  	</div>
      <div class="modal-footer">   
        <button class="btn btn-primary update_btn delete update_batch"  name="update" id="update_year"><i class="fa fa-edit">
        </i> Update</button>
        <button type="button" class="no btn btn-danger" data-dismiss="modal" id="no"><i class="fa fa-times"></i> Discard</button>
      </div>
  </div>
  </div>
</div>

<?php }}?> 
 <!--Update form End-->
 
 <!--Delete form Start-->
<?php 
if(isset($details) && !empty($details))
{
foreach($details as $view) 
{
 ?>   
<div id="delete_batch<?php echo $view['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
aria-hidden="false" align="center">
	<div class="modal-dialog">
 		 <div class="modal-content">
    			<div class="modal-header">
   					 <a class="close" data-dismiss="modal">×</a>
           				 <h3 id="myModalLabel">Delete exam paper details</h3>
			    </div>
  				<div class="modal-body">
  					Do you want to In-Active it? &nbsp; <strong></strong>
    			    <input type="hidden" value="<?php echo $view['id']; ?>" class="hidin" />
  				</div>
  				<div class="modal-footer">
    				<button class="btn btn-primary delete_yes" id="yesin">Yes</button>
    				<button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no">
                    <i class="fa fa-times"></i> No</button>
  				</div>
		</div>
	</div>  
</div>
<?php }} ?>



<script type="text/javascript">
$(document).ready(function(){
	$("#submit").live('click',function()
	 {
		var i=0;
		var subject=$("#subject").val(),
		year=$("#year").val(),
		page=$("#page").val(),
		exam_no=$("#exam_no").val(),
		publisher=$("#publisher").val();
		
		select_rack=$("#select_rack").val();
		select_row=$("#select_row").val();
		
		if(subject=='')
		{
		$(".v1").html("Required Field");
		i=1;
		}
		else
		{
		$(".v1").html("");
		}
		if(year=='')
	{
		$(".v2").html("Required Field");
		i=1;
	}
	else
	{
		$(".v2").html("");
	}
	if(page=='')
	{
		$(".v3").html("Required Field");
		i=1;
	}
	else
	{
		$(".v3").html("");
	}
	var publisher=$(".publisher").val();
	if(publisher=='')
	{
		$(".v4").html("Required Field");
		i=1;
	}
	else
	{
		$(".v4").html("");
	}
	if(i==1)
	{
		return false;
	}
	else
	{
		 for_loading('Loading... Data Adding...');
		$.ajax({
			url:BASE_URL+"library/insert_manage_expr",
			type:'POST',
			data:{ value1 : subject,value2 : year,value3 : page,value4 : publisher,value5 : exam_no,value6:select_rack,value7:select_row},
			success:function(result)
				{
					//alert(result);
					$("#view_all").html(result);
					for_response('Add Successfully...!'); //
					//$(".after_email").html('');
				}
		

		});
		$("#exam_no").val('');
		$("#subject").val('');
		$("#year").val('');
		$("#page").val('');
		$("#publisher").val('');
		$("#select_rack").val('');
	}
	});
	$("#update_year").live('click',function()
	 {
		 
		var i=0;
		
		var id_name=$(this).parent().parent().parent().find('.id_name').val(),
		
		exam_ed=$(this).parent().parent().parent().find('.exam_ed').val(),
		subject_ed=$(this).parent().parent().parent().find('.subject_ed').val(),
		year_ed=$(this).parent().parent().parent().find('.year_ed').val(),
		no_of_page_ed=$(this).parent().parent().parent().find('.no_of_page_ed').val(),
		select_rack_ed=$(this).parent().parent().parent().find('.select_rack_ed').val(),
		select_row_ed=$(this).parent().parent().parent().find('.select_row_ed').val(),
		publisher_ed=$(this).parent().parent().parent().find('.publisher_ed').val();
		
		var subject=$(".subject").val();
		
		 for_loading('Loading... Data Adding...');
		$.ajax({
			url:BASE_URL+"library/update_paper",
			type:'POST',
			data:{ 
			value1 : id_name,
			value2 : subject_ed,
			value3 : year_ed,
			value4 : no_of_page_ed,
			value5 : publisher_ed,
			value6 : exam_ed,
			value7 : select_rack_ed,
			value8 : select_row_ed
			},
		
			success:function(result)
				{
					//alert(result);
					$("#view_all").html(result);
					for_response('Add Successfully...!'); //
					//$(".after_email").html('');
				}
		
		

		});
	
		$('.modal').css("display", "none");
    	$('.fade').css("display", "none");
	 });
	 
	  $("#yesin").live("click",function()
	  {
	   for_loading_del('Loading... Please wait'); // loading notification
	    var hidin=$(this).parent().parent().find('.hidin').val();
		  $.ajax(
		 	{
			  url:BASE_URL+"library/delete_exam_paper",
			  type:'POST',
			  data:{ value1 : hidin},
			  success:function(result){
				  //alert(result);
			  $("#view_all").html(result);
			  for_response_del(' Success...!'); // resutl notification
			 }    
	 	 });
	    $('.modal').css("display", "none");
    	$('.fade').css("display", "none");
	}); 
	 

});
</script>



<script>
$(".subject").live('blur',function(){
	
	var subject=$(".subject").val();
	if(subject=='')
	{
		$(".v1").html("Required Field");
	}
	else
	{
		$(".v1").html("");
	}
});
$(".year").live('blur',function(){
	
	var year=$(".year").val();
	if(year=='')
	{
		$(".v2").html("Required Field");
	}
	else
	{
		$(".v2").html("");
	}
	
});
$(".page").live('blur',function(){
	
	var page=$(".page").val();
	if(page=='')
	{
		$(".v3").html("Required Field");
	}
	else
	{
		$(".v3").html("");
	}
});
$(".publisher").live('blur',function(){
	
	var publisher=$(".publisher").val();
	if(publisher=='')
	{
		$(".v4").html("Required Field");
	}
	else
	{
		$(".v4").html("");
	}
});



</script>
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

<div class="tab-pane" id="view_all"> 
<table id="example3" class="table table-bordered table-striped">
   
      <thead>
    	<tr>
            <th>S.no</th>
            <th>Exam Paper NO</th>
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
 		 <div class="modal-body" style="margin-left: 100px;">
        <table width="100%" border="0">
  <tr>
    <td width="25%">Exam Paper NO</td>
   
    <td width="47%"><input type="text" name="" class="exam_ed"  value="<?php echo $view['exam_no']; ?>" /></td>
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
           				 <h3 id="myModalLabel">Delete exam paper Details</h3>
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






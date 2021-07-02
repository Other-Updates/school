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
            <th>CD No</th>
            <th>Title</th>
            <td>Rack</td>
            <td>Row</td>
            <th>Price</th>
            <th>Date of Receipt</th>
            <th>Date of Purchase</th>
            <th>Publisher's name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Action</th>
        </tr>
        </thead>

<?php $i=0;//echo '<pre>';
			if(isset($details) && !empty($details))
			{
				foreach ($details as $view)
				{
					//print_r($view);
					?>
     
					<tr>
                        <td><?php echo  $i+1; ?></td>
                          <td><?php echo $view['cd_no'];?></td>
                        <td><?php echo $view['cd_title'];?></td>
                        <td><?php echo $view['bk_rack'];?>		 </td>
                        <td><?php echo $view['row'];?></td>
                           <td><?php echo $view['price'];?></td> 
                           <td><?php echo $view['date_of_receipt'];?></td>
                         <td><?php echo $view['date_of_purchase'];?></td>
                          <td><?php echo $view['pub_name'];?></td>
                           <td><?php echo $view['pub_email'];?></td>
                           <td><?php echo $view['pub_contact_no'];?></td>
                         
                          
                             <td>
                        <a href="#view_batch<?php  echo $view['id']; ?>" title="View" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="<?php $this->config->item("base_url"); ?>library/edit_cd/<?=$view['id']?>" title="Edit" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="#delete_batch<?php  echo $view['id']; ?>" title="Delete" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                        </td>                    
                       
                    </tr>
					<?php $i++;} } ?> 

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
                                     <td>CD NO</td>
                                     <td class="text_bold1"><?=$view['cd_no']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Title</td>
                                     <td class="text_bold1"><?=$view['cd_title']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Rack</td>
                                     <td class="text_bold1">
									
									 <?=$view['bk_rack']?> 
                                     
                                      </td>
                                    </tr>
                                    <tr>
                                     <td>Row</td>
                                     <td class="text_bold1"><?=$view['row']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Language</td>
                                     <td class="text_bold1"><?=$view['lang_type']?> </td>
                                    </tr>
                                    
                                    <tr>
                                     <td>Price</td>
                                     <td class="text_bold1"><?=$view['price']?> </td>
                                    </tr>
                                    <tr>
                                    <td>Date of Receipt</td>
                                     <td class="text_bold1"><?=$view['date_of_receipt']?> </td>
                                    </tr>
                                    <tr>
                                    <td>Date of Purchase</td>
                                     <td class="text_bold1"><?=$view['date_of_purchase']?> </td>
                                    </tr>
                                    <tr>
                                    <td>Publisher's name</td>
                                     <td class="text_bold1"><?=$view['pub_name']?> </td>
                                    </tr>
                                    <tr>
                                    <td>Email</td>
                                     <td class="text_bold1"><?=$view['pub_email']?> </td>
                                    </tr>
                                    <tr>
                                    <td>Contact Number</td>
                                     <td class="text_bold1"><?=$view['pub_contact_no']?> </td>
                                    </tr>
                                    <tr>
                                    <td>Publisher's address</td>
                                     <td class="text_bold1"><?=$view['pub_address']?> </td>
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
           				 <h3 id="myModalLabel">Delete CD/DVD Details</h3>
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




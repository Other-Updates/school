<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type='text/javascript' src='<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
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

<div class="nav-tabs-custom" id="list_all"><ul class="nav nav-tabs">
      <table id="example5" class="table table-bordered table-striped">
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
          <td> <a href="#test1_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm" title="Edit"><i class="fa fa-edit">	 			</i></a>
            </td>
               <?php  
                }
					}
            ?>
        	</tr>
        </table>
        </ul>
        </div>
         
	<?php 
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
            <td class="text_bold1"><?php echo $billto["block"]; ?></td>
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
<?php }} ?>

<?php 
if(isset($list) && !empty($list))
{ 
foreach($list as $billto) 
{
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
                <td><input type="hidden" name="id" class="id form-control" id="" value="<?php echo $billto["id"]; ?>" readonly /></td>
                </tr>         
                <tr>
                <th><strong>Hostel Name:</strong></th>
                    <td>
                    	<select class='hostel_name room ' id="" name="hostel_monthly_fees[block_id]">
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
                <td><input type="text" class="name form-control name" id=""  name="hostel" value="<?php echo $billto["room_name"]; ?>" /></td>
                </tr>
                <tr>
                <td><strong>No of Students:</strong></td>
                <td><input type="text" class="seat form-control" id="seat"  name="hostel" value="<?php echo $billto["no_of_seat"]; ?>" /></td>
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
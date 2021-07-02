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
<div class="row"><div class="example1_wrapper">
<table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="10%">S.No</th>
                <th width="10%">Bus RTO.No</th>
                <th width="10%">Bus.No</th>
                <th width="10%">Driver Name</th>
                <th width="10%">In-Charge Name</th>
                 <th width="10%">Action</th>
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
                 <tr><td width="10%"><?php echo "$i"; ?></td>
                 <td width="10%"><?php echo $billto["rto_no"]; ?></td>
                 <td width="10%"><?php echo $billto["bus_no"]; ?></td>
                 <td width="10%"><?php echo $billto['driver'][0]['driver'];?></td>
                 <td width="10%"><?php echo $billto['cleaner'][0]['cleaner'];?></td>
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
        
        
<!--VIEW FORM 1...........................................................................................................-->        
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
          <td width="10%"><strong>Bus RTO.No</strong></td> <td class="text_bold1"><?php echo $billto["rto_no"]; ?></td></tr>
          <td width="10%"><strong>Bus No</strong></td> <td class="text_bold1"><?php echo $billto["bus_no"]; ?></td></tr>
          <td width="10%"><strong>Driver Name</strong></td> <td class="text_bold1"><?php echo $billto['staff_name']?></td></tr>
          <td width="10%"><strong>In-Charge Name</strong></td> <td class="text_bold1"><?=$all_cleaner[0]['staff_name']?></td></tr>
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
        <td><input type="hidden" name="id" class="id " id="id" value="<?php echo $billto["id"]; ?>" readonly="readonly" /></td>
         </tr> 
         <tr><td>Bus RTO.No</td><td><input type="text" name="rtono1" id="rtono1" class="rtono1" value="<?php echo $billto["rto_no"]; ?>" /></td></tr>
<tr><td>Bus No</td><td><input type="text" name="busno1" id="busno1" class="busno1" value="<?php echo $billto["bus_no"]; ?>" /></tr></td>
<tr><td>Driver Name</td>
        <td>
        	<select id='drivname1' name='drivname1'  class=" drivname1">
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
                                <option value="<?=$value['id']?>"><?=$value['staff_name']?></option>
                            <?php 
                        }
                    }
                ?>
            </select>
        </td></tr>        
         </tr>
         </table>
    
     	
  	</div>
  		<div class="modal-footer">
   			 <button type="button" class="btn btn-primary"  id="update"><i class="fa fa-edit"></i> Update</button>
    		 <button type="reset" class="btn btn-danger"  id="no" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
</div>        
<?php }} ?>
</div>
</div>

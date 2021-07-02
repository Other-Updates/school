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
			
<table id="example4" class="table table-bordered table-striped" style="font-size:10px">
            <thead>
            <tr>
                <th>S.No</th>
                <th>Route Name</th>
                <th>Source</th>
                <th>Bus No</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
			<?php 
                if(isset($bus_number) && !empty($bus_number))
                {
					$i=0;
                    foreach($bus_number as $billto) 
                    {
                      $i++
            ?>   
                 <tr><td><?php echo "$i"; ?></td>
                 <td><?php echo $billto["root_name"]; ?></td>
                 <td><?php echo $billto["source"]; ?></td>
                 <td><?php echo $billto["bus_no"]; ?></td>
                 </td>
                 <td>
         <a href="#1test_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm" title="View"><i class="fa fa-eye"></i></a>
         <a href="#1test1_<?php echo $billto['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                
                </td>
                </tr>
           			<?php   
          			  }
				}
       			 ?>
        </tbody>
	    </table>
        <!--VIEW FORM 
        
         <?php 
if(isset($bus_number) && !empty($bus_number))
{
foreach($bus_number as $billto) 
{
 ?>   

<div id="1test_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  <div class="modal-dialog">
  <div class="modal-content">
     <div class="modal-header"><a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel">Route View</h3>
    </div>
  <div class="modal-body">
  <table width="100%" class="staff_table_sub">
        <tr>
        <?php /*?><td><strong>S.No</strong></td> <td><?php echo $billto["id"]; ?></td></tr><tr><?php */?>
        <td><strong>Route Name</strong></td> <td class="text_bold1"><?php echo $billto["root_name"]; ?></td></tr>
         <td><strong>Source</strong></td> <td class="text_bold1"><?php echo $billto["source"]; ?></td></tr>
          <td><strong>Bus Number</strong></td> <td class="text_bold1"><?php echo $billto["bus_no"]; ?></td></tr>
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
 <!-- UPDATE FORM 2.........................................................................................................................................-->
  <?php 
if(isset($bus_number) && !empty($bus_number))
{
foreach($bus_number as $billto) 
{
 ?>   
<div id="1test1_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  	<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a>   
    <h3 id="myModalLabel">Update Route</h3></div>
  	<div class="modal-body">
    <table width="100%">
         <tr>
         <!--<td><strong>S.No</strong></td>-->
         <td><input type="hidden" name="id" class="id" id="id" value="<?php echo $billto["id"]; ?>" readonly="readonly" /></td>
         </tr> 
         <tr><td>Route Name</td><td><input type="text" name="root1" id="root1" class="root1" value="<?php echo $billto["root_name"]; ?>" /></td></tr>
<tr><td>Source</td><td><input type="text" name="source1" id="source1" class="source1" value="<?php echo $billto["source"]; ?>" /></tr></td>
<tr><td>Bus No</td>
        <td>
        	<select id='busn_1' name='busn_1'  class="busn_1">
				<?php 
                    if(isset($details) && !empty($details)){
                        foreach($details as $val)
                        {
                            ?>
                            <option <?=($val['id']==$billto['rbus_no'])?'selected':''?> value="<?=$val['id']?>"><?=$val['bus_no']?></option>
                            <?php 
                        }
                    }
                ?>
            </select>
        </td></tr>
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



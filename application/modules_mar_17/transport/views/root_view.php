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


<div id="list_all_two">
<table id="example4" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>S.No</th>
                <th>Master Vehicle</th>
                <th>Master Route</th>
                <th>Master Stage</th>
                 <th>Action</th>
                </tr>
            </thead>
            <tbody>
			<?php 
                if(isset($root_detail) && !empty($root_detail))
                {
					$i=0;
                    foreach($root_detail as $billto) 
                    {
                        							$i++
            ?>   
                 <tr><td><?php echo "$i"; ?></td>
                 <td><?php echo $billto["bus_no"]; ?></td>
                 <td><?php echo $billto["root_name"]; ?></td>
                 <td><?php echo $billto["stage_name"]; ?></td>
               
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
if(isset($root_detail) && !empty($root_detail))
{
foreach($root_detail as $billto) 
{
 ?>   

<div id="1test_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel">Bus View</h3>
    </div>
  <div class="modal-body">
  <table width="100%" class="staff_table_sub">
        <tr>
          <td><strong>Bus RTO.No</strong></td> <td class="text_bold1"><?php echo $billto["bus_no"]; ?></td></tr>
          <td><strong>Bus No</strong></td> <td class="text_bold1"><?php echo $billto["root_name"]; ?></td></tr>
          <td><strong>Driver Name</strong></td> <td class="text_bold1"><?=$billto['stage_name']?></td></tr>
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
if(isset($details) && !empty($details))
{
foreach($details as $billto) 
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
        <table width="40%">
<tr><td>Master Vechical</td>
        <td>
        	<select id='master_vel' name='master_vel'  class="master_vel form-control mandatory">
            	
				<?php 
                    if(isset($details) && !empty($details)){
                        foreach($details as $val)
                        {
                            ?>
                                <option value="<?=$val['id']?>"><?=$val['bus_no']?></option>
                            <?php 
                        }
                    }
                ?>
            </select><span id="v3" class="val" style="color:#F00;"></span>
        </td></tr>
        <tr><td>Master Root</td>
        <td>
        	<select id='master_root_up' name='master_root_up'  class="master_root_up form-control mandatory">
            	
				<?php 
                    if(isset($root) && !empty($root)){
                        foreach($root as $value)
                        {
                            ?>
                                <option value="<?=$value['id']?>"><?=$value['root_name']?></option>
                            <?php 
                        }
                    }
                ?>
            </select><span id="v4" class="val" style="color:#F00;"></span>
        </td></tr>
         <tr><td>Master Stage</td>
        <td>
        	<select id='master_sta' name='master_sta'  class="master_sta form-control mandatory">
            	<?php 
                    if(isset($master_details) && !empty($master_details)){
                        foreach($master_details as $value)
                        {
                            ?>
                                <option value="<?=$value['id']?>"><?=$value['stage_name']?></option>
                            <?php 
                        }
                    }
                ?>
            </select><span id="v4" class="val" style="color:#F00;"></span>
        </td></tr></table>
    
     	
  	</div>
  		<div class="modal-footer">
   			 <button type="button" class="btn btn-primary"  id="update"><i class="fa fa-edit"></i> Update</button>
    		 <button type="reset" class="btn btn-danger"  id="no" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
  		</div>
</div>
</div>        
</div>
<?php }} ?>    
</div>  
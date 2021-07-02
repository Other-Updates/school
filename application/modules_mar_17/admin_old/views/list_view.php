<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
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
        <div class="nav-tabs-custom" id="list_all">
                                <ul class="nav nav-tabs">
                                    <li class="<?=($status==1)?'active':''?>"><a href="#tab_1" data-toggle="tab">Active</a></li>
                                    <li class="<?=($status!=1)?'active':''?>"><a href="#tab_2" data-toggle="tab">Inactive</a></li>
                                    
                                    
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane <?=($status==1)?'active':''?>" id="tab_1">
                                       
<table id="example1" class="table table-bordered table-striped">
<thead>
	<th>S.No</th>
    <th>Name</th>
     <th>Designation</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Status</th>
    <th>Created Date</th>
    <th>Action</th>
</thead>

<tbody>
<?php 

if(isset($list) && !empty($list))
{	
$row_count = 0;
foreach($list as $billto) 
{
	
	if($billto['status']==1)
	{
		$row_count++;
	?>			
					<tr><td><?php echo $row_count; ?></td>
                    <td><?php echo $billto["name"]; ?></td>
                     <td><?php echo $billto["designation"]; ?></td>
                    <td><?php echo $billto["email_id"]; ?></td>
                    <td><?php echo $billto["phone_no"]; ?></td>
                    <td><?php echo ($billto["status"]==1)?'Active':'Inactive'; ?></td>
                    <td><?php echo ($billto['ldt']==0)?'--':date("d-M-Y",strtotime($billto["ldt"])); ?></td>
                    <td><a href="#test_<?php echo $billto["id"]; ?>" title="View" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="<?=$this->config->item('base_url').'admin/update_admin/'.$billto["id"]; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="#delete_<?php echo $billto["id"]; ?>" title="In-Active" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                    </td></tr>

			<?php 		
				}
				
				}}
?>
</tbody>
</table>

                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane <?=($status!=1)?'active':''?>" id="tab_2">
                                        
<table id="example3" class="table table-bordered table-striped">
<thead>
	<th>S.No</th>
    <th>Name</th>
    <th>Designation</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Status</th>
    <th>Date</th>
    <th>Action</th>
</thead>

<tbody>
<?php 

if(isset($list) && !empty($list))
{	
$row = 0;
foreach($list as $billto) 
{
	if($billto['status']==0)
	{
		$row++;
	?>			
					<tr><td><?php echo $row; ?></td>
                    <td><?php echo $billto["name"]; ?></td>
                    <td><?php echo $billto["designation"]; ?></td>
                    <td><?php echo $billto["email_id"]; ?></td>
                    <td><?php echo $billto["phone_no"]; ?></td>
                    <td><?php echo ($billto["status"]==1)?'Active':'Inactive'; ?></td>
                    <td><?php echo ($billto['ldt']==0)?'--':date("d-M-Y",strtotime($billto["ldt"])); ?></td>
                    <td><a href="#test_<?php echo $billto["id"]; ?>" title="View" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="<?=$this->config->item('base_url').'admin/update_admin/'.$billto["id"]; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="#indelete_<?php echo $billto["id"]; ?>" title="Delete" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                    </td></tr>

			<?php 		
				}
				
				}
				}
?>
</tbody>
</table>

                                    </div><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->
                            </div>
 <?php 
if(isset($list) && !empty($list))
{	
foreach($list as $billto) 
{
	?>
<div id="test_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    
    <a class="close" data-dismiss="modal">×</a>
   <h3 id="myModalLabel">Admin View</h3>
    </div><div class="modal-body" >
<table class="view_table">

<tr>
	<td>Name</td><td class="text_bold"> <?php echo $billto['name']; ?></td>
</tr>
<tr>
	<td>Designation</td><td class="text_bold"> <?php echo $billto['designation']; ?></td>
</tr>
<tr>
	<td>Email ID</td><td class="text_bold"> <?php echo $billto['email_id']; ?> </td>
</tr>
<tr>
	<td>Phone Number</td><td class="text_bold"> <?php echo $billto['phone_no']; ?></td>
</tr>
<tr>
	<td>Address</td><td class="text_bold"> <?php echo nl2br($billto['address']); ?></td>
</tr>
<tr>
	<td>Status</td><td class="text_bold"> <?php  echo ($billto["status"]==1)?'Active':'Inactive'; ?></td>
</tr>
</table>

  </div>
  <div class="modal-footer">   
   <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
  </div></div>
  </div>
</div>
<?php
}}
?>

<?php 
if(isset($list) && !empty($list))
{	
foreach($list as $billto) 
{
	?>
    <div id="close">
<div id="delete_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel">Admin Inactive</h3>
    </div>
  <div class="modal-body" >
   	Are you sure want to move  <b><?php echo $billto['name']; ?></b> to Inactive?	
    <input type="hidden" value="<?php echo $billto['id']; ?>" class="hid" />

  </div>
  <div class="modal-footer">
   <input type="button" value="In-Active" id="yes" class="btn btn-primary delete"  />
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
	</div>
    </div>
  </div>
</div>
</div>
<?php
}}
?>
<?php 
if(isset($list) && !empty($list))
{	
foreach($list as $billto) 
{
	?>
    <div id="close">
<div id="indelete_<?php echo $billto['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
   <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel">Delete Admin</h3>
    </div>
  <div class="modal-body" >
   	Are you sure want to delete  <b><?php echo $billto['name']; ?></b> permanently?
    <input type="hidden" value="<?php echo $billto['id']; ?>" class="hidin" />

  </div>
  <div class="modal-footer">
   <input type="button" value="Yes" id="yesin" class="btn btn-primary delete"  />
   <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
  </div>
  </div>
  </div>
</div>
</div>
<?php
}}
?>
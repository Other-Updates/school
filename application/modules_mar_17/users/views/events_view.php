<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<link href="<?= $theme_path; ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/datatables/stu_data_table.css" rel="stylesheet" type="text/css" />
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/events.png"></div>
    Events
    <input type="button" name=type id='bt1' value='Show Public Events' class=" btn btn-primary btn-sm hid" style="position:relative;top: -2;
right: -483;" onclick="setVisibility('sub3');" />
</div> 
<div class="message-form-inner">
<table id="example1" class="table table-bordered table-striped" width="100%">
<thead>
    <tr>
        <th>S.No&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>Image&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>Event Name</th>        
        <th>Event Date&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>Venue&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>View&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    </tr>
</thead>
<?php
if(isset($events) && !empty($events))
{$i=0;
foreach($events as $val)
{
if($val['status']==1)
$i++
?>
    <tr>
    <td><?php echo"$i";?></td>
    <td>    
     <a href="#event_image" class='ajax' role="button" data-toggle="modal"><img class="stu_thumbnail" src="<?=$this->config->item('base_url').'profile_image/events/orginal/'.$val['image']?>" /></a>    
    </td>
    <td class="green"><?=$val['event_name']?></td>
    <td><?=$val['date']?></td>
    <td><?=$val['type']?></td> 
   <?php /*?>	<td class="text_bold"><span style="color:red"><?=$val['from'].'-'.$val['to']?></span></td><?php */?>
    <td><?=$val['venue']?></td>
    <td><a href="<?=$this->config->item('base_url').'users/events_view_page/'.$val['id']?>" class="btn bg-maroon btn-sm" value="View"><i class="fa fa-eye"></i></a></td>
    </tr>
<?php /*?> <td><?=date('d-M-Y',strtotime($val['ldt']));?>
</td>  <?php */?>
<?php

}}
?>
</table>

<div id="sub3" style="display:none;">
<div style="font-size: 20px;font-weight: bold;text-align: center;width: 100%; padding:10px 0; color:#058DCE">Public Events </div>
<table id="example3" class="table table-bordered table-striped" width="100%">
<thead>
    <tr>
        <th>S.No&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>Image&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>Event Name</th>        
        <th>Event Date&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>Venue&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>View&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    </tr>
</thead>

<?php
if(isset($public) && !empty($public))
{$i=0;
foreach($public as $val)
{
if($val['status']==1)
$i++
?>
    <tr>
    <td><?php echo"$i"; ?></td>
    <td>
    <a href="#event_image_public" class='ajax' role="button" data-toggle="modal"><img class="stu_thumbnail" src="<?=$this->config->item('base_url').'profile_image/events/orginal/'.$val['image']?>" /></a>    
    </td>
    <td class="green"><?=$val['event_name']?></td>
    <td><?=$val['date']?></td>
    <td><?=$val['type']?></td> 
   <?php /*?>	<td class="text_bold"><span style="color:red"><?=$val['from'].'-'.$val['to']?></span></td><?php */?>
    <td><?=$val['venue']?></td>
    <td><a href="<?=$this->config->item('base_url').'users/events_view_page/'.$val['id']?>" class="btn bg-maroon btn-sm" style="color:#FFF" value="View"><i class="fa fa-eye mess"></i></a></td>
    </tr>
<?php /*?> <td><?=date('d-M-Y',strtotime($val['ldt']));?>
</td>  <?php */?>
<?php
}}
?>
</table>
</div>
</div>
</div>
</div>



<?php /*?><div id="event_image" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Event Image</h3>
  </div>
  <div class="modal-body center">
    <img src="<?=$this->config->item('base_url').'profile_image/events/orginal/'.$val['image']?>" />
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>


<div id="event_image_public" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Event Image</h3>
  </div>
  <div class="modal-body center">
    <img src="<?=$this->config->item('base_url').'profile_image/events/orginal/'.$val['image']?>" />
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div><?php */?>


<!-- DATA TABES SCRIPT -->
<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		$("#example1").dataTable();
		$("#example4").dataTable();
		$("#example5").dataTable();
		$("#example3").dataTable();
		 $("#example4").dataTable();
		 $("#example5").dataTable();
		$('#example2').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": false
		});
	});
	
	function setVisibility(id) {
if(document.getElementById('bt1').value=='Hide Public Events'){
document.getElementById('bt1').value = 'Show Public Events';
document.getElementById(id).style.display = 'none';
}else{
document.getElementById('bt1').value = 'Hide Public Events';
document.getElementById(id).style.display = 'inline';
}
}
;
</script>



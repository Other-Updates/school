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

<div id="view_all" class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="<?=($status==1)?'active':''?>"><a href="#tab_1" data-toggle="tab">Active Batch</a></li>
<li class="<?=($status!=1)?'active':''?>"><a href="#tab_2" data-toggle="tab">Alumni Batch</a></li>
<!--<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>-->
</ul>
<br />
        <div class="tab-content">
         <div class="tab-pane <?=($status==1)?'active':''?>" id="tab_1">
      <table id="example1" class="table table-bordered table-striped">
      <thead>
    	<tr>
            <th>S.no</th>
            <th>Batch</th>
            <th>Created Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>

<?php $i=1;
			if(isset($list) && !empty($list))
			{
				foreach ($list as $view)
				{
					if($view['status']==1)
     
     				 {?>
					<tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $view['from'];?>-
                        <?php echo $view['to']; ?></td>
                        <td><?php echo date("d-M-Y",strtotime($view['ldt']));?></td>
                        <?php  $view['status']; ?> 
                        <td><?=($view['status']==1)?'Active':'Alumni';?></td>
                        <td>
                        <a href="#view_batch<?php  echo $view['id']; ?>" title="View" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="#test1_<?php  echo $view['id']; ?>" title="Edit" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="#delete_<?php  echo $view['id']; ?>" title="Alumni" data-toggle="modal" name="group" class="btn btn-info btn-sm"><i class="fa fa-fw fa-globe"></i></a>
                        </td>
                    </tr>
					<?php  $i++; }} }?> 

	</table>
	
</div>
<div class="tab-pane <?=($status!=1)?'active':''?>" id="tab_2"> 

   <table id="example3" class="table table-bordered table-striped">
      <thead>
    	<tr>
            <th>S.no</th>
            <th>Batch</th>
            <th>Created Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>

<?php $i=0;
			if(isset($list) && !empty($list))
			{
				foreach ($list as $view)
				{
					if($view['status']==0)
     
     				 {?>
					<tr>
                        <td><?php echo  $i+1; ?></td>
                        <td><?php echo $view['from'];?>-
                        <?php echo $view['to']; ?></td>
                        <td><?php echo date("d-M-Y",strtotime($view['ldt']));?></td>
                        <td><?=($view['status']==1)?'Active':'Alumni';?></td>
                        <td>
                        <a href="#view_batch<?php  echo $view['id']; ?>" title="View" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="#test1_<?php  echo $view['id']; ?>" title="Edit" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="#delete_batch<?php  echo $view['id']; ?>" title="Delete" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
					<?php $i++;}} } ?> 

	</table>
 	</div>
        </div>
        </div><!-- /.tab-pane -->


      
<?php $i=0;
   			if(isset($list) && !empty($list))
			{
				foreach ($list as $view)
				{?>
	
         <div id="view_batch<?=$view['id']?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style= align="center">
         <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                   <h3 id="myModalLabel">View Batch</h3>
                  </div>
                  <div class="modal-body">
                      <table class="staff_table_sub">
                             <tbody>
                                 
                                    <tr>
                                     <td>Batch</td>
                                     <td class="text_bold1"><?=$view['from']?> - <?=$view['to']?></td>
                                    </tr>
                                    <tr>
                                     <td>Status</th>
                                  <td class="text_bold1"><?php if($view['status']==1) echo "Active"; if($view['status']==0) echo "Alumni";?></td>
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
        
        <?php
   			if(isset($list) && !empty($list))
			{
				foreach ($list as $view)
				{?>
	
        <!--<form action="<?php //echo $this->config->item('base_url'); ?>admin/update_admin" method="post">-->
<div id="test1_<?php echo $view['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
<div class="modal-dialog">
<div class="modal-content" >
  <div class="modal-header">
   <a class="close" data-dismiss="modal">×</a>
   <h3 id="myModalLabel">Update Batch</h3>
  </div>
  <div class="modal-body" style="margin-left: 100px;">
<table width="100%" border="0">
  <tr>
    <td width="25%"></td>
    <td width="47%"><input type="hidden" name="id" class="id" value="<?php echo $view['id']; ?>" /></td>
  </tr>
  <tr>
    <td>From:</td>
    <td>
    <select name="from" required autofocus id="fdate" class="from form-control mandatory1 mandatory u_frm"  >
    <option value="" >Year</option>
    <?php for ($i = 2002; $i < date('Y')+30; $i++) : ?>
    <option <?=($view['from']==$i)?'selected':'';?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php endfor; ?>
    </select>     
    </td>
  </tr>
  <tr>
    <td>To:</td>
    <td class="end_year_update">
    <select name="to" required autofocus id="tdate" class="to form-control mandatory1 mandatory dupe">
    <option value="" >Year</option>
    <?php for ($i = $view['from']+1; $i < date('Y')+30; $i++) : ?>
    <option <?=($view['to']==$i)?'selected':'';?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php endfor; ?>
    </select> 
       <input type="hidden" value="<?php echo $view['to']; ?>" id="tr" class="tr" />
    </td>
     <td width="28%"><span class="u_val" style="color:#F00; font-weight:bold" id="up_date"> </span></td>
    </tr>
  <tr>
  <td>status:</td>
  <td>
    <select name="status"  required   class="form-control status mandatory" >
        <option <?=($view['status']==1)?'selected':'';?> value="1">Active</option>
        <option <?=($view['status']==0)?'selected':'';?> value="0">Alumni</option>
       
    </select>
     <input type="hidden" id="stat" class="stat" value="<?php echo $view["status"]; ?>"/>  
  </td>
  
  </tr>
</table>
  </div>
  <div class="modal-footer">   
    <!--<input type="button" class="btn btn-primary update_btn delete update_batch"  name="update" value="Update" />-->
    <button class="btn btn-primary update_btn delete update_batch"  name="update" id="update_year"><i class="fa fa-edit"></i> Update</button>
    <button type="button" class="no btn btn-danger" data-dismiss="modal" id="no"><i class="fa fa-times"></i> Discard</button>
  </div>
  </div>
  </div>
</div>

<?php }}?> 
<?php 
if(isset($list) && !empty($list))
{	
foreach($list as $view) 
{
	?>
<div id="close">
        <div id="delete_<?php echo $view['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
          <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3 id="myModalLabel">Alumni Batch</h3>
          </div>
          <div class="modal-body" >
            <b>Are you sure you want to Alumni Batch? 
            <input type="hidden" value="<?php echo $view['id']; ?>" class="id" /></b>
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
<?php
}}?> 


 
<?php 
if(isset($list) && !empty($list))
{
foreach($list as $view) 
{
 ?>   
<div id="delete_batch<?php echo $view['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
            <h3 id="myModalLabel">Delete Batch</h3>
    <h3 id="myModalLabel"></h3>
    </div>
  <div class="modal-body">
  Do you want to Delete Permanently? &nbsp; <strong></strong>
     <input type="hidden" value="<?php echo $view['id']; ?>" class="hidin" />
  </div>
  <div class="modal-footer">
   
    
    <button class="btn btn-primary delete_yes" id="yesin">Yes</button>
    <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i> No</button>
  </div>
</div>
</div>  
</div>
<?php }} ?>

<!--<script type="text/javascript">
$("#update_year").click(function(){
			 var fdate=$('#fdate').val();
			 var tdate=$("#tdate").val();
			 var i=0;
			 if(fdate=="")
			{
				$("#up_date").html("Select Year");
				i=1;
			}
		 });

</script>-->
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
<div id="g_div">
<table id="example1"   class="table table-bordered table-striped dataTable">
	<thead>
    	<tr>
        	<th>S.No</th>
            <th>Batch</th>
            <th>Semester</th>
            <th>Department</th>
            <th>Section</th>
            <th>Subject</th>
            <th>Subject Code</th>
            <th>Unit</th>
            <th>Topic</th>
            <th>Hours</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
	<?php 
			
        if(isset($all_syllabus) && !empty($all_syllabus)){
			$i=0;
            foreach($all_syllabus as $val)
               {
               $i++; ?>
             <tr>
             <td><?=$i?></td>
                                <td><?=$val['from']?>-<?=$val['to']?></td>
                                <td><?=$val['semester']?></td>
                                <td><?=$val['department']?></td>
                                <td><?=$val['group']?></td>
                                <td><?=$val['nick_name']?></td>
                                <td><?=$val['scode']?></td>
                                <td><?=$val['unit_group']?></td>
                                <td><?=$val['topic_group']?></td>
                                <td><?=$val['hour_group']?></td>
<td> <a href="#test_<?php echo $val['id']; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm" title="View"><i class="fa fa-eye"></i></a>
 <a href="#test2_<?php echo $val['id']; ?>" data-toggle="modal" name="group" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-times"></i></a>
</td></tr>
                        <?php 
                    }
                }
            ?>
    </tbody>
</table>
</div>



<?php 
if(isset($all_syllabus) && !empty($all_syllabus))
{
foreach($all_syllabus as $val) 
{
 ?>   
<div id="test2_<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
<div class="modal-dialog">
  <div class="modal-content">
     <div class="modal-header"> <a class="close" data-dismiss="modal">×</a>
   
    <h3 id="myModalLabel">Delete Syllabus</h3>
    </div>
  <div class="modal-body">
     Do you want to delete? &nbsp; 
    <input type="hidden" value="<?php echo $val['id']; ?>" class="hid" />
  </div>
  <div class="modal-footer">
   	
    
    <button class="btn btn-primary delete_yes" id="yes">Yes</button>
    <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i>No</button>
  </div>
</div>
</div>  
</div>
<?php }} ?>

<?php 
if(isset($all_syllabus) && !empty($all_syllabus))
{
foreach($all_syllabus as $val) 
{
 ?>   
<div id="test_<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  <div class="modal-dialog">
  <div class="modal-content">
     <div class="modal-header"><a class="close" data-dismiss="modal">×</a>
    <h3 id="myModalLabel">Syllabus View</h3>
    </div>
  <div class="modal-body">
  <table width="100%" class="staff_table_sub">
        <tr>
    <tr><td width="8%">Batch</td>
    <td class="text_bold" width="10%"><label><?=$val['from']?>-<?=$val['to']?></label></td></tr>
    <tr><td width="8%"> Semester</td>
    <td class="text_bold" width="10%"><label><?=$val['semester'] ?></label></td></tr>
    <tr><td width="8%">Department</td>
    <td class="text_bold" width="10%"><label><?=$val['department'] ?></label></td></tr>
    <tr><td width="8%">Section</td>
    <td class="text_bold" width="10%"><label><?=$val['group'] ?></label></td></tr>
    <tr><td width="8%">Subject</td>
    <td class="text_bold" width="10%"><label><?=$val['nick_name'] ?></label></td></tr>
    <tr><td width="8%">Subject Code</td>
    <td class="text_bold" width="10%"><label><?=$val['scode'] ?></label></td></tr>
    <tr><td width="8%">Unit</td>
    <td class="text_bold" width="10%"><label><?=$val['unit_group'] ?></label></td></tr>
     <tr><td width="8%">Topic</td>
    <td class="text_bold" width="10%"><label><?=$val['topic_group'] ?></label></td></tr>
    <tr> <td width="8%">Hours</td>
    <td class="text_bold" width="10%"><label><?=$val['hour_group'] ?></label></td></tr>
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




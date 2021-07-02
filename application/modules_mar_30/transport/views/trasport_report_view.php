
<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>

<style type="text/css">

</style>
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
         

<table id="example1"   class="table table-bordered table-striped dataTable">
	<thead>
    	<tr>
        	<th>S.No&nbsp;</th>
            <th>Image</th>
            <th>Roll No</th>
            <th>Name</th>
            <th>Batch</th>
            <th>Department</th>
            <th>Contact No</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
			<?php 
			
                if(isset($transport_student_list) && !empty($transport_student_list)){
					
					$i=0;
                    foreach($transport_student_list as $val)
                    {
						
                       $i++; ?>
                           <tr>
                           		<td><?=$i?></td>
                                <td><a href="#profile_img_<?= $val['id'] ?>" data-toggle="modal"><img class="staff_thumbnail" src="<?=$this->config->item('base_url').'profile_image/student/thumb/'.$val['image']?>" /></a></td>
                                <td><?=$val['std_id']?></td>
                                <td><?=$val['name']."&nbsp;".$val['last_name']?></td>
                                <td><?=$val['from'].'-'.$val['to']?></td>
                                <td><?php print_r($val['nickname'].'-'.$val['group']);?></td>
                                <td><?=$val['contact_no']?></td>
                                <td>Pending</td>
                                <td>
                                	<button id="view_tr_std" value="<?=$val['std_id']?>"  title="View" 
                                    class="btn bg-maroon btn-sm" >View</button>
                                   <?php /*?> <a href="<?=$this->config->item('base_url').'student/update_student/'.$val['id']?>" title="Edit" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a><?php */?>
                                </td>
                           </tr>
                        <?php 
                    }
                }
            ?>
    </tbody>
</table>

<br />
<input type="button" class="btn btn-primary print_class" value='Print' style="float:right;"/>
<br /><br />
<script type="text/javascript">
$(document).ready(function()
{
  $('.print_class').click(function(){
	window.print();  
  });
});
</script>
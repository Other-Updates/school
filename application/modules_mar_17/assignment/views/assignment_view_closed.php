<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
         <link href="<?= $theme_path; ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />	
         <link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/jquery.datetimepicker.css" />
		<script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.datetimepicker.js"></script>
        
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
      <br /> 
<table id="example1" class="table table-bordered table-striped">
<thead>
	<th>S.No</th>
	<th>Roll No</th>
    <th>Name</th>
    
    <th>Subject name</th>
    
    <th>Total Marks</th>
    <th>Submitted Date</th>
    <th>Mark</th>
    
</thead>
<tbody>
 <?php 
 //echo "<pre>"; print_r($sub_ass); exit;
 
if(isset($sub_ass) && !empty($sub_ass))
{
	$i=0;	
foreach($sub_ass  as $row) 
{
	$i++;
if(isset($row['student'][0]) && !empty($row['student'][0]))	
{
?>



		<tr>
        			<td><?=$i?></td>
                    <td><?php echo $row['student'][0]['std_id']; ?></td>
        
                    <td><?php echo $row['student'][0]['name']." ".$row['student'][0]['last_name'] ?></td>
                    
                   
                    <td><?php echo $row['subject'][0]['nick_name']; ?></td>
                    
                    <td><?php if(isset($row['ass_details'][0]))
					{
						
						
							echo $row['ass_details'][0]['total'];
						
					}
					else
					{
					}
					 ?></td>
                     
                    <td><?php echo date('d-m-Y',strtotime($row['ass_file'][0]['sub_date'])); ?></td>
                    <td>
                  <?php echo $row['ass_file'][0]['score']; ?>
                        </td>
                        
        </tr>




<?php
}}
?>
</tbody>
<tfoot><tr><td><td></td><td></td><td></td><td></td><td><input type="button" class="btn bg-maroon"  value="Closed" disabled  /></td><td><a target="_blank" href="<?=$this->config->item('base_url').'assignment/print_assignment_marks_nonupload/'.$row['batch_id'].'/'.$row['depart_id'].'/'.$row['group_id'].'/'.$row['semester'][0]['id'].'/'.$row['subject'][0]['id'].'/'.$row['ass_details'][0]['ass_number']; ?>" data-toggle="modal" name="group" class="btn bg-blue btn-sm">View</a><strong></strong></td></tr></tfoot>
</table>

    
    
    <?php
}
?>
</table>

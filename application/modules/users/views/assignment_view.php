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
        
 <?php 
if(isset($assignment) && !empty($assignment))
{	
foreach($assignment  as $billto) 
{
?>           
<div class="view_table"> 
<div class="row">
<div class="six columns">
<table width="100%">
	<tr>
    	<td width="40%">Assignment Date</td>
        <td width="60%" class="text_bold" style="color:green"  ><?php echo date('d-M-Y',strtotime($billto["ldt"])); ?></td>
    </tr>
    <tr>
    	<td>Due Date</td>
        <td class="text_bold"style="color:red"><?php echo date('d-M-Y',strtotime($billto["due_date"])); ?></td>      	
    </tr>
    
    
   
</table>	


</div>
<div class="six columns">
<table width="100%">
	<tr>
        <td width="40%">Total Marks</td>
        <td width="60%" class="text_bold"><?php echo $billto["total"]; ?></td>
    </tr>
    <tr>
      	<?php if($billto["close_status"]==0) {?>
      	<td>Submit</td>
        <td class="text_bold"><a target="_blank" href="<?=$this->config->item('base_url').'users/assignment_upload/'.$billto["id"]?>" data-toggle="modal" name="group">View</a></td>
        <?php } else
		{
			?>
            <td>Score</td>
        <td class="text_bold"><?php if(isset($billto["assignment_details"][0]['score'])) { echo $billto["assignment_details"][0]['score']."/Assignment Closed"; }else { echo "Assignment is Closed and Score is not updated";}?></td>
			<?php
		}?>
    </tr>
    
</table>
</div>
<table width="100%">
	<tr>
    	<td>Assignment Questions</td>
        <td class="text_bold"><?php echo $billto["question"]; ?></td>     
    </tr>
    <tr>
    	<td>Assignment File</td>
        <td class="text_bold"><a href="<?=$this->config->item('base_url').'assignment_files/questions/'.$billto['ass_file']; ?>" download="<?=$billto['ass_file']?>"><?php echo $billto['ass_file']; ?></a></td>
           
    </tr>
    <tr>
    	<td width="20%">Assignment Number</td>
        <td class="text_bold"><?php echo $billto["ass_number"]; ?></td>     
    </tr>
    <tr>
    	<td width="20%">Comments</td>
        <td class="text_bold"><?php echo $billto["comments"]; ?></td>     
    </tr>
    
</table>
</div> 



       
<?php
}}
else{
	?>
    
    <?php
}
?>
</table>
</div>


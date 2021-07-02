<?php /*?><script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script><?php */?>
<?php /*?><script type="text/javascript">
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
<?php */?>
<table class="table">
<thead>
    <tr>
        <td width="95%"><strong>Modules</strong></td><td><input type="checkbox"  id='staff_check' title="Select All"></td>
    </tr>
</thead>    
	
    <tr>
        <td>Add Student</td><td><input type="checkbox" <?=($staff_info[0]['add_student']==1)?'checked':''?> class="staff_check" name='staff_master[add_student]'></td>
    </tr>
    <tr>
        <td>Event</td><td><input type="checkbox" <?=($staff_info[0]['event']==1)?'checked':''?> class="staff_check" name='staff_master[event]'></td>
    </tr>
    <tr>
        <td>Time Table</td><td><input type="checkbox" <?=($staff_info[0]['time_table']==1)?'checked':''?> class="staff_check" name='staff_master[time_table]'></td>
    </tr>
    <tr>
        <td>Internal Mark</td><td><input type="checkbox" <?=($staff_info[0]['internal_mark']==1)?'checked':''?> class="staff_check" name='staff_master[internal_mark]'></td>
    </tr>
    <tr>
        <td>Assignment</td><td><input type="checkbox" <?=($staff_info[0]['assignment']==1)?'checked':''?> class="staff_check" name='staff_master[assignment]'></td>
    </tr>
    <tr>
        <td>Attendance</td><td><input type="checkbox" <?=($staff_info[0]['attendance']==1)?'checked':''?> class="staff_check" name='staff_master[attendance]'></td>
    </tr>
    <tr>
        <td>Sharing Note</td><td><input type="checkbox" <?=($staff_info[0]['sharing_note']==1)?'checked':''?> class="staff_check" name='staff_master[sharing_note]'></td>
    </tr>
    <tr>
        <td>Fee Details</td><td><input type="checkbox"  <?=($staff_info[0]['fee_details']==1)?'checked':''?> class="staff_check" name='staff_master[fee_details]'></td>
    </tr>
    <tr>
        <td>Library</td><td><input type="checkbox" <?=($staff_info[0]['library']==1)?'checked':''?> class="staff_check" name='staff_master[library]'></td>
    </tr>
    <tr>
        <td>Transport</td><td><input type="checkbox" <?=($staff_info[0]['transport']==1)?'checked':''?> class="staff_check" name='staff_master[transport]'></td>
    </tr>
    <tr>
        <td>Chat</td><td><input type="checkbox" <?=($staff_info[0]['chat']==1)?'checked':''?> class="staff_check" name='staff_master[chat]'></td>
    </tr>
     <tr>
        <td>Add Subject</td><td><input type="checkbox" <?=($staff_info[0]['subject']==1)?'checked':''?> class="staff_check" name='staff_master[subject]'></td>
    </tr>
</table>
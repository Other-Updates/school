<h4>View Syllabus</h4>
<div id="g_div" class='std_class'>
   <div class='std_class' id="g_div">
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
        </tr>
    </thead>
    <tbody>
	<?php 
			
        if(isset($all_syllabus_one) && !empty($all_syllabus_one)){
			$i=0;
            foreach($all_syllabus_one as $val)
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
                                  <?php 
                    }
                }
            ?>

</td></tr>
    </tbody>
</table>

                      
</div>
  
  <input type="button" value="Back" class="btn btn-danger left" onClick="history.go(-1);return true;" >  
                        
   

</div>
     <!--POPUP VIEW PERPOSE-->
     
<table class="staff_table" width="300">
  <thead>
    <tr>
        <th>Date</th>
        <th>Previous Amount</th>
    </tr>
<?php 
	if(isset($transport_year) && !empty($transport_year))
	{
		foreach($transport_year as $val)
		{ 
			?>
               </thead> 
                    <tr>
                        <td><?=$val['date_from'].'To'.$val['date_to']?></td>
                        <td><?=$val['total']?></td>
                    </tr>
            
<?php
		}
	}
?>
 </table>
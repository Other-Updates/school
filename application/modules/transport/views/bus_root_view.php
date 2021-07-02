<script type="text/javascript">
//$(document).ready(function(){ $("#batch").focus(); });
            $(function() {
                $("#example1").dataTable();
				$("#example4").dataTable();
				$("#example ").dataTable();
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
			
			function removeSpaces(string) {
 			return string.split(' ').join('');
			}
        </script>
        
        <div>
<div id="g_div">
<table width=" 100%" class="all my_table_style list_all table table-bordered table-striped " id="example3"><thead>
<tr><th>S.No</th>
	<th>Bus No</th>
    <th>Route Name</th>
    <th>Source</th>
    <th>Bus Fees</th>
    <th>Action</th>
</tr>
</thead>
      <tbody>
          <?php $i=1;
	 if(isset($master_details) && !empty($master_details))
	 {
     	foreach($master_details as $val)
        {
			?>
       		<!--<input type="hidden" id="fee_id" class="upd_id value<?=$i?>"  />-->
        <tr><td width="10%"><?=$i;?></td><td width="10%"><label><?=$val['bus_no'] ?><label></td>
        <td width="10%"><label><?=$val['root_name'] ?></label></td>
        <td width="10%"><label><?=$val['source'] ?></label></td>
        <td width="10%"><label><?=$val['bus_fees'] ?><label></td>
        <td width="10%"> 
<a href="<?=$this->config->item('base_url').'transport/view_transport/'.$val['master_root_id']?>" title="View" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
<a href="<?=$this->config->item('base_url').'transport/update_transport_stage/'.$val['master_root_id']?>" title="Edit" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
           
           </td>
       </tr>
   
    <?php  $i++;
		}
	 }?>
     </tbody>
  </table>    
</div>

<div id="list">
 
</div>

<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
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
<div id="list_all" class="list_all">
<table width="100%" id="example3"  class="all my_table_style list_all table table-bordered table-striped"><thead>
<tr><th>S.No</th><th>Fees Type</th><th>Status</th> <th>Action</th></tr>
</thead>
      <tbody>
          <?php $i=1;
	 if(isset($fee_name) && !empty($fee_name))
	 {
     	foreach($fee_name as $val)
		 
        {
			?>
       		<!--<input type="hidden" id="fee_id" class="upd_id value<?=$i ?>"  />-->
        <tr><td width="5%"><?=$i;?></td><td width="10%"><input type="text" value="<?=$val['fees_name'] ?>" disabled="disabled" class="fees_name<?=$i?> mandatory updatefee" id="ffees"/><span id="feeedit" class="feeedit" style="color:#F00;"></span></td>
        	<td  width="10% "> <select name="status" id="status" disabled="disabled" class="status<?=$i?>">
    				<option <?=($val['status']==1)?'selected':'';?> value="1">Active</option>
        			<option <?=($val['status']==0)?'selected':'';?> value="0">In-Active</option>
    			 </select>
           </td>
           <td width="10%"> 
<input type="button" name="Edit" id='update' data-toggle="modal" value='Edit' title="Edit"  class="btn bg-navy btn-sm success_<?=$i?> "  />
           <input type="button" name="Edit" id='add_update' title="Edit" value='Update' class="btn btn-success up_<?=$i?> "  style="display:none" > 
            </td>
       </tr>
   
    <?php  $i++;
	
		}
	 }?>
   
     </tbody>
  </table>    
</div>


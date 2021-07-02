<br />
<?php  
	$theme_path = $this->config->item('theme_locations').$this->config->item('active_template');
	if(isset($post_data) && !empty($post_data))
	{
		?>
        <table class="table table-bordered">
        <thead>
        <tr style="background:#058DCE; color:#fff;"><th width="7%">Columns</th><th>Select Department</th></tr>
        </thead>
        <?php
		for($i=1;$i<=$post_data['ucols'];$i++)
		{
			?>
            <tr>
            	<th style="background:#058DCE; color:#fff;">Column-<?=$i?></th>
                <td>
                	<table style="width:30%;float: left">
                    		  <tr>
                              	<td>Batch</td><td>Department</td><td>Section</td>
                              </tr>
                              <tr>
                                
                                <td>
                               <select id='select_batch' class='ajax_class' name="cols[<?=$i?>][0][batch_id]" style="width:103px;">
                                    <option value="">Select</option>
                                    <?php 
                                        if(isset($all_batch) && !empty($all_batch)){
                                            
                                            foreach($all_batch as $val1)
                                            {
                                                ?>
                                                    <option value="<?=$val1['id']?>"><?php echo $val1['from'].'-'.$val1['to']?></option>
                                                <?php 
                                            }
                                        }
                                    ?>
                                </select>
                                </td>
                               
                                
                                <td id='td_depart'>
                                   <select id='depart_id'  name="cols[<?=$i?>][0][depart_id]"  style="width:100px;">
                                            <option value="">Select</option>
                                   </select>
                              </td>
                              
                              <td id='g_td'>
                                    <select id='group_id'  name="cols[<?=$i?>][0][group_id]"  style="width:80px;">
                                            <option value="">Select</option>
                                    </select>
                                </td>
                                <td>
                                	<input type="text"  class="form-control total_seat seat_cls_<?=$i?> req test1"  name="cols[<?=$i?>][0][set_seat]"  style="width:40px;" />
                                    <input type="hidden" class="cols_no"  name="cols[<?=$i?>][0][cols_no]"   value="<?=$i?>" />
                                    <input type="hidden" class="cols_count" value="0" />
                                </td>
                                <td>
                                	<input type="text" class="form-control total_std req test2"  name="cols[<?=$i?>][0][total_std]" readonly="readonly" style="width:40px;"  />
                                </td>
                                <td>
                                	<input type="button" class="btn btn-success add_row"  id="0" style="height: 30px" value="+" title="Select other deprtment student in this column" />
                                </td>
                              </tr>  
                    </table>
                    <div class="sub_cols">
                    </div>
                </td>
            </tr>
            <?php
		}
		?>
        </table>
        <?php
	}
?>
<br />
<div class="right"><input type="submit" class='btn btn-primary' id='create_seat1'  /></div>
<br /><br />
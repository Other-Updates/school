<?php 
if(isset($date_list) && !empty($date_list)){ ?>	
    <select name="date_vl" id="date_vl" disabled="disabled">
        <option value="0">Select</option>
        <?php foreach($date_list as $vls){
			$re_arr  = explode(",",$vls);
			$date = $re_arr [0];
			 ?>	
        <option value="<?=$vls?>"><?php echo date('d-m-Y',strtotime($date));?></option>
    <?php } ?>
    </select>
<?php }else{ echo "Oops! No Absent Date Found"; } ?>
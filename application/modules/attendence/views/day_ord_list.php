<select name="day_ord" id="day_ord" disabled="disabled" >
    <option value="0">Select</option>
    <?php $i=1; while($tot_dys[0]['details'] >= $i ){  ?>	
    <option <?php if($day_or_no==$i){ ?> selected="selected" <?php }?> value="<?=$i?>">Day Order <?=$i?></option>
    <?php $i++; } ?>
</select>
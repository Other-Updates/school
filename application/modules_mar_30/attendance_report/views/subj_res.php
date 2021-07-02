<?php if(isset($subj_list) && !empty($subj_list)){ ?>	
	<select name="subj_id" id="subj_id" disabled="disabled">
        <option value="0">Select</option>
        <option value="all">All</option>
        <?php foreach($subj_list as $vls){ ?>	
        <option value="<?=$vls['id']?>"><?=$vls['subject_name']?></option>
	<?php } ?>
	</select>
<?php }else{ echo "Oops! Please Add Subjects"; } ?>
<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<table style="display:none">
    <thead>
    	<tr>
        <th>Question</th><th colspan="4">Choice</th><th>Answer</th><th><input type="button" value="+" class='add_row btn bg-purple btn-sm' /></th>
        </tr>
    </thead>
    <tbody>
    <tr id="last_row">
    	<td>
    <textarea name="multi_ques[]" cols="10" class="mandatory" style="height:40px;" ></textarea></td>
    <td colspan="4">
    <textarea name="m_choice[]" class="test" cols="10"  style="height:40px;" ></textarea>
    <textarea name="m_choice[]" class="test" cols="10"  style="height:40px;" ></textarea>
    <textarea name="m_choice[]" class="test" cols="10"  style="height:40px;" ></textarea>
    <textarea name="m_choice[]" class="test" cols="10"  style="height:40px;" ></textarea>
    </td>
    <td colspan="4">
    <label><input type="radio" name="m_ans[]" value="0" />Choice 1</label>
    <br/><br/>
    <label><input type="radio" name="m_ans[]" value="1" />Choice 2</label>
    <br/><br/>
    <label><input type="radio" name="m_ans[]" value="2" />Choice 3</label>
    <br/><br/>
    <label><input type="radio" name="m_ans[]" value="3" />Choice 4</label>
    
    </td>
    <td><input type="button" value="-" class='remove_comments btn bg-purple btn-sm'/></td>
    
    </tr>
    </tbody>
    </table>
<form name="quest" action="" method="post" enctype="multipart/form-data" onSubmit="return reportValue(this)" >
<table class="staff_table" border="0">
  <tr>
    <td width="117">Batch<input type="hidden" value="<?=$qus_list[0]['id']?>" name="question_id"> </td>
    <td width="124">
    <?php 
	if(isset($all_batch) && !empty($all_batch)){ ?>	
    <select name="batch_id" id="batch_id" class="mandatory">
    <?php foreach($all_batch as $vls){ ?>	
    <option <?=($vls['id']==$qus_list[0]['batch_id'])?'selected':''?> value="<?=$vls['id']?>"><?=$vls['from']?> - <?=$vls['to']?></option>
    <?php } ?>
    </select><span id="place1" class="val" style="color:#F00;"></span>
   
    <?php } ?>
    </td>
    <td width="88"> Department</td>
    <td width="164">&nbsp;
    <?php 
	if(isset($all_depart) && !empty($all_depart)){
		 
	$this->db->select('*');	
	$this->db->where('plac_ques_id',$qus_list[0]['id']);		
	$this->db->where('status','1');	
	$query_dep = $this->db->get('placement_qus_dept')->result_array();?>	
    <select multiple="multiple" name="dept_id[]" id="dept_id" class="mandatory">
    <?php foreach($all_depart as $vls){ 
	$ds=0;
	foreach($query_dep as $dep_id)
	{
		
		if($vls['id']==$dep_id['depart_id'])
		{
			$ds=1;
		}
		
	}
	
	?>	
    <option <?=($ds>0)?'selected':''?>  value="<?=$vls['id']?>"><?=$vls['department']?></option>
    <?php }?>
    </select><span id="place7" class="val" style="color:#F00;"></span>
    <?php } ?>
    </td>
  </tr>
  <tr>
    <td>Enter the Question</td>
    <td colspan="2"><textarea name="quest" id="quest" cols="10" class="mandatory"  style="height:100px;"  ><?=$qus_list[0]['question_s']?></textarea><span id="place2" class="val" style="color:#F00;"></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Question Image</td>
    <td colspan="2">
    <input type="file" name="ques_img" id="ques_img" /></td>
    <td>Choose Answer</td>
  </tr>
  </table>
 <div id="multi_ques">
 	<table id='app_table'>
    <thead>
    	<tr>
        <th>Question</th><th colspan="4">Choice</th><th>Answer</th><th><input type="button" value="+" class='add_row btn bg-purple btn-sm' /></th>
        </tr>
    </thead>
    <tbody>
    <tr>
    	<td>
        <input type="hidden" id="gizli" name="gizli" value="1" />
    <textarea name="multi_ques[]" cols="10" class="mandatory" style="height:40px;" ></textarea></td>
    <td colspan="4">
    <textarea name="m_choice[0][]"  cols="10"  style="height:40px;" ></textarea>
    <textarea name="m_choice[0][]"  cols="10"  style="height:40px;" ></textarea>
    <textarea name="m_choice[0][]"  cols="10"  style="height:40px;" ></textarea>
    <textarea name="m_choice[0][]"  cols="10"  style="height:40px;" ></textarea>
    </td>
    <td colspan="4">
    <label><input type="radio" name="m_ans[0]" value="0" />Choice 1</label>
    <br/><br/>
    <label><input type="radio" name="m_ans[0]" value="1" />Choice 2</label>
    <br/><br/>
    <label><input type="radio" name="m_ans[0]" value="2" />Choice 3</label>
    <br/><br/>
    <label><input type="radio" name="m_ans[0]" value="3" />Choice 4</label>
    
    </td>
    
    
    </tr>
    <tr>
    <td><input type="hidden" id="selectedRadioButton" /></td>
        </tr>
    </tbody>
    </table>
 </div>
 <table>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input name="submit" type="submit" value="Update" class="btn btn-primary"/> <input name="cancel" type="reset" value="Cancel" id="cancel" class="btn btn-danger"/>   <input type="button" value="Back" class="btn btn-danger" onClick="history.go(-1);return true;"></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<script type="text/javascript">
$(document).ready(function()
{
$('.add_row').click(function(){
		//$('#last_row').clone().appendTo('#app_table');	
		var i=4;  
		$('.dy_no').each(function(){
			$(this).html(i);
			i++;	
		});
		//
		var aydi = $('input#gizli').val();
    	$table = $('#last_row').clone().attr('id', '#table' + aydi).appendTo("#app_table");
    	$("input[type='radio']", $table).prop("name", "m_ans[" + aydi +"]");
		$(".test", $table).prop("name", "m_choice[" + aydi +"][]");
    	aydi++;
    	$('input#gizli').val(aydi);
	//
	 });
	$(".remove_comments").live('click',function(){
		$(this).closest("tr").remove();
		var i=4;  
		$('.dy_no').each(function(){
			$(this).html(i);
			i++;	
		});	
   });
});
</script>
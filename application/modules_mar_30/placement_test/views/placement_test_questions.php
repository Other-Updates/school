<?php
	$theme_path = $this->config->item('theme_locations').$this->config->item('active_template');
	$cur_date =  $this->user_auth->get_curdate();
		
	$cur_dat_al = date ('Y-m-d',strtotime($cur_date) ); 
	$get_whe = array('typ_e'=>'sem_strt_date','statu_s'=>'1');			
	$sem_strt_dt = $this->db->get_where('mas_college_det',$get_whe)->result_array();	
	$sem_str_dat = date ('Y-m-d',strtotime($sem_strt_dt[0]['details']));
	
	$date1=date_create($sem_str_dat);
	$date2=date_create($cur_dat_al);
	$diff=date_diff($date1,$date2);
	
	$tot_pre_days = $diff->format("%a");
?>


<?php /*?><script type="text/javascript" src="<?=$theme_path; ?>/js/auto_com/jquery.js"></script><?php */?>
<script type='text/javascript' src='<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?=$theme_path; ?>/js/auto_com/jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	//$("#batch_id").focus();
	
	$("#rol_no").autocomplete("attendance_od_ml/get_sutent_list", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});
/*$('#course').live('blur',function(){
	alert($(this).val());
});*/
</script>
<script>
$("#cancel").live("click",function()
			   {
				   $('.val').html('');
				   $('.mandatory').css('border','1px solid #CCCCCC');
				   $('.mandatory').val('');
				 
				   //$('.erro').html();
				   
			   })
</script>

<script type="text/javascript">

$("#batch_id").live('blur',function()
{
	var batch_id=$("#batch_id").val();
	
	if(batch_id=="0")
	{
		$("#place1").html("Select Batch");
	}
	else
	{
		$("#place1").html("");
	}
});
$("#quest").live('blur',function()
{
	var quest=$("#quest").val();
	var filter=/\w+.*$/;
	if(quest=="")
	{
		$("#place2").html("Enter Question");
	}
	else if(!filter.test(quest))
	{
		$("#place2").html("Enter Valid Question");
	}
	else
	{
		$("#place2").html("");
	}
});
$("#choice_1").live('blur',function()
{
	var choice_1=$("#choice_1").val();
	var filter=/\w+.*$/;
	if(choice_1=="")
	{
		$("#place3").html("Enter Answer");
	}
	else if(!filter.test(choice_1))
	{
		$("#place3").html("Enter Valid Answer");
	}
	else
	{
		$("#place3").html("");
	}
});
$("#choice_2").live('blur',function()
{
	var choice_2=$("#choice_2").val();
	var filter=/\w+.*$/;
	if(choice_2=="")
	{
		$("#place4").html("Enter Answer");
	}
	else if(!filter.test(choice_2))
	{
		$("#place4").html("Enter Valid Answer");
	}
	else
	{
		$("#place4").html("");
	}
});
$("#choice_3").live('blur',function()
{
	var choice_3=$("#choice_3").val();
	var filter=/\w+.*$/;
	if(choice_3=="")
	{
		$("#place5").html("Enter Answer");
	}
	else if(!filter.test(choice_3))
	{
		$("#place5").html("Enter Valid Answer");
	}
	else
	{
		$("#place5").html("");
	}
});
$("#choice_4").live('blur',function()
{
	var choice_4=$("#choice_4").val();
	var filter=/\w+.*$/;
	if(choice_4=="")
	{
		$("#place6").html("Enter Answer");
	}
	else if(!filter.test(choice_4))
	{
		$("#place6").html("Enter Valid Answer");
	}
	else
	{
		$("#place6").html("");
	}
});
</script>
<script type="text/javascript">
$("#q_type").live('change',function()
{
	var q_type=$(this).val();
	if(q_type==1)
	{
		$('#options').show();
		$("#hide_puzzle").show();
		$("#multi_ques").hide();
		$("#puzzle").hide();
	}
	else if(q_type==2)
	{
		$('#options').hide();
		$("#multi_ques").hide();
		$("#hide_puzzle").hide();
		$("#puzzle").show();
	}
	else if(q_type==3)
	{
		$('#options').hide();
		$("#multi_ques").show();
		$("#hide_puzzle").hide();
		$("#puzzle").hide();
	}
	else
	{
		$('#options').hide();
		$("#multi_ques").hide();
		$("#puzzle").hide();
		$("#hide_puzzle").hide();
	}
});
</script>

<?php if(isset($test_data) && empty($test_data)) { ?>

<script type="text/javascript">
$().ready(function() {
	
	$('#options').hide();
	$("#multi_ques").hide();
	$("#puzzle").hide();
	$("#hide_puzzle").hide();
	
});
</script>

<?php } ?>



<table style="display:none">
    <thead>
    	<tr>
        <th colspan="4">Question</th><th colspan="4">Choice</th><th>Answer</th><th><input type="button" value="+" class='add_row btn bg-purple btn-sm' /></th>
        </tr>
    </thead>
    <tbody>
    <tr id="last_row">
    	<td colspan="4">
    <textarea name="multi_ques[]" cols="10" class="mandatory" style="height:100px;" ></textarea></td>
    <td colspan="4">
    <textarea name="m_choice[]" class="test" cols="10"  style="height:40px;" ></textarea>
    <textarea name="m_choice[]" class="test" cols="10"  style="height:40px;" ></textarea>
    <textarea name="m_choice[]" class="test" cols="10"  style="height:40px;" ></textarea>
    <textarea name="m_choice[]" class="test" cols="10"  style="height:40px;" ></textarea>
    </td>
    <td colspan="4">
    <label><input type="radio" name="m_ans[]" value="0" />Choice 1</label>
    <br/><br />
    <label><input type="radio" name="m_ans[]" value="1" />Choice 2</label>
    <br/><br />
    <label><input type="radio" name="m_ans[]" value="2" />Choice 3</label>
    <br/><br />
    <label><input type="radio" name="m_ans[]" value="3" />Choice 4</label>
    
    </td>
    <td><input type="button" value="-" class='remove_comments btn bg-purple btn-sm'/></td>
    
    </tr>
    
    </tbody>
    </table>
<form name="quest" action="placement_test/inse_ques" method="post" enctype="multipart/form-data" onSubmit="return reportValue(this)" >
<table class="staff_table" border="0">
  <tr>
    <td width="117">Batch</td>
    <td width="124">
    <?php 
	if(isset($all_batch) && !empty($all_batch)){ ?>	
    <select name="batch_id" id="batch_id" class="mandatory">
    <option value="0">Select</option>
    <?php foreach($all_batch as $vls){ ?>	
    <option <?php if(isset($test_data) && !empty($test_data)) { if($test_data['batch']==$vls['id']) { echo 'selected'; }}?> value="<?=$vls['id']?>"><?=$vls['from']?> - <?=$vls['to']?></option>
    <?php } ?>
    </select><span id="place1" class="val" style="color:#F00;"></span>
   
    <?php }else{ echo "Oops! Please Add Batches"; } ?>
    </td>
    <td width="88" rowspan="3"> Department</td>
    <td width="164" rowspan="3">
    <?php 
	if(isset($all_depart) && !empty($all_depart)){ 
	?>	
    <select multiple="multiple" name="dept_id[]" id="dept_id" class="mandatory" style="width:400px; height:120px;">
    <?php foreach($all_depart as $vls){
		$dp1=0;
						foreach($test_dep as $dep_id1)
						{
							
							if($vls['id']==$dep_id1['depart_id'])
							{
								$dp1=1;
							}
							
						}
	?>	
    <option <?=($dp1>0)?'selected':''?> value="<?=$vls['id']?>"><?=$vls['department']?></option>
    <?php } ?>
    </select><span id="place7" class="val" style="color:#F00;"></span>
    <?php }else{ echo "Oops! Please Add Departments"; } ?>
    </td>
  </tr>
   <tr>
  <td>Question Type</td>
  		<td><select name="q_type" id="q_type">
        	<option value="">Select</option>
            <option <?php if(isset($test_data) && !empty($test_data)) { if($test_data['q_type']==1) { echo 'selected'; }}?> value="1">Multi Choice</option>
            <option <?php if(isset($test_data) && !empty($test_data)) { if($test_data['q_type']==2) { echo 'selected'; }}?> value="2">Puzzle</option>
            <option <?php if(isset($test_data) && !empty($test_data)) { if($test_data['q_type']==3) { echo 'selected'; }}?> value="3">Sub Questions</option>
        </select></td>
    </tr>
   <tr>
    <td>Question Image</td>
    <td>
      <input type="file" name="ques_img" id="ques_img" /></td>
    </tr>
  <tr>
    <td>Enter the Question</td>
    <td colspan="3"><textarea name="quest" id="quest" cols="10" class="mandatory"  style="height:50px;"  ></textarea><span id="place2" class="val" style="color:#F00;"></span></td>
    </tr>
 
  <tr>
    <td></td>
    
    <td colspan="2">
    </td>
   
  </tr>
  </table>
  <div id="options" style="display:<?php if(isset($test_data) && !empty($test_data)) { if($test_data['q_type']==1) { echo 'block'; } else { echo 'none';}} else { echo 'block'; }?>">
  <table border="0">
  <tr>
  	<td> </td> <td colspan="2"></td><td id="hide_puzzle" >Choose Answer</td>
  </tr>
  <tr>
    <td width="144">1</td>
    <td colspan="2">
    <textarea name="choice_1" id="choice_1" cols="10" class="mandatory" style="height:40px;" ></textarea><span id="place3" class="val" style="color:#F00;"></span></td>
    <td>
      <label><input type="radio" name="answ" value="0" id="answ_0" checked="checked" />Choice 1</label>
    </td>
  </tr>
  <tr>
    <td>2</td>
    <td colspan="2">
    <textarea name="choice_2" id="choice_2" cols="10" class="mandatory" style="height:40px;" ></textarea><span id="place4" class="val" style="color:#F00;"></span></td>
    <td><label><input type="radio" name="answ" value="1" id="answ_1" />Choice 2</label></td>
  </tr>
  <tr>
    <td>3</td>
    <td colspan="2">
    <textarea name="choice_3" id="choice_3" cols="10" class="mandatory" style="height:40px;"></textarea> <span id="place5" class="val" style="color:#F00;"></span></td>
    <td><label><input type="radio" name="answ" value="2" id="answ_2" />Choice 3</label></td>
  </tr>
  <tr>
    <td>4</td>
    <td colspan="2">
    <textarea name="choice_4" id="choice_4" cols="10" class="mandatory" style="height:40px;" ></textarea><span id="place6" class="val" style="color:#F00;"></span> </td>
    <td><label><input type="radio" name="answ" value="3" id="answ_3" />Choice 4</label></td>
  </tr>
 </table>
 </div>
 <div id="puzzle" style="display:<?php if(isset($test_data) && !empty($test_data)) { if($test_data['q_type']==2) { echo 'block'; } else { echo 'none';}}?>"">
 	<table>
    	<tr>
        	<td width="144">Enter Your Answer</td>
    <td><textarea name="answer_puzzle" id="answer_puzzle" cols="10" class="mandatory"  style="height:100px;"  ></textarea></td>
    <td>&nbsp;</td>
        </tr>
    </table>
 </div>
 <div id="multi_ques" style="display:<?php if(isset($test_data) && !empty($test_data)) { if($test_data['q_type']==3) { echo 'block'; } else { echo 'none';}}?>">
 	<table id='app_table'>
    <thead>
    	<tr>
        <td colspan="4">Question</td><td colspan="4">Choice</td><td colspan="4">Answer</td><td><input type="button" value="+" class='add_row btn bg-purple btn-sm' /></td>
        </tr>
    </thead>
    <tbody>
    <tr>
    	<td colspan="4">
        <input type="hidden" id="gizli" name="gizli" value="1" />
    <textarea name="multi_ques[]" cols="10" class="mandatory" style="height:160px;" ></textarea></td>
    <td colspan="4">
    <textarea name="m_choice[0][]"  cols="10"  style="height:40px; width:" class="mandatory" ></textarea>
    <textarea name="m_choice[0][]"  cols="10"  style="height:40px;" class="mandatory" ></textarea>
    <textarea name="m_choice[0][]"  cols="10"  style="height:40px;" class="mandatory" ></textarea>
    <textarea name="m_choice[0][]"  cols="10"  style="height:40px;" class="mandatory" ></textarea>
    </td>
    <td colspan="4">
    <label><input type="radio" name="m_ans[0]" checked="checked" value="0" />Choice 1</label>
    <br/><br />
    <label><input type="radio" name="m_ans[0]" value="1" />Choice 2</label>
   	<br/><br />
    <label><input type="radio" name="m_ans[0]" value="2" />Choice 3</label>
    <br/><br />
    <label><input type="radio" name="m_ans[0]" value="3" />Choice 4</label>
    
    </td>
    <td></td>
    
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td><input type="hidden" id="selectedRadioButton" /></td>
        </tr>
    </tbody>
    </table>
    
 </div>
 <br/>
 <table>
  <tr>
    <td width="144">&nbsp;</td>
    <td><input name="submit" type="submit" value="Submit" class="btn btn-primary"/> <input name="cancel" type="reset" value="Cancel" id="cancel" class="btn btn-danger"/></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<br />
<!--<h3>Multi Choice Questions</h3>-->
<table class="table table-bordered table-striped dataTable">
<thead>
  <tr>
    <th width="8%">S.no</th>
    <th width="11%">Batch</th>
    <th width="10%">Department</th>
    <th width="22%">Question</th>
    <th width="11%">Image</th>
    <th width="15%">Answers</th>
    
    <th width="12%">Action</th>
  </tr>
</thead>
  <?php
  //echo "<pre>"; print_r($qus_list); exit;
  if(isset($qus_list) && !empty($qus_list))
  {
  
  $i =1;
  foreach($qus_list as $st_lit)
  {
	  if($st_lit['question_type']==1)
  {
	$this->db->select('*');	
	$this->db->where('plac_ques_id',$st_lit['id']);	
	
	$this->db->where('status','1');		
	$query = $this->db->get('answer_choice')->result_array();
		
	$this->db->select('*');	
	$this->db->where('id',$st_lit['batch_id']);		
	$this->db->where('status','1');		
	$query_b = $this->db->get('batch')->result_array();
	
	$this->db->select('*');	
	$this->db->where('plac_ques_id',$st_lit['id']);		
	$this->db->where('status','1');	
	$query_dep = $this->db->get('placement_qus_dept')->result_array();
	$this->db->last_query();	
	//echo "<pre>"; print_r($query_dep);
	
	$dept_mnt = '';
	foreach($query_dep as $vls)
	{
		$this->db->select('*');	
		$this->db->where('id',$vls['depart_id']);		
		$this->db->where('status','1');		
		$query_de = $this->db->get('department')->result_array();
		$dept_mnt = $dept_mnt.$query_de[0]['department'].",";		
	}
		
  ?>

  <tr>
    <td><?=$i?></td>
    <td><?=$query_b[0]['from']?>-<?=$query_b[0]['to']?></td>
    <td><?php echo rtrim($dept_mnt,",");?></td>
    <td><?=$st_lit['question_s'];?></td>
    <td align="center">
    <?php if($st_lit['ques_img_name']!='no_image'){?>
    <img class="staff_thumbnail" src="<?php echo $this->config->item('base_url');?>/quest_img/thumb/<?=$st_lit['ques_img_name'];?>"/>
    <?php }?>
    
    </td>
    <td>
    <table width="100%" border="0">      
    <?php
	$j=1;
	foreach($query as $ans_cho)
	{
		if($ans_cho['option_val'] == $st_lit['answe_r']){ $bg_clr = 'bgcolor="green" style="color:#fff;font-weight: bold;"'; }else{ $bg_clr = ''; }
		
	  ?>
      <tr <?=$bg_clr ?> >
        <td width="20"><?=$j?></td>
        <td><?=$ans_cho['choice']?></td>
      </tr>      
    <?php
	$j++;
	}
	 ?> 
    </table>
    </td>
    
    <td>
    <a href="#test_<?php echo $st_lit["id"]; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm" title="View">
    <i class="fa fa-eye"></i></a>
    <a href="#test1_<?php echo $st_lit['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
    <a href="#delete_<?=$st_lit['id']?>" data-toggle="modal" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-times"></i></a>
    </td>
  </tr>
  
  
  <?php
  $i++;
  }
  }}else
  {?>
  <tr>
    <td colspan="9" align="center">Sorry...! No Data Found...</td>
  </tr>
  <?php } ?>
</table>
<br />
<h3>Puzzle</h3>
<table class="table table-bordered table-striped dataTable">
<thead>
  <tr>
    <th width="8%">S.no</th>
    <th width="11%">Batch</th>
    <th width="10%">Department</th>
    <th width="22%">Question</th>
    <th width="11%">Image</th>
    <th width="15%">Answer</th>
    
    <th width="12%">Action</th>
  </tr>
</thead>
  <?php
  if(isset($qus_list) && !empty($qus_list))
  {
	  
  $i =1;
  foreach($qus_list as $st_lit)
  {
	  if($st_lit['question_type']==2)
  {
	$this->db->select('*');	
	$this->db->where('plac_ques_id',$st_lit['id']);		
	$this->db->where('status','1');		
	$query = $this->db->get('answer_choice')->result_array();
		
	$this->db->select('*');	
	$this->db->where('id',$st_lit['batch_id']);		
	$this->db->where('status','1');		
	$query_b = $this->db->get('batch')->result_array();
	
	$this->db->select('*');	
	$this->db->where('plac_ques_id',$st_lit['id']);		
	$this->db->where('status','1');	
	$query_dep = $this->db->get('placement_qus_dept')->result_array();
	$this->db->last_query();	
	//echo "<pre>"; print_r($query_dep);
	
	$dept_mnt = '';
	foreach($query_dep as $vls)
	{
		$this->db->select('*');	
		$this->db->where('id',$vls['depart_id']);		
		$this->db->where('status','1');		
		$query_de = $this->db->get('department')->result_array();
		$dept_mnt = $dept_mnt.$query_de[0]['department'].",";		
	}
		
  ?>

  <tr>
    <td><?=$i?></td>
    <td><?=$query_b[0]['from']?>-<?=$query_b[0]['to']?></td>
    <td><?php echo rtrim($dept_mnt,",");?></td>
    <td><?=$st_lit['question_s'];?></td>
    <td align="center">
    <?php if($st_lit['ques_img_name']!='no_image'){?>
    <img class="staff_thumbnail" src="<?php echo $this->config->item('base_url');?>/quest_img/thumb/<?=$st_lit['ques_img_name'];?>"/>
    <?php }?>
    
    </td>
    <td>
    <?=$st_lit['answe_r']?>
    </td>
    
    <td>
    <a href="#viewp_<?php echo $st_lit["id"]; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm" title="View">
    <i class="fa fa-eye"></i></a>
    <a href="#editp_<?php echo $st_lit['id']; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
    <a href="#deletep_<?=$st_lit['id']?>" data-toggle="modal" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-times"></i></a>
    </td>
  </tr>
  
  
  <?php
  $i++;
  }
  }}else{
  ?>
  <tr>
    <td colspan="9" align="center">Sorry...! No Data Found...</td>
  </tr>
  <?php } ?>
</table>
<br />
<h3>Sub Questions</h3>
<table class="table table-bordered table-striped dataTable">
<thead>
  <tr>
    <th>S.no</th>
    <th>Batch</th>
    <th>Department</th>
    <th>Main Questions</th>
    <th>Sub Questions</th>
    <th>Image</th>
    <th>Answers</th>    
    <th width="14%">Action</th>
  </tr>
</thead>
  <?php
  //echo "<pre>"; print_r($qus_list); exit;
  if(isset($qus_list) && !empty($qus_list))
  {
  
  $i =1;
  foreach($qus_list as $st_lit)
  {
	  if($st_lit['question_type']==3)
  {
	$this->db->select('*');	
	$this->db->where('place_quest_id',$st_lit['id']);	
	$this->db->where('status','0');		
	$query_m = $this->db->get('multi_choice_questions')->result_array();
	$j=0;
	foreach($query_m as $m_choice)
	{
		$this->db->select('*');	
		$this->db->where('multi_question_id',$m_choice['id']);		
		$this->db->where('status','0');		
		$query_choice[$j]['multi_choice'] = $this->db->get('multi_choice_answers')->result_array();
		$j++;
	}
	//echo "<pre>"; print_r($query_choice); exit;
	$this->db->select('*');	
	$this->db->where('id',$st_lit['batch_id']);		
	$this->db->where('status','1');		
	$query_b = $this->db->get('batch')->result_array();
	
	$this->db->select('*');	
	$this->db->where('plac_ques_id',$st_lit['id']);		
	$this->db->where('status','1');	
	$query_dep = $this->db->get('placement_qus_dept')->result_array();
	$this->db->last_query();	
	//echo "<pre>"; print_r($query_dep);
	
	$dept_mnt = '';
	foreach($query_dep as $vls)
	{
		$this->db->select('*');	
		$this->db->where('id',$vls['depart_id']);		
		$this->db->where('status','1');		
		$query_de = $this->db->get('department')->result_array();
		$dept_mnt = $dept_mnt.$query_de[0]['department'].",";		
	}
		
  ?>

  <tr>
    <td><?=$i?></td>
    <td><?=$query_b[0]['from']?>-<?=$query_b[0]['to']?></td>
    <td><?php echo rtrim($dept_mnt,",");?></td>
    <td><?=$st_lit['question_s'];?></td>
    <td>
	<table width="100%" border="0"><?php 
	$mq=0;
	foreach($query_m as $mques)
	{	
	$this->db->select('*');	
	$this->db->where('id',$mques['id']);	
	$this->db->where('status','0');		
	$query_mq[$mq]['mq']= $this->db->get('multi_choice_questions')->result_array();
	?>
    <tr><td height="100"><?php echo $query_mq[$mq]['mq'][0]['multi_question']; ?></td></tr>
    <?php 
	$mq++;
	}
	
	?>
    </table></td>
    <td align="center">
    <?php if($st_lit['ques_img_name']!='no_image'){?>
    <img class="staff_thumbnail" src="<?php echo $this->config->item('base_url');?>/quest_img/thumb/<?=$st_lit['ques_img_name'];?>"/>
    <?php }?>
    
    </td>
    <td>
    
    
    <?php 
	$mc=0;
	foreach($query_m as $mchoice)
	{	
	$c=count($query_m);
	$this->db->select('*');	
	$this->db->where('multi_question_id',$mchoice['id']);	
	$this->db->where('status','0');		
	$query_mc[$mc]['mc']= $this->db->get('multi_choice_answers')->result_array();
	//echo $query_mc[$mc]['mc'][0]['multi_choice']."<br/>";
	$d=count($query_mc[$mc]['mc']);
	$mc++;
	}
	for($cm=0;$cm<$c;$cm++)
	{
		$j=1;
		for($cm1=0;$cm1<$d;$cm1++)
		{
			$this->db->select('*');	
			$this->db->where('place_quest_id',$st_lit['id']);	
			$this->db->where('status','0');		
			$query_answer = $this->db->get('multi_choice_questions')->result_array();
			if($query_mc[$cm]['mc'][$cm1]['multi_options'] == $query_answer[$cm]['multi_answers']){ $bg_clr = 'bgcolor="green" style="color:#fff;font-weight: bold;"'; }else{ $bg_clr = ''; }
			?>
            <table width="100%" border="0">
			<tr <?=$bg_clr ?>>
            <td width="20"><?=$j?></td>
            <td><?php echo $query_mc[$cm]['mc'][$cm1]['multi_choice']; ?></td>
            </tr>
            </table>
            
            <?php 
			$j++;
		}
		echo "<br/>";
	}
 
	
	 ?>      
    
    
    
    </td>
    
    
    <td>
    <a href="#views_<?php echo $st_lit["id"]; ?>" data-toggle="modal" name="group" class="btn bg-maroon btn-sm" title="View">
    <i class="fa fa-eye"></i></a>
    <a href="<?=$this->config->item('base_url').'placement_test/update_sub_questions/'.$st_lit["id"]; ?>" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
    <a href="#deletes_<?=$st_lit['id']?>" data-toggle="modal" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-times"></i></a>
    </td>
  </tr>
  
  
  <?php
  $i++;
  }
  }}else
  {?>
  <tr>
    <td colspan="9" align="center">Sorry...! No Data Found...</td>
  </tr>
  <?php } ?>
</table>
<script type="text/javascript">
$(".delt").live("click",function()
	{
	for_loading_del('Loading... Data Removing wait...');
	var id=$(this).parent().parent().find('.id').val();
	
	$.ajax
	(
		{
			
		 url:BASE_URL+"placement_test/delete_options",
		 type:'POST',
		 data:{ value1:id},
		
		 success:function(result){ 
       
		 if(result)
		 {
			 for_response_del('Remove Successfully...!');
			 window.location.reload();
		 }
		}    
	});
$('.modal').css("display", "none");
$('.fade').css("display", "none");
});
$("#deltp").live("click",function()
	{
	for_loading_del('Loading... Data Removing wait...');
	var id=$(this).parent().parent().find('.idp').val();
	
	$.ajax
	(
		{
			
		 url:BASE_URL+"placement_test/delete_puzzle_question",
		 type:'POST',
		 data:{ id:id},
		
		 success:function(result){ 
        
		 if(result)
		 {
			 for_response_del('Remove Successfully...!');
			 window.location.reload();
		 }
		}    
	});
$('.modal').css("display", "none");
$('.fade').css("display", "none");
});
$("#delts").live("click",function()
	{
	for_loading_del('Loading... Data Removing wait...');
	var id=$(this).parent().parent().find('.idp').val();
	
	$.ajax
	(
		{
			
		 url:BASE_URL+"placement_test/delete_sub_question",
		 type:'POST',
		 data:{ id:id},
		
		 success:function(result){ 
        
		 if(result)
		 {
			 for_response_del('Remove Successfully...!');
			 window.location.reload();
		 }
		}    
	});
$('.modal').css("display", "none");
$('.fade').css("display", "none");
});
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
		var new_row='<tr><td><br/></td></tr>';
    	$table = $('#last_row').clone().attr('id', '#table' + aydi).appendTo("#app_table");
		$("#app_table").append("<tr><td><br/></td></tr>");
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
<!--Multi choice questions-->
<!--View--> 
<?php
  if(isset($qus_list) && !empty($qus_list))
  {
  $i =1;
  foreach($qus_list as $st_lit)
  {
	$this->db->select('*');	
	$this->db->where('plac_ques_id',$st_lit['id']);		
	$this->db->where('status','1');		
	$query = $this->db->get('answer_choice')->result_array();
	
	$this->db->select('*');	
	$this->db->where('id',$st_lit['batch_id']);		
	$this->db->where('status','1');		
	$query_b = $this->db->get('batch')->result_array();
		
  ?>
<div id="test_<?php echo $st_lit["id"]; ?>" class="modal fade in" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3 id="myModalLabel">View Question</h3>

    	</div>
        
  		<div class="modal-body">
            <table class="view_table">
              <tr>
                <td width="150">Batch</td>
                <td class="text_bold"><?=$query_b[0]['from']?>-<?=$query_b[0]['to']?></td>
              </tr>
              <tr>
                <td>Question</td>
                <td class="text_bold"><?=$st_lit['question_s'];?></td>
              </tr>
              
              <?php if($st_lit['ques_img_name']!='no_image'){ ?>
              <tr>
                <td>Question Image</td>
                <td class="text_bold">
                <img src="<?php echo $this->config->item('base_url');?>/quest_img/<?=$st_lit['ques_img_name'];?>" width="200" height="150"/>
                </td>
              </tr>
              <?php } ?>
			  <?php
				$j=1;
				foreach($query as $ans_cho)
				{
					if($ans_cho['option_val'] == $st_lit['answe_r']){ $bg_clr = 'bgcolor="green" style="color:#000;font-weight: bold;"'; }else{ $bg_clr = ''; }
					
				  ?>
              <tr <?=$bg_clr?>>
                <td>Choice <?=$j?></td>
                <td class="text_bold"><?=$ans_cho['choice']?></td>
              </tr>
              <?php
			$j++;
			}
			 ?> 
             
            </table>
  		</div>
  		<div class="modal-footer">   
   			<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
  		</div>
  	</div>
  </div>
</div>

<?php
  $i++;
  }
  }
  ?>   
<!--Edit Page-->
 <?php 
if(isset($qus_list) && !empty($qus_list))
  {
  foreach($qus_list as $st_lit)
  {
	 
 ?>   

<div id="test1_<?php echo $st_lit['id']; ?>" class="modal fade in" tabindex="-1" 
  role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  	<div class="modal-dialog">
  	<div class="modal-content">
    <div class="modal-header"><a class="close" data-dismiss="modal">×</a>   
    <h3 id="myModalLabel">Update Placement</h3>
    </div>
  	<div class="modal-body">
    <form name="update" action="placement_test/update_options" method="post" enctype="multipart/form-data" onsubmit="return validateform();">
    <input type="hidden" name="question_id" class="id form-control" id="id" value="<?php echo $st_lit["id"]; ?>" readonly="readonly" />
     	 <table width="100%" class="form_table">
                   <tr>
                <td width="150">Batch</td>
                <td>
                    <select id='batch_id' name='batch_id' >
                        <option value="">Select</option>
                        <?php 
                            if(isset($all_batch) && !empty($all_batch)){
                                
                                foreach($all_batch as $bil)
                                {
                                    ?>
                        <option <?=($bil['id']==$st_lit['batch_id'])?'selected':''?> value="<?=$bil['id']?>"><?php echo $bil['from'].'-'.$bil['to']?>
                        </option>
                                    <?php 
                                }
                            }
                        ?>
                    </select>
                    </td>
                    <td> Department </td>
                    <td>
                    	 <?php 
                    if(isset($all_depart) && !empty($all_depart)){ 
					$this->db->select('*');	
					$this->db->where('plac_ques_id',$st_lit["id"]);		
					$this->db->where('status','1');	
					$query_depo = $this->db->get('placement_qus_dept')->result_array();
					//echo "<pre>"; print_r($query_dep1);
					?>	
                    <select multiple="multiple" name="dept_ido[]" id="dept_id" style="width:100px">
                    <?php foreach($all_depart as $val){
						$ds1=0;
						foreach($query_depo as $dep_id1)
						{
							
							if($val['id']==$dep_id1['depart_id'])
							{
								$ds1=1;
							}
							
						}
						?>
						
                    <option <?=($ds1>0)?'selected':''?> value="<?=$val['id']?>"><?=($val['department'])?></option>
                    <?php } ?>
                    </select>
                    <?php } ?>
                    </td>
                </tr>  
                <tr>
              	 <td>Re-Enter The Question</td>
                <td colspan="3"><textarea name="quest" value="<?=($st_lit['question_s'])?'selected':''?>" style="width:100%" checked="checked" 
                class="mandatory" ><?=$st_lit['question_s']?></textarea></td>
              </tr>
              <tr>
                <td>Question Image</td>
              <td align="center">
 				<input type="file" name="ques_img" id="ques_img" />
            </td>   
    </tr>
            <tr>
            <td>Choice 1</td>
            <td colspan="2">
            <textarea name="choices[]" id="choice_1" cols="10" class="mandatory"></textarea></td>
            <td>
            <label><input type="radio" name="answ" value="0" /> &nbsp;Choice 1</label>
            </td>
            </tr>
             <tr>
            <td>Choice 2</td>
            <td colspan="2">
            <textarea name="choices[]" id="choice_2" cols="10" class="mandatory"></textarea></td>
            <td>
            <label><input type="radio" name="answ" value="1" /> &nbsp;Choice 2</label>
            </td>
            </tr>
             <tr>
            <td>Choice 3</td>
            <td colspan="2">
            <textarea name="choices[]" id="choice_3" cols="10" class="mandatory"></textarea></td>
            <td>
            <label><input type="radio" name="answ" value="2"  /> &nbsp;Choice 3</label>
            </td>
            </tr>
             <tr>
            <td>Choice 4</td>
            <td colspan="2">
            <textarea name="choices[]" id="choice_4" cols="10" class="mandatory"></textarea></td>
            <td>
            <label><input type="radio" name="answ" value="3"  /> &nbsp;Choice 4</label>
            </td>
            </tr>
  		 </table>
  	</div>
  		<div class="modal-footer">
             <input name="update" type="submit" value="Update" class="btn btn-primary"/>
    		 <button type="reset" class="btn btn-danger"  id="no" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
  		</div>
        </form>
</div>
</div>        
</div>
<?php }}?>
<!--Delete-->
<?php
  if(isset($qus_list) && !empty($qus_list))
  {
  foreach($qus_list as $st_lit)
  {
?>   
<div id="delete_<?php echo $st_lit['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden=			        	"false" align="center">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
					<h3 id="myModalLabel">Placement Action</h3>
	</div>
                            <div class="modal-body">
                          Are You Sure Want Delete? &nbsp; <strong></strong>
                            <input type="hidden" value="<?php echo $st_lit['id']; ?>" class="id" />
                            </div>
                            <div class="modal-footer">
                            
                            <button class="btn btn-primary id delt " id="delt">Delete</button>
                            <button type="button" class="btn btn-danger "  data-dismiss="modal" id="no"><i class="fa fa-times"></i> Cancel</button>
</div>
</div>
</div>  
</div>
<?php }} ?>
<!--Puzzles-->
<!--View-->
<?php

  if(isset($qus_list) && !empty($qus_list))
  {
  $i =1;
  foreach($qus_list as $st_lit)
  {
	$this->db->select('*');	
	$this->db->where('id',$st_lit['batch_id']);		
	$this->db->where('status','1');		
	$query_b = $this->db->get('batch')->result_array();
		
  ?>
<div id="viewp_<?php echo $st_lit["id"]; ?>" class="modal fade in" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3 id="myModalLabel">View Question</h3>

    	</div>
        
  		<div class="modal-body">
            <table class="view_table">
              <tr>
                <td width="150">Batch</td>
                <td class="text_bold"><?=$query_b[0]['from']?>-<?=$query_b[0]['to']?></td>
              </tr>
              <tr>
                <td>Question</td>
                <td class="text_bold"><?=$st_lit['question_s'];?></td>
              </tr>
              
              <?php if($st_lit['ques_img_name']!='no_image'){ ?>
              <tr>
                <td>Question Image</td>
                <td class="text_bold">
                <img src="<?php echo $this->config->item('base_url');?>/quest_img/<?=$st_lit['ques_img_name'];?>" width="200" height="150"/>
                </td>
              </tr>
              <?php } ?>
              <tr>
              	<td>Answer</td><td class="text_bold"><?=$st_lit["answe_r"]?></td>
              </tr>
             
            </table>
  		</div>
  		<div class="modal-footer">   
   			<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
  		</div>
  	</div>
  </div>
</div>

<?php
  $i++;
  }
  }
  ?>
<!-- Edit-->
 <?php 
if(isset($qus_list) && !empty($qus_list))
  {
  foreach($qus_list as $st_lit)
  {
	 
 ?>   

<div id="editp_<?php echo $st_lit['id']; ?>" class="modal fade in" tabindex="-1" 
  role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  	<div class="modal-dialog">
  	<div class="modal-content">
    <div class="modal-header"><a class="close" data-dismiss="modal">×</a>   
    <h3 id="myModalLabel">Update Placement</h3>
    </div>
  	<div class="modal-body">
    <form name="update" action="placement_test/update_puzzle" method="post" enctype="multipart/form-data" onsubmit="return validateform();">
    <input type="hidden" name="question_id" class="id form-control" id="question_id" value="<?php echo $st_lit["id"]; ?>" readonly="readonly" />
     	 <table width="100%" class="form_table">
                   <tr>
                <td width="150">Batch</td>
                <td>
                    <select id='batch_id' name='batch_id' >
                        <?php 
                            if(isset($all_batch) && !empty($all_batch)){
                                
                                foreach($all_batch as $bil)
                                {
                                    ?>
                        <option <?=($bil['id']==$st_lit['batch_id'])?'selected':''?> value="<?=$bil['id']?>"><?php echo $bil['from'].'-'.$bil['to']?>
                        </option>
                                    <?php 
                                }
                            }
                        ?>
                    </select>
                    </td>
                    <td> Department </td>
                    <td>
                    <?php 
                    if(isset($all_depart) && !empty($all_depart)){ 
					$this->db->select('*');	
					$this->db->where('plac_ques_id',$st_lit["id"]);		
					$this->db->where('status','1');	
					$query_dep1 = $this->db->get('placement_qus_dept')->result_array();
					//echo "<pre>"; print_r($query_dep1);
					?>	
                    <select multiple="multiple" name="dept_id[]" id="dept_id" style="width:100px">
                    <?php foreach($all_depart as $val){
						$ds=0;
						foreach($query_dep1 as $dep_id)
						{
							
							if($val['id']==$dep_id['depart_id'])
							{
								$ds=1;
							}
							
						}
						?>
						
                    <option <?=($ds>0)?'selected':''?> value="<?=$val['id']?>"><?=($val['department'])?></option>
                    <?php } ?>
                    </select>
                    <?php } ?>
                    </td>
                </tr>  
                <tr>
              	 <td>Re-Enter The Question</td>
                <td colspan="3"><textarea name="quest" value="<?=($st_lit['question_s'])?'selected':''?>" style="width:100%" checked="checked" 
                class="mandatory" ><?=$st_lit['question_s']?></textarea></td>
              </tr>
              <tr>
                <td>Question Image</td>
              <td align="center">
 				<input type="file" name="ques_img" id="ques_img" />
            </td>   
    </tr>
            <tr>
              	<td>Answer</td><td class="text_bold"><textarea name="updatep_answer" cols="20" rows="4"><?=$st_lit["answe_r"]?></textarea></td>
              </tr>
  		 </table>
  	</div>
  		<div class="modal-footer">
             <input name="update" type="submit" value="Update" class="btn btn-primary"/>
    		 <button type="reset" class="btn btn-danger"  id="no" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
  		</div>
        </form>
</div>
</div>        
</div>
<?php }}?>
<!--Delete-->
<?php
  if(isset($qus_list) && !empty($qus_list))
  {
  foreach($qus_list as $st_lit)
  {
?>   
<div id="deletep_<?php echo $st_lit['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden=			        	"false" align="center">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
					<h3 id="myModalLabel">Placement Action</h3>
	</div>
                            <div class="modal-body">
                          Are You Sure Want Delete? &nbsp; <strong></strong>
                            <input type="hidden" value="<?php echo $st_lit['id']; ?>" class="idp" />
                            </div>
                            <div class="modal-footer">
                            
                            <button class="btn btn-primary id delt " id="deltp">Delete</button>
                            <button type="button" class="btn btn-danger "  data-dismiss="modal" id="no"><i class="fa fa-times"></i> Cancel</button>
</div>
</div>
</div>  
</div>
<?php }} ?>
<!--Sub Questions-->
<!--View-->
<?php
  if(isset($qus_list) && !empty($qus_list))
  {
  $i =1;
  foreach($qus_list as $st_lit)
  {
	$this->db->select('*');	
	$this->db->where('place_quest_id',$st_lit['id']);	
	$this->db->where('status','0');		
	$query_m = $this->db->get('multi_choice_questions')->result_array();
	$j=0;
	foreach($query_m as $m_choice)
	{
		$this->db->select('*');	
		$this->db->where('multi_question_id',$m_choice['id']);		
		$this->db->where('status','0');		
		$query_choice[$j]['multi_choice'] = $this->db->get('multi_choice_answers')->result_array();
		$j++;
	}
		
  ?>
<div id="views_<?php echo $st_lit["id"]; ?>" class="modal fade in" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3 id="myModalLabel">View Question</h3>

    	</div>
        
  		<div class="modal-body">
            <tr>
   <td></td>
    <td><strong><?=$st_lit['question_s'];?></strong></td>
    </tr>
    <tr>
    <td align="center" colspan="2">
    <?php if($st_lit['ques_img_name']!='no_image'){?>
    <img class="staff_thumbnail" src="<?php echo $this->config->item('base_url');?>/quest_img/<?=$st_lit['ques_img_name'];?>"/>
    <?php }?>
    
    </td>
    </tr>
    <tr>
    <td colspan="2">
	<table width="100%" border="0"><?php 
	$mq=0;
	$mc=0;
	$m=1;
	foreach($query_m as $mques)
	{	
	$this->db->select('*');	
	$this->db->where('id',$mques['id']);	
	$this->db->where('status','0');		
	$query_mq[$mq]['mq']= $this->db->get('multi_choice_questions')->result_array();
	
	
	
	?>
    <tr><td><?=$m?></td><td height="100"><?php echo $query_mq[$mq]['mq'][0]['multi_question']; ?></td></tr>
    <?php 
	$m++;
	
	$this->db->select('*');	
	$this->db->where('multi_question_id',$mques['id']);	
	$this->db->where('status','0');		
	$query_mc= $this->db->get('multi_choice_answers')->result_array();
	$c=count($query_mc);
	$n=1;
	for($j=0;$j<$c;$j++)
	{
	if($query_mq[$mq]['mq'][0]['multi_answers'] == $query_mc[$j]['multi_options']){ $bg_clr = 'bgcolor="green" style="color:#fff;font-weight: bold;"'; }else{ $bg_clr = ''; }
	?>
     <tr <?=$bg_clr?>><td width="15"><?=$n?></td><td><span class="questions_opt"><?php echo $query_mc[$j]['multi_choice'];  ?></span></td></tr>
     <?php 
	 $n++;
	}
	$mq++;
	}
	
 
	
	 ?>
    </table></td>
    </tr>
    
    <td>
    
    
          
    
    
    
    </td>
    
    
  
  
  
            </table>
  		</div>
  		<div class="modal-footer">   
   			<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
  		</div>
  	</div>
  </div>
</div>

<?php
  $i++;
  }
  }
  ?>   
<!--Delete-->
<?php
  if(isset($qus_list) && !empty($qus_list))
  {
  foreach($qus_list as $st_lit)
  {
?>   
<div id="deletes_<?php echo $st_lit['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden=			        	"false" align="center">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
					<h3 id="myModalLabel">Placement Action</h3>
	</div>
                            <div class="modal-body">
                          Are You Sure Want Delete? &nbsp; <strong></strong>
                            <input type="hidden" value="<?php echo $st_lit['id']; ?>" class="idp" />
                            </div>
                            <div class="modal-footer">
                            
                            <button class="btn btn-primary id delt " id="delts">Delete</button>
                            <button type="button" class="btn btn-danger "  data-dismiss="modal" id="no"><i class="fa fa-times"></i> Cancel</button>
</div>
</div>
</div>  
</div>
<?php }} ?>
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
function validateform()
{
	var i=0;
	var batch_id=$("#batch_id").val();
	
	if(batch_id=="0")
	{
		$("#place1").html("Select Batch");
		i=1;
	}
	else
	{
		$("#place1").html("");
	}
	var quest=$("#quest").val();
	var filter=/\w+.*$/;
	if(quest=="")
	{
		$("#place2").html("Enter Question");
		i=1;
	}
	else if(!filter.test(quest))
	{
		$("#place2").html("Enter Valid Question");
		i=1;
	}
	else
	{
		$("#place2").html("");
	}
	var choice_1=$("#choice_1").val();
	var filter=/\w+.*$/;
	if(choice_1=="")
	{
		$("#place3").html("Enter Answer");
		i=1;
	}
	else if(!filter.test(choice_1))
	{
		$("#place3").html("Enter Valid Answer");
		i=1;
	}
	else
	{
		$("#place3").html("");
	}
	var choice_2=$("#choice_2").val();
	//var filter=/\w+.*$/;
	if(choice_2=="")
	{
		$("#place4").html("Enter Answer");
		i=1;
	}
	else if(!filter.test(choice_2))
	{
		$("#place4").html("Enter Valid Answer");
		i=1
	}
	else
	{
		$("#place4").html("");
	}
	var choice_3=$("#choice_3").val();
	//var filter=/\w+.*$/;
	if(choice_3=="")
	{
		$("#place5").html("Enter Answer");
		i=1;
	}
	else if(!filter.test(choice_3))
	{
		$("#place5").html("Enter Valid Answer");
		i=1;
	}
	else
	{
		$("#place5").html("");
	}
	var choice_4=$("#choice_4").val();
	var filter=/\w+.*$/;
	if(choice_4=="")
	{
		$("#place6").html("Enter Answer");
		i=1;
	}
	else if(!filter.test(choice_4))
	{
		$("#place6").html("Enter Valid Answer");
		i=1;
	}
	else
	{
		$("#place6").html("");
	}
	if(i==1)
	{
		return false;
	}
	else
	{
		return true;
	}
}

</script>
<form name="quest" action="placement_test/inse_ques" method="post" enctype="multipart/form-data" onsubmit="return validateform();">
<table class="staff_table" border="0">
  <tr>
    <td width="117">Batch </td>
    <td width="124">
    <?php 
	if(isset($all_batch) && !empty($all_batch)){ ?>	
    <select name="batch_id" id="batch_id" class="mandatory">
    <option value="0">Select</option>
    <?php foreach($all_batch as $vls){ ?>	
    <option value="<?=$vls['id']?>"><?=$vls['from']?> - <?=$vls['to']?></option>
    <?php } ?>
    </select><span id="place1" class="val" style="color:#F00;"></span>
   
    <?php }else{ echo "Oops! Please Add Batches"; } ?>
    </td>
    <td width="88"> Department</td>
    <td width="164">&nbsp;
    <?php 
	if(isset($all_depart) && !empty($all_depart)){ ?>	
    <select multiple="multiple" name="dept_id[]" id="dept_id" class="mandatory">
    <?php foreach($all_depart as $vls){ ?>	
    <option value="<?=$vls['id']?>"><?=$vls['department']?></option>
    <?php } ?>
    </select><span id="place7" class="val" style="color:#F00;"></span>
    <?php }else{ echo "Oops! Please Add Departments"; } ?>
    </td>
  </tr>
  <tr>
    <td>Enter the Question</td>
    <td colspan="2"><textarea name="quest" id="quest" cols="10" class="mandatory"  style="height:100px;"  ></textarea><span id="place2" class="val" style="color:#F00;"></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Question Image</td>
    <td colspan="2">
    <input type="file" name="ques_img" id="ques_img" /></td>
    <td>Choose Answer</td>
  </tr>
  <tr>
    <td>Choice 1</td>
    <td colspan="2">
    <textarea name="choice_1" id="choice_1" cols="10" class="mandatory" style="height:40px;" ></textarea><span id="place3" class="val" style="color:#F00;"></span></td>
    <td>
      <label><input type="radio" name="answ" value="0" id="answ_0" checked="checked" />Choice 1</label>
    </td>
  </tr>
  <tr>
    <td>Choice 2</td>
    <td colspan="2">
    <textarea name="choice_2" id="choice_2" cols="10" class="mandatory" style="height:40px;" ></textarea><span id="place4" class="val" style="color:#F00;"></span></td>
    <td><label><input type="radio" name="answ" value="1" id="answ_1" />Choice 2</label></td>
  </tr>
  <tr>
    <td>Choice 3</td>
    <td colspan="2">
    <textarea name="choice_3" id="choice_3" cols="10" class="mandatory" style="height:40px;"></textarea> <span id="place5" class="val" style="color:#F00;"></span></td>
    <td><label><input type="radio" name="answ" value="2" id="answ_2" />Choice 3</label></td>
  </tr>
  <tr>
    <td>Choice 4</td>
    <td colspan="2">
    <textarea name="choice_4" id="choice_4" cols="10" class="mandatory" style="height:40px;" ></textarea><span id="place6" class="val" style="color:#F00;"></span> </td>
    <td><label><input type="radio" name="answ" value="3" id="answ_3" />Choice 4</label></td>
  </tr>
  <?php /*?><tr>
    <td scope="row">Question Type</td>
    <td>
       <?php 
	if(isset($qus_type) && !empty($qus_type)){ ?>	
    <select name="mas_type_id" id="mas_type_id" >
    <!--<option value="0">Select</option>-->
    <?php foreach($qus_type as $vls){ ?>	
    <option value="<?=$vls['id']?>"><?=$vls['type_name']?></option>
    <?php } ?>
    </select>
    <?php }else{ echo "Oops! Please Add Batches"; } ?></td>
    <td>Existing Questions Count : </td>
  </tr><?php */?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input name="submit" type="submit" value="Submit" class="btn btn-primary"/> <input name="cancel" type="reset" value="Cancel" id="cancel" class="btn btn-danger"/></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<br />
<table class="table table-bordered table-striped dataTable">
<thead>
  <tr>
    <th width="8%">S.no</th>
    <th width="11%">Batch</th>
    <th width="10%">Department</th>
    <th width="22%">Question</th>
    <th width="11%">Image</th>
    <th width="15%">Answers</th>
    <th width="11%">Status</th>
    <th width="12%">Action</th>
  </tr>
</thead>
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
    <td><?php if($st_lit['status']==1){ echo "Active"; }else{ echo "Inactive";} ?></td>
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
  }else{
  ?>
  <tr>
    <td colspan="9" align="center">Sorry...! No Data Found...</td>
  </tr>
  <?php } ?>
</table>


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
                <img src="<?php echo $this->config->item('base_url');?>/quest_img/orginal/<?=$st_lit['ques_img_name'];?>" width="200" height="150"/>
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
  
  <?php 
if(isset($qus_list) && !empty($qus_list))
  {
  foreach($qus_list as $st_lit)
  {
	 foreach($query_dep as $vls)
	{
		foreach($query as $ans_cho)
		{
 ?>   

<div id="test1_<?php echo $st_lit['id']; ?>" class="modal fade in" tabindex="-1" 
  role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
  	<div class="modal-dialog">
  	<div class="modal-content">
    <div class="modal-header"><a class="close" data-dismiss="modal">×</a>   
    <h3 id="myModalLabel">Update Question</h3>
    </div>
  	<div class="modal-body">
    <form name="update" action="placement_test/update_ques" method="post" enctype="multipart/form-data" onsubmit="return validateform();">
    <input type="hidden" name="id" class="id form-control" id="id" value="<?php echo $st_lit["id"]; ?>" readonly="readonly" />
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
                    if(isset($all_depart) && !empty($all_depart)){ ?>	
                    <select multiple="multiple" name="dept_id[]" id="dept_id" style="width:100px">
                    <?php foreach($all_depart as $val){?>
						
                    <option value="<?=($val['id'])?'selected':''?>"><?=($val['department'])?></option>
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
            <textarea name="choice_1" id="choice_1" cols="10" class="mandatory"></textarea></td>
            <td>
            <label><input type="radio" name="answ" /> &nbsp;Choice 1</label>
            </td>
            </tr>
             <tr>
            <td>Choice 2</td>
            <td colspan="2">
            <textarea name="choice_2" id="choice_2" cols="10" class="mandatory"></textarea></td>
            <td>
            <label><input type="radio" name="answ" value="<?=($ans_cho['choice'])?'selected':''?>" checked="checked" /> &nbsp;Choice 2</label>
            </td>
            </tr>
             <tr>
            <td>Choice 3</td>
            <td colspan="2">
            <textarea name="choice_3" id="choice_3" cols="10" class="mandatory" value="<?=($ans_cho['choice'])?'selected':''?>" ></textarea></td>
            <td>
            <label><input type="radio" name="answ" value="<?=($ans_cho['choice'])?'selected':''?>" checked="checked" /> &nbsp;Choice 3</label>
            </td>
            </tr>
             <tr>
            <td>Choice 4</td>
            <td colspan="2">
            <textarea name="choice_4" id="choice_4" cols="10" class="mandatory" value="<?=($ans_cho['choice'])?'selected':''?>" ></textarea></td>
            <td>
            <label><input type="radio" name="answ" value="<?=($ans_cho['choice'])?'selected':''?>" checked="checked" /> &nbsp;Choice 4</label>
            </td>
            </tr>
  		 </table>
  	</div>
  		<div class="modal-footer">
             <input name="update" type="submit" value="Update" class="btn btn-primary"/>
    		 <button type="reset" class="btn btn-danger"  id="no" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
  		</div>
</div>
</div>        
</div>
<?php }}}}?>

  
  
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

<script type="text/javascript">
$(document).ready(function()
{
	$(".delt").live("click",function()
	{
	
	var id=$(this).parent().parent().find('.id').val();
	$.ajax
	(
		{
			
		 url:BASE_URL+"placement_test/delete_placement",
		 type:'POST',
		 data:{ value1:id},
		
		 success:function(result){ 
        // alert (hi);
		 $("#view_all").html(result);
		 $("#view_all").html();
		}    
	});
$('.modal').css("display", "none");
$('.fade').css("display", "none");
});
});
</script> 
          
<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<script type="text/javascript">
	var BASE_URL = '<?php echo $this->config->item('base_url');  ?>';
	var sess = '<?php echo $this->user_auth->get_username();  ?>';
</script>
<script type="text/javascript" src="<?= $theme_path; ?>/js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<link href="<?= $theme_path ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<script src="<?= $theme_path ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script type="text/javascript"> 
 $('#reservation').daterangepicker();   
</script>

<style type="text/css">
@media print
{
	.bill_method,input,select,label,.feedback-panel,.hide_tr,input, .btn, #bill_div, .print_use1 {display:none;}
}
</style>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<div class="fees_tit">Eligibility Students</div> 
<br />
<table class="table table-bordered table-striped dataTable">
<thead>
	<tr>
    	<th>Image</th>
        <th>Roll No</th>
        <th>Name</th>
        <th>Batch</th>   
        <th>Department</th>
        <th>Group</th>
        <th>Contact No</th>
        <th>CGPA</th>
    </tr>
</thead>    
    <?php 
	$count=0;$count1=0;
	
	if(isset($mark) && !empty($mark))
	{
		
		foreach($mark as $val)
		{
			$count++;
			$per=0;
			$sum=array();
			$i=0;
			$arrear_check=0;
			foreach($val['student'] as $val1)
			{
				$sum[]=$val1['total_cgb'];
				if($val1['grade']==0)
					$arrear_check=1;
				$i++;
			}
			$per=array_sum($sum)/$i;
			if($per < $get_mark['mark'])
			{
			$count1++;	
			continue;
			}
			if($get_mark['arrear']=='yes')
			{
				if($arrear_check==1)
				continue;
				else
				{
					?>
                    	<input type="hidden" name="std_id[]" class="std_id"  value="<?=$val['std_id']?>"	 />
                    <?php
				}
			}
			else
			{
				?>
                <input type="hidden" name="std_id[]" class="std_id"  value="<?=$val['std_id']?>"	 />
                <?php
			}
			?>
            	<tr>
                	<td>
                    <a href="#profile_img" data-toggle="modal" style="cursor:context-menu"><img class="staff_thumbnail" src="<?=$this->config->item('base_url')?>profile_image/student/thumb/<?=$val['image']?>" /></a>
                    </td>
                    <td>
						
						<?=$val['roll_no']?></td>
                    <td><?=ucfirst($val['name'])?></td>
                    <td>
						<?php	
							echo $val['from'].'-'.$val['to'];	
						?>
                    </td>
                    <td>
                    	<?php
							echo $val['department'];
						?>
                    </td>
                    <td>
                    	<?=$val['group'];?>
                    </td>
                    <td>
                    	<?php 
							echo $val['contact_no'];
						?>
                    </td>
                    <td style="color:#063;font-weight:bold;">
                    	<?php 
							echo round($per,2);
						?>
                    </td>
                </tr>
                
                
            <?php 
		}
	}
	if($count1==$count)
	{
		echo "<tr><td colspan='9'>No Data Found...</td></tr>";
	}
	?>
    </table>
<table  class='print_admin_use staff_table'>
    	<tr>
        	<td width="12%">Company Name</td>
            <td  width="25%">
            	<input type="text"  id='company_name' name='company_name' class="mandatory"/><span id="cp1" style="color:#F00;"></span>
            </td>
            <td width="12%">Venue</td>
            <td  width="25%">
            	<input type="text" id='venue'  name='venue' class="mandatory"/><span id="cp2" style="color:#F00;"></span>
            </td>
            <td width="12%">Date</td>
            <td  width="25%">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name='reservation' id="reservation" class="mandatory int_val nmformat"><span id="cp3" style="color:#F00;"></span>
            </div><!-- /.input group -->
                                   
            </td>
        </tr>
        <tr>
        	<td style="vertical-align:top">Comments</td>
            <td colspan="5">
                <!--<textarea class="form-control" id='company_comment'  name='company_comment' rows="3" style="width:100%" ></textarea>-->
                <textarea id="company_comment" name="company_comment" style="height:75px;" class="mandatory"></textarea>
                <span id="cp4" style="color:#F00;"></span>
            </td>
        </tr>
        <tr>
        	<td width="10%">Salary</td>
            <td  width="5%">
            	<input type="text" id='salary' name='salary' class="mandatory" /><span id="cp5" style="color:#F00;"></span> 
            </td>
            <td  width="8.25%"></td>
            <td  width="10%">
            </td>
            <td  width="5%"></td>
            <td  width="30%">
            
            </td>
        </tr>
    </table>
<p class="print_admin_use">    
      <input type="button" class="btn btn-warning" style="float:right;margin-left:10px;" value="Print" id="print_btn" />
      <input type="submit" class="btn btn-success submit" style="float:right;"  id="add_interview" /> 
      <br /><br />
</p>
     <script type="text/javascript">
	 $('#print_btn').click(function(){
		window.print();	 
     });

</script>

</form>
<script>
$("#company_name").live('blur',function()
{
    var company_name=$("#company_name").val();
	var filter=/\w+.*$/;
	if(company_name=="")
	{
		$("#cp1").html("Required Field");
	}
	else if(!filter.test(company_name))
	{
		$("#cp1").html("Required Field");	
	}
	else
	{
		$("#cp1").html("");
	}
});
$("#venue").live('blur',function()
{
    var venue=$("#venue").val();
	var filter=/\w+.*$/;
	if(venue=="")
	{
		$("#cp2").html("Required Field");	
	}
	else if(!filter.test(venue))
	{
		$("#cp2").html("Required Field");	
	}
	else
	{
		$("#cp2").html("");
	}
});
$("#reservation").live('blur',function()
{
var reservation=$("#reservation").val();
	if(reservation=="" || reservation.trim().length==0 || reservation==null)
	{
		$("#cp3").html("Required Field");
		$("#company_name").focus();
	}
	else
	{
		$("#cp3").html("");
	}
});
$("#company_comment").live('blur',function()
{
	var company_comment=$("#company_comment").val();
	if(company_comment=="")
	{
		$("#cp4").html("Required Field");
	}
	else if (company_comment.length<6 || company_comment.length>250) 
    {
	 
	   $("#cp4").html("Minimum 6 to 250 characters");	
	 
    }
	else
	{
		$("#cp4").html("");
	}
});
$("#salary").live('blur',function()
{
	var salary=$("#salary").val();
	var filter=/^[0-9]{4,10}$/;
	if(salary=="" || salary.trim().length==0 || salary==null)
	{
		$("#cp5").html("Required Field");
	}
	else if(!filter.test(salary))
	{
		$("#cp5").html("Numeric only and length 4 to 10");
	}
	else if(salary==0)
	{
		$("#cp5").html("Required Field");
	}
	else
	{
		$("#cp5").html("");
	}
});

</script>
<script>
 $(document).ready(function()
 {
	 
	 $(".cancelBtn").live('click',function()
  		{
			
		});
	 
  $(".submit").live('click',function()
  {
	i=0;
	var company_name=$("#company_name").val();
	var cfilter=/\w+.*$/;
	if(company_name=="")
	{
		$("#cp1").html("Required Field");
		$('#company_name').css('border','1px solid #F00');
		i=1;
	}
	else if(!cfilter.test(company_name))
	{
		$("#cp1").html("Required Field");
		$('#company_name').css('border','1px solid #F00');
		i=1;	
	}
	else
	{
		$("#cp1").html("");
	}
	var venue=$("#venue").val();
	var vfilter=/\w+.*$/;
	if(venue=="")
	{
		$("#cp2").html("Required Field");
		$('#venue').css('border','1px solid #F00');	
		i=1;
	}
	else if(!vfilter.test(venue))
	{
		$("#cp2").html("Required Field");
		$('#venue').css('border','1px solid #F00');
		i=1;	
	}
	else
	{
		$("#cp2").html("");
	}
	var reservation=$("#reservation").val();
	if(reservation=="")
	{
		$("#cp3").html("Required Field");
		$('#reservation').css('border','1px solid #F00');
		i=1;
	}
	else
	{
		$("#cp3").html("");
		$('#reservation').css('border','1px solid #CCCCC');
	}
	var company_comment=$("#company_comment").val();
	if(company_comment=="")
	{
		$("#cp4").html("Required Field");
		$('#company_comment').css('border','1px solid #F00');
		i=1;
	}
	else if (company_comment.length<6 || company_comment.length>250) 
    {
	 
	   $("#cp4").html("Minimum 6 to 250 characters");
	   $('#company_comment').css('border','1px solid #F00');
	   i=1;	
	 
    }
	else
	{
		$("#cp4").html("");
	}
	var salary=$("#salary").val();
	var filter=/^[0-9]{4,10}$/;
	if(salary=="" || salary.trim().length==0 || salary==null)
	{
		$("#cp5").html("Required Field");
		 $('#salary').css('border','1px solid #F00');
		 i=1;
	}
	else if(!filter.test(salary))
	{
		$("#cp5").html("Numeric only and length 4 to 10");
		 $('#salary').css('border','1px solid #F00');
		 i=1;
	}
	else if(salary==0)
	{
		$("#cp5").html("Required Field");
		 $('#company_comment').css('border','1px solid #F00');
		 i=1;
	}
	else
	{
		$("#cp5").html("");
	}
	if(i==1)
	{
		return false;
	}
	else
	{
		return true;
	}
	  
  });
 });
</script>


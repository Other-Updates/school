
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
        <script type="text/javascript">
$('#form_name').live('blur',function()
	
	{
		
    var name=$(this).val();
	
	var filter=/\w+.*$/;
	if(name=="" || name==null || name.trim().length==0)
	{
		
		$("#v_error").html("Required Field");
		
	}
	else if(!filter.test(name))
	{
		$("#v_error").html("Enter Valid Name");
		
	}
	else
	{
		$("#v_error").html("");
	}
	});
	$('#imgInp').live('blur',function()
	{
		var img=$('#imgInp').val();
		if(img=="")
		{
			$("#img_error").html("Required Field");
		}
		else
		{
			$("#img_error").html("");
		}
	});
	</script>
    <script type="text/javascript">
	 $("#imgInp").live('change',function() {
				
				var val = $(this).val();
				//alert(val);
				switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
					 case 'doc': case 'docx': case 'pdf': case 'bmp': case 'jpg': case 'png': case '':
						$(this).val();
						$("#file_error").html("");
						break;
					default:
						$(this).val();
					   
					   $("#file_error").html("Upload Pdf/Doc/Docx/Image Files");
						break;
				}
			});
	</script>
    <script type="text/ecmascript">
   function validateForm()
   {
	var i=0;
	var name=$("#form_name").val();
	var filter=/\w+.*$/;
	
	if(name=="" || name==null || name.trim().length==0)
	{
		$("#v_error").html("Required Field");
		i=1;
	}
	else if(!filter.test(name))
	{
		$("#v_error").html("Enter Valid Name");
		i=1;
	}
	else
	{
		$("#v_error").html("");
	}
	var img=$('#imgInp').val();
		if(img=="")
		{
			$("#img_error").html("Required Field");
			i=1;
		}
		else
		{
			$("#img_error").html("");
		}
	message=document.getElementById('file_error').innerHTML;
	if((message.trim()).length>0)
	{
		i=1;
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
<?php /*?><script>
				$("form[name=sform]").submit(function()
  				{
				message=document.getElementById('file_error').innerHTML;
				if((message.trim()).length>0)
				{
					return false;
				}
				else
				{
					return true;
				}
				});
</script>
<?php */?>
<form method="post" name="sform" enctype="multipart/form-data" onsubmit="return validateForm();">
<table class="staff_table">
	<tbody>
		<tr>
			<td>Form Name</td>	
            <td><input type="text" name='form_name' class="mandatory" id="form_name" tabindex="1" />            
            <span id="v_error" class="val" style="color:#F00;"></span></td>	
            <td>File</td>	
            <td>
            	<div class="staff_img">   
                    <p>&nbsp;</p>
                    <input type='file' name="staff_image" style="margin-top: -25px;" class="mandatory" id="imgInp" tabindex="2" />
                    <span id="file_error" class="val" style="color:#F00;"></span> 
                    <span id="img_error" class="val" style="color:#F00;"></span>
               </div>
            </td>	
		</tr>
        </tbody>
        </table>          
        <img id="blah" name="file_name" width="100%" /><br /><br />  
        <input type="button" class="btn btn-danger right" id="cancel" value="Cancel" tabindex="4" /> 
        <input type="submit" class="btn btn-success right" style="margin-right:10px;" value="Submit" tabindex="3" />
        
        <br /><br />
</form>
<br /><br />
<table id="example1" class="table table-bordered table-striped dataTable">
	<thead>
	<tr>
    	<th width="1%">S.No</th>
        <th width="5%">File</th>
        <th width="5%">Form Name</th>
        <th width="3%">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php 
	$i=1;
	$user_det = $this->session->userdata('logged_in');
	if(isset($all_form) && !empty($all_form))
	{
		foreach($all_form as $val)
		{
			$temp=explode(".",$val['file_name'] );
   						 $ext=end($temp);
						 
						 $txt='txt';$docx='docx'; $pdf='pdf';$zip='zip';$rar='rar';$image='jpg';$image1='jpeg'; $image2='png'; $doc='doc';
			?>
         	<tr>
                <td><?=$i?></td>
                <td>
                <?php
				if($ext==$image) 
				{
				?>
                <a  href="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>" download="<?=$val['file_name']?>">
					<img id="blah" style=" radius:100px; " class="staff_thumbnail" src="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>"  alt="Form" /> 
                </a>
                <?php
				} 
				else if($ext==$image1)
				{
				?>
                <a  href="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>" download="<?=$val['file_name']?>">
					<img id="blah" style=" radius:100px;" class="staff_thumbnail" src="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>"  alt="Form" /> 
                </a>
                <?php
				}
				else if($ext==$image2)
				{
				?>
                <a  href="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>" download="<?=$val['file_name']?>">
					<img id="blah" style=" radius:100px;" class="staff_thumbnail" src="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>"  alt="Form" /> 
                </a>
                <?php 
				} else if($ext==$docx)
				{
				 ?>
                 <a  href="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>" download="<?=$val['file_name']?>">
					<img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" />
                </a>
                 <?php } 
				 else if($ext==$doc)
				 {
				 ?>
                 <a  href="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>" download="<?=$val['file_name']?>">
					<img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" />
                </a>
                 <?php 
				 } else if($ext==$pdf)
				 {
				  ?>
                  <a  href="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>" download="<?=$val['file_name']?>">
					<img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" />
                </a>
                  <?php
				 }
				 else
				 {
				 ?>
                 <a  href="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>" download="<?=$val['file_name']?>">
					<img id="blah" style=" radius:100px;" class="staff_thumbnail" src="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>"  alt="Form" /> 
                </a>
                 <?php } ?>
				</td>
                <td><?=$val['form_name']?></td>
                
                <td>
                <a href="<?= $this->config->item('base_url') ?>download_form_files/<?php echo $val['file_name']; ?>" download="<?=$val['file_name']?>" title="Download" class="btn bg-green btn-sm"><i class="fa fa-download"></i></a>
              <?php if(($user_det['staff_type']==$val['staff_type']) && ($user_det['user_id']==$val['created_by'])) { ?>
                	<a href="#test_<?php echo $val['id']; ?>" title="Delete" data-toggle="modal" name="group" class="btn bg-maroon btn-sm">Delete</a>
                   
                    <?php } ?>
                </td>
            </tr>   
            <?php
			$i++;
		}
	}
	
	?>
    </tbody>
</table>
 <?php 
	if(isset($all_form) && !empty($all_form))
	{
		foreach($all_form as $val)
		{
			?>
         	<div id="test_<?=$val['id']?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
               <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3 id="myModalLabel">Delete Form</h3>
                </div>
              <div class="modal-body" >
            		Are You Sure You Want to Delete ?
              </div>
              <div class="modal-footer">   
              	<a class="btn btn-warning"  href="<?= $this->config->item('base_url') ?>download_form/delete_form/<?=$val['id']?>">Yes</a>
                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
               </div>
               </div>  
              </div>
            </div>
            <?php
		}
	}
	?>

<script type="text/javascript">

	 function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
		
		var test_img=$(this).val();
		var timg=test_img.substring(test_img.lastIndexOf('.') + 1).toLowerCase();
					 
        if($(this).val()=="" || $(this).val()==null)
		{
		}
		else if(timg=='png' || timg=='jpg' || timg=='jpeg' || timg=='bmp')
		{	
        readURL(this);
		}
		else
		{
			$('#blah').attr('src', '');
		}
    });
	$('#cancel').live('click',function()
	{
		$('#form_name').val('');
		$('#imgInp').val('');
		$('.val').html('');
		$('#blah').attr('src', '');
		$('.mandatory').css('border','1px solid #CCCCCC');
	});
	</script>
    
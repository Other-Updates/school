<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template');?>
<link href="<?= $theme_path; ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/datatables/stu_data_table.css" rel="stylesheet" type="text/css" />
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user">
    	<img src="<?= $theme_path; ?>/images/icons/events/download.png">
    </div>
    Download Forms		
</div>
<div class="message-form-inner">
<table id="example1" class="table table-bordered table-striped" >
<thead>
	<tr>
    	<th width="10%">S.No</th>        
        <th width="50%">Form Name</th>
        <th>Uploaded By</th>
        <th width="10%">File</th>        
    </tr>
</thead>    
    <?php 
	$i=1;
	if(isset($all_form) && !empty($all_form))
	{
		foreach($all_form as $val)
		{
			$temp=explode(".",$val['file_name'] );
   						 $ext=end($temp);
						 
						 $txt='txt';$docx='docx'; $pdf='pdf';$zip='zip';$rar='rar';$image='jpg';$image1='jpeg'; $image2='png'; $doc='doc';
			?>
         	<tr>
                <th><?=$i?></th>
                <th><?=$val['form_name']?></th>
                <th><?=$val['staff'][0]['name']?></th>
                <th>
                
                <?php
				if($ext==$image) 
				{
				?>
                <a  href="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>" download="<?=$val['file_name']?>">
					<img id="blah" style="radius:100px;height:50px;width:50px;" class="add_staff_thumbnail" src="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>"  alt="Form" /> 
                </a>
                <?php
				} 
				else if($ext==$image1)
				{
				?>
                <a  href="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>" download="<?=$val['file_name']?>">
					<img id="blah" style=" radius:100px;height:50px;width:50px;" class="add_staff_thumbnail" src="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>"  alt="Form" /> 
                </a>
                <?php
				}
				else if($ext==$image2)
				{
				?>
                <a  href="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>" download="<?=$val['file_name']?>">
					<img id="blah" style=" radius:100px;height:50px;width:50px;" class="add_staff_thumbnail" src="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>"  alt="Form" /> 
                </a>
                <?php 
				} else if($ext==$docx)
				{
				 ?>
                 <a  href="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>" download="<?=$val['file_name']?>">
					<img id="blacch" style=" radius:100px;height:50px;width:50px;" class="add_staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" />
                </a>
                 <?php } 
				 else if($ext==$doc)
				 {
				 ?>
                 <a  href="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>" download="<?=$val['file_name']?>">
					<img id="blacch" style=" radius:100px;height:50px;width:50px;" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" />
                </a>
                 <?php 
				 } else if($ext==$pdf)
				 {
				  ?>
                  <a  href="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>" download="<?=$val['file_name']?>">
					<img id="blccah" style=" radius:100px;height:50px;width:50px;" class="add_staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" />
                </a>
                  <?php
				 }
				 else
				 {
				 ?>
                 <a  href="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>" download="<?=$val['file_name']?>">
					<img id="blah" style=" radius:100px;height:50px;width:50px;" class="staff_thumbnail" src="<?= $this->config->item('base_url') ?>download_form_files/<?=$val['file_name']?>"  alt="Form" /> 
                </a>
                 <?php } ?>
				</th>
             
                
            </tr>   
            <?php
			$i++;
		}
	}
	
	?>
</table>
</div>
</div>
</div>
<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		$("#example1").dataTable();
		$("#example4").dataTable();
		$("#example5").dataTable();
		$("#example3").dataTable();
		 $("#example4").dataTable();
		 $("#example5").dataTable();
		$('#example2').dataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": false
		});
	});
	
	$('.public').live('click',function(){
		$('.pub').show()
	
	});
	$('.hid').live('click',function(){
		$('.pub').hide()
	});
</script> 
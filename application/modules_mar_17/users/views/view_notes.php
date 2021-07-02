<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?> 
<link href="<?= $theme_path; ?>/css/footable.core.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/footable-demos.css" rel="stylesheet" type="text/css" />
<script src="<?= $theme_path; ?>/js/footable.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function () {
		$('table').footable();
	});
</script>  
<div id="back" style="max-height:555px; overflow-y:auto">
<table class="table demo my_table_style" id="table_view" >
<thead>
<tr>
<th>Files</th>
<th data-hide="phone,tablet">Subject</th>
<th>Posted By</th>
<th>Notes Title</th>
<th data-hide="phone">Date of post</th>
<th data-hide="phone,tablet">Download</th>
</tr>
</thead>
<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<?php //echo "<pre>"; print_r($notes_share); exit;?>
<?php  if(isset($notes_share) && !empty($notes_share)){
						//print_r($notes_share); exit;
            foreach($notes_share as $val)
                        {
							
	 $temp=explode(".",$val['image'] );
   						 $ext=end($temp);
						 $txt='txt';$docx='docx'; $pdf='pdf';$zip='zip';$rar='rar';$image='jpg';$image1='jpeg'; $image2=''; $doc='doc'; ?>

    <tr><td>
								<?php if($ext==$txt)
								{?>
									<a href="<?=$this->config->item('base_url').'profile_image/notes/original/'.rawurlencode($val['image'])?>" download="<?=$val['image']?>"> 
                                    <img class="img" id="blah" width="50" height="50" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /></a>
                                    
						  <?php }
								else if($ext==$doc)
								{?>
									<a href="<?=$this->config->item('base_url').'profile_image/notes/original/'.rawurlencode($val['image'])?>" download="<?=$val['image']?>">
                                    <img id="blah" class="img" width="50" height="50" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /></a>
						  <?php }
						 else if($ext==$docx)
								{?>
									<a href="<?=$this->config->item('base_url').'profile_image/notes/original/'.rawurlencode($val['image'])?>" download="<?=$val['image']?>">
                                    <img id="blah" class="img" width="50" height="50" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /></a>
						  <?php }
								else if($ext==$pdf)
								{?>
									<a href="<?=$this->config->item('base_url').'profile_image/notes/original/'.rawurlencode($val['image'])?>" download="<?=$val['image']?>">
                                    <img id="blah" class="img" width="50" height="50" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
						  <?php }
                          else if($ext==$zip)
								{?>
									<a href="<?=$this->config->item('base_url').'profile_image/notes/original/'.rawurlencode($val['image'])?>" download="<?=$val['image']?>">
                                    <img id="blah" class="img" width="50" height="50" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
						  <?php }
                          else if($ext==$rar)
								{?>
									<a href="<?=$this->config->item('base_url').'profile_image/notes/original/'.$val['image']?>" download="<?=$val['image']?>">
                                    <img id="blah" class="img" width="50" height="50" src="<?= $theme_path;?>/img/rar.png"  alt="notes" /></a>
						  <?php }
						 else  if($ext==$image)
						  {?>
							  <a href="<?=$this->config->item('base_url').'profile_image/notes/original/'.rawurlencode($val['image'])?>" download="<?=$val['image']?>"> 
                              <img  class="img" src="<?=$this->config->item('base_url').'profile_image/notes/original/'.$val['image']?>" 
                              width="50" height="50"/> </a>
        								 
						  <?php } 
                          else if($ext==$image1)
						  {?>
							  <a href="<?=$this->config->item('base_url').'profile_image/notes/original/'.rawurlencode($val['image'])?>" download="<?=$val['image']?>"> 
                              <img class="img" src="<?=$this->config->item('base_url').'profile_image/notes/original/'.$val['image']?>" 
                              width="50" height="50"/> </a>
        								 
						  <?php }
						 else if($ext==$image2)
						  {?>
							<a href="<?=$this->config->item('base_url').'profile_image/notes/original/'.rawurlencode($val['image'])?>" download="<?=$val['image']?>">  
                              <img id="blah" width="50" height="50" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>
        								 
						  <?php } else {?>
                          <a href="<?=$this->config->item('base_url').'profile_image/notes/original/'.rawurlencode($val['image'])?>" download="<?=$val['image']?>"> 
									<img id="blacch" width="50" height="50" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                 			<?php } ?></td>
                          
    							<td><?=$val['subject_name']?></td>
                                <td style="text-align:center;"><?=$val['staff'][0]['staff_name']?></td>
                                <td><?=$val['note_title']?></td><td><?=date("d-M-Y",strtotime($val['ldt']))?></td>
    							<td>
                                <a href="<?=$this->config->item('base_url').'profile_image/notes/original/'.$val['image']?>" download="<?=$val['image']?>">
                               <img src="<?= $theme_path; ?>/images/download.png"  alt="notes" title="Download" /><?php $val['image'] ?> </button></a> </td></tr>
								
  <?php } }else echo "<tr><td colspan='10' aline='center'>No records available</td> </tr>";
  ?>
</table>
</div>
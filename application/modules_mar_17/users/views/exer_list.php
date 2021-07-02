<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/placement_test.png"></div>
    Exercise List 			
</div> 
<?php /*?><?php
echo "<pre>";
print_r($excer_list);
exit;
?> <?php */?>
<div class="page-inner"><div class="page-title"><span> Exercise List</span> </div></div>
<div class="message-divider"></div>
<div class="message-form-inner">
<table width="350" border="1">
  <tr>
    <th width="53" scope="col">S.No </th>
    <th width="128" scope="col">Name</th>
    <th width="64" scope="col">Author Name</th>
    <th width="38" scope="col">Link</th>
    </tr>
  <?php
  $i =1;
  foreach($excer_list as $bthc_vl )
  {
  ?>
  <tr>
    <td><?=$i?></td>
    <td><?=$bthc_vl->display_name?></td>
    <td><?=$bthc_vl->author_name ?></td>
    <td><a href="<?=$bthc_vl->ka_url ?>" target="_blank">Click Here for Exercise</a></td>
    </tr>
  <?php $i++; } ?>
</table>

<br />

</div>
</div>
</div>

<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/placement_test.png"></div>
    Category List 			
</div> 
<?php /*?><?php
echo "<pre>";
print_r($categ_list);
exit;
?> <?php */?>
<div class="page-inner"><div class="page-title"><span> Category List</span> </div></div>
<div class="message-divider"></div>
<div class="message-form-inner">
<table width="350" border="1">
  <tr>
    <th width="53" scope="col">S.No </th>
    <th width="128" scope="col">Badges Name</th>
    <th width="64" scope="col">icon</th>
    <th width="77" scope="col">Description</th>
    </tr>
  <?php
  $i =1;
  foreach($categ_list as $bthc_vl )
  {
  ?>
  <tr>
    <td><?=$i?></td>
    <td><?=$bthc_vl->type_label?></td>
    <td><img src="<?=$bthc_vl->icon_src ?>"/></td>
    <td><?=$bthc_vl->translated_description ?></td>
    </tr>
  <?php $i++; } ?>
</table>

<br />

</div>
</div>
</div>

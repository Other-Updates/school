<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/placement_test.png"></div>
    Badges List 			
</div> 
<?php /*?><?php
echo "<pre>";
		print_r($batch_list);
		exit;
?> <?php */?>
<div class="page-inner"><div class="page-title"><span> Badges List</span> </div></div>
<div class="message-divider"></div>
<div class="message-form-inner">
<table width="590" border="1">
  <tr>
    <th width="53" scope="col">S.No </th>
    <th width="128" scope="col">Badges Name</th>
    <th width="64" scope="col">icon</th>
    <th width="77" scope="col">Description</th>
    <th width="65" scope="col">points </th>
    <th width="69" scope="col">slug name</th>
    <th width="88" scope="col">Link</th>
  </tr>
  <?php
  $i =1;
  foreach($batch_list as $bthc_vl )
  {
  ?>
  <tr>
    <td><?=$i?></td>
    <td><?=$bthc_vl->description?></td>
    <td><img src="<?=$bthc_vl->icon_src ?>"/></td>
    <td><?=$bthc_vl->safe_extended_description ?></td>
    <td><?=$bthc_vl->points ?></td>
    <td><?=$bthc_vl->slug ?></td>
    <td><a target="_blank" href="<?=$bthc_vl->absolute_url ?>">Click for Badges</a></td>
  </tr>
  <?php $i++; } ?>
</table>

<br />

</div>
</div>
</div>

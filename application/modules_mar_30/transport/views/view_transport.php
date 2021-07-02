<h3>View Stages</h3>
<?php
	 $i=1;
 if(isset($stage_master) && !empty($stage_master))
	 {
     	foreach($stage_master as $val)
        {
			?> <?php  $i++;
		}
	 }?>
 <div>
<br />
<table class="staff_table">
<tr>
    <td width="8%">Bus No</td>
    <td class="text_bold" width="10%"><label><?=$val['bus_no'] ?></label></td>
    <td width="8%">Route Name</td>
    <td class="text_bold" width="10%"><label><?=$val['root_name'] ?></label></td>        
    <td width="8%">Source</td>
    <td class="text_bold" width="10%"><label><?=$val['source'] ?></label></td>
   </tr>
</table> 
</div>
</br>
<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
 <link href="<?= $theme_path ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<script src="<?= $theme_path ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
 <script src="<?= $theme_path ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script>
function myFunction() {
    window.print();
}
</script>

  <?php 
  $data='';
  $arr_y=explode(",", $bus_number[0]['map_details']);
  $jj=0;
  foreach($arr_y as $key=>$map_det)
  {
	if($map_det!='')
	{
		$jj++;
	}
  }
  $jjj=1;
  $data_s='';
  foreach($arr_y as $key=>$map_det)
	{
		if($map_det!='')
		{
			$l_a=explode("_", $map_det);
			$data=$data.'new google.maps.LatLng('.$l_a[0].','.$l_a[1].')';
			if($jjj==1)
			{
				$data_s='var haightAshbury =new google.maps.LatLng('.$l_a[0].','.$l_a[1].');';
			}
			if($jj != $jjj)
			{
			$data=$data.',';
			}
			$jjj++;
		}
	}
  ?>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>

  <style>
      #googleMap {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
      #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>
   
    <script>
// In the following example, markers appear when the user clicks on the map.
// The markers are stored in an array.
// The user can then click an option to hide, show or delete the markers.
var map;
var markers = [];
var pos = [];
var line;
function initialize() {
  <?=$data_s?>
  var mapOptions = {
    zoom: 14,
    center: haightAshbury,
     mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('googleMap'),
      mapOptions);

  // This event listener will call addMarker() when the map is clicked.
   var lineCoordinates = [
   <?=$data?>
  ];

  // Define the symbol, using one of the predefined paths ('CIRCLE')
  // supplied by the Google Maps JavaScript API.
  var lineSymbol = {
    path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
    scale: 5,
    strokeColor: '#393'
  };

  // Create the polyline and add the symbol to it via the 'icons' property.
  line = new google.maps.Polyline({
    path: lineCoordinates,
    icons: [{
      icon: lineSymbol,
      offset: '100%'
    }],
    map: map
  });

  animateCircle();
  
}

// Add a marker to the map and push to the array.
function addMarker(location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
  markers.push(marker);
 
  
	pos[i]=marker.position.k+'_'+marker.position.B;
	  console.log(pos);
	i++;
}
function animateCircle() {
    var count = 0;
    window.setInterval(function() {
      count = (count + 1) % 200;

      var icons = line.get('icons');
      icons[0].offset = (count / 2) + '%';
      line.set('icons', icons);
  }, 100);
}
// Sets the map on all markers in the array.
function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}


google.maps.event.addDomListener(window, 'load', initialize);

    </script>

	
    <div id="googleMap" style="width:100%;height:380px;"></div>
<div>
<table class="all list_all table table-bordered table-striped" id="example3">
<thead>
<tr><th>S.No</th><th>Stage Name</th><th>Bus Fees</th></tr>
</thead>
      <tbody>
          <?php $i=1;
	 if(isset($stage_master) && !empty($stage_master))
	 {
     	foreach($stage_master as $val)
        {
			?>
       		<!--<input type="hidden" id="fee_id" class="upd_id value<?=$i?>"  />-->
           
        <tr>
          <td><?=$i;?></td>
          <td><?=$val['stage_name'] ?></td>
          <td><?=$val['bus_fees'] ?></td>
           
       </tr>
   
    <?php  $i++;
		}
	 }?>
     </tbody>
  </table> 
  
  <p class="">
  <br />
   <?php /*?><button><a href="<?=$this->config->item('base_url').'transport/bus_root_details' ?>" Back </a> </button><?php */?>
  <input type="button" class="btn btn-warning print_btn" style="float:right;margin-right:10px;" value="Print"  id="print_btn" onclick="myFunction()" />
   <input type="button" value="Back" class="btn btn-danger left" onClick="history.go(-1);return true;" >
   <br /><br />
  </p>
</div>

<style type="text/css">
@media print{
	input
	{
		
		display:none;
	}
	}
</style>
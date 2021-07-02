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
   <?php 
$this->load->model('transport/transport_model');
$map_point=$this->transport_model->get_map_info($stage_master[0]['master_root_id']);
$arr_y=explode(",", $map_point[0]['map_details']);
$add_marker='';

?>
    <script>
// In the following example, markers appear when the user clicks on the map.
// The markers are stored in an array.
// The user can then click an option to hide, show or delete the markers.
var map;
var markers = [];
var pos = [];

function initialize() {
  <?php 
  $i=1;
  $data='';
  $datas='';
  foreach($arr_y as $key=>$map_det)
{
	if($map_det!='')
	{
		$l_a=explode("_", $map_det);
		 $data=$data.'var haightAshburynew'.$i.' = new google.maps.LatLng('.$l_a[0].','.$l_a[1].');';
		 $datas=$datas.'addMarker(haightAshburynew'.$i.');';
		$i++;
	}
}
  ?>	
	 <?=$data;?>
	  var mapOptions = {
    zoom: 15,
    center: haightAshburynew1,
     mapTypeId:google.maps.MapTypeId.ROADMAP
  };
	  map = new google.maps.Map(document.getElementById('googleMap'),
		  mapOptions);
	
	  // This event listener will call addMarker() when the map is clicked.
	  google.maps.event.addListener(map, 'click', function(event) {
		addMarker(event.latLng);
	  });
	<?=$datas;?>
	  // Adds a marker at the center of the map.
	 
		

  
}
i=0;
// Add a marker to the map and push to the array.
function addMarker(location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
  markers.push(marker);
	pos[i]=marker.position.k+'_'+marker.position.B;
	i++;
}

// Sets the map on all markers in the array.
function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setAllMap(null);
}

// Shows any markers currently in the array.
function showMarkers() {
  setAllMap(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  clearMarkers();
  markers = [];
  pos=[];
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>

<h3>Update Stages</h3>
<div>
<table style="display:none;">
<tr id="last_row">

	<td><input type="text" class='stage_name length' name='stage_name[]' id="stage_name" /></td>
    <td><input type="text" class='r_amount length' name='r_amount[]' id="r_amou" /></td>
    <td><input type="button" value="-" class='remove_comments btn bg-purple btn-sm'/></td>
</tr>

</table>
 <?php $i=1;
	 if(isset($stage_master) && !empty($stage_master))
	 {
     	foreach($stage_master as $val)
		
        {
			?> <?php $i++;}} ?>
<div>
<table class="staff_table">
<tr>
    <td width="10%">Bus No</td>
    <td class="text_bold" width="15%"><label><?=$val['bus_no'] ?></label></td>
    <td width="10%">Route Name</td>
    <td class="text_bold" width="23%"><label><?=$val['root_name'] ?></label></td>        
    <td width="10%">Source</td>
    <td class="text_bold" width="23%"><label><?=$val['source'] ?></label></td>
</tr>
</table> 
</div>
<br />
<div class="row">
<div class="col-lg-6">
<table id='app_table' class="form_table">
	<tr>
    	
        <td>
        
    	
            	<?php 
                    if(isset($bus_number) && !empty($bus_number)){
                        foreach($bus_number as $val)
                        {
                            ?>
                            
                            <?php 
                        }
						
                    }
                ?>
            	</select>
                <input type="hidden" name="master_ve" id="master_ve" class="master_ve" value="<?=$stage_master[0]['master_bus_id']?>"/>
                </td></tr>
               
              
      			<td id="view"><input type='hidden'  name='rname' class='rname' id='rname' value="<?=$stage_master[0]['master_root_id']?>" /></td>
            
         
         <tr height="30">
         	<td width="50%">
            Stage Name
            </td>
            <td>
            Bus Fees
            </td>
         </tr>
   
     <?php $i=1;
	 if(isset($stage_master) && !empty($stage_master))
	 {
     	foreach($stage_master as $val)
        {
			?>
        <tr>
            <td>
            	<input type="text" value="<?=$val['stage_name'] ?>"   class="stage_name length" name='stage_name[]' id="stage_name"/>
            </td>
        
             <td>
             	<input type="text" value="<?=$val['bus_fees'] ?>"   class="r_amount length" name='r_amount[]' id="r_amou"/>
            </td>
        </tr>
        
    <?php }} ?>
    <tr><?php $i=0 ;?>
                    	<td><input type="text" class='stage_name length' name='stage_name[]' id="stage_name"/></td>
                        <td><input type="text" class='r_amount length' name='r_amount[]' id="r_amou" /> </td>
                        <td><input type="button" value="+" class='add_row btn bg-purple btn-sm' id="dis" /></td>
                    </tr>
</table>
<table class="form_table">
<tr>
<td width="50%">&nbsp;</td>
<td><input type="button" value="Back" class="btn btn-danger" onclick="history.go(-1);return true;" >
<input type="button" value="Update" id="add_group" class="btn btn-primary submit" /></td></tr>
</table>
</div>

<div class="col-lg-6">
	<p>
      <input onclick="deleteMarkers();" type=button value="Delete Markers" class="btn btn-primary right">
    </p>
    <br />
    <div id="googleMap" style="width:100%;height:300px;"></div>
</div>
</div>
<div>

 </div>

 
</div>
<script type="text/javascript">
$(document).ready(function(){
		$('.add_row').click(function(){
			
		$('#last_row').clone().appendTo('#app_table');  	
		 });
		 
		 
		 $(".remove_comments").live('click',function(){
			$(this).closest("tr").remove();
	   });
	   
	   /* $("#master_ve").live("change",function()
  			{
         var master_ve=$(this).val();
			 $.ajax(
				 {
				  url:BASE_URL+"transport/search_bus_details",
				  type:'GET',
				  data:{ value1 : master_ve},
				  success:function(result)
				  {
					 $("#view").html(result);
				  }    		
			});
  	});*/
	
	 $("#add_group").click(function(){
		 
			 var master_ve=$('#master_ve').val();
			
			 var rname=$('#rname').val();
			 var stage_name=$('#stage_name').val();
			 var r_amou=$('#r_amou').val();
			 y_array='';
			 $('.stage_name').each(function(){
				 if($(this).val()!='')
				y_array=y_array+$(this).val()+',';
			 });
			 x_array='';
			 $('.r_amount').each(function(){
				 if($(this).val()!='')
				x_array=x_array+$(this).val()+',';
			 });
			 
			 //for_loading('Loading... Data add Please Wait '); // loading notification
			$.ajax({
			  url:BASE_URL+"transport/update_bus_root",
			  type:'GET',
			  data:{ 
						value1 : master_ve,
						value3 : rname,
						value4 : y_array,
						value5 : x_array,
						google_map : pos
				   },
			  success:function(result){
					$('#g_div').html(result);
					for_response('Successfully Add...!'); 
					if(result){
					 window.location.replace(BASE_URL+"transport/bus_root_details"); }// resutl notification
			     
			}
			});
			$('#master_ve').val('');
			$('.r_amount').each(function(){
				 if($(this).val()!='')
				x_array=x_array+$(this).val('');
			 });
			$('.stage_name').each(function(){
				 if($(this).val()!='')
				y_array=y_array+$(this).val('');
			 });
		 });
 });

</script>

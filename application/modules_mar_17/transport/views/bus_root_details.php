<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCh-M7d8j26a8npBocA0M7ybgOFzJ-Qv8I&sensor=false"></script>
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

    function initialize() {
        var haightAshbury = new google.maps.LatLng(11.00860051288406, 76.96609497070312);
        var mapOptions = {
            zoom: 15,
            center: haightAshbury,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('googleMap'),
                mapOptions);

// This event listener will call addMarker() when the map is clicked.
        google.maps.event.addListener(map, 'click', function (event) {
            addMarker(event.latLng);
        });

// Adds a marker at the center of the map.
        addMarker(haightAshbury);
    }
    i = 0;
// Add a marker to the map and push to the array.
    function addMarker(location) {
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });

        markers.push(marker);
        console.log(marker);
        pos[i] = marker.position.k + '_' + marker.position.B;
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
        pos = [];
    }

    google.maps.event.addDomListener(window, 'load', initialize);

</script>



<section class="content-header"><h3>Add Stages</h3></section>
<div>
    <table width="100%">
        <tr><td width="200">Bus No</td>
            <td>
                <select id='master_ve' name='master_ve'  class="master_ve mandatory master_root">
                    <option value="0">Select</option>
                    <?php
                    if (isset($details) && !empty($details)) {
                        foreach ($details as $val) {
                            ?>
                            <option value="<?= $val['id'] ?>"><?= $val['bus_no'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select><span id="v3" class="val" style="color:#F00;"></span>
            </td>
        </tr>
        <tr id="view">
        <input type="hidden" name="rname1" id="rname1" class="rname1" />
        <td  colspan="2"></td><input type='hidden'  name='srname1' class='srname1' id='srname1' /></td>
        </tr>
        <tr id="view_one">
            <td  colspan="2"></td><input type='hidden'  name='rname' class='rname' id='rname' /></td>
        </tr>
    </table>
    <table style="display:none;" >
        <tr id="last_row">
            <td></td>
            <td><input type="text" class='stage_name length left' name='stage_name[]' id="stage_name" />
                <input type="text" class='r_amount length left' name='r_amount[]' id="r_amou"  style="margin-left:10px;width:70px;"/><span id="v1" class="val" style="color:#F00;"></span>
                <input type="button" value="-" class='remove_comments btn bg-purple btn-sm' style="margin-left:10px; margin-top:5px;"/><span id="v2" class="val" style="color:#F00;"></span></td>
        </tr>
    </table>
    <table class="form_table" >

        <tr>
            <td style="padding:0">
                <table id='app_table'><?php $i = 0; ?>
                    <tr>
                        <td width="200">Stages and Amount / year</td>
                        <td>
                            <input type="text" class='stage_name length left' name='stage_name[]' id="stage_name" /><span id="v1" class="val" style="color:#F00;"></span>
                            <input type="text" class='r_amount length left' name='r_amount[]' id="r_amou" style="margin-left:10px;width:70px;"/><span id="v2" class="val" style="color:#F00;"></span>
                            <input type="button" value="+" class='add_row btn bg-purple btn-sm left' id="dis" style="margin-left:10px; margin-top:5px;"/>
                        </td>
                    </tr>
                </table>
                <span id="vald" style="color:#F00;"></span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table><span id="stagedup" class="stagedup" style="color:#F00;"></span>
    <table><tr><td width="200">&nbsp;</td><td><input type="button" value="Add" id="add_group" class="btn btn-primary submit" /></td>
        </tr></table>
</div>
<div>
    <div id="" style="margin-left:0px; padding-bottom:10px;">
        <input onclick="deleteMarkers();" type="button" value="Delete Markers" class="btn btn-primary right">
    </div>
    <br /><br />
    <div id="googleMap" style="width:100%;height:300px; alignment-adjust:auto"></div>
</div>
<?php ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.add_row').click(function () {
            $('#last_row').clone().appendTo('#app_table');
        });
        $("#add_group").click(function () {

            var master_ve = $('#master_ve').val();
            var rname1 = $('#rname1').val();
            var rname = $('#rname').val();
            var stage_name = $('#stage_name').val();
            var r_amou = $('#r_amou').val();
            //alert(rname1);exit;
            y_array = '';
            $('.stage_name').each(function () {
                if ($(this).val() != '')
                    y_array = y_array + $(this).val() + ',';
            });
            x_array = '';
            $('.r_amount').each(function () {
                if ($(this).val() != '')
                    x_array = x_array + $(this).val() + ',';
            });
            for_loading('Loading... Data add Please Wait '); // loading notification
            $.ajax({
                url: BASE_URL + "transport/insert_bus_root",
                type: 'GET',
                data: {
                    value1: master_ve,
                    value3: rname1,
                    value2: rname,
                    value4: y_array,
                    value5: x_array,
                    google_map: pos

                },
                success: function (result)
                {
                    $('#g_div').html(result);
                    //alert(result);
                    for_response('Successfully Add...!'); // resutl notification
                    if (result)
                    {

                        //window.location.replace(BASE_URL+"transport/bus_root_details");

                        // window.location.replace(BASE_URL+"transport/bus_root_details");

                    }// resutl not }// resutl notification

                }
            });
            var master_ve = $('#master_ve').val('');
            var rname = $('#rname').val('');
            var rname = $('#rname1').val('');
            $('.r_amount').each(function () {
                if ($(this).val() != '')
                    x_array = x_array + $(this).val('');
            });
            $('.stage_name').each(function () {
                if ($(this).val() != '')
                    y_array = y_array + $(this).val('');
                $(".remove_comments").live('click', function () {
                    $(this).closest("tr").remove();

                });
            });
        });
    });
    $(".remove_comments").live('click', function () {
        $(this).closest("tr").remove();

    });

</script>
<script type="text/javascript">
    $("#master_ve").live("change", function ()
    {
        //alert(master_ve);
        var master_ve = $(this).val();
        $.ajax(
                {
                    url: BASE_URL + "transport/search_bus_details",
                    type: 'GET',
                    data: {value1: master_ve},
                    success: function (result)
                    {
                        $("#view").html(result);
                    }
                });
    });
</script>



<script type="text/javascript">
    $("#rname1").live("change", function ()
    {
        //alert(master_ve);
        var rname1 = $(this).val();
        $.ajax(
                {
                    url: BASE_URL + "transport/search_bus_stage",
                    type: 'GET',
                    data: {value1: rname1},
                    success: function (result)
                    {
                        $("#view_one").html(result);
                    }
                });
    });
</script>




<script type="text/javascript">
//$(document).ready(function(){ $("#batch").focus(); });
    $(function () {
        $("#example1").dataTable();
        $("#example4").dataTable();
        $("#example ").dataTable();
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

    function removeSpaces(string) {
        return string.split(' ').join('');
    }
</script>
<br /><br />

<div id="g_div">
    <table width=" 100%" class="all my_table_style list_all table table-bordered table-striped " id="example3"><thead>
            <tr><th>S.No</th>
                <th>Bus No</th>
                <th>Route Name</th>
                <th>Source</th>
                <th>Bus Fees</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
<?php
$i = 1;
if (isset($master_details) && !empty($master_details)) {
    foreach ($master_details as $val) {
        ?>
                          <!--<input type="hidden" id="fee_id" class="upd_id value<?= $i ?>"  />-->
                    <tr><td width="10%"><?= $i; ?></td><td width="10%"><label><?= $val['bus_no'] ?><label></td>
                                    <td width="10%"><label><?= $val['root_name'] ?></label></td>
                                    <td width="10%"><label><?= $val['source'] ?></label></td>
                                    <td width="10%"><label><?= $val['bus_fees'] ?><label></td>
                                                <td width="10%">
                                                    <a href="<?= $this->config->item('base_url') . 'transport/view_transport/' . $val['master_root_id'] ?>" title="View" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                                                    <a href="<?= $this->config->item('base_url') . 'transport/update_transport_stage/' . $val['master_root_id'] ?>" title="Edit" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>

                                                </td>
                                                </tr>

        <?php
        $i++;
    }
}
?>
                                        </tbody>
                                        </table>
                                        </div>

                                        <div id="list">
                                        </div>



                                        <script type="text/javascript" language="JavaScript">
                                            $("#update").live('click', function ()
                                            {
                                                idno = ($(this).attr('class'));
                                                var splitNumber = idno.split('_');
                                                var id = splitNumber[1];
                                                $(".route_bus" + id).attr("disabled", false);
                                                $(".master" + id).attr("disabled", false);
                                                $(".route" + id).attr("disabled", false);
                                                $(".source" + id).attr("disabled", false);
                                                $(".stage_name" + id).attr("disabled", false);
                                                $(".bus_fees" + id).attr("disabled", false);
                                                $(".success_" + id).css("display", 'none');
                                                $(".up_" + id).css("display", 'block');
                                            });
                                            $("#add_update").live('click', function () {
                                                idno = ($(this).attr('class'));
                                                var splitNumber = idno.split('_');
                                                var id = splitNumber[1]; //console.log(id);
                                                var f_master = $(".master" + id).val();
                                                var f_route = $(".route" + id).val();
                                                var f_source = $(".source" + id).val();
                                                var f_stage_name = $(".stage_name" + id).val();
                                                var f_bus_fees = $(".bus_fees" + id).val();
                                                $.ajax(
                                                        {
                                                            url: BASE_URL + "transport/update_fees_name",
                                                            type: 'POST',
                                                            data: {value1: id, value2: f_master, value3: f_route, value4: f_source, value5: f_stage_name, value6: f_bus_fees},
                                                            success: function (result) {
                                                                $("#list").html(result);
                                                                for_response_del('Data Delete Successfully...!'); // resutl notification
                                                            }
                                                        });
                                                $(".route_bus" + id).attr("disabled", true);
                                                $(".status" + id).attr("disabled", true);
                                                $(".success_" + id).css("display", 'block');
                                                $(".up_" + id).css("display", 'none');
                                            });

                                            //stage duplication
                                            $(".rname1").live('change', function ()
                                            {
                                                //alert("hi");
                                                busno = $("#master_ve").val();
                                                rootname = $("#rname1").val();
                                                //alert(busno);


                                                $.ajax(
                                                        {
                                                            url: BASE_URL + "transport/add_duplicate_stage",
                                                            type: 'POST',
                                                            data: {value1: busno, value2: rootname},
                                                            success: function (result)
                                                            {

                                                                $("#stagedup").html(result);
                                                                len = ((result + '').length);
                                                                if (len > 2) {
                                                                    $("#add_group").attr("disabled", true);
                                                                } else {
                                                                    $("#add_group").attr("disabled", false);
                                                                }

                                                            }
                                                        });
                                            });

                                        </script>




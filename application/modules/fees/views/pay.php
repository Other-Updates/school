<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<table>
    <tr>
        <td width="110">Student Roll No:</td>
        <td >
            <input type="text" style="float:left"name="rol_no" id="roll_no" autocomplete="off" style="width:150px"/>

            <input type="button" style="float:left;margin-left:10px; padding: 4px 10px;" id='view_std' class="btn bg-maroon" value='View' />
            <br /><br /><span id="ro1" style="color:#F00;"></span> </td>
    </tr>
</table>
<div id='full_info'></div>

<script type="text/javascript">
    $('.print_btn').live('click', function () {
        f_arr = $(this).attr('id').split("_");
        fees_info_id = f_arr[2];
        roll_no = $('#roll_no_' + f_arr[2]).val();
        exam_type = $('#exam_type_' + f_arr[2]).val();
        window.open(
                BASE_URL + 'fees/fees_details/' + fees_info_id + '/' + roll_no + '/' + exam_type, 'Fees Deatails', 'height=500,width=450,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes');
    });
    $().ready(function () {
        $("#roll_no").autocomplete(BASE_URL + "fees/get_student_list", {
            width: 260,
            autoFocus: true,
            matchContains: true,
            selectFirst: false
        });
    });
    $('#view_std').live('click', function () {

        //test();

        var i = 0;
        var roll_no = $("#roll_no").val();
        var filter = /[^-\s][a-zA-Z0-9-_\\s]+$/;
        if (roll_no == "")
        {
            $("#ro1").html("Enter Student Roll No");
            i = 1;
        } else if (!filter.test(roll_no))
        {
            $("#ro1").html("Enter Valid Roll No");
            i = 1;
        } else
        {
            $("#ro1").html("");
        }
        if (i == 0)
        {

            $.ajax({
                url: BASE_URL + "fees/view_student_fees",
                type: 'POST',
                data: {
                    roll_no: $('#roll_no').val(),
                },
                success: function (result) {
                    $('#full_info').html(result);
                }
            });
        }
    });
    $('.payment_mode').live('change', function () {
        f_arr = $(this).attr('id').split("_");
        $('#pay_btn_' + f_arr[2]).css('display', 'block');
        $('#com_btn_' + f_arr[2]).css('display', 'none');
        $('#pay_1btn_' + f_arr[2]).css('display', 'block');
        $('#com_1btn_' + f_arr[2]).css('display', 'none');
        $('#pay_bank_' + f_arr[2]).val('');
        $('#pay_branch_' + f_arr[2]).val('');
        $('#pay_cheque_' + f_arr[2]).val('');
        if ($(this).val() == '1')
        {
            $('#p_amt_' + f_arr[2]).css('display', 'block');
            $('#pay_amt_' + f_arr[2]).addClass('mandatory');

            $('#pay_bank_' + f_arr[2]).removeClass('mandatory');
            $('#pay_branch_' + f_arr[2]).removeClass('mandatory');
            $('#pay_1amt_' + f_arr[2]).removeClass('mandatory');
            $('#pay_cheque_' + f_arr[2]).removeClass('mandatory');

            $('#p_del_' + f_arr[2]).css('display', 'none');
            $('#pay_1amt_' + f_arr[2]).val('');

            $('#bal_1amt_' + f_arr[2]).val(Number($('#ful_amt_' + f_arr[2]).val()) - Number($('#paid_amt_' + f_arr[2]).val()));

        } else if ($(this).val() == '2' || $(this).val() == '3')
        {
            $('#p_amt_' + f_arr[2]).css('display', 'none');
            $('#p_del_' + f_arr[2]).css('display', 'block');

            $('#pay_amt_' + f_arr[2]).removeClass('mandatory');

            $('#pay_bank_' + f_arr[2]).addClass('mandatory');
            $('#pay_branch_' + f_arr[2]).addClass('mandatory');
            $('#pay_1amt_' + f_arr[2]).addClass('mandatory');
            $('#pay_cheque_' + f_arr[2]).addClass('mandatory');

            $('#pay_amt_' + f_arr[2]).val('');
            $('#bal_amt_' + f_arr[2]).val(Number($('#ful_amt_' + f_arr[2]).val()) - Number($('#paid_amt_' + f_arr[2]).val()));
        } else
        {
            $('#p_amt_' + f_arr[2]).css('display', 'none');
            $('#p_del_' + f_arr[2]).css('display', 'none');
        }
    });
    $('.pay_amt').live('keyup', function () {
        f_arr = $(this).attr('id').split("_");
        ful_amt = $('#ful_amt_' + f_arr[2]).val();
        paid_amt = $('#paid_amt_' + f_arr[2]).val();
        $('#bal_amt_' + f_arr[2]).val((Number(ful_amt) - Number(paid_amt)) - Number($(this).val()));
        if (Number($('#bal_amt_' + f_arr[2]).val()) == 0)
        {
            $('#pay_btn_' + f_arr[2]).css('display', 'none');
            $('#com_btn_' + f_arr[2]).css('display', 'block');
            $(this).css('border-color', '');
        } else if (Number($('#bal_amt_' + f_arr[2]).val()) < 0)
        {
            $(this).css('border-color', 'red');
            $('#pay_btn_' + f_arr[2]).css('display', 'none');
            $('#com_btn_' + f_arr[2]).css('display', 'none');
        } else if (Number($('#bal_amt_' + f_arr[2]).val()) > 0)
        {
            $(this).css('border-color', '');
            $('#pay_btn_' + f_arr[2]).css('display', 'block');
            $('#com_btn_' + f_arr[2]).css('display', 'none');
        }
        //$('#p_del_'+f_arr[2]).css('display','none');
    });
    $('.pay_1amt').live('keyup', function () {
        f_arr = $(this).attr('id').split("_");
        ful_amt = $('#ful_amt_' + f_arr[2]).val();
        paid_amt = $('#paid_amt_' + f_arr[2]).val();
        $('#bal_1amt_' + f_arr[2]).val((Number(ful_amt) - Number(paid_amt)) - Number($(this).val()));
        if (Number($('#bal_1amt_' + f_arr[2]).val()) == 0)
        {
            $('#pay_1btn_' + f_arr[2]).css('display', 'none');
            $('#com_1btn_' + f_arr[2]).css('display', 'block');
            $(this).css('border-color', '');
        } else if (Number($('#bal_1amt_' + f_arr[2]).val()) < 0)
        {
            $(this).css('border-color', 'red');
            $('#pay_1btn_' + f_arr[2]).css('display', 'none');
            $('#com_1btn_' + f_arr[2]).css('display', 'none');
        } else if (Number($('#bal_1amt_' + f_arr[2]).val()) > 0)
        {
            $(this).css('border-color', '');
            $('#pay_1btn_' + f_arr[2]).css('display', 'block');
            $('#com_1btn_' + f_arr[2]).css('display', 'none');
        }
        //$('#p_del_'+f_arr[2]).css('display','none');
    });
    $('.pay_btn').live('click', function () {
        f_arr = $(this).attr('id').split("_");

        var re = 0;
        $('#ex_div_' + f_arr[2]).find('.mandatory').each(function ()
        {
            if ($(this).val() == '' || $(this).val() == null || $(this).val().trim().length == 0 || $(this).val() == '.' || $(this).val() == ',')
            {
                $(this).css('border', '1px solid red');
                alert($(this).attr('id'));
                re = 1;
            } else {
                $(this).css('border', '1px solid #CCCCCC');
            }

        });
        if (re == 0)
        {
            for_loading('Loading... Data add Please Wait '); // loading notification
            $.ajax({
                url: BASE_URL + "fees/insert_fees",
                type: 'POST',
                data: {
                    fees_info_id: f_arr[2],
                    roll_no: $('#roll_no_' + f_arr[2]).val(),
                    payment_mode: $('#p_mode_' + f_arr[2]).val(),
                    amount: $('#pay_amt_' + f_arr[2]).val(),
                    c_amount: $('#pay_1amt_' + f_arr[2]).val(),
                    bank_name: $('#pay_bank_' + f_arr[2]).val(),
                    barch: $('#pay_branch_' + f_arr[2]).val(),
                    cheque_no: $('#pay_cheque_' + f_arr[2]).val(),
                    edit_amt: Number($('#edit_amt_' + f_arr[2]).val()),
                    edit_text: $('#edit_text_' + f_arr[2]).val(),
                    exam_type: $('#exam_type_' + f_arr[2]).val()
                },
                success: function (result) {
                    $('#full_info').html('');
                    $('#full_info').html(result);
                    for_response('Successfully Add...!'); // resutl notification
                }
            });
        }
    });
    $('.com_pay').live('click', function () {
        f_arr = $(this).attr('id').split("_");
        var re = 0;
        $('#ex_div_' + f_arr[2]).find('.mandatory').each(function ()
        {
            if ($(this).val() == '' || $(this).val() == null || $(this).val().trim().length == 0 || $(this).val() == '.' || $(this).val() == ',')
            {
                $(this).css('border', '1px solid red');
                alert($(this).attr('id'));
                re = 1;
            } else {
                $(this).css('border', '1px solid #CCCCCC');
            }

        });
        if (re == 0)
        {
            for_loading('Loading... Data add Please Wait '); // loading notification
            $.ajax({
                url: BASE_URL + "fees/insert_fees1",
                type: 'POST',
                data: {
                    fees_info_id: f_arr[2],
                    roll_no: $('#roll_no_' + f_arr[2]).val(),
                    payment_mode: $('#p_mode_' + f_arr[2]).val(),
                    amount: $('#pay_amt_' + f_arr[2]).val(),
                    c_amount: $('#pay_1amt_' + f_arr[2]).val(),
                    bank_name: $('#pay_bank_' + f_arr[2]).val(),
                    barch: $('#pay_branch_' + f_arr[2]).val(),
                    cheque_no: $('#pay_cheque_' + f_arr[2]).val(),
                    edit_amt: Number($('#edit_amt_' + f_arr[2]).val()),
                    edit_text: $('#edit_text_' + f_arr[2]).val(),
                    exam_type: $('#exam_type_' + f_arr[2]).val()
                },
                success: function (result) {
                    $('#full_info').html('');
                    $('#full_info').html(result);
                    for_response('Successfully Add...!'); // resutl notification
                }
            });
        }
    });
    i = 0;
    $('.edit_btn').live('click', function () {
        f_arr = $(this).attr('id').split("_");

        if (i == 0)
        {
            $('#edit_amt_' + f_arr[2]).css('display', 'block');
            $('#edit_text_' + f_arr[2]).css('display', 'block');
            $('#edit_amt_' + f_arr[2]).addClass('mandatory');
            $('#edit_text_' + f_arr[2]).addClass('mandatory');
            i = 1;
        } else
        {
            $('#fulamt_text_' + f_arr[2]).html(Number($('#ful_fine_' + f_arr[2]).html()) + Number($('#bill_amt_' + f_arr[2]).val()));
            $('#ful_amt_' + f_arr[2]).val(Number($('#ful_fine_' + f_arr[2]).html()) + Number($('#bill_amt_' + f_arr[2]).val()));

            $('#bal_1amt_' + f_arr[2]).val(Number($('#ful_amt_' + f_arr[2]).val()) - Number($('#paid_amt_' + f_arr[2]).val()));
            $('#bal_amt_' + f_arr[2]).val(Number($('#ful_amt_' + f_arr[2]).val()) - Number($('#paid_amt_' + f_arr[2]).val()));

            $('#edit_amt_' + f_arr[2]).css('display', 'none');
            $('#edit_text_' + f_arr[2]).css('display', 'none');
            $('#edit_amt_' + f_arr[2]).removeClass('mandatory');
            $('#edit_text_' + f_arr[2]).removeClass('mandatory');
            $('#edit_amt_' + f_arr[2]).val('');
            $('#edit_text_' + f_arr[2]).val('');
            i = 0;
        }

    });
    j = 0;
    $('.edit_btn1').live('click', function () {
        f_arr = $(this).attr('id').split("_");

        if (j == 0)
        {
            $('#edit_amt_' + f_arr[2]).css('display', 'block');
            $('#edit_text_' + f_arr[2]).css('display', 'block');
            j = 1;
        } else
        {
            $('#fulamt_text_' + f_arr[2]).html(Number($('#ful_fine_' + f_arr[2]).html()) + Number($('#bill_amt_' + f_arr[2]).val()));
            $('#ful_amt_' + f_arr[2]).val(Number($('#ful_fine_' + f_arr[2]).html()) + Number($('#bill_amt_' + f_arr[2]).val()));

            $('#bal_1amt_' + f_arr[2]).val(Number($('#ful_amt_' + f_arr[2]).val()) - Number($('#paid_amt_' + f_arr[2]).val()));
            $('#bal_amt_' + f_arr[2]).val(Number($('#ful_amt_' + f_arr[2]).val()) - Number($('#paid_amt_' + f_arr[2]).val()));

            $('#edit_amt_' + f_arr[2]).css('display', 'none');
            $('#edit_text_' + f_arr[2]).css('display', 'none');
            $('#edit_amt_' + f_arr[2]).val('');
            $('#edit_text_' + f_arr[2]).val('');
            j = 0;
        }

    });
    $('.edit_amt').live('keyup', function () {
        f_arr = $(this).attr('id').split("_");
        $('#fulamt_text_' + f_arr[2]).html(Number($('#ful_fine_' + f_arr[2]).html()) + Number($(this).val()));
        $('#ful_amt_' + f_arr[2]).val(Number($('#ful_fine_' + f_arr[2]).html()) + Number($(this).val()));
        $('#p_mode_' + f_arr[2]).val('');

        $('#bal_1amt_' + f_arr[2]).val(Number($('#ful_amt_' + f_arr[2]).val()) - Number($('#paid_amt_' + f_arr[2]).val()));
        $('#bal_amt_' + f_arr[2]).val(Number($('#ful_amt_' + f_arr[2]).val()) - Number($('#paid_amt_' + f_arr[2]).val()));

        $('#p_amt_' + f_arr[2]).css('display', 'none');

        $('#pay_1amt_' + f_arr[2]).val('');
        $('#pay_amt_' + f_arr[2]).val('');

        $('#p_del_' + f_arr[2]).css('display', 'none');
    });
    $('.edit_amt1').live('keyup', function () {
        f_arr = $(this).attr('id').split("_");
        $('#fulamt_text_' + f_arr[2]).html(Number($('#ful_fine_' + f_arr[2]).html()) + Number($(this).val()));
        $('#ful_amt_' + f_arr[2]).val(Number($('#ful_fine_' + f_arr[2]).html()) + Number($(this).val()));

        $('#bal_1amt_' + f_arr[2]).val(Number($('#ful_amt_' + f_arr[2]).val()) - Number($('#paid_amt_' + f_arr[2]).val()));
        $('#bal_amt_' + f_arr[2]).val(Number($('#ful_amt_' + f_arr[2]).val()) - Number($('#paid_amt_' + f_arr[2]).val()));

        $('#pay_1amt_' + f_arr[2]).val('');
        $('#pay_amt_' + f_arr[2]).val('');
        $('#p_mode_' + f_arr[2]).val('');
        $('#p_amt_' + f_arr[2]).css('display', 'none');
        $('#p_del_' + f_arr[2]).css('display', 'none');

    });

</script>

<!--<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>Google Maps Multiple Markers</title>
        <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.1.min.js"></script>
    </head>
    <body>
        <div id="map" style="width: 500px; height: 400px;"></div>

        <script type="text/javascript">
          // Define your locations: HTML content for the info window, latitude, longitude
          function test()
          {
              var locations = [
                  ['<h4>Bondi Beach</h4>', -33.890542, 151.274856],
                  ['<h4>Coogee Beach</h4>', -33.923036, 151.259052],
                  ['<h4>Cronulla Beach</h4>', -34.028249, 151.157507],
                  ['<h4>Manly Beach</h4>', -33.80010128657071, 151.28747820854187],
                  ['<h4>Maroubra Beach</h4>', -33.950198, 151.259302]
              ];

              // Setup the different icons and shadows
              var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';

              var icons = [
                  iconURLPrefix + 'red-dot.png',
                  iconURLPrefix + 'green-dot.png',
                  iconURLPrefix + 'blue-dot.png',
                  iconURLPrefix + 'orange-dot.png',
                  iconURLPrefix + 'purple-dot.png',
                  iconURLPrefix + 'pink-dot.png',
                  iconURLPrefix + 'yellow-dot.png'
              ]
              var icons_length = icons.length;


              var shadow = {
                  anchor: new google.maps.Point(15, 33),
                  url: iconURLPrefix + 'msmarker.shadow.png'
              };

              var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 10,
                  center: new google.maps.LatLng(-37.92, 151.25),
                  mapTypeId: google.maps.MapTypeId.ROADMAP,
                  mapTypeControl: false,
                  streetViewControl: false,
                  panControl: false,
                  zoomControlOptions: {
                      position: google.maps.ControlPosition.LEFT_BOTTOM
                  }
              });

              var infowindow = new google.maps.InfoWindow({
                  maxWidth: 160
              });

              var marker;
              var markers = new Array();

              var iconCounter = 0;

              // Add the markers and infowindows to the map
              for (var i = 0; i < locations.length; i++) {
                  marker = new google.maps.Marker({
                      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                      map: map,
                      icon: icons[iconCounter],
                      shadow: shadow
                  });

                  markers.push(marker);

                  google.maps.event.addListener(marker, 'click', (function (marker, i) {
                      return function () {
                          infowindow.setContent(locations[i][0]);
                          infowindow.open(map, marker);
                      }
                  })(marker, i));

                  iconCounter++;
                  // We only have a limited number of possible icon colors, so we may have to restart the counter
                  if (iconCounter >= icons_length) {
                      iconCounter = 0;
                  }
              }

              function AutoCenter() {
                  //  Create a new viewpoint bound
                  var bounds = new google.maps.LatLngBounds();
                  //  Go through each...
                  $.each(markers, function (index, marker) {
                      bounds.extend(marker.position);
                  });
                  //  Fit these bounds to the map
                  map.fitBounds(bounds);
              }
              AutoCenter();
          }
        </script>
    </body>
</html>||||||| .r1779
</script>=======
</script>
<script>
$("#roll_no").live('blur',function()
{
        var roll_no=$("#roll_no").val();
        var filter=/[^-\s][a-zA-Z0-9-_\\s]+$/;
        if(roll_no=="")
        {
                $("#ro1").html("Enter Student Roll No");
        }
        else if(!filter.test(roll_no))
        {
                $("#ro1").html("Only Numeric Alphanumeric");
        }
        else
        {
                $("#ro1").html("");
        }
});
</script>>>>>>>> .r2968-->


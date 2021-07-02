<script>
    function validate()
    {
	var i = 0;

	$('.required').each(function () {
	    var id = $(this).attr('id');
	    if ($(this).val() == '' && $(this).attr('disabled') != 'disabled')
	    {
		i = 1;
		//$(this).closest('td').find('.error').text('Field Required');
		$(this).css('border', '1px solid red')
	    } else {
		$(this).css('border', '');
	    }

	});

	if (i == 1)
	{

	    return false;
	} else
	{
	    for_loading('Adding Leave...!');
	    return true;
	}


    }
</script>
<div class="add_staff">
    <?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
    <form method="post" action="<?php echo $this->config->item('base_url') . 'leave/update_leave/' . $leave[0]['id']; ?>"  enctype="multipart/form-data" >
	<table class="staff_table">
	    <tr>
		<td>Leave Duration</td>
		<td><select name="leave_duration" id="leave_duration" class="form-control"  tabindex="1">
			<option value="">Select</option>
			<option value="1" <?php echo ($leave[0]['leave_duration'] == 1) ? 'selected="selected"' : ''; ?>>Half Day Leave</option>
			<option value="2" <?php echo ($leave[0]['leave_duration'] == 2) ? 'selected="selected"' : ''; ?>>Full Day Leave</option>
			<option value="3" <?php echo ($leave[0]['leave_duration'] == 3) ? 'selected="selected"' : ''; ?>>Permission</option>
		    </select>
		    <span id="v1" class="val" style="color:#F00;"></span></td>
		<td>Leave Type</td>
		<td>
		    <select name="leave_type" id="leave_type" class="form-control"  tabindex="2">
			<option value="">Select</option>
			<option value="1" <?php echo ($leave[0]['leave_type'] == 1) ? 'selected="selected"' : ''; ?>>Casual Leave (CL)</option>
			<option value="2" <?php echo ($leave[0]['leave_type'] == 2) ? 'selected="selected"' : ''; ?>>Seek Leave (SL)</option>
			<option value="3" <?php echo ($leave[0]['leave_type'] == 3) ? 'selected="selected"' : ''; ?>>Others</option>
		    </select>
		    <span id="v2" class="val" style="color:#F00;"></span></td>

	    </tr>
	    <tr class="leave_section">
		<td style="vertical-align:top">Leave From</td>
		<td><input type="text"  class=' ' name='from_date' value="<?php echo ($leave[0]['from_date']) ? date('d-m-Y', strtotime($leave[0]['from_date'])) : ''; ?>" id="from_date" tabindex="3" />
		    <span id="v3" class="val" style="color:#F00;"></span></td>
		<td style="vertical-align:top">Leave To</td>
		<td><input type="text"  class=' ' name='to_date' value="<?php echo ($leave[0]['to_date']) ? date('d-m-Y', strtotime($leave[0]['to_date'])) : ''; ?>" id="to_date" tabindex="4" />
		    <span id="v4" class="val" style="color:#F00;"></span></td>
	    </tr>
	    <tr class="permission_section" style="display: none">
		<td style="vertical-align:top">Permission From</td>
		<td><input type="text"  class=' ' name='from_date' value="<?php echo ($leave[0]['from_date']) ? date('d-m-Y H:i', strtotime($leave[0]['from_date'])) : ''; ?>" id="from_time" tabindex="5" />
		    <span id="v5" class="val" style="color:#F00;"></span></td>
		<td style="vertical-align:top">Permission To</td>
		<td><input type="text"  class='' name='to_date' value="<?php echo ($leave[0]['to_date']) ? date('d-m-Y H:i', strtotime($leave[0]['to_date'])) : ''; ?>" id="to_time" tabindex="6" />
		    <span id="v5" class="val" style="color:#F00;"></span></td>
	    </tr>
	    <tr class="session_section" style="display: none">
		<td>Session</td>
		<td>
		    <select name="session" id="session" class="form-control" tabindex="7">
			<option value="">Select</option>
			<option value="1" <?php echo ($leave[0]['session'] == 1) ? 'selected="selected"' : ''; ?>>Forenoon (FN)</option>
			<option value="2" <?php echo ($leave[0]['session'] == 2) ? 'selected="selected"' : ''; ?>>Afternoon (AN)</option>
		    </select>
		    <span style="color:red;" id="error_staffid"></span>
		    <span id="v4" class="val" style="color:#F00;"></span> </td>
		<td></td>
		<td></td>

	    </tr>
	    <tr>
		<td>Reason</td>
		<td colspan="3"><textarea tabindex="8" name="reason" id="reason" class="form-control" placeholder="Reason"><?php echo ($leave[0]['reason']) ? $leave[0]['reason'] : ''; ?></textarea><span id="v5" class="val" style="color:#F00;"></span></td>
		<td></td>
		<td></td>
	    </tr>

	</table>

	<br />

	<br />
	<input type="reset" value="Cancel" class="btn btn-danger" id="cancel" style="float:left"/>
	<div class="right">&nbsp;<input type="submit" value="submit" class="btn btn-primary"/></div>
	<br /><br />
    </form>

</div>
<script type="text/javascript">
    $(document).ready(function () {
	/* $("#from_date").datepicker({
	 format: 'dd/mm/yyyy',
	 startDate: "+0d",
	 autoclose: true,
	 }).on('changeDate', function (selected) {
	 var startDate = new Date(selected.date.valueOf());
	 $('#to_date').datepicker('setStartDate', startDate);
	 }).on('clearDate', function (selected) {
	 $('#to_date').datepicker('setStartDate', null);
	 });

	 $("#to_date").datepicker({
	 format: 'dd/mm/yyyy',
	 startDate: "+0d",
	 autoclose: true,
	 }).on('changeDate', function (selected) {
	 var endDate = new Date(selected.date.valueOf());
	 $('#from_date').datepicker('setEndDate', endDate);
	 }).on('clearDate', function (selected) {
	 $('#from_date').datepicker('setEndDate', null);
	 });*/
	var dateToday = new Date();
	// $('.leave_section').find('#from_date').datepicker({format: 'dd/mm/yyyy', startDate: '-1w'});
	// $('.leave_section').find('#to_date').datepicker({format: 'dd/mm/yyyy', startDate: '-1w'});

	$('.leave_section').find('#from_date').datetimepicker({
	    format: 'd-m-Y',
	    timepicker: false,
	    startDate: "+0d"
	});
	$('.leave_section').find('#to_date').datetimepicker({
	    format: 'd-m-Y',
	    timepicker: false,
	    startDate: "+0d"
	});
	$("#from_date_icon").click(function () {
	    $("#from_date").datetimepicker("show");
	    $('.leave_section').find('#from_date').datetimepicker({
		format: 'd-m-Y',
		startDate: "+0d"
	    });
	});
	$("#to_date_icon").click(function () {
	    $("#to_date").datepicker("show");
	    $('.leave_section').find('#to_date').datetimepicker({
		format: 'd-m-Y',
		startDate: "+0d"
	    });
	});
	$("#from_time_icon").click(function () {
	    $("#from_time").datetimepicker("show");
	});
	$("#to_time_icon").click(function () {
	    $("#to_time").datetimepicker("show");
	});
	$('#leave_duration').change(function () {
	    leave_duration = $('#leave_duration').val();
	    if (leave_duration == 1) {
		$('.session_section').show();
		$('.session_section').find('input').removeAttr('disabled');
	    } else {
		$('.session_section').find('input').attr('disabled', 'disabled');
		$('.session_section').hide();
	    }
	    if (leave_duration == 1 || leave_duration == 2) {
		if (leave_duration == 1) {
		    $('.leave_section').show();
		    $('.leave_section').find('input').val('').removeAttr('disabled');
		    $('.leave_section').find('#from_date').datetimepicker({
			format: 'd-m-Y',
			autoclose: true,
			startDate: '-1w',
			timepicker: false,
		    });
		    $('.leave_section').find('#to_date').datetimepicker("remove");
		    $('.permission_section').find('#from_time').datetimepicker('remove');
		    $('.permission_section').find('#to_time').datetimepicker('remove');
		    $('.permission_section').find('input').attr('disabled', 'disabled');
		    $('.permission_section').hide();
		} else {
		    $('.leave_section').show();
		    $('.leave_section').find('input').val('').removeAttr('disabled');
		    $('.leave_section').find('#from_date').datetimepicker({
			format: 'd-m-Y',
			autoclose: true,
			timepicker: false,
			startDate: '-1w'
		    }).on('changeDate', function (selected) {
			var minDate = new Date(selected.date.valueOf());
			$('#to_date').datepicker('setStartDate', minDate);
		    });
		    $('.leave_section').find('#to_date').datepicker({
			format: 'dd-mm-yyyy',
			timepicker: false,
			autoclose: true
		    });
		    $('.permission_section').find('#from_time').datetimepicker('remove');
		    $('.permission_section').find('#to_time').datetimepicker('remove');
		    $('.permission_section').find('input').attr('disabled', 'disabled');
		    $('.permission_section').hide();
		}
	    } else {
		$('.leave_section').find('#from_date').datetimepicker('remove');
		$('.leave_section').find('#to_date').datetimepicker('remove');
		$('.leave_section').find('input').attr('disabled', 'disabled');
		$('.leave_section').hide();
		$('.permission_section').show();
		$('.permission_section').find('input').val('').removeAttr('disabled');
		$('.permission_section').find('#from_time').datetimepicker({
		    datepicker: true,
		    timepicker: true,
		    format: 'd-m-Y H:i',
		    allowTimes: ['00:15', '00:30', '00:45', '01:00', '01:15', '01:30', '01:45', '02:00', '02:15', '02:30', '02:45', '03:00', '03:15', '03:30', '03:45', '04:00', '04:15', '04:30', '04:45', '04:00', '05:15', '05:30', '05:45', '05:00', '05:15', '05:30', '05:45', '06:00', '06:15', '06:30', '06:45', '07:00', '07:15', '07:30', '07:45', '08:00', '08:15', '08:30', '08:45', '09:00', '09:15', '09:30', '09:45', '10:00', '10:15', '10:30', '10:45', '11:00', '11:15', '11:30', '11:45', '12:00', '12:15', '12:30', '12:45', '13:00', '13:15', '13:30', '13:45', '14:00', '14:15', '14:30', '14:45', '15:00', '15:15', '15:30', '15:45', '16:00', '16:15', '16:30', '16:45', '17:00', '17:15', '17:30', '17:45', '17:00', '18:15', '18:30', '18:45', '19:00', , '19:15', '19:30', '19:45', '20:00', '20:15', '20:30', '20:45', '21:00', '21:15', '21:30', '21:45', '22:00', '22:15', '22:30', '22:45', '23:00'
		    ],
		    startdate: new Date(),
		    enddate: '+1w'
		}).on('changeDate', function (ev) {
		    var date = ev.date;
		    /*var datefrom = date.getDate();
		     var monthfrom = date.getMonth() + 1;
		     var yearfrom = date.getFullYear();
		     var start_format = yearfrom + '-' + monthfrom + '-' + datefrom + ' ' + date.getUTCHours() + ':' + date.getUTCMinutes() + ':00';
		     var end_format = yearfrom + '-' + monthfrom + '-' + datefrom + ' ' + (date.getUTCHours() + 2) + ':' + (date.getUTCMinutes() + 0) + ':59';
		     var startdate = new Date(start_format);
		     var enddate = new Date(end_format);
		     $('#to_time').datetimepicker('setStartDate', startdate);
		     $('#to_time').datetimepicker('setEndDate', enddate);*/
		    $('#to_time').data("DateTimePicker").minDate(date);
		});
		$('.permission_section').find('#to_time').datetimepicker({
		    datepicker: true,
		    timepicker: true,
		    format: 'd-m-Y H:i',
		    allowTimes: ['00:15', '00:30', '00:45', '01:00', '01:15', '01:30', '01:45', '02:00', '02:15', '02:30', '02:45', '03:00', '03:15', '03:30', '03:45', '04:00', '04:15', '04:30', '04:45', '04:00', '05:15', '05:30', '05:45', '05:00', '05:15', '05:30', '05:45', '06:00', '06:15', '06:30', '06:45', '07:00', '07:15', '07:30', '07:45', '08:00', '08:15', '08:30', '08:45', '09:00', '09:15', '09:30', '09:45', '10:00', '10:15', '10:30', '10:45', '11:00', '11:15', '11:30', '11:45', '12:00', '12:15', '12:30', '12:45', '13:00', '13:15', '13:30', '13:45', '14:00', '14:15', '14:30', '14:45', '15:00', '15:15', '15:30', '15:45', '16:00', '16:15', '16:30', '16:45', '17:00', '17:15', '17:30', '17:45', '17:00', '18:15', '18:30', '18:45', '19:00', , '19:15', '19:30', '19:45', '20:00', '20:15', '20:30', '20:45', '21:00', '21:15', '21:30', '21:45', '22:00', '22:15', '22:30', '22:45', '23:00'
		    ],
		    pickSeconds: true,
		    autoclose: true
		});
	    }
	});
	/*$('#from_time').on('dp.change', function (e) {
	 var formatedValue = e.date.format(e.date._f);
	 console.log(formatedValue);
	 var date2 = $('#from_time').val();
	 //var date2 = formatedValue;

	 var date = moment(date2, "DD/MM/YYYY HH:mm:ss").format("YYYY-MM-DD HH:mm:ss");
	 var date1 = moment.utc(date).add(2, 'hours').format("YYYY-MM-DD HH:mm:ss");
	 var to_time = moment(date1, "YYYY-MM-DD H:mm:ss").format("DD/MM/YYYY HH:mm:s");
	 $('#to_time').val(to_time);
	 })*/

	$('.permission_section').find('#from_time').datetimepicker({
	    datepicker: true,
	    timepicker: true,
	    format: 'd-m-Y H:i',
	    allowTimes: ['00:15', '00:30', '00:45', '01:00', '01:15', '01:30', '01:45', '02:00', '02:15',
		'02:30', '02:45', '03:00', '03:15', '03:30', '03:45', '04:00', '04:15', '04:30', '04:45',
		'04:00', '05:15', '05:30', '05:45', '05:00', '05:15', '05:30', '05:45', '06:00', '06:15',
		'06:30', '06:45', '07:00', '07:15', '07:30', '07:45', '08:00', '08:15', '08:30', '08:45',
		'09:00', '09:15', '09:30', '09:45', '10:00', '10:15', '10:30', '10:45', '11:00', '11:15',
		'11:30', '11:45', '12:00', '12:15', '12:30', '12:45', '13:00', '13:15', '13:30', '13:45',
		'14:00', '14:15', '14:30', '14:45', '15:00', '15:15', '15:30', '15:45', '16:00', '16:15',
		'16:30', '16:45', '17:00', '17:15', '17:30', '17:45', '17:00', '18:15', '18:30', '18:45',
		'19:00', , '19:15', '19:30', '19:45', '20:00', '20:15', '20:30', '20:45', '21:00', '21:15',
		'21:30', '21:45', '22:00', '22:15', '22:30', '22:45', '23:00'
	    ],
	    autoclose: true,
	    startDate: new Date(),
	    endDate: '+1w'
	}).on('dp.change', function (ev) {
	    var date = ev.date;
	    //alert(date);
	    /*var datefrom = date.getDate();
	     var monthfrom = date.getMonth() + 1;
	     var yearfrom = date.getFullYear();
	     var start_format = yearfrom + '-' + monthfrom + '-' + datefrom + ' ' + date.getUTCHours() + ':' + date.getUTCMinutes() + ':00';
	     var end_format = yearfrom + '-' + monthfrom + '-' + datefrom + ' ' + (date.getUTCHours() + 2) + ':' + (date.getUTCMinutes() + 0) + ':59';
	     var startdate = new Date(start_format);
	     var enddate = new Date(end_format);*/
	    //$('#to_time').datetimepicker('setStartDate', startdate);
	    $('#to_time').data("DateTimePicker").minDate(date);
	    //$('#to_time').val(to_time);


	});
	$('.permission_section').find('#to_time').datetimepicker({
	    datepicker: true,
	    timepicker: true,
	    format: 'd-m-Y H:i',
	    allowTimes: ['00:15', '00:30', '00:45', '01:00', '01:15', '01:30', '01:45', '02:00', '02:15', '02:30', '02:45', '03:00', '03:15', '03:30', '03:45', '04:00', '04:15', '04:30', '04:45', '04:00', '05:15', '05:30', '05:45', '05:00', '05:15', '05:30', '05:45', '06:00', '06:15', '06:30', '06:45', '07:00', '07:15', '07:30', '07:45', '08:00', '08:15', '08:30', '08:45', '09:00', '09:15', '09:30', '09:45', '10:00', '10:15', '10:30', '10:45', '11:00', '11:15', '11:30', '11:45', '12:00', '12:15', '12:30', '12:45', '13:00', '13:15', '13:30', '13:45', '14:00', '14:15', '14:30', '14:45', '15:00', '15:15', '15:30', '15:45', '16:00', '16:15', '16:30', '16:45', '17:00', '17:15', '17:30', '17:45', '17:00', '18:15', '18:30', '18:45', '19:00', , '19:15', '19:30', '19:45', '20:00', '20:15', '20:30', '20:45', '21:00', '21:15', '21:30', '21:45', '22:00', '22:15', '22:30', '22:45', '23:00'
	    ],
	    autoclose: true
	});
	$('.permission_section').find('#from_times').change(function () {
	    var date2 = $('#from_time').val();
	    var date = moment(date2, "DD-MM-YYYY HH:mm:ss").format("YYYY-MM-DD HH:mm:ss");
	    var date1 = moment.utc(date).add(2, 'hours').format("YYYY-MM-DD HH:mm:ss");
	    var to_time = moment(date1, "YYYY-MM-DD H:mm:ss").format("DD-MM-YYYY HH:mm:s");
	    $('#to_time').val(to_time);
	});
	$('.leave_section').find('#from_date').change(function () {
	    leave_duration = $('#leave_duration').val();
	    if (leave_duration == 1) {
		var date2 = $('#from_date').val();
		$('#to_date').val(date2);
		$('.leave_section').find('#to_date').datetimepicker("remove");
		$('.leave_section').find('.to_date_icon').removeAttr('id')
	    } else {
		$('.leave_section').find('.to_date_icon').attr('id', 'to_date_icon')
	    }
	});
    });
</script>


<script type="text/javascript">
    /*$(document).ready(function ()
     {
     //$("#staff_name").focus();
     $("#checking_email").blur(function ()
     {

     var email = $("#checking_email").val();
     var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
     if (email == 0 || email == null || email.trim().length == 0)
     {
     } else
     {
     if (!filter.test(email))
     {
     $("#errormessage").html("Enter valid email");
     } else
     {
     $.ajax({
     url: BASE_URL + "staff/checking_email_insert",
     type: 'POST',
     data: {value1: email},
     success: function (result) {
     $("#errormessage").html(result);
     //document.getElementById('hidden_msg').value=result;

     }

     });
     }
     }
     });

     //checking  staff_id

     $("#staff_id").blur(function ()
     {


     var staffid = $("#staff_id").val();
     //alert(staffid);
     $.ajax({
     url: BASE_URL + "staff/checking_staffid_insert",
     type: 'POST',
     data: {staff_id: staffid},
     success: function (result) {
     $("#error_staffid").html(result);


     }

     });

     });
     $("form[name=sform]").submit(function ()
     {


     /*if($("#depart_id").val()=='')
     {
     $("#depart_id").css('border','1px solid red');

     }
     else{
     $("#depart_id").css('border','1px solid #CCCCCC');
     $("#depart_id").tooltip('hide');
     }	*/


    /* var message1 = document.getElementById("errormessage").innerHTML;
     var message2 = document.getElementById("error_staffid").innerHTML;
     if ((message1.trim()).length > 0 && (message2.trim()).length > 0)
     {

     return false;
     } else if ((message1.trim()).length > 0)
     {

     return false;
     } else if ((message2.trim()).length > 0)
     {

     return false;
     } else
     {

     return true;
     }

     });
     }); * /
</script>
     <script>
     / * $("#staff_name").live('blur', function ()
     {
     var staff_name = $("#staff_name").val();
     var filter = /^[a-zA-Z.\s]{3,20}$/;
     if (staff_name == "")
     {
     $("#v1").html("Required Field");
     } else if (!filter.test(staff_name))
     {
     $("#v1").html("Alphabets and Min 3 to Max 20 ");
     } else
     {
     $("#v1").html("");
     }
     });
     $("#join_date").live('blur', function ()
     {
     var join_date = $("#join_date").val();
     if (join_date == "")
     {
     $("#v2").html("Required Field");
     } else
     {
     $("#v2").html("");
     }
     });
     $("#address").live('blur', function ()
     {
     var address = $("#address").val();
     if (address == "")
     {
     $("#v3").html("Required Field");
     } else if (address.length < 6 || address.length > 250)
     {

     $("#v3").html("Minimum 6 to 250 characters");
     } else
     {
     $("#v3").html("");
     }
     });
     $("#staff_id").live('blur', function ()
     {
     var staff_id = $("#staff_id").val();
     if (staff_id == "")
     {
     $("#v4").html("Required Field");
     } else
     {
     $("#v4").html("");
     }
     });
     $("#state").live('blur', function ()
     {
     var state = $("#state").val();
     if (state == "")
     {
     $("#v5").html("Required Field");
     } else
     {
     $("#v5").html("");
     }
     });
     $("#checking_email").live('blur', function ()
     {
     var checking_email = $("#checking_email").val();
     if (checking_email == "")
     {
     $("#v15").html("Required Field");
     } else
     {
     $("#v15").html("");
     }
     });
     $("#country").live('blur', function ()
     {
     var country = $("#country").val();
     if (country == "")
     {
     $("#v6").html("Required Field");
     } else
     {
     $("#v6").html("");
     }
     });
     $("#password").live('blur', function ()
     {
     var password = $("#password").val();
     var filter = /^((?=.*[a-zA-Z])(?=.*\d)(?=.*[#@%$]).{6,20})$/;
     if (password == "")
     {
     $("#v7").html("Required Field");
     } else if (!filter.test(password))
     {
     $("#v7").html("Minimum 6 characters(Ex:A@b2c#)");
     } else
     {
     $("#v7").html("");
     }
     });
     $("#postal_code").live('blur', function ()
     {
     var postal_code = $("#postal_code").val();
     if (postal_code == "")
     {
     $("#v8").html("Required Field");
     } else if (postal_code.length != 6)
     {

     $("#v8").html("Maximum 6 characters");
     } else
     {
     $("#v8").html("");
     }
     });
     $("#dob").live('blur', function ()
     {
     var dob = $("#dob").val();
     if (dob == "")
     {
     $("#v9").html("Required Field");
     } else
     {
     $("#v9").html("");
     }
     });
     $("#mobile").live('blur', function ()
     {
     var mobile = $("#mobile").val();
     var filter = /^[0-9]{10,12}$/;
     if (mobile == "")
     {
     $("#v11").html("Required Field");
     } else if (!filter.test(mobile))
     {
     $("#v11").html("Numeric only and length 10 to 12");
     } else
     {
     $("#v11").html("");
     }
     });
     $("#depart_id").live('blur', function ()
     {
     var depart_id = $("#depart_id").val();
     if (depart_id == "")
     {
     $("#v12").html("Required Field");
     } else
     {
     $("#v12").html("");
     }
     });
     $("#design_id").live('blur', function ()
     {
     var design_id = $("#design_id").val();
     if (design_id == "")
     {
     $("#v13").html("Required Field");
     } else
     {
     $("#v13").html("");
     }
     });
     $("#staff_type_id").live('blur', function ()
     {
     var staff_type_id = $("#staff_type_id").val();
     if (staff_type_id == "")
     {
     $("#v14").html("Required Field");
     } else
     {
     $("#v14").html("");
     }
     }); * /
</script>
     <script>
     / * function validate()
     {
     var i = 0;
     var staff_name = $("#staff_name").val();
     var filter = /^[a-zA-Z.\s]{3,20}$/;
     if (staff_name == "")
     {
     $("#v1").html("Required Field");
     i = 1;
     } else if (!filter.test(staff_name))
     {
     $("#v1").html("Alphabets and Min 3 to Max 20 ");
     i = 1;
     } else
     {
     $("#v1").html("");
     }
     var join_date = $("#join_date").val();
     if (join_date == "")
     {
     $("#v2").html("Required Field");
     i = 1;
     } else
     {
     $("#v2").html("");
     }
     var address = $("#address").val();
     if (address == "")
     {
     $("#v3").html("Required Field");
     i = 1;
     } else if (address.length < 6 || address.length > 250)
     {

     $("#v3").html("Minimum 6 to 250 characters");
     i = 1;
     } else
     {
     $("#v3").html("");
     }
     var staff_id = $("#staff_id").val();
     if (staff_id == "")
     {
     $("#v4").html("Required Field");
     i = 1;
     } else
     {
     $("#v4").html("");
     }
     var state = $("#state").val();
     if (state == "")
     {
     $("#v5").html("Required Field");
     i = 1;
     } else
     {
     $("#v5").html("");
     }
     var checking_email = $("#checking_email").val();
     if (checking_email == "")
     {
     $("#v15").html("Required Field");
     i = 1;
     } else
     {
     $("#v15").html("");
     }
     var country = $("#country").val();
     if (country == "")
     {
     $("#v6").html("Required Field");
     i = 1;
     } else
     {
     $("#v6").html("");
     }
     var password = $("#password").val();
     var filter = /^((?=.*[a-zA-Z])(?=.*\d)(?=.*[#@%$]).{6,20})$/;
     if (password == "")
     {
     $("#v7").html("Required Field");
     i = 1;
     } else if (!filter.test(password))
     {
     $("#v7").html("Minimum 6 characters(Ex:A@b2c#)");
     i = 1;
     } else
     {
     $("#v7").html("");
     }
     var postal_code = $("#postal_code").val();
     if (postal_code == "")
     {
     $("#v8").html("Required Field");
     i = 1;
     } else if (postal_code.length != 6)
     {

     $("#v8").html("Maximum 6 characters");
     i = 1;
     } else
     {
     $("#v8").html("");
     }
     var dob = $("#dob").val();
     if (dob == "")
     {
     $("#v9").html("Required Field");
     i = 1;
     } else
     {
     $("#v9").html("");
     }


     var mobile = $("#mobile").val();
     var filter = /^[0-9]{10,12}$/;
     if (mobile == "")
     {
     $("#v11").html("Required Field");
     i = 1;
     } else if (!filter.test(mobile))
     {
     $("#v11").html("Numeric only and length 10 to 12");
     i = 1;
     } else
     {
     $("#v11").html("");
     }
     var depart_id = $("#depart_id").val();
     if (depart_id == "")
     {
     $("#v12").html("Required Field");
     i = 1;
     } else
     {
     $("#v12").html("");
     }
     var design_id = $("#design_id").val();
     if (design_id == "")
     {
     $("#v13").html("Required Field");
     i = 1;
     } else
     {
     $("#v13").html("");
     }
     var staff_type_id = $("#staff_type_id").val();
     if (staff_type_id == "")
     {
     $("#v14").html("Required Field");
     } else
     {
     $("#v14").html("");
     }


     if (i == 1)
     {

     return false;
     } else
     {
     for_loading('Adding Staff...!');
     return true;
     }


     } * /
</script>




<div class="add_staff">
    <?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
    <form method="post" action="<?php echo $this->config->item('base_url') . 'leave/update_staff_leave/' . $leave[0]['id']; ?>"  enctype="multipart/form-data" >
	<input type="hidden" name="user_id" value="<?php echo ($leave[0]['user_id']) ? $leave[0]['user_id'] : '-'; ?>"/>
	<table class="staff_table">
	    <tr>
		<td>Staff Name</td>
		<td><b><?php echo ($leave[0]['staff_name']) ? $leave[0]['staff_name'] : '-'; ?></b></td>
	    </tr>
	    <tr>
		<td>Leave Duration</td>
		<td>
		    <?php
		    if ($leave[0]['leave_duration'] == 1) {
			echo '<b>Half Day</b>';
		    } elseif ($leave[0]['leave_duration'] == 2) {
			echo '<b>Full Day</b>';
		    } elseif ($leave[0]['leave_duration'] == 3) {
			echo '<b>Permission</b>';
		    }
		    ?>
		</td>
		<td>Leave Type</td>
		<td>
		    <?php
		    if ($leave[0]['leave_type'] == 1) {
			echo '<b>Casual Leave</b>';
		    } elseif ($leave[0]['leave_type'] == 2) {
			echo '<b>Seek Leave</b>';
		    } elseif ($leave[0]['leave_type'] == 3) {
			echo '<b>Others</b>';
		    }
		    ?>
	    </tr>
	    <tr>
		<td style="vertical-align:top">From</td>
		<td><b><?php
			if ($leave[0]['leave_duration'] == 3)
			    echo ($leave[0]['from_date']) ? date('d-m-Y H:i', strtotime($leave[0]['from_date'])) : '-';
			else
			    echo ($leave[0]['from_date']) ? date('d-m-Y', strtotime($leave[0]['from_date'])) : '-';
			?>
		    </b></td>
		<td style="vertical-align:top">To</td>
		<td><b>
			<?php
			if ($leave[0]['leave_duration'] == 3)
			    echo ($leave[0]['to_date']) ? date('d-m-Y H:i', strtotime($leave[0]['to_date'])) : '-';
			else
			    echo '<b>' . ($leave[0]['to_date']) ? date('d-m-Y', strtotime($leave[0]['to_date'])) : '-';
			?>
		    </b></td>
	    </tr>
	    <tr>
		<td>Session</td>
		<td>
		    <?php
		    if ($leave[0]['session'] == 1) {
			echo '<b>Forenoon (FN)</b>';
		    } elseif ($leave[0]['session'] == 2) {
			echo '<b>Afternoon (AN)</b>';
		    } else {
			echo '-';
		    }
		    ?>
		</td>
		<td></td>
		<td></td>

	    </tr>
	    <tr>
		<td>Reason</td>
		<td colspan="3"><b><?php echo ($leave[0]['reason']) ? $leave[0]['reason'] : '-'; ?></b></td>
		<td></td>
		<td></td>
	    </tr>
	    <tr>
		<td>Status</td>
		<td colspan="3">
		    <select name="status" id="status" class="status">
			<option value="">Select</option>
			<option value="Pending" <?php echo ($leave[0]['status'] == 'Pending') ? 'selected="selected"' : '-'; ?>>Pending</option>
			<option value="Hold" <?php echo ($leave[0]['status'] == 'Hold') ? 'selected="selected"' : '-'; ?>>Hold</option>
			<option value="Approved" <?php echo ($leave[0]['status'] == 'Approved') ? 'selected="selected"' : '-'; ?>>Approved</option>
			<option value="Rejected" <?php echo ($leave[0]['status'] == 'Rejected') ? 'selected="selected"' : '-'; ?>>Rejected</option>
		    </select>
		</td>
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
     function readURL(input) {
     if (input.files && input.files[0]) {
     var reader = new FileReader();
     reader.onload = function (e) {
     $('#blah').attr('src', e.target.result);
     }

     reader.readAsDataURL(input.files[0]);
     }
     }

     $("#imgInp").change(function () {

     if ($(this).val() == "" || $(this).val() == null)
     {

     } else
     {
     readURL(this);
     }
     });
     // Image validation size checking
     $("#imgInp").change(function () {

     var val = $(this).val();
     switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
     case 'gif':
     case 'jpg':
     case 'png':
     case '':
     $("#v18").html("");
     break;
     default:
     $(this).val();
     // error message here
     $("#v18").html("Invalid File Type");
     break;
     }
     });
     /*$('#imgInp').bind('change', function() {

     //alert(this.files[0].size);
     if(this.files[0].size>1048576)
     {
     var size_error="Profile Image:maximum size 1MB";
     $("#v18").html(size_error);

     }
     else
     {

     }

     });*/ // image validation ends here
    /*$('.add_row').click(function () {
     $('#last_row').clone().appendTo('#app_table');
     var i = 4;
     $('.dy_no').each(function () {
     $(this).html(i);
     i++;
     });
     });
     $(".remove_comments").live('click', function () {
     $(this).closest("tr").remove();
     var i = 4;
     $('.dy_no').each(function () {
     $(this).html(i);
     i++;
     });
     });
     //cancel function
     $("#cancel").live("click", function ()
     {
     $('.val').html('');
     $('.mandatory').css('border', '1px solid #CCCCCC');
     $("#blah").replaceWith('<img id="blah" class="add_staff_thumbnail" src="<?= $theme_path; ?>/img/avatar5.png"  alt="Staff Image" />');
     //$('.erro').html();

     });
     $("form[name=sform]").submit(function ()
     {

     var message = $("#v18").html();
     if (message.trim().length > 0)
     {

     return false;
     } else
     {
     return true;
     }

     });*/</script>
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


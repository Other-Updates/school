<style type="text/css">
    @media print
    {
        select {border: 1px solid #fff !important; box-shadow: inset 0 0px 0px rgba(0,0,0,0.075) !important; border-color:#fff; }
    }
    .modal-title {
	font-size: 20px;
	color: #333;
    }
    .modal-title {
	margin: 0;
	line-height: 1.42857143;
    }
    .bg-info {
	background-color: #26A69A;
    }
    .modal-header {
	min-height: 16.43px;
	padding: 15px;
	border-bottom: 1px solid #e5e5e5;
    }
    .modal {
	position: fixed;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	z-index: 1050;
	display: none;
	overflow: hidden;
	-webkit-overflow-scrolling: touch;
	outline: 0;
    }
    .modal-footer {
	margin-top: 60px;
    }
</style>
<script type="text/javascript">
//$(document).ready(function(){ $("#batch").focus(); });
    $(function () {
	$("#example1").dataTable();
	$("#example4").dataTable();
	$("#example5").dataTable();
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
    $("#batch").live('change', function ()
    {
	b_id = $(this).val();
	if (b_id == "" || b_id == null)
	{
	    $('#semester').prop('disabled', true);
	} else
	{

	    $('#semester').prop('disabled', false);
	    $('#department').prop('disabled', true);
	    $('#group1').prop('disabled', true);
	    $("#com_error").html('');
	    //$('#semester').focus();
	    $('#semester').val('');
	    $('#department').val('');
	    $('#group1').val('');
	    $('.master').html('');
	    $('all').hide();
	}
    });
    $("#semester").live('change', function ()
    {
	b_id = $(this).val();
	if (b_id == "" || b_id == null)
	{
	    $('#department').prop('disabled', true);
	} else
	{

	    $('#department').prop('disabled', false);
	    $('#group1').prop('disabled', true);
	    $("#com_error").html('');
	    //$('#department').focus();
	    $('#department').val('');
	    $('#group1').val('');
	    $('.master').html('');
	    $('all').hide();
	}
    });</script>


<?php
$this->load->model('master/master_model');
$user_det = $this->session->userdata('logged_in');
$permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
$staff = $this->session->userdata('logged_in');
$leave_sess = $this->session->userdata('leave_filter');
?>
<?php
if (isset($master) && !empty($master)) {
    foreach ($master as $row) {

    }
}
?>

<?php if ($staff['staff_type'] == 'staff') { ?>
    <input type="hidden" value="<?= $user_det['department_id'] ?>" class="hide_depart"/>
<?php } ?>

<div id="subject">

    <div class="row">
	<form method="post" enctype="multipart/form-data" >
	    <div class="col-sm-3">
		<label>From Date:</label><input class="from_date" value="<?php echo ($leave_sess['from_date']) ? $leave_sess['from_date'] : date('01-m-Y') ?>" name="from_date" placeholder="From date" type="text">
	    </div>
	    <div class="col-sm-3">
		<label>To date:</label><input class="to_date" value="<?php echo ($leave_sess['to_date']) ? $leave_sess['to_date'] : date('t-m-Y') ?>" name="to_date" placeholder="To date" type="text">
	    </div>
	    <div class="col-sm-3">
		<label>Status:</label><select name="status" id="status" class="status">
		    <option value="">Select</option>
		    <option value="Pending" <?php echo ($leave_sess['status'] == 'Pending') ? 'selected="selected"' : ''; ?>>Pending</option>
		    <option value="Approved" <?php echo ($leave_sess['status'] == 'Approved') ? 'selected="selected"' : ''; ?>>Approved</option>
		    <option value="Hold" <?php echo ($leave_sess['status'] == 'Hold') ? 'selected="selected"' : ''; ?>>Hold</option>
		    <option value="Rejected" <?php echo ($leave_sess['status'] == 'Rejected') ? 'selected="selected"' : ''; ?>>Rejected</option>
		</select>
	    </div>
	    <div class="col-sm-3">
		<input type="submit" style="margin-top: 17px;" class="btn btn-success" value="Search">
	    </div>
	</form>
    </div>

    <!--<a href="<?php echo $this->config->item('base_url') . 'leave/add'; ?>" class="btn btn-primary ">Add Leave</a>-->
    <!--<button id="but" class="btn btn-primary " disabled="disabled">Add Leave</button>-->
    </br>
</div>
<div>

</div>



<!--  table veiw perpose-->

<br />
<div id="view_all">
    <table id="example1" class="table table-bordered table-striped">
	<thead>
	    <tr>
		<th class="text-center">S.No</th>
		<th>Staff Name</th>
		<th>Leave Type</th>
		<th>Duration Type</th>
		<th class="text-center">From Date</th>
		<th class="text-center">To Date</th>
		<th class="text-center">Status</th>
		<th class="text-center">Actions</th>
	    </tr>
	</thead>
	<tbody>
	    <?php
	    if (!empty($leaves)) {
		$k = 1;
		foreach ($leaves as $list) {
		    ?>
		    <?php
		    $todate = strtotime($list['to_date']);
		    //$last_date = (time() - (60 * 60 * 24));
		    //$cur = strtotime(date('Y-m-d 00:00:00'));
		    $cur_date_l = strtotime(date('Y-m-d H:i:s'));
		    ?>
		    <tr class="odd gradeX">
			<td class="text-center"><?php echo $k; ?></td>
			<td><?php echo $list['staff_name']; ?></td>
			<td><?php
			    if ($list['leave_type'] == 1) {
				echo 'Casual Leave';
			    } elseif ($list['leave_type'] == 2) {
				echo 'Seek Leave';
			    } elseif ($list['leave_type'] == 3) {
				echo 'Others';
			    }
			    ?></td>

			<td><?php
			    if ($list['leave_duration'] == 1) {
				echo 'Half Day';
			    } elseif ($list['leave_duration'] == 2) {
				echo 'Full Day';
			    } elseif ($list['leave_duration'] == 3) {
				echo 'Permission';
			    }
			    ?></td>
			<td class="text-center"><?php echo ($list['leave_duration'] != 3) ? date('d/m/Y', strtotime($list['from_date'])) : date('d/m/Y H:i', strtotime($list['from_date'])); ?></td>
			<td class="text-center"><?php echo ($list['leave_duration'] != 3) ? date('d/m/Y', strtotime($list['to_date'])) : date('d/m/Y H:i', strtotime($list['to_date'])); ?></td>
			<td class="text-center">
			    <?php if ($todate < $cur_date_l) { ?>
	    		    <span class="label label-sm label-danger"> Over Due date </span>
				<?php
			    } else {
				if ($list['status'] == 'Approved')
				    echo '<button class="btn btn-sm btn-success">' . $list['status'] . '</button>';
				elseif ($list['status'] == 'Rejected')
				    echo '<button class="btn btn-sm btn-danger">' . $list['status'] . ' </button>';
				elseif ($list['status'] == 'Hold')
				    echo '<button class="btn btn-sm btn-warning">' . $list['status'] . '</button>';
				elseif ($list['status'] == 'Pending')
				    echo '<button class="btn btn-sm btn-primary">' . $list['status'] . '</button>';
			    }
			    ?>


			</td>
			<td class="text-center">
			    <a href="<?php echo $this->config->item('base_url') . 'leave/edit_leave/' . $list['id'] . ''; ?>" class="btn btn-info btn-sm "><i class="fa fa-pencil"></i></a>&nbsp;
			</td>
	<!--			<td class="text-center">
			<?php if ($todate < $cur_date_l) { ?>

	    		    <a href="<?php echo $this->config->item('base_url') . 'leave/delete/' . $list['id'] . ''; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
			<?php } else {
			    ?>

			    <?php if ($list['status'] == 'Pending') { ?>
																											<a href="<?php echo $this->config->item('base_url') . 'leave/edit_leave/' . $list['id'] . ''; ?>" class="btn btn-info btn-sm "><i class="fa fa-pencil"></i></a>&nbsp;
																											<a href="<?php echo $this->config->item('base_url') . 'leave/delete/' . $list['id'] . ''; ?>" class="btn btn-danger btn-sm "><i class="fa fa-trash-o"></i></a>
			    <?php } else { ?>
																											'N/A'
				<?php
			    }
			}
			?>



			</td>-->
		    </tr>

		    <?php
		    $k++;
		}
	    }
	    ?>
	</tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function () {
	$('.from_date').datetimepicker({
	    timepicker: false,
	    closeOnDateSelect: false,
	    closeOnTimeSelect: true,
	    initTime: true,
	    format: 'd-m-Y',
	    roundTime: 'ceil',
	    setDate: new Date(),
	    onChangeDateTime: function (dp) {
		month = dp.getMonth() + 1;
		year = dp.getFullYear();
		date = dp.getDate();
		month = (month < 10) ? ('0' + month) : month;
		$(".to_date").datetimepicker({minDate: year + '/' + month + '/' + date});
	    }
	});
	$('.to_date').datetimepicker({
	    timepicker: false,
	    closeOnDateSelect: false,
	    closeOnTimeSelect: true,
	    initTime: true,
	    format: 'd-m-Y',
	    //	 minDate: $("#from_date").val(),
	    roundTime: 'ceil',
	    setDate: new Date(),
	    onChangeDateTime: function (dp) {
		month = dp.getMonth() + 1;
		year = dp.getFullYear();
		date = dp.getDate();
		month = (month < 10) ? ('0' + month) : month;
		$(".from_date").datetimepicker({maxDate: year + '/' + month + '/' + date});
	    }
	});

    });
</script>



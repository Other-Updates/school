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

    <a href="<?php echo $this->config->item('base_url') . 'leave/add'; ?>" class="btn btn-primary ">Add Leave</a>
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
			    <?php if ($todate < $cur_date_l) { ?>
	    		    <a href="<?php echo $this->config->item('base_url') . 'leave/delete/' . $list['id'] . ''; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
			    <?php } else {
				?>

				<?php if ($list['status'] == 'Pending') { ?>
				    <a href="<?php echo $this->config->item('base_url') . 'leave/edit/' . $list['id'] . ''; ?>" class="btn btn-info btn-sm "><i class="fa fa-pencil"></i></a>&nbsp;
				    <a href="<?php echo $this->config->item('base_url') . 'leave/delete/' . $list['id'] . ''; ?>" class="btn btn-danger btn-sm "><i class="fa fa-trash-o"></i></a>
				<?php } else { ?>
				    'N/A'
				    <?php
				}
			    }
			    ?>



			</td>
		    </tr>

		    <?php
		    $k++;
		}
	    }
	    ?>
	</tbody>
    </table>
</div>

<!--/*   pop up box view-->
<?php
$i = 0;
if (isset($all_view) && !empty($all_view)) {
    foreach ($all_view as $view) {
	?>

	<div id="test_<?php echo $view['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
	     align="center">
	    <div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3 id="myModalLabel">View Subject</h3>
		    </div>

		    <div class="modal-body"  >
			<table class="staff_table_sub">

			    <tr>
				<td>Subject</td><td class="text_bold1"><?php echo $view['subject_name']; ?>  </td>
			    </tr>
			    <tr>
				<td>Nick Name</td><td class="text_bold1"><?php echo $view['nick_name']; ?>  </td>
			    </tr>
			    <tr>
				<td>Subject Code</td><td class="text_bold1"><?php echo $view['scode']; ?>  </td>
			    </tr>
			    <tr>
				<td>Credits</td><td class="text_bold1"><?php echo $view['grade_point']; ?>  </td>
			    </tr>
			    <tr>
				<td>Staff</td><td class="text_bold1"> <?php echo $view['staff_name']; ?></td>
			    </tr>
			    <tr>
				<td>Department</td><td class="text_bold1"> <?php echo $view['department']; ?> </td>
			    </tr>
			    <tr>
				<td>Section</td><td class="text_bold1"> <?php echo $view['group']; ?></td>
			    </tr>
			    <tr>
				<td>Semester</td><td class="text_bold1"> <?php echo $view['semester']; ?></td>
			    </tr>
			    <tr>
				<td>Batch</td><td class="text_bold1"> <?= $view['from'] ?>-<?= $view['to'] ?> </td>
			    </tr>
			</table>
		    </div>
		    <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
		    </div>
		</div>
	    </div>
	</div>
	<?php
	$i++;
    }
}
?>


<!--delete option-->
<?php
$i = 0;
if (isset($all_view) && !empty($all_view)) {
    foreach ($all_view as $update) {
	?>
	<div id="close">
	    <div id="delete_<?php echo $update['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		 aria-hidden="false" align="center">
		<div class="modal-dialog">
		    <div class="modal-content">
			<div class="modal-header">
			    <a class="close" data-dismiss="modal">×</a>
			    <h3 id="myModalLabel">Delete Subject</h3>
			</div>
			<div class="modal-body" >
			    Are you sure want you want Remove subject <b><?php echo $update['subject_name']; ?> ?
				<input type="hidden" value="<?php echo $update['id']; ?>" class="hid" /></b>
			</div>
			<div class="modal-footer">
			    <input type="button" value="Yes" id="yes" class="btn btn-primary delete_sub"  />
			    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
			</div>
		    </div>
		</div>
	    </div>
	</div>
	<?php
	$i++;
    }
}
?>

<!--update pop up-->
<?php
$i = 1;
if (isset($all_view) && !empty($all_view)) {
    foreach ($all_view as $update) {  //echo "<pre>"; print_r($update);
	?>

	<div id="update_<?php echo $update['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
	     align="center">
	    <div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3 id="myModalLabel">Update Subject</h3>
		    </div>
		    <div class="modal-body">

			<div class="box-body table-responsive">
			    <div id="subject">
				<table width="100%" border="0" class="form_table">
				    <input type="hidden" name="uid" class="u_id " value="<?php echo $update['id']; ?>" />

				    <tr>
					<td>Batch </td>
					<td>
					    <select id='batch' name='batch'  class="u_batch u_val mandatory" >

						<?php
						if (isset($all_batch) && !empty($all_batch)) {

						    foreach ($all_batch as $view) {
							?>
							<option <?= ( $view['id'] == $update['batch_id']) ? 'selected' : ''; ?>
							    value="<?= $view['id'] ?>" ><?php echo $view['from'] . '-' . $view['to'] ?>

							</option>
							<?php
						    }
						}
						?>

					    </select>
					    <input type="hidden" value="<?php echo $update['batch_id'] ?>"  id="batc" class="batc"/>
					</td>
				    </tr>
				    <tr>
					<td>Semester </td>
					<td>
					    <select id='semester' name='semester'  class="u_semester u_val mandatory" >

						<?php
						if (isset($all_semester) && !empty($all_semester)) {

						    foreach ($all_semester as $view) {
							?>
							<option <?= ($view['semester'] == $update['semester']) ? 'selected' : ''; ?>
							    value="<?= $view['id'] ?>"><?php echo $view['semester'] ?></option>
							    <?php
							}
						    }
						    ?>

					    </select>
					    <input type="hidden" value="<?php echo $update['semester_id'] ?>" id="sem" class="sem" />
					</td>
				    </tr>
				    <tr>
					<td>Department</td>
					<td>
					    <?php if ($staff['staff_type'] == 'staff') { ?>
	    				    <select id='department_<?= $i ?>' name='student_group'  class="u_department u_grp u_val mandatory " >

						    <?php
						    if (isset($all_department) && !empty($all_department)) {
							foreach ($all_department as $val) {
							    if ($val['id'] == $staff['department_id']) {
								?>
								<option <?= ($val['id'] == $update['depart_id']) ? 'selected' : ''; ?>
								    value="<?= $val['id'] ?>"><?= $val['department'] ?></option>

								<?php
							    }
							}
						    }
						    ?>

	    				    </select>
					    <?php } else { ?>
	    				    <select id='department_<?= $i ?>' name='student_group'  class="u_department u_grp u_val mandatory" >

						    <?php
						    if (isset($all_department) && !empty($all_department)) {
							foreach ($all_department as $val) {
							    ?>
		    					<option <?= ($val['id'] == $update['depart_id']) ? 'selected' : ''; ?>
		    					    value="<?= $val['id'] ?>"><?= $val['department'] ?></option>

							    <?php
							}
						    }
						    ?>

	    				    </select>
					    <?php } ?>
					    <input type="hidden" value="<?php echo $update['depart_id'] ?>" id="depid" class="depid" />
					</td>
				    </tr>
				    <tr>
					<td>Section </td>
					<td class='u_td<?= $i ?>'>
					    <select id='group' name='group'  class="mandatory u_group u_val mandatory" >


						<?php
						if (isset($update['get_group']) && !empty($update['get_group'])) {
						    foreach ($update['get_group'] as $val) {
							?>
							<option <?= ($val['id'] == $update['group_id']) ? 'selected' : ''; ?>
							    value="<?= $val['id'] ?>"> <?= $val['group'] ?> </option>

							<?php
						    }
						}
						?>

					    </select>
					    <input type="hidden" value="<?php echo $update['group_id'] ?>" id="section" class="section" />
					</td>

				    </tr>

				    <tr>
					<td width="25%">Subject:</td>
					<td> <input type="text" class="u_subject u_val mandatory"  value="<?php echo $update['subject_name']; ?>" />
					    <input type="hidden" class="usubject" id="usubject" value="<?php echo $update['subject_name']; ?>" />
					    <span class="subject_error errormessage" style="color:#F00;"></span></td>
				    </tr>
				    <tr>
					<td width="25%">Nick Name</td>
					<td> <input type="text" class="u_nick u_val mandatory" id="u_nick"  value="<?php echo $update['nick_name']; ?>" />
					    <input type="hidden" class="u_nick1" id="u_nick1" value="<?php echo $update['nick_name']; ?>" />
					    <span class="nick_error errormessage" style="color:#F00;"></span></td>
				    </tr>
				    <tr>
					<td>Subject Code </td>
					<td>
					    <input type="text" class="u_scode u_val mandatory" maxlength="10" value="<?php echo $update['scode']; ?>" />
					    <input type="hidden" class="uscode" id="uscode" value="<?php echo $update['scode']; ?>" />
					    <span class="scode_error errormessage" style="color:#F00;"></span>
					</td>
				    </tr>
				    <tr>
					<td>Credits </td>
					<td>
					    <input type="text" class="u_grade u_val mandatory"  value="<?php echo $update['grade_point']; ?>" />
					    <input type="hidden" class="ugrade" id="ugrade" value="<?php echo $update['grade_point']; ?>" />
					</td>
				    </tr>
				    <tr>
					<td width="10%">Staff Department </td>
					<td width="25%">
					    <select  name='student_group' id="depart_<?= $i ?>" class="u_department_staff mandatory staff validate staff_depart">

						<?php
						if (isset($all_department) && !empty($all_department)) {
						    foreach ($all_department as $val) {
							?>
							<option <?= ($val['id'] == $update['depart_id']) ? 'selected' : ''; ?> value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
							<?php
						    }
						}
						?>

					    </select>
					    <input type="hidden" value="<?php echo $update['depart_id'] ?>" id="staff" class="staff" />
					</td>
				    </tr>
				    <tr>
					<td>Staff</td>
					<td id='update_s_view<?= $i ?>'>
					    <select id='staff' name='student_staff'  class="u_staff mandatory validate">

						<?php
						$this->load->model('subject/subject_model');
						$all_stf = $this->subject_model->get_all_staff($update['depart_id']);
						?>
						<?php
						if (isset($all_stf) && !empty($all_stf)) {

						    foreach ($all_stf as $view) {
							?>
							<option <?= ($view['id'] == $update['staff_id']) ? 'selected' : ''; ?>
							    value="<?= $view['id'] ?>"><?php echo $view['staff_name'] ?>
							</option>
							<?php
						    }
						}
						?>

					    </select>
					    <input type="hidden" value="<?php echo $update['staff_id'] ?>" id="staffid" class="staffid" />
					</td>



				    </tr>

				</table>
			    </div>
			</div>
		    </div>
		    <div class="modal-footer">
			<input type="button" class="btn btn-primary delete" id="update" name="update" value="Update" />
			<button type="button" class="btn btn-danger" id="no" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
		    </div>
		</div>     </div>
	</div>
	<?php
	$i++;
    }
}
?>

<input type="hidden" value="<?= $staff['staff_type']; ?>"  id="us_type" />
<input type="hidden" value="0"  id="chk_valu" />



<script type="text/javascript">
    $('.add_bluk_import').click(function () {
	$('#myModal').modal({
	    backdrop: 'static',
	    keyboard: false
	});
	$('#myModal').modal('show');
    });
    $(document).ready(function () {

	var s_ty = $("#us_type").val()
	if (s_ty == 'admin')
	{
	    $('.btn-primary').prop('disabled', false);
	}

	$("#but").live('click', function () {
	    $("#cls").toggle();
	});
	$("#add_subject").click(function ()
	{
	    scode = $("#scode").val();
	    batch = $("#batch").val();
	    department = $(" #department").val();
	    group = $("#group1").val();
	    semester = $("#semester").val();
	    staff = $("#staff").val();
	    subject = $("#sub").val();
	    nick = $("#nicky").val();
	    grade = $("#grade_point").val();
	    staff_dep = $(".depar").val();
	    var i = 0;
	    if (batch == '') {
		i = 1;
		$('#batch').css('border', '1px solid red');
	    } else {
		$('#batch').css('border', '1px solid #CCCCCC');
	    }
	    if (department == '') {
		i = 1;
		$('#department').css('border', '1px solid red');
	    } else {
		$('#department').css('border', '1px solid #CCCCCC');
	    }
	    if (semester == '') {
		i = 1;
		$('#semester').css('border', '1px solid red');
	    } else {
		$('#semester').css('border', '1px solid #CCCCCC');
	    }
	    if (group == '') {
		i = 1;
		$('#group1').css('border', '1px solid red');
	    } else {
		$('#group1').css('border', '1px solid #CCCCCC');
	    }
	    if (staff == '') {
		i = 1;
		$('#staff').css('border', '1px solid red');
	    } else {
		$('#staff').css('border', '1px solid #CCCCCC');
	    }
	    if (subject == '' || subject.trim().length == 0) {
		i = 1;
		$('#sub').css('border', '1px solid red');
	    } else {
		$('#sub').css('border', '1px solid #CCCCCC');
	    }
	    if (scode == '' || scode.trim().length == 0) {
		i = 1;
		$('#scode').css('border', '1px solid red');
	    } else {
		$('#scode').css('border', '1px solid #CCCCCC');
	    }
	    if (nick == '' || nick.trim().length == 0) {
		i = 1;
		$('#nicky').css('border', '1px solid red');
	    } else {
		$('#nicky').css('border', '1px solid #CCCCCC');
	    }
	    //if( grad e=='' || gra d e .trim().length==0   ){i=1; $('# grade_point').css( 'bo rder','1px solid  red');}else{$('#grade_point').css('border','1px solid #CCCCCC');}
	    if (staff_dep == '' || staff_dep == null || staff_dep == 0)
	    {
		i = 1;
		$('.depar').css('border', ' 1px  solid red');
	    } else {
		$('.depar ').css('border', '1px solid #CCCCCC');
	    }
	    if (i == 0)
	    {
		$.ajax({
		    url: BASE_URL + "subject/insert_subject",
		    type: 'POST',
		    data: {
			value1: batch,
			value2: department,
			value3: group,
			value4: semester,
			value5: staff,
			value6: subject,
			value8: scode,
			value9: nick,
			grade: grade},
		    success: function (result) {

			$("#view_all").html(result);
			$("#view_all").html();
			$("#cls").css('display', 'none ');
			for_response('Subject Added Successfully...!'); // resutl notif ication
		    }

		});
		$("#scode").val('');
		$("#batch").val('');
		$("#department").val('');
		$("#group1").val('');
		$("#semester").val('');
		$("#staff").val('');
		$(".subject").val('');
		$(".depar").val('');
		$(" #nicky").val('');
		$("#grade_point").val('');
	    }
	});
	$("#cancel").click(function ()
	{
	    $('#semester').prop('disabled', true);
	    $('#department').prop('disabl ed', true);
	    $('#group1').prop('disable d', true);
	    $("#grade_point").val('');
	    $('.validate').val('');
	    $('#group1').val('');
	    $('#dupli').html('');
	    $('#dupli').html('');
	    $('#com_error').html('');
	    $('.validate').css('border', '1px solid #CCCCCC ');
	    $('.mandatory').css('border', '1px solid #CCCCCC');
	    $("#phone").css('border', '1px solid # CCCCCC');
	});

	$("#update").live("click", function ()
	{
	    i = 0;
	    // 	    var subject_error = $(this).parent().parent().find('.subject_error').html();
	    var nick_error = $(this).parent().parent().find('.nick_error').html();
	    var scode_error = $(this).parent().parent().find('.scode_error').html();
	    //		    var subject = $(this).parent().parent().find('.u_subject').val();
	    department = $(this).parent().parent().find('.u_department').val();
	    staff = $(this).parent().parent().find('.u_staff').val();
	    batch = $(this).parent().parent().find('.u_batch').val();
	    group = $(this).parent().parent().find('#group').val();
	    scode = $(this).parent().parent().find('.u_scode').val();
	    semester = $(this).parent().parent().find('.u_semester').val();
	    nickname = $(this).parent().parent().find('.u_nick').val();
	    grade = $(this).parent().parent().find('.u_grade').val();
	    var id = $(this).parent().parent().find('.u_id').val();
	    if (batch == '') {
		i = 1;
		$('.u_batch').css('border', '1px solid red');
	    }
	    if (department == '') {
		i = 1;
		$('.u_department').css('border', '1px solid red');
	    }
	    if (semester == '') {
		i = 1;
		$('.u_semester').css('border', '1px solid red');
	    }
	    if (group == '') {
		i = 1;
		$('#group').css('border', '1px solid red');
	    }
	    if (staff == '') {
		i = 1;
		$('.u_staff').css('border', '1px solid red');
	    }
	    if (subject == '' || subject.trim().length == 0) {
		i = 1;
		$('.u_subject').css('border', '1px solid red');
	    }
	    if (scode == '' || scode.trim().length == 0) {
		i = 1;
		$('.u_scode').css('border', '1px solid red');
	    }
	    if (nickname == '' || nickname.trim().length == 0) {
		i = 1;
		$('.u_nick').css('border', '1px solid red');
	    }
	    if (grade == '' || grade.trim().length == 0) {
		i = 1;
		$('.u_grade').css('border', '1px solid red');
	    }
	    if (subject_error.trim().length > 0 || nick_error.trim().length > 0 || scode_error.trim().length > 0) {
		i = 1;
		alert('Correct the errors');
	    }
	    if (i == 0)
	    {
		for_loading('Loading... Updateing Data'); // loading notification
		$.ajax({
		    url: BASE_URL + "subject/update_subject",
		    type: 'POST',
		    data: {value1: id,
			value2: subject,
			value3: staff,
			value4: batch,
			value5: group, value6: semester,
			value7: department,
			value8: scode,
			value9: nickname,
			grade: grade
		    },
		    success: function (result) {
			$("#view_all").html(result);
			for_response('Subject Updated Successfully...!'); // resutl notification
		    }});
		$('.modal').css("display", "none");
		$('.fade').css("display", "none");
	    }
	});
	$("#no").live("click", function ()
	{
	    var $a = $(this).parent().parent().find('.usubject').val();
	    $(this).parent().parent().find('.u_subject').val($a);
	    var $b = $(this).parent().parent().find('.uscode').val();
	    $(this).parent().parent().find('.u_scode').val($b);
	    var $y = u_nick1 = $(this).parent().parent().find('.u_nick1').val();
	    $(this).parent().parent().find('.u_nick').val($y);
	    var $c = $(this).parent().parent().find('.batc').val();
	    $(this).parent().parent().find('.u_batch').val($c);
	    var $d = $(this).parent().parent().find('.depid').val();
	    $(this).parent().parent().find('.u_department').val($d);
	    var $e = $(this).parent().parent().find('.sem').val();
	    $(this).parent().parent().find('.u_semester').val($e);
	    var $f = $(this).parent().parent().find('.staffid').val();
	    $(this).parent().parent().find('.u_staff').val($f);
	    var $g = $(this).parent().parent().find('.staff').val();
	    $(this).parent().parent().find('.u_department_staff').val($g);
	    var $h = $(this).parent().parent().find('section').val();
	    $(this).parent().parent().find('u_group').val();
	    var $grade = $(this).parent().parent().find('.ugrade').val();
	    $(this).parent().parent().find('.u_grade').val($grade);
	    $('.mandatory').css('border', '1px solid #CCCCCC');
	    m.html
	});

	$(".delete_sub").live("click", function ()
	{
	    for_loading_del('Loading... Delete Data'); // loading notification     var hidin = $(this).parent().parent().find('.hid').val();
	    $.ajax(
		    {url: BASE_URL + "subject/delete_subject",
			type: 'POST',
			data: {value1: hidin},
			success: function (result) {
			    $("#view_all").html(result);
			    for_response_del('Data Delete Successfully...!'); // resutl notification
			}

		    });
	    $('.modal').css("display", "none");
	    $('.fade').css("display", "none");
	});

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
	$('#department').live('change', function () {
	    //$('.master').html( ' ');
	    //$('.all').hide();
	    d_id = $(this).val();
	    $.ajax({
		url: BASE_URL + "subject/get_all_group",
		type: 'POST',
		data: {
		    depart_id: d_id

		},
		success: function (result) {
		    $('#g_td').html(result);
		    $('#group1').focus();
		    /*$('.modal-backdrop').hide();
		     $('.close_div').hide();*/
		}
	    });
	});
	$('.u_grp ').live('change', function () {
	    department = $(this).parent().parent().find('.u_department').val();
	    idnum = ($(this).attr('id'));
	    var splitNumber = idnum.split('_');
	    var ids = splitNumber[1];
	    $.ajax({
		url: BASE_URL + "subject/get_all_gp",
		type: 'POST',
		data: {
		    depart_id: department

		},
		success: function (result) {
		    $('.u_td' + ids).html(result);
		    /*$('.modal-backdrop').hide();
		     $('.close_div').hide();*/
		}
	    });
	});
	$('.find').live('change', function () {
	    department = $(this).parent().parent().find('.u_department').val();
	    idnum = ($(this).attr('id'));
	    var splitNumber = idnum.split('_');
	    var ids = splitNumber[1];
	    $.ajax({
		url: BASE_URL + "subject/get_update_staff",
		type: 'POST',
		data: {
		    depart_id: department

		},
		success: function (result) {

		    $('.staff').html(result);
		    /*$('.modal-backdrop').hide();
		     $('.close_div').hide();*/
		}
	    });
	});
	$('.staff').live('change', function () {
	    d_id = $(this);
	    $.ajax(
		    {
			url: BASE_URL + "subject/get_all_staff",
			type: 'POST',
			data: {depart_id: d_id.val()},
			success: function (result) {

			    $("#s_view").html(result);
			    $('#staff').focus();
			}
		    });
	});
	$(".src").live("click", function ()
	{
	    i = 0;
	    //for_loading_del('Loading... Delete Data'); // loading notification
	    batch = $("#batch").val(),
		    department = $("#department").val(),
		    group = $("#group1").val(),
		    semester = $("#semester").val();
	    //alert(batch+department+group+semester);
	    if (batch == '')
	    {
		i = 1;
		$('#batch').css('border', '1px solid red');
	    }
	    if (semester == '')
	    {
		i = 1;
		$('#semester').css('border', '1px solid red');
	    }
	    if (group == '')
	    {
		i = 1;
		$('#group1').css('border', '1px solid red');
	    }
	    if (department == '')
	    {
		i = 1;
		$('#department').css('border', '1px solid red');
	    }
	    if (i == 0)
	    {
		$.ajax(
			{
			    url: BASE_URL + "subject/staff_subject",
			    type: 'POST',
			    data: {value1: batch, value2: department, value3: group, value4: semester},
			    success: function (result) {
				$(".master").html(result);
				$('.all').show();
				$('#testing_subject').html('');
				// for_response_del('Data Delete Successfully...!'); // resutl notification
			    }
			});
	    }
	});
	//duplicate validation
<?php /* ?> $('.dupe').live('change',function(){
  scode=$("#scode").val(),
  batch=$("#batch").val(),
  department=$("#department").val(),
  group=$("#group1").val(),
  semester=$("#semester").val(),
  staff=$("#staff").val(),
  subject=$("#sub").val();

  $.ajax(
  {
  url:BASE_URL+"subject/validate_subject",
  type:'POST',
  data:{ value1:batch,value2:department,value3:group,value4:semester,value5:staff,value6:subject,value8:scode},
  success:function(result){
  $("#valu").html(result);
  len=( (result + '').length );
  if(len>2){$("#add_subject").attr("disabled", true);}
  else{$("#add_subject").attr("disabled", false);}
  //for_response('Data Insert Successfully...!'); // resutl notification
  }
  });
  });	<?php */ ?>


	$('.u_department_staff').live('change', function () {
	    department = $(this).parent().parent().find('.staff_depart').val();
	    idno = ($(this).attr('id'));
	    var splitNumber = idno.split('_');
	    var id = splitNumber[1];
	    $.ajax(
		    {
			url: BASE_URL + "subject/get_all_staff_update",
			type: 'POST',
			data: {depart_id: d_id.val()},
			success: function (result) {
			    $("#update_s_view" + id).html(result);
			}
		    });
	});
// duplication-subject
	$("#sub").blur(function ()
	{
	    var m = $("#chk_valu").val();
	    batch = $("#batch").val(),
		    department = $("#department").val(),
		    group = $("#group1").val(),
		    semester = $("#semester").val(),
		    subject = $("#sub").val();
	    $.ajax(
		    {
			url: BASE_URL + "subject/checking_deplicate_sub",
			type: 'POST',
			data: {value1: batch, value2: department, value3: group, value4: semester, value6: subject},
			success: function (result)
			{
			    $("#dupli").html(result);
			    len = ((result + '').length);
			    if (len > 2) {
				$("#add_subject").attr("disabled", true);
			    } else {
				if (m == 1)
				{
				    $("#add_subject").attr("disabled", true);
				} else
				{
				    $("#add_subject").attr("disabled", false);
				}
			    }
			}
		    });
	});
// duplication-nick name
	$("#nicky").blur(function ()
	{
	    batch = $("#batch").val(),
		    department = $("#department").val(),
		    group = $("#group1").val(),
		    semester = $("#semester").val(),
		    nick = $(this).val();
	    $.ajax(
		    {
			url: BASE_URL + "subject/checking_deplicate_nick",
			type: 'POST',
			data: {value1: batch, value2: department, value3: group, value4: semester, value6: nick},
			success: function (result)
			{
			    $("#dupli").html(result);
			    len = ((result + '').length);
			    if (len > 2) {
				$("#add_subject").attr("disabled", true);
			    } else
			    {
				if (m == 1)
				{
				    $("#add_subject").attr("disabled", true);
				} else
				{
				    $("#add_subject").attr("disabled", false);
				}
			    }
			}
		    });
	});
//duplication- subject codee
	$("#scode").blur(function ()
	{
	    batch = $("#batch").val(),
		    department = $("#department").val(),
		    group = $("#group1").val(),
		    semester = $("#semester").val(),
		    scode = $(this).val();
	    if (scode.trim().length > 0)
	    {
		$.ajax(
			{
			    url: BASE_URL + "subject/checking_deplicate_scode",
			    type: 'POST',
			    data: {value1: batch, value2: department, value3: group, value4: semester, value6: scode},
			    success: function (result)
			    {
				$("#dupli").html(result);
				len = ((result + '').length);
				if (len > 2) {
				    $("#add_subject").attr("disabled", true);
				} else {
				    $("#add_subject").attr("disabled", false);
				}
			    }
			});
	    }
	});
// update duplication-subject
	$(".u_subject").blur(function ()
	{
	    id = $(this).parent().parent().parent().parent().parent().find('.u_id').val();
	    batch = $(this).parent().parent().parent().parent().find('.u_batch').val(),
		    department = $(this).parent().parent().parent().parent().find('.u_department').val(),
		    group = $(this).parent().parent().parent().find('.u_group').val(),
		    semester = $(this).parent().parent().parent().parent().find('.u_semester').val(),
		    subject = $(this).val();
	    $.ajax(
		    {
			url: BASE_URL + "subject/update_checking_deplicate_sub",
			type: 'POST',
			data: {id: id, batch: batch, department: department, group: group, semester: semester, subject: subject},
			success: function (result)
			{

			    $(this).offsetParent().find('.subject_error').html(result);
			}
		    });
	});
	$('.staff_button').live('change', function () {

	    stf_button = $(".depar_value").val();
	    stf_id = $(".hide_depart").val();
	    var m = $("#com_error");
	    $('.btn-primary').prop('disabled', true);
	    if (stf_button == stf_id) {
		$('.btn-primary').prop('disabled', false);
		m.html('');
		$('#chk_valu').val(0);
	    } else
	    {
//alert('You could not subject to another Department');
		$('#chk_valu').val(1);
		m.html("You could not Add Subject to another Department.But you can Search!")
	    }
	}
	);
    });
// update duplication-nickname
    $(".u_nick").live('blur', function ()
    {
//alert('hi');
	id = $(this).parent().parent().parent().parent().parent().find('.u_id').val();
	batch = $(this).parent().parent().parent().parent().find('.u_batch').val(),
		department = $(this).parent().parent().parent().parent().find('.u_department').val(),
		group = $(this).parent().parent().parent().find('.u_group').val(),
		semester = $(this).parent().parent().parent().parent().find('.u_semester').val(),
		nick = $(this).val();
	$.ajax(
		{
		    url: BASE_URL + "subject/update_checking_deplicate_nick",
		    type: 'POST',
		    data: {id: id, batch: batch, department: department, group: group, semester: semester, nick: nick},
		    success: function (result)
		    {
			$(this).offsetParent().find('.nick_error').html(result);
		    }
		});
    });
// update duplication-scode
    $(".u_scode").live('blur', function ()
    {
//alert('hi');
	id = $(this).parent().parent().parent().parent().parent().find('.u_id').val();
	batch = $(this).parent().parent().parent().parent().find('.u_batch').val(),
		department = $(this).parent().parent().parent().parent().find('.u_department').val(),
		group = $(this).parent().parent().parent().find('.u_group').val(),
		semester = $(this).parent().parent().parent().parent().find('.u_semester').val(),
		scode = $(this).val();
	if (scode.trim().length > 0)
	{
	    $.ajax(
		    {
			url: BASE_URL + "subject/update_checking_deplicate_scode",
			type: 'POST',
			data: {id: id, batch: batch, department: department, group: group, semester: semester, scode: scode},
			success: function (result)
			{
			    $(this).offsetParent().find('.scode_error').html(result);
			}
		    });
	}
    });
    $('#group1').live('change', function () {


    });
</script>



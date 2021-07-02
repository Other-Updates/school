
<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
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
</script>
<a href="<?= $this->config->item('base_url') . 'staff/add_staff' ?>" class='btn btn-primary ight'>Add Staff</a>
<button type="button" class="btn btn-success add_bluk_import"><i class="icon-plus-circle2 position-left"></i> Import Staff</button>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
	<div class="modal-content">
	    <div class="modal-header bg-info">
		<h6 class="modal-title">Import Staff</h6>
	    </div>
	    <form action="<?php echo $this->config->item('base_url') . 'staff/import_staff'; ?>" enctype="multipart/form-data" name="" method="post" id="student_data">
		<div class="modal-body">
		    <div class="form-group">
			<div class="col-lg-12">
			    <div class="col-md-2"></div>
			    <div class="col-md-8">
				<div class="form-group">
				    <label><strong>Attachment:</strong></label>
				    <input type="file" name="staff_data" id="brand_data" class="form-control">
				    <span class="error_msg"></span>
				</div>
			    </div>

			    <div class="col-md-2"></div>
			</div>
		    </div>
		</div>
		<div class="modal-footer">
		    <button type="submit" name="submit" id="import" class="btn btn-success">Submit</button>
		    <button type="button" name="cancel" id="cancel" class="btn btn-warning" data-dismiss="modal">Cancel</button>
		</div>

	    </form>
	</div>
    </div>
</div>
<table style="float:right;width:420px;">
    <tr>

        <td style="width:100px;">
            <label>Class</label></td><td width="120"><select id='department' name='student_group'  class="u_department mandatory validate search " style="width:100px" >

                <option value="all">All</option>
		<?php
		if (isset($all_department) && !empty($all_department)) {
		    foreach ($all_department as $val) {
			?>
			<option value="<?= $val['id'] ?>"><?= $val['nickname'] ?></option>
			<?php
		    }
		}
		?>
            </select></td>
        <td style="width:100px;">
            <label>Staff Type</label></td><td ><select id="staff_type" class="" style="width:130px">
                <option value="all">All</option>
		<?php
		if (isset($staff_type) && !empty($staff_type)) {
		    foreach ($staff_type as $val2) {
			?>
			<option value="<?= $val2['id'] ?>"><?= ucfirst($val2['staff_type']) ?></option>
			<?php
		    }
		}
		?>
            </select></td>
    </tr>
</table>
<br />
<p>&nbsp;</p>
<div class="view">
</div>
<div class="staff">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No&nbsp;</th>
                <th>Image</th>
                <th>Staff Name</th>
                <th>Class</th>
                <th>Designation</th>
                <th>Email Id</th>
                <th>Mobile No</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
	    <?php
	    if (isset($all_staff) && !empty($all_staff)) {
		$i = 0;
		foreach ($all_staff as $val) {
		    $i++;
		    ?>
		    <tr>
			<td><?= $i; ?></td>
			<td><a href="#profile_img_<?= $val['id'] ?>" data-toggle="modal"><img class="staff_thumbnail" src="<?= $this->config->item('base_url') . 'profile_image/staff/thumb/' . $val['image'] ?>" width="100%" /></a></td>
			<td><?= $val['staff_name'] ?></td>
			<td><?= $val['nickname'] ?></td>
			<td><?= $val['designation'] ?></td>
			<td><?= $val['email_id'] ?></td>
			<td><?= $val['mobile_no'] ?></td>
			<td><?= date('d-M-Y', strtotime($val['ldt'])); ?></td>

			<td>
			    <a href="<?= $this->config->item('base_url') . 'staff/view_staff/' . $val['id'] ?>" title="View" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
			    <a href="<?= $this->config->item('base_url') . 'staff/update_staff/' . $val['id'] ?>" title="Edit" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
			    <!--<a href="<?= $this->config->item('base_url') . 'staff/delete_staff/' . $val['id'] ?>">Delete</a>-->
			    <a href="#delete_<?= $val['id'] ?>" title="Delete" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
			</td>
		    </tr>
		    <?php
		}
	    }
	    ?>
        </tbody>
    </table>
</div>
<?php
if (isset($all_staff) && !empty($all_staff)) {
    foreach ($all_staff as $val) {
	?>
	<div id="delete_<?= $val['id'] ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
	    <div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3 id="myModalLabel">Delete Staff</h3>
			<h3 id="myModalLabel"></h3>
		    </div>
		    <div class="modal-body">
			Are you sure you want to delete ?
		    </div>
		    <div class="modal-footer">
			<a href="<?= $this->config->item('base_url') . 'staff/delete_staff/' . $val['id'] ?>" type='button' class="btn btn-primary del_class">Yes</a>
			<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
		    </div>
		</div>
	    </div>
	</div>
	<?php
    }
}
?>
<script type="text/javascript">
    $('.add_bluk_import').click(function () {

	$('#myModal').modal({
	    backdrop: 'static',
	    keyboard: false
	});
	$('#myModal').modal('show');
    });
    $('#department').live('change', function () {
	depar_id = $('.u_department').val();
	$('#staff_type').val('');
	if (depar_id == 'all')
	{
	    $.ajax(
		    {
			url: BASE_URL + "staff/get_depat_staff_all",
			type: 'POST',
			data: {depart_id: 100000},
			success: function (result) {

			    $(".view").html(result);
			    $(".staff").hide();
			}
		    });
	} else
	{
	    $.ajax(
		    {
			url: BASE_URL + "staff/get_depat_staff",
			type: 'POST',
			data: {depart_id: depar_id},
			success: function (result) {

			    $(".view").html(result);
			    $(".staff").hide();
			}
		    });
	}
    });
    $("#staff_type").live('change', function ()
    {
	depar_id = $('.u_department').val();
	staff_type = $(this).val();
	if (depar_id == 'all' && staff_type == 'all')
	{
	    $.ajax(
		    {
			url: BASE_URL + "staff/get_depat_staff_all",
			type: 'POST',
			data: {depart_id: 100000},
			success: function (result) {

			    $(".view").html(result);
			    $(".staff").hide();
			}
		    });
	} else if (depar_id == 'all' && staff_type != 'all')
	{
	    $.ajax(
		    {
			url: BASE_URL + "staff/get_depat_staff_all_type",
			type: 'POST',
			data: {depart_id: 100000, staff_type: staff_type
			},
			success: function (result) {

			    $(".view").html(result);
			    $(".staff").hide();
			}
		    });
	} else if (depar_id != 'all' && staff_type != 'all')
	{
	    $.ajax(
		    {
			url: BASE_URL + "staff/get_staff_depat_type1",
			type: 'POST',
			data: {depart_id: depar_id, staff_type: staff_type
			},
			success: function (result) {

			    $(".view").html(result);
			    $(".staff").hide();
			}
		    });
	} else
	{
	    $.ajax(
		    {
			url: BASE_URL + "staff/get_depat_staff",
			type: 'POST',
			data: {depart_id: depar_id},
			success: function (result) {

			    $(".view").html(result);
			    $(".staff").hide();
			}
		    });

	}
    });
    $('.fright').live('click', function () {
	$('.search').show();
    });

</script>
<?php
if (isset($all_staff) && !empty($all_staff)) {
    foreach ($all_staff as $val) {
	?>
	<div id="profile_img_<?= $val['id'] ?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
	    <div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-body">
			<a class="close1" data-dismiss="modal">×</a>
			<img src="<?= $this->config->item('base_url') . 'profile_image/staff/orginal/' . $val['image'] ?>"  width="50%"/>
		    </div>
		</div>
	    </div>
	</div>
	<?php
    }
}
?>
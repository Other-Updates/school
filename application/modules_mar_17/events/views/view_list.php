<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<?php
$user = $this->user_auth->get_user_id();
$staff = $this->session->userdata('logged_in');
?>
<div id="view_all">
    <?php
    $user_det = $this->session->userdata('logged_in');
    $permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
    if ($permission[0]['event'] == 1) {
        ?>
        <p class="print_admin_use">
        <div><a href="<?= $this->config->item('base_url') . 'events/add_events' ?>" class='btn btn-primary'>Add events</a></div>
        <br /><br />
    </p>
<?php } ?>
<style type="text/css">
    .fb_iframe_widget{ float:right;}
</style>
<div id="fb-root" style="float:right;"></div>
<script>
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<br /><br />
<div>
    <table id="example1" class="table table-bordered table-striped dataTable">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Events Name</th>
                <th>Academic Year</th>
                <th>Class</th>
                <th>Type</th>
                <th>Venue</th>
                <th>Event Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (isset($details) && !empty($details)) {
                $i = 0;
                foreach ($details as $val) {
                    $i++
                    ?>

                    <?php /* ?><td><img class="staff_thumbnail" src="<?=$this->config->item('base_url').'profile_image/events/orginal/'.$val['image']?>" width="100%" />
                      <?php */ ?>


                    <tr>
                        <td><?php echo "$i"; ?></td>
                        </td>
                        <td><?= $val['event_name'] ?></td>

        <?php /* ?> <td><?=$val['from'].'-'.$val['to']?></td><?php */ ?>


                        <td>
                            <?php
                            if ($val['from'] == '' && $val['to'] == '')
                                echo "***";
                            else
                                echo $val['from'];
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($val['department'] == '')
                                echo "***";
                            else
                                echo $val['department'];
                            ?>
                        </td>
                        <?php /* ?> <td>
                          <?php
                          if($val['group']=='')
                          echo "***";
                          else
                          echo $val['group'];
                          ?>
                          </td><?php */ ?>

                        <td><?= $val['type'] ?></td>
                        <td><?= $val['venue'] ?></td>
                        <td><?= date('d-M-Y', strtotime($val['date'])); ?>
                        </td>
                        <td>
                            <a href="<?= $this->config->item('base_url') . 'events/view_events/' . $val['id'] ?>" class="btn bg-maroon btn-sm" title="View"><i class="fa fa-eye"></i></a>
                            <?php if ($val['user_id'] == $staff['user_id'] && $val['staff_type'] == $staff['staff_type']) {
                                ?>
                                <a href="<?= $this->config->item('base_url') . 'events/update_view/' . $val['id'] ?>" class="btn bg-navy btn-sm" title="Update"><i class="fa fa-edit"></i></a>
                                <!--<a href="<?= $this->config->item('base_url') . 'events/delete_events/' . $val['id'] ?>">Delete</a>-->
                                <a href="#delete_<?= $val['id'] ?>" data-toggle="modal" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-times"></i></a>
                                <?php
                            } else {
                                echo "";
                            }
                            ?>
                        </td>
                    </tr>


                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

</div>

<?php
if (isset($details) && !empty($details)) {
    foreach ($details as $val) {
        ?>
        <div id="delete_<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden=			        	"false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Events Action</h3>
                    </div>
                    <div class="modal-body">
                        Are You Sure Wanna Delete? &nbsp; <strong></strong>
                        <input type="hidden" value="<?php echo $val['id']; ?>" class="hidin" />
                    </div>
                    <div class="modal-footer">

                        <button class="btn btn-primary" id="inactive">Delete</button>
                        <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}
?>


<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#inactive").live("click", function ()
        {

            var id = $(this).parent().parent().find('.hidin').val();
            $.ajax({
                url: BASE_URL + "events/delete_events",
                type: 'POST',
                data: {value1: id},
                success: function (result) {

                    $("#view_all").html(result);
                    $("#view_all").html();
                }
            });
            $('.modal').css("display", "none");
            $('.fade').css("display", "none");
        });
        /* $("#yesin").live("click",function()
         {
         var hidin=$(this).parent().parent().find('.hidin').val();
         $.ajax({
         url:BASE_URL+"events/delete_events_inactive",
         type:'POST',
         data:{ value1 : hidin},

         success:function(result){

         $("#list_all").html(result);
         }

         });
         $('.modal').css("display", "none");
         $('.fade').css("display", "none");

         }); */
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

</script>
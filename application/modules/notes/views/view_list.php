<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<?php
$user = $this->user_auth->get_user_id();
$staff = $this->session->userdata('logged_in');
?>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
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
<!--<--shared_notes_view-->
<div id="view_all">
    <table id="example1" class="table table-bordered table-striped dataTable" width="100%">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Files</th>
                <th>Notes Title</th>
                <th>Subject</th>
                <th>Academic Year</th>
                <th>Class</th>
                <th>Section</th>
                <th>Term</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            if (isset($list) && !empty($list)) {
                foreach ($list as $val) {
                    //echo "<pre>"; print_r($val); exit;

                    $temp = explode(".", $val['image']);
                    $ext = end($temp);

                    $txt = 'txt';
                    $docx = 'docx';
                    $pdf = 'pdf';
                    $zip = 'zip';
                    $rar = 'rar';
                    $image = 'jpg';
                    $image1 = 'jpeg';
                    $image2 = '';
                    $doc = 'doc';
                    ?>
                    <tr>

                        <td><?= $i + 1 ?></td>
                        <td style="text-align:center;">
                            <?php
                            if ($ext == $txt) {
                                ?>

                                <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" target="_blank">
                                    <img class="img staff_thumbnail" id="bclah"  src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a></td>
                            <?php
                        } else if ($ext == $doc) {
                            ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" target="_blank">
                        <img id="bclah" class="img staff_thumbnail"  src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a></td>
                    <?php
                } else if ($ext == $pdf) {
                    ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" target="_blank">
                        <img id="bclah" class="img staff_thumbnail"  src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a></td>
                <?php } else if ($ext == $zip) {
                    ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" target="_blank">
                        <img id="bclah" class="img staff_thumbnail"  src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a></td>
                <?php } else if ($ext == $rar) {
                    ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" target="_blank">
                        <img id="bclah" class="img staff_thumbnail"  src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a></td>
                    <?php
                } else if ($ext == $image) {
                    ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" target="_blank">
                        <img  class="img staff_thumbnail" src="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . $val['image'] ?>"
                              /> </a>

                    <?php
                } else if ($ext == $image1) {
                    ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" target="_blank">
                        <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . $val['image'] ?>"
                             /></a>

                    <?php
                } else if ($ext == $docx) {
                    ?>
                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" target="_blank">
                        <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                    <?php
                } else if ($ext == $image2) {
                    ?>
                    <a href="<?= $theme_path; ?>/img/no.jpg" target="_blank">
                        <img id="blsah" class="img staff_thumbnail"  src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

        <?php } else { ?>

                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" target="_blank">
                        <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                <?php } ?>
                </td>
        <?php /* ?><?php } ?><?php */ ?>
                <td ><?= $val['note_title'] ?></td>
                <td><?php
                    if ($val['subject_id'] == 0) {
                        echo "**";
                    } else {
                        echo $val['subject_name'];
                    }
                    ?></td>
                <td ><?= $val['from']; ?></td>
                <td><?php
                    if ($val['depart_id'] == 0) {
                        echo "**";
                    } else {
                        echo $val['department'];
                    }
                    ?></td>
                <td><?php
                    if ($val['group_id'] == 0) {
                        echo "**";
                    } else {
                        echo $val['group'];
                    }
                    ?></td>
                <td ><?= $val['sem'] ?></td>
                <td ><?= date("d-M-Y", strtotime($val['ldt'])) ?></td>
                <form>
                    <td>
                        <?php if ($val['created_user'] == $staff['user_id'] && $val['staff_type'] == $staff['staff_type']) {
                            ?> <a href="#delete_batch<?php echo $val['id']; ?>" title="Remove" data-toggle="modal" name="group"
                               class="btn btn-danger">Delete</a> <?php
                           } else {
                               echo "**";
                           }
                           ?></td></td>
                </form>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
        </tbody>
    </table>
</div>




<?php
if (isset($list) && !empty($list)) {
    foreach ($list as $val) {
        //echo "<pre>"; print_r($rem); exit;
        ?>
        <div id="delete_batch<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Delete Notes</h3>
                    </div>
                    <div class="modal-body" >
                        <b>Are you sure you want to Remove Notes?
                            <input type="hidden" value="<?php echo $val['id']; ?>" class="id" /></b>
                    </div>
                    <div class="modal-footer">
                     <!--<input type="button" value="Yes"  class="btn btn-primary delete_yes"  />
                     <input type="button" value="No" class="btn btn-primary delete_all " id="no" />-->

                        <button type="button" id="r" class="remove_notes btn btn-primary" value="Remove"> <i class="fa fa-times"></i>Remove</button>
                        <button type="button" class="btn btn-danger delete_all" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
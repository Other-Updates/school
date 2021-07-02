<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<div class="message-container">
    <div class="message-form-content">
        <div class="message-form-header">
            <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/notes.png"></div>
            class Notes
        </div>
        <div class="message-form-inner">
            <div class="row">
                <div class="six columns">
                    <label class="field-name">Select Term :</label>
                    <select id='department' name='student_group'  class="semester mandatory">
                        <option value="">Select</option>

                        <?php
                        if (isset($semester) && !empty($semester)) {
                            foreach ($semester as $val) {
                                ?>
                                <option value="<?= $val['id'] ?>"><?= $val['semester'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>

                </div>
                <div class="six columns">
                    <label class="field-name">Select Subject :</label>
                    <div id="g_td">
                        <select id='group' name='student_group[group_id]'  class="f_subject value mandatory" disabled="disabled">
                            <option value="0">Select</option>
                        </select>
                    </div>
                </div>
            </div>
            <br />



            <div style="text-align:center; color:#69F; width:100%; padding:10px 0; "> Recently Added Notes *</div>
            <div id="back" style="max-height:555px; overflow-y:auto">
                <table class="table demo my_table_style">
                    <thead>

                        <tr>
                            <th>Files</th>
                            <th data-hide="phone,tablet">Subject</th>
                            <th>Posted By</th>
                            <th>Notes Title</th>
                            <th data-hide="phone">Date of post</th>
                            <th data-hide="phone,tablet">Download</th>
                        </tr>
                    </thead>
                    <?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

                    <?php
                    $i = 0;


                    if (isset($notes_share) && !empty($notes_share)) {
                        //print_r($notes_share); exit;
                        foreach ($notes_share as $val) {

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

                            <tr><td>
                                    <?php if ($ext == $txt) {
                                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                                            <img class="img" id="blah" width="50" height="50" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /></a>

                                    <?php
                                    } else if ($ext == $doc) {
                                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                                            <img id="blah" class="img" width="50" height="50" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /></a>
                                    <?php
                                    } else if ($ext == $docx) {
                                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                                            <img id="blah" class="img" width="50" height="50" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /></a>
                                    <?php
                                    } else if ($ext == $pdf) {
                                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                                            <img id="blah" class="img" width="50" height="50" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                                    <?php
                                    } else if ($ext == $zip) {
                                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                                            <img id="blah" class="img" width="50" height="50" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                                    <?php
                                    } else if ($ext == $rar) {
                                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                                            <img id="blah" class="img" width="50" height="50" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /></a>
                                    <?php
                                    } else if ($ext == $image) {
                                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                                            <img  class="img" src="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . $val['image'] ?>"
                                                  width="50" height="50"/> </a>

                                    <?php
                                    } else if ($ext == $image1) {
                                        ?>
                                        <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                                            <img class="img" src="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . $val['image'] ?>"
                                                 width="50" height="50"/> </a>

        <?php
        } else if ($ext == $image2) {
            ?>
                                        <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                                            <img id="blah" width="50" height="50" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

        <?php } else { ?>
                                        <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . rawurlencode($val['image']) ?>" download="<?= $val['image'] ?>">
                                            <img id="blacch" width="50" height="50" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                            <?php } ?></td>
                                <td><?= $val['subject_name'] ?></td>
                                <td style="text-align:center;"><?= $val['staff'][0]['staff_name'] ?></td>
                                <td><?= $val['note_title'] ?></td><td><?= date("d-M-Y", strtotime($val['ldt'])) ?></td>
                                <td>
                                    <a href="<?= $this->config->item('base_url') . 'profile_image/notes/original/' . $val['image'] ?>" download="<?= $val['image'] ?>">
                                        <img src="<?= $theme_path; ?>/images/download.png"  alt="notes" title="Download" /><?php $val['image'] ?> </button></a> </td></tr>

    <?php }
} else echo "<tr><td colspan='10' aline='center'>No records available</td> </tr>" ?>
                </table>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $('#department').live('change', function () {
        if ($(this).val() == "" || $(this).val() == null)
        {
            window.location.reload();
        } else
        {
            $('#group_id').prop('disabled', false);
        }
    });
    $('#group').live('change', function () {
        subj = $(".value").val(),
                sem = $(".semester").val();
        if (subj != 0 && sem != 0)
        {
            $.ajax({
                url: BASE_URL + "users/get_notes_by_subject",
                type: 'POST',
                data: {
                    value1: subj,
                    value2: sem

                },
                success: function (result) {
                    $('#back').html(result);

                    /*$('.modal-backdrop').hide();
                     $('.close_div').hide();*/
                }
            });
        }
    });


    $('#department').live('change', function () {
        department = $(".semester").val();

        $.ajax({
            url: BASE_URL + "users/get_all_sem_subje",
            type: 'POST',
            data: {
                value1: department

            },
            success: function (result) {
                $('#g_td').html(result);
                /*$('.modal-backdrop').hide();
                 $('.close_div').hide();*/
            }
        });


    });


</script>
<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<div id="list_all">
    <?php
    $user_det = $this->session->userdata('logged_in');
    if (isset($notice) && !empty($notice)) {
        foreach ($notice as $val) {
            if ($val['notice_type'] == 1) {

                if ($val['view_type'] == 1 && $user_det['user_id'] == $val['created_by'] && $user_det['staff_type'] == $val['staff_type']) {
                    ?>
                    <div class="my_notice notice">
                        <?php
                        if ($user_det['staff_type'] == 'admin') {
                            ?>
                            <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                            <?php
                        }
                        if ($user_det['staff_type'] == $val['staff_type'] && $user_det['user_id'] == $val['created_by']) {
                            ?>
                            <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                            <?php
                        }
                        ?>
                        <table width="100%" class="staff_table">

                            <tr>
                                <td width="10%">Posted By</td><td class="text_bold red"><?php echo ucfirst($val['staff'][0]['name']); ?></td>
                                <td>To Class</td><td class="text_bold">
                                    <?php
                                    if (isset($val['department'][0])) {
                                        echo $val['department'][0]['department'] . "&nbsp;-&nbsp;";
                                        if (isset($val['group'][0])) {
                                            echo $val['group'][0]['group'];
                                        }
                                    } else {
                                        echo "For all&nbsp;";
                                        if ($val['view_type'] == 0) {
                                            echo "";
                                        } else if ($val['view_type'] == 1) {
                                            echo "Student";
                                        } else if ($val['view_type'] == 2) {
                                            echo "Staff";
                                        } else if ($val['view_type'] == 3) {
                                            echo "";
                                        }
                                    }
                                    ?></td>
                                <td>From Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></td>
                                <td>Due Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></td>
                            </tr>
                            <tr>
                                <td>Notice</td><td colspan="5" class="text_bold"><?php echo $val['notice']; ?></td>
                                <?php
                                if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                                    $temp = explode(".", $val['notice_file']);
                                    $ext = end($temp);
                                    $txt = 'txt';
                                    $docx = 'docx';
                                    $pdf = 'pdf';
                                    $zip = 'zip';
                                    $rar = 'rar';
                                    $image = 'jpg';
                                    $image1 = 'jpeg';
                                    $image2 = 'bmp';
                                    $doc = 'doc';
                                    $image3 = 'png';
                                    $image4 = 'xps';
                                    ?>
                                    <td><?php
                                        if ($ext == $txt) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                                            <?php
                                        } else if ($ext == $doc) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                                            <?php
                                        } else if ($ext == $pdf) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                                        <?php } else if ($ext == $zip) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                                        <?php } else if ($ext == $rar) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                                            <?php
                                        } else if ($ext == $image) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                      /> </a>

                                            <?php
                                        } else if ($ext == $image1) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                     /></a>

                                            <?php
                                        } else if ($ext == $image2) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                     /></a>

                                            <?php
                                        } else if ($ext == $image3) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                     /></a>

                                            <?php
                                        } else if ($ext == $docx) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                                            <?php
                                        } else if ($ext == $image2) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                                        <?php } else {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                                        <?php } ?></td>
                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                    <?php
                } else if ($val['view_type'] == 0 || $val['view_type'] == 2 || $val['view_type'] == 3) {
                    if ($user_det['staff_type'] == 'staff') {
                        if ($val['depart_id'] == 0 || $val['depart_id'] == $user_det['department_id']) {
                            ?>
                            <div class="my_notice notice">
                                <?php
                                if ($user_det['staff_type'] == 'admin') {
                                    ?>
                                    <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                    <?php
                                }
                                if ($user_det['staff_type'] == $val['staff_type'] && $user_det['user_id'] == $val['created_by']) {
                                    ?>
                                    <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                    <?php
                                }
                                ?>
                                <table width="100%" class="staff_table">
                                    <tr>
                                        <td width="10%">Posted BY</td><td  class="text_bold red"><?php echo ucfirst($val['staff'][0]['name']); ?></td>
                                        <td >To Class</td><td class="text_bold">
                                            <?php
                                            if (isset($val['department'][0])) {
                                                echo $val['department'][0]['department'] . "&nbsp;-&nbsp;";
                                                if (isset($val['group'][0])) {
                                                    echo $val['group'][0]['group'];
                                                }
                                            } else {
                                                echo "For all&nbsp;";
                                                if ($val['view_type'] == 0) {
                                                    echo "";
                                                } else if ($val['view_type'] == 1) {
                                                    echo "Student";
                                                } else if ($val['view_type'] == 2) {
                                                    echo "Staff";
                                                } else if ($val['view_type'] == 3) {
                                                    echo "";
                                                }
                                            }
                                            ?></td>
                                        <td >From Date</td><td  class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></td>
                                        <td >Due Date</td><td  class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Notice</td><td colspan="5" class="text_bold"><?php echo $val['notice']; ?></td>
                                        <?php
                                        if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                                            $temp = explode(".", $val['notice_file']);
                                            $ext = end($temp);
                                            $txt = 'txt';
                                            $docx = 'docx';
                                            $pdf = 'pdf';
                                            $zip = 'zip';
                                            $rar = 'rar';
                                            $image = 'jpg';
                                            $image1 = 'jpeg';
                                            $image2 = 'bmp';
                                            $doc = 'doc';
                                            $image3 = 'png';
                                            $image4 = 'xps';
                                            ?>
                                            <td><?php
                                                if ($ext == $txt) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                                                    <?php
                                                } else if ($ext == $doc) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                                                    <?php
                                                } else if ($ext == $pdf) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                                                <?php } else if ($ext == $zip) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                                                <?php } else if ($ext == $rar) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                                                    <?php
                                                } else if ($ext == $image) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                              /> </a>

                                                    <?php
                                                } else if ($ext == $image1) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                             /></a>

                                                    <?php
                                                } else if ($ext == $image2) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                             /></a>

                                                    <?php
                                                } else if ($ext == $image3) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                             /></a>

                                                    <?php
                                                } else if ($ext == $docx) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                                                    <?php
                                                } else if ($ext == $image2) {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                                                <?php } else {
                                                    ?>
                                                    <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                        <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                                                <?php } ?></td>
                                        <?php } ?>
                                    </tr>
                                </table>
                            </div>
                            <?php
                        }
                    } else if ($user_det['staff_type'] == 'admin') {
                        ?>

                        <div class="my_notice notice">
                            <?php
                            if ($user_det['staff_type'] == 'admin') {
                                ?>
                                <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                <?php
                            }
                            if ($user_det['staff_type'] == $val['staff_type'] && $user_det['user_id'] == $val['created_by']) {
                                ?>
                                <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                <?php
                            }
                            ?>

                            <table width="100%" class="staff_table">
                                <tr>
                                    <td width="10%">Posted BY</td><td class="text_bold red"><?php echo ucfirst($val['staff'][0]['name']); ?></td>
                                    <td>To Class</td><td class="text_bold">
                                        <?php
                                        if (isset($val['department'][0])) {
                                            echo $val['department'][0]['department'] . "&nbsp;-&nbsp;";
                                            if (isset($val['group'][0])) {
                                                echo $val['group'][0]['group'];
                                            }
                                        } else {
                                            echo "For all&nbsp;";
                                            if ($val['view_type'] == 0) {
                                                echo "";
                                            } else if ($val['view_type'] == 1) {
                                                echo "Student";
                                            } else if ($val['view_type'] == 2) {
                                                echo "Staff";
                                            } else if ($val['view_type'] == 3) {
                                                echo "";
                                            }
                                        }
                                        ?></td>
                                    <td>From Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></td>
                                    <td>Due Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></td>
                                </tr>
                                <tr>
                                    <td>Notice</td><td colspan="5" class="text_bold"><?php echo $val['notice']; ?></td>
                                    <?php
                                    if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                                        $temp = explode(".", $val['notice_file']);
                                        $ext = end($temp);
                                        $txt = 'txt';
                                        $docx = 'docx';
                                        $pdf = 'pdf';
                                        $zip = 'zip';
                                        $rar = 'rar';
                                        $image = 'jpg';
                                        $image1 = 'jpeg';
                                        $image2 = 'bmp';
                                        $doc = 'doc';
                                        $image3 = 'png';
                                        $image4 = 'xps';
                                        ?>
                                        <td><?php
                                            if ($ext == $txt) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                                                <?php
                                            } else if ($ext == $doc) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                                                <?php
                                            } else if ($ext == $pdf) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                                            <?php } else if ($ext == $zip) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                                            <?php } else if ($ext == $rar) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                                                <?php
                                            } else if ($ext == $image) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                          /> </a>

                                                <?php
                                            } else if ($ext == $image1) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                                <?php
                                            } else if ($ext == $image2) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                                <?php
                                            } else if ($ext == $image3) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                                <?php
                                            } else if ($ext == $docx) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                                                <?php
                                            } else if ($ext == $image2) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                                            <?php } else {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                                            <?php } ?></td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                }
            } else if ($val['notice_type'] == 0) {

                if ($user_det['staff_type'] == 'staff') {
                    if ($val['view_type'] == 1 && $user_det['user_id'] == $val['created_by'] && $user_det['staff_type'] == $val['staff_type']) {
                        ?>
                        <div class="my_notice notice">
                            <?php
                            if ($user_det['staff_type'] == 'admin') {
                                ?>
                                <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                <?php
                            }
                            if ($user_det['staff_type'] == $val['staff_type'] && $user_det['user_id'] == $val['created_by']) {
                                ?>
                                <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                <?php
                            }
                            ?>
                            <table width="100%" class="staff_table">
                                <tr>
                                    <td width="10%">Posted BY</td><td class="text_bold red"><?php echo ucfirst($val['staff'][0]['name']); ?></td>
                                    <td>To Class</td><td class="text_bold">
                                        <?php
                                        if (isset($val['department'][0])) {
                                            echo $val['department'][0]['department'] . "&nbsp;-&nbsp;";
                                            if (isset($val['group'][0])) {
                                                echo $val['group'][0]['group'];
                                            }
                                        } else {
                                            echo "For all&nbsp;";
                                            if ($val['view_type'] == 0) {
                                                echo "";
                                            } else if ($val['view_type'] == 1) {
                                                echo "Student";
                                            } else if ($val['view_type'] == 2) {
                                                echo "Staff";
                                            } else if ($val['view_type'] == 3) {
                                                echo "";
                                            }
                                        }
                                        ?></td>
                                    <td>From Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></td>
                                    <td>Due Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></td>
                                </tr>
                                <tr>
                                    <td>Notice</td><td colspan="5" class="text_bold"><?php echo $val['notice']; ?></td>
                                    <?php
                                    if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                                        $temp = explode(".", $val['notice_file']);
                                        $ext = end($temp);
                                        $txt = 'txt';
                                        $docx = 'docx';
                                        $pdf = 'pdf';
                                        $zip = 'zip';
                                        $rar = 'rar';
                                        $image = 'jpg';
                                        $image1 = 'jpeg';
                                        $image2 = 'bmp';
                                        $doc = 'doc';
                                        $image3 = 'png';
                                        $image4 = 'xps';
                                        ?>
                                        <td><?php
                                            if ($ext == $txt) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                                                <?php
                                            } else if ($ext == $doc) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                                                <?php
                                            } else if ($ext == $pdf) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                                            <?php } else if ($ext == $zip) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                                            <?php } else if ($ext == $rar) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                                                <?php
                                            } else if ($ext == $image) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                          /> </a>

                                                <?php
                                            } else if ($ext == $image1) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                                <?php
                                            } else if ($ext == $image2) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                                <?php
                                            } else if ($ext == $image3) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                                <?php
                                            } else if ($ext == $docx) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                                                <?php
                                            } else if ($ext == $image2) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                                            <?php } else {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                                            <?php } ?></td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    if ($val['view_type'] == 0 || $val['view_type'] == 2 || $val['view_type'] == 3) {
                        ?>
                        <div class="my_notice notice">
                            <?php
                            if ($user_det['staff_type'] == 'admin') {
                                ?>
                                <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                <?php
                            }
                            if ($user_det['staff_type'] == $val['staff_type'] && $user_det['user_id'] == $val['created_by']) {
                                ?>
                                <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                                <?php
                            }
                            ?>
                            <table width="100%" class="staff_table">
                                <tr>
                                    <td width="10%">Posted By</td><td class="text_bold red"><?php echo ucfirst($val['staff'][0]['name']); ?></td>
                                    <td>To Class</td><td class="text_bold">
                                        <?php
                                        if (isset($val['department'][0])) {
                                            echo $val['department'][0]['department'] . "&nbsp;-&nbsp;" . $val['group'][0]['group'];
                                        } else {
                                            echo "For all&nbsp;";
                                            if ($val['view_type'] == 0) {
                                                echo "";
                                            } else if ($val['view_type'] == 1) {
                                                echo "Student";
                                            } else if ($val['view_type'] == 2) {
                                                echo "Staff";
                                            } else if ($val['view_type'] == 3) {
                                                echo "";
                                            }
                                        }
                                        ?></td>
                                    <td>From Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></td>
                                    <td>Due Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></td>
                                </tr>
                                <tr>
                                    <td>Notice</td><td colspan="5" class="text_bold"><?php echo $val['notice']; ?></td>
                                    <?php
                                    if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                                        $temp = explode(".", $val['notice_file']);
                                        $ext = end($temp);
                                        $txt = 'txt';
                                        $docx = 'docx';
                                        $pdf = 'pdf';
                                        $zip = 'zip';
                                        $rar = 'rar';
                                        $image = 'jpg';
                                        $image1 = 'jpeg';
                                        $image2 = 'bmp';
                                        $doc = 'doc';
                                        $image3 = 'png';
                                        $image4 = 'xps';
                                        ?>
                                        <td><?php
                                            if ($ext == $txt) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                                                <?php
                                            } else if ($ext == $doc) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                                                <?php
                                            } else if ($ext == $pdf) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                                            <?php } else if ($ext == $zip) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                                            <?php } else if ($ext == $rar) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                                                <?php
                                            } else if ($ext == $image) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                          /> </a>

                                                <?php
                                            } else if ($ext == $image1) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                                <?php
                                            } else if ($ext == $image2) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                                <?php
                                            } else if ($ext == $image3) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                         /></a>

                                                <?php
                                            } else if ($ext == $docx) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                                                <?php
                                            } else if ($ext == $image2) {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                                            <?php } else {
                                                ?>
                                                <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                    <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                                            <?php } ?></td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                } else if ($user_det['staff_type'] == 'admin') {
                    ?>
                    <div class="my_notice notice">
                        <?php
                        if ($user_det['staff_type'] == 'admin') {
                            ?>
                            <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                            <?php
                        }
                        if ($user_det['staff_type'] == $val['staff_type'] && $user_det['user_id'] == $val['created_by']) {
                            ?>
                            <a href="#delete_<?php echo $val["id"]; ?>" title="Delete Notice" data-toggle="modal" name="group" class="btn btn-danger btn-sm notice_close"><i class="fa fa-times"></i></a>
                            <?php
                        }
                        ?>
                        <table width="100%" class="staff_table">
                            <tr>
                                <td width="10%">Posted By</td><td class="text_bold red"><?php echo ucfirst($val['staff'][0]['name']); ?></td>
                                <td>To Class</td><td class="text_bold">
                                    <?php
                                    if (isset($val['department'][0])) {
                                        echo $val['department'][0]['department'] . "&nbsp;-&nbsp;" . $val['group'][0]['group'];
                                    } else {
                                        echo "For all&nbsp;";
                                        if ($val['view_type'] == 0) {
                                            echo "";
                                        } else if ($val['view_type'] == 1) {
                                            echo "Student";
                                        } else if ($val['view_type'] == 2) {
                                            echo "Staff";
                                        } else if ($val['view_type'] == 3) {
                                            echo "";
                                        }
                                    }
                                    ?></td>
                                <td>From Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_from'])); ?></td>
                                <td>Due Date</td><td class="text_bold"><?php echo date('d-M-Y', strtotime($val['notice_to'])); ?></td>
                            </tr>
                            <tr>
                                <td>Notice</td><td colspan="5" class="text_bold"><?php echo $val['notice']; ?></td>
                                <?php
                                if (isset($val['notice_file']) && !empty($val['notice_file'])) {
                                    $temp = explode(".", $val['notice_file']);
                                    $ext = end($temp);
                                    $txt = 'txt';
                                    $docx = 'docx';
                                    $pdf = 'pdf';
                                    $zip = 'zip';
                                    $rar = 'rar';
                                    $image = 'jpg';
                                    $image1 = 'jpeg';
                                    $image2 = 'bmp';
                                    $doc = 'doc';
                                    $image3 = 'png';
                                    $image4 = 'xps';
                                    ?>
                                    <td><?php
                                        if ($ext == $txt) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img class="staff_thumbnail img" id="blah12" src="<?= $theme_path; ?>/img/notepad.png"  alt="notes" /> </a>
                                            <?php
                                        } else if ($ext == $doc) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>
                                            <?php
                                        } else if ($ext == $pdf) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blccah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/pdf.png"  alt="notes" /></a>
                                        <?php } else if ($ext == $zip) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/zip.png"  alt="notes" /></a>
                                        <?php } else if ($ext == $rar) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="bcclah" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/rar.png"  alt="notes" /> </a>
                                            <?php
                                        } else if ($ext == $image) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img  class="staff_thumbnail img" src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                      /> </a>

                                            <?php
                                        } else if ($ext == $image1) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                     /></a>

                                            <?php
                                        } else if ($ext == $image2) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                     /></a>

                                            <?php
                                        } else if ($ext == $image3) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img class="img staff_thumbnail"  src="<?= $this->config->item('base_url') . 'notice/' . $val['notice_file'] ?>"
                                                     /></a>

                                            <?php
                                        } else if ($ext == $docx) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/word.png"  alt="notes" /> </a>

                                            <?php
                                        } else if ($ext == $image2) {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blccah" class="img staff_thumbnail" src="<?= $theme_path; ?>/img/no1.jpg"  alt="notes" /></a>

                                        <?php } else {
                                            ?>
                                            <a href="<?= $this->config->item('base_url') . 'notice/' . rawurlencode($val['notice_file']) ?>" download="<?= $val['notice_file'] ?>">
                                                <img id="blacch" class="staff_thumbnail img" src="<?= $theme_path; ?>/img/g1.jpg"  alt="notes" /> </a>
                                        <?php } ?></td>
                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                    <?php
                }
            }
        }
    }
    ?>
</div>

<?php
if (isset($notice) && !empty($notice)) {
    foreach ($notice as $val) {
        ?>
        <div id="close">
            <div id="delete_<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal">×</a>
                            <h3 id="myModalLabel">Delete Notice</h3>
                        </div>
                        <div class="modal-body" >
                            Are you sure want to Delete?
                            <input type="hidden" value="<?php echo $val['id']; ?>" class="hid" />

                        </div>
                        <div class="modal-footer">
                            <input type="button" value="Yes" id="yes" class="btn btn-primary delete"  />
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>


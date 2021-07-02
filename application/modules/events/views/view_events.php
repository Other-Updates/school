<div class="row">
    <div class="col-lg-6">

        <?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
        <?php
        if (isset($events_info) && !empty($events_info)) {
            foreach ($events_info as $val) {
                ?>
                <table class="staff_table">
                    <td>Events name</td>
                    <td class="text_bold"><?php echo $val['event_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Events Date</td>
                        <td class="text_bold"><?php echo $val['date']; ?></td>
                    <span id="v2" style="color:#F00;"></span></td>
                    </tr>
                    <tr>
                        <td>Academic Year</td>
                        <td class="text_bold">
                            <?php
                            if ($val['from'] == '' && $val['to'] == '')
                                echo "***";
                            else
                                echo $val['from'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Class</td>
                        <td class="text_bold">
                            <?php
                            if ($val['department'] == '')
                                echo "***";
                            else
                                echo $val['department'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td class="text_bold"><?php echo $val['type']; ?></td>
                    </tr>
                    <tr>
                        <td>Venue</td>
                        <td class="text_bold"><?php echo $val['venue']; ?></td>
                    </tr>

                    <?php
                }
                ?>
                <?php
            }
            ?>
            </tr>

            </tbody>
        </table>
        <input type="button" value="Back" class="btn btn-danger" onClick="history.go(-1);return true;">
    </div>
    <div class="col-lg-6">
        <img class="add_staff_thumbnail1" src="<?= $this->config->item('base_url') . 'profile_image/events/orginal/' . $val['image'] ?>" />
    </div>
</div>
<br />




<div>
    <table id="example1" class="table table-bordered table-striped">
        <h1 id="myModalLabel" style="font-size: 28px;">PARTICIPATED STUDENTS DETAILS:</h1>
        <thead>
            <tr>
                <th>S.no</th>
                <th>Student Name</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Batch</th>
                <th>Class</th>
                <th>Section</th>
            </tr>
        </thead>
        <?php
        if (isset($students) && !empty($students)) {
            $i = 0;
            foreach ($students as $bil) {
                $i++
                ?>
                <tr>
                    <td><?php echo "$i"; ?></td>
                    <td><?php echo $bil['name']; ?></td>
                    <td><?php echo $bil['email']; ?></td>
                    <td><?php echo $bil['phone']; ?></td>
                    <td><?php echo $bil['batch']; ?></td>
                    <td><?php echo $bil['depart']; ?></td>
                    <td><?php echo $bil['group']; ?></td>
                </tr>
                <?php
            }
        }
        ?>

    </table>
</div>

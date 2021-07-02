<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script type="text/javascript">


    // mobile validation
    $("#phone").live('blur', function ()
    {
        var phone = $("#phone").val();
        var filter = /^[0-9]{10,12}$/;
        var m = $("#phone_error");
        if (!filter.test(phone))
        {
            m.html("Minimum 10 to 12 characters");

        } else
        {
            m.html("");
        }
    });
    // address validation
    $("#address").live('blur', function ()
    {

        var address = $("#address").val();
        var m = $("#add_error");
        //alert(address.length);
        if (address.length < 6 || address.length > 250)
        {

            m.html("Minimum 6 to 250 characters");

        } else
        {
            m.html("");
        }
    });
    // password validation
    $("#new_password").live('blur', function ()
    {
        //alert("hi");
        var pass = $("#new_password").val();
        var filter = /^((?=.*[a-zA-Z])(?=.*\d)(?=.*[#@%$]).{6,20})$/;
        var m = $("#pass_error");
        if (pass == null || pass == "" || pass.trim().length == 0)
        {
            m.html("Required field");
        } else if (!filter.test(pass))
        {
            m.html("Minimum 6 to 20 characters");

        } else
        {
            m.html("");
        }
    });


</script>
<div class="row">
    <form class="editprofileform" method="post" action="<?php echo $this->config->item('base_url'); ?>staff_tickets/staff_profile_update" enctype="multipart/form-data" name="sform">
        <div class="col-md-3 profile-left">

            <h4>Your Profile Photo</h4>

            <div class="profilethumb">

                <a href="#">size 120*140</a>
                <img id="blah" class="add_staff_thumbnail" src="<?= $this->config->item("base_url") . 'profile_image/staff/orginal/' . $staff_details[0]['image']; ?>"/>

                <input type='file' name="staff_image" id="imgInp" />
                <span id="size_error" style="color:#F00;"></span>
            </div><!--profilethumb-->

        </div>
        <div class="col-md-9">


            <br>

            <h4>Official Details</h4>
            <table width="100%" class="staff_table">
                <tbody>
                    <tr>
                        <td width="30%">Name</td>
                        <td>:</td>
                        <td class="text_bold"><?php echo $staff_details[0]['staff_name'];
; ?></td>
                    </tr>
                    <tr>
                        <td>Class</td>
                        <td width="2%" >:</td>
                        <td class="text_bold"><?php echo $staff_details[0]['department']; ?></td>

                    </tr>
                    <tr>
                        <td>Designation</td>
                        <td>:</td>
                        <td class="text_bold"><?php echo $staff_details[0]['designation']; ?></td>
                    </tr>


                    <tr>
                        <td >E-Mail</td>
                        <td >:</td>
                        <td class="text_bold"><?php echo $staff_details[0]['email_id']; ?></td>
                    </tr>
                </tbody>
            </table>
            <h4>Password Change</h4>
            <table width="100%">
                <tr>
                    <td width="9%"><label>New Password</label></td>

                    <td><input type="password" name="new_password" id="new_password"  class="input-xlarge"><span style="color:#F00;" id="pass_error" class="confirmMessage"></span></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><label>Confirm&nbsp;Password</label></td>

                    <td><input type="password" name="con_password" id="con_password"  class="input-xlarge" onchange="checkPass();
                            return false;">

                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><span style="color:#F00;" id="confirmMessage" class="confirmMessage"></span></td>
                </tr>
                <tr>

                    <td>&nbsp;</td>
                    <td style="padding:0 0 0 2px;">
                        <input type="button" class="btn btn-primary delete"  name="update" id="change" value="Change" onclick="change_password();" />
                        <input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel" value="Cancel" />
                    </td>
                </tr>
            </table>
            <h4>Personal Details</h4>
            <table width="100%"  class="staff_table">
                <tbody>
                    <tr>
                        <td width="30%" >Date Of Birth</td>
                        <td width="2%" >:</td>
                        <td class="text_bold"><?php echo date("d-m-Y", strtotime($staff_details[0]['dob'])); ?></td>

                    </tr>

                    <tr>
                        <td width="30%" >Date Of Joining</td>
                        <td width="2%" >:</td>
                        <td class="text_bold"><?php echo date("d-m-Y", strtotime($staff_details[0]['join_date'])); ?></td>

                    </tr>
                    <tr>
                        <td>Mobile No</td>
                        <td>:</td>
                        <td class="text_bold"><input type="text" name="phone" id="phone" class="int_val" maxlength="12" value="<?php echo $staff_details[0]['mobile_no']; ?>"  /><span style="color:#F00;" id="phone_error"></span></td>


                    </tr>

                </tbody>
            </table>
            <br />
            <h4>Communication Address</h4>
            <table width="100%"  class="staff_table">
                <tbody>
                    <tr>
                        <td width="30%">Address</td>
                        <td width="2%">:</td>
                        <td class="text_bold">
                            <textarea name="address" id="address"><?php echo $staff_details[0]['address']; ?></textarea>
                            <span style="color:#F00;" id="add_error"></span>
                        </td>
                    </tr>
                </tbody>
            </table>


            <table width="100%"  class="staff_table">
                <tbody>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td class="text_bold"><?php echo $staff_details[0]['country']; ?></td>
                    </tr>

                    <tr>
                        <td width="30%">State</td>
                        <td width="2%">:</td>
                        <td class="text_bold"><?php echo $staff_details[0]['state']; ?></td>
                    </tr>
                    <tr>
                        <td>Postal Code</td>
                        <td>:</td>
                        <td class="text_bold"><?php echo $staff_details[0]['postal_code']; ?></td>
                    </tr>

                </tbody>
            </table>
            <table width="100%"  class="staff_table">

                <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td><input type="submit" name="submit" value="Update" class="btn btn-primary delete" /></td>
                    </tr>
                </tbody>
            </table>
            <br />
            <h4>Educational Details</h4>
            <table width="100%" class="staff_table_sub">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Examination</th>
                        <th>Board</th>
                        <th>Percentage (%)</th>
                        <th>Year of Passing</th>
                    </tr>
                </thead>
                <tbody>
<?php
$i = 1;
if (isset($staff_details['qualification'][0]) && !empty($staff_details['qualification'][0])) {
    foreach ($staff_details['qualification'][0] as $val) {
        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $val['examination'] ?></td>
                                <td><?= $val['borad'] ?></td>
                                <td><?= $val['percentage'] ?></td>
                                <td><?= $val['p_year'] ?></td>
                            </tr>
        <?php
        $i++;
    }
}
?>
                </tbody>
            </table>

    </form>
</div>
</div>
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
    $('#imgInp').bind('change', function () {

        //alert(this.files[0].size);
        if (this.files[0].size > 1048576)
        {
            var size_error = "Profile Image:maximum size 1MB";
            $("#size_error").html(size_error);

        } else
        {
            document.getElementById("size_error").innerHTML = "";
        }

    });
    function readImage(file) {

        var reader = new FileReader();
        var image = new Image();

        reader.readAsDataURL(file);
        reader.onload = function (_file) {
            image.src = _file.target.result;              // url.createObjectURL(file);
            image.onload = function () {
                var w = this.width,
                        h = this.height,
                        t = file.type, // ext only: // file.type.split('/')[1],
                        n = file.name,
                        s = ~~(file.size / 1024) + 'KB';
                $('#blah').attr('src', e.target.result);
            };
            image.onerror = function () {
                var type_error = "Invalid file type:";
                $("#size_error").html(type_error);

                //alert('Invalid file type: '+ file.type);
            };
        };

    }
    $("#imgInp").change(function (e) {
        if (this.disabled)
            return alert('File upload not supported!');
        var F = this.files;
        if (F && F[0])
            for (var i = 0; i < F.length; i++)
                readImage(F[i]);
    });
    $(document).ready(function ()
    {
        $("#change_password").click(function ()
        {
            $("#password").show();
        });
        $("#cancel").click(function ()
        {
            $("#new_password").val('');
            $("#con_password").val('');
            $("#confirmMessage").html('');
            $("#pass_error").html('');
            $("#con_password").css("background-color", "");

        });
        $("form[name=sform]").submit(function ()
        {
            var i = 0;
            var message1 = $("#size_error").html();
            var phone = $("#phone").val();
            var address = $("#address").val();
            var add_error = $("#add_error");
            var phone_error = $("#phone_error");
            var filter = /^[0-9]{10,12}$/;
            if (!filter.test(phone))
            {
                i = 1;
                phone_error.html("Minimum 10 to 12 characters");
            }
            if (address.length < 6 || address.length > 250)
            {

                i = 1;
                add_error.html("Minimum 6 to 250 characters");

            }

            // password validation
            if (i == 1 || message1.trim().length > 0)
            {

                return false;
            } else
            {

                return true;
            }

        });

    });

</script>
<script type="text/javascript">
    function checkPass()
    {
        //Store the password field objects into variables ...
        var pass1 = document.getElementById('new_password');
        var pass2 = document.getElementById('con_password');
        //Store the Confimation Message Object ...
        var message = document.getElementById('confirmMessage');
        //Set the colors we will be using ...
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        //Compare the values in the password field
        //and the confirmation field
        if ((pass1.value != "" || pass1.value != null) && (pass2.value != "" || pass2.value != null))
        {
            if (pass1.value == pass2.value) {
                //The passwords match.
                //Set the color to the good color and inform
                //the user that they have entered the correct password
                pass2.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "Passwords Match!"
            } else {
                //The passwords do not match.
                //Set the color to the bad color and
                //notify the user.
                pass2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Passwords Do Not Match!"
            }
        }
    }
    function change_password()
    {

        var i = 0;
        var message1 = $("#confirmMessage");
        var message2 = $("#pass_error");
        var con_password = $("#con_password").val();
        var new_password = $("#new_password").val();

        if (new_password == '' || con_password == '')
        {
            message1.html("Required Field");
            message2.html("Required Field");
            i = 1;
        } else if (new_password != con_password)
        {
            message1.html("Passwords Do Not Match!");
            i = 1;
        }
        if (i == 0 && message2.html().trim().length == 0)
        {
            for_loading('Changing Password...');
            $.ajax({
                url: BASE_URL + "staff_tickets/staff_password_change",
                type: 'POST',
                data: {new_password: new_password,
                },
                success: function (result) {

                    for_response('Password Changed Successfully...');
                    //alert(result);
                    // window.location.href=BASE_URL+"admin/logout";


                }

            });
            $("#new_password").val('');
            $("#con_password").val('');
            $("#pass_error").html('');
            $("#confirmMessage").html('');
            $("#con_password").css("background-color", "");
        } else
        {

        }



    }
</script>
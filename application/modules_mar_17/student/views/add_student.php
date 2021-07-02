<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<script type="text/javascript">
    $(document).ready(function ()
    {
        //$("#firstname").focus();
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
                    $("#v18").html("Enter valid email");
                } else
                {
                    $.ajax({
                        url: BASE_URL + "student/checking_email_insert",
                        type: 'POST',
                        data: {value1: email},
                        success: function (result) {
                            $("#v18").html(result);
                        }

                    });

                }
            }
        });

        $("#checking_studentid").blur(function ()
        {
            //alert("hi");
            var student_id = $("#checking_studentid").val();
            // var checking_studentid=$("#checking_studentid").val();
            if (student_id == "" || student_id == null || student_id.trim().length == 0)
            {
                $("#v4").html("Required Field");

            } else
            {

                $.ajax({
                    url: BASE_URL + "student/checking_studentid_insert",
                    type: 'POST',
                    data: {student_id: student_id},
                    success: function (result) {
                        // alert(result);

                        $("#v4").html(result);

                    }

                });
            }
        });


        $("#regno").blur(function ()
        {

            var regno = $("#regno").val();
            //alert(regno);
            if (regno.trim().length == 0)
            {
            } else
            {
                $.ajax({
                    url: BASE_URL + "student/checking_regno_insert",
                    type: 'POST',
                    data: {value1: regno},
                    success: function (result) {
                        //alert(result);
                        $("#re_dup").html(result);

                    }

                });
            }
        });
        $("form[name=sform]").submit(function ()
        {
            var message1 = document.getElementById('errormessage').innerHTML;
            var message2 = document.getElementById('error_studentid').innerHTML;
            var message3 = document.getElementById('re_dup').innerHTML;

            if ((message1.trim()).length > 0 && (message2.trim()).length > 0)
            {

                return false;
            } else if ((message1.trim()).length > 0)
            {

                return false;
            } else if ((message2.trim()).length > 0)
            {

                return false;
            } else if ((message3.trim()).length > 0)
            {
                return false;
            } else
            {

                return true;
            }

        });
    });
</script>
<script>
    function validateForm()

    {
        var i = 0;
        var firstname = $("#firstname").val();
        var filter = /^[a-zA-Z.\s]{3,30}$/;
        if (firstname == "")
        {
            $("#v1").html("Required Field");
            i = 1;
        } else if (!filter.test(firstname))
        {
            $("#v1").html("Alphabets and Min 3 to Max 30 ");
            i = 1;
        } else
        {
            $("#v1").html("");
        }
        var lastname = $("#lastname").val();
        var filter = /^[a-zA-Z.\s]{1,20}$/;
        if (lastname == "")
        {
            $("#v2").html("Required Field");
            i = 1;
        } else if (!filter.test(lastname))
        {
            $("#v2").html("Alphabets and Max 20 ");
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
        var checking_studentid = $("#checking_studentid").val();
        if (checking_studentid == "")
        {
            $("#v4").html("Required Field");
            i = 1;
        } else
        {
            $("#v4").html("");
        }
        var fathername = $("#fathername").val();
        var filter = /^[a-zA-Z.\s]{3,20}$/;
        if (fathername == "")
        {
            $("#v5").html("Required Field");
            i = 1;
        } else if (!filter.test(fathername))
        {
            $("#v5").html("Alphabets and Min 3 to Max 20 ");
            i = 1;
        } else
        {
            $("#v5").html("");
        }
        var dob = $("#reservation").val();
        if (dob == "")
        {
            $("#v6").html("Required Field");
            i = 1;
        } else
        {
            $("#v6").html("");
        }
        var city = $("#city").val();
        if (city == "")
        {
            $("#v7").html("Required Field");
            i = 1;
        } else
        {
            $("#v7").html("");
        }
        var batch_id = $("#batch_id").val();
        if (batch_id == "")
        {
            $("#v8").html("Required Field");
            i = 1;
        } else
        {
            $("#v8").html("");
        }
        var state = $("#state").val();
        if (state == "")
        {
            $("#v9").html("Required Field");
            i = 1;
        } else
        {
            $("#v9").html("");
        }
        var depart_id = $("#depart_id").val();
        if (depart_id == "")
        {
            $("#v10").html("Required Field");
            i = 1;
        } else
        {
            $("#v10").html("");
        }
        var country = $("#country").val();
        if (country == "")
        {
            $("#v11").html("Required Field");
            i = 1;
        } else
        {
            $("#v11").html("");
        }
        var parent_no = $("#parent_no").val();
        var filter = /^[0-9]{10,12}$/;
        if (parent_no == "")
        {
            $("#v12").html("Required Field");
            i = 1;
        } else if (!filter.test(parent_no))
        {
            $("#v12").html("Numeric only and length 10 to 12");
            i = 1;
        } else
        {
            $("#v12").html("");
        }
        var postal_code = $("#postal_code").val();
        if (postal_code == "")
        {
            $("#v13").html("Required Field");
            i = 1;
        } else if (postal_code.length != 6)
        {

            $("#v13").html("Maximum 6 characters");
            i = 1;

        } else
        {
            $("#v13").html("");
        }
        var student_contact = $("#student_contact").val();
        var filter = /^[0-9]{10,12}$/;
        if (student_contact == "")
        {
            $("#v14").html("Required Field");
            i = 1;
        } else if (!filter.test(student_contact))
        {
            $("#v14").html("Numeric only and length 10 to 12");
            i = 1;
        } else
        {
            $("#v14").html("");
        }
        var join_date = $("#join_date").val();
        if (join_date == "")
        {
            $("#v16").html("Required Field");
            i = 1;
        } else
        {
            $("#v16").html("");
        }
        var emgy_no = $("#emgy_no").val();
        var filter = /^[0-9]{10,12}$/;
        if (emgy_no == "")
        {
            $("#v17").html("Required Field");
            i = 1;
        } else if (!filter.test(emgy_no))
        {
            $("#v17").html("Numeric only and length 10 to 12");
            i = 1;
        } else
        {
            $("#v17").html("");
        }
        var checking_email = $("#checking_email").val();
        if (checking_email == "")
        {
            $("#v18").html("Required Field");
            i = 1;
        } else
        {
            $("#v18").html("");
        }
        var password = $("#password").val();
        var filter = /^((?=.*[a-zA-Z])(?=.*\d)(?=.*[#@%$]).{6,20})$/;
        if (password == "")
        {
            $("#v19").html("Required Field");
            i = 1;
        } else if (!filter.test(password))
        {
            $("#v19").html("Minimum 6 characters(Ex:A@b2c#)");
            i = 1;
        } else
        {
            $("#v19").html("");
        }
        var stdtype = $("#stdtype").val();
        if (stdtype == "0")
        {
            $("#v21").html("Required Field");
            $("#stdtype").css('border', '1px solid #F00');
            i = 1;
        } else
        {
            $("#v21").html("");
            $("#stdtype").css('border', '1px solid #CCCCCC');
        }

        var transport = $("#transport").val();
        if (transport == "0")
        {
            $("#v23").html("Required Field");
            $("#transport").css('border', '1px solid #F00');
            i = 1;
        } else
        {
            $("#v23").html("");
            $("#transport").css('border', '1px solid #CCCCCC');
        }
        var hostel = $("#stdhostel").val();
        if (hostel == "")
        {
            $("#v24").html("Required Field");
            $('#stdhostel').css('border', '1px solid #F00');
        } else
        {
            $("#v24").html("");
            $('#stdhostel').css('border', '1px solid #CCCCCC');
        }
        var scholae = $("#scholae").val();
        if (scholae == "")
        {
            $("#v25").html("Required Field");
            i = 1;
        } else
        {
            $("#v25").html("");
        }
        var first = $("#firestgrat").val();
        if (first == "")
        {
            $("#v26").html("Required Field");
            i = 1;
        } else
        {
            $("#v26").html("");
        }
        if (i == 1)
        {
            return false;
        } else
        {
            for_loading('Adding Student...!');

            return true;

        }
    }
</script>
<script>
    $("#firstname").live('blur', function ()
    {
        var firstname = $("#firstname").val();
        var filter = /^[a-zA-Z.\s]{3,30}$/;
        if (firstname == "")
        {
            $("#v1").html("Required Field");
        } else if (!filter.test(firstname))
        {
            $("#v1").html("Alphabets and Min 3 to Max 30 ");
        } else
        {
            $("#v1").html("");
        }
    });
    $("#lastname").live('blur', function ()
    {
        var lastname = $("#lastname").val();
        var filter = /^[a-zA-Z.\s]{1,20}$/;
        if (lastname == "")
        {
            $("#v2").html("Required Field");
        } else if (!filter.test(lastname))
        {
            $("#v2").html("Alphabets and Max 20 ");
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
    /*$("#checking_studentid").live('blur',function()
     {
     var checking_studentid=$("#checking_studentid").val();
     if(checking_studentid=="")
     {
     $("#v4").html("Required Field");

     }
     else
     {
     $("#v4").html("");
     }
     });*/
    $("#fathername").live('blur', function ()
    {
        var fathername = $("#fathername").val();
        var filter = /^[a-zA-Z.\s]{3,20}$/;
        if (fathername == "")
        {
            $("#v5").html("Required Field");
        } else if (!filter.test(fathername))
        {
            $("#v5").html("Alphabets and Min 3 to Max 20 ");
        } else
        {
            $("#v5").html("");
        }
    });
    $("#reservation").live('blur', function ()
    {
        var dob = $("#reservation").val();
        if (dob == "")
        {
            $("#v6").html("Required Field");
        } else
        {
            $("#v6").html("");
        }
    });
    $("#city").live('blur', function ()
    {
        var city = $("#city").val();
        if (city == "")
        {
            $("#v7").html("Required Field");
        } else
        {
            $("#v7").html("");
        }
    });

    $("#batch_id").live('blur', function ()
    {

        var batch_id = $("#batch_id").val();
        if (batch_id == "")
        {
            $("#v8").html("Required Field");
        } else
        {
            $("#v8").html("");
        }
    });
    $("#state").live('blur', function ()
    {
        var state = $("#state").val();
        if (state == "")
        {
            $("#v9").html("Required Field");
        } else
        {
            $("#v9").html("");
        }
    });
    $("#depart_id").live('blur', function ()
    {
        var depart_id = $("#depart_id").val();
        if (depart_id == "")
        {
            $("#v10").html("Required Field");
        } else
        {
            $("#v10").html("");
        }
    });
    $("#country").live('blur', function ()
    {
        var country = $("#country").val();
        if (country == "")
        {
            $("#v11").html("Required Field");
        } else
        {
            $("#v11").html("");
        }
    });
    $("#parent_no").live('blur', function ()
    {
        var parent_no = $("#parent_no").val();
        var filter = /^[0-9]{10,12}$/;
        if (parent_no == "")
        {
            $("#v12").html("Required Field");
        } else if (!filter.test(parent_no))
        {
            $("#v12").html("Numeric only and length 10 to 12");
        } else
        {
            $("#v12").html("");
        }
    });
    $("#postal_code").live('blur', function ()
    {
        var postal_code = $("#postal_code").val();
        if (postal_code == "")
        {
            $("#v13").html("Required Field");
        } else if (postal_code.length != 6)
        {

            $("#v13").html("Maximum 6 characters");

        } else
        {
            $("#v13").html("");
        }
    });
    $("#student_contact").live('blur', function ()
    {
        var student_contact = $("#student_contact").val();
        var filter = /^[0-9]{10,12}$/;
        if (student_contact == "")
        {
            $("#v14").html("Required Field");
        } else if (!filter.test(student_contact))
        {
            $("#v14").html("Numeric only and length 10 to 12");
        } else
        {
            $("#v14").html("");
        }
    });
    $("#join_date").live('blur', function ()
    {
        var join_date = $("#join_date").val();
        if (join_date == "")
        {
            $("#v16").html("Required Field");
        } else
        {
            $("#v16").html("");
        }
    });
    $("#emgy_no").live('blur', function ()
    {
        var emgy_no = $("#emgy_no").val();
        var filter = /^[0-9]{10,12}$/;
        if (emgy_no == "")
        {
            $("#v17").html("Required Field");
        } else if (!filter.test(emgy_no))
        {
            $("#v17").html("Numeric only and length 10 to 12");
        } else
        {
            $("#v17").html("");
        }
    });
    $("#checking_email").live('blur', function ()
    {
        var checking_email = $("#checking_email").val();
        if (checking_email == "")
        {
            $("#v18").html("Required Field");
        } else
        {
            $("#v18").html("");
        }
    });
    $("#password").live('blur', function ()
    {
        var password = $("#password").val();
        var filter = /^((?=.*[a-zA-Z])(?=.*\d)(?=.*[#@%$]).{6,20})$/;
        if (password == "")
        {
            $("#v19").html("Required Field");
        } else if (!filter.test(password))
        {
            $("#v19").html("Minimum 6 characters(Ex:A@b2c#)");
        } else
        {
            $("#v19").html("");
        }
    });
    /*$("#chat").live('change',function()
     {
     var chat=$("#chat").val();
     if(chat=="")
     {
     $("#v20").html("Required Field");
     }
     else
     {
     $("#v20").html("");
     }
     });*/
    $("#stdtype").live('blur', function ()
    {
        var stdtype = $("#stdtype").val();
        if (stdtype == "0")
        {
            $("#v21").html("Required Field");
            $(this).css('border', '1px solid #F00');

        } else
        {
            $("#v21").html("");
            $(this).css('border', '1px solid #CCCCCC');
        }
    });
    $("#transport").live('blur', function ()
    {

        var transport = $("#transport").val();
        if (transport == "0")
        {
            $("#v23").html("Required Field");
            $(this).css('border', '1px solid #F00');
        } else
        {
            $("#v23").html("");
            $(this).css('border', '1px solid #CCCCCC');
        }
    });
    $("#stdhostel").live('blur', function ()
    {

        var hostel = $("#stdhostel").val();
        if (hostel == "")
        {
            $("#v24").html("Required Field");
            $(this).css('border', '1px solid #F00');
        } else
        {
            $("#v24").html("");
            $(this).css('border', '1px solid #CCCCCC');
        }
    });
    $("#scholae").live('change', function ()
    {
        var scholae = $("#scholae").val();
        if (scholae == "")
        {
            $("#v25").html("Required Field");
        } else
        {
            $("#v25").html("");
        }
    });
    $("#firestgrat").live('change', function ()
    {
        var first = $("#firestgrat").val();
        if (first == "")
        {
            $("#v26").html("Required Field");
        } else
        {
            $("#v26").html("");
        }
    });
</script>

<form method="post"  enctype="multipart/form-data" name="sform" onsubmit="return validateForm();">
    <table class="staff_table">
        <tr>
            <td width="130">First Name</td>
            <td><input type="text" name='student[name]' class="mandatory"  onkeypress="return validateAlphabets(event);" id="firstname" tabindex="1"/>
                <span id="v1" style="color:#F00;" class="val"></span></td>
            <td>Last Name</td>
            <td><input type="text" name='student[last_name]' class="mandatory"  onkeypress="return validateAlphabets(event);" id="lastname" tabindex="2" />
                <span id="v2" style="color:#F00;" class="val"></span></td>
            <td>&nbsp;</td>
            <td rowspan="4" >
                <div class="staff_img">
                    <a href="#">size 120*140</a>
                    <img id="blah" class="add_staff_thumbnail" src="<?= $theme_path; ?>/img/avatar5.png"  alt="Student Image" />
                    <p>&nbsp;</p>
                    <input type='file' name="staff_image" id="imgInp" tabindex="4" /><span id="v22" class="val" style="color:#F00;"></span>
                </div>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:top">Address</td>
            <td colspan="3"><textarea tabindex="3" style="width:100%; height:50px;" name='student_details[address]' class="mandatory" id="address"></textarea>
                <span id="v3" style="color:#F00;" class="val"></span></td></td>
            <td></td>
        </tr>
        <tr>
            <td>Roll No</td>
            <td><input type="text" tabindex="5"  name='student[std_id]' class="mandatory" id="checking_studentid" /><span style="color:red;" id="error_studentid"></span>
                <span id="v4" style="color:#F00;" class="val"></span> </td> </td>
            <td>Father's / Guardians Name</td>
            <td><input type="text"  name='student_details[parent_name]' onkeypress="return validateAlphabets(event);" class="mandatory" id="fathername" tabindex="11"  />
                <span id="v5"  style="color:#F00;" class="val"></span></td>
            <td></td>
        </tr>
        <tr>
            <td>DOB</td>
            <td><input type="text"  name='student_details[dob]' class="form-control pull-left date mandatory" id="reservation" tabindex="6" />
                <br />   <span id="v6" style="color:#F00;" class="val"></span></td>
            <td>City</td>
            <td><input type="text" name='student_details[city]' class="mandatory"  onkeypress="return validateAlphabets(event);" id="city" tabindex="12" />
                <span id="v7" style="color:#F00;" class="val" ></span></td>
            <td></td>
        </tr>
        <tr>
            <td>Academic Year</td>
            <td>
                <select id='batch_id' name='student[batch_id]'  class="mandatory" tabindex="7" >
                    <?php
                    if (isset($all_batch) && !empty($all_batch)) {

                        foreach ($all_batch as $val1) {
                            ?>
                            <option value="<?= $val1['id'] ?>"><?php echo $val1['from']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select><span id="v8" style="color:#F00;" class="val"></span>
            </td>
            <td>State</td>
            <td><input type="text"  name='student_details[state]'  onkeypress="return validateAlphabets(event);" class="mandatory" id="state" tabindex="13"/>
                <span id="v9" style="color:#F00;" class="val"></span></td>
            <td>Application Number</td>
            <td>
                <input type="text"  name='student_details[admission_form_no]'   class="mandatory"  tabindex="13"/>
            </td>
        </tr>
        <tr>
            <td>Class</td>
            <td>
                <select id='depart_id' name='student_group[depart_id]'  class=" mandatory" tabindex="8">
                    <option value="">Select</option>
                    <?php
                    if (isset($all_depart) && !empty($all_depart)) {
                        foreach ($all_depart as $val) {
                            ?>
                            <option value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select><span id="v10"  style="color:#F00;" class="val"></span>
            </td>
            <td>Country</td>
            <td><input type="text"  name='student_details[country]' class="mandatory" onkeypress="return validateAlphabets(event);" id="country" tabindex="14"  />
                <span id="v11"  style="color:#F00;" class="val"></span></td>
            <td>Parent's / Guardians Mob No

            </td>
            <td><input type="text"  name='student_details[parent_no]' class="mandatory int_val" id="parent_no" tabindex="19" maxlength="12" />
                <span id="v12"  style="color:#F00;" class="val"></span></td></td>
        </tr>
        <tr>
            <td>Section</td>
            <td id='g_td'>
                <select id='group_id' name='student_group[group_id]' class="mandatory" tabindex="9">
                    <option value="">Select</option>
                </select>
            </td>
            <td>Postal Code</td>
            <td><input type="text"  name='student_details[postal_code]' class="mandatory int_val" id="postal_code" tabindex="15" maxlength="6" /><span id="v13" style="color:#F00;" class="val"></span></td>
            <td>Alternate Mobile No </td>
            <td><input type="text"  name='student[contact_no]' class="mandatory int_val" id="student_contact" maxlength="12" tabindex="20"/>
                <span id="v14" style="color:#F00;" class="val"></span></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>
                <input type="radio" name='student[gender]' id="my_radio" class="mandatory" value='male' tabindex="10"/> Male <input type="radio" name='student[gender]' value='female' id="my_radio1" tabindex="10"/> Female<span id="v15"></span>
            </td>

            <td>Joining Date</td>
            <td>
                <input type="text" class='date mandatory' name='student_details[join_date]'  id="join_date" tabindex="16"/>
                <span id="v16" style="color:#F00;" class="val"></span>
            </td>
            <td> Emergency Contact No
            </td>
            <td> <input type="text"  name='student_details[emgy_no]' class="mandatory int_val" id="emgy_no" maxlength="12" tabindex="21" />
                <span id="v17" style="color:#F00;" class="val"></span></td>
        </tr>
        <tr>
            <td>Parent's / Guardians Email Id</td>
            <td>
                <input type="text"  name='student[email_id]' id="checking_email" class="mandatory" tabindex="17"  /><span style="color:red;" id="errormessage"></span> <span id="v18" style="color:#F00;" class="val"></span>

            </td>
            <td>Password</td>
            <td>
                <input type="password" tabindex="18"  name='student[pwd]' class="mandatory" id="password" /><span id="v19" style="color:#F00;" class="val"></span>
            </td>
            <td>Chat Option</td>
            <td>
                <select name='student[chat]' class="mandatory" id="chat" tabindex="22">
                    <option value=''>Select</option>
                    <option value='1'>Enable</option>
                    <option value='0'>Disable</option>
                </select><span id="v20" style="color:#F00;" class="val"></span>
            </td>
        </tr>
        <tr>
            <td>Register No</td>
            <td><input type="text" name='student[regno]' class="" id="regno" tabindex="23"/>
                <span id="re_dup" style="color:#F00" class="val"></span></td>

            <td>Scholarship</td>
            <td>
                <select id='scholae' name='student[scholarship]' tabindex="24"  class="mandatory">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select><span id="v25" style="color:#F00;" class="val"></span>
            </td>
            <td class="tab1">First Graduate</td>
            <td class="tab1">
                <select id='firestgrat' name='student[graduate]' tabindex="25" class="mandatory">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select><span id="v26" style="color:#F00;" class="val"></span>
            </td>
        </tr>
        <tr>
            <td>Student Type</td>
            <td>
                <select id='stdtype' name='student[student_type]'  class="" tabindex="26">
                    <option value="0">Select</option>
                    <option value="1">Management</option>
                    <option value="2">Counselling</option>
                </select><span id="v21" style="color:#F00;" class="val"></span>
            </td>
            <td class="trans">Transport</td>
            <td class="trans">
                <select id='transport' name='student[transport]' tabindex="27">
                    <option>Select</option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                </select>
                <!--<span id="v23" style="color:#F00;" class="val"></span>-->
            </td>
            <td  class="hostel">Hostel</td>
            <td  class="hostel">
                <select id='stdhostel' name='student[hostel]' tabindex="28" >
                    <option>Select</option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                </select>
              <!-- <span id="v24" style="color:#F00;" class="val"></span>-->
            </td>
        </tr>

    </table>

    <br />
    <table style="display:none;">
        <tr id="last_row" >
            <td class="dy_no"></td>
            <td><input type="text" name='qualification[exam][]'/></td>
            <td><input type="text" name='qualification[borad][]'/></td>
            <td><input type="text" name='qualification[per][]'/></td>
            <td><input type="text" name='qualification[pass][]'/></td>
            <td><input type="button" value="-" class='remove_comments btn bg-purple btn-sm'/></td>
        </tr>
    </table>
    <table id='app_table'>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Examination</th>
                <th>Board</th>
                <th>Percentage (%)</th>
                <th>Year of Passing</th>
                <th><input type="button" value="+" class='add_row btn bg-purple btn-sm'/></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><input type="text" name='qualification[exam][]' id="col"  tabindex="29" /></td>
                <td><input type="text" name='qualification[borad][]' id="col1" tabindex="30" /></td>
                <td><input type="text" name='qualification[per][]' class="float_val" id="col2" tabindex="31" /></td>
                <td><input type="text"  name='qualification[pass][]' class="int_val" id="col3" tabindex="32" /></td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td><input type="text" name='qualification[exam][]' id="col4" tabindex="33"/></td>
                <td><input type="text" name='qualification[borad][]' id="col5" tabindex="34" /></td>
                <td><input type="text" name='qualification[per][]' class="float_val"  id="col6" tabindex="35"/></td>
                <td><input type="text" name='qualification[pass][]'  class="int_val" id="col7"  tabindex="36" /></td>
                <td></td>
            </tr>
            <tr>
                <td>3</td>
                <td><input type="text" name='qualification[exam][]' id="col8" tabindex="37" /></td>
                <td><input type="text" name='qualification[borad][]' id="col9" tabindex="38" /></td>
                <td><input type="text" name='qualification[per][]' class="float_val" id="col10" tabindex="39" /></td>
                <td><input type="text" name='qualification[pass][]'  class="int_val" id="col11" tabindex="40" /></td>
                <td></td>
            </tr>
            <tr>
                <td>4</td>
                <td><input type="text" name='qualification[exam][]' tabindex="41"/></td>
                <td><input type="text" name='qualification[borad][]' tabindex="42"/></td>
                <td><input type="text" name='qualification[per][]' tabindex="43" /></td>
                <td><input type="text" name='qualification[pass][]' tabindex="44" /></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <br />
    <input type="reset" value="Cancel" id="cancel" class="btn btn-danger" style="float:left"/>
    <div class="right"><input type="submit" value="submit" class="btn btn-primary" id="submit"></div>
    <br />
    <br />
</form>



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
    //image size checking
    $("#imgInp").change(function () {
        //alert("hi");

        var val = $(this).val();

        switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
            case 'gif':
            case 'jpg':
            case 'png':
            case 'jpeg':
            case '':
                $("#v22").html("");
                break;
            default:
                $(this).val();
                // error message here
                $("#v22").html("Invalid File Type");
                break;
        }
    });
    /*$('#imgInp').bind('change', function() {

     //alert(this.files[0].size);
     if(this.files[0].size>1048576)
     {
     var size_error="Profile Image:maximum size 1MB";
     $("#v22").xdshtml(size_error);

     }
     else
     {

     }

     });*/
    $('.add_row').click(function () {
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
    $('#depart_id').live('change', function () {
        d_id = $(this);
        $.ajax({
            url: BASE_URL + "student/get_all_group",
            type: 'POST',
            data: {
                depart_id: d_id.val()

            },
            success: function (result) {
                $('#g_td').html(result);
                //$('#group_id').focus();
                /*$('.modal-backdrop').hide();
                 $('.close_div').hide();*/
            }
        });
    });

    // cancel
    $("#cancel").live("click", function ()
    {
        $('.val').html('');
        $('.mandatory').css('border', '1px solid #CCCCCC');
        $("#transport").css('border', '1px solid #CCCCCC');
        $("#stdtype").css('border', '1px solid #CCCCCC');
        $('#stdhostel').css('border', '1px solid #CCCCCC');
        $("#blah").replaceWith('<img id="blah" class="add_staff_thumbnail" src="<?= $theme_path; ?>/img/avatar5.png"  alt="Staff Image" />');
        //$('.erro').html();

    });
    $("form[name=sform]").submit(function ()
    {

        var message = $("#v22").html();
        if (message.trim().length > 0)
        {

            return false;
        } else
        {
            return true;
        }

    });
</script>


<script type="text/javascript">
    $(document).ready(function () {
        $(".trans").change(function () {
            $("select option:selected").each(function () {
                if ($(this).attr("value") == "2") {
                    $(".hostel").show();
                }
                if ($(this).attr("value") == "1") {
                    $(".hostel").hide();
                    $("#stdhostel").val("");
                }
            });
        }).change();
    });
</script>

<script type="text/javascript">
    $(function () {
        //Datemask dd/mm/yyyy
        /*  $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
         //Datemask2 mm/dd/yyyy
         $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
         //Money Euro
         $("[data-mask]").inputmask();*/
        /*
         //Date range picker
         $('#reservation').daterangepicker();
         //Date range picker with time picker
         $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
         //Date range as a button
         $('#daterange-btn').daterangepicker(
         {
         ranges: {
         'Today': [moment(), moment()],
         'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
         'Last 7 Days': [moment().subtract('days', 6), moment()],
         'Last 30 Days': [moment().subtract('days', 29), moment()],
         'This Month': [moment().startOf('month'), moment().endOf('month')],
         'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
         },
         startDate: moment().subtract('days', 29),
         endDate: moment()
         },
         function(start, end) {
         $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
         }
         );

         //iCheck for checkbox and radio inputs
         $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
         checkboxClass: 'icheckbox_minimal',
         radioClass: 'iradio_minimal'
         });
         //Red color scheme for iCheck
         $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
         checkboxClass: 'icheckbox_minimal-red',
         radioClass: 'iradio_minimal-red'
         });
         //Flat red color scheme for iCheck
         $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
         checkboxClass: 'icheckbox_flat-red',
         radioClass: 'iradio_flat-red'
         });

         //Colorpicker
         $(".my-colorpicker1").colorpicker();
         //color picker with addon
         $(".my-colorpicker2").colorpicker();
         */
        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#checking_email").blur(function ()
        {

            var email = $("#checking_email").val(), stid = $("#st_id").val();
            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            //alert(email);
            if (!filter.test(email))
            {
                $("#error_msg").html("Enter valid email");
            } else
            {
                $.ajax({
                    url: BASE_URL + "student/checking_email_update",
                    type: 'POST',
                    data: {value1: email, value2: stid},
                    success: function (result) {

                        $("#error_msg").html(result);

                    }

                });
            }
        });
        // checking student id
        $("#checking_studentid").blur(function ()
        {
            //alert("hi");
            var student_id = $("#checking_studentid").val(), stid = $("#st_id").val();

            $.ajax({
                url: BASE_URL + "student/checking_studentid_update",
                type: 'POST',
                data: {student_id: student_id, stid: stid},
                success: function (result) {
                    // alert(result);

                    $("#error_studentid").html(result);

                }

            });

        });
        $("#reg_no").blur(function ()
        {

            var regno = $("#reg_no").val();
            var id = $('#st_id').val();
            //alert(reg_no);
            if (regno.trim().length == 0)
            {
            } else
            {
                $.ajax({
                    url: BASE_URL + "student/checking_regno_update",
                    type: 'POST',
                    data: {value1: regno, value2: id},
                    success: function (result) {
                        //alert(result);
                        $("#up_dup").html(result);

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

<!--<script>
function validateform()
{


        // First Name Validation
        var name = document.getElementById('firstname').value;
        var filter= /^[a-zA-Z.\s]{3,20}$/;
        if (!filter.test(name))
        {
                 document.getElementById("v1").style.display = "block";
                 return false;
        }
        else
        {
                 document.getElementById("v1").style.display = "none";
        }
                        // Last Name Validation
                        var name = document.getElementById('lastname').value;
                        var filter= /^[a-zA-Z.\s]{1,20}$/;
                        if (!filter.test(name))
                        {
                                 document.getElementById("v2").style.display = "block";
                                 return false;
                        }
                        else
                        {
                                 document.getElementById("v2").style.display = "none";
                        }
        // Address Validation
        var address=document.getElementById('address').value;
        if(address='' || address<=3 || address>=200)
        {
                document.getElementById("v3").style.display = "block";
                return false;
        }
        else
        {
                document.getElementById("v3").style.display = "none";
        }

                                // Studend Id validation
                                var staff=document.getElementById('checking_studentid').value;
                                if(staff=='')
                                {
                                        document.getElementById("v4").style.display = "block";
                                        return false;
                                }
                                else
                                {
                                        document.getElementById("v4").style.display = "none";
                                }
        // Fathers Name Validation
        var name = document.getElementById('fathername').value;
        var filter= /^[a-zA-Z.\s]{3,20}$/;
        if (!filter.test(name))
        {
                 document.getElementById("v5").style.display = "block";
                 return false;
        }
        else
        {
                 document.getElementById("v5").style.display = "none";
        }
                                // DOB Validation
                                var dob=document.getElementById('reservation').value;
                                if(dob=='')
                                {
                                        document.getElementById("v6").style.display = "block";
                                        return false;
                                }
                                else
                                {
                                        document.getElementById("v6").style.display = "none";
                                }
        // City Validation
        var country=document.getElementById('city').value;
        if(country=='')
        {
                document.getElementById("v7").style.display = "block";
                return false;
        }
        else
        {
                document.getElementById("v7").style.display = "none";
        }
                                //Batch validation
                                var e = document.getElementById("batch_id");
                                var strUser = e.options[e.selectedIndex].value;

                                var strUser1 = e.options[e.selectedIndex].text;
                                if(strUser==0)
                                {
                                        document.getElementById("v8").style.display = "block";
                                        return false;
                                }
                                else
                                {
                                        document.getElementById("v8").style.display = "none";
                                }
        // State Validation
        var state=document.getElementById('state').value;
        if(state=='')
        {
                document.getElementById("v9").style.display = "block";
                return false;
        }
        else
        {
                document.getElementById("v9").style.display = "none";
        }
                                //Class validation
                                var e = document.getElementById("depart_id");
                                var strUser = e.options[e.selectedIndex].value;

                                var strUser1 = e.options[e.selectedIndex].text;
                                if(strUser==0)
                                {
                                        document.getElementById("v10").style.display = "block";
                                        return false;
                                }
                                else
                                {
                                        document.getElementById("v10").style.display = "none";
                                }
        // Country Validation
        var state=document.getElementById('country').value;
        if(state=='')
        {
                document.getElementById("v11").style.display = "block";
                return false;
        }
        else
        {
                document.getElementById("v11").style.display = "none";
        }
                                //Parent Mobile Validation
                                var phone = document.getElementById('parent_no').value;
                                var filter=/^[0-9]{10,12}$/;
                                if (!filter.test(phone))
                                {
                                         document.getElementById("v12").style.display = "block";
                                         return false;
                                }
                                else
                                {
                                         document.getElementById("v12").style.display = "none";
                                }
        //Postal code Validation
        var postal = document.getElementById('postal_code').value;
        b=postal.length;
        if(postal=='' || isNaN(postal) || b!=6)
        {
                 document.getElementById("v13").style.display = "block";
                 return false;
        }
        else
        {
                 document.getElementById("v13").style.display = "none";
        }
                                //Parent Mobile Validation
                                var phone = document.getElementById('student_contact').value;
                                var filter=/^[0-9]{10,12}$/;
                                if (!filter.test(phone))
                                {
                                         document.getElementById("v14").style.display = "block";
                                         return false;
                                }
                                else
                                {
                                         document.getElementById("v14").style.display = "none";
                                }
                /*var gender=document.getElementById('gender').value;
        if(gender=='')
        {
                document.getElementById("v15").style.display = "block";
                return false;
        }
        else
        {
                document.getElementById("v15").style.display = "none";
        }*/
                                //Join Date
                                var date=document.getElementById('join_date').value;
                                if(date=='')
                                {
                                         document.getElementById("v16").style.display = "block";
                                         return false;
                                }
                                else
                                {
                                         document.getElementById("v16").style.display = "none";
                                }
        //Parent Mobile Validation
        var phone = document.getElementById('emgy_no').value;
        var filter=/^[0-9]{10,12}$/;
        if (!filter.test(phone))
        {
                 document.getElementById("v17").style.display = "block";
                 return false;
        }
        else
        {
                 document.getElementById("v17").style.display = "none";
        }
                                //Password Validation
                                var password = document.getElementById('password').value;
                                var filter=/^((?=.*[a-zA-Z])(?=.*\d)(?=.*[#@%$]).{6,20})$/;
                                if (!filter.test(password))
                                {
                                         document.getElementById("v18").style.display = "block";
                                         return false;
                                }
                                else
                                {
                                         document.getElementById("v18").style.display = "none";
                                }
}
</script>-->


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
        var chat = $(".chat").val();
        if (chat == "a")
        {
            //alert(chat);
            $("#v20").html("Required Field");
            i = 1;
        } else
        {
            $("#v20").html("");
        }
        var stdtype = $("#std_type").val();
        if (stdtype == "")
        {
            $("#v21").html("Required Field");
            $("#std_type").css('border', '1px solid #F00');
            i = 1;
        } else
        {
            $("#v21").html("");
            $("#stdtype").css('border', '1px solid #CCCCCC');
        }

        /*var transport=$("#transport").val();
         if(transport=="0")
         {
         $("#v23").html("Required Field");
         $("#transport").css('border','1px solid #F00');
         i=1;
         }
         else
         {
         $("#v23").html("");
         $("#transport").css('border','1px solid #CCCCCC');
         }
         var hostel=$("#stdhostel").val();
         if(hostel=="")
         {
         $("#v24").html("Required Field");
         $('#stdhostel').css('border','1px solid #F00');
         }
         else
         {
         $("#v24").html("");
         $('#stdhostel').css('border','1px solid #CCCCCC');
         }*/
        var mess = $('#error_msg').html();
        if (mess.trim().length > 0)
        {
            i = 1;
        }
        var messs = $('#error_studentid').html();
        if (messs.trim().length > 0)
        {
            i = 1;
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


<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<form method="post"  enctype="multipart/form-data" name="sform" onsubmit="return validateForm();">
    <table class="staff_table">
        <tr>
            <td>First Name</td>
            <td><input type="text" name='student[name]' value='<?= $student_info[0]['name'] ?>' id="firstname"/><input type="hidden" id="st_id" value="<?= $student_info[0]['id'] ?>" onkeypress="return validateAlphabets(event);" />
                <span id="v1" style="color:#F00;" class="val"></span></td>
            <td>Last Name</td>
            <td><input type="text" name='student[last_name]' value='<?= $student_info[0]['last_name'] ?>' onkeypress="return validateAlphabets(event);" id="lastname" />
                <span id="v2" style="color:#F00;" class="val"></span> </td>
            <td>&nbsp;</td>
            <td rowspan="4" >
                <div class="staff_img">
                    <a href="#">size 120*140</a>
                    <img id="blah" class="add_staff_thumbnail" src="<?= $this->config->item('base_url'); ?>/profile_image/student/orginal/<?= $student_info[0]['image'] ?>"  alt="Student Image" />
                    <p>&nbsp;</p>
                    <input type='file' name="staff_image" id="imgInp" />
                </div>
            </td>
        </tr>
        <tr>
            <td>Address</td>
            <td colspan="3"><textarea  name='student_details[address]' style="width:97%;height:50px" id="address"><?= $student_info[0]['address'] ?></textarea>
                <span id="v3" style="color:#F00;" class="val"> </td>
            <td></td>
        </tr>
        <tr>
            <td>Roll No</td>
            <td><input type="text"  name='student[std_id]' value='<?= $student_info[0]['std_id'] ?>' id="checking_studentid" class="" /><span style="color:red;" id="error_studentid"></span>
                <span id="v4" style="color:#F00;" class="val"></span></td>
            <td>Father's / Guardians Name</td>
            <td><input type="text" value='<?= $student_info[0]['parent_name'] ?>'  name='student_details[parent_name]' id="fathername" onkeypress="return validateAlphabets(event);"/>
                <span id="v5"  style="color:#F00;" class="val"></span></td>
            <td></td>
        </tr>
        <tr>
            <td>DOB</td>
            <td><input type="text"  name='student_details[dob]' class='date' value='<?= date("d-m-Y", strtotime($student_info[0]['dob'])) ?>' id="reservation"/>
                <span id="v6" style="color:#F00;" class="val"></span>
            </td>
            <td>City</td>
            <td><input type="text" name='student_details[city]' value='<?= $student_info[0]['city'] ?>' onkeypress="return validateAlphabets(event);" id="city" />
                <span id="v7" style="color:#F00;" class="val" ></span>
            </td></td>
            <td></td>
        </tr>
        <tr>
            <td>Academic Year</td>
            <td>
                <select id='batch_id' name='student[batch_id]'  class="form-control">
                    <?php
                    if (isset($all_batch) && !empty($all_batch)) {

                        foreach ($all_batch as $val1) {
                            ?>
                            <option <?= ($val1['id'] == $student_info[0]['batch_id']) ? 'selected' : '' ?> value="<?= $val1['id'] ?>"><?php echo $val1['from']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <span id="v8" style="color:#F00;" class="val"></span>
            </td>
            <td>State</td>
            <td><input type="text" value='<?= $student_info[0]['state'] ?>' onkeypress="return validateAlphabets(event);"  name='student_details[state]' id="state"/>
                <span id="v9" style="color:#F00;" class="val"></span>
            </td></td>
            <td></td>
            <td>

            </td>
        </tr>
        <tr>
            <td>Class</td>
            <td>
                <select id='depart_id' name='student_group[depart_id]'>
                    <option value="">Select</option>
                    <?php
                    if (isset($all_depart) && !empty($all_depart)) {
                        foreach ($all_depart as $val) {
                            ?>
                            <option <?= ($val['id'] == $student_info[0]['std_depart_id']) ? 'selected' : '' ?> value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <span id="v10"  style="color:#F00;" class="val"></span>
            </td>
            <td>Country</td>
            <td><input type="text"  value='<?= $student_info[0]['country'] ?>' name='student_details[country]' onkeypress="return validateAlphabets(event);" id="country" />
                <span id="v11"  style="color:#F00;" class="val"></span></td></td>
            <td>
                Parent's / Guardians Mob No
            </td>
            <td><input type="text"  value='<?= $student_info[0]['parent_no'] ?>' class="int_val" name='student_details[parent_no]' id="parent_no" />
                <span id="v12"  style="color:#F00;" class="val"></span></td>
        </tr>
        <tr>
            <td>Section</td>
            <td id='g_td'>
                <select id='group_id' name='student_group[group_id]'  class="form-control">
                    <option value="0">Select</option>
                    <?php
                    if (isset($all_group) && !empty($all_group)) {
                        foreach ($all_group as $val) {
                            ?>
                            <option <?= ($val['id'] == $student_info[0]['std_group_id']) ? 'selected' : '' ?>  value='<?= $val['id'] ?>'><?= $val['group'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
            <td>Postal Code</td>
            <td><input type="text" value='<?= $student_info[0]['postal_code'] ?>' class="int_val" name='student_details[postal_code]' id="postal_code"/>
                <span id="v13" style="color:#F00;" class="val"></span></td>
            <td>
                Alternate Mobile No
            </td>
            <td><input type="text"  value='<?= $student_info[0]['contact_no'] ?>' class="int_val" name='student[contact_no]' id="student_contact"/>
                <span id="v14" style="color:#F00;" class="val"></span></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>
                <input type="radio" name='student[gender]' <?= ($student_info[0]['gender'] == 'male') ? 'checked' : '' ?> value='male'/>Male&nbsp;
                <input type="radio" name='student[gender]' <?= ($student_info[0]['gender'] == 'female') ? 'checked' : '' ?> value='female'/>Female
                <span id="v15"></span>
            </td>
            <td>Joining Date</td>
            <td>
                <input type="text"  value='<?= date("d-m-Y", strtotime($student_info[0]['join_date'])); ?>' class='date' name='student_details[join_date]' id="join_date" />
                <span id="v16" style="color:#F00;" class="val"></span> </td>
            <td>
                Emergency Contact No
            </td>
            <td><input type="text"  name='student_details[emgy_no]' value='<?= $student_info[0]['emgy_no'] ?>' class="int_val" id="emgy_no"/>
                <span id="v17" style="color:#F00;" class="val"></span>
            </td>
        </tr>
        <tr>
            <td>Parent's / Guardians Email Id</td>
            <td>
                <input type="text"  name='student[email_id]' value='<?= $student_info[0]['email_id'] ?>' id="checking_email" class="" />
                <span id="v18" style="color:#F00;" class="val"></span>
                <span id="error_msg" style="color:#F00;" class="val"></span>

            </td>
            <td>Password</td>
            <td>
                <input type="password"  name='student[pwd]'  />

            </td>
            <td>Chat Option</td>
            <td>
                <select name='student[chat]' class="">

                    <option <?= ($student_info[0]['chat'] == 1) ? 'selected' : '' ?> value='1'>Enable</option>
                    <option <?= ($student_info[0]['chat'] == 0) ? 'selected' : '' ?> value='0'>Disable</option>
                </select>
                <span id="v20" style="color:#F00;" class="val">
            </td>
        </tr>

        <tr>
            <td>Register no</td>
            <td><input type="text" name='student[regno]' value='<?= $student_info[0]['regno'] ?>' id="reg_no"/><input type="hidden" id="st_id" value="<?= $student_info[0]['id'] ?>" /></td>
            <td>Scholarship</td>
            <td>
                <select id='' name='student[scholarship]'  class="form-control" >
                    <option value="">Select</option>
                    <option <?= ($student_info[0]['scholarship'] == 1) ? 'selected' : '' ?> value="1">Yes</option>
                    <option <?= ($student_info[0]['scholarship'] == 0) ? 'selected' : '' ?> value="0">No</option>
                </select>
            </td>
            <td>First Graduate</td>
            <td>
                <select id='' name='student[graduate]'  class="form-control" >
                    <option value="">Select</option>
                    <option <?= ($student_info[0]['graduate'] == 1) ? 'selected' : '' ?> value="1">Yes</option>
                    <option <?= ($student_info[0]['graduate'] == 0) ? 'selected' : '' ?> value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Student Type</td>
            <td>
                <select id='std_type' name='student[student_type]'  class="form-control " >
                    <option value="">Select</option>
                    <option <?= ($student_info[0]['student_type'] == 1) ? 'selected' : '' ?> value="1">Management</option>
                    <option <?= ($student_info[0]['student_type'] == 2) ? 'selected' : '' ?> value="2">Counselling</option>
                </select>
                <span id="v21" style="color:#F00;" class="val"></span>
            </td>
            <td>Transport</td>
            <td>
                <select id='trans' name='student[transport]'  class="form-control" >
                    <option value="">Select</option>
                    <option <?= ($student_info[0]['transport'] == 1) ? 'selected' : '' ?> value="1">Yes</option>
                    <option <?= ($student_info[0]['transport'] == 2) ? 'selected' : '' ?> value="2">No</option>
                </select>
                <span id="v23" style="color:#F00;" class="val"></span>
            </td>
            <td>Hostel</td>
            <td>
                <select id='hostel' name='student[hostel]'  class="form-control">
                    <option>Select</option>
                    <option id="host" <?= ($student_info[0]['hostel'] == 1) ? 'selected' : '' ?> value="1" disabled="disabled">Yes</option>
                    <option <?= ($student_info[0]['hostel'] == 2) ? 'selected' : '' ?> value="2">No</option>
                </select>
                <span id="v24" style="color:#F00;" class="val"></span>
            </td>
        </tr>

    </table>
    <br />
    <table style="display:none;">
        <tr id="last_row" >
            <td></td>
            <td><input type="text" name='qualification[exam][]'/></td>
            <td><input type="text" name='qualification[borad][]'/></td>
            <td><input type="text" name='qualification[per][]'/></td>
            <td><input type="text" name='qualification[pass][]'/></td>
            <td><input type="button" value="-" class='remove_comments btn bg-purple btn-sm'/></td>
        </tr>
    </table>
    <table style="display:none;">
        <tr id="last_row" >
            <td></td>
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
                <th></th>
                <th>Examination</th>
                <th>Board</th>
                <th>Percentage (%)</th>
                <th>Year of Passing</th>
                <th><input type="button" value="+" class='add_row btn bg-purple btn-sm'/></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (isset($student_info['qualification'][0]) && !empty($student_info['qualification'][0])) {
                foreach ($student_info['qualification'][0] as $val) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="text" value="<?= $val['examination'] ?>" name='qualification[exam][]'/></td>
                        <td><input type="text" value="<?= $val['borad'] ?>" name='qualification[borad][]'/></td>
                        <td><input type="text" value="<?= $val['percentage'] ?>" name='qualification[per][]'/></td>
                        <td><input type="text" value="<?= $val['p_year'] ?>"  name='qualification[pass][]'/></td>
                    </tr>
                    <?php
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>
    <br />
    <div class="right"><input type="submit" value="Update" class="btn btn-primary"></div>
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

        var val = $(this).val();

        switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
            case 'gif':
            case 'jpg':
            case 'png':
                $("#v19").html("");
                break;
            default:
                $(this).val();
                // error message here
                $("#v19").html("Invalid File Type");
                break;
        }
    });
    /*$('#imgInp').bind('change', function() {

     //alert(this.files[0].size);
     if(this.files[0].size>1048576)
     {
     var size_error="Profile Image:maximum size 1MB";
     $("#v19").html(size_error);

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
                /*$('.modal-backdrop').hide();
                 $('.close_div').hide();*/
            }
        });
    });
<?php /* ?>  $("form[name=sform]").submit(function()
  {

  var message=$("#v19").html();
  if(message.trim().length>0)
  {

  return false;
  }
  else
  {
  return true;
  }

  });<?php */ ?>
</script>

<script type="text/javascript">

    $('#trans').live('change', function () {
        trans = $(this).val();
        if (trans == 1)
        {
            $('#hostel').prop('disabled', true);
            $('#hostel').val('');
        }
        if (trans == 2)
        {
            $('#hostel').prop('disabled', false);
            $('#host').prop('disabled', false);

        }
    });
</script>
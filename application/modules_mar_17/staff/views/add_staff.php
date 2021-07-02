<script type="text/javascript">
    $(document).ready(function ()
    {
        //$("#staff_name").focus();
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
                    $("#errormessage").html("Enter valid email");
                } else
                {
                    $.ajax({
                        url: BASE_URL + "staff/checking_email_insert",
                        type: 'POST',
                        data: {value1: email},
                        success: function (result) {
                            $("#errormessage").html(result);
                            //document.getElementById('hidden_msg').value=result;

                        }

                    });
                }
            }
        });

        //checking  staff_id

        $("#staff_id").blur(function ()
        {


            var staffid = $("#staff_id").val();
            //alert(staffid);
            $.ajax({
                url: BASE_URL + "staff/checking_staffid_insert",
                type: 'POST',
                data: {staff_id: staffid},
                success: function (result) {
                    $("#error_staffid").html(result);


                }

            });

        });
        $("form[name=sform]").submit(function ()
        {


            /*if($("#depart_id").val()=='')
             {
             $("#depart_id").css('border','1px solid red');

             }
             else{
             $("#depart_id").css('border','1px solid #CCCCCC');
             $("#depart_id").tooltip('hide');
             }	*/


            var message1 = document.getElementById("errormessage").innerHTML;
            var message2 = document.getElementById("error_staffid").innerHTML;
            if ((message1.trim()).length > 0 && (message2.trim()).length > 0)
            {

                return false;
            } else if ((message1.trim()).length > 0)
            {

                return false;
            } else if ((message2.trim()).length > 0)
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
    $("#staff_name").live('blur', function ()
    {
        var staff_name = $("#staff_name").val();
        var filter = /^[a-zA-Z.\s]{3,20}$/;
        if (staff_name == "")
        {
            $("#v1").html("Required Field");
        } else if (!filter.test(staff_name))
        {
            $("#v1").html("Alphabets and Min 3 to Max 20 ");
        } else
        {
            $("#v1").html("");
        }
    });
    $("#join_date").live('blur', function ()
    {
        var join_date = $("#join_date").val();
        if (join_date == "")
        {
            $("#v2").html("Required Field");
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
    $("#staff_id").live('blur', function ()
    {
        var staff_id = $("#staff_id").val();
        if (staff_id == "")
        {
            $("#v4").html("Required Field");
        } else
        {
            $("#v4").html("");
        }
    });
    $("#state").live('blur', function ()
    {
        var state = $("#state").val();
        if (state == "")
        {
            $("#v5").html("Required Field");
        } else
        {
            $("#v5").html("");
        }
    });
    $("#checking_email").live('blur', function ()
    {
        var checking_email = $("#checking_email").val();
        if (checking_email == "")
        {
            $("#v15").html("Required Field");
        } else
        {
            $("#v15").html("");
        }
    });
    $("#country").live('blur', function ()
    {
        var country = $("#country").val();
        if (country == "")
        {
            $("#v6").html("Required Field");
        } else
        {
            $("#v6").html("");
        }
    });
    $("#password").live('blur', function ()
    {
        var password = $("#password").val();
        var filter = /^((?=.*[a-zA-Z])(?=.*\d)(?=.*[#@%$]).{6,20})$/;
        if (password == "")
        {
            $("#v7").html("Required Field");
        } else if (!filter.test(password))
        {
            $("#v7").html("Minimum 6 characters(Ex:A@b2c#)");
        } else
        {
            $("#v7").html("");
        }
    });
    $("#postal_code").live('blur', function ()
    {
        var postal_code = $("#postal_code").val();
        if (postal_code == "")
        {
            $("#v8").html("Required Field");
        } else if (postal_code.length != 6)
        {

            $("#v8").html("Maximum 6 characters");

        } else
        {
            $("#v8").html("");
        }
    });
    $("#dob").live('blur', function ()
    {
        var dob = $("#dob").val();
        if (dob == "")
        {
            $("#v9").html("Required Field");
        } else
        {
            $("#v9").html("");
        }
    });
    $("#mobile").live('blur', function ()
    {
        var mobile = $("#mobile").val();
        var filter = /^[0-9]{10,12}$/;
        if (mobile == "")
        {
            $("#v11").html("Required Field");
        } else if (!filter.test(mobile))
        {
            $("#v11").html("Numeric only and length 10 to 12");
        } else
        {
            $("#v11").html("");
        }
    });
    $("#depart_id").live('blur', function ()
    {
        var depart_id = $("#depart_id").val();
        if (depart_id == "")
        {
            $("#v12").html("Required Field");
        } else
        {
            $("#v12").html("");
        }
    });
    $("#design_id").live('blur', function ()
    {
        var design_id = $("#design_id").val();
        if (design_id == "")
        {
            $("#v13").html("Required Field");
        } else
        {
            $("#v13").html("");
        }
    });
    $("#staff_type_id").live('blur', function ()
    {
        var staff_type_id = $("#staff_type_id").val();
        if (staff_type_id == "")
        {
            $("#v14").html("Required Field");
        } else
        {
            $("#v14").html("");
        }
    });
</script>
<script>
    function validate()
    {
        var i = 0;
        var staff_name = $("#staff_name").val();
        var filter = /^[a-zA-Z.\s]{3,20}$/;
        if (staff_name == "")
        {
            $("#v1").html("Required Field");
            i = 1;
        } else if (!filter.test(staff_name))
        {
            $("#v1").html("Alphabets and Min 3 to Max 20 ");
            i = 1;
        } else
        {
            $("#v1").html("");
        }
        var join_date = $("#join_date").val();
        if (join_date == "")
        {
            $("#v2").html("Required Field");
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
        var staff_id = $("#staff_id").val();
        if (staff_id == "")
        {
            $("#v4").html("Required Field");
            i = 1;
        } else
        {
            $("#v4").html("");
        }
        var state = $("#state").val();
        if (state == "")
        {
            $("#v5").html("Required Field");
            i = 1;
        } else
        {
            $("#v5").html("");
        }
        var checking_email = $("#checking_email").val();
        if (checking_email == "")
        {
            $("#v15").html("Required Field");
            i = 1;
        } else
        {
            $("#v15").html("");
        }
        var country = $("#country").val();
        if (country == "")
        {
            $("#v6").html("Required Field");
            i = 1;
        } else
        {
            $("#v6").html("");
        }
        var password = $("#password").val();
        var filter = /^((?=.*[a-zA-Z])(?=.*\d)(?=.*[#@%$]).{6,20})$/;
        if (password == "")
        {
            $("#v7").html("Required Field");
            i = 1;
        } else if (!filter.test(password))
        {
            $("#v7").html("Minimum 6 characters(Ex:A@b2c#)");
            i = 1;
        } else
        {
            $("#v7").html("");
        }
        var postal_code = $("#postal_code").val();
        if (postal_code == "")
        {
            $("#v8").html("Required Field");
            i = 1;
        } else if (postal_code.length != 6)
        {

            $("#v8").html("Maximum 6 characters");
            i = 1;

        } else
        {
            $("#v8").html("");
        }
        var dob = $("#dob").val();
        if (dob == "")
        {
            $("#v9").html("Required Field");
            i = 1;
        } else
        {
            $("#v9").html("");
        }


        var mobile = $("#mobile").val();
        var filter = /^[0-9]{10,12}$/;
        if (mobile == "")
        {
            $("#v11").html("Required Field");
            i = 1;
        } else if (!filter.test(mobile))
        {
            $("#v11").html("Numeric only and length 10 to 12");
            i = 1;
        } else
        {
            $("#v11").html("");
        }
        var depart_id = $("#depart_id").val();
        if (depart_id == "")
        {
            $("#v12").html("Required Field");
            i = 1;
        } else
        {
            $("#v12").html("");
        }
        var design_id = $("#design_id").val();
        if (design_id == "")
        {
            $("#v13").html("Required Field");
            i = 1;
        } else
        {
            $("#v13").html("");
        }
        var staff_type_id = $("#staff_type_id").val();
        if (staff_type_id == "")
        {
            $("#v14").html("Required Field");
        } else
        {
            $("#v14").html("");
        }


        if (i == 1)
        {

            return false;
        } else
        {
            for_loading('Adding Staff...!');
            return true;
        }


    }
</script>




<div class="add_staff">
    <?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
    <form method="post"  enctype="multipart/form-data" name="sform" onsubmit="return validate();">
        <table class="staff_table">
            <tr>
                <td>Name</td>
                <td><input type="text" name='staff[staff_name]' class="mandatory"  onkeypress="return validateAlphabets(event);"   id="staff_name" tabindex="1"/><span id="v1" class="val" style="color:#F00;"></span></td>
                <td>Joining Date</td>
                <td><input type="text"  class='date mandatory' name='staff_details[join_date]' id="join_date" tabindex="2" />
                    <span id="v2" class="val" style="color:#F00;"></span></td>
                <td rowspan="4" >
                    <div class="staff_img">
                        <a href="#">size 120*140</a>
                        <img id="blah" class="add_staff_thumbnail" src="<?= $theme_path; ?>/img/avatar5.png"  alt="Staff Image" />
                        <p>&nbsp;</p>
                        <input type='file' name="staff_image" id="imgInp" tabindex="3" /><span id="v18" class="val" style="color:#F00;"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top">Address</td>
                <td colspan="3"><textarea style="width:92%; height:50px;" name='staff_details[address]' class="mandatory" id="address" tabindex="4"></textarea >
                    <span id="v3" class="val" style="color:#F00;"></span></td>
            </tr>
            <tr>
                <td>Staff Id</td>
                <td><input type="text" name='staff[staff_id]' class="mandatory" id="staff_id" tabindex="5" /><span style="color:red;" id="error_staffid"></span>
                    <span id="v4" class="val" style="color:#F00;"></span> </td>
                <td>Termination Date</td>
                <td><input type="text" class='date'    name='staff_details[end_date]' tabindex="10" /></td>
            </tr>
            <tr>
                <td>State</td>
                <td><input type="text"  name='staff_details[state]' class="mandatory" onkeypress="return validateAlphabets(event);" id="state" tabindex="6"><span id="v5" class="val" style="color:#F00;"></span></td>
                <td>Email Id</td>
                <td><input type="text" name='staff[email_id]' class="mandatory" id="checking_email" tabindex="11" /><span style="color:red;" id="errormessage"></span> <span id="v15" class="val" style="color:#F00;"></span>
                </td>
            </tr>
            <tr>
                <td>Country</td>
                <td><input type="text"  name='staff_details[country]' class="mandatory" id="country"    onkeypress="return validateAlphabets(event);" tabindex="7" /><span id="v6" class="val" style="color:#F00;"><span></td>
                            <td>Password</td>
                            <td><input type="password"  name='staff[pwd]' class="mandatory"  id="password" tabindex="12" />
                                <span id="v7" class="val" style="color:#F00;"></span></td>

                            </tr>
                            <tr>
                                <td>Postal Code</td>
                                <td><input type="text"  name='staff_details[postal_code]'   class="int_val mandatory" id="postal_code" tabindex="8"  />
                                    <span id="v8" class="val" style="color:#F00;"></span></td>
                                <td>DOB</td>
                                <td><input type="text" class='date mandatory'   name='staff_details[dob]' id="dob" tabindex="13" />
                                    <span id="v9" class="val" style="color:#F00;"></span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td><input type="radio" name='staff_details[gender]' id="my_radio" value='male' tabindex="9"/>Male&nbsp;&nbsp;<input type="radio" id="my_radio1" name='staff_details[gender]' value='female' tabindex="9"/>Female<span id="v10" style="color:#F00;"></span></td>
                                <td>Mobile No</td>
                                <td><input type="text"  name='staff[mobile_no]'  class="int_val mandatory" id="mobile" tabindex="14" />
                                    <span id="v11" class="val"  style="color:#F00;"></span></td>
                                <td>Staff Type</td>
                            </tr>
                            <tr>
                                <td>Class</td>
                                <td>
                                    <select id='depart_id' name='staff[depart_id]'  class="form-control mandatory" tabindex="15" >
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
                                    </select><span id="v12" class="val" style="color:#F00;"></span>
                                </td>
                                <td>Designation</td>
                                <td>
                                    <select id='design_id' name='staff[designation_id]' class="form-control mandatory" tabindex="16" >
                                        <option value="">Select</option>
                                        <?php
                                        if (isset($all_design) && !empty($all_design)) {
                                            foreach ($all_design as $val1) {
                                                ?>
                                                <option value="<?= $val1['id'] ?>"><?= $val1['designation'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select><span id="v13" class="val" style="color:#F00;"></span>
                                </td>
                                <td>
                                    <select name='staff[staff_type_id]' class="form-control mandatory" id="staff_type_id" tabindex="18" >
                                        <option value="">Select</option>
                                        <?php
                                        if (isset($staff_type) && !empty($staff_type)) {
                                            foreach ($staff_type as $val2) {
                                                ?>
                                                <option value="<?= $val2['id'] ?>"><?= ucfirst($val2['staff_type']) ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select><span id="v14" class="val" style="color:#F00;"></span>
                                </td>
                            </tr>
                            </table>
                            <table style="display:none;">
                                <tr id="last_row" >
                                    <td class="dy_no"></td>
                                    <td><input type="text" name='qualification[exam][]'/></td>
                                    <td><input type="text" name='qualification[borad][]'/></td>
                                    <td><input type="text" name='qualification[per][]'  class="float_val"/></td>
                                    <td><input type="text" name='qualification[pass][]' class="int_val"/></td>
                                    <td><input type="button" value="-" class='remove_comments btn bg-purple btn-sm'/></td>
                                </tr>
                            </table>
                            <br />
                            <table id='app_table'>
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Examination</th>
                                        <th>Board</th>
                                        <th>Percentage (%)</th>
                                        <th>Year of Passing</th>
                                        <th><input type="button" value="+" class='add_row btn bg-purple btn-sm' /></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" name='qualification[exam][]' id="col" tabindex="19" /></td>
                                        <td><input type="text" name='qualification[borad][]' id="col1" tabindex="20"/></td>
                                        <td><input type="text" name='qualification[per][]' class="float_val" id="col2" tabindex="21"/></td>
                                        <td><input type="text"  name='qualification[pass][]' class="int_val" id="col3" tabindex="22"/></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" name='qualification[exam][]' id="col4" tabindex="23"/></td>
                                        <td><input type="text" name='qualification[borad][]' id="col5" tabindex="24"/></td>
                                        <td><input type="text" name='qualification[per][]'  class="float_val" id="col6" tabindex="25"/></td>
                                        <td><input type="text" name='qualification[pass][]' class="int_val" id="col7" tabindex="26"/></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" name='qualification[exam][]' id="col8" tabindex="27"/></td>
                                        <td><input type="text" name='qualification[borad][]' id="col9" tabindex="28"/></td>
                                        <td><input type="text" name='qualification[per][]'  class="float_val" id="col10" tabindex="29"/></td>
                                        <td><input type="text" name='qualification[pass][]' class="int_val" id="col11" tabindex="30"/></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><input type="text" name='qualification[exam][]' tabindex="31"/></td>
                                        <td><input type="text" name='qualification[borad][]' tabindex="32"/></td>
                                        <td><input type="text" name='qualification[per][]'  class="float_val" tabindex="33"/></td>
                                        <td><input type="text" name='qualification[pass][]' class="int_val" tabindex="34"/></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                            <input type="reset" value="Cancel" class="btn btn-danger" id="cancel" style="float:left"/>
                            <div class="right">&nbsp;<input type="submit" value="submit" class="btn btn-primary"/></div>
                            <br /><br />
                            </form>

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
                                // Image validation size checking
                                $("#imgInp").change(function () {

                                    var val = $(this).val();

                                    switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
                                        case 'gif':
                                        case 'jpg':
                                        case 'png':
                                        case '':
                                            $("#v18").html("");
                                            break;
                                        default:
                                            $(this).val();
                                            // error message here
                                            $("#v18").html("Invalid File Type");
                                            break;
                                    }
                                });
                                /*$('#imgInp').bind('change', function() {

                                 //alert(this.files[0].size);
                                 if(this.files[0].size>1048576)
                                 {
                                 var size_error="Profile Image:maximum size 1MB";
                                 $("#v18").html(size_error);

                                 }
                                 else
                                 {

                                 }

                                 });*/ // image validation ends here
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
                                //cancel function
                                $("#cancel").live("click", function ()
                                {
                                    $('.val').html('');
                                    $('.mandatory').css('border', '1px solid #CCCCCC');
                                    $("#blah").replaceWith('<img id="blah" class="add_staff_thumbnail" src="<?= $theme_path; ?>/img/avatar5.png"  alt="Staff Image" />');
                                    //$('.erro').html();

                                });
                                $("form[name=sform]").submit(function ()
                                {

                                    var message = $("#v18").html();
                                    if (message.trim().length > 0)
                                    {

                                        return false;
                                    } else
                                    {
                                        return true;
                                    }

                                });
                            </script>
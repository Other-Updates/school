
<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#checking_email").blur(function ()
        {

            var email = $("#checking_email").val(), sid = $("#s_id").val();
            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if (!filter.test(email))
            {
                $("#error_msg").html("Enter valid email");
            } else
            {
                $.ajax({
                    url: BASE_URL + "staff/checking_email_update",
                    type: 'POST',
                    data: {value1: email, value2: sid},
                    success: function (result) {

                        $("#error_msg").html(result);

                    }

                });
            }
        });


        //staff id
        $("#checking_staffid").blur(function ()
        {

            var staff_id = $("#checking_staffid").val();
            var sid = $("#s_id").val();

            $.ajax({
                url: BASE_URL + "staff/checking_staffid_update",
                type: 'POST',
                data: {value1: staff_id, value2: sid},
                success: function (result) {

                    $("#error_staffid").html(result);

                }

            });

        });
        /* $("form[name=sform]").submit(function()
         {
         var message1=document.getElementById('error_msg').innerHTML;
         var message2=document.getElementById('error_staffid').innerHTML;
         if((message1.trim()).length >0 && (message2.trim()).length >0)
         {

         return false;
         }
         else if((message1.trim()).length >0)
         {

         return false;
         }
         else if((message2.trim()).length >0)
         {

         return false;
         }
         else
         {
         for_loading('Updating Staff...!');
         return true;
         }

         });*/
    });
</script>



<!--<script>
function validateform()
{
         // name validation
                var name = document.getElementById('staff_name').value;
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
                                // joindate validation
                                var date=document.getElementById('join_date').value;
                                if(date=='')
                                {
                                         document.getElementById("v2").style.display = "block";
                                         return false;
                                }
                                else
                                {
                                         document.getElementById("v2").style.display = "none";
                                }
                // address validation
                var address=document.getElementById('address').value;
                if(address='' || address.length<=3 || address.length>=200)
                {
                        document.getElementById("v3").style.display = "block";
                        return false;
                }
                else
                {
                        document.getElementById("v3").style.display = "none";
                }
                        // staffid validation
                                var staff=document.getElementById('checking_staffid').value;
                                if(staff=='')
                                {
                                        document.getElementById("v4").style.display = "block";
                                        return false;
                                }
                                else
                                {
                                        document.getElementById("v4").style.display = "none";
                                }
                //state validation
                var state=document.getElementById('state').value;
                if(state=='')
                {
                        document.getElementById("v5").style.display = "block";
                        return false;
                }
                else
                {
                        document.getElementById("v5").style.display = "none";
                }

                                // country validation
                                var country=document.getElementById('country').value;
                                if(country=='')
                                {
                                        document.getElementById("v6").style.display = "block";
                                        return false;
                                }
                                else
                                {
                                        document.getElementById("v6").style.display = "none";
                                }
                // postal code validation
                        var postal = document.getElementById('postal_code').value;
                        b=postal.length;
                        if(postal=='' || isNaN(postal) || b!=6)
                        {
                                 document.getElementById("v8").style.display = "block";
                                 return false;
                        }
                        else
                        {
                                 document.getElementById("v8").style.display = "none";
                        }
                                // DOB validation
                                var dob=document.getElementById('dob').value;
                                if(dob=='')
                                {
                                        document.getElementById("v9").style.display = "block";
                                        return false;
                                }
                                else
                                {
                                        document.getElementById("v9").style.display = "none";
                                }
                // Mobile validation
                var phone = document.getElementById('mobile').value;
                var filter=/^[0-9]{10,12}$/;
                if (!filter.test(phone))
                {
                         document.getElementById("v11").style.display = "block";
                         return false;
                }
                else
                {
                         document.getElementById("v11").style.display = "none";
                }
                                //Class validation
                                var e = document.getElementById("depart_id");
                                var strUser = e.options[e.selectedIndex].value;

                                var strUser1 = e.options[e.selectedIndex].text;
                                if(strUser==0)
                                {
                                        document.getElementById("v12").style.display = "block";
                                        return false;
                                }
                                else
                                {
                                        document.getElementById("v12").style.display = "none";
                                }
                // Designation validation
                var e = document.getElementById("design_id");
                var strUser = e.options[e.selectedIndex].value;

                var strUser1 = e.options[e.selectedIndex].text;
                if(strUser==0)
                {
                        document.getElementById("v13").style.display = "block";
                        return false;
                }
                else
                {
                        document.getElementById("v13").style.display = "none";
                }
                                //  Staff id validation
                                var e = document.getElementById("staff_type_id");
                                var strUser = e.options[e.selectedIndex].value;

                                var strUser1 = e.options[e.selectedIndex].text;
                                if(strUser==0)
                                {
                                        document.getElementById("v14").style.display = "block";
                                        return false;
                                }
                                else
                                {
                                        document.getElementById("v14").style.display = "none";
                                }
}
</script>-->

<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); /* echo "<pre>"; print_r($staff_info); */ ?>
<form method="post"  enctype="multipart/form-data" name="sform" onsubmit="return validate();">
    <table class="staff_table">
        <tr>
            <td>Name</td>
            <td><input type="text" name='staff[staff_name]' value="<?= $staff_info[0]['staff_name'] ?>" id="staff_name" onkeypress="return validateAlphabets(event);" /><input type="hidden" id="s_id" value="<?= $staff_info[0]['id'] ?>" />
                <span id="v1" class="val" style="color:#F00;"></span></td>
            <td>Joining Date</td>
            <td><input type="text"  name='staff_details[join_date]' class='date' id="join_date" value="<?= date('d-m-Y', strtotime($staff_info[0]['join_date'])) ?>"  /><span id="v2" class="val" style="color:#F00;"></span></td>
            <td rowspan="4" >
                <div class="staff_img">
                    <a href="#">size 120*140</a>
                    <img id="blah" class="add_staff_thumbnail" src="<?= $this->config->item('base_url'); ?>/profile_image/staff/orginal/<?= $staff_info[0]['image'] ?>"  alt="Staff Image" />
                    <p>&nbsp;</p>
                    <input type='file' name="staff_image" id="imgInp" />
                </div>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:top">Address</td>
            <td colspan="3"><textarea style="width:92%; height:50px;" name='staff_details[address]' id="address"><?= $staff_info[0]['address'] ?></textarea><span id="v3" class="val" style="color:#F00;"></span></td>
        </tr>
        <tr>
            <td>Staff Id</td>
            <td><input type="text" name='staff[staff_id]' value="<?= $staff_info[0]['staff_id'] ?>" id="checking_staffid" />
                <span style="color:red;" id="error_staffid"></span>
                <span id="v4" class="val" style="color:#F00;"></span></td>
            <td>Termination Date</td>
            <td><input type="text"  name='staff_details[end_date]' class='date' value="<?= ($staff_info[0]['end_date'] == '0000-00-00' || $staff_info[0]['end_date'] == '1970-01-01') ? ' ' : date("d-m-Y", strtotime($staff_info[0]['end_date'])); ?>" /></td>
        </tr>
        <tr>
            <td>State</td>
            <td><input type="text"  name='staff_details[state]' onkeypress="return validateAlphabets(event);" value="<?= $staff_info[0]['state'] ?>"
                       onkeypress="return validateAlphabets(event);" id="state"/><span id="v5" class="val" style="color:#F00;"></span></td>
            <td>Email Id</td>
            <td><input type="text" name='staff[email_id]' value="<?= $staff_info[0]['email_id'] ?>" id="checking_email" class="" /><span id="v15" class="val" style="color:#F00;"></span>
                <span id="error_msg" class="val" style="color:#F00;"></span></td>
        </tr>
        <tr>
            <td>Country</td>
            <td><input type="text"  name='staff_details[country]' value="<?= $staff_info[0]['country'] ?>"  id="country"    onkeypress="return validateAlphabets(event);"/>
                <span id="v6" class="val" style="color:#F00;"><span></td>
                        <td>Password</td>
                        <td><input type="password"  name='staff[pwd]'/></td>

                        </tr>
                        <tr>
                            <td>Postal Code</td>
                            <td><input type="text"  name='staff_details[postal_code]' class="int_val" id="postal_code" value="<?= $staff_info[0]['postal_code'] ?>"  />
                                <span id="v8" class="val" style="color:#F00;"></span></td>
                            <td>DOB</td>
                            <td><input type="text" class='date'  name='staff_details[dob]' id="dob" value="<?= date('d-m-Y', strtotime($staff_info[0]['dob'])) ?>" />
                                <span id="v9" class="val" style="color:#F00;"></span></td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>
                                <input type="radio" name='staff_details[gender]' <?= ($staff_info[0]['gender'] == 'male') ? 'checked' : '' ?> value='male'/>Male&nbsp;
                                <input type="radio" name='staff_details[gender]' <?= ($staff_info[0]['gender'] == 'female') ? 'checked' : '' ?> value='female'/>Female
                                <span id="v10" style="color:#F00;"></span>
                            </td>
                            <td>Mobile No</td>
                            <td><input type="text"  name='staff[mobile_no]' class="int_val"  value="<?= $staff_info[0]['mobile_no'] ?>" id="mobile" />
                                <span id="v11" class="val"  style="color:#F00;"></span></td>
                            <td>Staff Type</td>
                        </tr>
                        <tr>
                            <td>Class</td>
                            <td>
                                <select id='depart_id' name='staff[depart_id]' >

                                    <?php
                                    if (isset($all_depart) && !empty($all_depart)) {
                                        foreach ($all_depart as $val) {
                                            ?>
                                            <option <?= ($val['id'] == $staff_info[0]['depart_id']) ? 'selected' : '' ?> value="<?= $val['id'] ?>"><?= $val['department'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <span id="v12" class="val" style="color:#F00;"></span>
                            </td>
                            <td>Designation</td>
                            <td>
                                <select id='design_id' name='staff[designation_id]' >

                                    <?php
                                    if (isset($all_design) && !empty($all_design)) {
                                        foreach ($all_design as $val1) {
                                            ?>
                                            <option <?= ($val1['id'] == $staff_info[0]['designation_id']) ? 'selected' : '' ?> value="<?= $val1['id'] ?>"><?= $val1['designation'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <span id="v13" class="val" style="color:#F00;"></span>
                            </td>
                            <td>
                                <select name='staff[staff_type_id]' id="staff_type_id">

                                    <?php
                                    if (isset($staff_type) && !empty($staff_type)) {
                                        echo $staff_info[0]['staff_type_id'];
                                        foreach ($staff_type as $val2) {
                                            ?>
                                            <option <?= ($val2['id'] == $staff_info[0]['staff_type_id']) ? 'selected' : '' ?>  value="<?= $val2['id'] ?>"><?= ucfirst($val2['staff_type']) ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <span id="v14" class="val" style="color:#F00;"></span>
                            </td>
                        </tr>
                        </table>
                        <br />
                        <table style="display:none;">
                            <tr id="last_row" >

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
                                if (isset($staff_info['qualification'][0]) && !empty($staff_info['qualification'][0])) {
                                    foreach ($staff_info['qualification'][0] as $val) {
                                        ?>
                                        <tr>
                                            <?php /* ?><td><?=$i?></td><?php */ ?>
                                            <td><input type="text" value="<?= $val['examination'] ?>" name='qualification[exam][]' /></td>
                                            <td><input type="text" value="<?= $val['borad'] ?>" name='qualification[borad][]' /></td>
                                            <td><input type="text" value="<?= $val['percentage'] ?>" name='qualification[per][]'/></td>
                                            <td><input type="text" value="<?= $val['p_year'] ?>"  name='qualification[pass][]' /></td>
                                            <td><span style="color:#F00;" class="v15"></span></td></tr>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <br />
                        <div class="right"><input type="submit"  value='Update' class="btn btn-primary"/></div>
                        <br /><br />
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
                            // Image validation size checking
                            $("#imgInp").change(function () {

                                var val = $(this).val();

                                switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
                                    case 'gif':
                                    case 'jpg':
                                    case 'png':
                                        $("#v15").html("");
                                        break;
                                    default:
                                        $(this).val();
                                        // error message here
                                        $("#v15").html("Invalid File Type");
                                        break;
                                }
                            });
                            /*$('#imgInp').bind('change', function() {

                             //alert(this.files[0].size);
                             if(this.files[0].size>1048576)
                             {
                             var size_error="Profile Image:maximum size 1MB";
                             $("#v15").html(size_error);

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
                            $("form[name=sform]").submit(function ()
                            {

                                var message = $("#v15").html();
                                if (message.trim().length > 0)
                                {

                                    return false;
                                } else
                                {
                                    return true;
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
                                var staff_id = $("#checking_staffid").val();
                                if (staff_id == "")
                                {
                                    $("#v4").html("Required Field");
                                    i = 1;
                                } else
                                {
                                    $("#v4").html("");
                                }
                                var state = $("#checking_staffid").val();
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
                                var message1 = $('#error_msg').html();
                                if (message1.trim().length > 0)
                                {
                                    i = 1;
                                }
                                var message2 = $('#error_staffid').html();
                                if (message2.trim().length > 0)
                                {
                                    i = 1;
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

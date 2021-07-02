<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<br />
<?php /* ?><?php if($std_info[0]['hostel']==0){?>
  <div style="color:red; font-size:13px; text-align:center; width:100%; font-weight:bold;">This Student Hostel Type is "NO" ; Kindly Contact Respective Class Tutors. </div>
  <?php }?><?php */ ?>
<div class="fees_tit">Student Details</div>
<br />
<table class="staff_table">
    <tr>
        <td>First Name</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['name'] ?></td>
        <td>&nbsp;</td>
        <td>Last Name</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['last_name'] ?></td>
        <td>&nbsp;</td>
        <td rowspan="4" colspan="3" align="center">
            <img id="blah" class="add_staff_thumbnail" src="<?= $this->config->item('base_url') ?>profile_image/student/orginal/<?= $std_info[0]['image'] ?>" alt="Staff Image" /><br />
            <span class="green"></span>
        </td>
        <td rowspan="4">&nbsp;</td>
    </tr>
    <tr>
        <td>Address</td>
        <td>:</td>
        <td colspan="5" class="text_bold"><?= $std_info[0]['address'] ?><input type="hidden" class="std_id1" value="<?= $std_info[0]['id'] ?>"></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Roll No</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['std_id'] ?><input type="hidden" class="std_reg" value="<?= $std_info[0]['std_id'] ?>"></td><td>&nbsp;</td>
        <td>Father's / Guardians Name</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['parent_name'] ?></td><td>&nbsp;</td>
    </tr>
    <tr>
        <td>DOB</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['dob'] ?></td><td>&nbsp;</td>
        <td>City</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['city'] ?></td><td>&nbsp;</td>

    </tr>
    <tr>
        <td>Batch</td>
        <td>:</td>
        <td class="text_bold">
            <?= $std_info[0]['from'] . '-' . $std_info[0]['to'] ?>
        </td><td>&nbsp;</td>
        <td>State</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['state'] ?></td><td>&nbsp;</td>
        <td>Student Type</td>
        <td>:</td>
        <td class="text_bold"><?= ($std_info[0]['student_type'] == 1) ? 'Management' : 'Counselling' ?></td>
    </tr>
    <tr>
        <td>Department</td>
        <td>:</td>
        <td class="text_bold">
            <?= $std_info[0]['department'] ?>
        </td><td>&nbsp;</td>
        <td>Country</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['country'] ?></td><td>&nbsp;</td>
        <td>
            Parent's / Guardians Mob No
        </td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['parent_no'] ?></td>
    </tr>
    <tr>
        <td>Group</td>
        <td>:</td>
        <td id='g_td' class="text_bold">
            <?= $std_info[0]['group'] ?>
        </td><td>&nbsp;</td>
        <td>Postal Code</td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['postal_code'] ?></td><td>&nbsp;</td>
        <td>
            Student Mob No
        </td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['contact_no'] ?></td>
    </tr>
    <tr>
        <td>Gender</td>
        <td>:</td>
        <td class="text_bold">
            <?= ucfirst($std_info[0]['gender']) ?>
        </td><td>&nbsp;</td>
        <td>Joining Date</td>
        <td>:</td>
        <td class="text_bold">
            <?= $std_info[0]['join_date'] ?>
        </td><td>&nbsp;</td>
        <td>
            Emergency Contact No
        </td>
        <td>:</td>
        <td class="text_bold"><?= $std_info[0]['emgy_no'] ?></td>
    </tr>

</table>
<br />
<div id="view_tabel">
    <table id="example3" class="table table-bordered table-striped view">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Bus No</th>
                <th>Stage</th>
                <th>Route</th>
                <th>Bus fare/Year</th>
                <th>Term For</th>
                <th>Term Fees</th>
                <th>Fine</th>
                <th>Excess</th>
                <th>Balance</th>
                <th>Amount Paid</th>
                <th>Payment Period</th>
                <th>Payment Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        //echo "<pre>"; print_r($advance); exit;
        if (isset($transport_list) && !empty($transport_list)) {
            $i = 1;
            foreach ($transport_list as $val) {
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $val['bus_no'] ?></td>
                    <td><?= $val['stage'] ?></td>
                    <td><?= $val['route_id'] ?></td>
                    <td><?= $val['amount_id'] ?></td>
                    <td><?php
                        if ($val['f_days'] == 1) {
                            echo "6 Months";
                        } else {
                            echo " 1 Year";
                        }
                        ?></td>
                    <td><?= $val['period_amount'] ?></td>
                    <td><?= $val['get_fine'] ?></td>
                    <td><?= $val['excess'] ?></td>
                    <td><?= $val['balz'] ?></td>
                    <td><?= $val['total'] ?></td>
                    <td style="color:blue;">(<?php
                        echo $val['date_from'] . '-';
                        switch ($val['fdate']) {
                            case 1:
                                echo "Jan";
                                break;
                            case 2:
                                echo "Feb";
                                break;
                            case 3:
                                echo "Mar";
                                break;
                            case 4:
                                echo "Apr";
                                break;
                            case 5:
                                echo "May";
                                break;
                            case 6:
                                echo "Jun";
                                break;
                            case 7:
                                echo "Jul";
                                break;
                            case 8:
                                echo "Aug";
                                break;
                            case 9:
                                echo "Sep";
                                break;
                            case 10:
                                echo "Oct";
                                break;
                            case 11:
                                echo "Nov";
                                break;
                            case 12:
                                echo "Dec";
                                break;
                            default:
                                echo "";
                                break;
                        }
                        ?>) <span style="color:black;">To</span> (<?php
                        echo $val['date_to'] . '-';
                        switch ($val['tdate']) {
                            case 1:
                                echo "Jan";
                                break;
                            case 2:
                                echo "Feb";
                                break;
                            case 3:
                                echo "Mar";
                                break;
                            case 4:
                                echo "Apr";
                                break;
                            case 5:
                                echo "May";
                                break;
                            case 6:
                                echo "Jun";
                                break;
                            case 7:
                                echo "Jul";
                                break;
                            case 8:
                                echo "Aug";
                                break;
                            case 9:
                                echo "Sep";
                                break;
                            case 10:
                                echo "Oct";
                                break;
                            case 11:
                                echo "Nov";
                                break;
                            case 12:
                                echo "Dec";
                                break;
                            default:
                                echo "";
                                break;
                        }
                        ?>)</td>
                    <td style="color:blue;"><?= date('d-M-Y', strtotime($val['created_on'])) ?></td>
                    <td>
                        <a href="#history_<?= $val['id'] ?>" data-toggle="modal" data-original-title="View" name="group" class="btn bg-maroon btn-sm">View</a>
                        <a href="<?= $this->config->item('base_url') . 'transport/update_student_transport/' . $val['std_reg'] . '/' . $val['id']; ?>"
                           title="Edit" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                        <button  class="btn  btn-danger btn-sm" id="view_print" > Payment History</button>
                    </td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </table>
</div>
</br>
<!--<div>
        <table>
        <tr style="width:400" class="fright">
                <td>


            </td>
        </tr>
    </table>
</div>-->


<div class="fees_tit">Pay Transport Fees</div>
<br />
<table class="form_table">
    <tr>
        <td width="200">Stage</td>
        <td>
            <input type="text" style="float:left;" name="roll_no" id="get_stage" class="stage_class t_port" autocomplete="off" />
            <span id="hos_name" style="color:#F00;"></span>
        </td>
    </tr>

</table>

<div id='bus'>

</div>
<div id="advance_pay" style="display:none">
    <table class="form_table">
        <tr>
            <td width="204"><p style="color:blue; font:bold;">Amount Paying</p></td>
            <td><input type="text" id="a_amt" class="adva_amount t_port"  /></td>
        </tr>
        <tr>
            <td width="204"><p style="color:blue; font:bold;">Reason</p></td>
            <td><input type="text" id="reason" class="adva_amount t_port"  /></td>
        </tr>
    </table>
</div>

<?php $today = date('d-m-Y'); ?><input type="hidden" class="tody" value="<?= $today ?>"  />
<table class="form_table">
    <tr>
        <td width="200">Term</td>
        <td width="80">
            <select id='period' class="t_port s_mon">
                <option value='1'>Select</option>
                <option value='1'>Half-Yearly</option>
                <option value='2'>One Year</option>
            </select>
        </td>
        <td style="display:none;">
            <input type="text" id="amount_year" class="mount_year" />
        </td>
    </tr>

    <tr>
        <td width="200">Period</td>
        <td width="100">
            <span style="float:left;margin-top: 6PX;">From : &nbsp;</span>
            <span style="float:left;">
                <select name="to" id="fdate" class="mandatory to alert_year t_port"   title="Select Year"  style="width:90px;">
                    <option value="" selected="selected">Year</option>
                    <?php
                    $inc = explode('-', $std_info[0]['from']);
                    //exit;
                    for ($i = trim($inc[0]); $i <= trim($inc[1]); $i++) {
                        ?>
                        <option value='<?= $i ?>'><?= $i ?></option>
                    <?php }
                    ?>
                </select>
                <select id='gMonth1' style="width:90px;" class="t_port">
                    <option value=''>Select</option>
                    <option value='1'>Janaury</option>
                    <option value='2'>February</option>
                    <option value='3'>March</option>
                    <option value='4'>April</option>
                    <option value='5'>May</option>
                    <option value='6'>June</option>
                    <option value='7'>July</option>
                    <option value='8'>August</option>
                    <option value='9'>September</option>
                    <option value='10'>October</option>
                    <option value='11'>November</option>
                    <option value='12'>December</option>
                </select>
            </span>
        </td>
        <td width="">
            <span style="float:left;margin-top: 6PX;">
                &nbsp;&nbsp; To :&nbsp;&nbsp;
            </span>
            <span style="float:left;">
                <select name="to" id="tdate" class="mandatory to tdate_class t_port"   title="Select Year"  style="width:90px;">
                    <option value="" selected="selected">Year</option>
                    <?php
                    $inc = explode('-', $std_info[0]['from']);
                    //exit;
                    for ($i = trim($inc[0]); $i <= trim($inc[1]); $i++) {
                        ?>
                        <option value='<?= $i ?>'><?= $i ?></option>
                    <?php }
                    ?>
                </select>
                <select id='gMonth2' style="width:90px;" class="t_port">
                    <option value=''>Select</option>
                    <option value='1'>Janaury</option>
                    <option value='2'>February</option>
                    <option value='3'>March</option>
                    <option value='4'>April</option>
                    <option value='5'>May</option>
                    <option value='6'>June</option>
                    <option value='7'>July</option>
                    <option value='8'>August</option>
                    <option value='9'>September</option>
                    <option value='10'>October</option>
                    <option value='11'>November</option>
                    <option value='12'>December</option>
                </select>
            </span>
        </td>
        <td>
            <div id="year_show" > </div>
        </td>
    </tr>
</table>
<?php /* ?>
  <?php $year=date('d-m-Y',strtotime("+12month",strtotime($std_info[0]['join_date'])));?>
  <div style="display:none;" class="insert_month">
  <table class="form_table insert_month">
  <tr>
  <td width="200">Month</td>
  <td>
  <span style="float:left;margin-top: 6PX;">From : &nbsp;</span>
  <span style="float:left;">
  <select id='gMonth1' style="width:90px;" class="t_port">
  <option value=''>--Select Month--</option>
  <option value='1'>Janaury</option>
  <option value='2'>February</option>
  <option value='3'>March</option>
  <option value='4'>April</option>
  <option value='5'>May</option>
  <option value='6'>June</option>
  <option value='7'>July</option>
  <option value='8'>August</option>
  <option value='9'>September</option>
  <option value='10'>October</option>
  <option value='11'>November</option>
  <option value='12'>December</option>
  </select>
  </span> <?php $year=date('d-m-Y',strtotime("+12month",strtotime($std_info[0]['join_date'])));?>
  <span style="float:left;margin-top: 6PX;">
  &nbsp;&nbsp; To :&nbsp;&nbsp;
  </span>
  <span style="float:left;">
  <select id='gMonth2' style="width:90px;" class="t_port">
  <option value=''>--Select Month--</option>
  <option value='1'>Janaury</option>
  <option value='2'>February</option>
  <option value='3'>March</option>
  <option value='4'>April</option>
  <option value='5'>May</option>
  <option value='6'>June</option>
  <option value='7'>July</option>
  <option value='8'>August</option>
  <option value='9'>September</option>
  <option value='10'>October</option>
  <option value='11'>November</option>
  <option value='12'>December</option>
  </select>
  </span>
  </td>
  </tr>

  </table>
  </div>
  <?php */ ?>
<table class="form_table">
    <tr>
        <td width="200">Fine</td>
        <td>
            <input type="text" style="float:left;" name="fine_hos" id="get_fine" class="fine_class t_port"  />
            <span id="hos_name" style="color:#F00;"></span>
        </td>
    </tr>
    <tr>
        <td width="200">Payment Mode</td>
        <td>
            <select  id='p_mode_trans' class='payment_mode t_port'>
                <option value=''>Select</option>
                <option value='1'>Cash</option>
                <option value='2'>Cheque</option>
                <option value='3'>DD</option>
            </select>
        </td>
    </tr>
</table>
<div id="trans" style="display:none;">
    <table class="form_table">
        <tr><td width="200"></td><td><input type="text"  class="bank_name t_port" placeholder="Bank Name"/></td></tr>
        <tr><td width="200"></td><td><input type="text"  class="branch_name t_port" placeholder="Branch Name"/></td></tr>
        <tr><td width="200"></td><td><input type="text"  class="bank_dd t_port" placeholder="Cheque / DD No"/></td></tr>
        <tr><td width="200"></td><td><input type="text"  class="bank_amount t_port" placeholder="Amount"/></td></tr>
    </table>

</div>
<table>
    <tr>
        <td width="202">Total</td>
        <td>
            <input type="text" id="total" class="total_class t_port"  style="color:#F00; font:bold;" disabled="disabled"  />
        </td>
    </tr>


    <tr>
        <td width="200"></td>
        <td>
            <input type="button" id="submit_trans" value="Pay" class="btn btn-primary "/>
        </td>

    </tr>
</table>

<!--POPUP VIEW PERPOSE-->
<?php
if (isset($fees_info_trans) && !empty($fees_info_trans)) {
    foreach ($fees_info_trans as $val) { //echo "<pre>";print_r($val);
        ?>
        <div id="history_<?= $val['id'] ?>" class="modal fade in close_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel">Payment View</h3>
                    </div>
                    <div class="modal-body">
                        <table class="staff_table_sub">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Payment Mode</th>
                                    <th>Amount</th>
                                    <th>Bank Details</th>
                                </tr>
                            </thead>
                            <tr>
                                <td><?= date('d-M-Y', strtotime($val['created_on'])) ?></td>
                                <td><?php
                                    $val['payment_mode'];
                                    if ($val['payment_mode'] != 1) {
                                        echo "Bank";
                                    } else {
                                        echo "cash";
                                    }
                                    ?></td>
                                <td><?= $val['total'] ?></td>
                                <td><?= $val['branch_name'] ?></td>
                            </tr>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>

                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}
?>

<script type="text/javascript">
    $(document).ready(function (){
    $(".staff_table_sub tr:even").css("background-color", "#FAFAFA");
    });
    $().ready(function () {
    $("#get_stage").autocomplete(BASE_ U RL + "transport/get_stage_list", {
    width: 260,
            autoFocus: true,
            matchContains: true,
            selectFirst: false
    });
    });
    $().ready(function ()  {
    $('#get_stage_update').autocomplete(BAS E _URL + "transport/get_stage_list", {
    width: 260,
            autoFocus: true,
            matchContains: true,
            selectFirst: false
    });
    });
    $(".stage_class").live('blur', function ()
    {
    var s_id = $(this).val();
    $.ajax({
    url: BASE_URL + "transport/transport_bus_no",
            type: 'get',
            data: {
            source: s_id,
            },
            success: function (result) {

            result = result.trim();
            if (result == 'fail')
            {
            } else
            {
            $('#bus').html(result);
            }

            }
    });
    });
    $(".stage_class_update").live('blur', function ()
    {
    var s_id = $(this).val();
    $.ajax({
    url: BASE_URL + "transport/transport_bus_no1",
            type: 'get',
            data: {
            source: s_id,
            },
            success: function (result) {

            result = result.trim();
            if (result == 'fail')
            {
            } else
            {
            $('#update_bus').html(result);
            $("#update_trans").css('display', 'none');
            }
            }
    });
    });
    /*
     $(".stage_class_update").live('blur',function()
     {
     var id=$("#id_trans").val();
     var s_id=$(this).val();
     $.ajax({
     url:BASE_URL+"transport/transport_total",
     type:'get',
     data:{
     source:s_id,
     },
     success:function(result){

     result = result.trim();
     if(result == 'fail')
     {
     }
     else
     {
     $("#total:text"+id).val(result);
     }

     }
     });
     });*/

</script>
<script>
    $("#h_id").live('blur', function()
    {
    var h_id = $("#h_id").val();
    if (h_id == "")
    {
    $("#hos_name").html("Select Hostel Name");
    }
    else
    {
    $("#hos_name").html("");
    }
    });</script>
<script>
    $(document).ready(function(){
    $('#submit').live('click', function(){
    var i = 0;
    var h_id = $("#h_id").val();
    if (h_id == "")
    {
    $("#hos_name").html("Select Hostel Name");
    i = 1;
    }
    else     {     $("#hos_name").html("");
    }
    if (i == 1)
    {
    return false;
    }
    else
    {
    return true;
    }
    });
    });
    $(".bus_class").live('change', function()
    {
    var bus_id = $(this).val();
    var stage = $("#get_stage").val();
    $.ajax({
    url:BASE_URL + "transport/transport_amount",
            type:'get',
            da t a:{
            bus_id:bu s_id, s tage:stage,
            },
            success:funct io n(result){

    $('#route').html(resul t);
    }
    });
   });
    $(".route_class").l ive('change', function()
    {
    var bus_ i d = $("#bus _ id").val();
    var stage = $("#get_stage").val();
    $.ajax({
    url:BASE_URL + "transport/t  ra ns port_amount1",
            type:'get',
            d ata:{
            bus_id:bus_id, stag e :stage,
            },
            success:funct i on(result){
    result = resu l t.trim();
    $('#amount').html(result);
    //$('#update_year_show').css('display','none');
    }
    });
    });
    $(".route_class _ up").live('change', function()
    {
    var stage = $('#ge t _stage_update').val();
    var bus_id = $('#bus_id_up').val();
    $.ajax({
    url:BASE_URL + "transport/transport_amount1",
            type:'get',
            data:{
            bus _id:bus_id, stage:stage,
            },
            su ccess:fu nction(result){
    result = resul t.trim();
    $('#amount_ u p').html(result);
    $('#upd a te_year_show').css('display', 'none');
    }
    });
    });
    $(".bus_class").live('change', function()
    {
    var bus_id = $(this).val();
    var stage = $("#get_stage").val();
    $.aja x ({
    url: B ASE_URL + "transport/transport_total",
            type:'get',
            data:{
            bus_id:bus_id, stage:stage,
            },
            success:function(result){
            result = result.trim();
            $("#total:text").val(result);
            }
    });
    });
    $(".bus_class_up").live('change', function()
    {
    var bus_id = $(this).val();
    var stage = $(".stage_class_update").val();
    $.ajax({
    url:BASE_URL + "transport/trans port_total",
            t ype:'get',
            dat a :{
            bus_id:b u s_ id, stage:st a g e,
            },
            succes s:function(result){
            $(".total:text").val(resu lt);
            }
    }); });
    $(".bus_class_up").live('change', func t ion()
    {
    var bus_ id = $(this).val();
    var stage = $(".stage_class_update").val();
    $.ajax({
    url:BASE_URL + "transport/tr ansport_amount_up",
            type:'get',
            dat a:{
            bus_id:bus_id, stag e:stag e,
            },
            success:function(result){
            $('#ro ute_up').ht ml(resul t);
            }
    });
    });
    $("#stage_id").live ('change', function()
    {
    var stage_id = $("#stage_id").val();
    $.ajax({
    url:BASE_ URL + "transport/tran spor t_amount ",
            type:'get',
            data:  {
            sta ge _id:stage _i d,
            },
            success  : function(result){
            $('#amount').htm l(result);
            }
    });
    });
    < /script  >
            < script type = "te xt/javascript" >
            $('.date').datetimepicker({
    lang:'de ', i18n:{de:{
    mon t hs:[
            'January', 'February', 'March', 'April', 'May', 'Ju n e', 'July', 'August', 'September', 'October', 'November', 'December'
    ],
            dayOfWeek:["Su.", "M o", "T u", "We", " Th", "Fr ", "Sa." ]
    }},
            timepicker:false,
            format:'d-m- Y'
    });
    /*edit index toggle s how*/
    $(".edit_cla s").live ('click', function  ()
    {

    $("#advance_pay").toggle();
    var bank = $('#amount_id').val();
    $("#total:text").val(ba nk);
    $("#rea son").val ('');
    $(" #a_amt").val('');
    });
    /*edi t toggle show* /     $(".edit_update").live('click', functi on ()
     {

     $("#advance_pay1"). togg l e();

     });


     /*index bank detail d iv show*/     $("#p_mode_trans").live('change', function ()
    {
    var bank = $(this).val();
    if ((bank == 3) || (bank == 2))
    {
    $("#trans").css('display', 'block');
    }
    if ((bank = = 1))   {
    $("#trans ").css('disp l ay', ' none');
    }


    });
    /*update p
     op
     up bank detail  div show*/
    $(".payment_mode_up").live('change', function ()
    {
    var bank = $(this).val(); if ((bank == 3) || (bank == 2))
            trans_up
    {
    $("#up_bank").show(000);
    }
    if ((bank == 1))     {
    $("#up_bank").hide(000);
    }
    });
    $(".payment_mo de  _up").live('change', function ()
    {
    var bank = $(this).val();
    if ((bank == 3) || (bank == 2))
    {
    $ ("#trans_up").show(000);
    }
    if ((b ank == 1))
    {
    $("#trans_up").hide(000);
    }
    });
    < ! -- f ine amount keyup functional -- >
            $(".fine_class").live('keyup', function()
    {
    var bank = $(this).val();
    var amt_six = $(' .s_mon').val(); if (amt_six != 1)
    {
    if (bank == "")
    {
    var bank2 = $('#amount_id').val();
    $("#t o tal:text").val(bank2);
    }

    var ad_amount = $('#a_amt').val();
    if (ad_amount == '')
    {
    var bank2 = parseInt($('#amount_id').val());
    var bank = parseInt($(this).val());
    $("#total:text").val(bank + bank2);
    }
    else
    {
    var ad_amount = parseInt($('#a_amt').val());
    var bank = parseInt($(this).val());
    $("#total:text").val(bank + ad_amount);
    }
    }

    if (amt_six = 1)
    {
    if (bank == "")
    {
    var bank2 = $('#amount_year').val();
    $("#total:text").val(bank2); }

    var ad_amount = $('#a_amt').val();
    //alert(ad_amount); return false;
    if (ad_amount == '')
    {
    var bank2 = parseInt($('#amount_year').val());
    var bank = parseInt($(this).val());
    $("#total:text").val(bank + bank2);
    }
    else
    {
    var ad_amount = parseInt($('#a_amt').val());
    var bank5 = parseInt($(this).val());
    $("#total:text").val(bank5 + ad_amount);
    }
    }

    });
    < !--amount keyup functional-- >
            $("#a_amt").live('keyup', function()
    {
    var bank = $(this).val();
    if (bank == "")
    {
    var bank1 = $('#amount_id').val();
    $("#total:text").val(bank1);
    $(".s_mon").val('');
    }
    else
    {
    $("#total:text").val(bank);
    $(".s_mon").val('');
    }
    });
    $(".s_mon").live('change', function()
    {
    var month = $(this).val();
    if (month == 1)
    {

    var stage_amount = $('#amount_id').val();
    var reason_amont = $('.adva_amount').val();
    if (reason_amont == '')
    {
    var cost = stage_amount / 2;
    $("#total:text").val(cost);
    $("#amount_year:text").val(cost);
    }
    if (reason_amont != '')
    {
    var cost = reason_amont / 2;
    $("#total:text").val(cost);
    $("#amount_year:text").val(cost);
    }
    }
    else
    {
    var reason_amont = $('.adva_amount').val();
    if (reason_amont == '')
    {
    var stage_amount = $('#amount_id').val();
    var cost = stage_amount / 1;
    $("#total:text").val(cost);
    $("#amount_year:text").val(cost);
    }
    if (reason_amont != '')
    {
    var cost = reason_amont / 1;
    $("#total:text").val(cost);
    $("#amount_year:text").val(cost);
    }
    }

    });
    < !--month div view-- >
            $(".tdate_class").live('change', function()
    {

    var tdate = $(this).val();
    var fdate = $("#fdate").val();
    if (fdate == tdate)
    {

    $(".insert_month").css('display', 'block');
    }
    else
    {
    $(".insert_month").css('display', 'none');
    }


    });
    < !--month div view-- >
            $("#fdate").live('change', function()
    {

    var fdate = $(this).val();
    var tdate = $("#tdate").val();
    if (fdate == tdate)
    {

    $(".insert_month").css('display', 'block');
    }
    else
    {
    $(".insert_month").css('display', 'none');
    }
    });
    < !--update ajax-- >
            $("#update_pop_up").live('click', function()
    {
    var id = $("#id_trans").val();
    var stage = $(this).parent().parent().find('#get_stage_update').val();
    var date_from = $(this).parent().parent().find('#date_from_u').val();
    var date_to = $(this).parent().parent().find('#date_to_u').val();
    var fmon = $(this).parent().parent().find('#fdate_up').val();
    var tmon = $(this).parent().parent().find('#tdate_up').val();
    var bus_id = $(this).parent().parent().find('#bus_id_up').val();
    var amount_id = $(this).parent().parent().find('#amount_id_up').val();
    var route_id = $(this).parent().parent().find('#route_id_up').val();
    var a_amt = $(this).parent().parent().find('#a_amt').val();
    var reason = $(this).parent().parent().find('#reason').val();
    var f_days = $(this).parent().parent().find('#days').val();
    var get_fine = $(this).parent().parent().find('#get_fine').val();
    var due_date = $(this).parent().parent().find('#get_due_date').val();
    var payment_mode = $(this).parent().parent().find('#p_mode_trans_up').val();
    var bank_name = $(this).parent().parent().find('.bank_name_u').val();
    var branch_name = $(this).parent().parent().find('.branch_name_u').val();
    var bank_dd = $(this).parent().parent().find('.bank_dd_u').val();
    var bank_amount = $(this).parent().parent().find('.bank_amount_u').val();
    var total = $(this).parent().parent().find('#total').val();
    var bank_amount = $(this).parent().parent().find('.bank_amount').val();
    var std_reg = $(".roll_no_up").val();
    $.ajax({
    url:BASE_URL + "transport/update_student_transport1",
            type:'get',
            data:{
            stage:stage,
                    id:id,
                    fmon:fmon,
                    tmon:tmon,
                    date_from:date_from,
                    date_to:date_to,
                    bus_id:bus_id,
                    amount_id:amount_id,
                    route_id:route_id,
                    a_amt:a_amt,
                    reason:reason,
                    f_days:f_days,
                    get_fine:get_fine,
                    payment_mode:payment_mode,
                    bank_name:bank_name,
                    bank_dd:bank_dd,
                    bank_amount:bank_amount,
                    branch_name:branch_name,
                    total:total,
                    std_reg:std_reg
            }, success:function(result){
    $("#view_tabel").html(result);
    }
    });
    $('.modal').css("display", "none");
    $('.fade').css("display", "none");
    });
    $('#view_print').live('click', function(){
    var std_reg = $(".std_reg").val().trim();
    window.open(
            BASE_URL + 'transport/fees_details_transport/' + std_reg, 'Fees Deatails', 'height=500,width=950,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes');
    });</script>
<script>


    /*showing year*/

    $('#bus_id_up').live('change', function()
    {
    var std_roll = $(".std_reg").val();
    $.ajax({
    url:BASE_URL + "transport/transport_year",
            type:'get',
            data:{
            std_roll:std_roll
            },
            success:function(result){

            $('#update_year_show').html(result);
            }
    });
    });
    //idno=($(this).attr('class'));
</script>


<script>

    /*insert ajax function*/
    $("#submit_trans").live('click', function()
    {

    var stage = $("#get_stage").val();
    var date_from = $("#fdate").val();
    var date_to = $("#tdate").val();
    var fdate = $("#gMonth1").val();
    var tdate = $("#gMonth2").val();
    var bus_id = $("#bus_id").val();
    var amount_id = $("#amount_id").val();
    var route_id = $("#route_id").val();
    var a_amt = $("#a_amt").val();
    var reason = $("#reason").val();
    var period_amount = $("#amount_year").val();
    var period = $("#period").val();
    var get_fine = $("#get_fine").val();
    var due_date = $("#get_due_date").val();
    var payment_mode = $("#p_mode_trans").val();
    var bank_name = $(".bank_name").val();
    var branch_name = $(".branch_name").val();
    var bank_dd = $(".bank_dd").val();
    var bank_amount = $(".bank_amount").val();
    var total = $("#total").val();
    var bank_amount = $(".bank_amount").val();
    var std_reg = $(".std_reg").val();
    for_loading('Loading... Data Adding...');
    $.ajax({
    url:BASE_URL + "transport/insert_transport_fees",
            type:'get',
            data:{
            stage:stage,
                    date_from:date_from,
                    date_to:date_to,
                    fdate:fdate,
                    tdate:tdate,
                    bus_id:bus_id,
                    amount_id:amount_id,
                    route_id:route_id,
                    a_amt:a_amt,
                    reason:reason,
                    period_amount:period_amount,
                    period:period,
                    get_fine:get_fine,
                    payment_mode:payment_mode,
                    bank_name:bank_name,
                    bank_dd:bank_dd,
                    bank_amount:bank_amount,
                    branch_name:branch_name,
                    total:total,
                    std_reg:std_reg
            },
            success:function(result){

            $("#view_tabel").html(result);
            var stage = $(".t_port").val('');
            var route_id = $("#route_id").val('');
            var bank_amount = $(".bank_amount").val('');
            $(".insert_month").css('display', 'none');
            $("#trans").css('display', 'none');
            $("#advance_pay").css('display', 'none');
            $("#front_view").css('display', 'none');
            $("#incase").css('display', 'none');
            for_response('Add Successfully...!'); //
            }
    });
    });</script>
</script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
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


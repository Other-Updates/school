<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); 
?>
<link href="<?= $theme_path; ?>/img/favicon.png" rel="shortcut icon" type="img/x-icon">
<link rel="stylesheet" type="text/css" media="all" href="<?= $theme_path; ?>/css/bootstrap.css" />      
<link href="<?= $theme_path; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
<link href="<?= $theme_path; ?>/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $theme_path; ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/jquery.datetimepicker.css" />
		<script type="text/javascript" src="<?= $theme_path; ?>/js/jquery.datetimepicker.js"></script>
<br />      
   
<table border="0" id='app_table' class="staff_table_sub">
    <tr>
        <th>S.No</th>
        <th>Subject</th>
        <th>Date</th>
        <th>From Time</th>
        <th>To Time</th>
    </tr>
   		 <?php 
			if(isset($all_subject) && !empty($all_subject))
			{
				$r=0;
				$k=1;
				foreach($all_subject as $val)
				{
				?>
				
        <tr>
            <td class="sno"><?=$k?></td>
            <td>
            	<select class="select_subject check_other_class">
                        <option value="">Select</option>
                        <?php 
							if(isset($all_subject) && !empty($all_subject))
							{
								foreach($all_subject as $val)
								{
									?>
										<option  value="<?=$val['id']?>"><?=$val['nick_name']?></option>
									<?php
								}
							}
						?>                 
                     </select>
            </td>
            <td><input type="text" class="int_date date"/></td>
            <td>
            	<div class="bootstrap-timepicker">
                            <div class="form-group">
                                <div class="input-group" style="width:100px;">
                                    <input type="text" class="form-control timepicker timein" />
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>   
            </td>
            <td>
            	<div class="bootstrap-timepicker">
                            <div class="form-group">
                                <div class="input-group" style="width:100px;">
                                    <input type="text" class="form-control timepicker timeout"/>
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>   
            </td>
        </tr>
 		<?php
			$k++;
			}
			
		}
		else
		{
			$r=1;
			echo "<tr><td colspan='5'>Subject Not Created Yet..</td></tr>";
		}
		?>     		
</table >
<br />
<p class="fright">
<?php
if($ajax_val['select_type']==1 && $r==0){
?>
<input type="button" value='Submit' id='other_time_btn' class="btn btn-primary" disabled="disabled" />
<?php }else if($ajax_val['select_type']==2 && $r==0){?>
<input type="button" value='Submit' id='other_time_btn1' class="btn btn-primary" disabled="disabled"/>
<?php }else if($ajax_val['select_type']==3 && $r==0){?>
<input type="button" value='Submit' id='other_time_btn2' class="btn btn-primary" disabled="disabled" />
<?php }?>
<br />
<p>
<div>
<table class="staff_table">
<?php 
if(isset($all_subject) && !empty($all_subject))
				{
                foreach($all_subject as $val)
                { ?>
	<tr>
    <td width="137"><?php echo $val['nick_name']; ?></td>
    <td width="5">:</td>
    <td class="text_bold"><?php echo ucfirst(strtolower($val['subject_name'])); ?></td></tr>
    <?php }} ?>
</table>
</div>
		
        
        
		<script src="<?= $theme_path; ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script src="<?= $theme_path; ?>/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
		<script src="<?= $theme_path; ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
		<script type="text/javascript">
            var BASE_URL = '<?php echo $this->config->item('base_url');  ?>';
        </script>
        <script type="text/javascript">
           
			
			$(".timepicker").timepicker({
                    showInputs: false
                });
        </script>
         <script type="text/javascript">// <![CDATA[
			$('.date').datetimepicker({
			 lang:'de',
			 i18n:{de:{
			  months:[
			   'January','February','March','April','May','June','July','August','September','October','November','December'
			  ],
			  dayOfWeek:["Su.", "Mo", "Tu", "We", "Th", "Fr", "Sa."]
			 }},
			timepicker:false,
			format:'d-m-Y'
			});
			
		</script> 

<div class="add_staff">
<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<form method="post"  enctype="multipart/form-data" action="driver_insert_det" name="sform" onsubmit="return validate();">
<table class="driver_table">
	<tr>
    	<td width="95">Name</td>
        <td width="218"><input type="text" name='name' class="mandatory"     id="staff_name" tabindex="1"/></td>
        <td width="104">Joining Date</td>
        <td width="144"><input type="text"  class='date mandatory' name='join_date' id="join_date" tabindex="2" /></td>
      
        <td width="226" rowspan="3" >
        	<div class="staff_img">
        	<a href="#">size 120*140</a>
        	<img id="blah" class="add_staff_thumbnail" src="<?= $theme_path; ?>/img/avatar5.png"  alt="Driver Image" />            
            <p>&nbsp;</p>
            <input type='file' name="staff_image" id="imgInp" tabindex="3" />
            </div>
        </td>
    </tr>
    <tr>
    	<td style="vertical-align:top">Address</td>
        <td><textarea style="width:77%; height:50px;" name='address' class="mandatory" id="address" tabindex="4"></textarea ></td>
        <td>License Upload</td>
        <td><input type='file' name="lic_scan" id="imgInp" tabindex="" /></td>
      </tr>
    <tr>
    	<td>Driver Id</td>
        <td><input type="text" name='driver_id' class="mandatory" id="staff_id" tabindex="5" />
          
        <td>Termination Date</td>
        <td><input type="text" class='date'    name='end_date' tabindex="10" /></td>
       
    </tr>
    <tr>
    	<td>Experience</td>
        <td><input type="text"  name='experience' class="mandatory" onkeypress="return validateAlphabets(event);" id="state" tabindex="6"></td>
        	
        <td>Mobile No</td>
        <td><input type="text"  name='mobile_no'  class="int_val mandatory" id="mobile" tabindex="7" />
    </tr>
    <tr>
    <td></td>
    <td rowspan="4" >
            
        </td>
  
</table>

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
    
    $("#imgInp").change(function(){
		
        if($(this).val()=="" || $(this).val()==null)
							{
								
							}
							else
							{
                        readURL(this);
							}
    });
	// Image validation size checking
	$("#imgInp").change(function() {

    var val = $(this).val();

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpeg': case 'jpg': case 'png': case '':
            $("#v18").html("");
            break;
        default:
            $(this).val();
            // error message here
           $("#v18").html("Invalid File Type");
            break;
    }
});
</script>


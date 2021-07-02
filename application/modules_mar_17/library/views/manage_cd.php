<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?> 

<div class="row">
	<div class="col-lg-6">
		<table class="staff_table">
        	<tr>
                <td>CD NO</td>
                <td><input type="text" class="mandatory1 mandatory no_discs" id="no_discs"  />
                <span style="color:red;" id="v4" class="v4"></span>
                </td>
        	</tr>
            <tr>
                <td width="150">Title</td>
                <td><input type="text" tabindex="1" name="cd_title"  id="cd_title" class="cd_title mandatory mandatory1"/>
                <span style="color:red;" id="v1" class="v1"></span> </td>
            </tr>
            <tr>
            <td>Category</td>
                <td><select name="category" tabindex="2" id="category" class="mandatory mandatory1 category" >
             <option value="" selected="selected">Select</option>
             <?php 
			if(isset($category) && !empty($category))
			{
				foreach ($category as $cat)
				{
					?>
          
            <option value="<?php echo $cat['bcid']; ?>"><?php echo $cat['book_cat']; ?></option>
            <?php }}; ?>
            </select><span style="color:red;" id="v2" class="v2"></span></td>
            </tr>
            
            <tr>
            <td>Language</td>
            <td><select name="language" id="language" tabindex="3" class="mandatory mandatory1 language" required >
             <option value="" selected="selected">Select</option>
             <?php 
			if(isset($language) && !empty($language))
			{
				foreach ($language as $lang)
				{
					?>
          
            <option value="<?php echo $lang['id']; ?>"><?php echo $lang['lang_type']; ?></option>
            <?php }}; ?>
            </select><span style="color:red;" id="v3" class="v3"></span></td>
        </tr>
       
        <tr>
            <td>Price</td>
            <td><input type="text" tabindex="5" name="price" class="mandatory1 mandatory price" id="price" />
            <span style="color:red;" id="v5" class="v5"></span>
            </td>
        </tr>
        <tr>
            <td>Date of Receipt</td>
            <td><input type="text" tabindex="6" name="receipt" class="date mandatory1 mandatory receipt" id="receipt"  />
            <span style="color:red;" id="v6" class="v6"></span>
            </td>
        </tr>
        <tr>
            <td>Date of Purchase</td>
            <td><input type="text" tabindex="7" name="purchase" class="date mandatory1 mandatory purchase" id="purchase" />
            <span style="color:red;" id="v7" class="v7"></span>
            </td>
        </tr>
	 </table>
	</div>
	<div class="col-lg-6">
        <table class="staff_table">
       
       
        <tr>
            <td>Editition</td>
            <td><input type="text" tabindex="8" name="editition" class="mandatory1 mandatory editition" id="editition" />
            <span style="color:red;" id="v8" class="v8"></span>
            </td>
        </tr>
        <tr>
            <td>Bill Number</td>
            <td><input type="text" tabindex="9" name="bill_number" class="mandatory1 mandatory bill_number" id="bill_number" />
            <span style="color:red;" id="v9" class="v9"></span>
       </tr>
        <tr>
            <td>Publisher's Name</td>
            <td><input type="text" tabindex="10" name="pub_name" class="mandatory1 mandatory pub_name" id="pub_name" />
            <span style="color:red;" id="v10" class="v10"></span>
            </td>
        </tr>
        <tr>
            <td>Publisher's address</td>
            <td><textarea name="pub_add" id="pub_add" tabindex="11" class="pub_add mandatory1 mandatory" style="width: 60%; height: 50px;"></textarea>
            <span style="color:red;" id="v11" class="v11"></span> </td>
        </tr>
        <tr>
            <td>Email-id</td>
            <td><input type="text" tabindex="12" name="email_id" class="mandatory1 mandatory email_id" id="email_id" />
            <span style="color:red;" id="v12" class="v12"></span>
            </td>
        </tr>
        <tr>
            <td>Contact number</td>
            <td><input type="text" tabindex="13" name="con_num" class="mandatory1 mandatory con_num" id="con_num" />
            <span style="color:red;" id="v13" class="v13"></span>
           </td>
        </tr>
         <tr>
            <td>Select Rack</td>
           
            <td><select name="select_rack" id="select_rack" class="mandatory select_rack"  >
            <option value="" selected="selected">Select</option>
           <?php 
			if(isset($rack) && !empty($rack))
			{
				foreach ($rack as $rack_val)
				{
					?>
          
            <option value="<?php echo $rack_val['brid']; ?>"><?php echo $rack_val['bk_rack']; ?></option>
            <?php }}; ?>
            </select></td>
        </tr>
        <tr>
            <td>Select Row</td>
            <td><input type="text" tabindex="4" class="book_row mandatory1 mandatory" id="select_row"/>
           </td>
        </tr>         
        <tr>
            <td></td>
            <td>
                <input type="button" value="Add" name="adding" id="submit" class="btn btn-primary" tabindex="8" />
                <input type="button" value="Cancel" id="cancel" class="btn btn-danger" tabindex="9"/>
            </td>
        </tr>
        </table>
	</div>
</div>


<div class="tab-pane" id="view_all"> 
<table id="example3" class="table table-bordered table-striped">
   
      <thead>
    	<tr>
            <th>S.no</th>
            <th>CD No</th>
            <th>Title</th>
            <td>Rack</td>
            <td>Row</td>
            <th>Price</th>
            <th>Date of Receipt</th>
            <th>Date of Purchase</th>
            <th>Publisher's name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Action</th>
        </tr>
        </thead>

<?php $i=0;
			if(isset($details) && !empty($details))
			{
				foreach ($details as $view)
				{
					//print_r($view);
					?>
     
					<tr>
                        <td><?php echo  $i+1; ?></td>
                        <td><?php echo $view['cd_no'];?></td>
                        <td><?php echo $view['cd_title'];?></td>
                        <td><?php echo $view['bk_rack'];?> </td>
                        <td><?php echo $view['row'];?></td>
                        <td><?php echo $view['price'];?></td> 
                        <td><?php echo $view['date_of_receipt'];?></td>
                        <td><?php echo $view['date_of_purchase'];?></td>
                        <td><?php echo $view['pub_name'];?></td>
                        <td><?php echo $view['pub_email'];?></td>
                        <td><?php echo $view['pub_contact_no'];?></td>
                        <td><a href="#view_batch<?php  echo $view['id']; ?>" title="View" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="<?php $this->config->item("base_url"); ?>library/edit_cd/<?=$view['id']?>" title="Edit" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="#delete_batch<?php  echo $view['id']; ?>" title="Delete" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                        </td>                    
                    </tr>
					<?php $i++;} } ?> 
	</table>
    
 	</div>


<!--View form-->
 <?php $i=0;
   			if(isset($details) && !empty($details))
			{
				foreach ($details as $view)
				{
					//echo "<pre>";print_r($view);exit;?>
	
         <div id="view_batch<?=$view['id']?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
         aria-hidden="false" style= align="center">
         	<div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                   <h3 id="myModalLabel">View CD/DVD Paper</h3>
                  </div>
                  <div class="modal-body">
                      <table class="staff_table_sub">
                             <tbody>
                             		<tr>
                                     <td>CD NO</td>
                                     <td class="text_bold1"><?=$view['cd_no']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Title</td>
                                     <td class="text_bold1"><?=$view['cd_title']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Rack</td>
                                    <td class="text_bold1"><?=$view['bk_rack']?> </td>
                                     
                                     
                                    </tr>
                                    <tr>
                                     <td>Row</td>
                                     <td class="text_bold1"><?=$view['row']?> </td>
                                    </tr>
                                    <tr>
                                     <td>Language</td>
                                     <td class="text_bold1"><?=$view['lang_type']?> </td>
                                    </tr>
                                    
                                    <tr>
                                     <td>Price</td>
                                     <td class="text_bold1"><?=$view['price']?> </td>
                                    </tr>
                                    <tr>
                                    <td>Date of Receipt</td>
                                     <td class="text_bold1"><?=$view['date_of_receipt']?> </td>
                                    </tr>
                                    <tr>
                                    <td>Date of Purchase</td>
                                     <td class="text_bold1"><?=$view['date_of_purchase']?> </td>
                                    </tr>
                                    <tr>
                                    <td>Publisher's name</td>
                                     <td class="text_bold1"><?=$view['pub_name']?> </td>
                                    </tr>
                                    <tr>
                                    <td>Email</td>
                                     <td class="text_bold1"><?=$view['pub_email']?> </td>
                                    </tr>
                                    <tr>
                                    <td>Contact Number</td>
                                     <td class="text_bold1"><?=$view['pub_contact_no']?> </td>
                                    </tr>
                                    <tr>
                                    <td>Publisher's address</td>
                                     <td class="text_bold1"><?=$view['pub_address']?> </td>
                                    </tr>
                                                                        
                                </tbody>
                            </table>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Discard</button>
                  </div>
                  </div>
                  </div>
                </div>
<?php $i++;}} ?> 


<!--View form end-->

<!--Delete form Start-->
<?php 
if(isset($details) && !empty($details))
{
foreach($details as $view) 
{
 ?>   
<div id="delete_batch<?php echo $view['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
aria-hidden="false" align="center">
	<div class="modal-dialog">
 		 <div class="modal-content">
    			<div class="modal-header">
   					 <a class="close" data-dismiss="modal">×</a>
           				 <h3 id="myModalLabel">Delete CD/DVD Details</h3>
			    </div>
  				<div class="modal-body">
  					Do you want to In-Active it? &nbsp; <strong></strong>
    			    <input type="hidden" value="<?php echo $view['id']; ?>" class="hidin" />
  				</div>
  				<div class="modal-footer">
    				<button class="btn btn-primary delete_yes" id="yesin">Yes</button>
    				<button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no">
                    <i class="fa fa-times"></i> No</button>
  				</div>
		</div>
	</div>  
</div>
<?php }} ?>





<script type="text/javascript">
$(document).ready(function(){
	$("#submit").live('click',function()
	 {
		var i=0;
		var cd_title=$("#cd_title").val(),
		category=$("#category").val(),
		language=$("#language").val(),
		no_discs=$("#no_discs").val(),
		price=$("#price").val(),
		receipt=$("#receipt").val(),
		purchase=$("#purchase").val();
		editition=$("#editition").val(),
		bill_number=$("#bill_number").val(),
		pub_name=$("#pub_name").val(),
		pub_add=$("#pub_add").val(),
		email_id=$("#email_id").val(),
		select_rack=$("#select_rack").val(),
		select_row=$("#select_row").val(),
		con_num=$("#con_num").val();
		var cd_title=$(".cd_title").val();
	if(cd_title=='')
	{
		$(".v1").html("Required Field");
		i=1;
	}
	else
	{
		$(".v1").html("");
	}

	var category=$(".category").val();
	if(category=='')
	{
		$(".v2").html("Required Field");
		i=1;
	}
	else
	{
		$(".v2").html("");
	}

	var language=$(".language").val();
	if(language=='')
	{
		$(".v3").html("Required Field");
		i=1;
	}
	else
	{
		$(".v3").html("");
	}

	var no_discs=$(".no_discs").val();
	if(no_discs=='')
	{
		$(".v4").html("Required Field");
		i=1;
	}
	else
	{
		$(".v4").html("");
	}

	var price=$(".price").val();
	if(price=='')
	{
		$(".v5").html("Required Field");
		i=1;
	}
	else
	{
		$(".v5").html("");
	}

	var receipt=$(".receipt").val();
	if(receipt=='')
	{
		$(".v6").html("Required Field");
		i=1;
	}
	else
	{
		$(".v6").html("");
	}

	var purchase=$(".purchase").val();
	if(purchase=='')
	{
		$(".v7").html("Required Field");
		i=1;
	}
	else
	{
		$(".v7").html("");
	}

	var editition=$(".editition").val();
	if(editition=='')
	{
		$(".v8").html("Required Field");
		i=1;
	}
	else
	{
		$(".v8").html("");
	}

	var bill_number=$(".bill_number").val();
	if(bill_number=='')
	{
		$(".v9").html("Required Field");
		i=1;
	}
	else
	{
		$(".v9").html("");
	}

	var pub_name=$(".pub_name").val();
	if(pub_name=='')
	{
		$(".v10").html("Required Field");
		i=1;
	}
	else
	{
		$(".v10").html("");
	}

	var pub_add=$(".pub_add").val();
	if(pub_add=='')
	{
		$(".v11").html("Required Field");
		i=1;
	}
	else
	{
		$(".v11").html("");
	}

	var email_id=$(".email_id").val();
	if(email_id=='')
	{
		$(".v12").html("Required Field");
		i=1;
	}
	else
	{
		$(".v12").html("");
	}

	var con_num=$(".con_num").val();
	if(con_num=='')
	{
		$(".v13").html("Required Field");
		i=1;
	}
	else
	{
		$(".v13").html("");
	}
if(i==1)
	{
		return false;
	}
	else
	{
	
			//alert(pub_name);	
		 for_loading('Loading... Data Adding...');
		$.ajax({
			url:BASE_URL+"library/insert_manage_cd",
			type:'GET',
			data:{ 
			value1 : cd_title,
			value2 : category,
			value3 : language,
			value4 : no_discs,
			value5 : price,
			value6 : receipt,
			value7 : purchase,
			value8 : editition,
			value9 : bill_number,
			value10 : pub_name,
			value11 : pub_add,
			value12 : email_id,
			value13 : con_num,
			value14 : select_rack,
			value15 : select_row
			},
			
			success:function(result)
				{
					//alert(result);
					$("#view_all").html(result);
					for_response('Add Successfully...!'); //
					//$(".after_email").html('');
				}
		

		});
		$("#cd_title").val(''),
		$("#category").val(''),
		$("#language").val(''),
		$("#no_discs").val(''),
		$("#price").val(''),
		$("#receipt").val(''),
		$("#purchase").val(''),
		$("#editition").val(''),
		$("#bill_number").val(''),
		$("#pub_name").val(''),
		$("#pub_add").val(''),
		$("#email_id").val(''),
		$("#select_rack").val(''),
		$("#select_row").val(''),
		$("#con_num").val('');
	}
	});
});
	$("#yesin").live("click",function()
	  {
	   for_loading_del('Loading... Please wait'); // loading notification
	    var hidin=$(this).parent().parent().find('.hidin').val();
		  $.ajax(
		 	{
			  url:BASE_URL+"library/delete_cd",
			  type:'POST',
			  data:{ value1 : hidin},
			  success:function(result){
				  //alert(result);
			  $("#view_all").html(result);
			  for_response_del(' Success...!'); // resutl notification
			 }    
	 	 });
	    $('.modal').css("display", "none");
    	$('.fade').css("display", "none");
	}); 
	 


</script>
<script>
$(".cd_title").live('blur',function(){
	
	var cd_title=$(".cd_title").val();
	if(cd_title=='')
	{
		$(".v1").html("Required Field");
	}
	else
	{
		$(".v1").html("");
	}
});
$(".category").live('blur',function(){
	
	var category=$(".category").val();
	if(category=='')
	{
		$(".v2").html("Required Field");
	}
	else
	{
		$(".v2").html("");
	}
});
$(".language").live('blur',function(){
	
	var language=$(".language").val();
	if(language=='')
	{
		$(".v3").html("Required Field");
	}
	else
	{
		$(".v3").html("");
	}
});
$(".no_discs").live('blur',function(){
	
	var no_discs=$(".no_discs").val();
	if(no_discs=='')
	{
		$(".v4").html("Required Field");
	}
	else
	{
		$(".v4").html("");
	}
});
$(".price").live('blur',function(){
	
	var price=$(".price").val();
	if(price=='')
	{
		$(".v5").html("Required Field");
	}
	else
	{
		$(".v5").html("");
	}
});
$(".receipt").live('blur',function(){
	
	var receipt=$(".receipt").val();
	if(receipt=='')
	{
		$(".v6").html("Required Field");
	}
	else
	{
		$(".v6").html("");
	}
});
$(".purchase").live('blur',function(){
	
	var purchase=$(".purchase").val();
	if(purchase=='')
	{
		$(".v7").html("Required Field");
	}
	else
	{
		$(".v7").html("");
	}
});
$(".editition").live('blur',function(){
	
	var editition=$(".editition").val();
	if(editition=='')
	{
		$(".v8").html("Required Field");
	}
	else
	{
		$(".v8").html("");
	}
});
$(".bill_number").live('blur',function(){
	
	var bill_number=$(".bill_number").val();
	if(bill_number=='')
	{
		$(".v9").html("Required Field");
	}
	else
	{
		$(".v9").html("");
	}
});
$(".pub_name").live('blur',function(){
	
	var pub_name=$(".pub_name").val();
	if(pub_name=='')
	{
		$(".v10").html("Required Field");
	}
	else
	{
		$(".v10").html("");
	}
});
$(".pub_add").live('blur',function(){
	
	var pub_add=$(".pub_add").val();
	if(pub_add=='')
	{
		$(".v11").html("Required Field");
	}
	else
	{
		$(".v11").html("");
	}
});
$(".email_id").live('blur',function(){
	
	var email_id=$(".email_id").val();
	if(email_id=='')
	{
		$(".v12").html("Required Field");
	}
	else
	{
		$(".v12").html("");
	}
});
$(".con_num").live('blur',function(){
	
	var con_num=$(".con_num").val();
	if(con_num=='')
	{
		$(".v13").html("Required Field");
	}
	else
	{
		$(".v13").html("");
	}
});

</script>

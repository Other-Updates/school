<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>  

<div class="row">
	<div class="col-lg-6">
		<table class="staff_table">
            <tr>
                <td width="150">ACC No</td>
                <td><input type="text" tabindex="1" name="acc_no"  id="acc_no" class="acc_no1 mandatory mandatory1"  
                maxlength="50" /> <span style="color:red;" id="v1" class="v1"></span> </td>
            </tr>
            <tr>
            <td>Book No</td>
                <td><input type="text" tabindex="3" name="isbn_no"  class=" isbn_no mandatory1 mandatory" id="isbn_no"  
                maxlength="20" /> <span style="color:red;" id="v2" class="v2"></span> </td>
            </tr>
            <tr>
                <td style="vertical-align:top">Book Title</td>
                <td><input type="text" tabindex="3" name="book_title"  class="book_title mandatory1 mandatory" id="book_title"  
                /><span style="color:red;" id="v3" class="v3"></span>  </td>
            </tr>
            <tr>
            <td>Book Type</td>
            <td><select name="book_type" id="book_type" class="book_type mandatory mandatory1" required >
            <option value="" selected="selected">Select</option>
            <?php 
			if(isset($book_type) && !empty($book_type))
			{
				foreach ($book_type as $val)
				{
					?>
          
            <option value="<?php echo $val['btid']; ?>"><?php echo $val['book_type']; ?></option>
            <?php }}; ?>
            </select><span style="color:red;" id="v4" class="v4"></span> </td>
        </tr>
        <tr>
            <td>Authore Name</td>
            <td><input type="text" tabindex="4" name="authore" class="authore mandatory1 mandatory" id="authore"  />
            <span style="color:red;" id="v5" class="v5"></span> </td>
        </tr>
        <tr>
            <td>Purchase Date</td>
            <td><input type="text" tabindex="4" name="purchase" class="date  mandatory1 mandatory purchase " id="purchase" />
           <span style="color:red;" id="v6" class="v6"></span></td>
        </tr>
        <tr>
            <td>Edition</td>
            <td><input type="text" tabindex="4" name="edition" class="mandatory1 mandatory edition" id="edition" />
             <span style="color:red;" id="v7" class="v7"></span></td></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type="text" tabindex="4" name="price" class="price mandatory1 mandatory" id="price" />
             <span style="color:red;" id="v8" class="v8"></span></td>
            </td>
        </tr>
	 </table>
	</div>
	<div class="col-lg-6">
        <table class="staff_table">
       
        <tr>
            <td>No. of Pages</td>
            <td><input type="text" tabindex="4" name="page_no" class="mandatory1 mandatory page_no" id="page_no" />
            <span style="color:red;" id="v9" class="v9"></span
           ></td>
        </tr>
        <tr>
            <td>Bill Number</td>
            <td><input type="text" tabindex="4" name="bill_no" class="bill_no mandatory1 mandatory" id="bill_no" />
            <span style="color:red;" id="v10" class="v10">
            </td>
        </tr>
        <tr>
            <td>Publisher's name</td>
            <td><input type="text" tabindex="4" name="publisher" class="publisher mandatory1 mandatory" id="publisher"/>
            <span style="color:red;" id="v11" class="v11">
             </td>
        </tr>
        <tr>
            <td>Publisher's address</td>
            <td><textarea style="width: 60%; height: 50px;" class="publisher_add mandatory1 mandatory" name="publisher_add" id="publisher_add"></textarea>
            <span style="color:red;" id="v12" class="v12"> 
            </td>
        </tr>
        <tr>
            <td>Email-id</td>
            <td><input type="text" tabindex="4" name="email_id" class="email_id mandatory1 mandatory" id="email_id"  />
            <span style="color:red;" id="v13" class="v13"> 
            </td>
        </tr>
        <tr>
            <td>Contact number</td>
            <td><input type="text" tabindex="4" name="conta_num" class="mandatory1 mandatory conta_num" id="conta_num"  />
            <span style="color:red;" id="v14" class="v14"> 
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
            </select> <span style="color:red;" id="v15" class="v15"></td>
        </tr>
        <tr>
            <td>Book Row</td>
            <td><input type="text" tabindex="4" name="book_row" class="book_row mandatory1 mandatory" id="book_row"/>
            <span style="color:red;" id="v16" class="v16">
        </tr>
        
        <tr>
            <td></td>
            <td>
                <input type="button" value="Add" name="adding" id="submit" class="btn btn-primary submit" tabindex="8" />
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
            <th>ACC No</th>
            <th>ISBN No</th>
            <th>Book Title</th>
            <th>Book Type</th>
            <th>Authore Name</th>
            <th>Edition</th>
            <th>Publisher's name</th>
            <th>Rack</th>
            <th>Book Row</th>
            <th>Action</th>
        </tr>
        </thead>

<?php $i=0;
//echo "<pre>";print_r($all_book);exit;
			if(isset($all_book) && !empty($all_book))
			{
				foreach ($all_book as $view)
				{
					?>
     
					<tr>
                        <td><?php echo  $i+1; ?></td>
                        <td><?php echo $view['acc_no'];?></td>
                         <td><?php echo $view['isbn_no'];?></td>
                          <td><?php echo $view['book_title'];?></td>
                           <td><?php echo $view['book_type'];?></td> 
                           <td><?php echo $view['author_name'];?></td>
                         <td><?php echo $view['edition'];?></td>
                          <td><?php echo $view['pub_name'];?></td>
                           <td><?php echo $view['bk_rack'];?></td>
                           <td><?php echo $view['rack_row'];?></td>
                          
                             <td>
                       
                         <a href="<?php $this->config->item("base_url"); ?>library/view_book/<?=$view['id']?>" title="Edit" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="<?php $this->config->item("base_url"); ?>library/edit_book/<?=$view['id']?>" title="Edit" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="#delete_batch<?php  echo $view['id']; ?>" title="Delete" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                        </td>                    
                       
                    </tr>
					<?php $i++;} } ?> 

	</table>
    
 	</div>
    
    
    <!--Delete form Start-->
<?php 
if(isset($all_book) && !empty($all_book))
{
foreach($all_book as $view) 
{
 ?>   
<div id="delete_batch<?php echo $view['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
aria-hidden="false" align="center">
	<div class="modal-dialog">
 		 <div class="modal-content">
    			<div class="modal-header">
   					 <a class="close" data-dismiss="modal">×</a>
           				 <h3 id="myModalLabel">Delete Student Details</h3>
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
		var acc_no=$("#acc_no").val(),
		isbn_no=$("#isbn_no").val(),
		book_title=$("#book_title").val(),
		book_type=$("#book_type").val(),
		authore=$("#authore").val(),
		purchase=$("#purchase").val(),
		edition=$("#edition").val();
		price=$("#price").val(),
		page_no=$("#page_no").val(),
		bill_no=$("#bill_no").val(),
		publisher=$("#publisher").val(),
		publisher_add=$("#publisher_add").val(),
		email_id=$("#email_id").val(),
		conta_num=$("#conta_num").val(),
		select_rack=$("#select_rack").val(),
		book_row=$("#book_row").val();
		var acc_no=$(".acc_no1").val();
	if(acc_no=='')
	{
		$(".v1").html("Required Field");
		i=1;
	}
	else
	{
		$(".v1").html("");
	}

	var isbn_no=$(".isbn_no").val();
	if(isbn_no=='')
	{
		$(".v2").html("Required Field");
		i=1;
	}
	else
	{
		$(".v2").html("");
	}

	
	var book_title=$(".book_title").val();
	if(book_title=='')
	{
		$(".v3").html("Required Field");
		i=1;
	}
	else
	{
		$(".v3").html("");
	}


	var book_type=$(".book_type").val();
	if(book_type=='')
	{
		$(".v4").html("Required Field");
		i=1;
	}
	else
	{
		$(".v4").html("");
	}

	
	var authore=$(".authore").val();
	if(authore=='')
	{
		$(".v5").html("Required Field");
		i=1;
	}
	else
	{
		$(".v5").html("");
	}

	
	var purchase=$(".purchase").val();
	if(purchase=='')
	{
		$(".v6").html("Required Field");
		i=1;
	}
	else
	{
		$(".v6").html("");
	}

	var edition=$(".edition").val();
	if(edition=='')
	{
		$(".v7").html("Required Field");
		i=1;
	}
	else
	{
		$(".v7").html("");
	}

	var price=$(".price").val();
	if(price=='')
	{
		$(".v8").html("Required Field");
		i=1;
	}
	else
	{
		$(".v8").html("");
	}

	var page_no=$(".page_no").val();
	if(page_no=='')
	{
		$(".v9").html("Required Field");
		i=1;
	}
	else
	{
		$(".v9").html("");
	}

	var bill_no=$(".bill_no").val();
	if(bill_no=='')
	{
		$(".v10").html("Required Field");
		i=1;
	}
	else
	{
		$(".v10").html("");
	}

	var publisher=$(".publisher").val();
	if(publisher=='')
	{
		$(".v11").html("Required Field");
		i=1;
	}
	else
	{
		$(".v11").html("");
	}

	var publisher_add=$(".publisher_add").val();
	if(publisher_add=='')
	{
		$(".v12").html("Required Field");
		i=1;
	}
	else
	{
		$(".v12").html("");
	}

	var email_id=$(".email_id").val();
	if(email_id=='')
	{
		$(".v13").html("Required Field");
		i=1;
	}
	else
	{
		$(".v13").html("");
	}

	var conta_num=$(".conta_num").val();
	if(conta_num=='')
	{
		$(".v14").html("Required Field");
		i=1;
	}
	else
	{
		$(".v14").html("");
	}

	var select_rack=$(".select_rack").val();
	if(select_rack=='')
	{
		$(".v15").html("Required Field");
		i=1;
	}
	else
	{
		$(".v15").html("");
	}

	var book_row=$(".book_row").val();
	if(book_row=='')
	{
		$(".v16").html("Required Field");
		i=1;
	}
	else
	{
		$(".v16").html("");
	}
		if(i==1)
		{
			return false;
		}
		else
		{
		
		 for_loading('Loading... Data Adding...');
		$.ajax({
			url:BASE_URL+"library/insert_manage_book",
			type:'POST',
			data:{ 
			value1 : acc_no,
			value2 : isbn_no,
			value3 : book_title,
			value4 : book_type,
			value5 : authore,
			value6 : purchase,
			value7 : edition,
			value8 : price,
			value9 : page_no,
			value10 : bill_no,
			value11 : publisher,
			value12 : publisher_add,
			value13 : email_id,
			value14: conta_num,
			value15 : select_rack,
			value16 : book_row
			},
			success:function(result)
				{
					//alert(result);
					$("#view_all").html(result);
					for_response('Add Successfully...!'); //
					//$(".after_email").html('');
				}
		

		});
		$("#acc_no").val(''),
		$("#isbn_no").val(''),
		$("#book_title").val(''),
		$("#book_type").val(''),
		$("#authore").val(''),
		$("#purchase").val(''),
		$("#edition").val(''),
		$("#price").val(''),
		$("#page_no").val(''),
		$("#bill_no").val(''),
		$("#publisher").val(''),
		$("#publisher_add").val(''),
		$("#email_id").val(''),
		$("#conta_num").val(''),
		$("#select_rack").val(''),
		$("#book_row").val('');
		}
	});
	
});
$("#yesin").live("click",function()
	  {
	   for_loading_del('Loading... Please wait'); // loading notification
	    var hidin=$(this).parent().parent().find('.hidin').val();
		  $.ajax(
		 	{
			  url:BASE_URL+"library/delete_book",
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
$(".acc_no1").live('blur',function(){
	
	var acc_no=$(".acc_no1").val();
	if(acc_no=='')
	{
		$(".v1").html("Required Field");
	}
	else
	{
		$(".v1").html("");
	}
});
$(".isbn_no").live('blur',function(){
	
	var isbn_no=$(".isbn_no").val();
	if(isbn_no=='')
	{
		$(".v2").html("Required Field");
	}
	else
	{
		$(".v2").html("");
	}
});
$(".book_title").live('blur',function(){
	
	var book_title=$(".book_title").val();
	if(book_title=='')
	{
		$(".v3").html("Required Field");
	}
	else
	{
		$(".v3").html("");
	}
});
$(".book_type").live('blur',function(){
	
	var book_type=$(".book_type").val();
	if(book_type=='')
	{
		$(".v4").html("Required Field");
	}
	else
	{
		$(".v4").html("");
	}
});
$(".authore").live('blur',function(){
	
	var authore=$(".authore").val();
	if(authore=='')
	{
		$(".v5").html("Required Field");
	}
	else
	{
		$(".v5").html("");
	}
});
$(".purchase").live('blur',function(){
	
	var purchase=$(".purchase").val();
	if(purchase=='')
	{
		$(".v6").html("Required Field");
	}
	else
	{
		$(".v6").html("");
	}
});
$(".edition").live('blur',function(){
	
	var edition=$(".edition").val();
	if(edition=='')
	{
		$(".v7").html("Required Field");
	}
	else
	{
		$(".v7").html("");
	}
});
$(".price").live('blur',function(){
	
	var price=$(".price").val();
	if(price=='')
	{
		$(".v8").html("Required Field");
	}
	else
	{
		$(".v8").html("");
	}
});
$(".page_no").live('blur',function(){
	
	var page_no=$(".page_no").val();
	if(page_no=='')
	{
		$(".v9").html("Required Field");
	}
	else
	{
		$(".v9").html("");
	}
});
$(".bill_no").live('blur',function(){
	
	var bill_no=$(".bill_no").val();
	if(bill_no=='')
	{
		$(".v10").html("Required Field");
	}
	else
	{
		$(".v10").html("");
	}
});
$(".publisher").live('blur',function(){
	
	var publisher=$(".publisher").val();
	if(publisher=='')
	{
		$(".v11").html("Required Field");
	}
	else
	{
		$(".v11").html("");
	}
});
$(".publisher_add").live('blur',function(){
	
	var publisher_add=$(".publisher_add").val();
	if(publisher_add=='')
	{
		$(".v12").html("Required Field");
	}
	else
	{
		$(".v12").html("");
	}
});
$(".email_id").live('blur',function(){
	
	var email_id=$(".email_id").val();
	if(email_id=='')
	{
		$(".v13").html("Required Field");
	}
	else
	{
		$(".v13").html("");
	}
});
$(".conta_num").live('blur',function(){
	
	var conta_num=$(".conta_num").val();
	if(conta_num=='')
	{
		$(".v14").html("Required Field");
	}
	else
	{
		$(".v14").html("");
	}
});
$(".select_rack").live('blur',function(){
	
	var select_rack=$(".select_rack").val();
	if(select_rack=='')
	{
		$(".v15").html("Required Field");
	}
	else
	{
		$(".v15").html("");
	}
});
$(".book_row").live('blur',function(){
	
	var book_row=$(".book_row").val();
	if(book_row=='')
	{
		$(".v16").html("Required Field");
	}
	else
	{
		$(".v16").html("");
	}
});
</script>
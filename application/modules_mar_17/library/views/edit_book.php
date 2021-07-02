<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>  
<div class="row">
<?php //echo "<pre>"; print_r($details);exit;
			if(isset($details) && !empty($details))
			{
				foreach ($details as $val)
				{
					?>
	<div class="col-lg-6">
    <form action="<?php echo $this->config->item("base_url"); ?>library/update_book/<?php echo $val['id'];?>" method="post">
		<table class="staff_table">
            <tr>
                <td width="150">ACC No</td>
                <td><input type="text" tabindex="1" name="acc_no" value="<?=$val['acc_no']?>"  id="acc_no" class="mandatory mandatory1"  
                maxlength="50" /> </td>
            </tr>
            <tr>
            <td>ISBN No</td>
                <td><input type="text" tabindex="2" name="isbn_no" value="<?=$val['isbn_no']?>" class="mandatory1 mandatory" id="isbn_no"  
                maxlength="20" />  </td>
            </tr>
            <tr>
                <td style="vertical-align:top">Book Title</td>
                <td><input type="text" tabindex="3" name="book_title" value="<?=$val['book_title']?>" class="mandatory1 mandatory" id="book_title"  
                maxlength="20" /> </td>
            </tr>
            <tr>
            <td>Book Type</td>
            <td><select name="book_type" id="book_type" tabindex="4" class="mandatory" required >
            <?php 
			if(isset($book_type) && !empty($book_type))
			{
				foreach ($book_type as $val1)
				{
					?>
             <option <?=($val1['btid']==$val['book_type_id'])?'selected':''?> value="<?=$val1['btid']?>"><?=$val1['book_type']?></option>
            <?php }}; ?>
            </select></td>
        </tr>
        <tr>
            <td>Authore Name</td>
            <td><input type="text" tabindex="5" name="authore" value="<?=$val['author_name']?>" class="mandatory1 mandatory" id="authore"  />
            <span style="color:red;" id="phone_error" class="errormessage"></span> </td>
        </tr>
        <tr>
            <td>Purchase Date</td>
            <td><input type="text" tabindex="6" name="purchase" value="<?=$val['purchase_date']?>" class="date  mandatory1 mandatory" id="purchase" />
           
        </tr>
        <tr>
            <td>Edition</td>
            <td><input type="text" tabindex="7" name="edition" value="<?=$val['edition']?>" class="mandatory1 mandatory" id="edition" />
        </tr>
        <tr>
            <td>Price</td>
            <td><input type="text" tabindex="8" name="price" value="<?=$val['price']?>"  class="mandatory1 mandatory" id="price" />
            </td>
        </tr>
	 </table>
	</div>
	<div class="col-lg-6">
        <table class="staff_table">
       
        <tr>
            <td>No. of Pages</td>
            <td><input type="text" tabindex="9" name="page_no" value="<?=$val['no_of_pages']?>" class="mandatory1 mandatory" id="page_no" />
           </td>
        </tr>
        <tr>
            <td>Bill Number</td>
            <td><input type="text" tabindex="10" name="bill_no" value="<?=$val['billno']?>" class="mandatory1 mandatory" id="bill_no" />
            </td>
        </tr>
        <tr>
            <td>Publisher's name</td>
            <td><input type="text" tabindex="11" name="publisher" value="<?=$val['pub_name']?>" class="mandatory1 mandatory" id="publisher"/>
             </td>
        </tr>
        <tr>
            <td>Publisher's address</td>
            <td><textarea style="width: 60%; height: 50px;" class="mandatory1 mandatory" tabindex="12" name="publisher_add" id="publisher_add"><?=$val['pub_address']?></textarea> 
            </td>
        </tr>
        <tr>
            <td>Email-id</td>
            <td><input type="text" tabindex="13" name="email_id" class="mandatory1 mandatory" value="<?=$val['pub_email']?>" id="email_id"  />
            </td>
        </tr>
        <tr>
            <td>Contact number</td>
            <td><input type="text" tabindex="14" name="conta_num" class="mandatory1 mandatory" value="<?=$val['pub_contact_no']?>" id="conta_num"  />
             </td>
        </tr>
         <tr>
            <td>Select Rack</td>
           
            <td><select name="select_rack" tabindex="15" id="select_rack" class="mandatory"  >
           
           <?php 
		   //print_r($rack);exit;
			if(isset($rack) && !empty($rack))
			{
				foreach ($rack as $rack_val)
				{
					
					?>
          
            
             <option <?=($rack_val['brid']==$val['book_rack'])?'selected':''?> value="<?=$rack_val['brid']?>"><?=$rack_val['bk_rack']?></option>
            <?php }}; ?>
            </select></td>
        </tr>
        <tr>
            <td>Book Row</td>
            <td><input type="text" tabindex="16" name="book_row" class="mandatory1 mandatory" value="<?=$val['rack_row']?>" id="book_row"/>
        </tr>
        
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Update" name="adding" id="submit" class="btn btn-primary" tabindex="8" />
                <input type="button" value="Cancel" id="cancel" class="btn btn-danger" tabindex="9"/>
                </form>
            </td>
        </tr>
		  <?php }}?>
        </table>
	</div>
</div>
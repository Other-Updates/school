<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>  
<div class="row">
	<div class="col-lg-6">
    <?php $i=0;
	//echo "<pre>";print_r($details);exit;
			if(isset($details) && !empty($details))
			{
				foreach ($details as $view)
				{
					?>
    <form method="post" action="<?php echo $this->config->item("base_url"); ?>library/update_cd/<?php echo $view['id'];?>">
		<table class="staff_table">
         <tr>
                <td width="150">CD NO</td>
                <td><input type="text" tabindex="1" name="cd_no" value="<?php echo $view['cd_no'];?>"  id="cd_title" class="mandatory mandatory1"/> </td>
            </tr>
        
            <tr>
                <td width="150">Title</td>
                <td><input type="text" tabindex="1" name="cd_title" value="<?php echo $view['cd_title'];?>"  id="cd_title" class="mandatory mandatory1"/> </td>
            </tr>
            <tr>
            <td>Category</td>
                <td><select name="category" id="category" class="mandatory" >
             <option value="" selected="selected">Select</option>
             <?php 
			if(isset($category) && !empty($category))
			{
				foreach ($category as $cat)
				{
					
					?>
             <option <?=($cat['bcid']==$view['book_type_id'])?'selected':''?> value="<?=$cat['bcid']?>"><?=$cat['book_cat']?></option>
            <?php }}; ?>
            </select></td>
            </tr>
            
            <tr>
            <td>Language</td>
            <td><select name="language" id="language" class="mandatory" required >
             <option value="" selected="selected">Select</option>
             <?php 
			if(isset($language) && !empty($language))
			{
				foreach ($language as $lan)
				{
					?>
          
           
            
              <option <?=($lan['id']==$view['lang'])?'selected':''?> value="<?=$lan['id']?>"><?=$lan['lang_type']?></option>
            <?php }}; ?>
            </select></td>
        </tr>
        
        <tr>
            <td>Price</td>
            <td><input type="text" tabindex="4" name="price" value="<?php echo $view['price'];?>" class="mandatory1 mandatory" id="price" />
            </td>
        </tr>
        <tr>
            <td>Date of Receipt</td>
            <td><input type="text" tabindex="4" name="receipt" value="<?php echo $view['date_of_receipt'];?>" class="mandatory1 mandatory" id="receipt"  />
            </td>
        </tr>
        <tr>
            <td>Date of Purchase</td>
            <td><input type="text" tabindex="4" name="purchase" value="<?php echo $view['date_of_purchase'];?>" class="mandatory1 mandatory" id="purchase" />
            </td>
        </tr>
        <tr>
    <td>Select Rack</td>
   
    <td><select name="rack" id="" class="mandatory select_rack_ed"  >
    <option value="" selected="selected">Select</option>
   <?php 
    if(isset($rack) && !empty($rack))
    {
        foreach ($rack as $rack_val)
        {
            ?>
    		<option <?=($view['rack']==$rack_val['brid'])?'selected':''?> value="<?php echo $rack_val['brid']; ?>"><?php echo $rack_val['bk_rack']; ?></option>
    		<?php 
		}
	} 
	?>
    </select></td>
</tr>
	 </table>
	</div>
	<div class="col-lg-6">
        <table class="staff_table">
       
       
        <tr>
            <td>Editition</td>
            <td><input type="text" tabindex="4" name="editition" value="<?php echo $view['edition'];?>" class="mandatory1 mandatory" id="editition" />
            </td>
        </tr>
        <tr>
            <td>Bill Number</td>
            <td><input type="text" tabindex="4" name="bill_number" value="<?php echo $view['billno'];?>" class="mandatory1 mandatory" id="bill_number" />
       </tr>
        <tr>
            <td>Publisher's Name</td>
            <td><input type="text" tabindex="4" name="pub_name" value="<?php echo $view['pub_name'];?>" class="mandatory1 mandatory" id="pub_name" />
            </td>
        </tr>
        <tr>
            <td>Publisher's address</td>
            <td><textarea name="pub_add" id="pub_add" style="width: 60%; height: 50px;"><?php echo $view['pub_address'];?></textarea> </td>
        </tr>
        <tr>
            <td>Email-id</td>
            <td><input type="text" tabindex="4" name="email_id" value="<?php echo $view['pub_email'];?>" class="mandatory1 mandatory" id="email_id" />
            </td>
        </tr>
        <tr>
            <td>Contact number</td>
            <td><input type="text" tabindex="4" name="con_num" value="<?php echo $view['pub_contact_no'];?>" class="mandatory1 mandatory" id="con_num" />
           </td>
        </tr>
          <tr>
    <td>Select Rack</td>
   
    <td><select name="rack" id="" class="mandatory select_rack_ed"  >
    <option value="" selected="selected">Select</option>
   <?php 
    if(isset($rack) && !empty($rack))
    {
        foreach ($rack as $rack_val)
        {
            ?>
    		<option <?=($view['rack']==$rack_val['brid'])?'selected':''?> value="<?php echo $rack_val['brid']; ?>"><?php echo $rack_val['bk_rack']; ?></option>
    		<?php 
		}
	} 
	?>
    </select></td>
</tr>
<tr>
    <td>Row</td>
    <td><input type="text" name="row" tabindex="4" class="book_row mandatory1 mandatory select_row_ed" value="<?=$view['row']?>"/>
   </td>
</tr>         
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Update" name="adding" id="submit" class="btn btn-primary" tabindex="8" />
                <input type="button" value="Cancel" id="cancel" class="btn btn-danger" tabindex="9"/>
                 </form>
            </td>
        </tr>
        <?php }}; ?>
        </table>
       
	</div>
</div>
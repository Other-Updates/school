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
                <td class="text_bold"><?=$val['acc_no']?></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
            <td>Book No</td>
                <td class="text_bold"><?=$val['isbn_no']?> </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="vertical-align:top">Book Title</td>
                <td class="text_bold"><?=$val['book_title']?> </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
            <td>Book Type</td>
            <td class="text_bold"><?=$val['book_type']?></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Authore Name</td>
            <td class="text_bold"><?=$val['author_name']?> </td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Purchase Date</td>
           
             <td class="text_bold"><?=$val['purchase_date']?> </td>
        </tr>
        <tr>
            <td>Edition</td>
            <td class="text_bold"><?=$val['edition']?> </td>
           <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Price</td>
             <td class="text_bold"><?=$val['price']?> </td>
            <td>&nbsp;</td>
            </td>
        </tr>
	 </table>
	</div>
	<div class="col-lg-6">
        <table class="staff_table">
       
        <tr>
            <td>No. of Pages</td>
            
             <td class="text_bold"><?=$val['no_of_pages']?></td>
        <td>&nbsp;</td>
            
        </tr>
        <tr>
            <td>Bill Number</td>
            <td class="text_bold"><?=$val['billno']?></td>
        <td>&nbsp;</td>
           
        </tr>
        <tr>
            <td>Publisher's name</td>
            <td class="text_bold"><?=$val['pub_name']?></td>
        <td>&nbsp;</td>
            
        </tr>
        <tr>
            <td>Publisher's address</td>
           
            <td class="text_bold"><?=$val['pub_address']?></td>
        <td>&nbsp;</td> 
          
        </tr>
        <tr>
            <td>Email-id</td>
             <td class="text_bold"><?=$val['pub_email']?></td>
        <td>&nbsp;</td>
            
        </tr>
        <tr>
            <td>Contact number</td>
           
             <td class="text_bold"><?=$val['pub_contact_no']?></td>
        <td>&nbsp;</td>
        </tr>
         <tr>
            <td> Rack</td>
           
                        
            <td class="text_bold"><?=$val['book_rack']?></td>
        <td>&nbsp;</td>

           
        </tr>
        <tr>
            <td>Book Row</td>
            <td class="text_bold"><?=$val['rack_row']?></td>
        <td>&nbsp;</td>
            
        
        <tr>
            <td></td>
            <td>
                <input type="button" value="Back" class="btn btn-danger"  onclick="history.go(-1);return true;" />
                </form>
            </td>
        </tr>
        
        
        
		  <?php }}?>
        </table>
	</div>
</div>


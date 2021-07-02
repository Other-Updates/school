<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>  
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
                        <a href="#view_batch<?php  echo $view['id']; ?>" title="View" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="<?php $this->config->item("base_url"); ?>library/edit_book/<?=$view['id']?>" title="Edit" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="#delete_batch<?php  echo $view['id']; ?>" title="Delete" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                        </td>                    
                       
                    </tr>
					<?php $i++;} } ?> 

	</table>
    
 	</div>




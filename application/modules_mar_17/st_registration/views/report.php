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
<div class="row">
<div align="right"> <a href="<?php echo $this->config->item('base_url')?>st_registration/export_all"  class="btn btn-info btn-xs">Export</a>
 <input type="button" class="btn btn-info btn-xs print_btn" style="float:right;margin-right:10px;" value="Print"  id="print_btn" onclick="myFunction()" /></div>
	<div class="col-lg-6">
		<table class="staff_table">
            <td>Year</td>
            <?php $i = date("Y"); ?>
            <td><select name="year" id="year" class="mandatory year" required  title="Select Year">
            <option value="" selected="selected">Year</option>
            <?php for ($i ; $i < date('Y')+100; $i++) : ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
            </select></td>
            
        </tr>
        <td>Student Type</td>
            <td><select name="type" id="type" class="mandatory type" required  title="Select Year">
            <option value="">Select</option>
            <option value="1">In</option>
             <option value="2">Out</option>
           
            </select></td>
        
        </table>
	</div>
</div>

<div class="tab-pane" id="view_all"> 
<table id="example3" class="table table-bordered table-striped">
   
      <thead>
    	<tr>
            <th>S.no</th>
            <th>Application Number</th>
            <th>Student Name</th>
            <th>Address</th>
            <th>Email ID</th>
            <th>Phone Number</th>
            <th>Year</th>
            <th>Action</th>
           
        </tr>
        </thead>

<?php $i=0;
			if(isset($details) && !empty($details))
			{
				foreach ($details as $view)
				{
					?>
     
					<tr>
                        <td><?php echo  $i+1; ?></td>
                        <td><?php echo $view['admission_form_no'];?></td>
                         <td><?php echo $view['student_name'];?></td>
                          <td><?php echo $view['address'];?></td>
                           <td><?php echo $view['email'];?></td> 
                           <td><?php echo $view['phone_no'];?></td>
                            <td><?php echo $view['year'];?></td>
                             <td>
                        <a href="#view_batch<?php  echo $view['id']; ?>" title="View" data-toggle="modal" name="group" class="btn bg-maroon btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="#test1_<?php  echo $view['id']; ?>" title="Edit" data-toggle="modal" name="group" class="btn bg-navy btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="#delete_batch<?php  echo $view['id']; ?>" title="Delete" data-toggle="modal" name="group" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                        </td>                    
                       
                    </tr>
					<?php $i++;} } ?> 

	</table>
    </table>
 	</div>
    
    

<script type="text/javascript">

// inactive query	   
	  $("#yesin").live("click",function()
	  {
	   for_loading_del('Loading... Please wait'); // loading notification
	    var hidin=$(this).parent().parent().find('.hidin').val();
		  $.ajax(
		 	{
			  url:BASE_URL+"st_registration/delete_list",
			  type:'POST',
			  data:{ value1 : hidin},
			  success:function(result){
				  //alert(result);
			  $("#view_all").html(result);
			  for_response_del('Move To Alumni Successfully...!'); // resutl notification
			 }    
	 	 });
	    $('.modal').css("display", "none");
    	$('.fade').css("display", "none");
	}); 
	 $("#year").live("change",function()
	  {
		 
	  // for_loading_del('Loading... Please wait'); // loading notification
	    var year=$(this).parent().parent().find('.year').val();
		// alert(year);
		  $.ajax(
		 	{
			  url:BASE_URL+"st_registration/report_year",
			  type:'POST',
			  data:{ value1 : year},
			  success:function(result){
				 // alert(result);
			  $("#view_all").html(result);
			 // for_response_del('Move To Alumni Successfully...!'); // resutl notification
			 }    
	 	 });
	    $('.modal').css("display", "none");
    	$('.fade').css("display", "none");
	}); 
	$("#type").live("change",function()
	  {
		 
	  // for_loading_del('Loading... Please wait'); // loading notification
	    var type=$(this).parent().parent().find('.type').val();
		//var year=$(this).parent().parent().find('.year').val();
		//alert(type);
		  $.ajax(
		 	{
			  url:BASE_URL+"st_registration/report_type",
			  type:'POST',
			  data:{ value1 : type},
			  success:function(result){
				 // alert(result);
			  $("#view_all").html(result);
			 // for_response_del('Move To Alumni Successfully...!'); // resutl notification
			 }    
	 	 });
	    $('.modal').css("display", "none");
    	$('.fade').css("display", "none");
	}); 
</script>
<style type="text/css">
@media print{
	input
	{
		
		display:none;
	}
	}
</style>
<script>
function myFunction() {
    window.print();
}
</script>


   
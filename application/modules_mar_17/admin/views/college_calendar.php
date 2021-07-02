<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<script src='<?= $theme_path?>/js/moment.min.js'></script>
<script src='<?= $theme_path?>/js/jquery-ui.custom.min.js'></script>
<script>
<?php 
$user_det = $this->session->userdata('logged_in');
		
?>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '2014-06-12',
			selectable: true,
			selectHelper: true,
			/*eventClick: function(calEvent, jsEvent, view) {
					  var title = prompt('Day Order:', calEvent.title, { buttons: { Ok: true, Cancel: true} });
			
					  if (title){
						  calEvent.title = title;
						  console.log(calEvent);
						  calendar.fullCalendar('updateEvent',calEvent);
					  }
			},*/
			titleFormat: {

day: 'd, m, yyyy'   //whatever date format you want here
},
<?php 
	if($user_det['staff_type']=='admin'){
	?>
			select: function(start, end) {
				
				var title = prompt('Day Order:');
				if(title.length==1)
					title='Day-'+title;
				var eventData;
				if (title) {
					if(title.length==5)
					eventData = {
						title: title,
						start: start,
						end: end
					};
					else
					eventData = {
						title: title,
						start: start,
						color:'rgb(91, 173, 80)',
						end: end
					};
					var start = $.fullCalendar.formatDate(start, 'yyyy-MM-dd');
        			var end = $.fullCalendar.formatDate(end, 'yyyy-MM-dd');
					$.ajax({
						//for_loading_del('Loading... Data Updating Please Wait '); // loading notification
					  url:BASE_URL+"admin/add_calendar",
					  type:'get',
					  data:{ 
								start_date : start,
								end_date : end,
								title_name:title
						   },
					  success:function(){
							// for_response_del('Successfully Added...!'); // resutl notification  
					  }    
					});	
					$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				}
				$('#calendar').fullCalendar('unselect');

			},
	
  eventClick: function (calEvent, jsEvent, view) {
	var start = $.fullCalendar.formatDate(calEvent.start, 'yyyy-MM-dd');
    var end = $.fullCalendar.formatDate(calEvent.end, 'yyyy-MM-dd');
	var r = confirm("Are Sure You Want to Delete ?");
	if (r == true) {
		$.ajax({
		 // for_loading_del('Loading... Data Removing Please Wait '); // loading notification	
		  url:BASE_URL+"admin/delete_calendar",
		  type:'get',
		  data:{ 
					start_date : start,
					end_date : end
			   },
		  success:function(){
			//  for_response_del('Successfully Removed...!'); // resutl notification  
		
		  }    
		});	
		$('#calendar').fullCalendar('removeEvents', calEvent._id);
	} 
	     
    
},

			editable: true,<?php }?>
			<?php print_r($list);?>,
			/*events: [
				{
					title: 'All Day Event',
					start: '2014-06-01'
				},
				{
					title: 'Long Event',
					start: '2014-06-07',
					end: '2014-06-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-06-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-06-16T16:00:00'
				},
				{
					title: 'Meeting',
					start: '2014-06-12T12:30:00',
					end: '2014-06-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2014-06-12T12:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2014-06-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2014-06-28'
				}
			]*/
		});
		
	});

</script>
	<div id='calendar'></div>
<style type="text/css">
table.fc-border-separate
{
	border:1px solid #EBEBEB;
}
</style>
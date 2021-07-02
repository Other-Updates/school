<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<link href="<?= $theme_path; ?>/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?= $theme_path; ?>/js/plugins/fullcalendar/fullcalendar.js"></script>
<script>
	$(document).ready(function() {
	
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			
			 header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    buttonText: {//This is to add icons to the visible buttons
                        prev: "<span class='fa fa-caret-left'></span>",
                        next: "<span class='fa fa-caret-right'></span>",
                        today: 'today',
                        month: 'month',
                        week: 'week',
                        day: 'day'
                    },
					defaultDate: '2014-06-12',
		   selectable: true,
		   selectHelper: true,
		  
		   editable: false,
                    //Random default events
                  <?php print_r($list)?>,
                    editable: true,
                    droppable: true, // this allows things to be dropped onto the calendar !!!
                    drop: function(date, allDay) { // this function is called when something is dropped

                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject');

                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject);

                        // assign it the date that was reported
                        copiedEventObject.start = date;
                        copiedEventObject.allDay = allDay;
                        copiedEventObject.backgroundColor = $(this).css("background-color");
                        copiedEventObject.borderColor = $(this).css("border-color");

                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                        // is the "remove after drop" checkbox checked?
                        if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            $(this).remove();
                        }

                    }
			
			
			
		});
		
	});

</script>
<style type="text/css">
	#calendar {
		width: 100%;
	}
	#calendar table{ border:0;}
	#calendar table td.fc-header-left, #calendar table td.fc-header-center, #calendar table td.fc-header-right{ border:0;}
</style>
<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user"><img src="<?= $theme_path; ?>/images/icons/events/clendar.png"></div>
    Calendar			
</div>
<div class="message-form-inner">
<div id='calendar'></div>

<script type="text/javascript">
$(document).ready(function(){
	$('.print_btn').click(function(){
		window.print();	
	});	
});
</script>
</div>
</div>
</div>

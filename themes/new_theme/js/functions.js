   
 // CALENDAR DATE PICKER ===============================================================================

	$('#datetimepicker').datetimepicker({
        format: 'dd/MM/yyyy hh:mm',
		pick12HourFormat: false,   // enables the 12-hour format time picker
  		pickSeconds: false, 
        language: 'en'
      });
	  

	  
// TABS NAVIGATION ===============================================================================  
	  $('body').on('click', 'ul.tabs > li > a', function(e) {

    //Get Location of tab's content
    var contentLocation = $(this).attr('href');

    //Let go if not a hashed one
    if(contentLocation.charAt(0)=="#") {

        e.preventDefault();

        //Make Tab Active
        $(this).parent().siblings().children('a').removeClass('active');
        $(this).addClass('active');

        //Show Tab Content & add active class
        $(contentLocation).show().addClass('active').siblings().hide().removeClass('active');

    }
});

// BOOTSTRAP SELECT ===============================================================================  
$('.selectpicker').selectpicker();

jQuery.noConflict();

jQuery(document).ready(function(){
	
	prettyPrint();			//syntax highlighter
	mainwrapperHeight();
	responsive();
	
	
	// animation
	if(!jQuery('.left-side').hasClass('clicked')) {
		var anicount = 4;	
		jQuery('.sidebar ul.sidebar-menu > li').each(function(){										   
			jQuery(this).addClass('animate'+anicount+' fadeInUp');
			anicount++;
		});
		
		jQuery('.sidebar ul.sidebar-menu > li a').hover(function(){
			jQuery(this).find('span').addClass('animate0 swing');
		},function(){
			jQuery(this).find('span').removeClass('animate0 swing');
		});
		
		jQuery('.logopanel').addClass('animate0 fadeInUp');
		jQuery('.datewidget, .headerpanel').addClass('animate1 fadeInUp');
		jQuery('.searchwidget, .breadcrumbwidget').addClass('animate2 fadeInUp'); 
		jQuery('.plainwidget, .pagetitle').addClass('animate3 fadeInUp');
		jQuery('.maincontent').addClass('animate4 fadeInUp');
	}
	
	// widget icons dashboard
	if(jQuery('.widgeticons').length > 0) {
		jQuery('.widgeticons a').hover(function(){
			jQuery(this).find('img').addClass('animate0 bounceIn');
		},function(){
			jQuery(this).find('img').removeClass('animate0 bounceIn');
		});	
	}


	// adjust height of mainwrapper when 
	// it's below the document height
	function mainwrapperHeight() {
		var windowHeight = jQuery(window).height();
		var mainWrapperHeight = jQuery('.mainwrapper').height();
		var leftPanelHeight = jQuery('.leftpanel').height();
		if(leftPanelHeight > mainWrapperHeight)
			jQuery('.mainwrapper').css({minHeight: leftPanelHeight});	
		if(jQuery('.mainwrapper').height() < windowHeight)
			jQuery('.mainwrapper').css({minHeight: windowHeight});
	}
	
	function responsive() {
		
		var windowWidth = jQuery(window).width();
		
		// hiding and showing left menu
		if(!jQuery('.showmenu').hasClass('clicked')) {
			
			if(windowWidth < 960)
				hideLeftPanel();
			else
				showLeftPanel();
		}
		
		// rearranging widget icons in dashboard
		if(windowWidth < 768) {
			if(jQuery('.widgeticons .one_third').length == 0) {
				var count = 0;
				jQuery('.widgeticons li').each(function(){
					jQuery(this).removeClass('one_fifth last').addClass('one_third');
					if(count == 2) {
						jQuery(this).addClass('last');
						count = 0;
					} else { count++; }
				});	
			}
		} else {
			if(jQuery('.widgeticons .one_firth').length == 0) {
				var count = 0;
				jQuery('.widgeticons li').each(function(){
					jQuery(this).removeClass('one_third last').addClass('one_fifth');
					if(count == 4) {
						jQuery(this).addClass('last');
						count = 0;
					} else { count++; }
				});	
			}
		}
	}
	

	
	
	// show left panel
	function showLeftPanel() {
		jQuery('.leftpanel').css({marginLeft: '0px'}).removeClass('hide');
		jQuery('.rightpanel').css({marginLeft: '260px'});
		jQuery('.mainwrapper').css({backgroundPosition: '0 0'});
		jQuery('.footerleft').show();
		jQuery('.footerright').css({marginLeft: '260px'});
	}
	

	
});
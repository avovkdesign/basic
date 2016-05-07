jQuery(document).ready(function($) {
	
// toTop button 
	$(window).scroll( function() {
		if( $(this).scrollTop() != 0)	$('#toTop').fadeIn();
		else 	$('#toTop').fadeOut(); 
	});
	$('#toTop').click( function() {
		$('body,html').animate( {scrollTop:0}, 500);
	});

	
// responsive menu 
	var nav = $('#header nav');
	var pull = $('#mobile-menu');
	if ( $(window).width() < 1025) {
		nav.hide();
		pull.removeClass('mm-active');
	}
	pull.click(function() {
		if ( nav.is(':visible') ) { 
			nav.hide();
			pull.removeClass('mm-active');
		} else {
			nav.show();
			pull.addClass('mm-active');
		}  
		return false;
	});
	$(window).resize(function(){  
		if ( $(window).width() > 1025 ) { 
			pull.hide();
			nav.show();  
		} else {
			pull.show().removeClass('mm-active');
			nav.hide();  
		}  
	});

	
// social buttons
	$('.psb').click(function(){
	 	window.open($(this).attr("href"),'displayWindow', 'width=700,height=400,left=200,top=100,location=no, directories=no,status=no,toolbar=no,menubar=no');
	  	return false;
	});

});

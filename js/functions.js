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
	var nav = $('.topnav nav'),
		pull = $('#mobile-menu');

	if ( window.innerWidth < 1024) {
	// if ( $(document).width() < 1024) {
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
		// console.log( 'document = ' + window.innerWidth );
		// console.log( 'document = ' + $(document).width() );
		// console.log( 'window = ' + $(window).width() );
		// console.log( 'body = ' + $('body').width() );

		// if ( $(document).width() > 1024 ) {
		if ( window.innerWidth >= 1024 ) {
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

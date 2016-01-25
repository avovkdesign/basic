jQuery(document).ready(function($) {

	$('#themeoptions .form-table').each( function(){
		var name = $(this).prev().find('a').attr('href');
		$(this).wrap('<div id="' + name.substr(1) + '" class="tabitem"></div>');
	});
	
	$('#themeoptions form > h3:not(:first) a').appendTo( $('#themeoptions form > h3:first').attr('id','tabs') );
	$('#themeoptions form > h3:not(:first)').remove();
	
	$('#themeoptions form > h2:not(:first) a').appendTo( $('#themeoptions form > h2:first').attr('id','tabs') );
	$('#themeoptions form > h2:not(:first)').remove();

	$(".tabitem").hide();
	$("#tabs a:first").addClass('active');
	$(".tabitem:first").show();
	$("#tabs a").click(function() {
		$("#tabs a").removeClass("active");
		$(this).addClass("active");
		$(".tabitem").hide();
		var actTab = $(this).attr("href");
		$(actTab).fadeIn(300);
		return false;
	});
	
	var $color_inputs = $('input.popup-colorpicker');
	$color_inputs.each(function(){
		var $input = $(this);
		var $pickerId = "#" + $(this).attr('id') + "picker";

		$($pickerId).hide();
		$($pickerId).farbtastic($input);
		$($input).focus(function(){ $($pickerId).slideDown() });
		$($input).blur(function(){ $($pickerId).slideUp() });
	});
	
});

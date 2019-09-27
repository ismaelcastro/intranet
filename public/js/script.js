
$(document).ready(function(){
	// $('body').bind('contextmenu', function(e){
	// 	return false;	
	// });

	
});

$(window).on('load',function(){
	$('.preload').hide();
});

$(window).on('beforeunload', function(){
	$('.preload').show();
});